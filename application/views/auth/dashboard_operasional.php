<?php
$user = array_merge([
    'nama'  => 'User',
    'email' => '-',
    'role'  => '-',
    'usaha' => 'Bisnis Anda',
    'type'  => 'UMKM'
], (array)($user ?? []));

$summary = array_merge([
    'today_sales'   => 0,
    'today_expense' => 0,
    'today_profit'  => 0
], $summary ?? []);

$transactions = $transactions ?? [];
?>

<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=5,user-scalable=yes">
<meta name="theme-color" content="#1C6494">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<title>Dashboard <?= htmlspecialchars($user['nama']); ?></title>

<style>
/* === THEME COLOR VARIABLES === */
:root {
    --primary-color: #1F6B99;
    --primary-dark: #154A6F;
    --primary-light: #3A88BA;
    --primary-very-light: #E8F4FB;
    --secondary-color: #7EC8E3;
    --secondary-light: #A5D8E8;
    --accent-color: #48C9B0;
    --accent-dark: #2EA895;
    --success: #10B981;
    --success-light: #D1FAE5;
    --warning: #F59E0B;
    --warning-light: #FEF3C7;
    --danger: #EF4444;
    --danger-light: #FEE2E2;
    --background: #F8FAFC;
    --background-light: #FFFFFF;
    --card-bg: #FFFFFF;
    --text-primary: #1E293B;
    --text-secondary: #64748B;
    --text-muted: #94A3B8;
    --border-color: #E2E8F0;
    --shadow-xs: 0 1px 2px rgba(31, 107, 153, 0.04);
    --shadow-sm: 0 2px 4px rgba(31, 107, 153, 0.08);
    --shadow-md: 0 4px 12px rgba(31, 107, 153, 0.12);
    --shadow-lg: 0 12px 24px rgba(31, 107, 153, 0.15);
    --shadow-xl: 0 20px 40px rgba(31, 107, 153, 0.18);
}

*{box-sizing:border-box;margin:0;padding:0}
body{font-family:Inter,Segoe UI,Arial;background:linear-gradient(135deg, var(--background) 0%, #F0F8FC 100%);color:var(--text-primary)}

/* === SIDEBAR + HEADER LAYOUT (Donezo Style) === */
body {
    display: flex;
    font-family: Inter, Segoe UI, Arial;
    background: linear-gradient(135deg, var(--background) 0%, #F0F8FC 100%);
    color: var(--text-primary);
}

/* SIDEBAR STYLES */
.sidebar {
    position: fixed;
    left: 0;
    top: 0;
    height: 100vh;
    width: 260px;
    background: #fff;
    border-right: 1px solid var(--border-color);
    display: flex;
    flex-direction: column;
    z-index: 50;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    overflow-y: auto;
    overflow-x: hidden;
}

.sidebar.collapsed {
    width: 80px;
}

.sidebar-header {
    padding: 24px 20px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 12px;
}

.sidebar.collapsed .sidebar-header {
    padding: 16px 12px;
    justify-content: center;
}

.sidebar-logo {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    color: var(--primary-color);
    font-weight: 800;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s;
    white-space: nowrap;
    min-width: 40px;
}

.sidebar.collapsed .sidebar-logo {
    gap: 0;
    justify-content: center;
    flex: 1;
}

.sidebar-logo img {
    width: 40px;
    height: 40px;
    border-radius: 8px;
}

.sidebar.collapsed .sidebar-logo-text {
    display: none;
}

.sidebar-toggle {
    width: 36px;
    height: 36px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    display: none;
    align-items: center;
    justify-content: center;
    background: none;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s;
}

.sidebar-toggle:hover {
    background: var(--background);
    color: var(--primary-color);
}

.sidebar-menu {
    flex: 1;
    overflow-y: auto;
    padding: 16px 12px;
    list-style: none;
}

.sidebar-menu-item {
    margin-bottom: 8px;
}

.sidebar-menu-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    border-radius: 10px;
    text-decoration: none;
    color: var(--text-secondary);
    transition: all 0.3s;
    font-weight: 500;
    font-size: 14px;
}

.sidebar-menu-link:hover {
    background: var(--background);
    color: var(--primary-color);
}

.sidebar-menu-link.active {
    background: linear-gradient(135deg, #1F6B99 0%, #3A88BA 100%);
    color: #fff;
    font-weight: 600;
}

.sidebar-menu-icon {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.sidebar.collapsed .sidebar-menu-text {
    display: none;
}

.sidebar-footer {
    padding: 16px 12px;
    border-top: 1px solid var(--border-color);
    display: flex;
    gap: 8px;
}

.sidebar-footer-btn {
    flex: 1;
    padding: 8px 12px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background: none;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s;
    font-size: 12px;
    font-weight: 600;
}

.sidebar-footer-btn:hover {
    background: var(--background);
    color: var(--primary-color);
}

/* MAIN CONTENT WRAPPER */
.main-wrapper {
    margin-left: 260px;
    flex: 1;
    display: flex;
    flex-direction: column;
    transition: margin-left 0.3s ease;
}

body.sidebar-collapsed .main-wrapper {
    margin-left: 80px;
}

/* TOP HEADER */
.top-header {
    background: linear-gradient(135deg, #FFFFFF 0%, var(--primary-very-light) 100%);
    border-bottom: 1px solid var(--border-color);
    padding: 16px 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 70px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    position: sticky;
    top: 0;
    z-index: 40;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 16px;
    flex: 1;
}

.header-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--primary-color);
    white-space: nowrap;
}

.header-search {
    position: relative;
    flex: 1;
    max-width: 400px;
}

.header-search input {
    width: 100%;
    padding: 10px 16px 10px 40px;
    border: 1.5px solid var(--border-color);
    border-radius: 10px;
    background: var(--background-light);
    color: var(--text-primary);
    font-size: 14px;
    transition: all 0.3s;
}

.header-search input::placeholder {
    color: var(--text-muted);
}

.header-search input:focus {
    outline: none;
    border-color: var(--primary-color);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(31, 107, 153, 0.1);
}

.header-search::before {
    content: '🔍';
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 14px;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.header-icon-btn {
    width: 40px;
    height: 40px;
    border: 1.5px solid var(--border-color);
    border-radius: 10px;
    background: var(--background-light);
    color: var(--text-secondary);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    transition: all 0.3s;
}

.header-icon-btn:hover {
    background: var(--background);
    color: var(--primary-color);
}

.header-divider {
    width: 1px;
    height: 24px;
    background: var(--border-color);
}

.header-user {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 12px;
}

.header-user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1F6B99 0%, #7EC8E3 100%);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 14px;
}

.header-user-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.header-user-name {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-primary);
}

.header-user-email {
    font-size: 11px;
    color: var(--text-secondary);
}

.header-subscription-status {
    font-size: 10px;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    margin-top: 4px;
    width: fit-content;
}

.header-subscription-status.premium {
    background: linear-gradient(135deg, #FCD34D 0%, #FBBF24 100%);
    color: #78350F;
}

.header-subscription-status.starter {
    background: rgba(28, 100, 148, 0.1);
    color: #1C6494;
}

.header-subscription-status.free {
    background: rgba(148, 163, 184, 0.1);
    color: #64748B;
}
}

/* MAIN CONTENT AREA */
.content {
    flex: 1;
    padding: 40px 32px;
    overflow-y: auto;
    background: linear-gradient(180deg, var(--background) 0%, #F1F8FC 100%);
}

/* HIDE OLD NAVBAR */
.navbar-main {
    display: none;
}

/* RESPONSIVE DESIGN */
@media(max-width: 1024px) {
    .sidebar {
        width: 200px;
    }
    
    .main-wrapper {
        margin-left: 200px;
    }
    
    .header-search {
        max-width: 250px;
    }
    
    .sidebar.collapsed {
        width: 70px;
    }
    
    body.sidebar-collapsed .main-wrapper {
        margin-left: 70px;
    }
}

@media(max-width: 768px) {
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 0;
        border-right: none;
        z-index: 200;
        overflow: hidden;
        box-shadow: 2px 0 8px rgba(0,0,0,0.15);
    }
    
    .sidebar.mobile-open {
        width: 260px;
    }
    
    .main-wrapper {
        margin-left: 0;
    }
    
    .top-header {
        padding: 12px 16px;
        height: 60px;
    }
    
    .header-left {
        gap: 12px;
    }
    
    .header-search {
        display: none;
    }
    
    .content {
        padding: 16px;
    }
    
    .sidebar-toggle {
        display: flex;
    }
}

@media(max-width: 576px) {
    .sidebar.mobile-open {
        width: 100%;
    }
    
    .header-right {
        gap: 8px;
    }
    
    .header-user-info {
        display: none;
    }
    
    .header-icon-btn {
        width: 36px;
        height: 36px;
        font-size: 16px;
    }
    
    .content {
        padding: 12px;
    }
}


/* LAYOUT */
.container{
    max-width: 1200px;
    margin: 32px auto;
    padding: 0 24px;
}

/* BISNIS CARD - ELEGANT DESIGN */
.biz-card{
    background: linear-gradient(135deg, #E0F2FF 0%, #D1E7F5 100%);
    border-radius: 20px;
    padding: 40px 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    box-shadow: 0 4px 20px rgba(31, 107, 153, 0.15);
    border: 1.5px solid #A5D8E8;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    min-height: 160px;
}
.biz-card::before{
    display: none;
}
.biz-card::after {
    display: none;
}
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(20px); }
}
.biz-card:hover{
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(31, 107, 153, 0.18);
    border-color: #A5D8E8;
}
.biz-left{
    display: flex;
    gap: 32px;
    align-items: center;
    position: relative;
    z-index: 2;
    flex: 1;
}
.biz-info h2{
    font-size: 32px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 16px;
    letter-spacing: -0.5px;
}
.biz-info{
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.biz-info span{
    background: linear-gradient(135deg, #C7E0EE 0%, #D6E9F6 100%);
    color: var(--primary-color);
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    border: 1px solid #A5D8E8;
    display: inline-block;
    transition: all 0.3s ease;
    width: fit-content;
}
.biz-info span:hover{
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(31, 107, 153, 0.15);
}
.biz-profit{
    text-align: right;
    color: var(--primary-color);
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
}
.biz-profit small{
    font-size: 12px;
    font-weight: 600;
    display: block;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-secondary);
}
.biz-profit h2{
    margin: 0;
    font-size: 32px;
    font-weight: 800;
    text-shadow: 0 3px 12px rgba(0,0,0,0.2);
    line-height: 1;
}

/* SUBSCRIPTION STATUS CARD */
.subscription-card {
    background: linear-gradient(135deg, #FEF3C7 0%, #FCD34D 100%);
    border-radius: 16px;
    padding: 24px 28px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    box-shadow: 0 4px 16px rgba(217, 119, 6, 0.12);
    border: 1.5px solid #FCD34D;
    transition: all 0.3s ease;
}

.subscription-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(217, 119, 6, 0.18);
}

.subscription-left {
    display: flex;
    align-items: center;
    gap: 16px;
    flex: 1;
}

.subscription-icon {
    font-size: 32px;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(217, 119, 6, 0.15);
    border-radius: 12px;
}

.subscription-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.subscription-info h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: #78350F;
}

.subscription-info p {
    margin: 0;
    font-size: 12px;
    color: #B45309;
    font-weight: 500;
}

.subscription-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
    padding-left: 16px;
    border-left: 2px solid rgba(217, 119, 6, 0.2);
}

