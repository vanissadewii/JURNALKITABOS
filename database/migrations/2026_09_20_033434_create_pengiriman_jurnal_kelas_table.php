<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengiriman_jurnal_kelas', function (Blueprint $table) {
            $table->id('id_pengiriman');
            $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas')->cascadeOnDelete();
            $table->date('tanggal');
            $table->foreignId('dikirim_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('dikirim_at');
            $table->timestamps();

            $table->unique(['id_kelas', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengiriman_jurnal_kelas');
    }
};