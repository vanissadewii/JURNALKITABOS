<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Sesi Mengajar</title>

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
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12l9-9 9 9"/><path d="M5 10v10h14V10"/>
                    </svg>
                    Dasbor
                </a>
                <a href="{{ route('kelas.scan') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md font-semibold bg-[#F5EFE8] text-[#5C4033]">
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

            {{-- HEADER SCAN (back button + judul) --}}
            <div class="w-full bg-[#5C4033] px-4 py-5 sm:px-6 sm:py-6 md:px-7 md:py-7 flex items-center justify-center text-white">

            <h1 class="m-0 font-['Poppins'] text-[15px] sm:text-[17px] font-semibold text-center">
                Scan Sesi Mengajar
            </h1>

            </div>

            {{-- ISI KONTEN --}}
            <div class="w-full max-w-[500px] mx-auto px-4 py-6 sm:px-5 md:pt-10 pb-10 flex flex-col items-center">

                <h2 class="m-0 mb-1.5 font-['Poppins'] text-lg sm:text-xl md:text-2xl font-bold text-center text-[#3E3028]">
                    QR Code Siswa
                </h2>

                <p class="m-0 mb-6 text-xs leading-relaxed text-center text-[#7A6A60]">
                    Tunjukkan QR Code ini kepada guru Anda
                    untuk memulai verifikasi sesi.
                </p>

                {{-- QR PLACEHOLDER — nanti diganti komponen QR asli --}}
                <div class="w-[190px] h-[190px] sm:w-[210px] sm:h-[210px] md:w-[220px] md:h-[220px]
                            bg-white border border-[#E5D8CC] rounded-2xl flex items-center justify-center
                            p-[18px] shadow-[0_4px_15px_rgba(62,48,40,0.06)]">

                    <div class="relative w-[150px] h-[150px] sm:w-[170px] sm:h-[170px] md:w-[180px] md:h-[180px]
                                bg-[linear-gradient(90deg,#3E3028_10px,transparent_10px),linear-gradient(#3E3028_10px,transparent_10px),linear-gradient(90deg,transparent_20px,#3E3028_20px_30px),linear-gradient(transparent_20px,#3E3028_20px_30px)]
                                bg-[length:30px_30px] bg-[position:0_0]">

                        <div class="absolute top-0 left-0 w-[38px] h-[38px] border-[8px] border-[#3E3028] bg-white"></div>
                        <div class="absolute right-0 bottom-0 w-[38px] h-[38px] border-[8px] border-[#3E3028] bg-white"></div>

                    </div>

                </div>

                {{-- INFO SESI --}}
                <div class="w-full bg-white border border-[#E5D8CC] rounded-[10px] p-4 sm:p-[14px] mt-6
                            shadow-[0_4px_12px_rgba(62,48,40,0.04)]">

                    <div class="mb-3 font-['Poppins'] text-sm font-bold text-[#3E3028]">
                        Detail Sesi Mengajar
                    </div>

                    <div class="flex justify-between gap-4 py-2.5 border-b border-[#E5D8CC] text-[13px] sm:text-xs">
                        <span class="text-[#7A6A60]">Guru Pengajar</span>
                        <span class="text-[#3E3028] font-semibold text-right">Kurnila Putri, S.Pd.</span>
                    </div>

                    <div class="flex justify-between gap-4 py-2.5 border-b border-[#E5D8CC] text-[13px] sm:text-xs">
                        <span class="text-[#7A6A60]">Mata Pelajaran</span>
                        <span class="text-[#3E3028] font-semibold text-right">PPLG</span>
                    </div>

                    <div class="flex justify-between gap-4 py-2.5 border-b border-[#E5D8CC] text-[13px] sm:text-xs">
                        <span class="text-[#7A6A60]">Kelas</span>
                        <span class="text-[#3E3028] font-semibold text-right">XI RPL 2</span>
                    </div>

                    <div class="flex justify-between gap-4 py-2.5 border-b border-[#E5D8CC] text-[13px] sm:text-xs">
                        <span class="text-[#7A6A60]">Jam</span>
                        <span class="text-[#3E3028] font-semibold text-right">07:00 - 09:40</span>
                    </div>

                    <div class="flex justify-between gap-4 pt-2.5 text-[13px] sm:text-xs">
                        <span class="text-[#7A6A60]">Status</span>
                        <span class="text-[#3E3028] font-semibold text-right">Sesi Aktif</span>
                    </div>

                </div>

                {{-- PERINGATAN --}}
                <div class="w-full mt-4 p-[13px] bg-[#EAF4FF] border border-[#B8D8F5] rounded-lg
                            flex items-start gap-2.5">

                    <div class="w-5 h-5 shrink-0 rounded-full bg-[#4A90C2] text-white
                                flex items-center justify-center text-xs font-bold">
                        !
                    </div>

                    <p class="m-0 text-xs leading-relaxed text-[#245A7A]">
                        Pastikan Anda berada di kelas dan guru tersebut
                        benar sedang mengajar sebelum melakukan konfirmasi.
                    </p>

                </div>

            </div>
        </main>

    </div>

    {{-- BOTTOM NAV (mobile) --}}
    <nav class="md:hidden fixed bottom-0 inset-x-0 h-[72px] bg-white border-t border-[#E5D8CC] flex z-50">
        <a href="{{ route('kelas.beranda') }}" class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12l9-9 9 9"/><path d="M5 10v10h14V10"/></svg>
            Dasbor
        </a>
        <a href="{{ route('kelas.scan') }}" class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#5C4033] font-semibold">
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

</body>
</html>