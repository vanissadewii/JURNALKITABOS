<!DOCTYPE html>
<html>

<head>
    <title>Kelola Jam Pelajaran</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .form-row { margin-bottom: 12px; }
        label { display: inline-block; width: 160px; font-size: 14px; }
        select, input, button { padding: 6px; font-size: 14px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        hr { margin: 30px 0; }
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

    @if (session('error'))
    <p style="color:red;">{{ session('error') }}</p>
    @endif

    @if (empty($semesterAktif))
    <p style="color:red;">Belum ada semester aktif. Buat semester dulu sebelum menambah jam pelajaran.</p>
    @else

    <p>Semester aktif: <strong>{{ $semesterAktif->nama }}</strong></p>

    <h3>Generate Otomatis</h3>
    <form method="POST" action="{{ route('jam-pelajaran.generate') }}">
        @csrf

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
            <select name="kelompok_hari" required>
                <option value="senin_kamis">Senin - Kamis</option>
                <option value="jumat">Jumat</option>
                <option value="senin_jumat">Senin - Jumat (semua hari)</option>
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
            <select name="kelompok_hari" required>
                <option value="senin_kamis">Senin - Kamis</option>
                <option value="jumat">Jumat</option>
                <option value="senin_jumat">Senin - Jumat (semua hari)</option>
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

    <form method="POST" action="{{ route('jam-pelajaran.bulk-update') }}" id="form-jam-pelajaran">
        @csrf

        <div class="form-row">
            <button type="button" id="btn-toggle-edit">Aktifkan Mode Edit</button>
            <button type="submit" id="btn-simpan-terpilih" style="display:none;">Simpan Perubahan Terpilih</button>
            <button type="submit" formaction="{{ route('jam-pelajaran.bulk-delete') }}" id="btn-hapus-terpilih" style="display:none;" onclick="return confirm('Yakin hapus semua baris yang dicentang?');">Hapus Terpilih</button>
        </div>

        {{-- TABEL RINGKAS (tampilan biasa, hari digabung) --}}
        <div id="tabel-ringkas">
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
                @forelse ($jamGrup ?? [] as $g)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $g->semester->nama ?? '-' }}</td>
                    <td>{{ $g->tingkat }}</td>
                    <td>{{ $g->hari }}</td>
                    <td>{{ $g->jam_ke }}</td>
                    <td>{{ $g->jam_mulai }}</td>
                    <td>{{ $g->jam_selesai }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">Belum ada jam pelajaran.</td>
                </tr>
                @endforelse
            </table>
        </div>

        {{-- TABEL EDIT (per hari, muncul saat mode edit) --}}
        <div id="tabel-edit" style="display:none;">
            <table>
                <tr>
                    <th><input type="checkbox" id="pilih-semua"></th>
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
                    <td>
                        <input type="checkbox" name="pilih[]" value="{{ $j->getKey() }}" class="cek-baris">
                    </td>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $j->semester->nama ?? '-' }}</td>
                    <td>
                        <select name="rows[{{ $j->getKey() }}][tingkat]" class="field-edit" disabled>
                            @foreach ([10, 11, 12] as $t)
                            <option value="{{ $t }}" {{ (int) $j->tingkat === $t ? 'selected' : '' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="rows[{{ $j->getKey() }}][hari]" class="field-edit" disabled>
                            @foreach (['Senin','Selasa','Rabu','Kamis','Jumat'] as $hari)
                            <option value="{{ $hari }}" {{ $j->hari === $hari ? 'selected' : '' }}>{{ $hari }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="rows[{{ $j->getKey() }}][jam_ke]" value="{{ $j->jam_ke }}" min="1" style="width:60px;" class="field-edit" disabled></td>
                    <td><input type="time" name="rows[{{ $j->getKey() }}][jam_mulai]" value="{{ substr($j->jam_mulai, 0, 5) }}" class="field-edit" disabled></td>
                    <td><input type="time" name="rows[{{ $j->getKey() }}][jam_selesai]" value="{{ substr($j->jam_selesai, 0, 5) }}" class="field-edit" disabled></td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">Belum ada jam pelajaran.</td>
                </tr>
                @endforelse
            </table>
        </div>

    </form>

    <script>
        document.getElementById('pilih-semua')?.addEventListener('change', function() {
            document.querySelectorAll('.cek-baris').forEach(cb => cb.checked = this.checked);
        });

        const btnToggle = document.getElementById('btn-toggle-edit');
        const tabelRingkas = document.getElementById('tabel-ringkas');
        const tabelEdit = document.getElementById('tabel-edit');
        const fieldEdit = document.querySelectorAll('.field-edit');
        const tombolSimpanAtas = document.getElementById('btn-simpan-terpilih');
        const tombolHapusAtas = document.getElementById('btn-hapus-terpilih');
        let modeEdit = false;

        btnToggle.addEventListener('click', function() {
            modeEdit = !modeEdit;

            tabelRingkas.style.display = modeEdit ? 'none' : '';
            tabelEdit.style.display = modeEdit ? '' : 'none';
            fieldEdit.forEach(el => el.disabled = !modeEdit);
            tombolSimpanAtas.style.display = modeEdit ? '' : 'none';
            tombolHapusAtas.style.display = modeEdit ? '' : 'none';

            btnToggle.textContent = modeEdit ? 'Batalkan Edit' : 'Aktifkan Mode Edit';
        });
    </script>

</body>

</html>