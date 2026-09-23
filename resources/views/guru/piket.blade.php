<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu Piket</title>

  <!-- Google Fonts -->
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

        <a href="{{ url('/dashboard-guru') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
          </svg>
          <span>Beranda</span>
        </a>

        <a href="{{ route('jurnal.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
            <path d="M7 3v14"/>
          </svg>
          <span>Isi Jurnal</span>
        </a>

        <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>
          </svg>
          <span>Riwayat Jurnal</span>
        </a>

        <!-- Active Link (Piket) -->
        <a href="{{ url('/dashboard-guru-piket') }}" class="flex items-center gap-3 px-3 py-2.5 bg-[#F5EFE8] rounded-lg font-poppins font-bold text-md text-[#5C4033] transition-all">
          <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg>
          <span>Piket</span>
        </a>

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

  <!-- MAIN CONTENT AREA -->
  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8 w-full min-w-0">

     <!-- Top Header Bar -->
    <header class="w-full bg-[#5C4033] shadow-md sticky top-0 z-30 px-6 md:px-10 h-16 flex items-center justify-between">
      <div class="w-full flex items-center justify-between">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          </svg>
        </a>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-white">Piket</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="w-full px-6 md:px-10 py-8 flex flex-col gap-8 flex-1">

      <div class="flex flex-col gap-4 w-full">
        <h2 class="font-poppins font-bold text-sm sm:text-base tracking-wider uppercase text-brand-600">
          Pilih Menu Piket
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 w-full">

          <!-- MENU 1: Jurnal Mengajar (Terima Jurnal dari Kelas) -->
          <a href="{{ route('piket.jurnal') }}" class="group bg-white border border-brand-100 rounded-2xl p-6 flex flex-col gap-5 hover:border-brand-300 hover:shadow-md transition-all">
            <div class="w-12 h-12 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 flex items-center justify-center shrink-0">
              <svg class="w-6 h-6" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
                <path d="M7 7h6M7 10h6M7 13h3"/>
              </svg>
            </div>
            <div class="flex flex-col gap-1.5">
              <h3 class="font-poppins font-bold text-lg text-[#3E3028]">Jurnal Mengajar</h3>
              <p class="text-sm text-[#8C7B70] leading-relaxed">Terima dan pantau jurnal mengajar yang dikirim oleh setiap kelas hari ini.</p>
            </div>
            <span class="mt-auto flex items-center gap-1.5 text-sm font-poppins font-semibold text-brand-800 group-hover:text-brand-900">
              Buka Menu
              <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 4l6 6-6 6"/></svg>
            </span>
          </a>

          <!-- MENU 2: Dispensasi Siswa -->
          <a href="{{ route('dispen.index') }}" class="group bg-white border border-brand-100 rounded-2xl p-6 flex flex-col gap-5 hover:border-brand-300 hover:shadow-md transition-all">
            <div class="w-12 h-12 rounded-xl bg-brand-100 text-brand-800 flex items-center justify-center shrink-0">
              <svg class="w-6 h-6" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="10" cy="6.5" r="3.5"/>
                <path d="M4 17v-1a5 5 0 015-5h2a5 5 0 015 5v1"/>
                <path d="M13 9l3-3 1.5 1.5-3 3z"/>
              </svg>
            </div>
            <div class="flex flex-col gap-1.5">
              <h3 class="font-poppins font-bold text-lg text-[#3E3028]">Dispensasi Siswa</h3>
              <p class="text-sm text-[#8C7B70] leading-relaxed">Kelola pengajuan dan pencatatan dispensasi siswa yang izin meninggalkan kelas.</p>
            </div>
            <span class="mt-auto flex items-center gap-1.5 text-sm font-poppins font-semibold text-brand-800 group-hover:text-brand-900">
              Buka Menu
              <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 4l6 6-6 6"/></svg>
            </span>
          </a>

          <!-- MENU 3: Upload Tugas (Guru Izin/Sakit) -->
          <a href="{{ url('/piket/upload-tugas') }}" class="group bg-white border border-brand-100 rounded-2xl p-6 flex flex-col gap-5 hover:border-brand-300 hover:shadow-md transition-all">
            <div class="w-12 h-12 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 flex items-center justify-center shrink-0">
              <svg class="w-6 h-6" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M10 3v9m0 0l-3-3m3 3l3-3"/>
                <path d="M4 14v2a1 1 0 001 1h10a1 1 0 001-1v-2"/>
              </svg>
            </div>
            <div class="flex flex-col gap-1.5">
              <h3 class="font-poppins font-bold text-lg text-[#3E3028]">Upload Tugas</h3>
              <p class="text-sm text-[#8C7B70] leading-relaxed">Unggah tugas pengganti untuk kelas yang gurunya sedang izin atau sakit.</p>
            </div>
            <span class="mt-auto flex items-center gap-1.5 text-sm font-poppins font-semibold text-brand-800 group-hover:text-brand-900">
              Buka Menu
              <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 4l6 6-6 6"/></svg>
            </span>
          </a>

        </div>
      </div>

    </main>

  </div>

  <!-- Bottom Navigation Bar (Mobile HP) -->
  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-3.5 px-6 z-50 shadow-[0_-4px_25px_rgba(0,0,0,0.06)]">
    <div class="flex justify-between items-center">

      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
        </svg>
        <span>Beranda</span>
      </a>

      <a href="{{ url('/form-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
          <path d="M7 3v14"/>
        </svg>
        <span>Isi Jurnal</span>
      </a>

      <a href="{{ url('/riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>
        </svg>
        <span>Riwayat</span>
      </a>

      <!-- Active Mobile Link (Piket) -->
      <a href="{{ url('/dashboard-guru-piket') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800">
        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg>
        <span>Piket</span>
      </a>

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