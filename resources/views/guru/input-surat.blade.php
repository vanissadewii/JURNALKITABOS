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
        <a @if(auth()->user()->role === 'wali_kelas' && !auth()->user()->sedangPiket()) href="{{ route('piket.rekap') }}" @elseif(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif @if(auth()->user()->role !== 'wali_kelas' && !auth()->user()->sedangPiket()) style="pointer-events:none;opacity:.5;cursor:not-allowed" @endif class="flex items-center gap-3 px-3 py-2.5 bg-[#F5EFE8] rounded-lg font-poppins font-bold transition-all"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>{{ auth()->user()->role === 'wali_kelas' && !auth()->user()->sedangPiket() ? 'Rekap Piket' : 'Piket' }}</span></a>
        <a href="{{ url('/profil-guru') }}" class="flex items-center rounded-lg font-medium hover:bg-[#F5EFE8] transition-all"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/><circle cx="10" cy="6.5" r="3.5"/></svg><span>Profil</span></a>
      </nav>
    </div>
    <div class="p-4 text-xs text-[#9E8E83]">Jurnal Guru · Menu Piket</div>
  </aside>

  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8 w-full min-w-0">
    <header class="sticky top-0 z-30 w-full bg-[#5C4033] shadow-md px-6 md:px-10 py-6 flex flex-col justify-between items-start gap-3">
      <div class="flex flex-col gap-1">
        <a @if(auth()->user()->role === 'wali_kelas' && !auth()->user()->sedangPiket()) href="{{ route('piket.rekap') }}" @elseif(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif @if(auth()->user()->role !== 'wali_kelas' && !auth()->user()->sedangPiket()) style="pointer-events:none;opacity:.5;cursor:not-allowed" @endif class="text-xs font-semibold text-[#D7B899] hover:text-white flex items-center gap-1 mb-1">
          <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 15l-5-5 5-5"/></svg>
          Kembali ke Piket
        </a>
        <h1 class="font-poppins text-2xl sm:text-3xl font-bold text-white tracking-tight">Input Surat</h1>
      </div>
    </header>

    <main class="w-full px-4 sm:px-6 md:px-10 py-5 md:py-6 flex flex-col gap-4 md:gap-5 flex-1">

      @if(session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">{{ session('success') }}</div>
      @endif
      @if($errors->any())
        <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800">{{ $errors->first() }}</div>
      @endif

      <section class="rounded-2xl border border-brand-100 bg-white p-5 shadow-sm">
        <form method="post" enctype="multipart/form-data" action="{{ route('piket.input-surat.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-5">@csrf
          <div><label for="tanggal" class="mb-2 block text-sm font-semibold text-[#5C4033]">Tanggal</label><input id="tanggal" name="tanggal" type="date" value="{{ old('tanggal', $tanggal) }}" required class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-sm"></div>
          <div><label for="kelasSearch" class="mb-2 block text-sm font-semibold text-[#5C4033]">Cari Kelas dan Rombel</label><input id="kelasSearch" list="kelasOptions" autocomplete="off" required placeholder="Ketik tingkat, jurusan, atau rombel" class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-sm outline-none focus:border-brand-800 focus:ring-2 focus:ring-brand-100"><datalist id="kelasOptions">@foreach($kelasList as $kelas)<option value="{{ $kelas->tingkat }} {{ $kelas->jurusan }} · Rombel {{ $kelas->rombel }}"></option>@endforeach</datalist><input type="hidden" id="kelas" name="id_kelas" value="{{ old('id_kelas') }}"><p id="kelasSearchHint" class="mt-1 text-xs text-brand-600">Pilih kelas dari saran pencarian.</p></div>
          <div><label for="siswaSearch" class="mb-2 block text-sm font-semibold text-[#5C4033]">Cari Nama Siswa</label><input id="siswaSearch" list="siswaOptions" autocomplete="off" placeholder="Ketik nama siswa" class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-sm outline-none focus:border-brand-800 focus:ring-2 focus:ring-brand-100"><datalist id="siswaOptions"></datalist><input type="hidden" id="siswa" name="id_siswa" value="{{ old('id_siswa') }}"><div id="siswa-terpilih" class="mt-2 flex flex-wrap gap-2"></div><div id="siswa-extra"></div><p id="siswaSearchHint" class="mt-1 text-xs text-brand-600">Pilih kelas dahulu, lalu ketik sebagian nama siswa dari saran.</p></div>
          <div><label for="jenis_surat" class="mb-2 block text-sm font-semibold text-[#5C4033]">Jenis Surat</label><select id="jenis_surat" name="jenis_surat" required class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-sm"><option value="izin">Sakit / Izin</option><option value="terlambat">Terlambat</option></select></div>
          <div id="status-wrap"><label for="status" class="mb-2 block text-sm font-semibold text-[#5C4033]">Status</label><select id="status" name="status" class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-sm"><option value="Sakit">Sakit</option><option value="Izin">Izin</option></select></div>
          <div id="sampai-wrap"><label for="tanggal_sampai" class="mb-2 block text-sm font-semibold text-[#5C4033]">Sampai Tanggal (izin beberapa hari)</label><input id="tanggal_sampai" name="tanggal_sampai" type="date" min="{{ $tanggal }}" value="{{ old('tanggal_sampai', $tanggal) }}" class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-sm"></div>
          <div><label for="keterangan" class="mb-2 block text-sm font-semibold text-[#5C4033]">Keterangan / Jam Terlambat</label><input id="keterangan" name="keterangan" value="{{ old('keterangan') }}" class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-sm"></div>
          <div class="min-w-0 md:col-span-2">
            <label class="mb-2 block text-sm font-semibold text-[#5C4033]">Foto Surat Sakit / Izin <span class="font-normal text-brand-600">(opsional)</span></label>
            <div class="rounded-2xl border border-dashed border-brand-300 bg-brand-50/70 p-4 sm:p-5">
              <input id="fileKamera" name="file" type="file" accept="image/*" capture="environment" class="sr-only">
              <input id="fileGaleri" type="file" accept="image/*" class="sr-only">
              <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 sm:gap-3">
                <label for="fileKamera" class="inline-flex min-h-12 cursor-pointer items-center justify-center gap-2 rounded-xl bg-brand-800 px-4 py-3 text-center text-sm font-semibold text-white hover:bg-brand-900">
                  <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 7h3l1.5-2h7L17 7h3a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V8a1 1 0 011-1z"/><circle cx="12" cy="13" r="3.5"/></svg>
                  Ambil foto dengan kamera
                </label>
                <button type="button" id="btnPilihGaleri" class="inline-flex min-h-12 items-center justify-center gap-2 rounded-xl border border-brand-200 bg-white px-4 py-3 text-sm font-semibold text-brand-800 hover:bg-white/80">
                  <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="8.5" cy="9" r="1.5"/><path d="m21 15-5-5L5 20"/></svg>
                  Pilih dari galeri / file
                </button>
              </div>
              <p id="namaFile" class="mt-3 break-all text-center text-xs text-brand-600 sm:text-left">Belum ada foto terpilih</p>
              <div id="previewWrap" class="mt-4 hidden">
                <img id="previewImg" src="" alt="Pratinjau surat" class="mx-auto max-h-72 w-full rounded-xl border border-brand-200 bg-white object-contain sm:mx-0 sm:max-h-80 sm:w-auto">
              </div>
            </div>
          </div>
          <div class="flex items-end"><button type="submit" class="w-full md:w-auto rounded-xl bg-[#5C4033] px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#3E2B22] transition">Simpan Status</button></div>
        </form>
      </section>

      <section class="overflow-hidden rounded-2xl border border-brand-100 bg-white shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-brand-100 px-5 py-4"><div><h3 class="font-poppins font-bold text-lg">Input {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}</h3><p class="mt-1 text-xs text-brand-600">Daftar status sakit/izin yang sudah dicatat.</p></div><div class="flex items-center gap-2"><select id="filter-kelas" class="rounded-lg border border-brand-200 bg-white px-3 py-2 text-xs text-brand-800 outline-none focus:border-brand-800"><option value="">Semua Kelas</option>@foreach($kelasList as $kelas)<option value="{{ $kelas->id_kelas }}">{{ $kelas->tingkat }} {{ $kelas->jurusan }} Rombel {{ $kelas->rombel }}</option>@endforeach</select><span id="jumlah-riwayat" class="whitespace-nowrap rounded-full bg-brand-50 px-3 py-2 text-xs font-semibold text-brand-800">{{ $riwayat->count() }} siswa</span></div></div>
        <div class="overflow-x-auto"><table class="w-full min-w-[560px] text-left text-sm"><thead class="bg-brand-50 text-xs uppercase tracking-wide text-brand-700"><tr><th class="px-5 py-3">No.</th><th class="px-5 py-3">Nama Siswa</th><th class="px-5 py-3">Kelas</th><th class="px-5 py-3">Status</th></tr></thead><tbody class="divide-y divide-brand-50">
          @forelse($riwayat as $index => $item)<tr class="baris-riwayat hover:bg-brand-50/50" data-kelas="{{ $item->id_kelas }}"><td class="px-5 py-3 text-brand-600">{{ $index + 1 }}</td><td class="px-5 py-3 font-semibold">{{ $item->nama }}</td><td class="px-5 py-3">{{ $item->tingkat }} {{ $item->jurusan }} {{ $item->rombel }}</td><td class="px-5 py-3"><span class="rounded-full px-3 py-1 text-xs font-semibold {{ $item->status === 'Sakit' ? 'bg-amber-50 text-amber-800' : 'bg-blue-50 text-blue-800' }}">{{ $item->jenis_surat === 'terlambat' ? 'Terlambat' : $item->status }}</span>@if($item->keterangan) <span class="text-xs">· {{ $item->keterangan }}</span>@endif @if($item->file_path) <a class="ml-2 text-xs text-blue-700 underline" target="_blank" href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($item->file_path) }}">Foto surat</a>@endif</td></tr>
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
      <a @if(auth()->user()->role === 'wali_kelas' && !auth()->user()->sedangPiket()) href="{{ route('piket.rekap') }}" @elseif(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif @if(auth()->user()->role !== 'wali_kelas' && !auth()->user()->sedangPiket()) style="pointer-events:none;opacity:.5;cursor:not-allowed" @endif class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>{{ auth()->user()->role === 'wali_kelas' && !auth()->user()->sedangPiket() ? 'Rekap Piket' : 'Piket' }}</span></a>
      <a href="{{ url('/profil-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/><circle cx="10" cy="6.5" r="3.5"/></svg><span>Profil</span></a>
    </div>
  </nav>

  <script>
    const kelas = document.getElementById('kelas');
    const siswa = document.getElementById('siswa');
    const kelasSearch = document.getElementById('kelasSearch');
    const siswaSearch = document.getElementById('siswaSearch');
    const siswaOptions = document.getElementById('siswaOptions');
    const daftarKelas = @json($kelasSearchOptions);
    const daftarSiswa = @json($siswaSearchOptions);
    let siswaTerpilih = [];

    function labelKelas(id) {
      return daftarKelas.find(item => String(item.id) === String(id))?.label || '';
    }

    function perbaruiHintSiswa() {
      const hint = document.getElementById('siswaSearchHint');
      if (siswaTerpilih.length) {
        const jumlahKelas = new Set(siswaTerpilih.map(item => String(item.kelas))).size;
        hint.textContent = `${siswaTerpilih.length} siswa terpilih dari ${jumlahKelas} kelas.`;
      } else if (kelas.value) {
        hint.textContent = 'Nama siswa yang muncul hanya dari kelas yang dipilih.';
      } else {
        hint.textContent = 'Pilih kelas dahulu, lalu ketik sebagian nama siswa dari saran.';
      }
    }

    function isiPilihanSiswa() {
      siswaOptions.replaceChildren();
      daftarSiswa
        .filter(item => !siswaTerpilih.some(pilih => String(pilih.id) === String(item.id)))
        .filter(item => !kelas.value || String(item.kelas) === String(kelas.value))
        .forEach(item => {
          const option = document.createElement('option');
          option.value = `${item.nama} · ${item.kelasLabel}`;
          siswaOptions.append(option);
        });
      perbaruiHintSiswa();
    }

    function gambarSiswa() {
      const wadah = document.getElementById('siswa-terpilih');
      const extra = document.getElementById('siswa-extra');
      wadah.replaceChildren();
      extra.replaceChildren();

      siswaTerpilih.forEach((item, index) => {
        const chip = document.createElement('button');
        chip.type = 'button';
        chip.className = 'inline-flex items-center gap-1 rounded-full bg-brand-50 border border-brand-100 px-3 py-1.5 text-xs font-medium text-brand-800';
        chip.textContent = `${item.nama} ×`;
        chip.setAttribute('aria-label', `Hapus ${item.nama}`);
        chip.onclick = () => { siswaTerpilih.splice(index, 1); gambarSiswa(); isiPilihanSiswa(); };
        wadah.append(chip);

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id_siswa_list[]';
        input.value = item.id;
        extra.append(input);
      });

      if (siswaTerpilih.length) {
        const idKelas = String(siswaTerpilih[0].kelas);
        kelas.value = idKelas;
        kelasSearch.value = [...new Set(siswaTerpilih.map(item => String(item.kelas)))].map(labelKelas).filter(Boolean).join(', ');
      }
      perbaruiHintSiswa();
    }

    function pilihKelasDariTeks() {
      const teks = kelasSearch.value.trim();
      const selected = daftarKelas.find(item => item.label === teks);
      kelas.value = selected?.id ?? '';

      if (selected) {
        const sebelumnya = siswaTerpilih.length;
        siswaTerpilih = siswaTerpilih.filter(item => String(item.kelas) === String(selected.id));
        if (siswaTerpilih.length !== sebelumnya) gambarSiswa();
        document.getElementById('kelasSearchHint').textContent = 'Kelas terpilih. Nama siswa yang muncul hanya dari kelas ini.';
      } else {
        if (siswaTerpilih.length) {
          siswaTerpilih = [];
          gambarSiswa();
        }
        document.getElementById('kelasSearchHint').textContent = teks ? 'Pilih kelas dari saran pencarian.' : 'Pilih kelas agar nama siswa menyesuaikan.';
      }

      isiPilihanSiswa();
    }

    kelasSearch.addEventListener('input', pilihKelasDariTeks);
    kelasSearch.addEventListener('change', pilihKelasDariTeks);

    siswaSearch.addEventListener('input', () => {
      const selected = daftarSiswa.find(item =>
        `${item.nama} · ${item.kelasLabel}` === siswaSearch.value &&
        (!kelas.value || String(item.kelas) === String(kelas.value))
      );
      siswa.value = selected?.id ?? '';
      if (!selected) return;

      if (!kelas.value) {
        kelas.value = selected.kelas;
        kelasSearch.value = labelKelas(selected.kelas);
        document.getElementById('kelasSearchHint').textContent = 'Kelas terpilih otomatis mengikuti nama siswa.';
      }

      if (!siswaTerpilih.some(item => String(item.id) === String(selected.id))) {
        siswaTerpilih.push(selected);
      }
      siswaSearch.value = '';
      gambarSiswa();
      isiPilihanSiswa();
    });

    document.getElementById('jenis_surat').addEventListener('change', event => {
      const terlambat = event.target.value === 'terlambat';
      document.getElementById('status-wrap').hidden = terlambat;
      document.getElementById('sampai-wrap').hidden = terlambat;
      document.getElementById('file').required = false;
    });

    const kelasAwal = daftarKelas.find(item => String(item.id) === String(kelas.value));
    if (kelasAwal) kelasSearch.value = kelasAwal.label;
    const siswaAwal = daftarSiswa.find(item => String(item.id) === String(siswa.value));
    if (siswaAwal) siswaSearch.value = `${siswaAwal.nama} · ${siswaAwal.kelasLabel}`;
    isiPilihanSiswa();
    perbaruiHintSiswa();
    const filterKelas = document.getElementById('filter-kelas');
    const barisRiwayat = [...document.querySelectorAll('.baris-riwayat')];
    filterKelas.addEventListener('change', () => {
      let terlihat = 0;
      barisRiwayat.forEach(baris => { const cocok = !filterKelas.value || baris.dataset.kelas === filterKelas.value; baris.hidden = !cocok; if (cocok) terlihat++; });
      document.getElementById('jumlah-riwayat').textContent = `${terlihat} siswa`;
    });

    const fileKamera = document.getElementById('fileKamera');
    const fileGaleri = document.getElementById('fileGaleri');
    const btnPilihGaleri = document.getElementById('btnPilihGaleri');
    const namaFile = document.getElementById('namaFile');
    const previewWrap = document.getElementById('previewWrap');
    const previewImg = document.getElementById('previewImg');

    function tampilkanFileSurat(file) {
      if (file) {
        namaFile.textContent = file.name;
        const reader = new FileReader();
        reader.onload = e => {
          previewImg.src = e.target.result;
          previewWrap.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      } else {
        namaFile.textContent = 'Belum ada foto terpilih';
        previewWrap.classList.add('hidden');
        previewImg.src = '';
      }
    }

    if (fileKamera && fileGaleri && btnPilihGaleri) {
      btnPilihGaleri.addEventListener('click', () => fileGaleri.click());
      [fileKamera, fileGaleri].forEach(input => input.addEventListener('change', () => {
        const file = input.files && input.files[0];
        if (file) {
          tampilkanFileSurat(file);
          if (input === fileGaleri) {
            const transfer = new DataTransfer();
            transfer.items.add(file);
            fileKamera.files = transfer.files;
          }
        }
      }));
    }
  </script>
</body>
</html>
