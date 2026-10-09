<?php

namespace App\Http\Controllers;

use App\Models\JamPelajaran;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class JamPelajaranController extends Controller
{
    public function index(): View
    {
        $semesterAktif = Semester::where('status', 'aktif')->first();

        $jamPelajaran = $semesterAktif
            ? JamPelajaran::with('semester')
                ->where('id_semester', $semesterAktif->id_semester)
                ->orderBy('tingkat')
                ->orderBy('hari')
                ->orderBy('jam_ke')
                ->get()
            : collect();

        $urutanHari = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6, 'Minggu' => 7];

        $jamGrup = $jamPelajaran
            ->groupBy(fn ($j) => "{$j->hari}|{$j->jam_ke}|{$j->jam_mulai}|{$j->jam_selesai}")
            ->map(function ($items) use ($urutanHari) {
                $first = $items->first();
                $nomor = $items->pluck('hari')->map(fn ($h) => $urutanHari[$h])->sort()->values();
                $tingkat = $items->pluck('tingkat')->map(fn ($nilai) => (string) $nilai)->unique()->sort()->values();

                return (object) [
                    'semester' => $first->semester,
                    'tingkat' => $tingkat->implode(' & '),
                    'tingkat_cari' => $tingkat->implode(' '),
                    'jam_ke' => $first->jam_ke,
                    'jam_mulai' => substr($first->jam_mulai, 0, 5),
                    'jam_selesai' => substr($first->jam_selesai, 0, 5),
                    'hari' => $first->hari,
                    'id_jam' => $first->id_jam,
                    'urutan' => $nomor->first(),
                ];
            })
            ->sortBy([['urutan', 'asc'], ['jam_ke', 'asc']])
            ->values();

        $pengaturanKegiatan = DB::table('pengaturan_kegiatan_harian')->pluck('kegiatan_ditiadakan', 'hari')->all();
        $kegiatanTanggal = Schema::hasTable('pengaturan_kegiatan_tanggal')
            ? DB::table('pengaturan_kegiatan_tanggal')->orderByDesc('tanggal')->get()
            : collect();

        return view('admin.tambah_jam_pelajaran', compact('jamPelajaran', 'jamGrup', 'semesterAktif', 'pengaturanKegiatan', 'kegiatanTanggal'));
    }

    public function create(): View
    {
        $semesterAktif = Semester::where('status', 'aktif')->first();

        $pengaturanKegiatan = DB::table('pengaturan_kegiatan_harian')->pluck('kegiatan_ditiadakan', 'hari')->all();
        $kegiatanTanggal = Schema::hasTable('pengaturan_kegiatan_tanggal')
            ? DB::table('pengaturan_kegiatan_tanggal')->orderByDesc('tanggal')->get()
            : collect();

        return view('admin.tambah_jam_pelajaran', compact('semesterAktif', 'pengaturanKegiatan', 'kegiatanTanggal'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tingkat' => 'required|in:10,11,12',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_ke' => 'required|integer|min:1',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => ['required', 'date_format:H:i', function ($attribute, $value, $fail) use ($request) {
                if ($value !== '00:00' && $value <= $request->input('jam_mulai')) {
                    $fail('Jam selesai harus setelah jam mulai; 00:00 diperbolehkan sebagai tengah malam.');
                }
            }],
        ]);

        if (in_array($validated['hari'], ['Sabtu', 'Minggu'], true) && (int) $validated['tingkat'] !== 11) {
            return back()->withInput()->withErrors(['hari' => 'Hari Sabtu dan Minggu untuk uji coba hanya tersedia pada tingkat XI.']);
        }

        $semesterAktif = Semester::where('status', 'aktif')->firstOrFail();

        $sudahAda = JamPelajaran::where('id_semester', $semesterAktif->id_semester)
            ->where('tingkat', $validated['tingkat'])
            ->where('hari', $validated['hari'])
            ->where('jam_ke', $validated['jam_ke'])
            ->exists();

        if ($sudahAda) {
            return redirect()->back()->withInput()->withErrors([
                'jam_ke' => "Jam ke-{$validated['jam_ke']} hari {$validated['hari']} sudah ada. Jam lama tidak diubah; tambahkan nomor jam berikutnya.",
            ]);
        }

        JamPelajaran::create([
            'id_semester' => $semesterAktif->id_semester,
            'tingkat' => $validated['tingkat'],
            'hari' => $validated['hari'],
            'jam_ke' => $validated['jam_ke'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
        ]);

        return redirect()->back()->with('success', 'Jam pelajaran baru berhasil ditambahkan. Jam yang sudah ada tetap.');
    }

    public function updateKegiatan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hari' => ['required', 'in:Senin,Jumat'],
            'kegiatan_ditiadakan' => ['required', 'boolean'],
            'gabungan' => ['nullable', 'boolean'],
        ]);
        $hariYangDiubah = ($validated['gabungan'] ?? false) ? ['Senin', 'Jumat'] : [$validated['hari']];
        foreach ($hariYangDiubah as $hari) {
            $pengaturan = DB::table('pengaturan_kegiatan_harian')->where('hari', $hari);
            if ($pengaturan->exists()) {
                $pengaturan->update(['kegiatan_ditiadakan' => (bool) $validated['kegiatan_ditiadakan'], 'updated_at' => now()]);
            } else {
                DB::table('pengaturan_kegiatan_harian')->insert([
                    'hari' => $hari,
                    'kegiatan_ditiadakan' => (bool) $validated['kegiatan_ditiadakan'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $pesan = ($validated['gabungan'] ?? false)
            ? ((bool) $validated['kegiatan_ditiadakan'] ? 'Jam pelajaran maju diaktifkan untuk Senin dan Jumat.' : 'Jam pelajaran maju dinonaktifkan untuk Senin dan Jumat.')
            : ((bool) $validated['kegiatan_ditiadakan'] ? "Kegiatan {$validated['hari']} ditandai ditiadakan. Jadwal guru hari itu dimajukan satu jam." : "Kegiatan {$validated['hari']} diaktifkan kembali. Jadwal guru kembali normal.");

        return redirect()->route('jam-pelajaran.index')->with('success', $pesan);
    }

    public function storeKegiatanTanggal(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date_format:Y-m-d', 'unique:pengaturan_kegiatan_tanggal,tanggal'],
            'nama_kegiatan' => ['required', 'string', 'max:120'],
        ], [
            'tanggal.unique' => 'Tanggal tersebut sudah terdaftar. Gunakan tombol ON/OFF pada daftar kegiatan.',
        ]);

        DB::table('pengaturan_kegiatan_tanggal')->insert([
            ...$validated,
            'kegiatan_ditiadakan' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('jam-pelajaran.index')->with('success', 'Jadwal pelajaran tanggal '.Carbon::parse($validated['tanggal'])->format('d/m/Y')." dimatikan untuk kegiatan {$validated['nama_kegiatan']}.");
    }

    public function toggleKegiatanTanggal(int $id): RedirectResponse
    {
        $kegiatan = DB::table('pengaturan_kegiatan_tanggal')->where('id', $id)->firstOrFail();
        $aktif = ! (bool) $kegiatan->kegiatan_ditiadakan;

        DB::table('pengaturan_kegiatan_tanggal')->where('id', $id)->update([
            'kegiatan_ditiadakan' => $aktif,
            'updated_at' => now(),
        ]);

        return redirect()->route('jam-pelajaran.index')->with('success', $aktif
            ? 'Jadwal tanggal '.Carbon::parse($kegiatan->tanggal)->format('d/m/Y')." dimatikan untuk {$kegiatan->nama_kegiatan}."
            : 'Jadwal tanggal '.Carbon::parse($kegiatan->tanggal)->format('d/m/Y').' diaktifkan kembali.');
    }

    public function destroyKegiatanTanggal(int $id): RedirectResponse
    {
        DB::table('pengaturan_kegiatan_tanggal')->where('id', $id)->delete();

        return redirect()->route('jam-pelajaran.index')->with('success', 'Pengaturan kegiatan tanggal berhasil dihapus.');
    }

    public function generate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tingkat' => 'required|array|min:1',
            'tingkat.*' => 'required|in:10,11,12',
            'hari' => 'required|array|min:1',
            'hari.*' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'durasi_menit' => 'required|integer|min:1',
            'jumlah_jam' => 'required|integer|min:1',
            'jam_ke_mulai' => 'required|integer|min:1',
        ]);

        if (array_intersect($validated['hari'], ['Sabtu', 'Minggu']) && (array_values(array_unique(array_map('intval', $validated['tingkat']))) !== [11])) {
            return back()->withInput()->withErrors(['hari' => 'Untuk akhir pekan, pilih tingkat XI saja.']);
        }

        $semesterAktif = Semester::where('status', 'aktif')->firstOrFail();

        $durasiMenit = (int) $validated['durasi_menit'];
        $jumlahJam = (int) $validated['jumlah_jam'];
        $jamKeMulai = (int) $validated['jam_ke_mulai'];

        $ditambahkan = 0;
        $dilewati = 0;
        foreach ($validated['tingkat'] as $tingkat) {
            foreach ($validated['hari'] as $hari) {
                $waktu = Carbon::createFromFormat('H:i', $validated['jam_mulai']);

                for ($i = 0; $i < $jumlahJam; $i++) {
                    $mulai = $waktu->copy();
                    $selesai = $waktu->copy()->addMinutes($durasiMenit);
                    $jamKe = $jamKeMulai + $i;
                    $sudahAda = JamPelajaran::where('id_semester', $semesterAktif->id_semester)
                        ->where('tingkat', $tingkat)
                        ->where('hari', $hari)
                        ->where('jam_ke', $jamKe)
                        ->exists();

                    if ($sudahAda) {
                        $dilewati++;
                    } else {
                        JamPelajaran::create([
                            'id_semester' => $semesterAktif->id_semester,
                            'tingkat' => $tingkat,
                            'hari' => $hari,
                            'jam_ke' => $jamKe,
                            'jam_mulai' => $mulai->format('H:i'),
                            'jam_selesai' => $selesai->format('H:i'),
                        ]);
                        $ditambahkan++;
                    }

                    $waktu = $selesai;
                }
            }
        }

        return redirect()->back()->with('success', "{$ditambahkan} jam baru ditambahkan; {$dilewati} jam yang sudah ada dilewati tanpa diubah.");
    }

    public function edit($id): View
    {
        $jamPelajaran = JamPelajaran::findOrFail($id);

        return view('admin.edit_jam_pelajaran', compact('jamPelajaran'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $jamPelajaran = JamPelajaran::findOrFail($id);

        $validated = $request->validate([
            'tingkat' => 'required|in:10,11,12',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_ke' => 'required|integer|min:1',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => ['required', 'date_format:H:i', function ($attribute, $value, $fail) use ($request) {
                if ($value !== '00:00' && $value <= $request->input('jam_mulai')) {
                    $fail('Jam selesai harus setelah jam mulai; 00:00 diperbolehkan sebagai tengah malam.');
                }
            }],
        ]);

        if (in_array($validated['hari'], ['Sabtu', 'Minggu'], true) && (int) $validated['tingkat'] !== 11) {
            return back()->withInput()->withErrors(['hari' => 'Hari Sabtu dan Minggu hanya tersedia pada tingkat XI.']);
        }

        $jamPelajaran->update($validated);

        return redirect()->route('jam-pelajaran.index')->with('success', 'Jam pelajaran berhasil diperbarui.');
    }

    public function destroy($id): RedirectResponse
    {
        JamPelajaran::findOrFail($id)->delete();

        return redirect()->route('jam-pelajaran.index')->with('success', 'Jam pelajaran berhasil dihapus.');
    }

    public function bulkUpdate(Request $request): RedirectResponse
    {
        $ids = $request->input('pilih', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada baris yang dipilih untuk disimpan.');
        }

        $rows = $request->input('rows', []);
        $diperbarui = 0;

        foreach ($ids as $id) {
            if (! isset($rows[$id])) {
                continue;
            }

            $validator = validator($rows[$id], [
                'tingkat' => 'required|in:10,11,12',
                'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
                'jam_ke' => 'required|integer|min:1',
                'jam_mulai' => 'required|date_format:H:i',
                'jam_selesai' => ['required', 'date_format:H:i', function ($attribute, $value, $fail) use ($rows, $id) {
                    $mulai = $rows[$id]['jam_mulai'] ?? '';
                    if ($value !== '00:00' && $value <= $mulai) {
                        $fail('Jam selesai harus setelah jam mulai; 00:00 diperbolehkan sebagai tengah malam.');
                    }
                }],
            ]);

            if ($validator->fails()) {
                continue;
            }
            $barisValid = $validator->validated();
            if (in_array($barisValid['hari'], ['Sabtu', 'Minggu'], true) && (int) $barisValid['tingkat'] !== 11) {
                continue;
            }

            $jam = JamPelajaran::find($id);

            if ($jam) {
                $jam->update($barisValid);
                $diperbarui++;
            }
        }

        return redirect()->route('jam-pelajaran.index')->with('success', "{$diperbarui} jam pelajaran berhasil diperbarui.");
    }

    public function bulkDestroy(Request $request): RedirectResponse
    {
        $ids = $request->input('pilih', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada baris yang dipilih untuk dihapus.');
        }

        $keyName = (new JamPelajaran)->getKeyName();

        $jumlah = JamPelajaran::whereIn($keyName, $ids)->delete();

        return redirect()->route('jam-pelajaran.index')->with('success', "{$jumlah} jam pelajaran berhasil dihapus.");
    }

    /** @return array<int, string> */
    private function daftarHari(string $kelompok): array
    {
        return match ($kelompok) {
            'senin_kamis' => ['Senin', 'Selasa', 'Rabu', 'Kamis'],
            'jumat' => ['Jumat'],
            'senin_jumat' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
        };
    }
}
