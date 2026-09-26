<?php

namespace Database\Seeders;

use App\Models\JadwalPelajaran;
use App\Models\JamPelajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = Kelas::firstOrCreate([
            'tingkat' => '11',
            'jurusan' => 'RPL',
            'rombel' => 2,
        ]);

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

        User::firstOrCreate(
            ['username' => 'kelas.xirpl2'],
            [
                'name' => 'Ketua Kelas XI RPL 2',
                'password' => Hash::make('kelas123'),
                'role' => 'kelas',
                'status' => 'aktif',
                'id_kelas' => $kelas->id_kelas,
            ]
        );

        User::updateOrCreate(
            ['username' => 'badrussulaiman'],
            [
                'name' => 'Badrus Sulaiman',
                'password' => Hash::make('badrus123'),
                'role' => 'guru',
                'status' => 'aktif',
                'no_telepon' => '085735059975',
                'mapel' => 'Matematika',
                'id_kelas' => null,
            ]
        );

        $guru = User::where('username', 'badrussulaiman')->firstOrFail();
        $semester = Semester::firstOrCreate(
            ['nama' => 'Semester 1 2026/2027'],
            [
                'tanggal_mulai' => Carbon::create(2026, 7, 1),
                'tanggal_selesai' => Carbon::create(2026, 12, 31),
                'status' => 'aktif',
            ]
        );

        $mapel = Mapel::firstOrCreate(
            ['nama_mapel' => 'Matematika'],
            ['kode_mapel' => 'MTK']
        );

        $jam = JamPelajaran::firstOrCreate(
            [
                'id_semester' => $semester->id_semester,
                'tingkat' => $kelas->tingkat,
                'hari' => 'Senin',
                'jam_ke' => 1,
            ],
            [
                'jam_mulai' => '07:00:00',
                'jam_selesai' => '09:40:00',
            ]
        );

        JadwalPelajaran::firstOrCreate([
            'id_kelas' => $kelas->id_kelas,
            'id_jam' => $jam->id_jam,
            'id_guru' => $guru->id,
            'id_mapel' => $mapel->id_mapel,
        ]);
    }
}
