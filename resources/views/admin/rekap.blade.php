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

            <div class="flex flex-col gap-0.5 mb-5">

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 12l9-9 9 9"/>
                        <path d="M5 10v10h14V10"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('jadwal.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <path d="M16 2v4M8 2v4M3 10h18"/>
                    </svg>
                    Jadwal
                </a>

                <a href="{{ route('admin.jurnal') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>
                    Jurnal
                </a>

                <a href="{{ route('admin.verifikasi') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    Verifikasi
                </a>

                <a href="{{ route('admin.rekap') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold bg-[#5C4033] text-white">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <path d="M14 2v6h6"/>
                        <path d="M16 13H8"/>
                        <path d="M16 17H8"/>
                        <path d="M10 9H8"/>
                    </svg>
                    Rekap
                </a>

            </div>

            <p class="px-3.5 mb-2 text-[14px] font-semibold uppercase tracking-wider text-[#5C4033]">
                Data
            </p>

            <div class="flex flex-col gap-0.5 mb-5">

                <a href="{{ route('admin.user.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 21v-1a8 8 0 0 1 16 0v1"/>
                    </svg>
                    Guru
                </a>

                <a href="{{ route('admin.siswa.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 3l9 5-9 5-9-5 9-5z"/>
                        <path d="M6 10.5v4.5c0 1.5 2.5 3 6 3s6-1.5 6-3v-4.5"/>
                    </svg>
                    Siswa
                </a>

                <a href="{{ route('admin.kelas.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="4" y="3" width="16" height="18" rx="1"/>
                        <path d="M14 12h.01"/>
                    </svg>
                    Kelas
                </a>

                <a href="{{ route('mapel.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M2 6c2-1 5-1 7 0v13c-2-1-5-1-7 0V6z"/>
                        <path d="M22 6c-2-1-5-1-7 0v13c2-1 5-1 7 0V6z"/>
                    </svg>
                    Mata Pelajaran
                </a>

            </div>

            <p class="px-3.5 mb-2 text-[14px] font-semibold uppercase tracking-wider text-[#5C4033]">
                Pengaturan
            </p>

            <div class="flex flex-col gap-0.5">

                <a href="{{ route('admin.tambah') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Tambah
                </a>

                <a href="{{ route('semester.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <path d="M16 2v4M8 2v4M3 10h18"/>
                        <path d="M9 15.5l1.8 1.8L15 13.5"/>
                    </svg>
                    Semester
                </a>

                <a href="{{ route('jam-pelajaran.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="13" r="8"/>
                        <path d="M12 9v4l3 2"/>
                        <path d="M5 3L3 5M19 3l2 2"/>
                    </svg>
                    Jam Pelajaran
                </a>

            </div>
        </nav>

        <div class="border-t border-[#E5D8CC] px-4 py-4">

            <a href="{{ route('admin.profil') }}"
               class="flex items-center gap-3 px-1.5 mb-3 rounded-lg hover:bg-[#F5EFE8] py-1.5 transition">

                <div class="w-8 h-8 rounded-full bg-[#E8DFD6] flex items-center justify-center shrink-0">
                    <span class="text-xs font-bold text-[#5C4033]">AT</span>
                </div>

                <div class="min-w-0">
                    <p class="text-sm font-semibold text-[#3E3028] truncate">
                        Admin Testing
                    </p>
                    <p class="text-[11px] text-[#A08978]">
                        Administrator
                    </p>
                </div>

            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold text-[#C62828] hover:bg-[#FFEBEE] text-left">
                    Logout
                </button>
            </form>

        </div>
    </aside>

    <div class="md:ml-[280px] min-h-screen">
        <div class="bg-[#5C4033] px-4 py-5 sm:px-6 md:px-7">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-[#D7B899] text-xs font-medium">Rekap jurnal & kehadiran</p>
                    <h1 class="text-white font-['Poppins'] font-bold text-xl md:text-2xl">Rekap</h1>
                </div>
                <div class="flex items-center gap-2">
                    {{-- TOMBOL EXPORT EXCEL --}}
                    <a href="#"
                       class="inline-flex items-center gap-2 text-[12px] font-semibold px-3 sm:px-3.5 py-2 rounded-lg bg-white text-[#5C4033] hover:bg-[#F5EFE8]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        <span class="hidden xs:inline sm:inline">Export Excel</span>
                    </a>
                    <button type="button" onclick="openSidebar()" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white/10">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-4">

            {{-- FILTER --}}
            <div class="bg-white border border-[#E5D8CC] rounded-lg p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    <div>
                        <label class="text-[11px] font-semibold text-[#7A6A60] uppercase">Periode</label>
                        <select id="periode" onchange="handlePeriodeChange()"
                                class="mt-1 w-full border border-[#E5D8CC] rounded-lg px-3 py-2.5 text-sm bg-[#FDFBF7]">
                            <option value="hari" selected>Hari Ini</option>
                            <option value="custom">Custom</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-[11px] font-semibold text-[#7A6A60] uppercase">Dari Tanggal</label>
                        <div class="relative mt-1">
                            <input type="text" id="dariTanggal" readonly
                                   value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}"
                                   class="w-full border border-[#E5D8CC] rounded-lg pl-3 pr-9 py-2.5 text-sm bg-[#F0EAE2] text-[#7A6A60] cursor-not-allowed">
                            <svg id="dariTanggalIcon" class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-[#A08978] pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <label class="text-[11px] font-semibold text-[#7A6A60] uppercase">Sampai Tanggal</label>
                        <div class="relative mt-1">
                            <input type="text" id="sampaiTanggal" readonly
                                   value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}"
                                   class="w-full border border-[#E5D8CC] rounded-lg pl-3 pr-9 py-2.5 text-sm bg-[#F0EAE2] text-[#7A6A60] cursor-not-allowed">
                            <svg id="sampaiTanggalIcon" class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-[#A08978] pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                        </div>
                    </div>
                    <div>

                        <label class="text-[11px] font-semibold text-[#7A6A60] uppercase">Kelas</label>
                        <div class="mt-1">
                            <input type="text" id="cariKelas" list="daftarKelas" placeholder="Cari kelas..."
                                   autocomplete="off" oninput="terapkanFilter()"
                                   class="w-full border border-[#E5D8CC] rounded-lg px-3 py-2.5 text-sm bg-[#FDFBF7]">
                            <datalist id="daftarKelas">
                                <option value="X RPL 1"></option>
                                <option value="X RPL 2"></option>
                                <option value="XI RPL 2"></option>
                                <option value="X TKI 1"></option>
                            </datalist>
                        </div>
                    </div>
                </div>
                {{-- tombol Tampilkan sengaja dihapus: saat Periode "Custom" & tanggal diganti, --}}
                {{-- hasil rekap langsung ke-update otomatis (auto-submit), ga perlu tombol manual --}}
            </div>

            {{-- RINGKASAN --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5">
                <div class="bg-white rounded-lg p-3.5 border border-[#E5D8CC]">
                    <p class="text-[11px] font-semibold text-[#7A6A60] uppercase">Jurnal Masuk</p>
                    <p class="font-['Poppins'] font-extrabold text-[22px] mt-1">86</p>
                </div>
                <div class="bg-white rounded-lg p-3.5 border border-[#E5D8CC]">
                    <p class="text-[11px] font-semibold text-[#2E7D32] uppercase">Dicek Piket</p>
                    <p class="font-['Poppins'] font-extrabold text-[22px] text-[#2E7D32] mt-1">79</p>
                </div>
                <div class="bg-white rounded-lg p-3.5 border border-[#E5D8CC]">
                    <p class="text-[11px] font-semibold text-[#F57F17] uppercase">Belum Dicek</p>
                    <p class="font-['Poppins'] font-extrabold text-[22px] text-[#F57F17] mt-1">7</p>
                </div>
                <div class="bg-white rounded-lg p-3.5 border border-[#E5D8CC]">
                    <p class="text-[11px] font-semibold text-[#C62828] uppercase">Guru Tidak Hadir</p>
                    <p class="font-['Poppins'] font-extrabold text-[22px] text-[#C62828] mt-1">12</p>
                </div>
            </div>

            {{-- REKAP PER KELAS & REKAP KEHADIRAN GURU (BERSANDINGAN) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">

                {{-- REKAP PER KELAS --}}
                <div class="bg-white border border-[#E5D8CC] rounded-lg overflow-hidden">
                    <div class="px-4 py-3 border-b border-[#E5D8CC] bg-[#F5EFE8] flex items-center justify-between gap-2">
                        <h2 class="font-['Poppins'] font-bold text-sm uppercase">Rekap per Kelas</h2>
                        <span class="text-[11px] text-[#7A6A60]">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-[460px] w-full text-left text-[13px] border-collapse">
                            <thead>
                                <tr class="bg-[#FDFBF7]">
                                    <th class="px-4 py-3 border border-[#E5D8CC] text-[11px] font-semibold uppercase text-[#5C4033]">Kelas</th>
                                    <th class="px-4 py-3 border border-[#E5D8CC] text-[11px] font-semibold uppercase text-[#5C4033] text-center">Jurnal</th>
                                    <th class="px-4 py-3 border border-[#E5D8CC] text-[11px] font-semibold uppercase text-[#5C4033] text-center">Dicek Piket</th>
                                    <th class="px-4 py-3 border border-[#E5D8CC] text-[11px] font-semibold uppercase text-[#5C4033] text-center">Belum</th>
                                    <th class="px-4 py-3 border border-[#E5D8CC] text-[11px] font-semibold uppercase text-[#5C4033] text-center">Guru TH</th>
                                    <th class="px-4 py-3 border border-[#E5D8CC] text-[11px] font-semibold uppercase text-[#5C4033]">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-3 border border-[#E5D8CC] font-semibold">X RPL 1</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">12</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center text-[#2E7D32] font-semibold">11</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center text-[#F57F17] font-semibold">1</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">2</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC]">
                                        <a href="{{ route('admin.jurnal') }}"
                                           class="inline-flex items-center px-3 py-1.5 rounded-md text-[12px] font-semibold bg-[#5C4033] text-white hover:bg-[#432D23]">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 border border-[#E5D8CC] font-semibold">X RPL 2</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">12</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center text-[#2E7D32] font-semibold">12</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">0</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">1</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC]">
                                        <a href="{{ route('admin.jurnal') }}"
                                           class="inline-flex items-center px-3 py-1.5 rounded-md text-[12px] font-semibold bg-[#5C4033] text-white hover:bg-[#432D23]">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 border border-[#E5D8CC] font-semibold">XI RPL 2</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">11</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center text-[#2E7D32] font-semibold">10</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center text-[#F57F17] font-semibold">1</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">3</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC]">
                                        <a href="{{ route('admin.jurnal') }}"
                                           class="inline-flex items-center px-3 py-1.5 rounded-md text-[12px] font-semibold bg-[#5C4033] text-white hover:bg-[#432D23]">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 border border-[#E5D8CC] font-semibold">X TKI 1</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">10</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center text-[#2E7D32] font-semibold">9</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center text-[#F57F17] font-semibold">1</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">0</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC]">
                                        <a href="{{ route('admin.jurnal') }}"
                                           class="inline-flex items-center px-3 py-1.5 rounded-md text-[12px] font-semibold bg-[#5C4033] text-white hover:bg-[#432D23]">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- REKAP KEHADIRAN GURU --}}
                <div class="bg-white border border-[#E5D8CC] rounded-lg overflow-hidden">
                    <div class="px-4 py-3 border-b border-[#E5D8CC] bg-[#F5EFE8]">
                        <h2 class="font-['Poppins'] font-bold text-sm uppercase">Rekap Kehadiran Guru</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-[460px] w-full text-left text-[13px] border-collapse">
                            <thead>
                                <tr class="bg-[#FDFBF7]">
                                    <th class="px-4 py-3 border border-[#E5D8CC] text-[11px] font-semibold uppercase text-[#5C4033]">Nama Guru</th>
                                    <th class="px-4 py-3 border border-[#E5D8CC] text-[11px] font-semibold uppercase text-[#5C4033] text-center">Hadir</th>
                                    <th class="px-4 py-3 border border-[#E5D8CC] text-[11px] font-semibold uppercase text-[#5C4033] text-center">Izin</th>
                                    <th class="px-4 py-3 border border-[#E5D8CC] text-[11px] font-semibold uppercase text-[#5C4033] text-center">Tidak Hadir</th>
                                    <th class="px-4 py-3 border border-[#E5D8CC] text-[11px] font-semibold uppercase text-[#5C4033] text-center">Total Sesi</th>
                                    <th class="px-4 py-3 border border-[#E5D8CC] text-[11px] font-semibold uppercase text-[#5C4033]">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-3 border border-[#E5D8CC]">Budi Santoso, S.Pd.</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center text-[#2E7D32] font-semibold">18</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">1</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">0</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">19</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC]">
                                        <a href="{{ route('admin.sesi') }}"
                                           class="inline-flex items-center px-3 py-1.5 rounded-md text-[12px] font-semibold bg-[#5C4033] text-white hover:bg-[#432D23]">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 border border-[#E5D8CC]">Siti Aminah, S.Pd.</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center text-[#2E7D32] font-semibold">15</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">0</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center text-[#C62828] font-semibold">2</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">17</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC]">
                                        <a href="{{ route('admin.sesi') }}"
                                           class="inline-flex items-center px-3 py-1.5 rounded-md text-[12px] font-semibold bg-[#5C4033] text-white hover:bg-[#432D23]">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 border border-[#E5D8CC]">Zainul Arifin, S.Pd.</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center text-[#2E7D32] font-semibold">12</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">2</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center text-[#C62828] font-semibold">3</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC] text-center">17</td>
                                    <td class="px-4 py-3 border border-[#E5D8CC]">
                                        <a href="{{ route('admin.sesi') }}"
                                           class="inline-flex items-center px-3 py-1.5 rounded-md text-[12px] font-semibold bg-[#5C4033] text-white hover:bg-[#432D23]">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.remove('hidden');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.add('hidden');
        }

        // Format tanggal dipaksa dd/mm/yyyy oleh flatpickr sendiri (bukan ikut locale browser)
        let fpDari, fpSampai;

        document.addEventListener('DOMContentLoaded', function () {
            const opsi = {
                dateFormat: 'd/m/Y',
                defaultDate: 'today',
                allowInput: false,
                disableMobile: true,
                onChange: function () {
                    // begitu tanggal custom diganti, langsung terapkan filter otomatis
                    terapkanFilter();
                },
            };
            fpDari = flatpickr('#dariTanggal', opsi);
            fpSampai = flatpickr('#sampaiTanggal', opsi);
            handlePeriodeChange();
        });

        // TODO (backend): panggil endpoint/rekap sesuai periode, dariTanggal, sampaiTanggal, cariKelas,
        // lalu update angka ringkasan & isi kedua tabel. Untuk sekarang cuma placeholder.
        function terapkanFilter() {
            console.log('Terapkan filter otomatis:', {
                periode: document.getElementById('periode').value,
                dari: document.getElementById('dariTanggal').value,
                sampai: document.getElementById('sampaiTanggal').value,
                kelas: document.getElementById('cariKelas').value,
            });
        }

        function handlePeriodeChange() {
            const periode = document.getElementById('periode').value;
            const isHariIni = periode === 'hari';

            [fpDari, fpSampai].forEach(fp => {
                fp.set('clickOpens', !isHariIni);
                fp.input.disabled = isHariIni;
                fp.input.classList.toggle('bg-[#F0EAE2]', isHariIni);
                fp.input.classList.toggle('text-[#7A6A60]', isHariIni);
                fp.input.classList.toggle('cursor-not-allowed', isHariIni);
                fp.input.classList.toggle('bg-[#FDFBF7]', !isHariIni);
                fp.input.classList.toggle('text-[#3E3028]', !isHariIni);
                fp.input.classList.toggle('cursor-pointer', !isHariIni);

                if (isHariIni) {
                    fp.setDate(new Date(), true);
                }
            });

            terapkanFilter();

            const iconDari = document.getElementById('dariTanggalIcon');
            const iconSampai = document.getElementById('sampaiTanggalIcon');
            [iconDari, iconSampai].forEach(icon => {
                icon.classList.toggle('text-[#A08978]', isHariIni);
                icon.classList.toggle('text-[#5C4033]', !isHariIni);
            });
        }
    </script>
</body>
</html>