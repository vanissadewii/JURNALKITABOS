<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $primaryKey = 'id_kelas';

    protected $fillable = ['nama_kelas', 'tingkat'];
}
