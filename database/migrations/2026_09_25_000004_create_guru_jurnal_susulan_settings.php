<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan_jurnal_susulan_guru', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_guru')->unique()->constrained('users')->cascadeOnDelete();
            $table->boolean('aktif')->default(false);
            $table->timestamps();
        });

        $aktifGlobal = (bool) DB::table('pengaturan_jurnal_susulan')->where('id', 1)->value('aktif');
        DB::table('users')->whereIn('role', ['guru', 'guru_piket'])->orderBy('id')->get(['id'])->each(function ($guru) use ($aktifGlobal) {
            DB::table('pengaturan_jurnal_susulan_guru')->insert([
                'id_guru' => $guru->id,
                'aktif' => $aktifGlobal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_jurnal_susulan_guru');
    }
};
