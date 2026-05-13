<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title><?= $title ?? 'Daftar Tamu' ?> · Undangin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        /* ─── Filter Bar ─────────────────────────────────────── */
        .filter-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        gap: 16px;
        flex-wrap: wrap;
        }

        .filter-group {
        display: flex;
        gap: 6px;
        background: var(--o50);
        border-radius: 40px;
        padding: 4px;
        }

        .filter-btn {
        padding: 8px 18px;
        background: var(--o50);
        border-radius: 40px;
        border: none;
        
        font-size: 11px;
        font-weight: 800;
        color: var(--text3);
        cursor: pointer;
        transition: var(--transition);
        }

        .filter-btn.active {
        background: white; color: var(--o500); box-shadow: 0 1px 6px rgba(200,120,20,0.11); 
        }
        .modal-close {
        width: 30px; height: 30px;
        border-radius: var(--r-sm);
        border: 1px solid var(--border-md);
        background: var(--white); color: var(--text3);
        cursor: pointer; font-size: 13px;
        display: flex; align-items: center; justify-content: center;
        transition: .15s; flex-shrink: 0;
        }
        .modal-close:hover { background: var(--orange-lt); color: var(--orange); }
        .checklist {
        border: 1px solid var(--border-md);
        border-radius: var(--r-md); overflow: hidden;
        }
        .check-item {
        display: flex; align-items: center; gap: 11px;
        padding: 11px 14px; cursor: pointer;
        border-bottom: 1px solid var(--border);
        transition: background .12s;
        }
        .check-item:last-child { border-bottom: none; }
        .check-item:hover { background: var(--orange-lt); }
        .check-item input[type=checkbox] {
        width: 16px; height: 16px;
        accent-color: var(--orange); flex-shrink: 0;
        }
        .check-item-name { font-size: 13px; font-weight: 500; color: var(--text1); }
        .check-item-time { font-size: 11px; color: var(--text3); margin-top: 1px; }
        /* Page-specific styles (same as previous) */
        .toolbar { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 16px; flex-wrap: wrap; }
        .toolbar .search-box { width: 280px; }
        .toolbar .search-box input { width: 100%; }
        .back-button {
            display: inline-flex; align-items: center; gap: 6px; background: var(--white);
            border: 1.5px solid var(--border); border-radius: 40px; padding: 6px 14px;
            font-size: 12px; font-weight: 700; color: var(--text2); cursor: pointer;
            transition: all 0.14s; text-decoration: none; margin-bottom: 12px;
        }
        .back-button:hover { border-color: var(--o300); color: var(--o500); background: var(--o50); }
        .wedding-detail-card {
            background: linear-gradient(135deg, var(--o50) 0%, var(--white) 100%);
            border-radius: 20px; border: 1.5px solid var(--border); padding: 16px 20px;
            margin-bottom: 20px; display: flex; flex-wrap: wrap; align-items: center;
            justify-content: space-between; gap: 14px;
        }
        .wedding-info { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
        .wedding-icon {
            width: 52px; height: 52px; background: linear-gradient(145deg, var(--o300), var(--o500));
            border-radius: 18px; display: flex; align-items: center; justify-content: center;
            font-size: 24px; color: white; flex-shrink: 0;
        }
        .wedding-details h3 { cursive; font-size: 18px; color: var(--text1); margin-bottom: 6px; }
        .wedding-details p { font-size: 12px; color: var(--text2); display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .template-btn {
            background: var(--sage-light); border: 1.5px solid var(--sage-dark); border-radius: 40px;
            padding: 8px 18px; font-size: 12px; font-weight: 800; color: var(--sage-dark);
            cursor: pointer; transition: all 0.14s; display: inline-flex; align-items: center; gap: 8px;
        }
        .template-btn:hover { background: var(--sage); transform: translateY(-1px); }
        .guest-table-card { padding: 0; overflow: hidden; }
        .table-scroll { overflow-x: auto; }
        .guest-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .guest-table thead th {
            background: var(--o50); color: var(--text2); font-size: 10.5px; font-weight: 900;
            letter-spacing: 0.6px; text-transform: uppercase; padding: 12px 14px;
            text-align: left; border-bottom: 1.5px solid var(--border); white-space: nowrap;
        }
        .guest-table tbody td { padding: 12px 14px; border-bottom: 1px solid var(--grey-100); vertical-align: middle; }
        .guest-table tbody tr:hover { background: var(--o50); }
        .guest-cell { display: flex; align-items: center; gap: 10px; }
        .guest-cell .avatar {
            width: 34px; height: 34px; border-radius: 50%; background: var(--o100);
            display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0;
        }
        .guest-meta .name { font-weight: 800; font-size: 13px; color: var(--text1); }
        .guest-meta .phone { font-size: 11px; color: var(--text3); margin-top: 1px; }
        .tag-acara {
            display: inline-flex; align-items: center; gap: 4px; padding: 3px 8px;
            border-radius: 20px; font-size: 10px; font-weight: 800; margin-right: 4px; margin-bottom: 2px;
        }
        .tag-wedding { background: var(--coral-light); color: var(--coral-dark); }
        .tag-birthday { background: var(--amber-light); color: #8A6A00; }
        .tag-wisuda { background: var(--sky-light); color: var(--sky-dark); }
        .status-pill {
            display: inline-block; font-size: 10px; font-weight: 900; padding: 3px 10px;
            border-radius: 20px; white-space: nowrap;
        }
        .status-pill.hadir { background: var(--sage-light); color: var(--sage-dark); }
        .status-pill.belum { background: var(--amber-light); color: #8A6A00; }
        .status-pill.tidak { background: var(--coral-light); color: var(--coral-dark); }
        .status-pill.mungkin { background: var(--sky-light); color: var(--sky-dark); }
        .action-btns { display: flex; align-items: center; gap: 6px; }
        .action-btn {
            width: 30px; height: 30px; border-radius: 8px; border: 1.5px solid var(--border);
            background: var(--white); display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 14px; color: var(--text3); transition: all 0.14s;
        }
        .action-btn:hover { border-color: var(--o300); color: var(--o500); background: var(--o50); }
        .action-btn.whatsapp:hover { border-color: #25D366; color: #25D366; background: #25D36620; }
        .pagination {
            display: flex; align-items: center; justify-content: space-between; padding: 12px 16px;
            border-top: 1.5px solid var(--border); background: var(--o50); flex-wrap: wrap; gap: 10px;
        }
        .page-info { font-size: 11.5px; color: var(--text3); font-weight: 700; }
        .page-btns { display: flex; gap: 4px; flex-wrap: wrap; align-items: center; }
        .page-btn {
            min-width: 34px; height: 34px; border-radius: 8px; border: 1.5px solid var(--border);
            background: var(--white); font-size: 12px; font-weight: 800; color: var(--text2);
            cursor: pointer; display: flex; align-items: center; justify-content: center;
        }
        .page-btn.active { background: var(--o500); color: white; border-color: var(--o500); }
        .page-btn:disabled { opacity: 0.4; cursor: not-allowed; }
        .modal-overlay {
            position: fixed; inset: 0; background: rgba(42,26,14,0.35); z-index: 200;
            opacity: 0; pointer-events: none; transition: opacity 0.22s;
            display: flex; align-items: center; justify-content: center; padding: 20px;
        }
        .modal-overlay.open { opacity: 1; pointer-events: all; }
        .modal-card {
            position:relative;
            padding:20px;
            background: var(--white); 
            border-radius: var(--r); width: 100%; max-width: 520px;
            overflow:hidden;
            max-height:auto;
            transform: translateY(16px); transition: transform 0.26s;
            padding-bottom:80px;
        }
        .modal-body{
            padding-top:20px;
            max-height:100vh;
            overflow-y: auto;
        }
        .modal-overlay.open .modal-card { transform: translateY(0); }
        .modal-large { max-width: 680px; }
        .modal-header { display: flex; justify-content: space-between;}
        .modal-title { font-family: 'Pacifico', cursive; font-size: 18px; color: var(--text1); }
        .form-group { margin-bottom: 14px; }
        .form-label { font-size: 11.5px; font-weight: 800; color: var(--text2); margin-bottom: 5px; text-transform: uppercase; }
        .form-input { width: 100%; padding: 10px 13px; border: 1.5px solid var(--border); border-radius: 10px; font-size: 13px; }
        textarea.form-input { min-height: 200px; font-family: monospace; font-size: 12px; }
        .whatsapp-preview { background: #e5ddd5; border-radius: 12px; padding: 14px; margin-bottom: 14px; }
        .whatsapp-bubble { background: white; border-radius: 18px; padding: 12px 16px; font-size: 13px; line-height: 1.5; white-space: pre-wrap; }
        .template-tabs { display: none; gap: 8px;margin-top:20px; margin-bottom: 16px; flex-wrap: wrap; border-bottom: 1.5px solid var(--border); padding-bottom: 12px; }
        .template-tab { padding: 6px 14px; border-radius: 30px; background: var(--o50); font-size: 12px; font-weight: 800; cursor: pointer; }
        .template-tab.active { background: var(--o500); color: white; }
        .btn-wa { background: #25D366; }
        .modal-footer { 
            left:0;
            bottom:0;
            position:absolute; width: 100%;;display: flex; justify-content: flex-end; gap: 8px; padding: 14px; border-top: 1.5px solid var(--border); }
        .fab-add { display: none; position: fixed; bottom: 80px; right: 16px; width: 52px; height: 52px; border-radius: 50%; background: var(--o500); color: white; border: 3px solid white; align-items: center; justify-content: center; font-size: 22px; cursor: pointer; z-index: 40; }
        @media (max-width: 768px) {
            .toolbar { flex-direction: column; align-items: stretch; }
            .toolbar .search-box { width: 100%; }
            .guest-table thead { display: none; }
            .guest-table tbody tr { display: block; padding: 12px 14px; border-bottom: 1.5px solid var(--border); }
            .guest-table tbody td { display: flex; align-items: center; justify-content: space-between; padding: 6px 0; border: none; }
            .guest-table tbody td::before { content: attr(data-label); font-size: 10px; font-weight: 900; text-transform: uppercase; color: var(--text4); }
            .fab-add { display: flex; }
            .bottom-nav { display: flex; }
            .wedding-detail-card { flex-direction: column; align-items: flex-start; }
        }
        .loader { display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000; }
        .toast-message { position: fixed; bottom: 20px; right: 20px; background: var(--sage-dark); color: white; padding: 12px 20px; border-radius: 10px; z-index: 300; display: none; }

        /* ─── Filter Dropdown Mobile ─────────────────────────────── */
        .filter-dropdown-wrap {
            display: none;
            position: relative;
        }

        .filter-dropdown-trigger {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 14px;
            background: white;
            border: 1.5px solid var(--border);
            border-radius: 40px;
            font-size: 12px;
            font-weight: 800;
            color: var(--text2);
            cursor: pointer;
            transition: all 0.15s;
            min-width: 150px;
            justify-content: space-between;
        }

        .filter-dropdown-trigger:hover {
            border-color: var(--o300);
            color: var(--o500);
        }

        .filter-dropdown-trigger.active-filter {
            background: var(--o500);
            color: white;
            border-color: var(--o500);
        }

        .filter-dropdown-trigger .filter-icon {
            font-size: 14px;
            flex-shrink: 0;
        }

        .filter-dropdown-trigger .filter-chevron {
            font-size: 10px;
            transition: transform 0.2s;
            margin-left: auto;
            padding-left: 6px;
        }

        .filter-dropdown-trigger.open .filter-chevron {
            transform: rotate(180deg);
        }

        .filter-dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            right: 0;
            background: white;
            border: 1.5px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            z-index: 50;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            opacity: 0;
            pointer-events: none;
            transform: translateY(-6px);
            transition: all 0.18s ease;
        }

        .filter-dropdown-menu.open {
            opacity: 1;
            pointer-events: all;
            transform: translateY(0);
        }

        .filter-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            font-size: 12px;
            font-weight: 700;
            color: var(--text2);
            cursor: pointer;
            border-bottom: 1px solid var(--border);
            transition: background 0.12s;
        }

        .filter-dropdown-item:last-child {
            border-bottom: none;
        }

        .filter-dropdown-item:hover {
            background: var(--o50);
            color: var(--o500);
        }

        .filter-dropdown-item.selected {
            background: var(--o50);
            color: var(--o500);
            font-weight: 900;
        }

        .filter-dropdown-item .item-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .filter-dropdown-item .item-check {
            margin-left: auto;
            opacity: 0;
            font-size: 12px;
            color: var(--o500);
        }

        .filter-dropdown-item.selected .item-check {
            opacity: 1;
        }

        @media (max-width: 980px) {
            .filter-group {
                display: none;  /* sembunyikan pill buttons di mobile */
            }
            .filter-dropdown-wrap {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .modal-overlay {
                padding: 0;
                background: rgba(0,0,0,0.5);
                height:100vh;
                margin:0;
                overflow:hidden;
            }
            
            .modal-overlay.open {
                background: rgba(0,0,0,0.5);
            }
            
            .modal-card {
                position: relative;
                max-width: 100%;
                width: 100%;
                margin: 0;
                padding:0;
                transform: translateY(100%);
                transition: transform 0.3s ease-out;
                border-radius:0;
                border: none;
                height:100vh;
                left:0;
                top:0;
                flex-direction: column;
                overflow-y: auto;
            }
            .modal-body{
                padding:80px 20px 80px 20px;
                border:0;
            }
            
            .modal-overlay.open .modal-card {
                transform: translateY(0);
            }
            
            .modal-large {
                max-width: 100%;
            }
            
            /* Header styling untuk mobile */
            .modal-header {
                position: absolute;
                top: 0;
                width: 100%;
                left:0;
                background: white;
                padding: 12px;
                margin-bottom: 16px;
                border-bottom: 1px solid var(--border);
                z-index: 10;
            }
            
            .modal-title {
                font-size: 20px;
            }

            /* Footer tombol di bagian bawah */
            .modal-footer {
                position: fixed;
                width: 100%;
                bottom: 0;
                left:0;
                background: white;
                padding: 16px 16px;
                margin-top: 20px;
                margin-bottom:0;
                gap: 12px;
            }
            
            .modal-footer button {
                flex: 1;
                padding: 12px;
                font-size: 14px;
            }
            
            /* Checklist items styling mobile */
            .check-item {
                padding: 14px;
            }
            
            .check-item-name {
                font-size: 14px;
            }
            
            .check-item-time {
                font-size: 12px;
            }
            
            /* Template tabs scroll horizontal */

            .template-tab {
                white-space: nowrap;
                flex-shrink: 0;
            }
            
            /* WhatsApp preview */
            .whatsapp-preview {
                margin-bottom: 16px;
            }
            
            .whatsapp-bubble {
                font-size: 14px;
                padding: 14px;
            }
            
            /* Tombol close lebih besar untuk mobile */
            .modal-close {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }
            
            /* Tombol WhatsApp di footer */
            .btn-wa {
                background: #25D366;
                color: white;
            }
            
            .btn-wa:hover {
                background: #128C7E;
            }
        }

        /* Animasi untuk modal */
        @keyframes slideUp {
            from {
                transform: translateY(100%);
            }
            to {
                transform: translateY(0);
            }
        }

        /* Loading overlay lebih baik */
        .loader {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(4px);
        }
    </style>
</head>
<body>

<div class="loader" id="loader"><i class="fas fa-spinner fa-pulse fa-2x"></i></div>
<div class="toast-message" id="toast"></div>

<!-- SIDEBAR (same as before) -->

<?php include('../app/Views/dashboard/sidebar.php')?>

<main class="main">
    <div class="topbar">
        <div class="topbar-left"><h1>List Tamu</h1><p>Kelola dan pantau daftar tamu undangan</p></div>
        <div class="topbar-right">
            <div class="search-box"><span>🔍</span><input type="text" id="searchInput" placeholder="Cari tamu..."></div>
            <button class="new-btn" onclick="openAddModal()"><span>＋</span> Tambah Tamu</button>
        </div>
    </div>

    <a href="<?= base_url('undangan-saya') ?>" class="back-button"><span>←</span> Kembali ke Undangan Saya</a>

    <div class="wedding-detail-card">
        <div class="wedding-info">
            <div class="wedding-icon">💍</div>
            <div class="wedding-details">
                <h3><?= esc($undangan->nickname_men ?? '') ?> & <?= esc($undangan->nickname_women ?? '') ?></h3>
                <p>📅 <?= $mainEvent ? date('l, d F Y', strtotime($mainEvent->event_date)) : 'TBA' ?> · <?= $mainEvent ? date('H:i', strtotime($mainEvent->start_at)) : 'TBA' ?> WIB</p>
                <p>📍 <?= $mainEvent->location ?? 'TBA' ?></p>
                <p>🔗 <?= base_url("undangan/{$undangan->url_name}") ?></p>
            </div>
        </div>
        <!-- <button class="template-btn" onclick="openTemplateModal()">Template Pesan WhatsApp</button> -->
    </div>

    <div class="stat-grid">
        <div class="stat-card c1">
        <div class="stat-bg"></div>
        <div class="stat-icon"><i class="fa-solid fa-people-group"></i></div>
        <div class="stat-label">Total Tamu</div>
        <div class="stat-value"><?= $total_tamu ?></div>
        <div class="stat-change up">undangan dibuat</div>
        </div>
        <div class="stat-card c2">
        <div class="stat-bg"></div>
        <div class="stat-icon"><i class="fa-solid fa-calendar-check"></i></div>
        <div class="stat-label">Hadir</div>
        <div class="stat-value"><?= $total_rsvp ?></div>
        <div class="stat-change up">bersedia hadir</div>
        </div>
        <div class="stat-card c3">
        <div class="stat-bg"></div>
        <div class="stat-icon"><i class="fa-solid fa-question"></i></div>
        <div class="stat-label">Belum</div>
        <div class="stat-value"><?= $total_belum ?></div>
        <div class="stat-change up"><?= $total_tamu > 0 ? round($total_rsvp / $total_tamu * 100) : 0 ?>% dari tamu</div>
        </div>
        <div class="stat-card c4">
        <div class="stat-bg"></div>
        <div class="stat-icon"><i class="fa-solid fa-calendar-xmark"></i></div>
        <div class="stat-label">Tidak Hadir</div>
        <div class="stat-value"><?= $total_absen ?></div>
        <div class="stat-change up">berhalangan</div>
        </div>
    </div>

    <div class="card guest-table-card">
        <div class="card-header" style="padding: 16px 16px 0;">
            <div><div class="card-title">Daftar Tamu</div><div class="card-sub">Semua tamu dari acara ini</div></div>
            <div class="filter-group">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="1">Hadir</button>
                <button class="filter-btn" data-filter="0">Belum</button>
                <button class="filter-btn" data-filter="2">Tidak</button>
                <button class="filter-btn" data-filter="3">Mungkin</button>
                <button class="filter-btn reset-filter" id="resetFilterBtn">↺ Reset</button>
            </div>
            <!-- Filter Dropdown (Mobile Only) -->
            <div class="filter-dropdown-wrap" id="filterDropdownWrap">
                <button class="filter-dropdown-trigger" id="filterDropdownTrigger">
                    <span id="filterDropdownLabel">Semua</span>
                    <span class="filter-chevron">▼</span>
                </button>
                <div class="filter-dropdown-menu" id="filterDropdownMenu">
                    <div class="filter-dropdown-item selected" data-filter="all">
                        <span class="item-dot" style="background:#94a3b8"></span>
                        Semua
                        <span class="item-check">✓</span>
                    </div>
                    <div class="filter-dropdown-item" data-filter="1">
                        <span class="item-dot" style="background:#5A9E78"></span>
                        Hadir
                        <span class="item-check">✓</span>
                    </div>
                    <div class="filter-dropdown-item" data-filter="0">
                        <span class="item-dot" style="background:#D4A017"></span>
                        Belum
                        <span class="item-check">✓</span>
                    </div>
                    <div class="filter-dropdown-item" data-filter="2">
                        <span class="item-dot" style="background:#D05A3A"></span>
                        Tidak
                        <span class="item-check">✓</span>
                    </div>
                    <div class="filter-dropdown-item" data-filter="3">
                        <span class="item-dot" style="background:#4A90C4"></span>
                        Mungkin
                        <span class="item-check">✓</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-scroll">
            <table class="guest-table">
                <thead><tr><th>Tamu</th><th>Diundang ke Acara</th><th>Status RSVP</th><th>Aksi</th></tr></thead>
                <tbody id="guestTableBody"></tbody>
            </table>
        </div>

        <div class="pagination" id="paginationContainer"></div>
    </div>
</main>
<!-- <nav class="bottom-nav"><div class="bnav-item active"><span class="bnav-icon">👤</span>Tamu</div><div class="bnav-fab" onclick="openAddModal()"><span></span></div></nav> -->

<!-- MODAL TAMBAH TAMU -->
<div class="modal-overlay" id="addModal">
    <div class="modal-card">
        <div class="modal-header"><div><div class="modal-title">Tambah Tamu Baru</div></div><button class="modal-close" onclick="closeAddModal()"><i class="fas fa-times"></i></button></div>
        <div class="modal-body">
            <form id="addGuestForm">
                <div class="form-group"><label class="form-label">Nama Lengkap</label><input class="form-input" id="guestName" required></div>
                <div class="form-group"><label class="form-label">Nomor WhatsApp</label><input class="form-input" id="guestPhone" placeholder="+62 xxx"></div>
                <div class="form-group">
                    <label class="form-label">Acara yang Diundang</label>
                    <div class="checklist" id="eventsChecklist">
                    <!-- Diisi PHP -->
                    <?php if (!empty($allEvents)): ?>
                        <?php foreach ($allEvents as $event): ?>
                        <label class="check-item">
                            <input type="checkbox" name="events" value="<?= $event->id ?>" <?= $event->main_event == 1 ? 'checked' : '' ?>>
                            <div>
                            <div class="check-item-name"><?= esc($event->event_name) ?></div>
                            <div class="check-item-time"><?= date('d M Y', strtotime($event->event_date)) ?> · <?= substr($event->start_at ?? '', 0, 5) ?> WIB</div>
                            </div>
                        </label>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- demo fallback (hapus di produksi) -->
                        <label class="check-item">
                        <input type="checkbox" name="events" value="1" checked>
                        <div><div class="check-item-name">Akad Nikah</div><div class="check-item-time">03 May 2026 · 09:00 WIB</div></div>
                        </label>
                        <label class="check-item">
                        <input type="checkbox" name="events" value="2">
                        <div><div class="check-item-name">Resepsi</div><div class="check-item-time">03 May 2026 · 11:00 WIB</div></div>
                        </label>
                    <?php endif; ?>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-cancel" onclick="closeAddModal()">Batal</button><button type="submit" class="btn-save">Simpan</button></div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL TEMPLATE PESAN -->
<div class="modal-overlay" id="templateModal">
    <div class="modal-card modal-large">
        <div class="modal-header"><div><div class="modal-title">Template Pesan WhatsApp</div></div><button class="modal-close" onclick="closeTemplateModal()">✕</button></div>
        <div class="template-tabs" id="templateTabs"></div>
        <div class="modal-body">
            <div class="whatsapp-preview"><div class="whatsapp-bubble" id="whatsappPreview"></div></div>
            <div class="form-group"><label class="form-label">✏️ Edit Template</label><textarea class="form-input" id="templateEditor" rows="8"></textarea></div>
        </div>
        <div class="modal-footer"><button class="btn-cancel" onclick="closeTemplateModal()">Tutup</button><button class="btn-save btn-wa" id="sendWaBtn"><i class="fa-brands fa-whatsapp"></i> Kirim ke Tamu</button></div>
    </div>
</div>

<script>
// ── Filter Dropdown Mobile ──
(function () {
    const trigger = document.getElementById('filterDropdownTrigger');
    const menu    = document.getElementById('filterDropdownMenu');
    const label   = document.getElementById('filterDropdownLabel');

    const LABELS = {
        'all': 'Semua',
        '1':   'Hadir',
        '0':   'Belum',
        '2':   'Tidak',
        '3':   'Mungkin'
    };

    trigger?.addEventListener('click', () => {
        trigger.classList.toggle('open');
        menu.classList.toggle('open');
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('#filterDropdownWrap')) {
            trigger?.classList.remove('open');
            menu?.classList.remove('open');
        }
    });

    document.querySelectorAll('.filter-dropdown-item').forEach(item => {
        item.addEventListener('click', () => {
            const filter = item.dataset.filter;
            currentFilter = filter;
            currentPage   = 1;

            // Update label & active state di dropdown
            label.textContent = LABELS[filter] || 'Semua';
            document.querySelectorAll('.filter-dropdown-item').forEach(i => i.classList.remove('selected'));
            item.classList.add('selected');

            // Sync juga pill buttons desktop
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            document.querySelector(`.filter-btn[data-filter="${filter}"]`)?.classList.add('active');

            // Tanda aktif di trigger
            if (filter === 'all') {
                trigger.classList.remove('active-filter');
            } else {
                trigger.classList.add('active-filter');
            }

            trigger.classList.remove('open');
            menu.classList.remove('open');

            fetchGuests();
        });
    });

    // Sync dari pill buttons desktop → update dropdown juga
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;
            if (!filter) return;
            label.textContent = LABELS[filter] || 'Semua';
            document.querySelectorAll('.filter-dropdown-item').forEach(i => i.classList.remove('selected'));
            document.querySelector(`.filter-dropdown-item[data-filter="${filter}"]`)?.classList.add('selected');
            trigger?.classList.toggle('active-filter', filter !== 'all');
        });
    });

    // Reset button juga sync
    document.getElementById('resetFilterBtn')?.addEventListener('click', () => {
        label.textContent = 'Semua Tamu';
        document.querySelectorAll('.filter-dropdown-item').forEach(i => i.classList.remove('selected'));
        document.querySelector('.filter-dropdown-item[data-filter="all"]')?.classList.add('selected');
        trigger?.classList.remove('active-filter');
    });
})();

// Data state
let currentPage = 1;
let currentFilter = 'all';
let currentSearch = '';
let selectedGuestId = null;
let selectedGuestName = null;
let templates = {};

// Helper functions
function showToast(message, isError = false) {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.style.backgroundColor = isError ? '#D05A3A' : '#5A9E78';
    toast.style.display = 'block';
    setTimeout(() => toast.style.display = 'none', 3000);
}

function showLoader() { document.getElementById('loader').style.display = 'flex'; }
function hideLoader() { document.getElementById('loader').style.display = 'none'; }

async function fetchGuests() {
    showLoader();
    try {
        const response = await fetch('<?= $baseUrl ?>/filter', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
            body: new URLSearchParams({ page: currentPage, search: currentSearch, rsvp: currentFilter })
        });
        const data = await response.json();
        if (data.success) {
            renderGuestTable(data.guests);
            renderPagination(data);
            updateStats();
        }
    } catch (error) { console.error(error); showToast('Gagal memuat data', true); }
    finally { hideLoader(); }
}

