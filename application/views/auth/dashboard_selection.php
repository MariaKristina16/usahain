<?php
$user = array_merge([
    'nama'  => 'User',
    'email' => '-',
    'role'  => '-'
], $user ?? []);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pilih Dashboard - Usahain</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --primary: #1C6494;
      --primary-dark: #144d73;
      --primary-light: #2b7ec9;
      --secondary: #5bb7db;
      --accent: #65C1DF;
      --success: #2ecc71;
      --warning: #f39c12;
      --danger: #e74c3c;
      --bg-light: #f8f9fa;
      --bg-muted: #f0f4f8;
      --text-dark: #1e293b;
      --text-muted: #64748b;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .selection-container {
      max-width: 1000px;
      width: 100%;
    }

    .header-section {
      text-align: center;
      margin-bottom: 50px;
      color: white;
    }

    .header-section h1 {
      font-size: 2.5rem;
      font-weight: 800;
      margin-bottom: 12px;
    }

    .header-section p {
      font-size: 1.1rem;
      opacity: 0.95;
    }

    .dashboard-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 30px;
      margin-bottom: 30px;
    }

    .dashboard-card {
      background: white;
      border-radius: 24px;
      padding: 40px 32px;
      text-align: center;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      cursor: pointer;
      position: relative;
      overflow: hidden;
      border: 3px solid transparent;
    }

    .dashboard-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 6px;
      background: linear-gradient(90deg, #1C6494, #2563eb);
      transform: scaleX(0);
      transition: transform 0.4s;
    }

    .dashboard-card:hover::before {
      transform: scaleX(1);
    }

    .dashboard-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 30px 80px rgba(0, 0, 0, 0.25);
      border-color: rgba(28, 100, 148, 0.3);
    }

    .dashboard-card.planning {
      background: linear-gradient(135deg, #fff9f0 0%, #ffffff 100%);
    }

    .dashboard-card.operasional {
      background: linear-gradient(135deg, #e0f2fe 0%, #ffffff 100%);
    }

    .card-icon {
      width: 100px;
      height: 100px;
      margin: 0 auto 24px;
      border-radius: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 48px;
      transition: all 0.4s;
    }

    .dashboard-card.planning .card-icon {
      background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
      box-shadow: 0 12px 30px rgba(251, 191, 36, 0.3);
    }

    .dashboard-card.operasional .card-icon {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
      box-shadow: 0 12px 30px rgba(28, 100, 148, 0.3);
    }

    .dashboard-card:hover .card-icon {
      transform: scale(1.1) rotate(5deg);
    }

    .dashboard-card h3 {
      font-size: 1.75rem;
      font-weight: 800;
      color: #1e293b;
      margin-bottom: 12px;
    }

    .dashboard-card .subtitle {
      font-size: 0.95rem;
      color: #64748b;
      margin-bottom: 24px;
      font-weight: 600;
    }

    .dashboard-card p {
      color: #64748b;
      font-size: 0.95rem;
      line-height: 1.6;
      margin-bottom: 24px;
    }

    .feature-list {
      text-align: left;
      margin: 24px 0;
    }

    .feature-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 0;
      color: #475569;
      font-size: 0.9rem;
    }

    .feature-item::before {
      content: '✓';
      width: 24px;
      height: 24px;
      background: #22c55e;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 14px;
      flex-shrink: 0;
    }

    .select-btn {
      background: linear-gradient(135deg, var(--primary), var(--primary-light));
      color: white;
      padding: 14px 40px;
      border-radius: 12px;
      border: none;
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s;
      box-shadow: 0 8px 24px rgba(28, 100, 148, 0.3);
      width: 100%;
    }

    .select-btn:hover {
      background: linear-gradient(135deg, var(--primary-dark), var(--primary));
      transform: translateY(-2px);
      box-shadow: 0 12px 32px rgba(28, 100, 148, 0.4);
    }

    .logout-link {
      text-align: center;
      margin-top: 30px;
    }

    .logout-link a {
      color: white;
      text-decoration: none;
      font-size: 0.95rem;
      opacity: 0.9;
      transition: opacity 0.3s;
    }

    .logout-link a:hover {
      opacity: 1;
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .header-section h1 {
        font-size: 2rem;
      }

      .dashboard-cards {
        grid-template-columns: 1fr;
      }

      .dashboard-card {
        padding: 32px 24px;
      }
    }
  </style>
</head>
<body>
  
  <div class="selection-container">
    
    <!-- Header -->
    <div class="header-section">
      <h1>🎯 Pilih Dashboard Anda</h1>
      <p>Apakah Anda sudah memiliki usaha atau baru ingin memulai?</p>
    </div>

    <!-- Dashboard Cards -->
    <div class="dashboard-cards">
      
      <!-- Dashboard Operasional (Sudah Punya Usaha) -->
      <div class="dashboard-card operasional" onclick="selectDashboard('operasional')">
        <div class="card-icon">🚀</div>
        <h3>Sudah Memiliki Usaha</h3>
        <div class="subtitle">Dashboard Operasional</div>
        <p>Kelola dan kembangkan bisnis yang sudah berjalan dengan fitur manajemen lengkap</p>
        
        <div class="feature-list">
          <div class="feature-item">Pencatatan Keuangan Real-time</div>
          <div class="feature-item">Analisis Produk & Penjualan</div>
          <div class="feature-item">Manajemen Risiko Bisnis</div>
          <div class="feature-item">Monitoring Performa</div>
        </div>

        <button class="select-btn" type="button">Pilih Dashboard Ini</button>
      </div>

      <!-- Dashboard Perencanaan (Belum Punya Usaha) -->
      <div class="dashboard-card planning" onclick="selectDashboard('planning')">
        <div class="card-icon">💡</div>
        <h3>Belum Memiliki Usaha</h3>
        <div class="subtitle">Dashboard Perencanaan</div>
        <p>Mulai perjalanan bisnis Anda dari nol dengan panduan lengkap dan tools perencanaan</p>
        
        <div class="feature-list">
          <div class="feature-item">AI Advisor untuk ide usaha</div>
          <div class="feature-item">Kalkulator Modal & HPP</div>
          <div class="feature-item">Panduan Memulai Usaha</div>
          <div class="feature-item">Template Business Plan</div>
        </div>

        <button class="select-btn" type="button">Pilih Dashboard Ini</button>
      </div>

    </div>

    <!-- Logout Link -->
    <div class="logout-link">
      <a href="<?= site_url('auth/logout'); ?>">← Keluar</a>
    </div>

  </div>

  <!-- Modal Informasi Bisnis (Muncul setelah memilih dashboard perencanaan) -->
<div id="modalInformasiBisnis" class="modal" tabindex="-1" style="display:none; background:rgba(0,0,0,0.2);">
  <div class="modal-dialog" style="max-width: 480px; margin: 40px auto;">
    <div class="modal-content" style="border-radius:18px; overflow:hidden;">
      <div class="modal-header" style="border-bottom:none;">
        <h4 class="modal-title" style="font-weight:700; color:#d32f2f;">
          <img src="<?= base_url('assets/icons/business-info.png') ?>" style="width:28px; margin-right:8px; vertical-align:middle;"> Informasi Bisnis Anda
        </h4>
        <button type="button" class="close" onclick="document.getElementById('modalInformasiBisnis').style.display='none'" style="font-size:1.5rem; background:none; border:none;">&times;</button>
      </div>
      <div class="modal-body" style="padding-top:0;">
        <div style="background:#e8f0fe; border-radius:10px; padding:12px 16px; margin-bottom:18px; display:flex; align-items:center;">
          <img src="<?= base_url('assets/icons/clipboard.png') ?>" style="width:32px; margin-right:12px;">
          <div>
            <div style="font-weight:600; color:#1a237e;">Calon Pemilik UMKM</div>
            <div style="font-size:0.95rem; color:#374151;">Fokus pada perencanaan dan persiapan bisnis</div>
          </div>
        </div>
        <form id="formInformasiBisnis">
          <div style="margin-bottom:14px;">
            <label style="font-weight:600; color:#222;">Nama Usaha (Rencana) <span style="color:#888; font-weight:400;">(Opsional)</span></label>
            <input type="text" name="nama_usaha" id="nama_usaha" class="form-control" placeholder="Contoh: Warung Makan Berkah" style="background:#f5f6fa; border:none; border-radius:8px; margin-top:4px;">
          </div>
          <div style="margin-bottom:14px;">
            <label style="font-weight:600; color:#222;">Jenis Usaha <span style="color:#888; font-weight:400;">(Opsional)</span></label>
            <input type="text" name="jenis_usaha" id="jenis_usaha" class="form-control" placeholder="Contoh: Kuliner, Fashion, Jasa, Retail, dll" style="background:#f5f6fa; border:none; border-radius:8px; margin-top:4px;">
          </div>
          <div style="background:#fffbe6; border:1px solid #ffe082; border-radius:8px; padding:10px 14px; margin-bottom:18px; color:#b26a00; font-size:0.98rem;">
            <span style="margin-right:6px;">💡</span>Anda dapat mengubah informasi ini kapan saja di pengaturan profil
          </div>
          <div style="display:flex; justify-content:space-between;">
            <button type="button" class="btn btn-light" onclick="lewatiInformasiBisnis()" style="border:1px solid #ccc;">Lewati</button>
            <button type="submit" class="btn btn-primary" style="background:linear-gradient(90deg,#2196f3,#1976d2); border:none;">Mulai Sekarang</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
function selectDashboard(type) {
  if(type === 'planning') {
    // Redirect ke halaman pengisian informasi bisnis
    window.location.href = "<?= site_url('auth/bisnis_info'); ?>";
  } else if(type === 'operasional') {
    window.location.href = "<?= site_url('dashboard/operasional'); ?>";
  }
}

function lewatiInformasiBisnis() {
  document.getElementById('modalInformasiBisnis').style.display = 'none';
  // Lanjutkan ke dashboard perencanaan
  window.location.href = '<?= site_url('dashboard/perencanaan'); ?>';
}

document.getElementById('formInformasiBisnis').onsubmit = function(e) {
  e.preventDefault();
  // Simpan data ke server via AJAX
  fetch('<?= site_url('user/save_bisnis_info'); ?>', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      nama_usaha: document.getElementById('nama_usaha').value,
      jenis_usaha: document.getElementById('jenis_usaha').value
    })
  }).then(r => r.json()).then(res => {
    document.getElementById('modalInformasiBisnis').style.display = 'none';
    // Lanjutkan ke dashboard perencanaan
    window.location.href = '<?= site_url('dashboard/perencanaan'); ?>';
  });
}
  </script>

</body>
</html>