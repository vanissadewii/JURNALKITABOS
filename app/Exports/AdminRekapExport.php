<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminRekapExport implements FromArray, WithHeadings
{
    /** @param array<int, array<int, string|null>> $rows */
    public function __construct(private array $rows) {}
    public function array(): array { return $this->rows; }
    public function headings(): array { return ['Tanggal', 'Kelas', 'Guru', 'Mata Pelajaran', 'Jam ke', 'Materi', 'Jumlah Hadir', 'Kehadiran Guru', 'Status Piket', 'Alasan Penolakan']; }
}
