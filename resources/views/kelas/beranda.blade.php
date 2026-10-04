<!DOCTYPE html>
<html lang="id" class="[scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">




    @if (session('notif_sukses'))
    <div id="toast-notif"
        class="fixed top-4 left-1/2 -translate-x-1/2 z-[999] bg-[#E8F5E9] border border-[#258A3E] text-[#258A3E]
            text-xs sm:text-sm font-semibold px-4 py-3 rounded-xl shadow-lg flex items-center gap-2 max-w-[90%]
            transition-opacity duration-500">
        <span class="w-5 h-5 rounded-full bg-[#258A3E] text-white flex items-center justify-center text-[10px] shrink-0">✓</span>
        {{ session('notif_sukses') }}
    </div>
    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast-notif');
            if (toast) {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 500);
            }
        }, 4000);
    </script>
    @endif
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
                        <path d="M3 12l9-9 9 9" />
                        <path d="M5 10v10h14V10" />
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
            {{-- HEADER --}}
            <div class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 sm:px-6 sm:py-6 md:px-7 md:py-7 flex flex-col gap-1">
                <span class="text-[#D7B899] text-xs sm:text-sm font-medium tracking-wide">
                    Selamat Datang,
                </span>

                <span class="text-white text-2xl md:text-3xl font-['Poppins'] font-bold">
                    {{ $kelas->tingkat }} {{ $kelas->jurusan }} {{ $kelas->rombel }}
                </span>

                <span class="text-[#D7B899] text-xs sm:text-sm font-medium">
                    {{ \App\Support\Waktu::sekarang()->locale('id')->translatedFormat('l, d F Y') }}
                </span>
            </div>


            @if (session('notif_sukses'))
                <div role="status"
                     class="mx-4 mt-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800 sm:mx-6 md:mx-7">
                    {{ session('notif_sukses') }}
                </div>
            @endif

            {{-- ISI --}}
            <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-3.5">

                <span class="font-['Poppins'] font-bold text-md uppercase text-[#3E3028] mt-1">
                    Sesi Mengajar Aktif
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
                        <p class="border-t border-[#E5D8CC] pt-3 text-sm text-[#7A6A60]">◷ {{ $sesi->jam_mulai }}–{{ $sesi->jam_selesai }} (Jam ke-{{ $sesi->jam_ke_mulai }}@if($sesi->jam_ke_sampai !== $sesi->jam_ke_mulai) sampai ke-{{ $sesi->jam_ke_sampai }}@endif)</p>
                        @if($sesi->jurnal && $sesi->jurnal->status_kehadiran_guru === 'hadir')
                            <p class="flex items-center gap-2 text-sm font-semibold text-green-700"><span class="grid h-5 w-5 place-items-center rounded bg-green-600 text-white">✓</span> Kehadiran terverifikasi</p>
                        @endif
                        @if ($sesi->tugas)
                            <div class="rounded-xl border border-rose-200 bg-rose-50 p-3 text-sm text-rose-900">
                                <div class="flex flex-wrap items-center justify-between gap-2"><p class="font-semibold">{{ $sesi->tugas->materi ?? $sesi->jurnal?->materi ?? 'Materi' }}</p></div>
                                @if(\Carbon\Carbon::parse($sesi->tugas->created_at)->gte(\App\Support\Waktu::sekarang()->copy()->subMinutes(30)))<p role="status" class="mt-2 font-semibold">Tugas pengganti baru dikirim guru piket.</p>@endif
                                <p class="mt-2"><span class="font-semibold">Materi:</span> {{ $sesi->tugas->materi ?? $sesi->jurnal?->materi ?? '—' }}</p>
                                <p class="mt-1 whitespace-pre-line"><span class="font-semibold">Tugas:</span> {{ $sesi->tugas->tugas }}</p>
                                @if($sesi->tugas->file_path)<a class="mt-3 inline-flex rounded-lg bg-[#5C4033] px-4 py-2 text-xs font-semibold text-white" href="{{ route('kelas.tugas.download', $sesi->tugas->id_upload_tugas) }}">Buka lampiran</a>@endif
                            </div>
                        @elseif ($sesi->jurnal)

                        @else
                            <p class="rounded-xl bg-[#F5EFE8] p-3 text-xs text-[#7A6A60]">Jurnal sesi ini belum tersedia atau masih menunggu verifikasi guru.</p>
                        @endif
                        @if($sesi->dispensasi->isNotEmpty())
                            <details class="overflow-hidden rounded-xl border border-amber-200 bg-amber-50 text-sm text-amber-950">
                                <summary class="flex cursor-pointer list-none items-center justify-between gap-2 p-3 font-bold"><span>Siswa Dispensasi ({{ $sesi->dispensasi->count() }})</span><span class="transition-transform details-chevron">⌄</span></summary>
                                <div class="border-t border-amber-200 px-3">
                                    @foreach($sesi->dispensasi as $item)
                                        <div class="border-b border-amber-100 py-2 last:border-0"><div class="flex justify-between gap-2"><p class="font-semibold">{{ $item->siswa->nama ?? 'Siswa' }}</p><p class="shrink-0 text-[10px]">Jam ke-{{ $item->jam_ke_mulai }}@if($item->jam_ke_selesai) s/d {{ $item->jam_ke_selesai }}@endif</p></div><p class="mt-1 text-xs">Ket: {{ $item->alasan }}</p><p class="mt-1 text-xs">Disetujui oleh Waka: <strong>{{ $item->waka->nama ?? '—' }}</strong></p><p class="mt-1 text-xs">Diinput oleh Guru Piket: <strong>{{ $item->guruPiket->name ?? '—' }}</strong></p></div>
                                    @endforeach
                                </div>
                            </details>
                        @endif
                        @php($siswaTidakHadir = $sesi->siswaTidakHadir)
                        @if($siswaTidakHadir->isNotEmpty())
                            <details class="overflow-hidden rounded-xl border border-rose-200 bg-rose-50 text-sm text-rose-950">
                                <summary class="flex cursor-pointer list-none items-center justify-between gap-2 p-3 font-bold"><span>Siswa Tidak Hadir ({{ $siswaTidakHadir->count() }})</span><span class="transition-transform details-chevron">⌄</span></summary>
                                <div class="border-t border-rose-200 px-3">@foreach($siswaTidakHadir as $absen)<div class="flex justify-between gap-2 border-b border-rose-100 py-2 last:border-0"><span>{{ $absen->nama }}</span><span class="rounded px-2 py-0.5 text-xs font-bold {{ $absen->status === 'Sakit' ? 'bg-blue-100 text-blue-800' : ($absen->status === 'Izin' ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800') }}">{{ $absen->status }}</span></div>@endforeach</div>
                            </details>
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
                            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $sesi->tugas ? 'bg-sky-100 text-sky-800' : ($sesi->jurnal?->status_kehadiran_guru === 'tidak_hadir' ? 'bg-rose-100 text-rose-800' : 'bg-[#F5EFE8] text-[#5C4033]') }}">{{ $sesi->jurnal?->status_kehadiran_guru === 'hadir' ? 'Hadir' : ($sesi->tugas ? $sesi->tugas->status_guru : ($sesi->jurnal?->status_kehadiran_guru === 'tidak_hadir' || !$sesi->jurnal ? 'Tidak Hadir' : ($sesi->jurnal?->status_kehadiran_guru === 'sakit' ? 'Sakit' : ($sesi->jurnal?->status_kehadiran_guru === 'izin' ? 'Izin' : 'Selesai')))) }}</span>
                            @if($sesi->tugas && $sesi->jurnal?->status_kehadiran_guru !== 'hadir')
                                <p class="w-full flex items-center gap-2 text-sm font-semibold text-red-700"><span class="grid h-5 w-5 place-items-center rounded bg-red-600 text-white">×</span> Guru tidak hadir</p>
                            @elseif($sesi->jurnal?->status_kehadiran_guru === 'hadir')
                                <p class="w-full flex items-center gap-2 text-sm font-semibold text-green-700"><span class="grid h-5 w-5 place-items-center rounded bg-green-600 text-white">✓</span> Kehadiran terverifikasi</p>
                            @elseif($sesi->jurnal?->status_kehadiran_guru === 'tidak_hadir' || !$sesi->jurnal)
                                <p class="w-full flex items-center gap-2 text-sm font-semibold text-red-700"><span class="grid h-5 w-5 place-items-center rounded bg-red-600 text-white">×</span> Guru tidak hadir</p>
                            @endif
                            @if($sesi->tugas)
                                <div class="w-full rounded-xl border border-rose-200 bg-rose-50 p-3 text-sm text-rose-900">
                                    <p class="font-semibold">Materi: {{ $sesi->tugas->materi ?? '—' }}</p>
                                    <p class="mt-1 whitespace-pre-line"><span class="font-semibold">Tugas:</span> {{ $sesi->tugas->tugas }}</p>
                                    @if($sesi->tugas->file_path)<a class="mt-2 inline-flex rounded-lg bg-[#5C4033] px-4 py-2 text-xs font-semibold text-white" href="{{ route('kelas.tugas.download', $sesi->tugas->id_upload_tugas) }}">Buka lampiran</a>@endif
                                </div>
                            @endif
                            @if($sesi->dispensasi->isNotEmpty())
                                <details class="w-full overflow-hidden rounded-xl border border-amber-200 bg-amber-50 text-sm text-amber-950">
                                    <summary class="flex cursor-pointer list-none items-center justify-between gap-2 p-3 font-bold"><span>Siswa Dispensasi ({{ $sesi->dispensasi->count() }})</span><span>⌄</span></summary>
                                    <div class="border-t border-amber-200 px-3">@foreach($sesi->dispensasi as $item)<div class="border-b border-amber-100 py-2 last:border-0"><div class="flex justify-between gap-2"><p class="font-semibold">{{ $item->siswa->nama ?? 'Siswa' }}</p><p class="shrink-0 text-[10px]">Jam ke-{{ $item->jam_ke_mulai }}@if($item->jam_ke_selesai) s/d {{ $item->jam_ke_selesai }}@endif</p></div><p class="mt-1 text-xs">Ket: {{ $item->alasan }}</p><p class="mt-1 text-xs">Disetujui oleh Waka: <strong>{{ $item->waka->nama ?? '—' }}</strong></p><p class="mt-1 text-xs">Diinput oleh Guru Piket: <strong>{{ $item->guruPiket->name ?? '—' }}</strong></p></div>@endforeach</div>
                                </details>
                            @endif
                            @php($siswaTidakHadir = $sesi->siswaTidakHadir)
                            @if($siswaTidakHadir->isNotEmpty())
                                <details class="w-full overflow-hidden rounded-xl border border-rose-200 bg-rose-50 text-sm text-rose-950"><summary class="flex cursor-pointer list-none items-center justify-between gap-2 p-3 font-bold"><span>Siswa Tidak Hadir ({{ $siswaTidakHadir->count() }})</span><span>⌄</span></summary><div class="border-t border-rose-200 px-3">@foreach($siswaTidakHadir as $absen)<div class="flex justify-between gap-2 border-b border-rose-100 py-2 last:border-0"><span>{{ $absen->nama }}</span><span class="rounded px-2 py-0.5 text-xs font-bold {{ $absen->status === 'Sakit' ? 'bg-blue-100 text-blue-800' : ($absen->status === 'Izin' ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800') }}">{{ $absen->status }}</span></div>@endforeach</div></details>
                            @endif
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