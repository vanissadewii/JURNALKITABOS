<?php

namespace App\Support;

use Carbon\CarbonInterface;

class RentangJam
{
    /** Interval [mulai, selesai); 00:00 berarti tengah malam berikutnya. */
    public static function sedangBerjalan(string $mulai, string $selesai, CarbonInterface $sekarang): bool
    {
        $menitSekarang = ((int) $sekarang->format('H')) * 60 + (int) $sekarang->format('i');
        $menitMulai = self::menit($mulai);
        $menitSelesai = self::menit($selesai);
        if ($menitSelesai <= $menitMulai) { $menitSelesai += 1440; }
        return $menitSekarang >= $menitMulai && $menitSekarang < $menitSelesai;
    }

    public static function menit(string $jam): int
    {
        [$jam, $menit] = array_map('intval', explode(':', substr($jam, 0, 5)));
        return $jam * 60 + $menit;
    }
}
