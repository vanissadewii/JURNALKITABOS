<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ringkasan Sesi Mengajar</title>

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
              50: '#F5EFE8',
              100: '#E5D8CC',
              200: '#E2C7B0',
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
<body class="bg-brand-50 font-sans min-h-screen flex flex-col justify-between text-[#3E3028]">

  <div class="w-full flex-1 flex flex-col items-center pb-28 sm:pb-32">
    
    <!-- Screen Header -->
    <header class="w-full bg-white border-b border-brand-100 sticky top-0 z-40 shadow-sm">
      <div class="max-w-4xl mx-auto px-4 h-14 flex items-center justify-between">
        <a href="{{ url('/dashboard-guru') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-brand-50 hover:bg-brand-100 text-[#3E3028] transition-all active:scale-95" aria-label="Kembali ke Dashboard">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-[#3E3028]">Sesi Mengajar Selesai</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <!-- Main Content Container -->
    <main class="w-full max-w-lg px-4 sm:px-6 py-6 sm:py-8 flex-1 flex flex-col items-center justify-center gap-6">
      
      <!-- Summary Card Utama -->
      <div class="bg-white border border-brand-100 rounded-3xl overflow-hidden shadow-xl w-full flex flex-col">
        
        <!-- Header Visual Card (Gradient Banner) -->
        <div class="bg-gradient-to-r from-brand-800 to-brand-900 p-6 text-white flex flex-col items-center text-center gap-3 relative overflow-hidden">
          
          <!-- Decorative Icon -->
          <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shadow-inner">
            <svg class="w-8 h-8 text-emerald-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
              <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
          </div>

          <div class="flex flex-col gap-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-500/20 rounded-full text-xs font-semibold text-emerald-200 border border-emerald-400/30 w-fit mx-auto">
              ✓ Sesi Terverifikasi
            </span>
            <h2 class="font-poppins font-bold text-xl sm:text-2xl tracking-tight mt-1">Ringkasan Pembelajaran</h2>
            <p class="text-xs text-brand-200">Data sesi mengajar telah berhasil dicatat ke sistem.</p>
          </div>

        </div>

        <!-- Metric Highlight Cards -->
        <div class="grid grid-cols-2 gap-3 p-5 bg-brand-50/60 border-b border-brand-100">
          
          <div class="bg-white p-3.5 rounded-2xl border border-brand-100 flex flex-col items-center text-center gap-1 shadow-sm">
            <span class="text-[10px] font-bold text-brand-600 uppercase tracking-wider">Durasi Sesi</span>
            <span class="font-poppins font-bold text-lg text-brand-800">40 Menit</span>
          </div>

          <div class="bg-white p-3.5 rounded-2xl border border-brand-100 flex flex-col items-center text-center gap-1 shadow-sm">
            <span class="text-[10px] font-bold text-brand-600 uppercase tracking-wider">Status Siswa</span>
            <span class="font-poppins font-bold text-sm text-emerald-700">Perwakilan Sah</span>
          </div>

        </div>

        <!-- Detail Rincian Sesi -->
        <div class="p-5 sm:p-6 flex flex-col gap-3.5 text-xs sm:text-sm">
          
          <div class="flex justify-between items-center py-1">
            <span class="text-brand-600 font-medium">Guru Pengajar</span>
            <span class="font-bold text-[#3E3028]">Budi Santoso, S.Pd.</span>
          </div>

          <div class="w-full h-px bg-brand-50"></div>

          <div class="flex justify-between items-center py-1">
            <span class="text-brand-600 font-medium">Kelas</span>
            <span class="font-bold text-[#3E3028]">X RPL 1</span>
          </div>

          <div class="w-full h-px bg-brand-50"></div>

          <div class="flex justify-between items-center py-1">
            <span class="text-brand-600 font-medium">Mata Pelajaran</span>
            <span class="font-bold text-[#3E3028]">Matematika (Wajib)</span>
          </div>

          <div class="w-full h-px bg-brand-50"></div>

          <div class="flex justify-between items-center py-1">
            <span class="text-brand-600 font-medium">Waktu Check-in</span>
            <span class="font-bold text-[#3E3028]">07:03 WIB</span>
          </div>

          <div class="w-full h-px bg-brand-50"></div>

          <div class="flex justify-between items-center py-1">
            <span class="text-brand-600 font-medium">Waktu Check-out</span>
            <span class="font-bold text-[#3E3028]">07:43 WIB</span>
          </div>

        </div>

      </div>

      <!-- Action Button -->
      <a href="{{ url('/dashboard-guru') }}" class="w-full h-12 bg-gradient-to-r from-brand-800 to-brand-900 hover:from-brand-900 hover:to-black text-white font-poppins font-semibold text-sm rounded-2xl flex items-center justify-center gap-2 shadow-lg hover:shadow-xl active:scale-[0.99] transition-all">
        <span>Lanjutkan Isi Jurnal</span>
        <svg class="w-4 h-4 text-brand-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
      </a>

    </main>

  </div>

  <!-- Bottom Navigation Bar -->
  <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-2.5 px-6 sm:px-10 z-50 shadow-[0_-4px_20px_rgba(0,0,0,0.05)]">
    <div class="max-w-7xl mx-auto flex justify-between md:justify-center md:gap-32 items-center h-12">
      
      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col md:flex-row items-center gap-1 md:gap-2.5 text-xs md:text-sm font-bold text-brand-800">
        <svg class="w-5 h-5 md:w-6 md:h-6" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
          <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
        </svg>
        <span>Dashboard</span>
      </a>

      <a href="{{ url('/mulai-sesi') }}" class="flex flex-col md:flex-row items-center gap-1 md:gap-2.5 text-xs md:text-sm font-medium text-brand-600 hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5 md:w-6 md:h-6" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
          <path d="M7 3v14"/>
        </svg>
        <span>Jurnal</span>
      </a>

      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col md:flex-row items-center gap-1 md:gap-2.5 text-xs md:text-sm font-medium text-brand-600 hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5 md:w-6 md:h-6" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>
        </svg>
        <span>Rekap</span>
      </a>

      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col md:flex-row items-center gap-1 md:gap-2.5 text-xs md:text-sm font-medium text-brand-600 hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5 md:w-6 md:h-6" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
          <circle cx="10" cy="6.5" r="3.5"/>
        </svg>
        <span>Profil</span>
      </a>

    </div>
  </nav>

</body>
</html>