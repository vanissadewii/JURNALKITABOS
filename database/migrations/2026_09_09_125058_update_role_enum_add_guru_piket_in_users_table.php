<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('kelas', 'guru', 'guru_piket', 'admin') NOT NULL DEFAULT 'kelas'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('kelas', 'guru', 'admin') NOT NULL DEFAULT 'kelas'");
    }
};