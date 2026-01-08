<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tentang Usahain - Platform UMKM Indonesia</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --brand-1: #1F6B99;
      --brand-2: #154A6F;
      --accent: #7EC8E3;
      --muted-bg: #f0f4f8;
      --blue-main: #1F6B99;
    }

    body { 
      font-family: 'Inter', sans-serif; 
      background: var(--muted-bg);
      overflow-x: hidden;
    }

    .container {
      max-width: 1200px !important;
    }

    /* NAVBAR */
    .navbar {
      background: #FFFFFF !important;
      box-shadow: 0 1px 4px rgba(0,0,0,0.08);
      padding: 14px 0;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 700;
      font-size: 1.35rem;
      color: #1F6B99 !important;
      transition: .3s;
    }

    .navbar-brand:hover {
      transform: scale(1.02);
    }

    .navbar-brand img {
      width: 40px;
      height: 40px;
      border-radius: 6px;
      object-fit: contain;
    }

    .nav-link {
      color: #64748B !important;
      font-weight: 500;
      font-size: 0.95rem;
      transition: all .3s;
      padding: 8px 16px !important;
      margin: 0 4px;
      border-radius: 8px;
    }

    .nav-link:hover {
      color: #1F6B99 !important;
      background: rgba(31, 107, 153, 0.05);
    }

    .btn-login {
      background: white !important;
      border: 1px solid #E2E8F0 !important;
      color: #64748B !important;
      padding: 9px 20px !important;
      border-radius: 8px !important;
      font-weight: 500;
      font-size: 0.95rem;
      transition: all .3s;
    }

    .btn-login:hover {
      background: #F8FAFC !important;
      border-color: #1F6B99 !important;
      color: #1F6B99 !important;
    }

    .btn-signup {
      background: linear-gradient(135deg, #1F6B99, #154A6F) !important;
      color: white !important;
      padding: 9px 20px !important;
      border-radius: 8px !important;
      font-weight: 600;
      font-size: 0.95rem;
      border: none !important;
      transition: all .3s;
      box-shadow: 0 4px 12px rgba(31, 107, 153, 0.25);
    }

    .btn-signup:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(31, 107, 153, 0.35);
    }

    /* HERO SECTION */
    .hero-about {
      background: linear-gradient(135deg, rgba(31, 107, 153, 0.05) 0%, rgba(126, 200, 227, 0.05) 100%);
      padding: 80px 0 60px;
      text-align: center;
    }

    .hero-about h1 {
      font-size: 3.5rem;
      font-weight: 800;
      color: #1e293b;
      margin-bottom: 20px;
      line-height: 1.2;
    }

    .hero-about .highlight {
      color: #1F6B99;
      background: linear-gradient(120deg, #1F6B99, #7EC8E3);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero-about p {
      font-size: 1.2rem;
      color: #64748b;
      margin-bottom: 0;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }

    /* MISSION & VISION */
    .mission-vision {
      padding: 80px 0;
    }

    .mission-vision-card {
      background: white;
      border-radius: 20px;
      padding: 50px 40px;
      text-align: center;
      box-shadow: 0 4px 20px rgba(31, 107, 153, 0.08);
      transition: all 0.3s;
      height: 100%;
    }

    .mission-vision-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 40px rgba(31, 107, 153, 0.15);
    }

    .mission-vision-card .icon {
      font-size: 3.5rem;
      margin-bottom: 20px;
    }

    .mission-vision-card h3 {
      font-size: 1.8rem;
      font-weight: 700;
      color: #1F6B99;
      margin-bottom: 16px;
    }

    .mission-vision-card p {
      color: #64748b;
      font-size: 1rem;
      line-height: 1.7;
    }

    /* VALUES SECTION */
    .values-section {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      padding: 80px 0;
    }

    .values-section h2 {
      font-size: 2.5rem;
      font-weight: 800;
      color: #1e293b;
      text-align: center;
      margin-bottom: 60px;
    }

    .value-card {
      background: white;
      border-radius: 16px;
      padding: 32px 28px;
      text-align: center;
      box-shadow: 0 2px 12px rgba(0,0,0,0.08);
      transition: all 0.3s;
    }

    .value-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 8px 24px rgba(31, 107, 153, 0.12);
    }

    .value-card .value-icon {
      width: 80px;
      height: 80px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 2rem;
      background: linear-gradient(135deg, #E8F4FB, #D4E6F1);
    }

    .value-card h5 {
      font-size: 1.2rem;
      font-weight: 700;
      color: #1F6B99;
      margin-bottom: 12px;
    }

    .value-card p {
      color: #64748b;
      font-size: 0.95rem;
      line-height: 1.6;
      margin: 0;
    }

    /* TEAM SECTION */
    .team-section {
      padding: 80px 0;
    }

    .team-section h2 {
      font-size: 2.5rem;
      font-weight: 800;
      color: #1e293b;
      text-align: center;
      margin-bottom: 60px;
    }

    .team-member {
      text-align: center;
    }

    .team-member-avatar {
      width: 120px;
      height: 120px;
      border-radius: 16px;
      background: linear-gradient(135deg, #1F6B99, #7EC8E3);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 2.5rem;
      color: white;
    }

    .team-member h5 {
      font-size: 1.1rem;
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 4px;
    }

    .team-member .role {
      color: #1F6B99;
      font-size: 0.9rem;
      font-weight: 600;
      margin-bottom: 8px;
    }

    .team-member p {
      color: #64748b;
      font-size: 0.9rem;
      line-height: 1.6;
    }

    /* TIMELINE */
    .timeline-section {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      padding: 80px 0;
    }

    .timeline-section h2 {
      font-size: 2.5rem;
      font-weight: 800;
      color: #1e293b;
      text-align: center;
      margin-bottom: 60px;
    }

    .timeline {
      position: relative;
      padding: 20px 0;
    }

    .timeline::before {
      content: '';
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      width: 4px;
      height: 100%;
      background: linear-gradient(to bottom, #1F6B99, #7EC8E3);
    }

    .timeline-item {
      margin-bottom: 50px;
      position: relative;
    }

    .timeline-item:nth-child(odd) .timeline-content {
      margin-left: 0;
      margin-right: 52%;
      text-align: right;
    }

    .timeline-item:nth-child(even) .timeline-content {
      margin-left: 52%;
      margin-right: 0;
      text-align: left;
    }

    .timeline-item::before {
      content: '';
      position: absolute;
      left: 50%;
      top: 20px;
      transform: translateX(-50%);
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: white;
      border: 4px solid #1F6B99;
      z-index: 10;
    }

    .timeline-content {
      background: white;
      padding: 24px;
      border-radius: 12px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    .timeline-content .year {
      font-size: 1.4rem;
      font-weight: 800;
      color: #1F6B99;
      margin-bottom: 8px;
    }

    .timeline-content p {
      color: #64748b;
      margin: 0;
      font-size: 0.95rem;
    }

    /* CTA SECTION */
    .cta-section {
      background: linear-gradient(135deg, #1F6B99 0%, #154A6F 100%);
      padding: 80px 0;
      text-align: center;
      color: white;
    }

    .cta-section h2 {
      font-size: 2.5rem;
      font-weight: 800;
      margin-bottom: 20px;
    }

    .cta-section p {
      font-size: 1.1rem;
      margin-bottom: 40px;
      opacity: 0.95;
    }

    .btn-cta {
      background: white;
      color: #1F6B99;
      padding: 14px 40px;
      border-radius: 12px;
      font-weight: 700;
      font-size: 1rem;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s;
      border: none;
      cursor: pointer;
    }

    .btn-cta:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      color: #1F6B99;
    }

    /* FOOTER */
    footer {
      background: #1e293b;
      color: white;
      padding: 60px 0 0;
    }

    footer a {
      color: #94a3b8;
      text-decoration: none;
      font-size: 0.95rem;
      transition: color 0.3s;
    }

    footer a:hover {
      color: #1F6B99;
    }

    @media (max-width: 768px) {
      .hero-about h1 {
        font-size: 2rem;
      }

      .timeline::before {
        left: 20px;
      }

      .timeline-item::before {
        left: 20px;
      }

      .timeline-item:nth-child(odd) .timeline-content,
      .timeline-item:nth-child(even) .timeline-content {
        margin-left: 60px;
        margin-right: 0;
        text-align: left;
      }
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="<?= site_url(); ?>">
      <img src="<?= base_url('assets/logo.png'); ?>" alt="Usahain" class="navbar-logo">
      Usahain
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link" href="<?= site_url(); ?>#features">Fitur</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= site_url(); ?>#how-it-works">Cara Kerja</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= site_url(); ?>#faq">Harga</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= site_url('about'); ?>">Tentang</a></li>
      </ul>

      <div class="d-flex align-items-center gap-2">
        <a class="btn btn-login" href="<?= site_url('auth/login'); ?>">Login</a>
        <a class="btn btn-signup" href="<?= site_url('auth/register'); ?>">Sign Up</a>
      </div>
    </div>
  </div>
</nav>

<!-- HERO SECTION -->
<section class="hero-about">
  <div class="container">
    <h1>Tentang <span class="highlight">Usahain</span></h1>
    <p>Kami adalah platform terpadu yang didedikasikan untuk memberdayakan UMKM Indonesia agar berkembang pesat dengan tools yang mudah digunakan dan support penuh.</p>
  </div>
</section>

<!-- MISSION & VISION -->
<section class="mission-vision">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="mission-vision-card">
          <div class="icon">🎯</div>
          <h3>Misi Kami</h3>
          <p>Memberdayakan setiap pelaku UMKM Indonesia dengan menyediakan platform teknologi yang mudah digunakan, terjangkau, dan komprehensif untuk mengelola bisnis mereka dengan lebih efisien.</p>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="mission-vision-card">
          <div class="icon">🌟</div>
          <h3>Visi Kami</h3>
          <p>Menjadi platform nomor satu pilihan UMKM Indonesia yang membantu jutaan pengusaha untuk memulai, mengelola, dan mengembangkan bisnis mereka menuju kesuksesan yang berkelanjutan.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- VALUES SECTION -->
<section class="values-section">
  <div class="container">
    <h2>Nilai-Nilai Kami</h2>
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="value-card">
          <div class="value-icon">💡</div>
          <h5>Inovasi</h5>
          <p>Terus berinovasi untuk memberikan solusi terbaik dan terdepan dalam industri.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="value-card">
          <div class="value-icon">🤝</div>
          <h5>Kolaborasi</h5>
          <p>Bekerja sama dengan komunitas dan mitra untuk membangun ekosistem yang kuat.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="value-card">
          <div class="value-icon">🎯</div>
          <h5>Fokus</h5>
          <p>Tetap fokus pada kebutuhan pengguna dan terus meningkatkan kualitas layanan.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="value-card">
          <div class="value-icon">💪</div>
          <h5>Pemberdayaan</h5>
          <p>Memberdayakan UMKM untuk mencapai potensi penuh mereka dalam bisnis.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TIMELINE SECTION -->
<section class="timeline-section">
  <div class="container">
    <h2>Perjalanan Usahain</h2>
    <div class="timeline">
      <div class="timeline-item">
        <div class="timeline-content">
          <div class="year">2024</div>
          <p>Usahain diluncurkan sebagai solusi inovatif untuk UMKM Indonesia</p>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-content">
          <div class="year">Q2 2024</div>
          <p>Mencapai 1000+ pengguna aktif dan ekspansi fitur AI Advisor</p>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-content">
          <div class="year">Q3 2024</div>
          <p>Peluncuran fitur Manajemen Risiko dan integrasi pembayaran Midtrans</p>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-content">
          <div class="year">Q4 2024</div>
          <p>Mencapai 10000+ pengguna dan peluncuran subscription plan</p>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-content">
          <div class="year">2025+</div>
          <p>Komitmen untuk terus berinovasi dan mengembangkan ekosistem UMKM</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA SECTION -->
<section class="cta-section">
  <div class="container">
    <h2>Siap Bergabung?</h2>
    <p>Mulai perjalanan kesuksesan bisnis Anda bersama Usahain hari ini</p>
    <a href="<?= site_url('auth/register'); ?>" class="btn-cta">Daftar Sekarang</a>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 mb-4">
        <div style="margin-bottom: 24px;">
          <h3 style="font-size: 1.8rem; font-weight: 800; color: white; display: flex; align-items: center; gap: 10px;">
            <img src="<?= base_url('assets/logo.png'); ?>" alt="Usahain" style="width: 36px; height: 36px; border-radius: 6px; object-fit: contain;">
            Usahain
          </h3>
        </div>
        <p style="color: #94a3b8; font-size: 0.95rem; line-height: 1.7;">
          Platform terpadu untuk memulai, mengelola, dan mengembangkan UMKM Indonesia dengan fitur lengkap dan mudah digunakan.
        </p>
      </div>

      <div class="col-lg-2 col-md-6 col-6 mb-4">
        <h6 style="font-size: 1rem; font-weight: 700; color: white; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px;">Produk</h6>
        <ul style="list-style: none; padding: 0; margin: 0;">
          <li style="margin-bottom: 12px;"><a href="<?= site_url(); ?>#features">Fitur</a></li>
          <li style="margin-bottom: 12px;"><a href="<?= site_url(); ?>#faq">Harga</a></li>
          <li style="margin-bottom: 12px;"><a href="<?= site_url('auth/register'); ?>">Daftar</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-6 col-6 mb-4">
        <h6 style="font-size: 1rem; font-weight: 700; color: white; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px;">Perusahaan</h6>
        <ul style="list-style: none; padding: 0; margin: 0;">
          <li style="margin-bottom: 12px;"><a href="<?= site_url('about'); ?>">Tentang Kami</a></li>
          <li style="margin-bottom: 12px;"><a href="">Blog</a></li>
          <li style="margin-bottom: 12px;"><a href="">Kontak</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-6 col-6 mb-4">
        <h6 style="font-size: 1rem; font-weight: 700; color: white; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px;">Legal</h6>
        <ul style="list-style: none; padding: 0; margin: 0;">
          <li style="margin-bottom: 12px;"><a href="">Syarat & Ketentuan</a></li>
          <li style="margin-bottom: 12px;"><a href="">Privasi</a></li>
          <li style="margin-bottom: 12px;"><a href="">Keamanan</a></li>
        </ul>
      </div>
    </div>

    <div style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 40px; padding: 24px 0;">
      <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
          <p style="color: #64748b; margin: 0; font-size: 0.9rem;">© 2026 Usahain. All Rights Reserved.</p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <p style="color: #64748b; margin: 0; font-size: 0.9rem;">Made with ❤️ for UMKM Indonesia</p>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
