<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MasterKelasController extends Controller
{
    public function index(): View
    {
        $kelases = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();

        return view('admin.tambah_kelas', compact('kelases') + ['editKelas' => null]);
    }

    public function create(): View
    {
        $kelases = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();

        return view('admin.tambah_kelas', compact('kelases') + ['editKelas' => null]);
    }

    public function edit(int $id): View
    {
        $kelases = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();
        $editKelas = Kelas::findOrFail($id);

        return view('admin.tambah_kelas', compact('kelases', 'editKelas'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $kelas = Kelas::findOrFail($id);
        $validated = $request->validate([
            'tingkat' => ['required', 'integer', Rule::in([10, 11, 12])],
            'jurusan' => ['required', 'string', 'max:50'],
            'rombel' => [
                'required', 'integer', 'min:1',
                Rule::unique('kelas')->where(fn ($query) => $query
                    ->where('tingkat', $request->tingkat)
                    ->where('jurusan', $request->jurusan))
                    ->ignore($kelas->id_kelas, 'id_kelas'),
            ],
        ]);

        $kelas->update($validated);

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $kelas = Kelas::findOrFail($id);
        $referensi = [
            'siswa' => 'data siswa',
            'jadwal_pelajaran' => 'jadwal pelajaran',
            'dispens' => 'data dispensasi',
            'pengiriman_jurnal_kelas' => 'pengiriman jurnal',
            'users' => 'akun pengguna',
        ];

        foreach ($referensi as $table => $label) {
            if (DB::table($table)->where('id_kelas', $kelas->id_kelas)->exists()) {
                return redirect()->route('admin.kelas.index')
                    ->with('warning', "Kelas {$kelas->nama_kelas} masih digunakan oleh {$label} dan tidak dapat dihapus.");
            }
        }

        $kelas->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'tingkat' => ['required', 'integer', Rule::in([10, 11, 12])],
            'jurusan' => ['required', 'string', 'max:50'],
            'rombel' => [
                'required', 'integer', 'min:1',
                Rule::unique('kelas')->where(function ($query) use ($request) {
                    return $query->where('tingkat', $request->tingkat)
                        ->where('jurusan', $request->jurusan);
                }),
            ],
        ]);

        Kelas::create([
            'tingkat' => $request->tingkat,
            'jurusan' => $request->jurusan,
            'rombel' => $request->rombel,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
    }
}