function renderGuestTable(guests) {
    const tbody = document.getElementById('guestTableBody');
    if (!guests.length) { tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;padding:40px;">📭 Tidak ada tamu</td></tr>'; return; }
    tbody.innerHTML = guests.map(guest => {
        const name  = guest.guest_name;
        const phone = guest.phone_no || '-';
        const eventsHtml = guest.event_names?.map(e => `<span class="tag-acara tag-wedding">💍 ${e}</span>`).join('') || '<span class="tag-acara">-</span>';
        return `<tr>
            <td data-label="Tamu"><div class="guest-cell"><div class="avatar">${name.charAt(0)}</div><div class="guest-meta"><div class="name">${escapeHtml(name)}</div><div class="phone">${escapeHtml(phone)}</div></div></div></td>
            <td data-label="Acara">${eventsHtml}</td>
            <td data-label="RSVP"><span class="status-pill ${guest.rsvp_class}">${guest.rsvp_text}</span></td>
            <td data-label="Aksi"><div class="action-btns">
                <button class="action-btn" onclick="editGuest(${guest.id}, '${escapeHtml(name)}', '${escapeHtml(phone)}')">✏️</button>
                <button class="action-btn whatsapp btn-wa" style="color:white" onclick="openTemplateForGuest(${guest.id}, '${escapeHtml(name)}')"><i class="fa-brands fa-whatsapp"></i></button>
                <button class="action-btn delete" onclick="deleteGuest(${guest.id})">🗑️</button>
            </div></td>
        </tr>`;
    }).join('');
}

function renderPagination(data) {
    const paginationDiv = document.getElementById('paginationContainer');
    let pageButtons = '';
    pageButtons += `<button class="page-btn" onclick="goToPage(1)" ${data.currentPage === 1 ? 'disabled' : ''}>«</button>`;
    pageButtons += `<button class="page-btn" onclick="goToPage(${data.currentPage - 1})" ${data.currentPage === 1 ? 'disabled' : ''}>‹</button>`;
    
    const totalPages = data.totalPages;
    const current = data.currentPage;
    let start = Math.max(1, current - 2);
    let end = Math.min(totalPages, current + 2);
    
    for (let i = start; i <= end; i++) {
        pageButtons += `<button class="page-btn ${i === current ? 'active' : ''}" onclick="goToPage(${i})">${i}</button>`;
    }
    
    pageButtons += `<button class="page-btn" onclick="goToPage(${data.currentPage + 1})" ${data.currentPage === totalPages ? 'disabled' : ''}>›</button>`;
    pageButtons += `<button class="page-btn" onclick="goToPage(${totalPages})" ${data.currentPage === totalPages ? 'disabled' : ''}>»</button>`;
    
    paginationDiv.innerHTML = `
        <div class="page-info">Menampilkan ${data.startItem}–${data.endItem} dari ${data.total} tamu</div>
        <div class="page-btns">${pageButtons}</div>
    `;
}

async function updateStats() {
    const response = await fetch('<?= $baseUrl ?>/filter', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
        body: new URLSearchParams({ page: 1, search: '', rsvp: 'all' })
    });
    const data = await response.json();
    if (data.success) {
        document.getElementById('statGrid').innerHTML = `
            <div class="stat-card c1"><div class="stat-icon">👥</div><div class="stat-label">Total Tamu</div><div class="stat-value">${data.total}</div></div>
            <div class="stat-card c4"><div class="stat-icon">✅</div><div class="stat-label">Hadir</div><div class="stat-value">${data.guests.filter(g => g.rsvp === 1).length}</div></div>
            <div class="stat-card c2"><div class="stat-icon">⏳</div><div class="stat-label">Belum</div><div class="stat-value">${data.guests.filter(g => g.rsvp === 0).length}</div></div>
            <div class="stat-card c3"><div class="stat-icon">🚫</div><div class="stat-label">Tidak Hadir</div><div class="stat-value">${data.guests.filter(g => g.rsvp === 2).length}</div></div>
        `;
    }
}

