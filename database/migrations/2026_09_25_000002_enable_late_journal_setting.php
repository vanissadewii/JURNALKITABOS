<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan_jurnal_susulan', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->primary();
            $table->boolean('aktif')->default(false);
            $table->timestamps();
        });

        Schema::table('jurnal', function (Blueprint $table) {
            $table->boolean('is_susulan')->default(false)->after('status_verifikasi');
        });

        DB::table('pengaturan_jurnal_susulan')->insert([
            'id' => 1,
            'aktif' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::table('jurnal', function (Blueprint $table) {
            $table->dropColumn('is_susulan');
        });

        Schema::dropIfExists('pengaturan_jurnal_susulan');
    }
};
