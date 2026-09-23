<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Mengajar - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
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
            <p class="px-3.5 mb-2 text-[14px] font-semibold uppercase tracking-wider text-[#5C4033]">Menu Utama</p>
            <div class="flex flex-col gap-0.5 mb-5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l9-9 9 9"/><path d="M5 10v10h14V10"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('jadwal.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    Jadwal
                </a>
                <a href="{{ route('admin.jurnal') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold bg-[#5C4033] text-white">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    Jurnal
                </a>
                <a href="{{ route('admin.verifikasi') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    Verifikasi
                </a>
                <a href="{{ route('admin.rekap') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
                    Rekap
                </a>
            </div>

            <p class="px-3.5 mb-2 text-[14px] font-semibold uppercase tracking-wider text-[#5C4033]">Data</p>
            <div class="flex flex-col gap-0.5 mb-5">
                <a href="{{ route('admin.user.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg>
                    Guru
                </a>
                <a href="{{ route('admin.siswa.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 3l9 5-9 5-9-5 9-5z"/><path d="M6 10.5v4.5c0 1.5 2.5 3 6 3s6-1.5 6-3v-4.5"/></svg>
                    Siswa
                </a>
                <a href="{{ route('admin.kelas.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="3" width="16" height="18" rx="1"/><path d="M14 12h.01"/></svg>
                    Kelas
                </a>
                <a href="{{ route('mapel.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 6c2-1 5-1 7 0v13c-2-1-5-1-7 0V6z"/><path d="M22 6c-2-1-5-1-7 0v13c2-1 5-1 7 0V6z"/></svg>
                    Mata Pelajaran
                </a>
            </div>

            <p class="px-3.5 mb-2 text-[14px] font-semibold uppercase tracking-wider text-[#5C4033]">Pengaturan</p>
            <div class="flex flex-col gap-0.5">
                <a href="{{ route('admin.tambah') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                    Tambah
                </a>
                <a href="{{ route('semester.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="M9 15.5l1.8 1.8L15 13.5"/></svg>
                    Semester
                </a>
                <a href="{{ route('jam-pelajaran.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028] hover:bg-[#F5EFE8]">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="13" r="8"/><path d="M12 9v4l3 2"/><path d="M5 3L3 5M19 3l2 2"/></svg>
                    Jam Pelajaran
                </a>
            </div>
        </nav>

        <div class="border-t border-[#E5D8CC] px-4 py-4">
            <a href="{{ route('admin.profil') }}" class="flex items-center gap-3 px-1.5 mb-3 rounded-lg hover:bg-[#F5EFE8] py-1.5">
                <div class="w-8 h-8 rounded-full bg-[#E8DFD6] flex items-center justify-center shrink-0">
                    <span class="text-xs font-bold text-[#5C4033]">AT</span>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-[#3E3028] truncate">Admin Testing</p>
                    <p class="text-[11px] text-[#A08978]">Administrator</p>
                </div>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold text-[#C62828] hover:bg-[#FFEBEE] text-left">Logout</button>
            </form>
        </div>
    </aside>

    <div class="md:ml-[280px] min-h-screen">
        <div class="bg-[#5C4033] px-4 py-5 sm:px-6 md:px-7">
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

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                <div class="bg-white rounded-lg p-3.5 border border-[#E5D8CC]">
                    <p class="text-[11px] font-semibold text-[#7A6A60] uppercase">Total Jurnal Masuk</p>
                    <p class="font-['Poppins'] font-extrabold text-[22px] mt-1">18</p>
                </div>
                <div class="bg-white rounded-lg p-3.5 border border-[#E5D8CC]">
                    <p class="text-[11px] font-semibold text-[#F57F17] uppercase">Menunggu Piket</p>
                    <p class="font-['Poppins'] font-extrabold text-[22px] text-[#F57F17] mt-1">5</p>
                </div>
                <div class="bg-white rounded-lg p-3.5 border border-[#E5D8CC]">
                    <p class="text-[11px] font-semibold text-[#2E7D32] uppercase">Sudah Dicek Piket</p>
                    <p class="font-['Poppins'] font-extrabold text-[22px] text-[#2E7D32] mt-1">13</p>
                </div>
            </div>

            <div class="bg-white border border-[#E5D8CC] rounded-lg p-4">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="text-[11px] font-semibold text-[#7A6A60] uppercase">Status</label>
                        <select class="mt-1 w-full border border-[#E5D8CC] rounded-lg px-3 py-2.5 text-sm bg-[#FDFBF7]">
                            <option value="">Semua Status</option>
                            <option>Menunggu Piket</option>
                            <option>Sudah Dicek Piket</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-[11px] font-semibold text-[#7A6A60] uppercase">Cari Kelas</label>
                        <div class="relative mt-1">
                            <input type="text" id="cariKelas" oninput="filterKelas()" placeholder="Cari nama kelas..."
                                   class="w-full border border-[#E5D8CC] rounded-lg px-3 py-2.5 pr-10 text-sm bg-[#FDFBF7]">
                            <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#A08978]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="6"/><path d="m16 16 4 4"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                    <label class="text-[11px] font-semibold text-[#7A6A60] uppercase">Tanggal</label>
                    <input type="text"
                        id="filterTanggal"
                        name="tanggal"
                        class="mt-1 w-full border border-[#E5D8CC] rounded-lg px-3 py-2.5 text-sm bg-[#FDFBF7]"
                        readonly>
                    </div>

                    <!-- CDN Flatpickr -->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>

                    <script>
                        flatpickr("#filterTanggal", {
                        dateFormat: "Y-m-d",   // format yang dikirim ke server (buat Laravel)
                        altInput: true,        // tampilkan format lain ke user
                        altFormat: "d/m/Y",    // format yang DILIHAT user: dd/mm/yyyy
                        defaultDate: "{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                    });
                </script>
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <div data-kelas="XI RPL 2" class="bg-white border border-[#E5D8CC] rounded-lg p-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <div class="flex flex-wrap items-center gap-2">
                                <p class="font-['Poppins'] font-bold text-[16px]">XI RPL 2</p>
                                <span class="text-[11px] font-bold px-2.5 py-1 rounded-md bg-[#FFFDE7] text-[#F57F17]">Menunggu Piket</span>
                            </div>
                            <p class="text-[13px] text-[#7A6A60] mt-1">4 sesi</p>
                            <p class="text-[12px] text-[#A08978] mt-0.5">Waktu kirim: 15:10</p>
                        </div>
                        <button type="button" onclick="openDetailModal('XI RPL 2')"
                                class="relative z-10 text-sm font-semibold px-4 py-2 rounded-lg bg-[#5C4033] text-white hover:bg-[#432D23] shrink-0">
                            Detail
                        </button>
                    </div>
                </div>

                <div data-kelas="X RPL 1" class="bg-white border border-[#E5D8CC] rounded-lg p-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <div class="flex flex-wrap items-center gap-2">
                                <p class="font-['Poppins'] font-bold text-[16px]">X RPL 1</p>
                                <span class="text-[11px] font-bold px-2.5 py-1 rounded-md bg-[#E8F5E9] text-[#2E7D32]">Sudah Dicek Piket</span>
                            </div>
                            <p class="text-[13px] text-[#7A6A60] mt-1">4 sesi</p>
                            <p class="text-[12px] text-[#A08978] mt-0.5">Dicek piket: Budi Hartono • 15:00</p>
                        </div>
                        <button type="button" onclick="openDetailModal('X RPL 1')"
                                class="relative z-10 text-sm font-semibold px-4 py-2 rounded-lg border border-[#E5D8CC] hover:bg-[#F5EFE8] shrink-0">
                            Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="detailModal" class="fixed inset-0 bg-black/50 z-[60] hidden">
        <div class="min-h-full flex items-start sm:items-center justify-center p-3 sm:p-5 overflow-y-auto">
            <div class="bg-white rounded-xl w-full max-w-4xl my-2 sm:my-6 flex flex-col shadow-xl max-h-[95vh]">

                <div class="bg-[#5C4033] px-4 py-3.5 flex items-center justify-between gap-3 text-white shrink-0 rounded-t-xl">
                    <div class="min-w-0">
                        <h3 class="font-['Poppins'] font-bold text-base truncate" id="modalTitle">Detail Jurnal</h3>
                        <p class="text-[11px] text-[#D7B899] mt-0.5" id="modalTanggal">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                    </div>
                    <button type="button" onclick="closeDetailModal()"
                            class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-white/10 text-white text-2xl leading-none shrink-0"
                            aria-label="Tutup">&times;</button>
                </div>

                <div class="p-3 sm:p-5 overflow-y-auto flex-1 bg-[#FDFBF7]">
                    <div class="flex flex-col gap-3">

                        <div class="bg-white border border-[#E5D8CC] rounded-lg p-3.5">
                            <div class="flex flex-wrap items-start justify-between gap-2 mb-2">
                                <div>
                                    <p class="text-[11px] font-bold text-[#A08978] uppercase">Jam ke-1</p>
                                    <p class="font-['Poppins'] font-bold text-[14px] mt-0.5">Bahasa Jepang</p>
                                    <p class="text-[12px] text-[#7A6A60]">Sulistyowati, SS.</p>
                                </div>
                                <span class="text-[11px] font-bold px-2 py-1 rounded-md bg-[#FFEBEE] text-[#C62828]">Tidak Hadir + Tugas</span>
                            </div>
                            <p class="text-[12px]"><span class="font-semibold">Materi:</span> Latihan Bahasa Jepang hlm. 25</p>
                            <p class="text-[12px] text-[#7A6A60] mt-1">Keadaan siswa: —</p>
                        </div>

                        <div class="bg-white border border-[#E5D8CC] rounded-lg p-3.5">
                            <div class="flex flex-wrap items-start justify-between gap-2 mb-2">
                                <div>
                                    <p class="text-[11px] font-bold text-[#A08978] uppercase">Jam ke-2 – 4</p>
                                    <p class="font-['Poppins'] font-bold text-[14px] mt-0.5">PJOK</p>
                                    <p class="text-[12px] text-[#7A6A60]">Zainul Arifin, S.Pd.</p>
                                </div>
                                <span class="text-[11px] font-bold px-2 py-1 rounded-md bg-[#FFEBEE] text-[#C62828]">Tidak Hadir</span>
                            </div>
                            <p class="text-[12px] text-[#7A6A60] italic">Materi: —</p>
                            <p class="text-[12px] text-[#7A6A60] mt-1">Keadaan siswa: —</p>
                        </div>

                        <div class="bg-white border border-[#E5D8CC] rounded-lg p-3.5">
                            <div class="flex flex-wrap items-start justify-between gap-2 mb-2">
                                <div>
                                    <p class="text-[11px] font-bold text-[#A08978] uppercase">Jam ke-5 – 8</p>
                                    <p class="font-['Poppins'] font-bold text-[14px] mt-0.5">Matematika</p>
                                    <p class="text-[12px] text-[#7A6A60]">Badrus Sulaiman, S.Pd., Gr.</p>
                                </div>
                                <span class="text-[11px] font-bold px-2 py-1 rounded-md bg-[#E8F5E9] text-[#2E7D32]">Hadir</span>
                            </div>
                            <p class="text-[12px]"><span class="font-semibold">Materi:</span> Persamaan dan Pertidaksamaan</p>
                            <p class="text-[12px] mt-1"><span class="font-semibold">Jumlah hadir:</span> 32</p>
                            <div class="mt-2 border-t border-[#E5D8CC] pt-2">
                                <p class="text-[11px] font-semibold text-[#7A6A60] uppercase mb-1.5">Siswa tidak hadir</p>
                                <div class="flex flex-col gap-1 text-[12px]">
                                    <div class="flex justify-between gap-2"><span>Rizki Pratama</span><span class="font-bold text-[#2E7D32]">D</span></div>
                                    <div class="flex justify-between gap-2"><span>Nadia Putri</span><span class="font-bold text-[#2E7D32]">D</span></div>
                                    <div class="flex justify-between gap-2"><span>Fajar Nugroho</span><span class="font-bold text-[#2E7D32]">D</span></div>
                                    <div class="flex justify-between gap-2"><span>Andi Saputra</span><span class="font-bold text-[#1976D2]">S</span></div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-[#E5D8CC] rounded-lg p-3.5">
                            <div class="flex flex-wrap items-start justify-between gap-2 mb-2">
                                <div>
                                    <p class="text-[11px] font-bold text-[#A08978] uppercase">Jam ke-9 – 10</p>
                                    <p class="font-['Poppins'] font-bold text-[14px] mt-0.5">Bahasa Inggris</p>
                                    <p class="text-[12px] text-[#7A6A60]">Siti Aminah, S.Pd.</p>
                                </div>
                                <span class="text-[11px] font-bold px-2 py-1 rounded-md bg-[#E8F5E9] text-[#2E7D32]">Hadir</span>
                            </div>
                            <p class="text-[12px]"><span class="font-semibold">Materi:</span> Asking and Giving Opinion</p>
                            <p class="text-[12px] mt-1"><span class="font-semibold">Jumlah hadir:</span> 35</p>
                            <div class="mt-2 border-t border-[#E5D8CC] pt-2">
                                <p class="text-[11px] font-semibold text-[#7A6A60] uppercase mb-1.5">Siswa tidak hadir</p>
                                <div class="flex justify-between gap-2 text-[12px]"><span>Nadia Putri</span><span class="font-bold text-[#2E7D32]">D</span></div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="bg-white px-4 py-3 border-t border-[#E5D8CC] flex items-center justify-end gap-3 shrink-0 rounded-b-xl">
                    <button type="button" onclick="closeDetailModal()"
                            class="px-4 py-2 rounded-lg border border-[#E5D8CC] text-sm font-semibold hover:bg-[#F5EFE8] shrink-0">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

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

        function filterKelas() {
            const q = document.getElementById('cariKelas').value.toLowerCase().trim();
            document.querySelectorAll('[data-kelas]').forEach(function (el) {
                el.style.display = el.getAttribute('data-kelas').toLowerCase().includes(q) ? '' : 'none';
            });
        }

        function openDetailModal(nama) {
            var modal = document.getElementById('detailModal');
            var title = document.getElementById('modalTitle');
            if (title) title.innerText = 'Detail Jurnal - ' + nama;
            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }
        function closeDetailModal() {
            var modal = document.getElementById('detailModal');
            if (modal) modal.classList.add('hidden');
            document.body.style.overflow = '';
        }
    </script>
</body>
</html>