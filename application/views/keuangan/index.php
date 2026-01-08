<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Keuangan - Usahain</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1F6B99;
            --primary-dark: #154A6F;
            --primary-light: #E8F4FB;
            --secondary: #7EC8E3;
            --success: #10B981;
            --danger: #EF4444;
            --text: #1E293B;
            --text-secondary: #64748B;
            --bg: #F8FAFC;
            --card: #FFFFFF;
            --border: #E2E8F0;
            --shadow: 0 4px 12px rgba(31,107,153,0.1);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', Arial, sans-serif; background: var(--bg); color: var(--text); }
        .container { max-width: 900px; margin: 32px auto; padding: 0 18px; }
        .card { background: var(--card); border-radius: 12px; box-shadow: var(--shadow); padding: 32px 28px; margin-bottom: 32px; }
        h2 { color: var(--primary-dark); font-size: 1.4rem; font-weight: 700; margin-bottom: 18px; }
        .summary-row { display: flex; gap: 18px; margin-bottom: 18px; }
        .summary-card { background: var(--primary-light); border-radius: 12px; padding: 18px 24px; flex: 1; text-align: center; box-shadow: 0 2px 8px rgba(31,107,153,0.08); border-left: 4px solid var(--primary); }
        .summary-card .label { color: var(--text-secondary); font-size: 1rem; margin-bottom: 4px; }
        .summary-card .value { font-size: 1.3rem; font-weight: 700; color: var(--primary-dark); }
        .form-row { display: flex; gap: 12px; margin-bottom: 18px; }
        .form-row input, .form-row select { flex: 1; padding: 12px 16px; border-radius: 8px; border: 1.5px solid var(--border); font-size: 1rem; background: #fff; color: var(--text); }
        .form-row input:focus, .form-row select:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(31,107,153,0.1); }
        .btn { padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 1rem; border: none; cursor: pointer; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: #fff; transition: all 0.3s; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(31,107,153,0.2); }
        table { width: 100%; border-collapse: collapse; margin-top: 18px; font-size: 1rem; }
        th, td { padding: 14px 10px; border-bottom: 1px solid var(--border); text-align: left; }
        th { background: var(--primary-light); color: var(--primary-dark); font-weight: 700; }
        .currency { text-align: right; font-weight: 600; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 6px; font-size: 0.85em; font-weight: 600; }
        .badge.success { background: #D1FAE5; color: #065F46; }
        .badge.danger { background: #FEE2E2; color: #991B1B; }
        @media (max-width: 900px) { .summary-row, .form-row { flex-direction: column; gap: 10px; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Pencatatan Keuangan</h2>
            <div class="summary-row">
                <div class="summary-card">
                    <div class="label">Saldo Akhir</div>
                    <div class="value" id="saldoAkhir">Rp 0</div>
                </div>
                <div class="summary-card">
                    <div class="label">Total Pemasukan</div>
                    <div class="value" id="totalMasuk">Rp 0</div>
                </div>
                <div class="summary-card">
                    <div class="label">Total Pengeluaran</div>
                    <div class="value" id="totalKeluar">Rp 0</div>
                </div>
            </div>
            <form id="formKeuangan" onsubmit="tambahTransaksi(event)">
                <div class="form-row">
                    <select id="jenisTransaksi" required>
                        <option value="masuk">Pemasukan</option>
                        <option value="keluar">Pengeluaran</option>
                    </select>
                    <input type="text" id="deskripsi" placeholder="Deskripsi" required>
                    <input type="text" id="jumlah" placeholder="Jumlah (Rp)" required oninput="formatRupiah(this)">
                    <button type="submit" class="btn">Tambah</button>
                </div>
            </form>
            <table id="tabelKeuangan">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Jenis</th>
                        <th class="currency">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data transaksi akan muncul di sini -->
                </tbody>
            </table>
        </div>
    </div>
    <script>
    let transaksi = [];
    function formatRupiah(input) {
        let value = input.value.replace(/[^0-9]/g, '');
        if (value) {
            value = parseInt(value).toLocaleString('id-ID');
        }
        input.value = value;
    }
    function tambahTransaksi(e) {
        e.preventDefault();
        const jenis = document.getElementById('jenisTransaksi').value;
        const deskripsi = document.getElementById('deskripsi').value;
        const jumlahRaw = document.getElementById('jumlah').value.replace(/[^0-9]/g, '');
        const jumlah = parseInt(jumlahRaw);
        if (!jumlah || isNaN(jumlah) || jumlah <= 0) {
            alert('Masukkan jumlah yang valid!');
            return;
        }
        const tanggal = new Date().toLocaleDateString('id-ID');
        transaksi.unshift({ tanggal, deskripsi, jenis, jumlah });
        updateTabel();
        document.getElementById('formKeuangan').reset();
    }
    function updateTabel() {
        const tbody = document.querySelector('#tabelKeuangan tbody');
        tbody.innerHTML = '';
        let totalMasuk = 0, totalKeluar = 0;
        transaksi.forEach(tx => {
            if (tx.jenis === 'masuk') totalMasuk += tx.jumlah;
            else totalKeluar += tx.jumlah;
            const badge = tx.jenis === 'masuk' ? '<span class="badge success">Masuk</span>' : '<span class="badge danger">Keluar</span>';
            tbody.innerHTML += `<tr>
                <td>${tx.tanggal}</td>
                <td>${tx.deskripsi}</td>
                <td>${badge}</td>
                <td class="currency">Rp ${tx.jumlah.toLocaleString('id-ID')}</td>
            </tr>`;
        });
        document.getElementById('totalMasuk').textContent = 'Rp ' + totalMasuk.toLocaleString('id-ID');
        document.getElementById('totalKeluar').textContent = 'Rp ' + totalKeluar.toLocaleString('id-ID');
        document.getElementById('saldoAkhir').textContent = 'Rp ' + (totalMasuk-totalKeluar).toLocaleString('id-ID');
    }
    </script>
</body>
</html>
