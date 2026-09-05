@extends('layouts.kelas')

@section('title', 'Verifikasi Guru')

@section('content')

<style>
    .verifikasi-page {
        min-height: 100vh;
        background: #F5EFE8;
        padding-bottom: 30px;
    }

    .verifikasi-header {
        background: #5C4033;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 16px;
        color: white;
    }

    .verifikasi-back {
        color: white;
        text-decoration: none;
        font-size: 26px;
        width: 40px;
    }

    .verifikasi-header h1 {
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        text-align: center;
        flex: 1;
    }

    .header-space {
        width: 40px;
    }

    .verifikasi-content {
        padding: 24px 16px;
        max-width: 500px;
        margin: 0 auto;
    }

    .verifikasi-title {
        text-align: center;
        font-family: 'Poppins', sans-serif;
        font-size: 20px;
        font-weight: 600;
        color: #3E3028;
        margin: 0 0 8px;
    }

    .verifikasi-subtitle {
        text-align: center;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        line-height: 1.5;
        color: #7A6A60;
        margin: 0 auto 22px;
        max-width: 330px;
    }

    /* AREA SCAN */
    .scanner-box {
        width: 220px;
        height: 220px;
        margin: 0 auto 16px;
        background: #2D221C;
        border: 4px dashed #D7B899;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .scanner-camera {
        width: 70px;
        height: 70px;
        border: 2px solid #D7B899;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #D7B899;
        font-size: 28px;
    }

    .scan-line {
        position: absolute;
        width: 170px;
        height: 2px;
        background: #D7B899;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .scan-instruction {
        text-align: center;
        color: #3E3028;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        line-height: 1.5;
        margin: 0 0 20px;
    }

    /* INFO CARD */
    .info-card {
        width: 100%;
        background: white;
        border: 1px solid #E5D8CC;
        border-radius: 10px;
        padding: 16px;
        box-sizing: border-box;
        margin-bottom: 16px;
    }

    .info-title {
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: #3E3028;
        margin-bottom: 10px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 10px 0;
        border-bottom: 1px solid #E5D8CC;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
    }

    .info-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .info-label {
        color: #7A6A60;
    }

    .info-value {
        color: #3E3028;
        font-weight: 500;
        text-align: right;
    }

    /* WARNING */
    .warning-box {
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 20px;
        padding: 13px 14px;
        background: #EAF4FF;
        border: 1px solid #B8D8F5;
        border-radius: 8px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .warning-icon {
        width: 20px;
        height: 20px;
        min-width: 20px;
        border-radius: 50%;
        background: #5C4033;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
    }

    .warning-text {
        margin: 0;
        font-family: 'Inter', sans-serif;
        font-size: 12px;
        line-height: 1.5;
        color: #3E3028;
    }

    /* BUTTON */
    .confirm-button {
        width: 100%;
        height: 45px;
        border: none;
        border-radius: 8px;
        background: #5C4033;
        color: white;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
    }

    .confirm-button:hover {
        background: #4B3329;
    }

    @media (max-width: 400px) {
        .verifikasi-content {
            padding: 20px 16px;
        }

        .scanner-box {
            width: 200px;
            height: 200px;
        }

        .scan-line {
            width: 155px;
        }

        .verifikasi-title {
            font-size: 18px;
        }
    }
</style>


<div class="verifikasi-page">

    {{-- HEADER --}}
    <div class="verifikasi-header">

        <a href="{{ url()->previous() }}" class="verifikasi-back">
            ←
        </a>

        <h1>Verifikasi Guru</h1>

        <div class="header-space"></div>

    </div>


    <div class="verifikasi-content">

        {{-- JUDUL --}}
        <h2 class="verifikasi-title">
            Scan QR Guru
        </h2>

        <p class="verifikasi-subtitle">
            Arahkan kamera ke QR Code yang ditampilkan
            oleh guru Anda untuk memverifikasi sesi mengajar.
        </p>


        {{-- SCANNER --}}
        <div class="scanner-box">

            <div class="scanner-camera">
                ⌾
            </div>

            <div class="scan-line"></div>

        </div>

        <p class="scan-instruction">
            Arahkan kamera ke QR Code guru
        </p>


        {{-- DETAIL SESI --}}
        <div class="info-card">

            <div class="info-title">
                Detail Sesi Mengajar
            </div>

            <div class="info-row">
                <span class="info-label">
                    Guru Pengajar
                </span>

                <span class="info-value">
                    Kurnila Putri, S.Pd.
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">
                    Mata Pelajaran
                </span>

                <span class="info-value">
                    PPLG
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">
                    Kelas
                </span>

                <span class="info-value">
                    XI RPL 1
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">
                    Jam
                </span>

                <span class="info-value">
                    07:00 - 09:40
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">
                    Status
                </span>

                <span class="info-value">
                    Sesi Aktif
                </span>
            </div>

        </div>


        {{-- PERINGATAN --}}
        <div class="warning-box">

            <div class="warning-icon">
                !
            </div>

            <p class="warning-text">
                Pastikan QR Code berasal dari guru yang
                sedang mengajar di kelas Anda.
            </p>

        </div>

    </div>

</div>


<script>
    function konfirmasiSesi() {
        alert('Sesi mengajar berhasil dikonfirmasi.');
    }
</script>

@endsection