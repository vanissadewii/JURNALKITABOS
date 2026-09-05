<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Guru</title>
  
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

    /* Screen Dashboard Container */
    .screen-dashboard {
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

    /* Top Frame Group */
    .top-frame {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      width: 100%;
    }

    /* Dashboard Header */
    .dashboard-header {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      padding: 28px 24px 24px 24px;
      gap: 18px;
      width: 100%;
      background: linear-gradient(135deg, #5C4033 0%, #3E2B22 100%);
      box-shadow: 0 4px 20px rgba(92, 64, 51, 0.2);
      border-bottom-left-radius: 24px;
      border-bottom-right-radius: 24px;
    }

    .user-info-row {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
      width: 100%;
    }

    .user-text {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 4px;
    }

    .greeting {
      font-size: 13px;
      font-weight: 500;
      letter-spacing: 0.3px;
      color: #E2C7B0;
    }

    .user-name {
      font-family: 'Poppins', sans-serif;
      font-size: 22px;
      font-weight: 700;
      line-height: 28px;
      color: #FFFFFF;
      letter-spacing: -0.3px;
    }

    .user-role {
      font-size: 12px;
      font-weight: 400;
      color: #D7B899;
      opacity: 0.9;
    }

    /* Logo Khas Jurnal Guru (Buku Jurnal + Pena) */
    .header-logo-box {
      width: 58px;
      height: 58px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #FFFFFF 0%, #F5EFE8 100%);
      border: 2px solid #E2C7B0;
      border-radius: 18px;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }

    .date-row {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 8px;
      background: rgba(255, 255, 255, 0.1);
      padding: 6px 12px;
      border-radius: 20px;
      backdrop-filter: blur(4px);
    }

    .icon-calendar-sm {
      width: 14px;
      height: 14px;
    }

    .date-text {
      font-size: 12px;
      font-weight: 500;
      color: #FFF8F0;
    }

    /* Schedule Section */
    .schedule-section {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      padding: 24px 20px;
      gap: 16px;
      width: 100%;
    }

    .section-title {
      font-family: 'Poppins', sans-serif;
      font-weight: 700;
      font-size: 13px;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      color: #7A6A60;
    }

    /* Card Utama Modern */
    .schedule-card {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      padding: 20px;
      gap: 16px;
      width: 100%;
      background: #FFFFFF;
      border: 1px solid #EFE6DD;
      box-shadow: 0px 8px 24px rgba(92, 64, 51, 0.06);
      border-radius: 18px;
      position: relative;
      overflow: hidden;
    }

    .schedule-card::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 5px;
      background: #F57F17;
      border-top-left-radius: 18px;
      border-bottom-left-radius: 18px;
    }

    .card-header {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: flex-start;
      width: 100%;
    }

    .class-info {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 2px;
    }

    .subject-title {
      font-family: 'Poppins', sans-serif;
      font-weight: 700;
      font-size: 20px;
      line-height: 26px;
      color: #3E3028;
    }

    .class-subtitle {
      font-weight: 600;
      font-size: 13px;
      color: #8C7B70;
    }

    .status-badge {
      display: flex;
      align-items: center;
      padding: 6px 12px;
      background: #FFF8E1;
      border: 1px solid #FFE082;
      border-radius: 20px;
      font-weight: 600;
      font-size: 11px;
      color: #E65100;
    }

    .card-divider {
      width: 100%;
      height: 1px;
      background-color: #F2E9E1;
    }

    .time-info {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      font-weight: 500;
      color: #6D5C52;
      background: #F9F6F0;
      padding: 8px 12px;
      border-radius: 8px;
      width: 100%;
    }

    .icon-clock {
      width: 16px;
      height: 16px;
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
      box-shadow: 0 2px 6px rgba(92, 64, 51, 0.2);
    }

    /* Bottom Navigation Group */
    .bottom-group {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      width: 100%;
    }

    .bottom-navigation {
      display: flex;
      flex-direction: row;
      justify-content: space-around;
      align-items: center;
      padding: 10px 0 14px 0;
      width: 100%;
      height: 70px;
      background: #FFFFFF;
      border-top: 1px solid #EFE6DD;
      box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.03);
    }

    .nav-tab {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 4px;
      width: 80px;
      text-decoration: none;
      font-size: 11px;
      font-weight: 500;
      color: #9E8E83;
      transition: all 0.2s ease;
    }

    .nav-tab.active {
      font-weight: 700;
      color: #5C4033;
    }

    .nav-tab.active .nav-icon path {
      stroke: #5C4033;
      stroke-width: 2.2;
    }

    .nav-icon {
      width: 22px;
      height: 22px;
    }
  </style>
