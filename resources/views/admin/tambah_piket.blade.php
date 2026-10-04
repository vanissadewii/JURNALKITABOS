<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Piket - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>html,#piketTableViewport{scrollbar-width:none}html::-webkit-scrollbar,#piketTableViewport::-webkit-scrollbar{display:none}</style>
</head>
<body class="min-h-screen overflow-x-hidden bg-[#F5EFE8] font-['Inter'] text-[#3E3028]">
    <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-black/40 md:hidden" onclick="closeSidebar()"></div>
    @include('admin.partials.tambah_sidebar')
    <main class="min-h-screen md:ml-[280px]">
        <header class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 text-white shadow-sm sm:px-6 md:px-7"><div class="flex items-center justify-between gap-3"><div><p class="text-xs font-medium text-[#D7B899]">Pengaturan Petugas dan Jadwal</p><h1 class="font-['Poppins'] text-xl font-bold md:text-2xl">Tambah Piket</h1></div><button type="button" onclick="openSidebar()" class="rounded-lg px-3 py-2 text-white hover:bg-white/10 md:hidden" aria-label="Buka sidebar">☰</button></div></header>
        <section class="flex flex-col gap-5 p-4 sm:p-6 md:p-7">
            @if(session('success'))<div class="rounded-xl border border-[#B7DDBB] bg-[#E8F5E9] px-4 py-3 text-sm font-semibold text-[#2E7D32]">{{ session('success') }}</div>@endif
            @if($errors->any())<div class="rounded-xl border border-[#F0B8B8] bg-[#FFEBEE] px-4 py-3 text-sm text-[#C62828]"><p class="font-semibold">Periksa kembali data piket:</p><ul class="mt-2 list-inside list-disc space-y-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6"><h3 class="font-['Poppins'] text-base font-bold">Tambah Waka</h3><p class="mt-1 text-xs text-[#7A6A60]">Masukkan nama dan nomor WhatsApp. Kirim nama Waka yang sudah terdaftar untuk memperbarui nomornya.</p></div>
                <form method="POST" action="{{ route('admin.tambah.piket.waka') }}" class="flex flex-col gap-3 p-5 sm:flex-row sm:items-end sm:p-6">@csrf<label class="flex flex-1 flex-col gap-2"><span class="text-sm font-semibold">Nama Waka</span><input name="nama" maxlength="100" value="{{ old('nama') }}" placeholder="Masukkan nama Waka" required class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"></label><label class="flex flex-1 flex-col gap-2"><span class="text-sm font-semibold">Nomor HP / WhatsApp</span><input name="no_hp" type="tel" maxlength="25" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" required class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"></label><button type="submit" class="h-11 rounded-lg bg-[#5C4033] px-5 text-sm font-semibold text-white hover:bg-[#452F26]">Tambah Waka</button></form>
                @if($wakas->isNotEmpty())<details class="border-t border-[#E5D8CC]"><summary class="cursor-pointer px-5 py-3 text-sm font-semibold text-[#5C4033] sm:px-6">Waka terdaftar ({{ $wakas->count() }}) <span class="float-right">⌄</span></summary><div class="space-y-3 px-5 pb-5 sm:px-6">@foreach($wakas as $waka)<form method="POST" action="{{ route('admin.tambah.piket.waka.update', $waka) }}" class="grid grid-cols-1 gap-2 rounded-lg border border-[#E5D8CC] bg-[#FFFCF9] p-3 sm:grid-cols-[1fr_1fr_auto_auto] sm:items-end">@csrf @method('PUT')<label class="flex flex-col gap-1 text-xs font-semibold">Nama Waka<input name="nama" value="{{ $waka->nama }}" required maxlength="100" class="h-10 rounded-lg border border-[#D8C9BC] bg-white px-3 text-sm font-normal"></label><label class="flex flex-col gap-1 text-xs font-semibold">Nomor HP / WhatsApp<input name="no_hp" value="{{ $waka->no_hp }}" required maxlength="25" class="h-10 rounded-lg border border-[#D8C9BC] bg-white px-3 text-sm font-normal"></label><button class="h-10 rounded-lg bg-[#5C4033] px-4 text-sm font-semibold text-white">Simpan</button><button type="submit" form="hapus-waka-{{ $waka->id }}" class="h-10 rounded-lg border border-red-200 px-4 text-sm font-semibold text-red-700">Hapus</button></form><form id="hapus-waka-{{ $waka->id }}" method="POST" action="{{ route('admin.tambah.piket.waka.destroy', $waka) }}" onsubmit="return confirm('Hapus Waka {{ addslashes($waka->nama) }}?')">@csrf @method('DELETE')</form>@endforeach</div></details>@endif
            </article>

            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6">
                    <h3 class="font-['Poppins'] text-base font-bold">Jadwal Petugas Piket KBM</h3>
                </div>
                @if($guru->count() < 3)<div class="m-5 rounded-lg border border-[#F3D6A0] bg-[#FFF8E7] px-4 py-3 text-sm text-[#A16207]">Data guru dengan role Guru belum cukup. Tambahkan minimal 3 guru sebelum mengatur piket.</div>@endif
                @if($wakas->isEmpty())<div class="m-5 rounded-lg border border-[#F3D6A0] bg-[#FFF8E7] px-4 py-3 text-sm text-[#A16207]">Tambahkan data Waka pada card di atas sebelum menyusun jadwal.</div>@endif
                <form method="POST" action="{{ route('admin.tambah.piket.store') }}" class="p-5 sm:p-6">@csrf
                    <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Bulan</span><select name="bulan" id="bulanKalender" required onchange="pindahBulanKalender()" class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm">@foreach([1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'] as $nomor=>$nama)<option value="{{ $nomor }}" @selected(old('bulan',$bulan)==$nomor)>{{ $nama }}</option>@endforeach</select></label>
                        <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Tahun</span><select name="tahun" id="tahunKalender" required onchange="pindahBulanKalender()" class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm">@foreach($tahunPilihan as $pilihan)<option value="{{ $pilihan }}" @selected(old('tahun',$tahun)==$pilihan)>{{ $pilihan }}</option>@endforeach</select></label>
                    </div>
                    @php
                        $awalKalender = \Carbon\Carbon::create($tahun, $bulan, 1);
                        $jumlahHari = $awalKalender->daysInMonth;
                        $offsetKalender = $awalKalender->dayOfWeek;
                    @endphp
                    <section class="rounded-xl border border-[#E5D8CC] bg-[#FFFCF9] p-4 sm:p-5">
                        <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
                            <div><h4 class="font-['Poppins'] text-sm font-bold">Pilih tanggal piket</h4><p class="mt-1 text-xs text-[#7A6A60]">Klik tanggal apa pun, termasuk Sabtu dan Minggu, untuk mengatur petugasnya.</p></div>
                            <div class="flex gap-3 text-[11px] text-[#7A6A60]"><span><i class="mr-1 inline-block h-2.5 w-2.5 rounded-full bg-[#5C4033]"></i>Sudah diatur</span><span><i class="mr-1 inline-block h-2.5 w-2.5 rounded-full border border-[#D8C9BC] bg-white"></i>Belum diatur</span></div>
                        </div>
                        <div class="grid grid-cols-7 gap-1.5 sm:gap-2">
                            @foreach(['Min','Sen','Sel','Rab','Kam','Jum','Sab'] as $namaHari)
                                <div class="py-1 text-center text-xs font-semibold text-[#7A6A60]">{{ $namaHari }}</div>
                            @endforeach
                            @for($kosong=0; $kosong<$offsetKalender; $kosong++)<div aria-hidden="true"></div>@endfor
                            @for($nomorHari=1; $nomorHari<=$jumlahHari; $nomorHari++)
                                @php
                                    $tanggalKalender = $awalKalender->copy()->day($nomorHari);
                                    $tanggalKey = $tanggalKalender->format('Y-m-d');
                                    $sudahDiatur = $jadwalPerTanggal->has($tanggalKey);
                                @endphp
                                <button type="button" data-piket-tanggal="{{ $tanggalKey }}" aria-pressed="false" class="calendar-date group relative flex h-10 flex-col items-center justify-center rounded-xl border border-[#E5D8CC] bg-white text-xs font-bold sm:h-12 sm:text-sm text-[#3E3028] transition hover:border-[#5C4033] hover:bg-[#F5EFE8] sm:min-h-12">
                                        <span>{{ $nomorHari }}</span><span class="mt-1 h-1.5 w-1.5 rounded-full {{ $sudahDiatur ? 'bg-[#5C4033]' : 'bg-transparent' }}"></span>
                                </button>
                            @endfor
                        </div>
                    </section>
                    <input type="hidden" name="tanggal" id="piketTanggalAktif" value="{{ old('tanggal') }}">
                    <div id="piketTanggalKosong" class="rounded-lg border border-dashed border-[#D8C9BC] px-4 py-8 text-center text-sm text-[#7A6A60]">Pilih salah satu tanggal di kalender untuk mengisi petugas piket.</div>
                    <div class="space-y-3">
                        @foreach($tanggalPiket as $tanggal)
                            @php
                                $tanggalKey = $tanggal->format('Y-m-d');
                                $petugasTanggal = $jadwalPerTanggal->get($tanggalKey, collect());
                                $wakaTersimpan = $petugasTanggal->firstWhere('sesi', 'waka')?->id_waka;
                            @endphp
                            <section id="piketPanel-{{ $tanggalKey }}" data-piket-panel="{{ $tanggalKey }}" class="hidden overflow-hidden rounded-xl border border-[#E5D8CC] bg-[#FFFCF9]">
                                @php($tanggalUji24Jam = $petugasTanggal->whereIn('sesi', ['pagi', 'siang'])->isNotEmpty() && $petugasTanggal->whereIn('sesi', ['pagi', 'siang'])->every(fn($petugas) => $petugas->jam_mulai === '00:00:00' && $petugas->jam_selesai === '00:00:00'))
                                <h4 class="border-b border-[#E5D8CC] bg-white px-4 py-3 font-['Poppins'] text-sm font-bold">Petugas {{ $tanggal->locale('id')->translatedFormat('l, d F Y') }}</h4>
                                <div class="grid grid-cols-1 gap-4 p-4 xl:grid-cols-3">
                                    <label class="flex items-center gap-3 rounded-lg border border-amber-200 bg-amber-50 p-3 text-sm font-semibold text-amber-900 xl:col-span-3"><input type="checkbox" name="mode_24_jam" value="1" data-mode-24 data-default24="{{ $tanggalUji24Jam ? '1' : '0' }}" @checked($tanggalUji24Jam) disabled class="h-4 w-4 accent-[#5C4033]">Mode testing 24 jam (00.00–24.00) untuk sesi pagi dan siang</label>
                                    @foreach(['pagi'=>'Pagi','siang'=>'Siang'] as $sesi=>$namaSesi)
                                        @php($label=$tanggalUji24Jam ? $namaSesi.' • 24 jam (00.00–24.00)' : ($namaSesi.' • '.($sesi === 'pagi' ? '07.00–11.00' : '11.00–15.00')))
                                        @php($guruTersimpan=$petugasTanggal->where('sesi',$sesi)->sortBy('urutan')->values())
                                        <div class="rounded-lg border border-[#E5D8CC] bg-white p-3">
                                            <p data-label-sesi data-nama-sesi="{{ $sesi }}" class="mb-2 text-xs font-bold text-[#5C4033]">{{ $label }}</p>
                                            <div class="grid grid-cols-1 gap-2 sm:grid-cols-3 xl:grid-cols-1 2xl:grid-cols-3">
                                                @for($slot=0;$slot<3;$slot++)
                                                    @php($guruTerpilih=old("jadwal.$sesi.$slot", $guruTersimpan->get($slot)?->id_guru))
                                                    <label class="relative flex min-w-0 flex-col gap-1"><span class="text-[11px] text-[#7A6A60]">Guru {{ $slot+1 }}</span><input type="search" data-pilih-guru placeholder="Cari atau pilih guru..." autocomplete="off" required disabled value="{{ $guru->firstWhere('id', $guruTerpilih)?->name }}" class="h-10 w-full min-w-0 rounded-lg border border-[#D8C9BC] bg-white px-2 text-xs text-[#3E3028] outline-none focus:border-[#5C4033]"><select name="jadwal[{{ $sesi }}][]" data-id-guru required disabled class="hidden"><option value="">Pilih guru</option>@foreach($guru as $orang)<option value="{{ $orang->id }}" @selected($guruTerpilih==$orang->id)>{{ $orang->name }}</option>@endforeach</select><div data-hasil-guru class="absolute left-0 right-0 top-full z-20 hidden max-h-40 overflow-y-auto rounded-lg border border-[#D8C9BC] bg-white text-[#3E3028] shadow-lg"></div></label>
                                                @endfor
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="rounded-lg border border-[#E5D8CC] bg-white p-3"><p class="mb-3 text-xs font-bold text-[#5C4033]">Petugas Waka • 1 orang</p><label class="flex flex-col gap-1"><span class="text-[11px] text-[#7A6A60]">Waka bertugas</span><select name="jadwal[waka]" required disabled class="h-10 w-full rounded-lg border border-[#D8C9BC] bg-white px-2 text-xs"><option value="">Pilih Waka</option>@foreach($wakas as $waka)<option value="{{ $waka->id }}" @selected(old('jadwal.waka',$wakaTersimpan)==$waka->id)>{{ $waka->nama }} · {{ $waka->no_hp }}</option>@endforeach</select></label></div>
                                </div>
                            </section>
                        @endforeach
                    </div>
                    <div class="mt-5 flex justify-end border-t border-[#E5D8CC] pt-4"><button type="submit" @disabled($guru->count()<3||$wakas->isEmpty()) class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#452F26] disabled:cursor-not-allowed disabled:opacity-50">Simpan Petugas Tanggal Ini</button></div>
                </form>
            </article>

            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6"><h3 class="font-['Poppins'] text-base font-bold">Upload File Jadwal</h3><p class="mt-1 text-xs text-[#7A6A60]">Unggah Excel atau CSV. Gunakan satu baris untuk setiap tanggal kerja, dengan kolom berikut:</p><p class="mt-2 break-all rounded-md bg-[#F5EFE8] px-3 py-2 font-mono text-[11px] text-[#5C4033]">tanggal, guru_pagi_1, guru_pagi_2, guru_pagi_3, guru_siang_1, guru_siang_2, guru_siang_3, waka, mode_24_jam</p><p class="mt-1 text-[11px] text-[#7A6A60]">Kolom mode_24_jam opsional: isi 1/ya untuk jadwal testing 24 jam, atau 0/kosong untuk jam normal. Tanggal harus berformat YYYY-MM-DD; nama guru dan Waka harus sama dengan data yang terdaftar.</p></div>
                <form method="POST" action="{{ route('admin.tambah.piket.import') }}" enctype="multipart/form-data" class="flex flex-col gap-3 p-5 sm:flex-row sm:items-end sm:p-6">@csrf<label class="flex flex-1 flex-col gap-2"><span class="text-sm font-semibold">File jadwal (.xlsx, .xls, .csv)</span><input type="file" name="file_jadwal" accept=".xlsx,.xls,.csv,.txt" required class="min-h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-[#5C4033] file:px-3 file:py-1 file:text-xs file:font-semibold file:text-white"></label><button type="submit" class="h-11 rounded-lg border border-[#D8C9BC] px-5 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Upload Jadwal</button></form>
            </article>

            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="flex flex-col justify-between gap-3 border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:flex-row sm:items-center sm:px-6">
                    <div><h3 class="font-['Poppins'] text-base font-bold">Hasil Jadwal Piket</h3><p class="mt-1 text-xs text-[#7A6A60]">Jadwal khusus per tanggal untuk {{ $namaBulan }} {{ $tahun }}.</p></div>
                    <span class="w-fit rounded-md bg-[#F5EFE8] px-2.5 py-1 text-[11px] font-bold text-[#5C4033]">{{ $jadwalPerTanggal->count() }} Tanggal Terisi</span>
                </div>
                <form method="GET" action="{{ route('admin.tambah.piket') }}" class="flex flex-col gap-3 border-b border-[#E5D8CC] p-4 sm:flex-row sm:items-end sm:p-5">
                    <label class="flex flex-col gap-1 text-xs font-semibold">Bulan<select name="bulan" class="h-10 rounded-lg border border-[#D8C9BC] bg-white px-3 text-sm font-normal">@foreach([1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'] as $nomor=>$nama)<option value="{{ $nomor }}" @selected($bulan==$nomor)>{{ $nama }}</option>@endforeach</select></label>
                    <label class="flex flex-col gap-1 text-xs font-semibold">Tahun<select name="tahun" class="h-10 rounded-lg border border-[#D8C9BC] bg-white px-3 text-sm font-normal">@foreach($tahunPilihan as $pilihan)<option value="{{ $pilihan }}" @selected($tahun==$pilihan)>{{ $pilihan }}</option>@endforeach</select></label>
                    <button class="h-10 rounded-lg bg-[#5C4033] px-4 text-sm font-semibold text-white hover:bg-[#452F26]">Lihat Jadwal</button>
                </form>
                <div id="piketTableViewport" class="overflow-x-auto">
                    <table class="w-full min-w-[900px] border-collapse text-left text-sm">
                        <thead class="bg-[#F5EFE8] text-[11px] uppercase tracking-wider text-[#7A6A60]"><tr><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Tanggal</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Petugas Sesi Pagi</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Petugas Sesi Siang</th><th class="border-b border-[#E5D8CC] px-4 py-3">Waka / Nomor HP</th></tr></thead>
                        <tbody>
                            @forelse($jadwalPerTanggal as $tanggalKey=>$petugasTanggal)
                                @php($pagi=$petugasTanggal->where('sesi','pagi')->sortBy('urutan'))
                                @php($siang=$petugasTanggal->where('sesi','siang')->sortBy('urutan'))
                                @php($wakaTanggal=$petugasTanggal->firstWhere('sesi','waka'))
                                <tr class="hover:bg-[#FFFCF9]"><td class="border-b border-r border-[#E5D8CC] px-4 py-3 font-semibold">{{ \Carbon\Carbon::parse($tanggalKey)->locale('id')->translatedFormat('l, d F Y') }}</td><td class="border-b border-r border-[#E5D8CC] px-4 py-3"><div class="space-y-1">@if($pagi->first())<p class="mb-1 text-[10px] font-semibold text-[#7A6A60]">{{ $pagi->first()->jam_mulai === '00:00:00' && $pagi->first()->jam_selesai === '00:00:00' ? 'Bertugas 24 jam' : substr($pagi->first()->jam_mulai,0,5).'–'.substr($pagi->first()->jam_selesai,0,5) }}</p>@endif @forelse($pagi as $petugas)<p>{{ $petugas->urutan }}. {{ $petugas->guru?->name ?? 'Data guru tidak tersedia' }}</p>@empty<span class="text-[#A08978]">Belum diatur</span>@endforelse</div></td><td class="border-b border-r border-[#E5D8CC] px-4 py-3"><div class="space-y-1">@if($siang->first())<p class="mb-1 text-[10px] font-semibold text-[#7A6A60]">{{ $siang->first()->jam_mulai === '00:00:00' && $siang->first()->jam_selesai === '00:00:00' ? 'Bertugas 24 jam' : substr($siang->first()->jam_mulai,0,5).'–'.substr($siang->first()->jam_selesai,0,5) }}</p>@endif @forelse($siang as $petugas)<p>{{ $petugas->urutan }}. {{ $petugas->guru?->name ?? 'Data guru tidak tersedia' }}</p>@empty<span class="text-[#A08978]">Belum diatur</span>@endforelse</div></td><td class="border-b border-[#E5D8CC] bg-[#F5EFE8] px-4 py-3 font-medium">{{ $wakaTanggal?->waka ? $wakaTanggal->waka->nama.' · '.($wakaTanggal->waka->no_hp ?: 'nomor belum diisi') : 'Belum diatur' }}</td></tr>
                            @empty
                                <tr><td colspan="4" class="px-4 py-10 text-center text-sm text-[#7A6A60]">Belum ada jadwal pada bulan ini. Atur melalui form atau upload file.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </article>
        </section>
    </main>
    <datalist id="daftarGuruPiket">@foreach($guru as $orang)<option value="{{ $orang->name }}"></option>@endforeach</datalist>
    <script>
        const piketTanggalInput = document.getElementById('piketTanggalAktif');
        const piketPanels = [...document.querySelectorAll('[data-piket-panel]')];
        const piketButtons = [...document.querySelectorAll('[data-piket-tanggal]')];
        function pindahBulanKalender() {
            const bulan = document.getElementById('bulanKalender').value;
            const tahun = document.getElementById('tahunKalender').value;
            window.location.href = `{{ route('admin.tambah.piket') }}?bulan=${bulan}&tahun=${tahun}`;
        }
        function pilihTanggalPiket(tanggal) {
            piketTanggalInput.value = tanggal;
            document.getElementById('piketTanggalKosong').classList.add('hidden');
            piketPanels.forEach(panel => {
                const aktif = panel.dataset.piketPanel === tanggal;
                panel.classList.toggle('hidden', !aktif);
                panel.querySelectorAll('select, [data-pilih-guru], [data-mode-24]').forEach(control => control.disabled = !aktif);
                if (aktif) {
                    const mode24 = panel.querySelector('[data-mode-24]');
                    mode24.checked = mode24.dataset.default24 === '1';
                }
            });
            piketButtons.forEach(button => {
                const aktif = button.dataset.piketTanggal === tanggal;
                button.setAttribute('aria-pressed', aktif ? 'true' : 'false');
                button.classList.toggle('border-[#5C4033]', aktif);
                button.classList.toggle('bg-[#F5EFE8]', aktif);
                button.classList.toggle('ring-2', aktif);
                button.classList.toggle('ring-[#5C4033]/20', aktif);
            });
        }
        document.querySelectorAll('[data-pilih-guru]').forEach(input => {
            const select = input.nextElementSibling;
            const hasil = input.parentElement.querySelector('[data-hasil-guru]');
            const opsiGuru = [...select.options].filter(option => option.value);
            const tutupHasil = () => hasil.classList.add('hidden');
            const tampilkanHasil = () => {
                const kata = input.value.trim().toLocaleLowerCase();
                const cocok = kata ? opsiGuru.filter(option => option.textContent.trim().toLocaleLowerCase().includes(kata)) : opsiGuru;
                hasil.replaceChildren();
                cocok.slice(0, 12).forEach(option => {
                    const tombol = document.createElement('button'); tombol.type = 'button'; tombol.textContent = option.textContent.trim();
                    tombol.className = 'block w-full px-3 py-2 text-left text-xs text-[#3E3028] hover:bg-[#F5EFE8]';
                    tombol.addEventListener('click', () => { input.value = option.textContent.trim(); select.value = option.value; input.setCustomValidity(''); tutupHasil(); });
                    hasil.appendChild(tombol);
                });
                if (kata && !cocok.length) { const kosong = document.createElement('p'); kosong.textContent = 'Nama guru tidak ditemukan'; kosong.className = 'px-3 py-2 text-xs text-[#7A6A60]'; hasil.appendChild(kosong); }
                hasil.classList.toggle('hidden', input.disabled);
            };
            const sinkronkanGuru = () => {
                const nama = input.value.trim().toLocaleLowerCase();
                const opsi = opsiGuru.find(option => option.textContent.trim().toLocaleLowerCase() === nama);
                select.value = opsi?.value ?? '';
                input.setCustomValidity(opsi || !input.value ? '' : 'Pilih nama guru dari daftar hasil.');
            };
            input.addEventListener('focus', tampilkanHasil);
            input.addEventListener('input', () => { sinkronkanGuru(); tampilkanHasil(); });
            input.addEventListener('change', sinkronkanGuru);
            input.addEventListener('blur', () => setTimeout(tutupHasil, 150));
        });
        piketButtons.forEach(button => button.addEventListener('click', () => pilihTanggalPiket(button.dataset.piketTanggal)));
        document.querySelectorAll('[data-mode-24]').forEach(toggle => toggle.addEventListener('change', () => {
            const panel = toggle.closest('[data-piket-panel]');
            toggle.dataset.default24 = toggle.checked ? '1' : '0';
            const labels = panel.querySelectorAll('[data-label-sesi]');
            labels.forEach(label => { const nama=label.dataset.namaSesi; const pagi=nama==='pagi'; label.textContent=toggle.checked ? `${nama==='pagi'?'Pagi':'Siang'} • 24 jam (00.00–24.00)` : `${nama==='pagi'?'Pagi':'Siang'} • ${pagi?'07.00–11.00':'11.00–15.00'}`; });
        }));
        if (piketTanggalInput.value && document.querySelector(`[data-piket-panel="${piketTanggalInput.value}"]`)) pilihTanggalPiket(piketTanggalInput.value);
        function openSidebar(){document.getElementById('sidebar').classList.remove('-translate-x-full');document.getElementById('sidebarOverlay').classList.remove('hidden')}function closeSidebar(){document.getElementById('sidebar').classList.add('-translate-x-full');document.getElementById('sidebarOverlay').classList.add('hidden')}</script>
</body>
</html>
