<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_piket_bulanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('bulan');
            $table->unsignedSmallInteger('tahun');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']);
            $table->enum('sesi', ['pagi', 'siang', 'waka']);
            $table->unsignedTinyInteger('urutan')->default(1);
            $table->foreignId('id_guru')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('id_waka')->nullable()->constrained('waka')->nullOnDelete();
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->timestamps();
            $table->unique(['bulan', 'tahun', 'hari', 'sesi', 'urutan'], 'jadwal_piket_bulanan_unik');
            $table->index(['tahun', 'bulan', 'hari']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_piket_bulanan');
    }
};
