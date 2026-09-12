<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\JamPelajaran;
use App\Models\User;
use App\Models\Mapel;
use App\Models\JadwalPelajaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Database\Eloquent\Model;

class JadwalPelajaranImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    // Menyimpan baris yang lolos validasi tapi gagal dicocokkan ke data master
    protected array $tidakCocok = [];

    public function model(array $row): ?Model
{
    $tingkat = (string) $row['tingkat'];   // <-- paksa jadi string

    $kelas = Kelas::where('tingkat', $tingkat)
        ->where('jurusan', $row['jurusan'])
        ->where('rombel', $row['rombel'])
        ->first();

    $jam = JamPelajaran::where('tingkat', $tingkat)   // <-- pakai $tingkat juga
        ->where('hari', $row['hari'])
        ->where('jam_ke', $row['jam_ke'])
        ->whereHas('semester', fn ($q) => $q->where('status', 'aktif'))
        ->first();

    $guru = User::where('name', $row['nama_guru'])
        ->where('role', 'guru')
        ->first();

    $mapel = Mapel::where('nama_mapel', $row['nama_mapel'])->first();

    if (!$kelas || !$jam || !$guru || !$mapel) {
        $sebab = [];
        if (!$kelas) $sebab[] = "kelas (tingkat={$tingkat}, jurusan={$row['jurusan']}, rombel={$row['rombel']}) tidak ditemukan";
        if (!$jam)   $sebab[] = "jam pelajaran (tingkat={$tingkat}, hari={$row['hari']}, jam_ke={$row['jam_ke']}, semester aktif) tidak ditemukan";
        if (!$guru)  $sebab[] = "guru '{$row['nama_guru']}' tidak ditemukan";
        if (!$mapel) $sebab[] = "mapel '{$row['nama_mapel']}' tidak ditemukan";

        $this->tidakCocok[] = implode('; ', $sebab);

        return null;
    }

    return new JadwalPelajaran([
        'id_kelas' => $kelas->id_kelas,
        'id_jam'   => $jam->id_jam,
        'id_guru'  => $guru->id,
        'id_mapel' => $mapel->id_mapel,
    ]);
}

    public function rules(): array
    {
        return [
            'tingkat'    => 'required',
            'jurusan'    => 'required|string',
            'rombel'     => 'required|integer',
            'hari'       => 'required|string',
            'jam_ke'     => 'required|integer',
            'nama_guru'  => 'required|string',
            'nama_mapel' => 'required|string',
        ];
    }

    public function getTidakCocok(): array
    {
        return $this->tidakCocok;
    }
}