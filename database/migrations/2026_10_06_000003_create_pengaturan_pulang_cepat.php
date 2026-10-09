<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan_pulang_cepat', function (Blueprint $table) {
            $table->id();
            $table->string('hari', 10)->unique();
            $table->boolean('aktif')->default(false);
            $table->unsignedTinyInteger('jam_ke')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_pulang_cepat');
    }
};
