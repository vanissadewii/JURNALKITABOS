<!DOCTYPE html>
<html>
<head>
    <title>Kelola Jadwal Pelajaran</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .form-row { margin-bottom: 12px; }
        label { display: inline-block; width: 120px; font-size: 14px; }
        select, input, button { padding: 6px; font-size: 14px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; }
    </style>
</head>
<body>

    <h2>Kelola Jadwal Pelajaran</h2>
    <a href="{{ route('home') }}">← Kembali</a>
    <br><br>

    <form method="POST" action="{{ route('jadwal.import') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file_excel" accept=".xlsx,.xls,.csv" required>
        <button type="submit">Import Excel</button>
    </form>

    @if (session('warning'))
        <p style="color:#b45309; background:#fffbeb; padding:10px; border-radius:6px;">{{ session('warning') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <br>
    <form method="POST" action="{{ route('jadwal.store') }}">
        @csrf

        <div class="form-row">
            <label>Kelas:</label>
            <select name="id_kelas" id="id_kelas" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelas ?? [] as $k)
                    <option value="{{ $k->id_kelas }}" data-tingkat="{{ $k->tingkat }}">
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <label>Hari:</label>
            <select name="hari" id="hari" required>
                <option value="">-- Pilih Hari --</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
            </select>
        </div>

        <div class="form-row">
            <label>Dari Jam ke-:</label>
            <select name="jam_dari" id="jam_dari" required>
                <option value="">-- Pilih Kelas & Hari dulu --</option>
            </select>
        </div>

        <div class="form-row">
            <label>Sampai Jam ke-:</label>
            <select name="jam_sampai" id="jam_sampai" required>
                <option value="">-- Pilih Kelas & Hari dulu --</option>
            </select>
        </div>

        <div class="form-row">
            <label>Guru:</label>
            <select name="id_guru" required>
                <option value="">-- Pilih Guru --</option>
                @foreach ($guru ?? [] as $g)
                    <option value="{{ $g->id }}">{{ $g->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <label>Mapel:</label>
            <select name="id_mapel" required>
                <option value="">-- Pilih Mapel --</option>
                @foreach ($mapel ?? [] as $m)
                    <option value="{{ $m->id_mapel }}">{{ $m->nama_mapel }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <button type="submit">Simpan Jadwal</button>
        </div>
    </form>
    <br>

    <table>
        <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Hari</th>
            <th>Jam ke</th>
            <th>Waktu</th>
            <th>Guru</th>
            <th>Mapel</th>
        </tr>
        @forelse ($jadwalGrup ?? [] as $j)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $j->kelas }}</td>
                <td>{{ $j->hari }}</td>
                <td>{{ $j->jam_ke_mulai === $j->jam_ke_sampai ? $j->jam_ke_mulai : $j->jam_ke_mulai.' - '.$j->jam_ke_sampai }}</td>
                <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                <td>{{ $j->guru }}</td>
                <td>{{ $j->mapel }}</td>
            </tr>
        @empty
            <tr><td colspan="7">Belum ada jadwal.</td></tr>
        @endforelse
    </table>

    <script>
        const selKelas = document.getElementById('id_kelas');
        const selHari = document.getElementById('hari');
        const selDari = document.getElementById('jam_dari');
        const selSampai = document.getElementById('jam_sampai');

        selKelas.addEventListener('change', updateJam);
        selHari.addEventListener('change', updateJam);

        // kalau "dari" digeser melewati "sampai", "sampai" ikut menyesuaikan
        selDari.addEventListener('change', function () {
            if (selSampai.selectedIndex < selDari.selectedIndex) {
                selSampai.selectedIndex = selDari.selectedIndex;
            }
        });

        function updateJam() {
            const idKelas = selKelas.value;
            const hari = selHari.value;

            if (!idKelas || !hari) return;

            fetch(`{{ route('jadwal.get-jam') }}?id_kelas=${idKelas}&hari=${hari}`)
                .then(res => res.json())
                .then(data => {
                    if (data.length === 0) {
                        const kosong = '<option value="">-- Belum ada jam untuk hari ini --</option>';
                        selDari.innerHTML = kosong;
                        selSampai.innerHTML = kosong;
                        return;
                    }

                    const opsi = data.map(j =>
                        `<option value="${j.id_jam}">Jam ${j.jam_ke} (${j.jam_mulai.slice(0, 5)} - ${j.jam_selesai.slice(0, 5)})</option>`
                    ).join('');

                    selDari.innerHTML = opsi;
                    selSampai.innerHTML = opsi;
                });
        }
    </script>

</body>
</html>