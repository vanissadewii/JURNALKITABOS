<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['username' => 'admin'], // kunci pengecekan, biar tidak duplikat
            [
                'name'      => 'Admin Utama',
                'password'  => Hash::make('adminceo'),
                'role'      => 'admin',
                'status'    => 'aktif',
                'id_kelas'  => null,
            ]
        );
    }
}