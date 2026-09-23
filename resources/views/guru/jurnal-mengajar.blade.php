<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Jurnal Mengajar - Piket</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap"
        rel="stylesheet">

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

  <style>
    html {
      scrollbar-width: none;
    }

    html::-webkit-scrollbar {
      display: none;
    }

    details > summary {
      list-style: none;
    }

    details > summary::-webkit-details-marker {
      display: none;
    }

    details[open] > summary .chev {
      transform: rotate(180deg);
    }

    dialog::backdrop {
      background: rgba(62,43,34,0.35);
    }

    .kelas-card.is-hidden {
      display: none;
    }

    .guru-sidebar-nav a {
      gap: .75rem !important;
      padding: .625rem .75rem !important;
      border-radius: .5rem !important;
      font-size: 1rem !important;
      color: #7A6A60 !important;
    }

    .guru-sidebar-nav a svg {
      color: #7A6A60 !important;
    }

    .guru-sidebar-nav a.bg-\[\#F5EFE8\] {
      color: #5C4033 !important;
    }

    .guru-sidebar-nav a.bg-\[\#F5EFE8\] svg {
      color: #3E3028 !important;
    }

    .guru-sidebar > div:first-child {
      padding: 1.5rem 1rem !important;
      gap: 2rem !important;
    }
  </style>
</head>

