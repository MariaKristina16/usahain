<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin - Usahain</title>

<style>
:root{
    --primary:#1C6494;
    --secondary:#2980b9;
    --accent:#65C1DF;
    --success:#22c55e;
    --danger:#ef4444;
    --warning:#f59e0b;
    --info:#3b82f6;
    --bg:#f0f4f8;
    --card:#ffffff;
    --text:#1e293b;
    --muted:#64748b;
    --border:#e2e8f0;
    --shadow:0 4px 12px rgba(0,0,0,0.08);
}

*{
    box-sizing:border-box;
    margin:0;
    padding:0;
}

body{
    font-family:'Inter','Segoe UI','Arial',sans-serif;
    background:var(--bg);
    color:var(--text);
    line-height:1.6;
}


/* NAVBAR */
.navbar-main {
    background: var(--card);
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: var(--shadow);
}

.navbar-container {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 40px;
    height: 70px;
    padding: 0 32px;
}

.navbar-left {
    display: flex;
    align-items: center;
    min-width: fit-content;
}

.navbar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    color: var(--primary);
    font-weight: 800;
    font-size: 22px;
    transition: opacity 0.2s;
}

.navbar-brand:hover {
    opacity: 0.8;
}

.navbar-logo {
    width:45px;
    height:45px;
    display:flex;
    align-items:center;
    justify-content:center;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    border-radius: 8px;
}

.navbar-logo img{
    width:100%;
    height:100%;
    object-fit:contain;
}

.navbar-center {
    display: flex;
    gap: 32px;
    justify-content: center;
    flex: 1;
    align-items: center;
}

.navbar-link {
    position: relative;
    color: var(--muted);
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    transition: color 0.2s;
    padding-bottom: 8px;
}

.navbar-link:hover {
    color: var(--primary);
}

.navbar-link.active {
    color: var(--primary);
    font-weight: 700;
}

.navbar-link.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--primary);
    border-radius: 2px;
}

.navbar-right {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: fit-content;
}

.navbar-btn {
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.navbar-btn.btn-secondary {
    background: var(--bg);
    color: var(--muted);
}

.navbar-btn.btn-secondary:hover {
    background: var(--border);
    color: var(--primary);
    transform: translateY(-2px);
}

.navbar-btn.btn-logout {
    background: var(--danger);
    color: #fff;
}

.navbar-btn.btn-logout:hover {
    background: #dc2626;
    transform: translateY(-2px);
}

.navbar-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 16px;
    transition: transform 0.2s;
    cursor: pointer;
}

.navbar-avatar:hover {
    transform: scale(1.05);
}

/* SIDEBAR */
.sidebar {
    position: fixed;
    left: 0;
    top: 70px;
    width: 250px;
    height: calc(100vh - 70px);
    background: var(--card);
    border-right: 1px solid var(--border);
    overflow-y: auto;
    padding: 20px 0;
}

.sidebar-menu {
    list-style: none;
}

.sidebar-item {
    margin: 0;
}

.sidebar-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    color: var(--muted);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s;
    border-left: 3px solid transparent;
}

.sidebar-link:hover {
    background: var(--bg);
    color: var(--primary);
    border-left-color: var(--primary);
}

.sidebar-link.active {
    background: rgba(28, 100, 148, 0.1);
    color: var(--primary);
    border-left-color: var(--primary);
    font-weight: 700;
}

