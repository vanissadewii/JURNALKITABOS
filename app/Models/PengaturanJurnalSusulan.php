<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanJurnalSusulan extends Model
{
    protected $table = 'pengaturan_jurnal_susulan_guru';

    protected $fillable = ['id_guru', 'aktif'];

    protected function casts(): array
    {
        return ['aktif' => 'boolean'];
    }

    public static function forGuru(int $idGuru): self
    {
        return static::firstOrNew(['id_guru' => $idGuru], ['aktif' => false]);
    }
}
