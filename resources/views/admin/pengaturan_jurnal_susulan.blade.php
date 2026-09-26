<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izin Jurnal Susulan - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>html{scrollbar-width:none}html::-webkit-scrollbar{display:none}</style>
</head>
<body class="min-h-screen overflow-x-hidden bg-[#F5EFE8] font-['Inter'] text-[#3E3028]">
    <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-black/40 md:hidden" onclick="closeSidebar()"></div>
    @include('admin.partials.tambah_sidebar')
    <main class="min-h-screen md:ml-[280px]">
        <header class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 text-white shadow-sm sm:px-6 md:px-7">
            <div class="flex items-center justify-between gap-3"><div><p class="text-xs font-medium text-[#D7B899]">Pengaturan Jurnal</p><h1 class="font-['Poppins'] text-xl font-bold md:text-2xl">Izin Jurnal Susulan</h1></div><button type="button" onclick="openSidebar()" class="rounded-lg px-3 py-2 text-white hover:bg-white/10 md:hidden" aria-label="Buka sidebar">☰</button></div>
        </header>
        <section class="flex flex-col gap-4 p-4 sm:p-6 md:p-7">
            @if (session('success'))<div class="rounded-xl border border-[#B7DDBB] bg-[#E8F5E9] px-4 py-3 text-sm font-semibold text-[#2E7D32]">{{ session('success') }}</div>@endif
            @if ($errors->any())<div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-800">{{ $errors->first() }}</div>@endif
            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white shadow-sm">
                <div class="flex items-center justify-between gap-3 border-b border-[#E5D8CC] bg-[#FFFCF9] px-4 py-3">
                    <div><h2 class="font-['Poppins'] text-base font-bold">Atur Izin Jurnal Guru</h2><p class="mt-0.5 text-xs text-[#7A6A60]">Cari nama, pilih guru, lalu atur izin jurnal kemarin.</p></div>
                    <a href="{{ route('admin.jurnal') }}" class="shrink-0 rounded-lg border border-[#D8C9BC] bg-white px-3 py-2 text-xs font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Lihat Jurnal</a>
                </div>
                <div class="relative border-b border-[#E5D8CC] px-4 py-3">
                    <div class="flex flex-col gap-1.5 sm:flex-row sm:items-center sm:gap-4"><label for="cari-guru" class="shrink-0 text-sm font-semibold">Cari Nama Guru</label><input id="cari-guru" type="search" autocomplete="off" placeholder="Ketik nama guru di sini..." class="h-10 w-full rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"></div>
                    <div id="hasil-guru" class="absolute left-4 right-4 top-[calc(100%-0.75rem)] z-20 hidden max-h-56 overflow-y-auto rounded-lg border border-[#E5D8CC] bg-white p-1 shadow-lg">
                        @forelse($guruList as $guru)
                            <a href="{{ route('admin.aturan-jurnal-susulan.edit', ['id_guru' => $guru->id]) }}" data-nama="{{ strtolower($guru->name) }}" class="hasil-guru block rounded-md px-3 py-2 text-sm hover:bg-[#F5EFE8]"><span class="font-semibold">{{ $guru->name }}</span>@if($guru->role === 'guru_piket')<span class="ml-2 text-xs text-[#7A6A60]">Guru Piket</span>@endif</a>
                        @empty
                            <p class="px-3 py-2 text-sm text-[#7A6A60]">Belum ada akun guru.</p>
                        @endforelse
                        <p id="guru-tidak-ditemukan" class="hidden px-3 py-2 text-sm text-[#7A6A60]">Nama guru tidak ditemukan.</p>
                    </div>
                </div>
                @if($guruDipilih && $pengaturan)
                    <div class="flex flex-col gap-3 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex min-w-0 items-center gap-2.5">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg {{ $pengaturan->aktif ? 'bg-[#E8F5E9] text-[#2E7D32]' : 'bg-[#F5EFE8] text-[#7A6A60]' }}"><svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14H3V6a2 2 0 0 1 2-2z"/><path d="m9 16 2 2 4-4"/></svg></span>
                            <div class="min-w-0"><p class="truncate text-sm font-semibold">{{ $guruDipilih->name }}</p><p class="text-xs text-[#7A6A60]">Izin jurnal kemarin <span class="font-semibold {{ $pengaturan->aktif ? 'text-[#2E7D32]' : 'text-[#7A6A60]' }}">{{ $pengaturan->aktif ? 'Aktif' : 'Nonaktif' }}</span></p></div>
                        </div>
                        <form method="POST" action="{{ route('admin.aturan-jurnal-susulan.update') }}" class="flex shrink-0 items-center gap-2 self-end sm:self-center">@csrf @method('PUT')<input type="hidden" name="id_guru" value="{{ $guruDipilih->id }}"><button type="submit" name="aktif" value="1" @disabled($pengaturan->aktif) class="min-w-14 rounded-lg px-4 py-2 text-xs font-bold transition {{ $pengaturan->aktif ? 'cursor-default bg-green-700 text-white' : 'border border-green-200 bg-green-50 text-green-800 hover:bg-green-100' }}">ON</button><button type="submit" name="aktif" value="0" @disabled(!$pengaturan->aktif) class="min-w-14 rounded-lg px-4 py-2 text-xs font-bold transition {{ !$pengaturan->aktif ? 'cursor-default bg-[#7A6A60] text-white' : 'border border-[#D8C9BC] bg-white text-[#5C4033] hover:bg-[#F5EFE8]' }}">OFF</button></form>
                    </div>
                @elseif($guruList->isNotEmpty())
                    <p class="px-4 py-3 text-xs text-[#7A6A60]">Pilih nama guru dari hasil pencarian untuk mengatur izinnya.</p>
                @else
                    <p class="px-4 py-3 text-xs text-[#7A6A60]">Belum ada akun guru untuk diatur.</p>
                @endif
            </article>
        </section>
    </main>
<script>
        function openSidebar(){document.getElementById('sidebar').classList.remove('-translate-x-full');document.getElementById('sidebarOverlay').classList.remove('hidden')}
        function closeSidebar(){document.getElementById('sidebar').classList.add('-translate-x-full');document.getElementById('sidebarOverlay').classList.add('hidden')}
        const inputGuru = document.getElementById('cari-guru');
        const hasilGuru = document.getElementById('hasil-guru');
        const opsiGuru = [...document.querySelectorAll('.hasil-guru')];
        const guruTidakDitemukan = document.getElementById('guru-tidak-ditemukan');
        inputGuru?.addEventListener('input', () => {
            const query = inputGuru.value.trim().toLocaleLowerCase('id');
            let jumlahCocok = 0;
            opsiGuru.forEach(opsi => { const cocok = window.matchesAllSearchTerms(query, 'nama ' + opsi.dataset.nama, opsi.textContent); opsi.hidden = !cocok; if (cocok) jumlahCocok++; });
            guruTidakDitemukan?.classList.toggle('hidden', jumlahCocok > 0);
            hasilGuru.classList.toggle('hidden', !query);
        });
        inputGuru?.addEventListener('focus', () => { if (inputGuru.value.trim()) hasilGuru.classList.remove('hidden'); });
        document.addEventListener('click', event => { if (!event.target.closest('#cari-guru') && !event.target.closest('#hasil-guru')) hasilGuru?.classList.add('hidden'); });
    </script>
    @include('shared.preserve_search_scroll')
</body>
</html>
