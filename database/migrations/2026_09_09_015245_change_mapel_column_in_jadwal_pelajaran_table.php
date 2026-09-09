<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jadwal_pelajaran', function (Blueprint $table) {
            $table->dropColumn('mapel');
            $table->foreignId('id_mapel')->after('id_guru')
                ->constrained('mapel', 'id_mapel')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_pelajaran', function (Blueprint $table) {
            $table->dropForeign(['id_mapel']);
            $table->dropColumn('id_mapel');
            $table->string('mapel', 100);
        });
    }
};
