<?php

namespace App\Support;

use Carbon\Carbon;
use Carbon\CarbonInterface;

class Waktu
{
    public static function sekarang(): CarbonInterface
    {
        $uji = config('jurnal.waktu_uji');

        return $uji ? Carbon::parse($uji) : now();
    }
}
