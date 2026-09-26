<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jurnal', function (Blueprint $table) {
            $table->string('status_kehadiran_guru', 20)->default('hadir')->after('id_jadwal');
        });
    }

    public function down(): void
    {
        Schema::table('jurnal', function (Blueprint $table) {
            $table->dropColumn('status_kehadiran_guru');
        });
    }
};
