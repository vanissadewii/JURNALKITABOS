<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_siswa', function (Blueprint $table) {
            $table->date('tanggal_sampai')->nullable()->after('tanggal');
            $table->string('jenis_surat', 20)->default('izin')->after('status');
            $table->string('file_path')->nullable()->after('jenis_surat');
            $table->text('keterangan')->nullable()->after('file_path');
        });
    }

    public function down(): void
    {
        Schema::table('surat_siswa', function (Blueprint $table) {
            $table->dropColumn(['tanggal_sampai', 'jenis_surat', 'file_path', 'keterangan']);
        });
    }
};