function goToPage(page) { currentPage = page; fetchGuests(); }
function applyFilters() { currentPage = 1; fetchGuests(); }

// Event listeners
document.getElementById('searchInput').addEventListener('input', (e) => { currentSearch = e.target.value; applyFilters(); });
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        currentFilter = btn.getAttribute('data-filter');
        applyFilters();
    });
});
document.getElementById('resetFilterBtn').addEventListener('click', () => {
    currentFilter = 'all';
    currentSearch = '';
    document.getElementById('searchInput').value = '';
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    document.querySelector('.filter-btn[data-filter="all"]').classList.add('active');
    applyFilters();
});

// CRUD functions
async function addGuest() {
    const name  = document.getElementById('guestName').value.trim();
    const phone = document.getElementById('guestPhone').value.trim();
    if (!name) { showToast('Nama wajib diisi', true); return; }

    // Ambil semua checkbox events yang dicentang
    const checkedEvents = Array.from(
        document.querySelectorAll('#eventsChecklist input[type=checkbox]:checked')
    ).map(cb => cb.value);

    const params = new URLSearchParams();
    params.append('guest_name', name);
    params.append('phone', phone);
    // URLSearchParams butuh append per item untuk array
    checkedEvents.forEach(id => params.append('events[]', id));

    const response = await fetch('<?= $baseUrl ?>/add', {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: params
    });
    const data = await response.json();
    if (data.success) { showToast('Tamu berhasil ditambahkan'); closeAddModal(); fetchGuests(); }
    else { showToast(data.message || 'Gagal', true); }
}

