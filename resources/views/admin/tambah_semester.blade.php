@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('semester.store') }}">
    @csrf
    <input type="text" name="nama" placeholder="Contoh: Semester 1 2026/2027" required>
    <input type="date" name="tanggal_mulai" required>
    <input type="date" name="tanggal_selesai" required>
    <button type="submit">Simpan</button>
</form>

<table border="1" cellpadding="8">
    <tr><th>No</th><th>Nama</th><th>Mulai</th><th>Selesai</th><th>Status</th></tr>
    @forelse ($semesters as $i => $s)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $s->nama }}</td>
            <td>{{ $s->tanggal_mulai }}</td>
            <td>{{ $s->tanggal_selesai }}</td>
            <td>{{ $s->status }}</td>
        </tr>
    @empty
        <tr><td colspan="5">Belum ada semester.</td></tr>
    @endforelse
</table>