<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Jam Pelajaran</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, #sidebar nav { scrollbar-width: none; }
        html::-webkit-scrollbar, #sidebar nav::-webkit-scrollbar { display: none; }
    </style>
</head>

<body class="min-h-screen overflow-x-hidden bg-[#F5EFE8] font-['Inter'] text-[#3E3028]">

    {{-- OVERLAY MOBILE --}}
    <div
        id="sidebarOverlay"
        class="fixed inset-0 z-40 hidden bg-black/40 md:hidden"
        onclick="closeSidebar()"
    ></div>


    {{-- SIDEBAR --}}
    @include('admin.partials.tambah_sidebar')


    {{-- MAIN --}}
    <main class="min-h-screen md:ml-[280px]">

        {{-- HEADER --}}
        <header class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 text-white shadow-sm sm:px-6 md:px-7">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-medium text-[#D7B899]">
                        Atur waktu pembelajaran
                    </p>

                    <h1 class="mt-0.5 font-['Poppins'] text-xl font-bold md:text-2xl">
                        Jam Pelajaran
                    </h1>
                </div>

                <button
                    type="button"
                    onclick="openSidebar()"
                    class="flex h-10 w-10 items-center justify-center rounded-lg text-2xl text-white hover:bg-white/10 md:hidden"
                    aria-label="Buka menu"
                >
                    ☰
                </button>

            </div>

        </header>


        {{-- CONTENT --}}
        <section class="p-4 sm:p-6 md:p-7">

            <div class="w-full space-y-4">


                {{-- ================================================= --}}
                {{-- JUDUL HALAMAN --}}
                {{-- ================================================= --}}

                {{-- ================================================= --}}
                {{-- ERROR --}}
                {{-- ================================================= --}}

                @if ($errors->any())

                    <div class="rounded-lg border border-[#F0B8B8] bg-[#FFEBEE] px-4 py-3">

                        <p class="mb-2 text-sm font-semibold text-[#C62828]">
                            Terdapat kesalahan:
                        </p>

                        <ul class="list-inside list-disc space-y-1 text-sm text-[#C62828]">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- ================================================= --}}
                {{-- SUCCESS --}}
                {{-- ================================================= --}}

                @if (session('success'))

                    <div class="rounded-lg border border-[#B7DDBB] bg-[#E8F5E9] px-4 py-3 text-sm font-semibold text-[#2E7D32]">

                        {{ session('success') }}

                    </div>

                @endif


                {{-- ================================================= --}}
                {{-- SEMESTER --}}
                {{-- ================================================= --}}

                @if (empty($semesterAktif))

                    <div class="rounded-lg border border-[#F0B8B8] bg-white p-5">

                        <div class="flex gap-3">

                            <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#FFEBEE] text-[#C62828]">
                                !
                            </div>

                            <div>

                                <h3 class="font-['Poppins'] text-base font-bold text-[#C62828]">
                                    Semester aktif belum tersedia
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-[#7A6A60]">
                                    Buat semester aktif terlebih dahulu sebelum menambahkan jam pelajaran.
                                </p>

                            </div>

                        </div>

                    </div>

                @else


                    {{-- PENGATURAN KEGIATAN RUTIN --}}
                    <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                        <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6">
                            <h3 class="font-['Poppins'] text-base font-bold text-[#3E3028]">Pengaturan Kegiatan Pagi</h3>
                            <p class="mt-1 text-xs leading-5 text-[#7A6A60]">Aktifkan saat kegiatan ditiadakan. Jadwal guru di hari itu otomatis maju satu jam.</p>
                        </div>
                        @php($seninMaju = (bool) ($pengaturanKegiatan['Senin'] ?? false))
                        @php($jumatMaju = (bool) ($pengaturanKegiatan['Jumat'] ?? false))
                        <div class="grid gap-4 p-5 lg:grid-cols-[minmax(0,1fr)_minmax(280px,.8fr)] sm:p-6">
                            <form method="POST" action="{{ route('jam-pelajaran.kegiatan.update') }}" class="flex items-center justify-between gap-4 rounded-xl border border-[#E5D8CC] bg-[#FFFCF9] p-4">
                                @csrf @method('PATCH')
                                <input type="hidden" name="hari" value="Senin">
                                <input type="hidden" name="gabungan" value="1">
                                <input type="hidden" name="kegiatan_ditiadakan" value="{{ ($seninMaju && $jumatMaju) ? 0 : 1 }}">
                                <div class="min-w-0"><p class="text-sm font-bold text-[#3E3028]">Jam pelajaran maju · Senin dan Jumat</p><p class="mt-1 text-xs text-[#7A6A60]">{{ $seninMaju && $jumatMaju ? 'ON · jam ke-2 dimulai pada waktu jam ke-1' : 'OFF · jam mengikuti jadwal normal' }}</p><p class="mt-1 text-[11px] text-[#8C7B70]">ON menggeser jadwal satu slot lebih awal ketika apel Senin atau kegiatan Jumat ditiadakan.</p></div>
                                <button type="submit" role="switch" aria-checked="{{ $seninMaju && $jumatMaju ? 'true' : 'false' }}" class="relative h-7 w-12 shrink-0 rounded-full transition {{ $seninMaju && $jumatMaju ? 'bg-[#A16207]' : 'bg-[#C9BDB4]' }}"><span class="absolute top-1 h-5 w-5 rounded-full bg-white shadow transition {{ $seninMaju && $jumatMaju ? 'left-6' : 'left-1' }}"></span></button>
                            </form>
                            <div id="kegiatanTanggal" class="rounded-xl border border-[#E5D8CC] bg-white p-4"><h4 class="text-sm font-bold text-[#3E3028]">Kegiatan khusus</h4><p class="mt-1 text-xs leading-5 text-[#7A6A60]">Atur tanggal tertentu yang tidak ada pelajaran. Saat ON, jadwal pelajaran pada tanggal itu dimatikan.</p>
                                <form method="POST" action="{{ route('jam-pelajaran.kegiatan-tanggal.store') }}" class="mt-3 grid gap-2 sm:grid-cols-[1fr_1fr_auto] sm:items-end">@csrf
                                    <label class="flex min-w-0 flex-col gap-1 text-[11px] font-semibold text-[#7A6A60]">Nama kegiatan<input name="nama_kegiatan" required maxlength="120" value="{{ old('nama_kegiatan') }}" placeholder="Contoh: Maulid Nabi" class="h-9 rounded-lg border border-[#E5D8CC] px-2.5 text-xs text-[#3E3028]"></label>
                                    <label class="flex min-w-0 flex-col gap-1 text-[11px] font-semibold text-[#7A6A60]">Tanggal<input type="date" name="tanggal" required value="{{ old('tanggal') }}" class="h-9 rounded-lg border border-[#E5D8CC] px-2.5 text-xs text-[#3E3028]"></label>
                                    <button class="h-9 rounded-lg bg-[#5C4033] px-3 text-xs font-semibold text-white">Tambah · ON</button>
                                </form>
                                @error('tanggal')<p class="mt-2 text-xs font-medium text-red-700">{{ $message }}</p>@enderror
                                @error('nama_kegiatan')<p class="mt-2 text-xs font-medium text-red-700">{{ $message }}</p>@enderror
                                <div class="mt-3 max-h-56 divide-y divide-[#E5D8CC] overflow-y-auto rounded-lg border border-[#E5D8CC]">
                                    @forelse(($kegiatanTanggal ?? collect()) as $kegiatan)
                                        @php($ditiadakan = (bool) $kegiatan->kegiatan_ditiadakan)
                                        <div class="flex flex-col gap-2 p-3 sm:flex-row sm:items-center sm:justify-between"><div class="min-w-0"><p class="truncate text-xs font-bold text-[#3E3028]">{{ $kegiatan->nama_kegiatan }}</p><p class="mt-1 text-[11px] text-[#7A6A60]">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d/m/Y') }} · {{ $ditiadakan ? 'Jadwal dimatikan' : 'Jadwal normal' }}</p></div>
                                            <div class="flex shrink-0 items-center gap-2"><form method="POST" action="{{ route('jam-pelajaran.kegiatan-tanggal.toggle', $kegiatan->id) }}">@csrf @method('PATCH')<button role="switch" aria-checked="{{ $ditiadakan ? 'true' : 'false' }}" class="relative h-6 w-10 rounded-full transition {{ $ditiadakan ? 'bg-[#A16207]' : 'bg-[#C9BDB4]' }}"><span class="absolute top-1 h-4 w-4 rounded-full bg-white shadow {{ $ditiadakan ? 'left-5' : 'left-1' }}"></span></button><span class="ml-1 text-[11px] font-semibold">{{ $ditiadakan ? 'ON' : 'OFF' }}</span></form>
                                                <form method="POST" action="{{ route('jam-pelajaran.kegiatan-tanggal.destroy', $kegiatan->id) }}" onsubmit="return confirm('Hapus pengaturan kegiatan ini?')">@csrf @method('DELETE')<button class="rounded-lg border border-[#E5D8CC] px-2.5 py-1.5 text-[11px] font-semibold text-[#7A6A60]">Hapus</button></form></div>
                                        </div>
                                    @empty<p class="p-3 text-xs text-[#7A6A60]">Belum ada event yang diatur.</p>@endforelse
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="mt-4 overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                        <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6"><h3 class="font-['Poppins'] text-base font-bold">Pengaturan Pulang Cepat</h3><p class="mt-1 text-xs leading-5 text-[#7A6A60]">Pilih jam mulai pulang cepat. Sesi pada jam tersebut dan setelahnya akan ditandai pulang cepat di akun guru dan kelas.</p></div>
                        <div class="divide-y divide-[#F0E7DF]">
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $hariPulangCepat)
                                @php($aturanPc = $pengaturanPulangCepat[$hariPulangCepat] ?? null)
                                <form method="POST" action="{{ route('jam-pelajaran.pulang-cepat.update') }}" class="flex flex-wrap items-center justify-between gap-3 px-5 py-3 sm:px-6">@csrf @method('PATCH')<input type="hidden" name="hari" value="{{ $hariPulangCepat }}"><input type="hidden" name="aktif" value="0"><label class="flex items-center gap-3"><input type="checkbox" name="aktif" value="1" @checked($aturanPc?->aktif) class="h-5 w-5 accent-[#A16207]"><span class="text-sm font-bold">{{ $hariPulangCepat }} · Pulang cepat aktif</span></label><label class="flex items-center gap-2 text-xs font-semibold text-[#7A6A60]">Mulai jam ke<select name="jam_ke" class="rounded-lg border border-[#D8C9BC] bg-white px-3 py-2 text-sm text-[#3E3028]">@for($nomor=1;$nomor<=13;$nomor++)<option value="{{ $nomor }}" @selected((int)($aturanPc?->jam_ke ?? 1) === $nomor)>{{ $nomor }}</option>@endfor</select></label><button class="rounded-lg bg-[#5C4033] px-4 py-2 text-xs font-semibold text-white">Simpan</button></form>
                            @endforeach
                        </div>
                    </article>

                    {{-- ================================================= --}}
                    {{-- GENERATE OTOMATIS --}}
                    {{-- ================================================= --}}

                    <div class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">

                        {{-- CARD HEADER --}}
                        <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6">

                            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                                <div>

                                    <h3 class="font-['Poppins'] text-base font-bold text-[#3E3028]">
                                        Generate Otomatis
                                    </h3>

                                    <p class="mt-1 text-xs leading-5 text-[#7A6A60]">
                                        Buat beberapa jam pelajaran sekaligus.
                                    </p>

                                </div>

                                <span class="w-fit rounded-md bg-[#F5EFE8] px-2.5 py-1 text-[11px] font-semibold text-[#5C4033]">
                                    Otomatis
                                </span>

                            </div>

                        </div>


                        {{-- FORM --}}
                        <form
                            method="POST"
                            action="{{ route('jam-pelajaran.generate') }}"
                            class="p-5 sm:p-6"
                        >

                            @csrf

                            <input
                                type="hidden"
                                name="id_semester"
                                value="{{ $semesterAktif->id_semester }}"
                            >


                            <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">


                                {{-- TINGKAT --}}
                                <label class="flex flex-col gap-2">

                                    <span class="text-sm font-semibold text-[#3E3028]">
                                        Tingkat
                                    </span>

                                    <select name="tingkat[]" id="tingkatGenerate" multiple required class="h-[116px] w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 py-2 text-sm text-[#3E3028] outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
                                        <option value="10">Kelas 10</option>
                                        <option value="11">Kelas 11</option>
                                        <option value="12">Kelas 12</option>
                                    </select>
                                    <span class="text-[11px] leading-4 text-[#A08978]">Gunakan Ctrl + klik untuk memilih beberapa tingkat.</span>

                                </label>


                                {{-- HARI --}}
                                <label class="flex flex-col gap-2">

                                    <span class="text-sm font-semibold text-[#3E3028]">
                                        Hari
                                    </span>

                                    <select name="hari[]" id="hariGenerate" multiple required class="h-[148px] w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 py-2 text-sm text-[#3E3028] outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu" data-weekend hidden disabled>Sabtu · uji XI</option>
                                        <option value="Minggu" data-weekend hidden disabled>Minggu · uji XI</option>
                                    </select>
                                    <span class="text-[11px] leading-4 text-[#A08978]">Sabtu dan Minggu hanya aktif jika tingkat XI dipilih sendiri.</span>


                                </label>


                                {{-- MULAI JAM --}}
                                <label class="flex flex-col gap-2">

                                    <span class="text-sm font-semibold text-[#3E3028]">
                                        Mulai dari Jam ke-
                                    </span>

                                    <input
                                        type="number"
                                        name="jam_ke_mulai"
                                        value="1"
                                        min="1"
                                        required
                                        class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"
                                    >

                                </label>


                                {{-- JAM MULAI --}}
                                <label class="flex flex-col gap-2">

                                    <span class="text-sm font-semibold text-[#3E3028]">
                                        Jam Mulai
                                    </span>

                                    <input
                                        type="time"
                                        name="jam_mulai"
                                        required
                                        class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"
                                    >

                                </label>


                                {{-- DURASI --}}
                                <label class="flex flex-col gap-2">

                                    <span class="text-sm font-semibold text-[#3E3028]">
                                        Durasi per Jam
                                    </span>

                                    <div class="relative">

                                        <input
                                            type="number"
                                            name="durasi_menit"
                                            min="1"
                                            required
                                            class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 pr-16 text-sm outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"
                                        >

                                        <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs text-[#7A6A60]">
                                            menit
                                        </span>

                                    </div>

                                </label>


                                {{-- JUMLAH JAM --}}
                                <label class="flex flex-col gap-2">

                                    <span class="text-sm font-semibold text-[#3E3028]">
                                        Jumlah Jam Pelajaran
                                    </span>

                                    <input
                                        type="number"
                                        name="jumlah_jam"
                                        min="1"
                                        required
                                        class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"
                                    >

                                </label>

                            </div>


                            {{-- BUTTON --}}
                            <div class="mt-6 flex justify-end border-t border-[#E5D8CC] pt-5">

                                <button
                                    type="submit"
                                    class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#452F26]"
                                >
                                    Generate Jam
                                </button>

                            </div>

                        </form>

                    </div>



                    {{-- ================================================= --}}
                    {{-- TAMBAH MANUAL --}}
                    {{-- ================================================= --}}

                    <div class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">

                        {{-- HEADER --}}
                        <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6">

                            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                                <div>

                                    <h3 class="font-['Poppins'] text-base font-bold text-[#3E3028]">
                                        Tambah Manual
                                    </h3>

                                    <p class="mt-1 text-xs leading-5 text-[#7A6A60]">
                                        Tambahkan satu jam pelajaran secara manual.
                                    </p>

                                </div>

                                <span class="w-fit rounded-md bg-[#F5EFE8] px-2.5 py-1 text-[11px] font-semibold text-[#5C4033]">
                                    Manual
                                </span>

                            </div>

                        </div>


                        {{-- FORM --}}
                        <form
                            method="POST"
                            action="{{ route('jam-pelajaran.store') }}"
                            class="p-5 sm:p-6"
                        >

                            @csrf

                            <input
                                type="hidden"
                                name="id_semester"
                                value="{{ $semesterAktif->id_semester }}"
                            >


                            <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">


                                {{-- TINGKAT --}}
                                <label class="flex flex-col gap-2">

                                    <span class="text-sm font-semibold text-[#3E3028]">
                                        Tingkat
                                    </span>

                                    <select
                                        id="tingkatManual"
                                        name="tingkat"
                                        required
                                        class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"
                                    >

                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>

                                    </select>

                                </label>


                                {{-- HARI --}}
                                <label class="flex flex-col gap-2">

                                    <span class="text-sm font-semibold text-[#3E3028]">
                                        Hari
                                    </span>

                                    <select name="hari" id="hariManual" required class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm text-[#3E3028] outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu" data-weekend hidden disabled>Sabtu · uji XI</option>
                                        <option value="Minggu" data-weekend hidden disabled>Minggu · uji XI</option>
                                    </select>

                                </label>


                                {{-- JAM KE --}}
                                <label class="flex flex-col gap-2">

                                    <span class="text-sm font-semibold text-[#3E3028]">
                                        Jam ke-
                                    </span>

                                    <input
                                        type="number"
                                        name="jam_ke"
                                        min="1"
                                        required
                                        class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"
                                    >

                                </label>


                                {{-- JAM MULAI --}}
                                <label class="flex flex-col gap-2">

                                    <span class="text-sm font-semibold text-[#3E3028]">
                                        Jam Mulai
                                    </span>

                                    <input
                                        type="time"
                                        name="jam_mulai"
                                        required
                                        class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"
                                    >

                                </label>


                                {{-- JAM SELESAI --}}
                                <label class="flex flex-col gap-2 lg:col-span-2">

                                    <span class="text-sm font-semibold text-[#3E3028]">
                                        Jam Selesai
                                    </span>

                                    <input
                                        type="time"
                                        name="jam_selesai"
                                        required
                                        class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none transition focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10 lg:max-w-[calc(50%-12px)]"
                                    >

                                </label>

                            </div>


                            {{-- BUTTON --}}
                            <div class="mt-6 flex justify-end border-t border-[#E5D8CC] pt-5">

                                <button
                                    type="submit"
                                    class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#452F26]"
                                >
                                    Simpan Jam
                                </button>

                            </div>

                        </form>

                    </div>


                @endif



                {{-- ================================================= --}}
                {{-- DAFTAR JAM PELAJARAN --}}
                {{-- ================================================= --}}

                <div class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">

                    {{-- HEADER --}}
                    <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6">

                        <h3 class="font-['Poppins'] text-base font-bold text-[#3E3028]">
                            Daftar Jam Pelajaran
                        </h3>

                        <p class="mt-1 text-xs leading-5 text-[#7A6A60]">
                            Daftar waktu pembelajaran yang sudah dibuat.
                        </p>

                    </div>


                    {{-- PENCARIAN DAN TABLE --}}
                    <div class="border-b border-[#E5D8CC] p-4 sm:p-5">
                        <label class="relative block w-full sm:max-w-sm">
                            <span class="sr-only">Cari jam pelajaran</span>
                            <input id="cariJamPelajaran" type="search" oninput="filterJamPelajaran()" placeholder="Cari semester, tingkat, hari, atau jam..." class="h-10 w-full rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm outline-none focus:border-[#5C4033]">
                        </label>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[850px] border-collapse text-left text-sm">
                            <thead class="bg-[#F5EFE8]">
                                <tr>
                                    <th class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">No</th>
                                    <th class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">Semester</th>
                                    <th class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">Tingkat</th>
                                    <th class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">Hari</th>
                                    <th class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">Jam Ke</th>
                                    <th class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">Mulai</th>
                                    <th class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">Selesai</th>
                                    <th class="border-b border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">Hapus</th>
                                </tr>
                            </thead>
                            <tbody id="jamPelajaranTableBody">
                                @forelse ($jamGrup ?? [] as $i => $j)
                                    <tr class="jam-pelajaran-row transition hover:bg-[#FFFCF9]" data-cari="{{ strtolower('semester '.($j->semester->nama ?? '-').' tingkat '.$j->tingkat_cari.' hari '.$j->hari.' jam ke '.$j->jam_ke.' mulai '.$j->jam_mulai.' selesai '.$j->jam_selesai) }}">
                                        <td class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[#7A6A60]">{{ $i + 1 }}</td>
                                        <td class="border-b border-r border-[#E5D8CC] px-4 py-3 font-medium text-[#3E3028]">{{ $j->semester->nama ?? '-' }}</td>
                                        <td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ $j->tingkat }}</td>
                                        <td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ $j->hari }}</td>
                                        <td class="border-b border-r border-[#E5D8CC] px-4 py-3 whitespace-nowrap">Jam ke-{{ $j->jam_ke }}</td>
                                        <td class="border-b border-r border-[#E5D8CC] px-4 py-3 whitespace-nowrap">{{ $j->jam_mulai }}</td>
                                        <td class="border-b border-r border-[#E5D8CC] px-4 py-3 whitespace-nowrap">{{ $j->jam_selesai }}</td>
                                        <td class="border-b border-[#E5D8CC] px-4 py-3">
                                            <form method="POST" action="{{ route('jam-pelajaran.destroy', $j->id_jam) }}" onsubmit="return confirm('Hapus jam pelajaran ini? Jadwal yang memakai jam ini juga akan terhapus.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-lg border border-[#F0B8B8] px-3 py-1.5 text-xs font-semibold text-[#C62828] hover:bg-[#FFEBEE]">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8" class="px-4 py-10 text-center text-sm text-[#7A6A60]">Belum ada jam pelajaran.</td></tr>
                                @endforelse
                                <tr id="jamPelajaranTidakDitemukan" class="hidden"><td colspan="8" class="px-4 py-8 text-center text-sm text-[#7A6A60]">Jam pelajaran tidak ditemukan.</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

        </section>

    </main>


    {{-- SCRIPT --}}
    <script>

        function openSidebar() {

            document
                .getElementById('sidebar')
                .classList
                .remove('-translate-x-full');

            document
                .getElementById('sidebarOverlay')
                .classList
                .remove('hidden');

        }


        function closeSidebar() {

            document
                .getElementById('sidebar')
                .classList
                .add('-translate-x-full');

            document
                .getElementById('sidebarOverlay')
                .classList
                .add('hidden');

        }

        function aturHariAkhirPekan(levelSelectId, daySelectId) {
            const level = document.getElementById(levelSelectId);
            const hari = document.getElementById(daySelectId);
            if (!level || !hari) return;
            const update = () => {
                const terpilih = [...level.selectedOptions].map(option => option.value);
                const bolehWeekend = terpilih.length === 1 && terpilih[0] === '11';
                hari.querySelectorAll('[data-weekend]').forEach(option => {
                    option.hidden = !bolehWeekend;
                    option.disabled = !bolehWeekend;
                    if (!bolehWeekend) option.selected = false;
                });
            };
            level.addEventListener('change', update);
            update();
        }
        aturHariAkhirPekan('tingkatManual', 'hariManual');
        aturHariAkhirPekan('tingkatGenerate', 'hariGenerate');

        function filterJamPelajaran() {
            const query = document.getElementById('cariJamPelajaran').value.trim().toLowerCase();
            const rows = Array.from(document.querySelectorAll('.jam-pelajaran-row'));
            let visible = 0;

            rows.forEach(row => {
                const cocok = window.matchesAllSearchTerms(query, row.dataset.cari, row.textContent, 'tingkat ' + row.cells[2]?.textContent);
                row.classList.toggle('hidden', !cocok);
                if (cocok) visible++;
            });

            document.getElementById('jamPelajaranTidakDitemukan').classList.toggle('hidden', rows.length === 0 || visible > 0);
        }

    </script>

    @include('shared.preserve_search_scroll')
</body>

</html>
