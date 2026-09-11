<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profil Guru</title>

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
          <span>isi Jurnal</span>
        </a>

        <!-- Menu Riwayat Jurnal -->
        <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>
          </svg>
          <span>Riwayat Jurnal</span>
        </a>

        <!-- Active Link (Profil Guru) -->
        <a href="{{ url('/profil-guru') }}" class="flex items-center gap-3.5 px-4 py-3 bg-brand-50 rounded-xl font-poppins font-bold text-sm text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-[#3E3028]" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
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
      <div class="max-w-7xl w-full mx-auto flex items-center justify-between">
        <a href="{{ url('/profil-guru') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all active:scale-95" aria-label="Kembali ke Profil">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-white">Edit Profil</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <!-- Main Content Container -->
    <main class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8 py-6 sm:py-8 flex-1 flex flex-col items-center gap-6">
      
      <!-- Ubah Foto Profil -->
      <div class="flex flex-col items-center gap-3">
        <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-brand-300 text-brand-900 border-4 border-white shadow-md flex items-center justify-center font-poppins font-bold text-3xl sm:text-4xl">
          BS
        </div>
        <button type="button" class="text-xs sm:text-sm font-semibold text-brand-800 hover:text-brand-900 transition-colors">
          Ubah Foto Profil
        </button>
      </div>

      <!-- Form Data Profil -->
      <form action="{{ url('/profil-guru') }}" method="POST" class="w-full flex flex-col gap-6">
        @csrf
        
        <!-- Form Card Info Guru -->
        <div class="bg-white border border-brand-100 rounded-2xl p-6 sm:p-8 shadow-xs flex flex-col gap-5 w-full">
          <h2 class="font-poppins font-bold text-base sm:text-lg text-[#3E3028] border-b border-brand-100 pb-3">Informasi Pribadi</h2>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            <div class="flex flex-col gap-1.5">
              <label for="nama" class="text-xs font-semibold text-brand-600">Nama Lengkap</label>
              <input 
                type="text" 
                id="nama" 
                name="nama" 
                value="Budi Santoso, S.Pd." 
                required 
                class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors"
              >
            </div>

            <div class="flex flex-col gap-1.5">
              <label for="no_hp" class="text-xs font-semibold text-brand-600">No. Handphone</label>
              <input 
                type="text" 
                id="no_hp" 
                name="no_hp" 
                value="081234560001" 
                required 
                class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors"
              >
            </div>

            <div class="flex flex-col gap-1.5">
              <label for="unit_kerja" class="text-xs font-semibold text-brand-600">Unit Kerja</label>
              <input 
                type="text" 
                id="unit_kerja" 
                name="unit_kerja" 
                value="SMK Negeri 1 Jakarta" 
                required 
                class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors"
              >
            </div>

            <div class="flex flex-col gap-1.5">
              <label for="mapel" class="text-xs font-semibold text-brand-600">Mata Pelajaran</label>
              <input 
                type="text" 
                id="mapel" 
                name="mapel" 
                value="Matematika" 
                required 
                class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors"
              >
            </div>
          </div>

        </div>

        <!-- Password Card -->
        <div class="bg-white border border-brand-100 rounded-2xl p-6 sm:p-8 shadow-xs flex flex-col gap-5 w-full">
          
          <h2 class="font-poppins font-bold text-base sm:text-lg text-[#3E3028] border-b border-brand-100 pb-3">Ubah Password</h2>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
            <!-- Password Lama -->
            <div class="flex flex-col gap-1.5">
              <label for="passwordLama" class="text-xs font-semibold text-brand-600">Password Lama</label>
              <div class="relative w-full">
                <input 
                  type="password" 
                  id="passwordLama" 
                  placeholder="Masukkan password lama"
                  class="w-full h-11 pl-3.5 pr-10 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors"
                >
                <button 
                  type="button" 
                  onclick="togglePassword('passwordLama', this)" 
                  class="absolute right-3 top-1/2 -translate-y-1/2 text-brand-600 hover:text-brand-800 focus:outline-none p-1"
                >
                  <svg class="w-5 h-5 eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>
                </button>
              </div>
            </div>

            <!-- Password Baru -->
            <div class="flex flex-col gap-1.5">
              <label for="passwordBaru" class="text-xs font-semibold text-brand-600">Password Baru</label>
              <div class="relative w-full">
                <input 
                  type="password" 
                  id="passwordBaru" 
                  placeholder="Masukkan password baru"
                  class="w-full h-11 pl-3.5 pr-10 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors"
                >
                <button 
                  type="button" 
                  onclick="togglePassword('passwordBaru', this)" 
                  class="absolute right-3 top-1/2 -translate-y-1/2 text-brand-600 hover:text-brand-800 focus:outline-none p-1"
                >
                  <svg class="w-5 h-5 eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>
                </button>
              </div>
            </div>

            <!-- Konfirmasi Password Baru -->
            <div class="flex flex-col gap-1.5">
              <label for="konfirmasiPassword" class="text-xs font-semibold text-brand-600">Konfirmasi Password Baru</label>
              <div class="relative w-full">
                <input 
                  type="password" 
                  id="konfirmasiPassword" 
                  placeholder="Ulangi password baru"
                  class="w-full h-11 pl-3.5 pr-10 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors"
                >
                <button 
                  type="button" 
                  onclick="togglePassword('konfirmasiPassword', this)" 
                  class="absolute right-3 top-1/2 -translate-y-1/2 text-brand-600 hover:text-brand-800 focus:outline-none p-1"
                >
                  <svg class="w-5 h-5 eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>
                </button>
              </div>
            </div>
          </div>

        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row justify-end gap-3 w-full">
          <a href="{{ url('/profil-guru') }}" class="w-full sm:w-48 h-12 bg-white border border-[#5C4033] text-[#5C4033] hover:bg-brand-50 font-poppins font-semibold text-sm rounded-xl flex items-center justify-center active:scale-[0.99] transition-all">
            Batal
          </a>
          <button type="submit" class="w-full sm:w-48 h-12 bg-[#5C4033] hover:bg-[#3E2B22] text-white font-poppins font-semibold text-sm rounded-xl flex items-center justify-center shadow-md active:scale-[0.99] transition-all">
            Simpan Perubahan
          </button>
        </div>

      </form>

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
        <span>isi Jurnal</span>
      </a>

      <!-- Mobile Link Riwayat Jurnal -->
      <a href="{{ url('/riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>
        </svg>
        <span>Riwayat</span>
      </a>

      <!-- Active Mobile Link (Profil Guru) -->
      <a href="{{ url('/profil-guru') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
          <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
          <circle cx="10" cy="6.5" r="3.5"/>
        </svg>
        <span>Profil</span>
      </a>

    </div>
  </nav>

  <!-- Script Toggle Password -->
  <script>
    function togglePassword(inputId, button) {
      const input = document.getElementById(inputId);
      const svg = button.querySelector('svg');

      if (input.type === "password") {
        input.type = "text";
        svg.innerHTML = `
          <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
          <line x1="1" y1="1" x2="23" y2="23"></line>
        `;
      } else {
        input.type = "password";
        svg.innerHTML = `
          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
          <circle cx="12" cy="12" r="3"></circle>
        `;
      }
    }
  </script>

</body>
</html>