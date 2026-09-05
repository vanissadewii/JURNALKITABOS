<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qr_sesi', function (Blueprint $table) {
            $table->id('id_qr');
            $table->foreignId('id_jadwal')
                ->constrained('jadwal_pelajaran', 'id_jadwal')
                ->onDelete('cascade');
            $table->string('kode_qr', 100)->unique();
            $table->timestamp('waktu_generate');
            $table->timestamp('waktu_expired');
            $table->enum('status', ['aktif', 'expired'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_sesi');
    }
};
