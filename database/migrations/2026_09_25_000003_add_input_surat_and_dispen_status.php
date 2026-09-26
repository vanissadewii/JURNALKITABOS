<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')->constrained('siswa', 'id_siswa')->cascadeOnDelete();
            $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas')->cascadeOnDelete();
            $table->date('tanggal');
            $table->string('status', 10);
            $table->foreignId('id_guru_piket')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['id_siswa', 'tanggal']);
        });

        Schema::table('jurnal_siswa_absen', function (Blueprint $table) {
            $table->foreignId('id_siswa')->nullable()->after('id_jurnal')->constrained('siswa', 'id_siswa')->nullOnDelete();
        });
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE jurnal_siswa_absen MODIFY status VARCHAR(20) NOT NULL");
        } else {
            Schema::table('jurnal_siswa_absen', fn (Blueprint $table) => $table->string('status', 20)->change());
        }
    }

    public function down(): void
    {
        Schema::table('jurnal_siswa_absen', function (Blueprint $table) {
            $table->dropForeign(['id_siswa']);
            $table->dropColumn('id_siswa');
        });
        Schema::dropIfExists('surat_siswa');
    }
};
