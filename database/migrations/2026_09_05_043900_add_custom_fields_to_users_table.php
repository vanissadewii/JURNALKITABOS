<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['kelas', 'guru', 'admin'])->default('kelas')->after('email');
            $table->string('no_telepon', 20)->nullable()->after('role');
            $table->enum('status', ['aktif', 'nonaktif', 'pending'])->default('pending')->after('no_telepon');
            $table->foreignId('id_kelas')->nullable()->after('status')
                ->constrained('kelas', 'id_kelas')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_kelas']);
            $table->dropColumn(['role', 'no_telepon', 'status', 'id_kelas']);
        });
    }
};
