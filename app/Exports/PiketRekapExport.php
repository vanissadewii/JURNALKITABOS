<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PiketRekapExport implements FromArray, WithHeadings
{
    /** @param array<int, array<int, string|null>> $rows */
    public function __construct(private array $rows) {}

    public function array(): array
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return ['Tanggal', 'Jenis Rekap', 'Kelas', 'Nama Siswa', 'Guru', 'Mata Pelajaran', 'Keterangan', 'Status'];
    }
}
