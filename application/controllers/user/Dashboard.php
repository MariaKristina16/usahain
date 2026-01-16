<?php
$user = $user ?? [
    'nama'  => 'User',
    'usaha'=> 'Bisnis Anda',
    'type' => 'UMKM'
];

$summary = array_merge([
    'today_sales'   => 0,
    'today_expense' => 0,
    'today_profit'  => 0
], $summary ?? []);

$transactions = $transactions ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Usahain</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:Segoe UI,Arial,sans-serif;background:#f2f6f9;color:#333}

        .navbar{
            background:#2b7ec9;
            color:#fff;
            padding:16px 24px;
            display:flex;
            justify-content:space-between;
            align-items:center
        }

        .navbar h2{font-size:22px}
        .navbar a{color:#fff;text-decoration:none;font-weight:600}

        .container{
            max-width:1100px;
            margin:24px auto;
            padding:16px
        }

        .welcome{
            background:#fff;
            padding:20px;
            border-radius:12px;
            margin-bottom:20px
        }

        .welcome h1{font-size:22px;margin-bottom:6px}
        .welcome p{color:#666}

        .summary{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:14px;
            margin-bottom:20px
        }

        .card{
            background:#fff;
            padding:18px;
            border-radius:12px
        }

        .card small{color:#888}
        .card h3{margin-top:6px}

        .green{color:#2fb12f}
        .red{color:#e74c3c}
        .blue{color:#2b7ec9}

        .menu{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:14px;
            margin-bottom:20px
        }

        .menu a{
            background:#fff;
            padding:18px;
            border-radius:12px;
            text-decoration:none;
            color:#333;
            transition:.2s
        }

        .menu a:hover{
            background:#2b7ec9;
            color:#fff
        }

        .transaksi{
            background:#fff;
            border-radius:12px;
            padding:18px
        }

        .trx{
            display:flex;
            justify-content:space-between;
            padding:12px;
            background:#f7f9fb;
            border-radius:8px;
            margin-bottom:8px
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <h2>Usahain Dashboard</h2>
    <div>
        <?= htmlspecialchars($user['nama']); ?>
        |
        <a href="<?= site_url('auth/logout'); ?>">Logout</a>
    </div>
</div>

<div class="container">

    <!-- WELCOME -->
    <div class="welcome">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <h1>Selamat Datang, <?= htmlspecialchars($user['nama']); ?> 👋</h1>
                <p><?= htmlspecialchars($user['usaha']); ?> • <?= htmlspecialchars($user['type']); ?></p>
            </div>
            <button type="button" onclick="openEditBisnis()" style="background: #2b7ec9; color: white; border: none; padding: 10px 16px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 14px; transition: all 0.3s;">
                ✏️ Edit Informasi Bisnis
            </button>
        </div>
    </div>

    <!-- SUMMARY -->
    <div class="summary">
        <div class="card">
            <small>Pendapatan Hari Ini</small>
            <h3 class="green">Rp <?= number_format($summary['today_sales'],0,',','.'); ?></h3>
        </div>
        <div class="card">
            <small>Pengeluaran Hari Ini</small>
            <h3 class="red">Rp <?= number_format($summary['today_expense'],0,',','.'); ?></h3>
        </div>
        <div class="card">
            <small>Laba Bersih</small>
            <h3 class="blue">Rp <?= number_format($summary['today_profit'],0,',','.'); ?></h3>
        </div>
    </div>

    <!-- MENU -->
    <div class="menu">
        <a href="#">💰 Pencatatan Keuangan</a>
        <a href="#">📊 Analisis Produk</a>
        <a href="#">⚠️ Manajemen Risiko</a>
        <a href="#">🧮 Kalkulator HPP</a>
        <a href="#">📋 Subscription</a>
        <a href="#">🤖 AI Advisor</a>
    </div>

    <!-- TRANSAKSI -->
    <div class="transaksi">
        <h3>📋 Transaksi Terbaru</h3>
        <br>

        <?php if($transactions): ?>
            <?php foreach($transactions as $t): ?>
                <div class="trx">
                    <div>
                        <strong><?= htmlspecialchars($t['title']); ?></strong><br>
                        <small><?= htmlspecialchars($t['time']); ?></small>
                    </div>
                    <div style="font-weight:700;color:<?= $t['amount']<0?'#e74c3c':'#2fb12f'; ?>">
                        <?= ($t['amount']<0?'-Rp ':'+Rp ') . number_format(abs($t['amount']),0,',','.'); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="color:#888">Belum ada transaksi</p>
        <?php endif; ?>

    </div>

</div>

</body>
</html>

<!-- Modal Edit Informasi Bisnis -->
<div id="modalEditBisnis" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.3); z-index:1000; display:flex; align-items:center; justify-content:center;">
  <div style="background:white; border-radius:12px; padding:24px; max-width:500px; width:90%; box-shadow: 0 10px 40px rgba(0,0,0,0.15);">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
      <h2 style="color:#2b7ec9; font-size:20px;">Edit Informasi Bisnis</h2>
      <button type="button" onclick="closeEditBisnis()" style="background:none; border:none; font-size:24px; cursor:pointer; color:#999;">×</button>
    </div>
    
    <form id="formEditBisnis">
      <div style="margin-bottom:16px;">
        <label style="font-weight:600; color:#333; display:block; margin-bottom:6px;">Nama Usaha</label>
        <input type="text" id="edit_nama_usaha" name="nama_usaha" placeholder="Contoh: Warung Makan Berkah" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
      </div>
      
      <div style="margin-bottom:20px;">
        <label style="font-weight:600; color:#333; display:block; margin-bottom:6px;">Jenis Usaha</label>
        <input type="text" id="edit_jenis_usaha" name="jenis_usaha" placeholder="Contoh: Kuliner, Fashion, Jasa, etc" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
      </div>
      
      <div style="display:flex; gap:12px;">
        <button type="button" onclick="closeEditBisnis()" style="flex:1; background:#f0f0f0; border:none; padding:10px; border-radius:8px; cursor:pointer; font-weight:600; color:#333;">Batal</button>
        <button type="submit" style="flex:1; background:#2b7ec9; border:none; padding:10px; border-radius:8px; cursor:pointer; font-weight:600; color:white;">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
function openEditBisnis() {
  const modal = document.getElementById('modalEditBisnis');
  modal.style.display = 'flex';
  
  // Get current values from session/page if available
  const usaha = document.querySelector('.welcome p')?.textContent || '';
  document.getElementById('edit_nama_usaha').value = usaha.split('•')[0]?.trim() || '';
}

function closeEditBisnis() {
  document.getElementById('modalEditBisnis').style.display = 'none';
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
  const modal = document.getElementById('modalEditBisnis');
  if (event.target === modal) {
    closeEditBisnis();
  }
});

document.getElementById('formEditBisnis').onsubmit = function(e) {
  e.preventDefault();
  
  const nama_usaha = document.getElementById('edit_nama_usaha').value.trim();
  const jenis_usaha = document.getElementById('edit_jenis_usaha').value.trim();
  
  const submitBtn = this.querySelector('button[type="submit"]');
  const originalText = submitBtn.textContent;
  submitBtn.disabled = true;
  submitBtn.textContent = '⏳ Menyimpan...';
  
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
    const contentType = response.headers.get('content-type');
    if (!contentType || !contentType.includes('application/json')) {
      throw new Error('Response bukan JSON');
    }
    return response.json().then(data => ({ status: response.status, data: data }));
  })
  .then(({ status, data }) => {
    if (data.status === 'success' && status === 200) {
      alert('✅ Data berhasil disimpan!');
      closeEditBisnis();
      location.reload(); // Refresh untuk update tampilan
    } else {
      alert('Error: ' + (data.message || 'Gagal menyimpan'));
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
    }
  })
  .catch(err => {
    alert('Gagal menyimpan data: ' + err.message);
    submitBtn.disabled = false;
    submitBtn.textContent = originalText;
  });
};
</script>
