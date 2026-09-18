<!DOCTYPE html>
<html>
<head>
    <title>Tambah Siswa</title>
</head>
<body>

    <h2>Form Tambah Siswa</h2>

    <a href="{{ route('admin.kelas.index') }}">← Kembali</a>
    <br><br>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
        <br>
    @endif

    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
        <br>
    @endif

    <!-- FORM 1: TAMBAH SISWA MANUAL -->
    <form action="{{ route('admin.siswa.store') }}" method="POST">
        @csrf

        <!-- Input NISN -->
        <div>
            <label for="nisn">NISN:</label><br>
            <input type="number" id="nisn" name="nisn" value="{{ old('nisn') }}" placeholder="Contoh: 0012345678" required>
        </div>

        <br>

        <!-- Input Nama Siswa -->
        <div>
            <label for="nama">Nama Siswa:</label><br>
            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso" required>
        </div>

        <br>

        <!-- Dropdown Select Kelas -->
        <div>
            <label for="id_kelas">Pilih Kelas:</label><br>
            <select name="id_kelas" id="id_kelas" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelases as $kelas)
                    <option value="{{ $kelas->id_kelas }}" {{ old('id_kelas') == $kelas->id_kelas ? 'selected' : '' }}>
                        {{ $kelas->tingkat }} {{ $kelas->jurusan }} {{ $kelas->rombel }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <button type="submit">Simpan Siswa</button>
    </form> <!-- TUTUP FORM 1 DI SINI -->

    <hr style="margin: 20px 0;">

    <!-- FORM 2: IMPORT EXCEL (TERPISAH) -->
    <h3>Import Siswa dari Excel</h3>
    <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file_excel" accept=".xlsx,.xls,.csv" required>
        <button type="submit">Import Excel</button>
    </form> <!-- TUTUP FORM 2 DI SINI -->

    <br><hr><br>

    <!-- TABEL DAFTAR SISWA -->
    <h3>Daftar Siswa</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($siswas as $index => $siswa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>
                        {{ $siswa->kelas->tingkat ?? '' }} 
                        {{ $siswa->kelas->jurusan ?? '' }} 
                        {{ $siswa->kelas->rombel ?? '' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Belum ada data siswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>