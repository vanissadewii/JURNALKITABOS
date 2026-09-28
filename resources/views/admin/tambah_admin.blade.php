<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>html{scrollbar-width:none}html::-webkit-scrollbar{display:none}</style>
</head>

<body class="min-h-screen overflow-x-hidden bg-[#F5EFE8] font-['Inter'] text-[#3E3028]">
    <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-black/40 md:hidden" onclick="closeSidebar()"></div>

    @include('admin.partials.tambah_sidebar')

    <main class="min-h-screen md:ml-[280px]">
        <header class="bg-[#5C4033] px-4 py-5 sm:px-6 md:px-7">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-[#D7B899]">Menu Tambah</p>
                    <h1 class="font-['Poppins'] text-xl font-bold text-white md:text-2xl">Tambah Admin</h1>
                </div>
                <button type="button" onclick="openSidebar()" class="flex h-10 w-10 items-center justify-center rounded-lg text-2xl text-white hover:bg-white/10 md:hidden">☰</button>
            </div>
        </header>

        <section class="flex flex-col gap-5 p-4 sm:p-6 md:p-7">
            <div>
                <h2 class="mt-1 font-['Poppins'] text-xl font-bold text-[#3E3028]">Buat akun admin baru</h2>
            </div>

            @if (session('success'))<div class="rounded-lg border border-[#B7DDBB] bg-[#E8F5E9] px-4 py-3 text-sm font-semibold text-[#2E7D32]">{{ session('success') }}</div>@endif
            @if (session('error'))<div class="rounded-lg border border-[#F0B8B8] bg-[#FFEBEE] px-4 py-3 text-sm text-[#C62828]">{{ session('error') }}</div>@endif
            @if ($errors->any())<div class="rounded-lg border border-[#F0B8B8] bg-[#FFEBEE] px-4 py-3 text-sm text-[#C62828]">{{ $errors->first() }}</div>@endif

            <div class="flex flex-col gap-5">
                <form id="adminForm" method="POST" action="{{ route('admin.tambah.admin.store') }}" class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                    @csrf
                    <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6">
                        <h3 class="font-['Poppins'] text-base font-bold text-[#3E3028]">Informasi Login</h3>
                        <p class="mt-1 text-xs text-[#7A6A60]">Akun ini akan digunakan untuk masuk ke halaman admin.</p>
                    </div>

                    <div class="p-5 sm:p-6">
                    <div class="flex flex-col gap-4">
                        <label class="flex flex-col gap-2"><span class="text-sm font-semibold text-[#3E3028]">Nama Admin</span><input name="name" value="{{ old('name') }}" type="text" required maxlength="255" placeholder="Contoh: Admin Sekolah" class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"></label>
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-semibold text-[#3E3028]">Username</span>
                            <input id="username" name="username" type="text" pattern="[A-Za-z0-9](?:[A-Za-z0-9._]*[A-Za-z0-9])?" title="Gunakan huruf, angka, titik, atau garis bawah. Titik dan garis bawah tidak boleh di awal atau akhir." data-username-input required placeholder="Contoh: admin_sekolah" class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
                        </label>
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-semibold text-[#3E3028]">Password</span>
                            <span class="relative block">
                                <input id="password" name="password" type="password" required minlength="8" placeholder="Minimal 8 karakter" class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 pr-12 text-sm outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
                                <button type="button" onclick="togglePasswordVisibility('password', this)" aria-label="Lihat password" aria-pressed="false" class="absolute inset-y-0 right-0 flex w-11 items-center justify-center text-[#7A6A60] hover:text-[#5C4033]">
                                    <svg data-eye-open class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
                                    <svg data-eye-closed class="hidden h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true"><path d="m3 3 18 18M10.6 10.6a2 2 0 0 0 2.8 2.8"/><path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6.4 0 10 7 10 7a15 15 0 0 1-3.2 4.1M6.2 6.3C3.5 8.1 2 12 2 12s3.6 7 10 7c1 0 2-.2 2.9-.5"/></svg>
                                </button>
                            </span>
                        </label>
                    </div>

                    <div class="mt-6 flex flex-col-reverse gap-2 border-t border-[#E5D8CC] pt-5 sm:flex-row sm:justify-end">
                        <button type="submit" class="rounded-lg bg-[#5C4033] px-4 py-2.5 text-sm font-semibold text-white hover:bg-[#452F26]">Simpan Admin</button>
                    </div>
                    </div>
                </form>
            </div>

            <div class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="flex flex-col justify-between gap-3 border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:flex-row sm:items-center sm:px-6">
                    <div>
                        <h3 class="font-['Poppins'] text-base font-bold text-[#3E3028]">Admin Terdaftar</h3>
                        <p class="mt-1 text-xs text-[#7A6A60]">Daftar akun admin yang tersimpan.</p>
                    </div>
                    <span class="w-fit rounded-md bg-[#E8F5E9] px-2.5 py-1 text-[11px] font-bold text-[#2E7D32]">{{ $admins->count() }} Admin</span>
                </div>

                <div class="p-4 sm:p-5 overflow-x-auto">
                    <table class="w-full min-w-[720px] border border-[#E5D8CC] text-left text-sm">
                        <thead class="border-b border-[#E5D8CC] text-[11px] uppercase tracking-wider text-[#7A6A60]">
                            <tr>
                                <th class="px-3 py-3 font-semibold">Nama</th>
                                <th class="border-l border-[#E5D8CC] px-3 py-3 font-semibold">Username</th>
                                <th class="border-l border-[#E5D8CC] px-3 py-3 font-semibold">Status</th>
                                <th class="px-3 py-3 font-semibold">Tanggal dibuat</th>
                                <th class="px-3 py-3 text-right font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $admin)
                                <tr>
                                    <td class="border-b border-[#E5D8CC] px-3 py-3 font-semibold text-[#3E3028]">{{ $admin->name }}</td>
                                    <td class="border-b border-l border-[#E5D8CC] px-3 py-3 font-medium">{{ $admin->username }}</td>
                                    <td class="border-b border-l border-[#E5D8CC] px-3 py-3"><span class="rounded-md {{ $admin->status === 'aktif' ? 'bg-[#E8F5E9] text-[#2E7D32]' : 'bg-[#F5EFE8] text-[#7A6A60]' }} px-2 py-1 text-[11px] font-bold">{{ ucfirst($admin->status) }}</span></td>
                                    <td class="border-b border-l border-[#E5D8CC] px-3 py-3 text-[#7A6A60]">{{ $admin->created_at?->locale('id')->translatedFormat('d F Y') ?? '—' }}</td>
                                    <td class="border-b border-l border-[#E5D8CC] px-3 py-3"><div class="flex justify-end"><form method="POST" action="{{ route('admin.tambah.admin.destroy', $admin) }}" onsubmit="return confirm('Hapus akun admin {{ addslashes($admin->username) }}?')">@csrf @method('DELETE')<button type="submit" @disabled((int)$admin->id === (int)auth()->id()) class="rounded-full border border-[#F0B8B8] px-3 py-1 text-xs font-semibold text-[#C62828] hover:bg-[#FFEBEE] disabled:cursor-not-allowed disabled:opacity-40" title="{{ (int)$admin->id === (int)auth()->id() ? 'Akun yang sedang login tidak bisa dihapus' : 'Hapus admin' }}">Hapus</button></form></div></td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-3 py-10 text-center text-sm text-[#7A6A60]">Belum ada akun admin.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <div id="logoutModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/40 px-4" onclick="closeLogoutModal(event)">
        <div class="w-full max-w-sm rounded-xl bg-white p-5 shadow-xl" role="dialog" aria-modal="true" onclick="event.stopPropagation()">
            <h2 class="font-['Poppins'] text-lg font-bold">Yakin ingin logout?</h2>
            <p class="mt-2 text-sm text-[#7A6A60]">Anda akan keluar dari akun admin.</p>
            <div class="mt-5 flex justify-end gap-2">
                <button type="button" onclick="closeLogoutModal()" class="rounded-lg px-4 py-2 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Batal</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-lg bg-[#C62828] px-4 py-2 text-sm font-semibold text-white hover:bg-[#A51F1F]">Ya, Logout</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-username-input]').forEach(input => input.addEventListener('input', () => { input.value = input.value.replace(/\s+/g, '_'); }));

        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.remove('hidden');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.add('hidden');
        }

        // Menutup submenu "Tambah" saat salah satu item submenu diklik.
        // Penanda aktif tetap muncul karena mengikuti kondisi route (Blade),
        // bukan status buka/tutup <details> ini.
        function closeTambahMenu() {
            const menu = document.getElementById('tambahMenu');
            if (menu) {
                menu.open = false;
            }
        }

        function openLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeLogoutModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('logoutModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function updatePasswordEye(inputId, visible) {
            const input = document.getElementById(inputId);
            const button = document.querySelector(`[onclick="togglePasswordVisibility('${inputId}', this)"]`);
            if (!input || !button) return;
            input.type = visible ? 'text' : 'password';
            button.setAttribute('aria-pressed', String(visible));
            button.setAttribute('aria-label', visible ? 'Sembunyikan password' : 'Lihat password');
            button.querySelector('[data-eye-open]').classList.toggle('hidden', visible);
            button.querySelector('[data-eye-closed]').classList.toggle('hidden', !visible);
        }

        function togglePasswordVisibility(inputId, button) {
            const visible = document.getElementById(inputId).type === 'password';
            document.getElementById(inputId).type = visible ? 'text' : 'password';
            button.setAttribute('aria-pressed', String(visible));
            button.setAttribute('aria-label', visible ? 'Sembunyikan password' : 'Lihat password');
            button.querySelector('[data-eye-open]').classList.toggle('hidden', visible);
            button.querySelector('[data-eye-closed]').classList.toggle('hidden', !visible);
        }


    </script>
</body>

</html>