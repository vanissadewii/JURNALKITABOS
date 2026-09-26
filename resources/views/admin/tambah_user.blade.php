<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>html{scrollbar-width:none}html::-webkit-scrollbar{display:none}</style>
</head>
<body class="min-h-screen overflow-x-hidden bg-[#F5EFE8] font-['Inter'] text-[#3E3028]">
    <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-black/40 md:hidden" onclick="closeSidebar()"></div>
    @include('admin.partials.tambah_sidebar')

    <main class="min-h-screen md:ml-[280px]">
        <header class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 text-white shadow-sm sm:px-6 md:px-7">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-xs font-medium text-[#D7B899]">Pengaturan Admin</p>
                    <h1 class="font-['Poppins'] text-xl font-bold md:text-2xl">Pengurus Kelas & User</h1>
                </div>
                <button type="button" onclick="openSidebar()" class="rounded-lg px-3 py-2 text-white hover:bg-white/10 md:hidden" aria-label="Buka sidebar">☰</button>
            </div>
        </header>

        <section class="flex flex-col gap-5 p-4 sm:p-6 md:p-7">
            <div>
                <h2 class="font-['Poppins'] text-xl font-bold">Kelola User</h2>
            </div>

            @if ($errors->any())
                <div class="rounded-xl border border-[#F0B8B8] bg-[#FFEBEE] px-4 py-3 text-sm text-[#C62828]">
                    <p class="font-semibold">Periksa kembali data user:</p>
                    <ul class="mt-2 list-inside list-disc space-y-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif
            @if (session('success'))
                <div class="rounded-xl border border-[#B7DDBB] bg-[#E8F5E9] px-4 py-3 text-sm font-semibold text-[#2E7D32]">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="rounded-xl border border-[#F0B8B8] bg-[#FFEBEE] px-4 py-3 text-sm text-[#C62828]">{{ session('error') }}</div>
            @endif

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <article class="rounded-xl border border-[#E5D8CC] bg-white p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-[#7A6A60]">Guru</p>
                    <p class="mt-2 font-['Poppins'] text-2xl font-bold">{{ number_format($jumlahGuru) }}</p>
                    <p class="mt-1 text-xs text-[#7A6A60]">Akun guru terdaftar</p>
                </article>
                <article class="rounded-xl border border-[#E5D8CC] bg-white p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-[#7A6A60]">Pengurus Kelas</p>
                    <p class="mt-2 font-['Poppins'] text-2xl font-bold">{{ number_format($jumlahKelas) }}</p>
                    <p class="mt-1 text-xs text-[#7A6A60]">Akun pengurus kelas terdaftar</p>
                </article>
            </div>

            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="flex flex-col justify-between gap-3 border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:flex-row sm:items-center sm:px-6">
                    <div><h3 class="font-['Poppins'] text-base font-bold">Tambah User dari File</h3><p class="mt-1 text-xs leading-5 text-[#7A6A60]">Unggah Excel atau CSV untuk menambahkan banyak akun Guru atau Kelas sekaligus.</p></div>
                    <span class="w-fit shrink-0 rounded-md bg-[#F5EFE8] px-2.5 py-1 text-[11px] font-bold text-[#5C4033]">XLSX · XLS · CSV</span>
                </div>
                <form method="POST" action="{{ route('admin.user.import') }}" enctype="multipart/form-data" class="flex flex-col gap-4 p-5 sm:p-6">
                    @csrf
                    <label class="flex min-w-0 flex-col gap-2"><span class="text-sm font-semibold">Pilih file user</span><input type="file" name="file_user" accept=".xlsx,.xls,.csv" required class="w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] text-sm file:mr-4 file:border-0 file:bg-[#F5EFE8] file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-[#5C4033] hover:file:bg-[#EDE2D8]"></label>
                    <div class="rounded-lg bg-[#F5EFE8] px-3.5 py-3 text-xs leading-5 text-[#7A6A60]"><p class="font-semibold text-[#5C4033]">Kolom file:</p><p><code class="font-semibold">name, username, password, role, status, no_telepon, id_kelas</code></p><p>Role yang didukung: guru atau kelas. <code>id_kelas</code> untuk role kelas. Password minimal 8 karakter; status menandai akun aktif, nonaktif, atau pending.</p></div>
                    <div class="flex justify-end border-t border-[#E5D8CC] pt-4"><button type="submit" class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#452F26]">Upload User</button></div>
                </form>
            </article>

            <details class="group overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <summary class="flex cursor-pointer list-none items-center justify-between gap-3 bg-[#FFFCF9] px-5 py-4 sm:px-6">
                    <span><span class="block font-['Poppins'] text-sm font-bold">Tambah User</span><span class="mt-1 block text-xs text-[#7A6A60]">Buat akun guru atau perwakilan kelas.</span></span>
                    <span class="rounded-lg bg-[#5C4033] px-3.5 py-2 text-xs font-semibold text-white group-open:hidden">Buka form</span>
                    <span class="hidden rounded-lg border border-[#D8C9BC] px-3.5 py-2 text-xs font-semibold text-[#5C4033] group-open:inline">Tutup</span>
                </summary>
                <form method="POST" action="{{ route('admin.user.store') }}" class="grid grid-cols-1 gap-4 border-t border-[#E5D8CC] p-5 sm:grid-cols-2 lg:grid-cols-3 sm:p-6">
                    @csrf
                    <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Nama lengkap</span><input type="text" name="name" value="{{ old('name') }}" maxlength="255" placeholder="Contoh: Winartin, S.Pd/XI RPL 2" required class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033]"></label>
                    <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Username</span><input type="text" name="username" value="{{ old('username') }}" maxlength="50" placeholder="Username untuk login" required class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033]"></label>
                    <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Password</span><span class="relative"><input id="userManualPassword" type="password" name="password" minlength="8" placeholder="Minimal 8 karakter" required class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 pr-12 text-sm outline-none focus:border-[#5C4033]"><button type="button" onclick="toggleUserPassword()" aria-label="Tampilkan password" title="Tampilkan password" class="absolute inset-y-0 right-0 flex w-11 items-center justify-center text-[#7A6A60] hover:text-[#5C4033]"><svg id="userPasswordEye" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z"/><circle cx="12" cy="12" r="2.5"/></svg></button></span></label>
                    <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Role</span><select name="role" id="userRole" onchange="toggleKelas()" required class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033]"><option value="guru" @selected(old('role', 'guru') === 'guru')>Guru</option><option value="kelas" @selected(old('role') === 'kelas')>Pengurus Kelas</option></select></label>
                    <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Status</span><select name="status" required class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033]"><option value="aktif" @selected(old('status', 'aktif') === 'aktif')>Aktif</option><option value="nonaktif" @selected(old('status') === 'nonaktif')>Nonaktif</option><option value="pending" @selected(old('status') === 'pending')>Pending</option></select></label>
                    <label class="flex flex-col gap-2"><span class="text-sm font-semibold">No. telepon <span class="font-normal text-[#7A6A60]">(opsional)</span></span><input type="text" name="no_telepon" value="{{ old('no_telepon') }}" maxlength="20" placeholder="08xxxxxxxxxx" class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033]"></label>
                    <label id="createPengurusField" class="hidden flex-col gap-2 sm:col-span-2 lg:col-span-3"><span class="text-sm font-semibold">Ketua Kelas</span><select id="createKetua" name="id_ketua_kelas" class="h-11 rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm"><option value="">Pilih siswa</option>@foreach ($siswa as $calon)<option value="{{ $calon->id_siswa }}" data-kelas="{{ $calon->id_kelas }}" @selected(old('id_ketua_kelas') == $calon->id_siswa)>{{ $calon->nama }} • {{ $calon->kelas?->nama_kelas }}</option>@endforeach</select></label>
                    <label class="hidden flex-col gap-2 sm:col-span-2 lg:col-span-3 create-pengurus-field"><span class="text-sm font-semibold">Sekretaris 1</span><select id="createSekretaris1" name="id_sekretaris_1" class="h-11 rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm"><option value="">Pilih siswa</option>@foreach ($siswa as $calon)<option value="{{ $calon->id_siswa }}" data-kelas="{{ $calon->id_kelas }}" @selected(old('id_sekretaris_1') == $calon->id_siswa)>{{ $calon->nama }} • {{ $calon->kelas?->nama_kelas }}</option>@endforeach</select></label>
                    <label class="hidden flex-col gap-2 sm:col-span-2 lg:col-span-3 create-pengurus-field"><span class="text-sm font-semibold">Sekretaris 2</span><select id="createSekretaris2" name="id_sekretaris_2" class="h-11 rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm"><option value="">Pilih siswa</option>@foreach ($siswa as $calon)<option value="{{ $calon->id_siswa }}" data-kelas="{{ $calon->id_kelas }}" @selected(old('id_sekretaris_2') == $calon->id_siswa)>{{ $calon->nama }} • {{ $calon->kelas?->nama_kelas }}</option>@endforeach</select></label>
                    <label id="kelasField" class="hidden flex-col gap-2 sm:col-span-2 lg:col-span-3"><span class="text-sm font-semibold">Kelas untuk perwakilan</span><select id="createKelas" name="id_kelas" onchange="filterPengurusSiswa('create')" class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033]"><option value="">Pilih kelas</option>@foreach ($kelas as $k)<option value="{{ $k->id_kelas }}" @selected(old('id_kelas') == $k->id_kelas)>{{ $k->nama_kelas }}</option>@endforeach</select></label>
                    <div class="sm:col-span-2 lg:col-span-3 flex justify-end border-t border-[#E5D8CC] pt-4"><button type="submit" class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#452F26]">Simpan User</button></div>
                </form>
            </details>

            <article id="hasil-user" class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="flex flex-col justify-between gap-3 border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:flex-row sm:items-center sm:px-6">
                    <div>
                        <h3 class="font-['Poppins'] text-base font-bold">Hasil User</h3>
                        <p class="mt-1 text-xs text-[#7A6A60]">{{ number_format($users->total()) }} user ditemukan</p>
                    </div>
                </div>

                <form id="searchUserForm" method="GET" action="{{ route('admin.user.index') }}" class="grid grid-cols-1 gap-3 border-b border-[#E5D8CC] p-4 sm:grid-cols-[minmax(220px,1fr)_190px_auto_auto] sm:p-5">
                    <label class="relative block"><span class="sr-only">Cari user</span><input type="search" name="q" value="{{ request('q') }}" placeholder="Cari nama, username, telepon, atau kelas..." class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm outline-none focus:border-[#5C4033]"></label>
                    <label><span class="sr-only">Pilih jenis user</span><select name="role" class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm outline-none focus:border-[#5C4033]"><option value="">Semua user</option><option value="guru" @selected(request('role') === 'guru')>Guru</option><option value="kelas" @selected(request('role') === 'kelas')>Pengurus Kelas</option></select></label>
                    <button type="submit" class="h-11 rounded-lg bg-[#5C4033] px-5 text-sm font-semibold text-white hover:bg-[#452F26]">Cari</button>
                    @if (request()->hasAny(['q', 'role']))<a href="{{ route('admin.user.index') }}" onclick="sessionStorage.setItem('userTableScroll', window.scrollY)" class="flex h-11 items-center justify-center rounded-lg border border-[#D8C9BC] px-4 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Reset</a>@endif
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[850px] border-collapse text-left text-sm">
                        <thead class="bg-[#F5EFE8] text-[11px] uppercase tracking-wider text-[#7A6A60]"><tr><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Nama</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Username</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Role</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Kelas</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Ketua Kelas</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Sekretaris 1</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Sekretaris 2</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">No. Telepon</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Status</th><th class="border-b border-[#E5D8CC] px-4 py-3">Aksi</th></tr></thead>
                        <tbody>
                            @forelse ($users as $u)
                                <tr class="hover:bg-[#FFFCF9]">
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3 font-medium">{{ $u->name }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[#7A6A60]">{{ $u->username }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $u->role === 'guru' ? 'bg-[#E8F5E9] text-[#2E7D32]' : ($u->role === 'kelas' ? 'bg-[#FFF8E7] text-[#A16207]' : 'bg-[#F5EFE8] text-[#5C4033]') }}">{{ $u->role === 'kelas' ? 'Pengurus Kelas' : ucfirst($u->role) }}</span></td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ $u->kelas?->nama_kelas ?? '—' }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ $u->role === 'kelas' ? ($u->ketuaKelas?->nama ?: $u->nama_ketua_kelas ?: '—') : '—' }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ $u->role === 'kelas' ? ($u->sekretarisPertama?->nama ?: $u->nama_sekretaris ?: '—') : '—' }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ $u->role === 'kelas' ? ($u->sekretarisKedua?->nama ?: $u->nama_sekretaris_2 ?: '—') : '—' }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ $u->no_telepon ?: '—' }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ ucfirst($u->status) }}</td>
                                    <td class="border-b border-[#E5D8CC] px-4 py-3"><div class="flex items-center gap-2">
                                        <button type="button" onclick="bukaEditUser(this)" data-id="{{ $u->id }}" data-name="{{ $u->name }}" data-username="{{ $u->username }}" data-role="{{ $u->role }}" data-status="{{ $u->status }}" data-telepon="{{ $u->no_telepon }}" data-kelas="{{ $u->id_kelas }}" data-sekretaris="{{ $u->id_sekretaris_1 }}" data-ketua="{{ $u->id_ketua_kelas }}" data-sekretaris2="{{ $u->id_sekretaris_2 }}" class="rounded-lg border border-[#D8C9BC] px-3 py-1.5 text-xs font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Edit</button>
                                        <form method="POST" action="{{ route('admin.user.destroy', $u) }}" onsubmit="sessionStorage.setItem('userTableScroll', window.scrollY); return confirm('Hapus user {{ addslashes($u->name) }}?')" class="inline">@csrf @method('DELETE')<input type="hidden" name="filter_q" value="{{ request('q') }}"><input type="hidden" name="filter_role" value="{{ request('role') }}"><input type="hidden" name="filter_page" value="{{ request('page') }}"><button type="submit" class="rounded-lg border border-rose-200 px-3 py-1.5 text-xs font-semibold text-rose-700 hover:bg-rose-50">Hapus</button></form>
                                    </div></td>
                                </tr>
                            @empty
                                <tr><td colspan="10" class="px-4 py-12 text-center"><p class="font-semibold">Tidak ada user yang cocok.</p><p class="mt-1 text-xs text-[#7A6A60]">Coba ubah pilihan role atau kata pencarian.</p></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($users->hasPages())<div class="border-t border-[#E5D8CC] px-4 py-4 sm:px-6">{{ $users->links() }}</div>@endif
            </article>
        </section>
    </main>

<<<<<<< HEAD
        <div>
            <label>No. Telepon:</label><br>
            <input type="text" name="no_telepon" value="{{ old('no_telepon') }}">
        </div>
        <br>

        <div>
            <label>Kelas (khusus role "Kelas"):</label><br>
            <select name="id_kelas">
                <option value="">-- Tidak ada --</option>
                @foreach ($kelas as $k)
                <option value="{{ $k->id_kelas }}">
                    {{ $k->tingkat }} {{ $k->jurusan }} {{ $k->rombel }}
                </option>
                @endforeach
            </select>
        </div>
        <br>

        <button type="submit">Simpan User</button>
    </form>

    <br>
    <hr><br>

    <!-- TABEL DAFTAR USER -->
    <h2>Daftar User</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>No. Telepon</th>
                <th>Role</th>
                <th>Status</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $i => $u)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->username }}</td>
                <td>{{ $u->no_telepon ?: '-' }}</td>
                <td>{{ $u->role }}</td>
                <td>{{ $u->status }}</td>
                <td>
                    @if($u->kelas)
                    {{ $u->kelas->tingkat }} {{ $u->kelas->jurusan }} {{ $u->kelas->rombel }}
                    @else
                    -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Belum ada data user.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
