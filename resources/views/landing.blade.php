<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/paw-prints.png') }}">
    <title>PawFeeder — Smart Pet Feeder</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

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
            --border: #e8e0d4;
            --shadow: 0 2px 16px rgba(60,45,20,0.06);
            --shadow-hover: 0 8px 32px rgba(60,45,20,0.12);
            --radius: 16px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.95); }
            100% { transform: scale(1); opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        @keyframes wiggle {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-5deg); }
            75% { transform: rotate(5deg); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-40px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes pulseSoft {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        @keyframes pawWalk {
            0% { opacity: 0; transform: translateY(10px) rotate(-15deg); }
            50% { opacity: 1; }
            100% { opacity: 0; transform: translateY(-10px) rotate(15deg); }
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounceSlow {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-6px) rotate(2deg); }
            75% { transform: translateY(-3px) rotate(-2deg); }
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .animate-bounce-in { animation: bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) both; }
        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-wiggle { animation: wiggle 2s ease-in-out infinite; }
        .animate-fade-up { animation: fadeUp 0.7s ease-out both; }
        .animate-fade-left { animation: fadeInLeft 0.7s ease-out both; }
        .animate-fade-right { animation: fadeInRight 0.7s ease-out both; }
        .animate-pulse-soft { animation: pulseSoft 2.5s ease-in-out infinite; }
        .animate-slide-down { animation: slideDown 0.5s ease-out both; }
        .animate-bounce-slow { animation: bounceSlow 3s ease-in-out infinite; }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }
        .delay-6 { animation-delay: 0.6s; }
        .delay-7 { animation-delay: 0.7s; }
        .delay-8 { animation-delay: 0.8s; }
        .delay-10 { animation-delay: 1.0s; }
        .delay-12 { animation-delay: 1.2s; }

        /* Hidden until scroll reveals */
        .scroll-hidden {
            opacity: 0;
            transform: translateY(40px);
            transition: none;
        }
        .scroll-reveal {
            animation: fadeUp 0.7s ease-out both;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: rgba(245, 240, 232, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 12px 0;
            animation: slideDown 0.6s ease-out;
        }
        .navbar-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--primary);
            text-decoration: none;
        }
        .nav-logo img {
            width: 36px;
            height: 36px;
            animation: wiggle 2s ease-in-out infinite;
        }
        .nav-logo span {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s, transform 0.3s;
            position: relative;
        }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            border-radius: 2px;
            transition: width 0.3s;
        }
        .nav-links a:hover { color: var(--primary); transform: translateY(-2px); }
        .nav-links a:hover::after { width: 100%; }

        .nav-buttons {
            display: flex;
            gap: 12px;
        }

        /* ===== BUTTONS ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            border-radius: 50px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            text-decoration: none;
        }
        .btn:hover { transform: translateY(-3px) scale(1.03); }
        .btn:active { transform: translateY(0) scale(0.97); }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #e6a05c);
            color: white;
            box-shadow: 0 4px 20px rgba(212, 136, 62, 0.35);
        }
        .btn-primary:hover { box-shadow: 0 8px 30px rgba(212, 136, 62, 0.5); }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }
        .btn-outline:hover { background: var(--primary-bg); }

        .btn-accent {
            background: linear-gradient(135deg, var(--accent), #7dd4a8);
            color: white;
            box-shadow: 0 4px 20px rgba(91, 184, 138, 0.35);
        }
        .btn-accent:hover { box-shadow: 0 8px 30px rgba(91, 184, 138, 0.5); }

        .btn-lg {
            padding: 16px 40px;
            font-size: 1.1rem;
        }

        /* ===== HERO ===== */
        .hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 30px 30px 10px;
            max-width: 1400px;
            margin: 0 auto;
            gap: 40px;
            position: relative;
        }
        .hero-left {
            flex: 1;
            z-index: 2;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-bg);
            color: var(--primary);
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 20px;
            animation: bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) both;
        }
        .hero-badge .dot {
            width: 8px;
            height: 8px;
            background: var(--accent);
            border-radius: 50%;
            animation: pulseSoft 1.5s ease-in-out infinite;
        }
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 20px;
            animation: fadeInLeft 0.8s ease-out 0.2s both;
        }
        .hero-title .highlight {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-desc {
            font-size: 1.15rem;
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 36px;
            max-width: 500px;
            animation: fadeInLeft 0.8s ease-out 0.4s both;
        }
        .hero-cta {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            animation: fadeInLeft 0.8s ease-out 0.6s both;
        }
        .hero-stats {
            display: flex;
            gap: 40px;
            margin-top: 48px;
            animation: fadeInLeft 0.8s ease-out 0.8s both;
        }
        .hero-stat h3 {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary);
        }
        .hero-stat p {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .hero-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
        }
        .hero-poodle {
            width: 480px;
            max-width: 100%;
            animation: bounceIn 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.3s both;
            filter: drop-shadow(0 20px 40px rgba(60,45,20,0.15));
            cursor: pointer;
            transition: transform 0.3s;
        }
        .hero-poodle:hover {
            animation: wiggle 0.5s ease-in-out;
        }

        /* Floating decorations */
        .floating-pet {
            position: absolute;
            border-radius: 50%;
            z-index: 0;
        }
        .floating-pet img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
        }
        .fp-1 { width: 70px; height: 70px; top: 15%; right: 8%; animation: float 3s ease-in-out infinite; }
        .fp-2 { width: 55px; height: 55px; bottom: 25%; right: 5%; animation: bounceSlow 4s ease-in-out infinite; }
        .fp-3 { width: 60px; height: 60px; top: 30%; left: 48%; animation: float 3.5s ease-in-out 0.5s infinite; }
        .fp-paw { width: 40px; height: 40px; bottom: 20%; left: 52%; animation: wiggle 2s ease-in-out infinite; opacity: 0.3; }

        /* Blob bg */
        .hero-blob {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--primary-bg) 0%, transparent 70%);
            right: -50px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 0;
            opacity: 0.7;
        }

        /* ===== FEATURES SECTION ===== */
        .section {
            padding: 100px 80px;
            max-width: 1400px;
            margin: 0 auto;
        }
        .section-header {
            text-align: center;
            margin-bottom: 64px;
        }
        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--accent-bg);
            color: var(--accent);
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 16px;
        }
        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 16px;
        }
        .section-title .highlight {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .section-desc {
            font-size: 1.1rem;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }
        .feature-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 32px 28px;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            cursor: default;
            position: relative;
            overflow: hidden;
        }
                .feature-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .feature-card:hover .feature-icon { transform: scale(1.15) rotate(5deg); }

        .fi-orange, .fi-green, .fi-yellow, .fi-red, .fi-purple, .fi-gradient { background: transparent; }

        .feature-card h3 {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .feature-card p {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* ===== HOW IT WORKS ===== */
        .steps-container {
            display: flex;
            gap: 24px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .step-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 36px 28px;
            text-align: center;
            flex: 1;
            min-width: 220px;
            max-width: 280px;
            position: relative;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        .step-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }
        .step-number {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            font-weight: 800;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        .step-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .step-card p {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.6;
        }
        .step-emoji {
            font-size: 2.5rem;
            margin-bottom: 16px;
            display: block;
        }


        /* ===== CTA SECTION ===== */
        .cta-section {
            background: linear-gradient(135deg, var(--primary), #e6a05c, var(--accent));
            border-radius: 24px;
            padding: 80px 40px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
            margin: 0 auto;
            max-width: 1240px;
            margin-left: auto;
            margin-right: auto;
        }
        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 50%, rgba(255,255,255,0.1) 0%, transparent 50%);
        }
        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 16px;
            position: relative;
        }
        .cta-section p {
            font-size: 1.15rem;
            opacity: 0.9;
            margin-bottom: 36px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
        }
        .cta-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            position: relative;
        }
        .btn-white {
            background: white;
            color: var(--primary);
            font-weight: 700;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        .btn-white:hover { box-shadow: 0 8px 30px rgba(0,0,0,0.2); }
        .btn-ghost {
            background: rgba(255,255,255,0.15);
            color: white;
            border: 2px solid rgba(255,255,255,0.4);
        }
        .btn-ghost:hover { background: rgba(255,255,255,0.25); }

        /* floating paws in CTA */
        .cta-paw {
            position: absolute;
            font-size: 2rem;
            opacity: 0.15;
        }
        .cta-paw:nth-child(1) { top: 15%; left: 10%; animation: float 3s ease-in-out infinite; }
        .cta-paw:nth-child(2) { top: 20%; right: 12%; animation: bounceSlow 4s ease-in-out infinite; }
        .cta-paw:nth-child(3) { bottom: 15%; left: 15%; animation: wiggle 3s ease-in-out infinite; }
        .cta-paw:nth-child(4) { bottom: 20%; right: 10%; animation: float 3.5s ease-in-out 0.5s infinite; }

        /* ===== FOOTER ===== */
        .footer {
            text-align: center;
            padding: 48px 80px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        .footer a { color: var(--primary); text-decoration: none; }
        .footer a:hover { text-decoration: underline; }
        .footer-hearts {
            margin-top: 8px;
            font-size: 0.85rem;
        }

        /* ===== MOBILE BURGER ===== */
        .burger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
        }
        .burger span {
            display: block;
            width: 24px;
            height: 2px;
            background: var(--text);
            margin: 5px 0;
            border-radius: 2px;
            transition: all 0.3s;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .hero {
                flex-direction: column-reverse;
                text-align: center;
                padding-top: 100px;
                gap: 24px;
            }
            .hero-title { font-size: 2.4rem; }
            .hero-desc { margin: 0 auto 30px; }
            .hero-cta { justify-content: center; }
            .hero-stats { justify-content: center; }
            .hero-poodle { width: 300px; }
            .features-grid { grid-template-columns: 1fr; }
            .testimonials-grid { grid-template-columns: 1fr; }
            .hero-blob { width: 300px; height: 300px; }
            .floating-pet { display: none; }
            .nav-links { display: none; }
            .burger { display: block; }
            .cta-section h2 { font-size: 1.8rem; }
            .section-title { font-size: 1.8rem; }

            .nav-links.open {
                display: flex;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: rgba(245, 240, 232, 0.97);
                backdrop-filter: blur(12px);
                padding: 24px;
                gap: 20px;
                border-bottom: 1px solid var(--border);
                animation: slideDown 0.3s ease-out;
            }
        }
        @media (max-width: 600px) {
            .hero-title { font-size: 1.9rem; }
            .steps-container { flex-direction: column; align-items: center; }
            .step-card { max-width: 100%; }
        }
    </style>
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="#" class="nav-logo">
                <img src="{{ asset('images/paw-prints.png') }}" alt="PawFeeder">
                <span>PawFeeder</span>
            </a>
            <ul class="nav-links" id="navLinks">
                <li><a href="#features">Fitur</a></li>
                <li><a href="#how-it-works">Cara Kerja</a></li>
            </ul>
            <div class="nav-buttons">
                <a href="/login" class="btn btn-outline" style="padding: 8px 20px; font-size: 0.9rem;">Login</a>
                <a href="/signup" class="btn btn-primary" style="padding: 8px 20px; font-size: 0.9rem;">Register</a>
            </div>
            <button class="burger" id="burger" onclick="toggleNav()">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    <!-- ===== HERO ===== -->
    <section class="hero">
        <div class="hero-blob"></div>

        <!-- Floating small pets -->
        <div class="floating-pet fp-1"><img src="{{ asset('images/banana-cat.png') }}" alt="cat"></div>
        <div class="floating-pet fp-2"><img src="{{ asset('images/matcha-cat.png') }}" alt="cat"></div>
        <div class="floating-pet fp-3"><img src="{{ asset('images/doge-dog.png') }}" alt="dog"></div>
        <div class="floating-pet fp-paw"><img src="{{ asset('images/paw-prints.png') }}" alt="paw"></div>

        <div class="hero-left">
            <div class="hero-badge">
            </div>
            <h1 class="hero-title">
                Kasih Makan<br>
                <span class="highlight">Hewan Kesayanganmu</span><br>
                Jadi Gampang! 🐾
            </h1>
            <p class="hero-desc">
                PawFeeder adalah smart feeder berbasis IoT yang bisa kamu kontrol dari mana aja. Jadwalkan makan, monitor porsi, dan terima notifikasi otomatis — semua dari genggaman tanganmu!
            </p>
            <div class="hero-cta">
                <a href="/signup" class="btn btn-primary btn-lg">Mulai Sekarang!</a>
                <a href="#features" class="btn btn-outline btn-lg">Lihat Fitur</a>
            </div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <h3>500+</h3>
                    <p>Pet Parents Happy</p>
                </div>
                <div class="hero-stat">
                    <h3>24/7</h3>
                    <p>Monitoring Real-Time</p>
                </div>
                <div class="hero-stat">
                    <h3>99.9%</h3>
                    <p>Uptime</p>
                </div>
            </div>
        </div>

        <div class="hero-right">
            <img src="{{ asset('images/poodle.png') }}" alt="PawFeeder Poodle" class="hero-poodle" id="poodleImg">
        </div>
    </section>

    <!-- ===== FEATURES ===== -->
    <section class="section" id="features">
        <div class="section-header scroll-hidden">
            <h2 class="section-title">Semua yang <span class="highlight">Kamu Butuhkan</span></h2>
            <p class="section-desc">Dari monitoring real-time sampai kontrol penuh jadwal makan — PawFeeder punya semuanya!</p>
        </div>
        <div class="features-grid">
            <div class="feature-card scroll-hidden">
                <div class="feature-icon fi-orange">
    <img src="{{ asset('images/jam.png') }}" 
         style="width:100%;height:100%;object-fit:contain;">
</div>
                <h3>Monitoring Real-Time</h3>
                <p>Pantau berat makanan secara langsung dengan indikator visual. Tahu kapan makanan hampir habis!</p>
            </div>
            <div class="feature-card scroll-hidden">
                <div class="feature-icon">
    <img src="{{ asset('images/hm.png') }}" 
         style="width:100%;height:100%;object-fit:contain;">
</div>
                <h3>Grafik & Visualisasi</h3>
                <p>Lihat pola makan hewanmu lewat grafik interaktif. Data harian dan mingguan tersedia lengkap.</p>
            </div>
            <div class="feature-card scroll-hidden">
                <div class="feature-icon">
    <img src="{{ asset('images/sip.png') }}" 
         style="width:100%;height:100%;object-fit:contain;">
</div>
                <h3>Feeding Control</h3>
                <p>Tekan "Feed Now" kapan aja! Atur porsi makan sesuai kebutuhan — dari kecil sampai besar.</p>
            </div>
            <div class="feature-card scroll-hidden">
                <div class="feature-icon">
    <img src="{{ asset('images/kepo.png') }}" 
         style="width:100%;height:100%;object-fit:contain;">
</div>
                <h3>Jadwal Otomatis</h3>
                <p>Set jadwal makan harian. Aktifkan, nonaktifkan, atau edit kapan saja tanpa ribet.</p>
            </div>
            <div class="feature-card scroll-hidden">
                <div class="feature-icon">
    <img src="{{ asset('images/matcha-cat.png') }}" 
         style="width:100%;height:100%;object-fit:contain;">
</div>
                <h3>Riwayat Aktivitas</h3>
                <p>Semua aktivitas feeding tercatat lengkap — manual maupun otomatis, tinggal cek log-nya!</p>
            </div>
            <div class="feature-card scroll-hidden">
                <div class="feature-icon">
    <img src="{{ asset('images/lonceng.png') }}" 
         style="width:100%;height:100%;object-fit:contain;">
</div>
                <h3>Notifikasi WhatsApp</h3>
                <p>Dapat notifikasi langsung ke WhatsApp saat makanan habis atau feeding berhasil dilakukan.</p>
            </div>
        </div>
    </section>

    <!-- ===== HOW IT WORKS ===== -->
    <section class="section" id="how-it-works">
        <div class="section-header scroll-hidden">
        
            <h2 class="section-title">Gampang Banget, <span class="highlight">Cuma 3 Langkah!</span></h2>
            <p class="section-desc">Setup PawFeeder cuma butuh beberapa menit. Langsung bisa dipakai!</p>
        </div>
        <div class="steps-container">
            <div class="step-card scroll-hidden">
                <span class="step-emoji">📦</span>
                <div class="step-number">1</div>
                <h3>Pasang Device</h3>
                <p>Hubungkan PawFeeder ke WiFi rumahmu. Colok, connect, done!</p>
            </div>
            <div class="step-card scroll-hidden">
                <span class="step-emoji">⚙️</span>
                <div class="step-number">2</div>
                <h3>Atur di Dashboard</h3>
                <p>Login ke dashboard web, set jadwal makan dan porsi sesuai kebutuhan.</p>
            </div>
            <div class="step-card scroll-hidden">
                <span class="step-emoji">🎉</span>
                <div class="step-number">3</div>
                <h3>Santai Aja!</h3>
                <p>PawFeeder yang kerja. Kamu tinggal terima notifikasi dan pantau dari HP.</p>
            </div>
        </div>
    </section>

     <!-- ===== CTA ===== -->
    <section class="section">
        <div class="cta-section scroll-hidden">
            <span class="cta-paw">🐾</span>
            <span class="cta-paw">🐾</span>
            <span class="cta-paw">🐾</span>
            <span class="cta-paw">🐾</span>
            <h2>Siap Kasih yang Terbaik<br>buat Hewan Kesayanganmu? 🐶</h2>
            <p>Yuk join PawFeeder untuk anabul kesayanganmu!</p>
            <div class="cta-buttons">
                <a href="/signup" class="btn btn-white btn-lg">Daftar Gratis 🚀</a>
                <a href="/login" class="btn btn-ghost btn-lg">Sudah Punya Akun?</a>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <p>© 2026 <a href="#">PawFeeder</a>. Made with ♡ for your furry friends!</p>

    </footer>

    <script>
        // ===== MOBILE NAV TOGGLE =====
        function toggleNav() {
            document.getElementById('navLinks').classList.toggle('open');
        }

        const scrollElements = document.querySelectorAll('.scroll-hidden');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    // 1 second base delay + stagger
                    const stagger = index * 150;
                    setTimeout(() => {
                        entry.target.classList.remove('scroll-hidden');
                        entry.target.classList.add('scroll-reveal');
                    }, 100 + stagger);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        });

        scrollElements.forEach(el => observer.observe(el));

        const poodle = document.getElementById('poodleImg');
        if (poodle) {
            poodle.addEventListener('click', function() {
                this.style.animation = 'none';
                void this.offsetHeight; // trigger reflow
                this.style.animation = 'bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
            });
        }

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    // Close mobile nav
                    document.getElementById('navLinks').classList.remove('open');
                }
            });
        });

        window.addEventListener('scroll', () => {
            const nav = document.querySelector('.navbar');
            if (window.scrollY > 20) {
                nav.style.boxShadow = '0 4px 20px rgba(60,45,20,0.08)';
            } else {
                nav.style.boxShadow = 'none';
            }
        });

        window.addEventListener('mousemove', (e) => {
            const pets = document.querySelectorAll('.floating-pet');
            const x = (e.clientX / window.innerWidth - 0.5) * 20;
            const y = (e.clientY / window.innerHeight - 0.5) * 20;
            pets.forEach((pet, i) => {
                const factor = (i + 1) * 0.5;
                pet.style.transform = `translate(${x * factor}px, ${y * factor}px)`;
            });
        });
    </script>
</body>
</html>