.subscription-status {
    font-size: 12px;
    font-weight: 700;
    color: #78350F;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.subscription-expire {
    font-size: 11px;
    color: #B45309;
}

.subscription-btn {
    background: linear-gradient(135deg, #1F6B99 0%, #154A6F 100%);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 4px;
}

.subscription-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(31, 107, 153, 0.25);
}

/* SECTION */
.section-title{
    font-weight: 700;
    margin: 40px 0 24px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--primary-color);
    font-size: 20px;
    position: relative;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--primary-very-light);
}

.section-title::before {
    content: '';
    width: 4px;
    height: 4px;
    background: var(--primary-color);
    border-radius: 50%;
}

/* AKSI CEPAT - Action Buttons */
.actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
}

.action {
    border-radius: 14px;
    padding: 28px 20px;
    font-weight: 600;
    font-size: 14px;
    text-align: center;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    border: 1.5px solid var(--border-color);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0;
    cursor: pointer;
    background: #fff;
    min-height: 110px;
}

.action:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    border-color: var(--primary-color);
}

.action span {
    font-size: 32px;
    z-index: 2;
    transition: transform 0.3s ease;
}

.action .action-text {
    z-index: 2;
    font-size: 17px;
    font-weight: 700;
    color: inherit;
    line-height: 1.4;
    text-align: center;
    letter-spacing: 0.3px;
    text-shadow: 0 1px 2px rgba(255,255,255,0.3);
}

.action:hover span:not(.action-text) {
    transform: scale(1.15);
}

