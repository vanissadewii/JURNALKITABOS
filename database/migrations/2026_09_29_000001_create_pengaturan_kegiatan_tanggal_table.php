<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan_kegiatan_tanggal', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->unique();
            $table->string('nama_kegiatan', 120);
            $table->boolean('kegiatan_ditiadakan')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_kegiatan_tanggal');
    }
};
