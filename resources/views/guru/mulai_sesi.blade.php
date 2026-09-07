<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Guru</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

  <!-- Tailwind CSS CDN + Configuration -->
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
<body class="bg-brand-50 font-sans min-h-screen flex flex-col justify-between text-[#3E3028]">

  <div class="w-full flex-1 pb-28 sm:pb-32">
    
    <!-- Header Dashboard -->
    <header class="w-full bg-gradient-to-r from-brand-800 to-brand-900 shadow-lg border-b border-brand-700/20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        
        <div class="flex items-center justify-between w-full md:w-auto gap-4">
          <div class="flex flex-col gap-1">
            <span class="text-xs sm:text-sm font-medium tracking-wide text-brand-200">Selamat Datang,</span>
            <h1 class="font-poppins text-2xl sm:text-3xl font-bold text-white tracking-tight">Budi Santoso</h1>
            <span class="text-xs sm:text-sm text-brand-300">Guru Matematika • NIP. 19850101...</span>
          </div>

          <!-- Logo Mobile -->
          <div class="md:hidden w-12 h-12 flex items-center justify-center bg-gradient-to-br from-white to-[#F5EFE8] border-2 border-brand-200 rounded-xl shadow-md shrink-0">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="3" y="3" width="15" height="18" rx="2.5" fill="#5C4033"/>
              <circle cx="5.5" cy="6" r="0.8" fill="#D7B899"/>
              <circle cx="5.5" cy="12" r="0.8" fill="#D7B899"/>
              <circle cx="5.5" cy="18" r="0.8" fill="#D7B899"/>
              <line x1="9" y1="7" x2="15" y2="7" stroke="#E2C7B0" stroke-width="1.5" stroke-linecap="round"/>
              <line x1="9" y1="10.5" x2="15" y2="10.5" stroke="#E2C7B0" stroke-width="1.5" stroke-linecap="round"/>
              <line x1="9" y1="14" x2="13" y2="14" stroke="#E2C7B0" stroke-width="1.5" stroke-linecap="round"/>
              <path d="M14 19L20.5 12.5C21 12 21 11 20.5 10.5L19.5 9.5C19 9 18 9 17.5 9.5L11 16V19H14Z" fill="#D73800" stroke="#FFFFFF" stroke-width="1"/>
            </svg>
          </div>
        </div>

        <div class="flex items-center justify-between w-full md:w-auto gap-4">
          <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-3.5 py-2 rounded-xl text-xs sm:text-sm font-medium text-[#FFF8F0] border border-white/10">
            <svg class="w-4 h-4 text-brand-200" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
              <rect x="2" y="3" width="10" height="9" rx="1"/>
              <path d="M4 1v2M10 1v2M2 6h10"/>
            </svg>
            <span id="current-date">--</span>
          </div>

          <!-- Logo Desktop -->
          <div class="hidden md:flex w-14 h-14 items-center justify-center bg-gradient-to-br from-white to-[#F5EFE8] border-2 border-brand-200 rounded-2xl shadow-md shrink-0">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="3" y="3" width="15" height="18" rx="2.5" fill="#5C4033"/>
              <circle cx="5.5" cy="6" r="0.8" fill="#D7B899"/>
              <circle cx="5.5" cy="12" r="0.8" fill="#D7B899"/>
              <circle cx="5.5" cy="18" r="0.8" fill="#D7B899"/>
              <line x1="9" y1="7" x2="15" y2="7" stroke="#E2C7B0" stroke-width="1.5" stroke-linecap="round"/>
              <line x1="9" y1="10.5" x2="15" y2="10.5" stroke="#E2C7B0" stroke-width="1.5" stroke-linecap="round"/>
              <line x1="9" y1="14" x2="13" y2="14" stroke="#E2C7B0" stroke-width="1.5" stroke-linecap="round"/>
              <path d="M14 19L20.5 12.5C21 12 21 11 20.5 10.5L19.5 9.5C19 9 18 9 17.5 9.5L11 16V19H14Z" fill="#D73800" stroke="#FFFFFF" stroke-width="1"/>
            </svg>
          </div>
        </div>

      </div>
    </header>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col gap-8">
      
      <!-- 1. JADWAL UTAMA / AKTIF SAAT INI -->
      <section class="flex flex-col gap-3">
        <div class="flex items-center justify-between">
          <h2 class="font-poppins font-bold text-xs sm:text-sm tracking-wider uppercase text-brand-600 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            Sesi Mengajar Selanjutnya
          </h2>
        </div>

        <div class="w-full bg-white border border-brand-100 rounded-2xl p-6 md:p-8 flex flex-col gap-6 shadow-md relative overflow-hidden before:absolute before:left-0 before:top-0 before:bottom-0 before:w-2 before:bg-brand-800">
          <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex flex-col gap-1">
              <span class="text-xs font-semibold text-brand-700 bg-brand-50 px-3 py-1 rounded-full w-fit">Jam ke-1 (07:00 – 07:45)</span>
              <h3 class="font-poppins font-bold text-2xl md:text-3xl text-[#3E3028]">Matematika</h3>
              <span class="font-medium text-sm text-[#8C7B70]">Kelas X RPL 1 • Ruang Lab 2</span>
            </div>
            
            <a href="{{ url('/mulai-sesi') }}" class="w-full sm:w-auto px-8 h-12 bg-gradient-to-r from-brand-800 to-brand-900 hover:from-brand-900 hover:to-black text-white font-poppins font-semibold text-sm rounded-xl flex items-center justify-center shadow-md active:scale-[0.99] transition-all">
              Mulai Sesi Mengajar
            </a>
          </div>
        </div>
      </section>

      <!-- 2. DAFTAR RINGKAS SELURUH JADWAL HARI INI (7 JADWAL) -->
      <section class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
          <h2 class="font-poppins font-bold text-xs sm:text-sm tracking-wider uppercase text-brand-600">
            Semua Jadwal Hari Ini (7 Kelas)
          </h2>
          <span class="text-xs text-brand-700 font-medium">Senin, 7 Sep 2026</span>
        </div>

        <div class="bg-white border border-brand-100 rounded-2xl divide-y divide-brand-100 shadow-sm overflow-hidden">
          
          <!-- Item 1 (Berlangsung) -->
          <div class="p-4 sm:px-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-amber-50/40">
            <div class="flex items-center gap-4">
              <span class="px-3 py-1 bg-brand-800 text-white font-poppins text-xs font-bold rounded-lg shrink-0">Jam 1</span>
              <div>
                <h4 class="font-poppins font-bold text-sm text-[#3E3028]">Matematika — X RPL 1</h4>
                <p class="text-xs text-[#7A6A60]">07:00 – 07:45 WIB • Ruang Lab 2</p>
              </div>
            </div>
            <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-xs font-semibold w-fit">Sedang Berlangsung</span>
          </div>

          <!-- Item 2 -->
          <div class="p-4 sm:px-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-brand-50/50 transition-colors">
            <div class="flex items-center gap-4">
              <span class="px-3 py-1 bg-brand-100 text-brand-800 font-poppins text-xs font-bold rounded-lg shrink-0">Jam 2</span>
              <div>
                <h4 class="font-poppins font-bold text-sm text-[#3E3028]">Matematika — X RPL 1</h4>
                <p class="text-xs text-[#7A6A60]">07:45 – 08:30 WIB • Ruang Lab 2</p>
              </div>
            </div>
            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium w-fit">Belum Dimulai</span>
          </div>

          <!-- Item 3 -->
          <div class="p-4 sm:px-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-brand-50/50 transition-colors">
            <div class="flex items-center gap-4">
              <span class="px-3 py-1 bg-brand-100 text-brand-800 font-poppins text-xs font-bold rounded-lg shrink-0">Jam 3</span>
              <div>
                <h4 class="font-poppins font-bold text-sm text-[#3E3028]">Matematika — X RPL 2</h4>
                <p class="text-xs text-[#7A6A60]">08:30 – 09:15 WIB • Ruang Teori 1</p>
              </div>
            </div>
            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium w-fit">Belum Dimulai</span>
          </div>

          <!-- Item 4 -->
          <div class="p-4 sm:px-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-brand-50/50 transition-colors">
            <div class="flex items-center gap-4">
              <span class="px-3 py-1 bg-brand-100 text-brand-800 font-poppins text-xs font-bold rounded-lg shrink-0">Jam 4</span>
              <div>
                <h4 class="font-poppins font-bold text-sm text-[#3E3028]">Matematika — X RPL 2</h4>
                <p class="text-xs text-[#7A6A60]">09:30 – 10:15 WIB • Ruang Teori 1</p>
              </div>
            </div>
            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium w-fit">Belum Dimulai</span>
          </div>

        </div>
      </section>

    </main>

  </div>

  <!-- Bottom Navigation Bar -->
  <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-3.5 sm:py-4 px-6 sm:px-10 z-50 shadow-[0_-4px_25px_rgba(0,0,0,0.06)]">
    <div class="max-w-7xl mx-auto flex justify-between md:justify-center md:gap-32 items-center">
      
      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col md:flex-row items-center gap-1.5 md:gap-3 text-xs md:text-sm font-bold text-brand-800">
        <svg class="w-5 h-5 md:w-6 md:h-6" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
          <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
        </svg>
        <span>Dashboard</span>
      </a>

      <a href="{{ url('/mulai-sesi') }}" class="flex flex-col md:flex-row items-center gap-1.5 md:gap-3 text-xs md:text-sm font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5 md:w-6 md:h-6" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
          <path d="M7 3v14"/>
        </svg>
        <span>Jurnal</span>
      </a>

      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col md:flex-row items-center gap-1.5 md:gap-3 text-xs md:text-sm font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5 md:w-6 md:h-6" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
          <circle cx="10" cy="6.5" r="3.5"/>
        </svg>
        <span>Profil</span>
      </a>

    </div>
  </nav>

  <script>
    const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
    const today = new Date().toLocaleDateString('id-ID', options);
    document.getElementById('current-date').textContent = today;
  </script>

</body>
</html>