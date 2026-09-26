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

        $noAbsen = trim((string) ($row['no_absen'] ?? ''));
        if ($noAbsen === '') {
            $noAbsen = (string) ((Siswa::where('id_kelas', $kelas->id_kelas)->max('no_absen') ?? 0) + 1);
        }

        return new Siswa([
            'nisn' => null,
            'nama' => trim($row['nama']),
            'no_absen' => (int) $noAbsen,
            'id_kelas' => $kelas->id_kelas,
        ]);
    }

    public function prepareForValidation($data, $index): array
    {
        // File daftar siswa sekolah memakai kolom "kelas" dengan angka Romawi,
        // sedangkan data master menyimpan tingkat sebagai 10, 11, atau 12.
        $tingkat = trim((string) ($data['tingkat'] ?? $data['kelas'] ?? ''));
        $jurusan = strtoupper(trim((string) ($data['jurusan'] ?? '')));
        $rombel = trim((string) ($data['rombel'] ?? ''));

        $data['tingkat'] = match (strtoupper($tingkat)) {
            'X' => '10',
            'XI' => '11',
            'XII' => '12',
            default => $tingkat,
        };
        $data['jurusan'] = $jurusan;
        // File sekolah menandai rombel ULW dengan "-", sedangkan kelas master
        // ULW dibuat dengan rombel 1.
        if ($jurusan === 'ULW' && ($rombel === '' || $rombel === '-')) {
            $data['rombel'] = '1';
        }

        return $data;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:100'],
            'no_absen' => ['nullable', 'integer', 'min:1'],
            'tingkat' => ['required'],
            'jurusan' => ['required'],
            'rombel' => ['required'],
        ];
    }
}
