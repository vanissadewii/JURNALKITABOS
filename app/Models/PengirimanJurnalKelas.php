<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengirimanJurnalKelas extends Model
{
    protected $table = 'pengiriman_jurnal_kelas';

    protected $primaryKey = 'id_pengiriman';

<<<<<<< HEAD
    protected $fillable = ['id_kelas', 'tanggal', 'dikirim_oleh', 'dikirim_at'];

    protected $casts = [
        'tanggal' => 'date',
        'dikirim_at' => 'datetime',
=======
    protected $fillable = ['id_kelas', 'tanggal', 'dikirim_oleh', 'dikirim_at', 'status', 'alasan_tolak', 'id_diperiksa_oleh', 'diperiksa_at'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'dikirim_oleh');
    }

    public function pemeriksa()
    {
        return $this->belongsTo(User::class, 'id_diperiksa_oleh');
    }

    protected $casts = [
        'tanggal' => 'date',
        'dikirim_at' => 'datetime', 'diperiksa_at' => 'datetime',
>>>>>>> putri/tampilan-admin
    ];
}
