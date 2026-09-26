<?php

namespace App\Services;

use App\Models\JadwalPelajaran;
use App\Models\Jurnal;
use App\Support\Waktu;
<<<<<<< HEAD
=======
use App\Support\RentangJam;
>>>>>>> putri/tampilan-admin
use Illuminate\Support\Collection;

class VerifikasiSesiService
{
    /** @var array<int, string> */
<<<<<<< HEAD
    private const NAMA_HARI = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat'];
=======
    private const NAMA_HARI = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
>>>>>>> putri/tampilan-admin

    /** Jam pelajaran yang sedang berlangsung sekarang, opsional dibatasi kelas dan/atau guru. */
    public function jadwalBerlangsung(?int $idKelas = null, ?int $idGuru = null): ?JadwalPelajaran
    {
        $sekarang = Waktu::sekarang();
        $hari = self::NAMA_HARI[$sekarang->dayOfWeekIso] ?? null;

        if (! $hari) {
            return null;
        }

<<<<<<< HEAD
        $jam = $sekarang->format('H:i:s');

=======
>>>>>>> putri/tampilan-admin
        return JadwalPelajaran::with(['kelas', 'mapel', 'guru', 'jamPelajaran'])
            ->when($idKelas !== null, fn ($q) => $q->where('id_kelas', $idKelas))
            ->when($idGuru !== null, fn ($q) => $q->where('id_guru', $idGuru))
            ->whereHas('jamPelajaran', fn ($q) => $q
                ->where('hari', $hari)
<<<<<<< HEAD
                ->where('jam_mulai', '<=', $jam)
                ->where('jam_selesai', '>=', $jam)
                ->whereHas('semester', fn ($s) => $s->where('status', 'aktif')))
            ->first();
    }

    /** Jurnal hari ini untuk sesi (kelas + guru + mapel yang sama), status apa pun. */
    public function jurnalSesi(JadwalPelajaran $jadwal): ?Jurnal
    {
        return Jurnal::whereDate('tanggal', Waktu::sekarang()->toDateString())
=======
                ->whereHas('semester', fn ($s) => $s->where('status', 'aktif')))
            ->get()
            ->first(fn ($jadwal) => $jadwal->jamPelajaran
                && RentangJam::sedangBerjalan($jadwal->jamPelajaran->jam_mulai, $jadwal->jamPelajaran->jam_selesai, $sekarang));
    }

    /** Jurnal hari ini untuk sesi (kelas + guru + mapel yang sama), status apa pun. */
    public function jurnalSesi(JadwalPelajaran $jadwal, ?string $tanggal = null): ?Jurnal
    {
        return Jurnal::whereDate('tanggal', $tanggal ?? Waktu::sekarang()->toDateString())
>>>>>>> putri/tampilan-admin
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

<<<<<<< HEAD
        $jam = $sekarang->format('H:i:s');

        return $jam >= $rentang->first()->jamPelajaran->jam_mulai
            && $jam <= $rentang->last()->jamPelajaran->jam_selesai;
=======
        return RentangJam::sedangBerjalan(
            $rentang->first()->jamPelajaran->jam_mulai,
            $rentang->last()->jamPelajaran->jam_selesai,
            $sekarang
        );
>>>>>>> putri/tampilan-admin
    }
}
