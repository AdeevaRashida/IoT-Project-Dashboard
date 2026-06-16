<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawFeeder Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/paw-prints.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            --card-hover: #8d8282;
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
            --border: #e8e0d4;
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

        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            font-style: normal;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* Reset semua elemen agar tidak bold/italic secara default */
        * {
            font-style: normal;
        }

        /* Hanya heading yang boleh bold */
        h1,
        h2,
        h3,
        .top-bar h2,
        .sidebar-logo h1 {
            font-weight: 700;
            font-style: normal;
        }

        /* Semua teks lain normal */
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
            font-style: normal;
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
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        @keyframes wiggle {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(-4deg);
            }

            75% {
                transform: rotate(4deg);
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideRight {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
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

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes gaugeNeedle {
            0% {
                transform: rotate(-90deg);
            }

            100% {
                transform: rotate(var(--needle-angle));
            }
        }

        .bounce-in {
            animation: bounceIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) both;
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }

        .wiggle {
            animation: wiggle 1s ease-in-out infinite;
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
        }

        .sidebar-pet img {
            width: 80px;
            height: 80px;
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
        }

        .connection-dot.pulse-soft {
            animation: pulse 1.5s ease-in-out infinite;
        }

        .greeting {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .greeting img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--primary-light);
        }

        /* ===== NOTIFICATION BANNER ===== */
        .notif-banner {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: var(--radius);
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
            transition: all .3s;
        }

        .notif-banner.success {
            background: var(--accent-bg);
            color: var(--accent);
            border: 1px solid #b5e3cc;
        }

        .notif-banner.warning {
            background: var(--warning-bg);
            color: #a07820;
            border: 1px solid #f0dfa0;
        }

        .notif-banner svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .notif-banner .close-btn {
            margin-left: auto;
            background: none;
            border: none;
            cursor: pointer;
            color: inherit;
            opacity: .5;
            font-size: 18px;
            transition: opacity .2s;
        }

        .notif-banner .close-btn:hover {
            opacity: 1;
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

        .card-title svg {
            width: 18px;
            height: 18px;
        }

        /* ===== GRID LAYOUT ===== */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .grid-2-1 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        /* ===== GAUGE (Semi-circle) ===== */
        .gauge-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .gauge-svg {
            width: 200px;
            height: 120px;
            overflow: visible;
        }

        .gauge-bg {
            fill: none;
            stroke: #e8e0d4;
            stroke-width: 14;
            stroke-linecap: round;
        }

        .gauge-fill {
            fill: none;
            stroke-width: 14;
            stroke-linecap: round;
            transition: stroke-dashoffset 1s ease, stroke 0.5s;
        }

        .gauge-needle {
            transform-origin: 100px 100px;
            transition: transform 1s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .gauge-center-dot {
            fill: var(--text);
        }

        .gauge-value {
            font-size: 32px;
            font-weight: 700;
            margin-top: 4px;
        }

        .gauge-label {
            font-size: 13px;
            color: var(--text-muted);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 8px;
        }

        .status-badge.safe {
            background: var(--accent-bg);
            color: var(--accent);
        }

        .status-badge.warning {
            background: var(--warning-bg);
            color: #a07820;
        }

        .status-badge.danger {
            background: var(--danger-bg);
            color: var(--danger);
        }

        /* ===== PROGRESS BAR ===== */
        .progress-bar-bg {
            width: 100%;
            height: 12px;
            background: #e8e0d4;
            border-radius: 100px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 100px;
            transition: width 1s ease, background .5s;
        }

        /* ===== FEED BUTTON ===== */
        .feed-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary), #e8a050);
            color: #fff;
            border: none;
            border-radius: var(--radius);
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 4px 20px rgba(212, 136, 62, 0.3);
        }

        .feed-btn:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 28px rgba(212, 136, 62, 0.4);
        }

        .feed-btn:active {
            transform: scale(0.97);
        }

        .feed-btn svg {
            width: 22px;
            height: 22px;
        }

        .feed-btn.feeding {
            background: linear-gradient(135deg, var(--accent), #3da86d);
            box-shadow: 0 4px 20px rgba(91, 184, 138, 0.3);
        }

        .portion-control {
            margin-top: 16px;
        }

        .portion-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .slider-container {
            position: relative;
        }

        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 8px;
            border-radius: 100px;
            background: #e8e0d4;
            outline: none;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--primary);
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(212, 136, 62, 0.3);
            transition: transform .2s;
        }

        .slider::-webkit-slider-thumb:hover {
            transform: scale(1.2);
        }

        .slider-value {
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            color: var(--primary);
            margin-top: 8px;
        }

        /* ===== SCHEDULE ===== */
        .schedule-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .schedule-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            background: var(--bg);
            transition: all .2s;
        }

        .schedule-item:hover {
            background: var(--primary-bg);
        }

        .schedule-time {
            font-size: 20px;
            font-weight: 700;
            min-width: 70px;
        }

        .schedule-info {
            flex: 1;
        }

        .schedule-info .label {
            font-size: 13px;
            font-weight: 500;
        }

        .schedule-info .sub {
            font-size: 11px;
            color: var(--text-muted);
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

        .add-schedule-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px;
            border-radius: 12px;
            border: 2px dashed var(--border);
            background: transparent;
            color: var(--text-muted);
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all .2s;
        }

        .add-schedule-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-bg);
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

        /* ===== CHART ===== */
        .chart-container {
            position: relative;
            height: 240px;
        }

        .chart-container canvas {
            width: 100% !important;
        }

        /* ===== PET DECORATIONS ===== */
        .pet-deco {
            position: fixed;
            z-index: 0;
            opacity: .08;
            pointer-events: none;
        }

        .pet-deco img {
            width: 150px;
            height: 150px;
        }

        .pet-deco.top-right {
            top: 40px;
            right: 40px;
        }

        .pet-deco.bottom-left {
            bottom: 40px;
            left: 300px;
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
        }

        /* ===== MODAL SCHEDULE ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .4);
            z-index: 200;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal {
            background: var(--card);
            border-radius: var(--radius);
            padding: 28px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 60px rgba(60, 45, 20, .2);
            animation: bounceIn .4s cubic-bezier(0.68, -0.55, 0.265, 1.55) both;
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

        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
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
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(212, 136, 62, .4);
        }

        .btn-delete {
            padding: 6px 10px;
            border-radius: 8px;
            border: none;
            background: var(--danger-bg);
            color: var(--danger);
            cursor: pointer;
            font-size: 14px;
            transition: all .2s;
        }

        .btn-delete:hover {
            background: var(--danger);
            color: #fff;
        }

        /* ===== DEVICE LOCK OVERLAY ===== */
        .device-lock-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(25, 23, 20, 0.9);
            /* Gelap untuk menutupi dashboard */
            backdrop-filter: blur(8px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .device-lock-card {
            background: #fff;
            padding: 32px;
            border-radius: 20px;
            text-align: center;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .device-lock-card .icon {
            font-size: 48px;
            margin-bottom: 12px;
        }

        .device-lock-card h3 {
            color: var(--text-dark);
            font-size: 22px;
            margin-bottom: 8px;
        }

        .device-lock-card p {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .device-lock-card input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 12px;
            outline: none;
            box-sizing: border-box;
        }

        .device-lock-card input:focus {
            border-color: var(--accent);
        }

        .device-lock-card button {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 14px 20px;
            border-radius: 12px;
            width: 100%;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .device-lock-card button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(212, 136, 62, 0.3);
        }
    </style>
</head>

<body>

    <!-- Mobile Header -->
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
            <img src="{{ asset('images/banana-cat.png') }}" alt="PawFeeder Logo">
            <div>
                <h1>PawFeeder</h1>
                <span>Smart Pet Feeder</span>
            </div>
        </div>

        <div class="nav-section">Menu</div>
        <a class="nav-item active slide-right delay-1" href="{{ route('dashboard') }}">
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
                <span class="pet-name">Mochi</span> is happy! 🐶
            </p>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main">
        <!-- Top Bar -->
        <div class="top-bar fade-up">
            <div>
                <h2>Dashboard</h2>
                <p style="font-size:13px;color:var(--text-muted);margin-top:2px" id="realtimeDateGreet">Loading...</p>
            </div>
            <div class="top-bar-right">
                <div class="greeting bounce-in delay-3">
                    <img id="avatarImg" src="" alt="">
                </div>
            </div>
        </div>

        <!-- Notification Banners -->
        <div class="notif-banner success fade-up delay-1" id="notif-success" style="display:none">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span id="notifFeedingText"> Feeding berhasil!</span>
            <button class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>

        <!-- Row 1: Gauge + Feed Control + Quick Stats -->
        <div class="grid-3">
            <!-- Food Level Gauge -->
            <div class="card bounce-in delay-1">
                <div class="card-title">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path
                            d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                    </svg>
                    Level Makanan
                </div>
                <div class="gauge-container">
                    <svg class="gauge-svg" viewBox="0 0 200 120">
                        <!-- Background arc -->
                        <path class="gauge-bg" d="M 20 100 A 80 80 0 0 1 180 100" />
                        <!-- Filled arc -->
                        <path id="gaugeFill" class="gauge-fill" d="M 20 100 A 80 80 0 0 1 180 100"
                            stroke="var(--accent)" stroke-dasharray="251" stroke-dashoffset="62" />
                        <!-- Needle -->
                        <g id="gaugeNeedle" class="gauge-needle" style="transform:rotate(36deg)">
                            <line x1="100" y1="100" x2="100" y2="30" stroke="var(--text)" stroke-width="3"
                                stroke-linecap="round" />
                        </g>
                        <circle cx="100" cy="100" r="6" class="gauge-center-dot" />
                        <!-- Labels -->
                        <text x="16" y="118" font-size="10" fill="var(--text-muted)" font-family="Poppins">Habis</text>
                        <text x="160" y="118" font-size="10" fill="var(--text-muted)" font-family="Poppins">Penuh</text>
                    </svg>
                    <div class="gauge-value" id="gaugeValue">75g</div>
                    <div class="gauge-label">dari 100g kapasitas</div>
                    <div class="status-badge safe" id="statusBadge">Aman</div>
                </div>
                <!-- Progress bar too -->
                <div style="margin-top:16px">
                    <div style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:6px">
                        <span style="color:var(--text-muted)">Sisa Makanan</span>
                        <span style="font-weight:600" id="progressLabel">75%</span>
                    </div>
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" id="progressFill" style="width:75%;background:var(--accent)">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feed Control -->
            <div class="card bounce-in delay-2">
                <div class="card-title">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Kontrol Feeding
                </div>
                <div style="text-align:center;margin-bottom:16px">
                    <img src="{{ asset('images/pixel-cat.png') }}" alt="Cat"
                        style="width:80px;height:80px;margin:0 auto" class="float">
                    <p style="font-size:12px;color:var(--text-muted);margin-top:8px">Tekan tombol untuk memberi makan
                        sekarang</p>
                </div>
                <button class="feed-btn" id="feedBtn" onclick="handleFeed()">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span id="feedBtnText" style="display:inline-flex;align-items:center;gap:6px;">
                        Feed Now!
                        <img src="{{ asset('images/piring.png') }}" style="width:18px;height:18px;object-fit:contain;">
                    </span>
                </button>
                <div class="portion-control">
                    <div class="portion-label">Porsi Makan</div>
                    <input type="range" class="slider" id="portionSlider" min="5" max="50" value="30"
                        oninput="updatePortion(this.value)">
                    <div class="slider-value" id="portionValue">30 gram</div>
                </div>
                <div
                    style="display:flex;justify-content:space-between;margin-top:12px;font-size:12px;color:var(--text-muted)">
                    <span>Durasi servo: <strong id="servoDuration">3 detik</strong></span>
                </div>
            </div>

            <div class="card bounce-in delay-3" style="display:flex;flex-direction:column;gap:12px">
                <div class="card-title">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6m6 0h6m-6 0V9a2 2 0 012-2h2a2 2 0 012 2v10m6 0v-4a2 2 0 00-2-2h-2a2 2 0 00-2 2v4" />
                    </svg>
                    Ringkasan Hari Ini
                </div>
                <div
                    style="background:var(--primary-bg);padding:16px;border-radius:12px;display:flex;align-items:center;gap:12px">

                    <div style="width:44px;height:44px;">
                        <img src="{{ asset('images/piring.png') }}" style="width:100%;height:100%;object-fit:contain;">
                    </div>

                    <div>
                        <div style="font-size:22px;font-weight:700" id="statTotalFeeding">-</div>
                        <div style="font-size:11px;color:var(--text-muted)">Total Feeding</div>
                    </div>

                </div>
                <div
                    style="background:var(--accent-bg);padding:16px;border-radius:12px;display:flex;align-items:center;gap:12px">

                    <div style="width:44px;height:44px;">
                        <img src="{{ asset('images/jam.png') }}" style="width:100%;height:100%;object-fit:contain;">
                    </div>

                    <div>
                        <div style="font-size:22px;font-weight:700" id="statActiveSchedule">-</div>
                        <div style="font-size:11px;color:var(--text-muted)">Jadwal Aktif</div>
                    </div>

                </div>
                <div
                    style="background:var(--warning-bg);padding:16px;border-radius:12px;display:flex;align-items:center;gap:12px">

                    <div
                        style="width:44px;height:44px;display:flex;align-items:center;justify-content:center;font-size:28px;line-height:1;">
                        📊
                    </div>

                    <div>
                        <div style="font-size:22px;font-weight:700" id="statTotalGram">-</div>
                        <div style="font-size:11px;color:var(--text-muted)">Total Dikonsumsi</div>
                    </div>

                </div>
                <div style="font-size:11px;color:var(--text-muted);text-align:center;margin-top:auto"
                    id="lastUpdateTime">Update terakhir: --:-- WIB</div>
            </div>
        </div>

        <!-- Row 2: Chart + Schedule -->
        <div class="grid-2-1">
            <!-- Weight Chart -->
            <div class="card fade-up delay-3">
                <div class="card-title">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>
                    Grafik Berat Makanan (24 Jam)
                </div>
                <div class="chart-container">
                    <canvas id="weightChart"></canvas>
                </div>
            </div>

            <!-- Schedule -->
            <div class="card fade-up delay-4">
                <div class="card-title">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Jadwal Makan
                </div>
                <div class="schedule-list" id="scheduleList">
                </div>
            </div>
        </div>


        <!-- Row 3: Activity History -->
        <div class="card fade-up delay-5" style="margin-bottom:20px">
            <div class="card-title" style="justify-content:space-between">
                <span style="display:flex;align-items:center;gap:8px">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Riwayat Aktivitas
                </span>

            </div>
            <div style="overflow-x:auto">
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
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Row 4: Connection Status -->
        <div class="grid-3">
            <div class="card bounce-in delay-5" style="text-align:center">
                <div style="margin-bottom:8px">
                    <img src="{{ asset('images/esp.png') }}" style="width:28px;height:28px;object-fit:contain;">
                </div>
                <div style="font-size:14px;font-weight:600">ESP32 Device</div>
                <div class="status-badge safe" style="margin:8px auto 0">Terhubung</div>
                <div style="font-size:11px;color:var(--text-muted);margin-top:8px">Ping: 12ms</div>
            </div>
            <div class="card bounce-in delay-6" style="text-align:center">
                <div style="margin-bottom:8px">
                    <img src="{{ asset('images/firebase.png') }}" style="width:28px;height:28px;object-fit:contain;">
                </div>
                <div style="font-size:14px;font-weight:600">Firebase RTDB</div>
                <div class="status-badge safe" style="margin:8px auto 0">Realtime Sync</div>
                <div style="font-size:11px;color:var(--text-muted);margin-top:8px" id="firebaseLatency">Latency: --ms
                </div>
            </div>
            <div class="card bounce-in delay-7" style="text-align:center">
                <div style="margin-bottom:8px">
                    <img src="{{ asset('images/whatsapp.png') }}" style="width:28px;height:28px;object-fit:contain;">
                </div>
                <div style="font-size:14px;font-weight:600">WhatsApp Notif</div>
                <div class="status-badge safe" style="margin:8px auto 0">Aktif</div>
                <div style="font-size:11px;color:var(--text-muted);margin-top:8px" id="waLastSent">Last sent: --:--
                </div>
            </div>
        </div>
    </div>

    <div class="pet-deco top-right"><img src="{{ asset('images/matcha-cat.png') }}" alt="" class="float"></div>
    <div class="pet-deco bottom-left"><img src="{{ asset('images/paw-prints.png') }}" alt="" class="wiggle"></div>

    <div class="modal-overlay" id="petNameModal" style="z-index:999; display: none;">
        <div class="modal" style="text-align:center;">

            <div id="stepPetName">
                <div style="margin-bottom:12px">
                    <img src="{{ asset('images/siapa.png') }}" style="width:56px;height:56px;object-fit:contain;">
                </div>
                <div class="modal-title" style="justify-content:center;font-size:22px">
                    Nǐ hǎo! Siapa nama anabulmu? :D
                </div>
                <p style="font-size:13px;color:var(--text-muted);margin-bottom:20px">
                    Masukkan nama anabul gemasmu tuk memulai!
                </p>
                <div class="modal-field">
                    <input type="text" id="petNameInput" placeholder="cth: Mochi, Bruno, Luna..."
                        style="text-align:center;font-size:16px">
                </div>
                <div id="petNameError"
                    style="color:var(--danger);font-size:12px;margin-top:-8px;margin-bottom:8px;display:none">
                    Nama tidak boleh kosong!
                </div>
                <button class="btn-save" style="width:100%;margin-top:8px" onclick="submitPetName()">
                    Next!
                </button>
            </div>

            <div id="stepPhone" style="display: none;">
                <div class="icon" style="font-size: 40px; margin-bottom: 12px;">📱</div>
                <div class="modal-title" style="justify-content:center;font-size:22px; margin-bottom: 10px;">
                    Nomor WhatsApp
                </div>
                <p style="font-size:13px;color:var(--text-muted);margin-bottom:20px">
                    Masukkan nomor HP untuk menerima notifikasi otomatis saat anabulmu makan atau stok habis.
                </p>
                <div class="modal-field">
                    <input type="tel" id="phoneInput" placeholder="cth: 081234567890"
                        style="text-align:center;font-size:16px" />
                </div>
                <div id="phoneErrorMsg"
                    style="color: var(--danger); font-size: 12px; display: none; margin-top: -8px; margin-bottom: 8px;">
                    Nomor HP tidak boleh kosong!
                </div>
                <button class="btn-save" style="width:100%; margin-top:8px" onclick="submitPhone()">
                    Next!
                </button>
            </div>

            <div id="stepDeviceLock" style="display: none;">
                <div class="icon" style="font-size: 40px; margin-bottom: 12px;">🔗</div>
                <div class="modal-title" style="justify-content:center;font-size:22px; margin-bottom: 10px;">
                    Hubungkan PawFeeder
                </div>
                <p style="font-size:13px;color:var(--text-muted);margin-bottom:20px">
                    Masukkan Serial Number (Device ID) dari mesin PawFeeder kamu.
                </p>
                <div class="modal-field">
                    <input type="text" id="deviceIdInput" placeholder="pawfeederXXX"
                        style="text-align:center;font-size:16px" />
                </div>
                <div id="deviceErrorMsg"
                    style="color: var(--danger); font-size: 12px; display: none; margin-top: -8px; margin-bottom: 8px;">
                    Device ID tidak boleh kosong!
                </div>
                <button class="btn-save"
                    style="width:100%; margin-top:8px; background: linear-gradient(135deg, var(--primary), #e8a050)"
                    onclick="connectDevice()">
                    Mulai Pawfeeder!
                </button>
            </div>

        </div>
    </div>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
        import { getDatabase, ref, set, onValue, push, get } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-database.js";

        // ===== FIREBASE CONFIG =====
        const firebaseConfig = {
            apiKey: "{{ env('FIREBASE_API_KEY') }}",
            authDomain: "{{ env('FIREBASE_AUTH_DOMAIN') }}",
            projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
            storageBucket: "{{ env('FIREBASE_STORAGE_BUCKET') }}",
            messagingSenderId: "{{ env('FIREBASE_MESSAGING_SENDER_ID') }}",
            appId: "{{ env('FIREBASE_APP_ID') }}",
            databaseURL: "{{ env('FIREBASE_DATABASE_URL') }}"
        };

        const app = initializeApp(firebaseConfig);
        const db = getDatabase(app);
        const uid = @json(session('firebase_uid'));
        let isFeeding = false;
        let currentWeight = 75;
        let maxCapacity = 100;

        const userRef = (path) => ref(db, `users/${uid}/${path}`);

        let petName = 'Anabul';

        // Profile Photo
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

        function updateGauge(weight, max) {
            const pct = weight / max;
            const offset = 251 * (1 - pct);
            const needle = -90 + (180 * pct);
            document.getElementById('gaugeFill').style.strokeDashoffset = offset;
            document.getElementById('gaugeNeedle').style.transform = `rotate(${needle}deg)`;
            document.getElementById('gaugeValue').textContent = weight + 'g';
            document.getElementById('progressLabel').textContent = Math.round(pct * 100) + '%';
            document.getElementById('progressFill').style.width = (pct * 100) + '%';
            const fill = document.getElementById('gaugeFill');
            const bar = document.getElementById('progressFill');
            const badge = document.getElementById('statusBadge');
            if (pct > 0.3) {
                fill.style.stroke = 'var(--accent)'; bar.style.background = 'var(--accent)';
                badge.className = 'status-badge safe'; badge.textContent = 'Aman';
            } else if (pct > 0.1) {
                fill.style.stroke = 'var(--warning)'; bar.style.background = 'var(--warning)';
                badge.className = 'status-badge warning'; badge.textContent = '⚠ Hampir Habis';
            } else {
                fill.style.stroke = 'var(--danger)'; bar.style.background = 'var(--danger)';
                badge.className = 'status-badge danger'; badge.textContent = '✕ Habis!';
            }
        }

        window.updatePortion = function (val) {
            document.getElementById('portionValue').textContent = val + ' gram';
            document.getElementById('servoDuration').textContent = Math.round(val / 10) + ' detik';
        }

        // Ukur latency Firebase
        function measureLatency() {
            const start = Date.now();
            onValue(ref(db, 'users/' + uid + '/realtime/foodWeight'), () => {
                const latency = Date.now() - start;
                const el = document.getElementById('firebaseLatency');
                if (el) el.textContent = `Latency: ${latency}ms`;
            }, { onlyOnce: true });
        }

        measureLatency();

        onValue(ref(db, 'users/' + uid + '/realtime/waLastSent'), (snapshot) => {
            const val = snapshot.val();
            const el = document.getElementById('waLastSent');
            if (el) el.textContent = val ? `Last sent: ${val}` : 'Last sent: --:--';
        });

        setInterval(measureLatency, 30000);

        // Foodweight monitoring
        updateGauge(currentWeight, maxCapacity);
        document.querySelector('.gauge-label').textContent = `dari ${maxCapacity}g kapasitas`;

        onValue(ref(db, 'users/' + uid + '/realtime/foodWeight'), (snapshot) => {
            const weight = snapshot.val() ?? 75;
            updateGauge(weight, maxCapacity);
            currentWeight = weight;

            // Notif WA kalau stok < 20g
            if (weight < 20 && weight > 0) {
                fetch('/notify-low-stock', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ weight: weight })
                });
            }

            const now = new Date(new Date().getTime() + 7 * 3600000);
            const hh = String(now.getUTCHours()).padStart(2, '0');
            const mm = String(now.getUTCMinutes()).padStart(2, '0');
            const el = document.getElementById('lastUpdateTime');
            if (el) el.textContent = `Update terakhir: ${hh}:${mm} WIB`;
        });

        // Manual feeding button
        window.handleFeed = async function () {
            console.log('handleFeed dipanggil');

            if (isFeeding) return;
            isFeeding = true;

            const btn = document.getElementById('feedBtn');
            const txt = document.getElementById('feedBtnText');

            const notifSuccess = document.getElementById('notif-success');
            const notifFeedingText = document.getElementById('notifFeedingText');

            const portionSlider = document.getElementById('portionSlider');
            const currentPetName = document.querySelector('.pet-name')?.textContent || 'Anabul';

            let interval = null;

            try {
                const portion = parseInt(portionSlider.value);

                if (isNaN(portion) || portion <= 0) {
                    throw new Error('Porsi makanan tidak valid.');
                }

                if (currentWeight <= 0) {
                    throw new Error('Stok makanan sudah habis.');
                }

                if (portion > currentWeight) {
                    throw new Error('Porsi melebihi stok makanan yang tersedia.');
                }

                btn.classList.add('feeding');
                txt.textContent = 'Memberi makan... 🐾';

                let dots = 0;
                interval = setInterval(() => {
                    dots = (dots + 1) % 4;
                    txt.textContent = 'Memberi makan' + '.'.repeat(dots) + ' 🐾';
                }, 400);

                const time = new Date().toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                const newWeight = Math.max(0, currentWeight - portion);

                await set(ref(db, 'users/' + uid + '/feedNow'), {
                    active: true,
                    portion: portion,
                    timestamp: Date.now()
                });

                await set(ref(db, 'users/' + uid + '/realtime/foodWeight'), newWeight);

                currentWeight = newWeight;

                const response = await fetch('/notify-feeding', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        portion: portion,
                        weight: currentWeight
                    })
                });

                if (!response.ok) {
                    throw new Error('Gagal mengirim notifikasi feeding.');
                }

                const data = await response.json();
                console.log('Notif response:', data);

                const waTimeStr = new Date().toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false,
                    timeZone: 'Asia/Jakarta'
                });

                await set(ref(db, 'users/' + uid + '/realtime/waLastSent'), waTimeStr);

                await push(ref(db, 'users/' + uid + '/history'), {
                    time: time,
                    type: 'manual',
                    portion: portion,
                    status: 'success',
                    weightAfter: newWeight,
                    timestamp: Date.now()
                });

                notifFeedingText.textContent =
                    `Feeding berhasil! ${currentPetName} diberi makan ${portion}g pada ${time}`;

                notifSuccess.style.display = 'flex';

                console.log('Feeding berhasil');

            } catch (error) {
                console.error('Feeding error:', error);

                alert(error.message || 'Terjadi kesalahan saat melakukan feeding.');

                try {
                    await push(ref(db, 'users/' + uid + '/history'), {
                        time: new Date().toLocaleTimeString('id-ID', {
                            hour: '2-digit',
                            minute: '2-digit'
                        }),
                        type: 'manual',
                        portion: parseInt(portionSlider.value) || 0,
                        status: 'failed',
                        errorMessage: error.message || 'Unknown error',
                        weightAfter: currentWeight,
                        timestamp: Date.now()
                    });
                } catch (historyError) {
                    console.error('Gagal menyimpan history error:', historyError);
                }

            } finally {
                if (interval) {
                    clearInterval(interval);
                }

                btn.classList.remove('feeding');
                txt.textContent = 'Feed Now! 🍽️';
                isFeeding = false;

                try {
                    await set(ref(db, 'users/' + uid + '/feedNow'), {
                        active: false
                    });
                } catch (resetError) {
                    console.error('Gagal reset feedNow:', resetError);
                }
            }
        };

        onValue(ref(db, 'users/' + uid + '/history'), (snapshot) => {
            const data = snapshot.val();
            const tbody = document.getElementById('historyBody');
            tbody.innerHTML = '';

            if (!data) {
                tbody.innerHTML = `
            <tr>
                <td colspan="5" style="text-align:center;padding:32px">
                    <div style="font-size:28px;margin-bottom:8px">🍽️</div>
                    <div style="font-size:13px;color:var(--text-muted);font-weight:500">
                        Belum ada data nih, yuk kasih mam anabulmu!
                    </div>
                </td>
            </tr>`;
                document.getElementById('statTotalFeeding').textContent = '0';
                document.getElementById('statTotalGram').textContent = '0g';
                return;
            }

            const entries = Object.values(data)
                .sort((a, b) => b.timestamp - a.timestamp)
                .slice(0, 5);

            entries.forEach(entry => {
                const typeClass = entry.type === 'manual' ? 'manual' : 'auto';
                const typeLabel = entry.type === 'manual' ? 'Manual' : 'Otomatis';
                const statusColor = entry.status === 'success' ? 'var(--accent)' : 'var(--warning)';
                const statusLabel = entry.status === 'success' ? '✓ Berhasil' : '⚠ Terlambat';
                tbody.innerHTML += `
            <tr class="fade-up">
                <td>${entry.time}</td>
                <td><span class="type-badge ${typeClass}">${typeLabel}</span></td>
                <td>${entry.portion}g</td>
                <td style="color:${statusColor};font-weight:600">${statusLabel}</td>
                <td>${entry.weightAfter != null ? entry.weightAfter + 'g' : '-'}</td>
            </tr>
        `;
            });

            // Ringkasan hari ini
            const todayWIB = new Date(new Date().getTime() + 7 * 3600000);
            const todayStr = todayWIB.toISOString().slice(0, 10);
            const todayEntries = Object.values(data).filter(e => {
                if (!e.timestamp) return false;
                return new Date(e.timestamp + 7 * 3600000).toISOString().slice(0, 10) === todayStr;
            });

            document.getElementById('statTotalFeeding').textContent = todayEntries.length;
            document.getElementById('statTotalGram').textContent =
                todayEntries.reduce((sum, e) => sum + (e.portion || 0), 0) + 'g';
        });

        // ===== CHART REALTIME =====
        function getOrCreateChart() {
            if (!document.getElementById('weightChart')) {
                document.querySelector('.chart-container').innerHTML = '<canvas id="weightChart"></canvas>';
            }
            const ctx = document.getElementById('weightChart').getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 240);
            gradient.addColorStop(0, 'rgba(212,136,62,0.3)');
            gradient.addColorStop(1, 'rgba(212,136,62,0.02)');

            const weightChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Berat Makanan (g)',
                        data: [],
                        borderColor: '#d4883e',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#d4883e',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#3d3529',
                            titleFont: { family: 'Poppins', size: 12 },
                            bodyFont: { family: 'Poppins', size: 13 },
                            padding: 12, cornerRadius: 10,
                            callbacks: { label: (c) => ` ${c.parsed.y}g tersisa` }
                        }
                    },
                    scales: {
                        x: { grid: { display: false }, ticks: { font: { family: 'Poppins', size: 11 }, color: '#8c7e6a' } },
                        y: {
                            min: 0, max: 220, grid: { color: 'rgba(0,0,0,0.04)' },
                            ticks: { font: { family: 'Poppins', size: 11 }, color: '#8c7e6a', callback: (v) => v + 'g' }
                        }
                    },
                    interaction: { intersect: false, mode: 'index' }
                }
            });

            onValue(ref(db, 'users/' + uid + '/history'), (snapshot) => {
                const data = snapshot.val();
                const chartContainer = document.querySelector('.chart-container');
                const entries = data ? Object.values(data)
                    .filter(e => e.timestamp && e.timestamp >= Date.now() - 24 * 60 * 60 * 1000)
                    .sort((a, b) => a.timestamp - b.timestamp) : [];

                const existingMsg = document.getElementById('chartEmptyMsg');
                if (existingMsg) existingMsg.remove();

                if (entries.length === 0) {
                    weightChart.data.labels = [];
                    weightChart.data.datasets[0].data = [];
                    weightChart.update();

                    const emptyMsg = document.createElement('div');
                    emptyMsg.id = 'chartEmptyMsg';
                    emptyMsg.style.cssText = 'position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;pointer-events:none';
                    emptyMsg.innerHTML = `
                <img src="/images/aman.png" style="width:60px;height:60px;object-fit:contain;animation:float 3s ease-in-out infinite;">
                <p style="font-size:13px;color:var(--text-muted);font-weight:500;text-align:center">Belum ada data nih, yuk kasih mam anabulmu! <3</p>`;
                    chartContainer.appendChild(emptyMsg);
                    return;
                }

                const labels = entries.map(e => {
                    const d = new Date(e.timestamp + 7 * 3600000);
                    return String(d.getUTCHours()).padStart(2, '0') + ':' + String(d.getUTCMinutes()).padStart(2, '0');
                });
                const weights = entries.map(e => e.weightAfter ?? null);

                weightChart.data.labels = labels;
                weightChart.data.datasets[0].data = weights;
                weightChart.update();
            });
        }

        // ===== LOAD SCHEDULE =====
        function loadSchedule() {
            onValue(ref(db, 'users/' + uid + '/schedule'), (snapshot) => {
                const data = snapshot.val();
                const list = document.getElementById('scheduleList');

                if (!data) {
                    list.innerHTML = `
                <div style="text-align:center;padding:24px 16px">
                    <div style="font-size:28px;margin-bottom:8px">⏰</div>
                    <div style="font-size:13px;color:var(--text-muted);font-weight:500">
                        Belum ada jadwal. Tambahkan di halaman Jadwal!
                    </div>
                </div>`;
                    document.getElementById('statActiveSchedule').textContent = '0';
                    return;
                }

                list.innerHTML = '';
                let activeCount = 0;

                Object.entries(data).forEach(([key, item]) => {
                    if (!item.time) return;
                    if (item.active) activeCount++;

                    const div = document.createElement('div');
                    div.className = 'schedule-item';
                    div.innerHTML = `
                <div class="schedule-time">${item.time}</div>
                <div class="schedule-info">
                    <div class="label">${item.name || 'Jadwal'}</div>
                    <div class="sub">${item.portion || '-'}g • ${item.freq || 'Setiap hari'}</div>
                </div>
                <button class="toggle ${item.active ? 'active' : ''}"
                    onclick="toggleSchedule('${key}', this)"></button>
            `;
                    list.appendChild(div);
                });

                document.getElementById('statActiveSchedule').textContent = activeCount;
            });
        }

        window.toggleSchedule = function (key, btn) {
            btn.classList.toggle('active');
            set(ref(db, 'users/' + uid + '/schedule/' + key + '/active'), btn.classList.contains('active'));
        }

        window.toggleSidebar = function () {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('open');
        }

        // ===== REALTIME CLOCK WIB =====
        function updateDateTime() {
            const now = new Date();
            const wibOffset = 7 * 60;
            const utc = now.getTime() + now.getTimezoneOffset() * 60000;
            const wib = new Date(utc + wibOffset * 60000);

            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            const dayName = days[wib.getDay()];
            const date = wib.getDate();
            const month = months[wib.getMonth()];
            const year = wib.getFullYear();
            const hours = wib.getHours();
            const minutes = String(wib.getMinutes()).padStart(2, '0');
            const seconds = String(wib.getSeconds()).padStart(2, '0');

            let greeting = 'Selamat pagi!';
            if (hours >= 11 && hours < 15) greeting = 'Selamat siang!';
            else if (hours >= 15 && hours < 18) greeting = 'Selamat sore!';
            else if (hours >= 18) greeting = 'Selamat malam!';

            const el = document.getElementById('realtimeDateGreet');
            if (el) el.textContent = `${dayName}, ${date} ${month} ${year} • ${String(hours).padStart(2, '0')}:${minutes}:${seconds} WIB • ${greeting}`;
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
        getOrCreateChart();
        loadSchedule();

        // ===== JADWAL OTOMATIS =====
        const lastTriggeredSlots = new Set();
        let isScheduleRunning = false;

        let isFirstLoad = true;
        let lastHistoryCount = 0;

        onValue(ref(db, 'users/' + uid + '/history'), (snapshot) => {
            const data = snapshot.val();
            if (!data) return;

            const entries = Object.values(data);

            if (isFirstLoad) {
                lastHistoryCount = entries.length;
                isFirstLoad = false;
                return;
            }

            if (entries.length > lastHistoryCount) {
                const latestEntry = entries.sort((a, b) => b.timestamp - a.timestamp)[0];

                if (latestEntry.type === 'auto') {
                    const petName = document.querySelector('.pet-name')?.textContent || 'Anabul';
                    const weightAfter = latestEntry.weightAfter;
                    const portion = latestEntry.portion;

                    fetch('/notify-feeding', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ portion: portion, weight: weightAfter })
                    });

                    const notifText = document.getElementById('notifFeedingText');
                    if (notifText) notifText.textContent = `Jadwal otomatis! ${petName} diberi makan ${portion}g`;
                    const notifSuccess = document.getElementById('notif-success');
                    if (notifSuccess) {
                        notifSuccess.style.display = 'flex';
                        setTimeout(() => notifSuccess.style.display = 'none', 5000);
                    }
                }

                lastHistoryCount = entries.length;
            }
        });


        onValue(userRef(''), (snapshot) => {
            const data = snapshot.val() || {};
            const profile = data.profile || {};

            petName = profile.pet_name;
            const noHp = profile.phone;
            const deviceId = data.deviceId;

            const modalOverlay = document.getElementById('petNameModal');

            if (petName) {
                document.querySelectorAll('.pet-name').forEach(el => {
                    el.textContent = petName;
                });
            } else {
                document.querySelectorAll('.pet-name').forEach(el => {
                    el.textContent = "Anabul";
                });
            }

            if (!petName) {
                modalOverlay.style.display = 'flex';
                showOnlyStep('stepPetName');
            } else if (!noHp) {
                modalOverlay.style.display = 'flex';
                showOnlyStep('stepPhone');
            } else if (!deviceId) {
                modalOverlay.style.display = 'flex';
                showOnlyStep('stepDeviceLock');
            } else {
                modalOverlay.style.display = 'none';
            }
        });

        function showOnlyStep(stepId) {
            document.getElementById('stepPetName').style.display = 'none';
            document.getElementById('stepPhone').style.display = 'none';
            document.getElementById('stepDeviceLock').style.display = 'none';

            document.getElementById(stepId).style.display = 'block';
        }


        window.submitPetName = async function () {
            const name = document.getElementById('petNameInput').value.trim();
            if (!name) {
                document.getElementById('petNameError').style.display = 'block';
                return;
            }
            document.getElementById('petNameError').style.display = 'none';

            try {
                await set(ref(db, `users/${uid}/profile/pet_name`), name);
                console.log("Nama berhasil disimpan!");
            } catch (error) {
                console.error("Gagal menyimpan nama:", error);
            }
        }

        window.submitPhone = async function () {
            const phone = document.getElementById('phoneInput').value.trim();
            const errorMsg = document.getElementById('phoneErrorMsg');

            if (!phone) {
                errorMsg.textContent = "Nomor HP tidak boleh kosong!";
                errorMsg.style.display = 'block';
                return;
            }
            errorMsg.style.display = 'none';

            try {
                await set(ref(db, `users/${uid}/profile/phone`), phone);
                console.log("Nomor HP berhasil disimpan!");
            } catch (error) {
                console.error("Gagal menyimpan no HP:", error);
                errorMsg.textContent = "Terjadi kesalahan. Coba lagi.";
                errorMsg.style.display = 'block';
            }
        }

        window.connectDevice = async function () {
            const input = document.getElementById('deviceIdInput').value.trim();
            const errorMsg = document.getElementById('deviceErrorMsg');

            if (!input) {
                errorMsg.textContent = "Device ID tidak boleh kosong!";
                errorMsg.style.display = 'block';
                return;
            }
            errorMsg.style.display = 'none';

            try {
                await set(ref(db, 'devices/' + input + '/ownerUid'), uid);
                await set(ref(db, 'users/' + uid + '/deviceId'), input);

                console.log("Device berhasil terhubung!");

                // Jangan pake alert, jelek
                // alert("PawFeeder siap digunakan! 🐾");

            } catch (error) {
                console.error("Error connecting device:", error);
                errorMsg.textContent = "Gagal menghubungkan. Silakan coba lagi.";
                errorMsg.style.display = 'block';
            }
        }


    </script>

</body>

</html>