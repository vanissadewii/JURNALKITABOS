<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Sukses</title>

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

            {{-- HEADER (putih, tanpa tombol back) --}}
            <div class="w-full bg-[#5C4033] px-4 py-5 sm:px-6 sm:py-6 md:px-7 md:py-7 flex items-center justify-center text-white">

            <h1 class="m-0 font-['Poppins'] text-[15px] sm:text-[17px] font-semibold text-center">
                Verifikasi Sukses
            </h1>

            </div>

            {{-- ISI KONTEN --}}
            <div class="w-full max-w-[500px] mx-auto px-6 pt-8 sm:pt-10 pb-5 text-center">

                {{-- ICON BERHASIL --}}
                <div class="w-[72px] h-[72px] mx-auto mb-4 rounded-full bg-[#E8F5E9] border-2 border-[#2E7D32]
                            flex items-center justify-center text-[#2E7D32] text-4xl font-bold">
                    ✓
                </div>

                <h2 class="font-['Poppins'] text-lg sm:text-xl font-semibold text-[#2E7D32] m-0 mb-2">
                    Konfirmasi Berhasil
                </h2>

                <p class="text-xs leading-relaxed text-[#7A6A60] max-w-[320px] mx-auto mb-6">
                    Kehadiran Anda telah terverifikasi oleh sistem.
                </p>

                {{-- DETAIL KEHADIRAN --}}
                <div class="bg-white border border-[#E5D8CC] rounded-[10px] p-4 text-left
                            shadow-[0_2px_8px_rgba(62,48,40,0.06)]">

                    <div class="flex items-center justify-center mb-3">
                        <div class="font-['Poppins'] text-[15px] font-semibold text-[#3E3028]">
                            Detail Kehadiran
                        </div>
                    </div>

                    <div class="flex justify-between gap-4 py-2.5 border-b border-[#E5D8CC] text-[13px]">
                        <span class="text-[#7A6A60]">Guru</span>
                        <span class="text-[#3E3028] font-medium text-right">Kurnila Putri, S.Pd.</span>
                    </div>

                    <div class="flex justify-between gap-4 py-2.5 border-b border-[#E5D8CC] text-[13px]">
                        <span class="text-[#7A6A60]">Mata Pelajaran</span>
                        <span class="text-[#3E3028] font-medium text-right">PPLG</span>
                    </div>

                    <div class="flex justify-between gap-4 py-2.5 border-b border-[#E5D8CC] text-[13px]">
                        <span class="text-[#7A6A60]">Kelas</span>
                        <span class="text-[#3E3028] font-medium text-right">XI RPL 2</span>
                    </div>

                    <div class="flex justify-between gap-4 py-2.5 border-b border-[#E5D8CC] text-[13px]">
                        <span class="text-[#7A6A60]">Waktu Check-in</span>
                        <span class="text-[#3E3028] font-medium text-right">07:03 WIB</span>
                    </div>

                    <div class="flex justify-between gap-4 pt-2.5 text-[13px]">
                        <span class="text-[#7A6A60]">Status Kelas</span>
                        <span class="text-[#795548] font-semibold text-right">SEDANG MENGAJAR</span>
                    </div>

                </div>

                {{-- KEMBALI --}}
                <a href="{{ route('kelas.beranda') }}"
                   class="w-full h-[45px] mt-6 rounded-lg bg-[#5C4033] hover:bg-[#4B3329] text-white
                          font-['Poppins'] text-sm font-medium flex items-center justify-center">
                    Kembali ke Beranda
                </a>

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