<?php

namespace App\Support;

use Carbon\CarbonInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KegiatanTanggal
{
    public static function jadwalDitiadakan(CarbonInterface|string $tanggal): bool
    {
        $date = $tanggal instanceof CarbonInterface ? $tanggal->toDateString() : $tanggal;

        if (! Schema::hasTable('pengaturan_kegiatan_tanggal')) {
            return false;
        }

        if (! Schema::hasTable('pengaturan_kegiatan_tanggal')) {
            return null;
        }

        return DB::table('pengaturan_kegiatan_tanggal')
            ->whereDate('tanggal', $date)
            ->where('kegiatan_ditiadakan', true)
            ->exists();
    }

    public static function nama(CarbonInterface|string $tanggal): ?string
    {
        $date = $tanggal instanceof CarbonInterface ? $tanggal->toDateString() : $tanggal;

        return DB::table('pengaturan_kegiatan_tanggal')
            ->whereDate('tanggal', $date)
            ->where('kegiatan_ditiadakan', true)
            ->value('nama_kegiatan');
    }
}
