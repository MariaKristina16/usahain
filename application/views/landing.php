<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Usahain - Landing Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root{
      /* BRAND & NAVBAR */
      --brand-darkest: #1F2335;
      --brand-navy: #0F3246;
      --brand-blue: #1B5676;
      --brand-cyan: #2B8BB0;
      
      /* CTA & INTERACTIVE */
      --cta: #4EC1F2;
      --cta-dark: #2AA1D6;
      --cta-light: #81D4FA;
      
      /* HERO SECTION */
      --hero-text: #FFFFFF;
      --hero-text-sub: #D2E8F4;
      --hero-highlight: #4EC1F2;
      
      /* STAT CARDS */
      --stat-bg: rgba(255,255,255,0.06);
      --stat-border: rgba(255,255,255,0.14);
      --stat-number: #A8D8E8;
      --stat-label: #D8ECF4;
      
      /* NEUTRAL & SECONDARY */
      --text-primary: #000000;
      --text-active: #1B5676;
      --text-passive: #253043;
      --text-secondary: #666666;
      --text-tertiary: #999999;
      
      /* BACKGROUND */
      --bg-light: #F9FBFC;
      --bg-section-light: #E6F7FF;
      --bg-card: #FFFFFF;
      
      /* BORDER & SHADOW */
      --border-light: #E8E8E8;
      --shadow-sm: 0 4px 12px rgba(0,0,0,0.08);
      --shadow-md: 0 10px 24px rgba(0,0,0,0.12);
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    html, body { height: 100%; }
    body { 
      font-family: 'Inter', sans-serif; 
      background: var(--bg-light); 
      color: var(--text-secondary);
      line-height: 1.6;
    }
    
    /* Navbar */
    .navbar { background: white !important; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
    .nav-brand { font-weight: 700 !important; font-size: 20px !important; color: var(--text-primary) !important; }
    .nav-link { font-size: 14px; color: var(--text-passive) !important; font-weight: 500; }
    .nav-link:hover { color: var(--text-active) !important; }
    .btn-primary { 
      /* Button gradient: kiri = #1C6494, kanan = #1F2335 (user requested) */
      background: linear-gradient(90deg, #1C6494 0%, #1F2335 100%) !important; 
      border-color: transparent !important; 
      color: white !important; 
      font-weight: 600; 
      padding: 8px 18px; 
      border-radius: 8px; 
      transition: all 0.2s ease;
      box-shadow: 0 2px 6px rgba(28, 100, 148, 0.2);
    }
    .btn-primary:hover { 
      /* Slightly darker hover using same hue direction */
      background: linear-gradient(90deg, #144a63 0%, #0f1724 100%) !important; 
      border-color: transparent !important;
      box-shadow: 0 4px 12px rgba(15, 23, 36, 0.35);
    }
    
    /* Hero */
    .hero {
      /* Background gradient: kiri = #1F2335, kanan = #1C6494 (user requested)
         Note: angle 90deg goes left->right, so first color is left. */
      background: linear-gradient(90deg, #1F2335 0%, #1C6494 100%);
      color: white;
      padding: 80px 20px;
      text-align: center;
      position: relative;
    }
    .hero h1 { font-size: clamp(32px, 6vw, 48px); font-weight: 700; line-height: 1.2; margin-bottom: 16px; color: var(--hero-text); }
    .hero .lead { font-size: 16px; opacity: 0.95; margin-bottom: 24px; max-width: 600px; margin-left: auto; margin-right: auto; color: var(--hero-text-sub); }
    .hero .btn { padding: 12px 24px; font-weight: 600; border-radius: 8px; font-size: 14px; }
    .btn-info { background: var(--cta) !important; color: var(--brand-darkest) !important; border: none; font-weight: 600; transition: all 0.2s ease; }
    .btn-info:hover { background: var(--cta-dark) !important; color: white !important; }
    .btn-outline-light { border: 2px solid rgba(255,255,255,0.4) !important; color: white !important; transition: all 0.2s ease; }
    .btn-outline-light:hover { background: rgba(255,255,255,0.15) !important; border-color: rgba(255,255,255,0.6) !important; }
    
    /* Stat Box */
    .stat-box { 
      background: var(--stat-bg); 
      border: 1px solid var(--stat-border);
      border-radius: 12px; 
      padding: 32px 24px; 
      box-shadow: 0 8px 24px rgba(0,0,0,0.12);
      backdrop-filter: blur(4px);
    }
    .stat-box h3 { font-size: 32px; font-weight: 700; margin: 0; color: var(--stat-number); }
    .stat-box div { font-size: 13px; margin-top: 6px; font-weight: 500; color: var(--stat-label); }
    
    /* Features Section */
    #features, .py-5 { padding: 64px 20px !important; }
    #features h3, .py-5 > .container > h3 { font-size: clamp(24px, 5vw, 32px); font-weight: 700; color: var(--text-active); margin-bottom: 10px; letter-spacing: -0.3px; }
    #features .text-muted, .py-5 .text-muted { font-size: 14px; color: var(--text-tertiary) !important; margin-bottom: 40px !important; font-weight: 500; }
    
    /* Feature Card */
    .feature-card { 
      border-radius: 14px; 
      padding: 24px; 
      background: var(--bg-card); 
      box-shadow: var(--shadow-sm); 
      border: 1px solid var(--border-light);
      height: 100%;
      transition: all 0.25s ease;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
    }
    .feature-card:hover {
      box-shadow: var(--shadow-md);
      transform: translateY(-4px);
    }
    /* Feature Card Header: ikon + judul horizontal */
    .feature-card-header {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 12px;
    }
    .feature-card-icon {
      width: 40px;
      height: 40px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(180deg, #e8f6fb, #d4f0f9);
      box-shadow: var(--shadow-sm);
      flex: 0 0 40px;
    }
    .feature-card-icon svg { width: 24px; height: 24px; }
    .feature-card-title {
      font-size: 16px;
      font-weight: 700;
      color: var(--text-active);
      margin: 0;
      letter-spacing: -0.2px;
    }
    /* Feature Card Body */
    .feature-card-desc {
      font-size: 13px;
      color: var(--text-secondary);
      margin: 8px 0 12px 0;
      line-height: 1.6;
    }
    .feature-card-link {
      text-decoration: none;
      color: #1C6494;
      font-weight: 600;
      font-size: 13px;
      transition: color 0.2s ease;
    }
    .feature-card-link:hover { color: var(--cta); }
    .feature-row { 
      display: flex; 
      flex-direction: column;
      gap: 16px; 
      align-items: center;
      text-align: center;
    }
    /* Horizontal layout for feature cards (icon left, text right) */
    .feature-row--horizontal {
      flex-direction: row;
      align-items: center;
      text-align: left;
    }
    .feature-row--horizontal .feature-icon-sm {
      width: 64px;
      height: 64px;
      border-radius: 12px;
      flex: 0 0 64px;
    }
    .feature-row--horizontal .feature-body { text-align: left; margin-left: 16px; }
    .feature-row--horizontal .feature-body h5 { text-align: left; }
    .feature-row--horizontal .feature-body p { text-align: left; }
    @media (max-width: 768px) {
      .feature-row--horizontal { flex-direction: column; align-items: flex-start; }
      .feature-row--horizontal .feature-body { margin-left: 0; margin-top: 12px; text-align: left; }
      .feature-row--horizontal .feature-icon-sm { margin-bottom: 0; }
    }
    .feature-icon-sm {
      width: 80px;
      height: 80px;
      border-radius: 14px;
      background: linear-gradient(180deg, #e8f6fb, #d4f0f9);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--text-active);
      flex: 0 0 80px;
      box-shadow: var(--shadow-sm);
    }
    .feature-body { flex: 1; text-align: center; width: 100%; }
    .feature-body h5 { font-size: 16px; color: var(--text-active); font-weight: 700; margin-bottom: 10px; letter-spacing: -0.2px; }
    .feature-body p { font-size: 13px; color: var(--text-secondary); margin-bottom: 14px; line-height: 1.6; }
    /* Feature action links: use brand cyan/blue (#1C6494) to match tambahan features */
    .feature-body a { text-decoration: none; color: #1C6494; font-weight: 600; font-size: 13px; transition: color 0.2s ease; }
    .feature-body a:hover { color: var(--cta); }
    /* Override Bootstrap .text-primary inside feature cards to ensure consistent brand color */
    .feature-card .feature-body a.text-primary,
    .feature-body a.text-primary { color: #1C6494 !important; }
    
    /* Promo Section */
    .promo-section { background: var(--cta); padding: 64px 20px; }
    .promo-section h3 { font-size: 28px; font-weight: 700; color: white; margin-bottom: 8px; }
    .promo-section > .container > p { color: rgba(255,255,255,0.95); font-size: 15px; margin-bottom: 32px; }
    .promo-box { 
      background: var(--bg-card); 
      border-radius: 16px; 
      padding: 48px 36px; 
      box-shadow: 0 12px 40px rgba(0,0,0,0.15); 
      max-width: 700px; 
      margin: 32px auto 0;
    }
    .badge { padding: 8px 16px !important; font-size: 12px !important; font-weight: 700 !important; text-transform: uppercase !important; letter-spacing: 0.5px; }
    .badge.bg-warning { background: var(--brand-darkest) !important; color: white !important; }
    .promo-box h4 { font-size: 22px; font-weight: 700; color: var(--text-active); margin: 16px 0 20px; }
    .promo-box p { font-size: 14px; color: var(--text-secondary); }
    .promo-box .fs-3 { font-size: 32px !important; font-weight: 800 !important; color: var(--text-active) !important; }
    .promo-box ul { list-style: none; padding-left: 0; font-size: 14px; color: var(--text-secondary); line-height: 1.8; }
    .promo-box ul li { padding-left: 20px; position: relative; }

    /* Promo CTA (oval gradient) */
    .promo-cta {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      background: linear-gradient(90deg, #65C1DF 0%, #1C6494 100%) !important;
      color: #ffffff !important;
      padding: 10px 28px !important;
      border-radius: 28px !important;
      font-weight: 600 !important;
      font-size: 15px !important;
      line-height: 1.1 !important;
      border: none !important;
      box-shadow: 0 6px 18px rgba(28,100,148,0.14);
      transition: transform 0.16s ease, box-shadow 0.16s ease;
      text-decoration: none !important;
      margin: 0 auto !important;
    }
    .promo-cta svg { width: 16px; height: 16px; display: block; flex: 0 0 16px; }
    .promo-cta:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(28,100,148,0.18);
    }
    .promo-box ul li:before { content: "✓"; position: absolute; left: 0; color: var(--cta-light); font-weight: bold; }
    
    /* Why Section */
    .why-section { background: var(--bg-section-light); padding: 64px 20px; }
    .why-section h3 { font-size: clamp(24px, 5vw, 32px); font-weight: 700; color: var(--text-active); margin-bottom: 12px; }
    .why-section > .container > p { font-size: 15px; color: var(--text-secondary); margin-bottom: 44px; font-weight: 500; }
    .why-box { 
      text-align: center; 
      padding: 32px 24px; 
      transition: all 0.25s ease;
    }
    .why-box:hover {
      transform: translateY(-2px);
    }
    .why-icon {
      width: 110px;
      height: 110px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      box-shadow: var(--shadow-sm);
    }
    .why-icon svg { width: 48px; height: 48px; }
    .why-box h6 { font-size: 17px; color: var(--text-active); font-weight: 700; margin-bottom: 8px; letter-spacing: -0.2px; }
    .why-box p { font-size: 14px; color: var(--text-secondary); line-height: 1.6; }
    
    /* Footer */
    .site-footer { padding: 20px; text-align: center; color: var(--text-tertiary); font-size: 14px; background: var(--bg-card); }
    
    @media (max-width: 768px) {
      .hero { padding: 48px 16px; }
      .hero h1 { font-size: 28px; }
      .feature-card { padding: 24px 16px; }
      .feature-icon-sm { width: 64px; height: 64px; }
      .promo-box { padding: 32px 20px; }
      .why-icon { width: 100px; height: 100px; }
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
    <div class="container">
      <a class="navbar-brand nav-brand" href="<?= site_url(); ?>">Usahain</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExample07">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
          <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
          <li class="nav-item"><a class="nav-link" href="#why">Tentang</a></li>
          <li class="nav-item"><a class="btn btn-primary ms-3" href="<?= site_url('auth/login'); ?>">Masuk</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1 class="fw-bold display-5">Mulai Usaha Jadi <span style="color:var(--hero-highlight);">Mudah</span></h1>
      <p class="mt-3 lead">Platform terpadu untuk memulai, mengelola, dan mengembangkan UMKM anda</p>
      <div class="mt-4">
        <a href="<?= site_url('auth/register'); ?>" class="btn btn-info text-white me-2">⚡ Mulai Sekarang</a>
        <a href="#features" class="btn btn-outline-light">Pelajari Lebih Lanjut</a>
      </div>

      <div class="container mt-5">
        <div class="row text-center text-white g-3">
          <div class="col-md-4">
            <div class="stat-box">
              <h3 class="mb-0">10K</h3>
              <div>UMKM Terdaftar</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-box">
              <h3 class="mb-0">95%</h3>
              <div>Tingkat Kepuasan</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-box">
              <h3 class="mb-0">24/7</h3>
              <div>Support Tersedia</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Fitur Unggulan -->
  <section id="features" class="py-5">
    <div class="container text-center">
      <h3 class="fw-bold">Fitur Unggulan</h3>
      <p class="text-muted mb-5">Semua yang Anda butuhkan untuk sukses berbisnis</p>

      <div class="row g-4 gx-5">
        <div class="col-md-4">
          <div class="feature-card">
            <div class="feature-card-header">
              <div class="feature-card-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                  <rect x="4" y="4" width="16" height="16" rx="3" fill="#1B5676"/>
                  <circle cx="12" cy="10" r="2.5" fill="#FFFFFF"/>
                  <rect x="8" y="9" width="2" height="3" rx="0.5" fill="#083A56"/>
                  <rect x="14" y="9" width="2" height="3" rx="0.5" fill="#083A56"/>
                  <rect x="10" y="14" width="4" height="1.5" rx="0.5" fill="#E8F6FB"/>
                </svg>
              </div>
              <h3 class="feature-card-title">AI Advisor</h3>
            </div>
            <p class="feature-card-desc">Dapatkan rekomendasi ide usaha berdasarkan modal, minat, dan lokasi Anda</p>
            <a href="<?= site_url('advisor'); ?>" class="feature-card-link">Coba Sekarang →</a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="feature-card">
            <div class="feature-card-header">
              <div class="feature-card-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="3" fill="#8e44ad" opacity="0.2"/><g fill="none" stroke="#6B3BA0" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 6v12"/><path d="M12 6v12"/><path d="M17 6v12"/></g><rect x="4" y="4" width="16" height="4" rx="1" fill="#6B3BA0" opacity="0.15"/></svg>
              </div>
              <h3 class="feature-card-title">Kalkulator HPP</h3>
            </div>
            <p class="feature-card-desc">Hitung harga pokok produksi dan tentukan harga jual yang menguntungkan</p>
            <a href="<?= site_url('hpp'); ?>" class="feature-card-link">Hitung HPP →</a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="feature-card">
            <div class="feature-card-header">
              <div class="feature-card-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="3" fill="#00acc1" opacity="0.15"/><g fill="#00838F"><rect x="6" y="12" width="2" height="7" rx="0.5"/><rect x="10" y="10" width="2" height="9" rx="0.5"/><rect x="14" y="8" width="2" height="11" rx="0.5"/></g></svg>
              </div>
              <h3 class="feature-card-title">Analisis Produk</h3>
            </div>
            <p class="feature-card-desc">Ketahui produk mana yang menguntungkan dan merugikan</p>
            <a href="<?= site_url('analisis'); ?>" class="feature-card-link">Analisis →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Fitur Tambahan -->
  <section class="py-5" style="padding: 40px 20px !important;">
    <div class="container text-center">
      <div class="row g-4 gx-5">
        <div class="col-md-4">
          <div class="feature-card">
            <div class="feature-card-header">
              <div class="feature-card-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="3" fill="#f44336" opacity="0.12"/><path d="M12 8c2.2 0 4 1.8 4 4s-1.8 4-4 4-4-1.8-4-4 1.8-4 4-4z" fill="#D32F2F" opacity="0.8"/><path d="M8 16c0 1.7 2.2 3 4 3s4-1.3 4-3" fill="#F44336" opacity="0.2"/></svg>
              </div>
              <h3 class="feature-card-title">Pencatatan Keuangan</h3>
            </div>
            <p class="feature-card-desc">Catat pemasukan & pengeluaran</p>
            <a href="<?= site_url('keuangan'); ?>" class="feature-card-link">Mulai Catat →</a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="feature-card">
            <div class="feature-card-header">
              <div class="feature-card-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="3" fill="#00BCD4" opacity="0.12"/><path d="M12 6l4 2v3c0 2.8-2.2 5-4 5s-4-2.2-4-5V8l4-2z" fill="#0097A7"/></svg>
              </div>
              <h3 class="feature-card-title">Manajemen Risiko</h3>
            </div>
            <p class="feature-card-desc">Kelola risiko bisnis secara mudah</p>
            <a href="<?= site_url('risiko'); ?>" class="feature-card-link">Kelola Risiko →</a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="feature-card">
            <div class="feature-card-header">
              <div class="feature-card-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="3" fill="#8BC34A" opacity="0.12"/><g fill="#558B2F"><path d="M6 8h12v2H6z"/><path d="M6 12h12v2H6z"/><path d="M6 16h12v2H6z"/></g></svg>
              </div>
              <h3 class="feature-card-title">Rekomendasi Informasi Bisnis</h3>
            </div>
            <p class="feature-card-desc">Pelajari legalitas usaha</p>
            <a href="#" class="feature-card-link">Belajar →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Promo Section -->
  <section class="promo-section">
    <div class="container text-center">
      <h3>🎉 Penawaran Spesial!</h3>
      <p>Dapatkan akses premium dengan harga terjangkau</p>

      <div class="promo-box">
        <span class="badge bg-warning mb-3">⚡ Promo Terbatas</span>

        <h4>Paket Premium Usahain</h4>
        <p><span style="text-decoration:line-through; color:#aaa">Rp 50.000</span> <span class="fs-3">Rp 18.000</span> /bulan</p>
        <p style="color:#0d3b66; font-weight: 700; margin-bottom: 24px;">Hemat 64% dari harga normal!</p>

        <div class="row text-start mt-4">
          <div class="col-md-6">
            <h6 class="fw-bold">✨ Fitur Premium:</h6>
            <ul>
              <li>AI Advisor tanpa batas</li>
              <li>Analisis kompetitor mendalam</li>
              <li>Laporan keuangan otomatis</li>
              <li>Konsultasi bisnis 1-on-1</li>
            </ul>
          </div>
          <div class="col-md-6">
            <h6 class="fw-bold">🎁 Bonus Eksklusif:</h6>
            <ul>
              <li>Template dokumen bisnis</li>
              <li>Akses grup komunitas UMKM</li>
              <li>Webinar bulanan gratis</li>
              <li>Support prioritas</li>
            </ul>
          </div>
        </div>

        <a href="#" class="promo-cta text-white mt-4" role="button" aria-label="Ambil Penawaran Sekarang">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" aria-hidden="true" focusable="false">
            <!-- Rocket body -->
            <g>
              <path d="M42 6c0 0-12 6-18 12S14 34 14 34s10 2 20-4 8-24 8-24z" fill="#FFFFFF"/>
              <path d="M42 6c0 0-12 6-18 12S14 34 14 34s10 2 20-4 8-24 8-24z" fill-opacity="0.06"/>
              <!-- Nose / cap -->
              <path d="M46 2c6 6 4 18-2 24l-6-6c6-6 8-18 8-18z" fill="#E64A3A"/>
              <!-- Fins -->
              <path d="M12 38c-6 6-6 10-6 10s8 0 14-6c-4-2-8-4-8-4z" fill="#E64A3A"/>
              <path d="M50 38c6 6 6 10 6 10s-8 0-14-6c4-2 8-4 8-4z" fill="#E64A3A"/>
              <!-- Window -->
              <circle cx="32" cy="24" r="7" fill="#4EA9FF"/>
              <circle cx="32" cy="24" r="3.5" fill="#FFFFFF" opacity="0.18"/>
            </g>
            <!-- Flame -->
            <g>
              <path d="M26 46c-2 4 2 10 6 12s8-2 10-6 2-8 0-10c-4 2-14 2-16 4z" fill="#FFCD33"/>
              <path d="M30 50c-1 2 1 4 3 5s5-1 6-3 1-3 0-4c-2 1-8 1-9 2z" fill="#FF6B35"/>
            </g>
          </svg>
          Ambil Penawaran Sekarang
        </a>
        <p class="mt-2" style="font-size:13px; color:#999;">Promo berakhir dalam 7 hari · Gratis trial 7 hari</p>
      </div>
    </div>
  </section>

  <!-- Mengapa Usahain -->
  <section id="why" class="why-section">
    <div class="container text-center">
      <h3 class="fw-bold mb-4">Mengapa Pilih Usahain?</h3>
      <p class="text-muted mb-5">Kami memahami tantangan UMKM Indonesia</p>

      <div class="row g-4">
        <div class="col-md-4 why-box">
          <div class="why-icon" style="background:#FEECE6;color:#F59E0B"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" aria-hidden="true"><circle cx="24" cy="24" r="22" fill="#F59E0B"/><path d="M18 25l6 6 12-12" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <h6 class="fw-bold">Mudah Dipahami</h6>
          <p>Interface intuitif & panduan step-by-step</p>
        </div>
        <div class="col-md-4 why-box">
          <div class="why-icon" style="background:#FFF7ED;color:#F59E0B"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" aria-hidden="true"><circle cx="24" cy="24" r="18" fill="#F59E0B" opacity="0.2"/><path d="M24 12v24M12 24h24" stroke="#F59E0B" stroke-width="3" stroke-linecap="round"/><circle cx="24" cy="24" r="4" fill="#F59E0B"/></svg></div>
          <h6 class="fw-bold">Otomatis!</h6>
          <p>Otomatisasi perhitungan & analisis</p>
        </div>
        <div class="col-md-4 why-box">
          <div class="why-icon" style="background:#E6F7FF;color:#0e4c6e"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" aria-hidden="true"><path d="M12 16c-2.2 0-4 1.8-4 4v12c0 2.2 1.8 4 4 4h24c2.2 0 4-1.8 4-4V20c0-2.2-1.8-4-4-4H12z" fill="#0e4c6e" opacity="0.1"/><path d="M18 24c0-2 2-4 6-4s6 2 6 4" stroke="#0e4c6e" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/><circle cx="18" cy="20" r="2" fill="#0e4c6e"/><circle cx="30" cy="20" r="2" fill="#0e4c6e"/></svg></div>
          <h6 class="fw-bold">Tim Support Siaga</h6>
          <p>Tim support siap membantu Anda</p>
        </div>
      </div>

      <p class="mt-4 text-muted">Copyright © Usahain</p>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
