<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Jurnal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen">

    <div class="md:flex">

        {{-- SIDEBAR DESKTOP --}}
        <aside class="hidden md:flex md:flex-col md:w-64 md:h-screen md:sticky md:top-0
                       bg-white border-r border-[#E5D8CC] py-6 px-4">

            <div class="mb-8 px-2">
                <h1 class="font-['Poppins'] font-bold text-xl text-[#5C4033]">
                    JURNAL GURU
                </h1>
                <p class="text-md text-[#7A6A60] mt-1">
                    Akun Kelas
                </p>
            </div>

            <nav class="flex flex-col gap-1">

                {{-- DASBOR --}}
                <a href="{{ route('kelas.beranda') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">

                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12l9-9 9 9"/>
                        <path d="M5 10v10h14V10"/>
                    </svg>

                    Dasbor
                </a>


                {{-- SCAN --}}
                <a href="{{ route('kelas.scan') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">

                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                    </svg>

                    Scan
                </a>


                {{-- KIRIM JURNAL AKTIF --}}
                <a href="{{ route('kelas.kirim-jurnal') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md font-semibold bg-[#F5EFE8] text-[#5C4033]">

                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 2L11 13"/>
                        <path d="M22 2l-7 20-4-9-9-4 20-7z"/>
                    </svg>

                    Kirim Jurnal
                </a>


                {{-- PROFIL --}}
                <a href="{{ route('kelas.profile') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">

                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>
                    </svg>

                    Profil
                </a>

            </nav>
        </aside>


        {{-- KONTEN UTAMA --}}
        <main class="flex-1 w-full pb-24 md:pb-8">

            {{-- HEADER --}}
            <div class="bg-[#5C4033] px-4 py-5 sm:px-6 sm:py-6 md:px-7 md:py-7 flex flex-col gap-1">

            <span class="text-white text-xl md:text-3xl font-['Poppins'] font-bold">
            Kirim Jurnal
            </span>

            <span class="text-[#D7B899] text-xs font-medium mt-0.8">
            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
            </span>

            </div>

            {{-- ISI --}}
            <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-4">

                {{-- JUDUL REKAP --}}
                <div class="flex items-center justify-between mt-1">

                    <span class="font-['Poppins'] font-bold text-md uppercase text-[#3E3028]">
                        Rekap Jurnal Mengajar Hari Ini
                    </span>
                    
                </div>


                {{-- JURNAL 1 --}}
                <div class="bg-white border border-[#E5D8CC] rounded-[10px] p-4 sm:p-5
                            flex flex-col gap-3 shadow-[0_4px_12px_rgba(62,48,40,0.03)]">

                    <div class="flex justify-between items-start gap-3">

                        <div>
                            <div class="font-['Poppins'] font-bold text-base text-[#3E3028]">
                                Matematika
                            </div>

                            <div class="font-semibold text-xs text-[#7A6A60] mt-0.5">
                                Badrus Sulaiman, S.Pd., Gr.
                            </div>
                        </div>

                        <span class="text-[10px] font-semibold px-2.5 py-1 rounded-md
                                     bg-[#E8F5E9] text-[#2E7D32] whitespace-nowrap">
                            Selesai
                        </span>

                    </div>

                    <hr class="border-t border-[#E5D8CC]">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[13px] text-[#7A6A60]">

                        <div class="flex items-center gap-2">
                            <span>🕐</span>
                            <span>10:00 – 13:50</span>
                        </div>

                    </div>

                    <div class="text-[13px] text-[#7A6A60]">
                        <span class="font-semibold text-[#3E3028]">
                            Materi:
                        </span>
                        Persamaan dan Pertidaksamaan
                    </div>

                    <div class="flex items-center gap-2 text-[13px] font-semibold text-[#2E7D32]">

                        <div class="w-5 h-5 rounded-[5px] bg-[#4CAF50] flex items-center justify-center">

                            <svg class="w-[13px] h-[13px]"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="white"
                                 stroke-width="3">

                                <path d="M5 12l4 4L19 6"/>

                            </svg>

                        </div>

                        <span>
                            Jurnal sudah diisi
                        </span>

                    </div>

                </div>


                {{-- JURNAL 2 --}}
                <div class="bg-white border border-[#E5D8CC] rounded-[10px] p-4 sm:p-5
                            flex flex-col gap-3 shadow-[0_4px_12px_rgba(62,48,40,0.03)]">

                    <div class="flex justify-between items-start gap-3">

                        <div>
                            <div class="font-['Poppins'] font-bold text-base text-[#3E3028]">
                                Bahasa Inggris
                            </div>

                            <div class="font-semibold text-xs text-[#7A6A60] mt-0.5">
                                Siti Aminah, S.Pd.
                            </div>
                        </div>

                        <span class="text-[10px] font-semibold px-2.5 py-1 rounded-md
                                     bg-[#E8F5E9] text-[#2E7D32] whitespace-nowrap">
                            Selesai
                        </span>

                    </div>

                    <hr class="border-t border-[#E5D8CC]">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[13px] text-[#7A6A60]">

                        <div class="flex items-center gap-2">
                            <span>🕐</span>
                            <span>13:00 – 15:00</span>
                        </div>

                    </div>

                    <div class="text-[13px] text-[#7A6A60]">
                        <span class="font-semibold text-[#3E3028]">
                            Materi:
                        </span>
                        Asking and Giving Opinion
                    </div>

                    <div class="flex items-center gap-2 text-[13px] font-semibold text-[#2E7D32]">

                        <div class="w-5 h-5 rounded-[5px] bg-[#4CAF50] flex items-center justify-center">

                            <svg class="w-[13px] h-[13px]"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="white"
                                 stroke-width="3">

                                <path d="M5 12l4 4L19 6"/>

                            </svg>

                        </div>

                        <span>
                            Jurnal sudah diisi
                        </span>

                    </div>

                </div>


                {{-- JURNAL 3 --}}
                <div class="bg-white border border-[#E5D8CC] rounded-[10px] p-4 sm:p-5
                            flex flex-col gap-3 shadow-[0_4px_12px_rgba(62,48,40,0.03)]">

                    <div class="flex justify-between items-start gap-3">

                        <div>
                            <div class="font-['Poppins'] font-bold text-base text-[#3E3028]">
                                PJOK
                            </div>

                            <div class="font-semibold text-xs text-[#7A6A60] mt-0.5">
                                Zainul Arifin, S.Pd.
                            </div>
                        </div>

                        <span class="text-[10px] font-semibold px-2.5 py-1 rounded-md
                                     bg-[#E8F5E9] text-[#2E7D32] whitespace-nowrap">
                            Selesai
                        </span>

                    </div>

                    <hr class="border-t border-[#E5D8CC]">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[13px] text-[#7A6A60]">

                        <div class="flex items-center gap-2">
                            <span>🕐</span>
                            <span>07:00 – 09:40</span>
                        </div>

                    </div>

                    <div class="text-[13px] text-[#7A6A60]">
                        <span class="font-semibold text-[#3E3028]">
                            Materi:
                        </span>
                        Kebugaran Jasmani
                    </div>

                    <div class="flex items-center gap-2 text-[13px] font-semibold text-[#757575]">

                        <div class="w-5 h-5 rounded-[5px] bg-[#9E9E9E] flex items-center justify-center text-white text-xs font-bold">
                            ✕
                        </div>

                        <span>
                            Guru tidak hadir
                        </span>

                    </div>

                </div>


                {{-- STATUS SEMUA SELESAI --}}
                <div class="bg-[#E8F5E9] border border-[#C8E6C9] rounded-[10px] p-4 mt-2">

                    <div class="flex items-start gap-3">

                        <div class="w-8 h-8 rounded-lg bg-[#4CAF50] flex items-center justify-center shrink-0">

                            <svg class="w-5 h-5"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="white"
                                 stroke-width="3">

                                <path d="M5 12l4 4L19 6"/>

                            </svg>

                        </div>

                        <div>
                            <p class="font-['Poppins'] font-bold text-sm text-[#2E7D32]">
                                Semua sesi hari ini sudah selesai
                            </p>

                            <p class="text-xs text-[#4E6B50] mt-1">
                                Jurnal hari ini sudah lengkap dan siap dikirim.
                            </p>
                        </div>

                    </div>

                </div>


                {{-- TOMBOL KIRIM --}}
                <button
                    type="button"
                    class="w-full bg-[#5C4033] hover:bg-[#432D23] text-white
                           py-3.5 rounded-lg font-semibold text-sm
                           transition duration-200 mt-1">

                    <span class="inline-flex items-center justify-center gap-2">

                        <svg class="w-5 h-5"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">

                            <path d="M22 2L11 13"/>
                            <path d="M22 2l-7 20-4-9-9-4 20-7z"/>

                        </svg>

                        Kirim Jurnal Hari Ini

                    </span>

                </button>

                <p class="text-center text-[11px] text-[#7A6A60]">
                    Pastikan seluruh jurnal hari ini sudah benar sebelum dikirim.
                </p>

            </div>

        </main>

    </div>


    {{-- BOTTOM NAV MOBILE --}}
    <nav class="md:hidden fixed bottom-0 inset-x-0 h-[72px] bg-white
                border-t border-[#E5D8CC] flex z-50">

        {{-- DASBOR --}}
        <a href="{{ route('kelas.beranda') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1
                  text-[11px] text-[#7A6A60]">

            <svg class="w-5 h-5" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2">

                <path d="M3 12l9-9 9 9"/>
                <path d="M5 10v10h14V10"/>

            </svg>

            Dasbor
        </a>


        {{-- SCAN --}}
        <a href="{{ route('kelas.scan') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1
                  text-[11px] text-[#7A6A60]">

            <svg class="w-5 h-5" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2">

                <rect x="3" y="3" width="7" height="7"/>
                <rect x="14" y="3" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/>

            </svg>

            Scan
        </a>


        {{-- KIRIM JURNAL AKTIF --}}
        <a href="{{ route('kelas.kirim-jurnal') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1
                  text-[11px] text-[#5C4033] font-semibold">

            <svg class="w-5 h-5" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2">

                <path d="M22 2L11 13"/>
                <path d="M22 2l-7 20-4-9-9-4 20-7z"/>

            </svg>

            Kirim Jurnal
        </a>


        {{-- PROFIL --}}
        <a href="{{ route('kelas.profile') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1
                  text-[11px] text-[#7A6A60]">

            <svg class="w-5 h-5" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2">

                <circle cx="12" cy="8" r="4"/>
                <path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>

            </svg>

            Profil
        </a>

    </nav>

</body>
</html>
