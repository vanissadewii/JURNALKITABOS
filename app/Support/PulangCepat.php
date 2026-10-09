<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PulangCepat
{
    public static function jamMulai(string $hari): ?int
    {
        if (! Schema::hasTable('pengaturan_pulang_cepat')) {
            return null;
        }
        $aturan = DB::table('pengaturan_pulang_cepat')->where('hari', $hari)->first();

        return $aturan && $aturan->aktif ? (int) $aturan->jam_ke : null;
    }

    public static function berlaku(string $hari, int $jamKe): bool
    {
        $jamMulai = self::jamMulai($hari);

        return $jamMulai !== null && $jamKe >= $jamMulai;
    }
}
