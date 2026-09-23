<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
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

        <nav class="flex-1 overflow-y-auto px-3 py-4">
            <p class="mb-2 px-3.5 text-[14px] font-semibold uppercase tracking-wider text-[#5C4033]">Menu Utama</p>
            <div class="flex flex-col gap-0.5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="h-[18px] w-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l9-9 9 9"/><path d="M5 10v10h14V10"/></svg>
                    Beranda
                </a>
                <a href="{{ route('jadwal.index') }}" class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="h-[18px] w-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    Kehadiran Guru
                </a>
                <a href="{{ route('admin.jurnal') }}" class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="h-[18px] w-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    Jurnal
                </a>
                <a href="{{ route('admin.verifikasi') }}" class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="h-[18px] w-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    Lihat Verifikasi
                </a>
                <a href="{{ route('admin.rekap') }}" class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="h-[18px] w-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>
                    Rekap
                </a>

                <details class="mt-1 group">
                    <summary class="flex w-full list-none cursor-pointer items-center justify-between gap-3 rounded-lg bg-[#5C4033] px-3.5 py-2.5 text-sm font-semibold text-white">
                        <span class="flex items-center gap-3"><svg class="h-[18px] w-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg> Tambah</span>
                        <svg class="h-4 w-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                    </summary>
                    <div class="ml-3 mt-1 flex flex-col gap-0.5 border-l border-[#E5D8CC] pl-3">
                        <a href="{{ route('admin.tambah.admin') }}" class="rounded-lg bg-[#F5EFE8] px-3 py-2 text-[13px] font-semibold text-[#5C4033]">Admin</a>
                        <a href="{{ route('admin.tambah.jadwal') }}" class="rounded-lg px-3 py-2 text-[13px] text-[#3E3028] hover:bg-[#F5EFE8]">Jadwal</a>
                        <a href="{{ route('admin.tambah.jam') }}" class="rounded-lg px-3 py-2 text-[13px] text-[#3E3028] hover:bg-[#F5EFE8]">Jam Pelajaran</a>
                        <a href="{{ route('admin.tambah.mapel') }}" class="rounded-lg px-3 py-2 text-[13px] text-[#3E3028] hover:bg-[#F5EFE8]">Mata Pelajaran</a>
                        <a href="{{ route('admin.tambah.kelas') }}" class="rounded-lg px-3 py-2 text-[13px] text-[#3E3028] hover:bg-[#F5EFE8]">Kelas</a>
                        <a href="{{ route('admin.tambah.semester') }}" class="rounded-lg px-3 py-2 text-[13px] text-[#3E3028] hover:bg-[#F5EFE8]">Semester</a>
                        <a href="{{ route('admin.tambah.piket') }}" class="rounded-lg px-3 py-2 text-[13px] text-[#3E3028] hover:bg-[#F5EFE8]">Piket</a>
                        <a href="{{ route('admin.tambah.siswa') }}" class="rounded-lg px-3 py-2 text-[13px] text-[#3E3028] hover:bg-[#F5EFE8]">Siswa</a>
                        <a href="{{ route('admin.tambah.user') }}" class="rounded-lg px-3 py-2 text-[13px] text-[#3E3028] hover:bg-[#F5EFE8]">User</a>
                    </div>
                </details>
            </div>
        </nav>

        <div class="border-t border-[#E5D8CC] px-4 py-4">
            <div class="mb-3 flex items-center gap-3 rounded-lg px-1.5 py-1.5">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#E8DFD6] text-xs font-bold text-[#5C4033]">AT</div>
                <div class="min-w-0"><p class="truncate text-sm font-semibold">Admin Testing</p><p class="text-[11px] text-[#A08978]">Administrator</p></div>
            </div>
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

            <div id="successMessage" class="hidden rounded-lg border border-[#B7DDBB] bg-[#E8F5E9] px-4 py-3 text-sm font-semibold text-[#2E7D32]">
                Admin berhasil ditambahkan. Data ini masih berupa tampilan sementara.
            </div>

            <div class="flex flex-col gap-5">
                <form id="adminForm" class="rounded-lg border border-[#E5D8CC] bg-white p-5 sm:p-6" onsubmit="submitAdminForm(event)">
                    <div class="mb-5 border-b border-[#E5D8CC] pb-4">
                        <h3 class="font-['Poppins'] text-base font-bold text-[#3E3028]">Informasi Login</h3>
                        <p class="mt-1 text-xs text-[#7A6A60]">Akun ini akan digunakan untuk masuk ke halaman admin.</p>
                    </div>

                    <div class="flex flex-col gap-4">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-semibold text-[#3E3028]">Username</span>
                            <input id="username" name="username" type="text" required placeholder="Contoh: admin_sekolah" class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
                        </label>
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-semibold text-[#3E3028]">Password</span>
                            <input id="password" name="password" type="password" required minlength="6" placeholder="Minimal 6 karakter" class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
                        </label>
                        <label class="flex items-center gap-2 text-xs text-[#7A6A60]">
                            <input id="showPassword" type="checkbox" onchange="togglePassword(this)" class="h-4 w-4 accent-[#5C4033]"> Tampilkan password
                        </label>
                    </div>

                    <div class="mt-6 flex flex-col-reverse gap-2 border-t border-[#E5D8CC] pt-5 sm:flex-row sm:justify-end">
                        <button type="submit" class="rounded-lg bg-[#5C4033] px-4 py-2.5 text-sm font-semibold text-white hover:bg-[#452F26]">Simpan Admin</button>
                    </div>
                </form>
            </div>

            <div class="rounded-lg border border-[#E5D8CC] bg-white p-5 sm:p-6">
                <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                    <div>
                        <h3 class="font-['Poppins'] text-base font-bold text-[#3E3028]">Admin Terdaftar</h3>
                        <p class="mt-1 text-xs text-[#7A6A60]">Contoh hasil admin yang sudah ditambahkan.</p>
                    </div>
                    <span id="adminCount" class="w-fit rounded-md bg-[#E8F5E9] px-2.5 py-1 text-[11px] font-bold text-[#2E7D32]">1 Admin</span>
                </div>

                <div class="mt-4 overflow-x-auto">
                    <table class="w-full min-w-[620px] border border-[#E5D8CC] text-left text-sm">
                        <thead class="border-b border-[#E5D8CC] text-[11px] uppercase tracking-wider text-[#7A6A60]">
                            <tr>
                                <th class="px-3 py-3 font-semibold">Username</th>
                                <th class="px-3 py-3 font-semibold">Status</th>
                                <th class="px-3 py-3 font-semibold">Tanggal dibuat</th>
                                <th class="px-3 py-3 text-right font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="adminTableBody">
                            <tr data-password="admin123">
                                <td class="border-b border-[#E5D8CC] px-3 py-3 font-semibold text-[#3E3028]">admin</td>
                                <td class="border-b border-l border-[#E5D8CC] px-3 py-3"><span class="rounded-md bg-[#E8F5E9] px-2 py-1 text-[11px] font-bold text-[#2E7D32]">Aktif</span></td>
                                <td class="border-b border-l border-[#E5D8CC] px-3 py-3 text-[#7A6A60]">22 September 2026</td>
                                <td class="border-b border-l border-[#E5D8CC] px-3 py-3"><div class="flex justify-end gap-2"><button type="button" onclick="editAdmin(this)" class="rounded-full border border-[#D8C9BC] px-3 py-1 text-xs font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Edit</button><button type="button" onclick="deleteAdmin(this)" class="rounded-full border border-[#F0B8B8] px-3 py-1 text-xs font-semibold text-[#C62828] hover:bg-[#FFEBEE]">Hapus</button></div></td>
                            </tr>
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

    <div id="editAdminModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/40 px-4" onclick="closeEditAdminModal(event)">
        <div class="w-full max-w-md rounded-xl bg-white p-5 shadow-xl" role="dialog" aria-modal="true" onclick="event.stopPropagation()">
            <h2 class="font-['Poppins'] text-lg font-bold text-[#3E3028]">Edit Admin</h2>
            <p class="mt-1 text-sm text-[#7A6A60]">Perbarui username dan password admin.</p>
            <div class="mt-5 flex flex-col gap-4">
                <label class="flex flex-col gap-2">
                    <span class="text-sm font-semibold text-[#3E3028]">Username</span>
                    <input id="editUsername" type="text" class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033]">
                </label>
                <label class="flex flex-col gap-2">
                    <span class="text-sm font-semibold text-[#3E3028]">Password</span>
                    <input id="editPassword" type="password" minlength="6" class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033]">
                </label>
            </div>
            <div class="mt-5 flex justify-end gap-2">
                <button type="button" onclick="closeEditAdminModal()" class="rounded-lg px-4 py-2 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Batal</button>
                <button type="button" onclick="saveAdminEdit()" class="rounded-lg bg-[#5C4033] px-4 py-2 text-sm font-semibold text-white hover:bg-[#452F26]">Simpan Perubahan</button>
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

        function togglePassword(checkbox) {
            const password = document.getElementById('password');
            password.type = checkbox.checked ? 'text' : 'password';
        }

        function submitAdminForm(event) {
            event.preventDefault();
            const username = document.getElementById('username').value.trim();
            const tableBody = document.getElementById('adminTableBody');
            const today = new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });

            const row = document.createElement('tr');
            row.dataset.password = document.getElementById('password').value;
            row.innerHTML = `<td class="border-b border-[#E5D8CC] px-3 py-3 font-semibold text-[#3E3028]"></td><td class="border-b border-l border-[#E5D8CC] px-3 py-3"><span class="rounded-md bg-[#E8F5E9] px-2 py-1 text-[11px] font-bold text-[#2E7D32]">Aktif</span></td><td class="border-b border-l border-[#E5D8CC] px-3 py-3 text-[#7A6A60]"></td><td class="border-b border-l border-[#E5D8CC] px-3 py-3"><div class="flex justify-end gap-2"><button type="button" onclick="editAdmin(this)" class="rounded-full border border-[#D8C9BC] px-3 py-1 text-xs font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Edit</button><button type="button" onclick="deleteAdmin(this)" class="rounded-full border border-[#F0B8B8] px-3 py-1 text-xs font-semibold text-[#C62828] hover:bg-[#FFEBEE]">Hapus</button></div></td>`;
            row.children[0].textContent = username;
            row.children[2].textContent = today;
            tableBody.prepend(row);

            document.getElementById('adminCount').textContent = `${tableBody.children.length} Admin`;
            document.getElementById('successMessage').classList.remove('hidden');
            document.getElementById('adminForm').reset();
            document.getElementById('password').type = 'password';
            document.getElementById('showPassword').checked = false;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        let editingAdminRow = null;

        function editAdmin(button) {
            editingAdminRow = button.closest('tr');
            document.getElementById('editUsername').value = editingAdminRow.children[0].textContent.trim();
            document.getElementById('editPassword').value = editingAdminRow.dataset.password || '';
            const modal = document.getElementById('editAdminModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditAdminModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('editAdminModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            editingAdminRow = null;
        }

        function saveAdminEdit() {
            const username = document.getElementById('editUsername').value.trim();
            const password = document.getElementById('editPassword').value;
            if (!editingAdminRow || !username || password.length < 6) return;

            editingAdminRow.children[0].textContent = username;
            editingAdminRow.dataset.password = password;
            closeEditAdminModal();
        }

        function deleteAdmin(button) {
            if (!window.confirm('Hapus admin ini?')) return;

            button.closest('tr').remove();
            document.getElementById('adminCount').textContent = `${document.getElementById('adminTableBody').children.length} Admin`;
        }
    </script>
</body>

</html>
