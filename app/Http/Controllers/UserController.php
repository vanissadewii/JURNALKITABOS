<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with('kelas')->latest()->get();
        $kelas = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();

        // Ganti 'admin.user' menjadi 'admin.tambah_user'
        return view('admin.tambah_user', compact('users', 'kelas'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|min:8',
            'role' => 'required|in:kelas,guru,guru_piket,admin',
            'no_telepon' => 'nullable|string|max:20',
            'status' => 'required|in:aktif,nonaktif,pending',
            'id_kelas' => 'nullable|exists:kelas,id_kelas',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        // Buatkan email dummy otomatis agar tidak kena error NULL di database
        $validated['email'] = strtolower(trim($validated['username'])).'@jurnalkitabos.local';

        User::create($validated);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan.');
    }
}
