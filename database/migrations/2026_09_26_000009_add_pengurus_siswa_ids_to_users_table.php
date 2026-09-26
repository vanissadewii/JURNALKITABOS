<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            foreach (['id_ketua_kelas', 'id_sekretaris_1', 'id_sekretaris_2'] as $column) {
                if (! Schema::hasColumn('users', $column)) {
                    $table->unsignedBigInteger($column)->nullable();
                }
            }
        });

        $kelasCache = [];
        foreach (DB::table('users')->where('role', 'kelas')->whereNotNull('id_kelas')->get(['id', 'id_kelas', 'nama_ketua_kelas', 'nama_sekretaris', 'nama_sekretaris_2']) as $user) {
            $kelasCache[$user->id_kelas] ??= DB::table('siswa')->where('id_kelas', $user->id_kelas)->get(['id_siswa', 'nama'])->keyBy(fn ($siswa) => mb_strtolower(trim($siswa->nama)));
            $siswaKelas = $kelasCache[$user->id_kelas];
            $cariId = fn ($nama) => $nama ? ($siswaKelas[mb_strtolower(trim($nama))]->id_siswa ?? null) : null;
            DB::table('users')->where('id', $user->id)->update([
                'id_ketua_kelas' => $cariId($user->nama_ketua_kelas),
                'id_sekretaris_1' => $cariId($user->nama_sekretaris),
                'id_sekretaris_2' => $cariId($user->nama_sekretaris_2),
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = array_filter(['id_ketua_kelas', 'id_sekretaris_1', 'id_sekretaris_2'], fn ($column) => Schema::hasColumn('users', $column));
            if ($columns) $table->dropColumn($columns);
        });
    }
};
