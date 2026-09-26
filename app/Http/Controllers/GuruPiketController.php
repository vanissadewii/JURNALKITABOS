<?php

namespace App\Http\Controllers;

use App\Models\Dispen;
use App\Models\JadwalPelajaran;
use App\Models\Jurnal;
use App\Models\Kelas;
use App\Models\QrSesi;
use App\Models\User;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GuruPiketController extends Controller
{
    /** @var array<int, string> */
<<<<<<< HEAD
    private const NAMA_HARI = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat'];
=======
    private const NAMA_HARI = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
>>>>>>> putri/tampilan-admin

    /** Satu tempat untuk waktu "sekarang" (gampang dipalsukan saat tes). */
    private function sekarang(): CarbonInterface
    {
        return now();
        // UNTUK TES (hari Sabtu/Minggu): ganti return di atas dengan baris ini, kembalikan setelah selesai
        // return \Carbon\Carbon::parse('2026-09-21 08:00');
    }

    private function kunciSesi(int|string $idKelas, int|string $idGuru, int|string $idMapel): string
    {
        return "{$idKelas}-{$idGuru}-{$idMapel}";
    }

    /** @return Collection<int, Jurnal> */
    private function jurnalPada(string $tanggal, ?int $idKelas = null): Collection
    {
        return Jurnal::with(['jadwal.kelas', 'jadwal.mapel', 'jadwal.guru', 'absenSiswa'])
            ->whereDate('tanggal', $tanggal)
<<<<<<< HEAD
=======
            ->whereNotNull('waktu_submit')
>>>>>>> putri/tampilan-admin
            ->when($idKelas, fn ($q, $id) => $q->whereHas('jadwal', fn ($j) => $j->where('id_kelas', $id)))
            ->orderBy('id_jurnal')
            ->get()
            ->filter(fn ($j) => $j->jadwal !== null)
            ->values();
    }

    /**
     * Siswa tidak hadir dari kumpulan jurnal (siswa yang sama di beberapa sesi dihitung sekali).
     *
     * @param  Collection<int, Jurnal>  $jurnal
     * @return Collection<int, object>
     */
    private function siswaTidakHadir(Collection $jurnal): Collection
    {
        return $jurnal
            ->flatMap(fn ($j) => $j->absenSiswa->map(fn ($a) => (object) [
                'nama' => $a->nama,
                'status' => $a->status,
                'id_kelas' => $j->jadwal->id_kelas,
                'kelas' => $j->jadwal->kelas->nama_kelas ?? '-',
                'mapel' => $j->jadwal->mapel->nama_mapel ?? '-',
            ]))
            ->unique(fn ($a) => "{$a->id_kelas}|{$a->nama}")
            ->sortBy('kelas')
            ->values();
    }

    public function beranda(): View
    {
        $guru = Auth::user();
        $sekarang = $this->sekarang();
        $tanggal = $sekarang->toDateString();
        $jamSekarang = $sekarang->format('H:i:s');
        $hari = self::NAMA_HARI[$sekarang->dayOfWeekIso] ?? null; // null kalau Sabtu/Minggu

        $jurnalHariIni = $this->jurnalPada($tanggal);

        // jurnal terbaru untuk tiap sesi (kelas + guru + mapel yang sama)
        $jurnalPerSesi = $jurnalHariIni
            ->groupBy(fn ($j) => $this->kunciSesi($j->jadwal->id_kelas, $j->jadwal->id_guru, $j->jadwal->id_mapel))
            ->map(fn ($g) => $g->sortByDesc('id_jurnal')->first());

        // ================= BERANDA =================

        // jam pelajaran yang sedang berlangsung sekarang di semua kelas
        $jadwalBerlangsung = $hari
            ? JadwalPelajaran::with(['kelas', 'mapel', 'guru', 'jamPelajaran'])
                ->whereHas('jamPelajaran', fn ($q) => $q
                    ->where('hari', $hari)
                    ->where('jam_mulai', '<=', $jamSekarang)
                    ->where('jam_selesai', '>=', $jamSekarang)
                    ->whereHas('semester', fn ($s) => $s->where('status', 'aktif')))
                ->get()
            : collect();

        $sesiBerlangsung = $jadwalBerlangsung
            ->filter(fn ($j) => $j->jamPelajaran !== null)
            ->sortBy(fn ($j) => $j->kelas->nama_kelas ?? '')
            ->map(function ($j) use ($jurnalPerSesi) {
                $jurnal = $jurnalPerSesi->get($this->kunciSesi($j->id_kelas, $j->id_guru, $j->id_mapel));

                $status = match (true) {
                    ! $jurnal => 'Belum ada jurnal',
                    $jurnal->status_kehadiran_guru === 'izin' => 'Izin',
                    $jurnal->status_kehadiran_guru === 'sakit' => 'Sakit',
<<<<<<< HEAD
=======
                    $jurnal->status_kehadiran_guru === 'tidak_hadir' => 'Guru Tidak Hadir',
>>>>>>> putri/tampilan-admin
                    $jurnal->status_verifikasi === 'terverifikasi' => 'Terverifikasi',
                    default => 'Menunggu scan',
                };

                $namaGuru = $j->guru->name ?? '-';

                return (object) [
                    'kelas' => $j->kelas->nama_kelas ?? '-',
                    'mapel' => $j->mapel->nama_mapel ?? '-',
                    'guru' => $namaGuru,
                    'inisial' => mb_strtoupper(mb_substr($namaGuru, 0, 1)),
                    'jam_ke' => $j->jamPelajaran->jam_ke,
                    'jam_mulai' => substr($j->jamPelajaran->jam_mulai, 0, 5),
                    'jam_selesai' => substr($j->jamPelajaran->jam_selesai, 0, 5),
                    'status' => $status,
                ];
            })
            ->values();

        $jumlahBerlangsung = $sesiBerlangsung->count();
        $jumlahBelumJurnal = $sesiBerlangsung->where('status', 'Belum ada jurnal')->count();

        // guru izin / sakit (dihitung per guru, bukan per jurnal)
        $guruIzin = $jurnalHariIni->where('status_kehadiran_guru', 'izin')
            ->unique(fn ($j) => $j->jadwal->id_guru)->count();
        $guruSakit = $jurnalHariIni->where('status_kehadiran_guru', 'sakit')
            ->unique(fn ($j) => $j->jadwal->id_guru)->count();

        $siswaAbsen = $this->siswaTidakHadir($jurnalHariIni);
        $siswaSakit = $siswaAbsen->where('status', 'Sakit')->count();
        $siswaIzin = $siswaAbsen->where('status', 'Izin')->count();
        $siswaAlpha = $siswaAbsen->where('status', 'Alpha')->count();

        // aktivitas terbaru: jurnal masuk + verifikasi QR
        $jurnalMasuk = $jurnalHariIni
            ->filter(fn ($j) => $j->waktu_submit)
            ->map(function ($j) {
                $namaGuru = $j->jadwal->guru->name ?? '-';
                $mapel = $j->jadwal->mapel->nama_mapel ?? '-';
                $kelas = $j->jadwal->kelas->nama_kelas ?? '-';

                return (object) [
                    'waktu' => $j->waktu_submit,
                    'teks' => $j->status_kehadiran_guru === 'hadir'
                        ? "{$namaGuru} mengirim jurnal {$mapel} ({$kelas})"
                        : "{$namaGuru} melaporkan {$j->status_kehadiran_guru} untuk {$mapel} ({$kelas})",
                ];
            });

        $verifikasi = QrSesi::with(['jadwal.guru', 'jadwal.kelas'])
            ->whereDate('dipindai_at', $tanggal)
            ->get()
            ->filter(fn ($q) => $q->jadwal !== null)
            ->map(fn ($q) => (object) [
                'waktu' => $q->dipindai_at,
                'teks' => ($q->jadwal->kelas->nama_kelas ?? '-').' memverifikasi kehadiran '.($q->jadwal->guru->name ?? '-'),
            ]);

        $aktivitas = $jurnalMasuk->concat($verifikasi)->sortByDesc('waktu')->take(6)->values();

        // ================= ABSENSI SISWA =================

        $dispenHariIni = Dispen::with(['siswa', 'kelas'])
            ->where('status', 'disetujui')
            ->whereDate('tanggal', $tanggal)
            ->get();

        $absensiSiswa = $siswaAbsen
            ->map(fn ($a) => (object) [
                'nama' => $a->nama,
                'kelas' => $a->kelas,
                'status' => $a->status,
                'keterangan' => 'Dilaporkan di '.$a->mapel,
            ])
            ->concat($dispenHariIni->map(fn ($d) => (object) [
                'nama' => $d->siswa->nama ?? '-',
                'kelas' => $d->kelas->nama_kelas ?? '-',
                'status' => 'Dispen',
                'keterangan' => $d->labelJam().' · '.$d->alasan,
            ]))
            ->sortBy('kelas')
            ->values();

        // ================= DATA GURU =================

        $totalGuru = User::whereIn('role', ['guru', 'guru_piket'])->count();
        $guruHadir = $jurnalHariIni->where('status_kehadiran_guru', 'hadir')
            ->unique(fn ($j) => $j->jadwal->id_guru)->count();

        $jadwalHariIni = $hari
            ? JadwalPelajaran::with(['kelas', 'mapel', 'guru', 'jamPelajaran'])
                ->whereHas('jamPelajaran', fn ($q) => $q
                    ->where('hari', $hari)
                    ->whereHas('semester', fn ($s) => $s->where('status', 'aktif')))
                ->get()
                ->filter(fn ($j) => $j->jamPelajaran !== null)
                ->values()
            : collect();

        $guruHariIni = $jadwalHariIni
            ->groupBy('id_guru')
            ->map(function ($grup) use ($jurnalPerSesi) {
                $namaGuru = $grup->first()->guru->name ?? '-';

                // satu sesi = kombinasi kelas + guru + mapel (jam berurutan dihitung satu)
                $sesi = $grup->unique(fn ($j) => $this->kunciSesi($j->id_kelas, $j->id_guru, $j->id_mapel));
                $jurnalGuru = $sesi
                    ->map(fn ($j) => $jurnalPerSesi->get($this->kunciSesi($j->id_kelas, $j->id_guru, $j->id_mapel)))
                    ->filter();

                $status = match (true) {
                    $jurnalGuru->contains('status_kehadiran_guru', 'izin') => 'Izin',
                    $jurnalGuru->contains('status_kehadiran_guru', 'sakit') => 'Sakit',
<<<<<<< HEAD
=======
                    $jurnalGuru->contains('status_kehadiran_guru', 'tidak_hadir') => 'Guru Tidak Hadir',
>>>>>>> putri/tampilan-admin
                    $jurnalGuru->isNotEmpty() => 'Hadir',
                    default => 'Belum ada jurnal',
                };

                return (object) [
                    'nama' => $namaGuru,
                    'inisial' => mb_strtoupper(mb_substr($namaGuru, 0, 2)),
                    'mapel' => $grup->map(fn ($j) => $j->mapel->nama_mapel ?? '-')->unique()->implode(', '),
                    'kelas' => $grup->map(fn ($j) => $j->kelas->nama_kelas ?? '-')->unique()->implode(', '),
                    'jumlah_sesi' => $sesi->count(),
                    'jam' => substr((string) $grup->min(fn ($j) => $j->jamPelajaran->jam_mulai), 0, 5)
                        .' – '.substr((string) $grup->max(fn ($j) => $j->jamPelajaran->jam_selesai), 0, 5),
                    'status' => $status,
                ];
            })
            ->sortBy('nama')
            ->values();

        $guruTidakHadir = $jurnalHariIni
<<<<<<< HEAD
            ->whereIn('status_kehadiran_guru', ['izin', 'sakit'])
            ->unique(fn ($j) => $j->jadwal->id_guru)
            ->map(fn ($j) => (object) [
                'nama' => $j->jadwal->guru->name ?? '-',
                'status' => ucfirst($j->status_kehadiran_guru),
=======
            ->whereIn('status_kehadiran_guru', ['izin', 'sakit', 'tidak_hadir'])
            ->unique(fn ($j) => $j->jadwal->id_guru)
            ->map(fn ($j) => (object) [
                'nama' => $j->jadwal->guru->name ?? '-',
                'status' => $j->status_kehadiran_guru === 'tidak_hadir' ? 'Guru Tidak Hadir' : ucfirst($j->status_kehadiran_guru),
>>>>>>> putri/tampilan-admin
                'mapel' => $j->jadwal->mapel->nama_mapel ?? '-',
                'kelas' => $j->jadwal->kelas->nama_kelas ?? '-',
                'keterangan' => $j->keterangan ?: '-',
            ])
            ->values();

        // ================= LAPORAN (filter tanggal + kelas) =================

        $validator = validator(request()->query(), [
            'tanggal' => ['nullable', 'date_format:Y-m-d'],
            'id_kelas' => ['nullable', 'integer'],
        ]);
        $filter = $validator->passes() ? $validator->validated() : [];

        $tanggalLaporan = $filter['tanggal'] ?? $tanggal;
        $idKelasLaporan = ! empty($filter['id_kelas']) ? (int) $filter['id_kelas'] : null;

        $daftarKelas = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();

        $jurnalLaporan = $this->jurnalPada($tanggalLaporan, $idKelasLaporan);
        $siswaLaporan = $this->siswaTidakHadir($jurnalLaporan);
        $laporanSakit = $siswaLaporan->where('status', 'Sakit')->count();
        $laporanIzin = $siswaLaporan->where('status', 'Izin')->count();
        $laporanAlpha = $siswaLaporan->where('status', 'Alpha')->count();

        $guruIzinSakitLaporan = $jurnalLaporan
<<<<<<< HEAD
            ->whereIn('status_kehadiran_guru', ['izin', 'sakit'])
=======
            ->whereIn('status_kehadiran_guru', ['izin', 'sakit', 'tidak_hadir'])
>>>>>>> putri/tampilan-admin
            ->unique(fn ($j) => $j->jadwal->id_guru)
            ->count();

        $dispenLaporan = Dispen::with(['siswa', 'kelas'])
            ->where('status', 'disetujui')
            ->whereDate('tanggal', $tanggalLaporan)
            ->when($idKelasLaporan, fn ($q, $id) => $q->where('id_kelas', $id))
            ->get();

<<<<<<< HEAD
        return view('guru-piket.berandaguru', compact(
            'guru', 'sekarang',
            'sesiBerlangsung', 'jumlahBerlangsung', 'jumlahBelumJurnal',
            'guruIzin', 'guruSakit', 'siswaAbsen', 'siswaSakit', 'siswaIzin', 'siswaAlpha', 'aktivitas',
            'dispenHariIni', 'absensiSiswa',
            'totalGuru', 'guruHadir', 'guruHariIni', 'guruTidakHadir',
            'tanggalLaporan', 'idKelasLaporan', 'daftarKelas', 'jurnalLaporan', 'siswaLaporan',
            'laporanSakit', 'laporanIzin', 'laporanAlpha', 'guruIzinSakitLaporan', 'dispenLaporan'
        ));
=======
        return view('guru.piket');
>>>>>>> putri/tampilan-admin
    }
}
