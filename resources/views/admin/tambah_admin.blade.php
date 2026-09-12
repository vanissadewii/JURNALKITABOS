<!DOCTYPE html>
<html>
<head>
    <title>Menu Tambah Data - Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 24px;
            background: #f4f5f7;
        }
        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4px;
        }
        h2 {
            margin: 0;
        }
        .subtitle {
            color: #666;
            margin-bottom: 24px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }
        .card {
            display: block;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-decoration: none;
            color: #222;
            transition: box-shadow 0.15s, transform 0.15s;
        }
        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .card .icon {
            font-size: 28px;
            margin-bottom: 10px;
        }
        .card .title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .card .desc {
            font-size: 13px;
            color: #777;
        }
        .btn-logout {
            background: #b91c1c;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
        }
        .btn-logout:hover {
            background: #991b1b;
        }
    </style>
</head>
<body>

    <div class="header-row">
        <h2>Menu Tambah Data</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
    <div class="subtitle">Pilih data yang ingin dikelola.</div>

    <div class="grid">
        <a href="{{ route('admin.kelas.index') }}" class="card">
            <div class="icon">🏫</div>
            <div class="title">Kelas</div>
            <div class="desc">Kelola data kelas & rombel</div>
        </a>

        <a href="{{ route('admin.siswa.index') }}" class="card">
            <div class="icon">🧑‍🎓</div>
            <div class="title">Siswa</div>
            <div class="desc">Kelola data siswa</div>
        </a>

        <a href="{{ route('admin.user.index') }}" class="card">
            <div class="icon">👤</div>
            <div class="title">User</div>
            <div class="desc">Kelola akun guru, piket, dsb</div>
        </a>

        <a href="{{ route('mapel.index') }}" class="card">
            <div class="icon">📘</div>
            <div class="title">Mapel</div>
            <div class="desc">Kelola daftar mata pelajaran</div>
        </a>

        <a href="{{ route('semester.index') }}" class="card">
            <div class="icon">🗓️</div>
            <div class="title">Semester</div>
            <div class="desc">Kelola data semester aktif</div>
        </a>

        <a href="{{ route('jam-pelajaran.index') }}" class="card">
            <div class="icon">⏰</div>
            <div class="title">Jam Pelajaran</div>
            <div class="desc">Kelola jam per tingkat & hari</div>
        </a>

        <a href="{{ route('jadwal.index') }}" class="card">
            <div class="icon">📅</div>
            <div class="title">Jadwal Pelajaran</div>
            <div class="desc">Susun jadwal kelas per hari</div>
        </a>
    </div>

</body>
</html>