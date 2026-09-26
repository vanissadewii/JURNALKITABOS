<?php

namespace App\Support;

use Carbon\Carbon;
use Carbon\CarbonInterface;

class Waktu
{
    public static function sekarang(): CarbonInterface
    {
        $uji = config('jurnal.waktu_uji');

<<<<<<< HEAD
        return $uji ? Carbon::parse($uji) : now();
=======
        // Jadwal piket dan jurnal mengikuti waktu sekolah, bukan timezone server.
        return $uji ? Carbon::parse($uji, 'Asia/Jakarta')->setTimezone('Asia/Jakarta') : Carbon::now('Asia/Jakarta');
>>>>>>> putri/tampilan-admin
    }
}