/* TABS STYLING */
.tabs {
    display: flex;
    gap: 12px;
    border-bottom: 2px solid var(--border);
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.tab-btn {
    padding: 12px 24px;
    background: none;
    border: none;
    border-bottom: 3px solid transparent;
    color: var(--muted);
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    white-space: nowrap;
}

.tab-btn:hover {
    color: var(--primary);
    background: rgba(28, 100, 148, 0.05);
}

.tab-btn.active {
    color: var(--primary);
    border-bottom-color: var(--primary);
    font-weight: 700;
}

.tab-content {
    display: none;
    animation: fadeIn 0.3s ease;
}

.tab-content.active {
    display: block;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* MAIN CONTENT */
.main-content {
    margin-left: 250px;
    padding: 30px;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.page-title {
    font-size: 28px;
    font-weight: 800;
    color: var(--text);
}

.page-subtitle {
    color: var(--muted);
    font-size: 14px;
    margin-top: 4px;
}

/* CARDS GRID */
.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: var(--card);
    border-radius: 16px;
    padding: 24px;
    box-shadow: var(--shadow);
    border: 1px solid var(--border);
    transition: all 0.3s;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
}

.stat-card.green {
    border-top: 3px solid var(--success);
}

.stat-card.blue {
    border-top: 3px solid var(--primary);
}

.stat-card.purple {
    border-top: 3px solid #a855f7;
}

.stat-card.orange {
    border-top: 3px solid var(--warning);
}

.stat-label {
    color: var(--muted);
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-value {
    font-size: 32px;
    font-weight: 800;
    margin: 12px 0;
    color: var(--text);
}

.stat-change {
    font-size: 13px;
    font-weight: 600;
}

.stat-change.positive {
    color: var(--success);
}

.stat-change.negative {
    color: var(--danger);
}

/* SECTION */
.section {
    background: var(--card);
    border-radius: 16px;
    padding: 24px;
    box-shadow: var(--shadow);
    border: 1px solid var(--border);
    margin-bottom: 30px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    border-bottom: 1px solid var(--border);
    padding-bottom: 16px;
}

.section-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--primary);
}

.section-actions {
    display: flex;
    gap: 10px;
}

/* TABLE */
.table-responsive {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

th {
    background: var(--bg);
    padding: 12px;
    text-align: left;
    font-weight: 700;
    color: var(--text);
    border-bottom: 2px solid var(--border);
}

td {
    padding: 14px 12px;
    border-bottom: 1px solid var(--border);
}

tr:hover {
    background: var(--bg);
}

/* BUTTON */
.btn {
    padding: 10px 18px;
    border-radius: 8px;
    border: none;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
}

.btn-primary {
    background: var(--primary);
    color: #fff;
}

.btn-primary:hover {
    background: var(--secondary);
    transform: translateY(-2px);
}

.btn-secondary {
    background: var(--bg);
    color: var(--text);
    border: 1px solid var(--border);
}

.btn-secondary:hover {
    background: var(--border);
}

.btn-success {
    background: var(--success);
    color: #fff;
}

.btn-success:hover {
    background: #16a34a;
}

.btn-danger {
    background: var(--danger);
    color: #fff;
}

.btn-danger:hover {
    background: #dc2626;
}

.btn-warning {
    background: var(--warning);
    color: #fff;
}

.btn-warning:hover {
    background: #d97706;
}

.btn-info {
    background: var(--info);
    color: #fff;
}

.btn-info:hover {
    background: #2563eb;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 12px;
}

/* BADGE */
.badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.badge-success {
    background: rgba(34, 197, 94, 0.1);
    color: var(--success);
}

.badge-danger {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger);
}

.badge-warning {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning);
}

.badge-info {
    background: rgba(59, 130, 246, 0.1);
    color: var(--info);
}

/* PROGRESS BAR */
.progress-bar {
    background: var(--bg);
    border-radius: 10px;
    height: 8px;
    overflow: hidden;
    margin: 8px 0;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    transition: width 0.3s ease;
}

/* MODAL */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
}

.modal.active {
    display: flex;
}

.modal-content {
    background: var(--card);
    border-radius: 16px;
    padding: 30px;
    max-width: 500px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    border-bottom: 1px solid var(--border);
    padding-bottom: 16px;
}

.modal-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--text);
}

.modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: var(--muted);
}

.modal-body {
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 16px;
}

.form-label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: var(--text);
    font-size: 14px;
}

.form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
    transition: border-color 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(28, 100, 148, 0.1);
}

/* RESPONSIVE */
@media (max-width: 1024px) {
    .sidebar {
        width: 200px;
    }
    
    .main-content {
        margin-left: 200px;
    }

    .cards-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }

    .navbar-center {
        gap: 20px;
    }
}

