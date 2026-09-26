<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>html{scrollbar-width:none}html::-webkit-scrollbar{display:none}</style>
</head>

<body class="min-h-screen overflow-x-hidden bg-[#F5EFE8] font-['Inter'] text-[#3E3028]">
    <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-black/40 md:hidden" onclick="closeSidebar()"></div>

    <aside id="sidebar" class="fixed left-0 top-0 z-50 flex h-full w-[280px] -translate-x-full flex-col border-r border-[#E5D8CC] bg-white transition-transform duration-300 md:translate-x-0">
        <div class="px-5 pb-5 pt-6">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#5C4033]">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="font-['Poppins'] text-[15px] font-bold leading-tight text-[#5C4033]">JURNAL GURU</h1>
                    <p class="mt-0.5 text-[11px] text-[#A08978]">Admin Sekolah</p>
                </div>
            </div>
        </div>

        <div class="mx-5 border-t border-[#E5D8CC]"></div>

        <nav class="flex-1 overflow-y-auto py-4 px-3 flex flex-col">

            <p class="px-3.5 mb-2 text-[14px] font-semibold uppercase tracking-wider text-[#5C4033]">
                Menu Utama
            </p>


            <div class="flex flex-col gap-0.5">

                {{-- BERANDA --}}
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.dashboard') ? 'font-semibold bg-[#5C4033] text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                >

                    <svg
                        class="w-[18px] h-[18px] shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M3 12l9-9 9 9"/>
                        <path d="M5 10v10h14V10"/>
                    </svg>

                    Beranda

                </a>


                {{-- KEHADIRAN GURU --}}
                <a
                    href="{{ route('admin.kehadiran') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.kehadiran') ? 'font-semibold bg-[#5C4033] text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                >

                    <svg
                        class="w-[18px] h-[18px] shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <path d="M16 2v4M8 2v4M3 10h18"/>
                    </svg>

                    Kehadiran Guru

                </a>


                {{-- JURNAL --}}
                <a
                    href="{{ route('admin.jurnal') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.jurnal') ? 'font-semibold bg-[#5C4033] text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                >

                    <svg
                        class="w-[18px] h-[18px] shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>

                    Jurnal

                </a>


                {{-- LIHAT VERIFIKASI --}}
                <a
                    href="{{ route('admin.verifikasi') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.verifikasi') ? 'font-semibold bg-[#5C4033] text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                >

                    <svg
                        class="w-[18px] h-[18px] shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>

                    Lihat Verifikasi

                </a>


                {{-- REKAP --}}
                <a
                    href="{{ route('admin.rekap') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.rekap') ? 'font-semibold bg-[#5C4033] text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                >

                    <svg
                        class="w-[18px] h-[18px] shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <path d="M14 2v6h6"/>
                        <path d="M16 13H8"/>
                        <path d="M16 17H8"/>
                        <path d="M10 9H8"/>
                    </svg>

                    Rekap

                </a>


                {{-- ================================================= --}}
                {{-- TAMBAH --}}
                {{-- ================================================= --}}

                <p class="px-3.5 mt-4 mb-2 text-[14px] font-semibold uppercase tracking-wider text-[#5C4033]">PENGATURAN</p>

                <details id="tambahMenu" class="mt-1 group">

                    {{-- TOMBOL TAMBAH --}}
                    @php
                        $tambahAktif = request()->routeIs('admin.tambah.*', 'jadwal.*', 'jam-pelajaran.*', 'mapel.*', 'admin.kelas.*', 'semester.*', 'admin.siswa.*', 'admin.user.*');
                    @endphp
                    <summary
                        class="list-none cursor-pointer w-full flex items-center justify-between gap-3
                               px-3.5 py-2.5 rounded-lg text-sm {{ $tambahAktif ? 'bg-[#5C4033] font-semibold text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }} transition"
                    >

                        <span class="flex items-center gap-3">

                            <svg
                                class="w-[18px] h-[18px] shrink-0"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path d="M12 5v14M5 12h14"/>
                            </svg>

                            <span>
                                Tambah
                            </span>

                        </span>


                        <svg
                            class="w-4 h-4 {{ $tambahAktif ? 'text-white' : 'text-[#7A6A60]' }} transition-transform duration-200
                                   group-open:rotate-180"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path d="M6 9l6 6 6-6"/>
                        </svg>

                    </summary>


                    {{-- SUBMENU TAMBAH --}}
                    <div class="mt-1 ml-3 pl-3 border-l border-[#E5D8CC] flex flex-col gap-0.5">

                        {{-- ADMIN --}}
                        <a
                            href="{{ route('admin.tambah.admin') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.admin') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Admin
                        </a>


                        {{-- JADWAL --}}
                        <a
                            href="{{ route('admin.tambah.jadwal') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.jadwal', 'jadwal.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Jadwal
                        </a>


                        {{-- JAM PELAJARAN --}}
                        <a
                            href="{{ route('admin.tambah.jam') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.jam', 'jam-pelajaran.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Jam Pelajaran
                        </a>


                        {{-- MATA PELAJARAN --}}
                        <a
                            href="{{ route('admin.tambah.mapel') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.mapel', 'mapel.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Mata Pelajaran
                        </a>


                        {{-- KELAS --}}
                        <a
                            href="{{ route('admin.tambah.kelas') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.kelas', 'admin.kelas.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Kelas
                        </a>


                        {{-- SEMESTER --}}
                        <a
                            href="{{ route('admin.tambah.semester') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.semester', 'semester.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Semester
                        </a>


                        {{-- PIKET --}}
                        <a
                            href="{{ route('admin.tambah.piket') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.piket') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Piket
                        </a>


                        {{-- SISWA --}}
                        <a
                            href="{{ route('admin.tambah.siswa') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.siswa', 'admin.siswa.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Siswa
                        </a>


                        {{-- USER --}}
                        <a
                            href="{{ route('admin.tambah.user') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.user', 'admin.user.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            User
                        </a>

                    </div>

                </details>

            </div>

        </nav>

        <div class="border-t border-[#E5D8CC] px-4 py-4">
            <button type="button" onclick="openAdminProfileModal()" class="mb-3 flex w-full items-center gap-3 rounded-lg px-1.5 py-1.5 text-left hover:bg-[#F5EFE8]">
                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#E8DFD6] text-xs font-bold text-[#5C4033]">{{ auth()->user()->initials() }}</span>
                <span class="min-w-0"><span class="block truncate text-sm font-semibold">{{ auth()->user()->name }}</span><span class="text-[11px] text-[#A08978]">Administrator · Edit profil</span></span>
            </button>
            <button type="button" onclick="openLogoutModal()" class="w-full rounded-lg px-3.5 py-2.5 text-left text-sm font-semibold text-[#C62828] hover:bg-[#FFEBEE]">Logout</button>
        </div>
    </aside>

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
                            <input id="username" name="username" type="text" required placeholder="Contoh: admin_sekolah" class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
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
    @include('admin.partials.admin_profile_modal')
</body>

</html>