<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('waka', 'no_hp')) {
            return;
        }

        Schema::table('waka', function (Blueprint $table) {
            $table->string('no_hp', 20)->nullable()->after('nama');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('waka', 'no_hp')) {
            return;
        }

        Schema::table('waka', function (Blueprint $table) {
            $table->dropColumn('no_hp');
        });
    }
};
