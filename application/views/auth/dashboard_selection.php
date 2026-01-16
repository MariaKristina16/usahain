<?php
$user = array_merge([
    'nama'  => 'User',
    'email' => '-',
    'role'  => '-'
], (array)($user ?? []));
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
      --primary: #1F6B99;
      --primary-dark: #154A6F;
      --primary-light: #E8F4FB;
      --secondary: #7EC8E3;
      --success: #10B981;
      --warning: #F59E0B;
      --danger: #EF4444;
      --bg-light: #F8FAFC;
      --bg-muted: #f0f4f8;
      --text-dark: #1E293B;
      --text-muted: #64748B;
      --border: #E2E8F0;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f0f7fd 0%, #e8f4fb 100%);
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
      color: #1F6B99;
    }

    .header-section h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 12px;
      color: #1F6B99;
    }

    .header-section p {
      font-size: 1.1rem;
      color: #64748B;
      opacity: 1;
    }

    .dashboard-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 30px;
      margin-bottom: 30px;
    }

    .dashboard-card {
      background: white;
      border-radius: 32px;
      padding: 40px 32px;
      text-align: center;
      box-shadow: 0 8px 24px rgba(31, 107, 153, 0.08);
      transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
      cursor: pointer;
      position: relative;
      overflow: hidden;
      border: 2px solid rgba(232, 244, 251, 0.6);
    }

    .dashboard-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 6px;
      background: linear-gradient(90deg, #1F6B99, #7EC8E3);
      transform: scaleX(0);
      transition: transform 0.4s;
    }

    .dashboard-card:hover::before {
      transform: scaleX(1);
    }

    .dashboard-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 16px 48px rgba(31, 107, 153, 0.12);
      border-color: rgba(31, 107, 153, 0.2);
    }

    .dashboard-card.planning {
      background: linear-gradient(135deg, #FFFBF7 0%, #ffffff 100%);
    }

    .dashboard-card.operasional {
      background: linear-gradient(135deg, #F5FAFE 0%, #ffffff 100%);
    }

    .card-icon {
      width: 100px;
      height: 100px;
      margin: 0 auto 24px;
      border-radius: 28px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 48px;
      transition: all 0.5s;
    }

    .dashboard-card.planning .card-icon {
      background: linear-gradient(135deg, #FEC97A 0%, #F59E0B 100%);
      box-shadow: 0 8px 20px rgba(245, 158, 11, 0.15);
    }

    .dashboard-card.operasional .card-icon {
      background: linear-gradient(135deg, #7EC8E3 0%, #5BB8D0 100%);
      box-shadow: 0 8px 20px rgba(31, 107, 153, 0.15);
    }

    .dashboard-card:hover .card-icon {
      transform: scale(1.1) rotate(5deg);
    }

    .dashboard-card h3 {
      font-size: 1.75rem;
      font-weight: 800;
      color: #1E293B;
      margin-bottom: 12px;
    }

    .dashboard-card .subtitle {
      font-size: 0.95rem;
      color: #1F6B99;
      margin-bottom: 24px;
      font-weight: 600;
    }

    .dashboard-card p {
      color: #64748B;
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
      background: #10B981;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 14px;
      flex-shrink: 0;
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    .select-btn {
      background: linear-gradient(135deg, #1F6B99, #1A5A88);
      color: white;
      padding: 14px 40px;
      border-radius: 14px;
      border: none;
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.4s;
      box-shadow: 0 6px 16px rgba(31, 107, 153, 0.15);
      width: 100%;
    }

    .select-btn:hover {
      background: linear-gradient(135deg, #1A5A88, #154A6F);
      transform: translateY(-2px);
      box-shadow: 0 10px 24px rgba(31, 107, 153, 0.2);
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
      <h1><svg width="40" height="40" viewBox="0 0 40 40" fill="none" style="display:inline-block; margin-right:12px; vertical-align:middle; filter: drop-shadow(0 4px 8px rgba(31,107,153,0.2));"><defs><linearGradient id="gradTarget" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:#1F6B99;stop-opacity:1" /><stop offset="100%" style="stop-color:#7EC8E3;stop-opacity:1" /></linearGradient></defs><circle cx="20" cy="20" r="18" fill="url(#gradTarget)" opacity="0.15"/><circle cx="20" cy="20" r="14" fill="url(#gradTarget)"/><circle cx="20" cy="20" r="10" fill="white" opacity="0.3"/><circle cx="20" cy="20" r="6" fill="white"/><path d="M20 14v12M14 20h12" stroke="white" stroke-width="1.5" stroke-linecap="round" opacity="0.8"/></svg>Pilih Dashboard Anda</h1>
      <p>Apakah Anda sudah memiliki usaha atau baru ingin memulai?</p>
    </div>

    <!-- Dashboard Cards -->
    <div class="dashboard-cards">
      
      <!-- Dashboard Operasional (Sudah Punya Usaha) -->
      <div class="dashboard-card operasional" onclick="selectDashboard('operasional')">
        <div class="card-icon"><svg width="64" height="64" viewBox="0 0 64 64" fill="none" style="filter: drop-shadow(0 8px 16px rgba(31,107,153,0.2));"><defs><linearGradient id="gradBuild" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:#1F6B99;stop-opacity:1" /><stop offset="100%" style="stop-color:#7EC8E3;stop-opacity:1" /></linearGradient></defs><rect x="16" y="20" width="32" height="36" rx="2" fill="url(#gradBuild)" opacity="0.15"/><rect x="16" y="20" width="32" height="36" rx="2" stroke="url(#gradBuild)" stroke-width="2.5" fill="none"/><rect x="20" y="26" width="6" height="7" fill="url(#gradBuild)" opacity="0.8"/><rect x="29" y="26" width="6" height="7" fill="url(#gradBuild)" opacity="0.8"/><rect x="38" y="26" width="6" height="7" fill="url(#gradBuild)" opacity="0.8"/><rect x="20" y="36" width="6" height="7" fill="url(#gradBuild)" opacity="0.8"/><rect x="29" y="36" width="6" height="7" fill="url(#gradBuild)" opacity="0.8"/><rect x="38" y="36" width="6" height="7" fill="url(#gradBuild)" opacity="0.8"/><path d="M32 8L40 16H24Z" fill="url(#gradBuild)" opacity="0.6"/><line x1="32" y1="8" x2="32" y2="16" stroke="url(#gradBuild)" stroke-width="1.5"/></svg></div>
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
        <div class="card-icon"><svg width="64" height="64" viewBox="0 0 64 64" fill="none" style="filter: drop-shadow(0 8px 16px rgba(245,158,11,0.2));"><defs><linearGradient id="gradBulb" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:#F59E0B;stop-opacity:1" /><stop offset="100%" style="stop-color:#F97316;stop-opacity:1" /></linearGradient></defs><path d="M32 10C24 10 18 16 18 24c0 6 2 10 4 14l2 4h12l2-4c2-4 4-8 4-14c0-8-6-14-14-14z" fill="url(#gradBulb)" opacity="0.2"/><path d="M32 10C24 10 18 16 18 24c0 6 2 10 4 14l2 4h12l2-4c2-4 4-8 4-14c0-8-6-14-14-14z" stroke="url(#gradBulb)" stroke-width="2.5" fill="none" stroke-linejoin="round"/><rect x="26" y="42" width="12" height="3" rx="1" fill="url(#gradBulb)" opacity="0.8"/><rect x="28" y="46" width="8" height="2" rx="1" fill="url(#gradBulb)" opacity="0.6"/><circle cx="32" cy="26" r="4" fill="url(#gradBulb)" opacity="0.4"/><path d="M28 28L36 28" stroke="url(#gradBulb)" stroke-width="1.5" stroke-linecap="round" opacity="0.6"/></svg></div>
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
<div id="modalInformasiBisnis" class="modal" tabindex="-1" style="display:none; background:rgba(0,0,0,0.15); backdrop-filter: blur(2px);">
  <div class="modal-dialog" style="max-width: 480px; margin: 40px auto;">
    <div class="modal-content" style="border-radius:24px; overflow:hidden; border:1px solid rgba(31,107,153,0.1); box-shadow: 0 12px 40px rgba(31,107,153,0.12);">
      <div class="modal-header" style="border-bottom:none; background:linear-gradient(135deg, #F5FAFE 0%, #ffffff 100%); padding: 28px;">
        <h4 class="modal-title" style="font-weight:700; color:#1F6B99; font-size:1.3rem;">
          <svg width="28" height="28" viewBox="0 0 28 28" fill="none" style="display:inline-block; margin-right:12px; vertical-align:middle; filter: drop-shadow(0 2px 4px rgba(31,107,153,0.15));"><defs><linearGradient id="gradDoc" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:#1F6B99;stop-opacity:1" /><stop offset="100%" style="stop-color:#7EC8E3;stop-opacity:1" /></linearGradient></defs><rect x="5" y="3" width="18" height="22" rx="1.5" fill="url(#gradDoc)" opacity="0.15" stroke="url(#gradDoc)" stroke-width="1.5"/><line x1="9" y1="9" x2="19" y2="9" stroke="url(#gradDoc)" stroke-width="1.5" stroke-linecap="round"/><line x1="9" y1="14" x2="19" y2="14" stroke="url(#gradDoc)" stroke-width="1.5" stroke-linecap="round"/><line x1="9" y1="19" x2="15" y2="19" stroke="url(#gradDoc)" stroke-width="1.5" stroke-linecap="round"/></svg>Informasi Bisnis Anda
        </h4>
        <button type="button" class="close" onclick="document.getElementById('modalInformasiBisnis').style.display='none'" style="font-size:1.5rem; background:none; border:none; color:#64748B;">&times;</button>
      </div>
      <div class="modal-body" style="padding: 24px; background: white;">
        <div style="background:#F5FAFE; border-radius:14px; padding:14px 16px; margin-bottom:20px; display:flex; align-items:center; border: 1px solid rgba(31,107,153,0.1);">
          <svg width="36" height="36" viewBox="0 0 36 36" fill="none" style="margin-right:12px; flex-shrink:0; filter: drop-shadow(0 2px 4px rgba(31,107,153,0.1));"><defs><linearGradient id="gradBrief" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:#1F6B99;stop-opacity:1" /><stop offset="100%" style="stop-color:#7EC8E3;stop-opacity:1" /></linearGradient></defs><rect x="6" y="12" width="24" height="16" rx="1.5" fill="url(#gradBrief)" opacity="0.15" stroke="url(#gradBrief)" stroke-width="1.5"/><path d="M12 12V9c0-1.1.9-2 2-2h8c1.1 0 2 .9 2 2v3" stroke="url(#gradBrief)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="18" cy="20" r="2.5" fill="url(#gradBrief)" opacity="0.8"/><line x1="13" y1="16" x2="15" y2="16" stroke="url(#gradBrief)" stroke-width="1" stroke-linecap="round" opacity="0.5"/><line x1="21" y1="16" x2="23" y2="16" stroke="url(#gradBrief)" stroke-width="1" stroke-linecap="round" opacity="0.5"/></svg>
          <div style="text-align: left;">
            <div style="font-weight:600; color:#1F6B99; margin-bottom: 4px;">Calon Pemilik UMKM</div>
            <div style="font-size:0.95rem; color:#64748B;">Fokus pada perencanaan dan persiapan bisnis</div>
          </div>
        </div>
        <form id="formInformasiBisnis">
          <div style="margin-bottom:16px;">
            <label style="font-weight:600; color:#1E293B; display: block; margin-bottom: 8px;">Nama Usaha (Rencana) <span style="color:#64748B; font-weight:400;">(Opsional)</span></label>
            <input type="text" name="nama_usaha" id="nama_usaha" class="form-control" placeholder="Contoh: Warung Makan Berkah" style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:10px; padding: 10px 12px; font-size: 0.95rem;">
          </div>
          <div style="margin-bottom:16px;">
            <label style="font-weight:600; color:#1E293B; display: block; margin-bottom: 8px;">Jenis Usaha <span style="color:#64748B; font-weight:400;">(Opsional)</span></label>
            <input type="text" name="jenis_usaha" id="jenis_usaha" class="form-control" placeholder="Contoh: Kuliner, Fashion, Jasa, Retail, dll" style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:10px; padding: 10px 12px; font-size: 0.95rem;">
          </div>
          <div style="background:#FFFBF7; border:1px solid #F59E0B; border-radius:10px; padding:12px 14px; margin-bottom:20px; color:#92400E; font-size:0.95rem; display: flex; gap: 10px; align-items: flex-start;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" style="flex-shrink: 0; margin-top: 0px; filter: drop-shadow(0 1px 2px rgba(245,158,11,0.1));"><defs><linearGradient id="gradAlert" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:#F59E0B;stop-opacity:1" /><stop offset="100%" style="stop-color:#F97316;stop-opacity:1" /></linearGradient></defs><circle cx="12" cy="12" r="9.5" fill="url(#gradAlert)" opacity="0.15" stroke="url(#gradAlert)" stroke-width="1.5"/><path d="M12 7v4M12 13v2" stroke="url(#gradAlert)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg><span>Anda dapat mengubah informasi ini kapan saja di pengaturan profil</span>
          </div>
          <div style="display:flex; gap: 12px;">
            <button type="button" class="btn btn-light" onclick="lewatiInformasiBisnis()" style="flex: 1; border:1px solid #E2E8F0; color:#1E293B; border-radius: 10px; background: white; transition: all 0.3s;">Lewati</button>
            <button type="submit" class="btn btn-primary" style="flex: 1; background:linear-gradient(135deg, #1F6B99, #1A5A88); border:none; color:white; border-radius: 10px; transition: all 0.3s; box-shadow: 0 4px 12px rgba(31,107,153,0.15);">Mulai Sekarang</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
function selectDashboard(type) {
  if(type === 'planning') {
    // Tampilkan modal, jangan redirect
    document.getElementById('modalInformasiBisnis').style.display = 'block';
  } else if(type === 'operasional') {
    window.location.href = "<?= site_url('dashboard/operasional'); ?>";
  }
}

function lewatiInformasiBisnis() {
  // Close modal and redirect to planning dashboard without saving
  document.getElementById('modalInformasiBisnis').style.display = 'none';
  window.location.href = "<?= site_url('auth/dashboard_planning'); ?>";
}

document.getElementById('formInformasiBisnis').onsubmit = function(e) {
  e.preventDefault();
  
  const nama_usaha = document.getElementById('nama_usaha').value.trim();
  const jenis_usaha = document.getElementById('jenis_usaha').value.trim();
  
  // Show loading state
  const submitBtn = document.querySelector('#formInformasiBisnis button[type="submit"]');
  const originalText = submitBtn.textContent;
  submitBtn.disabled = true;
  submitBtn.textContent = '⏳ Menyimpan...';
  
  console.log('📤 Sending save_bisnis_info request', { nama_usaha, jenis_usaha });
  
  fetch('<?= site_url('user/save_bisnis_info'); ?>', {
    method: 'POST',
    headers: { 
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: JSON.stringify({
      nama_usaha: nama_usaha,
      jenis_usaha: jenis_usaha
    })
  })
  .then(response => {
    console.log('📊 Response status:', response.status, response.statusText);
    
    // Check if response is JSON
    const contentType = response.headers.get('content-type');
    console.log('📋 Content-Type:', contentType);
    
    if (!contentType || !contentType.includes('application/json')) {
      throw new Error('Response bukan JSON: ' + contentType);
    }
    
    return response.json().then(data => ({ 
      status: response.status, 
      data: data 
    }));
  })
  .then(({ status, data }) => {
    console.log('📥 Response data:', data);
    
    // Check if response was successful
    if (data.status === 'success' && status === 200) {
      console.log('✅ SUCCESS: Data tersimpan');
      document.getElementById('modalInformasiBisnis').style.display = 'none';
      setTimeout(() => {
        window.location.href = '<?= site_url('dashboard/perencanaan'); ?>';
      }, 500);
    } else {
      // Error response dari backend
      console.error('❌ Backend error:', data.message || data.error);
      const errorMsg = data.message || data.error || 'Gagal menyimpan data';
      alert('Error: ' + errorMsg);
      
      // Restore button
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
    }
  })
  .catch(err => {
    console.error('❌ Fetch error:', err.message);
    console.error('Stack:', err.stack);
    
    // Show detailed error message
    let errorMessage = 'Gagal menyimpan data. ';
    
    if (err.message.includes('JSON')) {
      errorMessage += 'Server response tidak valid JSON. Check console (F12).';
    } else if (err.message.includes('Failed to fetch')) {
      errorMessage += 'Tidak bisa terhubung ke server. Check connection.';
    } else {
      errorMessage += err.message;
    }
    
    alert(errorMessage);
    
    // Restore button
    submitBtn.disabled = false;
    submitBtn.textContent = originalText;
  });
}
  </script>

</body>
</html>