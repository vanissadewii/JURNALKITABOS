<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['username' => 'admin'], // kunci pengecekan, biar tidak duplikat
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('adminceo'),
                'role' => 'admin',
                'status' => 'aktif',
                'id_kelas' => null,
            ]
        );
    }
}
