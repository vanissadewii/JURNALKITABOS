<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan_kegiatan_harian', function (Blueprint $table) {
            $table->id();
            $table->enum('hari', ['Senin', 'Jumat'])->unique();
            $table->boolean('kegiatan_ditiadakan')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_kegiatan_harian');
    }
};
