<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Piket - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
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
                <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6"><h3 class="font-['Poppins'] text-base font-bold">Tambah Waka</h3><p class="mt-1 text-xs text-[#7A6A60]">Daftarkan Waka terlebih dahulu agar dapat dipilih pada jadwal.</p></div>
                <form method="POST" action="{{ route('admin.tambah.piket.waka') }}" class="flex flex-col gap-3 p-5 sm:flex-row sm:items-end sm:p-6">@csrf<label class="flex flex-1 flex-col gap-2"><span class="text-sm font-semibold">Nama Waka</span><input name="nama" maxlength="100" value="{{ old('nama') }}" placeholder="Masukkan nama Waka" required class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"></label><button type="submit" class="h-11 rounded-lg bg-[#5C4033] px-5 text-sm font-semibold text-white hover:bg-[#452F26]">Tambah Waka</button></form>
                @if($wakas->isNotEmpty())<div class="border-t border-[#E5D8CC] px-5 py-3 text-xs text-[#7A6A60] sm:px-6">Waka terdaftar: <span class="font-semibold text-[#3E3028]">{{ $wakas->pluck('nama')->join(', ') }}</span></div>@endif
            </article>

            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6">
                    <h3 class="font-['Poppins'] text-base font-bold">Jadwal Petugas Piket KBM</h3>
                </div>
                @if($guru->count() < 3)<div class="m-5 rounded-lg border border-[#F3D6A0] bg-[#FFF8E7] px-4 py-3 text-sm text-[#A16207]">Data guru dengan role Guru belum cukup. Tambahkan minimal 3 guru sebelum mengatur piket.</div>@endif
                @if($wakas->isEmpty())<div class="m-5 rounded-lg border border-[#F3D6A0] bg-[#FFF8E7] px-4 py-3 text-sm text-[#A16207]">Tambahkan data Waka pada card di atas sebelum menyusun jadwal.</div>@endif
                <form method="POST" action="{{ route('admin.tambah.piket.store') }}" class="p-5 sm:p-6">@csrf
                    <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Bulan</span><select name="bulan" required class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm">@foreach([1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'] as $nomor=>$nama)<option value="{{ $nomor }}" @selected(old('bulan',$bulan)==$nomor)>{{ $nama }}</option>@endforeach</select></label>
                        <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Tahun</span><select name="tahun" required class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm">@foreach($tahunPilihan as $pilihan)<option value="{{ $pilihan }}" @selected(old('tahun',$tahun)==$pilihan)>{{ $pilihan }}</option>@endforeach</select></label>
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
                                @php($tanggalUji24Jam = in_array($tanggalKey, ['2026-09-26', '2026-09-27'], true))
                                <h4 class="border-b border-[#E5D8CC] bg-white px-4 py-3 font-['Poppins'] text-sm font-bold">Petugas {{ $tanggal->locale('id')->translatedFormat('l, d F Y') }}@if($tanggalUji24Jam)<span class="ml-2 rounded-full bg-amber-100 px-2 py-1 text-[10px] text-amber-900">TEST • 24 JAM</span>@endif</h4>
                                <div class="grid grid-cols-1 gap-4 p-4 xl:grid-cols-3">
                                    @foreach(($tanggalUji24Jam ? ['pagi'=>'Pagi • 24 jam (00.00–24.00)','siang'=>'Siang • 24 jam (00.00–24.00)'] : ['pagi'=>'Pagi • 07.00–11.00','siang'=>'Siang • 11.00–15.00']) as $sesi=>$label)
                                        @php($guruTersimpan=$petugasTanggal->where('sesi',$sesi)->sortBy('urutan')->values())
                                        <div class="rounded-lg border border-[#E5D8CC] bg-white p-3">
                                            <p class="mb-2 text-xs font-bold text-[#5C4033]">{{ $label }}</p>
                                            <div class="grid grid-cols-1 gap-2 sm:grid-cols-3 xl:grid-cols-1 2xl:grid-cols-3">
                                                @for($slot=0;$slot<3;$slot++)
                                                    @php($guruTerpilih=old("jadwal.$sesi.$slot", $guruTersimpan->get($slot)?->id_guru))
                                                    <label class="flex min-w-0 flex-col gap-1"><span class="text-[11px] text-[#7A6A60]">Guru {{ $slot+1 }}</span><input type="search" list="daftarGuruPiket" data-pilih-guru placeholder="Cari atau pilih guru..." autocomplete="off" required disabled value="{{ $guru->firstWhere('id', $guruTerpilih)?->name }}" class="h-10 w-full min-w-0 rounded-lg border border-[#D8C9BC] bg-white px-2 text-xs outline-none focus:border-[#5C4033]"><select name="jadwal[{{ $sesi }}][]" data-id-guru required disabled class="hidden"><option value="">Pilih guru</option>@foreach($guru as $orang)<option value="{{ $orang->id }}" @selected($guruTerpilih==$orang->id)>{{ $orang->name }}</option>@endforeach</select></label>
                                                @endfor
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="rounded-lg border border-[#E5D8CC] bg-white p-3"><p class="mb-3 text-xs font-bold text-[#5C4033]">Petugas Waka • 1 orang</p><label class="flex flex-col gap-1"><span class="text-[11px] text-[#7A6A60]">Waka bertugas</span><select name="jadwal[waka]" required disabled class="h-10 w-full rounded-lg border border-[#D8C9BC] bg-white px-2 text-xs"><option value="">Pilih Waka</option>@foreach($wakas as $waka)<option value="{{ $waka->id }}" @selected(old('jadwal.waka',$wakaTersimpan)==$waka->id)>{{ $waka->nama }}</option>@endforeach</select></label></div>
                                </div>
                            </section>
                        @endforeach
                    </div>
                    <div class="mt-5 flex justify-end border-t border-[#E5D8CC] pt-4"><button type="submit" @disabled($guru->count()<3||$wakas->isEmpty()) class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#452F26] disabled:cursor-not-allowed disabled:opacity-50">Simpan Petugas Tanggal Ini</button></div>
                </form>
            </article>

            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6"><h3 class="font-['Poppins'] text-base font-bold">Upload File Jadwal</h3><p class="mt-1 text-xs text-[#7A6A60]">Unggah Excel atau CSV. Gunakan satu baris untuk setiap tanggal kerja, dengan kolom berikut:</p><p class="mt-2 break-all rounded-md bg-[#F5EFE8] px-3 py-2 font-mono text-[11px] text-[#5C4033]">tanggal, guru_pagi_1, guru_pagi_2, guru_pagi_3, guru_siang_1, guru_siang_2, guru_siang_3, waka</p><p class="mt-1 text-[11px] text-[#7A6A60]">Contoh satu baris: 2026-09-01, nama guru 1, nama guru 2, nama guru 3, nama guru 4, nama guru 5, nama guru 6, nama Waka. Tanggal harus berformat YYYY-MM-DD; nama harus sama dengan data yang terdaftar.</p></div>
                <form method="POST" action="{{ route('admin.tambah.piket.import') }}" enctype="multipart/form-data" class="flex flex-col gap-3 p-5 sm:flex-row sm:items-end sm:p-6">@csrf<label class="flex flex-1 flex-col gap-2"><span class="text-sm font-semibold">File jadwal (.xlsx, .xls, .csv)</span><input type="file" name="file_jadwal" accept=".xlsx,.xls,.csv,.txt" required class="min-h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-[#F5EFE8] file:px-3 file:py-1 file:text-xs file:font-semibold file:text-[#5C4033]"></label><button type="submit" class="h-11 rounded-lg border border-[#D8C9BC] px-5 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Upload Jadwal</button></form>
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
                        <thead class="bg-[#F5EFE8] text-[11px] uppercase tracking-wider text-[#7A6A60]"><tr><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Tanggal</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Petugas Sesi Pagi</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Petugas Sesi Siang</th><th class="border-b border-[#E5D8CC] px-4 py-3">Waka</th></tr></thead>
                        <tbody>
                            @forelse($jadwalPerTanggal as $tanggalKey=>$petugasTanggal)
                                @php($pagi=$petugasTanggal->where('sesi','pagi')->sortBy('urutan'))
                                @php($siang=$petugasTanggal->where('sesi','siang')->sortBy('urutan'))
                                @php($wakaTanggal=$petugasTanggal->firstWhere('sesi','waka'))
                                <tr class="hover:bg-[#FFFCF9]"><td class="border-b border-r border-[#E5D8CC] px-4 py-3 font-semibold">{{ \Carbon\Carbon::parse($tanggalKey)->locale('id')->translatedFormat('l, d F Y') }}</td><td class="border-b border-r border-[#E5D8CC] px-4 py-3"><div class="space-y-1">@if($pagi->first())<p class="mb-1 text-[10px] font-semibold text-[#7A6A60]">{{ $pagi->first()->jam_mulai === '00:00:00' && $pagi->first()->jam_selesai === '00:00:00' ? 'Bertugas 24 jam' : substr($pagi->first()->jam_mulai,0,5).'–'.substr($pagi->first()->jam_selesai,0,5) }}</p>@endif @forelse($pagi as $petugas)<p>{{ $petugas->urutan }}. {{ $petugas->guru?->name ?? 'Data guru tidak tersedia' }}</p>@empty<span class="text-[#A08978]">Belum diatur</span>@endforelse</div></td><td class="border-b border-r border-[#E5D8CC] px-4 py-3"><div class="space-y-1">@if($siang->first())<p class="mb-1 text-[10px] font-semibold text-[#7A6A60]">{{ $siang->first()->jam_mulai === '00:00:00' && $siang->first()->jam_selesai === '00:00:00' ? 'Bertugas 24 jam' : substr($siang->first()->jam_mulai,0,5).'–'.substr($siang->first()->jam_selesai,0,5) }}</p>@endif @forelse($siang as $petugas)<p>{{ $petugas->urutan }}. {{ $petugas->guru?->name ?? 'Data guru tidak tersedia' }}</p>@empty<span class="text-[#A08978]">Belum diatur</span>@endforelse</div></td><td class="border-b border-[#E5D8CC] bg-[#F5EFE8] px-4 py-3 font-medium">{{ $wakaTanggal?->waka?->nama ?? 'Belum diatur' }}</td></tr>
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
        function pilihTanggalPiket(tanggal) {
            piketTanggalInput.value = tanggal;
            document.getElementById('piketTanggalKosong').classList.add('hidden');
            piketPanels.forEach(panel => {
                const aktif = panel.dataset.piketPanel === tanggal;
                panel.classList.toggle('hidden', !aktif);
                panel.querySelectorAll('select, [data-pilih-guru]').forEach(control => control.disabled = !aktif);
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
            const sinkronkanGuru = () => {
                const nama = input.value.trim().toLocaleLowerCase();
                const opsi = [...select.options].find(option => option.value && option.textContent.trim().toLocaleLowerCase() === nama);
                select.value = opsi?.value ?? '';
                input.setCustomValidity(opsi || !input.value ? '' : 'Pilih nama guru dari daftar.');
            };
            input.addEventListener('input', sinkronkanGuru);
            input.addEventListener('change', sinkronkanGuru);
        });
        piketButtons.forEach(button => button.addEventListener('click', () => pilihTanggalPiket(button.dataset.piketTanggal)));
        if (piketTanggalInput.value && document.querySelector(`[data-piket-panel="${piketTanggalInput.value}"]`)) pilihTanggalPiket(piketTanggalInput.value);
        function openSidebar(){document.getElementById('sidebar').classList.remove('-translate-x-full');document.getElementById('sidebarOverlay').classList.remove('hidden')}function closeSidebar(){document.getElementById('sidebar').classList.add('-translate-x-full');document.getElementById('sidebarOverlay').classList.add('hidden')}</script>
</body>
</html>
