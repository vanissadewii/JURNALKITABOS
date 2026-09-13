<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    protected $table = 'jadwal_pelajaran';

    protected $primaryKey = 'id_jadwal';

    protected $fillable = ['id_kelas', 'id_jam', 'id_guru', 'id_mapel'];
}
