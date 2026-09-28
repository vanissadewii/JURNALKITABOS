<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Jurnal;
use App\Models\PengirimanJurnalKelas;
use App\Models\PengaturanJurnalSusulan;
use App\Models\Siswa;
use App\Models\Dispen;
use Illuminate\Support\Facades\DB;
use App\Services\VerifikasiSesiService;
use App\Services\SesiKelasService;
use App\Support\Waktu;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class JurnalController extends Controller
{
    public function create(Request $request, VerifikasiSesiService $sesi): View|RedirectResponse
    {
        $guru = Auth::user();
        $isSusulan = $request->boolean('susulan');
        $isPulangCepat = $request->boolean('pulang_cepat');
        $tanggalJurnal = Carbon::parse(Waktu::sekarang()->toDateTimeString());
        $hariMap = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
        $hariIni = $hariMap[$tanggalJurnal->dayOfWeekIso] ?? null;
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
                    ->whereHas('jamPelajaran', fn ($q) => $q->where('hari', $hariIni)
                        ->whereHas('semester', fn ($semester) => $semester->where('status', 'aktif')))
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

        if ($jurnal && ! $this->jurnalBisaDiperbarui($jurnal, (int) $jadwalAktif->id_kelas, $tanggalString)) {
            return redirect('/dashboard-guru')->with('error', 'Jurnal tidak bisa diubah karena rekap kelas sudah dikirim ke Jurnal Mengajar atau jurnal sudah disetujui guru piket.');
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
        $rentang = $sesi->rentangEfektif($jadwalAktif);

        return view('guru.form_jurnal', compact(
            'jadwalAktif', 'jadwalPilihan', 'daftarSiswa', 'daftarSiswaJson', 'rentang', 'jurnal', 'isSusulan', 'tanggalJurnal', 'isPulangCepat'
        ));
    }

    public function store(Request $request, VerifikasiSesiService $sesi): RedirectResponse
    {
        $validated = $request->validate([
            'id_jadwal' => 'required|exists:jadwal_pelajaran,id_jadwal',
            'susulan' => 'nullable|boolean',
            'materi' => 'required|string|max:5000',
            'catatan' => 'nullable|string',
            'jumlah_hadir' => 'nullable|integer|min:0',
            'siswa_absen' => 'nullable|array',
            'siswa_absen.*.nama' => 'required_with:siswa_absen|string',
            'siswa_absen.*.id_siswa' => 'nullable|exists:siswa,id_siswa',
            'siswa_absen.*.status' => 'required_with:siswa_absen|in:Sakit,Izin,Dispen,Alpha',
        ]);

        $isSusulan = $request->boolean('susulan');
        $isPulangCepat = $request->boolean('pulang_cepat');
        if ($isSusulan && ! PengaturanJurnalSusulan::forGuru((int) Auth::id())->aktif) {
            return redirect()->route('dashboard-guru')->with('error', 'Pengisian jurnal susulan sedang ditutup oleh admin.');
        }

        $tanggalJurnal = Carbon::parse(Waktu::sekarang()->toDateTimeString());
        if ($isSusulan) {
            $tanggalJurnal->subDay();
        }
        $namaHari = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
        $hariTarget = $namaHari[$tanggalJurnal->dayOfWeekIso] ?? null;

        $jadwalQuery = JadwalPelajaran::with(['jamPelajaran.semester'])
            ->where('id_jadwal', $validated['id_jadwal'])
            ->where('id_guru', Auth::id());
        if ($isSusulan || $isPulangCepat) {
            $jadwalQuery->whereHas('jamPelajaran', fn ($q) => $q
                ->where('hari', $hariTarget)
                ->whereHas('semester', fn ($semester) => $semester->where('status', 'aktif')));
        }
        $jadwal = $jadwalQuery->first();

        if (! $jadwal) {
            return redirect()->route('dashboard-guru')->with('error', 'Jadwal tersebut tidak terdaftar untuk tanggal jurnal yang dipilih.');
        }

        if (! $isSusulan && DB::table('upload_tugas')
            ->where('id_jadwal', $jadwal->id_jadwal)
            ->whereDate('tanggal', $tanggalJurnal->toDateString())
            ->exists()) {
            return redirect()->route('dashboard-guru')
                ->with('error', 'Guru piket sudah mengirim tugas untuk sesi ini. Sesi tersebut tercatat sebagai izin atau sakit dan jurnal guru tidak dapat diisi.');
        }

        if (! $isSusulan && ! $sesi->masihBerjalan($jadwal)) {
            return redirect()->route('dashboard-guru')
                ->with('error', 'Sesi pelajaran ini sudah selesai, jurnal tidak bisa dikirim lagi.');
        }

        $jurnalAda = $sesi->jurnalSesi($jadwal, $tanggalJurnal->toDateString());
        if ($jurnalAda && ! $this->jurnalBisaDiperbarui($jurnalAda, (int) $jadwal->id_kelas, $tanggalJurnal->toDateString())) {
            return redirect()->route('dashboard-guru')
                ->with('error', 'Jurnal tidak bisa diubah karena rekap kelas sudah dikirim ke Jurnal Mengajar atau jurnal sudah disetujui guru piket.');
        }
        $sudahTerverifikasi = $jurnalAda?->status_verifikasi === 'terverifikasi';

        $keterangan = $validated['catatan'] ?? '';
        if (! empty($validated['siswa_absen'])) {
            $daftarAbsen = collect($validated['siswa_absen'])
                ->map(fn ($s) => "{$s['nama']} ({$s['status']})")
                ->implode(', ');
            $keterangan = trim($keterangan."\nTidak hadir: ".$daftarAbsen);
        }

        $dataJurnal = [
            'id_jadwal' => $jadwal->id_jadwal,
            'tanggal' => $tanggalJurnal->toDateString(),
            'is_susulan' => $isSusulan,
            'status_kehadiran_guru' => $sudahTerverifikasi ? $jurnalAda->status_kehadiran_guru : 'menunggu_verifikasi',
            'status_verifikasi' => $sudahTerverifikasi ? 'terverifikasi' : 'belum_verifikasi',
            'status_piket' => 'menunggu',
            'alasan_tolak' => null,
            'id_diperiksa_oleh' => $sudahTerverifikasi ? $jurnalAda->id_diperiksa_oleh : null,
            'diperiksa_at' => $sudahTerverifikasi ? $jurnalAda->diperiksa_at : null,
            'materi' => $validated['materi'] ?? null,
            'keterangan' => $keterangan ?: null,
            'jumlah_hadir' => $validated['jumlah_hadir'] ?? null,
            'waktu_submit' => Waktu::sekarang(),
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
        if ($isPulangCepat) {
            return redirect()->route('dashboard-guru')->with('success', 'Jurnal pulang cepat dikirim ke antrean guru piket untuk ditinjau.');
        }

        if ($sudahTerverifikasi) {
            return redirect()->route('dashboard-guru')->with('success', 'Jurnal berhasil diperbarui dan perubahan langsung terlihat di rekap akun kelas.');
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
            ->where('status_verifikasi', 'terverifikasi')
            ->get()
            ->filter(fn ($j) => $j->jadwal && $j->jadwal->jamPelajaran)
            ->sortBy(fn ($j) => [$j->jadwal->kelas->tingkat, $j->jadwal->kelas->jurusan, $j->jadwal->kelas->rombel, $j->jadwal->jamPelajaran->jam_ke])
            ->values();

        $tugasPerJadwal = DB::table('upload_tugas')->whereDate('tanggal', Waktu::sekarang()->toDateString())
            ->get()->keyBy('id_jadwal');

        $daftarJurnal = $jurnalHariIni->map(function ($j) use ($tugasPerJadwal) {
            $kelas = $j->jadwal->kelas;
            $tugas = $tugasPerJadwal->get($j->id_jadwal);
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
                    'hadir_guru' => $j->status_kehadiran_guru === 'hadir' && $j->status_verifikasi === 'terverifikasi',
                    'ada_tugas' => $tugas !== null,
                    'tugas' => $tugas?->tugas,
                    'status_guru' => $tugas?->status_guru,
                    'id_upload_tugas' => $tugas?->id_upload_tugas,
                    'file_path' => $tugas?->file_path,
                    'materi' => $tugas?->materi ?? $j->materi,
                    'jumlah_hadir' => $j->jumlah_hadir,
                    'siswa' => $j->absenSiswa->map(fn ($a) => ['nama' => $a->nama, 'ket' => match ($a->status) { 'Sakit' => 'S', 'Izin' => 'I', 'Dispen' => 'D', default => 'A' }])->all(),
                ]],
            ];
        })->all();

        $tingkatUrutan = ['X' => 1, 'XI' => 2, 'XII' => 3];
        $daftarTingkat = collect($daftarJurnal)->pluck('tingkat')->unique()->sortBy(fn ($t) => $tingkatUrutan[$t] ?? 99)->values();
        $sekarang = Waktu::sekarang();
        $hariIni = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'][$sekarang->dayOfWeekIso];
        $jadwalPerKelas = JadwalPelajaran::with('jamPelajaran')
            ->whereHas('jamPelajaran', fn ($q) => $q->where('hari', $hariIni)->whereHas('semester', fn ($semester) => $semester->where('status', 'aktif')))
            ->get()->groupBy('id_kelas');
        $jurnalTerkirimPerJadwal = Jurnal::whereDate('tanggal', $sekarang->toDateString())->whereNotNull('waktu_submit')->get()->keyBy('id_jadwal');
        $pengirimanKelas = PengirimanJurnalKelas::with('kelas')
            ->whereDate('tanggal', $sekarang->toDateString())
            ->orderByRaw("FIELD(status, 'menunggu', 'ditolak', 'disetujui')")
            ->orderByDesc('dikirim_at')->get();
        $pengirimanKelas->each(function ($pengiriman) use ($jadwalPerKelas, $tugasPerJadwal, $jurnalTerkirimPerJadwal) {
            $jadwalKelas = $jadwalPerKelas->get($pengiriman->id_kelas, collect());
            $lengkap = $jadwalKelas->filter(fn ($jadwal) => $tugasPerJadwal->has($jadwal->id_jadwal) || $jurnalTerkirimPerJadwal->has($jadwal->id_jadwal))->count();
            $pengiriman->jumlah_sesi = $jadwalKelas->count();
            $pengiriman->jumlah_lengkap = $lengkap;
            $pengiriman->jumlah_kurang = max(0, $pengiriman->jumlah_sesi - $lengkap);
        });
        $isPiketHariIni = $guru->sedangPiket($sekarang);
        $guruPiketId = (int) $guru->id;

        return view('guru.jurnal-mengajar', compact('daftarJurnal', 'daftarTingkat', 'isPiketHariIni', 'guruPiketId', 'pengirimanKelas'));
    }

    public function approvePengirimanKelas(Request $request, PengirimanJurnalKelas $pengiriman): RedirectResponse
    {
        abort_unless(Auth::user()->sedangPiket(Waktu::sekarang()), 403, 'Anda tidak sedang bertugas piket.');
        abort_if($pengiriman->status !== 'menunggu', 409, 'Kiriman kelas ini sudah diproses.');
        $pengiriman->update([
            'status' => 'disetujui',
            'alasan_tolak' => null,
            'id_diperiksa_oleh' => Auth::id(),
            'diperiksa_at' => now(),
        ]);

        return back()->with('success', 'Rekap jurnal kelas berhasil disetujui.');
    }

    public function rejectPengirimanKelas(Request $request, PengirimanJurnalKelas $pengiriman): RedirectResponse
    {
        $data = $request->validate(['alasan' => ['required', 'string', 'max:2000']]);
        abort_unless(Auth::user()->sedangPiket(Waktu::sekarang()), 403, 'Anda tidak sedang bertugas piket.');
        abort_if($pengiriman->status !== 'menunggu', 409, 'Kiriman kelas ini sudah diproses.');
        $pengiriman->update([
            'status' => 'ditolak',
            'alasan_tolak' => $data['alasan'],
            'id_diperiksa_oleh' => Auth::id(),
            'diperiksa_at' => now(),
        ]);

        return back()->with('success', 'Rekap jurnal kelas ditolak. Kelas dapat memperbaiki dan mengirim ulang.');
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

    private function jurnalBisaDiperbarui(Jurnal $jurnal, int $idKelas, string $tanggal): bool
    {
        if (DB::table('upload_tugas')->where('id_jadwal', $jurnal->id_jadwal)->whereDate('tanggal', $tanggal)->exists()) {
            return false;
        }

        if ($jurnal->status_piket === 'disetujui') {
            return false;
        }

        return ! PengirimanJurnalKelas::where('id_kelas', $idKelas)
            ->whereDate('tanggal', $tanggal)
            ->whereIn('status', ['menunggu', 'disetujui'])
            ->exists();
    }

    public function adminIndex(SesiKelasService $service): View
    {
        $pengirimanDisetujui = PengirimanJurnalKelas::with(['kelas', 'pemeriksa'])
            ->where('status', 'disetujui')
            ->latest('tanggal')->latest('dikirim_at')->get();

        $tanggalList = $pengirimanDisetujui->pluck('tanggal')->map(fn ($tanggal) => $tanggal->toDateString())->unique()->values();
        $kelasIds = $pengirimanDisetujui->pluck('id_kelas')->unique()->values();
        $jadwalIds = JadwalPelajaran::whereIn('id_kelas', $kelasIds)->pluck('id_jadwal');
        $jurnalTerverifikasi = Jurnal::with(['jadwal.guru', 'jadwal.kelas', 'jadwal.mapel', 'jadwal.jamPelajaran', 'absenSiswa'])
            ->whereIn('tanggal', $tanggalList)->whereIn('id_jadwal', $jadwalIds)
            ->whereNotNull('waktu_submit')->where('status_verifikasi', 'terverifikasi')
            ->get()->groupBy(fn ($jurnal) => $jurnal->jadwal->id_kelas.'|'.$jurnal->tanggal->toDateString());
        $tugasTerunggah = DB::table('upload_tugas')->whereIn('tanggal', $tanggalList)->whereIn('id_kelas', $kelasIds)->get()
            ->groupBy(fn ($tugas) => $tugas->id_kelas.'|'.substr((string) $tugas->tanggal, 0, 10));
        $jumlahSiswaPerKelas = Siswa::whereIn('id_kelas', $kelasIds)->selectRaw('id_kelas, COUNT(*) as jumlah')->groupBy('id_kelas')->pluck('jumlah', 'id_kelas');

        foreach ($pengirimanDisetujui as $pengiriman) {
            $tanggal = Carbon::parse($pengiriman->tanggal->toDateString());
            $key = $pengiriman->id_kelas.'|'.$pengiriman->tanggal->toDateString();
            $jurnalHari = $jurnalTerverifikasi->get($key, collect());
            $tugasHari = $tugasTerunggah->get($key, collect())->sortByDesc('created_at');
            $jumlahSiswa = (int) $jumlahSiswaPerKelas->get($pengiriman->id_kelas, 0);

            $pengiriman->rekap = $pengiriman->kelas
                ? $service->sesiHariIni($pengiriman->kelas, $tanggal)->map(function ($sesi) use ($jurnalHari, $tugasHari, $jumlahSiswa) {
                    $sesi->jurnal = $jurnalHari->first(fn ($jurnal) => in_array((int) $jurnal->id_jadwal, array_map('intval', $sesi->ids), true));
                    $sesi->tugas = $tugasHari->first(fn ($tugas) => $tugas->id_jadwal && in_array((int) $tugas->id_jadwal, array_map('intval', $sesi->ids), true));
                    $sesi->jumlah_siswa = $jumlahSiswa;

                    return $sesi;
                })
                : collect();
        }

        $urutanTingkat = ['10' => 1, '11' => 2, '12' => 3];
        $pengirimanPerKelas = $pengirimanDisetujui->groupBy('id_kelas')->sortBy(function ($kirimanKelas) use ($urutanTingkat) {
            $kelas = $kirimanKelas->first()->kelas;

            return sprintf('%02d-%s-%s', $urutanTingkat[(string) $kelas?->tingkat] ?? 99, $kelas?->jurusan ?? 'ZZZ', $kelas?->rombel ?? 'ZZZ');
        });

        return view('admin.jurnal', compact('pengirimanPerKelas'));
    }

    public function verifikasiSukses(Request $request, Jurnal $jurnal): View
    {
        $jurnal->load('jadwal.kelas', 'jadwal.mapel');

        abort_if((int) $jurnal->jadwal->id_guru !== (int) $request->user()->id, 403);

        return view('guru.verifikasisukses', compact('jurnal'));
    }
}