=======
    <div id="editUserModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/45 p-4" onclick="if(event.target===this) tutupEditUser()">
        <section class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white shadow-2xl">
            <div class="flex items-center justify-between border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6"><div><h2 class="font-['Poppins'] text-lg font-bold">Edit User</h2><p class="mt-1 text-xs text-[#7A6A60]">Perbarui informasi akun.</p></div><button type="button" onclick="tutupEditUser()" class="rounded-lg px-3 py-2 text-lg text-[#7A6A60] hover:bg-[#F5EFE8]" aria-label="Tutup">×</button></div>
            <form id="editUserForm" method="POST" class="grid grid-cols-1 gap-4 p-5 sm:grid-cols-2 sm:p-6" onsubmit="sessionStorage.setItem('userTableScroll', window.scrollY)">@csrf @method('PUT')
                <input type="hidden" name="filter_q" value="{{ request('q') }}"><input type="hidden" name="filter_role" value="{{ request('role') }}"><input type="hidden" name="filter_page" value="{{ request('page') }}">
                <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Nama lengkap</span><input id="editName" name="name" required maxlength="255" class="h-11 rounded-lg border border-[#D8C9BC] px-3.5 text-sm"></label>
                <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Username</span><input id="editUsername" name="username" required maxlength="50" class="h-11 rounded-lg border border-[#D8C9BC] px-3.5 text-sm"></label>
                <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Password baru <span class="font-normal text-[#7A6A60]">(kosongkan jika tidak diganti)</span></span><span class="relative"><input id="editUserPassword" type="password" name="password" minlength="8" class="h-11 w-full rounded-lg border border-[#D8C9BC] px-3.5 pr-12 text-sm"><button type="button" onclick="toggleEditUserPassword()" aria-label="Tampilkan password" title="Tampilkan password" class="absolute inset-y-0 right-0 flex w-11 items-center justify-center text-[#7A6A60] hover:text-[#5C4033]"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z"/><circle cx="12" cy="12" r="2.5"/></svg></button></span></label>
                <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Role</span><select id="editRole" name="role" onchange="toggleEditKelas()" required class="h-11 rounded-lg border border-[#D8C9BC] px-3.5 text-sm"><option value="guru">Guru</option><option value="kelas">Pengurus Kelas</option></select></label>
                <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Status</span><select id="editStatus" name="status" required class="h-11 rounded-lg border border-[#D8C9BC] px-3.5 text-sm"><option value="aktif">Aktif</option><option value="nonaktif">Nonaktif</option><option value="pending">Pending</option></select></label>
                <label class="flex flex-col gap-2"><span class="text-sm font-semibold">No. Telepon</span><input id="editTelepon" name="no_telepon" maxlength="20" class="h-11 rounded-lg border border-[#D8C9BC] px-3.5 text-sm"></label>
                <label id="editKetuaField" class="hidden flex-col gap-2 sm:col-span-2"><span class="text-sm font-semibold">Ketua Kelas</span><select id="editKetua" name="id_ketua_kelas" class="h-11 rounded-lg border border-[#D8C9BC] px-3.5 text-sm"><option value="">Pilih siswa</option>@foreach ($siswa as $calon)<option value="{{ $calon->id_siswa }}" data-kelas="{{ $calon->id_kelas }}">{{ $calon->nama }} • {{ $calon->kelas?->nama_kelas }}</option>@endforeach</select></label>
                <label id="editSekretarisField" class="hidden flex-col gap-2 sm:col-span-2"><span class="text-sm font-semibold">Sekretaris 1</span><select id="editSekretaris" name="id_sekretaris_1" class="h-11 rounded-lg border border-[#D8C9BC] px-3.5 text-sm"><option value="">Pilih siswa</option>@foreach ($siswa as $calon)<option value="{{ $calon->id_siswa }}" data-kelas="{{ $calon->id_kelas }}">{{ $calon->nama }} • {{ $calon->kelas?->nama_kelas }}</option>@endforeach</select></label>
                <label id="editSekretaris2Field" class="hidden flex-col gap-2 sm:col-span-2"><span class="text-sm font-semibold">Sekretaris 2</span><select id="editSekretaris2" name="id_sekretaris_2" class="h-11 rounded-lg border border-[#D8C9BC] px-3.5 text-sm"><option value="">Pilih siswa</option>@foreach ($siswa as $calon)<option value="{{ $calon->id_siswa }}" data-kelas="{{ $calon->id_kelas }}">{{ $calon->nama }} • {{ $calon->kelas?->nama_kelas }}</option>@endforeach</select></label>
                <label id="editKelasField" class="hidden flex-col gap-2 sm:col-span-2"><span class="text-sm font-semibold">Kelas perwakilan</span><select id="editKelas" name="id_kelas" onchange="filterPengurusSiswa('edit')" class="h-11 rounded-lg border border-[#D8C9BC] px-3.5 text-sm"><option value="">Pilih kelas</option>@foreach ($kelas as $k)<option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>@endforeach</select></label>
                <div class="flex justify-end gap-2 border-t border-[#E5D8CC] pt-4 sm:col-span-2"><button type="button" onclick="tutupEditUser()" class="rounded-lg border border-[#D8C9BC] px-4 py-2.5 text-sm font-semibold text-[#5C4033]">Batal</button><button type="submit" class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white">Simpan Perubahan</button></div>
            </form>
        </section>
    </div>
