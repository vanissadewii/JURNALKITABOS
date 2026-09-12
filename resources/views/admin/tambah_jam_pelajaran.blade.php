<!DOCTYPE html>
<html>
<head>
    <title>Kelola Jam Pelajaran</title>
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
            width: 160px;
            font-size: 14px;
        }
        select, input, button {
            padding: 6px;
            font-size: 14px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        hr {
            margin: 30px 0;
        }
    </style>
</head>
<body>

    <h2>Kelola Jam Pelajaran</h2>
    <a href="{{ route('home') }}">← Kembali</a>
    <br><br>

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

    @if (empty($semesterAktif))
        <p style="color:red;">Belum ada semester aktif. Buat semester dulu sebelum menambah jam pelajaran.</p>
    @else

        <h3>Generate Otomatis</h3>
        <form method="POST" action="{{ route('jam-pelajaran.generate') }}">
            @csrf
            <input type="hidden" name="id_semester" value="{{ $semesterAktif->id_semester }}">

            <div class="form-row">
                <label>Tingkat:</label>
                <select name="tingkat" required>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>

            <div class="form-row">
                <label>Hari (Ctrl+klik untuk pilih lebih dari satu):</label>
                <select name="hari[]" multiple required style="height:110px;">
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                </select>
            </div>

            <div class="form-row">
                <label>Mulai dari Jam ke-:</label>
                <input type="number" name="jam_ke_mulai" value="1" min="1" required>
            </div>

            <div class="form-row">
                <label>Jam Mulai:</label>
                <input type="time" name="jam_mulai" required>
            </div>

            <div class="form-row">
                <label>Durasi per Jam (menit):</label>
                <input type="number" name="durasi_menit" required>
            </div>

            <div class="form-row">
                <label>Jumlah Jam Pelajaran:</label>
                <input type="number" name="jumlah_jam" required>
            </div>

            <div class="form-row">
                <button type="submit">Generate</button>
            </div>
        </form>

        <hr>

        <h3>Tambah Manual (satu baris)</h3>
        <form method="POST" action="{{ route('jam-pelajaran.store') }}">
            @csrf
            <input type="hidden" name="id_semester" value="{{ $semesterAktif->id_semester }}">

            <div class="form-row">
                <label>Tingkat:</label>
                <select name="tingkat" required>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>

            <div class="form-row">
                <label>Hari:</label>
                <select name="hari" required>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                </select>
            </div>

            <div class="form-row">
                <label>Jam ke-:</label>
                <input type="number" name="jam_ke" min="1" required>
            </div>

            <div class="form-row">
                <label>Jam Mulai:</label>
                <input type="time" name="jam_mulai" required>
            </div>

            <div class="form-row">
                <label>Jam Selesai:</label>
                <input type="time" name="jam_selesai" required>
            </div>

            <div class="form-row">
                <button type="submit">Simpan</button>
            </div>
        </form>

    @endif

    <br>

    <table>
        <tr>
            <th>No</th>
            <th>Semester</th>
            <th>Tingkat</th>
            <th>Hari</th>
            <th>Jam ke</th>
            <th>Mulai</th>
            <th>Selesai</th>
        </tr>
        @forelse ($jamPelajaran ?? [] as $i => $j)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $j->semester->nama ?? '-' }}</td>
                <td>{{ $j->tingkat }}</td>
                <td>{{ $j->hari }}</td>
                <td>{{ $j->jam_ke }}</td>
                <td>{{ $j->jam_mulai }}</td>
                <td>{{ $j->jam_selesai }}</td>
            </tr>
        @empty
            <tr><td colspan="7">Belum ada jam pelajaran.</td></tr>
        @endforelse
    </table>

</body>
</html>