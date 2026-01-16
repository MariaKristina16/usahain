<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Usahain</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .navbar { background: #333; color: #fff; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h2 { font-size: 24px; }
        .navbar a { color: #fff; text-decoration: none; margin-left: 20px; }
        .navbar a:hover { text-decoration: underline; }
        .container { max-width: 1000px; margin: 20px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #333; margin-bottom: 20px; }
        .user-info { background: #f8f9fa; padding: 15px; border-left: 4px solid #667eea; margin-bottom: 30px; border-radius: 4px; }
        .user-info p { margin: 5px 0; }
        .menu { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; }
        .menu-item { background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #ddd; text-decoration: none; color: #333; transition: all 0.3s; }
        .menu-item:hover { background: #667eea; color: #fff; border-color: #667eea; }
        .menu-item h3 { margin-bottom: 5px; }
        .menu-item p { font-size: 14px; opacity: 0.8; }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>Usahain Dashboard</h2>
        <div>
            <span><?php echo $user['nama']; ?> (<?php echo $user['role']; ?>)</span>
            <a href="<?php echo site_url('auth/logout'); ?>">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Selamat Datang, <?php echo $user['nama']; ?>!</h1>

        <div class="user-info">
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <p><strong>Role:</strong> <?php echo $user['role']; ?></p>
        </div>

        <h3>Menu Aplikasi</h3>
        <div class="menu">
            <a href="<?php echo site_url('user'); ?>" class="menu-item">
                <h3>👥 Kelola User</h3>
                <p>Lihat, edit, dan hapus data user</p>
            </a>
            <a href="<?php echo site_url('subscription'); ?>" class="menu-item">
                <h3>📋 Subscription</h3>
                <p>Kelola paket subscription pengguna</p>
            </a>
            <a href="<?php echo site_url('analisis'); ?>" class="menu-item">
                <h3>📊 Analisis Produk</h3>
                <p>Analisis dan kelola produk Anda</p>
            </a>
            <a href="<?php echo site_url('risiko'); ?>" class="menu-item">
                <h3>⚠️ Manajemen Risiko</h3>
                <p>Identifikasi dan kelola risiko usaha</p>
            </a>
            <a href="<?php echo site_url('keuangan'); ?>" class="menu-item">
                <h3>💰 Pencatatan Keuangan</h3>
                <p>Catat dan pantau keuangan usaha</p>
            </a>
            <a href="<?php echo site_url('hpp'); ?>" class="menu-item">
                <h3>🧮 Kalkulator HPP</h3>
                <p>Hitung harga pokok produksi</p>
            </a>
        </div>
    </div>
</body>
</html>
