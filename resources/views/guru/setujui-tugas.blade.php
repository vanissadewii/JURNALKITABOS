<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setujui Tugas Guru - Piket</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'], poppins: ['Poppins', 'sans-serif'] }, colors: { brand: { 50: '#F9F6F0', 100: '#EFE6DD', 200: '#E2C7B0', 300: '#D7B899', 600: '#7A6A60', 700: '#6D5C52', 800: '#5C4033', 900: '#3E2B22' } } } } };
  </script>
</head>
<body class="min-h-screen bg-brand-50 font-sans text-[#3E3028]">
  <header class="w-full bg-[#5C4033] px-4 py-5 text-white shadow-md sm:px-6 md:px-10 sm:py-7">
    <div class="mx-auto w-full max-w-5xl">
      <a href="{{ route('dashboard-guru-piket') }}" class="mb-2 inline-flex items-center gap-2 text-xs font-semibold text-[#D7B899] hover:text-white">
        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="m12 15-5-5 5-5"/></svg>
        Kembali ke Piket
      </a>
      <h1 class="mt-1 font-poppins text-2xl font-bold tracking-tight sm:text-3xl">Setujui Tugas Guru</h1>
    </div>
  </header>

  <main class="mx-auto w-full max-w-5xl px-4 py-5 sm:px-6 sm:py-8 md:px-10">
    <p class="mb-5 text-sm leading-6 text-brand-600">Periksa materi dan tugas yang dikirim guru saat izin atau sakit.</p>

    @if(session('success'))
      <div class="mt-5 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-semibold text-emerald-800">{{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="mt-5 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm font-semibold text-rose-800">{{ $errors->first() }}</div>
    @endif

    <section class="space-y-4">
      @forelse($tugasMenunggu as $tugas)
        <article class="rounded-2xl border border-brand-100 bg-white p-5 shadow-sm sm:p-6">
          <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
              <p class="text-xs font-semibold uppercase tracking-wide text-brand-600">{{ $tugas->tanggal ? \Carbon\Carbon::parse($tugas->tanggal)->format('d/m/Y') : 'Tanggal tidak tersedia' }} · {{ $tugas->mapel }}</p>
              <h2 class="mt-1 font-poppins text-xl font-bold">{{ $tugas->nama_guru ?: 'Nama guru tidak tersedia' }}</h2>
              <p class="mt-1 text-sm text-brand-600">Kelas {{ $tugas->tingkat }} {{ $tugas->jurusan }} {{ $tugas->rombel }}</p>
            </div>
            <span class="rounded-full px-3 py-1 text-xs font-bold {{ strtolower($tugas->status_guru) === 'izin' ? 'bg-amber-100 text-amber-800' : 'bg-sky-100 text-sky-800' }}">{{ ucfirst($tugas->status_guru) }}</span>
          </div>

          @if(strtolower($tugas->status_guru) === 'izin')
            <div class="mt-4 rounded-xl border border-amber-200 bg-amber-50 p-4">
              <h3 class="text-xs font-bold uppercase tracking-wide text-amber-900">Alasan izin</h3>
              <p class="mt-1 whitespace-pre-line text-sm leading-6 text-amber-950">{{ $tugas->alasan_izin ?: 'Alasan belum dicantumkan.' }}</p>
            </div>
          @endif

          <div class="mt-4 grid gap-4 sm:grid-cols-2">
            <section class="rounded-xl bg-[#FFFCF9] p-4">
              <h3 class="text-xs font-bold uppercase tracking-wide text-brand-600">Materi</h3>
              <p class="mt-2 whitespace-pre-line text-sm leading-6">{{ $tugas->materi ?: 'Tidak ada materi tambahan.' }}</p>
            </section>
            <section class="rounded-xl bg-[#FFFCF9] p-4">
              <h3 class="text-xs font-bold uppercase tracking-wide text-brand-600">Tugas</h3>
              <p class="mt-2 whitespace-pre-line text-sm leading-6">{{ $tugas->tugas }}</p>
            </section>
          </div>

          @if($tugas->file_path)
            <a href="{{ route('piket.upload-tugas.download', $tugas->id_upload_tugas) }}" class="mt-4 inline-flex items-center gap-2 rounded-lg border border-brand-200 px-4 py-2 text-sm font-semibold text-brand-800 hover:bg-brand-50">
              <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 3v9m0 0 3.5-3.5M10 12 6.5 8.5M4 13.5v2A1.5 1.5 0 005.5 17h9a1.5 1.5 0 001.5-1.5v-2"/></svg>
              Buka lampiran
            </a>
          @endif

          <form method="POST" action="{{ route('piket.upload-tugas.review', $tugas->id_upload_tugas) }}" class="mt-5 border-t border-brand-100 pt-5">
            @csrf
            <label class="block text-sm font-semibold" for="catatan-{{ $tugas->id_upload_tugas }}">Catatan piket <span class="font-normal text-brand-600">(opsional, wajib diisi jika ditolak)</span></label>
            <textarea id="catatan-{{ $tugas->id_upload_tugas }}" name="catatan" rows="2" class="mt-2 w-full rounded-lg border border-brand-200 bg-white p-3 text-sm focus:border-brand-600 focus:outline-none">{{ old('catatan') }}</textarea>
            <div class="mt-3 flex flex-wrap gap-3">
              <button name="keputusan" value="disetujui" class="rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-bold text-white hover:bg-emerald-800">Setujui tugas</button>
              <button name="keputusan" value="ditolak" class="rounded-lg border border-rose-300 bg-white px-4 py-2.5 text-sm font-bold text-rose-700 hover:bg-rose-50">Tolak tugas</button>
            </div>
          </form>
        </article>
      @empty
        <div class="rounded-2xl border border-dashed border-brand-300 bg-white px-6 py-14 text-center">
          <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-emerald-50 text-emerald-700">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 4 4L19 6"/></svg>
          </div>
          <h2 class="mt-4 font-poppins text-lg font-bold">Tidak ada tugas menunggu</h2>
          <p class="mt-1 text-sm text-brand-600">Kiriman tugas guru yang perlu ditinjau akan muncul di sini.</p>
        </div>
      @endforelse
    </section>
  </main>
</body>
</html>
