<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Waka extends Model
{
    protected $table = 'waka';

    protected $fillable = ['nama', 'no_hp'];

    /**
     * Simpan nomor apa adanya (hanya dibersihkan dari spasi dan tanda baca)
     * agar nomor yang diketik admin tetap terbaca seperti aslinya.
     */
    public function setNoHpAttribute(?string $nilai): void
    {
        $bersih = preg_replace('/[^0-9+]/', '', (string) $nilai);

        $this->attributes['no_hp'] = $bersih === '' || $bersih === '+' ? null : $bersih;
    }

    /**
     * Nomor siap pakai untuk tautan wa.me, selalu berformat internasional (62...).
     */
    public function nomorWa(): ?string
    {
        $angka = preg_replace('/\D/', '', (string) $this->no_hp);

        if ($angka === null || $angka === '') {
            return null;
        }

        if (str_starts_with($angka, '62')) {
            return $angka;
        }

        if (str_starts_with($angka, '0')) {
            return '62'.substr($angka, 1);
        }

        return str_starts_with($angka, '8') ? '62'.$angka : $angka;
    }

    /** Nomor untuk ditampilkan ke layar, misal 0812-3456-7890. */
    public function nomorTampilan(): ?string
    {
        $angka = preg_replace('/\D/', '', (string) $this->no_hp);

        if ($angka === null || $angka === '') {
            return null;
        }

        $potong = preg_replace('/(\d{4})(?=\d)/', '$1-', $angka);

        return $potong ?? $angka;
    }

    /** Nomor dianggap layak kirim bila panjangnya masuk akal untuk Indonesia. */
    public function nomorValid(): bool
    {
        $nomor = $this->nomorWa();

        return $nomor !== null && strlen($nomor) >= 11 && strlen($nomor) <= 15;
    }

    /** @return HasMany<JadwalPiketBulanan, $this> */
    public function jadwalPiket(): HasMany
    {
        return $this->hasMany(JadwalPiketBulanan::class, 'id_waka');
    }
}
