<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('kelas','guru','wali_kelas','admin') NOT NULL DEFAULT 'kelas'");
        }
    }

    public function down(): void
    {
        DB::table('users')->where('role', 'wali_kelas')->update(['role' => 'guru']);

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('kelas','guru','admin') NOT NULL DEFAULT 'kelas'");
        }
    }
};
