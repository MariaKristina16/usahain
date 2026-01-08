<?php
$user = array_merge([
    'nama'  => 'User',
    'email' => '-',
    'role'  => '-',
    'usaha' => 'Bisnis Anda',
    'type'  => 'UMKM'
], (array)($user ?? []));
?>

<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=5,user-scalable=yes">
<meta name="theme-color" content="#1F6B99">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<title>Informasi Bisnis - Usahain</title>

<style>
/* === THEME COLOR VARIABLES === */
:root {
    --primary-color: #1F6B99;
    --primary-dark: #154A6F;
    --primary-light: #3A88BA;
    --secondary-color: #7EC8E3;
    --secondary-light: #A5D8E8;
    --accent-color: #00D4FF;
    --accent-dark: #48C9B0;
    --success: #10B981;
    --success-light: #6EE7B7;
    --warning: #F59E0B;
    --warning-light: #FBBF24;
    --danger: #EF4444;
    --danger-light: #FCA5A5;
    --background: #F8FAFC;
    --card-bg: #FFFFFF;
    --text-primary: #1E293B;
    --text-secondary: #64748B;
    --text-muted: #94A3B8;
    --border-color: #E2E8F0;
    --shadow-xs: 0 1px 2px rgba(0,0,0,0.05);
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06);
    --shadow-md: 0 4px 6px rgba(0,0,0,0.1), 0 2px 4px rgba(0,0,0,0.06);
    --shadow-lg: 0 10px 15px rgba(0,0,0,0.1), 0 4px 6px rgba(0,0,0,0.05);
    --shadow-xl: 0 20px 25px rgba(0,0,0,0.1), 0 10px 10px rgba(0,0,0,0.04);
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Inter, Segoe UI, Arial;
    background: var(--background);
    color: var(--text-primary);
    line-height: 1.6;
}

/* === NAVBAR === */
.navbar-main {
    background: #fff;
    border-bottom: 1px solid #e5e7eb;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95);
}

.navbar-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 70px;
    gap: 40px;
}

.navbar-left {
    display: flex;
    align-items: center;
    flex-shrink: 0;
}

.navbar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    transition: all 0.3s;
}

.navbar-brand:hover {
    opacity: 0.8;
}

.navbar-logo {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.navbar-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.navbar-title {
    font-size: 22px;
    font-weight: 800;
    color: #1F6B99;
    letter-spacing: -0.5px;
}

.navbar-center {
    display: flex;
    gap: 32px;
    align-items: center;
    flex: 1;
    justify-content: center;
}

.navbar-link {
    color: #4b5563;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s;
    position: relative;
    padding: 6px 0;
}

.navbar-link:hover {
    color: #1F6B99;
}

.navbar-link.active {
    color: #1F6B99;
    font-weight: 800;
}

.navbar-link.active::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #1F6B99, #7EC8E3);
    border-radius: 2px;
}

.navbar-right {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-shrink: 0;
}

.navbar-btn {
    padding: 10px 22px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.navbar-btn.btn-secondary {
    background: linear-gradient(135deg, #f0f4f8 0%, #e8eef5 100%);
    color: #374151;
    font-weight: 600;
}

.navbar-btn.btn-secondary:hover {
    background: linear-gradient(135deg, #e8eef5 0%, #dfe5ed 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.navbar-btn.btn-logout {
    background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
    color: #fff;
    font-weight: 700;
}

.navbar-btn.btn-logout:hover {
    background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(239, 68, 68, 0.3);
}

.navbar-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1F6B99 0%, #7EC8E3 100%);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 16px;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(31, 107, 153, 0.2);
}

/* RESPONSIVE NAVBAR */
@media(max-width:1024px) {
    .navbar-container { gap: 24px; }
    .navbar-center { gap: 20px; }
    .navbar-link { font-size: 13px; }
}

@media(max-width:768px) {
    .navbar-container {
        height: auto;
        padding: 12px 16px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .navbar-center {
        gap: 16px;
        order: 3;
        width: 100%;
        justify-content: flex-start;
        flex: none;
    }
    .navbar-link { font-size: 12px; }
    .navbar-right { gap: 8px; }
    .navbar-btn { padding: 8px 14px; font-size: 12px; }
    .navbar-title { font-size: 18px; }
}

@media(max-width:576px) {
    .navbar-container { padding: 10px 12px; }
    .navbar-logo { font-size: 24px; }
    .navbar-title { font-size: 16px; }
    .navbar-center { gap: 12px; }
    .navbar-link { font-size: 11px; }
    .navbar-btn { padding: 6px 12px; font-size: 11px; }
    .navbar-avatar {
        width: 36px;
        height: 36px;
        font-size: 14px;
    }
}

/* === CONTAINER === */
.container {
    max-width: 1200px;
    margin: 32px auto;
    padding: 0 24px;
}

/* === BREADCRUMB === */
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 32px;
    font-size: 14px;
}

.breadcrumb a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.breadcrumb a:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

.breadcrumb span {
    color: var(--text-muted);
}

/* === PAGE HEADER === */
.page-header {
    margin-bottom: 48px;
    text-align: center;
}

.page-title {
    font-size: 36px;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 12px;
}

.page-subtitle {
    font-size: 16px;
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto;
}

/* === SECTION === */
.section {
    margin-bottom: 64px;
}

.section-header {
    margin-bottom: 36px;
    text-align: center;
}

.section-title {
    font-size: 28px;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -12px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    border-radius: 3px;
}

.section-desc {
    font-size: 15px;
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto;
}



/* === INFO CARDS GRID === */
.info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 48px;
}

.info-card {
    background: var(--card-bg);
    border-radius: 20px;
    padding: 32px 28px;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
    transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
}

.info-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    transform: scaleX(0);
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.info-card::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(31, 107, 153, 0.06) 0%, transparent 70%);
    transition: all 0.5s;
}

