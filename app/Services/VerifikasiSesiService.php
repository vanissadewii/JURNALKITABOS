<?php

namespace App\Services;

use App\Models\JadwalPelajaran;
use App\Models\JamPelajaran;
use App\Models\Jurnal;
use App\Support\Waktu;
use App\Support\RentangJam;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class VerifikasiSesiService
{
    /** @var array<int, string> */
    private const NAMA_HARI = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];

    /** Jam pelajaran yang sedang berlangsung sekarang, opsional dibatasi kelas dan/atau guru. */
    public function jadwalBerlangsung(?int $idKelas = null, ?int $idGuru = null): ?JadwalPelajaran
    {
        $sekarang = Waktu::sekarang();
        $hari = self::NAMA_HARI[$sekarang->dayOfWeekIso] ?? null;

        if (! $hari) {
            return null;
        }

        $kegiatanDitiadakan = (bool) DB::table('pengaturan_kegiatan_harian')->where('hari', $hari)->value('kegiatan_ditiadakan');
        $slotPerHari = $kegiatanDitiadakan ? $this->slotPerHari($hari) : collect();

        return JadwalPelajaran::with(['kelas', 'mapel', 'guru', 'jamPelajaran'])
            ->when($idKelas !== null, fn ($q) => $q->where('id_kelas', $idKelas))
            ->when($idGuru !== null, fn ($q) => $q->where('id_guru', $idGuru))
            ->whereHas('jamPelajaran', fn ($q) => $q
                ->where('hari', $hari)
                ->whereHas('semester', fn ($s) => $s->where('status', 'aktif')))
            ->get()
            ->first(function ($jadwal) use ($sekarang, $kegiatanDitiadakan, $slotPerHari) {
                if (! $jadwal->jamPelajaran) {
                    return false;
                }
                $jam = $this->jamEfektif($jadwal->jamPelajaran, $kegiatanDitiadakan, $slotPerHari);

                return RentangJam::sedangBerjalan($jam->jam_mulai, $jam->jam_selesai, $sekarang);
            });
    }

    /** Jurnal hari ini untuk sesi (kelas + guru + mapel yang sama), status apa pun. */
    public function jurnalSesi(JadwalPelajaran $jadwal, ?string $tanggal = null): ?Jurnal
    {
        return Jurnal::whereDate('tanggal', $tanggal ?? Waktu::sekarang()->toDateString())
            ->whereHas('jadwal', fn ($q) => $q
                ->where('id_kelas', $jadwal->id_kelas)
                ->where('id_guru', $jadwal->id_guru)
                ->where('id_mapel', $jadwal->id_mapel))
            ->latest('id_jurnal')
            ->first();
    }

    public function jurnalTerverifikasi(JadwalPelajaran $jadwal): ?Jurnal
    {
        $jurnal = $this->jurnalSesi($jadwal);

        return $jurnal && $jurnal->status_verifikasi === 'terverifikasi' ? $jurnal : null;
    }

    /** Semua jam berurutan (kelas, guru, mapel sama) pada hari jadwal itu. */
    public function rentang(JadwalPelajaran $jadwal): Collection
    {
        $jadwal->loadMissing('jamPelajaran');
        $jam = $jadwal->jamPelajaran;

        return JadwalPelajaran::with('jamPelajaran')
            ->where('id_kelas', $jadwal->id_kelas)
            ->where('id_guru', $jadwal->id_guru)
            ->where('id_mapel', $jadwal->id_mapel)
            ->whereHas('jamPelajaran', fn ($q) => $q
                ->where('id_semester', $jam->id_semester)
                ->where('hari', $jam->hari))
            ->get()
            ->sortBy(fn ($j) => $j->jamPelajaran->jam_ke)
            ->values();
    }

    /** Rentang sesi dengan nomor dan waktu jam maju untuk ditampilkan ke pengguna. */
    public function rentangEfektif(JadwalPelajaran $jadwal): Collection
    {
        $rentang = $this->rentang($jadwal);
        $jamPertama = $rentang->first()?->jamPelajaran;

        if (! $jamPertama) {
            return $rentang;
        }

        $hari = $jamPertama->hari;
        $maju = in_array($hari, ['Senin', 'Jumat'], true)
            && (bool) DB::table('pengaturan_kegiatan_harian')->where('hari', $hari)->value('kegiatan_ditiadakan');
        $slotPerHari = $maju ? $this->slotPerHari($hari) : collect();

        return $rentang->map(function (JadwalPelajaran $item) use ($maju, $slotPerHari) {
            if (! $item->jamPelajaran) {
                return $item;
            }

            $jamTampilan = $this->jamEfektif($item->jamPelajaran, $maju, $slotPerHari);
            $jamTampilan = clone $jamTampilan;
            $item->setRelation('jamPelajaran', $jamTampilan);

            return $item;
        });
    }

    /** Apakah sekarang masih di dalam waktu sesi (hari dan jam) ini. */
    public function masihBerjalan(JadwalPelajaran $jadwal): bool
    {
        $rentang = $this->rentang($jadwal);

        if ($rentang->isEmpty()) {
            return false;
        }

        $sekarang = Waktu::sekarang();

        if ((self::NAMA_HARI[$sekarang->dayOfWeekIso] ?? null) !== $rentang->first()->jamPelajaran->hari) {
            return false;
        }

        $hari = $rentang->first()->jamPelajaran->hari;
        $kegiatanDitiadakan = (bool) DB::table('pengaturan_kegiatan_harian')->where('hari', $hari)->value('kegiatan_ditiadakan');
        $slotPerHari = $kegiatanDitiadakan ? $this->slotPerHari($hari) : collect();
        $jamMulai = $this->jamEfektif($rentang->first()->jamPelajaran, $kegiatanDitiadakan, $slotPerHari);
        $jamSelesai = $this->jamEfektif($rentang->last()->jamPelajaran, $kegiatanDitiadakan, $slotPerHari);

        return RentangJam::sedangBerjalan($jamMulai->jam_mulai, $jamSelesai->jam_selesai, $sekarang);
    }

    /** @return Collection<string, JamPelajaran> */
    private function slotPerHari(string $hari): Collection
    {
        return JamPelajaran::where('hari', $hari)
            ->whereHas('semester', fn ($query) => $query->where('status', 'aktif'))
            ->get()
            ->keyBy(fn ($jam) => $jam->id_semester.'|'.$jam->tingkat.'|'.$jam->jam_ke);
    }

    private function jamEfektif(JamPelajaran $jam, bool $maju, Collection $slotPerHari): JamPelajaran
    {
        if (! $maju || (int) $jam->jam_ke <= 1) {
            return $jam;
        }

        return $slotPerHari->get($jam->id_semester.'|'.$jam->tingkat.'|'.((int) $jam->jam_ke - 1)) ?? $jam;
    }
}
