<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengiriman_jurnal_kelas', function (Blueprint $table) {
            $table->string('status', 20)->default('menunggu')->after('dikirim_at');
            $table->text('alasan_tolak')->nullable()->after('status');
            $table->foreignId('id_diperiksa_oleh')->nullable()->after('alasan_tolak')->constrained('users')->nullOnDelete();
            $table->timestamp('diperiksa_at')->nullable()->after('id_diperiksa_oleh');
        });
    }

    public function down(): void
    {
        Schema::table('pengiriman_jurnal_kelas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_diperiksa_oleh');
            $table->dropColumn(['status', 'alasan_tolak', 'diperiksa_at']);
        });
    }
};
