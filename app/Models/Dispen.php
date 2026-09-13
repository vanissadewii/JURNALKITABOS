<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispen extends Model
{
    use HasFactory;

    protected $table = 'dispens';

    protected $primaryKey = 'id_dispen';

    protected $fillable = [
        'nomor_surat',
        'id_siswa',
        'id_kelas',
        'tanggal',
        'jam_ke_mulai',
        'jam_ke_selesai',
        'alasan',
        'id_guru_piket',
        'status',
        'id_waka',
        'disetujui_at',
        'token_approval',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'disetujui_at' => 'datetime',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    // GANTI App\Models\User kalau model user kamu namanya beda
    public function guruPiket()
    {
        return $this->belongsTo(User::class, 'id_guru_piket');
    }

    public function waka()
    {
        return $this->belongsTo(User::class, 'id_waka');
    }

    // baris pivot dispen_jurnal
    public function dispenJurnal()
    {
        return $this->hasMany(DispenJurnal::class, 'id_dispen', 'id_dispen');
    }

    public function isSampaiSelesai(): bool
    {
        return is_null($this->jam_ke_selesai);
    }

    public function labelJam(): string
    {
        return $this->isSampaiSelesai()
            ? "Jam ke-{$this->jam_ke_mulai} s/d Selesai"
            : "Jam ke-{$this->jam_ke_mulai} s/d {$this->jam_ke_selesai}";
    }
}
