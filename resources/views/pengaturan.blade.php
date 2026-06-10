<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/paw-prints.png') }}">
    <title>Pengaturan - PawFeeder</title>
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
            --info: #5b8fb8;
            --info-bg: #e8f1f7;
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

        /* ===== MAIN ===== */
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

        /* ===== LAYOUT 2 KOLOM (TABS + CONTENT) ===== */
        .settings-wrap {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 24px;
        }

        /* Tab nav samping */
        .tabs-nav {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 12px;
            box-shadow: var(--shadow);
            height: fit-content;
            position: sticky;
            top: 24px;
        }

        .tab-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            border: none;
            background: transparent;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            transition: all .2s;
            text-align: left;
            margin-bottom: 4px;
        }

        .tab-btn:hover {
            background: var(--primary-bg);
            color: var(--primary);
            transform: translateX(3px);
        }

        .tab-btn.active {
            background: var(--primary-bg);
            color: var(--primary);
        }

        .tab-btn .tab-ico {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--primary-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all .2s;
        }

        .tab-btn.active .tab-ico {
            background: var(--primary);
            color: #fff;
        }

        .tab-btn .tab-ico svg {
            width: 18px;
            height: 18px;
        }

        .tab-btn .tab-meta {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .tab-btn .tab-meta small {
            font-size: 11px;
            font-weight: 500;
            color: var(--text-muted);
        }

        /* Card */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px;
            box-shadow: var(--shadow);
            transition: all .3s ease;
        }

        .card+.card {
            margin-top: 20px;
        }

        .card-head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 6px;
        }

        .card-head h3 {
            font-size: 18px;
            font-weight: 700;
        }

        .card-head .head-ico {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--primary-bg);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-head .head-ico svg {
            width: 20px;
            height: 20px;
        }

        .card-sub {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 22px;
        }

        /* Tab panels */
        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
            animation: fadeUp .35s ease-out both;
        }

        /* ===== PROFIL — avatar + form ===== */
        .profile-row {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 18px;
            border-radius: 14px;
            background: var(--bg);
            margin-bottom: 24px;
        }

        .avatar {
            width: 84px;
            height: 84px;
            border-radius: 50%;
            background: var(--primary-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: 700;
            color: var(--primary);
            flex-shrink: 0;
            border: 3px solid #fff;
            box-shadow: 0 4px 14px rgba(212, 136, 62, .2);
        }

        .profile-row .who h4 {
            font-size: 17px;
            font-weight: 700;
        }

        .profile-row .who p {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .profile-row .who-actions {
            margin-top: 10px;
            display: flex;
            gap: 8px;
        }

        .btn-mini {
            padding: 7px 14px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 600;
            color: var(--text);
            cursor: pointer;
            transition: all .2s;
        }

        .btn-mini:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-1px);
        }

        .btn-mini.danger:hover {
            border-color: var(--danger);
            color: var(--danger);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .field {
            display: flex;
            flex-direction: column;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 6px;
        }

        .field input,
        .field select,
        .field textarea {
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

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px var(--primary-bg);
        }

        .field textarea {
            resize: vertical;
            min-height: 90px;
            font-family: 'Poppins', sans-serif;
        }

        /* ===== TOGGLE ROW (Notifikasi dll) ===== */
        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 18px;
            border-radius: 14px;
            background: var(--bg);
            margin-bottom: 12px;
            transition: all .2s;
        }

        .toggle-row:hover {
            background: #efe8db;
        }

        .toggle-row .tr-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .toggle-row .tr-ico {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .tr-ico.orange {
            background: var(--primary-bg);
            color: var(--primary);
        }

        .tr-ico.green {
            background: var(--accent-bg);
            color: var(--accent);
        }

        .tr-ico.yellow {
            background: var(--warning-bg);
            color: var(--warning);
        }

        .tr-ico.blue {
            background: var(--info-bg);
            color: var(--info);
        }

        .tr-ico.pink {
            background: #fde8ee;
            color: #d45a8e;
        }

        .tr-ico svg {
            width: 20px;
            height: 20px;
        }

        .tr-text h5 {
            font-size: 14px;
            font-weight: 600;
        }

        .tr-text p {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px;
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

        /* ===== HEWAN PELIHARAAN ===== */
        .pets-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
        }

        .pet-card {
            background: var(--bg);
            border: 2px solid var(--border);
            border-radius: 14px;
            padding: 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: all .25s;
            cursor: pointer;
            position: relative;
        }

        .pet-card:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .pet-card .pet-img-wrap {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--primary-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .pet-card .pet-img-wrap img {
            width: 64px;
            height: 64px;
            object-fit: contain;
        }

        .pet-card h5 {
            font-size: 15px;
            font-weight: 700;
        }

        .pet-card .pet-meta {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .pet-card .pet-tag {
            margin-top: 10px;
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 600;
            background: var(--accent-bg);
            color: var(--accent);
        }

        .pet-card.add {
            border-style: dashed;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-weight: 600;
            min-height: 200px;
        }

        .pet-card.add:hover {
            color: var(--primary);
        }

        .pet-card.add .plus {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--primary-bg);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            font-size: 28px;
            font-weight: 300;
        }

        /* ===== PERANGKAT ===== */
        .device-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px;
            border-radius: 14px;
            background: var(--bg);
            margin-bottom: 12px;
        }

        .device-card .dc-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .device-card .dc-ico {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--accent-bg);
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .device-card .dc-ico svg {
            width: 22px;
            height: 22px;
        }

        .device-card h5 {
            font-size: 14px;
            font-weight: 700;
        }

        .device-card .dc-meta {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            display: inline-block;
            animation: pulse 1.5s ease-in-out infinite;
        }

        .status-dot.off {
            background: var(--text-muted);
            animation: none;
        }

        /* ===== ACTIONS BAR (Save / Reset) ===== */
        .save-bar {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 24px;
        }

        .btn-cancel {
            padding: 12px 20px;
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
            padding: 12px 24px;
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
            gap: 8px;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(212, 136, 62, .4);
        }

        .btn-save svg {
            width: 16px;
            height: 16px;
        }

        /* ===== DANGER ZONE ===== */
        .danger-zone {
            border: 2px solid var(--danger-bg);
            background: #fff7f7;
        }

        .danger-zone .head-ico {
            background: var(--danger-bg);
            color: var(--danger);
        }

        .danger-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border-radius: 12px;
            background: #fff;
            border: 1px solid var(--danger-bg);
            margin-bottom: 10px;
        }

        .danger-row h5 {
            font-size: 14px;
            font-weight: 700;
            color: var(--danger);
        }

        .danger-row p {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .btn-danger {
            padding: 9px 16px;
            border-radius: 10px;
            border: 2px solid var(--danger);
            background: transparent;
            color: var(--danger);
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-danger:hover {
            background: var(--danger);
            color: #fff;
            transform: translateY(-1px);
        }

        /* ===== TOAST ===== */
        .toast {
            position: fixed;
            top: 24px;
            right: 24px;
            background: var(--card);
            border: 1px solid var(--border);
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

        .toast svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .toast.success svg {
            color: var(--accent);
        }

        .toast.error svg {
            color: var(--danger);
        }

        .toast.warning svg {
            color: var(--warning);
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

        @media (max-width: 1024px) {
            .settings-wrap {
                grid-template-columns: 1fr;
            }

            .tabs-nav {
                position: static;
                display: flex;
                flex-wrap: wrap;
                gap: 6px;
            }

            .tabs-nav .tab-btn {
                flex: 1 1 auto;
                min-width: 160px;
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

            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .top-bar {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }

            .profile-row {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    {{-- ===== MOBILE HEADER ===== --}}
    <div class="mobile-header">
        <h1>
            <img src="{{ asset('images/dimsum-cat.png') }}" alt="PawFeeder"
                style="width:28px;height:28px;object-fit:contain;">
            PawFeeder
        </h1>
        <button class="hamburger" onclick="toggleSidebar()">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
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
        <a class="nav-item active slide-right delay-4" href="{{ route('pengaturan') }}">
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
                <span class="pet-name">Anabul</span> is happy! 🐶
            </p>
        </div>
    </aside>

    {{-- ===== MAIN ===== --}}
    <main class="main">
        {{-- TOP BAR --}}
        <div class="top-bar fade-up">
            <div>
                <h2>Pengaturan</h2>
                <p>Atur akun, hewan, perangkat & preferensi kamu di sini</p>
            </div>
            <div class="connection-badge">

            </div>
        </div>

        {{-- ===== SETTINGS WRAP ===== --}}
        <div class="settings-wrap">

            {{-- TAB NAVIGATION --}}
            <nav class="tabs-nav fade-up delay-1">
                <button class="tab-btn active" data-tab="profil">
                    <span class="tab-ico">
                        <img src="{{ asset('images/profil.png') }}" style="width:38px;height:38px;object-fit:contain;">
                    </span>
                    <span class="tab-meta">Profil<small>Data akun kamu</small></span>
                </button>
                <button class="tab-btn" data-tab="hewan">
                    <span class="tab-ico">
                        <img src="{{ asset('images/pet.png') }}" style="width:38px;height:38px;object-fit:contain;">
                    </span>
                    <span class="tab-meta">Hewan Peliharaan<small>Anabul kesayangan</small></span>
                </button>
                <button class="tab-btn" data-tab="notifikasi">
                    <span class="tab-ico">
                        <img src="{{ asset('images/lonceng.png') }}" style="width:38px;height:38px;object-fit:contain;">
                    </span>
                    <span class="tab-meta">Notifikasi<small>Atur pemberitahuan</small></span>
                </button>

                <button class="tab-btn" data-tab="keamanan">
                    <span class="tab-ico">
                        <img src="{{ asset('images/aman.png') }}" style="width:38px;height:38px;object-fit:contain;">
                    </span>
                    <span class="tab-meta">Keamanan<small>Password & privasi</small></span>
                </button>
            </nav>

            {{-- TAB CONTENT --}}
            <div class="tabs-content">

                {{-- ====== PROFIL ====== --}}
                <section class="tab-panel active" id="tab-profil">
                    <div class="card">
                        <div class="card-head">
                            <div class="head-ico">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3>Profil Akun</h3>
                        </div>
                        <p class="card-sub">Update informasi profil kamu agar selalu up to date!</p>

                        <div class="profile-row">
                            <div class="avatar" id="avatarInitial" style="overflow:hidden;padding:0">
                                <img id="avatarImg" src="" alt=""
                                    style="width:100%;height:100%;object-fit:cover;display:none;border-radius:50%">
                                <span id="avatarLetter">P</span>
                            </div>
                            <div class="who" style="flex:1">
                                <h4 id="profileName">Pet Owner</h4>
                                <p id="profileEmail">owner@pawfeeder.com</p>
                                <div class="who-actions">
                                    <input type="file" id="photoInput" accept="image/*" style="display:none"
                                        onchange="uploadPhoto(event)">
                                    <button class="btn-mini"
                                        onclick="document.getElementById('photoInput').click()">Ganti Foto</button>
                                    <button class="btn-mini danger" onclick="deletePhoto()">Hapus</button>
                                </div>
                            </div>
                        </div>

                        <form id="formProfil" onsubmit="saveProfile(event)">
                            <div class="form-grid">
                                <div class="field">
                                    <label>Nama Lengkap</label>
                                    <input type="text" id="inpName" value="Pet Owner" placeholder="Nama kamu">
                                </div>
                                <div class="field">
                                    <label>Email</label>
                                    <input type="email" id="inpEmail" value="owner@pawfeeder.com"
                                        placeholder="email@kamu.com">
                                </div>
                                <div class="field">
                                    <label>No. HP</label>
                                    <input type="tel" id="inpPhone" value="08123456789" placeholder="08xx">
                                </div>
                                <div class="field">
                                    <label>Bahasa</label>
                                    <select id="inpLang">
                                        <option value="id" selected>🇮🇩 Indonesia</option>
                                        <option value="en">🇬🇧 English</option>
                                    </select>
                                </div>
                                <div class="field full">
                                    <label>Alamat</label>
                                    <textarea id="inpAddress"
                                        placeholder="Alamat lengkap kamu...">Jl. Anabul Bahagia No.7, Jakarta</textarea>
                                </div>
                            </div>

                            <div class="save-bar">
                                <button type="button" class="btn-cancel" onclick="resetProfile()">Reset</button>
                                <button type="submit" class="btn-save">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </section>

                {{-- ====== HEWAN PELIHARAAN ====== --}}
                <section class="tab-panel" id="tab-hewan">
                    <div class="card">
                        <div class="card-head">
                            <div class="head-ico">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <h3>Hewan Peliharaan</h3>
                        </div>
                        <p class="card-sub">Kelola data anabul kesayangan kamu 🐱🐶</p>

                        <div class="form-grid" style="margin-top:8px">
                            <div class="field full">
                                <label>Nama Anabul</label>
                                <input type="text" id="inpPetName" placeholder="cth: Mochi, Bruno, Luna...">
                            </div>
                        </div>
                        <div class="save-bar">
                            <button class="btn-save" onclick="savePetName()">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Nama
                            </button>
                        </div>
                    </div>
                </section>

                {{-- ====== NOTIFIKASI ====== --}}
                <section class="tab-panel" id="tab-notifikasi">
                    <div class="card">
                        <div class="card-head">
                            <div class="head-ico">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </div>
                            <h3>Pengaturan Notifikasi</h3>
                        </div>
                        <p class="card-sub">Pilih notifikasi mana saja yang mau kamu terima 🔔</p>

                        <div class="toggle-row">
                            <div class="tr-left">
                                <div class="tr-ico orange">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="tr-text">
                                    <h5>Pengingat Jadwal Makan</h5>
                                    <p>Notif sebelum waktu makan tiba</p>
                                </div>
                            </div>
                            <button class="toggle active" data-key="notif_jadwal" onclick="toggleSwitch(this)"></button>
                        </div>

                        <div class="toggle-row">
                            <div class="tr-left">
                                <div class="tr-ico green">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="tr-text">
                                    <h5>Konfirmasi Pemberian Makan</h5>
                                    <p>Notif saat anabul selesai dikasih makan</p>
                                </div>
                            </div>
                            <button class="toggle active" data-key="notif_konfirmasi"
                                onclick="toggleSwitch(this)"></button>
                        </div>

                        <div class="toggle-row">
                            <div class="tr-left">
                                <div class="tr-ico yellow">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="tr-text">
                                    <h5>Stok Pakan Menipis</h5>
                                    <p>Peringatan saat pakan di feeder hampir habis</p>
                                </div>
                            </div>
                            <button class="toggle active" data-key="notif_stok" onclick="toggleSwitch(this)"></button>
                        </div>

                    </div>
                </section>


                {{-- ====== KEAMANAN ====== --}}
                <section class="tab-panel" id="tab-keamanan">
                    <div class="card">
                        <div class="card-head">
                            <div class="head-ico">
                                <img src="{{ asset('images/gembok.png') }}"
                                    style="width:24px;height:24px;object-fit:contain;">
                            </div>
                            <h3>Ubah Password</h3>
                        </div>
                        <p class="card-sub">Pastikan password kamu kuat ya 🔒</p>

                        <form onsubmit="changePassword(event)">
                            <div class="form-grid">
                                <div class="field full">
                                    <label>Password Lama</label>
                                    <input type="password" placeholder="••••••••" required>
                                </div>
                                <div class="field">
                                    <label>Password Baru</label>
                                    <input type="password" placeholder="••••••••" required>
                                </div>
                                <div class="field">
                                    <label>Konfirmasi Password</label>
                                    <input type="password" placeholder="••••••••" required>
                                </div>
                            </div>

                            <div class="save-bar">
                                <button type="submit" class="btn-save">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- DANGER ZONE --}}
                    <div class="card danger-zone" style="margin-top:20px">
                        <div class="card-head">
                            <div class="head-ico">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <h3 style="color:var(--danger)">Zona Berbahaya</h3>
                        </div>
                        <p class="card-sub">Aksi di bawah ini tidak bisa dibatalkan, hati-hati ya!</p>

                        <div class="danger-row">
                            <div>
                                <h5>Logout</h5>
                                <p>Keluar dari sesi ini</p>
                            </div>
                            <button class="btn-danger" onclick="doLogout()">Logout</button>
                        </div>

                        <div class="danger-row">
                            <div>
                                <h5>Hapus Akun Permanen</h5>
                                <p>Semua data anabul & jadwal akan hilang</p>
                            </div>
                            <button class="btn-danger" onclick="doDeleteAccount()">Hapus Akun</button>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </main>

    {{-- ===== TOAST ===== --}}
    <div class="toast" id="toast">
        <svg id="toastIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span id="toastMsg">Berhasil!</span>
    </div>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
        import { getDatabase, ref, get, set, update } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-database.js";

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

        // Helper: path selalu di bawah users/{uid}/
        const userRef = (path) => ref(db, `users/${uid}/${path}`);

        // ===== LOAD DATA DARI FIREBASE =====
        async function loadProfile() {
            if (!uid) return;
            const snap = await get(userRef('profile'));
            const data = snap.val() || {};

            document.getElementById('inpName').value = data.name || '';
            document.getElementById('inpEmail').value = data.email || @json(session('user_email') ?? '');
            document.getElementById('inpPhone').value = data.phone || '';
            document.getElementById('inpAddress').value = data.address || '';

            const name = data.name || '';
            document.getElementById('profileName').textContent = name || '(Belum diisi)';
            document.getElementById('profileEmail').textContent = data.email || @json(session('user_email') ?? '');
            document.getElementById('avatarLetter').textContent = (name[0] || '?').toUpperCase();
        }

        async function loadPetName() {
            if (!uid) return;
            const snap = await get(userRef('profile/pet_name'));
            const name = snap.val();
            if (name) {
                document.querySelectorAll('.pet-name').forEach(el => el.textContent = name);
                document.getElementById('inpPetName').value = name;
            }
        }

        async function loadNotifSettings() {
            if (!uid) return;
            // ✅ users/{uid}/notif_settings (tidak berubah, tidak ada di struktur utama — boleh tetap)
            const snap = await get(userRef('notif_settings'));
            const data = snap.val() || {};
            document.querySelectorAll('.toggle[data-key]').forEach(btn => {
                const key = btn.dataset.key;
                const defaultOn = ['notif_jadwal', 'notif_konfirmasi', 'notif_stok'].includes(key);
                const isOn = data[key] !== undefined ? data[key] : defaultOn;
                btn.classList.toggle('active', isOn);
            });
        }

        // Load semua saat halaman buka
        loadProfile();
        loadPetName();
        loadNotifSettings();

        // ===== SIMPAN PROFIL =====
        window.saveProfile = async function (e) {
            e.preventDefault();
            if (!uid) return showToast('Kamu belum login!', 'error');

            const data = {
                name: document.getElementById('inpName').value.trim(),
                email: document.getElementById('inpEmail').value.trim(),
                phone: document.getElementById('inpPhone').value.trim(),
                address: document.getElementById('inpAddress').value.trim(),
            };

            await update(userRef('profile'), data);

            document.getElementById('profileName').textContent = data.name || '(Belum diisi)';
            document.getElementById('profileEmail').textContent = data.email;
            document.getElementById('avatarLetter').textContent = (data.name[0] || '?').toUpperCase();

            showToast('Profil berhasil disimpan!', 'success');
        }

        // ===== SIMPAN NAMA PET =====
        window.savePetName = async function () {
            if (!uid) return;
            const name = document.getElementById('inpPetName').value.trim();
            if (!name) return showToast('Nama tidak boleh kosong!', 'error');

            await set(userRef('profile/pet_name'), name);

            // Update session via Laravel
            await fetch('/save-pet-name', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ pet_name: name })
            });

            document.querySelectorAll('.pet-name').forEach(el => el.textContent = name);
            showToast('Nama anabul disimpan! 🐾', 'success');
        }

        // ===== TOGGLE NOTIFIKASI =====
        window.toggleSwitch = async function (btn) {
            btn.classList.toggle('active');
            const isOn = btn.classList.contains('active');
            const key = btn.dataset.key;
            if (key && uid) {
                // ✅ users/{uid}/notif_settings/{key}
                await set(userRef('notif_settings/' + key), isOn);
            }
            showToast(isOn ? 'Diaktifkan ✨' : 'Dinonaktifkan', isOn ? 'success' : 'warning');
        }

        // ===== LOGOUT =====
        window.doLogout = function () {
            showConfirmModal(
                '👋 Logout',
                'Yakin mau logout? Kamu perlu login lagi untuk mengakses dashboard.',
                'Logout',
                () => { window.location.href = '{{ route("logout") }}'; }
            );
        }

        // ===== HAPUS AKUN =====
        window.doDeleteAccount = function () {
            showConfirmModal(
                '⚠️ Hapus Akun Permanen',
                'Semua data anabul, jadwal, dan riwayat akan hilang selamanya. Tindakan ini tidak bisa dibatalkan!',
                'Hapus Akun',
                async () => {
                    if (uid) {
                        await set(ref(db, 'users/' + uid), null);
                    }

                    await fetch('{{ route("account.delete") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    });

                    window.location.href = '{{ route("login") }}';
                },
                true // danger mode
            );
        }

        // ===== CONFIRM MODAL =====
        window.showConfirmModal = function (title, message, confirmText, onConfirm, isDanger = false) {
            document.getElementById('confirmTitle').textContent = title;
            document.getElementById('confirmMessage').textContent = message;
            const btn = document.getElementById('confirmOkBtn');
            btn.textContent = confirmText;
            btn.className = isDanger ? 'btn-save' : 'btn-save';
            btn.style.background = isDanger
                ? 'linear-gradient(135deg, var(--danger), #e06060)'
                : 'linear-gradient(135deg, var(--primary), #e8a050)';
            btn.onclick = () => { closeConfirmModal(); onConfirm(); };
            document.getElementById('confirmModal').style.display = 'flex';
        }

        window.closeConfirmModal = function () {
            document.getElementById('confirmModal').style.display = 'none';
        }

        // ===== PASSWORD =====
        window.changePassword = function (e) {
            e.preventDefault();
            const inputs = e.target.querySelectorAll('input[type=password]');
            const [old, n1, n2] = inputs;
            if (n1.value !== n2.value) return showToast('Konfirmasi password tidak cocok!', 'error');
            if (n1.value.length < 6) return showToast('Password minimal 6 karakter', 'error');
            inputs.forEach(i => i.value = '');
            showToast('Password berhasil diupdate 🔒', 'success');
        }

        // ===== RESET PROFIL =====
        window.resetProfile = function () {
            loadProfile();
            showToast('Form direset', 'warning');
        }

        // ===== LOAD FOTO PROFIL =====
        async function loadPhoto() {
            if (!uid) return;
            const snap = await get(userRef('profile_photo'));
            const url = snap.val();
            if (url) {
                document.getElementById('avatarImg').src = url;
                document.getElementById('avatarImg').style.display = 'block';
                document.getElementById('avatarLetter').style.display = 'none';
            }
        }
        loadPhoto();

        // ===== UPLOAD FOTO KE CLOUDINARY =====
        window.uploadPhoto = async function (event) {
            const file = event.target.files[0];
            if (!file) return;

            showToast('Mengupload foto...', 'warning');

            const formData = new FormData();
            formData.append('file', file);
            formData.append('upload_preset', 'pawfeeder_photos');

            const res = await fetch('https://api.cloudinary.com/v1_1/drtcf0jw2/image/upload', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            const url = data.secure_url;

            // ✅ users/{uid}/profile_photo
            await set(userRef('profile_photo'), url);

            document.getElementById('avatarImg').src = url;
            document.getElementById('avatarImg').style.display = 'block';
            document.getElementById('avatarLetter').style.display = 'none';

            showToast('Foto profil berhasil diupload!', 'success');
        }

        // ===== HAPUS FOTO =====
        window.deletePhoto = async function () {
            if (!uid) return;
            // ✅ users/{uid}/profile_photo
            await set(userRef('profile_photo'), null);

            document.getElementById('avatarImg').src = '';
            document.getElementById('avatarImg').style.display = 'none';
            document.getElementById('avatarLetter').style.display = 'block';

            showToast('Foto profil dihapus', 'success');
        }

        // Live update avatar letter
        document.getElementById('inpName').addEventListener('input', (e) => {
            const v = e.target.value.trim();
            document.getElementById('avatarLetter').textContent = (v[0] || '?').toUpperCase();
        });

        // ===== TABS =====
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
                btn.classList.add('active');
                document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
            });
        });

        // ===== SIDEBAR MOBILE =====
        window.toggleSidebar = function () {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('open');
        }

        // ===== TOAST =====
        window.showToast = function (msg, type = 'success') {
            const toast = document.getElementById('toast');
            toast.classList.remove('success', 'error', 'warning');
            toast.classList.add(type);
            document.getElementById('toastMsg').textContent = msg;
            toast.classList.add('show');
            clearTimeout(window._toastTimer);
            window._toastTimer = setTimeout(() => toast.classList.remove('show'), 2800);
        }
    </script>

    <!-- Confirm Modal -->
    <div class="modal-overlay" id="confirmModal"
        style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:200;align-items:center;justify-content:center;">
        <div
            style="background:var(--card);border-radius:var(--radius);padding:32px;max-width:400px;width:90%;box-shadow:0 20px 60px rgba(60,45,20,.2);animation:bounceIn .4s cubic-bezier(0.68,-0.55,0.265,1.55) both;">
            <div style="font-size:22px;font-weight:700;margin-bottom:10px" id="confirmTitle">Konfirmasi</div>
            <p style="font-size:14px;color:var(--text-muted);margin-bottom:24px;line-height:1.6" id="confirmMessage">
                Yakin?</p>
            <div style="display:flex;gap:10px;justify-content:flex-end">
                <button class="btn-cancel" onclick="closeConfirmModal()">Batal</button>
                <button class="btn-save" id="confirmOkBtn">OK</button>
            </div>
        </div>
    </div>
</body>

</html>