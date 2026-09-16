<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sesi Terverifikasi</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

  <!-- Tailwind CSS CDN -->
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
</head>
<body class="bg-[#F9F6F0] font-sans min-h-screen flex text-[#3E3028]">

  <!-- SIDEBAR LEFT NAVIGATION (Desktop) -->
  <aside class="w-64 bg-white border-r border-brand-100 min-h-screen flex flex-col justify-between shrink-0 fixed left-0 top-0 bottom-0 z-40 hidden md:flex">
    <div class="p-6 flex flex-col gap-8">

      <!-- Brand Logo / Title -->
      <div class="flex flex-col gap-0.5">
        <h2 class="font-poppins font-extrabold text-xl text-[#3E3028] tracking-tight">JURNAL GURU</h2>
        <span class="text-xs font-medium text-brand-600">Akun Guru</span>
      </div>

      <!-- Navigation Links -->
      <nav class="flex flex-col gap-1.5">

        <a href="{{ url('/dashboard-guru') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
          </svg>
          <span>Beranda</span>
        </a>

        <!-- Active Link (Isi Jurnal) -->
        <a href="{{ url('/form-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 bg-brand-50 rounded-xl font-poppins font-bold text-sm text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-[#3E3028]" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
            <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
            <path d="M7 3v14"/>
          </svg>
          <span>Isi Jurnal</span>
        </a>

        <!-- Menu Riwayat Jurnal -->
        <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>
          </svg>
          <span>Riwayat Jurnal</span>
        </a>

        <a href="{{ url('/profil-guru') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
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
  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-20 md:pb-0">

    <!-- Header Bar -->
    <header class="w-full bg-[#5C4033] shadow-sm sticky top-0 z-30 px-6 md:px-10 h-16 flex items-center justify-between shrink-0">
      <div class="w-full flex items-center justify-between">
        <a href="{{ url('/dashboard-guru') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all active:scale-95" aria-label="Kembali ke Dashboard">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-white">Sesi Berjalan</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <!-- Main Content Container (Full Size) -->
    <main class="w-full p-4 sm:p-6 md:p-8 flex-1 flex flex-col">

      <!-- FULL CARD VERTICAL LAYOUT -->
      <div class="w-full flex-1 bg-white border border-[#EFE6DD] rounded-3xl p-6 sm:p-8 md:p-10 shadow-sm flex flex-col justify-between items-center">
        
        <!-- TOP STATUS HEADER -->
        <div class="w-full flex items-center justify-between border-b border-[#F4ECE1] pb-4 shrink-0">
          <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="font-poppins font-bold text-xs uppercase tracking-wider text-brand-600">Sesi Mengajar Aktif</span>
          </div>
          <span class="px-3.5 py-1 bg-[#FFF8E7] text-[#B78103] border border-[#FCE8B2] rounded-full font-poppins font-semibold text-xs">
            Sedang Berlangsung
          </span>
        </div>

        <!-- MIDDLE CONTENT (VERIFIKASI TENGAH ATAS + DETAIL DI BAWAHNYA) -->
        <div class="w-full max-w-2xl my-auto flex flex-col items-center gap-8 py-6">

          <!-- 1. TULISAN TERVERIFIKASI (TENGAH ATAS) -->
          <div class="flex flex-col items-center justify-center text-center gap-4">
            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-emerald-50 border-4 border-emerald-100 flex items-center justify-center shadow-xs">
              <svg class="w-10 h-10 sm:w-12 sm:h-12 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
            </div>

            <div class="flex flex-col items-center gap-1.5">
              <h2 class="font-poppins font-bold text-2xl sm:text-3xl text-[#3E3028]">Sesi Terverifikasi</h2>
              <span class="text-xs sm:text-sm font-medium text-emerald-700 bg-emerald-50 px-4 py-1 rounded-lg border border-emerald-200">
                ✓ Kehadiran Sah oleh Perwakilan
              </span>
            </div>
          </div>

          <!-- 2. DETAIL INFORMASI SESI (DI BAWAH TERVERIFIKASI) -->
          <div class="w-full bg-[#F9F6F0] border border-[#EFE6DD] rounded-2xl p-5 sm:p-6 flex flex-col divide-y divide-[#EFE6DD] text-sm sm:text-base">
            <div class="flex justify-between items-center py-3">
              <span class="text-brand-600 font-medium">Pengajar</span>
              <span class="font-bold text-[#3E3028]">Budi Santoso</span>
            </div>

            <div class="flex justify-between items-center py-3">
              <span class="text-brand-600 font-medium">Kelas</span>
              <span class="font-bold text-[#3E3028]">X RPL 1</span>
            </div>

            <div class="flex justify-between items-center py-3">
              <span class="text-brand-600 font-medium">Mata Pelajaran</span>
              <span class="font-bold text-[#3E3028]">Matematika</span>
            </div>

            <div class="flex justify-between items-center py-3">
              <span class="text-brand-600 font-medium">Check-in Sesi</span>
              <span class="font-bold text-[#3E3028]">07:03 WIB</span>
            </div>
          </div>

          <!-- 3. TOMBOL KEMBALI -->
          <div class="w-full flex flex-col items-center gap-2.5">
            <a href="{{ url('/dashboard-guru') }}" class="w-full h-13 sm:h-14 bg-[#5C4033] hover:bg-[#3E2B22] text-white font-poppins font-semibold text-sm sm:text-base rounded-xl flex items-center justify-center shadow-sm active:scale-[0.99] transition-all">
              Kembali
            </a>
            <p class="text-xs text-brand-600 text-center leading-relaxed">
              Tekan tombol di atas untuk kembali ke halaman utama.
            </p>
          </div>

        </div>

        <!-- FOOTER CARD -->
        <div class="w-full border-t border-[#F4ECE1] pt-4 text-center text-xs text-brand-600 shrink-0">
          Sistem Jurnal Mengajar Digital — Status Terhubung
        </div>

      </div>

    </main>

  </div>

  <!-- Bottom Navigation Bar (Mobile) -->
  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-3.5 px-6 z-50 shadow-[0_-4px_25px_rgba(0,0,0,0.06)]">
    <div class="flex justify-between items-center">

      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
        </svg>
        <span>Beranda</span>
      </a>

      <!-- Active Mobile Link (Isi Jurnal) -->
      <a href="{{ url('/form-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
          <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
          <path d="M7 3v14"/>
        </svg>
        <span>Isi Jurnal</span>
      </a>

      <!-- Mobile Link Riwayat Jurnal -->
      <a href="{{ url('/riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>
        </svg>
        <span>Riwayat</span>
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