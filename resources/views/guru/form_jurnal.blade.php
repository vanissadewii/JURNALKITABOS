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
          <span>Isi Jurnal</span>
        </a>

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
  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8">

    <!-- Top Header Bar -->
    <header class="w-full bg-[#5C4033] shadow-md sticky top-0 z-30 px-6 md:px-10 h-16 flex items-center justify-between">
      <div class="w-full flex items-center justify-between">
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
    <main class="w-full px-6 md:px-10 py-6 sm:py-8 flex-1 flex flex-col items-center gap-6">

      <!-- Card Ringkasan Info Sesi -->
      <div class="bg-white border border-brand-100 rounded-2xl p-6 shadow-xs w-full flex flex-col gap-3 text-sm">

        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Mata Pelajaran</span>
          <span class="font-bold text-[#3E3028]">Matematika</span>
        </div>

        <div class="w-full h-px bg-brand-50"></div>

        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Guru</span>
          <span class="font-bold text-[#3E3028]">Budi Santoso</span>
        </div>

        <div class="w-full h-px bg-brand-50"></div>

        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Kelas</span>
          <span class="font-bold text-[#3E3028]">X RPL 1</span>
        </div>

        <div class="w-full h-px bg-brand-50"></div>

        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Jam Ke</span>
          <span class="font-bold text-[#3E3028]">Jam Ke 1 - 3</span>
        </div>

        <div class="w-full h-px bg-brand-50"></div>

        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Waktu Kerja</span>
          <span class="font-bold text-[#3E3028]">07:03 – 07:43</span>
        </div>

      </div>

      <!-- Form Inputs Container -->
      <form action="{{ url('/tampilkan-qr-guru') }}" method="GET" class="w-full flex flex-col gap-5">

        <!-- Select Status Kehadiran Guru -->
        <div class="flex flex-col gap-1.5">
          <label for="status_guru" class="text-xs font-semibold text-brand-600">Status Kehadiran Guru</label>
          <div class="relative">
            <select 
              id="status_guru" 
              name="status_guru" 
              onchange="toggleStatusGuru(this.value)"
              class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-xs sm:text-sm text-[#3E3028] appearance-none focus:outline-none focus:border-brand-800 transition-colors pr-10 cursor-pointer font-semibold"
            >
              <option value="Hadir di Kelas" selected>Hadir di Kelas</option>
              <option value="Izin / Sakit">Izin / Sakit</option>
            </select>
            <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-brand-600">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M6 9l6 6 6-6"/>
              </svg>
            </div>
          </div>
        </div>

        <!-- Banner Info Ketika Guru Izin/Sakit -->
        <div id="banner-izin" class="hidden p-4 bg-amber-50 border border-amber-200 rounded-xl items-start gap-3">
          <svg class="w-5 h-5 text-amber-700 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <p class="text-xs text-amber-900 leading-relaxed">
            Status Anda saat ini adalah <strong>Izin / Sakit</strong>. Pengisian materi, presensi siswa, dan catatan pembelajaran dinonaktifkan.
          </p>
        </div>

        <!-- FORM ISIAN UTAMA -->
        <div id="section-form-utama" class="flex flex-col gap-5">

          <!-- Input Materi Pembelajaran -->
          <div class="flex flex-col gap-1.5">
            <label for="materi" class="text-xs font-semibold text-brand-600">Materi Pembelajaran</label>
            <input 
              type="text" 
              id="materi" 
              name="materi" 
              value="Persamaan Linear Satu Variabel" 
              class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-xs sm:text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-all disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed disabled:border-gray-200"
            >
          </div>

          <!-- Input Grid: Jumlah Hadir & Absen -->
          <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-col gap-1.5">
              <label for="jumlah_hadir" class="text-xs font-semibold text-brand-600">Jumlah Hadir</label>
              <input 
                type="number" 
                id="jumlah_hadir" 
                name="jumlah_hadir" 
                value="30" 
                class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-xs sm:text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-all disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed disabled:border-gray-200"
              >
            </div>

            <div class="flex flex-col gap-1.5">
              <label for="jumlah_absen" class="text-xs font-semibold text-brand-600">Jumlah Tidak Hadir</label>
              <input 
                type="number" 
                id="jumlah_absen" 
                name="jumlah_absen" 
                value="0" 
                readonly
                class="w-full h-11 px-3.5 bg-brand-50 border border-brand-100 rounded-xl text-xs sm:text-sm font-bold text-[#3E3028] focus:outline-none disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed disabled:border-gray-200"
              >
            </div>
          </div>

          <!-- FITUR PRESENSI SISWA SIMPEL (SEARCH & TANGGUNG JAWAB TOMBOL KET / S I A) -->
          <div id="box-presensi-siswa" class="bg-white border border-brand-100 rounded-2xl p-5 flex flex-col gap-4 shadow-xs transition-all">
            <div class="flex flex-col gap-2">
              <label for="search-siswa" class="font-poppins font-bold text-xs sm:text-sm text-[#3E3028] flex items-center gap-2">
                <svg class="w-4 h-4 text-brand-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
                </svg>
                <span>Presensi Siswa Tidak Hadir:</span>
              </label>

              <!-- Input Cari Nama Siswa -->
              <div class="relative">
                <input 
                  type="text" 
                  id="search-siswa" 
                  oninput="filterSiswa(this.value)"
                  placeholder="Ketik nama / no. absen siswa..." 
                  class="w-full h-10 pl-9 pr-3.5 bg-brand-50/50 border border-brand-100 rounded-xl text-xs sm:text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-all disabled:bg-gray-100 disabled:cursor-not-allowed"
                >
                <svg class="w-4 h-4 text-brand-600 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
              </div>
            </div>

            <!-- List Siswa dengan Tombol Aksi Langsung (S, I, A) -->
            <div id="list-siswa-container" class="flex flex-col gap-2 max-h-60 overflow-y-auto pr-1">
              <!-- Render otomatis via JavaScript -->
            </div>

            <!-- Container Tersembunyi untuk Input Form Laravel/Backend -->
            <div id="hidden-inputs-container"></div>
          </div>

          <!-- Input Catatan Kegiatan Kelas -->
          <div class="flex flex-col gap-1.5">
            <label for="catatan" class="text-xs font-semibold text-brand-600">Catatan Kegiatan Kelas</label>
            <textarea 
              id="catatan" 
              name="catatan" 
              rows="3" 
              class="w-full p-3.5 bg-white border border-brand-100 rounded-xl text-xs sm:text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-all resize-none disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed disabled:border-gray-200"
            >Siswa sangat antusias mengerjakan latihan soal di papan tulis.</textarea>
          </div>

        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full h-12 mt-2 bg-[#5C4033] hover:bg-[#3E2B22] text-white font-poppins font-semibold text-sm rounded-xl flex items-center justify-center shadow-md active:scale-[0.99] transition-all">
          Simpan Jurnal
        </button>

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

      <a href="{{ url('/form-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
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

      <a href="{{ url('/profil-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
          <circle cx="10" cy="6.5" r="3.5"/>
        </svg>
        <span>Profil</span>
      </a>
    </div>
  </nav>

  <!-- SCRIPT LOGIKA JAVASCRIPT SIMPEL -->
  <script>
    function toggleStatusGuru(status) {
      const materiInput = document.getElementById('materi');
      const jumlahHadirInput = document.getElementById('jumlah_hadir');
      const searchSiswaInput = document.getElementById('search-siswa');
      const catatanInput = document.getElementById('catatan');
      const boxPresensi = document.getElementById('box-presensi-siswa');
      const bannerIzin = document.getElementById('banner-izin');

      if (status === 'Izin / Sakit') {
        materiInput.disabled = true;
        jumlahHadirInput.disabled = true;
        searchSiswaInput.disabled = true;
        catatanInput.disabled = true;

        boxPresensi.classList.add('bg-gray-100', 'opacity-60', 'pointer-events-none');
        boxPresensi.classList.remove('bg-white');

        bannerIzin.classList.remove('hidden');
        bannerIzin.classList.add('flex');
      } else {
        materiInput.disabled = false;
        jumlahHadirInput.disabled = false;
        searchSiswaInput.disabled = false;
        catatanInput.disabled = false;

        boxPresensi.classList.remove('bg-gray-100', 'opacity-60', 'pointer-events-none');
        boxPresensi.classList.add('bg-white');

        bannerIzin.classList.add('hidden');
        bannerIzin.classList.remove('flex');
      }
    }

    // Data Siswa beserta Status Default ("Hadir")
    const daftarSiswa = [
      { key: 'siswa-1', nama: 'Aditya Pratama', absen: '01', status: 'Hadir' },
      { key: 'siswa-2', nama: 'Bella Safira', absen: '02', status: 'Hadir' },
      { key: 'siswa-3', nama: 'Citra Kirana', absen: '03', status: 'Hadir' },
      { key: 'siswa-4', nama: 'Doni Kusuma', absen: '04', status: 'Hadir' }
    ];

    let searchKeyword = "";

    function filterSiswa(val) {
      searchKeyword = val.toLowerCase();
      renderListSiswa();
    }

    function setStatusSiswa(key, newStatus) {
      const targetSiswa = daftarSiswa.find(s => s.key === key);
      if (targetSiswa) {
        // Toggle: Jika status yang diklik sama, kembalikan ke 'Hadir'
        targetSiswa.status = (targetSiswa.status === newStatus) ? 'Hadir' : newStatus;
      }
      renderListSiswa();
      updateRingkasanJumlah();
    }

    function renderListSiswa() {
      const container = document.getElementById('list-siswa-container');
      container.innerHTML = '';

      const filtered = daftarSiswa.filter(s => 
        s.nama.toLowerCase().includes(searchKeyword) || 
        s.absen.includes(searchKeyword)
      );

      if (filtered.length === 0) {
        container.innerHTML = `
          <div class="text-xs text-brand-600 italic p-3 bg-brand-50/50 rounded-xl text-center border border-dashed border-brand-100">
            Siswa tidak ditemukan.
          </div>`;
        return;
      }

      filtered.forEach(siswa => {
        const isSakit = siswa.status === 'Sakit';
        const isIzin  = siswa.status === 'Izin';
        const isAlpha = siswa.status === 'Alpha';

        const itemHTML = `
          <div class="flex items-center justify-between p-2.5 bg-brand-50/60 border border-brand-100 rounded-xl text-xs sm:text-sm">
            <div class="flex items-center gap-2.5 overflow-hidden">
              <span class="w-6 h-6 rounded-full bg-brand-100 text-brand-800 font-bold text-xs flex items-center justify-center shrink-0">
                ${siswa.absen}
              </span>
              <span class="font-semibold text-[#3E3028] truncate">${siswa.nama}</span>
            </div>

            <!-- Tombol Pilihan S I A Langsung -->
            <div class="flex items-center gap-1 shrink-0">
              <button type="button" onclick="setStatusSiswa('${siswa.key}', 'Sakit')" 
                class="w-7 h-7 rounded-lg font-bold text-xs transition-all ${isSakit ? 'bg-amber-500 text-white shadow-xs scale-105' : 'bg-white text-amber-700 border border-amber-200 hover:bg-amber-50'}">
                S
              </button>
              <button type="button" onclick="setStatusSiswa('${siswa.key}', 'Izin')" 
                class="w-7 h-7 rounded-lg font-bold text-xs transition-all ${isIzin ? 'bg-blue-500 text-white shadow-xs scale-105' : 'bg-white text-blue-700 border border-blue-200 hover:bg-blue-50'}">
                I
              </button>
              <button type="button" onclick="setStatusSiswa('${siswa.key}', 'Alpha')" 
                class="w-7 h-7 rounded-lg font-bold text-xs transition-all ${isAlpha ? 'bg-rose-500 text-white shadow-xs scale-105' : 'bg-white text-rose-700 border border-rose-200 hover:bg-rose-50'}">
                A
              </button>
            </div>
          </div>
        `;
        container.innerHTML += itemHTML;
      });

      renderHiddenInputs();
    }

    function updateRingkasanJumlah() {
      const totalTidakHadir = daftarSiswa.filter(s => s.status !== 'Hadir').length;
      document.getElementById('jumlah_absen').value = totalTidakHadir;
    }

    function renderHiddenInputs() {
      const hiddenContainer = document.getElementById('hidden-inputs-container');
      hiddenContainer.innerHTML = '';

      const tidakHadir = daftarSiswa.filter(s => s.status !== 'Hadir');
      tidakHadir.forEach((item, index) => {
        hiddenContainer.innerHTML += `
          <input type="hidden" name="siswa_absen[${index}][key]" value="${item.key}">
          <input type="hidden" name="siswa_absen[${index}][status]" value="${item.status}">
        `;
      });
    }

    // Inisialisasi Pertama
    renderListSiswa();
  </script>

</body>
</html>