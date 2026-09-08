<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
            font-family: Arial, sans-serif;
            background: #F5EFE8;
        }

        /* =========================================
           HALAMAN UTAMA
        ========================================= */

        .guru-profil {
            width: 100%;
            min-height: 100vh;
            background: #F5EFE8;
            display: flex;
            flex-direction: column;
            color: #3E3028;
        }


        /* =========================================
           HEADER
        ========================================= */

        .screen-header {
            width: 100%;
            height: 48px;
            padding: 0 16px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            border-bottom: 1px solid #E5D8CC;
        }

        .header-space {
            width: 32px;
            height: 32px;
        }

        .screen-header h1 {
            font-size: 16px;
            font-weight: 700;
        }


        /* =========================================
           CONTENT
        ========================================= */

        .content {
            width: 100%;
            flex: 1;

            padding: 24px;

            display: flex;
            flex-direction: column;
            align-items: center;

            gap: 24px;
        }


        /* =========================================
           PROFILE
        ========================================= */

        .profile {
            width: 100%;

            display: flex;
            flex-direction: column;
            align-items: center;

            gap: 12px;
        }

        .avatar {
            width: 80px;
            height: 80px;

            border-radius: 50%;
            background: #D7B899;

            display: flex;
            justify-content: center;
            align-items: center;

            font-size: 28px;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-info h2 {
            font-size: 18px;
            font-weight: 700;
            text-align: center;
        }


        /* =========================================
           DATA GURU
        ========================================= */

        .data-card {
            width: 100%;

            padding: 16px;

            background: #FFFFFF;
            border: 1px solid #E5D8CC;
            border-radius: 10px;
        }

        .data-row {
            min-height: 16px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 10px;

            font-size: 11px;
        }

        .data-label {
            color: #7A6A60;
        }

        .data-value {
            color: #3E3028;
            font-weight: 600;
            text-align: right;

            max-width: 65%;
            word-break: break-word;
        }

        .line {
            height: 1px;

            background: #E5D8CC;

            margin: 12px 0;
        }


        /* =========================================
           BUTTON
        ========================================= */

        .buttons {
            width: 100%;

            display: flex;
            flex-direction: column;

            gap: 10px;
        }

        .btn {
            width: 100%;
            height: 45px;

            border-radius: 8px;

            display: flex;
            justify-content: center;
            align-items: center;

            font-size: 14px;
            font-weight: 600;

            cursor: pointer;
        }

        .btn-edit {
            background: #5C4033;
            color: white;
        }


        /* =========================================
           NAVIGASI BAWAH
        ========================================= */

        .bottom-navigation {
            width: 100%;
            height: 64px;

            padding: 8px 0;

            background: white;
            border-top: 1px solid #E5D8CC;

            display: flex;
            justify-content: space-around;
            align-items: center;

            flex-shrink: 0;
        }

        .nav-item {
            flex: 1;

            display: flex;
            flex-direction: column;
            align-items: center;

            gap: 4px;

            font-size: 11px;
            color: #7A6A60;
        }

        .nav-icon {
            font-size: 18px;
            height: 20px;
        }

        .nav-item.active {
            color: #5C4033;
            font-weight: 600;
        }


        /* =========================================
           HP KECIL
        ========================================= */

        @media (max-width: 390px) {

            .screen-header {
                height: 48px;
                padding: 0 16px;
            }

            .content {
                padding: 24px 16px;
                gap: 24px;
            }

            .data-card {
                width: 100%;
            }

            .buttons {
                width: 100%;
            }

            .btn {
                width: 100%;
            }
        }


        /* =========================================
           HP SANGAT KECIL
        ========================================= */

        @media (max-width: 350px) {

            .content {
                padding: 20px 12px;
                gap: 20px;
            }

            .avatar {
                width: 70px;
                height: 70px;

                font-size: 24px;
            }

            .profile-info h2 {
                font-size: 16px;
            }

            .data-card {
                padding: 12px;
            }

            .data-row {
                font-size: 10px;
            }

            .btn {
                height: 43px;
                font-size: 13px;
            }

            .nav-item {
                font-size: 10px;
            }

            .nav-icon {
                font-size: 16px;
            }
        }


        /* =========================================
           LAYAR BESAR
        ========================================= */

        @media (min-width: 600px) {

            .screen-header {
                height: 70px;
                padding: 0 4%;
            }

            .screen-header h1 {
                font-size: 24px;
            }

            .header-space {
                width: 48px;
                height: 48px;
            }

            .content {
                padding: 5% 8%;
                gap: 5%;
            }

            .avatar {
                width: 120px;
                height: 120px;
                font-size: 42px;
            }

            .profile {
                gap: 18px;
            }

            .profile-info h2 {
                font-size: 28px;
            }

            .data-card {
                width: 80%;
                padding: 28px;
                border-radius: 14px;
            }

            .data-row {
                min-height: 28px;
                font-size: 16px;
            }

            .line {
                margin: 18px 0;
            }

            .buttons {
                width: 80%;
            }

            .btn {
                height: 58px;
                font-size: 18px;
                border-radius: 10px;
            }

            .bottom-navigation {
                height: 80px;
                padding: 10px 5%;
            }

            .nav-item {
                font-size: 15px;
                gap: 6px;
            }

            .nav-icon {
                font-size: 24px;
                height: 26px;
            }
        }


        /* =========================================
           LAYAR SANGAT BESAR
        ========================================= */

        @media (min-width: 1000px) {

            .screen-header {
                height: 80px;
            }

            .screen-header h1 {
                font-size: 28px;
            }

            .content {
                padding: 50px 12%;
                gap: 35px;
            }

            .avatar {
                width: 140px;
                height: 140px;
                font-size: 48px;
            }

            .profile-info h2 {
                font-size: 32px;
            }

            .data-card {
                width: 70%;
                max-width: 900px;
                padding: 32px;
            }

            .data-row {
                font-size: 18px;
                min-height: 32px;
            }

            .buttons {
                width: 70%;
                max-width: 900px;
            }

            .btn {
                height: 64px;
                font-size: 20px;
            }

            .bottom-navigation {
                height: 90px;
            }

            .nav-item {
                font-size: 17px;
            }

            .nav-icon {
                font-size: 28px;
            }
        }

    </style>
</head>

<body>

<div class="guru-profil">

    <!-- HEADER -->
    <div class="screen-header">

        <div class="header-space"></div>

        <h1>Profil Saya</h1>

        <div class="header-space"></div>

    </div>


    <!-- CONTENT -->
    <div class="content">

        <!-- PROFIL -->
        <div class="profile">

            <div class="avatar">
                ♙
            </div>

            <div class="profile-info">
                <h2>Budi Santoso, S.Pd.</h2>
            </div>

        </div>


        <!-- DATA GURU -->
        <div class="data-card">

            <div class="data-row">
                <span class="data-label">NIP</span>
                <span class="data-value">
                    198501012010011001
                </span>
            </div>

            <div class="line"></div>

            <div class="data-row">
                <span class="data-label">No. Handphone</span>
                <span class="data-value">
                    081234560001
                </span>
            </div>

            <div class="line"></div>

            <div class="data-row">
                <span class="data-label">Unit Kerja</span>
                <span class="data-value">
                    SMK Negeri 1 Jakarta
                </span>
            </div>

            <div class="line"></div>

            <div class="data-row">
                <span class="data-label">Mata Pelajaran</span>
                <span class="data-value">
                    Matematika
                </span>
            </div>

        </div>


        <!-- TOMBOL -->
        <div class="buttons">

            <div class="btn btn-edit">
                Edit Profil
            </div>

        </div>

    </div>


    <!-- NAVIGASI BAWAH -->
    <div class="bottom-navigation">

        <div class="nav-item">
            <div class="nav-icon">⌂</div>
            <span>Dashboard</span>
        </div>

        <div class="nav-item">
            <div class="nav-icon">▣</div>
            <span>Jurnal</span>
        </div>

        <div class="nav-item">
            <div class="nav-icon">▤</div>
            <span>Rekap</span>
        </div>

        <div class="nav-item active">
            <div class="nav-icon">○</div>
            <span>Profil</span>
        </div>

    </div>

</div>

</body>
</html>