<!DOCTYPE html>
<html>
<head>
    <title>Kelola User</title>
</head>
<body>

    <h2>Form Tambah User</h2>

    <!-- Pesan Error Validasi -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Pesan Sukses -->
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- FORM TAMBAH USER -->
    <form method="POST" action="{{ route('admin.user.store') }}">
        @csrf

        <div>
            <label>Nama Lengkap (Display):</label><br>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Winartin, S.Pd" required>
        </div>
        <br>

        <div>
            <label>Username (Untuk Login):</label><br>
            <input type="text" name="username" value="{{ old('username') }}" placeholder="Contoh: winartinbahasa" required>
        </div>
        <br>

        <div>
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </div>
        <br>

        <div>
            <label>Role:</label><br>
            <select name="role" required>
                <option value="guru">Guru</option>
                <option value="guru_piket">Guru Piket</option>
                <option value="kelas">Kelas (Perwakilan)</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <br>

        <div>
            <label>Status:</label><br>
            <select name="status" required>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
                <option value="pending">Pending</option>
            </select>
        </div>
        <br>

        <div>
            <label>No. Telepon:</label><br>
            <input type="text" name="no_telepon" value="{{ old('no_telepon') }}">
        </div>
        <br>

        <div>
            <label>Kelas (khusus role "Kelas"):</label><br>
            <select name="id_kelas">
                <option value="">-- Tidak ada --</option>
                @foreach ($kelas as $k)
                    <option value="{{ $k->id_kelas }}">
                        {{ $k->tingkat }} {{ $k->jurusan }} {{ $k->rombel }}
                    </option>
                @endforeach
            </select>
        </div>
        <br>

        <button type="submit">Simpan User</button>
    </form>

    <br><hr><br>

    <!-- TABEL DAFTAR USER -->
    <h2>Daftar User</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Status</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $i => $u)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->role }}</td>
                    <td>{{ $u->status }}</td>
                    <td>
                        @if($u->kelas)
                            {{ $u->kelas->tingkat }} {{ $u->kelas->jurusan }} {{ $u->kelas->rombel }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada data user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>