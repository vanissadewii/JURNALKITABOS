<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Jurnal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    <style>html{scrollbar-width:none}html::-webkit-scrollbar{display:none}</style>
</head>

<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen overflow-x-hidden">

    <div class="md:flex md:min-h-screen">

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

                <a href="{{ route('kelas.beranda') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12l9-9 9 9"/>
                        <path d="M5 10v10h14V10"/>
                    </svg>
                    Beranda
                </a>

                <a href="{{ route('kelas.scan') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                    </svg>
                    Scan
                </a>

                <a href="{{ route('kelas.kirim-jurnal') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md font-semibold bg-[#F5EFE8] text-[#5C4033]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 2L11 13"/>
                        <path d="M22 2l-7 20-4-9-20-7z"/>
                    </svg>
                    Kirim Jurnal
                </a>

                <a href="{{ route('kelas.profile') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>
                    </svg>
                    Profil
                </a>

            </nav>
        </aside>


        {{-- KONTEN UTAMA --}}
        <main class="flex-1 w-full min-w-0 pb-24 md:pb-8">

            {{-- HEADER --}}
            <div class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 sm:px-6 sm:py-6 md:px-7 md:py-7 flex flex-col gap-1">
                <span class="text-white text-xl md:text-3xl font-['Poppins'] font-bold">
                    Kirim Jurnal
                </span>
            </div>


            <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-4">

                <div class="flex items-center justify-between mt-1">
                    <span class="font-['Poppins'] font-bold text-md uppercase text-[#3E3028]">
                        Rekap Jurnal Mengajar Hari Ini
                    </span>
                </div>


                {{-- TABEL REKAP --}}
                <div class="w-full max-w-full bg-white border border-[#E5D8CC] rounded-[10px]
                            shadow-[0_4px_12px_rgba(62,48,40,0.03)] overflow-x-auto">

                    <table class="min-w-[900px] w-full text-left border-collapse">
                        <thead><tr class="bg-[#F5EFE8] text-xs text-[#7A6A60]"><th class="px-4 py-3">Jam</th><th class="px-4 py-3">Guru</th><th class="px-4 py-3">Mapel</th><th class="px-4 py-3">Status scan</th><th class="px-4 py-3">Materi</th><th class="px-4 py-3">Kehadiran</th></tr></thead>
                        <tbody>
                        @forelse($rekap as $sesi)
                            @php($jurnalSesi = $sesi->jurnal)
                            <tr class="border-t border-[#E5D8CC]">
                                <td class="px-4 py-3">{{ $sesi->jam_ke_mulai }}@if($sesi->jam_ke_sampai !== $sesi->jam_ke_mulai)–{{ $sesi->jam_ke_sampai }}@endif</td>
                                <td class="px-4 py-3">{{ $sesi->guru }}</td><td class="px-4 py-3">{{ $sesi->mapel }}</td>
                                <td class="px-4 py-3">{{ $jurnalSesi?->status_verifikasi === 'terverifikasi' ? 'Terverifikasi' : ($jurnalSesi ? 'Menunggu verifikasi' : 'Belum ada jurnal') }}</td>
                                <td class="px-4 py-3">{{ $jurnalSesi?->materi ?: '—' }}</td><td class="px-4 py-3">{{ $jurnalSesi?->jumlah_hadir ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-4 py-8 text-center text-sm text-[#7A6A60]">Tidak ada sesi terjadwal hari ini.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>


                <div class="w-full rounded-xl border {{ $semuaSelesai ? 'border-green-200 bg-green-50' : 'border-amber-200 bg-amber-50' }} p-4">
                    <p class="font-semibold {{ $semuaSelesai ? 'text-green-800' : 'text-amber-800' }}">{{ $pengiriman ? 'Jurnal hari ini sudah dikirim.' : ($semuaSelesai ? 'Semua sesi sudah selesai dan terverifikasi.' : 'Jurnal bisa dikirim setelah semua sesi selesai dan terverifikasi.') }}</p>
                </div>

                {{-- TOMBOL KIRIM --}}
                <form method="POST" action="{{ route('kelas.kirim-jurnal.store') }}">
                    @csrf
                    <button
                    type="submit"
                    id="btnKirimJurnal"
                    @disabled(!$semuaSelesai || $pengiriman)
                    class="w-full bg-[#A89B90] text-white py-3.5 rounded-lg font-semibold text-sm
                           transition duration-200 mt-1 cursor-not-allowed opacity-70">
                    <span class="inline-flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 2L11 13"/>
                            <path d="M22 2l-7 20-4-9-20-7z"/>
                        </svg>
                        {{ $pengiriman ? 'Jurnal Sudah Dikirim' : 'Kirim Jurnal Hari Ini' }}
                    </span>
                    </button>
                </form>

                <p class="text-center text-[11px] text-[#7A6A60]">
                    Pastikan seluruh jurnal hari ini sudah benar sebelum dikirim.
                </p>

            </div>
        </main>
    </div>


    <nav class="md:hidden fixed bottom-0 inset-x-0 h-[72px] bg-white border-t border-[#E5D8CC] flex z-50">
        <a href="{{ route('kelas.beranda') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 12l9-9 9 9"/>
                <path d="M5 10v10h14V10"/>
            </svg>
            Beranda
        </a>
        <a href="{{ route('kelas.scan') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"/>
                <rect x="14" y="3" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/>
            </svg>
            Scan
        </a>
        <a href="{{ route('kelas.kirim-jurnal') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#5C4033] font-semibold">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 2L11 13"/>
                <path d="M22 2l-7 20-4-9-20-7z"/>
            </svg>
            Kirim Jurnal
        </a>
        <a href="{{ route('kelas.profile') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>
            </svg>
            Profil
        </a>
    </nav>




</body>
</html>