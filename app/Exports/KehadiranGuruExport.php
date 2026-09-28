<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KehadiranGuruExport implements FromArray, WithHeadings
{
    /** @param array<int, array<int, string|int|null>> $rows */
    public function __construct(private array $rows) {}

    public function array(): array
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return ['Guru', 'Mata Pelajaran', 'Status', 'Materi / Keterangan', 'Kelas', 'Jam ke', 'Waktu'];
    }
}
