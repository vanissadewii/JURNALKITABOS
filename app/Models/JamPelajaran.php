<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JamPelajaran extends Model
{
    protected $table = 'jam_pelajaran';

    protected $primaryKey = 'id_jam';

    protected $fillable = ['id_semester', 'tingkat', 'hari', 'jam_ke', 'jam_mulai', 'jam_selesai'];
}
