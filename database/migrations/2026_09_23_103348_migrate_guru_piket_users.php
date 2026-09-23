<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')->where('role', 'guru_piket')->update(['role' => 'guru']);
    }

    public function down(): void
    {
        //
    }
};
