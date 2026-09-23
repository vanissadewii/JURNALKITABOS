<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Support\Waktu;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GuruDashboardController extends Controller
{
    /** @var array<int, string> */
    private array $namaHari = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat'];

    public function index(): View
    {
        $guru = Auth::user();
        $sekarang = $sekarang = Waktu::sekarang();
        $jamSekarang = $sekarang->format('H:i');
        $hari = $this->namaHari[$sekarang->dayOfWeekIso] ?? null; // null kalau Sabtu/Minggu

        $jadwal = $hari
            ? JadwalPelajaran::with(['kelas', 'mapel', 'jamPelajaran'])
                ->where('id_guru', $guru->id)
                ->whereHas('jamPelajaran', fn ($q) => $q
                    ->where('hari', $hari)
                    ->whereHas('semester', fn ($s) => $s->where('status', 'aktif')))
                ->get()
                ->filter(fn ($j) => $j->jamPelajaran !== null)
                ->sortBy(fn ($j) => $j->jamPelajaran->jam_ke)
                ->values()
            : collect();

        // gabungkan jam berurutan dengan kelas & mapel yang sama jadi satu sesi
        $sesi = collect();

        foreach ($jadwal as $j) {
            $jam = $j->jamPelajaran;
            $last = $sesi->last();

            if (
                $last
                && $last->id_kelas == $j->id_kelas
                && $last->id_mapel == $j->id_mapel
                && $last->jam_ke_sampai + 1 === (int) $jam->jam_ke
            ) {
                $last->jam_ke_sampai = (int) $jam->jam_ke;
                $last->jam_selesai = substr($jam->jam_selesai, 0, 5);

                continue;
            }

            $sesi->push((object) [
                'id_jadwal' => $j->id_jadwal, // jam pertama dalam sesi
                'id_kelas' => $j->id_kelas,
                'id_mapel' => $j->id_mapel,
                'kelas' => $j->kelas->nama_kelas ?? '-',
                'mapel' => $j->mapel->nama_mapel ?? '-',
                'jam_ke_mulai' => (int) $jam->jam_ke,
                'jam_ke_sampai' => (int) $jam->jam_ke,
                'jam_mulai' => substr($jam->jam_mulai, 0, 5),
                'jam_selesai' => substr($jam->jam_selesai, 0, 5),
                'status' => '',
            ]);
        }

        // status tiap sesi
        $sudahAdaAkanDatang = false;

        foreach ($sesi as $s) {
            if ($jamSekarang > $s->jam_selesai) {
                $s->status = 'Selesai';
            } elseif ($jamSekarang >= $s->jam_mulai) {
                $s->status = 'Berlangsung';
            } elseif (! $sudahAdaAkanDatang) {
                $s->status = 'Akan Datang';
                $sudahAdaAkanDatang = true;
            } else {
                $s->status = 'Belum Dimulai';
            }
        }

        $sesiSaatIni = $sesi->firstWhere('status', 'Berlangsung');

        return view('guru.dashboard_guru', compact('guru', 'sesi', 'sesiSaatIni'));
    }
}
