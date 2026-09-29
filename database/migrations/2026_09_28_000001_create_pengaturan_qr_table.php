<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('pengaturan_qr')) {
            Schema::create('pengaturan_qr', function (Blueprint $table) {
                $table->id();
                $table->unsignedSmallInteger('masa_qr_detik')->default(10);
                $table->timestamps();
            });
        }

        if (DB::table('pengaturan_qr')->doesntExist()) {
            DB::table('pengaturan_qr')->insert([
                'masa_qr_detik' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_qr');
    }
};
