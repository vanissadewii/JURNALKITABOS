<?php

namespace App\Imports;

use App\Models\Mapel;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MapelImport implements SkipsOnFailure, ToModel, WithHeadingRow, WithValidation
{
    use SkipsFailures;

    public function model(array $row): ?Model
    {
        return new Mapel([
            'nama_mapel' => trim($row['nama_mapel']),
            'kode_mapel' => isset($row['kode_mapel']) && trim((string) $row['kode_mapel']) !== ''
                ? trim((string) $row['kode_mapel'])
                : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_mapel' => ['required', 'string', 'max:100', 'unique:mapel,nama_mapel'],
            'kode_mapel' => ['nullable', 'string', 'max:20', 'unique:mapel,kode_mapel'],
        ];
    }
}
