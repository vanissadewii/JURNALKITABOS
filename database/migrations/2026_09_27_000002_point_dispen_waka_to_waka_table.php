<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom dispens.id_waka dulunya merujuk ke users.id, padahal Waka
     * disimpan pada tabel waka tersendiri. Perbaikan ini membuat dispensasi
     * dapat mencatat Waka yang bertugas sesuai jadwal dari admin.
     */
    public function up(): void
    {
        $this->pindahkanRujuk('users', 'waka');
    }

    public function down(): void
    {
        $this->pindahkanRujuk('waka', 'users');
    }

    private function pindahkanRujuk(string $dari, string $ke): void
    {
        if (! Schema::hasTable('dispens') || ! Schema::hasTable($ke)) {
            return;
        }

        $foreign = collect(Schema::getForeignKeys('dispens'))->first(
            fn (array $key) => ($key['foreign_table'] ?? null) === $dari
                && in_array('id_waka', $key['columns'] ?? [], true)
        );

        if (! $foreign) {
            return;
        }

        $idsValid = DB::table($ke)->pluck('id')->all();
        DB::table('dispens')
            ->whereNotNull('id_waka')
            ->when($idsValid !== [], fn ($query) => $query->whereNotIn('id_waka', $idsValid))
            ->update(['id_waka' => null]);

        Schema::table('dispens', function (Blueprint $table) use ($foreign) {
            $table->dropForeign($foreign['name']);
        });

        Schema::table('dispens', function (Blueprint $table) use ($ke) {
            $table->foreign('id_waka')->references('id')->on($ke)->nullOnDelete();
        });
    }
};
