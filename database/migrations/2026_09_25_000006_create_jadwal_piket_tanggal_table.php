<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_piket_tanggal', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('sesi', ['pagi', 'siang', 'waka']);
            $table->unsignedTinyInteger('urutan')->default(1);
            $table->foreignId('id_guru')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('id_waka')->nullable()->constrained('waka')->nullOnDelete();
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->timestamps();
            $table->unique(['tanggal', 'sesi', 'urutan'], 'jadwal_piket_tanggal_unik');
        });

        if (! Schema::hasTable('jadwal_piket_bulanan')) {
            return;
        }

        $urutanHari = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5];
        foreach (DB::table('jadwal_piket_bulanan')->orderBy('id')->get() as $lama) {
            $awal = Carbon::create((int) $lama->tahun, (int) $lama->bulan, 1)->startOfDay();
            $akhir = $awal->copy()->endOfMonth();
            foreach (CarbonPeriod::create($awal, $akhir) as $tanggal) {
                if ($tanggal->dayOfWeekIso !== $urutanHari[$lama->hari]) {
                    continue;
                }

                DB::table('jadwal_piket_tanggal')->insert([
                    'tanggal' => $tanggal->toDateString(),
                    'sesi' => $lama->sesi,
                    'urutan' => $lama->urutan,
                    'id_guru' => $lama->id_guru,
                    'id_waka' => $lama->id_waka,
                    'jam_mulai' => $lama->jam_mulai,
                    'jam_selesai' => $lama->jam_selesai,
                    'created_at' => $lama->created_at,
                    'updated_at' => $lama->updated_at,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_piket_tanggal');
    }
};
