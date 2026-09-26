<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jurnal', function (Blueprint $table) {
            $table->string('status_piket', 20)->default('menunggu')->after('status_verifikasi');
            $table->text('alasan_tolak')->nullable()->after('status_piket');
            $table->foreignId('id_diperiksa_oleh')->nullable()->after('alasan_tolak')->constrained('users')->nullOnDelete();
            $table->timestamp('diperiksa_at')->nullable()->after('id_diperiksa_oleh');
        });
    }

    public function down(): void
    {
        Schema::table('jurnal', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_diperiksa_oleh');
            $table->dropColumn(['status_piket', 'alasan_tolak', 'diperiksa_at']);
        });
    }
};
