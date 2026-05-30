<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/paw-prints.png') }}">
    <title>Jadwal Makan - PawFeeder</title>
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
            /* << kotak putih */
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

        /* ===== ICON helpers ===== */
        .ico {
            width: 28px;
            height: 28px;
            object-fit: contain;
            display: block;
            -webkit-user-drag: none;
            user-select: none;
        }

        .ico-sm {
            width: 18px;
            height: 18px;
            object-fit: contain;
            display: inline-block;
            vertical-align: -3px;
            -webkit-user-drag: none;
            user-select: none;
        }

        .ico-md {
            width: 22px;
            height: 22px;
            object-fit: contain;
            display: inline-block;
            vertical-align: -5px;
            -webkit-user-drag: none;
            user-select: none;
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
            object-fit: cover;
            flex-shrink: 0;
        }

        .sidebar-logo h1 {
            font-size: 20px;
            font-weight: 700;
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

        .sidebar-pet {
            margin-top: auto;
            text-align: center;
            padding: 16px;
            background: var(--primary-bg);
            border-radius: 12px;
        }

        .sidebar-pet img {
            width: 64px;
            height: 64px;
            object-fit: contain;
            margin: 0 auto;
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
            gap: 16px;
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

        /* ===== CARDS (kotak putih) ===== */
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

        .stat-icon.pink {
            background: #fde8ee;
        }

        .stat-icon.no-bg {
            background: transparent;
        }

        .stat-icon img {
            width: 34px;
            height: 34px;
            object-fit: contain;
        }

        .stat-icon.no-bg img {
            width: 56px;
            height: 56px;
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

        .filter-tab img {
            width: 16px;
            height: 16px;
            object-fit: contain;
        }

        .add-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, var(--primary), #e8a050);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 4px 16px rgba(212, 136, 62, .3);
        }

        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 22px rgba(212, 136, 62, .4);
        }

        .add-btn svg {
            width: 18px;
            height: 18px;
        }

        /* ===== SCHEDULE GRID ===== */
        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
            gap: 20px;
        }

        .schedule-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 22px;
            box-shadow: var(--shadow);
            transition: all .3s ease;
            position: relative;
            overflow: hidden;
        }

        .schedule-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-3px);
        }

        .schedule-card.inactive {
            opacity: .55;
        }

        .sched-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 14px;
        }

        .sched-time {
            font-size: 32px;
            font-weight: 700;
            color: var(--text);
            line-height: 1;
        }

        .sched-name {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 4px;
            font-weight: 500;
        }

        .toggle {
            position: relative;
            width: 44px;
            height: 24px;
            background: #d4cfc6;
            border-radius: 100px;
            cursor: pointer;
            transition: background .3s;
            border: none;
            padding: 0;
            flex-shrink: 0;
        }

        .toggle.active {
            background: var(--accent);
        }

        .toggle::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #fff;
            top: 2px;
            left: 2px;
            transition: transform .3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 1px 4px rgba(0, 0, 0, .15);
        }

        .toggle.active::after {
            transform: translateX(20px);
        }

        .sched-info {
            background: var(--bg);
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 12px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .info-item {
            text-align: center;
        }

        .info-label {
            font-size: 10px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
            margin-top: 2px;
        }

        .sched-days {
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .day-badge {
            padding: 4px 10px;
            background: var(--primary-bg);
            color: var(--primary);
            border-radius: 100px;
            font-size: 11px;
            font-weight: 600;
        }

        .sched-actions {
            display: flex;
            gap: 8px;
        }

        .sched-btn {
            flex: 1;
            padding: 8px;
            border-radius: 10px;
            border: none;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .sched-btn.feed {
            background: var(--accent-bg);
            color: var(--accent);
        }

        .sched-btn.feed:hover {
            background: var(--accent);
            color: #fff;
        }

        .sched-btn.edit {
            background: var(--primary-bg);
            color: var(--primary);
        }

        .sched-btn.edit:hover {
            background: var(--primary);
            color: #fff;
        }

        .sched-btn.delete {
            background: var(--danger-bg);
            color: var(--danger);
            flex: 0 0 38px;
        }

        .sched-btn.delete:hover {
            background: var(--danger);
            color: #fff;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            grid-column: 1 / -1;
            background: var(--card);
            border: 2px dashed var(--border);
            border-radius: var(--radius);
            padding: 48px 24px;
            text-align: center;
        }

        .empty-state img {
            width: 72px;
            height: 72px;
            object-fit: contain;
            margin: 0 auto 12px;
            display: block;
        }

        .empty-state h3 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .empty-state p {
            font-size: 13px;
            color: var(--text-muted);
        }

        /* ===== MODAL ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .4);
            z-index: 200;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal {
            background: var(--card);
            border-radius: var(--radius);
            padding: 28px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 20px 60px rgba(60, 45, 20, .2);
            animation: bounceIn .4s cubic-bezier(0.68, -0.55, 0.265, 1.55) both;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-field {
            margin-bottom: 16px;
        }

        .modal-field label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            display: block;
            margin-bottom: 6px;
        }

        .modal-field input,
        .modal-field select {
            width: 100%;
            padding: 12px 16px;
            background: var(--bg);
            border: 2px solid var(--border);
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: var(--text);
            outline: none;
            transition: all .2s;
        }

        .modal-field input:focus,
        .modal-field select:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px var(--primary-bg);
        }

        .day-picker {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .day-pick {
            padding: 8px 14px;
            border-radius: 10px;
            background: var(--bg);
            border: 2px solid var(--border);
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            transition: all .2s;
            user-select: none;
        }

        .day-pick:hover {
            border-color: var(--primary-light);
        }

        .day-pick.active {
            background: var(--primary-bg);
            border-color: var(--primary);
            color: var(--primary);
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 24px;
        }

        .btn-cancel {
            flex: 1;
            padding: 12px;
            border-radius: 12px;
            border: 2px solid var(--border);
            background: transparent;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            transition: all .2s;
        }

        .btn-cancel:hover {
            border-color: var(--danger);
            color: var(--danger);
        }

        .btn-save {
            flex: 2;
            padding: 12px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, var(--primary), #e8a050);
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 4px 16px rgba(212, 136, 62, .3);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(212, 136, 62, .4);
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
        }

        .hamburger svg {
            width: 24px;
            height: 24px;
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

            .grid-4 {
                grid-template-columns: repeat(2, 1fr);
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

            .schedule-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    {{-- ===== MOBILE HEADER ===== --}}
    <div class="mobile-header">
        <button class="hamburger" onclick="toggleSidebar()" aria-label="Menu">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <h1><img src="{{ asset('images/paw-prints.png') }}" class="ico-md" alt=""> PawFeeder</h1>
        <span class="connection-badge"><span class="connection-dot"></span>Online</span>
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
        <a class="nav-item active slide-right delay-2" href="{{ route('jadwal') }}">
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
        <div class="top-bar fade-up">
            <div>
                <h2>Jadwal Makan</h2>
                <p>Atur jadwal makan otomatis yuk!</p>
            </div>
            <div class="top-bar-right">
                {{-- connection badge dihilangkan --}}
            </div>
        </div>

        {{-- STATS --}}
        <div class="grid-4">
            <div class="card stat-card bounce-in delay-1">
                <div class="stat-icon no-bg"><img src="{{ asset('images/jam.png') }}" alt="Dimsum Cat"></div>
                <div>
                    <div class="stat-value" id="statTotal">0</div>
                    <div class="stat-label">Total Jadwal</div>
                </div>
            </div>
            <div class="card stat-card bounce-in delay-2">
                <div class="stat-icon green"><img src="{{ asset('images/centang.png') }}" alt="Centang"></div>
                <div>
                    <div class="stat-value" id="statActive">0</div>
                    <div class="stat-label">Jadwal Aktif</div>
                </div>
            </div>
            <div class="card stat-card bounce-in delay-3">
                <div class="stat-icon yellow"><img src="{{ asset('images/piring.png') }}" alt="Piring"></div>
                <div>
                    <div class="stat-value" id="statPortion">0g</div>
                    <div class="stat-label">Porsi Harian</div>
                </div>
            </div>
            <div class="card stat-card bounce-in delay-4">
                <div class="stat-icon pink"><img src="{{ asset('images/paw-prints.png') }}" alt="Paw"></div>
                <div>
                    <div class="stat-value" id="statNext">--:--</div>
                    <div class="stat-label">Jadwal Berikutnya</div>
                </div>
            </div>
        </div>

        {{-- ACTION BAR --}}
        <div class="action-bar fade-up delay-2">
            <div class="filter-tabs">
                <button class="filter-tab active" data-filter="all">
                    <img src="{{ asset('images/paw-prints.png') }}" alt=""> Semua
                </button>
                <button class="filter-tab" data-filter="active">
                    <img src="{{ asset('images/centang.png') }}" alt=""> Aktif
                </button>
                <button class="filter-tab" data-filter="inactive">
                    <img src="{{ asset('images/jam.png') }}" alt=""> Nonaktif
                </button>
            </div>
            <button class="add-btn" onclick="openModal()">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Jadwal
            </button>
        </div>

        {{-- SCHEDULE GRID --}}
        <div class="schedule-grid" id="scheduleGrid">
            <div class="empty-state">
                <img src="{{ asset('images/jam.png') }}" alt="">
                <h3>Belum ada jadwal makan</h3>
                <p>Yuk tambahkan jadwal makan pertama untuk anabul kamu!</p>
            </div>
        </div>
    </main>

    {{-- ===== MODAL ===== --}}
    <div class="modal-overlay" id="modal">
        <div class="modal">
            <h3 class="modal-title">
                <img src="{{ asset('images/jam.png') }}" class="ico-md" alt=""> Tambah Jadwal Makan
            </h3>
            <form id="schedForm" onsubmit="saveSchedule(event)">
                <div class="modal-field">
                    <label>Nama Jadwal</label>
                    <input type="text" id="schedName" placeholder="Sarapan pagi" required>
                </div>
                <div class="modal-field">
                    <label>Jam</label>
                    <input type="time" id="schedTime" required>
                </div>
                <div class="modal-field">
                    <label>Porsi (gram)</label>
                    <input type="number" id="schedPortion" placeholder="30" min="1" required>
                </div>
                <div class="modal-field">
                    <label>Frekuensi</label>
                    <select id="schedFreq" required>
                        <option value="Setiap hari">Setiap hari</option>
                        <option value="Weekday">Weekday</option>
                        <option value="Weekend">Weekend</option>
                    </select>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn-save">💾 Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== TOAST ===== --}}
    <div class="toast" id="toast">
        <img src="{{ asset('images/centang.png') }}" id="toastIcon" style="width:44px;height:44px;object-fit:contain;"
            alt="">
        <span id="toastMsg">Berhasil!</span>
    </div>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
        import { getDatabase, ref, set, onValue, push, remove } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-database.js";

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
        if (!uid) { console.error('User belum login!'); }

        let currentFilter = 'all';
        let allSchedules = {};

        // ====== SIDEBAR ======
        window.toggleSidebar = function () {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('open');
        }

        // ====== MODAL ======
        window.openModal = function (editKey = null) {
            document.getElementById('modal').classList.add('open');
            document.getElementById('modal').dataset.editKey = editKey || '';
            if (editKey && allSchedules[editKey]) {
                const s = allSchedules[editKey];
                document.getElementById('schedName').value = s.name || '';
                document.getElementById('schedTime').value = s.time || '';
                document.getElementById('schedPortion').value = s.portion || '';
                document.getElementById('schedFreq').value = s.freq || 'Setiap hari';
                document.querySelector('.modal-title').innerHTML = `⏰ Edit Jadwal Makan`;
            } else {
                document.querySelector('.modal-title').innerHTML = `⏰ Tambah Jadwal Makan`;
            }
        }

        window.closeModal = function () {
            document.getElementById('modal').classList.remove('open');
            document.getElementById('schedForm').reset();
            document.getElementById('modal').dataset.editKey = '';
        }

        // ====== SAVE ======
        window.saveSchedule = function (e) {
            e.preventDefault();
            const name = document.getElementById('schedName').value.trim();
            const time = document.getElementById('schedTime').value;
            const portion = parseInt(document.getElementById('schedPortion').value);
            const freq = document.getElementById('schedFreq').value;

            if (!name || !time || !portion) {
                showToast('Semua field wajib diisi!', 'error');
                return;
            }

            const editKey = document.getElementById('modal').dataset.editKey;
            const key = editKey || 'slot_' + Date.now();

            set(ref(db, `users/${uid}/schedule/` + key), {
                name, time, portion, freq,
                active: editKey ? (allSchedules[editKey]?.active ?? true) : true
            }).then(() => {
                closeModal();
                showToast(editKey ? 'Jadwal diperbarui!' : 'Jadwal berhasil ditambahkan!');
            });
        }

        // ====== TOGGLE ======
        window.toggleActive = function (key, btn) {
            const newVal = !allSchedules[key]?.active;
            set(ref(db, `users/${uid}/schedule/` + key + '/active'), newVal);
        }

        // ====== DELETE ======
        window.deleteSchedule = function (key) {
            if (!confirm('Hapus jadwal ini?')) return;
            remove(ref(db, `users/${uid}/schedule/` + key))
                .then(() => showToast('Jadwal dihapus', 'warning'));
        }

        // ====== REALTIME LISTENER ======
        onValue(ref(db, `users/${uid}/schedule`), (snapshot) => {
            allSchedules = snapshot.val() || {};
            render();
        });

        // ====== FILTERS ======
        document.querySelectorAll('.filter-tab').forEach(t => {
            t.addEventListener('click', () => {
                document.querySelectorAll('.filter-tab').forEach(x => x.classList.remove('active'));
                t.classList.add('active');
                currentFilter = t.dataset.filter;
                render();
            });
        });

        // ====== RENDER ======
        function render() {
            const grid = document.getElementById('scheduleGrid');
            let entries = Object.entries(allSchedules).filter(([k, v]) => v.time);

            if (currentFilter === 'active') entries = entries.filter(([k, v]) => v.active);
            if (currentFilter === 'inactive') entries = entries.filter(([k, v]) => !v.active);

            // STATS
            const all = Object.values(allSchedules).filter(v => v.time);
            document.getElementById('statTotal').textContent = all.length;
            document.getElementById('statActive').textContent = all.filter(s => s.active).length;
            const totalPortion = all.filter(s => s.active).reduce((sum, s) => sum + Number(s.portion || 0), 0);
            document.getElementById('statPortion').textContent = totalPortion + 'g';

            const now = new Date(new Date().getTime() + 7 * 3600000);
            const nowMin = now.getUTCHours() * 60 + now.getUTCMinutes();
            const upcoming = all.filter(s => s.active && s.time)
                .map(s => { const [h, m] = s.time.split(':').map(Number); return { ...s, mins: h * 60 + m }; })
                .sort((a, b) => a.mins - b.mins);
            const next = upcoming.find(s => s.mins > nowMin) || upcoming[0];
            document.getElementById('statNext').textContent = next ? next.time : '--:--';

            if (!entries.length) {
                grid.innerHTML = `
            <div class="empty-state">
                <img src="{{ asset('images/jam.png') }}" alt="">
                <h3>Belum ada jadwal</h3>
                <p>Yuk tambahkan jadwal makan untuk anabul kamu!</p>
            </div>`;
                return;
            }

            grid.innerHTML = entries.map(([key, s]) => `
        <div class="schedule-card bounce-in ${s.active ? '' : 'inactive'}">
            <div class="sched-head">
                <div>
                    <div class="sched-time">${s.time}</div>
                    <div class="sched-name">${s.name || 'Jadwal'}</div>
                </div>
                <button class="toggle ${s.active ? 'active' : ''}" onclick="toggleActive('${key}', this)"></button>
            </div>
            <div class="sched-info">
                <div class="info-item">
                    <div class="info-label">Porsi</div>
                    <div class="info-value">${s.portion}g</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Frekuensi</div>
                    <div class="info-value">${s.freq || 'Setiap hari'}</div>
                </div>
            </div>
            <div class="sched-days">
                <span class="day-badge">${s.freq || 'Setiap hari'}</span>
            </div>
            <div class="sched-actions">
                <button class="sched-btn edit" onclick="openModal('${key}')">✏️ Edit</button>
                <button class="sched-btn delete" onclick="deleteSchedule('${key}')">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 7V4a2 2 0 012-2h2a2 2 0 012 2v3"/></svg>
                </button>
            </div>
        </div>
    `).join('');
        }

        // ====== TOAST ======
        window.showToast = function (msg, type = 'success') {
            const t = document.getElementById('toast');
            document.getElementById('toastMsg').textContent = msg;
            t.classList.remove('error', 'warning');
            if (type !== 'success') t.classList.add(type);
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 2800);
        }

        // ====== LOAD PET NAME ======
        const firebaseDbUrl = "https://pawfeeder-456a9-default-rtdb.asia-southeast1.firebasedatabase.app";

        if (uid) {
            fetch(`${firebaseDbUrl}/users/${uid}/profile/pet_name.json`)
                .then(res => res.json())
                .then(name => {
                    if (name) {
                        document.querySelectorAll('.pet-name').forEach(el => el.textContent = name);
                    }
                });
        }
    </script>
</body>

</html>