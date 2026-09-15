<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek jika database yang dipakai adalah MySQL / MariaDB
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('kelas', 'guru', 'guru_piket', 'admin') NOT NULL DEFAULT 'kelas'");
        } else {
            // Untuk SQLite (digunakan oleh CI/CD GitHub Actions)
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('kelas')->change();
            });
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('kelas', 'guru', 'admin') NOT NULL DEFAULT 'kelas'");
        } else {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('kelas')->change();
            });
        }
    }
};
