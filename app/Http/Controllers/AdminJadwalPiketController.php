<?php

namespace App\Http\Controllers;

use App\Imports\JadwalPiketImport;
use App\Models\JadwalPiketBulanan;
use App\Models\User;
use App\Models\Waka;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class AdminJadwalPiketController extends Controller
{
    public function index(Request $request): View
    {
        $bulan = (int) $request->query('bulan', now()->month);
        $tahun = (int) $request->query('tahun', now()->year);
        abort_if($bulan < 1 || $bulan > 12 || $tahun < 2000 || $tahun > 2100, 404);

        $awalBulan = Carbon::create($tahun, $bulan, 1)->startOfDay();
        $akhirBulan = $awalBulan->copy()->endOfMonth()->endOfDay();
        $tanggalPiket = collect(CarbonPeriod::create($awalBulan, $akhirBulan))->values();
        $jadwal = JadwalPiketBulanan::with(['guru', 'waka'])
            ->whereBetween('tanggal', [$awalBulan->toDateString(), $akhirBulan->toDateString()])
            ->orderBy('tanggal')
            ->orderByRaw("FIELD(sesi, 'pagi','siang','waka')")
            ->orderBy('urutan')
            ->get();
        $jadwalPerTanggal = $jadwal->groupBy(fn (JadwalPiketBulanan $item) => $item->tanggal->format('Y-m-d'));

        return view('admin.tambah_piket', [
            'guru' => User::where('role', 'guru')->orderBy('name')->get(['id', 'name']),
            'wakas' => Waka::orderBy('nama')->get(),
            'jadwal' => $jadwal,
            'jadwalPerTanggal' => $jadwalPerTanggal,
            'tanggalPiket' => $tanggalPiket,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'namaBulan' => $this->namaBulan($bulan),
            'tahunPilihan' => range(now()->year - 2, now()->year + 3),
        ]);
    }

    public function storeWaka(Request $request): RedirectResponse
    {
        $data = $request->validate(['nama' => 'required|string|max:100']);
        Waka::create($data);

        return back()->with('success', 'Data Waka berhasil ditambahkan.');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer|between:2000,2100',
            'tanggal' => 'required|date_format:Y-m-d',
            'jadwal' => 'required|array',
            'jadwal.pagi' => 'required|array|size:3',
            'jadwal.pagi.*' => 'required|integer|exists:users,id',
            'jadwal.siang' => 'required|array|size:3',
            'jadwal.siang.*' => 'required|integer|exists:users,id',
            'jadwal.waka' => 'required|integer|exists:waka,id',
        ]);

        $tanggal = Carbon::createFromFormat('!Y-m-d', $data['tanggal']);
        if ($tanggal->month !== (int) $data['bulan'] || $tanggal->year !== (int) $data['tahun']) {
            return back()->withInput()->withErrors(['tanggal' => 'Pilih tanggal pada bulan dan tahun yang dipilih.']);
        }

        $guruIds = User::where('role', 'guru')->pluck('id')->map(fn ($id) => (int) $id)->all();
        foreach (['pagi', 'siang'] as $sesi) {
            $terpilih = $data['jadwal'][$sesi];
            if (count(array_unique(array_map('intval', $terpilih))) !== 3 || count(array_diff(array_map('intval', $terpilih), $guruIds))) {
                return back()->withInput()->withErrors(["jadwal.{$sesi}" => "Pilih 3 guru berbeda yang memiliki role Guru untuk sesi {$sesi} tanggal {$data['tanggal']}."]);
            }
        }

        $tanggalUji24Jam = in_array($data['tanggal'], ['2026-09-26', '2026-09-27'], true);
        $rentangSesi = $tanggalUji24Jam
            ? ['pagi' => ['00:00:00', '00:00:00'], 'siang' => ['00:00:00', '00:00:00']]
            : ['pagi' => ['07:00:00', '11:00:00'], 'siang' => ['11:00:00', '15:00:00']];

        DB::transaction(function () use ($data, $rentangSesi) {
            JadwalPiketBulanan::where('tanggal', $data['tanggal'])->delete();
            foreach ($rentangSesi as $sesi => [$mulai, $selesai]) {
                foreach ($data['jadwal'][$sesi] as $slot => $idGuru) {
                    JadwalPiketBulanan::create([
                        'tanggal' => $data['tanggal'],
                        'sesi' => $sesi,
                        'urutan' => $slot + 1,
                        'id_guru' => $idGuru,
                        'jam_mulai' => $mulai,
                        'jam_selesai' => $selesai,
                    ]);
                }
            }

            JadwalPiketBulanan::create([
                'tanggal' => $data['tanggal'],
                'sesi' => 'waka',
                'urutan' => 1,
                'id_waka' => $data['jadwal']['waka'],
            ]);
        });

        $pesan = 'Jadwal piket tanggal '.$tanggal->locale('id')->translatedFormat('d F Y').' berhasil disimpan.';
        if ($tanggalUji24Jam) {
            $pesan .= ' Mode testing aktif: sesi pagi dan siang berlaku 24 jam (00.00–24.00).';
        }

        return redirect()->route('admin.tambah.piket', ['bulan' => $data['bulan'], 'tahun' => $data['tahun']])
            ->with('success', $pesan);
    }

    public function import(Request $request): RedirectResponse
    {
        $request->validate(['file_jadwal' => 'required|file|mimes:xlsx,xls,csv,txt|max:5120']);
        $import = new JadwalPiketImport();
        Excel::import($import, $request->file('file_jadwal'));
        $rows = $import->rows ?? collect();
        if ($rows->isEmpty()) {
            return back()->withErrors(['file_jadwal' => 'File tidak memiliki baris data.']);
        }

        $guru = User::where('role', 'guru')->get()->keyBy(fn ($user) => Str::lower(trim($user->name)));
        $wakas = Waka::all()->keyBy(fn ($waka) => Str::lower(trim($waka->nama)));
        $items = [];
        $tanggalTerisi = [];
        $bulan = null;
        $tahun = null;

        foreach ($rows as $index => $row) {
            $rawTanggal = trim((string) ($row['tanggal'] ?? ''));
            try {
                $tanggal = Carbon::createFromFormat('!Y-m-d', $rawTanggal);
            } catch (\Throwable) {
                $tanggal = false;
            }
            if (! $tanggal || $tanggal->format('Y-m-d') !== $rawTanggal) {
                return back()->withErrors(['file_jadwal' => 'Tanggal pada baris '.($index + 2).' harus berformat YYYY-MM-DD.']);
            }

            if ($bulan === null) {
                $bulan = $tanggal->month;
                $tahun = $tanggal->year;
            } elseif ($tanggal->month !== $bulan || $tanggal->year !== $tahun) {
                return back()->withErrors(['file_jadwal' => 'Semua tanggal dalam file harus berada pada bulan yang sama.']);
            }

            $dateKey = $tanggal->toDateString();
            if (in_array($dateKey, $tanggalTerisi, true)) {
                return back()->withErrors(['file_jadwal' => 'Tanggal '.$dateKey.' muncul lebih dari sekali.']);
            }
            $tanggalTerisi[] = $dateKey;

            foreach (['pagi' => 'guru_pagi_', 'siang' => 'guru_siang_'] as $sesi => $prefix) {
                $guruSesi = [];
                for ($slot = 1; $slot <= 3; $slot++) {
                    $nama = Str::lower(trim((string) ($row[$prefix.$slot] ?? '')));
                    if (! $nama || ! $guru->has($nama)) {
                        return back()->withErrors(['file_jadwal' => 'Nama guru pada baris '.($index + 2).' tidak ditemukan.']);
                    }
                    $idGuru = (int) $guru[$nama]->id;
                    if (in_array($idGuru, $guruSesi, true)) {
                        return back()->withErrors(['file_jadwal' => 'Guru pada sesi yang sama harus berbeda di baris '.($index + 2).'.']);
                    }
                    $guruSesi[] = $idGuru;
                    $items[] = [
                        'tanggal' => $dateKey,
                        'sesi' => $sesi,
                        'urutan' => $slot,
                        'id_guru' => $idGuru,
                        'jam_mulai' => in_array($dateKey, ['2026-09-26', '2026-09-27'], true) ? '00:00:00' : ($sesi === 'pagi' ? '07:00:00' : '11:00:00'),
                        'jam_selesai' => in_array($dateKey, ['2026-09-26', '2026-09-27'], true) ? '00:00:00' : ($sesi === 'pagi' ? '11:00:00' : '15:00:00'),
                    ];
                }
            }

            $namaWaka = Str::lower(trim((string) ($row['waka'] ?? '')));
            if (! $namaWaka || ! $wakas->has($namaWaka)) {
                return back()->withErrors(['file_jadwal' => 'Nama Waka pada baris '.($index + 2).' tidak ditemukan. Tambahkan Waka terlebih dahulu.']);
            }
            $items[] = ['tanggal' => $dateKey, 'sesi' => 'waka', 'urutan' => 1, 'id_waka' => $wakas[$namaWaka]->id];
        }

        $tanggalWajib = $this->tanggalBulan((int) $bulan, (int) $tahun);
        if (array_diff($tanggalWajib, $tanggalTerisi) || array_diff($tanggalTerisi, $tanggalWajib)) {
            return back()->withErrors(['file_jadwal' => 'File harus memuat setiap tanggal pada bulan tersebut, termasuk akhir pekan.']);
        }

        DB::transaction(function () use ($tanggalWajib, $items) {
            JadwalPiketBulanan::whereIn('tanggal', $tanggalWajib)->delete();
            foreach ($items as $item) {
                JadwalPiketBulanan::create($item);
            }
        });

        return redirect()->route('admin.tambah.piket', ['bulan' => $bulan, 'tahun' => $tahun])->with('success', 'Jadwal piket berhasil diimpor per tanggal.');
    }

    /** @return array<int, string> */
    private function tanggalBulan(int $bulan, int $tahun): array
    {
        $awal = Carbon::create($tahun, $bulan, 1)->startOfDay();
        $akhir = $awal->copy()->endOfMonth();

        return collect(CarbonPeriod::create($awal, $akhir))
            ->map(fn (Carbon $tanggal) => $tanggal->toDateString())
            ->values()
            ->all();
    }

    private function namaBulan(int $bulan): string
    {
        return [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'][$bulan];
    }
}
