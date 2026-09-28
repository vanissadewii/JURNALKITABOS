<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Kelas;
use App\Support\NamaWaliKelas;
use App\Support\Username;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements SkipsOnFailure, ToModel, WithHeadingRow, WithValidation
{
    use SkipsFailures;

    public function prepareForValidation(array $data, int $index): array
    {
        $data['username'] = Username::normalisasi((string) ($data['username'] ?? ''));

        return $data;
    }

    public function model(array $row): ?Model
    {
        $name = trim((string) $row['name']);
        if (trim((string) ($row['role'] ?? '')) === 'wali_kelas' && ! empty($row['id_kelas'])) {
            $kelas = Kelas::find($row['id_kelas']);
            $name = $kelas ? (NamaWaliKelas::untukKelas($kelas->tingkat, $kelas->jurusan, $kelas->rombel) ?? $name) : $name;
        }

        return new User([
            'name' => $name,
            'username' => Username::normalisasi((string) $row['username']),
            'password' => trim((string) $row['password']),
            'role' => trim((string) $row['role']),
            'status' => trim((string) ($row['status'] ?? 'aktif')),
            'no_telepon' => isset($row['no_telepon']) && trim((string) $row['no_telepon']) !== '' ? trim((string) $row['no_telepon']) : null,
            'id_kelas' => isset($row['id_kelas']) && trim((string) $row['id_kelas']) !== '' ? (int) $row['id_kelas'] : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'regex:'.Username::FORMAT, 'unique:users,username'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:guru,kelas,wali_kelas'],
            'status' => ['nullable', 'in:aktif,nonaktif,pending'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'id_kelas' => ['nullable', 'integer', 'exists:kelas,id_kelas', 'required_if:role,kelas,wali_kelas'],
        ];
    }
}
