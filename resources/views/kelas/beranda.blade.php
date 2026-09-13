<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen">

    <div class="md:flex">

        {{-- SIDEBAR (desktop) --}}
        <aside class="hidden md:flex md:flex-col md:w-64 md:h-screen md:sticky md:top-0
                       bg-white border-r border-[#E5D8CC] py-6 px-4">

            <div class="mb-8 px-2">
                <h1 class="font-['Poppins'] font-bold text-xl text-[#5C4033]">JURNAL GURU</h1>
                <p class="text-md text-[#7A6A60] mt-1">Akun Kelas</p>
            </div>

            <nav class="flex flex-col gap-1">
                <a href="{{ route('kelas.beranda') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md font-semibold bg-[#F5EFE8] text-[#5C4033]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12l9-9 9 9"/><path d="M5 10v10h14V10"/>
                    </svg>
                    Dasbor
                </a>
                <a href="{{ route('kelas.scan') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                    </svg>
                    Scan
                </a>
                <a href="{{ route('kelas.kirim-jurnal') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/>
                    </svg>
                    Kirim Jurnal
                </a>
                <a href="{{ route('kelas.profile') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>
                    </svg>
                    Profil
                </a>
            </nav>
        </aside>

        {{-- KONTEN UTAMA --}}
        <main class="flex-1 w-full pb-24 md:pb-8">

            {{-- HEADER --}}
            <div class="bg-[#5C4033] px-4 py-5 sm:px-6 sm:py-6 md:px-7 md:py-7 flex flex-col gap-1">
                <span class="text-[#FFFFFF] text-[20px] font-['Poppins']">Hai 👋</span>
                <span class="text-white text-xl md:text-3xl font-['Poppins'] font-bold">
                    XI RPL 2
                </span>
                <span class="text-[#D7B899] text-xs font-medium mt-0.8">
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                </span>
            </div>

            {{-- ISI --}}
            <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-3.5">

                <span class="font-['Poppins'] font-bold text-md uppercase text-[#3E3028] mt-1">
                    Sesi Mengajar Aktif
                </span>

                {{-- ===== MATEMATIKA ===== --}}
                <div class="bg-white border border-[#E5D8CC] rounded-[10px] p-4 sm:p-[18px] md:p-5
                            flex flex-col gap-4 shadow-[0_4px_12px_rgba(62,48,40,0.03)]">

                    <div class="flex justify-between items-start sm:items-center gap-3">
                        <div>
                            <div class="font-['Poppins'] font-bold text-base sm:text-lg text-[#3E3028]">Matematika</div>
                            <div class="font-['Inter'] font-semibold text-xs sm:text-sm text-[#7A6A60] mt-0.5">Badrus Sulaiman, S.Pd., Gr.</div>
                        </div>
                        <span class="text-[10px] sm:text-[11px] font-semibold px-2 sm:px-2.5 py-1 rounded-md whitespace-nowrap bg-[#FFFDE7] text-[#F57F17]">
                            Sedang Berjalan
                        </span>
                    </div>

                    <hr class="border-t border-[#E5D8CC] w-full m-0">

                    <div class="flex items-center gap-1.5 text-[13px] text-[#7A6A60] font-['Inter']">
                        <svg class="shrink-0" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#7A6A60" stroke-width="2">
                            <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>
                        </svg>
                        <span>10:00 – 13:50 (Jam ke-5 sampai ke-8)</span>
                    </div>

                    <div class="flex items-center gap-2 font-['Inter'] text-[13px] font-semibold text-[#2E7D32]">
                        <div class="w-5 h-5 rounded-[5px] bg-[#4CAF50] flex items-center justify-center">
                            <svg class="w-[13px] h-[13px]" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3">
                                <path d="M5 12l4 4L19 6"/>
                            </svg>
                        </div>
                        <span>Kehadiran terverifikasi</span>
                    </div>

                    {{-- SISWA DISPEN (bisa diklik) --}}
                    <div class="bg-[#FFF8E1] border border-[#FFE082] rounded-[8px] overflow-hidden">
                        <button type="button"
                                onclick="toggleDispen(this)"
                                class="w-full flex items-center justify-between gap-2 p-3 sm:p-3.5 text-left hover:bg-[#FFF3C4] transition">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 rounded-[5px] bg-[#F9A825] flex items-center justify-center shrink-0">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                </div>
                                <span class="font-['Inter'] font-semibold text-[13px] text-[#3E3028]">
                                    Siswa Dispensasi (2)
                                </span>
                            </div>
                            <svg class="w-4 h-4 text-[#7A6A60] transition-transform duration-200 arrow-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M6 9l6 6 6-6"/>
                            </svg>
                        </button>

                        <div class="dispen-content hidden px-3 sm:px-3.5 pb-3 sm:pb-3.5">
                            <div class="flex flex-col gap-1.5 pt-1 border-t border-[#FFE082]">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-[13px] text-[#3E3028]">Rizki Pratama</span>
                                    <span class="text-[11px] font-medium text-[#7A6A60]">Jam ke-5 s/d 8</span>
                                </div>
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-[13px] text-[#3E3028]">Nadia Putri</span>
                                    <span class="text-[11px] font-medium text-[#7A6A60]">Jam ke-5 s/d 10</span>
                                </div>
                            </div>
                            <p class="text-[11px] text-[#7A6A60] mt-2.5 pt-2 border-t border-[#FFE082]">
                                Disetujui oleh Waka: <span class="font-semibold text-[#3E3028]">Bu Rina</span>
                            </p>
                        </div>
                    </div>

                    {{-- SISWA SAKIT / ALPA / IZIN (diinput guru di kelas) --}}
                    <div class="bg-[#FFEBEE] border border-[#FFCDD2] rounded-[8px] overflow-hidden">
                        <button type="button"
                                onclick="toggleDispen(this)"
                                class="w-full flex items-center justify-between gap-2 p-3 sm:p-3.5 text-left hover:bg-[#FFCDD2]/50 transition">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 rounded-[5px] bg-[#E53935] flex items-center justify-center shrink-0">
                                    <span class="text-white text-[11px] font-bold">!</span>
                                </div>
                                <span class="font-['Inter'] font-semibold text-[13px] text-[#3E3028]">
                                    Siswa Tidak Hadir (1)
                                </span>
                            </div>
                            <svg class="w-4 h-4 text-[#7A6A60] transition-transform duration-200 arrow-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M6 9l6 6 6-6"/>
                            </svg>
                        </button>

                        <div class="dispen-content hidden px-3 sm:px-3.5 pb-3 sm:pb-3.5">
                            <div class="flex flex-col gap-1.5 pt-1 border-t border-[#FFCDD2]">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-[13px] text-[#3E3028]">Andi Saputra</span>
                                    <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-[#FFCDD2] text-[#C62828]">Sakit</span>
                                </div>
                            </div>
                            <p class="text-[11px] text-[#7A6A60] mt-2.5 pt-2 border-t border-[#FFCDD2]">
                                Diinput oleh: <span class="font-semibold text-[#3E3028]">Badrus Sulaiman, S.Pd., Gr.</span>
                            </p>
                        </div>
                    </div>
                </div>


                {{-- ===== BAHASA INGGRIS (Nadia lanjut dispen) ===== --}}
                <div class="bg-white border border-[#E5D8CC] rounded-[10px] p-4 sm:p-[18px] md:p-5
                            flex flex-col gap-4 shadow-[0_4px_12px_rgba(62,48,40,0.03)]">
                    <div class="flex justify-between items-start sm:items-center gap-3">
                        <div>
                            <div class="font-['Poppins'] font-bold text-base sm:text-lg text-[#3E3028]">Bahasa Inggris</div>
                            <div class="font-['Inter'] font-semibold text-xs sm:text-sm text-[#7A6A60] mt-0.5">Siti Aminah, S.Pd.</div>
                        </div>
                        <span class="text-[10px] sm:text-[11px] font-semibold px-2 sm:px-2.5 py-1 rounded-md whitespace-nowrap bg-[#F5F5F5] text-[#7A6A60]">
                            Belum Dimulai
                        </span>
                    </div>
                    <hr class="border-t border-[#E5D8CC] w-full m-0">
                    <div class="flex items-center gap-1.5 text-[13px] text-[#7A6A60] font-['Inter']">
                        <svg class="shrink-0" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#7A6A60" stroke-width="2">
                            <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>
                        </svg>
                        <span>13:00 – 15:00 (Jam ke-9 sampai ke-10)</span>
                    </div>

                    {{-- NADIA LANJUT DISPEN --}}
                    <div class="bg-[#FFF8E1] border border-[#FFE082] rounded-[8px] overflow-hidden">
                        <button type="button"
                                onclick="toggleDispen(this)"
                                class="w-full flex items-center justify-between gap-2 p-3 sm:p-3.5 text-left hover:bg-[#FFF3C4] transition">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 rounded-[5px] bg-[#F9A825] flex items-center justify-center shrink-0">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                </div>
                                <span class="font-['Inter'] font-semibold text-[13px] text-[#3E3028]">
                                    Siswa Dispensasi (1)
                                </span>
                            </div>
                            <svg class="w-4 h-4 text-[#7A6A60] transition-transform duration-200 arrow-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M6 9l6 6 6-6"/>
                            </svg>
                        </button>

                        <div class="dispen-content hidden px-3 sm:px-3.5 pb-3 sm:pb-3.5">
                            <div class="flex flex-col gap-1.5 pt-1 border-t border-[#FFE082]">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-[13px] text-[#3E3028]">Nadia Putri</span>
                                    <span class="text-[11px] font-medium text-[#7A6A60]">Jam ke-5 s/d 10</span>
                                </div>
                            </div>
                            <p class="text-[11px] text-[#7A6A60] mt-2.5 pt-2 border-t border-[#FFE082]">
                                Disetujui oleh Waka: <span class="font-semibold text-[#3E3028]">Bu Rina</span>
                            </p>
                        </div>
                    </div>
                </div>


                <span class="font-['Poppins'] font-bold text-md uppercase text-[#3E3028] mt-1">
                    Sesi Mengajar Selesai
                </span>


                {{-- ===== PJOK (Tidak Hadir) ===== --}}
                <div class="bg-white border border-[#E5D8CC] rounded-[10px] p-4 sm:p-[18px] md:p-5
                            flex flex-col gap-4 shadow-[0_4px_12px_rgba(62,48,40,0.03)]">
                    <div class="flex justify-between items-start sm:items-center gap-3">
                        <div>
                            <div class="font-['Poppins'] font-bold text-base sm:text-lg text-[#3E3028]">PJOK</div>
                            <div class="font-['Inter'] font-semibold text-xs sm:text-sm text-[#7A6A60] mt-0.5">Zainul Arifin, S.Pd.</div>
                        </div>
                        <span class="text-[10px] sm:text-[11px] font-semibold px-2 sm:px-2.5 py-1 rounded-md whitespace-nowrap bg-[#FFEBEE] text-[#D32F2F]">
                            Tidak Hadir
                        </span>
                    </div>
                    <hr class="border-t border-[#E5D8CC] w-full m-0">
                    <div class="flex items-center gap-1.5 text-[13px] text-[#7A6A60] font-['Inter']">
                        <svg class="shrink-0" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#7A6A60" stroke-width="2">
                            <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>
                        </svg>
                        <span>07:40 – 09:40 (Jam ke-2 sampai ke-4)</span>
                    </div>
                    <div class="flex items-center gap-2 font-['Inter'] text-[13px] font-semibold text-[#757575]">
                        <div class="w-5 h-5 rounded-[5px] bg-[#D32F2F] flex items-center justify-center text-white text-[13px] font-bold">✕</div>
                        <span>Guru tidak hadir</span>
                    </div>
                </div>


                {{-- ===== BAHASA JEPANG (Izin + Tugas) ===== --}}
                <div class="bg-white border border-[#E5D8CC] rounded-[10px] p-4 sm:p-[18px] md:p-5
                            flex flex-col gap-4 shadow-[0_4px_12px_rgba(62,48,40,0.03)]">
                    <div class="flex justify-between items-start sm:items-center gap-3">
                        <div>
                            <div class="font-['Poppins'] font-bold text-base sm:text-lg text-[#3E3028]">Bahasa Jepang</div>
                            <div class="font-['Inter'] font-semibold text-xs sm:text-sm text-[#7A6A60] mt-0.5">Sulistyowati, SS.</div>
                        </div>
                        <span class="text-[10px] sm:text-[11px] font-semibold px-2 sm:px-2.5 py-1 rounded-md whitespace-nowrap bg-[#E3F2FD] text-[#1976D2]">
                            Izin (Disetujui)
                        </span>
                    </div>
                    <hr class="border-t border-[#E5D8CC] w-full m-0">
                    <div class="flex items-center gap-1.5 text-[13px] text-[#7A6A60] font-['Inter']">
                        <svg class="shrink-0" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#7A6A60" stroke-width="2">
                            <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>
                        </svg>
                        <span>07:00 – 07:40 (Jam ke-1)</span>
                    </div>

                    <div class="bg-[#FDFBF7] border border-[#E5D8CC] rounded-[8px] p-3 sm:p-4">
                        <div class="font-['Inter'] font-semibold text-[13px] sm:text-sm text-[#3E3028] mb-1">
                            Tugas:
                        </div>
                        <div class="font-['Inter'] text-[13px] sm:text-sm text-[#7A6A60]">
                            Mengerjakan latihan Bahasa Jepang halaman 25
                        </div>
                        <p class="text-[11px] text-[#7A6A60] mt-2 pt-2 border-t border-[#E5D8CC]">
                            Diinput oleh Guru Piket: <span class="font-semibold text-[#3E3028]">Pak Ahmad</span>
                        </p>
                    </div>
                </div>

            </div>
        </main>
    </div>

    {{-- BOTTOM NAV --}}
    <nav class="md:hidden fixed bottom-0 inset-x-0 h-[72px] bg-white border-t border-[#E5D8CC] flex z-50">
        <a href="{{ route('kelas.beranda') }}" class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#5C4033] font-semibold">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12l9-9 9 9"/><path d="M5 10v10h14V10"/></svg>
            Dasbor
        </a>
        <a href="{{ route('kelas.scan') }}" class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Scan
        </a>
        <a href="{{ route('kelas.kirim-jurnal') }}" class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg>
            Kirim Jurnal
        </a>
        <a href="{{ route('kelas.profile') }}" class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg>
            Profil
        </a>
    </nav>

    <script>
        function toggleDispen(btn) {
            const content = btn.nextElementSibling;
            const arrow = btn.querySelector('.arrow-icon');

            content.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        }
    </script>

</body>
</html>