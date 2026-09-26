<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPiketBulanan extends Model
{
    protected $table = 'jadwal_piket_tanggal';

    protected $fillable = [
        'tanggal', 'sesi', 'urutan', 'id_guru', 'id_waka', 'jam_mulai', 'jam_selesai',
    ];

    protected function casts(): array
    {
        return ['tanggal' => 'date'];
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_guru');
    }

    public function waka(): BelongsTo
    {
        return $this->belongsTo(Waka::class, 'id_waka');
    }
}
