<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $kolomDitambahkan = [];

    public function up(): void
    {
        $columns = Schema::getColumnListing('upload_tugas');

        Schema::table('upload_tugas', function (Blueprint $table) use ($columns) {
            if (! in_array('id_jadwal', $columns, true)) {
                $table->unsignedBigInteger('id_jadwal')->nullable();
                $this->kolomDitambahkan[] = 'id_jadwal';
            }
            if (! in_array('tanggal', $columns, true)) {
                $table->date('tanggal')->nullable();
                $this->kolomDitambahkan[] = 'tanggal';
            }
            if (! in_array('materi', $columns, true)) {
                $table->text('materi')->nullable();
                $this->kolomDitambahkan[] = 'materi';
            }
            if (! in_array('file_path', $columns, true)) {
                $table->string('file_path')->nullable();
                $this->kolomDitambahkan[] = 'file_path';
            }
        });
    }

    public function down(): void
    {
        // Kolom-kolom ini sudah dimiliki migrasi inti aplikasi; jangan dihapus di rollback.
    }
};
