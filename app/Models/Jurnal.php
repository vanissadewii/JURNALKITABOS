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
        'status_kehadiran_guru',
        'tanggal',
        'materi',
        'keterangan',
        'jumlah_hadir',
        'status_verifikasi',
        'status_piket',
        'alasan_tolak',
        'id_diperiksa_oleh',
        'diperiksa_at',
        'is_susulan',
        'waktu_submit',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_susulan' => 'boolean',
        'waktu_submit' => 'datetime',
        'diperiksa_at' => 'datetime',
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
