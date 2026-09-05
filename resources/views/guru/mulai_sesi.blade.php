<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mulai Sesi Mengajar</title>
  
  <!-- Import Font Google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
  
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #dcd6cd;
      font-family: 'Inter', sans-serif;
    }

    /* Screen Container */
    .screen-container {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: flex-start;
      width: 390px;
      height: 844px;
      min-height: 844px;
      background: #F9F6F0;
      position: relative;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(62, 48, 40, 0.15);
      border-radius: 28px;
    }

    .top-frame {
      display: flex;
      flex-direction: column;
      width: 100%;
    }

    /* Screen Header Top Bar */
    .screen-header {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
      padding: 16px 20px;
      width: 100%;
      background: #FFFFFF;
      border-bottom: 1px solid #EFE6DD;
    }

    .back-button {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 36px;
      height: 36px;
      border-radius: 10px;
      background: #F9F6F0;
      color: #3E3028;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .back-button:active {
      transform: scale(0.95);
    }

    .header-title {
      font-family: 'Poppins', sans-serif;
      font-weight: 700;
      font-size: 16px;
      color: #3E3028;
    }

    .header-placeholder {
      width: 36px;
    }

    /* Content Area */
    .content-area {
      display: flex;
      flex-direction: column;
      padding: 20px;
      gap: 16px;
      width: 100%;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
    }

    .section-title {
      font-family: 'Poppins', sans-serif;
      font-weight: 700;
      font-size: 16px;
      color: #3E3028;
    }

    .status-badge {
      display: flex;
      align-items: center;
      padding: 5px 12px;
      background: #F0E6DF;
      border-radius: 20px;
      font-weight: 600;
      font-size: 11px;
      color: #795548;
    }

    /* Detail Card */
    .detail-card {
      display: flex;
      flex-direction: column;
      padding: 20px;
      gap: 14px;
      width: 100%;
      background: #FFFFFF;
      border: 1px solid #EFE6DD;
      border-radius: 18px;
      box-shadow: 0 8px 24px rgba(92, 64, 51, 0.05);
    }

    .info-group {
      display: flex;
      flex-direction: column;
      gap: 3px;
    }

    .info-label {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 0.6px;
      text-transform: uppercase;
      color: #9E8E83;
    }

    .info-value-main {
      font-family: 'Poppins', sans-serif;
      font-weight: 700;
      font-size: 15px;
      color: #3E3028;
    }

    .info-value-sub {
      font-size: 12px;
      color: #7A6A60;
    }

    .card-line {
      width: 100%;
      height: 1px;
      background-color: #F4EDE6;
    }

    /* Instruction Text */
    .instruction-text {
      font-size: 12px;
      line-height: 18px;
      text-align: center;
      color: #8C7B70;
      padding: 0 8px;
    }

    /* Action Footer Group */
    .action-footer {
      display: flex;
      flex-direction: column;
      padding: 20px;
      gap: 12px;
      width: 100%;
    }

    .primary-button {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 48px;
      background: linear-gradient(135deg, #5C4033 0%, #4A3329 100%);
      border: none;
      border-radius: 12px;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: 14px;
      color: #FFFFFF;
      box-shadow: 0 4px 12px rgba(92, 64, 51, 0.25);
      cursor: pointer;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .primary-button:active {
      transform: scale(0.98);
    }

    .secondary-button {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 48px;
      background: #FFFFFF;
      border: 1.5px solid #5C4033;
      border-radius: 12px;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: 14px;
      color: #5C4033;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .secondary-button:active {
      transform: scale(0.98);
      background: #F9F6F0;
    }
  </style>
</head>
<body>

  <div class="screen-container">
    <!-- Top Content Group -->
    <div class="top-frame">
      
      <!-- Top Screen Header -->
      <div class="screen-header">
        <a href="{{ url('/dashboard-guru') }}" class="back-button" aria-label="Kembali">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3E3028" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <h1 class="header-title">Mulai Sesi Mengajar</h1>
        <div class="header-placeholder"></div>
      </div>

      <!-- Content Area -->
      <div class="content-area">
        
        <!-- Section Header -->
        <div class="section-header">
          <h2 class="section-title">Detail Sesi Mengajar</h2>
          <div class="status-badge">
            <span>Sesi Aktif</span>
          </div>
        </div>

        <!-- Detail Card -->
        <div class="detail-card">
          
          <!-- Guru -->
          <div class="info-group">
            <span class="info-label">Guru Pengajar</span>
            <span class="info-value-main">Budi Santoso, S.Pd.</span>
            <span class="info-value-sub">NIP. 198501012010011001</span>
          </div>

          <div class="card-line"></div>

          <!-- Mata Pelajaran -->
          <div class="info-group">
            <span class="info-label">Mata Pelajaran</span>
            <span class="info-value-main">Matematika (Wajib)</span>
          </div>

          <div class="card-line"></div>

          <!-- Kelas & Ruangan -->
          <div class="info-group">
            <span class="info-label">Kelas & Ruangan</span>
            <span class="info-value-main">X RPL 1 (Ruang Lab 2)</span>
          </div>

          <div class="card-line"></div>

          <!-- Jam Pembelajaran -->
          <div class="info-group">
            <span class="info-label">Jam Pembelajaran</span>
            <span class="info-value-main">Jam Ke-1 • 07:00 – 07:45</span>
          </div>

        </div>

        <!-- Instruction Text -->
        <p class="instruction-text">
          Lakukan scan QR Code kelas untuk memverifikasi Anda berada di lokasi kelas yang benar.
        </p>

      </div>

    </div>

    <!-- Bottom Action Footer -->
    <div class="action-footer">
      <button class="primary-button" onclick="alert('Fitur Kamera QR Scanner Siap!')">Scan QR Kelas</button>
      <a href="{{ url('/dashboard-guru') }}" class="secondary-button">Kembali</a>
    </div>
  </div>

</body>
</html>