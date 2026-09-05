<?php

use Illuminate\Support\Facades\Route;

// Saat buka localhost langsung tampilkan halaman Login
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Route ke Dashboard Guru
Route::get('/dashboard-guru', function () {
    return view('guru.dashboard_guru');
});

// Route ke Mulai Sesi
Route::get('/mulai-sesi', function () {
    return view('guru.mulai_sesi');
});