.info-card:hover::after {
    transform: translate(-20%, 20%);
}

.info-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 12px 28px rgba(31, 107, 153, 0.12);
    border-color: var(--primary-light);
}

.info-card:hover::before {
    transform: scaleX(1);
}

.info-card-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    margin-bottom: 20px;
    box-shadow: 0 4px 12px rgba(31, 107, 153, 0.15);
    position: relative;
    z-index: 2;
    transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.info-card:hover .info-card-icon {
    transform: scale(1.12) rotate(-3deg);
    box-shadow: 0 8px 16px rgba(31, 107, 153, 0.2);
}

.info-card-icon.icon-1 {
    background: linear-gradient(135deg, #3B82F6, #1F6B99);
    color: #fff;
}

.info-card-icon.icon-2 {
    background: linear-gradient(135deg, #8B5CF6, #7C3AED);
    color: #fff;
}

.info-card-icon.icon-3 {
    background: linear-gradient(135deg, #EC4899, #DB2777);
    color: #fff;
}

.info-card-icon.icon-4 {
    background: linear-gradient(135deg, #F59E0B, #D97706);
    color: #fff;
}

.info-card-icon.icon-5 {
    background: linear-gradient(135deg, #06B6D4, #0891B2);
    color: #fff;
}

.info-card-icon.icon-6 {
    background: linear-gradient(135deg, #10B981, #059669);
    color: #fff;
}

.info-card-title {
    font-size: 20px;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 12px;
    position: relative;
    z-index: 2;
}

.info-card-desc {
    font-size: 14px;
    color: var(--text-secondary);
    line-height: 1.7;
    margin-bottom: 20px;
    position: relative;
    z-index: 2;
    flex: 1;
}

.info-card-points {
    list-style: none;
    margin-bottom: 20px;
    position: relative;
    z-index: 2;
}

.info-card-points li {
    font-size: 13px;
    color: var(--text-secondary);
    padding: 6px 0;
    padding-left: 24px;
    position: relative;
}

.info-card-points li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: var(--success);
    font-weight: 800;
    font-size: 15px;
}

.info-card-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: #fff;
    padding: 12px 20px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 700;
    font-size: 14px;
    border: none;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative;
    z-index: 2;
}

.info-card-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(31, 107, 153, 0.3);
    background: linear-gradient(135deg, var(--primary-dark) 0%, #0f3a4f 100%);
}

.info-card-btn::after {
    content: '→';
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.info-card-btn:hover::after {
    transform: translateX(4px);
}

/* === TIPS GRID === */
.tips-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.tip-card {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 28px 24px;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
    transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.tip-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    transform: scaleX(0);
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.tip-card::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 150px;
    height: 150px;
    background: radial-gradient(circle, rgba(31, 107, 153, 0.06) 0%, transparent 70%);
    transition: all 0.5s;
}

.tip-card:hover::after {
    transform: translate(-20%, 20%);
}

.tip-card:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 12px 28px rgba(31, 107, 153, 0.12);
    border-color: var(--primary-light);
}

.tip-card:hover::before {
    transform: scaleX(1);
}

.tip-icon {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    margin: 0 auto 20px;
    box-shadow: 0 4px 12px rgba(31, 107, 153, 0.15);
    position: relative;
    z-index: 2;
    background: linear-gradient(135deg, #F3F4F6, #E5E7EB);
}

.tip-title {
    font-size: 18px;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 12px;
    position: relative;
    z-index: 2;
}

.tip-desc {
    font-size: 13px;
    color: var(--text-secondary);
    line-height: 1.7;
    position: relative;
    z-index: 2;
}

/* === RESOURCE SECTION === */
.resource-section {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    border-radius: 20px;
    padding: 40px;
    color: #fff;
    box-shadow: 0 10px 28px rgba(31, 107, 153, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.15);
}

.resource-title {
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 28px;
    text-align: center;
}

.resource-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.resource-item {
    background: rgba(255, 255, 255, 0.12);
    border-radius: 14px;
    padding: 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    display: flex;
    align-items: flex-start;
    gap: 16px;
}

.resource-item:hover {
    background: rgba(255, 255, 255, 0.18);
    border-color: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.resource-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    background: rgba(255, 255, 255, 0.2);
    flex-shrink: 0;
}

.resource-content {
    flex: 1;
}

.resource-content h4 {
    font-size: 16px;
    font-weight: 800;
    margin-bottom: 6px;
}

.resource-content p {
    font-size: 13px;
    opacity: 0.95;
    line-height: 1.6;
}

/* === GUIDES SECTION === */
.guides-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    margin-bottom: 60px;
}

.guide-section {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 28px;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
    transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    animation: fadeIn 0.5s ease-out;
}

.guide-section:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(31, 107, 153, 0.12);
    border-color: var(--primary-light);
}

.guide-title {
    font-size: 18px;
    font-weight: 800;
    color: var(--primary-color);
    margin-bottom: 12px;
}

.guide-content {
    font-size: 14px;
    color: var(--text-secondary);
    margin-bottom: 16px;
    line-height: 1.6;
}

.guide-list {
    list-style: none;
    padding: 0;
}

.guide-list li {
    padding: 8px 0;
    padding-left: 24px;
    position: relative;
    font-size: 13px;
    color: var(--text-primary);
    line-height: 1.6;
}

.guide-list li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: var(--success);
    font-weight: 800;
    font-size: 14px;
}

/* === RESOURCES GRID === */
.resources-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 60px;
}

.resource-card {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: #fff;
    border-radius: 20px;
    padding: 32px 24px;
    text-align: center;
    transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    cursor: pointer;
    border: 1px solid rgba(255, 255, 255, 0.2);
    animation: fadeIn 0.5s ease-out;
}

.resource-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 28px rgba(31, 107, 153, 0.25);
    border-color: rgba(255, 255, 255, 0.3);
}

