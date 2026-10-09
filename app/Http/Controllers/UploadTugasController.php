<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Jurnal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Support\Waktu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class UploadTugasController extends Controller
{
    private const NAMA_HARI = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];

    public function create(): View
    {
        $sekarang = Waktu::sekarang();
        $hari = self::NAMA_HARI[$sekarang->dayOfWeekIso] ?? null;
        $jadwalHariIni = $hari
            ? JadwalPelajaran::with(['kelas', 'mapel', 'jamPelajaran'])
                ->whereHas('jamPelajaran', fn ($query) => $query
                    ->where('hari', $hari)
                    ->whereHas('semester', fn ($semester) => $semester->where('status', 'aktif')))
                ->get()
                ->filter(fn ($jadwal) => $jadwal->kelas && $jadwal->mapel && $jadwal->jamPelajaran)
                ->sortBy(fn ($jadwal) => [$jadwal->kelas->tingkat, $jadwal->kelas->jurusan, $jadwal->kelas->rombel, $jadwal->jamPelajaran->jam_ke])
            : collect();

        $jadwalOptions = $jadwalHariIni->map(fn ($jadwal) => [
            'id' => (int) $jadwal->id_jadwal,
            'id_kelas' => (int) $jadwal->id_kelas,
            'kelas' => $jadwal->kelas->nama_kelas,
            'mapel' => $jadwal->mapel->nama_mapel,
            'jam_ke' => (int) $jadwal->jamPelajaran->jam_ke,
            'jam_mulai' => substr($jadwal->jamPelajaran->jam_mulai, 0, 5),
            'jam_selesai' => substr($jadwal->jamPelajaran->jam_selesai, 0, 5),
        ])->values();

        return view('guru.upload-tugas', [
            'kelasList' => Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get(),
            'mapelList' => Mapel::orderBy('nama_mapel')->pluck('nama_mapel'),
            'kelasOptions' => Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get()->map(fn ($kelas) => [
                'id' => (int) $kelas->id_kelas,
                'label' => $kelas->nama_kelas,
            ])->values(),
            'jadwalOptions' => $jadwalOptions,
        ]);
    }

    public function reviewIndex(): View
    {
        $kolom = Schema::getColumnListing('upload_tugas');
        $query = DB::table('upload_tugas')
            ->join('kelas', 'kelas.id_kelas', '=', 'upload_tugas.id_kelas')
            ->leftJoin('users', 'users.id', '=', 'upload_tugas.'.(in_array('id_pengunggah', $kolom, true) ? 'id_pengunggah' : 'id_guru_piket'));

        if (in_array('id_jadwal', $kolom, true)) {
            $query->whereNull('upload_tugas.id_jadwal');
        }
        if (in_array('status_review', $kolom, true)) {
            $query->where('upload_tugas.status_review', 'menunggu');
        } else {
            $query->whereRaw('1 = 0');
        }

        $pilihan = ['upload_tugas.*', 'kelas.tingkat', 'kelas.jurusan', 'kelas.rombel', 'users.name as nama_guru'];
        foreach (['tanggal', 'materi', 'file_path', 'alasan_izin'] as $optionalColumn) {
            if (! in_array($optionalColumn, $kolom, true)) {
                $pilihan[] = DB::raw("null as {$optionalColumn}");
            }
        }
        $tugasMenunggu = $query->orderByDesc('upload_tugas.created_at')->select($pilihan)->get();

        return view('guru.setujui-tugas', compact('tugasMenunggu'));
    }

    public function createGuru(): View
    {
        $hari = self::NAMA_HARI[Waktu::sekarang()->dayOfWeekIso] ?? null;
        $mapelPerKelas = $hari
            ? JadwalPelajaran::with('mapel')
                ->whereHas('jamPelajaran', fn ($query) => $query->where('hari', $hari)->whereHas('semester', fn ($semester) => $semester->where('status', 'aktif')))
                ->get()->filter(fn ($jadwal) => $jadwal->mapel)
                ->groupBy('id_kelas')->map(fn ($jadwals) => $jadwals->pluck('mapel.nama_mapel')->unique()->values())
            : collect();

        return view('guru.unggah-tugas-guru', [
            'kelasList' => Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get(),
            'mapelPerKelas' => $mapelPerKelas,
        ]);
    }

    public function storeGuru(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:izin,sakit'], 'alasan_izin' => ['exclude_unless:status,izin', 'required', 'string', 'max:2000'],
            'id_kelas' => ['required', 'integer', 'exists:kelas,id_kelas'], 'mapel' => ['required', 'string', 'exists:mapel,nama_mapel'],
            'materi' => ['required', 'string', 'max:5000'], 'tugas' => ['required', 'string', 'max:10000'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip', 'max:20480'],
        ]);
        $hari = self::NAMA_HARI[Waktu::sekarang()->dayOfWeekIso] ?? null;
        $mapelTerjadwal = $hari ? JadwalPelajaran::with('mapel')
            ->where('id_kelas', $data['id_kelas'])
            ->whereHas('mapel', fn ($query) => $query->where('nama_mapel', $data['mapel']))
            ->whereHas('jamPelajaran', fn ($query) => $query->where('hari', $hari)->whereHas('semester', fn ($semester) => $semester->where('status', 'aktif')))
            ->exists() : false;
        if (! $mapelTerjadwal) {
            return back()->withErrors(['mapel' => 'Mata pelajaran tidak terjadwal untuk kelas yang dipilih hari ini.'])->withInput();
        }
        $filePath = $request->hasFile('file') ? $request->file('file')->store('tugas-guru', 'public') : null;
        DB::table('upload_tugas')->insert([
            'id_kelas' => $data['id_kelas'], 'id_jadwal' => null, 'tanggal' => Waktu::sekarang()->toDateString(), 'file_path' => $filePath,
            'mapel' => $data['mapel'], 'materi' => $data['materi'], 'status_guru' => ucfirst($data['status']),
            'alasan_izin' => $data['status'] === 'izin' ? $data['alasan_izin'] : null, 'tugas' => $data['tugas'],
            'id_guru_piket' => $request->user()->id, 'id_pengunggah' => $request->user()->id, 'status_review' => 'menunggu',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        return redirect()->route('dashboard-guru')->with('success', 'Tugas terkirim kepada guru piket untuk disetujui.');
    }

    public function unduhLampiran(int $id): Response
    {
        $tugas = DB::table('upload_tugas')->where('id_upload_tugas', $id)->first();
        abort_if(! $tugas || ! $tugas->file_path, 404);
        abort_unless(Storage::disk('public')->exists($tugas->file_path), 404, 'Lampiran tidak ditemukan.');

        return Storage::disk('public')->response($tugas->file_path);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:izin,sakit'],
            'alasan_izin' => ['nullable', 'string', 'max:2000'],
            'id_kelas' => ['required', 'integer', 'exists:kelas,id_kelas'],
            'id_jadwal' => ['required', 'integer', 'exists:jadwal_pelajaran,id_jadwal'],
            'mapel' => ['required', 'string', 'exists:mapel,nama_mapel'],
            'materi' => ['required', 'string', 'max:5000'],
            'tugas' => ['required', 'string', 'max:10000'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip', 'max:20480'],
        ], [
            'materi.required' => 'Materi pembelajaran wajib diisi.',
            'id_jadwal.required' => 'Pilih sesi mengajar untuk tugas ini.',
        ]);

        if ($data['status'] === 'izin' && blank($data['alasan_izin'])) {
            return back()->withErrors(['alasan_izin' => 'Alasan izin wajib diisi.'])->withInput();
        }

        $jadwal = JadwalPelajaran::with(['kelas', 'mapel', 'jamPelajaran'])
            ->where('id_jadwal', $data['id_jadwal'])
            ->first();
        if (! $jadwal || (int) $jadwal->id_kelas !== (int) $data['id_kelas'] || $jadwal->mapel?->nama_mapel !== $data['mapel']) {
            return back()->withErrors(['id_jadwal' => 'Sesi tidak cocok dengan kelas dan mata pelajaran yang dipilih.'])->withInput();
        }

        $tanggal = Waktu::sekarang()->toDateString();
        $statusGuru = $data['status'];
        $jurnal = Jurnal::whereHas('jadwal', fn ($query) => $query
            ->where('id_kelas', $jadwal->id_kelas)
            ->where('id_guru', $jadwal->id_guru)
            ->where('id_mapel', $jadwal->id_mapel))
            ->whereDate('tanggal', $tanggal)
            ->latest('id_jurnal')->first();

        if ($jurnal && strtolower((string) $jurnal->status_kehadiran_guru) === 'hadir') {
            return back()->withErrors(['id_jadwal' => 'Guru pada sesi ini sudah tercatat hadir. Tugas piket hanya dapat diunggah untuk guru yang sakit atau izin.'])->withInput();
        }
        if ($jurnal && in_array(strtolower((string) $jurnal->status_kehadiran_guru), ['sakit', 'izin'], true) && $jurnal->status_verifikasi === 'terverifikasi') {
            return back()->withErrors(['id_jadwal' => 'Status guru pada sesi ini sudah tercatat sakit/izin. Gunakan catatan tugas yang sudah ada.'])->withInput();
        }
        $filePath = $request->hasFile('file') ? $request->file('file')->store('tugas-piket', 'public') : null;

        DB::transaction(function () use ($data, $jadwal, $request, $tanggal, $statusGuru, $filePath, $jurnal) {
            DB::table('upload_tugas')->insert([
                'id_kelas' => $jadwal->id_kelas,
                'id_jadwal' => $jadwal->id_jadwal,
                'tanggal' => $tanggal,
                'file_path' => $filePath,
                'mapel' => $jadwal->mapel->nama_mapel,
                'materi' => $data['materi'],
                'status_guru' => ucfirst($statusGuru),
                'alasan_izin' => $statusGuru === 'izin' ? $data['alasan_izin'] : null,
                'tugas' => $data['tugas'],
                'id_guru_piket' => $request->user()->id,
                'id_pengunggah' => $jadwal->id_guru,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $keterangan = ucfirst($statusGuru);
            if ($statusGuru === 'izin' && filled($data['alasan_izin'])) {
                $keterangan .= ': '.$data['alasan_izin'];
            }
            $keterangan .= ' · Tugas: '.$data['tugas'];

            $nilaiJurnal = [
                'id_jadwal' => $jadwal->id_jadwal,
                'tanggal' => $tanggal,
                'materi' => $data['materi'],
                'keterangan' => $keterangan,
                'jumlah_hadir' => null,
                'status_kehadiran_guru' => 'menunggu_verifikasi',
                'status_verifikasi' => 'belum_verifikasi',
                'status_piket' => 'menunggu',
                'alasan_tolak' => null,
                'id_diperiksa_oleh' => null,
                'diperiksa_at' => null,
                'waktu_submit' => now(),
            ];

            if ($jurnal) {
                $jurnal->update($nilaiJurnal);
            } else {
                Jurnal::create($nilaiJurnal);
            }
        });

        return redirect()->route('piket.upload-tugas')->with('success', 'Tugas '.$jadwal->mapel->nama_mapel.' untuk '.$jadwal->kelas->nama_kelas.' (jam ke-'.$jadwal->jamPelajaran->jam_ke.') berhasil dikirim untuk ditinjau guru piket.');
    }

    public function tinjau(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate([
            'keputusan' => ['required', 'in:disetujui,ditolak'],
            'catatan' => ['required_if:keputusan,ditolak', 'nullable', 'string', 'max:1000'],
        ], ['catatan.required_if' => 'Catatan penolakan wajib diisi.']);
        abort_unless(Schema::hasColumn('upload_tugas', 'status_review'), 404, 'Fitur persetujuan tugas belum tersedia. Jalankan migrasi database terlebih dahulu.');
        $tugas = DB::table('upload_tugas')->where('id_upload_tugas', $id)->lockForUpdate()->first();
        abort_unless($tugas && ($tugas->status_review ?? 'menunggu') === 'menunggu', 404);
        abort_unless($tugas->id_jadwal === null, 404);

        DB::transaction(function () use ($data, $tugas, $request) {
            DB::table('upload_tugas')->where('id_upload_tugas', $tugas->id_upload_tugas)->update([
                'status_review' => $data['keputusan'], 'catatan_piket' => $data['catatan'] ?? null,
                'ditinjau_at' => now(), 'updated_at' => now(),
            ]);
            if ($tugas->id_jadwal) Jurnal::where('id_jadwal', $tugas->id_jadwal)->whereDate('tanggal', $tugas->tanggal)->update([
                'status_kehadiran_guru' => $data['keputusan'] === 'disetujui' ? strtolower($tugas->status_guru) : 'menunggu_verifikasi',
                'status_verifikasi' => $data['keputusan'] === 'disetujui' ? 'terverifikasi' : 'belum_verifikasi',
                'status_piket' => $data['keputusan'], 'alasan_tolak' => $data['keputusan'] === 'ditolak' ? ($data['catatan'] ?? 'Tugas ditolak guru piket.') : null,
                'id_diperiksa_oleh' => $request->user()->id, 'diperiksa_at' => now(), 'updated_at' => now(),
            ]);
        });

        return redirect()->route('piket.tugas-review')->with('success', 'Tinjauan tugas berhasil disimpan.');
    }
}
