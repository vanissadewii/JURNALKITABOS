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

        <!-- Active Link (Isi Jurnal) -->
        <a href="{{ url('/form-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 bg-brand-50 rounded-xl font-poppins font-bold text-sm text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-[#3E3028]" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
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

        <!-- Menu Profil Guru -->
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

  <!-- MAIN CONTENT AREA (Digeser ke kanan untuk layar laptop) -->
  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8">
    
    <!-- Top Header Bar (Warna Cokelat Dashboard) -->
    <header class="w-full bg-[#5C4033] shadow-md sticky top-0 z-30 px-6 md:px-10 h-16 flex items-center justify-between">
      <div class="max-w-4xl w-full mx-auto flex items-center justify-between">
        <a href="{{ url('/dashboard-guru') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all active:scale-95" aria-label="Kembali">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-white">Lengkapi Jurnal Mengajar</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <!-- Main Content Container -->
    <main class="w-full max-w-2xl mx-auto px-4 sm:px-6 py-6 sm:py-8 flex-1 flex flex-col items-center gap-6">
      
      <!-- Card Ringkasan Info Sesi -->
      <div class="bg-white border border-brand-100 rounded-2xl p-5 shadow-xs w-full flex flex-col gap-2.5 text-xs sm:text-sm">
        
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

      <!-- Form Inputs Container (ACTION MENGARAH KE QR CODE GURU) -->
      <form action="{{ url('/tampilkan-qr-guru') }}" method="GET" class="w-full flex flex-col gap-5">
        
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
            <label for="jumlah_absen" class="text-xs font-semibold text-brand-600">Jumlah Tidak Hadir</label>
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

        <!-- FITUR SELECT PRESENSI SISWA TIDAK HADIR -->
        <div class="bg-white border border-brand-100 rounded-2xl p-4 flex flex-col gap-3 shadow-xs">
          <label for="select-siswa" class="font-poppins font-bold text-xs sm:text-sm text-[#3E3028] flex items-center gap-2">
            <svg class="w-4 h-4 text-brand-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
            </svg>
            <span>Pilih Siswa Tidak Hadir / Absen:</span>
          </label>
          
          <select id="select-siswa" onchange="tampilkanDetailSiswa(this.value)" class="w-full h-11 px-3.5 text-xs sm:text-sm font-semibold rounded-xl border border-brand-100 bg-brand-50/50 text-[#3E3028] focus:outline-none focus:border-brand-800 transition-all cursor-pointer">
            <option value="" disabled selected>-- Pilih Nama Siswa --</option>
            <option value="siswa-1">Aditya Pratama (Absen 01)</option>
            <option value="siswa-2">Bella Safira (Absen 02)</option>
            <option value="siswa-3">Citra Kirana (Absen 03)</option>
            <option value="siswa-4">Doni Kusuma (Absen 04)</option>
          </select>

          <!-- Kartu Informasi Detail Siswa -->
          <div id="detail-siswa-box" class="hidden flex-col gap-3 p-3.5 mt-1 bg-brand-50/80 border border-brand-100 rounded-xl">
            <div class="flex items-center justify-between border-b border-brand-100 pb-2.5">
              <span class="font-poppins font-bold text-sm text-[#3E3028]" id="info-nama">Aditya Pratama</span>
              <span class="px-2 py-0.5 bg-white text-brand-800 text-[11px] font-bold rounded-md border border-brand-100" id="info-absen">No. Absen: 01</span>
            </div>

            <!-- Detail Grid Informasi Siswa -->
            <div class="grid grid-cols-2 gap-2 text-xs text-brand-600">
              <p>Kelas: <strong class="text-[#3E3028] font-semibold" id="info-kelas">X RPL 1</strong></p>
              <p>NISN: <strong class="text-[#3E3028] font-semibold" id="info-nisn">0051234001</strong></p>
            </div>

            <!-- Select Status Keterangan Kehadiran (Sakit, Izin, Alpha) -->
            <div class="flex items-center justify-between pt-1 border-t border-brand-100/60">
              <label for="status-kehadiran-siswa" class="text-xs font-semibold text-brand-800">Keterangan:</label>
              <select id="status-kehadiran-siswa" onchange="updateWarnaKeterangan(this)" class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-amber-300 bg-amber-50 text-amber-800 focus:outline-none cursor-pointer">
                <option value="Sakit" selected>Sakit</option>
                <option value="Izin">Izin</option>
                <option value="Alpha">Alpha</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Select Status Kehadiran Guru -->
        <div class="flex flex-col gap-1.5">
          <label for="status_guru" class="text-xs font-semibold text-brand-600">Status Kehadiran Guru</label>
          <div class="relative">
            <select 
              id="status_guru" 
              name="status_guru" 
              class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] appearance-none focus:outline-none focus:border-brand-800 transition-colors pr-10 cursor-pointer"
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
        <button type="submit" class="w-full h-12 mt-2 bg-[#5C4033] hover:bg-[#3E2B22] text-white font-poppins font-semibold text-sm rounded-xl flex items-center justify-center shadow-md active:scale-[0.99] transition-all">
          Simpan Jurnal
        </button>

      </form>

    </main>

  </div>

  <!-- Bottom Navigation Bar (Hanya muncul di Mobile/HP) -->
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
        <span>isi Jurnal</span>
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

  <!-- Script Interaktif Tampilkan Detail Siswa -->
  <script>
    const dataSiswa = {
      'siswa-1': { nama: 'Aditya Pratama', absen: '01', kelas: 'X RPL 1', nisn: '0051234001' },
      'siswa-2': { nama: 'Bella Safira', absen: '02', kelas: 'X RPL 1', nisn: '0051234002' },
      'siswa-3': { nama: 'Citra Kirana', absen: '03', kelas: 'X RPL 1', nisn: '0051234003' },
      'siswa-4': { nama: 'Doni Kusuma', absen: '04', kelas: 'X RPL 1', nisn: '0051234004' }
    };

    function tampilkanDetailSiswa(idSiswa) {
      const detailBox = document.getElementById('detail-siswa-box');
      const item = dataSiswa[idSiswa];

      if (item) {
        document.getElementById('info-nama').innerText = item.nama;
        document.getElementById('info-absen').innerText = 'No. Absen: ' + item.absen;
        document.getElementById('info-kelas').innerText = item.kelas;
        document.getElementById('info-nisn').innerText = item.nisn;
        
        detailBox.classList.remove('hidden');
        detailBox.classList.add('flex');
      }
    }

    function updateWarnaKeterangan(element) {
      const val = element.value;
      if (val === 'Sakit') {
        element.className = "px-3 py-1.5 text-xs font-semibold rounded-lg border border-amber-300 bg-amber-50 text-amber-800 focus:outline-none cursor-pointer";
      } else if (val === 'Izin') {
        element.className = "px-3 py-1.5 text-xs font-semibold rounded-lg border border-blue-300 bg-blue-50 text-blue-800 focus:outline-none cursor-pointer";
      } else if (val === 'Alpha') {
        element.className = "px-3 py-1.5 text-xs font-semibold rounded-lg border border-rose-300 bg-rose-50 text-rose-800 focus:outline-none cursor-pointer";
      }
    }
  </script>

</body>
</html>