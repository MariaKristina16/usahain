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

$errors = $errors ?? [];
$success = $success ?? '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - Usahain</title>
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

        /* ===== HEADER ===== */
        .page-header {
            margin-bottom: 32px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #1e293b;
        }

        .page-header p {
            font-size: 15px;
            color: #64748b;
        }

        /* ===== ALERTS ===== */
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert-warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        /* ===== FORM SECTION ===== */
        .form-section {
            background: white;
            padding: 32px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .form-section-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-section-desc {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 24px;
        }

        /* ===== FORM GROUPS ===== */
        .form-group {
            margin-bottom: 24px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1e293b;
            font-size: 14px;
        }

        .form-label.required::after {
            content: '*';
            color: #ef4444;
            margin-left: 4px;
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            color: #1e293b;
            transition: all 0.3s;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #1f6b99;
            box-shadow: 0 0 0 3px rgba(31, 107, 153, 0.1);
            background: #f8fafc;
        }

        .form-input:disabled {
            background: #f1f5f9;
            color: #94a3b8;
            cursor: not-allowed;
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-helper {
            font-size: 12px;
            color: #64748b;
            margin-top: 6px;
        }

        .form-error {
            font-size: 12px;
            color: #ef4444;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ===== FORM ROW ===== */
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
        }

        /* ===== BUTTONS ===== */
        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-start;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
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
        }

        .btn-primary:hover {
            box-shadow: 0 8px 16px rgba(31, 107, 153, 0.3);
            transform: translateY(-2px);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
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

        /* ===== AVATAR UPLOAD ===== */
        .avatar-section {
            display: flex;
            align-items: center;
            gap: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 24px;
        }

        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            background: linear-gradient(135deg, #1f6b99 0%, #3a88ba 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-weight: 800;
            color: white;
            flex-shrink: 0;
            overflow: hidden;
            object-fit: cover;
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-controls {
            flex: 1;
        }

        .avatar-info {
            font-size: 13px;
            color: #64748b;
            margin-top: 8px;
            line-height: 1.6;
        }

        /* ===== DANGER ZONE ===== */
        .danger-zone {
            background: #fef2f2;
            border: 2px solid #fee2e2;
            padding: 24px;
            border-radius: 12px;
            margin-top: 32px;
        }

        .danger-zone-title {
            font-size: 16px;
            font-weight: 700;
            color: #991b1b;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .danger-zone-desc {
            font-size: 14px;
            color: #7f1d1d;
            margin-bottom: 16px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .container {
                padding: 16px;
            }

            .form-section {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .avatar-section {
                flex-direction: column;
                text-align: center;
            }
        }

        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 32px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="<?= site_url('user/profile/' . $user['id_user']); ?>" class="back-link">← Kembali ke Profile</a>

        <div class="page-header">
            <h1>⚙️ Pengaturan Akun</h1>
            <p>Kelola informasi profil dan preferensi akun Anda</p>
        </div>

        <?php if ($success): ?>
            <div class="alert alert-success">
                <span>✓</span>
                <div><?= htmlspecialchars($success); ?></div>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-error">
                    <span>!</span>
                    <div><?= htmlspecialchars($error); ?></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- EDIT PROFIL SECTION -->
        <div class="form-section">
            <div class="form-section-title">👤 Informasi Profil</div>
            <div class="form-section-desc">Perbarui informasi pribadi dan data bisnis Anda</div>

            <form method="POST" action="<?= site_url('user/update_profile/' . $user['id_user']); ?>">
                <div class="form-group">
                    <label class="form-label required">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-input" value="<?= htmlspecialchars($user['nama']); ?>" required>
                    <div class="form-helper">Nama yang akan ditampilkan di aplikasi</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" value="<?= htmlspecialchars($user['email'] ?? '-'); ?>" disabled>
                    <div class="form-helper">Email tidak dapat diubah untuk menjaga keamanan akun</div>
                </div>

                <div class="divider"></div>

                <div class="form-section-title">💼 Informasi Bisnis</div>
                <div class="form-section-desc">Data bisnis yang Anda kelola</div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Usaha</label>
                        <input type="text" name="nama_usaha" class="form-input" value="<?= htmlspecialchars($user['nama_usaha'] ?? ''); ?>">
                        <div class="form-helper">Contoh: Toko Fashion Online, Warung Makan, dll</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jenis Usaha</label>
                        <select name="jenis_usaha" class="form-select">
                            <option value="">-- Pilih Jenis Usaha --</option>
                            <option value="kuliner" <?= ($user['jenis_usaha'] === 'kuliner' ? 'selected' : ''); ?>>Kuliner</option>
                            <option value="fashion" <?= ($user['jenis_usaha'] === 'fashion' ? 'selected' : ''); ?>>Fashion</option>
                            <option value="kerajinan" <?= ($user['jenis_usaha'] === 'kerajinan' ? 'selected' : ''); ?>>Kerajinan</option>
                            <option value="jasa" <?= ($user['jenis_usaha'] === 'jasa' ? 'selected' : ''); ?>>Jasa</option>
                            <option value="retail" <?= ($user['jenis_usaha'] === 'retail' ? 'selected' : ''); ?>>Retail</option>
                            <option value="digital" <?= ($user['jenis_usaha'] === 'digital' ? 'selected' : ''); ?>>Digital</option>
                            <option value="lainnya" <?= ($user['jenis_usaha'] === 'lainnya' ? 'selected' : ''); ?>>Lainnya</option>
                        </select>
                        <div class="form-helper">Kategori industri utama bisnis Anda</div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
                    <a href="<?= site_url('user/profile/' . $user['id_user']); ?>" class="btn btn-secondary">❌ Batal</a>
                </div>
            </form>
        </div>

        <!-- SECURITY SECTION -->
        <?php if ($user['oauth_provider'] === 'local'): ?>
        <div class="form-section">
            <div class="form-section-title">🔐 Keamanan & Password</div>
            <div class="form-section-desc">Kelola keamanan akun Anda</div>

            <form method="POST" action="<?= site_url('user/change_password'); ?>">
                <div class="form-group">
                    <label class="form-label required">Password Lama</label>
                    <input type="password" name="password_lama" class="form-input" required>
                    <div class="form-helper">Masukkan password saat ini untuk verifikasi</div>
                </div>

                <div class="form-group">
                    <label class="form-label required">Password Baru</label>
                    <input type="password" name="password_baru" class="form-input" minlength="6" required>
                    <div class="form-helper">Minimal 6 karakter, gunakan kombinasi huruf dan angka</div>
                </div>

                <div class="form-group">
                    <label class="form-label required">Konfirmasi Password Baru</label>
                    <input type="password" name="konfirmasi_password" class="form-input" minlength="6" required>
                    <div class="form-helper">Ketik ulang password baru untuk konfirmasi</div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">🔑 Ubah Password</button>
                    <a href="<?= site_url('user/profile/' . $user['id_user']); ?>" class="btn btn-secondary">❌ Batal</a>
                </div>
            </form>
        </div>
        <?php endif; ?>

        <!-- PREFERENCES SECTION -->
        <div class="form-section">
            <div class="form-section-title">📋 Preferensi</div>
            <div class="form-section-desc">Atur preferensi dan notifikasi Anda</div>

            <div style="padding: 16px; background: #f8fafc; border-radius: 8px; border-left: 4px solid #1f6b99; margin-bottom: 24px;">
                <div style="font-weight: 600; color: #1e293b; margin-bottom: 8px;">📧 Notifikasi Email</div>
                <div style="font-size: 14px; color: #64748b;">
                    Anda akan menerima email untuk aktivitas penting seperti login baru, perubahan password, dan update fitur.
                </div>
            </div>

            <div style="padding: 16px; background: #f8fafc; border-radius: 8px; border-left: 4px solid #1f6b99;">
                <div style="font-weight: 600; color: #1e293b; margin-bottom: 8px;">🔒 Status Keamanan</div>
                <div style="font-size: 14px; color: #64748b; margin-bottom: 12px;">
                    Akun Anda dilindungi dengan enkripsi tingkat tinggi dan protokol keamanan terbaru.
                </div>
                <div style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: #10b981; font-weight: 600;">
                    ✓ Aman & Terverifikasi
                </div>
            </div>
        </div>

        <!-- ACCOUNT INFO SECTION -->
        <div class="form-section">
            <div class="form-section-title">ℹ️ Informasi Akun</div>
            <div class="form-section-desc">Detail akun dan riwayat</div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div style="padding: 16px; background: #f8fafc; border-radius: 8px;">
                    <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; margin-bottom: 8px;">ID Pengguna</div>
                    <div style="font-size: 16px; font-weight: 700; color: #1e293b;">#<?= htmlspecialchars($user['id_user']); ?></div>
                </div>

                <div style="padding: 16px; background: #f8fafc; border-radius: 8px;">
                    <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; margin-bottom: 8px;">Metode Autentikasi</div>
                    <div style="font-size: 16px; font-weight: 700; color: #1e293b;">
                        <?php echo $user['oauth_provider'] === 'google' ? '🔐 Google' : '📧 Email'; ?>
                    </div>
                </div>

                <div style="padding: 16px; background: #f8fafc; border-radius: 8px;">
                    <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; margin-bottom: 8px;">Terdaftar Sejak</div>
                    <div style="font-size: 16px; font-weight: 700; color: #1e293b;"><?= date('d M Y', strtotime($user['created_at'])); ?></div>
                </div>

                <div style="padding: 16px; background: #f8fafc; border-radius: 8px;">
                    <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; margin-bottom: 8px;">Status Akun</div>
                    <div style="font-size: 16px; font-weight: 700; color: #10b981;">✓ Aktif</div>
                </div>
            </div>
        </div>

        <!-- DANGER ZONE -->
        <div class="danger-zone">
            <div class="danger-zone-title">⚠️ Zona Berbahaya</div>
            <div class="danger-zone-desc">Tindakan di bawah ini tidak dapat dibatalkan. Harap berhati-hati.</div>
            
            <a href="<?= site_url('user/delete_account/' . $user['id_user']); ?>" class="btn btn-danger" onclick="return confirm('⚠️ PERHATIAN!\n\nHapus akun akan menghapus SEMUA data bisnis Anda secara permanen.\n\nApakah Anda yakin ingin melanjutkan?');">
                🗑️ Hapus Akun Secara Permanen
            </a>
        </div>
    </div>

    <script>
        // Form validation
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const inputs = this.querySelectorAll('input[required], select[required]');
                let isValid = true;

                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.style.borderColor = '#ef4444';
                    } else {
                        input.style.borderColor = '#e2e8f0';
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Mohon lengkapi semua bidang yang diperlukan');
                }
            });
        });
    </script>
</body>
</html>
