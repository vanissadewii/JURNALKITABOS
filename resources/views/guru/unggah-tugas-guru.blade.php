<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unggah Tugas</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
            poppins: ['Poppins', 'sans-serif'],
          },
          colors: {
            brand: {
              50: '#F9F6F0',
              100: '#EFE6DD',
              200: '#E2C7B0',
              300: '#D7B899',
              600: '#7A6A60',
              700: '#6D5C52',
              800: '#5C4033',
              900: '#3E2B22',
            }
          }
        }
      }
    }
  </script>
  <style>
    html { scrollbar-width: none; }
    html::-webkit-scrollbar { display: none; }
    @media (min-width: 768px) {
      .app-input, .app-select, .app-textarea {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 1.5rem !important;
      }
      .app-input > span, .app-select > span, .app-textarea > span {
        flex: 0 0 15rem;
      }
      .app-input > select, .app-input > input,
      .app-select > select, .app-select > input {
        flex: 1 1 auto;
        max-width: 400px;
      }
      .app-textarea { align-items: flex-start !important; }
      .app-textarea > textarea { flex: 1 1 auto; max-width: 400px; }
    }
  </style>
</head>

<body class="bg-brand-50 font-sans min-h-screen flex text-[#3E3028]">

  <!-- SIDEBAR LEFT NAVIGATION (Desktop) -->
  <aside class="guru-sidebar w-64 bg-white border-r border-[#E5D8CC] min-h-screen flex flex-col justify-between shrink-0 fixed left-0 top-0 bottom-0 z-40 hidden md:flex">
    <div class="py-6 px-4 flex flex-col gap-8">
      <div class="flex flex-col gap-0.5">
        <h2 class="font-poppins font-extrabold text-xl text-[#3E3028] tracking-tight">JURNAL GURU</h2>
        <span class="text-md font-medium text-[#7A6A60]">Akun Guru</span>
      </div>

      <nav class="flex flex-col gap-1">
        <a href="{{ url('/dashboard-guru') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/></svg>
          <span>Beranda</span>
        </a>
        <span class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-[#F5EFE8] font-poppins font-bold text-md text-[#5C4033]">
          <svg class="w-5 h-5 text-[#3E3028]" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 13V3m0 0L6.5 6.5M10 3l3.5 3.5"/><path d="M3.5 13v2.5A1.5 1.5 0 005 17h10a1.5 1.5 0 001.5-1.5V13"/></svg>
          <span>Unggah Tugas</span>
        </span>
        <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 4h14M3 8h14M3 12h10M3 16h6"/></svg>
          <span>Riwayat Jurnal</span>
        </a>
        <a href="{{ url('/profil-guru') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/><circle cx="10" cy="6.5" r="3.5"/></svg>
          <span>Profil</span>
        </a>
      </nav>
    </div>
  </aside>

  <!-- MAIN CONTENT AREA -->
  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-8 w-full min-w-0">

    <header class="sticky top-0 z-30 w-full bg-[#5C4033] shadow-md px-4 sm:px-6 md:px-10 py-5 sm:py-7">
      <a href="{{ route('dashboard-guru') }}" class="mb-2 inline-flex items-center gap-2 text-sm font-semibold text-brand-200 hover:text-white">
        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="m12 15-5-5 5-5"/></svg>
        Kembali ke Beranda
      </a>
      <span class="block text-xs sm:text-sm font-medium tracking-wide text-brand-200">Unggah Tugas</span>
      <h1 class="mt-1 font-poppins text-2xl sm:text-3xl font-bold text-white tracking-tight">Tugas saat Izin / Sakit</h1>
    </header>

    <main class="w-full flex-1 px-4 sm:px-6 md:px-10 py-6 md:py-8">
      <div class="mx-auto w-full max-w-4xl">

        @if($errors->any())
          <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm font-semibold text-rose-800">{{ $errors->first() }}</div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ route('guru.unggah-tugas.store') }}"
          class="rounded-2xl border border-brand-100 bg-white p-5 shadow-sm sm:p-8">
          @csrf

          <div class="flex flex-col gap-5">
            <label class="app-select grid gap-1.5 text-sm font-semibold text-[#3E3028]">
              <span>Status</span>
              <select id="statusTugas" name="status" class="rounded-lg border border-brand-200 bg-[#FFFCF9] p-3 font-normal">
                <option value="sakit" @selected(old('status', 'sakit') === 'sakit')>Sakit</option>
                <option value="izin" @selected(old('status') === 'izin')>Izin</option>
              </select>
            </label>

            <label id="alasanIzinWrap" class="app-select hidden grid gap-1.5 text-sm font-semibold text-[#3E3028]">
              <span>Alasan izin (wajib)</span>
              <input id="alasanIzin" name="alasan_izin" value="{{ old('alasan_izin') }}" class="rounded-lg border border-brand-200 bg-[#FFFCF9] p-3 font-normal">
            </label>

            <div class="grid gap-5 md:grid-cols-2">
              <label class="app-select grid gap-1.5 text-sm font-semibold text-[#3E3028]">
                <span>Kelas tujuan</span>
                <select id="kelasTujuan" name="id_kelas" required class="rounded-lg border border-brand-200 bg-[#FFFCF9] p-3 font-normal">
                  <option value="">Pilih kelas</option>
                  @foreach($kelasList as $kelas)
                    <option value="{{ $kelas->id_kelas }}" @selected(old('id_kelas') == $kelas->id_kelas)>{{ $kelas->nama_kelas }}</option>
                  @endforeach
                </select>
              </label>

              <label class="app-select grid gap-1.5 text-sm font-semibold text-[#3E3028]">
                <span>Mata pelajaran</span>
                <select id="mapelTujuan" name="mapel" required class="rounded-lg border border-brand-200 bg-[#FFFCF9] p-3 font-normal">
                  <option value="">Pilih kelas terlebih dahulu</option>
                </select>
              </label>
            </div>

            <label class="app-input grid gap-1.5 text-sm font-semibold text-[#3E3028]">
              <span>Materi</span>
              <input name="materi" required value="{{ old('materi') }}" class="rounded-lg border border-brand-200 bg-[#FFFCF9] p-3 font-normal">
            </label>

            <label class="app-textarea grid gap-1.5 text-sm font-semibold text-[#3E3028]">
              <span>Tugas</span>
              <textarea name="tugas" required rows="4" class="rounded-lg border border-brand-200 bg-[#FFFCF9] p-3 font-normal">{{ old('tugas') }}</textarea>
            </label>

            <label class="app-input grid gap-1.5 text-sm font-semibold text-[#3E3028]">
              <span>Lampiran (opsional)</span>
              <input type="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip" class="rounded-lg border border-brand-200 bg-[#FFFCF9] p-3 font-normal">
            </label>

            <div class="flex justify-end pt-1">
              <button class="w-full rounded-xl bg-[#5C4033] px-6 py-3 font-poppins font-bold text-white hover:bg-[#452F26] sm:w-auto">Kirim ke Guru Piket</button>
            </div>
          </div>
        </form>

      </div>
    </main>
  </div>

  <script>
    const mapelPerKelas = @json($mapelPerKelas);
    const kelasSelect = document.getElementById('kelasTujuan');
    const mapelSelect = document.getElementById('mapelTujuan');
    const statusSelect = document.getElementById('statusTugas');
    const alasanWrap = document.getElementById('alasanIzinWrap');
    const alasanInput = document.getElementById('alasanIzin');
    const mapelLama = @json(old('mapel'));
    function perbaruiMapel() {
      const list = mapelPerKelas[kelasSelect.value] || [];
      mapelSelect.replaceChildren(new Option(list.length ? 'Pilih mata pelajaran' : 'Tidak ada mapel terjadwal hari ini', ''));
      list.forEach(nama => mapelSelect.add(new Option(nama, nama, false, nama === mapelLama)));
      if (list.length === 1) mapelSelect.value = list[0];
    }
    function perbaruiAlasan() {
      const perlu = statusSelect.value === 'izin';
      alasanWrap.classList.toggle('hidden', !perlu);
      alasanInput.required = perlu;
      alasanInput.disabled = !perlu;
    }
    kelasSelect.addEventListener('change', perbaruiMapel);
    statusSelect.addEventListener('change', perbaruiAlasan);
    perbaruiMapel(); perbaruiAlasan();
  </script>
</body>

</html>
