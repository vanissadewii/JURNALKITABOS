<?php

namespace App\Support;

use App\Models\JadwalPiketBulanan;
use App\Models\Waka;
use Illuminate\Support\Collection;

class WakaPiket
{
    /**
     * Jadwal Waka pada satu tanggal tertentu, diambil dari jadwal piket
     * yang disusun admin (menu Tambah Piket).
     */
    public static function jadwal(?string $tanggal): ?JadwalPiketBulanan
    {
        if (! $tanggal) {
            return null;
        }

        return JadwalPiketBulanan::query()
            ->whereDate('tanggal', $tanggal)
            ->where('sesi', 'waka')
            ->whereNotNull('id_waka')
            ->orderBy('urutan')
            ->first();
    }

    /**
     * Waka yang seharusnya menerima persetujuan dispensasi.
     * Urutan prioritas: Waka pada tanggal dispensasi, Waka hari ini,
     * jadwal Waka terdekat setelah hari ini, lalu jadwal Waka terakhir.
     *
     * @return Collection<int, Waka>
     */
    public static function kandidat(?string $tanggal): Collection
    {
        $hariIni = Waktu::sekarang()->toDateString();
        $kandidat = collect();

        foreach (array_unique(array_filter([$tanggal, $hariIni])) as $tanggalDiperiksa) {
            $waka = static::jadwal($tanggalDiperiksa)?->waka;

            if ($waka) {
                $kandidat->push($waka);
            }
        }

        $berikutnya = JadwalPiketBulanan::query()
            ->where('sesi', 'waka')
            ->whereNotNull('id_waka')
            ->whereDate('tanggal', '>=', $hariIni)
            ->orderBy('tanggal')
            ->orderBy('urutan')
            ->limit(5)
            ->get()
            ->pluck('waka')
            ->filter();

        $terakhir = JadwalPiketBulanan::query()
            ->where('sesi', 'waka')
            ->whereNotNull('id_waka')
            ->whereDate('tanggal', '<', $hariIni)
            ->orderByDesc('tanggal')
            ->orderByDesc('urutan')
            ->limit(3)
            ->get()
            ->pluck('waka')
            ->filter();

        return $kandidat->merge($berikutnya)->merge($terakhir)->unique('id')->values();
    }

    /** Waka yang tercantum pada jadwal Tambah Piket untuk tanggal tersebut. */
    public static function bertugas(?string $tanggal): ?Waka
    {
        return static::jadwal($tanggal)?->waka;
    }
}
