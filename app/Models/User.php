<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\CarbonInterface;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $role
 * @property string|null $no_telepon
 * @property string|null $mapel
 * @property string $status
 * @property int|null $id_kelas
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Kolom yang dapat diisi secara mass-assignment.
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'no_telepon',
        'mapel',
        'status',
        'id_kelas',
        'nama_sekretaris',
        'nama_ketua_kelas',
        'nama_sekretaris_2',
        'id_ketua_kelas',
        'id_sekretaris_1',
        'id_sekretaris_2',
    ];

    /**
     * Kolom yang disembunyikan saat dikonversi ke Array/JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /**
     * Cast tipe data atribut.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * @return BelongsTo<Kelas, $this>
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function ketuaKelas(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_ketua_kelas', 'id_siswa');
    }

    public function sekretarisPertama(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_sekretaris_1', 'id_siswa');
    }

    public function sekretarisKedua(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_sekretaris_2', 'id_siswa');
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        $initials = Str::initials($this->name, true);

        return Str::length($initials) > 1
            ? Str::substr($initials, 0, 1).Str::substr($initials, -1)
            : $initials;
    }

    public function jadwalPiket(): HasMany
    {
        return $this->hasMany(JadwalPiket::class, 'id_guru', 'id');
    }

    /** Dipakai buat nampilin menu "Piket" di navbar — guru ini pernah dijadwal piket. */
    public function isGuruPiket(): bool
    {
        return JadwalPiketBulanan::where('id_guru', $this->id)->exists();
    }

    /** Dipakai buat validasi approve — guru ini piket TEPAT SEKARANG. */
    public function sedangPiket(?CarbonInterface $waktu = null): bool
    {
        $waktu ??= now();
        return JadwalPiketBulanan::query()
            ->whereDate('tanggal', $waktu->toDateString())
            ->where('id_guru', $this->id)
            ->whereIn('sesi', ['pagi', 'siang'])
            ->where(function ($q) use ($waktu) {
                $q->where(function ($jam) use ($waktu) {
                    $jam->where('jam_mulai', '<=', $waktu->format('H:i:s'))
                        ->where('jam_selesai', '>=', $waktu->format('H:i:s'));
                })->orWhere(function ($jam) {
                    $jam->where('jam_mulai', '00:00:00')->where('jam_selesai', '00:00:00');
                });
            })
            ->exists();
    }
}
