<?php
$user = array_merge([
    'id_user'      => '',
    'nama'         => 'User',
    'email'        => '-',
    'nama_usaha'   => '-',
    'jenis_usaha'  => '-',
    'avatar_url'   => '',
    'oauth_provider' => 'local',
    'created_at'   => '-'
], (array)($user ?? []));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Usahain</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', Segoe UI, Arial;
            background: #f8fafc;
            color: #1e293b;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        /* ===== HEADER ===== */
        .header {
            background: linear-gradient(135deg, #1F6B99 0%, #3A88BA 100%);
            color: white;
            padding: 40px 30px;
            border-radius: 16px;
            margin-bottom: 40px;
            box-shadow: 0 4px 20px rgba(31, 107, 153, 0.15);
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.2);
            border: 3px solid rgba(255, 255, 255, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: 800;
            flex-shrink: 0;
            overflow: hidden;
            object-fit: cover;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .profile-info p {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 4px;
        }

        .profile-info .badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 12px;
        }

        /* ===== NAV TABS ===== */
        .nav-tabs {
            display: flex;
            gap: 0;
            border-bottom: 2px solid #e2e8f0;
            margin-bottom: 40px;
        }

        .nav-tab {
            padding: 16px 24px;
            border: none;
            background: none;
            color: #64748b;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
        }

        .nav-tab:hover {
            color: #1f6b99;
        }

        .nav-tab.active {
            color: #1f6b99;
            border-bottom-color: #1f6b99;
        }

        /* ===== CONTENT SECTIONS ===== */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== INFO CARDS ===== */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .info-card-label {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .info-card-value {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            word-break: break-word;
        }

        .info-card-secondary {
            font-size: 14px;
            color: #64748b;
            margin-top: 8px;
        }

        /* ===== ACTIVITY SECTION ===== */
        .activity-item {
            background: white;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #1f6b99;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .activity-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 8px;
        }

        .activity-title {
            font-weight: 600;
            color: #1e293b;
            font-size: 15px;
        }

        .activity-date {
            font-size: 12px;
            color: #94a3b8;
        }

        .activity-desc {
            font-size: 14px;
            color: #64748b;
            margin-top: 8px;
            line-height: 1.5;
        }

        /* ===== BUTTONS ===== */
        .btn-group {
            display: flex;
            gap: 12px;
            justify-content: flex-start;
            margin-bottom: 40px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1f6b99 0%, #3a88ba 100%);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            box-shadow: 0 8px 16px rgba(31, 107, 153, 0.3);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: white;
            color: #1f6b99;
            border: 2px solid #1f6b99;
        }

        .btn-secondary:hover {
            background: #e8f4fb;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        /* ===== STATS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            border: 1px solid #e2e8f0;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: #1f6b99;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .nav-tabs {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .nav-tab {
                padding: 12px 16px;
                font-size: 14px;
                white-space: nowrap;
            }

            .info-grid, .stats-grid {
                grid-template-columns: 1fr;
            }

            .btn-group {
                flex-wrap: wrap;
            }
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1f6b99;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="<?= site_url('dashboard/perencanaan'); ?>" class="back-link">← Kembali ke Dashboard</a>

        <!-- PROFILE HEADER -->
        <div class="header">
            <div class="profile-avatar">
                <?php if (!empty($user['avatar_url'])): ?>
                    <img src="<?= htmlspecialchars($user['avatar_url']); ?>" alt="Avatar">
                <?php else: ?>
                    <?= strtoupper(substr($user['nama'] ?? 'U', 0, 1)); ?>
                <?php endif; ?>
            </div>
            <div class="profile-info">
                <h1><?= htmlspecialchars($user['nama']); ?></h1>
                <p><?= htmlspecialchars($user['email'] ?? '-'); ?></p>
                <p style="margin-bottom: 16px;">Bergabung sejak <?= date('d M Y', strtotime($user['created_at'])); ?></p>
                <span class="badge">
                    <?php 
                    $provider = $user['oauth_provider'] ?? 'local';
                    echo $provider === 'google' ? '🔐 Google OAuth' : '📧 Email & Password';
                    ?>
                </span>
            </div>
        </div>

        <!-- NAV TABS -->
        <div class="nav-tabs">
            <button class="nav-tab active" onclick="showTab('overview')">
                📋 Ringkasan
            </button>
            <button class="nav-tab" onclick="showTab('business')">
                💼 Data Bisnis
            </button>
            <button class="nav-tab" onclick="showTab('activity')">
                📊 Aktivitas
            </button>
            <button class="nav-tab" onclick="showTab('settings')">
                ⚙️ Pengaturan
            </button>
        </div>

        <!-- TAB: OVERVIEW -->
        <div id="overview" class="tab-content active">
            <div class="btn-group">
                <a href="<?= site_url('user/edit/' . $user['id_user']); ?>" class="btn btn-primary">
                    ✏️ Edit Profile
                </a>
                <a href="<?= site_url('user/settings'); ?>" class="btn btn-secondary">
                    ⚙️ Pengaturan Akun
                </a>
            </div>

            <h2 style="margin-bottom: 24px; font-size: 20px; color: #1e293b;">Informasi Akun</h2>
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-card-label">ID Pengguna</div>
                    <div class="info-card-value">#<?= htmlspecialchars($user['id_user']); ?></div>
                </div>
                <div class="info-card">
                    <div class="info-card-label">Nama Lengkap</div>
                    <div class="info-card-value"><?= htmlspecialchars($user['nama']); ?></div>
                </div>
                <div class="info-card">
                    <div class="info-card-label">Email</div>
                    <div class="info-card-value"><?= htmlspecialchars($user['email'] ?? '-'); ?></div>
                </div>
                <div class="info-card">
                    <div class="info-card-label">Metode Autentikasi</div>
                    <div class="info-card-value">
                        <?php echo $user['oauth_provider'] === 'google' ? 'Google' : 'Email'; ?>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-card-label">Terdaftar Sejak</div>
                    <div class="info-card-value"><?= date('d M Y', strtotime($user['created_at'])); ?></div>
                </div>
                <div class="info-card">
                    <div class="info-card-label">Status Akun</div>
                    <div class="info-card-value" style="color: #10b981;">✓ Aktif</div>
                </div>
            </div>
        </div>

        <!-- TAB: BUSINESS -->
        <div id="business" class="tab-content">
            <div class="btn-group">
                <a href="<?= site_url('user/edit/' . $user['id_user']); ?>" class="btn btn-primary">
                    ✏️ Edit Data Bisnis
                </a>
            </div>

            <h2 style="margin-bottom: 24px; font-size: 20px; color: #1e293b;">Data Bisnis Anda</h2>
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-card-label">Nama Usaha</div>
                    <div class="info-card-value"><?= htmlspecialchars($user['nama_usaha'] ?? '-'); ?></div>
                    <div class="info-card-secondary">
                        Nama resmi bisnis Anda
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-card-label">Jenis Usaha</div>
                    <div class="info-card-value"><?= htmlspecialchars($user['jenis_usaha'] ?? '-'); ?></div>
                    <div class="info-card-secondary">
                        Kategori industri utama
                    </div>
                </div>
            </div>

            <?php if (!empty($user['nama_usaha']) || !empty($user['jenis_usaha'])): ?>
            <div style="margin-top: 40px; padding: 24px; background: #e8f4fb; border-radius: 12px; border-left: 4px solid #1f6b99;">
                <h3 style="color: #1f6b99; margin-bottom: 12px; font-size: 16px;">💡 Tips Pengembangan</h3>
                <ul style="color: #1f6b99; margin-left: 20px; line-height: 1.8; font-size: 14px;">
                    <li>Konsistenkan branding bisnis Anda di semua platform</li>
                    <li>Catat semua transaksi untuk monitoring keuangan yang akurat</li>
                    <li>Manfaatkan tools Usahain untuk perencanaan dan analisis bisnis</li>
                    <li>Evaluasi performa bisnis secara berkala</li>
                </ul>
            </div>
            <?php endif; ?>
        </div>

        <!-- TAB: ACTIVITY -->
        <div id="activity" class="tab-content">
            <h2 style="margin-bottom: 24px; font-size: 20px; color: #1e293b;">Aktivitas Terbaru</h2>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number"><?= $advisor_count ?? 0; ?></div>
                    <div class="stat-label">Konsultasi AI</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?= $transaksi_count ?? 0; ?></div>
                    <div class="stat-label">Transaksi Tercatat</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?= $analisis_count ?? 0; ?></div>
                    <div class="stat-label">Analisis Produk</div>
                </div>
            </div>

            <h3 style="margin: 32px 0 16px 0; font-size: 16px; color: #1e293b;">Riwayat Aktivitas</h3>
            
            <?php if (!empty($activities)): ?>
                <?php foreach ($activities as $activity): ?>
                <div class="activity-item">
                    <div class="activity-header">
                        <div class="activity-title"><?= htmlspecialchars($activity['title']); ?></div>
                        <div class="activity-date"><?= date('d M Y', strtotime($activity['date'])); ?></div>
                    </div>
                    <div class="activity-desc"><?= htmlspecialchars($activity['description']); ?></div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="padding: 40px; text-align: center; background: white; border-radius: 12px; color: #94a3b8;">
                    <p style="font-size: 16px; margin-bottom: 8px;">📊 Belum ada aktivitas</p>
                    <p style="font-size: 14px;">Mulai gunakan Usahain untuk merencanakan bisnis Anda</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- TAB: SETTINGS -->
        <div id="settings" class="tab-content">
            <h2 style="margin-bottom: 24px; font-size: 20px; color: #1e293b;">Pengaturan Akun</h2>
            
            <div class="btn-group">
                <a href="<?= site_url('user/edit/' . $user['id_user']); ?>" class="btn btn-primary">
                    ✏️ Edit Profil
                </a>
                <?php if ($user['oauth_provider'] === 'local'): ?>
                <a href="<?= site_url('user/change_password'); ?>" class="btn btn-secondary">
                    🔑 Ubah Password
                </a>
                <?php endif; ?>
                <a href="<?= site_url('auth/logout'); ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin logout?');">
                    🚪 Logout
                </a>
            </div>

            <div style="background: white; padding: 24px; border-radius: 12px; border: 1px solid #e2e8f0; margin-top: 24px;">
                <h3 style="color: #1e293b; margin-bottom: 16px; font-size: 16px;">Preferensi Keamanan</h3>
                
                <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #e2e8f0;">
                    <div style="font-weight: 600; color: #1e293b; margin-bottom: 8px;">Verifikasi Email</div>
                    <div style="font-size: 14px; color: #64748b; margin-bottom: 12px;">
                        Email Anda: <strong><?= htmlspecialchars($user['email'] ?? '-'); ?></strong>
                    </div>
                    <div style="font-size: 13px; color: #10b981; display: inline-flex; align-items: center; gap: 6px;">
                        ✓ Terverifikasi
                    </div>
                </div>

                <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #e2e8f0;">
                    <div style="font-weight: 600; color: #1e293b; margin-bottom: 8px;">Metode Autentikasi</div>
                    <div style="font-size: 14px; color: #64748b;">
                        <?php 
                        $auth_method = $user['oauth_provider'] === 'google' ? 'Google OAuth' : 'Email & Password';
                        echo $auth_method;
                        ?>
                    </div>
                </div>

                <div>
                    <div style="font-weight: 600; color: #1e293b; margin-bottom: 8px;">Aktivitas Login</div>
                    <div style="font-size: 14px; color: #64748b;">
                        Terakhir login: <strong><?= date('d M Y H:i', strtotime($user['updated_at'])); ?></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });

            // Remove active class from all nav tabs
            document.querySelectorAll('.nav-tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // Show selected tab
            document.getElementById(tabName).classList.add('active');

            // Add active class to clicked nav tab
            event.target.classList.add('active');
        }
    </script>
</body>
</html>