>>>>>>> putri/tampilan-admin

    <script>
        function toggleUserPassword(){const input=document.getElementById('userManualPassword');const button=input.nextElementSibling;const showing=input.type==='password';input.type=showing?'text':'password';button.setAttribute('aria-label',showing?'Sembunyikan password':'Tampilkan password');button.title=showing?'Sembunyikan password':'Tampilkan password';}
        function toggleEditUserPassword(){const input=document.getElementById('editUserPassword');const button=input.nextElementSibling;const showing=input.type==='password';input.type=showing?'text':'password';button.setAttribute('aria-label',showing?'Sembunyikan password':'Tampilkan password');button.title=showing?'Sembunyikan password':'Tampilkan password';}
        function openSidebar(){document.getElementById('sidebar').classList.remove('-translate-x-full');document.getElementById('sidebarOverlay').classList.remove('hidden');}
        function closeSidebar(){document.getElementById('sidebar').classList.add('-translate-x-full');document.getElementById('sidebarOverlay').classList.add('hidden');}
        function filterPengurusSiswa(prefix){const kelasId=document.getElementById(prefix==='create'?'createKelas':'editKelas').value;const ids=prefix==='create'?['createKetua','createSekretaris1','createSekretaris2']:['editKetua','editSekretaris','editSekretaris2'];ids.forEach(id=>{const select=document.getElementById(id);Array.from(select.options).forEach(option=>{if(!option.value)return;option.hidden=!!kelasId&&option.dataset.kelas!==kelasId;});if(select.selectedOptions[0]?.hidden)select.value='';});}
        function toggleKelas(){const visible=document.getElementById('userRole').value==='kelas';const field=document.getElementById('kelasField');field.classList.toggle('hidden',!visible);field.classList.toggle('flex',visible);document.querySelectorAll('.create-pengurus-field').forEach(field=>{field.classList.toggle('hidden',!visible);field.classList.toggle('flex',visible);});document.getElementById('createPengurusField').classList.toggle('hidden',!visible);document.getElementById('createPengurusField').classList.toggle('flex',visible);filterPengurusSiswa('create');}
        function toggleEditKelas(){const visible=document.getElementById('editRole').value==='kelas';const field=document.getElementById('editKelasField');field.classList.toggle('hidden',!visible);field.classList.toggle('flex',visible);['editKetuaField','editSekretarisField','editSekretaris2Field'].forEach(id=>{const pengurus=document.getElementById(id);pengurus.classList.toggle('hidden',!visible);pengurus.classList.toggle('flex',visible);});}
        function bukaEditUser(button){const modal=document.getElementById('editUserModal');document.getElementById('editUserForm').action='{{ url('/admin/user') }}/'+button.dataset.id;document.getElementById('editName').value=button.dataset.name;document.getElementById('editUsername').value=button.dataset.username;document.getElementById('editRole').value=button.dataset.role;document.getElementById('editStatus').value=button.dataset.status;document.getElementById('editTelepon').value=button.dataset.telepon||'';document.getElementById('editKelas').value=button.dataset.kelas||'';document.getElementById('editSekretaris').value=button.dataset.sekretaris||'';document.getElementById('editKetua').value=button.dataset.ketua||'';document.getElementById('editSekretaris2').value=button.dataset.sekretaris2||'';toggleEditKelas();filterPengurusSiswa('edit');modal.classList.remove('hidden');modal.classList.add('flex');document.body.classList.add('overflow-hidden');}
        function tutupEditUser(){const modal=document.getElementById('editUserModal');modal.classList.add('hidden');modal.classList.remove('flex');document.body.classList.remove('overflow-hidden');}
        document.addEventListener('keydown',event=>{if(event.key==='Escape')tutupEditUser()});
        document.getElementById('searchUserForm').addEventListener('submit',()=>sessionStorage.setItem('userTableScroll',window.scrollY));
        const savedUserScroll=sessionStorage.getItem('userTableScroll');if(savedUserScroll!==null){sessionStorage.removeItem('userTableScroll');requestAnimationFrame(()=>window.scrollTo(0,Number(savedUserScroll)));}
        toggleKelas();
    </script>
    @include('shared.preserve_search_scroll')
</body>
<<<<<<< HEAD

</html>
=======
</html>
>>>>>>> putri/tampilan-admin