.sale {
    background: linear-gradient(135deg, #E6F9F0 0%, #CCF2E0 100%);
    border-color: #99E5C2;
    color: #0D7F56;
}

.sale:hover {
    border-color: #10B981;
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.2);
    background: linear-gradient(135deg, #D1F4E6 0%, #B3EDDB 100%);
}

.sale .action-text {
    color: #0D7F56;
    font-weight: 700;
}

.expense {
    background: linear-gradient(135deg, #FDE8E8 0%, #FDD0D0 100%);
    border-color: #FBA8A8;
    color: #B91C1C;
}

.expense:hover {
    border-color: #EF4444;
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.2);
    background: linear-gradient(135deg, #FCD4D4 0%, #FCBABA 100%);
}

.expense .action-text {
    color: #B91C1C;
    font-weight: 700;
}

.stock {
    background: linear-gradient(135deg, #E0EDFF 0%, #C0DCFD 100%);
    border-color: #7EC3F5;
    color: #0C4A99;
}

.stock:hover {
    border-color: #3B82F6;
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.2);
    background: linear-gradient(135deg, #C7DFFE 0%, #A8CFFC 100%);
}

.stock .action-text {
    color: #0C4A99;
    font-weight: 700;
}

.report {
    background: linear-gradient(135deg, #FEF5E6 0%, #FDE9CC 100%);
    border-color: #F5C873;
    color: #A05C00;
}

.report:hover {
    border-color: #F59E0B;
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.2);
    background: linear-gradient(135deg, #FDE9CC 0%, #FDD8B3 100%);
}

.report .action-text {
    color: #A05C00;
    font-weight: 700;
}

/* SUMMARY CARDS */
.summary{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 40px;
}

.sum-card{
    background: linear-gradient(135deg, #FFFFFF 0%, #F9FAFB 100%);
    border-radius: 16px;
    padding: 28px 24px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: 1.5px solid var(--border-color);
    position: relative;
    overflow: hidden;
}

.sum-card::before{
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    transform: scaleX(0);
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.sum-card::after{
    content: '';
    position: absolute;
    bottom: -25%;
    right: -15%;
    width: 140px;
    height: 140px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(31, 107, 153, 0.04) 0%, transparent 70%);
    transition: all 0.5s;
}

.sum-card:hover::after{
    transform: translate(-10%, -10%) scale(1.2);
}

.sum-card:hover::before{
    transform: scaleX(1);
}

.sum-card:hover{
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(31, 107, 153, 0.1);
    border-color: var(--border-color);
}
.sum-card small{
    color: var(--text-secondary);
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
    position: relative;
    z-index: 2;
}
.sum-card small::before{
    content: '';
    display: inline-block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    transition: transform 0.3s;
}
.sum-card:hover small::before{
    transform: scale(1.5);
}
.sum-card h3{
    margin-top: 0;
    font-size: 32px;
    font-weight: 800;
    line-height: 1.2;
    position: relative;
    z-index: 2;
    letter-spacing: -0.5px;
}
.sum-card .green::before,
.sum-card:has(.green)::before{
    background: linear-gradient(90deg, #10B981, #059669);
}

.sum-card .red::before,
.sum-card:has(.red)::before{
    background: linear-gradient(90deg, #EF4444, #DC2626);
}

.sum-card .blue::before,
.sum-card:has(.blue)::before{
    background: linear-gradient(90deg, #1F6B99, #154A6F);
}
.sum-card:has(.green) small::before{
    background: #10B981;
}
.sum-card:has(.red) small::before{
    background: #EF4444;
}
.sum-card:has(.blue) small::before{
    background: #1F6B99;
}
.green{
    color: #059669;
    text-shadow: 0 1px 6px rgba(16, 185, 129, 0.2);
}
.red{
    color: #DC2626;
    text-shadow: 0 1px 6px rgba(239, 68, 68, 0.2);
}
.blue{
    color: #1F6B99;
    text-shadow: 0 1px 6px rgba(31, 107, 153, 0.2);
}

/* TRANSAKSI */
.transaksi{
    background: var(--card-bg);
    border-radius: 20px;
    padding: 24px;
    box-shadow: var(--shadow-sm);
    margin-bottom: 30px;
    border: 1px solid var(--border-color);
}
.tx{
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #f8fbfc 0%, #f0f6f9 100%);
    padding: 16px 20px;
    border-radius: 14px;
    margin-bottom: 12px;
    border-left: 5px solid transparent;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.tx:hover{
    background: linear-gradient(135deg, #e8f4f8 0%, #deeef5 100%);
    transform: translateX(6px);
    box-shadow: 0 4px 12px rgba(31, 107, 153, 0.1);
}
.tx small{
    color: var(--text-secondary);
    font-size: 12px;
}
.tx strong{
    color: var(--text-primary);
    font-weight: 700;
}
.tx.plus{
    border-left-color: #10B981;
    color: #10B981;
}
.tx.minus{
    border-left-color: #EF4444;
    color: #EF4444;
}

/* TOOLS BISNIS */
.tools-grid{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 48px;
}
.tool-box{
    background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
    border-radius: 20px;
    padding: 28px 24px;
    box-shadow: var(--shadow-sm);
    transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    cursor: pointer;
    border: 1px solid var(--border-color);
    position: relative;
    overflow: hidden;
}
.tool-box::before{
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color), var(--primary-light));
    transform: scaleX(0);
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.tool-box::after{
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(31, 107, 153, 0.06) 0%, transparent 70%);
    transition: all 0.5s;
}
.tool-box:hover::after{
    transform: translate(-20%, 20%);
}
.tool-box:hover{
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 12px 28px rgba(31, 107, 153, 0.12);
    border-color: var(--primary-light);
    background: linear-gradient(135deg, #ffffff 0%, #f0f7ff 100%);
}
.tool-box:hover::before{
    transform: scaleX(1);
}
.tool-icon{
    width: 54px;
    height: 54px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin-bottom: 14px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    position: relative;
    z-index: 2;
    transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.tool-box:hover .tool-icon{
    transform: scale(1.12) rotate(-3deg);
    box-shadow: 0 8px 16px rgba(0,0,0,0.15);
}
.tool-icon.hpp{
    background: linear-gradient(135deg, #3B82F6, #1F6B99);
}
.tool-icon.keuangan{
    background: linear-gradient(135deg, #10B981, #059669);
}
.tool-icon.risiko{
    background: linear-gradient(135deg, #F59E0B, #D97706);
}
.tool-icon.analisis{
    background: linear-gradient(135deg, #8B5CF6, #7C3AED);
}
.tool-icon.info{
    background: linear-gradient(135deg, #EC4899, #DB2777);
}
.tool-icon.advisor{
    background: linear-gradient(135deg, #06B6D4, #0891B2);
}
.tool-title{
    font-weight: 800;
    margin-bottom: 12px;
    font-size: 18px;
    color: var(--text-primary);
    position: relative;
    z-index: 2;
}
.tool-desc{
    font-size: 14px;
    color: var(--text-secondary);
    margin-bottom: 16px;
    line-height: 1.6;
    position: relative;
    z-index: 2;
}
.tool-box a{
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.tool-box a::after{
    content: '→';
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.tool-box:hover a{
    color: var(--primary-dark);
}
.tool-box:hover a::after{
    transform: translateX(6px);
}

/* RESPONSIVE DESIGN */

/* === DESKTOP & LARGE SCREENS (>1200px) === */
@media(min-width:1200px){
    .container{max-width:1200px}
}

/* === LAPTOP & MEDIUM SCREENS (992px - 1199px) === */
@media(max-width:1199px){
    .container{max-width:1000px}
    .tools-grid{grid-template-columns:repeat(4,1fr)}
}

/* === TABLET LANDSCAPE & SMALL LAPTOP (768px - 991px) === */
@media(max-width:991px){
    .container{padding:0 20px}
    
    /* Bisnis card */
    .biz-card{padding:24px;flex-direction:column;text-align:center}
    .biz-left{flex-direction:column;width:100%}
    .biz-profit{text-align:center;margin-top:16px}
    .biz-icon{font-size:36px}
    
    /* Actions - 2 columns */
    .actions{grid-template-columns:repeat(2,1fr);gap:12px}
    .action{padding:16px;font-size:14px}
    
    /* Summary - stack vertically */
    .summary{grid-template-columns:1fr;gap:12px}
    
    /* Chart & Insight - stack vertically */
    .chart-insight-wrapper{grid-template-columns:1fr}
    .chart-section{margin-bottom:20px}
    #salesChart{height:200px}
    
    /* Tools - 2 columns */
    .tools-grid{grid-template-columns:repeat(2,1fr);gap:14px}
    .tool-box{padding:20px}
}

/* === TABLET PORTRAIT & LARGE PHONES (576px - 767px) === */
@media(max-width:767px){
    .container{padding:0 16px;margin:20px auto}
    
    /* Bisnis card */
    .biz-card{padding:20px;margin-bottom:20px}
    .biz-info h2{font-size:18px}
    .biz-info span{font-size:11px;padding:4px 10px}
    .biz-profit h2{font-size:22px}
    
    /* Section titles */
    .section-title{font-size:15px;margin:20px 0 12px}
    
    /* Filter periode - full width buttons */
    .filter-periode{
        justify-content:stretch;
        gap:8px
    }
    .filter-btn{
        flex:1;
        text-align:center;
        font-size:12px;
        padding:8px 12px
    }
    
    /* Summary cards */
    .sum-card{padding:16px}
    .sum-card small{font-size:12px}
    .sum-card h3{font-size:20px}
    
    /* Chart */
    .chart-section{padding:20px}
    .chart-header{flex-direction:column;align-items:flex-start;gap:12px}
    .chart-header h4{font-size:15px}
    .chart-legend{flex-wrap:wrap;gap:12px;font-size:11px}
    #salesChart{height:180px}
    
    /* Insight */
    .insight-section{padding:20px}
    .insight-section h4{font-size:15px}
    .insight-item{padding:12px}
    .insight-item strong{font-size:13px}
    .insight-item p{font-size:12px}
    
    /* Transaksi */
    .transaksi{padding:16px}
    .tx{padding:12px;flex-direction:column;align-items:flex-start;gap:8px}
    .tx div:last-child{align-self:flex-end;font-size:16px;font-weight:700}
    
    /* Tools - still 2 columns but smaller */
    .tool-box{padding:18px}
    .tool-icon{font-size:32px;margin-bottom:10px}
    .tool-title{font-size:14px}
    .tool-desc{font-size:12px}
}

/* === SMARTPHONE (320px - 575px) === */
@media(max-width:575px){
    .container{padding:0 12px;margin:16px auto}
    
    /* Bisnis card - compact */
    .biz-card{padding:16px;margin-bottom:16px}
    .biz-icon{font-size:32px}
    .biz-info h2{font-size:16px}
    .biz-info span{font-size:10px;padding:3px 8px;margin-right:4px}
    .biz-profit{margin-top:12px}
    .biz-profit small{font-size:11px}
    .biz-profit h2{font-size:20px}
    
    /* Actions - single column on very small screens */
    .actions{grid-template-columns:1fr;gap:10px}
    .action{padding:14px;font-size:15px}
    
    /* Section titles */
    .section-title{font-size:14px;margin:16px 0 10px}
    
    /* Filter - stack on small phones */
    .filter-periode{gap:6px}
    .filter-btn{font-size:11px;padding:7px 10px}
    
    /* Summary */
    .sum-card{padding:14px}
    .sum-card small{font-size:11px}
    .sum-card h3{font-size:18px;margin-top:6px}
    
    /* Chart */
    .chart-section{padding:16px}
    .chart-header h4{font-size:14px}
    .chart-legend{gap:10px;font-size:10px}
    .legend-color{width:10px;height:10px}
    #salesChart{height:160px}
    
    /* Insight */
    .insight-section{padding:16px}
    .insight-section h4{font-size:14px;margin-bottom:12px}
    .insight-item{padding:10px;margin-bottom:10px}
    .insight-icon{font-size:20px;margin-bottom:6px}
    .insight-item strong{font-size:12px;margin-bottom:4px}
    .insight-item p{font-size:11px;line-height:1.4}
    
    /* Transaksi */
    .transaksi{padding:14px}
    .tx{padding:10px}
    .tx strong{font-size:13px}
    .tx small{font-size:11px}
    .tx div:last-child{font-size:15px}
    
    /* Tools - single column */
    .tools-grid{grid-template-columns:1fr;gap:12px;margin-bottom:30px}
    .tool-box{padding:16px}
    .tool-icon{font-size:28px}
    .tool-title{font-size:14px;margin-bottom:4px}
    .tool-desc{font-size:11px;margin-bottom:8px}
    .tool-box a{font-size:12px}
}

/* === EXTRA SMALL DEVICES (< 375px) === */
@media(max-width:374px){
    .header h3{font-size:14px}
    .biz-info h2{font-size:15px}
    .filter-periode{flex-direction:column}
    .filter-btn{width:100%}
    #salesChart{height:150px}
}

/* Touch-friendly improvements for all mobile devices */
@media(max-width:991px){
    /* Larger touch targets */
    .action, .filter-btn, .logout-btn, .tool-box{
        min-height:44px;
        display:flex;
        align-items:center;
        justify-content:center
    }
    
    /* Prevent text selection on buttons */
    .action, .filter-btn, .logout-btn{
        -webkit-tap-highlight-color:transparent;
        user-select:none
    }
    
    /* Smooth scrolling */
    html{scroll-behavior:smooth}
    
    /* Remove hover effects on touch devices */
    .tool-box:hover::before{transform:scaleX(0)}
}

/* ===== MODAL STYLES ===== */
.modal-overlay{
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    backdrop-filter: blur(5px);
    z-index: 999;
    align-items: center;
    justify-content: center;
}
.modal-overlay.active{
    display: flex;
}
.modal-container{
    background: #fff;
    border-radius: 24px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.25);
    animation: modalSlideIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: 1px solid rgba(31, 107, 153, 0.1);
}
@keyframes modalSlideIn{
    from {
        opacity: 0;
        transform: translateY(-40px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}
.modal-header{
    padding: 28px 28px 16px;
    border-bottom: 1px solid #e9ecef;
}
.modal-title{
    font-size: 24px;
    font-weight: 800;
    color: var(--text-primary);
    margin: 0;
}
.modal-subtitle{
    font-size: 14px;
    color: var(--text-secondary);
    margin: 8px 0 0;
}
.modal-body{
    padding: 28px;
}
.modal-form-group{
    margin-bottom: 24px;
}
.modal-label{
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 8px;
}
.modal-input{
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e0e4e8;
    border-radius: 12px;
    font-size: 15px;
    transition: all 0.3s;
    font-family: inherit;
}
.modal-input:focus{
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(31, 107, 153, 0.1);
}
.modal-input::placeholder{
    color: #adb5bd;
}
.modal-select{
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e0e4e8;
    border-radius: 12px;
    font-size: 15px;
    background: #fff;
    cursor: pointer;
    transition: all 0.3s;
    font-family: inherit;
}
.modal-select:focus{
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(31, 107, 153, 0.1);
}
.modal-textarea{
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e0e4e8;
    border-radius: 12px;
    font-size: 15px;
    font-family: inherit;
    resize: vertical;
    min-height: 100px;
    transition: all 0.3s;
}
.modal-textarea:focus{
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(31, 107, 153, 0.1);
}
.modal-footer{
    padding: 16px 28px 28px;
    display: flex;
    gap: 12px;
    justify-content: flex-end;
}
.modal-btn{
    padding: 12px 28px;
    border: none;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.modal-btn-primary{
    background: var(--primary-color);
    color: #fff;
}
.modal-btn-primary:hover{
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(31, 107, 153, 0.3);
}
.modal-btn-danger{
    background: #EF4444;
    color: #fff;
}
.modal-btn-danger:hover{
    background: #DC2626;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
}
.modal-btn-secondary{
    background: #e9ecef;
    color: var(--text-primary);
    font-weight: 600;
}
.modal-btn-secondary:hover{
    background: #dee2e6;
    transform: translateY(-2px);
}
@media(max-width:576px){
    .modal-container{
        width: 95%;
        border-radius: 20px;
    }
    .modal-header, .modal-body, .modal-footer{
        padding: 20px;
    }
    .modal-title{
        font-size: 22px;
    }
}

/* Modal Risiko Styles */
.modal-container.wide{
    max-width: 800px;
}
.risk-grid{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 28px;
}
.risk-card{
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    border: 2px solid;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.risk-card:hover{
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
.risk-card.red{
    border-color: #EF4444;
    background: linear-gradient(135deg, #fff 0%, #FEE2E2 100%);
}
.risk-card.yellow{
    border-color: #F59E0B;
    background: linear-gradient(135deg, #fff 0%, #FEF3C7 100%);
}
.risk-card.green{
    border-color: #10B981;
    background: linear-gradient(135deg, #fff 0%, #ECFDF5 100%);
}
.risk-card.blue{
    border-color: #3B82F6;
    background: linear-gradient(135deg, #fff 0%, #EFF6FF 100%);
}
.risk-card-header{
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
    font-weight: 800;
    font-size: 16px;
}
.risk-icon{
    font-size: 24px;
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.risk-card.red .risk-icon{
    background: #EF4444;
    color: #fff;
}
.risk-card.yellow .risk-icon{
    background: #F59E0B;
    color: #fff;
}
.risk-card.green .risk-icon{
    background: #10B981;
    color: #fff;
}
.risk-card.blue .risk-icon{
    background: #3B82F6;
    color: #fff;
}
.risk-checklist{
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.risk-checkbox{
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.2s;
}
.risk-checkbox:hover{
    background: rgba(0,0,0,0.04);
}
.risk-checkbox input[type="checkbox"]{
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: var(--primary-color);
}
.risk-checkbox label{
    cursor: pointer;
    font-size: 13px;
    flex: 1;
}
.score-section{
    background: linear-gradient(135deg, var(--primary-color) 0%, #7EC8E3 100%);
    color: #fff;
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 28px;
    box-shadow: 0 8px 24px rgba(31, 107, 153, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.2);
}
.score-header{
    font-size: 16px;
    font-weight: 800;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.score-bar-container{
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    height: 28px;
    overflow: hidden;
    margin-bottom: 16px;
}
.score-bar{
    background: #10B981;
    height: 100%;
    border-radius: 12px;
    transition: width 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 12px;
    color: #fff;
    min-width: 40px;
}
.score-text{
    font-size: 36px;
    font-weight: 800;
    margin-bottom: 8px;
}
.score-desc{
    font-size: 14px;
    opacity: 0.95;
    line-height: 1.6;
}
@media(max-width:768px){
    .risk-grid{
        grid-template-columns: 1fr;
    }
    .modal-container.wide{
        max-width: 95%;
    }
}

/* FILTER PERIODE */
.filter-periode{
    display: flex;
    gap: 12px;
    margin-bottom: 24px;
    justify-content: flex-end;
    flex-wrap: wrap;
}
.filter-btn{
    padding: 10px 20px;
    border-radius: 24px;
    border: 2px solid var(--primary-light);
    background: var(--card-bg);
    color: var(--primary-color);
    font-weight: 700;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    text-decoration: none;
    display: inline-block;
}
.filter-btn:hover{
    background: var(--primary-light);
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(31, 107, 153, 0.2);
}
.filter-btn.active{
    background: var(--primary-color);
    color: #fff;
    border-color: var(--primary-color);
    box-shadow: 0 6px 16px rgba(31, 107, 153, 0.25);
}

/* CHART & INSIGHT WRAPPER */
.chart-insight-wrapper{
    display:grid;
    grid-template-columns:7fr 3fr;
    gap:20px;
    margin-bottom:30px
}

/* CHART SECTION */
.chart-section{
    background: var(--card-bg);
    border-radius: 20px;
    padding: 28px;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
}
.chart-header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}
.chart-header h4{
    color: var(--primary-color);
    font-size: 18px;
    font-weight: 800;
}
.chart-legend{
    display: flex;
    gap: 20px;
    font-size: 13px;
}
.legend-item{
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: var(--text-secondary);
}
.legend-color{
    width: 12px;
    height: 12px;
    border-radius: 3px;
}
.legend-sales{
    background: #10B981;
}
.legend-expense{
    background: #EF4444;
}
.legend-profit{
    background: var(--primary-color);
}
#salesChart{
    width: 100%;
    height: 240px;
}

/* INSIGHT SECTION */
.insight-section{
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    border-radius: 20px;
    padding: 28px;
    color: #fff;
    box-shadow: 0 10px 28px rgba(31, 107, 153, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.15);
}
.insight-section h4{
    font-size: 18px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 800;
}
.insight-item{
    background: rgba(255, 255, 255, 0.12);
    padding: 16px;
    border-radius: 14px;
    margin-bottom: 14px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.insight-item:hover{
    background: rgba(255, 255, 255, 0.18);
    border-color: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}
.insight-item strong{
    display: block;
    margin-bottom: 6px;
    font-size: 15px;
    font-weight: 700;
}
.insight-item p{
    font-size: 13px;
    opacity: 0.95;
    line-height: 1.6;
}
.insight-icon{
    font-size: 24px;
    margin-bottom: 8px;
}

/* FOOTER SIMPLE */
.footer-simple {
    width: 100%;
    background: linear-gradient(180deg, #f8fafc 0%, #f0f6f9 100%);
    border-top: 1px solid #e6eef5;
    padding: 20px 0;
    font-size: 13px;
    color: #64748B;
}

/* INI KUNCI CENTER */
.footer-inner {
    max-width: 1200px;
    margin: 0 auto; /* ← CENTER HORIZONTAL */
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

/* ===== PROFILE MODAL ===== */
.profile-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
    animation: fadeIn 0.3s ease;
}

.profile-modal.show {
    display: flex;
}

.profile-modal-content {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    width: 90%;
    max-width: 500px;
    animation: slideUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.profile-modal-header {
    padding: 24px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.profile-modal-header h2 {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--primary-color);
    margin: 0;
}

.profile-modal-close {
    width: 36px;
    height: 36px;
    border: none;
    border-radius: 8px;
    background: var(--background);
    color: var(--text-secondary);
    cursor: pointer;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}

.profile-modal-close:hover {
    background: var(--border-color);
    color: var(--text-primary);
}

.profile-modal-body {
    padding: 32px 24px;
}

.profile-item {
    margin-bottom: 28px;
    padding-bottom: 20px;
    border-bottom: 2px solid #F1F5F9;
}

.profile-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.profile-item label {
    display: block;
    font-size: 0.85rem;
    font-weight: 700;
    color: #64748B;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
}

.profile-value {
    display: block;
    font-size: 1.15rem;
    color: #1F6B99;
    font-weight: 500;
    padding: 14px 16px;
    background: #F8FAFC;
    border-radius: 10px;
    border-left: 4px solid #1F6B99;
    word-break: break-word;
}

.profile-modal-footer {
    padding: 16px 24px;
    border-top: 1px solid var(--border-color);
    display: flex;
    gap: 12px;
    justify-content: flex-end;
}

.profile-modal-btn {
    padding: 10px 24px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
    color: #fff;
}

.profile-modal-btn:hover {
    box-shadow: 0 8px 16px rgba(31, 107, 153, 0.25);
    transform: translateY(-2px);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 1024px) {
    .actions {
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
    }
    
    .action {
        padding: 24px 16px;
    }
}

@media (max-width: 576px) {
    .actions {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
    
    .action {
        padding: 20px 12px;
    }
    
    .action span {
        font-size: 28px;
    }
    
    .action-text {
        font-size: 12px;
    }
    
    .footer-inner {
        flex-direction: column;
        text-align: center;
        gap: 12px;
    }

    .footer-left,
    .footer-right {
        width: 100%;
        text-align: center;
        justify-content: center;
    }

    .footer-right {
        flex-wrap: wrap;
        gap: 4px;
    }
}
</style>
</head>

<body>

<!-- SIDEBAR NAVIGATION -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="#" onclick="toggleSidebar(); return false;" class="sidebar-logo" title="Klik untuk buka/tutup sidebar">
            <img src="<?= base_url('assets/logo.png'); ?>" alt="Usahain">
            <span class="sidebar-logo-text">Usahain</span>
        </a>
    </div>
    
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a href="<?= site_url('auth/dashboard_operasional'); ?>" class="sidebar-menu-link active">
                <span class="sidebar-menu-icon">📊</span>
                <span class="sidebar-menu-text">Dashboard</span>
            </a>
        </li>
         <li class="sidebar-menu-item">
            <a href="<?= site_url('advisor'); ?>" class="sidebar-menu-link">
                <span class="sidebar-menu-icon">🤖</span>
                <span class="sidebar-menu-text">AI Advisor</span>
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="<?= site_url('hpp'); ?>" class="sidebar-menu-link">
                <span class="sidebar-menu-icon">🧮</span>
                <span class="sidebar-menu-text">Kalkulator HPP</span>
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="<?= site_url('keuangan'); ?>" class="sidebar-menu-link">
                <span class="sidebar-menu-icon">💰</span>
                <span class="sidebar-menu-text">Keuangan</span>
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="<?= site_url('risiko'); ?>" class="sidebar-menu-link">
                <span class="sidebar-menu-icon">🛡️</span>
                <span class="sidebar-menu-text">Manajemen Risiko</span>
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="<?= site_url('analisis'); ?>" class="sidebar-menu-link">
                <span class="sidebar-menu-icon">🎯</span>
                <span class="sidebar-menu-text">Analisis Produk</span>
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="<?= site_url('auth/info_bisnis'); ?>" class="sidebar-menu-link">
                <span class="sidebar-menu-icon">📚</span>
                <span class="sidebar-menu-text">Informasi</span>
            </a>
        </li>
    </ul>
    
    <!-- SUBSCRIPTION STATUS IN SIDEBAR -->
    <div style="padding: 16px 12px; border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color);">
        <div style="background: linear-gradient(135deg, #FEF3C7 0%, #FCD34D 100%); border-radius: 12px; padding: 12px 14px; text-align: center;">
            <div style="font-size: 24px; margin-bottom: 6px;">✨</div>
            <div style="font-size: 12px; font-weight: 700; color: #78350F; margin-bottom: 4px;">Premium Plan</div>
            <div style="font-size: 10px; color: #B45309; margin-bottom: 8px;">Aktif</div>
            <button onclick="openSubscriptionModal()" style="width: 100%; background: linear-gradient(135deg, #1F6B99 0%, #154A6F 100%); color: white; border: none; padding: 6px 8px; border-radius: 6px; font-size: 11px; font-weight: 600; cursor: pointer; transition: all 0.3s;" onmouseover="this.transform='translateY(-1px)'; this.boxShadow='0 4px 12px rgba(31, 107, 153, 0.25)'" onmouseout="this.transform='translateY(0)'; this.boxShadow='none'">Kelola</button>
        </div>
    </div>
    
        <a href="<?= site_url('auth/change_dashboard'); ?>" class="sidebar-footer-btn" style="text-align: center; text-decoration: none;">🏢</a>
        <button class="sidebar-footer-btn" onclick="if(confirm('Yakin ingin logout?')) window.location.href='<?= site_url('auth/logout'); ?>'">
            Logout
        </button>
    </div>
</aside>

<!-- MAIN CONTENT WRAPPER -->
<div class="main-wrapper">
    <!-- TOP HEADER -->
    <header class="top-header">
        <div class="header-left">
            <button class="sidebar-toggle" id="mobileMenuBtn" style="display: none; font-size: 20px; width: auto; border: none; background: none; color: var(--text-secondary); cursor: pointer;">☰</button>
            <div class="header-title">Dashboard Operasional</div>
            <div class="header-search">
                <input type="text" placeholder="Cari...">
            </div>
        </div>
        
        <div class="header-right">
            <button class="header-icon-btn" title="Notifikasi">🔔</button>
            <div class="header-divider"></div>
            <div class="header-user" onclick="openProfileModal()" style="cursor: pointer;">
                <div class="header-user-avatar"><?= strtoupper(substr($user['nama'], 0, 1)); ?></div>
                <div class="header-user-info">
                    <div class="header-user-name"><?= htmlspecialchars($user['nama']); ?></div>
                    <div class="header-user-email"><?= htmlspecialchars($user['email']); ?></div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- MAIN CONTENT -->
    <main class="content">

<div class="container"> 
    <!-- BISNIS -->
    <div class="biz-card">
        <div class="biz-left">
            <div class="biz-info">
                <h2><?= htmlspecialchars($user['usaha']); ?></h2>
                <span><?= $user['type']; ?></span>
                <span>Aktif Beroperasi</span>
            </div>
        </div>
        <div class="biz-profit">
            <small>Hari Ini</small>
            <h2 id="labaBersihHeader">Rp <?= number_format($summary['today_profit'],0,',','.'); ?></h2>
            <small>Laba Bersih</small>
        </div>
    </div>

    <!-- TOOLS -->
    <div class="section-title">Tools Bisnis Lainnya</div>
    <div class="tools-grid">
        <div class="tool-box">
            <div class="tool-icon advisor" style="color:#fff">🤖</div>
            <div class="tool-title">AI Advisor</div>
            <div class="tool-desc">Konsultasi dengan AI untuk strategi bisnis yang lebih baik</div>
            <a href="<?= site_url('advisor'); ?>">Minta Konsultasi</a>
        </div>

        <div class="tool-box">
            <div class="tool-icon hpp" style="color:#fff">🧮</div>
            <div class="tool-title">Kalkulator HPP</div>
            <div class="tool-desc">Hitung Harga Pokok Penjualan untuk menentukan harga jual yang menguntungkan</div>
            <a href="<?= site_url('hpp'); ?>">Hitung HPP</a>
        </div>

        <div class="tool-box">
            <div class="tool-icon keuangan" style="color:#fff">💰</div>
            <div class="tool-title">Pencatatan Keuangan</div>
            <div class="tool-desc">Catat dan kelola semua transaksi keuangan bisnis Anda dengan mudah</div>
            <a href="<?= site_url('keuangan'); ?>">Lihat Laporan</a>
        </div>

        <div class="tool-box">
            <div class="tool-icon risiko" style="color:#fff">⚠️</div>
            <div class="tool-title">Manajemen Risiko</div>
            <div class="tool-desc">Identifikasi dan mitigasi risiko bisnis untuk melindungi usaha Anda</div>
            <a href="<?= site_url('risiko'); ?>">Kelola Risiko</a>
        </div>

        <div class="tool-box">
            <div class="tool-icon analisis" style="color:#fff">📊</div>
            <div class="tool-title">Analisis Produk</div>
            <div class="tool-desc">Analisis performa produk dan dapatkan rekomendasi untuk meningkatkan penjualan</div>
            <a href="<?= site_url('analisis'); ?>">Lihat Analisis</a>
        </div>

        <div class="tool-box">
            <div class="tool-icon info" style="color:#fff">ℹ️</div>
            <div class="tool-title">Rekomendasi Informasi Bisnis</div>
            <div class="tool-desc">Dapatkan informasi dan tips bisnis dari para ahli untuk mengembangkan usaha</div>
            <a href="<?= site_url('auth/info_bisnis'); ?>">Baca Selanjutnya</a>
        </div>
    </div>

    <!-- AKSI CEPAT -->
    <div class="section-title">Aksi Cepat</div>
    <div class="actions">
        <a href="#" onclick="openModalPenjualan(); return false;" class="action sale">
            <span class="action-text">Catat Penjualan</span>
        </a>
        <a href="#" onclick="openModalPengeluaran(); return false;" class="action expense">
            <span class="action-text">Catat Pengeluaran</span>
        </a>
        <a href="<?= base_url('hpp'); ?>" class="action stock">
            <span class="action-text">Kalkulator HPP</span>
        </a>
        <a href="<?= base_url('risiko'); ?>" onclick="openModalRisiko(); return false;" class="action report">
            <span class="action-text">Manajemen Risiko</span>
        </a>
    </div>

    <!-- RINGKASAN -->
    <div class="section-title">Ringkasan Keuangan</div>
    
    <!-- FILTER PERIODE -->
    <div class="filter-periode">
        <a href="?periode=hari" class="filter-btn active">Hari Ini</a>
        <a href="?periode=minggu" class="filter-btn">Minggu Ini</a>
        <a href="?periode=bulan" class="filter-btn">Bulan Ini</a>
        <a href="?periode=tahun" class="filter-btn">Tahun Ini</a>
    </div>
    
    <div class="summary">
        <div class="sum-card">
            <small>Penjualan</small>
            <h3 class="green" id="totalPenjualan">Rp <?= number_format($summary['today_sales'],0,',','.'); ?></h3>
            <small id="jumlahPenjualan">1 transaksi</small>
        </div>
        <div class="sum-card">
            <small>Pengeluaran</small>
            <h3 class="red" id="totalPengeluaran">Rp <?= number_format($summary['today_expense'],0,',','.'); ?></h3>
            <small id="jumlahPengeluaran">1 transaksi</small>
        </div>
        <div class="sum-card">
            <small>Laba Bersih</small>
            <h3 class="blue" id="labaBersih">Rp <?= number_format($summary['today_profit'],0,',','.'); ?></h3>
            <small id="marginProfit">Margin: <?= ($summary['today_sales']>0)?round(($summary['today_profit']/$summary['today_sales'])*100,1):0; ?>%</small>
        </div>
    </div>

    <!-- GRAFIK & INSIGHT -->
<div class="chart-insight-wrapper">

    <!-- GRAFIK -->
    <div class="chart-section">
        <div class="chart-header">
            <h4>Tren Keuangan (7 Hari Terakhir)</h4>
            <div class="chart-legend">
                <div class="legend-item">
                    <div class="legend-color legend-sales"></div>
                    <span>Penjualan</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color legend-expense"></div>
                    <span>Pengeluaran</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color legend-profit"></div>
                    <span>Laba</span>
                </div>
            </div>
        </div>

        <!-- WRAPPER WAJIB -->
        <div class="chart-canvas-wrapper">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <!-- INSIGHT -->
    <div class="insight-section">
        <h4>Insight Bisnis</h4>

        <div class="insight-item">
            <strong>Performa Baik</strong>
            <p>Penjualan hari ini meningkat dibanding hari sebelumnya.</p>
        </div>

        <div class="insight-item">
            <strong>Efisiensi Biaya</strong>
            <p>Pengeluaran relatif stabil dan terkontrol.</p>
        </div>

        <div class="insight-item">
            <strong>Rekomendasi</strong>
            <p>Tambahkan stok produk favorit untuk memaksimalkan penjualan.</p>
        </div>
    </div>

</div>


    <!-- TRANSAKSI -->
    <div class="section-title">Transaksi Terbaru <span style="font-size:13px;font-weight:normal;margin-left:10px;color:#999" id="jumlahTransaksi"><?= count($transactions); ?> transaksi</span></div>
    <div class="transaksi" id="transaksiList">
        <?php if($transactions): foreach($transactions as $tx): $neg = ($tx['amount'] < 0); ?>
        <div class="tx <?= $neg?'minus':'plus'; ?>">
            <div>
                <strong><?= htmlspecialchars($tx['title']); ?></strong><br>
                <small><?= $tx['type']; ?></small>
            </div>
            <div><?= $neg?'-':'+'; ?> Rp <?= number_format(abs($tx['amount']),0,',','.'); ?></div>
        </div>
        <?php endforeach; else: ?>
        <p class="text-muted">Belum ada transaksi</p>
        <?php endif; ?>
    </div>

</div>

<!-- FOOTER SIMPLE -->
<footer class="footer-simple">
    <div class="footer-inner">
        <div class="footer-left">
            © 2025 <span class="brand">Usahain</span> · Platform Manajemen UMKM Terpadu
        </div>
        <div class="footer-right">
            <a href="#">Tentang</a>
            <span>•</span>
            <a href="#">Fitur</a>
            <span>•</span>
            <a href="#">Kebijakan Privasi</a>
            <span>•</span>
            <a href="#">Bantuan</a>
        </div>
    </div>
</footer>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
// Data dummy untuk demo (nanti bisa diambil dari backend)
const chartData = {
    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
    sales: [2500000, 3200000, 2800000, 4100000, 3600000, 4800000, 3900000],
    expense: [1200000, 1500000, 1100000, 1800000, 1400000, 2000000, 1600000],
    profit: [1300000, 1700000, 1700000, 2300000, 2200000, 2800000, 2300000]
};

// Initialize Chart
const ctx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartData.labels,
        datasets: [
            {
                label: 'Penjualan',
                data: chartData.sales,
                borderColor: '#2ecc71',
                backgroundColor: 'rgba(46, 204, 113, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: '#2ecc71',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            },
            {
                label: 'Pengeluaran',
                data: chartData.expense,
                borderColor: '#e74c3c',
                backgroundColor: 'rgba(231, 76, 60, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: '#e74c3c',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            },
            {
                label: 'Laba Bersih',
                data: chartData.profit,
                borderColor: '#1C6494',
                backgroundColor: 'rgba(28, 100, 148, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: '#1C6494',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                padding: 12,
                titleFont: {
                    size: 14,
                    weight: 'bold'
                },
                bodyFont: {
                    size: 13
                },
                callbacks: {
                    label: function(context) {
                        let label = context.dataset.label || '';
                        if (label) {
                            label += ': ';
                        }
                        label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                        return label;
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + (value / 1000000) + 'jt';
                    },
                    font: {
                        size: 11
                    }
                },
                grid: {
                    color: 'rgba(0, 0, 0, 0.05)'
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    font: {
                        size: 11,
                        weight: '600'
                    }
                }
            }
        }
    }
});

// Filter periode functionality
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Update active state
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        // Get periode parameter
        const periode = this.href.split('periode=')[1];
        
        // Update chart title based on periode
        const titles = {
            'hari': '7 Hari Terakhir',
            'minggu': '4 Minggu Terakhir',
            'bulan': '12 Bulan Terakhir',
            'tahun': '5 Tahun Terakhir'
        };
        
        document.querySelector('.chart-header h4').innerHTML = 
            '📊 Tren Keuangan (' + titles[periode] + ')';
        
        // Here you can add AJAX call to fetch new data based on periode
        // For demo, we'll just keep the same data
        console.log('Filter changed to:', periode);
    });
});
</script>

<!-- MODAL CATAT PENJUALAN -->
<div class="modal-overlay" id="modalPenjualan" onclick="if(event.target===this) closeModalPenjualan()">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">💰 Catat Penjualan</h3>
            <p class="modal-subtitle">Masukkan detail penjualan Anda</p>
        </div>
        <form id="formPenjualan" onsubmit="submitPenjualan(event)">
            <div class="modal-body">
                <div class="modal-form-group">
                    <label class="modal-label" for="inputJumlah">Jumlah (Rp)</label>
                    <input 
                        type="text" 
                        id="inputJumlah" 
                        class="modal-input" 
                        placeholder="150.000"
                        oninput="formatRupiah(this)"
                        required
                    >
                </div>
                <div class="modal-form-group">
                    <label class="modal-label" for="inputKategori">Kategori</label>
                    <select id="inputKategori" class="modal-select" required>
                        <option value="" disabled selected>Pilih kategori</option>
                        <option value="Makanan & Minuman">Makanan & Minuman</option>
                        <option value="Produk">Produk</option>
                        <option value="Jasa">Jasa</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="modal-form-group">
                    <label class="modal-label" for="inputDeskripsi">Deskripsi</label>
                    <textarea 
                        id="inputDeskripsi" 
                        class="modal-textarea" 
                        placeholder="Penjualan nasi ayam 10 porsi"
                        required
                    ></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-btn modal-btn-secondary" onclick="closeModalPenjualan()">Batal</button>
                <button type="submit" class="modal-btn modal-btn-primary">Simpan Transaksi</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL CATAT PENGELUARAN -->
<div class="modal-overlay" id="modalPengeluaran" onclick="if(event.target===this) closeModalPengeluaran()">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">🧾 Catat Pengeluaran</h3>
            <p class="modal-subtitle">Masukkan detail pengeluaran Anda</p>
        </div>
        <form id="formPengeluaran" onsubmit="submitPengeluaran(event)">
            <div class="modal-body">
                <div class="modal-form-group">
                    <label class="modal-label" for="inputJumlahPengeluaran">Jumlah (Rp)</label>
                    <input 
                        type="text" 
                        id="inputJumlahPengeluaran" 
                        class="modal-input" 
                        placeholder="75.000"
                        oninput="formatRupiah(this)"
                        required
                    >
                </div>
                <div class="modal-form-group">
                    <label class="modal-label" for="inputKategoriPengeluaran">Kategori</label>
                    <select id="inputKategoriPengeluaran" class="modal-select" required>
                        <option value="" disabled selected>Pilih kategori</option>
                        <option value="Bahan Baku">Bahan Baku</option>
                        <option value="Operasional">Operasional</option>
                        <option value="Gaji Karyawan">Gaji Karyawan</option>
                        <option value="Utilitas">Utilitas (Listrik, Air)</option>
                        <option value="Transport">Transport</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="modal-form-group">
                    <label class="modal-label" for="inputDeskripsiPengeluaran">Deskripsi</label>
                    <textarea 
                        id="inputDeskripsiPengeluaran" 
                        class="modal-textarea" 
                        placeholder="Pembelian beras 25kg"
                        required
                    ></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-btn modal-btn-secondary" onclick="closeModalPengeluaran()">Batal</button>
                <button type="submit" class="modal-btn modal-btn-danger">Simpan Transaksi</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL MANAJEMEN RISIKO -->
<div class="modal-overlay" id="modalRisiko" onclick="if(event.target===this) closeModalRisiko()">
    <div class="modal-container wide">
        <div class="modal-header">
            <h3 class="modal-title">⚠️ Manajemen Risiko Bisnis</h3>
            <p class="modal-subtitle">Identifikasi dan kelola risiko untuk melindungi bisnis Anda</p>
        </div>
        <form id="formRisiko" onsubmit="submitRisiko(event)">
            <div class="modal-body">
                
                <!-- SKOR RISIKO -->
                <div class="score-section">
                    <div class="score-header">📊 Skor Kesehatan Bisnis</div>
                    <div class="score-text" id="riskScore">0%</div>
                    <div class="score-bar-container">
                        <div class="score-bar" id="riskScoreBar" style="width:0%">0%</div>
                    </div>
                    <div class="score-desc" id="riskDesc">Mulai centang item di bawah untuk menilai risiko bisnis Anda</div>
                </div>

                <!-- RISK CARDS GRID -->
                <div class="risk-grid">
                    
                    <!-- RISIKO TINGGI -->
                    <div class="risk-card red">
                        <div class="risk-card-header">
                            <div class="risk-icon">🔴</div>
                            <div>Risiko Tinggi</div>
                        </div>
                        <div class="risk-checklist">
                            <div class="risk-checkbox">
                                <input type="checkbox" id="risk1" onchange="calculateRiskScore()">
                                <label for="risk1">Tidak ada asuransi bisnis</label>
                            </div>
                            <div class="risk-checkbox">
                                <input type="checkbox" id="risk2" onchange="calculateRiskScore()">
                                <label for="risk2">Hanya 1 supplier utama</label>
                            </div>
                            <div class="risk-checkbox">
                                <input type="checkbox" id="risk3" onchange="calculateRiskScore()">
                                <label for="risk3">Tidak ada dana darurat</label>
                            </div>
                            <div class="risk-checkbox">
                                <input type="checkbox" id="risk4" onchange="calculateRiskScore()">
                                <label for="risk4">Lokasi rawan bencana</label>
                            </div>
                        </div>
                    </div>

                    <!-- RISIKO SEDANG -->
                    <div class="risk-card yellow">
                        <div class="risk-card-header">
                            <div class="risk-icon">🟡</div>
                            <div>Risiko Sedang</div>
                        </div>
                        <div class="risk-checklist">
                            <div class="risk-checkbox">
                                <input type="checkbox" id="risk5" onchange="calculateRiskScore()">
                                <label for="risk5">Fluktuasi harga bahan</label>
                            </div>
                            <div class="risk-checkbox">
                                <input type="checkbox" id="risk6" onchange="calculateRiskScore()">
                                <label for="risk6">Kompetitor baru muncul</label>
                            </div>
                            <div class="risk-checkbox">
                                <input type="checkbox" id="risk7" onchange="calculateRiskScore()">
                                <label for="risk7">Bisnis musiman</label>
                            </div>
                            <div class="risk-checkbox">
                                <input type="checkbox" id="risk8" onchange="calculateRiskScore()">
                                <label for="risk8">Karyawan kunci resign</label>
                            </div>
                        </div>
                    </div>

                    <!-- MITIGASI RISIKO -->
                    <div class="risk-card green">
                        <div class="risk-card-header">
                            <div class="risk-icon">🟢</div>
                            <div>Mitigasi Risiko</div>
                        </div>
                        <div class="risk-checklist">
                            <div class="risk-checkbox">
                                <input type="checkbox" id="mitigasi1" onchange="calculateRiskScore()">
                                <label for="mitigasi1">Kontrak supplier jangka panjang</label>
                            </div>
                            <div class="risk-checkbox">
                                <input type="checkbox" id="mitigasi2" onchange="calculateRiskScore()">
                                <label for="mitigasi2">Diversifikasi produk/layanan</label>
                            </div>
                            <div class="risk-checkbox">
                                <input type="checkbox" id="mitigasi3" onchange="calculateRiskScore()">
                                <label for="mitigasi3">Dana darurat 6 bulan</label>
                            </div>
                            <div class="risk-checkbox">
                                <input type="checkbox" id="mitigasi4" onchange="calculateRiskScore()">
                                <label for="mitigasi4">SOP tertulis lengkap</label>
                            </div>
                        </div>
                    </div>

                    <!-- RENCANA KONTINJENSI -->
                    <div class="risk-card blue">
                        <div class="risk-card-header">
                            <div class="risk-icon">🔵</div>
                            <div>Rencana Kontinjensi</div>
                        </div>
                        <div class="risk-checklist">
                            <div class="risk-checkbox">
                                <input type="checkbox" id="kontinjensi1" onchange="calculateRiskScore()">
                                <label for="kontinjensi1">Backup supplier tersedia</label>
                            </div>
                            <div class="risk-checkbox">
                                <input type="checkbox" id="kontinjensi2" onchange="calculateRiskScore()">
                                <label for="kontinjensi2">Sistem pembayaran digital</label>
                            </div>
                            <div class="risk-checkbox">
                                <input type="checkbox" id="kontinjensi3" onchange="calculateRiskScore()">
                                <label for="kontinjensi3">Kemampuan WFH/remote</label>
                            </div>
                            <div class="risk-checkbox">
                                <input type="checkbox" id="kontinjensi4" onchange="calculateRiskScore()">
                                <label for="kontinjensi4">Asuransi bisnis aktif</label>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="modal-btn modal-btn-secondary" onclick="closeModalRisiko()">Batal</button>
                <button type="submit" class="modal-btn modal-btn-primary">Simpan Assessment</button>
            </div>
        </form>
    </div>
</div>

<script>
// Data tracking
let dataKeuangan = {
    penjualan: <?= $summary['today_sales']; ?>,
    pengeluaran: <?= $summary['today_expense']; ?>,
    jumlahTransaksiPenjualan: 1,
    jumlahTransaksiPengeluaran: 1,
    totalTransaksi: <?= count($transactions); ?>
};

// Format number to Rupiah
function formatRupiahDisplay(number) {
    return 'Rp ' + parseInt(number).toLocaleString('id-ID');
}

// Update all displays
function updateDisplay() {
    const labaBersih = dataKeuangan.penjualan - dataKeuangan.pengeluaran;
    const margin = dataKeuangan.penjualan > 0 ? ((labaBersih / dataKeuangan.penjualan) * 100).toFixed(1) : 0;

    console.log('Updating displays...');
    console.log('Penjualan:', dataKeuangan.penjualan);
    console.log('Pengeluaran:', dataKeuangan.pengeluaran);
    console.log('Laba Bersih:', labaBersih);

    // Update header
    const headerEl = document.getElementById('labaBersihHeader');
    if (headerEl) {
        headerEl.textContent = formatRupiahDisplay(labaBersih);
        console.log('✓ Header updated');
    }

    // Update summary cards
    const penjualanEl = document.getElementById('totalPenjualan');
    if (penjualanEl) {
        penjualanEl.textContent = formatRupiahDisplay(dataKeuangan.penjualan);
        console.log('✓ Penjualan updated');
    }

    const pengeluaranEl = document.getElementById('totalPengeluaran');
    if (pengeluaranEl) {
        pengeluaranEl.textContent = formatRupiahDisplay(dataKeuangan.pengeluaran);
        console.log('✓ Pengeluaran updated');
    }

    const labaBersihEl = document.getElementById('labaBersih');
    if (labaBersihEl) {
        labaBersihEl.textContent = formatRupiahDisplay(labaBersih);
        console.log('✓ Laba Bersih updated');
    }
    
    const jumlahPenjualanEl = document.getElementById('jumlahPenjualan');
    if (jumlahPenjualanEl) {
        jumlahPenjualanEl.textContent = dataKeuangan.jumlahTransaksiPenjualan + ' transaksi';
    }
    
    const jumlahPengeluaranEl = document.getElementById('jumlahPengeluaran');
    if (jumlahPengeluaranEl) {
        jumlahPengeluaranEl.textContent = dataKeuangan.jumlahTransaksiPengeluaran + ' transaksi';
    }
    
    const marginEl = document.getElementById('marginProfit');
    if (marginEl) {
        marginEl.textContent = 'Margin: ' + margin + '%';
    }
    
    // Update total transaksi
    const totalTxEl = document.getElementById('jumlahTransaksi');
    if (totalTxEl) {
        totalTxEl.textContent = dataKeuangan.totalTransaksi + ' transaksi';
    }

    console.log('All displays updated successfully!');
}

// Add transaction to list
function addTransactionToList(title, kategori, amount) {
    const transaksiList = document.getElementById('transaksiList');
    
    // Remove "belum ada transaksi" message if exists
    const emptyMsg = transaksiList.querySelector('.text-muted');
    if (emptyMsg) {
        emptyMsg.remove();
    }

    // Create new transaction element
    const newTx = document.createElement('div');
    newTx.className = 'tx plus';
    newTx.style.animation = 'slideIn 0.3s ease-out';
    newTx.innerHTML = `
        <div>
            <strong>${title}</strong><br>
            <small>Baru saja • ${kategori}</small>
        </div>
        <div>+ Rp ${parseInt(amount).toLocaleString('id-ID')}</div>
    `;

    // Add to top of list
    transaksiList.insertBefore(newTx, transaksiList.firstChild);
}

// Add expense transaction to list
function addExpenseToList(title, kategori, amount) {
    const transaksiList = document.getElementById('transaksiList');
    
    // Remove "belum ada transaksi" message if exists
    const emptyMsg = transaksiList.querySelector('.text-muted');
    if (emptyMsg) {
        emptyMsg.remove();
    }

    // Create new transaction element
    const newTx = document.createElement('div');
    newTx.className = 'tx minus';
    newTx.style.animation = 'slideIn 0.3s ease-out';
    newTx.innerHTML = `
        <div>
            <strong>${title}</strong><br>
            <small>Baru saja • ${kategori}</small>
        </div>
        <div>- Rp ${parseInt(amount).toLocaleString('id-ID')}</div>
    `;

    // Add to top of list
    transaksiList.insertBefore(newTx, transaksiList.firstChild);
}

// Open Modal Penjualan
function openModalPenjualan() {
    document.getElementById('modalPenjualan').classList.add('active');
    document.body.style.overflow = 'hidden';
}

// Close Modal Penjualan
function closeModalPenjualan() {
    document.getElementById('modalPenjualan').classList.remove('active');
    document.body.style.overflow = '';
    document.getElementById('formPenjualan').reset();
}

// Open Modal Pengeluaran
function openModalPengeluaran() {
    document.getElementById('modalPengeluaran').classList.add('active');
    document.body.style.overflow = 'hidden';
}

// Close Modal Pengeluaran
function closeModalPengeluaran() {
    document.getElementById('modalPengeluaran').classList.remove('active');
    document.body.style.overflow = '';
    document.getElementById('formPengeluaran').reset();
}

// Open Modal Risiko
function openModalRisiko() {
    document.getElementById('modalRisiko').classList.add('active');
    document.body.style.overflow = 'hidden';
    calculateRiskScore(); // Calculate initial score
}

// Close Modal Risiko
function closeModalRisiko() {
    document.getElementById('modalRisiko').classList.remove('active');
    document.body.style.overflow = '';
    document.getElementById('formRisiko').reset();
}

// Calculate Risk Score
function calculateRiskScore() {
    // Count checked items in each category
    const risikoTinggi = [1,2,3,4].filter(i => document.getElementById('risk'+i)?.checked).length;
    const risikoSedang = [5,6,7,8].filter(i => document.getElementById('risk'+i)?.checked).length;
    const mitigasi = [1,2,3,4].filter(i => document.getElementById('mitigasi'+i)?.checked).length;
    const kontinjensi = [1,2,3,4].filter(i => document.getElementById('kontinjensi'+i)?.checked).length;
    
    // Calculate score (lower risk = higher score)
    // Negative points for risks, positive points for mitigations
    const negativePoints = (risikoTinggi * 10) + (risikoSedang * 5);
    const positivePoints = (mitigasi * 8) + (kontinjensi * 7);
    
    // Score from 0-100
    let score = 50 + positivePoints - negativePoints;
    score = Math.max(0, Math.min(100, score)); // Clamp between 0-100
    
    // Update UI
    const scoreText = document.getElementById('riskScore');
    const scoreBar = document.getElementById('riskScoreBar');
    const scoreDesc = document.getElementById('riskDesc');
    
    if (scoreText && scoreBar && scoreDesc) {
        scoreText.textContent = Math.round(score) + '%';
        scoreBar.style.width = score + '%';
        scoreBar.textContent = Math.round(score) + '%';
        
        // Change color based on score
        if (score >= 75) {
            scoreBar.style.background = '#2ecc71';
            scoreDesc.textContent = '✅ Excellent! Bisnis Anda memiliki manajemen risiko yang baik';
        } else if (score >= 50) {
            scoreBar.style.background = '#f39c12';
            scoreDesc.textContent = '⚠️ Cukup baik, namun masih ada area yang perlu diperbaiki';
        } else if (score >= 25) {
            scoreBar.style.background = '#e67e22';
            scoreDesc.textContent = '⚠️ Perlu perhatian! Risiko bisnis cukup tinggi';
        } else {
            scoreBar.style.background = '#e74c3c';
            scoreDesc.textContent = '🚨 Urgent! Bisnis Anda memiliki risiko tinggi yang perlu segera ditangani';
        }
    }
    
    console.log('Risk Assessment:', {
        risikoTinggi,
        risikoSedang,
        mitigasi,
        kontinjensi,
        score: Math.round(score)
    });
}

// Format Rupiah
function formatRupiah(input) {
    let value = input.value.replace(/[^0-9]/g, '');
    if (value) {
        value = parseInt(value).toLocaleString('id-ID');
    }
    input.value = value;
}

// Submit Form Penjualan
function submitPenjualan(e) {
    e.preventDefault();
    
    const jumlahRaw = document.getElementById('inputJumlah').value.replace(/[^0-9]/g, '');
    const jumlah = parseInt(jumlahRaw);
    const kategori = document.getElementById('inputKategori').value;
    const deskripsi = document.getElementById('inputDeskripsi').value;
    
    console.log('=== SUBMIT PENJUALAN ===');
    console.log('Jumlah:', jumlah);
    console.log('Kategori:', kategori);
    console.log('Deskripsi:', deskripsi);
    
    // Validasi
    if (!jumlah || isNaN(jumlah) || jumlah <= 0) {
        alert('⚠️ Masukkan jumlah yang valid!');
        return;
    }
    
    // Update data keuangan
    dataKeuangan.penjualan += jumlah;
    dataKeuangan.jumlahTransaksiPenjualan++;
    dataKeuangan.totalTransaksi++;
    
    // Add to transaction list
    addTransactionToList(deskripsi, kategori, jumlah);
    
    // Update all displays
    updateDisplay();
    
    // Show success notification
    showNotification('✅ Penjualan berhasil dicatat! Rp ' + parseInt(jumlah).toLocaleString('id-ID'), 'success');
    
    closeModalPenjualan();
}

// Submit Form Pengeluaran
function submitPengeluaran(e) {
    e.preventDefault();
    
    const jumlahRaw = document.getElementById('inputJumlahPengeluaran').value.replace(/[^0-9]/g, '');
    const jumlah = parseInt(jumlahRaw);
    const kategori = document.getElementById('inputKategoriPengeluaran').value;
    const deskripsi = document.getElementById('inputDeskripsiPengeluaran').value;
    
    console.log('=== SUBMIT PENGELUARAN ===');
    console.log('Jumlah:', jumlah);
    console.log('Kategori:', kategori);
    console.log('Deskripsi:', deskripsi);
    
    // Validasi
    if (!jumlah || isNaN(jumlah) || jumlah <= 0) {
        alert('⚠️ Masukkan jumlah yang valid!');
        return;
    }
    
    // Update data keuangan
    dataKeuangan.pengeluaran += jumlah;
    dataKeuangan.jumlahTransaksiPengeluaran++;
    dataKeuangan.totalTransaksi++;
    
    // Add to transaction list
    addExpenseToList(deskripsi, kategori, jumlah);
    
    // Update all displays
    updateDisplay();
    
    // Show success notification
    showNotification('✅ Pengeluaran berhasil dicatat! Rp ' + parseInt(jumlah).toLocaleString('id-ID'), 'error');
    
    closeModalPengeluaran();
}

// Submit Form Risiko
function submitRisiko(e) {
    e.preventDefault();
    
    // Get score
    const scoreText = document.getElementById('riskScore').textContent;
    const scoreDesc = document.getElementById('riskDesc').textContent;
    
    console.log('=== SUBMIT RISK ASSESSMENT ===');
    console.log('Score:', scoreText);
    console.log('Description:', scoreDesc);
    
    // Count items
    const totalChecked = document.querySelectorAll('#formRisiko input[type="checkbox"]:checked').length;
    
    // Show success notification
    showNotification('✅ Assessment risiko berhasil disimpan! Skor: ' + scoreText + ' (' + totalChecked + ' item teridentifikasi)', 'success');
    
    closeModalRisiko();
}

// Show notification
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#2fb12f' : '#e74c3c'};
        color: white;
        padding: 16px 24px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        animation: slideInRight 0.3s ease-out;
        font-weight: 600;
    `;
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease-out';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModalPenjualan();
        closeModalPengeluaran();
        closeModalRisiko();
    }
});

// Add CSS animations
const styleAnimations = document.createElement('style');
styleAnimations.textContent = `
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(100px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes slideOutRight {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(100px); }
    }
`;
document.head.appendChild(styleAnimations);

// Sidebar Toggle Function
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const body = document.body;
    
    body.classList.toggle('sidebar-collapsed');
    sidebar.classList.toggle('collapsed');
    
    console.log('Sidebar toggled:', {
        bodyCollapsed: body.classList.contains('sidebar-collapsed'),
        sidebarCollapsed: sidebar.classList.contains('collapsed')
    });
}

const sidebar = document.getElementById('sidebar');
const mobileMenuBtn = document.getElementById('mobileMenuBtn');

if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener('click', function() {
        sidebar.classList.toggle('mobile-open');
    });
}

// Close sidebar when clicking on a link on mobile
document.querySelectorAll('.sidebar-menu-link').forEach(link => {
    link.addEventListener('click', function() {
        if (window.innerWidth <= 768) {
            sidebar.classList.remove('mobile-open');
        }
    });
});

// Responsive sidebar toggle button visibility
function updateResponsive() {
    if (window.innerWidth <= 768) {
        mobileMenuBtn.style.display = 'flex';
        sidebarToggle.style.display = 'flex';
    } else {
        mobileMenuBtn.style.display = 'none';
        sidebar.classList.remove('mobile-open');
    }
}

updateResponsive();
window.addEventListener('resize', updateResponsive);
</script>

<!-- PROFILE MODAL -->
<div class="profile-modal" id="profileModal">
    <div class="profile-modal-content">
        <div class="profile-modal-header">
            <h2>Profil User</h2>
            <button class="profile-modal-close" onclick="closeProfileModal()">✕</button>
        </div>
        <div class="profile-modal-body">
            <div class="profile-item">
                <label>Nama Lengkap</label>
                <div class="profile-value"><?= htmlspecialchars($user['nama'] ?? '-'); ?></div>
            </div>
            <div class="profile-item">
                <label>Email</label>
                <div class="profile-value"><?= htmlspecialchars($user['email'] ?? '-'); ?></div>
            </div>
            <div class="profile-item">
                <label>Nama Usaha</label>
                <div class="profile-value"><?= htmlspecialchars($user['usaha'] ?? '-'); ?></div>
            </div>
            <div class="profile-item">
                <label>Tipe Dashboard</label>
                <div class="profile-value"><?= htmlspecialchars($user['type'] ?? '-'); ?></div>
            </div>
        </div>
        <div class="profile-modal-footer">
            <button class="profile-modal-btn" onclick="closeProfileModal()">Tutup</button>
        </div>
    </div>
</div>

<script>
function openProfileModal() {
    document.getElementById('profileModal').classList.add('show');
}

function closeProfileModal() {
    document.getElementById('profileModal').classList.remove('show');
}

function openSubscriptionModal() {
    alert('Membuka halaman manajemen paket langganan...');
    // Dapat diarahkan ke halaman subscription jika diperlukan
    // window.location.href = '<?= site_url('user/subscription'); ?>';
}

// Close modal when clicking outside
document.getElementById('profileModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeProfileModal();
    }
});
</script>

</main>
</div>

</body>
</html>

