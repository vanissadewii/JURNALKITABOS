<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengirimanJurnalKelas extends Model
{
    protected $table = 'pengiriman_jurnal_kelas';

    protected $primaryKey = 'id_pengiriman';

    protected $fillable = ['id_kelas', 'tanggal', 'dikirim_oleh', 'dikirim_at'];

    protected $casts = [
        'tanggal' => 'date',
        'dikirim_at' => 'datetime',
    ];
}
