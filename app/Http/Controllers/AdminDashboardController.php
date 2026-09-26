<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Jurnal;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Support\Waktu;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    private const NAMA_HARI = [
        1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis',
        5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu',
    ];

    public function index(): View
    {
        $sekarang = Waktu::sekarang();
        $hariIni = self::NAMA_HARI[$sekarang->dayOfWeekIso];

        $jadwalHariIni = JadwalPelajaran::with(['kelas', 'mapel', 'guru', 'jamPelajaran'])
            ->whereHas('jamPelajaran', fn ($query) => $query
                ->where('hari', $hariIni)
                ->whereHas('semester', fn ($semester) => $semester->where('status', 'aktif')))
            ->get()
            ->filter(fn ($jadwal) => $jadwal->kelas && $jadwal->jamPelajaran)
            ->sortBy(fn ($jadwal) => $jadwal->jamPelajaran->jam_mulai)
            ->values();

        $jurnalHariIni = Jurnal::query()
            ->with(['jadwal', 'jadwal.guru'])
            ->whereDate('tanggal', $sekarang->toDateString())
            ->whereNotNull('waktu_submit')
            ->get()
            ->keyBy('id_jadwal');

        $jadwalHariIni->each(function ($jadwal) use ($jurnalHariIni) {
            $jadwal->jurnalHariIni = $jurnalHariIni->get($jadwal->id_jadwal);
        });

        $kelas = Kelas::query()->orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();
        $kelasPerTingkat = $kelas->groupBy(fn ($item) => match ((string) $item->tingkat) {
            '10' => 'X', '11' => 'XI', '12' => 'XII', default => (string) $item->tingkat,
        });
        $jadwalPerKelas = $jadwalHariIni->groupBy('id_kelas');

        $jurnalTerkirim = Jurnal::whereNotNull('waktu_submit')
            ->where(function ($query) {
                $query->whereNull('status_kehadiran_guru')->orWhere('status_kehadiran_guru', '!=', 'tidak_hadir');
            });
        $jurnalHariIniTerkirim = (clone $jurnalTerkirim)->whereDate('tanggal', $sekarang->toDateString());

        $jumlahGuru = User::where('role', 'guru')->count();
        $jumlahSiswa = Siswa::count();
        $jumlahKelas = $kelas->count();
        $jumlahJurnal = $jurnalTerkirim->count();
        $menungguVerifikasi = (clone $jurnalHariIniTerkirim)
            ->where('status_verifikasi', 'belum_verifikasi')->count();

        $ringkasanKehadiran = [
            'hadir' => (clone $jurnalHariIniTerkirim)->where('status_kehadiran_guru', 'hadir')->count(),
            'izin' => (clone $jurnalHariIniTerkirim)->where('status_kehadiran_guru', 'izin')->count(),
            'sakit' => (clone $jurnalHariIniTerkirim)->where('status_kehadiran_guru', 'sakit')->count(),
            'tidak_hadir' => Jurnal::whereDate('tanggal', $sekarang->toDateString())
                ->where('status_kehadiran_guru', 'tidak_hadir')->count(),
        ];

        return view('admin.dashboard_admin', compact(
            'hariIni', 'kelasPerTingkat', 'jadwalPerKelas', 'jumlahGuru', 'jumlahSiswa',
            'jumlahKelas', 'jumlahJurnal', 'menungguVerifikasi', 'ringkasanKehadiran'
        ) + ['kelasList' => $kelas]);
    }
}
