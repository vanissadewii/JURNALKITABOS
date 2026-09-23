<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
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
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
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
                    Wakasiswa
                </a>

                <a href="{{ route('admin.user.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold bg-[#5C4033] text-white">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 21v-1a8 8 0 0 1 16 0v1"/>
                    </svg>
                    Guru
                </a>

                <a href="{{ route('admin.user.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 21v-1a8 8 0 0 1 16 0v1"/>
                    </svg>
                    Guru Piket
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
                    <a href="{{ route('admin.user.index') }}" class="inline-flex items-center gap-1.5 text-[#D7B899] text-xs font-medium hover:text-white transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
                        Kembali ke Daftar Guru
                    </a>
                    <h1 class="text-white font-['Poppins'] font-bold text-xl md:text-2xl mt-1">
                        Budi Santoso, S.Pd.
                    </h1>
                </div>
                <button type="button" onclick="openSidebar()" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white/10 shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-4">

            {{-- CARD: INFORMASI GURU --}}
            <div class="bg-white border border-[#E5D8CC] rounded-lg overflow-hidden">
                <div class="flex items-center gap-3 px-4 sm:px-5 py-4 border-b border-[#E5D8CC]">
                    <div class="w-11 h-11 rounded-lg bg-[#5C4033] flex items-center justify-center shrink-0 text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M4 21v-1a8 8 0 0 1 16 0v1"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-['Poppins'] font-bold text-[15px]">
                            Informasi Guru
                        </h2>
                        <p class="text-[12px] text-[#7A6A60] mt-0.5">
                            Data dasar guru pada sistem
                        </p>
                    </div>
                </div>

                <div class="p-4 sm:p-5 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                    <div>
                        <p class="text-[11px] font-semibold text-[#7A6A60] uppercase">Nama Lengkap</p>
                        <p class="text-[14px] font-semibold mt-1">Budi Santoso, S.Pd.</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-[#7A6A60] uppercase">NIP</p>
                        <p class="text-[14px] font-semibold mt-1">198203152009011005</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-[#7A6A60] uppercase">Mata Pelajaran</p>
                        <p class="text-[14px] font-semibold mt-1">Matematika</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-[#7A6A60] uppercase">Status</p>
                        <p class="text-[14px] font-semibold mt-1">Guru Tetap</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-[#7A6A60] uppercase">No. HP</p>
                        <p class="text-[14px] font-semibold mt-1">0812-3456-7890</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-[#7A6A60] uppercase">Email</p>
                        <p class="text-[14px] font-semibold mt-1">budi.santoso@sekolah.sch.id</p>
                    </div>
                </div>
            </div>

            {{-- CARD: RIWAYAT KEHADIRAN (TERPISAH DARI INFORMASI GURU) --}}
            <div class="bg-white border border-[#E5D8CC] rounded-lg overflow-hidden">
                <div class="flex items-center gap-3 px-4 sm:px-5 py-4 border-b border-[#E5D8CC]">
                    <div class="w-11 h-11 rounded-lg bg-[#5C4033] flex items-center justify-center shrink-0 text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="13" r="8"/>
                            <path d="M12 9v4l3 2"/>
                            <path d="M5 3L3 5M19 3l2 2"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-['Poppins'] font-bold text-[15px]">
                            Riwayat Kehadiran
                        </h2>
                        <p class="text-[12px] text-[#7A6A60] mt-0.5">
                            Rekap kehadiran mengajar berdasarkan data jurnal
                        </p>
                    </div>
                </div>

                {{-- RINGKASAN --}}
                <div class="px-4 sm:px-5 pt-4">
                    <div class="grid grid-cols-4 gap-2.5">
                        <div class="bg-[#E8F5E9] rounded-lg p-3 text-center">
                            <p class="font-['Poppins'] font-extrabold text-[18px] text-[#2E7D32]">18</p>
                            <p class="text-[10px] font-semibold text-[#2E7D32] uppercase mt-0.5">Hadir</p>
                        </div>
                        <div class="bg-[#E3F2FD] rounded-lg p-3 text-center">
                            <p class="font-['Poppins'] font-extrabold text-[18px] text-[#1976D2]">1</p>
                            <p class="text-[10px] font-semibold text-[#1976D2] uppercase mt-0.5">Izin</p>
                        </div>
                        <div class="bg-[#FFEBEE] rounded-lg p-3 text-center">
                            <p class="font-['Poppins'] font-extrabold text-[18px] text-[#C62828]">0</p>
                            <p class="text-[10px] font-semibold text-[#C62828] uppercase mt-0.5">Tidak Hadir</p>
                        </div>
                        <div class="bg-[#F5EFE8] rounded-lg p-3 text-center">
                            <p class="font-['Poppins'] font-extrabold text-[18px] text-[#5C4033]">19</p>
                            <p class="text-[10px] font-semibold text-[#5C4033] uppercase mt-0.5">Total Sesi</p>
                        </div>
                    </div>
                </div>

                {{-- FILTER RINGKAS --}}
                <div class="px-4 sm:px-5 pt-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="text-[11px] font-semibold text-[#7A6A60] uppercase">Dari Tanggal</label>
                            <input type="text" readonly value="01/09/2026"
                                   class="mt-1 w-full border border-[#E5D8CC] rounded-lg px-3 py-2.5 text-sm bg-[#FDFBF7]">
                        </div>
                        <div>
                            <label class="text-[11px] font-semibold text-[#7A6A60] uppercase">Sampai Tanggal</label>
                            <input type="text" readonly value="22/09/2026"
                                   class="mt-1 w-full border border-[#E5D8CC] rounded-lg px-3 py-2.5 text-sm bg-[#FDFBF7]">
                        </div>
                    </div>
                </div>

                {{-- LIST RIWAYAT PER SESI --}}
                <div class="p-4 sm:p-5 flex flex-col gap-2.5">

                    <div class="border border-[#E5D8CC] rounded-lg p-3.5">
                        <div class="flex flex-wrap items-start justify-between gap-2">
                            <div>
                                <p class="text-[13px] font-semibold">Senin, 21/09/2026 • Jam ke-1–2</p>
                                <p class="text-[12px] text-[#7A6A60] mt-0.5">X RPL 1 • Matematika</p>
                            </div>
                            <span class="text-[10px] font-bold px-2 py-1 rounded-md bg-[#E8F5E9] text-[#2E7D32] shrink-0">Hadir</span>
                        </div>
                    </div>

                    <div class="border border-[#E5D8CC] rounded-lg p-3.5">
                        <div class="flex flex-wrap items-start justify-between gap-2">
                            <div>
                                <p class="text-[13px] font-semibold">Senin, 21/09/2026 • Jam ke-5–8</p>
                                <p class="text-[12px] text-[#7A6A60] mt-0.5">XI RPL 1 • Matematika</p>
                            </div>
                            <span class="text-[10px] font-bold px-2 py-1 rounded-md bg-[#E8F5E9] text-[#2E7D32] shrink-0">Hadir</span>
                        </div>
                    </div>

                    <div class="border border-[#E5D8CC] rounded-lg p-3.5">
                        <div class="flex flex-wrap items-start justify-between gap-2 mb-1.5">
                            <div>
                                <p class="text-[13px] font-semibold">Jumat, 18/09/2026 • Jam ke-2–4</p>
                                <p class="text-[12px] text-[#7A6A60] mt-0.5">X RPL 2 • Matematika</p>
                            </div>
                            <span class="text-[10px] font-bold px-2 py-1 rounded-md bg-[#E3F2FD] text-[#1976D2] shrink-0">Izin</span>
                        </div>
                        <p class="text-[12px] text-[#7A6A60]">Tugas untuk kelas: Latihan Soal Bab 3 hlm. 40–42</p>
                    </div>

                    <div class="text-center pt-1">
                        <a href="{{ route('admin.jurnal') }}" class="text-[12px] font-semibold text-[#5C4033] hover:underline">
                            Lihat semua riwayat →
                        </a>
                    </div>

                </div>
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
    </script>

</body>
</html>