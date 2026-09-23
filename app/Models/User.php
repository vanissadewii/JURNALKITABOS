<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $role
 * @property string|null $no_telepon
 * @property string $status
 * @property int|null $id_kelas
 * @property Carbon|null $email_verified_at
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
        'status',
        'id_kelas',
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
        return $this->jadwalPiket()->exists();
    }

    /** Dipakai buat validasi approve — guru ini piket TEPAT SEKARANG. */
    public function sedangPiket(?Carbon $waktu = null): bool
    {
        $waktu ??= now();

        $hari = match ($waktu->dayOfWeekIso) {
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            default => null,
        };

        if (! $hari) {
            return false;
        }

        return $this->jadwalPiket()
            ->where('hari', $hari)
            ->whereTime('jam_mulai', '<=', $waktu->format('H:i:s'))
            ->whereTime('jam_selesai', '>=', $waktu->format('H:i:s'))
            ->exists();
    }
}