</head>
<body>

  <div class="screen-dashboard">
    <!-- Top Content Group -->
    <div class="top-frame">
      
      <!-- Dashboard Header -->
      <div class="dashboard-header">
        <div class="user-info-row">
          <div class="user-text">
            <span class="greeting">Selamat Datang,</span>
            <h1 class="user-name">Budi Santoso</h1>
            <span class="user-role">Guru Matematika • NIP. 19850101...</span>
          </div>
          
          <!-- Logo Spesifik Jurnal Mengajar (Buku Catatan Bergaris + Pena) -->
          <div class="header-logo-box">
            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="3" y="3" width="15" height="18" rx="2.5" fill="#5C4033"/>
              <circle cx="5.5" cy="6" r="0.8" fill="#D7B899"/>
              <circle cx="5.5" cy="12" r="0.8" fill="#D7B899"/>
              <circle cx="5.5" cy="18" r="0.8" fill="#D7B899"/>
              <line x1="9" y1="7" x2="15" y2="7" stroke="#E2C7B0" stroke-width="1.5" stroke-linecap="round"/>
              <line x1="9" y1="10.5" x2="15" y2="10.5" stroke="#E2C7B0" stroke-width="1.5" stroke-linecap="round"/>
              <line x1="9" y1="14" x2="13" y2="14" stroke="#E2C7B0" stroke-width="1.5" stroke-linecap="round"/>
              <path d="M14 19L20.5 12.5C21 12 21 11 20.5 10.5L19.5 9.5C19 9 18 9 17.5 9.5L11 16V19H14Z" fill="#D73800" stroke="#FFFFFF" stroke-width="1"/>
            </svg>
          </div>
        </div>

        <div class="date-row">
          <svg class="icon-calendar-sm" viewBox="0 0 14 14" fill="none" stroke="#E2C7B0" stroke-width="1.5">
            <rect x="2" y="3" width="10" height="9" rx="1"/>
            <path d="M4 1v2M10 1v2M2 6h10"/>
          </svg>
          <span class="date-text" id="current-date">--</span>
        </div>
      </div>

      <!-- Schedule Section -->
      <div class="schedule-section">
        <h2 class="section-title">Jadwal Mengajar Saat Ini</h2>
        
        <div class="schedule-card">
          <div class="card-header">
            <div class="class-info">
              <h3 class="subject-title">Matematika</h3>
              <span class="class-subtitle">Kelas X RPL 1</span>
            </div>
            <div class="status-badge">
              <span>Belum Dimulai</span>
            </div>
          </div>

          <div class="card-divider"></div>

          <div class="time-info">
            <svg class="icon-clock" viewBox="0 0 16 16" fill="none" stroke="#6D5C52" stroke-width="1.6">
              <circle cx="8" cy="8" r="6"/>
              <path d="M8 4.5v4.25l2.5 1.5"/>
            </svg>
            <span>Jam ke-1 (07:00 – 07:45)</span>
          </div>

          <!-- Tombol Mengarah ke Halaman Mulai Sesi -->
          <a href="{{ url('/mulai-sesi') }}" class="primary-button">Mulai Sesi Mengajar</a>
        </div>
      </div>

    </div>

    <!-- Bottom Navigation Group -->
    <div class="bottom-group">
      <nav class="bottom-navigation">
        <a href="{{ url('/dashboard-guru') }}" class="nav-tab active">
          <svg class="nav-icon" viewBox="0 0 20 20" fill="none" stroke="#9E8E83" stroke-width="1.8">
            <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
          </svg>
          <span>Dashboard</span>
        </a>
        <a href="{{ url('/jurnal-guru') }}" class="nav-tab">
          <svg class="nav-icon" viewBox="0 0 20 20" fill="none" stroke="#9E8E83" stroke-width="1.8">
            <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
            <path d="M7 3v14"/>
          </svg>
          <span>Jurnal</span>
        </a>
        <a href="{{ url('/profil-guru') }}" class="nav-tab">
          <svg class="nav-icon" viewBox="0 0 20 20" fill="none" stroke="#9E8E83" stroke-width="1.8">
            <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
            <circle cx="10" cy="6.5" r="3.5"/>
          </svg>
          <span>Profil</span>
        </a>
      </nav>
    </div>
  </div>

  <script>
    // Format tanggal otomatis mengikuti hari saat ini
    const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
    const today = new Date().toLocaleDateString('id-ID', options);
    document.getElementById('current-date').textContent = today;
  </script>

</body>
</html>