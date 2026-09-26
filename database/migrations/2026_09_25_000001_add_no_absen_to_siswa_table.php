<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->unsignedSmallInteger('no_absen')->nullable()->after('nama');
        });

        DB::table('siswa')->orderBy('id_kelas')->orderBy('id_siswa')->get(['id_siswa', 'id_kelas'])
            ->groupBy('id_kelas')
            ->each(function ($siswas) {
                foreach ($siswas->values() as $index => $siswa) {
                    DB::table('siswa')->where('id_siswa', $siswa->id_siswa)
                        ->update(['no_absen' => $index + 1]);
                }
            });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn('no_absen');
        });
    }
};
