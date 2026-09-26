<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index(Request $request): View
    {
        $query = Siswa::with('kelas');

        if ($request->filled('tingkat')) {
            $query->whereHas('kelas', fn ($kelasQuery) => $kelasQuery->where('tingkat', $request->input('tingkat')));
        }

        if ($request->filled('rombel')) {
            $query->whereHas('kelas', fn ($kelasQuery) => $kelasQuery->where('rombel', $request->input('rombel')));
        }

        if ($request->filled('q')) {
            $terms = preg_split('/\s+/', trim((string) $request->input('q')), -1, PREG_SPLIT_NO_EMPTY);
            if (count($terms) > 1) {
                $terms = array_values(array_diff($terms, ['nama', 'mata', 'pelajaran', 'kode', 'tingkat', 'kelas', 'jurusan', 'rombel', 'hari', 'jam', 'semester', 'status', 'role', 'username', 'telepon', 'absen', 'no']));
            }
            if ($terms === []) {
                $terms = [trim((string) $request->input('q'))];
            }
            $query->where(function ($siswaQuery) use ($terms) {
                foreach ($terms as $term) {
                    $like = "%{$term}%";
                    $tingkat = match (strtoupper($term)) {
                        'X' => '10',
                        'XI' => '11',
                        'XII' => '12',
                        default => $term,
                    };
                    $siswaQuery->where(function ($fields) use ($like, $tingkat) {
                        $fields->where('nama', 'like', $like)
                            ->orWhere('no_absen', 'like', $like)
                            ->orWhereHas('kelas', function ($kelasQuery) use ($like, $tingkat) {
                                $kelasQuery->where('tingkat', 'like', $tingkat)
                                    ->orWhere('jurusan', 'like', $like)
                                    ->orWhere('rombel', 'like', $like);
                            });
                    });
                }
            });
        }

        $siswas = $query->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->select('siswa.*')
            ->orderBy('kelas.tingkat')
            ->orderBy('kelas.jurusan')
            ->orderBy('kelas.rombel')
            ->orderBy('siswa.no_absen')
            ->orderBy('siswa.nama')
            ->with('kelas')
            ->paginate(15)
            ->withQueryString();

        $kelases = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();

        return view('admin.tambah_siswa', compact('siswas', 'kelases'));
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('admin.siswa.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'no_absen' => ['nullable', 'integer', 'min:1'],
            'id_kelas' => ['required', 'exists:kelas,id_kelas'],
        ]);

        $nomorAbsen = $request->input('no_absen') ?: (Siswa::where('id_kelas', $request->id_kelas)->max('no_absen') ?? 0) + 1;

        Siswa::create([
            'nama' => $request->nama,
            'no_absen' => $nomorAbsen,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
    }

    public function destroy(Siswa $siswa): RedirectResponse
    {
        $namaSiswa = $siswa->nama;
        $siswa->delete();

        return back()->with('success', "Data siswa {$namaSiswa} berhasil dihapus.");
    }

    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'file_excel' => ['required', 'mimes:xlsx,xls,csv'],
        ]);

        $import = new SiswaImport;
        Excel::import($import, $request->file('file_excel'));

        $failures = $import->failures();
        if ($failures->count() > 0) {
            $pesan = $failures->map(function ($failure) {
                return "Baris {$failure->row()}: ".implode(', ', $failure->errors());
            })->implode(' | ');

            return redirect()->route('admin.siswa.index')->with('error', "Sebagian data gagal diimport: {$pesan}");

        }

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diimport!');

    }
}
