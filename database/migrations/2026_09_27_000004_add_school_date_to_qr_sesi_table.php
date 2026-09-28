<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('qr_sesi', function (Blueprint $table) {
            $table->date('tanggal')->nullable()->index();
        });
    }

    public function down(): void
    {
        Schema::table('qr_sesi', function (Blueprint $table) {
            $table->dropColumn('tanggal');
        });
    }
};
