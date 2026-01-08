<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HPP Calculator - Usahain</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1F6B99;
            --primary-dark: #154A6F;
            --primary-light: #E8F4FB;
            --secondary: #7EC8E3;
            --success: #10B981;
            --danger: #EF4444;
            --warning: #F59E0B;
            --text: #1E293B;
            --text-secondary: #64748B;
            --bg: #F8FAFC;
            --card: #FFFFFF;
            --border: #E2E8F0;
            --shadow: 0 4px 12px rgba(31,107,153,0.1);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', Arial, sans-serif; background: var(--bg); color: var(--text); }
        nav { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; padding: 18px 32px; font-size: 1.1rem; display: flex; align-items: center; }
        nav a { color: #fff; margin-right: 28px; text-decoration: none; font-weight: 600; transition: color 0.2s; }
        nav a:hover { color: rgba(255,255,255,0.8); }
        nav .logout { margin-left: auto; }
        .container { max-width: 1100px; margin: 32px auto; padding: 0 18px; }
        .card { background: var(--card); border-radius: 12px; box-shadow: var(--shadow); padding: 32px 28px; margin-bottom: 32px; }
        .header { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; margin-bottom: 24px; gap: 12px; }
        .header h2 { font-size: 1.5rem; font-weight: 700; color: var(--primary-dark); }
        .btn { display: inline-block; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 1rem; border: none; cursor: pointer; transition: all 0.3s; }
        .btn-success { background: var(--success); color: #fff; }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: #fff; }
        .btn-warning { background: var(--warning); color: #fff; }
        .btn-danger { background: var(--danger); color: #fff; }
        .btn:hover { opacity: 0.92; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(31,107,153,0.2); }
        .summary-row { display: flex; gap: 18px; margin-bottom: 18px; }
        .summary-card { background: var(--primary-light); border-radius: 12px; padding: 18px 24px; flex: 1; text-align: center; box-shadow: 0 2px 8px rgba(31,107,153,0.08); border-left: 4px solid var(--primary); }
        .summary-card .label { color: var(--text-secondary); font-size: 1rem; margin-bottom: 4px; }
        .summary-card .value { font-size: 1.3rem; font-weight: 700; color: var(--primary-dark); }
        .filter-row { display: flex; gap: 12px; margin-bottom: 18px; }
        .filter-row input[type="text"] { flex: 2; padding: 12px 16px; border-radius: 8px; border: 1.5px solid var(--border); font-size: 1rem; background: #fff; color: var(--text); }
        .filter-row select { flex: 1; padding: 12px 16px; border-radius: 8px; border: 1.5px solid var(--border); font-size: 1rem; background: #fff; color: var(--text); }
        .filter-row input:focus, .filter-row select:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(31,107,153,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 18px; font-size: 1rem; }
        th, td { padding: 14px 10px; border-bottom: 1px solid var(--border); text-align: left; }
        th { background: var(--primary-light); color: var(--primary-dark); font-weight: 700; }
        .currency { text-align: right; font-weight: 600; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 6px; font-size: 0.85em; font-weight: 600; }
        .badge.success { background: #D1FAE5; color: #065F46; }
        .badge.danger { background: #FEE2E2; color: #991B1B; }
        .badge.warning { background: #FEF3C7; color: #92400E; }
        .alert { padding: 14px; margin-bottom: 20px; border-radius: 8px; font-size: 1rem; }
        .alert-success { background: #d4edda; color: #155724; }
        @media (max-width: 900px) {
            .summary-row, .filter-row { flex-direction: column; gap: 10px; }
            .header { flex-direction: column; gap: 10px; }
        }
    </style>
</head>
<body>
    <nav>
        <a href="<?= site_url('dashboard'); ?>">Dashboard</a>
        <a href="<?= site_url('hpp'); ?>">HPP Calculator</a>
        <a href="<?= site_url('auth/logout'); ?>" class="logout">Logout (<?= $this->session->userdata('nama'); ?>)</a>
    </nav>
    <div class="container">
        <div class="card">
            <div class="header">
                <h2>HPP Calculator - Perhitungan Biaya Produksi</h2>
                <a href="<?= site_url('hpp/create'); ?>" class="btn btn-success">+ Tambah HPP</a>
            </div>
            <div class="summary-row">
                <div class="summary-card">
                    <div class="label">Total Data HPP</div>
                    <div class="value"><?= isset($hpp_list) ? count($hpp_list) : 0 ?></div>
                </div>
                <div class="summary-card">
                    <div class="label">Rata-rata Margin</div>
                    <div class="value">
                        <?php 
                        $avg_margin = 0;
                        if (!empty($hpp_list)) {
                            $total_margin = 0;
                            foreach ($hpp_list as $hpp) {
                                $total_margin += ($hpp->harga_jual - $hpp->total_biaya);
                            }
                            $avg_margin = $total_margin / count($hpp_list);
                        }
                        echo 'Rp ' . number_format($avg_margin, 0, ',', '.');
                        ?>
                    </div>
                </div>
            </div>
            <div class="filter-row">
                <input type="text" id="searchInput" placeholder="Cari data HPP..." onkeyup="filterTable()">
                <select id="marginFilter" onchange="filterTable()">
                    <option value="">Semua Margin</option>
                    <option value="plus">Margin Positif</option>
                    <option value="minus">Margin Negatif</option>
                </select>
            </div>
            <?php if ($this->session->flashdata('success')) : ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            <?php if (empty($hpp_list)) : ?>
                <p style="padding: 20px; text-align: center; color: var(--muted);">Belum ada data HPP. <a href="<?= site_url('hpp/create'); ?>">Buat yang baru</a></p>
            <?php else : ?>
                <table id="hppTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Biaya Bahan</th>
                            <th>Biaya Tenaga Kerja</th>
                            <th>Total Biaya</th>
                            <th>Harga Jual</th>
                            <th>Margin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($hpp_list as $hpp) : ?>
                        <?php $margin = $hpp->harga_jual - $hpp->total_biaya; ?>
                        <tr data-margin="<?= $margin >= 0 ? 'plus' : 'minus' ?>">
                            <td><?= $no++; ?></td>
                            <td class="currency">Rp <?= number_format($hpp->bahan, 0, ',', '.'); ?></td>
                            <td class="currency">Rp <?= number_format($hpp->tenaga_kerja, 0, ',', '.'); ?></td>
                            <td class="currency"><strong>Rp <?= number_format($hpp->total_biaya, 0, ',', '.'); ?></strong></td>
                            <td class="currency">Rp <?= number_format($hpp->harga_jual, 0, ',', '.'); ?></td>
                            <td class="currency">
                                <span class="badge <?= $margin > 0 ? 'success' : ($margin < 0 ? 'danger' : 'warning') ?>">
                                    Rp <?= number_format($margin, 0, ',', '.'); ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= site_url('hpp/view/'.$hpp->id_hpp); ?>" class="btn btn-primary" style="padding: 5px 10px; font-size: 12px;">Lihat</a>
                                <a href="<?= site_url('hpp/edit/'.$hpp->id_hpp); ?>" class="btn btn-warning" style="padding: 5px 10px; font-size: 12px;">Edit</a>
                                <a href="<?= site_url('hpp/delete/'.$hpp->id_hpp); ?>" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px;">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    <script>
    function filterTable() {
        var input = document.getElementById('searchInput').value.toLowerCase();
        var marginFilter = document.getElementById('marginFilter').value;
        var table = document.getElementById('hppTable');
        if (!table) return;
        var trs = table.getElementsByTagName('tr');
        for (var i = 1; i < trs.length; i++) {
            var tr = trs[i];
            var text = tr.textContent.toLowerCase();
            var marginType = tr.getAttribute('data-margin');
            var show = true;
            if (input && text.indexOf(input) === -1) show = false;
            if (marginFilter && marginType !== marginFilter) show = false;
            tr.style.display = show ? '' : 'none';
        }
    }
    </script>
</body>
</html>
