<?php

use App\Support\NamaWaliKelas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $aliasNamaAkun = [
            '10|AK|1' => 'Atih Wilupi',
            '10|AK|4' => 'Astra Bella Flamboyan',
            '10|AN|1' => 'Dhuana Putri Puspitasary',
            '10|DKV|1' => 'Rulik Indrawati',
            '10|PSPT|1' => 'Benny Mamora',
            '10|PSPT|2' => "Muto'atul Khosi'ah",
            '11|AK|3' => 'Arvia Rienetasary',
            '11|AN|1' => 'Khuriyatul Kamila',
            '11|MP|1' => 'Martiin',
            '12|DKV|2' => "Elysa Yuli Nur'aini",
            '12|MP|1' => 'Ajeng Okvitasari',
            '12|MP|3' => 'Fitria Diah Ayu Hartati',
            '12|PSPT|1' => 'Wiwik Yuniarsih',
            '12|PSPT|2' => 'Mufatiroh',
            '12|ULW|1' => 'Fitria Renytasari',
        ];

        $keyNama = static fn (string $nama): string => preg_replace('/[^a-z0-9]/', '', strtolower(explode(',', $nama)[0]));
        $akunGuru = DB::table('users')->whereIn('role', ['guru', 'wali_kelas'])->get(['id', 'name']);
        $kelasList = DB::table('kelas')->orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();
        $akunTerpakai = [];

        foreach ($kelasList as $kelas) {
            $namaRoster = NamaWaliKelas::untukKelas($kelas->tingkat, $kelas->jurusan, $kelas->rombel);
            if ($namaRoster === null) {
                continue;
            }

            $kelasKey = $kelas->tingkat.'|'.$kelas->jurusan.'|'.$kelas->rombel;
            $namaAkun = $aliasNamaAkun[$kelasKey] ?? explode(',', $namaRoster)[0];
            $namaAkunKey = $keyNama($namaAkun);
            $akun = $akunGuru->first(fn ($user) => $keyNama($user->name) === $namaAkunKey);

            if (! $akun) {
                throw new RuntimeException('Akun guru untuk wali kelas '.$kelasKey.' tidak ditemukan.');
            }
            if (isset($akunTerpakai[$akun->id])) {
                throw new RuntimeException('Satu akun guru terpilih untuk lebih dari satu kelas.');
            }

            $akunTerpakai[$akun->id] = true;
            DB::table('users')->where('id', $akun->id)->update([
                'name' => $namaRoster,
                'role' => 'wali_kelas',
                'id_kelas' => $kelas->id_kelas,
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        // Role dan penempatan wali kelas tidak bisa dipulihkan otomatis.
    }
};
