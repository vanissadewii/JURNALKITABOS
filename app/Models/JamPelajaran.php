<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JamPelajaran extends Model
{
    protected $table = 'jam_pelajaran';

    protected $primaryKey = 'id_jam';

    protected $fillable = ['id_semester', 'tingkat', 'hari', 'jam_ke', 'jam_mulai', 'jam_selesai'];

    /**
     * @return BelongsTo<Semester, $this>
     */
    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id_semester');
    }

    /**
     * @return HasMany<JadwalPelajaran, $this>
     */
    public function jadwalPelajaran(): HasMany
    {
        return $this->hasMany(JadwalPelajaran::class, 'id_jam', 'id_jam');
    }
}