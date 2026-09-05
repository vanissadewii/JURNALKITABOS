@extends('layouts.kelas')

@section('title', 'Scan Sesi Mengajar')

@section('content')

<style>
    * {
        box-sizing: border-box;
    }

    .scan-page {
        width: 100%;
        min-height: 100vh;
        background: #F5EFE8;
        color: #3E3028;
        font-family: 'Inter', sans-serif;
    }

    /* HEADER */
    .scan-header {
        width: 100%;
        height: 64px;
        background: #5C4033;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        color: #FFFFFF;
    }

    .scan-back {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFFFFF;
        text-decoration: none;
        font-size: 25px;
        flex-shrink: 0;
    }

    .scan-header h1 {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        font-size: 17px;
        font-weight: 600;
        text-align: center;
    }

    .header-space {
        width: 36px;
        flex-shrink: 0;
    }

    /* CONTENT */
    .scan-content {
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        padding: 28px 20px 40px;
    }

    .scan-section {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .scan-title {
        margin: 0 0 6px;
        font-family: 'Poppins', sans-serif;
        font-size: 20px;
        font-weight: 700;
        text-align: center;
        color: #3E3028;
    }

    .scan-subtitle {
        margin: 0 0 24px;
        font-size: 13px;
        line-height: 1.5;
        text-align: center;
        color: #7A6A60;
    }

    /* QR */
    .qr-container {
        width: 220px;
        height: 220px;
        background: #FFFFFF;
        border: 1px solid #E5D8CC;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 18px;
        box-shadow: 0 4px 15px rgba(62, 48, 40, 0.06);
    }

    .qr-placeholder {
        width: 180px;
        height: 180px;
        background:
            linear-gradient(90deg, #3E3028 10px, transparent 10px) 0 0 / 30px 30px,
            linear-gradient(#3E3028 10px, transparent 10px) 0 0 / 30px 30px,
            linear-gradient(90deg, transparent 20px, #3E3028 20px 30px) 0 0 / 30px 30px,
            linear-gradient(transparent 20px, #3E3028 20px 30px) 0 0 / 30px 30px;
        position: relative;
    }

    .qr-placeholder::before,
    .qr-placeholder::after {
        content: "";
        position: absolute;
        width: 38px;
        height: 38px;
        border: 8px solid #3E3028;
        background: #FFFFFF;
    }

    .qr-placeholder::before {
        top: 0;
        left: 0;
    }

    .qr-placeholder::after {
        right: 0;
        bottom: 0;
    }

    /* INFO CARD */
    .info-card {
        width: 100%;
        background: #FFFFFF;
        border: 1px solid #E5D8CC;
        border-radius: 10px;
        padding: 16px;
        margin-top: 24px;
        box-shadow: 0 4px 12px rgba(62, 48, 40, 0.04);
    }

    .info-title {
        margin-bottom: 12px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: #3E3028;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 9px 0;
        border-bottom: 1px solid #E5D8CC;
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
        font-weight: 600;
        text-align: right;
    }

    /* WARNING */
    .warning-box {
        width: 100%;
        margin-top: 16px;
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
        flex-shrink: 0;
        border-radius: 50%;
        background: #4A90C2;
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
    }

    .warning-text {
        margin: 0;
        font-size: 12px;
        line-height: 1.5;
        color: #245A7A;
    }

    /* RESPONSIVE */
    @media (max-width: 430px) {

        .scan-header {
            height: 56px;
            padding: 0 16px;
        }

        .scan-header h1 {
            font-size: 16px;
        }

        .scan-content {
            padding: 24px 16px 32px;
        }

        .scan-title {
            font-size: 19px;
        }

        .qr-container {
            width: 210px;
            height: 210px;
        }

        .qr-placeholder {
            width: 170px;
            height: 170px;
        }
    }

    @media (max-width: 360px) {

        .scan-content {
            padding-left: 14px;
            padding-right: 14px;
        }

        .scan-title {
            font-size: 18px;
        }

        .scan-subtitle {
            font-size: 12px;
        }

        .qr-container {
            width: 190px;
            height: 190px;
        }

        .qr-placeholder {
            width: 150px;
            height: 150px;
        }

        .info-card {
            padding: 14px;
        }

        .info-row {
            font-size: 12px;
        }

        .warning-text {
            font-size: 11px;
        }
    }

    @media (min-width: 768px) {

        .scan-content {
            padding-top: 40px;
        }

        .scan-title {
            font-size: 22px;
        }
    }
</style>


<div class="scan-page">

    {{-- HEADER --}}
    <div class="scan-header">

        <a href="{{ url()->previous() }}" class="scan-back">
            ←
        </a>

        <h1>Scan Sesi Mengajar</h1>

        <div class="header-space"></div>

    </div>


    <div class="scan-content">

        <div class="scan-section">

            <h2 class="scan-title">
                QR Code Siswa
            </h2>

            <p class="scan-subtitle">
                Tunjukkan QR Code ini kepada guru Anda
                untuk memulai verifikasi sesi.
            </p>


            <div class="qr-container">
                <div class="qr-placeholder"></div>
            </div>


            <div class="info-card">

                <div class="info-title">
                    Detail Sesi Mengajar
                </div>

                <div class="info-row">
                    <span class="info-label">Guru Pengajar</span>
                    <span class="info-value">Kurnila Putri, S.Pd.</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Mata Pelajaran</span>
                    <span class="info-value">PPLG</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Kelas</span>
                    <span class="info-value">XI RPL 1</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Jam</span>
                    <span class="info-value">07:00 - 09:40</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Status</span>
                    <span class="info-value">Sesi Aktif</span>
                </div>

            </div>


            <div class="warning-box">

                <div class="warning-icon">
                    !
                </div>

                <p class="warning-text">
                    Pastikan Anda berada di kelas dan guru tersebut
                    benar sedang mengajar sebelum melakukan konfirmasi.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection