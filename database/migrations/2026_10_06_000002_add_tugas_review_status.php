<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('upload_tugas', function (Blueprint $table) {
            $table->string('status_review', 20)->default('menunggu');
            $table->text('catatan_piket')->nullable();
            $table->timestamp('ditinjau_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('upload_tugas', function (Blueprint $table) {
            $table->dropColumn(['status_review', 'catatan_piket', 'ditinjau_at']);
        });
    }
};
