<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel ini nyatet: untuk 1 dispen, jam pelajaran/guru mana aja yang
        // kena. 1 dispen (misal jam 3-6) bisa nyentuh beberapa id_jadwal
        // (beberapa guru & mapel berbeda), jadi butuh tabel pivot ini.
        Schema::create('dispen_jurnal', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_dispen')
                ->constrained('dispens', 'id_dispen')
                ->cascadeOnDelete();

            $table->foreignId('id_jadwal')
                ->constrained('jadwal_pelajaran', 'id_jadwal')
                ->cascadeOnDelete();

            // dicatat setelah approve, biar gampang lacak jurnal mana yang
            // sudah dibuat/diupdate akibat dispen ini
            $table->foreignId('id_jurnal')
                ->nullable()
                ->constrained('jurnal', 'id_jurnal')
                ->nullOnDelete();

            $table->timestamps();

            $table->unique(['id_dispen', 'id_jadwal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispen_jurnal');
    }
};