.resource-card.expanded {
    grid-column: 1 / -1;
}

.resource-card.expanded .resource-short {
    display: none;
}

.resource-card.expanded .resource-content {
    display: block;
}

.resource-icon {
    font-size: 48px;
    margin-bottom: 16px;
}

.resource-title {
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 12px;
}

.resource-desc {
    font-size: 13px;
    opacity: 0.95;
    line-height: 1.6;
    margin-bottom: 16px;
}

.resource-short {
    display: block;
}

.resource-content {
    display: none;
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    animation: slideDown 0.3s ease-out;
    text-align: left;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.resource-content ul {
    list-style: none;
    margin: 16px 0;
}

.resource-content li {
    padding: 10px 0;
    padding-left: 24px;
    position: relative;
}

.resource-content li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: #fff;
    font-weight: 800;
    font-size: 14px;
}

/* === FOOTER === */
.footer-simple {
    width: 100%;
    background: linear-gradient(180deg, #f8fafc 0%, #f0f6f9 100%);
    border-top: 1px solid #e6eef5;
    padding: 20px 0;
    font-size: 13px;
    color: #64748B;
}

.footer-inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    font-weight: 500;
}

.footer-left, .footer-right {
    display: flex;
    align-items: center;
    gap: 8px;
}

.footer-right a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.footer-right a:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

.brand {
    font-weight: 800;
    color: var(--primary-color);
}

/* === RESPONSIVE === */
@media(max-width: 991px) {
    .container {
        padding: 0 20px;
        margin: 24px auto;
    }

    .tools-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .info-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .tips-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .guides-grid {
        grid-template-columns: 1fr;
    }

    .resources-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .resource-list {
        grid-template-columns: 1fr;
    }

    .page-title {
        font-size: 28px;
    }

    .section-title {
        font-size: 24px;
    }

    .info-card {
        padding: 24px 20px;
    }

    .tip-card {
        padding: 20px 16px;
    }

    .resource-section {
        padding: 32px 24px;
    }
}

