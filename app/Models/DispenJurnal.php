<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DispenJurnal extends Model
{
    protected $table = 'dispen_jurnal';

    protected $fillable = [
        'id_dispen',
        'id_jadwal',
        'id_jurnal',
    ];

    public function dispen()
    {
        return $this->belongsTo(Dispen::class, 'id_dispen', 'id_dispen');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalPelajaran::class, 'id_jadwal', 'id_jadwal');
    }

    public function jurnal()
    {
        return $this->belongsTo(Jurnal::class, 'id_jurnal', 'id_jurnal');
    }
}