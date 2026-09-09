<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Scan QR Kelas</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #1C1611;
        }

        /* =========================
           HALAMAN UTAMA
        ========================= */

        .scan-page {
            width: 100%;
            min-height: 100vh;
            background: #1C1611;
            color: #FFFFFF;

            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* =========================
           BAGIAN ATAS
        ========================= */

        .top-section {
            width: 100%;
        }

        /* Header */

        .dark-header {
            width: 100%;
            height: 80px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 16px;
        }

        /* Tombol kembali */

        .back-button {
            width: 32px;
            height: 32px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;
            text-decoration: none;

            font-size: 32px;
            font-weight: 300;
        }

        /* Judul */

        .dark-header h1 {
            font-family: Arial, sans-serif;
            font-size: 16px;
            font-weight: 600;

            line-height: 24px;

            text-align: center;
        }

        /* Kotak kosong sebelah kanan
           supaya judul tetap di tengah */

        .header-space {
            width: 32px;
            height: 32px;
        }

        /* =========================
           AREA SCAN
        ========================= */

        .scan-section {
            width: 100%;

            display: flex;
            flex-direction: column;
            align-items: center;

            padding-top: 40px;
            gap: 24px;
        }

        /* Kotak kamera / QR */

        .viewfinder {
            width: 260px;
            height: 260px;

            background: #2D221C;

            border: 4px dashed #D7B899;

            border-radius: 16px;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Bentuk scan di tengah */

        .scan-icon {
            width: 140px;
            height: 140px;

            position: relative;

            opacity: 0.3;
        }

        /* Empat sudut scan */

        .scan-icon::before {
            content: "";

            position: absolute;

            top: 0;
            left: 0;

            width: 30px;
            height: 30px;

            border-top: 2px solid #D7B899;
            border-left: 2px solid #D7B899;
        }

        .scan-icon::after {
            content: "";

            position: absolute;

            right: 0;
            bottom: 0;

            width: 30px;
            height: 30px;

            border-right: 2px solid #D7B899;
            border-bottom: 2px solid #D7B899;
        }

        .scan-corner-top-right {
            position: absolute;

            top: 0;
            right: 0;

            width: 30px;
            height: 30px;

            border-top: 2px solid #D7B899;
            border-right: 2px solid #D7B899;
        }

        .scan-corner-bottom-left {
            position: absolute;

            bottom: 0;
            left: 0;

            width: 30px;
            height: 30px;

            border-bottom: 2px solid #D7B899;
            border-left: 2px solid #D7B899;
        }

        /* Keterangan */

        .instruction {
            width: 280px;

            font-size: 14px;
            font-weight: 500;

            line-height: 17px;

            text-align: center;

            color: #FFFFFF;
        }

        /* =========================
           BAGIAN FLASH
        ========================= */

        .flash-section {
            width: 100%;
            height: 128px;

            display: flex;
            align-items: flex-start;
            justify-content: center;

            padding: 40px;
        }

        /* Tombol flash */

        .flash-button {
            width: 48px;
            height: 48px;

            border: none;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.12549);

            display: flex;
            align-items: center;
            justify-content: center;

            cursor: pointer;
        }

        /* Icon petir */

        .bolt {
            position: relative;

            width: 20px;
            height: 20px;
        }

        .bolt::before {
            content: "ϟ";

            position: absolute;

            left: 2px;
            top: -6px;

            color: #FFFFFF;

            font-size: 28px;
            font-weight: 400;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (min-width: 600px) {

            .scan-page {
                max-width: 390px;
                margin: 0 auto;
            }
        }

        @media (max-width: 350px) {

            .viewfinder {
                width: 230px;
                height: 230px;
            }

            .scan-section {
                padding-top: 25px;
            }

            .instruction {
                width: 90%;
            }
        }
    </style>
</head>

<body>

<div class="scan-page">

    <!-- BAGIAN ATAS -->
    <div class="top-section">

        <!-- HEADER -->
        <div class="dark-header">

            <!-- Tombol kembali -->
            <a href="/mulai-sesi" class="back-button">
                ‹
            </a>

            <!-- Judul -->
            <h1>
                Scan QR Kelas
            </h1>

            <!-- Penyeimbang -->
            <div class="header-space"></div>

        </div>


        <!-- AREA SCAN -->
        <div class="scan-section">

            <!-- Kotak QR -->
            <div class="viewfinder">

                <div class="scan-icon">

                    <div class="scan-corner-top-right"></div>

                    <div class="scan-corner-bottom-left"></div>

                </div>

            </div>


            <!-- Keterangan -->
            <p class="instruction">
                Arahkan kamera ke QR Code kelas.
            </p>

        </div>

    </div>


    <!-- BAGIAN FLASH -->
    <div class="flash-section">

        <button class="flash-button" type="button">

            <div class="bolt"></div>

        </button>

    </div>

</div>

</body>
</html>