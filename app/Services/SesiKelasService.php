<?php

namespace App\Services;

use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use Carbon\CarbonInterface;
use App\Support\RentangJam;
use Illuminate\Support\Collection;

class SesiKelasService
{
    /** @var array<int, string> */
    private const NAMA_HARI = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];

    /**
     * Sesi mengajar satu kelas pada hari dari $sekarang.
     * Jam berurutan dengan guru & mapel sama digabung jadi satu sesi.
     *
     * @return Collection<int, object>
     */
    public function sesiHariIni(Kelas $kelas, CarbonInterface $sekarang): Collection
    {
        $hari = self::NAMA_HARI[$sekarang->dayOfWeekIso] ?? null; // null di luar hari pada jadwal

        if (! $hari) {
            return collect();
        }

        $jadwal = JadwalPelajaran::with(['mapel', 'guru', 'jamPelajaran'])
            ->where('id_kelas', $kelas->id_kelas)
            ->whereHas('jamPelajaran', fn ($q) => $q
                ->where('hari', $hari)
                ->whereHas('semester', fn ($s) => $s->where('status', 'aktif')))
            ->get()
            ->filter(fn ($j) => $j->jamPelajaran !== null)
            ->sortBy(fn ($j) => $j->jamPelajaran->jam_ke)
            ->values();

        $sesi = collect();

        foreach ($jadwal as $j) {
            $jam = $j->jamPelajaran;
            $last = $sesi->last();

            if (
                $last
                && $last->id_guru == $j->id_guru
                && $last->id_mapel == $j->id_mapel
                && $last->jam_ke_sampai + 1 === (int) $jam->jam_ke
            ) {
                $last->jam_ke_sampai = (int) $jam->jam_ke;
                $last->jam_selesai = substr($jam->jam_selesai, 0, 5);
                $last->ids[] = $j->id_jadwal;

                continue;
            }

            $sesi->push((object) [
                'ids' => [$j->id_jadwal], // semua id_jadwal dalam sesi ini
                'id_guru' => $j->id_guru,
                'id_mapel' => $j->id_mapel,
                'mapel' => $j->mapel->nama_mapel ?? '-',
                'guru' => $j->guru->name ?? '-',
                'jam_ke_mulai' => (int) $jam->jam_ke,
                'jam_ke_sampai' => (int) $jam->jam_ke,
                'jam_mulai' => substr($jam->jam_mulai, 0, 5),
                'jam_selesai' => substr($jam->jam_selesai, 0, 5),
                'status' => '',
            ]);
        }

        foreach ($sesi as $s) {
            $menit = RentangJam::menit($sekarang->format('H:i'));
            $selesai = RentangJam::menit($s->jam_selesai) ?: 1440;
            if (RentangJam::sedangBerjalan($s->jam_mulai, $s->jam_selesai, $sekarang)) {
                $s->status = 'Berlangsung';
            } elseif ($menit >= RentangJam::menit($s->jam_mulai) && $menit >= $selesai) {
                $s->status = 'Selesai';
            } else {
                $s->status = 'Belum Dimulai';
            }
        }

        return $sesi;
    }
}
