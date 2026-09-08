<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_pelajaran', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->foreignId('id_kelas')
                ->constrained('kelas', 'id_kelas')
                ->onDelete('cascade');
            $table->foreignId('id_jam')
                ->constrained('jam_pelajaran', 'id_jam')
                ->onDelete('cascade');
            $table->foreignId('id_guru')
                ->constrained('users', 'id')
                ->onDelete('cascade');
            $table->string('mapel', 100);   // string dulu buat MVP, bisa dipisah jadi tabel mapel nanti
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajaran');
    }
};
