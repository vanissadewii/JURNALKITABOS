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
        
        <!-- Mata Pelajaran -->
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
          <span class="text-brand-600 font-medium">NIP</span>
          <span class="font-bold text-[#3E3028]">198501012010011001</span>
        </div>

        <div class="w-full h-px bg-brand-50"></div>

        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Kelas</span>
          <span class="font-bold text-[#3E3028]">X RPL 1</span>
        </div>

        <div class="w-full h-px bg-brand-50"></div>

        <!-- Jam Ke / Sesi (Hanya Jam Ke dan Tanggal saja) -->
        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Jam Ke / Sesi</span>
          <span class="font-bold text-[#3E3028]">Jam Ke 1 - 3 • 21-07-2026</span>
        </div>

        <div class="w-full h-px bg-brand-50"></div>

        <!-- Waktu Kerja -->
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
              class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] appearance-none focus:outline-none focus:border-brand-800 transition-colors pr-10 cursor-pointer font-semibold"
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

        <!-- SECTION 1: DITAMPILKAN JIKA GURU "HADIR DI KELAS" / "TUGAS TERSTRUKTUR" -->
        <div id="section-guru-hadir" class="flex flex-col gap-5">
          
          <!-- Input Materi Pembelajaran -->
          <div class="flex flex-col gap-1.5">
            <label for="materi" class="text-xs font-semibold text-brand-600">Materi Pembelajaran</label>
            <input 
              type="text" 
              id="materi" 
              name="materi" 
              value="Persamaan Linear Satu Variabel" 
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
                class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors"
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
                class="w-full h-11 px-3.5 bg-brand-50 border border-brand-100 rounded-xl text-sm font-bold text-[#3E3028] focus:outline-none"
              >
            </div>
          </div>

          <!-- FITUR MULTI-SELECT PRESENSI SISWA TIDAK HADIR -->
          <div class="bg-white border border-brand-100 rounded-2xl p-4 flex flex-col gap-3 shadow-xs">
            <label for="select-siswa" class="font-poppins font-bold text-xs sm:text-sm text-[#3E3028] flex items-center gap-2">
              <svg class="w-4 h-4 text-brand-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
              </svg>
              <span>Pilih Siswa Tidak Hadir / Absen:</span>
            </label>
            
            <select id="select-siswa" onchange="pilihSiswa(this.value)" class="w-full h-11 px-3.5 text-xs sm:text-sm font-semibold rounded-xl border border-brand-100 bg-brand-50/50 text-[#3E3028] focus:outline-none focus:border-brand-800 transition-all cursor-pointer">
              <option value="" disabled selected>-- Pilih Nama Siswa --</option>
              <option value="siswa-1">Aditya Pratama (Absen 01)</option>
              <option value="siswa-2">Bella Safira (Absen 02)</option>
              <option value="siswa-3">Citra Kirana (Absen 03)</option>
              <option value="siswa-4">Doni Kusuma (Absen 04)</option>
            </select>

            <!-- Form Tambah Keterangan Siswa Sementara -->
            <div id="form-keterangan-sementara" class="hidden flex-col gap-3 p-3.5 bg-brand-50 border border-brand-100 rounded-xl">
              <div class="flex items-center justify-between border-b border-brand-100 pb-2">
                <span class="font-poppins font-bold text-sm text-[#3E3028]" id="temp-nama">Aditya Pratama</span>
                <span class="text-xs text-brand-600 font-semibold" id="temp-absen">No. Absen: 01</span>
              </div>
              
              <div class="flex items-center justify-between gap-3">
                <label class="text-xs font-semibold text-brand-800">Status Kehadiran:</label>
                <select id="temp-status" class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-amber-300 bg-amber-50 text-amber-800 focus:outline-none cursor-pointer">
                  <option value="Sakit">Sakit</option>
                  <option value="Izin">Izin</option>
                  <option value="Alpha">Alpha</option>
                </select>
              </div>

              <button type="button" onclick="tambahkanKeDaftar()" class="w-full py-2 bg-brand-800 hover:bg-brand-900 text-white font-semibold text-xs rounded-lg transition-all">
                + Tambahkan ke Daftar Absen
              </button>
            </div>

            <!-- DAFTAR / RIWAYAT SISWA YANG TIDAK HADIR -->
            <div id="container-daftar-absen" class="flex flex-col gap-2 mt-2">
              <span class="text-xs font-bold text-brand-600">Daftar Siswa Tidak Hadir:</span>
              
              <div id="empty-state-absen" class="text-xs text-brand-600 italic p-3 bg-brand-50/50 rounded-xl border border-dashed border-brand-100 text-center">
                Belum ada siswa yang ditambahkan ke daftar absen.
              </div>

              <!-- List hasil input akan otomatis dimasukkan ke sini oleh JavaScript -->
              <div id="list-siswa-absen" class="flex flex-col gap-2"></div>
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

        </div>

        <!-- SECTION 2: DITAMPILKAN KHUSUS JIKA GURU "IZIN / SAKIT" -->
        <div id="section-guru-izin" class="hidden flex-col gap-5">
          
          <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl flex items-start gap-3">
            <svg class="w-5 h-5 text-amber-700 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-xs text-amber-900 leading-relaxed">
              Anda memilih status <strong>Izin / Sakit</strong>. Pengisian presensi siswa dinonaktifkan. Silakan isi alasan dan instruksi tugas untuk disampaikan ke kelas.
            </p>
          </div>

          <!-- Keterangan Alasan Izin -->
          <div class="flex flex-col gap-1.5">
            <label for="keterangan_izin" class="text-xs font-semibold text-brand-600">Alasan Tidak Hadir</label>
            <select id="keterangan_izin" name="keterangan_izin" class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors">
              <option value="Sakit">Sakit</option>
              <option value="Izin Dinas / Pelatihan">Izin Dinas / Pelatihan</option>
              <option value="Keperluan Keluarga">Keperluan Keluarga</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </div>

          <!-- Instruksi Tugas untuk Siswa -->
          <div class="flex flex-col gap-1.5">
            <label for="instruksi_tugas" class="text-xs font-semibold text-brand-600">Instruksi Tugas untuk Siswa</label>
            <textarea 
              id="instruksi_tugas" 
              name="instruksi_tugas" 
              rows="4" 
              placeholder="Contoh: Kerjakan LKS Matematika Halaman 42 bagian A dan B. Kumpulkan ke Ketua Kelas di meja guru."
              class="w-full p-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors resize-none"
            ></textarea>
          </div>

          <!-- Pengumpulan Tugas -->
          <div class="flex flex-col gap-1.5">
            <label for="media_pengumpulan" class="text-xs font-semibold text-brand-600">Metode Pengumpulan Tugas</label>
            <select id="media_pengumpulan" name="media_pengumpulan" class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors">
              <option value="Kumpul via Ketua Kelas / Guru Piket">Kumpul via Ketua Kelas / Guru Piket</option>
              <option value="Upload Google Classroom">Upload Google Classroom</option>
              <option value="Dikumpulkan Pertemuan Selanjutnya">Dikumpulkan Pertemuan Selanjutnya</option>
            </select>
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
        <span>isi Jurnal</span>
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

  <!-- SCRIPT LOGIKA JAVASCRIPT -->
  <script>
    // 1. Toggle Tampilan Form Berdasarkan Status Guru
    function toggleStatusGuru(status) {
      const sectionHadir = document.getElementById('section-guru-hadir');
      const sectionIzin = document.getElementById('section-guru-izin');

      if (status === 'Izin / Sakit') {
        sectionHadir.classList.add('hidden');
        sectionHadir.classList.remove('flex');

        sectionIzin.classList.remove('hidden');
        sectionIzin.classList.add('flex');
      } else {
        sectionIzin.classList.add('hidden');
        sectionIzin.classList.remove('flex');

        sectionHadir.classList.remove('hidden');
        sectionHadir.classList.add('flex');
      }
    }

    // Master Data Siswa
    const dataSiswa = {
      'siswa-1': { nama: 'Aditya Pratama', absen: '01' },
      'siswa-2': { nama: 'Bella Safira', absen: '02' },
      'siswa-3': { nama: 'Citra Kirana', absen: '03' },
      'siswa-4': { nama: 'Doni Kusuma', absen: '04' }
    };

    let selectedSiswaKey = null;
    let daftarAbsenSiswa = [];

    // 2. Tampilkan form keterangan sementara saat dropdown siswa dipilih
    function pilihSiswa(key) {
      if (!key) return;
      
      // Cegah pilih siswa yang sudah dimasukkan ke daftar
      if (daftarAbsenSiswa.some(item => item.key === key)) {
        alert('Siswa ini sudah ada dalam daftar siswa tidak hadir.');
        document.getElementById('select-siswa').value = "";
        return;
      }

      selectedSiswaKey = key;
      const siswa = dataSiswa[key];

      document.getElementById('temp-nama').innerText = siswa.nama;
      document.getElementById('temp-absen').innerText = 'No. Absen: ' + siswa.absen;
      
      const formTemp = document.getElementById('form-keterangan-sementara');
      formTemp.classList.remove('hidden');
      formTemp.classList.add('flex');
    }

    // 3. Masukkan Siswa ke Dalam Daftar / Riwayat Absen
    function tambahkanKeDaftar() {
      if (!selectedSiswaKey) return;

      const siswa = dataSiswa[selectedSiswaKey];
      const statusKet = document.getElementById('temp-status').value;

      daftarAbsenSiswa.push({
        key: selectedSiswaKey,
        nama: siswa.nama,
        absen: siswa.absen,
        status: statusKet
      });

      // Reset Form Pengisian Sementara
      document.getElementById('form-keterangan-sementara').classList.add('hidden');
      document.getElementById('form-keterangan-sementara').classList.remove('flex');
      document.getElementById('select-siswa').value = "";
      selectedSiswaKey = null;

      // Render ulang daftar riwayat & update jumlah tidak hadir
      renderDaftarAbsen();
    }

    // 4. Render Riwayat Siswa Absen ke DOM
    function renderDaftarAbsen() {
      const listContainer = document.getElementById('list-siswa-absen');
      const emptyState = document.getElementById('empty-state-absen');
      const inputJumlahAbsen = document.getElementById('jumlah_absen');

      listContainer.innerHTML = '';

      if (daftarAbsenSiswa.length === 0) {
        emptyState.classList.remove('hidden');
      } else {
        emptyState.classList.add('hidden');

        daftarAbsenSiswa.forEach((item, index) => {
          let badgeColor = "";
          if (item.status === 'Sakit') badgeColor = "bg-amber-100 text-amber-800 border-amber-300";
          else if (item.status === 'Izin') badgeColor = "bg-blue-100 text-blue-800 border-blue-300";
          else if (item.status === 'Alpha') badgeColor = "bg-rose-100 text-rose-800 border-rose-300";

          const itemHTML = `
            <div class="flex items-center justify-between p-3 bg-brand-50 border border-brand-100 rounded-xl">
              <div class="flex items-center gap-2.5">
                <span class="w-6 h-6 rounded-full bg-brand-100 text-brand-800 font-bold text-xs flex items-center justify-center shrink-0">
                  ${item.absen}
                </span>
                <span class="font-semibold text-xs sm:text-sm text-[#3E3028]">${item.nama}</span>
              </div>
              
              <div class="flex items-center gap-2">
                <span class="px-2.5 py-1 rounded-lg text-xs font-bold border ${badgeColor}">
                  ${item.status}
                </span>
                <button type="button" onclick="hapusSiswaAbsen(${index})" class="p-1 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                </button>
              </div>

              <!-- Input Hidden untuk dikirimkan ke backend Laravel -->
              <input type="hidden" name="siswa_absen[${index}][key]" value="${item.key}">
              <input type="hidden" name="siswa_absen[${index}][status]" value="${item.status}">
            </div>
          `;

          listContainer.innerHTML += itemHTML;
        });
      }

      // Update angka pada field "Jumlah Tidak Hadir"
      inputJumlahAbsen.value = daftarAbsenSiswa.length;
    }

    // 5. Hapus siswa dari daftar
    function hapusSiswaAbsen(index) {
      daftarAbsenSiswa.splice(index, 1);
      renderDaftarAbsen();
    }
  </script>

</body>
</html>