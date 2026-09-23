<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected $casts = [
        'tanggal' => 'date',
        'waktu_submit' => 'datetime',
    ];

    /**
     * @return BelongsTo<JadwalPelajaran, $this>
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalPelajaran::class, 'id_jadwal', 'id_jadwal');
    }

    /**
     * @return HasMany<JurnalSiswaAbsen, $this>
     */
    public function absenSiswa(): HasMany
    {
        return $this->hasMany(JurnalSiswaAbsen::class, 'id_jurnal', 'id_jurnal');
    }
}