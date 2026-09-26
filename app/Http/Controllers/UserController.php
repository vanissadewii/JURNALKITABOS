<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Validation\Rule;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::with(['kelas', 'ketuaKelas', 'sekretarisPertama', 'sekretarisKedua'])->whereIn('role', ['guru', 'kelas']);
        $role = $request->input('role');
        $kataKunci = trim((string) $request->input('q', ''));

        if (in_array($role, ['guru', 'kelas'], true)) {
            $query->where('role', $role);
        }

        if ($kataKunci !== '') {
            $terms = preg_split('/\s+/', $kataKunci, -1, PREG_SPLIT_NO_EMPTY);
            if (count($terms) > 1) {
                $terms = array_values(array_diff($terms, ['nama', 'mata', 'pelajaran', 'kode', 'tingkat', 'kelas', 'jurusan', 'rombel', 'hari', 'jam', 'semester', 'status', 'role', 'username', 'telepon', 'nisn', 'absen', 'no']));
            }
            if ($terms === []) {
                $terms = [$kataKunci];
            }
            $query->where(function ($userQuery) use ($terms) {
                foreach ($terms as $term) {
                    $like = "%{$term}%";
                    $tingkat = match (strtoupper($term)) {
                        'X' => '10',
                        'XI' => '11',
                        'XII' => '12',
                        default => $term,
                    };
                    $userQuery->where(function ($fields) use ($like, $tingkat) {
                        $fields->where('name', 'like', $like)
                            ->orWhere('username', 'like', $like)
                            ->orWhere('no_telepon', 'like', $like)
                            ->orWhere('role', 'like', $like)
                            ->orWhere('status', 'like', $like)
                            ->orWhereHas('kelas', function ($kelasQuery) use ($like, $tingkat) {
                                $kelasQuery->where('tingkat', 'like', $tingkat)
                                    ->orWhere('jurusan', 'like', $like)
                                    ->orWhere('rombel', 'like', $like);
                            });
                    });
                }
            });
        }

        $users = $query->orderByRaw("CASE role WHEN 'guru' THEN 1 WHEN 'kelas' THEN 2 ELSE 3 END")
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();
        $kelas = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();
        $siswa = Siswa::with('kelas')->orderBy('nama')->get(['id_siswa', 'nama', 'no_absen', 'id_kelas']);
        $jumlahGuru = User::where('role', 'guru')->count();
        $jumlahKelas = User::where('role', 'kelas')->count();

        return view('admin.tambah_user', compact('users', 'kelas', 'siswa', 'jumlahGuru', 'jumlahKelas'));
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('admin.user.index');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        abort_if($user->role === 'admin', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username,'.$user->id],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', 'in:kelas,guru'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'in:aktif,nonaktif,pending'],
            'id_kelas' => ['nullable', 'exists:kelas,id_kelas', 'required_if:role,kelas'],
            'id_ketua_kelas' => ['nullable', 'integer', ...($request->input('role') === 'kelas' ? [Rule::exists('siswa', 'id_siswa')->where('id_kelas', $request->input('id_kelas'))] : [])],
            'id_sekretaris_1' => ['nullable', 'integer', ...($request->input('role') === 'kelas' ? [Rule::exists('siswa', 'id_siswa')->where('id_kelas', $request->input('id_kelas'))] : [])],
            'id_sekretaris_2' => ['nullable', 'integer', ...($request->input('role') === 'kelas' ? [Rule::exists('siswa', 'id_siswa')->where('id_kelas', $request->input('id_kelas'))] : [])],
        ]);

        if ($validated['role'] === 'kelas') {
            $selectedOfficers = array_filter([$validated['id_ketua_kelas'] ?? null, $validated['id_sekretaris_1'] ?? null, $validated['id_sekretaris_2'] ?? null]);
            if (count($selectedOfficers) !== count(array_unique($selectedOfficers))) {
                return back()->withInput()->withErrors(['id_ketua_kelas' => 'Pilih siswa yang berbeda untuk setiap jabatan.']);
            }
        }

        if (empty($validated['password'])) {
            unset($validated['password']);
        }
        if ($validated['role'] !== 'kelas') {
            $validated['id_kelas'] = null;
            $validated['id_ketua_kelas'] = null;
            $validated['id_sekretaris_1'] = null;
            $validated['id_sekretaris_2'] = null;
        } else {
            $validated['nama_ketua_kelas'] = null;
            $validated['nama_sekretaris'] = null;
            $validated['nama_sekretaris_2'] = null;
        }
        $user->update($validated);

        return redirect()->route('admin.user.index', array_filter([
            'q' => $request->input('filter_q'), 'role' => $request->input('filter_role'), 'page' => $request->input('filter_page'),
        ], fn ($value) => $value !== null && $value !== ''))
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        abort_if($user->role === 'admin', 404);

        if ((int) $user->id === (int) $request->user()->id) {
            return back()->with('error', 'Akun yang sedang digunakan tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()->route('admin.user.index', array_filter([
            'q' => $request->input('filter_q'), 'role' => $request->input('filter_role'), 'page' => $request->input('filter_page'),
        ], fn ($value) => $value !== null && $value !== ''))
            ->with('success', 'User berhasil dihapus.');
    }

    public function import(Request $request): RedirectResponse
    {
        $request->validate(['file_user' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:5120']]);

        $import = new UserImport;
        Excel::import($import, $request->file('file_user'));
        $failures = $import->failures();

        if ($failures->isNotEmpty()) {
            $pesan = $failures->take(5)->map(fn ($failure) => 'Baris '.$failure->row().': '.implode(', ', $failure->errors()))->implode(' | ');
            return redirect()->route('admin.user.index')->with('error', 'Sebagian baris tidak dapat diimpor. '.$pesan);
        }

        return redirect()->route('admin.user.index')->with('success', 'Data user berhasil diimpor dari file.');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|min:8',
            'role' => 'required|in:kelas,guru',
            'no_telepon' => 'nullable|string|max:20',
            'status' => 'required|in:aktif,nonaktif,pending',
            'id_kelas' => 'nullable|exists:kelas,id_kelas',
            'id_ketua_kelas' => ['nullable', 'integer', ...($request->input('role') === 'kelas' ? [Rule::exists('siswa', 'id_siswa')->where('id_kelas', $request->input('id_kelas'))] : [])],
            'id_sekretaris_1' => ['nullable', 'integer', ...($request->input('role') === 'kelas' ? [Rule::exists('siswa', 'id_siswa')->where('id_kelas', $request->input('id_kelas'))] : [])],
            'id_sekretaris_2' => ['nullable', 'integer', ...($request->input('role') === 'kelas' ? [Rule::exists('siswa', 'id_siswa')->where('id_kelas', $request->input('id_kelas'))] : [])],
        ]);

        if ($validated['role'] === 'kelas') {
            $selectedOfficers = array_filter([$validated['id_ketua_kelas'] ?? null, $validated['id_sekretaris_1'] ?? null, $validated['id_sekretaris_2'] ?? null]);
            if (count($selectedOfficers) !== count(array_unique($selectedOfficers))) {
                return back()->withInput()->withErrors(['id_ketua_kelas' => 'Pilih siswa yang berbeda untuk setiap jabatan.']);
            }
        }

        if ($validated['role'] !== 'kelas') {
            $validated['id_kelas'] = null;
            $validated['id_ketua_kelas'] = null;
            $validated['id_sekretaris_1'] = null;
            $validated['id_sekretaris_2'] = null;
        } else {
            $validated['nama_ketua_kelas'] = null;
            $validated['nama_sekretaris'] = null;
            $validated['nama_sekretaris_2'] = null;
        }

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan.');
    }
}