<body class="bg-brand-50 font-sans min-h-screen flex text-[#3E3028]">

  {{--
    VARIABEL DARI CONTROLLER (masih dummy di bawah):

    - $isPiketHariIni : bool
    - $guruPiketId    : id guru yang login sebagai piket
    - $daftarJurnal   : 1 ITEM = 1 KIRIMAN JURNAL DARI 1 KELAS (bukan per jam),
        berisi array 'sesi' untuk tiap jam mengajar hari itu.
  --}}

  @php
    $isPiketHariIni = true;

    $guruPiketId = 12;

    $daftarJurnal = [

      [
        'id' => 101,
        'kelas' => 'X RPL 1',
        'tingkat' => 'X',
        'waktu_kirim' => '10:15',
        'status' => 'menunggu',
        'alasan_tolak' => null,

        'sesi' => [

          [
            'jam' => '1',
            'mapel' => 'Bahasa Jepang',
            'guru' => 'Sulistyowati, SS.',
            'guru_id' => 5,
            'hadir_guru' => false,
            'ada_tugas' => true,
            'materi' => 'Mengerjakan latihan Bahasa Jepang halaman 25',
            'jumlah_hadir' => null,
            'siswa' => []
          ],

          [
            'jam' => '2 - 4',
            'mapel' => 'PJOK',
            'guru' => 'Zainul Arifin, S.Pd.',
            'guru_id' => 12,
            'hadir_guru' => false,
            'ada_tugas' => false,
            'materi' => null,
            'jumlah_hadir' => null,
            'siswa' => []
          ],

          [
            'jam' => '5 - 8',
            'mapel' => 'Matematika',
            'guru' => 'Badrus Sulaiman, S.Pd., Gr.',
            'guru_id' => 8,
            'hadir_guru' => true,
            'ada_tugas' => false,
            'materi' => 'Persamaan dan Pertidaksamaan',
            'jumlah_hadir' => 32,

            'siswa' => [
              ['nama' => 'Rizki Pratama', 'ket' => 'D'],
              ['nama' => 'Nadia Putri', 'ket' => 'D'],
              ['nama' => 'Fajar Nugroho', 'ket' => 'D'],
              ['nama' => 'Andi Saputra', 'ket' => 'S'],
            ]
          ],

          [
            'jam' => '9 - 10',
            'mapel' => 'Bahasa Inggris',
            'guru' => 'Siti Aminah, S.Pd.',
            'guru_id' => 3,
            'hadir_guru' => true,
            'ada_tugas' => false,
            'materi' => 'Asking and Giving Opinion',
            'jumlah_hadir' => 35,

            'siswa' => [
              ['nama' => 'Nadia Putri', 'ket' => 'D'],
            ]
          ],

        ],
      ],

      [
        'id' => 102,
        'kelas' => 'X RPL 2',
        'tingkat' => 'X',
        'waktu_kirim' => '10:20',
        'status' => 'menunggu',
        'alasan_tolak' => null,

        'sesi' => [
          [
            'jam' => '1 - 2',
            'mapel' => 'Matematika',
            'guru' => 'Budi Santoso, S.Pd.',
            'guru_id' => 20,
            'hadir_guru' => true,
            'ada_tugas' => false,
            'materi' => 'Fungsi Kuadrat',
            'jumlah_hadir' => 34,
            'siswa' => []
          ],
        ],
      ],

      [
        'id' => 103,
        'kelas' => 'XI RPL 1',
        'tingkat' => 'XI',
        'waktu_kirim' => '09:40',
        'status' => 'disetujui',
        'alasan_tolak' => null,

        'sesi' => [
          [
            'jam' => '1 - 3',
            'mapel' => 'Produktif RPL',
            'guru' => 'Anton Wijaya, S.Kom.',
            'guru_id' => 15,
            'hadir_guru' => true,
            'ada_tugas' => false,
            'materi' => 'Praktik CRUD Laravel',
            'jumlah_hadir' => 30,
            'siswa' => []
          ],
        ],
      ],

      [
        'id' => 104,
        'kelas' => 'XII RPL 1',
        'tingkat' => 'XII',
        'waktu_kirim' => '08:05',
        'status' => 'ditolak',
        'alasan_tolak' => 'Jumlah hadir tidak sesuai presensi kelas, mohon dicek ulang.',

        'sesi' => [
          [
            'jam' => '1 - 4',
            'mapel' => 'Bahasa Inggris',
            'guru' => 'Siti Aminah, S.Pd.',
            'guru_id' => 3,
            'hadir_guru' => true,
            'ada_tugas' => false,
            'materi' => 'Report Text',
            'jumlah_hadir' => 35,
            'siswa' => []
          ],
        ],
      ],

    ];

    $daftarTingkat = ['X', 'XI', 'XII'];
  @endphp


  <!-- ========================================================= -->
  <!-- SIDEBAR -->
  <!-- ========================================================= -->

  <aside
    class="guru-sidebar w-64 bg-white border-r border-[#E5D8CC]
           min-h-screen flex flex-col justify-between shrink-0
           fixed left-0 top-0 bottom-0 z-40 hidden md:flex">

    <div class="py-6 px-4 flex flex-col gap-8">

      <!-- BRAND -->
      <div class="flex flex-col gap-0.5">

        <h2 class="font-poppins font-extrabold text-xl text-[#3E3028] tracking-tight">
          JURNAL GURU
        </h2>

        <span class="text-md font-medium text-[#7A6A60]">
          Akun Guru
        </span>

      </div>


      <!-- NAVIGATION -->
      <nav class="guru-sidebar-nav flex flex-col gap-1">

        <!-- BERANDA -->
        <a
          href="{{ url('/dashboard-guru') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                 font-medium text-md text-[#7A6A60]
                 hover:bg-[#F5EFE8] hover:text-[#5C4033]
                 transition-all">

          <svg
            class="w-5 h-5 text-brand-600"
            viewBox="0 0 20 20"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8">

            <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>

          </svg>

          <span>Beranda</span>

        </a>


        <!-- ISI JURNAL -->
        <a
          href="{{ route('jurnal.create') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                 font-medium text-md text-[#7A6A60]
                 hover:bg-[#F5EFE8] hover:text-[#5C4033]
                 transition-all">

          <svg
            class="w-5 h-5 text-brand-600"
            viewBox="0 0 20 20"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8">

            <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
            <path d="M7 3v14"/>

          </svg>

          <span>Isi Jurnal</span>

        </a>


        <!-- RIWAYAT JURNAL -->
        <a
          href="{{ url('/riwayat-jurnal') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                 font-medium text-md text-[#7A6A60]
                 hover:bg-[#F5EFE8] hover:text-[#5C4033]
                 transition-all">

          <svg
            class="w-5 h-5 text-brand-600"
            viewBox="0 0 20 20"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8">

            <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>

          </svg>

          <span>Riwayat Jurnal</span>

        </a>


        <!-- PIKET - AKTIF -->
        <a
          href="{{ route('dashboard-guru-piket') }}"
          class="flex items-center gap-3 px-3 py-2.5
                 bg-[#F5EFE8] rounded-lg
                 font-poppins font-bold text-md text-[#5C4033]
                 transition-all">

          <svg
            class="h-5 w-5 text-[#3E3028]"
            viewBox="0 0 20 20"
            fill="none"
            stroke="currentColor"
            stroke-width="2">

            <path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/>
            <path d="M7 10l2 2 4-4"/>

          </svg>

          <span>Piket</span>

        </a>


        <!-- PROFIL -->
        <a
          href="{{ url('/profil-guru') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                 font-medium text-md text-[#7A6A60]
                 hover:bg-[#F5EFE8] hover:text-[#5C4033]
                 transition-all">

          <svg
            class="w-5 h-5 text-brand-600"
            viewBox="0 0 20 20"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8">

            <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
            <circle cx="10" cy="6.5" r="3.5"/>

          </svg>

          <span>Profil</span>

        </a>

      </nav>

    </div>

  </aside>


  <!-- ========================================================= -->
  <!-- MAIN CONTENT -->
  <!-- ========================================================= -->

  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8 w-full min-w-0">


    <!-- HEADER -->

    <header
      class="sticky top-0 z-30 w-full bg-[#5C4033] shadow-md
             px-6 md:px-10 py-6
             flex flex-col md:flex-row
             justify-between items-start md:items-center
             gap-3">

      <div class="flex flex-col gap-1">

        <a
          href="{{ route('dashboard-guru-piket') }}"
          class="text-xs font-semibold text-[#D7B899]
                 hover:text-white flex items-center gap-1 mb-1">

          <svg
            class="w-3.5 h-3.5"
            viewBox="0 0 20 20"
            fill="none"
            stroke="currentColor"
            stroke-width="2">

            <path d="M12 15l-5-5 5-5"/>

          </svg>

          Kembali ke Piket

        </a>

        <h1
          class="font-poppins text-2xl sm:text-3xl
                 font-bold text-white tracking-tight">

          Jurnal Mengajar

        </h1>

        <span class="text-xs sm:text-sm text-[#D7B899]">
          {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
          • Review jurnal masuk per kelas
        </span>

      </div>

    </header>


    <!-- MAIN -->

    <main
      class="w-full px-6 md:px-10 py-8
             flex flex-col gap-6 flex-1">

      @if(!$isPiketHariIni)

        <div
          class="bg-white border border-rose-200 rounded-2xl
                 p-8 flex flex-col items-center
                 text-center gap-3">

          <div
            class="w-12 h-12 rounded-full bg-rose-50
                   text-rose-600 flex items-center justify-center">

            <svg
              class="w-6 h-6"
              viewBox="0 0 20 20"
              fill="none"
              stroke="currentColor"
              stroke-width="2">

              <circle cx="10" cy="10" r="7"/>
              <path d="M7 7l6 6M13 7l-6 6"/>

            </svg>

          </div>

          <h3 class="font-poppins font-bold text-lg">
            Akses Ditolak
          </h3>

          <p class="text-sm text-[#8C7B70] max-w-sm">
            Halaman ini hanya bisa diakses oleh guru yang sedang bertugas piket hari ini.
          </p>

        </div>

      @else


        <!-- FILTER TINGKAT KELAS -->

        <div
          id="filterBar"
          class="sticky z-20
                 -mx-6 px-6
                 md:-mx-10 md:px-10
                 bg-brand-50/95 backdrop-blur-sm
                 py-3 border-b border-brand-100
                 flex items-center gap-2
                 overflow-x-auto">

          @foreach($daftarTingkat as $t)

            <button
              type="button"
              data-tingkat="{{ $t }}"
              onclick="filterTingkat('{{ $t }}')"
              class="filter-btn px-5 py-2 rounded-full
                     text-sm font-semibold
                     bg-white border border-brand-100
                     text-[#7A6A60] whitespace-nowrap">

              Kelas {{ $t }}

            </button>

          @endforeach

        </div>


        <!-- DAFTAR KELAS -->

        <div
          class="flex flex-col gap-4"
          id="daftarKelas">

          @forelse($daftarJurnal as $j)

            @php

              $isMilikSendiri = in_array(
                $guruPiketId,
                array_column($j['sesi'], 'guru_id')
              );

              $badge = match($j['status']) {

                'menunggu' => [
                  'bg-amber-50 border-amber-200 text-amber-800',
                  'Menunggu Persetujuan'
                ],

                'disetujui' => [
                  'bg-emerald-50 border-emerald-200 text-emerald-800',
                  'Disetujui'
                ],

                'ditolak' => [
                  'bg-rose-50 border-rose-200 text-rose-800',
                  'Ditolak'
                ],

              };

            @endphp


            <div
              class="kelas-card bg-white border border-brand-100
                     rounded-2xl overflow-hidden"
              data-tingkat="{{ $j['tingkat'] }}"
              data-status="{{ $j['status'] }}"
              data-id="{{ $j['id'] }}">

              <details {{ $j['status'] === 'menunggu' ? 'open' : '' }}>

                <summary
                  class="cursor-pointer p-5
                         flex flex-col md:flex-row
                         md:items-center
                         gap-3 md:gap-6">

                  <div
                    class="flex items-center gap-3
                           md:w-44 shrink-0">

                    <div
                      class="w-11 h-11 rounded-xl
                             bg-brand-50 border border-brand-100
                             flex items-center justify-center
                             font-poppins font-bold
                             text-brand-800 text-xs shrink-0">

                      {{ $j['tingkat'] }}

                    </div>

                    <div class="flex flex-col">

                      <h4
                        class="font-poppins font-bold text-base
                               text-[#3E3028] leading-tight">

                        {{ $j['kelas'] }}

                      </h4>

                      <span class="text-xs text-[#8C7B70]">
                        {{ count($j['sesi']) }} sesi • kirim {{ $j['waktu_kirim'] }}
                      </span>

                    </div>

                  </div>


                  <div class="flex-1"></div>


                  <div class="flex items-center gap-2 flex-wrap">

                    <span
                      class="px-2.5 py-1 rounded-full
                             text-xs font-semibold border
                             {{ $badge[0] }}
                             whitespace-nowrap">

                      {{ $badge[1] }}

                    </span>

                  </div>


                  <svg
                    class="chev w-4 h-4 text-[#8C7B70]
                           shrink-0 transition-transform"
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2">

                    <path d="M5 7l5 5 5-5"/>

                  </svg>

                </summary>


                <div
                  class="px-5 pb-5 pt-1
                         border-t border-brand-50
                         flex flex-col gap-4">


                  <!-- TABEL REKAP JURNAL -->

                  <div
                    class="w-full max-w-full bg-white
                           border border-[#E5D8CC]
                           rounded-[10px]
                           shadow-[0_4px_12px_rgba(62,48,40,0.03)]
                           overflow-x-auto">

                    <table
                      class="min-w-[1150px] w-full
                             text-left border-collapse">

                      <thead>

                        <tr class="bg-[#F5EFE8]">

                          <th
                            rowspan="2"
                            class="px-4 py-3 text-[11px]
                                   font-semibold uppercase
                                   text-[#5C4033]
                                   whitespace-nowrap
                                   border-b border-r border-[#E5D8CC]
                                   align-middle">

                            Jam Ke-

                          </th>

                          <th
                            rowspan="2"
                            class="px-4 py-3 text-[11px]
                                   font-semibold uppercase
                                   text-[#5C4033]
                                   whitespace-nowrap
                                   border-b border-r border-[#E5D8CC]
                                   align-middle">

                            Nama Pengajar

                          </th>

                          <th
                            rowspan="2"
                            class="px-4 py-3 text-[11px]
                                   font-semibold uppercase
                                   text-[#5C4033]
                                   whitespace-nowrap
                                   border-b border-r border-[#E5D8CC]
                                   align-middle">

                            Mata Pelajaran

                          </th>

                          <th
                            rowspan="2"
                            class="px-4 py-3 text-[11px]
                                   font-semibold uppercase
                                   text-[#5C4033]
                                   whitespace-nowrap
                                   border-b border-r border-[#E5D8CC]
                                   text-center align-middle">

                            Hadir

                          </th>

                          <th
                            rowspan="2"
                            class="px-4 py-3 text-[11px]
                                   font-semibold uppercase
                                   text-[#5C4033]
                                   whitespace-nowrap
                                   border-b border-r border-[#E5D8CC]
                                   text-center align-middle">

                            Tidak Hadir
                            <br>
                            <span class="normal-case font-medium">
                              (Tugas)
                            </span>

                          </th>

                          <th
                            rowspan="2"
                            class="px-4 py-3 text-[11px]
                                   font-semibold uppercase
                                   text-[#5C4033]
                                   border-b border-r border-[#E5D8CC]
                                   min-w-[220px] align-middle">

                            Materi

                          </th>

                          <th
                            colspan="6"
                            class="px-4 py-2 text-[11px]
                                   font-semibold uppercase
                                   text-[#5C4033]
                                   text-center
                                   border-b border-r border-[#E5D8CC]">

                            Keadaan Siswa

                          </th>

                        </tr>


                        <tr class="bg-[#F5EFE8]">

                          <th
                            class="px-3 py-2.5 text-[11px]
                                   font-semibold uppercase
                                   text-[#5C4033]
                                   whitespace-nowrap
                                   border-b border-r border-[#E5D8CC]
                                   text-center">

                            Jumlah Hadir

                          </th>

                          <th
                            class="px-3 py-2.5 text-[11px]
                                   font-semibold uppercase
                                   text-[#5C4033]
                                   whitespace-nowrap
                                   border-b border-r border-[#E5D8CC]
                                   min-w-[150px]">

                            Nama Siswa

                          </th>

                          <th
                            class="px-2 py-2.5 text-[11px]
                                   font-semibold uppercase
                                   text-[#5C4033]
                                   border-b border-r border-[#E5D8CC]
                                   text-center w-9">

                            S

                          </th>

                          <th
                            class="px-2 py-2.5 text-[11px]
                                   font-semibold uppercase
                                   text-[#5C4033]
                                   border-b border-r border-[#E5D8CC]
                                   text-center w-9">

                            I

                          </th>

                          <th
                            class="px-2 py-2.5 text-[11px]
                                   font-semibold uppercase
                                   text-[#5C4033]
                                   border-b border-r border-[#E5D8CC]
                                   text-center w-9">

                            A

                          </th>

                          <th
                            class="px-2 py-2.5 text-[11px]
                                   font-semibold uppercase
                                   text-[#5C4033]
                                   border-b border-[#E5D8CC]
                                   text-center w-9">

                            D

                          </th>

                        </tr>

                      </thead>


                      <tbody>

                        @foreach($j['sesi'] as $s)

                          @php
                            $jumlahBaris = count($s['siswa']) > 0
                              ? count($s['siswa'])
                              : 1;
                          @endphp

                          @for($i = 0; $i < $jumlahBaris; $i++)

                            <tr
                              class="border-b border-[#E5D8CC]
                                     align-top
                                     {{ $s['guru_id'] === $guruPiketId
                                        ? 'bg-amber-50/50'
                                        : '' }}">

                              @if($i === 0)

                                <td
                                  rowspan="{{ $jumlahBaris }}"
                                  class="px-4 py-3 text-[13px]
                                         text-[#3E3028]
                                         whitespace-nowrap
                                         border-r border-[#E5D8CC]
                                         align-top">

                                  {{ $s['jam'] }}

                                </td>


                                <td
                                  rowspan="{{ $jumlahBaris }}"
                                  class="px-4 py-3 text-[13px]
                                         text-[#3E3028]
                                         whitespace-nowrap
                                         border-r border-[#E5D8CC]
                                         align-top">

                                  {{ $s['guru'] }}

                                  @if($s['guru_id'] === $guruPiketId)

                                    <span
                                      class="block text-[10px]
                                             font-semibold text-amber-700">

                                      (Anda)

                                    </span>

                                  @endif

                                </td>


                                <td
                                  rowspan="{{ $jumlahBaris }}"
                                  class="px-4 py-3 text-[13px]
                                         text-[#3E3028]
                                         whitespace-nowrap
                                         border-r border-[#E5D8CC]
                                         align-top">

                                  {{ $s['mapel'] }}

                                </td>


                                <td
                                  rowspan="{{ $jumlahBaris }}"
                                  class="px-4 py-3 text-center
                                         border-r border-[#E5D8CC]
                                         align-top">

                                  <span
                                    class="{{ $s['hadir_guru']
                                      ? 'text-[#2E7D32]'
                                      : 'text-[#C62828]' }}
                                      font-bold">

                                    {{ $s['hadir_guru'] ? '✓' : '✕' }}

                                  </span>

                                </td>


                                <td
                                  rowspan="{{ $jumlahBaris }}"
                                  class="px-4 py-3 text-center
                                         border-r border-[#E5D8CC]
                                         align-top">

                                  @if($s['hadir_guru'])

                                    <span class="text-[#C62828] font-bold">
                                      ✕
                                    </span>

                                  @else

                                    <span
                                      class="{{ $s['ada_tugas']
                                        ? 'text-[#2E7D32]'
                                        : 'text-[#7A6A60]' }}
                                        font-bold">

                                      {{ $s['ada_tugas'] ? '✓' : '-' }}

                                    </span>

                                  @endif

                                </td>


                                <td
                                  rowspan="{{ $jumlahBaris }}"
                                  class="px-4 py-3 text-[13px]
                                         text-[#3E3028]
                                         whitespace-normal
                                         break-words
                                         min-w-[220px]
                                         border-r border-[#E5D8CC]
                                         align-top">

                                  {{ $s['materi'] ?? '-' }}

                                </td>


                                <td
                                  rowspan="{{ $jumlahBaris }}"
                                  class="px-4 py-3 text-[13px]
                                         text-[#3E3028]
                                         text-center
                                         whitespace-nowrap
                                         border-r border-[#E5D8CC]
                                         align-top">

                                  {{ $s['jumlah_hadir'] ?? '-' }}

                                </td>

                              @endif


                              @if(count($s['siswa']))

                                <td
                                  class="px-4 py-2.5 text-[13px]
                                         text-[#3E3028]
                                         border-r border-[#E5D8CC]">

                                  {{ $s['siswa'][$i]['nama'] }}

                                </td>

                                <td
                                  class="px-2 py-2.5 text-center
                                         border-r border-[#E5D8CC]">

                                  {{ $s['siswa'][$i]['ket'] === 'S' ? '✓' : '' }}

                                </td>

                                <td
                                  class="px-2 py-2.5 text-center
                                         border-r border-[#E5D8CC]">

                                  {{ $s['siswa'][$i]['ket'] === 'I' ? '✓' : '' }}

                                </td>

                                <td
                                  class="px-2 py-2.5 text-center
                                         border-r border-[#E5D8CC]">

                                  {{ $s['siswa'][$i]['ket'] === 'A' ? '✓' : '' }}

                                </td>

                                <td class="px-2 py-2.5 text-center">

                                  {{ $s['siswa'][$i]['ket'] === 'D' ? '✓' : '' }}

                                </td>

                              @else

                                <td
                                  class="px-4 py-2.5 text-[13px]
                                         text-[#7A6A60]
                                         border-r border-[#E5D8CC]">

                                  -

                                </td>

                                <td
                                  class="px-2 py-2.5
                                         border-r border-[#E5D8CC]">
                                </td>

                                <td
                                  class="px-2 py-2.5
                                         border-r border-[#E5D8CC]">
                                </td>

                                <td
                                  class="px-2 py-2.5
                                         border-r border-[#E5D8CC]">
                                </td>

                                <td class="px-2 py-2.5">
                                </td>

                              @endif

                            </tr>

                          @endfor

                        @endforeach

                      </tbody>

                    </table>

                  </div>


                  @if($j['status'] === 'ditolak' && $j['alasan_tolak'])

                    <div
                      class="bg-rose-50 border border-rose-200
                             rounded-xl p-3 text-sm text-rose-800">

                      <span class="font-semibold">
                        Alasan penolakan:
                      </span>

                      {{ $j['alasan_tolak'] }}

                    </div>

                  @endif


                  @if($j['status'] === 'menunggu')

                    @if($isMilikSendiri)

                      <div
                        class="bg-brand-50 border border-brand-100
                               rounded-xl p-3 text-sm
                               text-[#7A6A60]
                               flex items-center gap-2">

                        <svg
                          class="w-4 h-4 shrink-0"
                          viewBox="0 0 20 20"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2">

                          <circle cx="10" cy="10" r="7"/>
                          <path d="M10 6v4M10 14h.01"/>

                        </svg>

                        Ada jam mengajar Anda di kelas ini — tidak bisa disetujui/ditolak oleh diri sendiri. Menunggu guru piket lain.

                      </div>

                    @else

                      <div class="flex items-center gap-3">

                        <button
                          type="button"
                          onclick="setujuiKelas({{ $j['id'] }})"
                          class="px-5 h-10 rounded-lg
                                 bg-emerald-600 hover:bg-emerald-700
                                 text-white text-sm font-semibold
                                 flex items-center gap-2">

                          <svg
                            class="w-4 h-4"
                            viewBox="0 0 20 20"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5">

                            <path d="M4 10l4 4 8-8"/>

                          </svg>

                          Setujui Jurnal Kelas Ini

                        </button>


                        <button
                          type="button"
                          onclick="bukaTolak({{ $j['id'] }})"
                          class="px-5 h-10 rounded-lg
                                 bg-white border border-rose-300
                                 hover:bg-rose-50
                                 text-rose-700 text-sm font-semibold
                                 flex items-center gap-2">

                          <svg
                            class="w-4 h-4"
                            viewBox="0 0 20 20"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5">

                            <path d="M6 6l8 8M14 6l-8 8"/>

                          </svg>

                          Tolak

                        </button>

                      </div>

                    @endif

                  @endif

                </div>

              </details>

            </div>

          @empty

            <div
              class="bg-white border border-brand-100
                     rounded-2xl p-10 text-center
                     text-sm text-[#8C7B70]">

              Belum ada kelas yang mengirim jurnal hari ini.

            </div>

          @endforelse

        </div>


        <div
          id="kosongMenunggu"
          class="hidden bg-white border border-brand-100
                 rounded-2xl p-10 text-center
                 text-sm text-[#8C7B70]">

          Semua jurnal pada tingkat ini sudah diproses. 🎉

        </div>

      @endif

    </main>

  </div>


  <!-- ========================================================= -->
  <!-- DIALOG ALASAN TOLAK -->
  <!-- ========================================================= -->

  <dialog
    id="dialogTolak"
    class="rounded-2xl p-0 w-full max-w-md
           border border-brand-100">

    <form
      id="formTolak"
      class="flex flex-col gap-4 p-6"
      onsubmit="return kirimTolak(event)">

      <h3 class="font-poppins font-bold text-lg text-[#3E3028]">
        Tolak Jurnal Kelas
      </h3>

      <p class="text-sm text-[#8C7B70]">
        Tuliskan alasan penolakan agar kelas bisa memperbaiki jurnalnya.
      </p>

      <textarea
        id="alasanTolak"
        name="alasan"
        required
        rows="3"
        placeholder="Contoh: Jumlah hadir tidak sesuai presensi kelas"
        class="w-full border border-brand-100
               rounded-xl p-3 text-sm
               focus:outline-none focus:ring-2
               focus:ring-brand-300"></textarea>

      <div class="flex justify-end gap-3 mt-1">

        <button
          type="button"
          onclick="document.getElementById('dialogTolak').close()"
          class="px-4 h-10 rounded-lg text-sm
                 font-semibold text-[#7A6A60]
                 hover:bg-brand-50">

          Batal

        </button>

        <button
          type="submit"
          class="px-5 h-10 rounded-lg
                 bg-rose-600 hover:bg-rose-700
                 text-white text-sm font-semibold">

          Kirim Penolakan

        </button>

      </div>

    </form>

  </dialog>


  <!-- ========================================================= -->
  <!-- BOTTOM NAV MOBILE -->
  <!-- ========================================================= -->

  <nav
    class="md:hidden fixed bottom-0 left-0 right-0
           bg-white border-t border-brand-100
           py-3.5 px-6 z-50
           shadow-[0_-4px_25px_rgba(0,0,0,0.06)]">

    <div class="flex justify-between items-center">

      <a
        href="{{ url('/dashboard-guru') }}"
        class="flex flex-col items-center gap-1
               text-xs font-medium text-[#9E8E83]">

        <svg
          class="w-5 h-5"
          viewBox="0 0 20 20"
          fill="none"
          stroke="currentColor"
          stroke-width="1.8">

          <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>

        </svg>

        <span>Beranda</span>

      </a>


      <a
        href="{{ route('jurnal.create') }}"
        class="flex flex-col items-center gap-1
               text-xs font-medium text-[#9E8E83]">

        <svg
          class="w-5 h-5"
          viewBox="0 0 20 20"
          fill="none"
          stroke="currentColor"
          stroke-width="1.8">

          <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
          <path d="M7 3v14"/>

        </svg>

        <span>Isi Jurnal</span>

      </a>


      <a
        href="{{ url('/riwayat-jurnal') }}"
        class="flex flex-col items-center gap-1
               text-xs font-medium text-[#9E8E83]">

        <svg
          class="w-5 h-5"
          viewBox="0 0 20 20"
          fill="none"
          stroke="currentColor"
          stroke-width="1.8">

          <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>

        </svg>

        <span>Riwayat</span>

      </a>


      <a
        href="{{ route('dashboard-guru-piket') }}"
        class="flex flex-col items-center gap-1
               text-xs font-bold text-brand-800">

        <svg
          class="h-5 w-5"
          viewBox="0 0 20 20"
          fill="none"
          stroke="currentColor"
          stroke-width="2.2">

          <path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/>
          <path d="M7 10l2 2 4-4"/>

        </svg>

        <span>Piket</span>

      </a>


      <a
        href="{{ url('/profil-guru') }}"
        class="flex flex-col items-center gap-1
               text-xs font-medium text-[#9E8E83]">

        <svg
          class="w-5 h-5"
          viewBox="0 0 20 20"
          fill="none"
          stroke="currentColor"
          stroke-width="1.8">

          <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
          <circle cx="10" cy="6.5" r="3.5"/>

        </svg>

        <span>Profil</span>

      </a>

    </div>

  </nav>


  <script>

    let tingkatAktif = '{{ $daftarTingkat[0] }}';

    let idYangDitolak = null;


    function posisikanFilterBar() {

      const header = document.querySelector('header');

      const bar = document.getElementById('filterBar');

      if (header && bar) {
        bar.style.top = header.offsetHeight + 'px';
      }

    }


    window.addEventListener('load', posisikanFilterBar);

    window.addEventListener('resize', posisikanFilterBar);


    function filterTingkat(t) {

      tingkatAktif = t;

      document.querySelectorAll('.filter-btn').forEach(btn => {

        const active = btn.dataset.tingkat === t;

        btn.className =
          'filter-btn px-5 py-2 rounded-full text-sm font-semibold whitespace-nowrap ' +
          (
            active
              ? 'bg-brand-800 text-white'
              : 'bg-white border border-brand-100 text-[#7A6A60]'
          );

      });

      terapkanFilter();

    }


    function terapkanFilter() {

      let terlihat = 0;

      document.querySelectorAll('.kelas-card').forEach(card => {

        const cocok =
          card.dataset.tingkat === tingkatAktif;

        card.classList.toggle(
          'is-hidden',
          !cocok
        );

        if (cocok) {
          terlihat++;
        }

      });

      document
        .getElementById('kosongMenunggu')
        .classList
        .toggle('hidden', terlihat > 0);

    }


    // TODO: sambungkan ke route backend (POST) saat integrasi, contoh:
    // fetch(`/piket/jurnal-mengajar/${id}/setujui`, {
    //   method: 'POST',
    //   headers: {...csrf}
    // })


    function setujuiKelas(id) {

      const card =
        document.querySelector(
          `.kelas-card[data-id="${id}"]`
        );

      if (!card) return;

      card.remove();

      terapkanFilter();

    }


    function bukaTolak(id) {

      idYangDitolak = id;

      document.getElementById('alasanTolak').value = '';

      document
        .getElementById('dialogTolak')
        .showModal();

    }


    function kirimTolak(e) {

      e.preventDefault();

      // TODO: sambungkan ke route backend (POST alasan) saat integrasi

      const card =
        document.querySelector(
          `.kelas-card[data-id="${idYangDitolak}"]`
        );

      if (card) {

        card.remove();

        terapkanFilter();

      }

      document
        .getElementById('dialogTolak')
        .close();

      return false;

    }


    document.addEventListener(
      'DOMContentLoaded',
      () => filterTingkat('{{ $daftarTingkat[0] }}')
    );

  </script>

</body>

</html>