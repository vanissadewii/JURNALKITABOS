<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('qr_sesi', function (Blueprint $table) {
            $table->foreignId('id_jurnal')->nullable()->after('id_jadwal')
                ->constrained('jurnal', 'id_jurnal')->cascadeOnDelete();
            $table->enum('tipe', ['guru', 'kelas'])->default('guru')->after('kode_qr');
            $table->timestamp('dipindai_at')->nullable()->after('waktu_expired');
            $table->foreignId('dipindai_oleh')->nullable()->after('dipindai_at')
                ->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('qr_sesi', function (Blueprint $table) {
            $table->dropForeign(['id_jurnal']);
            $table->dropForeign(['dipindai_oleh']);
            $table->dropColumn(['id_jurnal', 'tipe', 'dipindai_at', 'dipindai_oleh']);
        });
    }
};