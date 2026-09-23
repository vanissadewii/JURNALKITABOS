<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurnal_siswa_absen', function (Blueprint $table) {
            $table->id('id_absen');
            $table->foreignId('id_jurnal')->constrained('jurnal', 'id_jurnal')->cascadeOnDelete();
            $table->string('nama', 100);
            $table->enum('status', ['Sakit', 'Izin', 'Alpha']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurnal_siswa_absen');
    }
};