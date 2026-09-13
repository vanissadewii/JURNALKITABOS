<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DispenJurnal extends Model
{
    protected $table = 'dispen_jurnal';

    protected $fillable = [
        'id_dispen',
        'id_jadwal',
        'id_jurnal',
    ];

        /** @return BelongsTo<Dispen, $this> */
    public function dispen(): BelongsTo
    {
        return $this->belongsTo(Dispen::class, 'id_dispen', 'id_dispen');
    }

    /** @return BelongsTo<JadwalPelajaran, $this> */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalPelajaran::class, 'id_jadwal', 'id_jadwal');
    }

    /** @return BelongsTo<Jurnal, $this> */
    public function jurnal(): BelongsTo
    {
        return $this->belongsTo(Jurnal::class, 'id_jurnal', 'id_jurnal');
    }
}