<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = 'jurnal';

    protected $primaryKey = 'id_jurnal';

    protected $fillable = [
        'id_jadwal',
        'tanggal',
        'materi',
        'keterangan',
        'jumlah_hadir',
        'status_verifikasi',
        'waktu_submit',
    ];

    public function jadwal()
    {
        return $this->belongsTo(JadwalPelajaran::class, 'id_jadwal', 'id_jadwal');
    }
}