async function deleteGuest(id) {
    if (!confirm('Hapus tamu ini?')) return;
    const response = await fetch(`<?= $baseUrl ?>/delete/${id}`, {
        method: 'DELETE',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });
    const data = await response.json();
    if (data.success) { showToast('Tamu dihapus'); fetchGuests(); }
    else { showToast('Gagal', true); }
}

async function editGuest(id, currentName, currentPhone) {
    const newName = prompt('Edit nama:', currentName);
    if (!newName) return;
    const newPhone = prompt('Edit nomor WA:', currentPhone === '-' ? '' : currentPhone);
    const response = await fetch(`<?= $baseUrl ?>/edit/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
        body: new URLSearchParams({ guest_name: newName, phone: newPhone || '' })
    });
    const data = await response.json();
    if (data.success) { showToast('Tamu diupdate'); fetchGuests(); }
}

// Template & WhatsApp functions
async function loadTemplates() {
    const response = await fetch('<?= $baseUrl ?>/templates', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });
    const data = await response.json();
    if (data.success) {
        templates = data.templates;
        renderTemplateTabs();
    }
}

function renderTemplateTabs() {
    const container = document.getElementById('templateTabs');
    container.innerHTML = Object.keys(templates).map((key, idx) => 
        `<div class="template-tab ${idx === 0 ? 'active' : ''}" data-template="${key}">${getTemplateName(key)}</div>`
    ).join('');
    document.querySelectorAll('.template-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.template-tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            const templateKey = tab.getAttribute('data-template');
            document.getElementById('templateEditor').value = templates[templateKey];
            updatePreview();
        });
    });
}

function getTemplateName(key) {
    const names = { pernikahan: '💍 Pernikahan', ulang_tahun: '🎂 Ulang Tahun', wisuda: '🎓 Wisuda' };
    return names[key] || key;
}

function updatePreview() {
    let text = document.getElementById('templateEditor').value;
    let previewText = text.replace(/{{nama}}/g, selectedGuestName || '[Nama Tamu]');
    document.getElementById('whatsappPreview').innerHTML = previewText.replace(/\n/g, '<br>');
}

async function openTemplateForGuest(id, name) {
    selectedGuestId = id;
    selectedGuestName = name;
    await loadTemplates();
    document.getElementById('templateEditor').value = templates.pernikahan || '';
    updatePreview();
    document.getElementById('templateModal').classList.add('open');
}

function openTemplateModal() {
    selectedGuestId = null;
    selectedGuestName = null;
    openTemplateForGuest(null, '[Nama Tamu]');
}

document.getElementById('templateEditor').addEventListener('input', updatePreview);

document.getElementById('sendWaBtn').onclick = async () => {
    if (!selectedGuestId) {
        showToast('Pilih tamu terlebih dahulu', true);
        return;
    }
    const message = document.getElementById('templateEditor').value;
    const response = await fetch('<?= $baseUrl ?>/send-wa', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
        body: new URLSearchParams({ guest_id: selectedGuestId, message: message })
    });
    const data = await response.json();
    if (data.success) {
        window.open(data.wa_url, '_blank');
        showToast(`Pesan dibuka untuk ${selectedGuestName}`);
        closeTemplateModal();
    } else {
        showToast(data.message || 'Gagal mengirim', true);
    }
};

function openAddModal() { document.getElementById('addModal').classList.add('open'); }
function closeAddModal() { document.getElementById('addModal').classList.remove('open'); document.getElementById('addGuestForm').reset(); }
function closeTemplateModal() { document.getElementById('templateModal').classList.remove('open'); selectedGuestId = null; }
function escapeHtml(str) { return str.replace(/[&<>]/g, m => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;' }[m])); }

document.getElementById('addGuestForm').addEventListener('submit', (e) => { e.preventDefault(); addGuest(); });
document.querySelectorAll('.modal-close').forEach(btn => btn.onclick = () => { closeAddModal(); closeTemplateModal(); });

// Initial load
fetchGuests();
</script>
</body>
</html>