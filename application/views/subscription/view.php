<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Subscription</title>
    <style>
        :root {
            --primary: #1F6B99;
            --success: #2E7D32;
            --danger: #C62828;
            --text-dark: #1E293B;
            --text-muted: #64748B;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .navbar { background: var(--text-dark); color: #fff; padding: 15px 20px; display: flex; justify-content: space-between; margin-bottom: 20px; }
        .navbar a { color: #fff; text-decoration: none; margin-left: 15px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: var(--text-dark); margin-bottom: 20px; }
        .info-row { display: flex; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee; }
        .info-label { font-weight: bold; min-width: 150px; color: var(--text-muted); }
        .info-value { color: var(--text-dark); }
        .btn { display: inline-block; padding: 10px 20px; text-decoration: none; border: none; border-radius: 4px; cursor: pointer; margin-right: 10px; margin-top: 20px; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: #154A6F; }
        .btn-edit { background: var(--success); color: #fff; }
        .btn-edit:hover { background: #218838; }
        .btn-delete { background: var(--danger); color: #fff; }
        .btn-delete:hover { background: #c82333; }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>Detail Subscription</h2>
        <a href="<?php echo site_url('subscription'); ?>">&larr; Kembali</a>
    </div>

    <div class="container">
        <h1>Detail Subscription</h1>

        <div class="info-row">
            <div class="info-label">ID:</div>
            <div class="info-value"><?php echo $subscription->id_subs; ?></div>
        </div>

        <div class="info-row">
            <div class="info-label">Paket:</div>
            <div class="info-value"><?php echo htmlspecialchars($subscription->paket); ?></div>
        </div>

        <div class="info-row">
            <div class="info-label">Status:</div>
            <div class="info-value"><?php echo htmlspecialchars($subscription->status); ?></div>
        </div>

        <div class="info-row">
            <div class="info-label">Tgl Aktif:</div>
            <div class="info-value"><?php echo $subscription->tgl_aktif; ?></div>
        </div>

        <div class="info-row">
            <div class="info-label">Tgl Kadaluarsa:</div>
            <div class="info-value"><?php echo $subscription->tgl_expired; ?></div>
        </div>

        <div>
            <a href="<?php echo site_url('subscription/edit/' . $subscription->id_subs); ?>" class="btn btn-edit">Edit</a>
            <a href="<?php echo site_url('subscription/delete/' . $subscription->id_subs); ?>" class="btn btn-delete">Hapus</a>
        </div>
    </div>
</body>
</html>
