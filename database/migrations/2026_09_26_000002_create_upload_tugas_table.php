<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('upload_tugas', function (Blueprint $table) {
            $table->id('id_upload_tugas');
            $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas')->cascadeOnDelete();
            $table->string('mapel', 100);
            $table->enum('status_guru', ['Izin', 'Sakit']);
            $table->text('alasan_izin')->nullable();
            $table->text('tugas');
            $table->foreignId('id_guru_piket')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('upload_tugas');
    }
};
