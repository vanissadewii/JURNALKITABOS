<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurnal', function (Blueprint $table) {
            $table->id('id_jurnal');
            $table->foreignId('id_jadwal')
                ->constrained('jadwal_pelajaran', 'id_jadwal')
                ->onDelete('cascade');
            $table->date('tanggal');
            $table->text('materi')->nullable();
            $table->text('keterangan')->nullable();  // agenda/diskusi/tugas
            $table->integer('jumlah_hadir')->nullable();
            $table->enum('status_verifikasi', ['belum_verifikasi', 'terverifikasi'])->default('belum_verifikasi');
            $table->timestamp('waktu_submit')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurnal');
    }
};
