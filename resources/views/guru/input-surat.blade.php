<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Surat - Piket</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'], poppins: ['Poppins', 'sans-serif'] }, colors: { brand: { 50:'#F9F6F0',100:'#EFE6DD',200:'#E2C7B0',300:'#D7B899',600:'#7A6A60',700:'#6D5C52',800:'#5C4033',900:'#3E2B22' } } } } };
  </script>
  <style>
    html { scrollbar-width:none; } html::-webkit-scrollbar { display:none; }
    .guru-sidebar-nav a { gap:.75rem!important; padding:.625rem .75rem!important; border-radius:.5rem!important; font-size:1rem!important; color:#7A6A60!important; }
    .guru-sidebar-nav a svg { color:#7A6A60!important; }
    .guru-sidebar-nav a.bg-\[\#F5EFE8\] { color:#5C4033!important; }
    .guru-sidebar-nav a.bg-\[\#F5EFE8\] svg { color:#3E3028!important; }
    .guru-sidebar > div:first-child { padding:1.5rem 1rem!important; gap:2rem!important; }
  </style>
</head>
<body class="bg-brand-50 font-sans min-h-screen flex text-[#3E3028]">
  <aside class="guru-sidebar w-64 bg-white border-r border-[#E5D8CC] min-h-screen flex flex-col justify-between shrink-0 fixed left-0 top-0 bottom-0 z-40 hidden md:flex">
    <div class="py-6 px-4 flex flex-col gap-8">
      <div class="flex flex-col gap-0.5"><h2 class="font-poppins font-extrabold text-xl text-[#3E3028] tracking-tight">JURNAL GURU</h2><span class="text-md font-medium text-[#7A6A60]">Akun Guru</span></div>
      <nav class="guru-sidebar-nav flex flex-col gap-1">
        <a href="{{ url('/dashboard-guru') }}" class="flex items-center rounded-lg font-medium hover:bg-[#F5EFE8] transition-all"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/></svg><span>Beranda</span></a>
        <a href="{{ route('jurnal.create') }}" class="flex items-center rounded-lg font-medium hover:bg-[#F5EFE8] transition-all"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/><path d="M7 3v14"/></svg><span>Isi Jurnal</span></a>
        <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center rounded-lg font-medium hover:bg-[#F5EFE8] transition-all"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 4h14M3 8h14M3 12h10M3 16h6"/></svg><span>Riwayat Jurnal</span></a>
        <a @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif @if(!auth()->user()->sedangPiket()) style="pointer-events:none;opacity:.5;cursor:not-allowed" @endif class="flex items-center gap-3 px-3 py-2.5 bg-[#F5EFE8] rounded-lg font-poppins font-bold transition-all"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>Piket</span></a>
        <a href="{{ url('/profil-guru') }}" class="flex items-center rounded-lg font-medium hover:bg-[#F5EFE8] transition-all"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/><circle cx="10" cy="6.5" r="3.5"/></svg><span>Profil</span></a>
      </nav>
    </div>
    <div class="p-4 text-xs text-[#9E8E83]">Jurnal Guru · Menu Piket</div>
  </aside>

  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8 w-full min-w-0">
    <header class="sticky top-0 z-30 w-full bg-[#5C4033] shadow-md px-6 md:px-10 py-6 flex flex-col justify-between items-start gap-3">
      <div class="flex flex-col gap-1">
        <a @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif @if(!auth()->user()->sedangPiket()) style="pointer-events:none;opacity:.5;cursor:not-allowed" @endif class="text-xs font-semibold text-[#D7B899] hover:text-white flex items-center gap-1 mb-1">
          <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 15l-5-5 5-5"/></svg>
          Kembali ke Piket
        </a>
        <h1 class="font-poppins text-2xl sm:text-3xl font-bold text-white tracking-tight">Input Surat</h1>
      </div>
    </header>

    <main class="w-full px-6 md:px-10 py-5 flex flex-col gap-4 flex-1">

      @if(session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">{{ session('success') }}</div>
      @endif
      @if($errors->any())
        <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800">{{ $errors->first() }}</div>
      @endif

      <section class="rounded-2xl border border-brand-100 bg-white p-5 shadow-sm">
        <div class="mb-4 flex items-center justify-between border-b border-brand-100 pb-4"><div><h2 class="font-poppins font-bold text-lg">Form Input Surat</h2><p class="mt-1 text-xs text-brand-600">Status otomatis diteruskan ke form jurnal kelas.</p></div><span class="rounded-lg bg-amber-50 px-3 py-2 text-xs font-bold text-amber-800 border border-amber-200">SAKIT / IZIN</span></div>
        <form method="post" action="{{ route('piket.input-surat.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-5">@csrf
          <div><label for="tanggal" class="mb-2 block text-sm font-semibold text-[#5C4033]">Tanggal</label><input id="tanggal" name="tanggal" type="date" value="{{ old('tanggal', $tanggal) }}" required class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-sm"></div>
          <div><label for="kelas" class="mb-2 block text-sm font-semibold text-[#5C4033]">Kelas dan Rombel</label><select id="kelas" name="id_kelas" required class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-sm outline-none focus:border-brand-800 focus:ring-2 focus:ring-brand-100"><option value="">Pilih kelas</option>@foreach($kelasList as $kelas)<option value="{{ $kelas->id_kelas }}" @selected(old('id_kelas') == $kelas->id_kelas)>{{ $kelas->tingkat }} {{ $kelas->jurusan }} · Rombel {{ $kelas->rombel }}</option>@endforeach</select></div>
          <div><label for="siswa" class="mb-2 block text-sm font-semibold text-[#5C4033]">Nama Siswa</label><select id="siswa" name="id_siswa" required class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-sm outline-none focus:border-brand-800 focus:ring-2 focus:ring-brand-100"><option value="">Pilih siswa</option>@foreach($siswaList as $siswa)<option value="{{ $siswa->id_siswa }}" data-kelas="{{ $siswa->id_kelas }}" @selected(old('id_siswa') == $siswa->id_siswa)>{{ $siswa->nama }}</option>@endforeach</select></div>
          <div><label for="status" class="mb-2 block text-sm font-semibold text-[#5C4033]">Status Surat</label><select id="status" name="status" required class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-sm outline-none focus:border-brand-800 focus:ring-2 focus:ring-brand-100"><option value="Sakit" @selected(old('status') === 'Sakit')>Sakit</option><option value="Izin" @selected(old('status') === 'Izin')>Izin</option></select></div>
          <div class="flex items-end"><button type="submit" class="w-full md:w-auto rounded-xl bg-[#5C4033] px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#3E2B22] transition">Simpan Status</button></div>
        </form>
      </section>

      <section class="overflow-hidden rounded-2xl border border-brand-100 bg-white shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-brand-100 px-5 py-4"><div><h3 class="font-poppins font-bold text-lg">Input {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}</h3><p class="mt-1 text-xs text-brand-600">Daftar status sakit/izin yang sudah dicatat.</p></div><div class="flex items-center gap-2"><select id="filter-kelas" class="rounded-lg border border-brand-200 bg-white px-3 py-2 text-xs text-brand-800 outline-none focus:border-brand-800"><option value="">Semua Kelas</option>@foreach($kelasList as $kelas)<option value="{{ $kelas->id_kelas }}">{{ $kelas->tingkat }} {{ $kelas->jurusan }} Rombel {{ $kelas->rombel }}</option>@endforeach</select><span id="jumlah-riwayat" class="whitespace-nowrap rounded-full bg-brand-50 px-3 py-2 text-xs font-semibold text-brand-800">{{ $riwayat->count() }} siswa</span></div></div>
        <div class="overflow-x-auto"><table class="w-full min-w-[560px] text-left text-sm"><thead class="bg-brand-50 text-xs uppercase tracking-wide text-brand-700"><tr><th class="px-5 py-3">No.</th><th class="px-5 py-3">Nama Siswa</th><th class="px-5 py-3">Kelas</th><th class="px-5 py-3">Status</th></tr></thead><tbody class="divide-y divide-brand-50">
          @forelse($riwayat as $index => $item)<tr class="baris-riwayat hover:bg-brand-50/50" data-kelas="{{ $item->id_kelas }}"><td class="px-5 py-3 text-brand-600">{{ $index + 1 }}</td><td class="px-5 py-3 font-semibold">{{ $item->nama }}</td><td class="px-5 py-3">{{ $item->tingkat }} {{ $item->jurusan }} {{ $item->rombel }}</td><td class="px-5 py-3"><span class="rounded-full px-3 py-1 text-xs font-semibold {{ $item->status === 'Sakit' ? 'bg-amber-50 text-amber-800' : 'bg-blue-50 text-blue-800' }}">{{ $item->status }}</span></td></tr>
          @empty<tr><td colspan="4" class="px-5 py-10 text-center text-sm text-brand-600">Belum ada input surat hari ini.</td></tr>@endforelse
        </tbody></table></div>
      </section>
    </main>
  </div>

  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-3.5 px-6 z-50 shadow-[0_-4px_25px_rgba(0,0,0,0.06)]">
    <div class="flex justify-between items-center">
      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/></svg><span>Beranda</span></a>
      <a href="{{ url('/form-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/><path d="M7 3v14"/></svg><span>Isi Jurnal</span></a>
      <a href="{{ url('/riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 4h14M3 8h14M3 12h10M3 16h6"/></svg><span>Riwayat</span></a>
      <a @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif @if(!auth()->user()->sedangPiket()) style="pointer-events:none;opacity:.5;cursor:not-allowed" @endif class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>Piket</span></a>
      <a href="{{ url('/profil-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/><circle cx="10" cy="6.5" r="3.5"/></svg><span>Profil</span></a>
    </div>
  </nav>

  <script>
    const kelas = document.getElementById('kelas');
    const siswa = document.getElementById('siswa');
    function filterSiswa() {
      [...siswa.options].forEach((option, index) => { if (index > 0) option.hidden = !!kelas.value && option.dataset.kelas !== kelas.value; });
      if (siswa.selectedOptions[0]?.hidden) siswa.value = '';
    }
    kelas.addEventListener('change', filterSiswa);
    siswa.addEventListener('change', () => { const selectedClass = siswa.selectedOptions[0]?.dataset.kelas; if (selectedClass) { kelas.value = selectedClass; filterSiswa(); siswa.value = [...siswa.options].find(o => o.value === siswa.value)?.value || siswa.value; } });
    filterSiswa();
    const filterKelas = document.getElementById('filter-kelas');
    const barisRiwayat = [...document.querySelectorAll('.baris-riwayat')];
    filterKelas.addEventListener('change', () => {
      let terlihat = 0;
      barisRiwayat.forEach(baris => { const cocok = !filterKelas.value || baris.dataset.kelas === filterKelas.value; baris.hidden = !cocok; if (cocok) terlihat++; });
      document.getElementById('jumlah-riwayat').textContent = `${terlihat} siswa`;
    });
  </script>
</body>
</html>
