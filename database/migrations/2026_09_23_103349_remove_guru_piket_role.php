<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('kelas','guru','admin') NOT NULL DEFAULT 'kelas'");
        }
        // SQLite (dipakai CI/testing) tidak mendukung ALTER MODIFY COLUMN untuk enum.
        // Data guru_piket sudah dipindahkan di migration sebelumnya, jadi cukup aman di-skip di sini.
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('kelas','guru','guru_piket','admin') NOT NULL DEFAULT 'kelas'");
        }
    }
};
