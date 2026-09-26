<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda Guru</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

  <!-- CDN Tailwind CSS -->
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
    .guru-sidebar-nav a { gap: .75rem !important; padding: .625rem .75rem !important; border-radius: .5rem !important; font-size: 1rem !important; color: #7A6A60 !important; }
    .guru-sidebar-nav a svg { color: #7A6A60 !important; }
    .guru-sidebar-nav a.bg-\[\#F5EFE8\] { color: #5C4033 !important; }
    .guru-sidebar-nav a.bg-\[\#F5EFE8\] svg { color: #3E3028 !important; }
    .guru-sidebar > div:first-child { padding: 1.5rem 1rem !important; gap: 2rem !important; }
  </style>
</head>
<body class="bg-brand-50 font-sans min-h-screen flex text-[#3E3028]">

  <!-- SIDEBAR LEFT NAVIGATION (Desktop) -->
  <aside class="guru-sidebar w-64 bg-white border-r border-[#E5D8CC] min-h-screen flex flex-col justify-between shrink-0 fixed left-0 top-0 bottom-0 z-40 hidden md:flex">
    <div class="py-6 px-4 flex flex-col gap-8">
      
      <!-- Brand Logo / Title -->
      <div class="flex flex-col gap-0.5">
        <h2 class="font-poppins font-extrabold text-xl text-[#3E3028] tracking-tight">JURNAL GURU</h2>
          <span class="text-md font-medium text-[#7A6A60]">Akun Guru</span>
      </div>

      <!-- Navigation Links -->
      <nav class="guru-sidebar-nav flex flex-col gap-1">
        
        <!-- Active Link (Dashboard) -->
        <a href="{{ url('/dashboard-guru') }}" class="flex items-center gap-3 px-3 py-2.5 bg-[#F5EFE8] rounded-lg font-poppins font-bold text-md text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-[#3E3028]" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
          </svg>
          <span>Beranda</span>
        </a>

        <!-- Menu Input Jurnal -->
        @if ($sesiSaatIni)
        <a href="{{ route('jurnal.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
        @else
        <span aria-disabled="true" title="Isi jurnal tersedia saat sesi mengajar berlangsung" class="pointer-events-none flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#9E8E83] opacity-50">
        @endif
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
            <path d="M7 3v14"/>
          </svg>
          <span>Isi Jurnal</span>
        @if ($sesiSaatIni)</a>@else</span>@endif

        <!-- MENU LIST/RIWAYAT JURNAL -->
        <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>
          </svg>
          <span>Riwayat Jurnal</span>
        </a>

        <a @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif @if(!auth()->user()->sedangPiket()) style="pointer-events:none;opacity:.5;cursor:not-allowed" @endif class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>Piket</span>
        </a>

        <!-- Menu Profil Guru -->
        <a href="{{ url('/profil-guru') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
            <circle cx="10" cy="6.5" r="3.5"/>
          </svg>
          <span>Profil</span>
        </a>

      </nav>

    </div>
  </aside>

  <!-- MAIN CONTENT AREA (Full Width Desktop) -->
  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8 w-full min-w-0">
    
    <!-- Top Header Bar -->
    <header class="sticky top-0 z-30 w-full bg-[#5C4033] shadow-md px-6 md:px-10 py-6 sm:py-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
      
      <div class="flex items-center justify-between w-full md:w-auto gap-4">
        <div class="flex flex-col gap-1">
          <span class="text-xs sm:text-sm font-medium tracking-wide text-brand-200">Selamat Datang,</span>
          <h1 class="font-poppins text-2xl sm:text-3xl font-bold text-white tracking-tight">{{ $guru->name }}</h1>
          <span class="flex flex-wrap items-center gap-2 text-xs sm:text-sm text-[#D7B899]">
            <span>Guru</span>
            <span class="text-white/40">•</span>
            <span>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</span>
          </span>
        </div>
      </div>

    </header>

    <!-- Main Content Container (Penuh Lebar Layar) -->
    <main class="w-full px-6 md:px-10 py-8 flex flex-col gap-8 flex-1">
      @if (session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">{{ session('success') }}</div>
      @endif
      @if (session('error'))
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-800">{{ session('error') }}</div>
      @endif

      @if (($izinJurnalSusulan ?? false) && ($adaJadwalKemarin ?? false))
        <section class="flex flex-col gap-3 rounded-2xl border border-amber-200 bg-[#FFFCF4] p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:px-5">
          <div class="flex items-start gap-3">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-800"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14H3V6a2 2 0 0 1 2-2z"/><path d="m9 16 2 2 4-4"/></svg></div>
            <div><div class="flex flex-wrap items-center gap-2"><h2 class="font-poppins text-base font-bold text-[#3E3028]">Jurnal Kemarin</h2><span class="rounded-full bg-amber-100 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-amber-900">Izin aktif</span></div><p class="mt-1 text-xs leading-5 text-[#7A6A60]">Lengkapi jurnal dari jadwal mengajar kemarin. Akses dibuka oleh admin khusus untuk akun Anda.</p></div>
          </div>
          <a href="{{ route('jurnal.create', ['susulan' => 1]) }}" class="inline-flex h-10 shrink-0 items-center justify-center rounded-xl bg-[#5C4033] px-4 text-sm font-semibold text-white shadow-sm hover:bg-[#3E2B22]">Isi Jurnal Kemarin</a>
        </section>
      @endif
      
      <section class="flex flex-col gap-4 w-full">
        <div class="flex items-center justify-between">
          <h2 class="font-poppins font-bold text-sm sm:text-base tracking-wider uppercase text-brand-600">Jadwal Mengajar Saat Ini</h2>
          @if ($kegiatanDitiadakan)
            <span class="rounded-full border border-amber-200 bg-amber-50 px-3 py-1 text-[11px] font-semibold text-amber-800">Jam dimajukan</span>
          @endif
        </div>
        @php($sesiUtama = $sesiSaatIni ?? $sesiBerikutnya)
        @if ($sesiUtama)
          <article class="w-full rounded-2xl border border-brand-100 bg-white p-6 shadow-sm md:p-8">
            <div class="flex flex-col justify-between gap-5 lg:flex-row lg:items-center">
              <div>
                <span class="rounded-full bg-[#F5EFE8] px-3 py-1 text-xs font-semibold text-[#5C4033]">{{ $sesiUtama->status }}</span>
                <h3 class="mt-3 font-poppins text-2xl font-bold text-[#3E3028]">{{ $sesiUtama->kelas }}</h3>
                <p class="mt-1 font-semibold text-[#8C7B70]">{{ $sesiUtama->mapel }}</p>
              </div>
              <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <span class="rounded-xl border border-brand-100 bg-brand-50 px-4 py-3 text-center text-sm font-medium text-brand-700">Jam ke-{{ $sesiUtama->jam_ke_mulai }}@if($sesiUtama->jam_ke_sampai !== $sesiUtama->jam_ke_mulai)–{{ $sesiUtama->jam_ke_sampai }}@endif · {{ $sesiUtama->jam_mulai }}–{{ $sesiUtama->jam_selesai }}</span>
                @if ($sesiSaatIni)
                  <a href="{{ route('jurnal.create') }}" class="inline-flex h-12 items-center justify-center rounded-xl bg-[#5C4033] px-6 text-sm font-semibold text-white shadow-md hover:bg-[#3E2B22]">Mulai Sesi Mengajar</a>
                @else
                  <span aria-disabled="true" class="inline-flex h-12 cursor-not-allowed items-center justify-center rounded-xl bg-[#E5D8CC] px-6 text-sm font-semibold text-[#7A6A60]">Menunggu sesi dimulai</span>
                @endif
              </div>
            </div>
          </article>
        @else
          <div class="rounded-2xl border border-dashed border-brand-200 bg-white p-8 text-center text-sm text-[#7A6A60]">
            @if ($hari)
              Belum ada jadwal mengajar untuk hari ini.
            @else
              Tidak ada jadwal mengajar pada akhir pekan.
            @endif
          </div>
        @endif
      </section>

      <section class="flex w-full flex-col gap-4">
        <div class="flex items-center justify-between">
          <h2 class="font-poppins font-bold text-sm sm:text-base tracking-wider uppercase text-brand-600">Jadwal Mengajar Hari Ini</h2>
          <span class="rounded-full border border-brand-100 bg-white px-3 py-1 text-xs font-semibold text-brand-700">{{ $sesi->count() }} Sesi</span>
        </div>
        @if ($sesi->isNotEmpty())
          <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($sesi as $item)
              @php($statusClass = match($item->status) { 'Berlangsung' => 'border-green-200 bg-green-50 text-green-800', 'Akan Datang' => 'border-amber-200 bg-amber-50 text-amber-800', 'Selesai' => 'border-[#E5D8CC] bg-[#F5EFE8] text-[#7A6A60]', default => 'border-gray-200 bg-gray-100 text-gray-600' })
              <article class="flex flex-col justify-between gap-5 rounded-2xl border border-brand-100 bg-white p-5 transition-all hover:border-brand-300 hover:shadow-md">
                <div class="flex items-start justify-between gap-4">
                  <div class="flex items-start gap-3.5">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-brand-100 font-poppins text-sm font-bold text-brand-800">{{ str_pad((string) $item->jam_ke_mulai, 2, '0', STR_PAD_LEFT) }}</span>
                    <div><h3 class="font-poppins text-base font-bold text-[#3E3028]">{{ $item->kelas }}</h3><p class="text-xs font-semibold text-[#8C7B70]">{{ $item->mapel }}</p></div>
                  </div>
                  <span class="whitespace-nowrap rounded-full border px-3 py-1 text-xs font-semibold {{ $statusClass }}">{{ $item->status }}</span>
                </div>
                <div class="flex items-center justify-between gap-2 border-t border-brand-50 pt-3 text-xs">
                  <span class="font-medium text-brand-600">Jam ke-{{ $item->jam_ke_mulai }}@if($item->jam_ke_sampai !== $item->jam_ke_mulai)–{{ $item->jam_ke_sampai }}@endif · {{ $item->jam_mulai }}–{{ $item->jam_selesai }}</span>
                  @if ($item->status === 'Berlangsung')
                    <a href="{{ route('jurnal.create') }}" class="shrink-0 font-poppins font-semibold text-brand-800 underline underline-offset-2">Isi Jurnal</a>
                  @endif
                </div>
              </article>
            @endforeach
          </div>
        @else
          <div class="rounded-2xl border border-dashed border-brand-200 bg-white p-8 text-center text-sm text-[#7A6A60]">Tidak ada sesi untuk ditampilkan.</div>
        @endif
      </section>

    </main>

  </div>

  <!-- Bottom Navigation Bar (Mobile HP) -->
  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-3.5 px-6 z-50 shadow-[0_-4px_25px_rgba(0,0,0,0.06)]">
    <div class="flex justify-between items-center">
      
      <!-- Active Mobile Link -->
      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
          <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
        </svg>
        <span>Beranda</span>
      </a>

      <!-- Inactive Mobile Link (Form Jurnal) -->
      @if ($sesiSaatIni)
      <a href="{{ route('jurnal.create') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
      @else
      <span aria-disabled="true" title="Isi jurnal tersedia saat sesi mengajar berlangsung" class="pointer-events-none flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] opacity-50">
      @endif
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
          <path d="M7 3v14"/>
        </svg>
        <span>Isi Jurnal</span>
      @if ($sesiSaatIni)</a>@else</span>@endif

      <!-- LIST RIWAYAT JURNAL MOBILE -->
      <a href="{{ url('/riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>
        </svg>
        <span>Riwayat</span>
      </a>

      <a @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif @if(!auth()->user()->sedangPiket()) style="pointer-events:none;opacity:.5;cursor:not-allowed" @endif class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg>
        <span>Piket</span>
      </a>

      <!-- Inactive Mobile Link (Profil Guru) -->
      <a href="{{ url('/profil-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
          <circle cx="10" cy="6.5" r="3.5"/>
        </svg>
        <span>Profil</span>
      </a>

    </div>
  </nav>



</body>
</html>