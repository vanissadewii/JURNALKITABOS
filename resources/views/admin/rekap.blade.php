<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @vite('resources/css/app.css')
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

                <details class="mt-1 group">

                    {{-- TOMBOL TAMBAH --}}
                    <summary
                        class="list-none cursor-pointer w-full flex items-center justify-between gap-3
                               px-3.5 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.tambah.*', 'jadwal.*', 'jam-pelajaran.*', 'mapel.*', 'admin.kelas.*', 'semester.*', 'admin.siswa.*', 'admin.user.*') ? 'bg-[#5C4033] font-semibold text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }} transition"
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
                            class="w-4 h-4 text-[#7A6A60] transition-transform duration-200
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
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.admin') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Admin
                        </a>


                        {{-- JADWAL --}}
                        <a
                            href="{{ route('admin.tambah.jadwal') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.jadwal', 'jadwal.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Jadwal
                        </a>


                        {{-- JAM PELAJARAN --}}
                        <a
                            href="{{ route('admin.tambah.jam') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.jam', 'jam-pelajaran.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Jam Pelajaran
                        </a>


                        {{-- MATA PELAJARAN --}}
                        <a
                            href="{{ route('admin.tambah.mapel') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.mapel', 'mapel.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Mata Pelajaran
                        </a>


                        {{-- KELAS --}}
                        <a
                            href="{{ route('admin.tambah.kelas') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.kelas', 'admin.kelas.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Kelas
                        </a>


                        {{-- SEMESTER --}}
                        <a
                            href="{{ route('admin.tambah.semester') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.semester', 'semester.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Semester
                        </a>


                        {{-- PIKET --}}
                        <a
                            href="{{ route('admin.tambah.piket') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.piket') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Piket
                        </a>


                        {{-- SISWA --}}
                        <a
                            href="{{ route('admin.tambah.siswa') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.siswa', 'admin.siswa.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Siswa
                        </a>


                        {{-- USER --}}
                        <a
                            href="{{ route('admin.tambah.user') }}"
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

    <div class="md:ml-[280px] min-h-screen">
        <div class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 sm:px-6 md:px-7 shadow-sm">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-[#D7B899] text-xs font-medium">Rekap jurnal & kehadiran</p>
                    <h1 class="text-white font-['Poppins'] font-bold text-xl md:text-2xl">Rekap</h1>
                </div>
                <div class="flex items-center gap-2">
                    {{-- TOMBOL EXPORT EXCEL --}}
                    <a href="{{ route('admin.rekap.export', request()->only(['dari', 'sampai', 'id_kelas'])) }}"
                       class="inline-flex items-center gap-2 text-[12px] font-semibold px-3 sm:px-3.5 py-2 rounded-lg bg-white text-[#5C4033] hover:bg-[#F5EFE8]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        <span class="hidden xs:inline sm:inline">Export CSV (Excel)</span>
                    </a>
                    <button type="button" onclick="openSidebar()" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white/10">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-4 px-4 py-5 sm:p-6 md:p-7">
            <form method="GET" action="{{ route('admin.rekap') }}" class="grid grid-cols-1 items-end gap-3 rounded-lg border border-[#E5D8CC] bg-white p-4 sm:grid-cols-2 lg:grid-cols-4">
                <label class="text-[11px] font-semibold uppercase text-[#7A6A60]">Dari tanggal<input type="date" name="dari" value="{{ $dari }}" class="mt-1 w-full rounded-lg border border-[#E5D8CC] bg-[#FDFBF7] px-3 py-2.5 text-sm font-normal text-[#3E3028]"></label>
                <label class="text-[11px] font-semibold uppercase text-[#7A6A60]">Sampai tanggal<input type="date" name="sampai" value="{{ $sampai }}" class="mt-1 w-full rounded-lg border border-[#E5D8CC] bg-[#FDFBF7] px-3 py-2.5 text-sm font-normal text-[#3E3028]"></label>
                <label class="text-[11px] font-semibold uppercase text-[#7A6A60]">Kelas<select name="id_kelas" class="mt-1 w-full rounded-lg border border-[#E5D8CC] bg-[#FDFBF7] px-3 py-2.5 text-sm font-normal text-[#3E3028]"><option value="">Semua kelas</option>@foreach($kelas as $pilihanKelas)<option value="{{ $pilihanKelas->id_kelas }}" @selected(($filters['id_kelas'] ?? '') == $pilihanKelas->id_kelas)>{{ $pilihanKelas->nama_kelas }}</option>@endforeach</select></label>
                <div class="flex gap-2"><button type="submit" class="flex-1 rounded-lg bg-[#5C4033] px-4 py-2.5 text-sm font-semibold text-white">Tampilkan</button><a href="{{ route('admin.rekap') }}" class="rounded-lg border border-[#D8C9BC] px-4 py-2.5 text-sm font-semibold text-[#5C4033]">Reset</a></div>
            </form>

            <div class="grid grid-cols-2 gap-2.5 lg:grid-cols-4">
                @foreach ([['Jurnal Masuk',$jurnals->count(),'text-[#3E3028]'],['Dicek Piket',$jurnals->whereIn('status_piket',['disetujui','ditolak'])->count(),'text-[#2E7D32]'],['Belum Dicek',$jurnals->where('status_piket','menunggu')->count(),'text-[#F57F17]'],['Guru Tidak Hadir',$jurnals->where('status_kehadiran_guru','tidak_hadir')->count(),'text-[#C62828]']] as [$label,$jumlah,$warna])
                    <div class="rounded-lg border border-[#E5D8CC] bg-white p-3.5"><p class="text-[11px] font-semibold uppercase text-[#7A6A60]">{{ $label }}</p><p class="mt-1 font-['Poppins'] text-[22px] font-extrabold {{ $warna }}">{{ $jumlah }}</p></div>
                @endforeach
            </div>

            <section class="overflow-hidden rounded-lg border border-[#E5D8CC] bg-white">
                <div class="flex items-center justify-between border-b border-[#E5D8CC] bg-[#F5EFE8] px-4 py-3"><h2 class="font-['Poppins'] text-sm font-bold uppercase">Rekap per Kelas</h2><span class="text-xs text-[#7A6A60]">{{ $dari }} — {{ $sampai }}</span></div>
                <div class="overflow-x-auto"><table class="min-w-[650px] w-full text-left text-[13px]"><thead class="bg-[#FDFBF7] text-[11px] uppercase text-[#5C4033]"><tr><th class="border border-[#E5D8CC] px-4 py-3">Kelas</th><th class="border border-[#E5D8CC] px-4 py-3 text-center">Jurnal</th><th class="border border-[#E5D8CC] px-4 py-3 text-center">Dicek Piket</th><th class="border border-[#E5D8CC] px-4 py-3 text-center">Belum Dicek</th><th class="border border-[#E5D8CC] px-4 py-3 text-center">Guru Tidak Hadir</th></tr></thead><tbody>
                    @forelse($byClass as $baris)<tr><td class="border border-[#E5D8CC] px-4 py-3 font-semibold">{{ $baris->kelas->nama_kelas }}</td><td class="border border-[#E5D8CC] px-4 py-3 text-center">{{ $baris->jumlah }}</td><td class="border border-[#E5D8CC] px-4 py-3 text-center text-[#2E7D32]">{{ $baris->dicek }}</td><td class="border border-[#E5D8CC] px-4 py-3 text-center text-[#F57F17]">{{ $baris->belum }}</td><td class="border border-[#E5D8CC] px-4 py-3 text-center text-[#C62828]">{{ $baris->tidak_hadir }}</td></tr>
                    @empty<tr><td colspan="5" class="px-4 py-8 text-center text-sm text-[#7A6A60]">Belum ada jurnal pada periode ini.</td></tr>@endforelse
                </tbody></table></div>
            </section>

            <section class="overflow-hidden rounded-lg border border-[#E5D8CC] bg-white">
                <div class="border-b border-[#E5D8CC] bg-[#F5EFE8] px-4 py-3"><h2 class="font-['Poppins'] text-sm font-bold uppercase">Rekap Kehadiran Guru</h2></div>
                <div class="overflow-x-auto"><table class="min-w-[680px] w-full text-left text-[13px]"><thead class="bg-[#FDFBF7] text-[11px] uppercase text-[#5C4033]"><tr><th class="border border-[#E5D8CC] px-4 py-3">Nama Guru</th><th class="border border-[#E5D8CC] px-4 py-3 text-center">Hadir</th><th class="border border-[#E5D8CC] px-4 py-3 text-center">Izin</th><th class="border border-[#E5D8CC] px-4 py-3 text-center">Sakit</th><th class="border border-[#E5D8CC] px-4 py-3 text-center">Tidak Hadir</th><th class="border border-[#E5D8CC] px-4 py-3 text-center">Total Sesi</th></tr></thead><tbody>
                    @forelse($byTeacher as $baris)<tr><td class="border border-[#E5D8CC] px-4 py-3 font-semibold">{{ $baris->guru->name }}</td><td class="border border-[#E5D8CC] px-4 py-3 text-center text-[#2E7D32]">{{ $baris->hadir }}</td><td class="border border-[#E5D8CC] px-4 py-3 text-center">{{ $baris->izin }}</td><td class="border border-[#E5D8CC] px-4 py-3 text-center">{{ $baris->sakit }}</td><td class="border border-[#E5D8CC] px-4 py-3 text-center text-[#C62828]">{{ $baris->tidak_hadir }}</td><td class="border border-[#E5D8CC] px-4 py-3 text-center">{{ $baris->jumlah }}</td></tr>
                    @empty<tr><td colspan="6" class="px-4 py-8 text-center text-sm text-[#7A6A60]">Belum ada data kehadiran guru pada periode ini.</td></tr>@endforelse
                </tbody></table></div>
            </section>
        </div>
    </div>

    <script>
        function openSidebar(){document.getElementById('sidebar').classList.remove('-translate-x-full');document.getElementById('sidebarOverlay').classList.remove('hidden')}
        function closeSidebar(){document.getElementById('sidebar').classList.add('-translate-x-full');document.getElementById('sidebarOverlay').classList.add('hidden')}
        function closeTambahMenu(){const menu=document.getElementById('tambahMenu');if(menu)menu.open=false}
    </script>
    @include('admin.partials.admin_profile_modal')
    @include('shared.preserve_search_scroll')
</body>
</html>