<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisis Produk - Usahain</title>
    <style>
        :root {
            --primary: #1F6B99;
            --primary-dark: #154A73;
            --primary-light: #E8F4FB;
            --secondary: #7EC8E3;
            --accent: #FF9800;
            --success: #48C9B0;
            --danger: #E74C3C;
            --warning: #F39C12;
            --text: #2C3E50;
            --text-light: #7F8C8D;
            --bg-light: #F8FAFC;
            --border: #E2E8F0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1F6B99 0%, #2E7BA8 50%, #7EC8E3 100%);
            min-height: 100vh;
            padding: 20px;
            color: var(--text);
            line-height: 1.8;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            color: var(--primary);
            font-size: 24px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-links {
            display: flex;
            gap: 15px;
        }

        .navbar a {
            color: var(--primary);
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .navbar a:hover {
            background: var(--primary);
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 48px 52px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 28px;
            border-bottom: 2px solid var(--bg-light);
        }

        h1 {
            color: var(--primary-dark);
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
            line-height: 1.4;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(31, 107, 153, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(31, 107, 153, 0.4);
        }

        .btn-small {
            padding: 8px 16px;
            font-size: 13px;
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--success) 0%, #38B5A0 100%);
            box-shadow: 0 4px 15px rgba(72, 201, 176, 0.3);
        }

        .btn-edit:hover {
            box-shadow: 0 6px 20px rgba(72, 201, 176, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, var(--danger) 0%, #c0392b 100%);
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }

        .btn-delete:hover {
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        }

        .btn-view {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-view:hover {
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 48px;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary-light) 0%, #fff 100%);
            padding: 32px 28px;
            border-radius: 15px;
            border-left: 4px solid var(--primary);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card h3 {
            color: var(--text-light);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 14px;
            font-weight: 700;
        }

        .stat-card .value {
            color: var(--primary-dark);
            font-size: 32px;
            font-weight: 800;
            line-height: 1.4;
            word-break: break-word;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            background: #fff;
            margin: 0;
        }

        th, td {
            padding: 20px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            line-height: 1.6;
        }

        th {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.8px;
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: linear-gradient(90deg, var(--primary-light) 0%, rgba(126,200,227,0.1) 100%);
            transform: scale(1.01);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .empty {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-light);
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .profit-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.4;
        }

        .profit-positive {
            background: #D4EDDA;
            color: #1F6B99;
            font-weight: 600;
        }

        .profit-negative {
            background: #F8D7DA;
            color: #721C24;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
                line-height: 1.7;
            }

            .container {
                padding: 28px 20px;
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
                padding: 16px 20px;
            }

            .navbar-links {
                width: 100%;
                justify-content: center;
            }

            .header-section {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
                margin-bottom: 32px;
                padding-bottom: 20px;
            }

            h1 {
                font-size: 22px;
                line-height: 1.3;
            }

            .stats-cards {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 13px;
            }

            th, td {
                padding: 10px 8px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-small {
                width: 100%;
                justify-content: center;
            }

            /* ANALISIS PRODUK OTOMATIS STYLES */
            .produk-analisis-card {
                background: linear-gradient(135deg, rgba(31,107,153,0.08) 0%, rgba(126,200,227,0.08) 100%);
                box-shadow: 0 4px 16px rgba(31,107,153,0.12);
                border-radius: 18px;
                padding: 36px 32px;
                margin-bottom: 48px;
                border: 1px solid rgba(31,107,153,0.15);
            }

            .produk-analisis-flex {
                display: flex;
                flex-wrap: wrap;
                gap: 32px;
                align-items: flex-start;
                justify-content: space-between;
            }

            .produk-analisis-info {
                flex: 1 1 300px;
                min-width: 240px;
            }

            .produk-analisis-info h3 {
                font-size: 22px;
                color: var(--primary-dark);
                font-weight: 700;
                margin-bottom: 20px;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .produk-summary-item {
                margin-bottom: 16px;
                font-size: 15px;
                color: var(--text);
                font-weight: 600;
                display: flex;
                align-items: flex-start;
                gap: 10px;
                padding: 12px 14px;
                background: rgba(255,255,255,0.8);
                border-radius: 8px;
                border-left: 3px solid var(--primary);
                line-height: 1.8;
            }

            .produk-terlaris { color: #1F6B99; font-weight: 700; }
            .produk-profit { color: #48C9B0; font-weight: 700; }
            .produk-perhatian { color: #E74C3C; font-weight: 700; }
            .produk-summary-meta { color: var(--text-light); font-size: 13px; font-weight: 500; line-height: 1.6; }

            .produk-rekomendasi {
                margin-top: 24px;
                padding: 18px 20px;
                color: var(--primary-dark);
                font-size: 14px;
                list-style: none;
                background: rgba(255,255,255,0.6);
                border-radius: 10px;
                border-left: 4px solid var(--success);
                line-height: 1.9;
            }

            .produk-rekomendasi li {
                margin-bottom: 12px;
                padding-left: 26px;
                position: relative;
                line-height: 1.7;
            }

            .produk-rekomendasi li::before {
                content: '→';
                position: absolute;
                left: 0;
                color: var(--success);
                font-weight: 700;
            }

            .produk-rekomendasi li:last-child {
                margin-bottom: 0;
            }

            .produk-analisis-chart {
                flex: 1 1 280px;
                min-width: 200px;
                max-width: 400px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255,255,255,0.8);
                border-radius: 12px;
                padding: 16px;
            }

            @media (max-width: 900px) {
                .produk-analisis-card { padding: 16px 12px; }
                .produk-analisis-flex { flex-direction: column; gap: 20px; }
                .produk-analisis-chart { max-width: 100%; min-width: 0; }
                .produk-analisis-info h3 { font-size: 18px; }
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>📊 Analisis Produk - Usahain</h2>
        <div class="navbar-links">
            <a href="<?php echo site_url('auth/dashboard'); ?>">🏠 Dashboard</a>
            <a href="<?php echo site_url('auth/logout'); ?>">🚪 Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="header-section">
            <h1>💼 Data Analisis Produk</h1>
            <a href="<?php echo site_url('analisis/create'); ?>" class="btn">
                ➕ Tambah Analisis Baru
            </a>
        </div>

        <?php if (!empty($produk_list)): ?>
            <!-- ANALISIS PRODUK OTOMATIS SECTION -->
            <div class="produk-analisis-card">
                <div class="produk-analisis-flex">
                    <div class="produk-analisis-info">
                        <h3>📊 Analisis Performa Produk Real-Time</h3>
                        <div id="produkSummary">
                            <?php
                                // Hitung analisis otomatis dari data real
                                $produk_terlaris = null;
                                $max_penjualan = 0;
                                $max_profit = 0;
                                $produk_profit_max = null;
                                
                                foreach($produk_list as $p) {
                                    if($p->penjualan > $max_penjualan) {
                                        $max_penjualan = $p->penjualan;
                                        $produk_terlaris = $p;
                                    }
                                    $profit = $p->penjualan - $p->biaya_produksi;
                                    if($profit > $max_profit) {
                                        $max_profit = $profit;
                                        $produk_profit_max = $p;
                                    }
                                }
                                
                                // Temukan produk dengan penjualan terendah
                                $min_penjualan = PHP_INT_MAX;
                                $produk_rendah = null;
                                foreach($produk_list as $p) {
                                    if($p->penjualan < $min_penjualan) {
                                        $min_penjualan = $p->penjualan;
                                        $produk_rendah = $p;
                                    }
                                }
                            ?>
                            <div class="produk-summary-item">
                                <strong>🏆 Produk Terlaris:</strong>
                                <span class="produk-terlaris"><?= htmlspecialchars($produk_terlaris->nama_produk ?? '-'); ?></span>
                                <span class="produk-summary-meta">(Rp <?= number_format($produk_terlaris->penjualan ?? 0, 0, ',', '.'); ?>)</span>
                            </div>
                            <div class="produk-summary-item">
                                <strong>💎 Profit Tertinggi:</strong>
                                <span class="produk-profit"><?= htmlspecialchars($produk_profit_max->nama_produk ?? '-'); ?></span>
                                <span class="produk-summary-meta">(Rp <?= number_format($max_profit, 0, ',', '.'); ?>)</span>
                            </div>
                            <div class="produk-summary-item">
                                <strong>⚠️ Perlu Perhatian:</strong>
                                <span class="produk-perhatian"><?= htmlspecialchars($produk_rendah->nama_produk ?? '-'); ?></span>
                                <span class="produk-summary-meta">(Penjualan: Rp <?= number_format($produk_rendah->penjualan ?? 0, 0, ',', '.'); ?>)</span>
                            </div>
                        </div>
                        <ul id="produkRekomendasi" class="produk-rekomendasi">
                            <li>Fokuskan promosi pada <strong><?= htmlspecialchars($produk_terlaris->nama_produk ?? 'produk terlaris'); ?></strong> karena permintaan tinggi</li>
                            <li>Manfaatkan margin tinggi <strong><?= htmlspecialchars($produk_profit_max->nama_produk ?? 'produk profit'); ?></strong> untuk maksimalkan revenue</li>
                            <?php if($produk_rendah): ?>
                                <li>Evaluasi strategi atau harga untuk <strong><?= htmlspecialchars($produk_rendah->nama_produk); ?></strong></li>
                            <?php endif; ?>
                            <li>Monitor tren penjualan setiap hari untuk strategi inventory yang lebih baik</li>
                        </ul>
                    </div>
                    <div class="produk-analisis-chart">
                        <canvas id="produkChart" height="180"></canvas>
                    </div>
                </div>
            </div>
            <!-- END ANALISIS OTOMATIS -->
            
            <div class="stats-cards">
                <div class="stat-card">
                    <h3>Total Produk</h3>
                    <div class="value"><?php echo count($produk_list); ?></div>
                </div>
                <div class="stat-card">
                    <h3>Total Penjualan</h3>
                    <div class="value">
                        Rp <?php 
                            $total_penjualan = array_sum(array_column($produk_list, 'penjualan'));
                            echo number_format($total_penjualan, 0, ',', '.'); 
                        ?>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Total Biaya</h3>
                    <div class="value">
                        Rp <?php 
                            $total_biaya = array_sum(array_column($produk_list, 'biaya_produksi'));
                            echo number_format($total_biaya, 0, ',', '.'); 
                        ?>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Total Profit</h3>
                    <div class="value" style="color: <?php echo ($total_penjualan - $total_biaya) > 0 ? 'var(--success)' : 'var(--danger)'; ?>">
                        Rp <?php echo number_format($total_penjualan - $total_biaya, 0, ',', '.'); ?>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Penjualan</th>
                            <th>Biaya Produksi</th>
                            <th>Margin</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produk_list as $p): ?>
                            <?php 
                                $margin = $p->penjualan - $p->biaya_produksi;
                                $is_profit = $margin > 0;
                            ?>
                            <tr>
                                <td><strong><?php echo $p->id_produk; ?></strong></td>
                                <td><?php echo htmlspecialchars($p->nama_produk); ?></td>
                                <td><strong>Rp <?php echo number_format($p->penjualan, 0, ',', '.'); ?></strong></td>
                                <td>Rp <?php echo number_format($p->biaya_produksi, 0, ',', '.'); ?></td>
                                <td style="color: <?php echo $is_profit ? 'var(--success)' : 'var(--danger)'; ?>; font-weight: 600;">
                                    Rp <?php echo number_format($margin, 0, ',', '.'); ?>
                                </td>
                                <td>
                                    <span class="profit-badge <?php echo $is_profit ? 'profit-positive' : 'profit-negative'; ?>">
                                        <?php echo $is_profit ? '✓ Untung' : '✗ Rugi'; ?>
                                    </span>
                                </td>
                                <td><?php echo date('d M Y', strtotime($p->created_at)); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="<?php echo site_url('analisis/view/' . $p->id_produk); ?>" class="btn btn-view btn-small">👁️ Lihat</a>
                                        <a href="<?php echo site_url('analisis/edit/' . $p->id_produk); ?>" class="btn btn-edit btn-small">✏️ Edit</a>
                                        <a href="<?php echo site_url('analisis/delete/' . $p->id_produk); ?>" class="btn btn-delete btn-small" onclick="return confirm('Yakin ingin menghapus produk ini?');">🗑️ Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty">
                <div class="empty-icon">📦</div>
                <p><strong>Belum ada data analisis produk</strong></p>
                <p>Mulai analisis produk pertama Anda untuk mengembangkan bisnis UMKM</p>
                <a href="<?php echo site_url('analisis/create'); ?>" class="btn">
                    ➕ Buat Analisis Pertama
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    
    <!-- Analisis Produk Script -->
    <script>
    // Konversi data PHP ke JavaScript
    const produkListData = <?php echo json_encode($produk_list); ?>;
    
    function renderProdukChart() {
        const chartElement = document.getElementById('produkChart');
        if (!chartElement || !produkListData || produkListData.length === 0) return;
        
        const ctx = chartElement.getContext('2d');
        
        // Ambil maksimal 8 produk untuk chart (untuk readability)
        const displayData = produkListData.slice(0, 8);
        
        // Siapkan data untuk chart
        const labels = displayData.map(p => p.nama_produk.substring(0, 15)); // Truncate nama panjang
        const penjualanData = displayData.map(p => parseFloat(p.penjualan));
        const biayaData = displayData.map(p => parseFloat(p.biaya_produksi));
        const profitData = displayData.map(p => parseFloat(p.penjualan) - parseFloat(p.biaya_produksi));
        
        // Warna untuk visualisasi
        const profitColors = profitData.map(profit => 
            profit >= 0 ? 'rgba(72,201,176,0.8)' : 'rgba(231,76,60,0.8)'
        );
        const profitBgColors = profitData.map(profit => 
            profit >= 0 ? 'rgba(72,201,176,0.2)' : 'rgba(231,76,60,0.2)'
        );
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Penjualan',
                        data: penjualanData,
                        backgroundColor: 'rgba(28,100,148,0.7)',
                        borderColor: '#1C6494',
                        borderWidth: 2,
                        borderRadius: 6,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Biaya Produksi',
                        data: biayaData,
                        backgroundColor: 'rgba(200,100,100,0.6)',
                        borderColor: '#c86464',
                        borderWidth: 2,
                        borderRadius: 6,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Profit',
                        data: profitData,
                        backgroundColor: profitColors,
                        borderColor: 'transparent',
                        borderWidth: 0,
                        type: 'line',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: false,
                        yAxisID: 'y1',
                        pointBackgroundColor: profitColors,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            padding: 15,
                            font: { size: 12, weight: '600' },
                            usePointStyle: true,
                            boxWidth: 8
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.85)',
                        padding: 12,
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 12 },
                        borderColor: '#1C6494',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': Rp ';
                                }
                                label += new Intl.NumberFormat('id-ID', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }).format(context.parsed.y);
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: { display: true, text: 'Penjualan & Biaya (Rp)', font: { size: 12 } },
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: { display: true, text: 'Profit (Rp)', font: { size: 12 } },
                        beginAtZero: true,
                        grid: { drawOnChartArea: false },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }).format(value);
                            }
                        }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    }
    
    // Render chart saat DOM siap
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', renderProdukChart);
    } else {
        renderProdukChart();
    }
    </script>
</body>
</html>