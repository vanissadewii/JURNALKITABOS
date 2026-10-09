<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('upload_tugas', function (Blueprint $table) {
            $table->foreignId('id_pengunggah')->nullable()->after('id_guru_piket')->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('upload_tugas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_pengunggah');
        });
    }
};
