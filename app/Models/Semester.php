<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semester';

    protected $primaryKey = 'id_semester';

    protected $fillable = ['nama', 'tanggal_mulai', 'tanggal_selesai', 'status'];
}
