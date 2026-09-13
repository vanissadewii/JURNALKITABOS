<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispens', function (Blueprint $table) {
            $table->id('id_dispen');
            $table->string('nomor_surat')->unique();

            $table->foreignId('id_siswa')
                ->constrained('siswa', 'id_siswa')
                ->cascadeOnDelete();

            $table->foreignId('id_kelas')
                ->constrained('kelas', 'id_kelas')
                ->cascadeOnDelete();

            $table->date('tanggal');
            $table->unsignedTinyInteger('jam_ke_mulai');
            $table->unsignedTinyInteger('jam_ke_selesai')->nullable();
            $table->text('alasan');

            $table->foreignId('id_guru_piket')
                ->constrained('users', 'id')
                ->cascadeOnDelete();

            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])
                ->default('menunggu');

            $table->foreignId('id_waka')
                ->nullable()
                ->constrained('users', 'id')
                ->nullOnDelete();

            $table->timestamp('disetujui_at')->nullable();
            $table->string('token_approval')->unique()->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispens');
    }
};