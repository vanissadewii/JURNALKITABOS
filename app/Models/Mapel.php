<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mapel extends Model
{
    protected $table = 'mapel';        // <- ini yang kelewatan

    protected $primaryKey = 'id_mapel';

    protected $fillable = ['nama_mapel', 'kode_mapel'];

    /**
     * @return HasMany<JadwalPelajaran, $this>
     */
    public function jadwalPelajaran(): HasMany
    {
        return $this->hasMany(JadwalPelajaran::class, 'id_mapel', 'id_mapel');
    }
}