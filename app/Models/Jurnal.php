<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

    public function dispensasi(): HasManyThrough
    {
        return $this->hasManyThrough(
            Dispen::class,
            DispenJurnal::class,
            'id_jurnal',  // FK di dispen_jurnal ke jurnal ini
            'id_dispen',  // FK di dispens ke dispen_jurnal.id_dispen
            'id_jurnal',  // local key di jurnal
            'id_dispen'   // local key di dispen_jurnal
        );
    }
}
