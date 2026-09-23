<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_piket', function (Blueprint $table) {
            $table->id('id_piket');

            $table->foreignId('id_guru')
                ->constrained('users', 'id')
                ->cascadeOnDelete();

            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']);
            $table->unsignedTinyInteger('sesi');
            $table->time('jam_mulai');
            $table->time('jam_selesai');

            $table->timestamps();

            // asumsi: 1 sesi piket per hari cuma dipegang 1 guru
            $table->unique(['hari', 'sesi']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_piket');
    }
};
