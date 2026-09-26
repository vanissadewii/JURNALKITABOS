<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Jurnal;
<<<<<<< HEAD
use App\Models\Siswa;
use App\Services\VerifikasiSesiService;
use App\Support\Waktu;
=======
use App\Models\PengaturanJurnalSusulan;
use App\Models\Siswa;
use App\Models\Dispen;
use Illuminate\Support\Facades\DB;
use App\Services\VerifikasiSesiService;
use App\Support\Waktu;
use Carbon\Carbon;
>>>>>>> putri/tampilan-admin
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class JurnalController extends Controller
{
    public function create(Request $request, VerifikasiSesiService $sesi): View|RedirectResponse
    {
        $guru = Auth::user();
<<<<<<< HEAD

        $jadwalAktif = $request->query('jadwal')
            ? JadwalPelajaran::with(['kelas', 'mapel', 'jamPelajaran'])
                ->where('id_guru', $guru->id)
                ->where('id_jadwal', (int) $request->query('jadwal'))
                ->first()
            : $sesi->jadwalBerlangsung(idGuru: (int) $guru->id);

        if (! $jadwalAktif) {
            return redirect()->route('dashboard-guru')
                ->with('error', 'Tidak ada sesi mengajar yang sedang berlangsung.');
        }

        if (! $sesi->masihBerjalan($jadwalAktif)) {
            return redirect()->route('dashboard-guru')
                ->with('error', 'Sesi pelajaran ini sudah selesai, jurnal tidak bisa diisi lagi.');
        }

        $jurnal = $sesi->jurnalSesi($jadwalAktif); // draft yang sudah pernah diisi (kalau ada)

        if ($jurnal && $jurnal->status_verifikasi === 'terverifikasi') {
            return redirect()->route('guru.verifikasisukses', $jurnal);
        }

        if ($jurnal) {
            return redirect()->route('guru.scan')
                ->with('info', 'Jurnal sudah terkirim, tinggal verifikasi kehadiran lewat scan QR kelas.');
        }

        $daftarSiswa = Siswa::where('id_kelas', $jadwalAktif->id_kelas)->orderBy('nama')->get();
        $rentang = $sesi->rentang($jadwalAktif);

        return view('guru.form_jurnal', compact('jadwalAktif', 'daftarSiswa', 'rentang'));
=======
        $isSusulan = $request->boolean('susulan');
        $tanggalJurnal = Carbon::parse(Waktu::sekarang()->toDateTimeString());
        $jadwalPilihan = collect();

        if ($isSusulan) {
            if (! PengaturanJurnalSusulan::forGuru((int) Auth::id())->aktif) {
                return redirect()->route('dashboard-guru')->with('error', 'Pengisian jurnal susulan sedang ditutup oleh admin.');
            }

            $tanggalJurnal->subDay();
            $namaHari = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
            $hariTarget = $namaHari[$tanggalJurnal->dayOfWeekIso] ?? null;

            if (! $hariTarget) {
                return redirect()->route('dashboard-guru')->with('error', 'Tidak ada jadwal pelajaran untuk hari kemarin.');
            }

            $jadwalPilihan = JadwalPelajaran::with(['kelas', 'mapel', 'jamPelajaran.semester'])
                ->where('id_guru', $guru->id)
                ->whereHas('jamPelajaran', fn ($q) => $q
                    ->where('hari', $hariTarget)
                    ->whereHas('semester', fn ($semester) => $semester->where('status', 'aktif')))
                ->get()
                ->sortBy(fn ($jadwal) => $jadwal->jamPelajaran->jam_mulai)
                ->values();

            $jadwalAktif = $request->filled('jadwal')
                ? $jadwalPilihan->firstWhere('id_jadwal', (int) $request->query('jadwal'))
                : $jadwalPilihan->first();

            if (! $jadwalAktif) {
                return redirect()->route('dashboard-guru')->with('error', 'Tidak ditemukan jadwal mengajar Anda untuk kemarin.');
            }
        } else {
            if ($request->filled('jadwal')) {
                $jadwalAktif = JadwalPelajaran::with(['kelas', 'mapel', 'jamPelajaran.semester'])
                    ->where('id_guru', $guru->id)
                    ->where('id_jadwal', (int) $request->query('jadwal'))
                    ->whereHas('jamPelajaran.semester', fn ($q) => $q->where('status', 'aktif'))
                    ->first();
            } else {
                $jadwalAktif = $sesi->jadwalBerlangsung(idGuru: (int) $guru->id);
            }

            if ($jadwalAktif) {
                $jadwalPilihan = collect([$jadwalAktif]);
            }
        }

        if (! $jadwalAktif) {
            return redirect()->route('dashboard-guru')
                ->with('error', 'Belum ada jadwal aktif untuk akun guru ini. Hubungi admin untuk menambahkan jadwal.');
        }

        $tanggalString = $tanggalJurnal->toDateString();
        $jurnal = $sesi->jurnalSesi($jadwalAktif, $tanggalString);

        if ($jurnal && $jurnal->status_verifikasi === 'terverifikasi') {
            return redirect('/dashboard-guru')->with('success', 'Jurnal untuk sesi ini sudah terverifikasi.');
        }

        $daftarSiswa = Siswa::where('id_kelas', $jadwalAktif->id_kelas)->orderBy('no_absen')->orderBy('nama')->get();
        $statusPiket = DB::table('surat_siswa')->where('id_kelas', $jadwalAktif->id_kelas)->whereDate('tanggal', $tanggalString)->get()->keyBy('id_siswa');
        $statusDispen = Dispen::where('id_kelas', $jadwalAktif->id_kelas)->whereDate('tanggal', $tanggalString)->where('status', 'disetujui')
            ->where('jam_ke_mulai', '<=', $jadwalAktif->jamPelajaran->jam_ke)
            ->where(function ($q) use ($jadwalAktif) { $q->whereNull('jam_ke_selesai')->orWhere('jam_ke_selesai', '>=', $jadwalAktif->jamPelajaran->jam_ke); })
            ->get()->keyBy('id_siswa');
        $statusJurnal = $jurnal?->absenSiswa()->get()->keyBy('id_siswa') ?? collect();
        $daftarSiswaJson = json_encode($daftarSiswa->map(function ($siswa) use ($statusPiket, $statusDispen, $statusJurnal) {
            $status = $statusJurnal->get($siswa->id_siswa)?->status ?? 'Hadir';
            $otomatis = false;
            $alasan = null;
            if ($statusPiket->has($siswa->id_siswa)) {
                $status = $statusPiket->get($siswa->id_siswa)->status;
                $otomatis = true;
            }
            if ($statusDispen->has($siswa->id_siswa)) {
                $status = 'Dispen';
                $alasan = $statusDispen->get($siswa->id_siswa)->alasan;
                $otomatis = true;
            }
            return ['key' => (string) $siswa->id_siswa, 'id_siswa' => $siswa->id_siswa, 'nama' => $siswa->nama,
                'absen' => str_pad((string) ($siswa->no_absen ?? '-'), 2, '0', STR_PAD_LEFT), 'status' => $status,
                'otomatis' => $otomatis, 'alasan' => $alasan];
        })->values(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
        $rentang = $sesi->rentang($jadwalAktif);

        return view('guru.form_jurnal', compact(
            'jadwalAktif', 'jadwalPilihan', 'daftarSiswa', 'daftarSiswaJson', 'rentang', 'jurnal', 'isSusulan', 'tanggalJurnal'
        ));
>>>>>>> putri/tampilan-admin
    }

    public function store(Request $request, VerifikasiSesiService $sesi): RedirectResponse
    {
        $validated = $request->validate([
            'id_jadwal' => 'required|exists:jadwal_pelajaran,id_jadwal',
<<<<<<< HEAD
=======
            'susulan' => 'nullable|boolean',
>>>>>>> putri/tampilan-admin
            'materi' => 'nullable|string',
            'catatan' => 'nullable|string',
            'jumlah_hadir' => 'nullable|integer|min:0',
            'siswa_absen' => 'nullable|array',
            'siswa_absen.*.nama' => 'required_with:siswa_absen|string',
<<<<<<< HEAD
            'siswa_absen.*.status' => 'required_with:siswa_absen|in:Sakit,Izin,Alpha',
=======
            'siswa_absen.*.id_siswa' => 'nullable|exists:siswa,id_siswa',
            'siswa_absen.*.status' => 'required_with:siswa_absen|in:Sakit,Izin,Dispen,Alpha',
>>>>>>> putri/tampilan-admin
        ]);

        $isSusulan = $request->boolean('susulan');
        if ($isSusulan && ! PengaturanJurnalSusulan::forGuru((int) Auth::id())->aktif) {
            return redirect()->route('dashboard-guru')->with('error', 'Pengisian jurnal susulan sedang ditutup oleh admin.');
        }

<<<<<<< HEAD
        if (! $sesi->masihBerjalan($jadwal)) {
=======
        $tanggalJurnal = Carbon::parse(Waktu::sekarang()->toDateTimeString());
        if ($isSusulan) {
            $tanggalJurnal->subDay();
        }
        $namaHari = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
        $hariTarget = $namaHari[$tanggalJurnal->dayOfWeekIso] ?? null;

        $jadwalQuery = JadwalPelajaran::with(['jamPelajaran.semester'])
            ->where('id_jadwal', $validated['id_jadwal'])
            ->where('id_guru', Auth::id());
        if ($isSusulan) {
            $jadwalQuery->whereHas('jamPelajaran', fn ($q) => $q
                ->where('hari', $hariTarget)
                ->whereHas('semester', fn ($semester) => $semester->where('status', 'aktif')));
        }
        $jadwal = $jadwalQuery->first();

        if (! $jadwal) {
            return redirect()->route('dashboard-guru')->with('error', 'Jadwal tersebut tidak terdaftar untuk tanggal jurnal yang dipilih.');
        }

        if (! $isSusulan && ! $sesi->masihBerjalan($jadwal)) {
>>>>>>> putri/tampilan-admin
            return redirect()->route('dashboard-guru')
                ->with('error', 'Sesi pelajaran ini sudah selesai, jurnal tidak bisa dikirim lagi.');
        }

<<<<<<< HEAD
        if ($sesi->jurnalSesi($jadwal)) {
            return redirect()->route('guru.scan')
                ->with('info', 'Jurnal sesi ini sudah terkirim, tinggal verifikasi.');
=======
        $jurnalAda = $sesi->jurnalSesi($jadwal, $tanggalJurnal->toDateString());
        if ($jurnalAda && $jurnalAda->status_verifikasi === 'terverifikasi') {
            return redirect()->route('dashboard-guru')
                ->with('success', 'Jurnal sesi ini sudah terverifikasi.');
>>>>>>> putri/tampilan-admin
        }

        $keterangan = $validated['catatan'] ?? '';
        if (! empty($validated['siswa_absen'])) {
            $daftarAbsen = collect($validated['siswa_absen'])
                ->map(fn ($s) => "{$s['nama']} ({$s['status']})")
                ->implode(', ');
            $keterangan = trim($keterangan."\nTidak hadir: ".$daftarAbsen);
        }

<<<<<<< HEAD
        $jurnal = Jurnal::create([
            'id_jadwal' => $jadwal->id_jadwal,
            'tanggal' => Waktu::sekarang()->toDateString(),
            'status_kehadiran_guru' => 'hadir',
            'status_verifikasi' => 'belum_verifikasi',
=======
        $dataJurnal = [
            'id_jadwal' => $jadwal->id_jadwal,
            'tanggal' => $tanggalJurnal->toDateString(),
            'is_susulan' => $isSusulan,
            'status_kehadiran_guru' => 'hadir',
            'status_verifikasi' => 'belum_verifikasi',
            'status_piket' => 'menunggu',
            'alasan_tolak' => null,
            'id_diperiksa_oleh' => null,
            'diperiksa_at' => null,
>>>>>>> putri/tampilan-admin
            'materi' => $validated['materi'] ?? null,
            'keterangan' => $keterangan ?: null,
            'jumlah_hadir' => $validated['jumlah_hadir'] ?? null,
            'waktu_submit' => Waktu::sekarang(),
<<<<<<< HEAD
        ]);
        foreach ($validated['siswa_absen'] ?? [] as $s) {
            $jurnal->absenSiswa()->create(['nama' => $s['nama'], 'status' => $s['status']]);
        }

        return redirect()->route('guru.scan')
            ->with('success', 'Jurnal terkirim. Verifikasi kehadiran dengan scan QR kelas sekarang.');
    }

=======
        ];
        $jurnal = $jurnalAda ?? Jurnal::create($dataJurnal);
        if ($jurnalAda) {
            $jurnal->update($dataJurnal);
            $jurnal->absenSiswa()->delete();
        }
        foreach ($validated['siswa_absen'] ?? [] as $s) {
            $jurnal->absenSiswa()->create(['id_siswa' => $s['id_siswa'] ?? null, 'nama' => $s['nama'], 'status' => $s['status']]);
        }

        if ($isSusulan) {
            return redirect()->route('dashboard-guru')->with('success', 'Jurnal kemarin berhasil dikirim sebagai jurnal susulan.');
        }

        return redirect()->route('guru.scan-kelas', $jurnal)
            ->with('success', 'Jurnal terkirim. Verifikasi kehadiran dengan scan QR kelas sekarang.');
    }

    public function piketIndex(): View
    {
        $guru = Auth::user();
        $jurnalHariIni = Jurnal::with(['jadwal.kelas', 'jadwal.mapel', 'jadwal.guru', 'jadwal.jamPelajaran', 'absenSiswa'])
            ->whereDate('tanggal', Waktu::sekarang()->toDateString())
            ->whereNotNull('waktu_submit')
            ->get()
            ->filter(fn ($j) => $j->jadwal && $j->jadwal->jamPelajaran)
            ->sortBy(fn ($j) => [$j->jadwal->kelas->tingkat, $j->jadwal->kelas->jurusan, $j->jadwal->kelas->rombel, $j->jadwal->jamPelajaran->jam_ke])
            ->values();

        $daftarJurnal = $jurnalHariIni->map(function ($j) {
            $kelas = $j->jadwal->kelas;
            $romawi = [10 => 'X', 11 => 'XI', 12 => 'XII'];
            $jam = $j->jadwal->jamPelajaran;
            $namaGuru = $j->jadwal->guru->name ?? '-';

            return [
                'id' => $j->id_jurnal,
                'kelas' => $kelas->nama_kelas,
                'tingkat' => $romawi[(int) $kelas->tingkat] ?? (string) $kelas->tingkat,
                'waktu_kirim' => $j->waktu_submit?->format('H:i') ?? '-',
                'status' => $j->status_kehadiran_guru === 'tidak_hadir' ? 'tidak_hadir' : ($j->status_piket ?? 'menunggu'),
                'alasan_tolak' => $j->alasan_tolak,
                'sesi' => [[
                    'jam' => (string) $jam->jam_ke,
                    'mapel' => $j->jadwal->mapel->nama_mapel ?? '-',
                    'guru' => $namaGuru,
                    'guru_id' => (int) $j->jadwal->id_guru,
                    'hadir_guru' => $j->status_verifikasi === 'terverifikasi',
                    'ada_tugas' => false,
                    'materi' => $j->materi,
                    'jumlah_hadir' => $j->jumlah_hadir,
                    'siswa' => $j->absenSiswa->map(fn ($a) => ['nama' => $a->nama, 'ket' => match ($a->status) { 'Sakit' => 'S', 'Izin' => 'I', 'Dispen' => 'D', default => 'A' }])->all(),
                ]],
            ];
        })->all();

        $tingkatUrutan = ['X' => 1, 'XI' => 2, 'XII' => 3];
        $daftarTingkat = collect($daftarJurnal)->pluck('tingkat')->unique()->sortBy(fn ($t) => $tingkatUrutan[$t] ?? 99)->values();
        $isPiketHariIni = $guru->sedangPiket(Waktu::sekarang());
        $guruPiketId = (int) $guru->id;

        return view('guru.jurnal-mengajar', compact('daftarJurnal', 'daftarTingkat', 'isPiketHariIni', 'guruPiketId'));
    }

    public function approve(Request $request, Jurnal $jurnal): RedirectResponse
    {
        $this->pastikanPiketBukanPengajar($jurnal);
        abort_if($jurnal->status_kehadiran_guru === 'tidak_hadir', 409, 'Catatan ketidakhadiran otomatis tidak dapat disetujui sebagai jurnal.');
        abort_if($jurnal->status_piket !== 'menunggu', 409, 'Jurnal ini sudah diproses.');
        $jurnal->update(['status_piket' => 'disetujui', 'id_diperiksa_oleh' => Auth::id(), 'diperiksa_at' => now(), 'alasan_tolak' => null]);

        return back()->with('success', 'Jurnal berhasil disetujui.');
    }

    public function reject(Request $request, Jurnal $jurnal): RedirectResponse
    {
        $data = $request->validate(['alasan' => ['required', 'string', 'max:2000']]);
        $this->pastikanPiketBukanPengajar($jurnal);
        abort_if($jurnal->status_kehadiran_guru === 'tidak_hadir', 409, 'Catatan ketidakhadiran otomatis tidak dapat ditolak sebagai jurnal.');
        abort_if($jurnal->status_piket !== 'menunggu', 409, 'Jurnal ini sudah diproses.');
        $jurnal->update(['status_piket' => 'ditolak', 'alasan_tolak' => $data['alasan'], 'id_diperiksa_oleh' => Auth::id(), 'diperiksa_at' => now()]);

        return back()->with('success', 'Jurnal ditolak dan alasannya tersimpan.');
    }

    private function pastikanPiketBukanPengajar(Jurnal $jurnal): void
    {
        abort_unless(Auth::user()->sedangPiket(Waktu::sekarang()), 403, 'Anda tidak sedang bertugas piket.');
        abort_if((int) $jurnal->jadwal()->value('id_guru') === (int) Auth::id(), 403, 'Guru tidak dapat memproses jurnalnya sendiri.');
    }

    public function adminIndex(): View
    {
        $jurnalSusulan = Jurnal::with(['jadwal.guru', 'jadwal.kelas', 'jadwal.mapel'])
            ->where('is_susulan', true)->whereNotNull('waktu_submit')->latest('tanggal')->latest('waktu_submit')->get();
        $jurnalSemua = Jurnal::with(['jadwal.guru', 'jadwal.kelas', 'jadwal.mapel', 'jadwal.jamPelajaran'])
            ->whereNotNull('waktu_submit')->latest('tanggal')->latest('waktu_submit')->get();
        $jumlahJurnal = $jurnalSemua->count();
        $jumlahDisetujui = $jurnalSemua->where('status_piket', 'disetujui')->count();
        $jumlahDitolak = $jurnalSemua->where('status_piket', 'ditolak')->count();

        return view('admin.jurnal', compact('jurnalSusulan', 'jurnalSemua', 'jumlahJurnal', 'jumlahDisetujui', 'jumlahDitolak'));
    }

>>>>>>> putri/tampilan-admin
    public function verifikasiSukses(Request $request, Jurnal $jurnal): View
    {
        $jurnal->load('jadwal.kelas', 'jadwal.mapel');

        abort_if((int) $jurnal->jadwal->id_guru !== (int) $request->user()->id, 403);

        return view('guru.verifikasisukses', compact('jurnal'));
    }
}
