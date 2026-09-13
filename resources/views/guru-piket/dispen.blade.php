@extends('layouts.guru-piket')

@section('title', 'Dispen')

@section('content')

    <div class="mb-5">
        <h2 class="text-[18px] font-bold text-[#3F2924]">Dispen</h2>
        <p class="mt-1 text-[10px] text-[#795548]">Buat surat izin dispen siswa dan pantau status persetujuannya.</p>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-md bg-[#E8F5E9] px-4 py-3">
            <p class="text-[10px] text-[#258A3E] mb-2">
                {{ session('success') }}
            </p>

            @if (session('link_wa'))
                <a href="{{ session('link_wa') }}" target="_blank"
                    class="inline-block rounded-md bg-[#25D366] px-3 py-2 text-[9px] font-semibold text-white hover:bg-[#1ebe57]">
                    Kirim Link Approval via WhatsApp
                </a>
            @else
                <p class="text-[9px] text-[#8D7B74]">
                    (Nomor WA Waka belum diatur di sistem.)
                </p>
            @endif
        </div>
    @endif

    <!-- ================= FORM PENGAJUAN ================= -->
    <div class="rounded-lg bg-white p-5 shadow-sm">

        <h3 class="text-[13px] font-bold mb-4">Buat Surat Dispen</h3>

        <form method="POST" action="{{ route('dispen.store') }}" id="formDispen">
            @csrf

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                <!-- Cari siswa -->
                <div class="relative">
                    <label class="text-[9px] font-medium">Cari Siswa (nama / NISN)</label>
                    <input
                        type="text"
                        id="cariSiswaInput"
                        autocomplete="off"
                        placeholder="Ketik nama atau NISN..."
                        class="mt-1 w-full rounded-md border border-[#E4DDD8] px-3 py-2 text-[10px] outline-none focus:border-[#258A3E]">
                    <div id="hasilCariSiswa" class="absolute z-10 mt-1 hidden w-full rounded-md border border-[#E4DDD8] bg-white shadow-lg"></div>

                    <input type="hidden" name="id_siswa" id="id_siswa" required>
                    <input type="hidden" name="id_kelas" id="id_kelas" required>
                </div>

                <!-- Nama siswa terpilih (readonly, breakdown dari search) -->
                <div>
                    <label class="text-[9px] font-medium">Nama Siswa</label>
                    <input type="text" id="nama_siswa_display" readonly
                        class="mt-1 w-full rounded-md border border-[#E4DDD8] bg-[#FAF8F5] px-3 py-2 text-[10px] outline-none">
                </div>

                <!-- Kelas/konsentrasi (auto) -->
                <div>
                    <label class="text-[9px] font-medium">Kelas / Konsentrasi</label>
                    <input type="text" id="kelas_display" readonly
                        class="mt-1 w-full rounded-md border border-[#E4DDD8] bg-[#FAF8F5] px-3 py-2 text-[10px] outline-none">
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="text-[9px] font-medium">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" required
                        value="{{ now()->format('Y-m-d') }}"
                        class="mt-1 w-full rounded-md border border-[#E4DDD8] px-3 py-2 text-[10px] outline-none focus:border-[#258A3E]">
                </div>

                <!-- Jam mulai -->
                <div>
                    <label class="text-[9px] font-medium">Jam Pelajaran Dari</label>
                    <select name="jam_ke_mulai" id="jam_ke_mulai" required
                        class="mt-1 w-full rounded-md border border-[#E4DDD8] px-3 py-2 text-[10px] outline-none focus:border-[#258A3E]">
                        <option value="">Pilih siswa & tanggal dulu</option>
                    </select>
                </div>

                <!-- Jam selesai -->
                <div>
                    <label class="text-[9px] font-medium">Jam Pelajaran Sampai</label>
                    <select name="jam_ke_selesai" id="jam_ke_selesai" required
                        class="mt-1 w-full rounded-md border border-[#E4DDD8] px-3 py-2 text-[10px] outline-none focus:border-[#258A3E]">
                        <option value="">Pilih siswa & tanggal dulu</option>
                    </select>
                </div>

                <!-- Alasan -->
                <div class="md:col-span-2">
                    <label class="text-[9px] font-medium">Alasan Dispen</label>
                    <textarea name="alasan" rows="3" required placeholder="Contoh: Mengikuti lomba LKS tingkat provinsi"
                        class="mt-1 w-full rounded-md border border-[#E4DDD8] px-3 py-2 text-[10px] outline-none focus:border-[#258A3E]"></textarea>
                </div>

            </div>

            <div class="mt-5 flex justify-end">
                <button type="submit"
                    class="rounded-md bg-[#258A3E] px-5 py-2.5 text-[10px] font-semibold text-white hover:bg-[#1F7434]">
                    Buat Surat Dispen
                </button>
            </div>

        </form>
    </div>

    <!-- ================= RIWAYAT / LOG ================= -->
    <div class="mt-5 rounded-lg bg-white p-5 shadow-sm">

        <h3 class="text-[13px] font-bold mb-4">Riwayat Pengajuan Dispen</h3>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[750px] border-collapse">
                <thead>
                    <tr class="bg-[#FAF8F5] text-left">
                        <th class="rounded-l-md px-3 py-2 text-[8px] font-semibold text-[#795548]">No. Surat</th>
                        <th class="px-3 py-2 text-[8px] font-semibold text-[#795548]">Nama Siswa</th>
                        <th class="px-3 py-2 text-[8px] font-semibold text-[#795548]">Kelas</th>
                        <th class="px-3 py-2 text-[8px] font-semibold text-[#795548]">Tanggal</th>
                        <th class="px-3 py-2 text-[8px] font-semibold text-[#795548]">Jam</th>
                        <th class="px-3 py-2 text-[8px] font-semibold text-[#795548]">Guru Piket</th>
                        <th class="rounded-r-md px-3 py-2 text-[8px] font-semibold text-[#795548]">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayat as $d)
                    <tr class="border-b border-[#F1ECE8]">
                        <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">{{ $d->nomor_surat }}</td>
                        <td class="px-3 py-2.5 text-[8px] font-medium text-[#3F2924]">{{ $d->siswa->nama }}</td>
                        <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                            {{ $d->kelas->tingkat }} {{ $d->kelas->jurusan }} {{ $d->kelas->rombel }}
                        </td>
                        <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">{{ $d->tanggal->format('d/m/Y') }}</td>
                        <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">{{ $d->labelJam() }}</td>
                        <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">{{ $d->guruPiket->name ?? '-' }}</td>
                        <td class="px-3 py-2.5">
                            @if ($d->status === 'disetujui')
                            <span class="rounded-full bg-[#E8F5E9] px-2 py-1 text-[7px] font-semibold text-[#258A3E]">Disetujui</span>
                            @elseif ($d->status === 'ditolak')
                            <span class="rounded-full bg-[#FFEBEE] px-2 py-1 text-[7px] font-semibold text-[#E53935]">Ditolak</span>
                            @else
                            <span class="rounded-full bg-[#FFF3E0] px-2 py-1 text-[7px] font-semibold text-[#F57C00]">Menunggu</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-3 py-6 text-center text-[9px] text-[#8D7B74]">Belum ada pengajuan dispen.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $riwayat->links() }}
        </div>

    </div>

@endsection

@section('scripts')
<script>
    const cariInput = document.getElementById('cariSiswaInput');
    const hasilBox = document.getElementById('hasilCariSiswa');
    const idSiswaInput = document.getElementById('id_siswa');
    const idKelasInput = document.getElementById('id_kelas');
    const namaDisplay = document.getElementById('nama_siswa_display');
    const kelasDisplay = document.getElementById('kelas_display');
    const tanggalInput = document.getElementById('tanggal');
    const jamMulaiSelect = document.getElementById('jam_ke_mulai');
    const jamSelesaiSelect = document.getElementById('jam_ke_selesai');

    let debounceTimer;

    cariInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        const q = cariInput.value.trim();

        if (q.length < 2) {
            hasilBox.classList.add('hidden');
            return;
        }

        debounceTimer = setTimeout(async () => {
            const res = await fetch(`{{ route('dispen.cari-siswa') }}?q=${encodeURIComponent(q)}`);
            const data = await res.json();

            hasilBox.innerHTML = '';

            if (data.length === 0) {
                hasilBox.innerHTML = '<div class="px-3 py-2 text-[9px] text-[#8D7B74]">Tidak ditemukan</div>';
            } else {
                data.forEach(s => {
                    const item = document.createElement('div');
                    item.className = 'cursor-pointer px-3 py-2 text-[9px] hover:bg-[#F5EFE8]';
                    item.textContent = `${s.nama} — ${s.label_kelas} (${s.nisn})`;
                    item.addEventListener('click', () => pilihSiswa(s));
                    hasilBox.appendChild(item);
                });
            }

            hasilBox.classList.remove('hidden');
        }, 300);
    });

    function pilihSiswa(s) {
        idSiswaInput.value = s.id_siswa;
        idKelasInput.value = s.id_kelas;
        namaDisplay.value = s.nama;
        kelasDisplay.value = s.label_kelas;
        cariInput.value = s.nama;
        hasilBox.classList.add('hidden');
        muatOpsiJam();
    }

    async function muatOpsiJam() {
        if (!idKelasInput.value || !tanggalInput.value) return;

        const url = `{{ route('dispen.opsi-jam') }}?id_kelas=${idKelasInput.value}&tanggal=${tanggalInput.value}`;
        const res = await fetch(url);
        const data = await res.json();

        jamMulaiSelect.innerHTML = '';
        jamSelesaiSelect.innerHTML = '';

        if (!data.jam || data.jam.length === 0) {
            jamMulaiSelect.innerHTML = '<option value="">Tidak ada jadwal (' + (data.pesan || 'akhir pekan') + ')</option>';
            jamSelesaiSelect.innerHTML = '<option value="">-</option>';
            return;
        }

        data.jam.forEach(j => {
            const opt1 = document.createElement('option');
            opt1.value = j.jam_ke;
            opt1.textContent = `Jam ke-${j.jam_ke} (${j.jam_mulai.substring(0,5)}-${j.jam_selesai.substring(0,5)})`;
            jamMulaiSelect.appendChild(opt1);

            const opt2 = opt1.cloneNode(true);
            jamSelesaiSelect.appendChild(opt2);
        });

        const optSelesai = document.createElement('option');
        optSelesai.value = '';
        optSelesai.textContent = 'Sampai Selesai (jam terakhir)';
        jamSelesaiSelect.appendChild(optSelesai);
    }

    tanggalInput.addEventListener('change', muatOpsiJam);

    document.addEventListener('click', (e) => {
        if (!hasilBox.contains(e.target) && e.target !== cariInput) {
            hasilBox.classList.add('hidden');
        }
    });
</script>
@endsection