@media (max-width: 768px) {
    .sidebar {
        width: 0;
        overflow: hidden;
        transition: width 0.3s;
    }

    .sidebar.active {
        width: 200px;
    }

    .main-content {
        margin-left: 0;
        padding: 20px;
    }

    .cards-grid {
        grid-template-columns: 1fr;
    }

    .navbar-container {
        gap: 20px;
        height: auto;
        padding: 12px 16px;
        flex-wrap: wrap;
    }

    .navbar-center {
        order: 3;
        width: 100%;
        gap: 16px;
        margin-top: 10px;
    }

    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }

    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .section-actions {
        width: 100%;
    }

    .btn {
        flex: 1;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .navbar-link {
        display: none;
    }

    .page-title {
        font-size: 22px;
    }

    .stat-value {
        font-size: 24px;
    }

    .section-title {
        font-size: 16px;
    }

    table {
        font-size: 12px;
    }

    th, td {
        padding: 8px;
    }

    .btn {
        padding: 8px 12px;
        font-size: 12px;
    }
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar-main">
    <div class="navbar-container">
        <div class="navbar-left">
            <a href="<?= site_url('admin/dashboard'); ?>" class="navbar-brand">
                <span class="navbar-logo"><img src="<?= base_url('assets/logo.png'); ?>" alt="Usahain"></span>
                <span>Usahain Admin</span>
            </a>
        </div>
        <div class="navbar-right">
            <div class="navbar-avatar" title="Profile Admin"><?= strtoupper(substr($this->session->userdata('nama') ?? 'A',0,1)); ?></div>
            <a href="<?= site_url('auth/logout'); ?>" class="navbar-btn btn-logout" onclick="return confirm('Yakin ingin logout?')">
                <span>Logout</span>
            </a>
        </div>
    </div>
</nav>

<!-- SIDEBAR -->
<aside class="sidebar">
    <ul class="sidebar-menu">
        <li class="sidebar-item">
            <a href="javascript:void(0)" class="sidebar-link active" onclick="setActive(this); switchTab('overview')">
                <span>📊</span> Dashboard
            </a>
        </li>
        <li class="sidebar-item">
            <a href="javascript:void(0)" class="sidebar-link" onclick="setActive(this); switchTab('pengguna')">
                <span>👥</span> Pengguna
            </a>
        </li>
        <li class="sidebar-item">
            <a href="javascript:void(0)" class="sidebar-link" onclick="setActive(this); switchTab('bisnis')">
                <span>🏢</span> Data Bisnis
            </a>
        </li>
        <li class="sidebar-item">
            <a href="javascript:void(0)" class="sidebar-link" onclick="setActive(this); switchTab('subscription')">
                <span>💳</span> Subscription
            </a>
        </li>
        <li class="sidebar-item">
            <a href="javascript:void(0)" class="sidebar-link" onclick="setActive(this); switchTab('fitur')">
                <span>💡</span> Fitur
            </a>
        </li>
        <li class="sidebar-item">
            <a href="javascript:void(0)" class="sidebar-link" onclick="setActive(this); switchTab('pengaturan')">
                <span>⚙️</span> Pengaturan
            </a>
        </li>
        <li class="sidebar-item">
            <a href="javascript:void(0)" class="sidebar-link" onclick="setActive(this); switchTab('laporan')">
                <span>📈</span> Laporan
            </a>
        </li>
    </ul>
</aside>

<!-- MAIN CONTENT -->
<div class="main-content">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard Admin</h1>
            <p class="page-subtitle">Kelola semua aspek aplikasi Usahain</p>
        </div>
    </div>

    <!-- TABS -->
    <div class="tabs">
        <button class="tab-btn active" onclick="switchTab('overview')">📊 Overview</button>
        <button class="tab-btn" onclick="switchTab('pengguna')">👥 Pengguna</button>
        <button class="tab-btn" onclick="switchTab('bisnis')">🏢 Data Bisnis</button>
        <button class="tab-btn" onclick="switchTab('subscription')">💳 Subscription</button>
        <button class="tab-btn" onclick="switchTab('fitur')">💡 Fitur</button>
        <button class="tab-btn" onclick="switchTab('laporan')">📈 Laporan</button>
        <button class="tab-btn" onclick="switchTab('filter')">🔍 Filter</button>
        <button class="tab-btn" onclick="switchTab('pengaturan')">⚙️ Pengaturan</button>
    </div>

    <!-- TAB: OVERVIEW -->
    <div id="overview" class="tab-content active">
        <div class="stat-card green">
            <div class="stat-label">Total Pengguna</div>
            <div class="stat-value"><?= isset($total_users) ? number_format($total_users) : '0'; ?></div>
            <div class="stat-change positive">+<?= isset($new_users) ? $new_users : '0'; ?> bulan ini</div>
        </div>

        <div class="stat-card blue">
            <div class="stat-label">Pengguna Aktif</div>
            <div class="stat-value"><?= isset($active_users) ? number_format($active_users) : '0'; ?></div>
            <div class="stat-change positive">+<?= isset($active_increase) ? $active_increase : '5'; ?>% dari bulan lalu</div>
        </div>

        <div class="stat-card purple">
            <div class="stat-label">Premium Users</div>
            <div class="stat-value"><?= isset($premium_users) ? number_format($premium_users) : '0'; ?></div>
            <div class="stat-change positive"><?= isset($conversion_rate) ? $conversion_rate : '12'; ?>% conversion</div>
        </div>

        <div class="stat-card orange">
            <div class="stat-label">Revenue Bulan Ini</div>
            <div class="stat-value">Rp <?= number_format(isset($revenue) ? $revenue : 0,0,',','.'); ?></div>
            <div class="stat-change positive">+<?= isset($revenue_increase) ? $revenue_increase : '8'; ?>% dari bulan lalu</div>
        </div>
    </div>

    <!-- PENGGUNAAN FITUR -->
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">📈 Penggunaan Fitur (30 Hari)</h2>
            <div class="section-actions">
                <button class="btn btn-secondary btn-sm" onclick="refreshFeatureUsage()">🔄 Refresh</button>
                <button class="btn btn-info btn-sm" onclick="openExportModal()">📥 Export</button>
            </div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Fitur</th>
                        <th>Penggunaan</th>
                        <th>Persentase</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $features = array(
                        array('name' => 'AI Advisor', 'count' => 1250, 'percent' => 95),
                        array('name' => 'Kalkulator HPP', 'count' => 980, 'percent' => 78),
                        array('name' => 'Pencatatan Keuangan', 'count' => 1100, 'percent' => 88),
                        array('name' => 'Analisis Produk', 'count' => 650, 'percent' => 52),
                        array('name' => 'Manajemen Risiko', 'count' => 520, 'percent' => 42),
                    );
                    
                    if (!empty($features) && is_array($features)): 
                        foreach($features as $f): 
                    ?>
                    <tr>
                        <td><strong><?= $f['name']; ?></strong></td>
                        <td>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width:<?= $f['percent']; ?>%"></div>
                            </div>
                        </td>
                        <td><span class="badge badge-info"><?= $f['percent']; ?>%</span></td>
                        <td>
                            <button class="btn btn-sm btn-secondary" onclick="viewFeatureDetails('<?= $f['name']; ?>')">Detail</button>
                        </td>
                    </tr>
                    <?php 
                        endforeach; 
                    else: 
                    ?>
                    <tr>
                        <td colspan="4" style="text-align:center;color:var(--muted)">Tidak ada data penggunaan fitur.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    </div><!-- End Overview Tab -->

    <!-- TAB: PENGGUNA -->
    <div id="pengguna" class="tab-content">
        <div class="section-header">
            <h2 class="section-title">👥 Pengguna Terbaru</h2>
            <div class="section-actions">
                <button class="btn btn-primary btn-sm" onclick="openAddUserModal()">+ Tambah Pengguna</button>
                <button class="btn btn-secondary btn-sm" onclick="refreshUsers()">🔄 Refresh</button>
            </div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $users = array(
                        array('id' => 1, 'name' => 'Budi Santoso', 'email' => 'budi@example.com', 'status' => 'Aktif', 'date' => '2026-01-05'),
                        array('id' => 2, 'name' => 'Siti Nurhaliza', 'email' => 'siti@example.com', 'status' => 'Aktif', 'date' => '2026-01-04'),
                        array('id' => 3, 'name' => 'Ahmad Wijaya', 'email' => 'ahmad@example.com', 'status' => 'Aktif', 'date' => '2026-01-03'),
                        array('id' => 4, 'name' => 'Rina Kartika', 'email' => 'rina@example.com', 'status' => 'Inactive', 'date' => '2026-01-02'),
                        array('id' => 5, 'name' => 'Dedi Gunawan', 'email' => 'dedi@example.com', 'status' => 'Aktif', 'date' => '2026-01-01'),
                    );
                    
                    foreach($users as $u): 
                    ?>
                    <tr>
                        <td><strong><?= $u['name']; ?></strong></td>
                        <td><?= $u['email']; ?></td>
                        <td>
                            <span class="badge <?= $u['status'] == 'Aktif' ? 'badge-success' : 'badge-danger'; ?>">
                                <?= $u['status']; ?>
                            </span>
                        </td>
                        <td><?= $u['date']; ?></td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="editUser(<?= $u['id']; ?>)">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteUser(<?= $u['id']; ?>)">Hapus</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    </div><!-- End Pengguna Tab -->

    <!-- TAB: FITUR -->
    <div id="fitur" class="tab-content">
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">📈 Penggunaan Fitur (30 Hari)</h2>
                <div class="section-actions">
                    <button class="btn btn-secondary btn-sm" onclick="refreshFeatureUsage()">🔄 Refresh</button>
                    <button class="btn btn-info btn-sm" onclick="openExportModal()">📥 Export</button>
                </div>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Fitur</th>
                            <th>Penggunaan</th>
                            <th>Persentase</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $features = array(
                            array('name' => 'AI Advisor', 'count' => 1250, 'percent' => 95),
                            array('name' => 'Kalkulator HPP', 'count' => 980, 'percent' => 78),
                            array('name' => 'Pencatatan Keuangan', 'count' => 1100, 'percent' => 88),
                            array('name' => 'Analisis Produk', 'count' => 650, 'percent' => 52),
                            array('name' => 'Manajemen Risiko', 'count' => 520, 'percent' => 42),
                        );
                        
                        if (!empty($features) && is_array($features)): 
                            foreach($features as $f): 
                        ?>
                        <tr>
                            <td><strong><?= $f['name']; ?></strong></td>
                            <td>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width:<?= $f['percent']; ?>%"></div>
                                </div>
                            </td>
                            <td><span class="badge badge-info"><?= $f['percent']; ?>%</span></td>
                            <td>
                                <button class="btn btn-sm btn-secondary" onclick="viewFeatureDetails('<?= $f['name']; ?>')">Detail</button>
                            </td>
                        </tr>
                        <?php 
                            endforeach; 
                        else: 
                        ?>
                        <tr>
                            <td colspan="4" style="text-align:center;color:var(--muted)">Tidak ada data penggunaan fitur.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section" style="margin-top: 30px;">
            <div class="section-header">
                <h2 class="section-title">📊 Statistik Fitur</h2>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div class="stat-card blue">
                    <div class="stat-label">Total Penggunaan Fitur</div>
                    <div class="stat-value">4,500</div>
                    <div class="stat-change positive">+15% dari minggu lalu</div>
                </div>
                <div class="stat-card green">
                    <div class="stat-label">Fitur Paling Populer</div>
                    <div class="stat-value">AI Advisor</div>
                    <div class="stat-change positive">95% pengguna aktif</div>
                </div>
                <div class="stat-card purple">
                    <div class="stat-label">Rata-rata Penggunaan/User</div>
                    <div class="stat-value">3.6</div>
                    <div class="stat-change positive">Fitur per pengguna</div>
                </div>
            </div>
        </div>
    </div><!-- End Fitur Tab -->

    <!-- TAB: FILTER -->
    <div id="filter" class="tab-content">
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">🔍 Filter & Search Data</h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div class="form-group">
                    <label class="form-label">Cari Pengguna</label>
                    <input type="text" class="form-control" placeholder="Nama atau email...">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-control">
                        <option value="">-- Semua Status --</option>
                        <option value="aktif">Aktif</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Paket</label>
                    <select class="form-control">
                        <option value="">-- Semua Paket --</option>
                        <option value="free">Free</option>
                        <option value="starter">Starter</option>
                        <option value="premium">Premium</option>
                        <option value="elite">Elite</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" class="form-control">
                </div>
            </div>

            <div style="margin-top: 20px; display: flex; gap: 10px;">
                <button class="btn btn-primary" onclick="applyFilter()">🔍 Terapkan Filter</button>
                <button class="btn btn-secondary" onclick="resetFilter()">↺ Reset</button>
            </div>

            <hr style="margin: 30px 0; border: 1px solid var(--border);">

            <h3 style="color: var(--primary); margin-bottom: 20px;">Hasil Filter</h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Paket</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" style="text-align: center; color: var(--muted);">Gunakan filter untuk menampilkan data</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- End Filter Tab -->

    <!-- TAB: PENGATURAN -->
    <div id="pengaturan" class="tab-content">
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">⚙️ Pengaturan Aplikasi</h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px;">
                <!-- General Settings -->
                <div style="border: 1px solid var(--border); border-radius: 12px; padding: 20px;">
                    <h3 style="color: var(--primary); margin-bottom: 16px;">📱 Pengaturan Umum</h3>
                    <div class="form-group">
                        <label class="form-label">Nama Aplikasi</label>
                        <input type="text" class="form-control" value="Usahain" onchange="saveSetting(this)">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Support</label>
                        <input type="email" class="form-control" value="support@usahain.com" onchange="saveSetting(this)">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Telepon Support</label>
                        <input type="tel" class="form-control" value="+62-123-456-789" onchange="saveSetting(this)">
                    </div>
                </div>

                <!-- Security Settings -->
                <div style="border: 1px solid var(--border); border-radius: 12px; padding: 20px;">
                    <h3 style="color: var(--primary); margin-bottom: 16px;">🔒 Keamanan</h3>
                    <div class="form-group">
                        <label class="form-label">
                            <input type="checkbox" checked> Aktifkan Two-Factor Authentication
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <input type="checkbox" checked> Aktifkan Email Verification
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Max Login Attempts</label>
                        <input type="number" class="form-control" value="5" onchange="saveSetting(this)">
                    </div>
                    <button class="btn btn-warning" onclick="changePassword()">Ubah Password Admin</button>
                </div>

                <!-- Email Settings -->
                <div style="border: 1px solid var(--border); border-radius: 12px; padding: 20px;">
                    <h3 style="color: var(--primary); margin-bottom: 16px;">📧 Email Settings</h3>
                    <div class="form-group">
                        <label class="form-label">SMTP Host</label>
                        <input type="text" class="form-control" value="smtp.gmail.com" onchange="saveSetting(this)">
                    </div>
                    <div class="form-group">
                        <label class="form-label">SMTP Port</label>
                        <input type="number" class="form-control" value="587" onchange="saveSetting(this)">
                    </div>
                    <button class="btn btn-info" onclick="testEmail()">📨 Test Email</button>
                </div>

                <!-- Payment Settings -->
                <div style="border: 1px solid var(--border); border-radius: 12px; padding: 20px;">
                    <h3 style="color: var(--primary); margin-bottom: 16px;">💳 Payment Gateway</h3>
                    <div class="form-group">
                        <label class="form-label">Midtrans Server Key</label>
                        <input type="password" class="form-control" placeholder="Masukkan key..." onchange="saveSetting(this)">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Midtrans Client Key</label>
                        <input type="password" class="form-control" placeholder="Masukkan key..." onchange="saveSetting(this)">
                    </div>
                    <button class="btn btn-info" onclick="testPayment()">💰 Test Payment</button>
                </div>

                <!-- Backup Settings -->
                <div style="border: 1px solid var(--border); border-radius: 12px; padding: 20px;">
                    <h3 style="color: var(--primary); margin-bottom: 16px;">💾 Backup Database</h3>
                    <div style="margin-bottom: 12px;">
                        <p style="font-size: 13px; color: var(--muted);">Last Backup: 2026-01-08 15:30:00</p>
                    </div>
                    <button class="btn btn-success" onclick="backupDatabase()" style="width: 100%; margin-bottom: 8px;">📥 Backup Sekarang</button>
                    <button class="btn btn-secondary" onclick="restoreDatabase()" style="width: 100%;">↩️ Restore Backup</button>
                </div>

                <!-- System Info -->
                <div style="border: 1px solid var(--border); border-radius: 12px; padding: 20px;">
                    <h3 style="color: var(--primary); margin-bottom: 16px;">ℹ️ Informasi Sistem</h3>
                    <div style="font-size: 13px; color: var(--muted); line-height: 1.8;">
                        <p><strong>Versi App:</strong> 1.0.0</p>
                        <p><strong>Database:</strong> MySQL 5.7</p>
                        <p><strong>PHP Version:</strong> 7.4.33</p>
                        <p><strong>Server:</strong> Apache 2.4</p>
                        <p><strong>Last Update:</strong> 2026-01-01</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Pengaturan Tab -->

    <!-- TAB: DATA BISNIS -->
    <div id="bisnis" class="tab-content">
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">🏢 Data Bisnis Pengguna</h2>
                <div class="section-actions">
                    <button class="btn btn-secondary btn-sm" onclick="refreshBisnis()">🔄 Refresh</button>
                    <button class="btn btn-success btn-sm" onclick="openAddBisnis()">➕ Tambah</button>
                </div>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Bisnis</th>
                            <th>Pemilik</th>
                            <th>Jenis Usaha</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $bisnis = array(
                            array('nama' => 'Toko Elektronik ABC', 'pemilik' => 'Budi Santoso', 'jenis' => 'Retail', 'status' => 'Aktif'),
                            array('nama' => 'Warung Makan Sejahtera', 'pemilik' => 'Siti Nurhaliza', 'jenis' => 'F&B', 'status' => 'Aktif'),
                            array('nama' => 'Laundry Express', 'pemilik' => 'Ahmad Wijaya', 'jenis' => 'Jasa', 'status' => 'Aktif'),
                            array('nama' => 'Kafe Cozy Corner', 'pemilik' => 'Rina Kartika', 'jenis' => 'F&B', 'status' => 'Nonaktif'),
                        );
                        
                        foreach($bisnis as $b): 
                        ?>
                        <tr>
                            <td><strong><?= $b['nama']; ?></strong></td>
                            <td><?= $b['pemilik']; ?></td>
                            <td><?= $b['jenis']; ?></td>
                            <td><span class="badge <?= $b['status'] == 'Aktif' ? 'badge-success' : 'badge-danger'; ?>"><?= $b['status']; ?></span></td>
                            <td>
                                <button class="btn btn-sm btn-secondary" onclick="editBisnis('<?= $b['nama']; ?>')">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteBisnis('<?= $b['nama']; ?>')">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- End Data Bisnis Tab -->

    <!-- TAB: SUBSCRIPTION -->
    <div id="subscription" class="tab-content">
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">💳 Subscription Pengguna</h2>
                <div class="section-actions">
                    <button class="btn btn-secondary btn-sm" onclick="refreshSubscription()">🔄 Refresh</button>
                </div>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Pengguna</th>
                            <th>Paket</th>
                            <th>Status</th>
                            <th>Tanggal Berakhir</th>
                            <th>Harga/Bulan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $subscriptions = array(
                            array('user' => 'Budi Santoso', 'plan' => 'Premium', 'status' => 'Active', 'expires' => '2026-04-05', 'price' => 'Rp 299.000'),
                            array('user' => 'Siti Nurhaliza', 'plan' => 'Starter', 'status' => 'Active', 'expires' => '2026-02-04', 'price' => 'Rp 99.000'),
                            array('user' => 'Ahmad Wijaya', 'plan' => 'Elite', 'status' => 'Active', 'expires' => '2026-07-03', 'price' => 'Rp 599.000'),
                            array('user' => 'Rina Kartika', 'plan' => 'Free', 'status' => 'Expired', 'expires' => '2025-12-02', 'price' => 'Gratis'),
                        );
                        
                        foreach($subscriptions as $s): 
                        ?>
                        <tr>
                            <td><strong><?= $s['user']; ?></strong></td>
                            <td><?= $s['plan']; ?></td>
                            <td><span class="badge <?= $s['status'] == 'Active' ? 'badge-success' : 'badge-danger'; ?>"><?= $s['status']; ?></span></td>
                            <td><?= $s['expires']; ?></td>
                            <td><?= $s['price']; ?></td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="viewSubscriptionDetail('<?= $s['user']; ?>')">Detail</button>
                                <button class="btn btn-sm btn-warning" onclick="renewSubscription('<?= $s['user']; ?>')">Perbarui</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- End Subscription Tab -->

    <!-- TAB: LAPORAN -->
    <div id="laporan" class="tab-content">
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">📈 Laporan & Analisis</h2>
                <div class="section-actions">
                    <button class="btn btn-secondary btn-sm" onclick="generateReport()">📊 Generate</button>
                    <button class="btn btn-info btn-sm" onclick="openExportModal()">📥 Export</button>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
                <div class="stat-card blue">
                    <div class="stat-label">Total Pendapatan (Bulan Ini)</div>
                    <div class="stat-value">Rp 45.5M</div>
                    <div class="stat-change positive">+18% dari bulan lalu</div>
                </div>
                <div class="stat-card green">
                    <div class="stat-label">New Users (Bulan Ini)</div>
                    <div class="stat-value">342</div>
                    <div class="stat-change positive">+22% dari bulan lalu</div>
                </div>
                <div class="stat-card purple">
                    <div class="stat-label">Churn Rate</div>
                    <div class="stat-value">2.4%</div>
                    <div class="stat-change negative">-1.2% improvement</div>
                </div>
                <div class="stat-card orange">
                    <div class="stat-label">Avg Session Duration</div>
                    <div class="stat-value">28 min</div>
                    <div class="stat-change positive">+5 min increase</div>
                </div>
            </div>

            <div class="section" style="margin-top: 30px;">
                <h3 class="section-title">📊 Rincian Laporan</h3>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Metrik</th>
                                <th>Januari 2026</th>
                                <th>Desember 2025</th>
                                <th>Perubahan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Total Users</strong></td>
                                <td>1,250</td>
                                <td>1,008</td>
                                <td><span class="badge badge-success">+19.0%</span></td>
                            </tr>
                            <tr>
                                <td><strong>Active Users</strong></td>
                                <td>890</td>
                                <td>756</td>
                                <td><span class="badge badge-success">+17.7%</span></td>
                            </tr>
                            <tr>
                                <td><strong>Premium Conversions</strong></td>
                                <td>156</td>
                                <td>128</td>
                                <td><span class="badge badge-success">+21.9%</span></td>
                            </tr>
                            <tr>
                                <td><strong>Total Revenue</strong></td>
                                <td>Rp 45.5M</td>
                                <td>Rp 38.6M</td>
                                <td><span class="badge badge-success">+17.9%</span></td>
                            </tr>
                            <tr>
                                <td><strong>Customer Support Tickets</strong></td>
                                <td>234</td>
                                <td>312</td>
                                <td><span class="badge badge-danger">-25.0%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- End Laporan Tab -->

</div><!-- End Main Content -->

<!-- MODAL: ADD USER -->
<div id="addUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Pengguna Baru</h3>
            <button class="modal-close" onclick="closeModal('addUserModal')">&times;</button>
        </div>
        <div class="modal-body">
            <form id="addUserForm" onsubmit="submitAddUser(event)">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <select class="form-control" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="user">User</option>
                        <option value="premium">Premium User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">Simpan</button>
                    <button type="button" class="btn btn-secondary" style="flex: 1;" onclick="closeModal('addUserModal')">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: EXPORT DATA -->
<div id="exportModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Export Data</h3>
            <button class="modal-close" onclick="closeModal('exportModal')">&times;</button>
        </div>
        <div class="modal-body">
            <form onsubmit="submitExport(event)">
                <div class="form-group">
                    <label class="form-label">Tipe Data</label>
                    <select class="form-control" required>
                        <option value="">-- Pilih Tipe Data --</option>
                        <option value="users">Data Pengguna</option>
                        <option value="subscription">Data Subscription</option>
                        <option value="features">Penggunaan Fitur</option>
                        <option value="all">Semua Data</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Format</label>
                    <select class="form-control" required>
                        <option value="csv">CSV</option>
                        <option value="pdf">PDF</option>
                        <option value="xlsx">Excel</option>
                    </select>
                </div>
                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button type="submit" class="btn btn-success" style="flex: 1;">Download</button>
                    <button type="button" class="btn btn-secondary" style="flex: 1;" onclick="closeModal('exportModal')">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Tab switching function
    function switchTab(tabName) {
        // Hide all tab content
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
        });
        
        // Remove active class from all tab buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Show selected tab
        const selectedTab = document.getElementById(tabName);
        if (selectedTab) {
            selectedTab.classList.add('active');
        }
        
        // Add active class to clicked button
        event.target.classList.add('active');
    }

    // Set active menu
    function setActive(element) {
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.classList.remove('active');
        });
        element.classList.add('active');
    }

    // Modal functions
    function openModal(modalId) {
        document.getElementById(modalId).classList.add('active');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
    }

    function openAddUserModal() {
        openModal('addUserModal');
    }

    function openExportModal() {
        openModal('exportModal');
    }

    // Form submissions
    function submitAddUser(event) {
        event.preventDefault();
        alert('Pengguna berhasil ditambahkan! Fitur akan diintegrasikan dengan database.');
        closeModal('addUserModal');
    }

    function submitExport(event) {
        event.preventDefault();
        alert('Data sedang dipersiapkan untuk diunduh...');
        closeModal('exportModal');
    }

    // Action functions
    function editUser(userId) {
        alert('Edit user dengan ID: ' + userId);
    }

    function deleteUser(userId) {
        if (confirm('Yakin ingin menghapus pengguna ini?')) {
            alert('Pengguna dengan ID: ' + userId + ' berhasil dihapus!');
        }
    }

    function viewSubscriptionDetail(userName) {
        alert('Detail subscription untuk: ' + userName);
    }

    function renewSubscription(userName) {
        alert('Perpanjangan subscription untuk: ' + userName);
    }

    function viewFeatureDetails(featureName) {
        alert('Detail penggunaan: ' + featureName);
    }

    function refreshFeatureUsage() {
        alert('Data penggunaan fitur sedang diperbarui...');
    }

    function refreshUsers() {
        alert('Data pengguna sedang diperbarui...');
    }

    function refreshSubscription() {
        alert('Data subscription sedang diperbarui...');
    }

    function refreshBisnis() {
        alert('Data bisnis sedang diperbarui...');
    }

    function openAddBisnis() {
        alert('Membuka form tambah bisnis...');
    }

    function editBisnis(nama) {
        alert('Edit bisnis: ' + nama);
    }

    function deleteBisnis(nama) {
        if (confirm('Yakin ingin menghapus bisnis: ' + nama + '?')) {
            alert('Bisnis berhasil dihapus!');
        }
    }

    function generateReport() {
        alert('Generate laporan sedang diproses...');
    }

    // Close modal when clicking outside
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
            }
        });
    });
</script>

</body>
</html>
