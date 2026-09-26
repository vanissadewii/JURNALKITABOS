<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Mengajar - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>html{scrollbar-width:none}html::-webkit-scrollbar{display:none}</style>
</head>
<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen overflow-x-hidden">

    <div id="sidebarOverlay"
         class="fixed inset-0 bg-black/40 z-40 hidden pointer-events-none md:hidden"
         onclick="closeSidebar()"></div>

    <aside id="sidebar"
           class="fixed top-0 left-0 z-50 h-full w-[280px] bg-white border-r border-[#E5D8CC] transform -translate-x-full md:translate-x-0 transition-transform duration-300 flex flex-col">
        <div class="px-5 pt-6 pb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-[#5C4033] flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="font-['Poppins'] font-bold text-[15px] text-[#5C4033] leading-tight">JURNAL GURU</h1>
                    <p class="text-[11px] text-[#A08978] mt-0.5">Admin Sekolah</p>
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
            <button type="button" onclick="openAdminProfileModal()"  class="flex items-center gap-3 px-1.5 mb-3 rounded-lg hover:bg-[#F5EFE8] py-1.5">
                <div class="w-8 h-8 rounded-full bg-[#E8DFD6] flex items-center justify-center shrink-0">
                    <span class="text-xs font-bold text-[#5C4033]">{{ auth()->user()->initials() }}</span>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-[#3E3028] truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-[#A08978]">Administrator</p>
                </div>
            </button>
            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold text-[#C62828] hover:bg-[#FFEBEE] text-left">Logout</button>
            </form>
        </div>
    </aside>

    <div class="md:ml-[280px] min-h-screen">
        <div class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 sm:px-6 md:px-7 shadow-sm">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-[#D7B899] text-xs font-medium">Pantau jurnal dari akun kelas</p>
                    <h1 class="text-white font-['Poppins'] font-bold text-xl md:text-2xl">Jurnal Mengajar</h1>
                </div>
                <button type="button" onclick="openSidebar()" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white/10 shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-4">

            <section class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="flex flex-col justify-between gap-3 p-4 sm:flex-row sm:items-center sm:p-5">
                    <div>
                        <h2 class="font-['Poppins'] font-bold text-sm">Jurnal Susulan</h2>
                        <p class="mt-1 text-xs text-[#7A6A60]">{{ $jurnalSusulan->count() }} jurnal kemarin sudah dikirim guru.</p>
                    </div>
                    <a href="{{ route('admin.aturan-jurnal-susulan.edit') }}" class="w-fit rounded-lg border border-[#D8C9BC] px-3.5 py-2 text-xs font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Atur izin pengisian</a>
                </div>
                @if ($jurnalSusulan->isNotEmpty())
                    <div class="overflow-x-auto border-t border-[#E5D8CC]">
                        <table class="w-full min-w-[760px] text-left text-sm">
                            <thead class="bg-[#F5EFE8] text-[11px] uppercase tracking-wide text-[#7A6A60]"><tr><th class="px-4 py-3">Tanggal Jurnal</th><th class="px-4 py-3">Guru</th><th class="px-4 py-3">Kelas / Mapel</th><th class="px-4 py-3">Dikirim</th><th class="px-4 py-3">Status</th></tr></thead>
                            <tbody>
                                @foreach ($jurnalSusulan as $susulan)
                                    <tr class="border-t border-[#E5D8CC]">
                                        <td class="px-4 py-3"><span class="font-semibold">{{ $susulan->tanggal?->format('d/m/Y') }}</span><span class="ml-2 rounded-full bg-[#FFF8E7] px-2 py-1 text-[10px] font-bold text-[#A16207]">SUSULAN</span></td>
                                        <td class="px-4 py-3">{{ $susulan->jadwal?->guru?->name ?? '—' }}</td>
                                        <td class="px-4 py-3">{{ $susulan->jadwal?->kelas?->nama_kelas ?? '—' }} <span class="text-[#7A6A60]">• {{ $susulan->jadwal?->mapel?->nama_mapel ?? '—' }}</span></td>
                                        <td class="px-4 py-3 text-[#7A6A60]">{{ $susulan->waktu_submit?->format('d/m/Y H:i') ?? '—' }}</td>
                                        <td class="px-4 py-3"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $susulan->status_verifikasi === 'terverifikasi' ? 'bg-[#E8F5E9] text-[#2E7D32]' : 'bg-[#FFF8E7] text-[#A16207]' }}">{{ $susulan->status_verifikasi === 'terverifikasi' ? 'Terverifikasi' : 'Menunggu verifikasi' }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="border-t border-[#E5D8CC] px-5 py-6 text-sm text-[#7A6A60]">Belum ada jurnal susulan yang masuk.</div>
                @endif
            </section>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                <div class="bg-white rounded-lg p-3.5 border border-[#E5D8CC]"><p class="text-[11px] font-semibold text-[#7A6A60] uppercase">Total Jurnal</p><p class="font-['Poppins'] font-extrabold text-[22px] mt-1">{{ $jumlahJurnal }}</p></div>
                <div class="bg-white rounded-lg p-3.5 border border-[#E5D8CC]"><p class="text-[11px] font-semibold text-[#A16207] uppercase">Disetujui Piket</p><p class="font-['Poppins'] font-extrabold text-[22px] text-[#A16207] mt-1">{{ $jumlahDisetujui }}</p></div>
                <div class="bg-white rounded-lg p-3.5 border border-[#E5D8CC]"><p class="text-[11px] font-semibold text-[#C62828] uppercase">Ditolak Piket</p><p class="font-['Poppins'] font-extrabold text-[22px] text-[#C62828] mt-1">{{ $jumlahDitolak }}</p></div>
            </div>
            <section class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="border-b border-[#E5D8CC] p-4"><input id="cariJurnalAdmin" oninput="filterJurnalAdmin()" type="search" placeholder="Cari guru, kelas, atau mapel..." class="w-full rounded-lg border border-[#D8C9BC] px-3 py-2.5 text-sm"></div>
                <div class="overflow-x-auto"><table class="w-full min-w-[800px] text-left text-sm">
                    <thead class="bg-[#F5EFE8] text-[11px] uppercase text-[#7A6A60]"><tr><th class="px-4 py-3">Tanggal</th><th class="px-4 py-3">Guru</th><th class="px-4 py-3">Kelas / Mapel</th><th class="px-4 py-3">Materi</th><th class="px-4 py-3">Scan kelas</th><th class="px-4 py-3">Review piket</th></tr></thead>
                    <tbody id="daftarJurnalAdmin">
                    @forelse($jurnalSemua as $item)
                        <tr class="jurnal-admin-row border-t border-[#E5D8CC]" data-search="{{ strtolower(($item->jadwal->guru->name ?? '').' '.($item->jadwal->kelas->nama_kelas ?? '').' '.($item->jadwal->mapel->nama_mapel ?? '')) }}">
                            <td class="px-4 py-3">{{ $item->tanggal?->format('d/m/Y') }}<div class="text-xs text-[#7A6A60]">{{ $item->waktu_submit?->format('H:i') ?? '—' }}</div></td>
                            <td class="px-4 py-3">{{ $item->jadwal->guru->name ?? '—' }}</td>
                            <td class="px-4 py-3">{{ $item->jadwal->kelas->nama_kelas ?? '—' }}<div class="text-xs text-[#7A6A60]">{{ $item->jadwal->mapel->nama_mapel ?? '—' }} · Jam {{ $item->jadwal->jamPelajaran->jam_ke ?? '—' }}</div></td>
                            <td class="px-4 py-3">{{ $item->materi ?: '—' }}</td>
                            <td class="px-4 py-3">{{ $item->status_verifikasi === 'terverifikasi' ? 'Terverifikasi' : 'Menunggu' }}</td>
                            <td class="px-4 py-3">{{ ucfirst($item->status_piket ?? 'menunggu') }}@if($item->alasan_tolak)<div class="mt-1 text-xs text-rose-700">{{ $item->alasan_tolak }}</div>@endif</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-8 text-center text-[#7A6A60]">Belum ada jurnal tersimpan.</td></tr>
                    @endforelse
                    </tbody>
                </table></div>
            </section>
            <script>
                function filterJurnalAdmin() {
                    const q = document.getElementById('cariJurnalAdmin').value.trim().toLowerCase();
                    document.querySelectorAll('.jurnal-admin-row').forEach(row => row.classList.toggle('hidden', !window.matchesAllSearchTerms(q, row.dataset.search)));
                }
            </script>

    <script>
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            const overlay = document.getElementById('sidebarOverlay');
            overlay.classList.remove('hidden', 'pointer-events-none');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            const overlay = document.getElementById('sidebarOverlay');
            overlay.classList.add('hidden', 'pointer-events-none');
        }

        function filterJurnal() {
            const q = document.getElementById('cariKelas').value.toLowerCase().trim();
            const status = document.getElementById('filterStatus').value;
            document.querySelectorAll('.jurnal-row').forEach(function (row) {
                const cocokKelas = window.matchesAllSearchTerms(q, 'kelas ' + row.dataset.kelas, 'status ' + row.dataset.status, row.textContent);
                const cocokStatus = status === 'semua' || row.dataset.status === status;
                row.style.display = cocokKelas && cocokStatus ? '' : 'none';
            });
        }
        function filterKelas() { filterJurnal(); }

    </script>
    @include('admin.partials.admin_profile_modal')
    @include('shared.preserve_search_scroll')
</body>
</html>