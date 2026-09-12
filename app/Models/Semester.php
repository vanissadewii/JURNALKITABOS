<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semester extends Model
{
    protected $table = 'semester';

    protected $primaryKey = 'id_semester';

    protected $fillable = ['nama', 'tanggal_mulai', 'tanggal_selesai', 'status'];

    /**
     * @return HasMany<JamPelajaran, $this>
     */
    public function jamPelajaran(): HasMany
    {
        return $this->hasMany(JamPelajaran::class, 'id_semester', 'id_semester');
    }
}