<?php

namespace App\Services;

use App\Models\Jurnal;

class SesiKelas
{
    /** @param array<int, int> $ids */
    public function __construct(
        public array $ids,
        public int $id_guru,
        public int $id_mapel,
        public string $mapel,
        public string $guru,
        public int $jam_ke_mulai,
        public int $jam_ke_sampai,
        public string $jam_mulai,
        public string $jam_selesai,
        public string $status,
        public ?Jurnal $jurnal = null,
    ) {}
}
