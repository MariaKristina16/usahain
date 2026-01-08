<?php
$user = array_merge([
    'nama'  => 'User',
    'usaha'=> 'Bisnis Anda',
    'type' => 'Pemilik Usaha'
], (array)($user ?? []));

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
    <title>Dashboard Operasional - Usahain</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f2f6f9;
            color: #333;
        }

        .navbar {
            background: linear-gradient(135deg, #1F6B99, #154f7a);
            color: white;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .navbar h2 {
            font-size: 22px;
            font-weight: 700;
        }

        .navbar-right {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: opacity 0.3s;
        }

        .navbar a:hover {
            opacity: 0.8;
        }

        .container {
            max-width: 1200px;
            margin: 24px auto;
            padding: 16px;
        }

        .welcome {
            background: white;
            padding: 28px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .welcome h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #1F6B99;
        }

        .welcome p {
            color: #666;
            font-size: 15px;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .card small {
            color: #888;
            font-size: 13px;
        }

        .card h3 {
            margin-top: 8px;
            font-size: 24px;
            font-weight: 700;
        }

        .green { color: #10B981; }
        .red { color: #EF4444; }
        .blue { color: #1F6B99; }

        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 14px;
            margin-bottom: 24px;
        }

        .menu a {
            background: white;
            padding: 18px;
            border-radius: 12px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            font-weight: 600;
            display: block;
            text-align: center;
        }

        .menu a:hover {
            background: linear-gradient(135deg, #1F6B99, #154f7a);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(31,107,153,0.2);
        }

        .transaksi {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .transaksi h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #1F6B99;
        }

        .trx {
            display: flex;
            justify-content: space-between;
            padding: 12px;
            background: #f7f9fb;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .trx strong {
            color: #333;
            font-weight: 600;
        }

        .trx small {
            color: #888;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }

            .navbar-right {
                width: 100%;
                justify-content: center;
            }

            .summary {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <h2>📊 Usahain - Dashboard Operasional</h2>
    <div class="navbar-right">
        <span><?= htmlspecialchars($user['nama']); ?></span>
        <a href="<?= site_url('auth/logout'); ?>">Logout</a>
    </div>
</div>

<div class="container">

    <!-- WELCOME -->
    <div class="welcome">
        <h1>Selamat Datang, <?= htmlspecialchars($user['nama']); ?> 👋</h1>
        <p><?= htmlspecialchars($user['usaha']); ?> • <?= htmlspecialchars($user['type']); ?></p>
    </div>

    <!-- SUMMARY -->
    <div class="summary">
        <div class="card">
            <small>💰 Pendapatan Hari Ini</small>
            <h3 class="green">Rp <?= number_format($summary['today_sales'],0,',','.'); ?></h3>
        </div>
        <div class="card">
            <small>💸 Pengeluaran Hari Ini</small>
            <h3 class="red">Rp <?= number_format($summary['today_expense'],0,',','.'); ?></h3>
        </div>
        <div class="card">
            <small>📈 Laba Bersih</small>
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
                    <div style="font-weight:700;color:<?= $t['amount']<0?'#EF4444':'#10B981'; ?>">
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
