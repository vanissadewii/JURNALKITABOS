<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('users', 'nama_sekretaris')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('nama_sekretaris', 150)->nullable()->after('id_kelas');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'nama_sekretaris')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('nama_sekretaris');
            });
        }
    }
};
