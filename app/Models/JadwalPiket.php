<?php

namespace App\Models;
use Database\Factories\JadwalPiketFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPiket extends Model
{
    use HasFactory;

    protected $table = 'jadwal_piket';

    protected $primaryKey = 'id_piket';

    protected $fillable = ['id_guru', 'hari', 'sesi', 'jam_mulai', 'jam_selesai'];

    /**
     * @return BelongsTo<User, $this>
     */
    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_guru', 'id');
    }

    /**
     * Cek apakah guru dengan $idGuru sedang piket SAAT INI (hari & jam berjalan).
     */
    public static function sedangPiket(int $idGuru): bool
    {
        $sekarang = Carbon::now();
        $hariIni = $sekarang->translatedFormat('l'); // "Senin", "Selasa", dst (locale id)

        return static::where('id_guru', $idGuru)
            ->where('hari', $hariIni)
            ->whereTime('jam_mulai', '<=', $sekarang->format('H:i:s'))
            ->whereTime('jam_selesai', '>=', $sekarang->format('H:i:s'))
            ->exists();
    }
}
