@extends('layouts.kelas')

@section('title', 'Dasbor')

@section('content')

<style>
    .header-kelas {
        background: #5C4033;
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .sapaan {
        color: #D7B899;
        font-size: 13px;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
    }

    .nama-kelas {
        color: #FFFFFF;
        font-size: 22px;
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
    }

    .tanggal {
        color: #D7B899;
        font-size: 12px;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        margin-top: 2px;
    }

    .content-kelas {
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .section-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        color: #3E3028;
        margin-top: 4px;
    }

    .session-card {
        background: #FFFFFF;
        border: 1px solid #E5D8CC;
        border-radius: 10px;
        padding: 16px;

        display: flex;
        flex-direction: column;
        gap: 16px;

        box-shadow: 0 4px 12px rgba(62, 48, 40, 0.03);
    }

    .session-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .mapel {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: #3E3028;
    }

    .guru {
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        font-size: 14px;
        color: #7A6A60;
        margin-top: 2px;
    }

    .status {
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
        white-space: nowrap;
    }

    /* STATUS SESI */
    .status-berjalan {
        background: #FFFDE7;
        color: #F57F17;
    }

    .status-belum {
        background: #F5F5F5;
        color: #7A6A60;
    }

    .status-selesai {
        background: #E8F5E9;
        color: #2E7D32;
    }

    .session-card hr {
        border: none;
        border-top: 1px solid #E5D8CC;
        width: 100%;
        margin: 0;
    }

    .jam {
        display: flex;
        align-items: center;
        gap: 6px;

        font-size: 13px;
        color: #7A6A60;
        font-family: 'Inter', sans-serif;
    }

    .jam svg {
        flex-shrink: 0;
    }

    .btn-scan {
        background: #5C4033;
        color: #FFFFFF;

        border: none;
        border-radius: 8px;

        padding: 12px;

        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 14px;

        cursor: pointer;
        width: 100%;

        transition: 0.2s ease;
    }

    .btn-scan:hover {
        opacity: 0.9;
    }

    /* CHECK SUDAH SCAN */
    .scan-selesai {
        display: flex;
        align-items: center;
        gap: 8px;

        font-family: 'Inter', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: #2E7D32;
    }

    .check-box {
        width: 20px;
        height: 20px;
        border-radius: 5px;
        background: #4CAF50;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .check-box svg {
        width: 13px;
        height: 13px;
    }

    .status-tidak-hadir {
    background: #F5F5F5;
    color: #757575;
    }

    .guru-tidak-hadir {
    display: flex;
    align-items: center;
    gap: 8px;

    font-family: 'Inter', sans-serif;
    font-size: 13px;
    font-weight: 600;
    color: #757575;
    }

    .icon-tidak-hadir {
    width: 20px;
    height: 20px;
    border-radius: 5px;
    background: #9E9E9E;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #FFFFFF;
    font-size: 13px;
    font-weight: bold;
    }

    @media (min-width: 600px) {

        .header-kelas {
            padding: 26px;
        }

        .content-kelas {
            padding: 24px;
        }

        .session-card {
            padding: 18px;
        }
    }

    @media (min-width: 900px) {

        .header-kelas {
            padding: 28px;
        }

        .nama-kelas {
            font-size: 24px;
        }

        .content-kelas {
            padding: 28px;
        }

        .session-card {
            padding: 20px;
        }
    }

    @media (max-width: 430px) {

        .header-kelas {
            padding: 20px 16px;
        }

        .nama-kelas {
            font-size: 20px;
        }

        .content-kelas {
            padding: 16px;
        }

        .session-card {
            padding: 14px;
        }

        .mapel {
            font-size: 17px;
        }

        .guru {
            font-size: 13px;
        }
    }

    @media (max-width: 380px) {

        .session-header {
            align-items: flex-start;
        }

        .mapel {
            font-size: 16px;
        }

        .guru {
            font-size: 12px;
        }

        .status {
            font-size: 10px;
            padding: 4px 8px;
        }

        .btn-scan {
            font-size: 13px;
        }
    }

</style>


<!-- =========================
     HEADER
========================= -->

<div class="header-kelas">

    <span class="sapaan">
        Hai 👋
    </span>

    <span class="nama-kelas">
        {{ $kelas->nama_kelas ?? 'XI RPL 2' }}
    </span>

    <span class="tanggal">
        {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
    </span>

</div>


<div class="content-kelas">

    <!-- SESI MENGAJAR -->
    <span class="section-title">
        Sesi Mengajar Aktif
    </span>

    <div class="session-card">

        <div class="session-header">

            <div>
                <div class="mapel">
                    Matematika
                </div>

                <div class="guru">
                    Badrus Sulaiman, S.Pd., Gr.
                </div>
            </div>

            <span class="status status-berjalan">
                Sedang Berjalan
            </span>

        </div>

        <hr>

        <div class="jam">

            <svg width="14"
                 height="14"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="#7A6A60"
                 stroke-width="2">

                <circle cx="12" cy="12" r="9"/>
                <path d="M12 7v5l3 3"/>

            </svg>

            <span>
                10:00 – 13:50 (Jam ke-5 sampai ke-8)
            </span>

        </div>

        <div class="scan-selesai">

            <div class="check-box">

                <svg viewBox="0 0 24 24"
                     fill="none"
                     stroke="#FFFFFF"
                     stroke-width="3">

                    <path d="M5 12l4 4L19 6"/>

                </svg>

            </div>

            <span>
                Kehadiran terverifikasi
            </span>

        </div>

    </div>

    <!-- BAHASA INGGRIS -->
    <div class="session-card">

        <div class="session-header">

            <div>
                <div class="mapel">
                    Bahasa Inggris
                </div>

                <div class="guru">
                    Siti Aminah, S.Pd.
                </div>
            </div>

            <span class="status status-belum">
                Belum Dimulai
            </span>

        </div>

        <hr>

        <div class="jam">

            <svg width="14"
                 height="14"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="#7A6A60"
                 stroke-width="2">

                <circle cx="12" cy="12" r="9"/>
                <path d="M12 7v5l3 3"/>

            </svg>

            <span>
                13:00 – 15:00 (Jam ke-9 sampai ke-10)
            </span>

        </div>

    </div>


    <span class="section-title">
        Sesi Mengajar Selesai
    </span>

    <div class="session-card">

        <div class="session-header">

            <div>
                <div class="mapel">
                    PJOK
                </div>

                <div class="guru">
                    Zainul Arifin, S.Pd.
                </div>
            </div>

            <span class="status status-tidak-hadir">
                Tidak Hadir
            </span>

        </div>

        <hr>

        <div class="jam">

            <svg width="14"
                 height="14"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="#7A6A60"
                 stroke-width="2">

                <circle cx="12" cy="12" r="9"/>
                <path d="M12 7v5l3 3"/>

            </svg>

            <span>
                07:00 – 09:40 (Jam ke-1 sampai ke-4)
            </span>

        </div>

        <div class="guru-tidak-hadir">

        <div class="icon-tidak-hadir">
             ✕
        </div>

        <span>
        Guru tidak hadir
        </span>

        </div>

    </div>

</div>

@endsection