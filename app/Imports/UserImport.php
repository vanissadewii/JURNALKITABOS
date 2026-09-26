<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements SkipsOnFailure, ToModel, WithHeadingRow, WithValidation
{
    use SkipsFailures;

    public function model(array $row): ?Model
    {
        return new User([
            'name' => trim((string) $row['name']),
            'username' => trim((string) $row['username']),
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
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:guru,kelas'],
            'status' => ['nullable', 'in:aktif,nonaktif,pending'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'id_kelas' => ['nullable', 'integer', 'exists:kelas,id_kelas', 'required_if:role,kelas'],
        ];
    }
}
