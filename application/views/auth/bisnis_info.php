<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informasi Bisnis Anda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f6f8fa; }
    .modal-content-custom {
      border-radius: 18px;
      max-width: 440px;
      margin: 48px auto;
      box-shadow: 0 8px 32px rgba(44,62,80,0.12);
      background: #fff;
      padding: 0;
    }
    .modal-header-custom {
      border-bottom: none;
      padding: 28px 32px 0 32px;
    }
    .modal-title-custom {
      font-weight: 700;
      color: #d32f2f;
      font-size: 1.6rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .modal-body-custom {
      padding: 0 32px 32px 32px;
    }
    .info-box {
      background: #e8f0fe;
      border-radius: 10px;
      padding: 12px 16px;
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .info-box .icon {
      font-size: 1.7rem;
      color: #1976d2;
    }
    .form-label {
      font-weight: 600;
      color: #222;
    }
    .form-label .opsional {
      color: #888;
      font-weight: 400;
      font-size: 0.98em;
    }
    .form-control {
      background: #f5f6fa;
      border: none;
      border-radius: 8px;
      margin-top: 4px;
    }
    .note-box {
      background: #fffbe6;
      border: 1px solid #ffe082;
      border-radius: 8px;
      padding: 10px 14px;
      margin-bottom: 18px;
      color: #b26a00;
      font-size: 0.98rem;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .btn-gradient {
      background: linear-gradient(90deg,#2196f3,#1976d2);
      color: #fff;
      border: none;
      font-weight: 600;
    }
    .btn-outline {
      border: 1px solid #ccc;
      background: #fff;
      color: #222;
      font-weight: 500;
    }
    @media (max-width: 600px) {
      .modal-content-custom { max-width: 98vw; margin: 0; }
      .modal-header-custom, .modal-body-custom { padding: 18px 8vw; }
    }
  </style>
</head>
<body>
  <div class="modal-content-custom">
    <div class="modal-header-custom d-flex justify-content-between align-items-start">
      <div class="modal-title-custom">
        <span>📝</span> Informasi Bisnis Anda
      </div>
      <button type="button" class="btn-close" aria-label="Close" onclick="window.location.href='<?= site_url('dashboard_selection'); ?>'"></button>
    </div>
    <div class="modal-body-custom">
      <div class="mb-3" style="margin-bottom:18px;">
        <div class="info-box">
          <span class="icon">📋</span>
          <div>
            <div style="font-weight:600; color:#1a237e;">Calon Pemilik UMKM</div>
            <div style="font-size:0.95rem; color:#374151;">Fokus pada perencanaan dan persiapan bisnis</div>
          </div>
        </div>
      </div>
      <form id="formInformasiBisnis">
        <div class="mb-3">
          <label class="form-label">Nama Usaha (Rencana) <span class="opsional">(Opsional)</span></label>
          <input type="text" name="nama_usaha" id="nama_usaha" class="form-control" placeholder="Contoh: Warung Makan Berkah">
        </div>
        <div class="mb-3">
          <label class="form-label">Jenis Usaha <span class="opsional">(Opsional)</span></label>
          <input type="text" name="jenis_usaha" id="jenis_usaha" class="form-control" placeholder="Contoh: Kuliner, Fashion, Jasa, Retail, dll">
        </div>
        <div class="note-box mb-3">
          <span>💡</span> Anda dapat mengubah informasi ini kapan saja di pengaturan profil
        </div>
        <div class="d-flex justify-content-between">
          <button type="button" class="btn btn-outline" onclick="window.location.href='<?= site_url('dashboard/perencanaan'); ?>'">Lewati</button>
          <button type="submit" class="btn btn-gradient">Mulai Sekarang</button>
        </div>
      </form>
    </div>
  </div>
  <script>
    document.getElementById('formInformasiBisnis').onsubmit = function(e) {
      e.preventDefault();
      fetch('<?= site_url('user/save_bisnis_info'); ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          nama_usaha: document.getElementById('nama_usaha').value,
          jenis_usaha: document.getElementById('jenis_usaha').value
        })
      }).then(r => r.json()).then(res => {
        window.location.href = '<?= site_url('dashboard/perencanaan'); ?>';
      });
    }
  </script>
</body>
</html>
