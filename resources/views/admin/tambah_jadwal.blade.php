<!DOCTYPE html>
<html>
<head>
    <title>Kelola Jadwal Pelajaran</title>
  <style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
    }
    .form-row {
        margin-bottom: 12px;
    }
    label {
        display: inline-block;
        width: 100px;
        font-size: 14px;
    }
    select, input, button {
        padding: 6px;
        font-size: 14px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 8px;
    }
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

   <form method="POST" action="{{ route('jadwal.store') }}">
    @csrf

    <div>
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

    <div>
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

    <div>
        <label>Jam ke-:</label>
        <select name="id_jam" id="id_jam" required>
            <option value="">-- Pilih Kelas & Hari dulu --</option>
        </select>
    </div>

    <div>
        <label>Guru:</label>
        <select name="id_guru" required>
            <option value="">-- Pilih Guru --</option>
            @foreach ($guru ?? [] as $g)
                <option value="{{ $g->id }}">{{ $g->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Mapel:</label>
        <select name="id_mapel" required>
            <option value="">-- Pilih Mapel --</option>
            @foreach ($mapel ?? [] as $m)
                <option value="{{ $m->id_mapel }}">{{ $m->nama_mapel }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit">Simpan Jadwal</button>
    </div>
</form>
    <br>

    <table border="1" cellpadding="8">
        <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Hari</th>
            <th>Jam ke</th>
            <th>Waktu</th>
            <th>Guru</th>
            <th>Mapel</th>
        </tr>
        @forelse ($jadwal ?? [] as $i => $j)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $j->kelas->nama_kelas }}</td>
                <td>{{ $j->jamPelajaran->hari }}</td>
                <td>{{ $j->jamPelajaran->jam_ke }}</td>
                <td>{{ $j->jamPelajaran->jam_mulai }} - {{ $j->jamPelajaran->jam_selesai }}</td>
                <td>{{ $j->guru->name }}</td>
                <td>{{ $j->mapel->nama_mapel }}</td>
            </tr>
        @empty
            <tr><td colspan="7">Belum ada jadwal.</td></tr>
        @endforelse
    </table>

    <script>
        document.getElementById('id_kelas').addEventListener('change', updateJam);
        document.getElementById('hari').addEventListener('change', updateJam);

        function updateJam() {
            const idKelas = document.getElementById('id_kelas').value;
            const hari = document.getElementById('hari').value;
            const jamSelect = document.getElementById('id_jam');

            if (!idKelas || !hari) return;

            fetch(`{{ route('jadwal.get-jam') }}?id_kelas=${idKelas}&hari=${hari}`)
                .then(res => res.json())
                .then(data => {
                    jamSelect.innerHTML = '<option value="">-- Pilih Jam --</option>';
                    data.forEach(j => {
                        const opt = document.createElement('option');
                        opt.value = j.id_jam;
                        opt.textContent = `Jam ${j.jam_ke} (${j.jam_mulai} - ${j.jam_selesai})`;
                        jamSelect.appendChild(opt);
                    });
                });
        }
    </script>

</body>
</html>