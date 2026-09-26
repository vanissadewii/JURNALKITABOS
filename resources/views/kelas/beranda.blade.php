<!DOCTYPE html>
<html lang="id" class="[scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">

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
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 2L11 13"/>
                        <path d="M22 2l-7 20-4-9-9-4 20-7z"/>
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
        <main class="flex-1 w-full pb-24 md:pb-8">
            @if(($tugasPiket ?? collect())->isNotEmpty())
                <section class="mx-4 mt-4 rounded-2xl border border-amber-200 bg-amber-50 p-4 sm:mx-6">
                    <h2 class="font-poppins font-bold text-base text-[#3E3028]">Materi dari Guru Piket</h2>
                    <div class="mt-3 space-y-3">
                        @foreach($tugasPiket as $tugas)
                            <article class="rounded-xl border border-amber-200 bg-white p-4">
                                <div class="flex flex-wrap items-center justify-between gap-2"><h3 class="font-semibold">{{ $tugas->mapel }}</h3><span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-bold">Guru {{ $tugas->status_guru }}</span></div>
                                @if($tugas->alasan_izin)<p class="mt-2 text-sm text-[#7A6A60]">{{ $tugas->alasan_izin }}</p>@endif
                                <p class="mt-2 whitespace-pre-line text-sm">{{ $tugas->tugas }}</p>
                                @if($tugas->file_path)<a class="mt-3 inline-flex rounded-lg bg-[#5C4033] px-4 py-2 text-sm font-semibold text-white" href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($tugas->file_path) }}" target="_blank" rel="noopener">Buka lampiran</a>@endif
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- HEADER --}}
            <div class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 sm:px-6 sm:py-6 md:px-7 md:py-7 flex flex-col gap-1">
                <span class="text-[#D7B899] text-xs sm:text-sm font-medium tracking-wide">
                    Selamat Datang,
                </span>

                <span class="text-white text-2xl md:text-3xl font-['Poppins'] font-bold">
                    {{ $kelas->tingkat }} {{ $kelas->jurusan }} {{ $kelas->rombel }}
                </span>

                <span class="text-[#D7B899] text-xs sm:text-sm font-medium">
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                </span>
            </div>

            @if (isset($dispensasiDisetujui) && $dispensasiDisetujui->isNotEmpty())
                <section class="mx-4 mt-5 rounded-2xl border border-amber-200 bg-amber-50 p-4 sm:mx-6 md:mx-7 md:p-5">
                    <h2 class="font-['Poppins'] text-lg font-bold text-[#5C4033]">Dispensasi Disetujui Hari Ini</h2>
                    <p class="mt-1 text-sm text-[#7A6A60]">Siswa dan rentang jam berikut sudah tercatat untuk kelas ini.</p>
                    <div class="mt-3 space-y-3">
                        @foreach ($dispensasiDisetujui as $item)
                            <div class="rounded-xl border border-amber-100 bg-white p-3 sm:flex sm:items-start sm:justify-between sm:gap-4">
                                <div><p class="font-semibold">{{ $item->siswa->nama }}</p><p class="mt-1 text-sm text-[#7A6A60]">{{ $item->alasan }}</p></div>
                                <p class="mt-2 shrink-0 text-sm font-semibold text-[#5C4033] sm:mt-0">{{ $item->labelJam() }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if (session('notif_sukses'))
                <div role="status"
                     class="mx-4 mt-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800 sm:mx-6 md:mx-7">
                    {{ session('notif_sukses') }}
                </div>
            @endif

            {{-- ISI --}}
            <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-3.5">

                <span class="font-['Poppins'] font-bold text-md uppercase text-[#3E3028] mt-1">
                    Jadwal Mengajar Hari Ini
                </span>

                @forelse (($sesiAktif ?? collect()) as $sesi)
                    <article class="flex flex-col gap-3 rounded-2xl border border-[#E5D8CC] bg-white p-4 shadow-sm sm:p-5">
                        <div class="flex flex-wrap items-start justify-between gap-3">
                            <div>
                                <h2 class="font-['Poppins'] text-base font-bold text-[#3E3028]">{{ $sesi->mapel }}</h2>
                                <p class="mt-1 text-sm text-[#7A6A60]">{{ $sesi->guru }}</p>
                            </div>
                            <span class="rounded-full border border-[#E5D8CC] bg-[#F5EFE8] px-3 py-1 text-xs font-semibold text-[#5C4033]">{{ $sesi->status }}</span>
                        </div>
                        <p class="text-sm text-[#7A6A60]">Jam ke-{{ $sesi->jam_ke_mulai }}@if($sesi->jam_ke_sampai !== $sesi->jam_ke_mulai)–{{ $sesi->jam_ke_sampai }}@endif · {{ $sesi->jam_mulai }}–{{ $sesi->jam_selesai }}</p>
                        @if ($sesi->jurnal)
                            <div class="rounded-xl border border-green-200 bg-green-50 p-3 text-sm text-green-900">
                                <p class="font-semibold">Jurnal guru terverifikasi</p>
                                @if ($sesi->jurnal->materi)<p class="mt-1">Materi: {{ $sesi->jurnal->materi }}</p>@endif
                                <p class="mt-1">Hadir: {{ $sesi->jurnal->jumlah_hadir ?? '—' }} siswa</p>
                                @if ($sesi->jurnal->absenSiswa->isNotEmpty())
                                    <ul class="mt-2 list-inside list-disc text-xs">
                                        @foreach ($sesi->jurnal->absenSiswa as $absen)
                                            <li>{{ $absen->nama }} — {{ $absen->status }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @else
                            <p class="rounded-xl bg-[#F5EFE8] p-3 text-xs text-[#7A6A60]">Jurnal sesi ini belum tersedia atau masih menunggu verifikasi guru.</p>
                        @endif
                    </article>
                @empty
                    <p class="rounded-2xl border border-dashed border-[#D8C9BC] bg-white p-5 text-sm text-[#7A6A60]">Tidak ada jadwal mengajar lagi untuk hari ini.</p>
                @endforelse

                @if (($sesiSelesai ?? collect())->isNotEmpty())
                    <span class="mt-3 font-['Poppins'] text-md font-bold uppercase text-[#3E3028]">Sesi Mengajar Selesai</span>
                    @foreach ($sesiSelesai as $sesi)
                        <article class="flex flex-wrap items-center justify-between gap-3 rounded-2xl border border-[#E5D8CC] bg-white p-4">
                            <div><h2 class="font-semibold text-[#3E3028]">{{ $sesi->mapel }}</h2><p class="mt-1 text-sm text-[#7A6A60]">{{ $sesi->guru }} · Jam ke-{{ $sesi->jam_ke_mulai }}@if($sesi->jam_ke_sampai !== $sesi->jam_ke_mulai)–{{ $sesi->jam_ke_sampai }}@endif</p></div>
                            <span class="rounded-full bg-[#F5EFE8] px-3 py-1 text-xs font-semibold text-[#5C4033]">Selesai</span>
                        </article>
                    @endforeach
                @endif

            </div>
        </main>
    </div>

    {{-- BOTTOM NAV --}}
    <nav class="md:hidden fixed bottom-0 inset-x-0 h-[72px] bg-white border-t border-[#E5D8CC] flex z-50">

        <a href="{{ route('kelas.beranda') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#5C4033] font-semibold">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 12l9-9 9 9"/>
                <path d="M5 10v10h14V10"/>
            </svg>
            Dasbor
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
           class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 2L11 13"/>
                <path d="M22 2l-7 20-4-9-9-4 20-7z"/>
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