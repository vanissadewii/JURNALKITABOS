<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_kelas
 * @property string $tingkat
 * @property string $jurusan
 * @property string $rombel
 * @property-read string $nama_kelas
 */
class Kelas extends Model
{
    protected $table = 'kelas';

    protected $primaryKey = 'id_kelas';

    protected $fillable = ['tingkat', 'jurusan', 'rombel'];

    protected $appends = ['nama_kelas'];

    public function getNamaKelasAttribute(): string
    {
        $romawi = ['10' => 'X', '11' => 'XI', '12' => 'XII'];

        return "{$romawi[$this->tingkat]} {$this->jurusan} {$this->rombel}";
    }
}
