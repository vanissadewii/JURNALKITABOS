<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kelas</title>
</head>
<body>

    <h2>Form Tambah Kelas</h2>

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

    <form action="{{ route('admin.kelas.store') }}" method="POST">
        @csrf

        <!-- Input Nama Kelas -->
        <!-- Input Jurusan (ganti dari nama_kelas) -->
<div>
    <label for="jurusan">Jurusan:</label><br>
    <input type="text" id="jurusan" name="jurusan" value="{{ old('jurusan') }}" placeholder="Contoh: RPL" required>
</div>

        <br>

        
<div>
    <label>Tingkat Kelas:</label><br>
    
    <input type="radio" id="tingkat_10" name="tingkat" value="10" {{ old('tingkat') == '10' ? 'checked' : '' }} required>
    <label for="tingkat_10">10 (X)</label>

    <input type="radio" id="tingkat_11" name="tingkat" value="11" {{ old('tingkat') == '11' ? 'checked' : '' }}>
    <label for="tingkat_11">11 (XI)</label>

    <input type="radio" id="tingkat_12" name="tingkat" value="12" {{ old('tingkat') == '12' ? 'checked' : '' }}>
    <label for="tingkat_12">12 (XII)</label>
</div>

<div class="mb-3">
    <label class="block text-sm font-medium mb-1">Rombel (nomor kelas paralel)</label>
    <input type="number" name="rombel" min="1" max="20" required
           placeholder="Contoh: 2"
           class="w-full border rounded-lg px-3 py-2">
</div>

        <br>

        <button type="submit">Simpan Kelas</button>
    </form>

    <table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th>No</th>
            <th>Tingkat</th>
            <th>Nama Kelas</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kelases as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->tingkat }}</td>
                <td>{{ $item->nama_kelas }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align: center;">Belum ada data kelas.</td>
            </tr>
        @endforelse
    </tbody>
</table>


</body>
</html>