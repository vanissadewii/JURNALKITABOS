<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Presensi Siswa</title>

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
    
    <!-- Screen Header Bar -->
    <header class="w-full bg-white border-b border-brand-100 sticky top-0 z-40 shadow-sm">
      <div class="max-w-5xl mx-auto px-4 h-14 flex items-center justify-between">
        <a href="{{ url('/form-jurnal') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-brand-50 hover:bg-brand-100 text-[#3E3028] transition-all active:scale-95" aria-label="Kembali">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-[#3E3028]">Presensi Siswa</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <!-- Main Content Container -->
    <main class="w-full max-w-5xl px-4 sm:px-6 py-6 sm:py-8 flex-1 flex flex-col gap-6">
      
      <!-- Session Header Info Card -->
      <div class="bg-white border border-brand-100 rounded-2xl p-5 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div class="flex flex-col gap-1">
          <span class="text-xs font-semibold text-brand-600 uppercase tracking-wider">Sesi Pembelajaran</span>
          <h2 class="font-poppins font-bold text-lg sm:text-xl text-[#3E3028]">Matematika — X RPL 1</h2>
          <p class="text-xs sm:text-sm text-brand-600">Selasa, 21 Juli 2026 • Jam ke-1 (07:03 – 07:43 WIB)</p>
        </div>
        
        <div class="flex items-center gap-2 bg-brand-50 border border-brand-100 px-3 py-1.5 rounded-xl text-xs sm:text-sm font-semibold text-brand-800">
          <svg class="w-4 h-4 text-brand-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
          </svg>
          <span>Total: 32 Siswa</span>
        </div>
      </div>

      <!-- Quick Attendance Metric Badges -->
      <div class="grid grid-cols-4 gap-2 sm:gap-4">
        <div class="bg-white border border-emerald-200 p-3 sm:p-4 rounded-xl flex flex-col items-center text-center shadow-xs">
          <span class="text-[10px] sm:text-xs font-bold text-emerald-700 uppercase tracking-wider">Hadir</span>
          <span class="font-poppins font-bold text-base sm:text-xl text-emerald-700" id="count-hadir">30</span>
        </div>

        <div class="bg-white border border-blue-200 p-3 sm:p-4 rounded-xl flex flex-col items-center text-center shadow-xs">
          <span class="text-[10px] sm:text-xs font-bold text-blue-700 uppercase tracking-wider">Izin</span>
          <span class="font-poppins font-bold text-base sm:text-xl text-blue-700" id="count-izin">1</span>
        </div>

        <div class="bg-white border border-amber-200 p-3 sm:p-4 rounded-xl flex flex-col items-center text-center shadow-xs">
          <span class="text-[10px] sm:text-xs font-bold text-amber-700 uppercase tracking-wider">Sakit</span>
          <span class="font-poppins font-bold text-base sm:text-xl text-amber-700" id="count-sakit">1</span>
        </div>

        <div class="bg-white border border-rose-200 p-3 sm:p-4 rounded-xl flex flex-col items-center text-center shadow-xs">
          <span class="text-[10px] sm:text-xs font-bold text-rose-700 uppercase tracking-wider">Alpha</span>
          <span class="font-poppins font-bold text-base sm:text-xl text-rose-700" id="count-alpha">0</span>
        </div>
      </div>

      <!-- Form Input Daftar Presensi Siswa -->
      <form action="{{ url('/form-jurnal') }}" method="GET" class="flex flex-col gap-4">
        
        <!-- Dropdown Select Pencarian Nama Siswa -->
        <div class="bg-white border border-brand-100 rounded-2xl p-4 flex flex-col gap-2 shadow-xs">
          <label for="select-siswa-search" class="font-poppins font-bold text-xs sm:text-sm text-[#3E3028] flex items-center gap-2">
            <svg class="w-4 h-4 text-brand-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
            </svg>
            <span>Pilih / Cari Nama Siswa:</span>
          </label>
          
          <select id="select-siswa-search" onchange="filterSiswaCard(this.value)" class="w-full px-3 py-2.5 text-xs sm:text-sm font-semibold rounded-xl border border-brand-100 bg-brand-50/50 text-[#3E3028] focus:outline-none focus:ring-2 focus:ring-brand-800 transition-all cursor-pointer">
            <option value="all" selected>-- Tampilkan Semua Siswa (32) --</option>
            <option value="siswa-1">Aditya Pratama (NISN: 0051234001)</option>
            <option value="siswa-2">Bella Safira (NISN: 0051234002)</option>
            <option value="siswa-3">Citra Kirana (NISN: 0051234003)</option>
            <option value="siswa-4">Doni Kusuma (NISN: 0051234004)</option>
          </select>
        </div>

        <!-- Container Daftar Card Siswa -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3" id="siswa-card-container">
          
          <!-- SISWA 1 -->
          <div id="siswa-1" class="siswa-card bg-white border border-brand-100 rounded-2xl p-4 shadow-xs flex flex-col gap-3 transition-all">
            <div class="flex items-center justify-between border-b border-brand-50 pb-3">
              <div class="flex items-center gap-3">
                <span class="w-8 h-8 flex items-center justify-center bg-brand-50 text-brand-800 font-bold text-xs rounded-xl border border-brand-100 shrink-0">
                  01
                </span>
                <div class="flex flex-col">
                  <span class="font-poppins font-bold text-sm text-[#3E3028]">Aditya Pratama</span>
                  <span class="text-xs text-brand-600">NISN: <strong class="text-[#3E3028] font-semibold">0051234001</strong></span>
                </div>
              </div>
              <span class="px-2.5 py-1 bg-emerald-50 text-emerald-800 text-[10px] font-bold rounded-lg border border-emerald-200">
                Laki-Laki
              </span>
            </div>

            <!-- Detail Sub-Informasi Tambahan -->
            <div class="grid grid-cols-2 gap-2 text-xs text-brand-600 bg-brand-50/60 p-2.5 rounded-xl border border-brand-100/50">
              <p>📍 Tempat Lahir: <span class="font-semibold text-[#3E3028]">Surabaya</span></p>
              <p>📅 Keterangan: <span class="font-semibold text-[#3E3028]">Ketua Kelas</span></p>
            </div>

            <!-- Status Presensi Dropdown -->
            <div class="flex items-center justify-between pt-1">
              <span class="text-xs font-semibold text-brand-700">Status Kehadiran:</span>
              <div class="w-32 sm:w-36">
                <select name="siswa[1]" onchange="updateSelectColor(this)" class="status-select w-full px-2.5 py-1.5 text-xs font-semibold rounded-xl border border-emerald-300 bg-emerald-50 text-emerald-800 focus:outline-none focus:ring-2 focus:ring-brand-800 transition-all cursor-pointer">
                  <option value="Hadir" selected class="bg-white text-gray-800 font-medium">Hadir</option>
                  <option value="Izin" class="bg-white text-gray-800 font-medium">Izin</option>
                  <option value="Sakit" class="bg-white text-gray-800 font-medium">Sakit</option>
                  <option value="Alpha" class="bg-white text-gray-800 font-medium">Alpha</option>
                </select>
              </div>
            </div>
          </div>

          <!-- SISWA 2 -->
          <div id="siswa-2" class="siswa-card bg-white border border-brand-100 rounded-2xl p-4 shadow-xs flex flex-col gap-3 transition-all">
            <div class="flex items-center justify-between border-b border-brand-50 pb-3">
              <div class="flex items-center gap-3">
                <span class="w-8 h-8 flex items-center justify-center bg-brand-50 text-brand-800 font-bold text-xs rounded-xl border border-brand-100 shrink-0">
                  02
                </span>
                <div class="flex flex-col">
                  <span class="font-poppins font-bold text-sm text-[#3E3028]">Bella Safira</span>
                  <span class="text-xs text-brand-600">NISN: <strong class="text-[#3E3028] font-semibold">0051234002</strong></span>
                </div>
              </div>
              <span class="px-2.5 py-1 bg-pink-50 text-pink-800 text-[10px] font-bold rounded-lg border border-pink-200">
                Perempuan
              </span>
            </div>

            <div class="grid grid-cols-2 gap-2 text-xs text-brand-600 bg-brand-50/60 p-2.5 rounded-xl border border-brand-100/50">
              <p>📍 Tempat Lahir: <span class="font-semibold text-[#3E3028]">Malang</span></p>
              <p>📅 Keterangan: <span class="font-semibold text-[#3E3028]">Siswa Regular</span></p>
            </div>

            <div class="flex items-center justify-between pt-1">
              <span class="text-xs font-semibold text-brand-700">Status Kehadiran:</span>
              <div class="w-32 sm:w-36">
                <select name="siswa[2]" onchange="updateSelectColor(this)" class="status-select w-full px-2.5 py-1.5 text-xs font-semibold rounded-xl border border-emerald-300 bg-emerald-50 text-emerald-800 focus:outline-none focus:ring-2 focus:ring-brand-800 transition-all cursor-pointer">
                  <option value="Hadir" selected class="bg-white text-gray-800 font-medium">Hadir</option>
                  <option value="Izin" class="bg-white text-gray-800 font-medium">Izin</option>
                  <option value="Sakit" class="bg-white text-gray-800 font-medium">Sakit</option>
                  <option value="Alpha" class="bg-white text-gray-800 font-medium">Alpha</option>
                </select>
              </div>
            </div>
          </div>

          <!-- SISWA 3 -->
          <div id="siswa-3" class="siswa-card bg-white border border-brand-100 rounded-2xl p-4 shadow-xs flex flex-col gap-3 transition-all">
            <div class="flex items-center justify-between border-b border-brand-50 pb-3">
              <div class="flex items-center gap-3">
                <span class="w-8 h-8 flex items-center justify-center bg-brand-50 text-brand-800 font-bold text-xs rounded-xl border border-brand-100 shrink-0">
                  03
                </span>
                <div class="flex flex-col">
                  <span class="font-poppins font-bold text-sm text-[#3E3028]">Citra Kirana</span>
                  <span class="text-xs text-brand-600">NISN: <strong class="text-[#3E3028] font-semibold">0051234003</strong></span>
                </div>
              </div>
              <span class="px-2.5 py-1 bg-pink-50 text-pink-800 text-[10px] font-bold rounded-lg border border-pink-200">
                Perempuan
              </span>
            </div>

            <div class="grid grid-cols-2 gap-2 text-xs text-brand-600 bg-brand-50/60 p-2.5 rounded-xl border border-brand-100/50">
              <p>📍 Tempat Lahir: <span class="font-semibold text-[#3E3028]">Sidoarjo</span></p>
              <p>📅 Keterangan: <span class="font-semibold text-[#3E3028]">Izin Lomba</span></p>
            </div>

            <div class="flex items-center justify-between pt-1">
              <span class="text-xs font-semibold text-brand-700">Status Kehadiran:</span>
              <div class="w-32 sm:w-36">
                <select name="siswa[3]" onchange="updateSelectColor(this)" class="status-select w-full px-2.5 py-1.5 text-xs font-semibold rounded-xl border border-blue-300 bg-blue-50 text-blue-800 focus:outline-none focus:ring-2 focus:ring-brand-800 transition-all cursor-pointer">
                  <option value="Hadir" class="bg-white text-gray-800 font-medium">Hadir</option>
                  <option value="Izin" selected class="bg-white text-gray-800 font-medium">Izin</option>
                  <option value="Sakit" class="bg-white text-gray-800 font-medium">Sakit</option>
                  <option value="Alpha" class="bg-white text-gray-800 font-medium">Alpha</option>
                </select>
              </div>
            </div>
          </div>

          <!-- SISWA 4 -->
          <div id="siswa-4" class="siswa-card bg-white border border-brand-100 rounded-2xl p-4 shadow-xs flex flex-col gap-3 transition-all">
            <div class="flex items-center justify-between border-b border-brand-50 pb-3">
              <div class="flex items-center gap-3">
                <span class="w-8 h-8 flex items-center justify-center bg-brand-50 text-brand-800 font-bold text-xs rounded-xl border border-brand-100 shrink-0">
                  04
                </span>
                <div class="flex flex-col">
                  <span class="font-poppins font-bold text-sm text-[#3E3028]">Doni Kusuma</span>
                  <span class="text-xs text-brand-600">NISN: <strong class="text-[#3E3028] font-semibold">0051234004</strong></span>
                </div>
              </div>
              <span class="px-2.5 py-1 bg-emerald-50 text-emerald-800 text-[10px] font-bold rounded-lg border border-emerald-200">
                Laki-Laki
              </span>
            </div>

            <div class="grid grid-cols-2 gap-2 text-xs text-brand-600 bg-brand-50/60 p-2.5 rounded-xl border border-brand-100/50">
              <p>📍 Tempat Lahir: <span class="font-semibold text-[#3E3028]">Gresik</span></p>
              <p>📅 Keterangan: <span class="font-semibold text-[#3E3028]">Surat Dokter (+1 hr)</span></p>
            </div>

            <div class="flex items-center justify-between pt-1">
              <span class="text-xs font-semibold text-brand-700">Status Kehadiran:</span>
              <div class="w-32 sm:w-36">
                <select name="siswa[4]" onchange="updateSelectColor(this)" class="status-select w-full px-2.5 py-1.5 text-xs font-semibold rounded-xl border border-amber-300 bg-amber-50 text-amber-800 focus:outline-none focus:ring-2 focus:ring-brand-800 transition-all cursor-pointer">
                  <option value="Hadir" class="bg-white text-gray-800 font-medium">Hadir</option>
                  <option value="Izin" class="bg-white text-gray-800 font-medium">Izin</option>
                  <option value="Sakit" selected class="bg-white text-gray-800 font-medium">Sakit</option>
                  <option value="Alpha" class="bg-white text-gray-800 font-medium">Alpha</option>
                </select>
              </div>
            </div>
          </div>

        </div>

        <!-- Submit Button Container -->
        <div class="sticky bottom-16 sm:bottom-20 bg-brand-50/90 backdrop-blur-md pt-3 pb-2 w-full">
          <button type="submit" class="w-full h-12 bg-gradient-to-r from-brand-800 to-brand-900 hover:from-brand-900 hover:to-black text-white font-poppins font-semibold text-sm rounded-xl flex items-center justify-center shadow-lg active:scale-[0.99] transition-all">
            Simpan Presensi Siswa
          </button>
        </div>

      </form>

    </main>

  </div>

  <!-- Bottom Navigation Bar -->
  <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-2.5 px-6 sm:px-10 z-50 shadow-[0_-4px_20px_rgba(0,0,0,0.05)]">
    <div class="max-w-7xl mx-auto flex justify-between md:justify-center md:gap-32 items-center h-12">
      
      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col md:flex-row items-center gap-1 md:gap-2.5 text-xs md:text-sm font-medium text-brand-600 hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5 md:w-6 md:h-6" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
        </svg>
        <span>Dashboard</span>
      </a>

      <a href="{{ url('/presensi-siswa') }}" class="flex flex-col md:flex-row items-center gap-1 md:gap-2.5 text-xs md:text-sm font-bold text-brand-800">
        <svg class="w-5 h-5 md:w-6 md:h-6" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
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

  <!-- Script Filter Pilih Siswa & Auto Warna -->
  <script>
    // Fungsi Menyaring Tampilan Kartu Siswa berdasarkan Select Option
    function filterSiswaCard(selectedId) {
      const allCards = document.querySelectorAll('.siswa-card');
      
      allCards.forEach(card => {
        if (selectedId === 'all') {
          card.classList.remove('hidden');
        } else {
          if (card.id === selectedId) {
            card.classList.remove('hidden');
          } else {
            card.classList.add('hidden');
          }
        }
      });
    }

    // Fungsi Mengubah Warna Dropdown Status Presensi
    function updateSelectColor(selectElement) {
      const val = selectElement.value;
      selectElement.className = "status-select w-full px-2.5 py-1.5 text-xs font-semibold rounded-xl border focus:outline-none focus:ring-2 focus:ring-brand-800 transition-all cursor-pointer ";
      
      if (val === 'Hadir') {
        selectElement.className += "border-emerald-300 bg-emerald-50 text-emerald-800";
      } else if (val === 'Izin') {
        selectElement.className += "border-blue-300 bg-blue-50 text-blue-800";
      } else if (val === 'Sakit') {
        selectElement.className += "border-amber-300 bg-amber-50 text-amber-800";
      } else if (val === 'Alpha') {
        selectElement.className += "border-rose-300 bg-rose-50 text-rose-800";
      }

      calculateSummary();
    }

    // Hitung ulang total di badges atas
    function calculateSummary() {
      let hadir = 0, izin = 0, sakit = 0, alpha = 0;
      document.querySelectorAll('.status-select').forEach(select => {
        if (select.value === 'Hadir') hadir++;
        if (select.value === 'Izin') izin++;
        if (select.value === 'Sakit') sakit++;
        if (select.value === 'Alpha') alpha++;
      });

      document.getElementById('count-hadir').innerText = hadir;
      document.getElementById('count-izin').innerText = izin;
      document.getElementById('count-sakit').innerText = sakit;
      document.getElementById('count-alpha').innerText = alpha;
    }
  </script>

</body>
</html>