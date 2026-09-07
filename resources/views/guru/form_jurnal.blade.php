<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lengkapi Jurnal Mengajar</title>

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
      <div class="max-w-4xl mx-auto px-4 h-14 flex items-center justify-between">
        <a href="{{ url('/ringkasan-sesi') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-brand-50 hover:bg-brand-100 text-[#3E3028] transition-all active:scale-95" aria-label="Kembali">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-[#3E3028]">Lengkapi Jurnal Mengajar</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <!-- Main Content Container -->
    <main class="w-full max-w-xl px-4 sm:px-6 py-6 sm:py-8 flex-1 flex flex-col items-center justify-center gap-6">
      
      <!-- Card Ringkasan Info Sesi -->
      <div class="bg-white border border-brand-100 rounded-2xl p-5 shadow-sm w-full flex flex-col gap-2.5 text-xs sm:text-sm">
        
        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Guru</span>
          <span class="font-bold text-[#3E3028]">Budi Santoso</span>
        </div>

        <div class="w-full h-px bg-brand-50"></div>

        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">NIP</span>
          <span class="font-bold text-[#3E3028]">198501012010011001</span>
        </div>

        <div class="w-full h-px bg-brand-50"></div>

        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Kelas & Tanggal</span>
          <span class="font-bold text-[#3E3028]">X RPL 1 • 21-07-2026</span>
        </div>

        <div class="w-full h-px bg-brand-50"></div>

        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Jam Ke / Sesi</span>
          <span class="font-bold text-[#3E3028]">1 / JG-20260721-001</span>
        </div>

        <div class="w-full h-px bg-brand-50"></div>

        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Waktu Kerja</span>
          <span class="font-bold text-[#3E3028]">07:03 – 07:43 (Terverifikasi)</span>
        </div>

      </div>

      <!-- Form Inputs Container -->
      <form action="{{ url('/dashboard-guru') }}" method="GET" class="w-full flex flex-col gap-4">
        
        <!-- Input Materi Pembelajaran -->
        <div class="flex flex-col gap-1.5">
          <label for="materi" class="text-xs font-semibold text-brand-600">Materi Pembelajaran</label>
          <input 
            type="text" 
            id="materi" 
            name="materi" 
            value="Persamaan Linear Satu Variabel" 
            required 
            class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors"
          >
        </div>

        <!-- Input Grid: Jumlah Hadir & Absen -->
        <div class="grid grid-cols-2 gap-3">
          
          <div class="flex flex-col gap-1.5">
            <label for="jumlah_hadir" class="text-xs font-semibold text-brand-600">Jumlah Hadir</label>
            <input 
              type="number" 
              id="jumlah_hadir" 
              name="jumlah_hadir" 
              value="30" 
              required 
              class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors"
            >
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="jumlah_absen" class="text-xs font-semibold text-brand-600">Jumlah Absen</label>
            <input 
              type="number" 
              id="jumlah_absen" 
              name="jumlah_absen" 
              value="2" 
              required 
              class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors"
            >
          </div>

        </div>

        <!-- Select Status Kehadiran Guru -->
        <div class="flex flex-col gap-1.5">
          <label for="status_guru" class="text-xs font-semibold text-brand-600">Status Kehadiran Guru</label>
          <div class="relative">
            <select 
              id="status_guru" 
              name="status_guru" 
              class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] appearance-none focus:outline-none focus:border-brand-800 transition-colors pr-10"
            >
              <option value="Hadir di Kelas" selected>Hadir di Kelas</option>
              <option value="Tugas Terstruktur">Tugas Terstruktur</option>
              <option value="Izin / Sakit">Izin / Sakit</option>
            </select>
            <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-brand-600">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M6 9l6 6 6-6"/>
              </svg>
            </div>
          </div>
        </div>

        <!-- Input Catatan Kegiatan Kelas -->
        <div class="flex flex-col gap-1.5">
          <label for="catatan" class="text-xs font-semibold text-brand-600">Catatan Kegiatan Kelas</label>
          <textarea 
            id="catatan" 
            name="catatan" 
            rows="3" 
            class="w-full p-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors resize-none"
          >Siswa sangat antusias mengerjakan latihan soal di papan tulis.</textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full h-12 mt-2 bg-gradient-to-r from-brand-800 to-brand-900 hover:from-brand-900 hover:to-black text-white font-poppins font-semibold text-sm rounded-xl flex items-center justify-center shadow-lg active:scale-[0.99] transition-all">
          Simpan Jurnal
        </button>

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

      <a href="{{ url('/form-jurnal') }}" class="flex flex-col md:flex-row items-center gap-1 md:gap-2.5 text-xs md:text-sm font-bold text-brand-800">
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

</body>
</html>