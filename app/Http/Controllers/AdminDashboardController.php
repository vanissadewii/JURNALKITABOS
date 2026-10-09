<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\JamPelajaran;
use App\Models\Jurnal;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Support\Waktu;
use Illuminate\Support\Facades\DB;
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
            ->sortBy(fn ($jadwal) => [$jadwal->id_kelas, $jadwal->jamPelajaran->jam_ke])
            ->values();

        $kegiatanDitiadakan = in_array($hariIni, ['Senin', 'Jumat'], true)
            && (bool) DB::table('pengaturan_kegiatan_harian')->where('hari', $hariIni)->value('kegiatan_ditiadakan');
        $slotJam = JamPelajaran::where('hari', $hariIni)->whereHas('semester', fn ($q) => $q->where('status', 'aktif'))
            ->get()->keyBy(fn ($jam) => $jam->tingkat.'|'.$jam->jam_ke);
        foreach ($jadwalHariIni as $jadwal) {
            $nomor = (int) $jadwal->jamPelajaran->jam_ke - ($kegiatanDitiadakan ? 1 : 0);
            if ($kegiatanDitiadakan && $nomor > 0 && ($slot = $slotJam->get($jadwal->kelas->tingkat.'|'.$nomor))) {
                $tampilan = clone $jadwal->jamPelajaran;
                $tampilan->jam_ke = $nomor;
                $tampilan->jam_mulai = $slot->jam_mulai;
                $tampilan->jam_selesai = $slot->jam_selesai;
                $jadwal->setRelation('jamPelajaran', $tampilan);
            }
        }
        $gabungan = collect();
        foreach ($jadwalHariIni as $jadwal) {
            $last = $gabungan->last();
            if ($last && (int) $last->id_kelas === (int) $jadwal->id_kelas && (int) $last->id_mapel === (int) $jadwal->id_mapel && (int) $last->id_guru === (int) $jadwal->id_guru
                && (int) $last->jam_ke_sampai + 1 === (int) $jadwal->jamPelajaran->jam_ke) {
                $last->jam_ke_sampai = (int) $jadwal->jamPelajaran->jam_ke;
                $last->jam_selesai = $jadwal->jamPelajaran->jam_selesai;
                $last->jadwals->push($jadwal);

                continue;
            }
            $gabungan->push((object) [
                'id_kelas' => $jadwal->id_kelas, 'id_mapel' => $jadwal->id_mapel, 'id_guru' => $jadwal->id_guru,
                'kelas' => $jadwal->kelas, 'mapel' => $jadwal->mapel, 'guru' => $jadwal->guru,
                'jam_ke_mulai' => (int) $jadwal->jamPelajaran->jam_ke,
                'jam_ke_sampai' => (int) $jadwal->jamPelajaran->jam_ke,
                'jam_mulai' => $jadwal->jamPelajaran->jam_mulai,
                'jam_selesai' => $jadwal->jamPelajaran->jam_selesai,
                'jadwals' => collect([$jadwal]),
            ]);
        }
        $jadwalHariIni = $gabungan->sortBy('jam_mulai')->values();

        $jurnalHariIni = Jurnal::query()
            ->with(['jadwal', 'jadwal.guru'])
            ->whereDate('tanggal', $sekarang->toDateString())
            ->whereNotNull('waktu_submit')
            ->latest('id_jurnal')
            ->get()
            ->groupBy('id_jadwal')
            ->map(fn ($items) => $items->first());

        $jadwalHariIni->each(function ($jadwal) use ($jurnalHariIni) {
            $jadwal->jurnalHariIni = $jadwal->jadwals->map(fn ($slot) => $jurnalHariIni->get($slot->id_jadwal))->filter()->sortByDesc('id_jurnal')->first();
            if ($jadwal->guru && $jadwal->mapel) {
                $jadwal->mapel->setAttribute('nama_guru_dashboard', $jadwal->guru->name);
            }
        });

        $kelas = Kelas::query()->orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();
        $kelasPerTingkat = $kelas->groupBy(fn ($item) => match ((string) $item->tingkat) {
            '10' => 'X', '11' => 'XI', '12' => 'XII', default => (string) $item->tingkat,
        });
        $jadwalPerKelas = $jadwalHariIni->groupBy('id_kelas');
        $jadwalPerGuru = $jadwalHariIni->groupBy(fn ($jadwal) => $jadwal->id_guru)
            ->map(fn ($daftar) => (object) [
                'guru' => $daftar->first()->guru,
                'jumlah_jam' => $daftar->sum(fn ($jadwal) => $jadwal->jam_ke_sampai - $jadwal->jam_ke_mulai + 1),
                'jadwal' => $daftar->sortBy('jam_mulai')->values(),
            ])->sortBy(fn ($item) => $item->guru?->name ?? '');

        $jurnalTerkirim = Jurnal::whereNotNull('waktu_submit')
            ->where('status_verifikasi', 'terverifikasi')
            ->where(function ($query) {
                $query->whereNull('status_kehadiran_guru')->orWhere('status_kehadiran_guru', '!=', 'tidak_hadir');
            });
        $jurnalHariIniTerkirim = (clone $jurnalTerkirim)->whereDate('tanggal', $sekarang->toDateString());

        $jumlahGuru = User::whereIn('role', ['guru', 'wali_kelas'])->count();
        $jumlahSiswa = Siswa::count();
        $jumlahKelas = $kelas->count();
        $jumlahJurnal = (clone $jurnalHariIniTerkirim)->count();
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
        ) + ['kelasList' => $kelas, 'jadwalPerGuru' => $jadwalPerGuru]);
    }
}
