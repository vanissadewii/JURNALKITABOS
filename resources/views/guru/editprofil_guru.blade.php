<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Guru</title>

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

        .guru-edit {
            width: 100%;
            min-height: 100vh;
            background: #F5EFE8;
            display: flex;
            flex-direction: column;
            color: #3E3028;
        }

        /* HEADER */
        .screen-header {
            width: 100%;
            height: 48px;
            padding: 0 16px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #FFFFFF;
            border-bottom: 1px solid #E5D8CC;
        }

        .screen-header h1 {
            font-size: 16px;
            font-weight: 700;
            text-align: center;
        }

        /* CONTENT */
        .content {
            width: 100%;
            flex: 1;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        /* PROFIL */
        .profile-edit {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
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
            color: #5C4033;
        }

        .ubah-foto {
            font-size: 12px;
            font-weight: 600;
            color: #5C4033;
            cursor: pointer;
        }

        /* DATA PROFIL */
        .form-card {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            background: #FFFFFF;
            border: 1px solid #E5D8CC;
            border-radius: 10px;
        }

        .form-group {
            width: 100%;
            margin-bottom: 16px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-size: 12px;
            font-weight: 600;
            color: #7A6A60;
        }

        .form-group input {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid #D9C9BA;
            border-radius: 7px;
            background: #FFFFFF;
            color: #3E3028;
            font-size: 13px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #5C4033;
        }

        /* UBAH PASSWORD */
        .password-card {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            background: #FFFFFF;
            border: 1px solid #E5D8CC;
            border-radius: 10px;
        }

        .password-title {
            margin-bottom: 16px;
            font-size: 15px;
            font-weight: 700;
            color: #3E3028;
        }

        .password-group {
            width: 100%;
            margin-bottom: 16px;
        }

        .password-group:last-child {
            margin-bottom: 0;
        }

        .password-group label {
            display: block;
            margin-bottom: 7px;
            font-size: 12px;
            font-weight: 600;
            color: #7A6A60;
        }

        /* INPUT PASSWORD */
        .password-input {
            width: 100%;
            position: relative;
        }

        .password-input input {
            width: 100%;
            height: 42px;
            padding: 0 45px 0 12px;
            border: 1px solid #D9C9BA;
            border-radius: 7px;
            background: #FFFFFF;
            color: #3E3028;
            font-size: 13px;
            outline: none;
        }

        .password-input input:focus {
            border-color: #5C4033;
        }

        /* ICON MATA */
        .eye-button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);

            width: 24px;
            height: 24px;

            border: none;
            background: transparent;
            padding: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            cursor: pointer;
        }

        .eye-icon {
            width: 20px;
            height: 13px;

            border: 2px solid #3E3028;
            border-radius: 50% / 70%;

            position: relative;
            display: block;
        }

        .eye-icon::after {
            content: "";
            position: absolute;

            width: 6px;
            height: 6px;

            background: #3E3028;
            border-radius: 50%;

            top: 50%;
            left: 50%;

            transform: translate(-50%, -50%);
        }

        /* MATA DICORET */
        .eye-icon.hidden::before {
            content: "";

            position: absolute;

            width: 25px;
            height: 2px;

            background: #3E3028;

            top: 50%;
            left: 50%;

            transform: translate(-50%, -50%) rotate(45deg);

            z-index: 2;
        }

        /* BUTTON */
        .buttons {
            width: 100%;
            max-width: 600px;

            display: flex;
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
            text-decoration: none;
        }

        .btn-save {
            background: #5C4033;
            color: #FFFFFF;
            border: none;
        }

        .btn-cancel {
            background: #FFFFFF;
            color: #5C4033;
            border: 1px solid #5C4033;
        }

        /* NAVIGASI BAWAH */
        .bottom-navigation {
            width: 100%;
            height: 64px;

            padding: 8px 0;

            background: #FFFFFF;
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

        /* ICON PROFIL */
        .profile-icon {
            width: 22px;
            height: 22px;

            position: relative;

            display: flex;
            justify-content: center;
        }

        .profile-head {
            width: 8px;
            height: 8px;

            border: 2px solid #5C4033;
            border-radius: 50%;

            position: absolute;
            top: 0;
        }

        .profile-body {
            width: 18px;
            height: 10px;

            border: 2px solid #5C4033;
            border-bottom: none;
            border-radius: 12px 12px 0 0;

            position: absolute;
            bottom: 0;
        }

        /* RESPONSIVE */
        @media (max-width: 600px) {

            .content {
                padding: 20px 16px;
                gap: 18px;
            }

            .form-card,
            .password-card,
            .buttons {
                width: 100%;
                max-width: 100%;
            }

            .form-card,
            .password-card {
                padding: 16px;
            }
        }

        @media (max-width: 350px) {

            .content {
                padding: 18px 12px;
                gap: 16px;
            }

            .avatar {
                width: 70px;
                height: 70px;
                font-size: 24px;
            }

            .form-card,
            .password-card {
                padding: 12px;
            }

            .form-group,
            .password-group {
                margin-bottom: 13px;
            }

            .form-group input,
            .password-input input {
                height: 40px;
                font-size: 12px;
            }

            .password-title {
                font-size: 14px;
            }

            .btn {
                height: 42px;
                font-size: 13px;
            }

            .nav-item {
                font-size: 10px;
            }
        }

        @media (min-width: 800px) {

            .screen-header {
                height: 64px;
            }

            .screen-header h1 {
                font-size: 22px;
            }

            .content {
                padding: 40px 8%;
                gap: 25px;
            }

            .avatar {
                width: 100px;
                height: 100px;
                font-size: 36px;
            }

            .form-card,
            .password-card {
                max-width: 700px;
                padding: 28px;
            }

            .form-group label,
            .password-group label {
                font-size: 14px;
            }

            .form-group input,
            .password-input input {
                height: 48px;
                font-size: 15px;
            }

            .password-title {
                font-size: 18px;
            }

            .buttons {
                max-width: 700px;
            }

            .btn {
                height: 52px;
                font-size: 16px;
            }

            .bottom-navigation {
                height: 75px;
            }

            .nav-item {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

<div class="guru-edit">

    <!-- HEADER -->
    <div class="screen-header">
        <h1>Edit Profil</h1>
    </div>


    <!-- CONTENT -->
    <div class="content">

        <!-- PROFIL -->
        <div class="profile-edit">

            <div class="avatar">
                ♙
            </div>

            <div class="ubah-foto">
                Ubah Foto
            </div>

        </div>


        <!-- DATA PROFIL -->
        <div class="form-card">

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input
                    type="text"
                    value="Budi Santoso, S.Pd."
                >
            </div>

            <div class="form-group">
                <label>NIP</label>
                <input
                    type="text"
                    value="198501012010011001"
                >
            </div>

            <div class="form-group">
                <label>No. Handphone</label>
                <input
                    type="text"
                    value="081234560001"
                >
            </div>

            <div class="form-group">
                <label>Unit Kerja</label>
                <input
                    type="text"
                    value="SMK Negeri 1 Jakarta"
                >
            </div>

            <div class="form-group">
                <label>Mata Pelajaran</label>
                <input
                    type="text"
                    value="Matematika"
                >
            </div>

        </div>


        <!-- UBAH PASSWORD -->
        <div class="password-card">

            <div class="password-title">
                Ubah Password
            </div>

            <div class="password-group">

                <label>Password Lama</label>

                <div class="password-input">

                    <input
                        type="password"
                        id="passwordLama"
                        placeholder="Masukkan password lama"
                    >

                    <button
                        type="button"
                        class="eye-button"
                        onclick="togglePassword('passwordLama', this)"
                    >
                        <span class="eye-icon"></span>
                    </button>

                </div>

            </div>


            <div class="password-group">

                <label>Password Baru</label>

                <div class="password-input">

                    <input
                        type="password"
                        id="passwordBaru"
                        placeholder="Masukkan password baru"
                    >

                    <button
                        type="button"
                        class="eye-button"
                        onclick="togglePassword('passwordBaru', this)"
                    >
                        <span class="eye-icon"></span>
                    </button>

                </div>

            </div>


            <div class="password-group">

                <label>Konfirmasi Password Baru</label>

                <div class="password-input">

                    <input
                        type="password"
                        id="konfirmasiPassword"
                        placeholder="Ulangi password baru"
                    >

                    <button
                        type="button"
                        class="eye-button"
                        onclick="togglePassword('konfirmasiPassword', this)"
                    >
                        <span class="eye-icon"></span>
                    </button>

                </div>

            </div>

        </div>


        <!-- BUTTON -->
        <div class="buttons">

            <div class="btn btn-save">
                Simpan Perubahan
            </div>

            <div class="btn btn-cancel">
                Batal
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


<!-- JAVASCRIPT -->
<script>
function togglePassword(inputId, button) {

    const input = document.getElementById(inputId);
    const icon = button.querySelector(".eye-icon");

    if (input.type === "password") {

        input.type = "text";
        icon.classList.add("hidden");

    } else {

        input.type = "password";
        icon.classList.remove("hidden");

    }
}
</script>

</body>
</html>