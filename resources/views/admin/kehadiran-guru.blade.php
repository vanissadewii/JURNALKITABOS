<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kehadiran Guru - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        @media print {
            #sidebar, #sidebarOverlay, .no-print { display: none !important; }
            .print-area { margin: 0 !important; }
            body { background: #fff !important; }
        }
    </style>
    <style>html{scrollbar-width:none}html::-webkit-scrollbar{display:none}</style>
</head>
<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen overflow-x-hidden">

    <div id="sidebarOverlay" class="fixed inset-0 bg-black/40 z-40 hidden md:hidden" onclick="closeSidebar()"></div>

    <aside id="sidebar" class="fixed top-0 left-0 z-50 h-full w-[280px] bg-white border-r border-[#E5D8CC] transform -translate-x-full md:translate-x-0 transition-transform duration-300 flex flex-col">
        <div class="px-5 pt-6 pb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-[#5C4033] flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>
                </div>

                <div>
                    <h1 class="font-['Poppins'] font-bold text-[15px] text-[#5C4033] leading-tight">
                        JURNAL GURU
                    </h1>
                    <p class="text-[11px] text-[#A08978] mt-0.5">
                        Admin Sekolah
                    </p>
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

                </button>


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

                @php
                    $tambahAktif = request()->routeIs('admin.tambah.*', 'jadwal.*', 'jam-pelajaran.*', 'mapel.*', 'admin.kelas.*', 'semester.*', 'admin.siswa.*', 'admin.user.*');
                @endphp
                <details id="tambahMenu" class="mt-1 group">

                    {{-- TOMBOL TAMBAH --}}
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

            <button type="button" onclick="openAdminProfileModal()" 
               class="flex items-center gap-3 px-1.5 mb-3 rounded-lg hover:bg-[#F5EFE8] py-1.5 transition">

                <div class="w-8 h-8 rounded-full bg-[#E8DFD6] flex items-center justify-center shrink-0">
                    <span class="text-xs font-bold text-[#5C4033]">{{ auth()->user()->initials() }}</span>
                </div>

                <div class="min-w-0">
                    <p class="text-sm font-semibold text-[#3E3028] truncate">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-[11px] text-[#A08978]">
                        Administrator
                    </p>
                </div>

            </button>

            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold text-[#C62828] hover:bg-[#FFEBEE] text-left">
                    Logout
                </button>
            </form>

        </div>
    </aside>

    <div class="md:ml-[280px] min-h-screen print-area">

        {{-- HEADER (tanpa hari & tanggal) --}}
        <div class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 sm:px-6 md:px-7 shadow-sm no-print">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#D7B899] text-xs font-medium">Rekap kehadiran harian guru</p>
                    <h1 class="text-white font-['Poppins'] font-bold text-xl md:text-2xl">Kehadiran Guru</h1>
                </div>
                <button type="button" onclick="openSidebar()" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white/10">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-4">

            <form method="GET" action="{{ route('admin.kehadiran') }}" class="flex flex-col gap-4">
                <div class="flex flex-col gap-3 rounded-lg border border-[#E5D8CC] bg-white p-4 sm:flex-row sm:items-end sm:justify-between sm:p-5">
                    <div><p class="text-[11px] font-semibold uppercase tracking-wide text-[#A08978]">Rekap harian</p><h2 class="font-[Poppins] text-lg font-bold">Kehadiran Guru</h2><p class="text-sm text-[#7A6A60]">Data berdasarkan jadwal dan jurnal guru pada tanggal yang dipilih.</p></div>
                    <label class="flex flex-col gap-1 text-xs font-semibold text-[#7A6A60]">Tanggal<input type="date" name="tanggal" id="tanggalPicker" value="{{ $tanggal->format('Y-m-d') }}" onchange="this.form.submit()" class="rounded-lg border border-[#E5D8CC] bg-[#FDFBF7] px-3 py-2 text-sm text-[#3E3028]"></label>
                </div>
                <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                    <div class="flex flex-wrap gap-2 no-print">
                        @foreach ([['semua','Semua'],['hadir','Hadir'],['izin','Izin'],['sakit','Sakit'],['tidak-hadir','Tidak Hadir'],['belum','Belum ada jurnal']] as [$key,$label])
                            <button type="button" data-status-btn="{{ $key }}" onclick="filterStatus('{{ $key }}', this)" class="status-tab-btn rounded-lg border border-[#D8C9BC] bg-white px-3 py-2 text-xs font-bold text-[#5C4033] transition">{{ $label }} <span class="opacity-80">({{ $ringkasan[$key] ?? 0 }})</span></button>
                        @endforeach
                    </div>
                    <button type="button" onclick="exportExcel()" class="rounded-lg border border-[#B7DDBB] bg-[#E8F5E9] px-3.5 py-2 text-xs font-bold text-[#2E7D32] hover:bg-[#D7EFDA]">Export CSV</button>
                </div>
            </form>
            <div class="overflow-hidden rounded-lg border border-[#E5D8CC] bg-white">
                <div class="overflow-x-auto"><table id="tabelKehadiran" class="w-full min-w-[760px] text-left text-sm">
                    <thead class="bg-[#F5EFE8] text-[11px] uppercase text-[#5C4033]"><tr><th class="p-3">Guru</th><th class="p-3">Mata Pelajaran</th><th class="p-3">Status</th><th class="p-3">Materi / Keterangan</th><th class="p-3">Kelas</th><th class="p-3">Jam</th></tr></thead>
                    <tbody class="divide-y divide-[#E5D8CC]">
                        @forelse ($barisKehadiran as $baris)
                            @php($jurnal = $baris->jurnalHariIni)
                            @php($status = $baris->statusTampilan)
                            @php($labelStatus = match($status) { 'hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'tidak-hadir' => 'Tidak Hadir', default => 'Belum ada jurnal' })
                            @php($warnaStatus = match($status) { 'hadir' => 'bg-[#E8F5E9] text-[#2E7D32]', 'izin' => 'bg-[#E3F2FD] text-[#1565C0]', 'sakit' => 'bg-[#FFF3E0] text-[#E65100]', 'tidak-hadir' => 'bg-[#FFEBEE] text-[#C62828]', default => 'bg-[#F5EFE8] text-[#7A6A60]' })
                            <tr data-status="{{ $status }}"><td class="p-3 font-semibold">{{ $baris->guru->name }}</td><td class="p-3">{{ $baris->mapel->nama_mapel ?? '—' }}</td><td class="p-3"><span class="rounded-md px-2 py-1 text-xs font-bold {{ $warnaStatus }}">{{ $labelStatus }}</span></td><td class="max-w-sm whitespace-pre-line p-3">{{ $jurnal?->materi ?: ($jurnal?->keterangan ?: '—') }}</td><td class="p-3">{{ $baris->kelas->nama_kelas }}</td><td class="p-3 whitespace-nowrap">{{ substr($baris->jamPelajaran->jam_mulai,0,5) }}–{{ substr($baris->jamPelajaran->jam_selesai,0,5) }}</td></tr>
                        @empty
                            <tr><td colspan="6" class="p-8 text-center text-sm text-[#7A6A60]">Tidak ada jadwal mengajar pada tanggal ini.</td></tr>
                        @endforelse
                    </tbody>
                </table></div>
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

        function closeTambahMenu() {
            const menu = document.getElementById('tambahMenu');
            if (menu) {
                menu.open = false;
            }
        }

        // ===== FILTER STATUS =====
        function filterStatus(status, btn) {

            document.querySelectorAll('#tabelKehadiran tbody tr').forEach(function (row) {
                const cocok = status === 'semua' || row.dataset.status === status;
                row.classList.toggle('hidden', !cocok);
            });

            document.querySelectorAll('.status-tab-btn').forEach(function (tab) {
                tab.classList.remove('bg-[#5C4033]', 'text-white');
                tab.classList.add('bg-white');
            });

            btn.classList.remove('bg-white');
            btn.classList.add('bg-[#5C4033]', 'text-white');
        }

        // ===== EXPORT KE EXCEL (CSV, terbuka otomatis di Excel) =====
        function exportExcel() {

            const rows = [['Guru', 'Mata Pelajaran', 'Status', 'Materi / Tugas', 'Kelengkapan']];

            document.querySelectorAll('#tabelKehadiran tbody tr').forEach(function (row) {
                if (row.classList.contains('hidden')) return;
                const cells = Array.from(row.children).map(td => td.innerText.trim().replace(/\s+/g, ' '));
                rows.push(cells);
            });

            const csvContent = rows.map(r => r.map(v => `"${v.replace(/"/g, '""')}"`).join(',')).join('\n');
            const blob = new Blob(['\uFEFF' + csvContent], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const tanggal = document.getElementById('tanggalPicker').value;

            const a = document.createElement('a');
            a.href = url;
            a.download = `Kehadiran-Guru-${tanggal}.csv`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }
    </script>
    @include('admin.partials.admin_profile_modal')
</body>
</html>