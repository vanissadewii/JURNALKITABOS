<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAccountController extends Controller
{
    public function index(): View
    {
        $admins = User::where('role', 'admin')->orderBy('name')->get();

        return view('admin.tambah_admin', compact('admins'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([...$data, 'role' => 'admin', 'status' => 'aktif']);

        return redirect()->route('admin.tambah.admin')->with('success', 'Akun admin berhasil ditambahkan.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        abort_unless($user->role === 'admin', 404);
        if ((int) $user->id === (int) $request->user()->id) {
            return back()->with('error', 'Akun admin yang sedang digunakan tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()->route('admin.tambah.admin')->with('success', 'Akun admin berhasil dihapus.');
    }
}
