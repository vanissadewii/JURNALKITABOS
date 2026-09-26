<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Jurnal;
use App\Models\QrSesi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RiwayatJurnalController extends Controller
{
    public function index(): View
    {
<<<<<<< HEAD
        $semuaJurnal = Jurnal::whereHas('jadwal', function ($q) {
            $q->where('id_guru', Auth::id());
        })
            ->with(['jadwal.kelas', 'jadwal.mapel', 'jadwal.jamPelajaran'])
=======
        $semuaJurnal = Jurnal::where('status_verifikasi', 'terverifikasi')
            ->whereHas('jadwal', function ($q) {
                $q->where('id_guru', Auth::id());
            })
            ->with(['jadwal.kelas', 'jadwal.mapel', 'jadwal.jamPelajaran', 'absenSiswa'])
>>>>>>> putri/tampilan-admin
            ->get()
            ->sort(function ($a, $b) {
                if ($a->tanggal->ne($b->tanggal)) {
                    return $b->tanggal->timestamp <=> $a->tanggal->timestamp;
                }

                return ($a->jadwal->jamPelajaran->jam_ke ?? 0) <=> ($b->jadwal->jamPelajaran->jam_ke ?? 0);
            })
            ->values();

        $tanggalAdaSesi = $semuaJurnal->pluck('tanggal')->map(fn ($t) => $t->format('Y-m-d'))->unique()->values();

        return view('guru.riwayat_jurnal', compact('semuaJurnal', 'tanggalAdaSesi'));
    }

    public function show(Jurnal $jurnal): View
    {
        $jurnal->load(['jadwal.kelas', 'jadwal.mapel', 'jadwal.jamPelajaran']);
        $jadwal = $jurnal->jadwal;

        abort_if((int) $jadwal->id_guru !== (int) Auth::id(), 403);
<<<<<<< HEAD
=======
        abort_unless($jurnal->status_verifikasi === 'terverifikasi', 404);
>>>>>>> putri/tampilan-admin

        // rentang jam berurutan (kelas, guru, mapel sama) di hari itu, mis. jam ke-1 sampai 3
        $jam = $jadwal->jamPelajaran;
        $jamAwal = $jam;
        $jamAkhir = $jam;

        if ($jam) {
            $jamSet = JadwalPelajaran::with('jamPelajaran')
                ->where('id_kelas', $jadwal->id_kelas)
                ->where('id_guru', $jadwal->id_guru)
                ->where('id_mapel', $jadwal->id_mapel)
                ->whereHas('jamPelajaran', fn ($q) => $q
                    ->where('id_semester', $jam->id_semester)
                    ->where('hari', $jam->hari))
                ->get()
                ->map(fn ($j) => $j->jamPelajaran)
                ->filter()
                ->keyBy(fn ($j) => (int) $j->jam_ke);

            $awal = (int) $jam->jam_ke;
            $akhir = (int) $jam->jam_ke;

            while ($jamSet->has($awal - 1)) {
                $awal--;
            }
            while ($jamSet->has($akhir + 1)) {
                $akhir++;
            }

            $jamAwal = $jamSet->get($awal);
            $jamAkhir = $jamSet->get($akhir);
        }

        // pisahkan isi kolom keterangan: catatan guru, siswa tidak hadir, dan dispen
        $catatan = [];
        $tidakHadir = [];
        $dispen = [];

        foreach (preg_split('/\R|\s\|\s/', (string) $jurnal->keterangan) as $bagian) {
            $bagian = trim($bagian);

            if ($bagian === '') {
                continue;
            }

            if (str_starts_with($bagian, 'Tidak hadir:')) {
                $daftar = trim(substr($bagian, strlen('Tidak hadir:')));

                foreach (preg_split('/\),\s*/', $daftar) as $item) {
                    $item = trim($item);

                    if ($item === '') {
                        continue;
                    }

                    if (! str_ends_with($item, ')')) {
                        $item .= ')';
                    }

                    if (preg_match('/^(.*)\s\((Sakit|Izin|Alpha)\)$/u', $item, $m)) {
                        $tidakHadir[] = ['nama' => $m[1], 'status' => $m[2]];
                    } else {
                        $tidakHadir[] = ['nama' => $item, 'status' => '-'];
                    }
                }
            } elseif (str_starts_with($bagian, 'Dispen:')) {
                $dispen[] = trim(substr($bagian, strlen('Dispen:')));
            } else {
                $catatan[] = $bagian;
            }
        }

        // info verifikasi dari QR yang dipindai kelas
        $qr = QrSesi::where('id_jurnal', $jurnal->id_jurnal)
            ->where('tipe', 'guru')
            ->latest('id_qr')
            ->first();
        $pemindai = $qr?->dipindai_oleh ? User::find($qr->dipindai_oleh) : null;

        return view('guru.detail_jurnal', compact(
            'jurnal',
            'jadwal',
            'jamAwal',
            'jamAkhir',
            'catatan',
            'tidakHadir',
            'dispen',
            'qr',
            'pemindai'
        ));
    }
}
