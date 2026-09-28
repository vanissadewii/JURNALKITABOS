<!DOCTYPE html>
<html>
<head>
    <title>Edit Jam Pelajaran</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .form-row { margin-bottom: 12px; }
        label { display: inline-block; width: 160px; font-size: 14px; }
        select, input, button { padding: 6px; font-size: 14px; }
    </style>
</head>
<body>

    <h2>Edit Jam Pelajaran</h2>
    <a href="{{ route('jam-pelajaran.index') }}">← Kembali</a>
    <br><br>

    @if ($errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('jam-pelajaran.update', $jamPelajaran) }}">
        @csrf
        @method('PUT')

        <div class="form-row">
            <label>Tingkat:</label>
            <select name="tingkat" required>
                @foreach ([10, 11, 12] as $t)
                    <option value="{{ $t }}" {{ (int) $jamPelajaran->tingkat === $t ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <label>Hari:</label>
            <select name="hari" required>
                @foreach (['Senin','Selasa','Rabu','Kamis','Jumat'] as $hari)
                    <option value="{{ $hari }}" {{ $jamPelajaran->hari === $hari ? 'selected' : '' }}>{{ $hari }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <label>Jam ke-:</label>
            <input type="number" name="jam_ke" value="{{ $jamPelajaran->jam_ke }}" min="1" required>
        </div>

        <div class="form-row">
            <label>Jam Mulai:</label>
            <input type="time" name="jam_mulai" value="{{ substr($jamPelajaran->jam_mulai, 0, 5) }}" required>
        </div>

        <div class="form-row">
            <label>Jam Selesai:</label>
            <input type="time" name="jam_selesai" value="{{ substr($jamPelajaran->jam_selesai, 0, 5) }}" required>
        </div>

        <div class="form-row">
            <button type="submit">Simpan Perubahan</button>
        </div>
    </form>

</body>
</html>