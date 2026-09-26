<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JurnalSiswaAbsen extends Model
{
    protected $table = 'jurnal_siswa_absen';

    protected $primaryKey = 'id_absen';

<<<<<<< HEAD
    protected $fillable = ['id_jurnal', 'nama', 'status'];
=======
    protected $fillable = ['id_jurnal', 'id_siswa', 'nama', 'status'];
>>>>>>> putri/tampilan-admin
}
