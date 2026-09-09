<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $primaryKey = 'id_kelas';

    protected $fillable = ['tingkat', 'jurusan', 'rombel'];

    protected $appends = ['nama_kelas'];

    public function getNamaKelasAttribute()
    {
        $romawi = ['10' => 'X', '11' => 'XI', '12' => 'XII'];

        return "{$romawi[$this->tingkat]} {$this->jurusan} {$this->rombel}";
    }
}
