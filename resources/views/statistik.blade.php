<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/paw-prints.png') }}">
    <title>Statistik - PawFeeder</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
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
            --card: #faf8f4;
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
            --border: #e8e0d4;
            --shadow: 0 2px 16px rgba(60, 45, 20, 0.06);
            --shadow-hover: 0 8px 32px rgba(60, 45, 20, 0.12);
            --radius: 16px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        * {
            font-style: normal;
        }

        h1,
        h2,
        h3,
        .top-bar h2,
        .sidebar-logo h1 {
            font-weight: 700;
        }

        p,
        span,
        div,
        td,
        th,
        label,
        a,
        button,
        input {
            font-weight: 400;
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

        @keyframes pulse {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .6
            }
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
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

        .delay-7 {
            animation-delay: .7s;
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

        .sidebar-logo .logo-circle {
            width: 48px;
            height: 48px;
            background: var(--primary-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
        }

        .sidebar-logo h1 {
            font-size: 20px;
            color: var(--primary);
            line-height: 1.1;
        }

        .sidebar-logo span {
            font-size: 11px;
            color: var(--text-muted);
            display: block;
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
            overflow: hidden;
        }

        .nav-item:hover {
            background: var(--primary-bg);
            color: var(--primary);
            transform: translateX(4px);
        }

        .nav-item svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .nav-item.active {
            background: var(--primary-bg);
            color: var(--primary);
            font-weight: 600;
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

        .sidebar-pet img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
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

        /* ===== PERIOD SELECTOR ===== */
        .period-selector {
            display: inline-flex;
            gap: 4px;
            padding: 4px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .period-btn {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            background: transparent;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            transition: all .2s;
        }

        .period-btn:hover {
            color: var(--primary);
        }

        .period-btn.active {
            background: var(--primary-bg);
            color: var(--primary);
        }

        /* ===== CARDS ===== */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow);
            transition: all .3s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
        }

        .card-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ===== STATS GRID ===== */
        .grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        .grid-2-1 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
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

        .stat-icon.blue {
            background: var(--info-bg);
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            line-height: 1.1;
            animation: countUp .6s ease both;
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
            margin-top: 2px;
        }

        .stat-trend {
            font-size: 11px;
            font-weight: 600;
            margin-top: 4px;
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }

        .stat-trend.up {
            color: var(--accent);
        }

        .stat-trend.down {
            color: var(--danger);
        }

        /* ===== CHART ===== */
        .chart-container {
            position: relative;
            height: 280px;
        }

        .chart-container.small {
            height: 220px;
        }

        .chart-container canvas {
            width: 100% !important;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .chart-legend {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        /* ===== TOP TIMES LIST ===== */
        .top-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .top-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            background: var(--bg);
            transition: all .2s;
        }

        .top-item:hover {
            background: var(--primary-bg);
            transform: translateX(4px);
        }

        .top-rank {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: var(--primary-bg);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .top-rank.gold {
            background: #fff3d6;
            color: #c89020;
        }

        .top-rank.silver {
            background: #ececec;
            color: #888;
        }

        .top-rank.bronze {
            background: #f5e0d0;
            color: #b87040;
        }

        .top-info {
            flex: 1;
            min-width: 0;
        }

        .top-info .label {
            font-size: 14px;
            font-weight: 600;
        }

        .top-info .sub {
            font-size: 11px;
            color: var(--text-muted);
        }

        .top-value {
            font-size: 14px;
            font-weight: 700;
            color: var(--primary);
        }

        /* ===== HISTORY TABLE ===== */
        .history-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 6px;
        }

        .history-table th {
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            padding: 8px 12px;
        }

        .history-table td {
            padding: 12px;
            font-size: 13px;
            background: var(--bg);
            transition: background .2s;
        }

        .history-table tr:hover td {
            background: var(--primary-bg);
        }

        .history-table td:first-child {
            border-radius: 10px 0 0 10px;
        }

        .history-table td:last-child {
            border-radius: 0 10px 10px 0;
        }

        .table-wrap {
            overflow-x: auto;
        }

        .type-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 600;
        }

        .type-badge.manual {
            background: var(--primary-bg);
            color: var(--primary);
        }

        .type-badge.auto {
            background: var(--accent-bg);
            color: var(--accent);
        }

        .status-badge-tbl {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-badge-tbl.success {
            background: var(--accent-bg);
            color: var(--accent);
        }

        .status-badge-tbl.warning {
            background: var(--warning-bg);
            color: #a07820;
        }

        /* ===== ACTION BTN ===== */
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

        .action-btn.primary {
            background: linear-gradient(135deg, var(--primary), #e8a050);
            color: #fff;
            box-shadow: 0 4px 16px rgba(212, 136, 62, .3);
        }

        .action-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 22px rgba(212, 136, 62, .4);
        }

        /* ===== INSIGHT CARDS ===== */
        .insight-card {
            display: flex;
            gap: 14px;
            padding: 16px;
            background: var(--bg);
            border-radius: 12px;
            transition: all .2s;
        }

        .insight-card:hover {
            background: var(--primary-bg);
        }

        .insight-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .insight-icon.green {
            background: var(--accent-bg);
        }

        .insight-icon.yellow {
            background: var(--warning-bg);
        }

        .insight-icon.blue {
            background: var(--info-bg);
        }

        .insight-body .title {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .insight-body .desc {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* ===== TOAST ===== */
        .toast {
            position: fixed;
            top: 24px;
            right: 24px;
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
            transform: translateX(0);
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

        @media (max-width: 1100px) {
            .grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
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

            .grid-2,
            .grid-3,
            .grid-2-1 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .top-bar {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }

            .grid-4 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    {{-- ===== MOBILE HEADER ===== --}}
    <div class="mobile-header">
        <button class="hamburger" onclick="toggleSidebar()">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <span style="font-weight:700;color:var(--primary)">🐾 PawFeeder</span>
        <div class="connection-badge"><span class="connection-dot pulse-soft"></span> Online</div>
    </div>
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo bounce-in">
            <img src="{{ asset('images/banana-cat.png') }}" alt="PawFeeder Logo"
                style="width:48px;height:48px;object-fit:contain;border-radius:50%;">
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
        <a class="nav-item active slide-right delay-3" href="{{ route('statistik') }}">
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
        <a class="nav-item slide-right delay-5" href="{{ route('notifikasi') }}">
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
                <h2>Statistik</h2>
                <p>Pantau pola makan & konsumsi anabul kamu di sini</p>
            </div>
            <div class="top-bar-right fade-up delay-1">
                <div class="period-selector">
                    <button class="period-btn" data-period="day">Hari</button>
                    <button class="period-btn active" data-period="week">Minggu</button>
                    <button class="period-btn" data-period="month">Bulan</button>
                </div>
            </div>
        </div>

        {{-- STATS --}}
        <div class="grid-4">
            <div class="card stat-card fade-up delay-1">
                <div class="stat-icon">
                    <img src="{{ asset('images/piring.png') }}" style="width:100%;height:100%;object-fit:contain;">
                </div>

                <div>
                    <div class="stat-value" id="statFeeding">28</div>
                    <div class="stat-label">Total Feeding</div>
                    <div class="stat-trend up" id="trendFeeding">▲ 12% vs minggu lalu</div>
                </div>
            </div>
            <div class="card stat-card fade-up delay-2">
                <div class="stat-icon">
                    <img src="{{ asset('images/dimsum-cat.png') }}" style="width:100%;height:100%;object-fit:contain;">
                </div>

                <div>
                    <div class="stat-value" id="statConsumed">820g</div>
                    <div class="stat-label">Total Dikonsumsi</div>
                    <div class="stat-trend up" id="trendConsumed">▲ 8% vs minggu lalu</div>
                </div>
            </div>
            <div class="card stat-card fade-up delay-3">
                <div class="stat-icon" style="font-size:28px;line-height:1;">
                    📈
                </div>

                <div>
                    <div class="stat-value" id="statAvg">117g</div>
                    <div class="stat-label">Rata-rata Harian</div>
                    <div class="stat-trend down" id="trendAvg">▼ 3% vs minggu lalu</div>
                </div>
            </div>
            <div class="card stat-card fade-up delay-4">
                <div class="stat-icon">
                    <img src="{{ asset('images/centang.png') }}" style="width:100%;height:100%;object-fit:contain;">
                </div>

                <div>
                    <div class="stat-value" id="statSuccess">96%</div>
                    <div class="stat-label">Tingkat Sukses</div>
                    <div class="stat-trend up" id="trendSuccess">▲ 2% vs minggu lalu</div>
                </div>
            </div>
        </div>

        {{-- CHART + TOP TIMES --}}
        <div class="grid-2-1">
            <div class="card fade-up delay-2">
                <div class="chart-header">
                    <div class="card-title" style="margin:0">Konsumsi Makanan</div>
                    <div class="chart-legend">
                        <div class="legend-item"><span class="legend-dot" style="background:var(--primary)"></span>
                            Konsumsi (g)</div>
                        <div class="legend-item"><span class="legend-dot" style="background:var(--accent)"></span>
                            Target (g)</div>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="consumptionChart"></canvas>
                </div>
            </div>

            <div class="card fade-up delay-3">
                <div class="card-title">Jam Makan Favorit</div>
                <div class="top-list">
                    <div class="top-item">
                        <div class="top-rank gold">1</div>
                        <div class="top-info">
                            <div class="label">07:00</div>
                            <div class="sub">Sarapan pagi</div>
                        </div>
                        <div class="top-value">7x</div>
                    </div>
                    <div class="top-item">
                        <div class="top-rank silver">2</div>
                        <div class="top-info">
                            <div class="label">12:00</div>
                            <div class="sub">Makan siang</div>
                        </div>
                        <div class="top-value">7x</div>
                    </div>
                    <div class="top-item">
                        <div class="top-rank bronze">3</div>
                        <div class="top-info">
                            <div class="label">18:00</div>
                            <div class="sub">Makan malam</div>
                        </div>
                        <div class="top-value">7x</div>
                    </div>
                    <div class="top-item">
                        <div class="top-rank">4</div>
                        <div class="top-info">
                            <div class="label">22:00</div>
                            <div class="sub">Snack malam</div>
                        </div>
                        <div class="top-value">5x</div>
                    </div>
                    <div class="top-item">
                        <div class="top-rank">5</div>
                        <div class="top-info">
                            <div class="label">15:30</div>
                            <div class="sub">Snack sore</div>
                        </div>
                        <div class="top-value">2x</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2 CHARTS ROW --}}
        <div class="grid-2">
            <div class="card fade-up delay-3">
                <div class="card-title">🍩 Tipe Feeding</div>
                <div class="chart-container small">
                    <canvas id="typeChart"></canvas>
                </div>
            </div>
            <div class="card fade-up delay-4">
                <div class="card-title">Pola Mingguan</div>
                <div class="chart-container small">
                    <canvas id="weeklyChart"></canvas>
                </div>
            </div>
        </div>

        {{-- HISTORY TABLE --}}
        <div class="card fade-up delay-5">
            <div class="chart-header">
                <div class="card-title" style="margin:0">Riwayat Aktivitas</div>
                <div style="display:flex;gap:10px;flex-wrap:wrap">
                    <button class="action-btn primary" onclick="exportData()" style="margin-left:auto">Export
                        Excel</button>

                </div>
            </div>
            <div class="table-wrap">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Jenis</th>
                            <th>Porsi</th>
                            <th>Status</th>
                            <th>Berat Setelah</th>
                        </tr>
                    </thead>
                    <tbody id="historyBody">
                        <tr>
                            <td>12:00</td>
                            <td><span class="type-badge auto">⏰ Otomatis</span></td>
                            <td>30g</td>
                            <td><span class="status-badge-tbl success">✓ Berhasil</span></td>
                            <td>75g</td>
                        </tr>
                        <tr>
                            <td>10:30</td>
                            <td><span class="type-badge manual">👆 Manual</span></td>
                            <td>15g</td>
                            <td><span class="status-badge-tbl success">✓ Berhasil</span></td>
                            <td>105g</td>
                        </tr>
                        <tr>
                            <td>07:00</td>
                            <td><span class="type-badge auto">⏰ Otomatis</span></td>
                            <td>30g</td>
                            <td><span class="status-badge-tbl success">✓ Berhasil</span></td>
                            <td>120g</td>
                        </tr>
                        <tr>
                            <td>Kemarin 18:00</td>
                            <td><span class="type-badge auto">⏰ Otomatis</span></td>
                            <td>30g</td>
                            <td><span class="status-badge-tbl success">✓ Berhasil</span></td>
                            <td>150g</td>
                        </tr>
                        <tr>
                            <td>Kemarin 12:00</td>
                            <td><span class="type-badge auto">⏰ Otomatis</span></td>
                            <td>25g</td>
                            <td><span class="status-badge-tbl warning">⚠ Terlambat</span></td>
                            <td>180g</td>
                        </tr>
                        <tr>
                            <td>Kemarin 07:00</td>
                            <td><span class="type-badge auto">⏰ Otomatis</span></td>
                            <td>30g</td>
                            <td><span class="status-badge-tbl success">✓ Berhasil</span></td>
                            <td>205g</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- ===== TOAST ===== --}}
    <div class="toast" id="toast">
        <span id="toastIcon">✅</span>
        <span id="toastMsg">Berhasil!</span>
    </div>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
        import { getDatabase, ref, onValue } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-database.js";

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

        const uid = @json(session('firebase_uid'));

        // ====== LOAD PET NAME ======
        if (uid) {
            fetch(`https://pawfeeder-456a9-default-rtdb.asia-southeast1.firebasedatabase.app/users/${uid}/profile/pet_name.json`)
                .then(res => res.json())
                .then(name => {
                    if (name) {
                        document.querySelectorAll('.pet-name').forEach(el => el.textContent = name);
                    }
                });
        }

        // ===== KONSTANTA & VARIABEL =====
        const FONT = { family: 'Poppins', size: 11 };
        const COLORS = {
            primary: '#d4883e', primaryLight: '#f0c28a',
            accent: '#5bb88a', warning: '#e8b83d',
            danger: '#d45a5a', info: '#5b9bd4',
            text: '#3d3529', muted: '#8c7e6a', grid: '#e8e0d4'
        };
        Chart.defaults.font.family = 'Poppins';
        Chart.defaults.color = COLORS.muted;

        let consumptionChart, typeChart, weeklyChart;
        let allHistory = [];
        let currentPeriod = 'week';

        function makeGradient(ctx, color1, color2, h = 280) {
            const g = ctx.createLinearGradient(0, 0, 0, h);
            g.addColorStop(0, color1);
            g.addColorStop(1, color2);
            return g;
        }

        // ===== HELPER WAKTU WIB =====
        function getWIB(ts) {
            return new Date(ts + 7 * 3600000);
        }
        function getWIBNow() {
            return new Date(Date.now() + 7 * 3600000);
        }
        function getWIBDateStr(ts) {
            return getWIB(ts).toISOString().slice(0, 10);
        }
        function getWeekStart(date) {
            const d = new Date(date);
            const day = d.getUTCDay() || 7;
            d.setUTCDate(d.getUTCDate() - (day - 1));
            d.setUTCHours(0, 0, 0, 0);
            return d;
        }
        function getMonthStart(date) {
            return new Date(Date.UTC(date.getUTCFullYear(), date.getUTCMonth(), 1));
        }

        // ===== FILTER DATA BY PERIOD =====
        function filterByPeriod(entries, period) {
            const now = getWIBNow();
            if (period === 'day') {
                const todayStr = now.toISOString().slice(0, 10);
                return entries.filter(e => e.timestamp && getWIBDateStr(e.timestamp) === todayStr);
            } else if (period === 'week') {
                const weekStart = getWeekStart(now);
                return entries.filter(e => e.timestamp && getWIB(e.timestamp) >= weekStart);
            } else {
                const monthStart = getMonthStart(now);
                return entries.filter(e => e.timestamp && getWIB(e.timestamp) >= monthStart);
            }
        }

        // ===== UPDATE SEMUA UI =====
        function updateAll(period) {
            currentPeriod = period;
            const filtered = filterByPeriod(allHistory, period);

            updateStats(filtered, period);
            updateConsumptionChart(filtered, period);
            updateWeeklyChart(filtered, period);
            updateTypeChart(filtered);
            updateTopTimes(filtered);
            updateHistoryTable(filtered);
        }

        // ===== 1. STATS =====
        function updateStats(entries, period) {
            const totalFeeding = entries.length;
            const totalGram = entries.reduce((s, e) => s + (e.portion || 0), 0);

            let days = 1;
            if (period === 'week') days = 7;
            else if (period === 'month') days = 30;
            const avgDaily = days > 0 ? Math.round(totalGram / days) : totalGram;

            const successCount = entries.filter(e => e.status === 'success').length;
            const successRate = totalFeeding > 0 ? Math.round((successCount / totalFeeding) * 100) : 100;

            const formatGram = (g) => g >= 1000 ? (g / 1000).toFixed(2) + 'kg' : g + 'g';

            document.getElementById('statFeeding').textContent = totalFeeding;
            document.getElementById('statConsumed').textContent = formatGram(totalGram);
            document.getElementById('statAvg').textContent = avgDaily + 'g';
            document.getElementById('statSuccess').textContent = successRate + '%';

            document.querySelectorAll('.stat-value').forEach(el => {
                el.style.animation = 'none'; void el.offsetWidth; el.style.animation = '';
            });

            function getPrevEntries(period) {
                const now = getWIBNow();
                if (period === 'day') {
                    const yesterday = new Date(now); yesterday.setUTCDate(yesterday.getUTCDate() - 1);
                    const yStr = yesterday.toISOString().slice(0, 10);
                    return allHistory.filter(e => e.timestamp && getWIBDateStr(e.timestamp) === yStr);
                } else if (period === 'week') {
                    const weekStart = getWeekStart(now);
                    const prevEnd = new Date(weekStart); prevEnd.setUTCMilliseconds(-1);
                    const prevStart = getWeekStart(prevEnd);
                    return allHistory.filter(e => e.timestamp && getWIB(e.timestamp) >= prevStart && getWIB(e.timestamp) <= prevEnd);
                } else {
                    const monthStart = getMonthStart(now);
                    const prevEnd = new Date(monthStart); prevEnd.setUTCMilliseconds(-1);
                    const prevStart = getMonthStart(prevEnd);
                    return allHistory.filter(e => e.timestamp && getWIB(e.timestamp) >= prevStart && getWIB(e.timestamp) <= prevEnd);
                }
            }

            const prev = getPrevEntries(period);
            const prevFeeding = prev.length;
            const prevGram = prev.reduce((s, e) => s + (e.portion || 0), 0);
            const prevDays = period === 'day' ? 1 : period === 'week' ? 7 : 30;
            const prevAvg = Math.round(prevGram / prevDays);
            const prevSuccess = prevFeeding > 0
                ? Math.round((prev.filter(e => e.status === 'success').length / prevFeeding) * 100)
                : 100;
            const periodLabel = period === 'day' ? 'kemarin' : period === 'week' ? 'minggu lalu' : 'bulan lalu';

            function setTrend(id, curr, prev, periodLabel) {
                const el = document.getElementById(id);
                if (!el) return;
                if (prev === 0) {
                    el.className = 'stat-trend up';
                    el.textContent = 'belum ada data sebelumnya';
                    return;
                }
                const pct = Math.round(((curr - prev) / prev) * 100);
                el.className = `stat-trend ${pct >= 0 ? 'up' : 'down'}`;
                el.textContent = `${pct >= 0 ? '▲' : '▼'} ${Math.abs(pct)}% vs ${periodLabel}`;
            }

            setTrend('trendFeeding', totalFeeding, prevFeeding, periodLabel);
            setTrend('trendConsumed', totalGram, prevGram, periodLabel);
            setTrend('trendAvg', avgDaily, prevAvg, periodLabel);
            setTrend('trendSuccess', successRate, prevSuccess, periodLabel);
        }

        // ===== 2. CONSUMPTION CHART =====
        function updateConsumptionChart(entries, period) {
            let labels = [];
            let consumed = [];
            let target = [];

            if (period === 'day') {
                const hourMap = {};
                entries.forEach(e => {
                    const h = getWIB(e.timestamp).getUTCHours();
                    hourMap[h] = (hourMap[h] || 0) + (e.portion || 0);
                });
                for (let h = 0; h < 24; h += 3) {
                    labels.push(String(h).padStart(2, '0') + ':00');
                    let sum = 0;
                    for (let i = h; i < h + 3; i++) sum += hourMap[i] || 0;
                    consumed.push(sum);
                    target.push(30);
                }
            } else if (period === 'week') {
                const dayNames = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                const dayMap = {};
                entries.forEach(e => {
                    const d = getWIB(e.timestamp);
                    const dow = (d.getUTCDay() + 6) % 7;
                    dayMap[dow] = (dayMap[dow] || 0) + (e.portion || 0);
                });
                for (let i = 0; i < 7; i++) {
                    labels.push(dayNames[i]);
                    consumed.push(dayMap[i] || 0);
                    target.push(115);
                }
            } else {
                const weekMap = {};
                entries.forEach(e => {
                    const d = getWIB(e.timestamp);
                    const weekNum = Math.ceil(d.getUTCDate() / 7);
                    weekMap[weekNum] = (weekMap[weekNum] || 0) + (e.portion || 0);
                });
                for (let w = 1; w <= 4; w++) {
                    labels.push('Mg ' + w);
                    consumed.push(weekMap[w] || 0);
                    target.push(800);
                }
            }

            if (consumptionChart) consumptionChart.destroy();
            const ctx1 = document.getElementById('consumptionChart').getContext('2d');
            consumptionChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [
                        {
                            label: 'Konsumsi',
                            data: consumed,
                            backgroundColor: makeGradient(ctx1, COLORS.primary, COLORS.primaryLight),
                            borderRadius: 10, borderSkipped: false,
                            barThickness: 'flex', maxBarThickness: 36
                        },
                        {
                            label: 'Target',
                            data: target,
                            type: 'line',
                            borderColor: COLORS.accent,
                            backgroundColor: 'transparent',
                            borderWidth: 2,
                            borderDash: [6, 4],
                            tension: 0.35, pointRadius: 0, pointHoverRadius: 5,
                            pointBackgroundColor: COLORS.accent
                        }
                    ]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#fff', titleColor: COLORS.text, bodyColor: COLORS.text,
                            borderColor: COLORS.grid, borderWidth: 1, padding: 12, cornerRadius: 10,
                            titleFont: { weight: '700', family: 'Poppins' },
                            bodyFont: { family: 'Poppins' },
                            callbacks: { label: (c) => ` ${c.dataset.label}: ${c.parsed.y}g` }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { color: COLORS.grid, drawBorder: false }, ticks: { font: FONT } },
                        x: { grid: { display: false }, ticks: { font: FONT } }
                    }
                }
            });
        }

        // ===== 3. WEEKLY CHART (frekuensi) =====
        function updateWeeklyChart(entries, period) {
            let labels = [];
            let freqData = [];

            if (period === 'day') {
                const hourMap = {};
                entries.forEach(e => {
                    const h = getWIB(e.timestamp).getUTCHours();
                    hourMap[h] = (hourMap[h] || 0) + 1;
                });
                for (let h = 0; h < 24; h += 3) {
                    labels.push(String(h).padStart(2, '0'));
                    let sum = 0;
                    for (let i = h; i < h + 3; i++) sum += hourMap[i] || 0;
                    freqData.push(sum);
                }
            } else if (period === 'week') {
                const dayNames = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                const dayMap = {};
                entries.forEach(e => {
                    const dow = (getWIB(e.timestamp).getUTCDay() + 6) % 7;
                    dayMap[dow] = (dayMap[dow] || 0) + 1;
                });
                for (let i = 0; i < 7; i++) {
                    labels.push(dayNames[i]);
                    freqData.push(dayMap[i] || 0);
                }
            } else {
                const weekMap = {};
                entries.forEach(e => {
                    const w = Math.ceil(getWIB(e.timestamp).getUTCDate() / 7);
                    weekMap[w] = (weekMap[w] || 0) + 1;
                });
                for (let w = 1; w <= 4; w++) {
                    labels.push('Mg ' + w);
                    freqData.push(weekMap[w] || 0);
                }
            }

            if (weeklyChart) weeklyChart.destroy();
            const ctx3 = document.getElementById('weeklyChart').getContext('2d');
            const grad = ctx3.createLinearGradient(0, 0, 0, 220);
            grad.addColorStop(0, 'rgba(212,136,62,0.35)');
            grad.addColorStop(1, 'rgba(212,136,62,0)');
            weeklyChart = new Chart(ctx3, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'Frekuensi Feeding',
                        data: freqData,
                        borderColor: COLORS.primary,
                        backgroundColor: grad,
                        borderWidth: 3, tension: 0.4, fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: COLORS.primary,
                        pointBorderWidth: 2, pointRadius: 5, pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#fff', titleColor: COLORS.text, bodyColor: COLORS.text,
                            borderColor: COLORS.grid, borderWidth: 1, padding: 12, cornerRadius: 10,
                            callbacks: { label: (c) => ` ${c.parsed.y}x feeding` }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { color: COLORS.grid, drawBorder: false }, ticks: { font: FONT, stepSize: 1 } },
                        x: { grid: { display: false }, ticks: { font: FONT } }
                    }
                }
            });
        }

        // ===== 4. TYPE CHART (donut) =====
        function updateTypeChart(entries) {
            const autoCount = entries.filter(e => e.type === 'auto').length;
            const manualCount = entries.filter(e => e.type === 'manual').length;

            if (typeChart) typeChart.destroy();
            const ctx2 = document.getElementById('typeChart').getContext('2d');
            typeChart = new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: ['Otomatis', 'Manual'],
                    datasets: [{
                        data: [autoCount, manualCount],
                        backgroundColor: [COLORS.accent, COLORS.primary],
                        borderColor: '#faf8f4',
                        borderWidth: 4, hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '65%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { font: FONT, padding: 14, usePointStyle: true, pointStyle: 'circle' }
                        },
                        tooltip: {
                            backgroundColor: '#fff', titleColor: COLORS.text, bodyColor: COLORS.text,
                            borderColor: COLORS.grid, borderWidth: 1, padding: 12, cornerRadius: 10,
                            callbacks: { label: (c) => ` ${c.label}: ${c.parsed}x` }
                        }
                    }
                }
            });
        }

        // ===== 5. JAM MAKAN FAVORIT =====
        function updateTopTimes(entries) {
            const hourMap = {};
            entries.forEach(e => {
                if (!e.timestamp) return;
                const h = getWIB(e.timestamp).getUTCHours();
                const key = String(h).padStart(2, '0') + ':00';
                hourMap[key] = (hourMap[key] || 0) + 1;
            });

            entries.forEach(e => {
                if (e.timestamp) return;
                if (!e.time) return;
                const key = e.time.substring(0, 5);
                hourMap[key] = (hourMap[key] || 0) + 1;
            });

            const sorted = Object.entries(hourMap)
                .sort((a, b) => b[1] - a[1])
                .slice(0, 5);

            const rankClasses = ['gold', 'silver', 'bronze', '', ''];
            const list = document.querySelector('.top-list');
            list.innerHTML = '';

            if (sorted.length === 0) {
                list.innerHTML = '<div style="text-align:center;color:var(--text-muted);padding:20px;font-size:13px">Belum ada data</div>';
                return;
            }

            const mealNames = {
                '07:00': 'Sarapan pagi', '07:30': 'Sarapan pagi',
                '12:00': 'Makan siang', '12:30': 'Makan siang',
                '18:00': 'Makan malam', '18:30': 'Makan malam',
                '06:00': 'Sarapan pagi', '08:00': 'Sarapan pagi',
                '22:00': 'Snack malam', '15:00': 'Snack sore', '15:30': 'Snack sore'
            };

            sorted.forEach(([time, count], i) => {
                const rankClass = rankClasses[i] || '';
                const subLabel = mealNames[time] || 'Waktu makan';
                list.innerHTML += `
            <div class="top-item">
                <div class="top-rank ${rankClass}">${i + 1}</div>
                <div class="top-info">
                    <div class="label">${time}</div>
                    <div class="sub">${subLabel}</div>
                </div>
                <div class="top-value">${count}x</div>
            </div>
        `;
            });
        }

        // ===== 6. HISTORY TABLE =====
        function updateHistoryTable(entries) {
            const tbody = document.getElementById('historyBody');
            const sorted = [...entries].sort((a, b) => (b.timestamp || 0) - (a.timestamp || 0)).slice(0, 10);

            if (sorted.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:20px">Belum ada data di periode ini</td></tr>';
                return;
            }

            tbody.innerHTML = sorted.map(e => {
                const typeClass = e.type === 'manual' ? 'manual' : 'auto';
                const typeLabel = e.type === 'manual' ? 'Manual' : 'Otomatis';
                const statusClass = e.status === 'success' ? 'success' : 'warning';
                const statusLabel = e.status === 'success' ? '✓ Berhasil' : '⚠ Terlambat';

                let timeStr = e.time || '--:--';

                if (e.timestamp) {
                    const d = new Date(e.timestamp);

                    const dateStr =
                        String(d.getDate()).padStart(2, '0') + '/' +
                        String(d.getMonth() + 1).padStart(2, '0') + '/' +
                        d.getFullYear();

                    timeStr = `${e.time || '--:--'} | ${dateStr}`;
                }

                return `
            <tr class="fade-up">
                <td>${timeStr}</td>
                <td><span class="type-badge ${typeClass}">${typeLabel}</span></td>
                <td>${e.portion || 0}g</td>
                <td><span class="status-badge-tbl ${statusClass}">${statusLabel}</span></td>
                <td>${e.weightAfter != null ? e.weightAfter + 'g' : '-'}</td>
            </tr>
        `;
            }).join('');
        }

        // ===== EXPORT EXCEL =====
        window.exportData = function () {
            const filtered = filterByPeriod(allHistory, currentPeriod);
            const sorted = filtered.sort((a, b) => (b.timestamp || 0) - (a.timestamp || 0));

            const wsData = [['Waktu', 'Jenis', 'Porsi (g)', 'Status', 'Berat Setelah (g)']];

            sorted.forEach(e => {
                let timeStr = e.time || '';
                if (e.timestamp) {
                    const d = getWIB(e.timestamp);
                    timeStr = d.toISOString().slice(0, 10) + ' ' +
                        String(d.getUTCHours()).padStart(2, '0') + ':' +
                        String(d.getUTCMinutes()).padStart(2, '0');
                }
                wsData.push([
                    timeStr,
                    e.type === 'manual' ? 'Manual' : 'Otomatis',
                    e.portion || 0,
                    e.status === 'success' ? 'Berhasil' : 'Terlambat',
                    e.weightAfter ?? '-'
                ]);
            });

            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet(wsData);

            const colWidths = wsData[0].map((_, ci) => ({
                wch: Math.max(...wsData.map(row => String(row[ci] ?? '').length)) + 4
            }));
            ws['!cols'] = colWidths;

            const orange = 'FFD4883E';
            const orangeLight = 'FFFFF3E2';
            const white = 'FFFFFFFF';
            const textDark = 'FF3D3529';
            const accentGreen = 'FF5BB88A';
            const accentBg = 'FFE8F7EF';
            const borderColor = 'FFE8E0D4';

            const headerStyle = {
                font: { bold: true, color: { rgb: white }, name: 'Calibri', sz: 11 },
                fill: { fgColor: { rgb: orange } },
                alignment: { horizontal: 'center', vertical: 'center' },
                border: {
                    top: { style: 'thin', color: { rgb: orange } },
                    bottom: { style: 'thin', color: { rgb: orange } },
                    left: { style: 'thin', color: { rgb: orange } },
                    right: { style: 'thin', color: { rgb: orange } }
                }
            };

            const rowStyleEven = {
                font: { color: { rgb: textDark }, name: 'Calibri', sz: 11 },
                fill: { fgColor: { rgb: white } },
                alignment: { horizontal: 'center', vertical: 'center' },
                border: {
                    top: { style: 'thin', color: { rgb: borderColor } },
                    bottom: { style: 'thin', color: { rgb: borderColor } },
                    left: { style: 'thin', color: { rgb: borderColor } },
                    right: { style: 'thin', color: { rgb: borderColor } }
                }
            };

            const rowStyleOdd = { ...rowStyleEven, fill: { fgColor: { rgb: orangeLight } } };

            const cols = ['A', 'B', 'C', 'D', 'E'];
            const totalRows = wsData.length;

            cols.forEach(col => {
                const cell = ws[`${col}1`];
                if (cell) cell.s = headerStyle;
            });

            for (let r = 2; r <= totalRows; r++) {
                const style = r % 2 === 0 ? rowStyleEven : rowStyleOdd;
                cols.forEach(col => {
                    const cell = ws[`${col}${r}`];
                    if (cell) cell.s = style;
                });

                const statusCell = ws[`D${r}`];
                if (statusCell) {
                    const isSuccess = statusCell.v === 'Berhasil';
                    statusCell.s = {
                        ...style,
                        font: { bold: true, color: { rgb: isSuccess ? accentGreen : 'FFD45A5A' }, name: 'Calibri', sz: 11 },
                        fill: { fgColor: { rgb: isSuccess ? accentBg : 'FFFDE8E8' } }
                    };
                }

                const jenisCell = ws[`B${r}`];
                if (jenisCell) {
                    const isAuto = jenisCell.v === 'Otomatis';
                    jenisCell.s = {
                        ...style,
                        font: { bold: true, color: { rgb: isAuto ? accentGreen : orange }, name: 'Calibri', sz: 11 }
                    };
                }
            }

            ws['!rows'] = Array(totalRows).fill(null).map((_, i) => ({ hpt: i === 0 ? 22 : 18 }));

            XLSX.utils.book_append_sheet(wb, ws, 'Riwayat Feeding');
            XLSX.writeFile(wb, `pawfeeder-${currentPeriod}-${getWIBNow().toISOString().slice(0, 10)}.xlsx`);
        }

        // ===== PERIOD SWITCH =====
        document.querySelectorAll('.period-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                updateAll(btn.dataset.period);
            });
        });

        // ===== FIREBASE LISTENER =====
        if (uid) {
            onValue(ref(db, `users/${uid}/history`), (snapshot) => {
                const data = snapshot.val();
                allHistory = data ? Object.values(data) : [];
                updateAll(currentPeriod);
            });
        } else {
            updateAll(currentPeriod);
        }

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
            window._toastTimer = setTimeout(() => toast.classList.remove('show'), 2200);
        }

        // ===== SIDEBAR MOBILE =====
        window.toggleSidebar = function () {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('open');
        }
    </script>

</body>

</html>