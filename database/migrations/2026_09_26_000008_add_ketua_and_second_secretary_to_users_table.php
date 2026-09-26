<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'nama_ketua_kelas')) {
                $table->string('nama_ketua_kelas', 150)->nullable()->after('nama_sekretaris');
            }
            if (! Schema::hasColumn('users', 'nama_sekretaris_2')) {
                $table->string('nama_sekretaris_2', 150)->nullable()->after('nama_ketua_kelas');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = array_filter(['nama_ketua_kelas', 'nama_sekretaris_2'], fn ($column) => Schema::hasColumn('users', $column));
            if ($columns) $table->dropColumn($columns);
        });
    }
};
