<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekap Piket | Jurnal Guru</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>tailwind.config={theme:{extend:{colors:{brand:{50:'#F9F6F0',100:'#EFE6DD',200:'#E2C7B0',300:'#D7B899',600:'#7A6A60',800:'#5C4033',900:'#3E2B22'}}}}}</script>
</head>
<body class="min-h-screen bg-brand-50 text-[#3E3028] font-sans flex">
  @include('guru.partials.piket-sidebar')
  <div class="flex-1 md:ml-64 min-w-0 flex flex-col min-h-screen pb-24 md:pb-8">
  <header class="sticky top-0 z-20 h-16 bg-[#5C4033] px-5 md:px-10 flex items-center shadow">
    <h1 class="text-white font-bold">Rekap Piket</h1>
  </header>
  <main class="w-full max-w-7xl px-4 md:px-8 py-7 space-y-6">
    @if(session('success'))<div class="rounded-xl bg-green-50 border border-green-200 text-green-800 px-4 py-3">{{ session('success') }}</div>@endif
    <section class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
      <div><p class="text-sm font-semibold uppercase tracking-wider text-brand-600">Arsip kegiatan piket</p><h1 class="mt-1 text-2xl font-extrabold">Rekap Kegiatan</h1><p class="mt-1 text-sm text-[#8C7B70]">Pilih jenis data dan rentang tanggal. Hasil yang tampil bisa diunduh sebagai file Excel.</p></div>
      <a href="{{ route('piket.rekap.export', request()->query()) }}" class="inline-flex justify-center items-center gap-2 rounded-xl bg-[#5C4033] px-5 py-3 text-sm font-bold text-white hover:bg-[#3E2B22]">↓ Unduh Excel</a>
    </section>

    <form method="GET" action="{{ route('piket.rekap') }}" class="rounded-2xl border border-brand-100 bg-white p-4 md:p-5 flex flex-col md:flex-row md:items-end gap-3">
      <input type="hidden" name="jenis" value="{{ $jenis }}">
      <label class="flex flex-col gap-1 text-sm font-semibold">Dari tanggal<input type="date" name="mulai" value="{{ $mulai }}" class="h-11 rounded-xl border border-brand-200 px-3 font-normal"></label>
      <label class="flex flex-col gap-1 text-sm font-semibold">Sampai tanggal<input type="date" name="sampai" value="{{ $sampai }}" class="h-11 rounded-xl border border-brand-200 px-3 font-normal"></label>
      <button class="h-11 rounded-xl bg-brand-800 px-5 text-sm font-bold text-white hover:bg-brand-900">Terapkan Filter</button>
      @if(isset($errors) && $errors->any())<p class="text-sm text-red-700">{{ $errors->first() }}</p>@endif
    </form>

    @php($cards = [
      'semua' => ['Semua', $jumlahSemua, 'border-brand-200'],
      'jurnal' => ['Jurnal Mengajar', $counts['jurnal'], 'border-amber-200'],
      'dispen' => ['Dispensasi Siswa', $counts['dispen'], 'border-violet-200'],
      'surat' => ['Input Surat', $counts['surat'], 'border-sky-200'],
      'tugas' => ['Upload Tugas', $counts['tugas'], 'border-emerald-200'],
    ])
    <section class="grid grid-cols-2 lg:grid-cols-5 gap-3">
      @foreach($cards as $key => [$title, $count, $border])
        <a href="{{ route('piket.rekap', ['mulai' => $mulai, 'sampai' => $sampai, 'jenis' => $key]) }}" class="rounded-2xl border-2 {{ $border }} {{ $jenis === $key ? 'bg-[#F5EFE8] ring-2 ring-[#D7B899]' : 'bg-white' }} p-4 hover:shadow-sm transition">
          <p class="text-xs md:text-sm font-semibold text-[#7A6A60]">{{ $title }}</p><p class="mt-2 text-2xl font-extrabold">{{ $count }}</p><p class="text-xs text-[#8C7B70]">catatan</p>
        </a>
      @endforeach
    </section>

    <section class="overflow-hidden rounded-2xl border border-brand-100 bg-white">
      <div class="flex items-center justify-between gap-3 border-b border-brand-100 px-4 py-4 md:px-5"><div><h2 class="font-bold">{{ $jenis === 'semua' ? 'Semua Rekap' : $cards[$jenis][0] }}</h2><p class="text-xs text-[#8C7B70]">{{ $mulai }} s.d. {{ $sampai }} · {{ count($rows) }} catatan</p></div></div>
      @if(count($rows))
        <div class="overflow-x-auto"><table class="w-full min-w-[900px] text-left text-sm"><thead class="bg-brand-50 text-xs uppercase tracking-wide text-brand-600"><tr><th class="px-4 py-3">Tanggal</th><th class="px-4 py-3">Jenis</th><th class="px-4 py-3">Kelas</th><th class="px-4 py-3">Siswa</th><th class="px-4 py-3">Guru Piket / Guru</th><th class="px-4 py-3">Mapel</th><th class="px-4 py-3">Keterangan</th><th class="px-4 py-3">Status</th></tr></thead><tbody class="divide-y divide-brand-100">
        @foreach($rows as $row)<tr class="align-top hover:bg-brand-50/60"><td class="whitespace-nowrap px-4 py-3">{{ $row[0] }}</td><td class="px-4 py-3 font-semibold">{{ $row[1] }}</td><td class="px-4 py-3">{{ $row[2] }}</td><td class="px-4 py-3">{{ $row[3] ?? '—' }}</td><td class="px-4 py-3">{{ $row[4] ?? '—' }}</td><td class="px-4 py-3">{{ $row[5] ?? '—' }}</td><td class="max-w-sm px-4 py-3">{{ $row[6] ?? '—' }}</td><td class="px-4 py-3">{{ $row[7] ?? '—' }}</td></tr>@endforeach
        </tbody></table></div>
      @else
        <div class="px-5 py-14 text-center"><p class="font-bold">Belum ada data pada tanggal ini</p><p class="mt-1 text-sm text-[#8C7B70]">Coba pilih rentang tanggal atau jenis rekap yang lain.</p></div>
      @endif
    </section>
  </main>
  </div>
  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-3 px-6 z-30 flex justify-between text-xs font-medium text-brand-600">
    <a @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif @if(!auth()->user()->sedangPiket()) style="pointer-events:none;opacity:.5;cursor:not-allowed" @endif class="font-bold text-brand-800">Piket</a><a href="{{ route('profil-guru') }}">Profil</a>
  </nav>
</body>
</html>
