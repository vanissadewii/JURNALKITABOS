<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Support\Waktu;

class QrSesi extends Model
{
    protected $table = 'qr_sesi';

    protected $primaryKey = 'id_qr';

    protected $fillable = [
        'id_jadwal', 'id_jurnal', 'tanggal', 'tipe', 'kode_qr',
        'waktu_generate', 'waktu_expired', 'status',
        'dipindai_at', 'dipindai_oleh',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_generate' => 'datetime',
        'waktu_expired' => 'datetime',
        'dipindai_at' => 'datetime',
    ];

    /**
     * @return BelongsTo<JadwalPelajaran, $this>
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalPelajaran::class, 'id_jadwal', 'id_jadwal');
    }

    /**
     * @return BelongsTo<Jurnal, $this>
     */
    public function jurnal(): BelongsTo
    {
        return $this->belongsTo(Jurnal::class, 'id_jurnal', 'id_jurnal');
    }

    public function sudahDipindai(): bool
    {
        return ! is_null($this->dipindai_at);
    }

    public function tanggalSesuaiHariIni(): bool
    {
        return $this->tanggal !== null
            && $this->tanggal->toDateString() === Waktu::sekarang()->toDateString();
    }

    public function sudahExpired(): bool
    {
        return now()->greaterThan($this->waktu_expired);
    }
}
