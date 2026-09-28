<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('waka', 'no_hp')) {
            Schema::table('waka', function (Blueprint $table) {
                $table->string('no_hp', 25)->nullable()->after('nama');
            });
        }

        Schema::table('dispens', function (Blueprint $table) {
            $table->foreignId('id_waka_piket')->nullable()->after('id_waka')->constrained('waka')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('dispens', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_waka_piket');
        });
        Schema::table('waka', function (Blueprint $table) {
            $table->dropColumn('no_hp');
        });
    }
};