@media(max-width: 767px) {
    .container {
        padding: 0 16px;
        margin: 20px auto;
    }

    .tools-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .tips-grid {
        grid-template-columns: 1fr;
    }

    .guides-grid {
        grid-template-columns: 1fr;
    }

    .resources-grid {
        grid-template-columns: 1fr;
    }

    .resource-list {
        grid-template-columns: 1fr;
    }

    .page-header {
        margin-bottom: 32px;
    }

    .page-title {
        font-size: 24px;
        margin-bottom: 8px;
    }

    .page-subtitle {
        font-size: 14px;
    }

    .section {
        margin-bottom: 40px;
    }

    .section-header {
        margin-bottom: 24px;
    }

    .section-title {
        font-size: 20px;
        margin-bottom: 8px;
    }

    .section-desc {
        font-size: 13px;
    }

    .info-card {
        padding: 20px 16px;
    }

    .info-card-icon {
        width: 52px;
        height: 52px;
        font-size: 28px;
    }

    .info-card-title {
        font-size: 18px;
    }

    .info-card-desc {
        font-size: 13px;
    }

    .tip-card {
        padding: 16px 12px;
    }

    .tip-icon {
        width: 56px;
        height: 56px;
        font-size: 32px;
    }

    .tip-title {
        font-size: 16px;
    }

    .tip-desc {
        font-size: 12px;
    }

    .resource-section {
        padding: 24px 16px;
        border-radius: 16px;
    }

    .resource-title {
        font-size: 20px;
        margin-bottom: 20px;
    }

    .resource-item {
        padding: 16px;
        gap: 12px;
    }

    .resource-icon {
        width: 44px;
        height: 44px;
        font-size: 20px;
    }

    .resource-content h4 {
        font-size: 14px;
    }

    .resource-content p {
        font-size: 12px;
    }

    .breadcrumb {
        font-size: 12px;
        margin-bottom: 24px;
    }
}

@media(max-width: 575px) {
    .container {
        padding: 0 12px;
        margin: 16px auto;
    }

    .page-title {
        font-size: 20px;
    }

    .section-title {
        font-size: 18px;
    }

    .footer-inner {
        flex-direction: column;
        text-align: center;
    }

    .footer-left, .footer-right {
        width: 100%;
        justify-content: center;
    }

    .footer-right {
        flex-wrap: wrap;
    }

    .info-card {
        padding: 18px 14px;
    }

    .info-card-title {
        font-size: 16px;
    }

    .tip-card {
        padding: 14px 12px;
    }

    .tip-title {
        font-size: 14px;
    }
}

/* ANIMATIONS */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.info-card, .tip-card {
    animation: fadeIn 0.5s ease-out;
}
</style>
</head>

<body>
<!-- NAVBAR -->
<nav class="navbar-main">
    <div class="navbar-container">
        <div class="navbar-left">
            <a href="<?= site_url('auth/dashboard'); ?>" class="navbar-brand">
                <span class="navbar-logo"><img src="<?= base_url('assets/logo.png'); ?>" alt="Usahain"></span>
                <span class="navbar-title">Usahain</span>
            </a>
        </div>

        <div class="navbar-center">
            <a href="<?= site_url('auth/dashboard'); ?>" class="navbar-link">Dashboard</a>
            <a href="<?= site_url('auth/dashboard'); ?>" class="navbar-link">Fitur</a>
            <a href="<?= site_url('info'); ?>" class="navbar-link active">Informasi</a>
            <a href="<?= site_url('auth/dashboard'); ?>" class="navbar-link">Kontak</a>
        </div>

        <div class="navbar-right">
            <a href="<?= site_url('auth/change_dashboard'); ?>" class="navbar-btn btn-secondary">🔄 Perencanaan</a>
            <div class="navbar-avatar" title="<?= htmlspecialchars($user['nama']); ?>">
                <?= strtoupper(substr($user['nama'],0,1)); ?>
            </div>
            <a href="<?= site_url('auth/logout'); ?>" 
               class="navbar-btn btn-logout"
               onclick="return confirm('Yakin ingin logout?')">
               Logout
            </a>
        </div>
    </div>
</nav>

