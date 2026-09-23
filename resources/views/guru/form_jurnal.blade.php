<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lengkapi Jurnal Mengajar</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

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

  <!-- SIDEBAR (Desktop) -->
  <aside class="w-64 bg-white border-r border-brand-100 min-h-screen flex flex-col justify-between shrink-0 fixed left-0 top-0 bottom-0 z-40 hidden md:flex">
    <div class="p-6 flex flex-col gap-8">
      <div class="flex flex-col gap-0.5">
        <h2 class="font-poppins font-extrabold text-xl text-[#3E3028] tracking-tight">JURNAL GURU</h2>
        <span class="text-xs font-medium text-brand-600">Akun Guru</span>
      </div>

      <nav class="flex flex-col gap-1.5">
        <a href="{{ url('/dashboard-guru') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z" />
          </svg>
          <span>Beranda</span>
        </a>

        <a href="{{ url('/form-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 bg-brand-50 rounded-xl font-poppins font-bold text-sm text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-[#3E3028]" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
            <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z" />
            <path d="M7 3v14" />
          </svg>
          <span>Isi Jurnal</span>
        </a>

        <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M3 4h14M3 8h14M3 12h10M3 16h6" />
          </svg>
          <span>Riwayat Jurnal</span>
        </a>

        <a href="{{ url('/profil-guru') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17" />
            <circle cx="10" cy="6.5" r="3.5" />
          </svg>
          <span>Profil</span>
        </a>
      </nav>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8">

    <header class="w-full bg-[#5C4033] shadow-md sticky top-0 z-30 px-6 md:px-10 h-16 flex items-center justify-between">
      <div class="w-full flex items-center justify-between">
        <a href="{{ url('/dashboard-guru') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all active:scale-95" aria-label="Kembali">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6" />
          </svg>
        </a>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-white">Lengkapi Jurnal Mengajar</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <main class="w-full px-6 md:px-10 py-6 sm:py-8 flex-1 flex flex-col items-center gap-6">

      @if ($errors->any())
      <ul class="w-full text-sm text-red-700 bg-red-50 border border-red-200 rounded-xl p-4 list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
      @endif

      @if (! $jadwalAktif)
      <div class="w-full bg-white border border-brand-100 rounded-2xl p-6 text-sm text-brand-700 flex flex-col gap-3">
        <p class="font-semibold">Tidak ada jadwal mengajar yang dipilih.</p>
        <p>Buka jurnal dari tombol "Isi Jurnal" atau "Mulai Sesi Mengajar" di Beranda.</p>
        <a href="{{ url('/dashboard-guru') }}" class="font-poppins font-semibold text-brand-800 underline underline-offset-2">← Kembali ke Beranda</a>
      </div>
      @else
      @if (session('error'))
      <div class="w-full bg-red-50 border border-red-200 text-red-700 text-sm font-medium rounded-xl p-4">
        {{ session('error') }}
      </div>
      @endif
      @if (session('success'))
      <div class="w-full bg-green-50 border border-green-200 text-green-700 text-sm font-medium rounded-xl p-4">
        {{ session('success') }}
      </div>
      @endif
      @php
      $awal = ($rentang ?? collect())->first()?->jamPelajaran ?? $jadwalAktif->jamPelajaran;
      $akhir = ($rentang ?? collect())->last()?->jamPelajaran ?? $awal;
      $labelJam = $awal
      ? 'Jam Ke '.$awal->jam_ke.($akhir->jam_ke != $awal->jam_ke ? ' - '.$akhir->jam_ke : '')
      : '-';
      $labelWaktu = $awal
      ? substr($awal->jam_mulai, 0, 5).' – '.substr($akhir->jam_selesai, 0, 5)
      : '-';

      $siswaJs = $daftarSiswa->values()->map(function ($s, $i) {
      return [
      'key' => 'siswa-'.$s->id_siswa,
      'nama' => $s->nama,
      'absen' => str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT),
      'status' => 'Hadir',
      ];
      });
      @endphp

      <!-- Card Ringkasan Info Sesi -->
      <div class="bg-white border border-brand-100 rounded-2xl p-6 shadow-xs w-full flex flex-col gap-3 text-sm">
        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Mata Pelajaran</span>
          <span class="font-bold text-[#3E3028]">{{ $jadwalAktif->mapel->nama_mapel ?? '-' }}</span>
        </div>
        <div class="w-full h-px bg-brand-50"></div>

        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Guru</span>
          <span class="font-bold text-[#3E3028]">{{ auth()->user()->name }}</span>
        </div>
        <div class="w-full h-px bg-brand-50"></div>

        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Kelas</span>
          <span class="font-bold text-[#3E3028]">{{ $jadwalAktif->kelas->nama_kelas ?? '-' }}</span>
        </div>
        <div class="w-full h-px bg-brand-50"></div>

        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Jam Ke</span>
          <span class="font-bold text-[#3E3028]">{{ $labelJam }}</span>
        </div>
        <div class="w-full h-px bg-brand-50"></div>

        <div class="flex justify-between items-center">
          <span class="text-brand-600 font-medium">Waktu Kerja</span>
          <span class="font-bold text-[#3E3028]">{{ $labelWaktu }}</span>
        </div>
      </div>

      <!-- FORM -->
      <form action="{{ route('jurnal.store') }}" method="POST" class="w-full flex flex-col gap-5">
        @csrf
        <input type="hidden" name="id_jadwal" value="{{ $jadwalAktif->id_jadwal }}">

        <!-- FORM ISIAN UTAMA -->
        <div id="section-form-utama" class="flex flex-col gap-5">

          <div class="flex flex-col gap-1.5">
            <label for="materi" class="text-xs font-semibold text-brand-600">Materi Pembelajaran</label>
            <input
              type="text"
              id="materi"
              name="materi"
              value="{{ old('materi') }}"
              placeholder="Tulis materi yang diajarkan..."
              class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-xs sm:text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-all disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed disabled:border-gray-200">
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-col gap-1.5">
              <label for="jumlah_hadir" class="text-xs font-semibold text-brand-600">Jumlah Hadir</label>
              <input
                type="number"
                id="jumlah_hadir"
                name="jumlah_hadir"
                value="{{ $daftarSiswa->count() }}"
                readonly
                class="w-full h-11 px-3.5 bg-brand-50 border border-brand-100 rounded-xl text-xs sm:text-sm font-bold text-[#3E3028] focus:outline-none disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed disabled:border-gray-200">
            </div>

            <div class="flex flex-col gap-1.5">
              <label for="jumlah_absen" class="text-xs font-semibold text-brand-600">Jumlah Tidak Hadir</label>
              <input
                type="number"
                id="jumlah_absen"
                value="0"
                readonly
                class="w-full h-11 px-3.5 bg-brand-50 border border-brand-100 rounded-xl text-xs sm:text-sm font-bold text-[#3E3028] focus:outline-none">
            </div>
          </div>

          <!-- PRESENSI SISWA -->
          <div id="box-presensi-siswa" class="bg-white border border-brand-100 rounded-2xl p-5 flex flex-col gap-4 shadow-xs transition-all">
            <div class="flex flex-col gap-2">
              <label for="search-siswa" class="font-poppins font-bold text-xs sm:text-sm text-[#3E3028] flex items-center gap-2">
                <svg class="w-4 h-4 text-brand-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                  <circle cx="9" cy="7" r="4" />
                  <path d="M23 21v-2a4 4 0 00-3-3.87" />
                  <path d="M16 3.13a4 4 0 010 7.75" />
                </svg>
                <span>Presensi Siswa Tidak Hadir:</span>
              </label>

              <div class="relative">
                <input
                  type="text"
                  id="search-siswa"
                  oninput="filterSiswa(this.value)"
                  placeholder="Ketik nama / no. absen siswa..."
                  class="w-full h-10 pl-9 pr-3.5 bg-brand-50/50 border border-brand-100 rounded-xl text-xs sm:text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-all disabled:bg-gray-100 disabled:cursor-not-allowed">
                <svg class="w-4 h-4 text-brand-600 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </div>
            </div>

            <div id="list-siswa-container" class="flex flex-col gap-2 max-h-60 overflow-y-auto pr-1"></div>

            <div id="hidden-inputs-container"></div>
          </div>
        </div>

        <button type="submit" class="w-full h-12 mt-2 bg-[#5C4033] hover:bg-[#3E2B22] text-white font-poppins font-semibold text-sm rounded-xl flex items-center justify-center shadow-md active:scale-[0.99] transition-all">
          Simpan Jurnal
        </button>

      </form>

      @endif

    </main>
  </div>

  <!-- Bottom Navigation (Mobile) -->
  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-3.5 px-6 z-50 shadow-[0_-4px_25px_rgba(0,0,0,0.06)]">
    <div class="flex justify-between items-center">
      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z" />
        </svg>
        <span>Beranda</span>
      </a>

      <a href="{{ url('/form-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
          <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z" />
          <path d="M7 3v14" />
        </svg>
        <span>Isi Jurnal</span>
      </a>

      <a href="{{ url('/riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 4h14M3 8h14M3 12h10M3 16h6" />
        </svg>
        <span>Riwayat</span>
      </a>

      <a href="{{ url('/profil-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17" />
          <circle cx="10" cy="6.5" r="3.5" />
        </svg>
        <span>Profil</span>
      </a>
    </div>
  </nav>

  @if ($jadwalAktif)
  <script>
    // Daftar siswa asli dari database (kelas jadwal ini)
    const daftarSiswa = @json($siswaJs);
    let searchKeyword = '';

    function filterSiswa(val) {
      searchKeyword = val.toLowerCase();
      renderListSiswa();
    }

    function setStatusSiswa(key, newStatus) {
      const target = daftarSiswa.find(s => s.key === key);
      if (target) {
        // klik status yang sama lagi = kembali ke Hadir
        target.status = (target.status === newStatus) ? 'Hadir' : newStatus;
      }
      renderListSiswa();
      renderHiddenInputs();
      updateRingkasanJumlah();
    }

    function renderListSiswa() {
      const container = document.getElementById('list-siswa-container');
      container.innerHTML = '';

      const filtered = daftarSiswa.filter(s =>
        s.nama.toLowerCase().includes(searchKeyword) || s.absen.includes(searchKeyword)
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
        const isIzin = siswa.status === 'Izin';
        const isAlpha = siswa.status === 'Alpha';

        const row = document.createElement('div');
        row.className = 'flex items-center justify-between p-2.5 bg-brand-50/60 border border-brand-100 rounded-xl text-xs sm:text-sm';
        row.innerHTML = `
          <div class="flex items-center gap-2.5 overflow-hidden">
            <span class="w-6 h-6 rounded-full bg-brand-100 text-brand-800 font-bold text-xs flex items-center justify-center shrink-0">${siswa.absen}</span>
            <span class="nama-siswa font-semibold text-[#3E3028] truncate"></span>
          </div>
          <div class="flex items-center gap-1 shrink-0">
            <button type="button" data-status="Sakit"
              class="w-7 h-7 rounded-lg font-bold text-xs transition-all ${isSakit ? 'bg-amber-500 text-white shadow-xs scale-105' : 'bg-white text-amber-700 border border-amber-200 hover:bg-amber-50'}">S</button>
            <button type="button" data-status="Izin"
              class="w-7 h-7 rounded-lg font-bold text-xs transition-all ${isIzin ? 'bg-blue-500 text-white shadow-xs scale-105' : 'bg-white text-blue-700 border border-blue-200 hover:bg-blue-50'}">I</button>
            <button type="button" data-status="Alpha"
              class="w-7 h-7 rounded-lg font-bold text-xs transition-all ${isAlpha ? 'bg-rose-500 text-white shadow-xs scale-105' : 'bg-white text-rose-700 border border-rose-200 hover:bg-rose-50'}">A</button>
          </div>
        `;

        // nama diisi lewat textContent supaya aman dari tanda kutip / karakter khusus
        row.querySelector('.nama-siswa').textContent = siswa.nama;
        row.querySelectorAll('button[data-status]').forEach(btn => {
          btn.addEventListener('click', () => setStatusSiswa(siswa.key, btn.dataset.status));
        });

        container.appendChild(row);
      });
    }

    function updateRingkasanJumlah() {
      const tidakHadir = daftarSiswa.filter(s => s.status !== 'Hadir').length;
      document.getElementById('jumlah_absen').value = tidakHadir;
      document.getElementById('jumlah_hadir').value = daftarSiswa.length - tidakHadir;
    }

    // Input tersembunyi yang dibaca controller: siswa_absen[i][nama] & siswa_absen[i][status]
    function renderHiddenInputs() {
      const box = document.getElementById('hidden-inputs-container');
      box.innerHTML = '';

      daftarSiswa.filter(s => s.status !== 'Hadir').forEach((s, i) => {
        const nama = document.createElement('input');
        nama.type = 'hidden';
        nama.name = `siswa_absen[${i}][nama]`;
        nama.value = s.nama;

        const status = document.createElement('input');
        status.type = 'hidden';
        status.name = `siswa_absen[${i}][status]`;
        status.value = s.status;

        box.appendChild(nama);
        box.appendChild(status);
      });
    }

    renderListSiswa();
    updateRingkasanJumlah();
    renderHiddenInputs();
  </script>
  @endif

</body>

</html>