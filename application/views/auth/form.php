<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($user) ? 'Edit User' : 'Tambah User'; ?></title>
    <style>
        :root { --primary: #1F6B99; --primary-dark: #154A6F; --secondary: #7EC8E3; --danger: #EF4444; --text: #1E293B; --text-secondary: #64748B; --border: #E2E8F0; --bg: #F8FAFC; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', Arial, sans-serif; background: var(--bg); padding: 20px; color: var(--text); }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        h1 { color: var(--primary-dark); margin-bottom: 24px; font-size: 24px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 8px; color: var(--text); font-weight: 600; font-size: 14px; }
        input, select, textarea { width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; color: var(--text); background: #fff; }
        input:focus, select:focus, textarea:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(31,107,153,0.1); }
        .error { color: var(--danger); font-size: 12px; margin-top: 5px; }
        .btn { display: inline-block; padding: 11px 22px; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: #fff; border: none; border-radius: 8px; cursor: pointer; margin-right: 10px; font-weight: 600; font-size: 14px; transition: all 0.3s; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(31,107,153,0.25); }
        .btn-secondary { background: var(--text-secondary); }
        .btn-secondary:hover { background: var(--text); }
        .back-link { display: inline-block; margin-bottom: 20px; color: var(--primary); text-decoration: none; font-weight: 600; font-size: 14px; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <a href="<?php echo site_url('user'); ?>" class="back-link">&larr; Kembali ke Daftar User</a>
        <h1><?php echo isset($user) ? 'Edit User' : 'Tambah User Baru'; ?></h1>

        <?php if ($this->form_validation->run() === FALSE): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label for="nama">Nama *</label>
                <input type="text" id="nama" name="nama" value="<?php echo isset($user) ? htmlspecialchars($user->nama) : set_value('nama'); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" value="<?php echo isset($user) ? htmlspecialchars($user->email) : set_value('email'); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password <?php echo isset($user) ? '(biarkan kosong jika tidak ingin mengubah)' : '*'; ?></label>
                <input type="password" id="password" name="password" <?php echo !isset($user) ? 'required' : ''; ?>>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role">
                    <option value="user" <?php echo (isset($user) && $user->role === 'user') ? 'selected' : ''; ?>>User</option>
                    <option value="admin" <?php echo (isset($user) && $user->role === 'admin') ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nama_usaha">Nama Usaha</label>
                <input type="text" id="nama_usaha" name="nama_usaha" value="<?php echo isset($user) ? htmlspecialchars($user->nama_usaha ?? '') : set_value('nama_usaha'); ?>">
            </div>

            <div>
                <button type="submit" class="btn">Simpan</button>
                <a href="<?php echo site_url('user'); ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
