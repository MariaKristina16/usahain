<?php
$user = array_merge([
    'nama'  => 'User',
    'email' => '-',
    'usaha'=> 'Bisnis Anda',
    'type' => 'Calon Pemilik UMKM'
], (array)($user ?? []));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perencanaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1F6B99;
            --primary-dark: #154A6F;
            --primary-light: #3A88BA;
            --primary-very-light: #E8F4FB;
            --secondary: #7EC8E3;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --bg: #F8FAFC;
            --text-primary: #1E293B;
            --text-secondary: #64748B;
            --text-muted: #94A3B8;
            --border: #E2E8F0;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', Segoe UI, Arial; background: var(--bg); color: var(--text-primary); display: flex; min-height: 100vh; }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 260px;
            background: #fff;
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: 50;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            overflow-y: auto;
        }

        .sidebar.collapsed { width: 80px; }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 12px;
        }

        .sidebar.collapsed .sidebar-header {
            padding: 16px 12px;
            justify-content: center;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--primary);
            font-weight: 800;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
            min-width: 40px;
        }

        .sidebar.collapsed .sidebar-logo {
            gap: 0;
            justify-content: center;
            flex: 1;
        }

        .sidebar-logo:hover {
            opacity: 0.8;
        }

        .sidebar-logo img {
            height: 40px;
            width: 40px;
            object-fit: contain;
            border-radius: 8px;
            transition: all 0.3s;
            flex-shrink: 0;
        }

        .sidebar.collapsed .sidebar-logo-text { display: none; }

        .sidebar-toggle {
            width: 36px;
            height: 36px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: none;
            color: var(--text-secondary);
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .sidebar-toggle:hover {
            background: var(--bg);
            color: var(--primary);
        }

        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 16px 12px;
            list-style: none;
        }

        .sidebar-menu-item { margin-bottom: 8px; }

        .sidebar-menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 10px;
            text-decoration: none;
            color: var(--text-secondary);
            transition: all 0.3s;
            font-weight: 500;
            font-size: 14px;
        }

        .sidebar-menu-link:hover {
            background: var(--bg);
            color: var(--primary);
        }

        .sidebar-menu-link.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: #fff;
            font-weight: 600;
        }

        .sidebar-menu-icon {
            width: 20px;
            font-size: 18px;
            flex-shrink: 0;
        }

        .sidebar.collapsed .sidebar-menu-text { display: none; }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 8px;
        }

        .sidebar-footer-btn {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .sidebar-footer-btn:hover {
            background: var(--bg);
            color: var(--primary);
        }

        /* ===== MAIN WRAPPER ===== */
        .main-wrapper {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        body.sidebar-collapsed .main-wrapper { margin-left: 80px; }

        /* ===== TOP HEADER ===== */
        .top-header {
            background: linear-gradient(135deg, #fff 0%, var(--primary-very-light) 100%);
            border-bottom: 1px solid var(--border);
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .header-left { display: flex; align-items: center; gap: 16px; flex: 1; }
        .header-title { font-size: 18px; font-weight: 700; color: var(--primary); }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-icon-btn {
            width: 40px;
            height: 40px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            background: #fff;
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: all 0.3s;
        }

        .header-icon-btn:hover {
            background: var(--bg);
            color: var(--primary);
        }

        .header-divider { width: 1px; height: 24px; background: var(--border); }

        .header-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 12px;
        }

        .header-user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
        }

        .header-user-info { display: flex; flex-direction: column; gap: 2px; }
        .header-user-name { font-size: 13px; font-weight: 600; color: var(--text-primary); }
        .header-user-email { font-size: 11px; color: var(--text-secondary); }

        /* ===== MAIN CONTENT ===== */
        .content {
            flex: 1;
            padding: 40px 32px;
            overflow-y: auto;
            background: linear-gradient(180deg, var(--bg) 0%, #F1F8FC 100%);
        }

        .container { max-width: 1200px; margin: 0 auto; }

        /* ===== WELCOME SECTION ===== */
        .welcome-card {
            background: linear-gradient(135deg, #fff 0%, var(--primary-very-light) 100%);
            border-radius: 18px;
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: 0 4px 20px rgba(31, 107, 153, 0.1);
            border: 1px solid rgba(31, 107, 153, 0.1);
        }

        .welcome-card h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--primary);
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .welcome-card p {
            font-size: 1.1rem;
            color: var(--primary-light);
            margin-bottom: 24px;
            line-height: 1.6;
            font-weight: 400;
        }

        /* ===== PROGRESS BAR ===== */
        .progress-section {
            background: #fff;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 40px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .progress-label {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 16px;
            font-size: 1.1rem;
            letter-spacing: 0.3px;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .progress-info span {
            font-size: 0.95rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .progress-bar {
            background: #e3eafc;
            border-radius: 10px;
            height: 12px;
            width: 100%;
            overflow: hidden;
        }

        .progress-bar-inner {
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            height: 100%;
            border-radius: 10px;
            width: 16.6%;
            transition: width 1s ease;
        }

        /* ===== CHECKLIST SECTION ===== */
        .checklist-section {
            background: #fff;
            border-radius: 14px;
            padding: 32px;
            margin-bottom: 40px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .section-title {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 24px;
            font-size: 1.35rem;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.2px;
            line-height: 1.4;
        }

        .checklist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 16px;
        }

        .checklist-item {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--bg);
            border-radius: 10px;
            padding: 14px 18px;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--primary);
            transition: all 0.3s;
            cursor: pointer;
            user-select: none;
        }

        .checklist-item:hover {
            background: var(--primary-very-light);
            transform: translateY(-2px);
        }

        .checklist-item.checked {
            background: linear-gradient(135deg, #d1f7c4 0%, #a8f0b0 100%);
            color: #2e7d32;
            font-weight: 600;
        }

        .checklist-item .icon { 
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .checklist-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--success);
        }

        /* ===== TOOLS SECTION ===== */
        .tools-section {
            margin-bottom: 40px;
        }

        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .tool-card {
            background: #fff;
            border-radius: 16px;
            padding: 32px 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--border);
        }

        .tool-card:hover {
            box-shadow: 0 12px 32px rgba(31, 107, 153, 0.15);
            transform: translateY(-6px);
            border-color: var(--primary);
        }

        .tool-icon {
            font-size: 3rem;
            margin-bottom: 16px;
        }

        .tool-title {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 1.1rem;
            letter-spacing: 0.2px;
        }

        .tool-desc {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 18px;
            line-height: 1.5;
        }

        .tool-link {
            display: inline-block;
            color: #fff;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            text-decoration: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .tool-link:hover {
            box-shadow: 0 8px 16px rgba(31, 107, 153, 0.25);
            transform: scale(1.05);
        }

        /* ===== GUIDE SECTION ===== */
        .guide-section {
            margin-bottom: 40px;
        }

        .guide-progress {
            display: flex;
            gap: 20px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .guide-step {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            font-size: 1rem;
        }

        .guide-step.completed {
            color: var(--success);
        }

        .guide-step.pending {
            color: var(--primary);
        }

        .guide-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .guide-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            transition: all 0.3s;
            border: 1px solid var(--border);
        }

        .guide-card:hover {
            box-shadow: 0 12px 32px rgba(31, 107, 153, 0.15);
            transform: translateY(-6px);
            border-color: var(--primary);
        }

        .guide-icon {
            font-size: 2.5rem;
            margin-bottom: 16px;
        }

        .guide-title {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 1.05rem;
            letter-spacing: 0.2px;
        }

        .guide-desc {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 16px;
            line-height: 1.5;
        }

        .guide-check {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 16px;
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .guide-check input {
            cursor: pointer;
            width: 18px;
            height: 18px;
        }

        /* ===== UPGRADE MODAL ===== */
        .upgrade-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
            animation: fadeIn 0.3s ease;
        }

        .upgrade-modal.show {
            display: flex;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .upgrade-modal-content {
            background: #fff;
            border-radius: 20px;
            padding: 50px 40px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .upgrade-icon {
            font-size: 4rem;
            margin-bottom: 24px;
            animation: bounce 1s ease infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .upgrade-modal h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 12px;
            letter-spacing: 0.3px;
        }

        .upgrade-modal p {
            font-size: 1.05rem;
            color: var(--text-secondary);
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .upgrade-modal-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .upgrade-btn {
            padding: 14px 32px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .upgrade-btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: #fff;
            flex: 1;
        }

        .upgrade-btn-primary:hover {
            box-shadow: 0 8px 20px rgba(31, 107, 153, 0.25);
            transform: translateY(-2px);
        }

        .upgrade-btn-secondary {
            background: var(--bg);
            color: var(--primary);
            flex: 1;
            border: 2px solid var(--primary);
        }

        .upgrade-btn-secondary:hover {
            background: var(--primary-very-light);
        }
        @media (max-width: 1024px) {
            .tools-grid, .guide-grid { grid-template-columns: repeat(2, 1fr); }
            .sidebar { width: 200px; }
            .main-wrapper { margin-left: 200px; }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                width: 0;
                z-index: 200;
                overflow: hidden;
            }
            
            .sidebar.mobile-open { width: 260px; }
            .main-wrapper { margin-left: 0; }
            
            .top-header { padding: 12px 16px; height: 60px; }
            .content { padding: 20px 16px; }
            .welcome-card { padding: 24px; }
            .welcome-card h1 { font-size: 1.5rem; }
            
            .tools-grid, .guide-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 576px) {
            .header-user-info { display: none; }
            .checklist-grid { grid-template-columns: 1fr; }
            .content { padding: 12px; }
        }
    </style>
</head>
<body>
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="#" onclick="toggleSidebar(); return false;" class="sidebar-logo" title="Klik untuk buka/tutup sidebar">
                <img src="<?= base_url('assets/logo.png'); ?>" alt="Usahain Logo" style="height: 40px; width: auto; border-radius: 8px;">
                <span class="sidebar-logo-text" style="font-size: 14px; font-weight: 700;">Usahain</span>
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="sidebar-menu-item">
                <a href="<?= site_url('auth/dashboard_planning'); ?>" class="sidebar-menu-link active">
                    <span class="sidebar-menu-icon">🏠</span>
                    <span class="sidebar-menu-text">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="<?= site_url('advisor'); ?>" class="sidebar-menu-link">
                    <span class="sidebar-menu-icon">🤖</span>
                    <span class="sidebar-menu-text">AI Advisor</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="<?= site_url('risiko'); ?>" class="sidebar-menu-link">
                    <span class="sidebar-menu-icon">🛡️</span>
                    <span class="sidebar-menu-text">Risiko Bisnis</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="<?= site_url('info'); ?>" class="sidebar-menu-link">
                    <span class="sidebar-menu-icon">📚</span>
                    <span class="sidebar-menu-text">Info Bisnis</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <button class="sidebar-footer-btn" id="opsBtn" style="display: none;" onclick="window.location.href='<?= site_url('auth/change_dashboard'); ?>'">Ops</button>
            <button class="sidebar-footer-btn" onclick="if(confirm('Yakin ingin logout?')) window.location.href='<?= site_url('auth/logout'); ?>'">Logout</button>
        </div>
    </aside>

    <!-- MAIN WRAPPER -->
    <div class="main-wrapper">
        <!-- TOP HEADER -->
        <div class="top-header">
            <div class="header-left">
                <div class="header-title">🎯 Dashboard Perencanaan</div>
            </div>
            <div class="header-right">
                <button class="header-icon-btn" title="Notifikasi">🔔</button>
                <div class="header-divider"></div>
                <div class="header-user">
                    <div class="header-user-avatar"><?= strtoupper(substr($user['nama'] ?? 'U', 0, 1)); ?></div>
                    <div class="header-user-info">
                        <div class="header-user-name"><?= htmlspecialchars($user['nama'] ?? 'User'); ?></div>
                        <div class="header-user-email">Calon Pengusaha</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="content">
            <div class="container">
                <!-- WELCOME SECTION -->
                <div class="welcome-card">
                    <h1>Persiapan Bisnis Impianmu</h1>
                    <p>Mari mulai dengan langkah-langkah penting untuk membangun fondasi bisnis yang kuat</p>
                </div>

                <!-- PROGRESS SECTION -->
                <div class="progress-section">
                    <div class="progress-label">Progress Persiapan Bisnis</div>
                    <div class="progress-info">
                        <span>Tahap 1: Konsep Bisnis</span>
                        <span id="progress-text">0 dari 6 Selesai</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-inner" id="progress-bar-inner"></div>
                    </div>
                </div>

                <!-- CHECKLIST SECTION -->
                <div class="checklist-section">
                    <div class="section-title">Checklist Persiapan Bisnis</div>
                    <div class="checklist-grid">
                        <label class="checklist-item" data-step="1">
                            <input type="checkbox" class="checklist-check" checked disabled>
                            <span class="icon">✓</span>
                            <span>Tentukan Konsep Bisnis</span>
                        </label>
                        <label class="checklist-item" data-step="2">
                            <input type="checkbox" class="checklist-check">
                            <span class="icon">•</span>
                            <span>Hitung Modal & HPP</span>
                        </label>
                        <label class="checklist-item" data-step="3">
                            <input type="checkbox" class="checklist-check">
                            <span class="icon">•</span>
                            <span>Riset Pasar</span>
                        </label>
                        <label class="checklist-item" data-step="4">
                            <input type="checkbox" class="checklist-check">
                            <span class="icon">•</span>
                            <span>Analisis Kompetitor</span>
                        </label>
                        <label class="checklist-item" data-step="5">
                            <input type="checkbox" class="checklist-check">
                            <span class="icon">•</span>
                            <span>Buat Business Plan</span>
                        </label>
                        <label class="checklist-item" data-step="6">
                            <input type="checkbox" class="checklist-check">
                            <span class="icon">•</span>
                            <span>Persiapan Legalitas</span>
                        </label>
                    </div>
                </div>

                <!-- TOOLS SECTION -->
                <div class="tools-section">
                    <div class="section-title">Tools Perencanaan Bisnis</div>
                    <div class="tools-grid">
                        <div class="tool-card">
                            <div class="tool-icon">🤖</div>
                            <div class="tool-title">AI Business Advisor</div>
                            <div class="tool-desc">Konsultasi cerdas untuk strategi bisnis Anda</div>
                            <a href="<?= site_url('advisor'); ?>" class="tool-link">Konsultasi</a>
                        </div>
                        <div class="tool-card">
                            <div class="tool-icon">📊</div>
                            <div class="tool-title">Kalkulator HPP</div>
                            <div class="tool-desc">Hitung harga pokok produksi dengan akurat</div>
                            <a href="<?= site_url('hpp'); ?>" class="tool-link">Hitung HPP</a>
                        </div>
                        <div class="tool-card">
                            <div class="tool-icon">📈</div>
                            <div class="tool-title">Proyeksi Keuangan</div>
                            <div class="tool-desc">Simulasi untung-rugi bisnis Anda</div>
                            <a href="<?= site_url('keuangan'); ?>" class="tool-link">Simulasi</a>
                        </div>
                        <div class="tool-card">
                            <div class="tool-icon">🔍</div>
                            <div class="tool-title">Analisis Produk</div>
                            <div class="tool-desc">Riset pasar untuk produk atau layanan</div>
                            <a href="<?= site_url('analisis'); ?>" class="tool-link">Analisis</a>
                        </div>
                        <div class="tool-card">
                            <div class="tool-icon">⚠️</div>
                            <div class="tool-title">Analisis Risiko</div>
                            <div class="tool-desc">Identifikasi risiko bisnis sejak awal</div>
                            <a href="<?= site_url('risiko'); ?>" class="tool-link">Kelola Risiko</a>
                        </div>
                        <div class="tool-card">
                            <div class="tool-icon">💡</div>
                            <div class="tool-title">Informasi Bisnis</div>
                            <div class="tool-desc">Tips dan insight dunia UMKM</div>
                            <a href="<?= site_url('info'); ?>" class="tool-link">Info</a>
                        </div>
                    </div>
                </div>

                <!-- GUIDE SECTION -->
                <div class="guide-section">
                    <div class="section-title">Panduan Memulai Bisnis</div>
                    <div class="guide-progress">
                        <div class="guide-step completed">
                            <span>✓</span> Tahap 1
                        </div>
                        <div class="guide-step pending">
                            <span>2</span> Tahap 2
                        </div>
                        <div class="guide-step pending">
                            <span>3</span> Tahap 3
                        </div>
                    </div>
                    <div class="guide-grid">
                        <div class="guide-card">
                            <div class="guide-icon">🚀</div>
                            <div class="guide-title">Cara Memulai UMKM dari Nol</div>
                            <div class="guide-desc">Panduan lengkap untuk pemula yang ingin memulai usaha</div>
                            <a href="<?= site_url('panduan/umkm'); ?>" class="tool-link">Baca</a>
                            <div class="guide-check">
                                <input type="checkbox" checked disabled>
                                <span>Selesai</span>
                            </div>
                        </div>
                        <div class="guide-card">
                            <div class="guide-icon">🔍</div>
                            <div class="guide-title">Riset Pasar yang Efektif</div>
                            <div class="guide-desc">Teknik riset pasar untuk kesuksesan UMKM</div>
                            <a href="<?= site_url('panduan/risetpasar'); ?>" class="tool-link">Baca</a>
                            <div class="guide-check">
                                <input type="checkbox" disabled>
                                <span>Tandai</span>
                            </div>
                        </div>
                        <div class="guide-card">
                            <div class="guide-icon">💰</div>
                            <div class="guide-title">Kelola Modal Usaha</div>
                            <div class="guide-desc">Best practice pengelolaan keuangan bisnis</div>
                            <a href="<?= site_url('panduan/modalusaha'); ?>" class="tool-link">Baca</a>
                            <div class="guide-check">
                                <input type="checkbox" disabled>
                                <span>Tandai</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- UPGRADE MODAL -->
    <div class="upgrade-modal" id="upgradeModal">
        <div class="upgrade-modal-content">
            <div class="upgrade-icon">🎉</div>
            <h2>Selamat!</h2>
            <p>Anda sudah melewati tahap perencanaan! Saatnya ke level selanjutnya dan mulai mengoperasionalkan bisnis Anda.</p>
            <div class="upgrade-modal-buttons">
                <button class="upgrade-btn upgrade-btn-primary" onclick="upgradeToDashboardOperasional()">
                    Mulai Sekarang
                </button>
                <button class="upgrade-btn upgrade-btn-secondary" onclick="closeUpgradeModal()">
                    Nanti Saja
                </button>
            </div>
        </div>
    </div>

    <script>
        // Checklist functionality
        const checklistItems = document.querySelectorAll('.checklist-check');
        const progressBarInner = document.getElementById('progress-bar-inner');
        const progressText = document.getElementById('progress-text');
        const upgradeModal = document.getElementById('upgradeModal');

        function updateProgress() {
            const checkedItems = document.querySelectorAll('.checklist-check:checked').length;
            const totalItems = checklistItems.length;
            const percentage = (checkedItems / totalItems) * 100;
            const progressPercent = (checkedItems / totalItems) * 6;

            progressBarInner.style.width = percentage + '%';
            progressText.textContent = checkedItems + ' dari ' + totalItems + ' Selesai';

            // Update checklist item styling
            document.querySelectorAll('.checklist-item').forEach((item, index) => {
                const checkbox = item.querySelector('input[type="checkbox"]');
                const icon = item.querySelector('.icon');
                
                if (checkbox.checked) {
                    item.classList.add('checked');
                    icon.textContent = '✓';
                } else {
                    item.classList.remove('checked');
                    icon.textContent = '•';
                }
            });

            // Show upgrade modal when all items are checked
            if (checkedItems === totalItems && totalItems > 0) {
                showUpgradeModal();
            }
        }

        checklistItems.forEach(item => {
            item.addEventListener('change', updateProgress);
        });

        function showUpgradeModal() {
            upgradeModal.classList.add('show');
        }

        function closeUpgradeModal() {
            upgradeModal.classList.remove('show');
        }

        function upgradeToDashboardOperasional() {
            window.location.href = "<?= site_url('auth/dashboard_operasional'); ?>";
        }

        // Initialize progress on page load
        updateProgress();

        function toggleSidebar() {
            const body = document.body;
            const sidebar = document.querySelector('.sidebar');
            
            // Toggle classes
            body.classList.toggle('sidebar-collapsed');
            sidebar.classList.toggle('collapsed');
            
            // Visual feedback
            console.log('Sidebar toggled:', {
                bodyCollapsed: body.classList.contains('sidebar-collapsed'),
                sidebarCollapsed: sidebar.classList.contains('collapsed')
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth <= 768) {
                document.querySelector('.sidebar').classList.add('mobile-open');
            }
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.querySelector('.sidebar').classList.remove('mobile-open');
            }
        });
    </script>
</body>
</html>
