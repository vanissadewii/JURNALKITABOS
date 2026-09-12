@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('mapel.store') }}">
    @csrf
    <input type="text" name="nama_mapel" placeholder="Nama Mapel (misal: Matematika)" required>
    <input type="text" name="kode_mapel" placeholder="Kode (opsional, misal: MTK)">
    <button type="submit">Simpan</button>
</form>

<table border="1" cellpadding="8">
    <tr><th>No</th><th>Nama Mapel</th><th>Kode</th></tr>
    @forelse ($mapels as $i => $m)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $m->nama_mapel }}</td>
            <td>{{ $m->kode_mapel ?? '-' }}</td>
        </tr>
    @empty
        <tr><td colspan="3">Belum ada data mapel.</td></tr>
    @endforelse
</table>