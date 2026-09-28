<?php

use App\Support\NamaWaliKelas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        foreach (DB::table('users')->join('kelas', 'users.id_kelas', '=', 'kelas.id_kelas')->where('users.role', 'wali_kelas')
            ->get(['users.id', 'kelas.tingkat', 'kelas.jurusan', 'kelas.rombel']) as $wali) {
            $nama = NamaWaliKelas::untukKelas($wali->tingkat, $wali->jurusan, $wali->rombel);
            if ($nama !== null) {
                DB::table('users')->where('id', $wali->id)->update(['name' => $nama]);
            }
        }

        $used = [];
        foreach (DB::table('users')->orderBy('id')->get(['id', 'username']) as $user) {
            $normalized = preg_replace('/[^A-Za-z0-9._]/', '_', preg_replace('/\s+/u', '_', trim((string) $user->username)) ?? '');
            $base = trim((string) $normalized, '._');
            $base = substr($base !== '' ? $base : 'user_'.$user->id, 0, 50);
            $candidate = $base;
            $suffixNumber = 0;

            while (isset($used[strtolower($candidate)]) || DB::table('users')->where('username', $candidate)->where('id', '<>', $user->id)->exists()) {
                $suffix = '_'.$user->id.($suffixNumber ? '_'.$suffixNumber : '');
                $candidate = substr($base, 0, 50 - strlen($suffix)).$suffix;
                $suffixNumber++;
            }

            $used[strtolower($candidate)] = true;
            if ($candidate !== $user->username) {
                DB::table('users')->where('id', $user->id)->update(['username' => $candidate]);
            }
        }
    }

    public function down(): void
    {
        // Perubahan data ini tidak dapat dibatalkan otomatis.
    }
};
