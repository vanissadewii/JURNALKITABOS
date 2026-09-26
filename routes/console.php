<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Tandai jadwal yang sudah berakhir lebih dari 15 menit tanpa jurnal sebagai guru tidak hadir.
\Illuminate\Support\Facades\Schedule::call(function () {
    $sekarang = now();
    $batasAkhir = $sekarang->copy()->subMinutes((int) config('jurnal.toleransi_tidak_hadir', 15));
    $hari = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'][$sekarang->dayOfWeekIso];

    \App\Models\JadwalPelajaran::query()
        ->with('jamPelajaran')
        ->whereHas('jamPelajaran', fn ($q) => $q
            ->where('hari', $hari)
            ->where('jam_selesai', '<=', $batasAkhir->format('H:i:s'))
            ->whereHas('semester', fn ($semester) => $semester->where('status', 'aktif')))
        ->get()
        ->each(function ($jadwal) use ($sekarang) {
            $jurnalAda = \App\Models\Jurnal::where('id_jadwal', $jadwal->id_jadwal)
                ->whereDate('tanggal', $sekarang->toDateString())
                ->whereNotNull('waktu_submit')->exists();
            if (! $jurnalAda) {
                $jurnal = \App\Models\Jurnal::where('id_jadwal', $jadwal->id_jadwal)
                    ->whereDate('tanggal', $sekarang->toDateString())
                    ->whereNull('waktu_submit')->latest('id_jurnal')->first() ?? new \App\Models\Jurnal();
                $jurnal->fill([
                    'id_jadwal' => $jadwal->id_jadwal,
                    'status_kehadiran_guru' => 'tidak_hadir',
                    'tanggal' => $sekarang->toDateString(),
                    'status_verifikasi' => 'belum_verifikasi',
                    'status_piket' => 'menunggu',
                    'keterangan' => trim(($jurnal->keterangan ? $jurnal->keterangan.' | ' : '').'Jurnal tidak dikirim hingga toleransi setelah jam pelajaran berakhir.'),
                    'waktu_submit' => $sekarang,
                ])->save();
            }
        });
})->name('jurnal.tandai-tidak-hadir')->everyMinute()->withoutOverlapping();
