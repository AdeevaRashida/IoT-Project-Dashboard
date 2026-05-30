<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="user-id" content="{{ session('firebase_uid') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/paw-prints.png') }}">
    <title>Notifikasi - PawFeeder</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg: #f5f0e8;
            --card: #ffffff;
            --card-hover: #ffffff;
            --text: #3d3529;
            --text-muted: #8c7e6a;
            --primary: #d4883e;
            --primary-light: #f0c28a;
            --primary-bg: #fef3e2;
            --accent: #5bb88a;
            --accent-bg: #e8f7ef;
            --warning: #e8b83d;
            --warning-bg: #fef9eb;
            --danger: #d45a5a;
            --danger-bg: #fde8e8;
            --info: #5b9bd4;
            --info-bg: #e8f1fb;
            --border: #ece6da;
            --shadow: 0 2px 16px rgba(60, 45, 20, 0.06);
            --shadow-hover: 0 8px 32px rgba(60, 45, 20, 0.12);
            --radius: 16px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes bounceIn {
            0% {
                transform: scale(0.3);
                opacity: 0;
            }

            50% {
                transform: scale(1.05);
            }

            70% {
                transform: scale(0.95);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-8px)
            }
        }

        @keyframes wiggle {

            0%,
            100% {
                transform: rotate(0)
            }

            25% {
                transform: rotate(-4deg)
            }

            75% {
                transform: rotate(4deg)
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes slideRight {
            from {
                opacity: 0;
                transform: translateX(-20px)
            }

            to {
                opacity: 1;
                transform: translateX(0)
            }
        }

        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0)
            }

            to {
                opacity: 0;
                transform: translateX(120%)
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .6
            }
        }

        .bounce-in {
            animation: bounceIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) both;
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }

        .fade-up {
            animation: fadeUp 0.5s ease-out both;
        }

        .slide-right {
            animation: slideRight 0.5s ease-out both;
        }

        .pulse-soft {
            animation: pulse 2s ease-in-out infinite;
        }

        .delay-1 {
            animation-delay: .1s;
        }

        .delay-2 {
            animation-delay: .2s;
        }

        .delay-3 {
            animation-delay: .3s;
        }

        .delay-4 {
            animation-delay: .4s;
        }

        .delay-5 {
            animation-delay: .5s;
        }

        .delay-6 {
            animation-delay: .6s;
        }

        .removing {
            animation: slideOutRight .35s ease-in forwards;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 260px;
            background: var(--card);
            border-right: 1px solid var(--border);
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform .3s ease;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 12px;
            margin-bottom: 32px;
        }

        .sidebar-logo img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
        }

        .sidebar-logo h1 {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
        }

        .sidebar-logo span {
            font-size: 11px;
            color: var(--text-muted);
            display: block;
        }

        .sidebar-pet img {
            width: 80px;
            height: 80px;
        }

        .nav-section {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 12px;
            margin-top: 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-muted);
            cursor: pointer;
            transition: all .2s ease;
            text-decoration: none;
            position: relative;
        }

        .nav-item:hover {
            background: var(--primary-bg);
            color: var(--primary);
            transform: translateX(4px);
        }

        .nav-item.active {
            background: var(--primary-bg);
            color: var(--primary);
            font-weight: 600;
        }

        .nav-item svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--danger);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 100px;
            min-width: 20px;
            text-align: center;
        }

        .sidebar-pet {
            margin-top: auto;
            text-align: center;
            padding: 16px;
            background: var(--primary-bg);
            border-radius: 12px;
        }

        .sidebar-pet .pet-emoji {
            font-size: 48px;
            display: block;
        }

        .sidebar-pet p {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 4px;
            font-weight: 500;
        }

        /* ===== MAIN CONTENT ===== */
        .main {
            margin-left: 260px;
            padding: 24px 32px;
            min-height: 100vh;
        }

        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .top-bar h2 {
            font-size: 26px;
            font-weight: 700;
        }

        .top-bar p {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .connection-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
            background: var(--accent-bg);
            color: var(--accent);
            cursor: default;
            transition: all .2s;
        }

        .connection-badge:hover {
            transform: scale(1.05);
        }

        .connection-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            display: inline-block;
            animation: pulse 1.5s ease-in-out infinite;
        }

        /* ===== STATS GRID ===== */
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow);
            transition: all .3s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 28px;
        }

        .stat-icon.orange {
            background: var(--primary-bg);
        }

        .stat-icon.green {
            background: var(--accent-bg);
        }

        .stat-icon.yellow {
            background: var(--warning-bg);
        }

        .stat-icon.red {
            background: var(--danger-bg);
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            line-height: 1.1;
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
            margin-top: 2px;
        }

        /* ===== ACTION BAR ===== */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-tabs {
            display: flex;
            gap: 8px;
            padding: 0;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 8px 14px;
            border-radius: 8px;
            border: none;
            background: transparent;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .filter-tab:hover {
            color: var(--primary);
        }

        .filter-tab.active {
            background: var(--primary-bg);
            color: var(--primary);
        }

        .action-btns {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 12px;
            border: none;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
        }

        .action-btn.secondary {
            background: var(--card);
            color: var(--text-muted);
            border: 1px solid var(--border);
        }

        .action-btn.secondary:hover {
            color: var(--primary);
            border-color: var(--primary-light);
        }

        .action-btn.danger {
            background: var(--danger-bg);
            color: var(--danger);
        }

        .action-btn.danger:hover {
            background: var(--danger);
            color: #fff;
        }

        .action-btn.primary {
            background: linear-gradient(135deg, var(--primary), #e8a050);
            color: #fff;
            box-shadow: 0 4px 16px rgba(212, 136, 62, .3);
        }

        .action-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 22px rgba(212, 136, 62, .4);
        }

        /* ===== NOTIF LIST ===== */
        .notif-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .notif-item {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 18px 20px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: flex-start;
            gap: 16px;
            transition: all .3s ease;
            position: relative;
            cursor: pointer;
        }

        .notif-item:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
        }

        .notif-item.unread {
            border-left: 4px solid var(--border);
            background: #fffdf9;
        }

        .notif-item.unread .notif-title::after {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
            margin-left: 8px;
            vertical-align: middle;
            animation: pulse 1.5s ease-in-out infinite;
        }

        .notif-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 24px;
        }

        .notif-body {
            flex: 1;
            min-width: 0;
        }

        .notif-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .notif-msg {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 8px;
        }

        .notif-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 500;
            flex-wrap: wrap;
        }

        .notif-meta .dot {
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background: var(--text-muted);
            display: inline-block;
        }

        .notif-tag {
            padding: 3px 10px;
            border-radius: 100px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .notif-tag.success {
            background: var(--accent-bg);
            color: var(--accent);
        }

        .notif-tag.warning {
            background: var(--warning-bg);
            color: #b88a1a;
        }

        .notif-tag.danger {
            background: var(--danger-bg);
            color: var(--danger);
        }

        .notif-tag.info {
            background: var(--info-bg);
            color: var(--info);
        }

        .notif-tag.primary {
            background: var(--primary-bg);
            color: var(--primary);
        }

        .notif-actions {
            display: flex;
            gap: 6px;
            align-items: center;
            flex-shrink: 0;
        }

        .icon-btn {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            border: none;
            background: var(--bg);
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s;
            font-size: 16px;
        }

        .icon-btn:hover {
            background: var(--danger-bg);
            color: var(--danger);
            transform: scale(1.1);
        }

        .icon-btn.read:hover {
            background: var(--accent-bg);
            color: var(--accent);
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            background: var(--card);
            border: 2px dashed var(--border);
            border-radius: var(--radius);
            padding: 64px 24px;
            text-align: center;
        }

        .empty-state .emoji {
            font-size: 72px;
            display: block;
            margin-bottom: 12px;
            animation: float 3s ease-in-out infinite;
        }

        .empty-state h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .empty-state p {
            font-size: 14px;
            color: var(--text-muted);
        }

        /* ===== TOAST ===== */
        .toast {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.8);
            opacity: 0;
            transition: all .3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            background: var(--card);
            border: 1px solid var(--border);
            border-left: 4px solid var(--accent);
            padding: 14px 20px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(60, 45, 20, .15);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 300;
            transform: translateX(420px);
            transition: transform .4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            font-size: 14px;
            font-weight: 600;
            max-width: 360px;
        }

        .toast.show {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }

        .toast.error {
            border-left-color: var(--danger);
        }

        .toast.warning {
            border-left-color: var(--warning);
        }

        /* ===== MOBILE ===== */
        .mobile-header {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: var(--card);
            border-bottom: 1px solid var(--border);
            padding: 12px 16px;
            z-index: 101;
            align-items: center;
            justify-content: space-between;
        }

        .mobile-header h1 {
            font-size: 16px;
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .hamburger {
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            font-size: 22px;
            color: var(--text);
        }

        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .3);
            z-index: 99;
        }

        @media (max-width: 900px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .overlay.open {
                display: block;
            }

            .mobile-header {
                display: flex;
            }

            .main {
                margin-left: 0;
                padding: 80px 16px 24px;
            }

            .grid-3 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .top-bar {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }

            .notif-item {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

    {{-- ===== MOBILE HEADER ===== --}}
    <div class="mobile-header">
        <h1>🐾 PawFeeder</h1>
        <button class="hamburger" onclick="toggleSidebar()">☰</button>
    </div>
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    {{-- ===== SIDEBAR ===== --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo bounce-in">
            <img src="{{ asset('images/banana-cat.png') }}" alt="PawFeeder Logo">
            <div>
                <h1>PawFeeder</h1>
                <span>Smart Pet Feeder</span>
            </div>
        </div>

        <div class="nav-section">Menu</div>
        <a class="nav-item slide-right delay-1" href="{{ route('dashboard') }}">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1" />
            </svg>
            Dashboard
        </a>
        <a class="nav-item slide-right delay-2" href="{{ route('jadwal') }}">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Jadwal
        </a>
        <a class="nav-item slide-right delay-3" href="{{ route('statistik') }}">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6m6 0h6m-6 0V9a2 2 0 012-2h2a2 2 0 012 2v10m6 0v-4a2 2 0 00-2-2h-2a2 2 0 00-2 2v4" />
            </svg>
            Statistik
        </a>
        <a class="nav-item slide-right delay-4" href="{{ route('pengaturan') }}">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <circle cx="12" cy="12" r="3" />
            </svg>
            Pengaturan
        </a>

        <div class="nav-section" style="margin-top:24px">Info</div>
        <a class="nav-item active slide-right delay-5" href="{{ route('notifikasi') }}">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0" />
            </svg>
            Notifikasi
        </a>

        <div class="sidebar-pet">
            <img src="{{ asset('images/doge-dog.png') }}" alt="Pet" class="float">
            <p style="font-size:11px;color:var(--text-muted);margin-top:8px">
                <span class="pet-name">{{ session('pet_name') ?? 'Anabul' }}</span> is happy! 🐶
            </p>
        </div>
    </aside>

    {{-- ===== MAIN ===== --}}
    <main class="main">
        {{-- TOP BAR --}}
        <div class="top-bar">
            <div class="fade-up">
                <h2>Notifikasi</h2>
                <p>Semua aktivitas dan info terbaru anabul kamu di sini</p>
            </div>
            <div class="top-bar-right fade-up delay-1">
            </div>
        </div>

        {{-- STATS --}}
        <div class="grid-3">
            <div class="card stat-card fade-up delay-1">
                <div class="stat-icon">
                    <img src="{{ asset('images/lonceng.png') }}" style="width:100%;height:100%;object-fit:contain;">
                </div>
                <div>
                    <div class="stat-value" id="statTotal">0</div>
                    <div class="stat-label">Total Notifikasi</div>
                </div>
            </div>
            <div class="card stat-card fade-up delay-2">
                <div class="stat-icon">
                    <img src="{{ asset('images/kepo.png') }}" style="width:100%;height:100%;object-fit:contain;">
                </div>
                <div>
                    <div class="stat-value" id="statUnread">0</div>
                    <div class="stat-label">Belum Dibaca</div>
                </div>
            </div>
            <div class="card stat-card fade-up delay-3">
                <div class="stat-icon">
                    <img src="{{ asset('images/centang.png') }}" style="width:80%;height:80%;object-fit:contain;">
                </div>
                <div>
                    <div class="stat-value" id="statRead">0</div>
                    <div class="stat-label">Sudah Dibaca</div>
                </div>
            </div>
        </div>

        {{-- ACTION BAR --}}
        <div class="action-bar fade-up delay-3">
            <div class="filter-tabs">
                <button class="filter-tab active" data-filter="all">Semua</button>
                <button class="filter-tab" data-filter="unread">Belum Dibaca</button>
                <button class="filter-tab" data-filter="read">Sudah Dibaca</button>
            </div>
            <div class="action-btns">
                <button class="action-btn danger" onclick="clearAll()">Hapus Semua</button>
            </div>
        </div>

        {{-- NOTIF LIST --}}
        <div class="notif-list" id="notifList"></div>
    </main>

    {{-- ===== TOAST ===== --}}
    <div class="toast" id="toast">
        <span id="toastIcon">✅</span>
        <span id="toastMsg">Berhasil!</span>
    </div>
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
        import { getDatabase, ref, onValue, set, push } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-database.js";

        const firebaseConfig = {
            apiKey: "{{ config('services.firebase.api_key') }}",
            authDomain: "{{ config('services.firebase.auth_domain') }}",
            projectId: "{{ config('services.firebase.project_id') }}",
            storageBucket: "{{ config('services.firebase.storage_bucket') }}",
            messagingSenderId: "{{ config('services.firebase.messaging_sender_id') }}",
            appId: "{{ config('services.firebase.app_id') }}",
            databaseURL: "{{ config('services.firebase.database_url') }}"
        };

        const app = initializeApp(firebaseConfig);
        const db = getDatabase(app);

        let notifications = [];
        const userId = @json(session('firebase_uid'));
        if (!userId) { console.error('User belum login!'); }
        let currentFilter = 'all';

        // ===== HELPERS =====
        function formatDate(ts) {
            const date = new Date(ts);
            const diff = (Date.now() - ts) / 1000;
            if (diff < 60) return 'Baru saja';
            if (diff < 3600) return Math.floor(diff / 60) + ' menit lalu';
            if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';
            if (diff < 172800) return 'Kemarin';
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            return `${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()}`;
        }
        function formatTime(ts) {
            const d = new Date(ts + 7 * 3600000);
            return String(d.getUTCHours()).padStart(2, '0') + ':' + String(d.getUTCMinutes()).padStart(2, '0');
        }

        // ===== RENDER =====
        function render() {
            const list = document.getElementById('notifList');
            let filtered = notifications;
            if (currentFilter === 'unread') filtered = notifications.filter(n => !n.read);
            if (currentFilter === 'read') filtered = notifications.filter(n => n.read);

            document.getElementById('statTotal').textContent = notifications.length;
            document.getElementById('statUnread').textContent = notifications.filter(n => !n.read).length;
            document.getElementById('statRead').textContent = notifications.filter(n => n.read).length;

            if (filtered.length === 0) {
                let msg = 'Belum ada notifikasi nih!';
                if (currentFilter === 'unread') msg = 'Semua notifikasi udah dibaca! :D';
                if (currentFilter === 'read') msg = 'Belum ada notifikasi yang dibaca.';
                list.innerHTML = `
            <div class="empty-state bounce-in">
                <span class="emoji">
                    <img src="{{ asset('images/lonceng.png') }}"
                         style="width:1em;height:1em;object-fit:contain;">
                </span>
                <h3>Belum ada notifikasi</h3>
                <p>${msg}</p>
            </div>`;
                return;
            }

            list.innerHTML = filtered.map((n, i) => `
        <div class="notif-item ${n.read ? '' : 'unread'} fade-up delay-${Math.min(i + 1, 6)}"
             data-id="${n.id}" onclick="toggleRead('${n.id}')">
            <div class="notif-icon ${n.type}"><img src="/images/${n.icon}.png" style="width:48px;height:48px;object-fit:contain;"></div>
            <div class="notif-body">
                <div class="notif-title">${n.title}</div>
                <div class="notif-msg">${n.message}</div>
                <div class="notif-meta">
                    <span class="notif-tag ${n.type}">${n.tag}</span>
                    <span class="dot"></span>
                    <span>${formatDate(n.timestamp)}</span>
                    <span class="dot"></span>
                    <span>${formatTime(n.timestamp)}</span>
                </div>
            </div>
            <div class="notif-actions" onclick="event.stopPropagation()">
                <button class="icon-btn" title="Hapus"
                    onclick="deleteNotif('${n.id}')">🗑️</button>
            </div>
        </div>
    `).join('');
        }

        // ===== LISTEN FIREBASE =====
        onValue(ref(db, 'users/' + userId + '/history'), (snapshot) => {
            const data = snapshot.val();
            if (!data) { notifications = []; render(); return; }

            notifications = Object.entries(data).map(([key, e]) => {
                const isManual = e.type === 'manual';
                return {
                    id: key,
                    icon: isManual ? 'piring' : 'jam',
                    type: 'success',
                    tag: isManual ? 'Manual' : 'Otomatis',
                    title: isManual
                        ? `${document.querySelector('.pet-name')?.textContent || 'Anabul'} diberi makan manual!`
                        : 'Jadwal makan otomatis berjalan!',
                    message: `Porsi ${e.portion}g berhasil dikeluarkan pada ${e.time}. Sisa makanan: ${e.weightAfter ?? '-'}g`,
                    timestamp: e.timestamp,
                    read: e.read ?? false
                };
            }).sort((a, b) => b.timestamp - a.timestamp);

            render();
        });

        // ===== ACTIONS =====
        window.toggleRead = function (id) {
            const n = notifications.find(x => x.id === id);
            if (!n) return;
            n.read = !n.read;
            set(ref(db, 'users/' + userId + '/history/' + id + '/read'), n.read);
            render();
        }

        window.deleteNotif = function (id) {
            const el = document.querySelector(`.notif-item[data-id="${id}"]`);
            if (el) {
                el.classList.add('removing');
                setTimeout(() => {
                    set(ref(db, 'users/' + userId + '/history/' + id), null);
                }, 300);
            }
        }

        window.markAllRead = function () {
            if (notifications.length === 0) return showToast('ℹ️', 'Belum ada notifikasi', 'warning');
            notifications.forEach(n => {
                n.read = true;
                set(ref(db, 'users/' + userId + '/history/' + n.id + '/read'), true);
            });
            showToast('✓', 'Semua notifikasi ditandai dibaca', 'success');
            render();
        }

        window.clearAll = function () {
            if (notifications.length === 0) return showToast('ℹ️', 'Belum ada notifikasi', 'warning');
            if (!confirm('Yakin mau hapus semua notifikasi?')) return;
            set(ref(db, 'users/' + userId + '/history'), null);
            showToast('🗑️', 'Semua notifikasi dihapus', 'error');
        }

        // ===== FILTER TABS =====
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                currentFilter = tab.dataset.filter;
                render();
            });
        });

        // ===== TOAST =====
        function showToast(icon, msg, type = 'success') {
            const toast = document.getElementById('toast');
            document.getElementById('toastIcon').textContent = icon;
            document.getElementById('toastMsg').textContent = msg;
            toast.classList.remove('error', 'warning');
            if (type === 'error') toast.classList.add('error');
            if (type === 'warning') toast.classList.add('warning');
            toast.classList.add('show');
            clearTimeout(window._toastTimer);
            window._toastTimer = setTimeout(() => toast.classList.remove('show'), 2500);
        }

        // ===== SIDEBAR MOBILE =====
        window.toggleSidebar = function () {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('open');
        }
    </script>

    @include('partials.load-pet-name')
</body>

</html>