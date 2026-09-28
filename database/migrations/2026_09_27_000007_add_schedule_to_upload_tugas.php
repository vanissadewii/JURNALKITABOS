<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('upload_tugas', function (Blueprint $table) {
            $table->foreignId('id_jadwal')->nullable()->after('id_kelas')
                ->constrained('jadwal_pelajaran', 'id_jadwal')->nullOnDelete();
            $table->text('materi')->nullable()->after('mapel');
        });
    }

    public function down(): void
    {
        Schema::table('upload_tugas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_jadwal');
            $table->dropColumn('materi');
        });
    }
};
