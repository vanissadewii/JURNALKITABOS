<?php

namespace App\Http\Controllers;

use App\Models\JamPelajaran;
use App\Models\JadwalPelajaran;
use App\Models\PengaturanJurnalSusulan;
use App\Models\User;
use App\Support\Waktu;
use App\Support\RentangJam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GuruDashboardController extends Controller
{
    /** @var array<int, string> */
    private array $namaHari = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];

    public function index(): View
    {
        /** @var User $guru */
        $guru = Auth::user();
        $sekarang = Waktu::sekarang();
        $hari = $this->namaHari[$sekarang->dayOfWeekIso] ?? null;
        $pengaturan = $hari
            ? DB::table('pengaturan_kegiatan_harian')->where('hari', $hari)->value('kegiatan_ditiadakan')
            : false;
        $kegiatanDitiadakan = (bool) $pengaturan;

        $jadwal = $hari
            ? JadwalPelajaran::with(['kelas', 'mapel', 'jamPelajaran'])
                ->where('id_guru', $guru->id)
                ->whereHas('jamPelajaran', fn ($q) => $q
                    ->where('hari', $hari)
                    ->whereHas('semester', fn ($s) => $s->where('status', 'aktif')))
                ->get()
                ->filter(fn ($j) => $j->jamPelajaran !== null)
            : collect();

        $slotPerHari = $hari
            ? JamPelajaran::where('hari', $hari)
                ->whereHas('semester', fn ($q) => $q->where('status', 'aktif'))
                ->get()
                ->keyBy(fn ($slot) => $slot->tingkat.'|'.$slot->jam_ke)
            : collect();

        $barisJadwal = $jadwal->map(function ($j) use ($kegiatanDitiadakan, $slotPerHari) {
            $jamAsli = (int) $j->jamPelajaran->jam_ke;
            $jamTampilan = $jamAsli;
            $slotWaktu = $j->jamPelajaran;

            if ($kegiatanDitiadakan && $jamAsli > 1) {
                $slotSebelumnya = $slotPerHari->get($j->jamPelajaran->tingkat.'|'.($jamAsli - 1));
                if ($slotSebelumnya) {
                    $jamTampilan = $jamAsli - 1;
                    $slotWaktu = $slotSebelumnya;
                }
            }

            return (object) [
                'jadwal' => $j,
                'jam_ke' => $jamTampilan,
                'jam_mulai' => substr($slotWaktu->jam_mulai, 0, 5),
                'jam_selesai' => substr($slotWaktu->jam_selesai, 0, 5),
            ];
        })->sortBy('jam_ke')->values();

        // Gabungkan jam berurutan dengan kelas dan mapel yang sama menjadi satu sesi.
        $sesi = collect();
        foreach ($barisJadwal as $baris) {
            $j = $baris->jadwal;
            $last = $sesi->last();
            if (
                $last
                && $last->id_kelas == $j->id_kelas
                && $last->id_mapel == $j->id_mapel
                && $last->jam_ke_sampai + 1 === $baris->jam_ke
            ) {
                $last->jam_ke_sampai = $baris->jam_ke;
                $last->jam_selesai = $baris->jam_selesai;
                continue;
            }

            $sesi->push((object) [
                'id_jadwal' => $j->id_jadwal,
                'id_kelas' => $j->id_kelas,
                'id_mapel' => $j->id_mapel,
                'kelas' => $j->kelas->nama_kelas ?? '-',
                'mapel' => $j->mapel->nama_mapel ?? '-',
                'jam_ke_mulai' => $baris->jam_ke,
                'jam_ke_sampai' => $baris->jam_ke,
                'jam_mulai' => $baris->jam_mulai,
                'jam_selesai' => $baris->jam_selesai,
                'status' => '',
            ]);
        }

        $sudahAdaAkanDatang = false;
        foreach ($sesi as $s) {
            $menit = RentangJam::menit($sekarang->format('H:i'));
            $selesai = RentangJam::menit($s->jam_selesai) ?: 1440;
            if (RentangJam::sedangBerjalan($s->jam_mulai, $s->jam_selesai, $sekarang)) {
                $s->status = 'Berlangsung';
            } elseif ($menit >= RentangJam::menit($s->jam_mulai) && $menit >= $selesai) {
                $s->status = 'Selesai';
            } elseif (! $sudahAdaAkanDatang) {
                $s->status = 'Akan Datang';
                $sudahAdaAkanDatang = true;
            } else {
                $s->status = 'Belum Dimulai';
            }
        }

        $sesiSaatIni = $sesi->firstWhere('status', 'Berlangsung');
        $sesiBerikutnya = $sesi->firstWhere('status', 'Akan Datang');
        $izinJurnalSusulan = PengaturanJurnalSusulan::forGuru((int) $guru->id)->aktif;
        $tanggalKemarin = $sekarang->copy()->subDay();
        $hariKemarin = $this->namaHari[$tanggalKemarin->dayOfWeekIso] ?? null;
        $adaJadwalKemarin = $hariKemarin && JadwalPelajaran::where('id_guru', $guru->id)
            ->whereHas('jamPelajaran', fn ($q) => $q
                ->where('hari', $hariKemarin)
                ->whereHas('semester', fn ($semester) => $semester->where('status', 'aktif')))
            ->exists();

        return view('guru.dashboard_guru', compact(
            'guru', 'hari', 'sesi', 'sesiSaatIni', 'sesiBerikutnya',
            'izinJurnalSusulan', 'adaJadwalKemarin', 'kegiatanDitiadakan'
        ));
    }
}
