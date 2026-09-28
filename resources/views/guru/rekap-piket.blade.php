<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekap Piket | Jurnal Guru</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>tailwind.config={theme:{extend:{fontFamily:{sans:['Inter','sans-serif'],poppins:['Poppins','sans-serif']},colors:{brand:{50:'#F9F6F0',100:'#EFE6DD',200:'#E2C7B0',300:'#D7B899',600:'#7A6A60',800:'#5C4033',900:'#3E2B22'}}}}}</script>
</head>
<body class="min-h-screen bg-brand-50 text-[#3E3028] font-sans flex">
  @include('guru.partials.piket-sidebar')
  <div class="flex-1 md:ml-64 min-w-0 flex flex-col min-h-screen pb-24 md:pb-8">
  <header class="sticky top-0 z-20 w-full bg-[#5C4033] px-4 py-4 md:px-10 md:py-5 shadow">
    <div class="flex items-center gap-3">
      <a href="{{ auth()->user()->sedangPiket() ? route('dashboard-guru-piket') : (auth()->user()->role === 'wali_kelas' ? route('dashboard-guru') : route('dashboard-guru')) }}" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white/10 text-white hover:bg-white/20" aria-label="Kembali">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
      </a>
      <h1 class="font-poppins text-xl sm:text-2xl font-bold text-white">Rekap Piket</h1>
    </div>
  </header>
  <main class="w-full max-w-7xl px-4 md:px-8 py-7 space-y-6">
    @if(session('success'))<div class="rounded-xl bg-green-50 border border-green-200 text-green-800 px-4 py-3">{{ session('success') }}</div>@endif
    <section class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
    </section>

    <form method="GET" action="{{ route('piket.rekap') }}" class="rounded-2xl border border-brand-100 bg-white p-3 md:p-5 grid grid-cols-2 md:flex md:items-end gap-2 md:gap-3">
      <label class="col-span-2 min-w-0 flex flex-col gap-1 text-[11px] font-semibold sm:text-sm">Jenis rekap<select name="jenis" class="h-9 rounded-lg border border-brand-200 bg-white px-2 text-xs sm:text-sm"><option value="semua" @selected($jenis === 'semua')>Semua</option><option value="jurnal" @selected($jenis === 'jurnal')>Jurnal mengajar</option><option value="dispen" @selected($jenis === 'dispen')>Dispensasi saja</option><option value="surat" @selected($jenis === 'surat')>Input surat saja</option><option value="tugas" @selected($jenis === 'tugas')>Upload tugas saja</option></select></label>
      <label class="min-w-0 flex flex-col gap-1 text-[11px] sm:text-sm font-semibold">Dari tanggal<input type="date" name="mulai" value="{{ $mulai }}" class="h-9 w-full min-w-0 rounded-lg border border-brand-200 px-1.5 sm:px-3 text-[11px] sm:text-sm font-normal"></label>
      <label class="min-w-0 flex flex-col gap-1 text-[11px] sm:text-sm font-semibold">Sampai tanggal<input type="date" name="sampai" value="{{ $sampai }}" class="h-9 w-full min-w-0 rounded-lg border border-brand-200 px-1.5 sm:px-3 text-[11px] sm:text-sm font-normal"></label>
      <button class="col-span-2 md:col-span-1 h-9 md:h-11 rounded-lg md:rounded-xl bg-brand-800 px-3 md:px-5 text-xs md:text-sm font-bold text-white hover:bg-brand-900">Terapkan Filter</button>
      @if(isset($errors) && $errors->any())<p class="col-span-2 text-xs sm:text-sm text-red-700">{{ $errors->first() }}</p>@endif
    </form>

    @php($cards = [
      'semua' => ['Semua', $jumlahSemua, 'border-brand-200'],
      'jurnal' => ['Jurnal Mengajar', $counts['jurnal'], 'border-amber-200'],
      'dispen' => ['Dispensasi Siswa', $counts['dispen'], 'border-violet-200'],
      'surat' => ['Input Surat', $counts['surat'], 'border-sky-200'],
      'tugas' => ['Upload Tugas', $counts['tugas'], 'border-emerald-200'],
    ])
    <section class="grid grid-cols-5 gap-1.5 sm:gap-3">
      @foreach($cards as $key => [$title, $count, $border])
        <a href="{{ route('piket.rekap', ['mulai' => $mulai, 'sampai' => $sampai, 'jenis' => $key]) }}" class="min-w-0 rounded-xl sm:rounded-2xl border {{ $border }} {{ $jenis === $key ? 'bg-[#F5EFE8] ring-1 sm:ring-2 ring-[#D7B899]' : 'bg-white' }} p-1.5 sm:p-4 hover:shadow-sm transition">
          <p class="min-h-6 text-[9px] leading-tight sm:min-h-0 sm:text-sm font-semibold text-[#7A6A60]">{{ $title }}</p><p class="mt-1 sm:mt-2 text-base sm:text-2xl font-extrabold">{{ $count }}</p><p class="hidden sm:block text-xs text-[#8C7B70]">catatan</p>
        </a>
      @endforeach
    </section>

    <section class="overflow-hidden rounded-2xl border border-brand-100 bg-white">
      <div class="flex items-center justify-between gap-3 border-b border-brand-100 px-4 py-4 md:px-5"><div><h2 class="font-bold">{{ $jenis === 'semua' ? 'Semua Rekap' : $cards[$jenis][0] }}</h2><p class="text-xs text-[#8C7B70]">{{ \Carbon\Carbon::parse($mulai)->format('d/m/Y') }} s.d. {{ \Carbon\Carbon::parse($sampai)->format('d/m/Y') }} · {{ count($rows) }} catatan</p></div><a href="{{ route('piket.rekap.export', ['mulai' => $mulai, 'sampai' => $sampai, 'jenis' => $jenis]) }}" class="shrink-0 rounded-lg bg-[#5C4033] px-3 py-2 text-xs font-bold text-white hover:bg-[#452F26]">Export Excel</a></div>
      @if(count($rows))
        <div class="overflow-x-auto"><table class="w-full min-w-[900px] text-left text-sm"><thead class="bg-brand-50 text-xs uppercase tracking-wide text-brand-600"><tr><th class="px-4 py-3">Tanggal</th><th class="px-4 py-3">Jenis</th><th class="px-4 py-3">Kelas</th><th class="px-4 py-3">Siswa</th><th class="px-4 py-3">Guru Piket / Guru</th><th class="px-4 py-3">Mapel</th><th class="px-4 py-3">Keterangan</th><th class="px-4 py-3">Status</th></tr></thead><tbody class="divide-y divide-brand-100">
        @foreach($rows as $row)<tr class="align-top hover:bg-brand-50/60"><td class="whitespace-nowrap px-4 py-3">{{ $row[0] }}</td><td class="px-4 py-3 font-semibold">{{ $row[1] }}</td><td class="px-4 py-3">{{ $row[2] }}</td><td class="px-4 py-3">{{ $row[3] ?? '—' }}</td><td class="px-4 py-3">{{ $row[4] ?? '—' }}</td><td class="px-4 py-3">{{ $row[5] ?? '—' }}</td><td class="max-w-sm px-4 py-3">{{ $row[6] ?? '—' }}</td><td class="px-4 py-3">{{ $row[7] ?? '—' }}</td></tr>@endforeach
        </tbody></table></div>
      @else
        <div class="px-5 py-14 text-center"><p class="font-bold">Belum ada data pada rentang tanggal ini</p><p class="mt-1 text-sm text-[#8C7B70]">Periksa tanggal yang dipilih atau coba rentang tanggal lain.</p></div>
      @endif
    </section>
  </main>
  </div>
  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-3.5 px-6 z-50 shadow-[0_-4px_25px_rgba(0,0,0,0.06)]">
    <div class="flex justify-between items-center">
      <a href="{{ route('dashboard-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-brand-600"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/></svg><span>Beranda</span></a>
      <a href="{{ route('jurnal.create') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-brand-600"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/><path d="M7 3v14"/></svg><span>Jurnal</span></a>
      <a href="{{ route('riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-brand-600"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 4h14M3 8h14M3 12h10M3 16h6"/></svg><span>Riwayat</span></a>
      @if(auth()->user()->role === 'wali_kelas' && !auth()->user()->sedangPiket())
      <a href="{{ route('piket.rekap') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>{{ auth()->user()->role === 'wali_kelas' && !auth()->user()->sedangPiket() ? 'Rekap Piket' : 'Piket' }}</span></a>
      @elseif(auth()->user()->sedangPiket())
      <a href="{{ route('dashboard-guru-piket') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-brand-600 opacity-40"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>{{ auth()->user()->role === 'wali_kelas' && !auth()->user()->sedangPiket() ? 'Rekap Piket' : 'Piket' }}</span></a>
      @else
      <span aria-disabled="true" title="Menu tersedia saat jadwal piket aktif" class="flex flex-col items-center gap-1 text-xs font-medium text-brand-600 opacity-40"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>Piket</span></span>
      @endif
      <a href="{{ route('profil-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-brand-600"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/><circle cx="10" cy="6.5" r="3.5"/></svg><span>Profil</span></a>
    </div>
  </nav>
</body>
</html>
