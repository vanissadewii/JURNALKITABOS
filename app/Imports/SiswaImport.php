<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements SkipsOnFailure, ToModel, WithHeadingRow, WithValidation
{
    use SkipsFailures;

    public function model(array $row): ?Model
    {
        // Bersihkan spasi di awal/akhir string
        $tingkat = trim($row['tingkat'] ?? '');
        $jurusan = trim($row['jurusan'] ?? '');
        $rombel = trim($row['rombel'] ?? '');

        // Cari kelas tanpa memedulikan huruf besar/kecil (case insensitive)
        $kelas = Kelas::where('tingkat', $tingkat)
            ->where('jurusan', 'LIKE', $jurusan)
            ->where('rombel', $rombel)
            ->first();

        // JIKA KELAS TIDAK DITEMUKAN, HENTIKAN PROSES DAN TAMPILKAN ERROR DETAIL
        if (! $kelas) {
            throw new \Exception("Kelas '{$tingkat} {$jurusan} {$rombel}' tidak ditemukan di database tabel kelas!");
        }

        return new Siswa([
            'nisn' => trim($row['nisn']),
            'nama' => trim($row['nama']),
            'id_kelas' => $kelas->id_kelas,
        ]);
    }

    public function rules(): array
    {
        return [
            'nisn' => ['required', 'max:20', 'unique:siswa,nisn'],
            'nama' => ['required', 'string', 'max:100'],
            'tingkat' => ['required'],
            'jurusan' => ['required'],
            'rombel' => ['required'],
        ];
    }
}