<div class="container">
    <!-- BREADCRUMB -->
    <div class="breadcrumb">
        <a href="<?= site_url('auth/dashboard'); ?>">Dashboard</a>
        <span>/</span>
        <span>Informasi Bisnis</span>
    </div>

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">📚 Informasi Bisnis</h1>
        <p class="page-subtitle">Pelajari panduan lengkap, tips, dan sumber daya untuk mengembangkan bisnis Anda dengan lebih baik</p>
    </div>

    <!-- SECTION 1: LEGALITAS & PERIZINAN -->
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">⚖️ Legalitas & Perizinan Usaha</h2>
            <p class="section-desc">Pahami dokumen dan izin yang diperlukan untuk menjalankan usaha secara legal dan aman</p>
        </div>

        <div class="info-grid">
            <!-- Card 1: NPWP -->
            <div class="info-card">
                <div class="info-card-icon icon-1">🏛️</div>
                <h3 class="info-card-title">NPWP (Nomor Pokok Wajib Pajak)</h3>
                <p class="info-card-desc">Identitas perpajakan yang wajib dimiliki setiap pengusaha untuk melaporkan kewajiban pajak.</p>
                <ul class="info-card-points">
                    <li>Dokumen resmi dari Direktorat Jenderal Pajak</li>
                    <li>Diperlukan untuk pengajuan kredit bank</li>
                    <li>Berlaku seumur hidup</li>
                    <li>Proses mudah dan gratis</li>
                </ul>
                <a href="https://www.pajak.go.id" target="_blank" class="info-card-btn">Pelajari Lebih</a>
            </div>

            <!-- Card 2: NIB -->
            <div class="info-card">
                <div class="info-card-icon icon-2">📋</div>
                <h3 class="info-card-title">NIB (Nomor Induk Berusaha)</h3>
                <p class="info-card-desc">Nomor identitas unik untuk setiap badan usaha yang terdaftar di Sistem Administrasi Badan Usaha.</p>
                <ul class="info-card-points">
                    <li>Diterbitkan melalui portal OSS</li>
                    <li>Gratis dan mudah didapatkan</li>
                    <li>Wajib untuk semua jenis usaha</li>
                    <li>Proses approval cepat (1-3 hari)</li>
                </ul>
                <a href="https://oss.go.id" target="_blank" class="info-card-btn">Pelajari Lebih</a>
            </div>

            <!-- Card 3: PIRT -->
            <div class="info-card">
                <div class="info-card-icon icon-3">🏭</div>
                <h3 class="info-card-title">PIRT (Perizinan Industri Rumah Tangga)</h3>
                <p class="info-card-desc">Izin khusus untuk usaha makanan/minuman yang diproduksi dari rumah dengan skala kecil.</p>
                <ul class="info-card-points">
                    <li>Khusus untuk produk makanan/minuman</li>
                    <li>Diterbitkan oleh Dinas Kesehatan</li>
                    <li>Berlaku 2 tahun dan dapat diperpanjang</li>
                    <li>Biaya terjangkau</li>
                </ul>
                <a href="https://www.kemkes.go.id" target="_blank" class="info-card-btn">Pelajari Lebih</a>
            </div>

            <!-- Card 4: SERTIFIKAT HALAL -->
            <div class="info-card">
                <div class="info-card-icon icon-4">✨</div>
                <h3 class="info-card-title">Sertifikat Halal</h3>
                <p class="info-card-desc">Sertifikat resmi yang membuktikan produk Anda telah lolos audit kehalalan sesuai syariat Islam.</p>
                <ul class="info-card-points">
                    <li>Dikeluarkan oleh Lembaga Halal</li>
                    <li>Meningkatkan kepercayaan konsumen</li>
                    <li>Wajib untuk produk tertentu</li>
                    <li>Proses verifikasi ketat dan komprehensif</li>
                </ul>
                <a href="https://www.halal.go.id" target="_blank" class="info-card-btn">Pelajari Lebih</a>
            </div>

            <!-- Card 5: MEREK DAGANG -->
            <div class="info-card">
                <div class="info-card-icon icon-5">🎯</div>
                <h3 class="info-card-title">Pendaftaran Merek Dagang</h3>
                <p class="info-card-desc">Perlindungan hukum atas nama dan logo usaha Anda dari peniruan dan penggunaan oleh pihak lain.</p>
                <ul class="info-card-points">
                    <li>Dilakukan melalui Direktorat Jenderal HKI</li>
                    <li>Perlindungan 10 tahun dan dapat diperpanjang</li>
                    <li>Memberikan keunikan dan eksklusivitas</li>
                    <li>Proses approval 1-2 tahun</li>
                </ul>
                <a href="https://www.dgip.go.id" target="_blank" class="info-card-btn">Pelajari Lebih</a>
            </div>

            <!-- Card 6: BPOM -->
            <div class="info-card">
                <div class="info-card-icon icon-6">🔬</div>
                <h3 class="info-card-title">Izin BPOM</h3>
                <p class="info-card-desc">Sertifikasi dari Badan Pengawas Obat dan Makanan untuk produk kesehatan dan makanan tertentu.</p>
                <ul class="info-card-points">
                    <li>Untuk produk farmasi dan makanan spesifik</li>
                    <li>Standar keamanan dan kualitas ketat</li>
                    <li>Berlaku 5 tahun</li>
                    <li>Meningkatkan kredibilitas produk</li>
                </ul>
                <a href="https://www.bpom.go.id" target="_blank" class="info-card-btn">Pelajari Lebih</a>
            </div>
        </div>
    </div>

    <!-- SECTION 2: TIPS SUKSES -->
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">⭐ Tips Sukses Membangun UMKM</h2>
            <p class="section-desc">Kumpulan tips praktis dari para ahli bisnis untuk membuat usaha Anda semakin berkembang</p>
        </div>

        <div class="tips-grid">
            <div class="tip-card">
                <div class="tip-icon">📱</div>
                <h3 class="tip-title">Manfaatkan Media Sosial</h3>
                <p class="tip-desc">Bangun kehadiran digital Anda melalui media sosial untuk menjangkau audiens yang lebih luas dan meningkatkan penjualan secara signifikan.</p>
            </div>

            <div class="tip-card">
                <div class="tip-icon">📊</div>
                <h3 class="tip-title">Kelola Keuangan dengan Baik</h3>
                <p class="tip-desc">Catat setiap transaksi dan buat laporan keuangan teratur untuk memahami kesehatan bisnis dan membuat keputusan yang tepat.</p>
            </div>

            <div class="tip-card">
                <div class="tip-icon">🤝</div>
                <h3 class="tip-title">Layanan Pelanggan Terbaik</h3>
                <p class="tip-desc">Prioritaskan kepuasan pelanggan dengan memberikan layanan terbaik, respons cepat, dan solusi yang memuaskan setiap kebutuhan mereka.</p>
            </div>

            <div class="tip-card">
                <div class="tip-icon">🔄</div>
                <h3 class="tip-title">Inovasi dan Adaptasi</h3>
                <p class="tip-desc">Selalu cari peluang baru dan jangan takut untuk berubah mengikuti tren pasar serta kebutuhan konsumen yang terus berkembang.</p>
            </div>

            <div class="tip-card">
                <div class="tip-icon">💼</div>
                <h3 class="tip-title">Jalin Kemitraan Strategis</h3>
                <p class="tip-desc">Cari mitra bisnis yang dapat saling mendukung dan menciptakan sinergi untuk pertumbuhan bersama yang lebih cepat dan berkelanjutan.</p>
            </div>

            <div class="tip-card">
                <div class="tip-icon">📈</div>
                <h3 class="tip-title">Investasi pada SDM</h3>
                <p class="tip-desc">Tingkatkan skill dan pengetahuan tim Anda melalui pelatihan, workshop, dan pengembangan karir untuk meningkatkan produktivitas dan kualitas kerja.</p>
            </div>
        </div>
    </div>

    <!-- SECTION 3: PANDUAN & REFERENSI -->
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">📚 Panduan & Referensi Lengkap</h2>
            <p class="section-desc">Kumpulan panduan praktis, tips, dan sumber daya untuk mengembangkan bisnis UMKM Anda dengan lebih baik</p>
        </div>

        <!-- GUIDES SECTION -->
        <div class="guides-grid">
            <!-- Guide 1: Memulai Usaha -->
            <div class="guide-section">
                <h3 class="guide-title">🚀 Memulai Usaha dari Nol</h3>
                <p class="guide-content">Panduan lengkap untuk memulai usaha Anda dari awal dengan persiapan yang matang.</p>
                <ul class="guide-list">
                    <li>Identifikasi ide bisnis dan riset pasar</li>
                    <li>Buat business plan yang solid</li>
                    <li>Tentukan struktur bisnis (PT, CV, Perorangan)</li>
                    <li>Persiapkan modal dan finansial</li>
                    <li>Urus izin dan perizinan usaha</li>
                    <li>Siapkan lokasi dan fasilitas produksi</li>
                    <li>Rekrut dan latih sumber daya manusia</li>
                    <li>Lakukan soft launching dan promosi</li>
                </ul>
            </div>

            <!-- Guide 2: Pengelolaan Keuangan -->
            <div class="guide-section">
                <h3 class="guide-title">💰 Pengelolaan Keuangan yang Baik</h3>
                <p class="guide-content">Strategi mengelola keuangan bisnis agar tetap sehat dan menguntungkan.</p>
                <ul class="guide-list">
                    <li>Pisahkan keuangan bisnis dan pribadi</li>
                    <li>Catat setiap transaksi bisnis</li>
                    <li>Buat laporan keuangan berkala</li>
                    <li>Monitor arus kas masuk dan keluar</li>
                    <li>Tentukan harga jual yang menguntungkan</li>
                    <li>Kelola hutang dan piutang dengan baik</li>
                    <li>Siapkan dana cadangan operasional</li>
                    <li>Lakukan perpajakan yang tepat</li>
                </ul>
            </div>

            <!-- Guide 3: Pemasaran Digital -->
            <div class="guide-section">
                <h3 class="guide-title">📱 Strategi Pemasaran Digital</h3>
                <p class="guide-content">Manfaatkan platform digital untuk meningkatkan penjualan dan awareness brand.</p>
                <ul class="guide-list">
                    <li>Bangun kehadiran di media sosial</li>
                    <li>Buat konten yang menarik dan relevan</li>
                    <li>Kelola toko online (marketplace atau website)</li>
                    <li>Manfaatkan influencer lokal</li>
                    <li>Jalankan campaign promosi yang efektif</li>
                    <li>Analisis data customer dan perilaku pembeli</li>
                    <li>Berikan layanan customer service terbaik</li>
                    <li>Kolaborasi dengan bisnis komplementer</li>
                </ul>
            </div>

            <!-- Guide 4: Pengembangan Produk -->
            <div class="guide-section">
                <h3 class="guide-title">🎯 Pengembangan & Inovasi Produk</h3>
                <p class="guide-content">Strategi mengembangkan produk dan berinovasi untuk tetap kompetitif.</p>
                <ul class="guide-list">
                    <li>Lakukan riset kebutuhan konsumen</li>
                    <li>Kembangkan varian produk baru</li>
                    <li>Tingkatkan kualitas produk existing</li>
                    <li>Perhatikan feedback dan review pelanggan</li>
                    <li>Uji coba produk baru sebelum produksi massal</li>
                    <li>Optimalkan proses produksi</li>
                    <li>Sertifikasi dan standar kualitas</li>
                    <li>Packing dan branding yang menarik</li>
                </ul>
            </div>
        </div>

        <!-- RESOURCES SECTION -->
        <h2 class="guide-title" style="margin-bottom: 32px; margin-top: 40px;">📚 Sumber Daya & Referensi</h2>
        <div class="resources-grid">
            <div class="resource-card" onclick="toggleResource(this)">
                <div class="resource-icon">🎓</div>
                <div class="resource-short">
                    <h3 class="resource-title">Pelatihan UMKM</h3>
                    <p class="resource-desc">Akses gratis pelatihan dari berbagai institusi untuk meningkatkan skill bisnis.</p>
                </div>
                <div class="resource-content">
                    <h3 class="resource-title">Pelatihan UMKM</h3>
                    <p style="margin-bottom: 16px;">Tingkatkan kemampuan bisnis Anda melalui berbagai program pelatihan berkualitas:</p>
                    <ul>
                        <li>Program pelatihan gratis dari Dinas Koperasi & UMKM</li>
                        <li>Workshop manajemen bisnis dan keuangan</li>
                        <li>Pelatihan digital marketing dan e-commerce</li>
                        <li>Sertifikasi keahlian untuk meningkatkan kredibilitas</li>
                        <li>Mentoring dari profesional berpengalaman</li>
                        <li>Akses ke komunitas pembelajaran online</li>
                    </ul>
                </div>
            </div>

            <div class="resource-card" onclick="toggleResource(this)">
                <div class="resource-icon">💼</div>
                <div class="resource-short">
                    <h3 class="resource-title">Program Pembiayaan</h3>
                    <p class="resource-desc">Berbagai program pinjaman dengan bunga rendah untuk pengembangan usaha.</p>
                </div>
                <div class="resource-content">
                    <h3 class="resource-title">Program Pembiayaan</h3>
                    <p style="margin-bottom: 16px;">Solusi pembiayaan untuk mengembangkan bisnis UMKM Anda:</p>
                    <ul>
                        <li>Kredit Usaha Rakyat (KUR) dengan bunga kompetitif</li>
                        <li>Program pembiayaan dari BNI dan Bank Syariah</li>
                        <li>Cicilan 0% untuk investasi awal bisnis</li>
                        <li>Akses ke lembaga keuangan mikro terpercaya</li>
                        <li>Konsultasi gratis untuk permohonan pinjaman</li>
                        <li>Proses approval cepat dan mudah</li>
                    </ul>
                </div>
            </div>

            <div class="resource-card" onclick="toggleResource(this)">
                <div class="resource-icon">🌐</div>
                <div class="resource-short">
                    <h3 class="resource-title">Platform Penjualan</h3>
                    <p class="resource-desc">Manfaatkan marketplace untuk memperluas jangkauan penjualan produk.</p>
                </div>
                <div class="resource-content">
                    <h3 class="resource-title">Platform Penjualan</h3>
                    <p style="margin-bottom: 16px;">Jangkau lebih banyak pelanggan melalui berbagai platform online:</p>
                    <ul>
                        <li>Tokopedia, Shopee, Lazada - marketplace terbesar Indonesia</li>
                        <li>Toko online sendiri dengan Shopify atau WooCommerce</li>
                        <li>Social commerce melalui Facebook & Instagram Shop</li>
                        <li>Strategi SEO untuk meningkatkan visibility</li>
                        <li>Payment gateway terintegrasi dan aman</li>
                        <li>Tools analitik untuk tracking performa penjualan</li>
                    </ul>
                </div>
            </div>

            <div class="resource-card" onclick="toggleResource(this)">
                <div class="resource-icon">👥</div>
                <div class="resource-short">
                    <h3 class="resource-title">Komunitas Bisnis</h3>
                    <p class="resource-desc">Bergabung dengan komunitas untuk networking dan berbagi pengalaman.</p>
                </div>
                <div class="resource-content">
                    <h3 class="resource-title">Komunitas Bisnis</h3>
                    <p style="margin-bottom: 16px;">Kembangkan jaringan bisnis dan dapatkan support dari sesama entrepreneur:</p>
                    <ul>
                        <li>Komunitas UMKM lokal dan nasional</li>
                        <li>Forum diskusi online untuk berbagi pengalaman</li>
                        <li>Networking event dan business gathering rutin</li>
                        <li>Akses ke mentor dan business advisor</li>
                        <li>Peluang kolaborasi dan kemitraan bisnis</li>
                        <li>Grup support WhatsApp untuk entrepreneur</li>
                    </ul>
                </div>
            </div>

            <div class="resource-card" onclick="toggleResource(this)">
                <div class="resource-icon">📞</div>
                <div class="resource-short">
                    <h3 class="resource-title">Konsultasi Gratis</h3>
                    <p class="resource-desc">Layanan konsultasi dari para ahli untuk membantu mengembangkan bisnis Anda.</p>
                </div>
                <div class="resource-content">
                    <h3 class="resource-title">Konsultasi Gratis</h3>
                    <p style="margin-bottom: 16px;">Dapatkan arahan dari para ahli untuk mengoptimalkan bisnis Anda:</p>
                    <ul>
                        <li>Konsultasi bisnis gratis dari Dinas Koperasi</li>
                        <li>Konsultasi keuangan & perpajakan dari akuntan</li>
                        <li>Guidance perizinan dari petugas resmi</li>
                        <li>Strategic planning untuk pengembangan bisnis</li>
                        <li>Sesi tanya jawab dengan business expert</li>
                        <li>Follow-up support untuk implementasi</li>
                    </ul>
                </div>
            </div>

            <div class="resource-card" onclick="toggleResource(this)">
                <div class="resource-icon">🏆</div>
                <div class="resource-short">
                    <h3 class="resource-title">Sertifikasi & Award</h3>
                    <p class="resource-desc">Daftarkan bisnis Anda untuk mendapatkan sertifikasi dan penghargaan.</p>
                </div>
                <div class="resource-content">
                    <h3 class="resource-title">Sertifikasi & Award</h3>
                    <p style="margin-bottom: 16px;">Tingkatkan kredibilitas bisnis dengan sertifikasi dan penghargaan:</p>
                    <ul>
                        <li>Sertifikasi UKM Berprestasi dari pemerintah</li>
                        <li>Award Entrepreneur Terbaik tingkat nasional</li>
                        <li>Sertifikasi Standar Internasional ISO</li>
                        <li>Label Produk Lokal Berkualitas</li>
                        <li>Recognition program dari berbagai institusi</li>
                        <li>Publikasi media dan promosi khusus</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<!-- FOOTER -->
<footer class="footer-simple">
    <div class="footer-inner">
        <div class="footer-left">
            © 2025 <span class="brand">Usahain</span> · Platform Manajemen UMKM Terpadu
        </div>
        <div class="footer-right">
            <a href="#">Tentang</a>
            <span>•</span>
            <a href="#">Kebijakan Privasi</a>
            <span>•</span>
            <a href="#">Bantuan</a>
        </div>
    </div>
</footer>

<script>
// Smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Add animation on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animation = 'fadeIn 0.5s ease-out forwards';
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.info-card, .tip-card, .resource-item, .guide-section, .resource-card').forEach(el => {
    observer.observe(el);
});

// Toggle resource card content
function toggleResource(card) {
    const allCards = document.querySelectorAll('.resource-card');
    
    // Close other cards
    allCards.forEach(c => {
        if (c !== card) {
            c.classList.remove('expanded');
        }
    });
    
    // Toggle current card
    card.classList.toggle('expanded');
    
    // Scroll to card if expanded
    if (card.classList.contains('expanded')) {
        setTimeout(() => {
            card.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }, 100);
    }
}
</script>
</body>
</html>
