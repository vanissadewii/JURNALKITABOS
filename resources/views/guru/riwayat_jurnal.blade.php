<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jurnal Mengajar - Riwayat</title>

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
<body class="bg-brand-50 font-sans min-h-screen flex text-[#3E3028]">

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

        <a href="{{ url('/form-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
            <path d="M7 3v14"/>
          </svg>
          <span>Isi Jurnal</span>
        </a>

        <!-- Active Link (Riwayat Jurnal) -->
        <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 bg-brand-50 rounded-xl font-poppins font-bold text-sm text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-[#3E3028]" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
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
  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8">
    
    <!-- Top Header Bar -->
    <header class="w-full bg-[#5C4033] shadow-md sticky top-0 z-30 px-6 md:px-10 h-16 flex items-center justify-between">
      <div class="max-w-5xl w-full mx-auto flex items-center justify-between">
        <a href="{{ url('/dashboard-guru') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all active:scale-95" aria-label="Kembali">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-white">Riwayat Jurnal Mengajar</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <!-- Main Content Container -->
    <main class="w-full max-w-5xl mx-auto px-4 sm:px-6 py-6 sm:py-8 flex flex-col gap-5 flex-1">
      
      <!-- Section Title -->
      <div class="flex items-center justify-between">
        <h2 class="font-poppins font-bold text-sm sm:text-base tracking-wider uppercase text-brand-600">
          Daftar Sesi Mengajar
        </h2>
        <span class="text-xs font-semibold text-brand-700 bg-white border border-brand-100 px-3 py-1 rounded-full shadow-xs">
          3 Sesi Tersimpan
        </span>
      </div>

      <!-- Container Card Jurnal (Grid 1 Kolom di HP, 2 Kolom di Laptop) -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <!-- CARD 1 -->
        <div class="bg-white border border-brand-100 rounded-2xl p-5 shadow-xs hover:shadow-md transition-shadow flex flex-col justify-between gap-4">
          
          <div class="flex flex-col gap-3">
            <div class="flex justify-between items-start gap-2">
              <div class="flex flex-col gap-0.5">
                <h3 class="font-poppins font-bold text-base sm:text-lg text-[#3E3028]">Matematika</h3>
                <span class="text-xs sm:text-sm font-medium text-brand-600">X RPL 1 • 21 Juli 2026 (Jam ke-1)</span>
              </div>
              <span class="px-2.5 py-1 bg-[#E8F5E9] text-[#2E7D32] rounded-md font-semibold text-xs shrink-0">
                Terverifikasi
              </span>
            </div>

            <div class="w-full h-px bg-brand-50"></div>

            <div class="flex flex-col gap-1 text-xs sm:text-sm text-brand-600">
              <p><strong class="font-semibold text-[#3E3028]">Materi:</strong> Persamaan Linear Satu Variabel</p>
              <p><strong class="font-semibold text-[#3E3028]">Kehadiran:</strong> 30 Hadir / 2 Absen • <span class="text-brand-700 font-medium">07:03 – 07:43</span></p>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex justify-end gap-2 pt-2 border-t border-brand-50">
            <a href="{{ url('/form-jurnal') }}" class="px-3.5 py-1.5 bg-brand-50 border border-brand-800 text-brand-800 hover:bg-brand-100 font-poppins font-semibold text-xs rounded-lg transition-colors">
              Edit
            </a>
            <a href="{{ url('/sesi-terverifikasi') }}" class="px-3.5 py-1.5 bg-brand-800 hover:bg-brand-900 text-white font-poppins font-semibold text-xs rounded-lg shadow-xs transition-colors">
              Lihat
            </a>
          </div>

        </div>

        <!-- CARD 2 -->
        <div class="bg-white border border-brand-100 rounded-2xl p-5 shadow-xs hover:shadow-md transition-shadow flex flex-col justify-between gap-4">
          
          <div class="flex flex-col gap-3">
            <div class="flex justify-between items-start gap-2">
              <div class="flex flex-col gap-0.5">
                <h3 class="font-poppins font-bold text-base sm:text-lg text-[#3E3028]">Matematika</h3>
                <span class="text-xs sm:text-sm font-medium text-brand-600">X RPL 2 • 21 Juli 2026 (Jam ke-2)</span>
              </div>
              <span class="px-2.5 py-1 bg-[#E8F5E9] text-[#2E7D32] rounded-md font-semibold text-xs shrink-0">
                Terverifikasi
              </span>
            </div>

            <div class="w-full h-px bg-brand-50"></div>

            <div class="flex flex-col gap-1 text-xs sm:text-sm text-brand-600">
              <p><strong class="font-semibold text-[#3E3028]">Materi:</strong> Sistem Pertidaksamaan Linear</p>
              <p><strong class="font-semibold text-[#3E3028]">Kehadiran:</strong> 32 Hadir / 0 Absen • <span class="text-brand-700 font-medium">08:00 – 08:45</span></p>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex justify-end gap-2 pt-2 border-t border-brand-50">
            <a href="{{ url('/form-jurnal') }}" class="px-3.5 py-1.5 bg-brand-50 border border-brand-800 text-brand-800 hover:bg-brand-100 font-poppins font-semibold text-xs rounded-lg transition-colors">
              Edit
            </a>
            <a href="{{ url('/sesi-terverifikasi') }}" class="px-3.5 py-1.5 bg-brand-800 hover:bg-brand-900 text-white font-poppins font-semibold text-xs rounded-lg shadow-xs transition-colors">
              Lihat
            </a>
          </div>

        </div>

        <!-- CARD 3 -->
        <div class="bg-white border border-brand-100 rounded-2xl p-5 shadow-xs hover:shadow-md transition-shadow flex flex-col justify-between gap-4">
          
          <div class="flex flex-col gap-3">
            <div class="flex justify-between items-start gap-2">
              <div class="flex flex-col gap-0.5">
                <h3 class="font-poppins font-bold text-base sm:text-lg text-[#3E3028]">Matematika</h3>
                <span class="text-xs sm:text-sm font-medium text-brand-600">XI RPL 1 • 20 Juli 2026 (Jam ke-3)</span>
              </div>
              <span class="px-2.5 py-1 bg-[#E8F5E9] text-[#2E7D32] rounded-md font-semibold text-xs shrink-0">
                Terverifikasi
              </span>
            </div>

            <div class="w-full h-px bg-brand-50"></div>

            <div class="flex flex-col gap-1 text-xs sm:text-sm text-brand-600">
              <p><strong class="font-semibold text-[#3E3028]">Materi:</strong> Fungsi Kuadrat & Grafik</p>
              <p><strong class="font-semibold text-[#3E3028]">Kehadiran:</strong> 28 Hadir / 4 Absen • <span class="text-brand-700 font-medium">09:00 – 09:45</span></p>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex justify-end gap-2 pt-2 border-t border-brand-50">
            <a href="{{ url('/form-jurnal') }}" class="px-3.5 py-1.5 bg-brand-50 border border-brand-800 text-brand-800 hover:bg-brand-100 font-poppins font-semibold text-xs rounded-lg transition-colors">
              Edit
            </a>
            <a href="{{ url('/sesi-terverifikasi') }}" class="px-3.5 py-1.5 bg-brand-800 hover:bg-brand-900 text-white font-poppins font-semibold text-xs rounded-lg shadow-xs transition-colors">
              Lihat
            </a>
          </div>

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

      <a href="{{ url('/form-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
          <path d="M7 3v14"/>
        </svg>
        <span>Isi Jurnal</span>
      </a>

      <a href="{{ url('/riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
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