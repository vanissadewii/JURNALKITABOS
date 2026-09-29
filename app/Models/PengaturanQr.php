<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class PengaturanQr extends Model
{
    protected $table = 'pengaturan_qr';

    protected $fillable = ['masa_qr_detik'];

    public static function durasi(): int
    {
        try {
            if (! Schema::hasTable('pengaturan_qr')) {
                return 10;
            }

            $masa = static::query()->value('masa_qr_detik');

            return $masa === null ? 10 : max(5, min(120, (int) $masa));
        } catch (\Throwable) {
            return 10;
        }
    }
}
