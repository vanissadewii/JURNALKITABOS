<?php

return [
    'admin_phone' => env('JURNAL_ADMIN_PHONE', '087782599520'),
    'dispen_public_url' => env('JURNAL_DISPEN_PUBLIC_URL', env('APP_URL', 'http://localhost')),
    'toleransi_tidak_hadir' => (int) env('JURNAL_TOLERANSI_TIDAK_HADIR', 15),
];
