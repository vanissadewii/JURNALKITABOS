<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dispen extends Model
{
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

    /** @return BelongsTo<Siswa, $this> */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    /** @return BelongsTo<Kelas, $this> */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    /** @return BelongsTo<User, $this> */
    public function guruPiket(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_guru_piket');
    }

    /** @return BelongsTo<User, $this> */
    public function waka(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_waka');
    }

    /** @return HasMany<DispenJurnal, $this> */
    public function dispenJurnal(): HasMany
    {
        return $this->hasMany(DispenJurnal::class, 'id_dispen', 'id_dispen');
    }
}
