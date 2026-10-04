<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekap Piket | Jurnal Guru</title>
  <style>
    html, body { scrollbar-width: none; }
    html::-webkit-scrollbar, body::-webkit-scrollbar { display: none; }
  </style>
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
  <main class="w-full max-w-none px-3 sm:px-5 lg:px-8 py-5 sm:py-7 space-y-5 sm:space-y-6">
    @if(session('success'))<div class="rounded-xl bg-green-50 border border-green-200 text-green-800 px-4 py-3">{{ session('success') }}</div>@endif
    <form method="GET" action="{{ route('piket.rekap') }}" class="rounded-2xl border border-brand-100 bg-white p-3 sm:p-5 grid grid-cols-2 lg:flex lg:items-end gap-2 sm:gap-3">
      <input type="hidden" name="jenis" value="{{ $jenis }}">
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
    <section class="grid grid-cols-5 gap-1 sm:gap-2">
      @foreach($cards as $key => [$title, $count, $border])
        <a href="{{ route('piket.rekap', ['mulai' => $mulai, 'sampai' => $sampai, 'jenis' => $key]) }}" class="min-w-0 min-h-[4.5rem] sm:min-h-24 rounded-lg sm:rounded-xl border {{ $border }} {{ $jenis === $key ? 'bg-[#F5EFE8] ring-1 sm:ring-2 ring-[#D7B899]' : 'bg-white' }} px-1 py-2 sm:p-3 text-center hover:shadow-sm transition">
          <p class="text-[9px] leading-tight sm:text-xs font-semibold text-[#7A6A60]">{{ $title }}</p><p class="mt-1 text-sm sm:text-xl font-extrabold">{{ $count }}</p>
        </a>
      @endforeach
    </section>

    <section class="overflow-hidden rounded-2xl border border-brand-100 bg-white">
      <div class="border-b border-brand-100 p-3 sm:p-4"><label for="cariRekapPiket" class="mb-1 block text-xs font-semibold text-[#7A6A60]">Cari nama, kelas, mapel, kegiatan, atau status</label><input id="cariRekapPiket" type="search" oninput="filterRekapPiket()" placeholder="Ketik untuk mencari..." class="h-10 w-full rounded-lg border border-brand-200 px-3 text-sm outline-none focus:border-brand-800"></div>
      <div class="flex items-center justify-between gap-3 border-b border-brand-100 px-4 py-4 md:px-5"><div><h2 class="font-bold">{{ $jenis === 'semua' ? 'Semua Rekap' : $cards[$jenis][0] }}</h2><p class="text-xs text-[#8C7B70]">{{ \Carbon\Carbon::parse($mulai)->format('d/m/Y') }} s.d. {{ \Carbon\Carbon::parse($sampai)->format('d/m/Y') }} · {{ count($rows) }} catatan</p></div><a href="{{ route('piket.rekap.export', ['mulai' => $mulai, 'sampai' => $sampai, 'jenis' => $jenis]) }}" class="shrink-0 rounded-lg bg-[#5C4033] px-3 py-2 text-xs font-bold text-white hover:bg-[#452F26]">Export Excel</a></div>
      @if(count($rows))
        @php($rowsPerKelas = collect($rows)->groupBy(fn ($row) => $row[2] ?? '—'))
        <div class="grid gap-3 p-3 sm:p-4">
          @foreach($rowsPerKelas as $namaKelas => $items)
            <article class="rekap-kelas min-w-0 rounded-xl border border-brand-100 bg-[#FFFCF9] p-4 sm:p-5" data-cari="{{ strtolower($namaKelas.' '.$items->flatten(1)->implode(' ')) }}">
              <div class="flex items-start justify-between gap-3"><div class="min-w-0"><p class="text-xs text-[#8C7B70]">{{ $items->count() }} catatan</p><h3 class="mt-1 font-bold">{{ $namaKelas }}</h3><p class="mt-1 text-xs text-[#8C7B70]">{{ $items->pluck(0)->unique()->count() }} tanggal aktivitas</p></div><button type="button" onclick="bukaRekapKelas({{ $loop->index }})" class="shrink-0 rounded-lg bg-brand-800 px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-900">Lihat detail</button></div>
            </article>
          @endforeach
        </div>
      @else
        <div class="px-5 py-14 text-center"><p class="font-bold">Belum ada data pada rentang tanggal ini</p><p class="mt-1 text-sm text-[#8C7B70]">Periksa tanggal yang dipilih atau coba rentang tanggal lain.</p></div>
      @endif
    </section>
  </main>
  </div>
  <dialog id="dialogRekapKelas" class="w-[calc(100%-1.5rem)] max-w-2xl max-h-[85vh] overflow-y-auto rounded-2xl border border-brand-100 p-0 shadow-xl">
    <div class="sticky top-0 z-10 flex items-center justify-between gap-3 border-b border-brand-100 bg-white px-4 py-4 sm:px-6"><div><p class="text-xs font-semibold uppercase tracking-wide text-brand-600">Detail rekap kelas</p><h2 id="judulRekapKelas" class="mt-1 font-poppins text-lg font-bold"></h2></div><button type="button" onclick="document.getElementById('dialogRekapKelas').close()" class="rounded-lg border border-brand-100 px-3 py-2 text-sm font-semibold">Tutup</button></div>
    <div id="isiRekapKelas" class="grid gap-3 p-4 sm:p-6"></div>
  </dialog>
  <script>
    const rekapPerKelas = @js(collect($rows)->groupBy(fn ($row) => $row[2] ?? '—')->values());
    function filterRekapPiket() { const q = document.getElementById('cariRekapPiket').value.trim().toLocaleLowerCase(); document.querySelectorAll('.rekap-kelas').forEach(card => card.classList.toggle('hidden', !card.dataset.cari.includes(q))); }
    function rekapTeks(value) { const node = document.createElement('span'); node.textContent = value ?? '—'; return node.innerHTML; }
    function tanggalUrut(tanggal) {
      const [hari, bulan, tahun] = String(tanggal).split('/');
      return Number(`${tahun}${bulan}${hari}`);
    }
    function bukaRekapKelas(index) {
      const items = rekapPerKelas[index];
      if (!items) return;
      document.getElementById('judulRekapKelas').textContent = items[0][2] || 'Rekap kelas';
      const jenisGabungan = ['Input Surat', 'Dispensasi Siswa'];
      const terbaruPerNama = new Map();
      const barisBiasa = [];
      items.forEach(row => {
        if (!jenisGabungan.includes(row[1]) || !row[3]) {
          barisBiasa.push(row);
          return;
        }
        const kunci = `${row[1]}|${row[0]}|${row[3].trim().toLocaleLowerCase()}`;
        const sebelumnya = terbaruPerNama.get(kunci);
        if (!sebelumnya || tanggalUrut(row[0]) >= tanggalUrut(sebelumnya[0])) terbaruPerNama.set(kunci, row);
      });
      const htmlBiasa = barisBiasa.map(row => {
        const detailUtama = [
          row[5] ? `<span><b>Mapel:</b> ${rekapTeks(row[5])}</span>` : '',
          row[3] ? `<span><b>Siswa:</b> ${rekapTeks(row[3])}</span>` : '',
        ].filter(Boolean).join('<span class="text-brand-200">·</span>');
        const pengajar = row[8] ? `<p><span class="text-brand-600">Mengajar</span><span class="ml-2 font-medium">${rekapTeks(row[8])}</span></p>` : '';
        const penginput = row[9] ? `<p><span class="text-brand-600">Diinput oleh</span><span class="ml-2 font-medium">${rekapTeks(row[9])}</span></p>` : '';
        const waka = row[10] ? `<p><span class="text-brand-600">Waka</span><span class="ml-2 font-medium">${rekapTeks(row[10])}</span></p>` : '';
        return `<article class="rounded-xl border border-brand-100 bg-white p-4"><header class="flex items-center justify-between gap-3"><div class="min-w-0"><p class="text-xs text-brand-600">${rekapTeks(row[0])}</p><h3 class="mt-1 font-poppins font-bold">${rekapTeks(row[1])}</h3></div><span class="shrink-0 rounded-full bg-brand-50 px-3 py-1 text-xs font-semibold text-brand-800">${rekapTeks(row[7])}</span></header>${detailUtama ? `<p class="mt-3 flex flex-wrap items-center gap-x-2 gap-y-1 border-b border-brand-50 pb-3 text-sm">${detailUtama}</p>` : ''}<div class="mt-3 space-y-1 text-sm">${pengajar}${penginput}${waka}</div><div class="mt-3 border-t border-brand-50 pt-3"><p class="text-xs text-brand-600">Keterangan</p><p class="mt-1 whitespace-pre-line break-words text-sm leading-5">${rekapTeks(row[6] || 'Tidak ada keterangan')}</p></div></article>`;
      }).join('');
      const groupedRows = Array.from(terbaruPerNama.values()).reduce((groups, row) => {
        (groups[row[1]] ||= []).push(row);
        return groups;
      }, {});
      const htmlGabungan = Object.entries(groupedRows).map(([jenis, rows]) => {
        rows.sort((a, b) => tanggalUrut(b[0]) - tanggalUrut(a[0]));
        const daftarSiswa = rows.map(row => {
          const warnaStatus = row[7] === 'Sakit' ? 'bg-blue-100 text-blue-800' : (row[7] === 'Izin' ? 'bg-amber-100 text-amber-800' : 'bg-brand-50 text-brand-800');
          const detailInput = row[9] ? `<p class="mt-1 text-xs text-brand-600">Diinput oleh ${rekapTeks(row[9])}</p>` : '';
          const detailWaka = row[10] ? `<p class="mt-1 text-xs text-brand-600">Waka ${rekapTeks(row[10])}</p>` : '';
          return `<li class="flex items-start justify-between gap-3 border-b border-brand-50 py-3 last:border-0"><div class="min-w-0"><p class="font-semibold">${rekapTeks(row[3])}</p><p class="mt-0.5 text-xs text-brand-600">${rekapTeks(row[0])} · ${rekapTeks(row[6])}</p>${detailInput}${detailWaka}</div><span class="shrink-0 rounded-full ${warnaStatus} px-3 py-1 text-xs font-semibold">${rekapTeks(row[7])}</span></li>`;
        }).join('');
        return `<article class="rounded-xl border border-brand-100 bg-white p-4"><header class="border-b border-brand-100 pb-2"><h3 class="font-poppins font-bold">${rekapTeks(jenis)} <span class="font-sans text-sm font-medium text-brand-600">(${rows.length})</span></h3></header><ul>${daftarSiswa}</ul></article>`;
      }).join('');
      document.getElementById('isiRekapKelas').innerHTML = htmlGabungan + htmlBiasa;
      document.getElementById('dialogRekapKelas').showModal();
    }
  </script>
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
