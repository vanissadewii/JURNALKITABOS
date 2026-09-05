@extends('layouts.kelas')

@section('title', 'Verifikasi Sukses')

@section('content')

<style>
    .success-page {
        min-height: 100vh;
        background: #F5EFE8;
        padding-bottom: 30px;
    }

    .success-header {
        height: 56px;
        background: white;
        border-bottom: 1px solid #E5D8CC;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .success-header h1 {
        margin: 0;
        color: #3E3028;
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
        font-weight: 600;
    }

    .success-content {
        max-width: 500px;
        margin: 0 auto;
        padding: 40px 24px 20px;
        text-align: center;
    }

    .success-icon {
        width: 72px;
        height: 72px;
        margin: 0 auto 18px;
        border-radius: 50%;
        background: #E8F5E9;
        border: 2px solid #2E7D32;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #2E7D32;
        font-size: 36px;
        font-weight: bold;
    }

    .success-title {
        margin: 0 0 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 20px;
        font-weight: 600;
        color: #2E7D32;
    }

    .success-subtitle {
        margin: 0 auto 24px;
        max-width: 320px;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        line-height: 1.5;
        color: #7A6A60;
    }

    .detail-card {
        background: white;
        border: 1px solid #E5D8CC;
        border-radius: 10px;
        padding: 16px;
        text-align: left;
        box-shadow: 0 2px 8px rgba(62, 48, 40, 0.06);
    }

    .detail-header {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    position: relative;
    }

    .detail-title {
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: #3E3028;
    }

    .verified-badge {
        padding: 5px 9px;
        border-radius: 20px;
        background: #E8F5E9;
        color: #2E7D32;
        font-family: 'Inter', sans-serif;
        font-size: 11px;
        font-weight: 600;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 10px 0;
        border-bottom: 1px solid #E5D8CC;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: #7A6A60;
    }

    .detail-value {
        color: #3E3028;
        font-weight: 500;
        text-align: right;
    }

    .status-mengajar {
        color: #795548;
        font-weight: 600;
    }

    .home-button {
        width: 100%;
        height: 45px;
        margin-top: 24px;
        border: none;
        border-radius: 8px;
        background: #5C4033;
        color: white;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
    }

    .home-button:hover {
        background: #4B3329;
    }

    @media (max-width: 400px) {
        .success-content {
            padding: 32px 20px 20px;
        }

        .detail-row {
            font-size: 12px;
        }
    }
</style>


<div class="success-page">

    <div class="success-header">
        <h1>Verifikasi Sukses</h1>
    </div>

    <div class="success-content">

        {{-- ICON BERHASIL --}}
        <div class="success-icon">
            ✓
        </div>

        {{-- JUDUL --}}
        <h2 class="success-title">
            Konfirmasi Berhasil
        </h2>

        <p class="success-subtitle">
            Kehadiran Anda telah terverifikasi oleh sistem.
        </p>


        {{-- DETAIL KEHADIRAN --}}
        <div class="detail-card">

            <div class="detail-header">
                <div class="detail-title">
                    Detail Kehadiran
                </div>
            </div>

            <div class="detail-row">
                <span class="detail-label">
                    Guru
                </span>

                <span class="detail-value">
                    Kurnila Putri, S.Pd.
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">
                    Mata Pelajaran
                </span>

                <span class="detail-value">
                    PPLG
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">
                    Kelas
                </span>

                <span class="detail-value">
                    XI RPL 2
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">
                    Waktu Check-in
                </span>

                <span class="detail-value">
                    07:03 WIB
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">
                    Status Kelas
                </span>

                <span class="detail-value status-mengajar">
                    SEDANG MENGAJAR
                </span>
            </div>

        </div>


        {{-- KEMBALI --}}
        <a href="{{ route('kelas.beranda') }}" class="home-button">
            Kembali ke Beranda
        </a>

    </div>

</div>

@endsection