<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/paw-prints.png') }}">
    <title>Daftar - PawFeeder</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg: #f5f0e8;
            --card: #faf8f4;
            --text: #3d3529;
            --text-muted: #8c7e6a;
            --primary: #d4883e;
            --primary-light: #f0c28a;
            --primary-bg: #fef3e2;
            --accent: #5bb88a;
            --accent-bg: #e8f7ef;
            --danger: #d45a5a;
            --danger-bg: #fde8e8;
            --border: #e8e0d4;
            --shadow: 0 2px 16px rgba(60, 45, 20, 0.06);
            --shadow-hover: 0 12px 40px rgba(60, 45, 20, 0.15);
            --radius: 24px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow-x: hidden;
        }

        /* ============ FLOATING MASCOT IMAGES ============ */
        .floating-pet {
            position: absolute;
            pointer-events: none;
            user-select: none;
            z-index: 1;
            filter: drop-shadow(0 6px 12px rgba(60, 45, 20, 0.18));
        }

        .floating-pet img {
            width: 100%;
            height: auto;
            display: block;
            -webkit-user-drag: none;
        }

        .pet-1 {
            width: 80px;
            top: 8%;
            left: 6%;
            animation: bounceFloat 4s ease-in-out infinite;
        }

        .pet-2 {
            width: 70px;
            top: 14%;
            right: 8%;
            animation: bounceFloat 4.5s ease-in-out infinite 0.4s;
        }

        .pet-3 {
            width: 90px;
            bottom: 10%;
            left: 10%;
            animation: bounceFloat 5s ease-in-out infinite 0.8s;
        }

        .pet-4 {
            width: 75px;
            bottom: 14%;
            right: 7%;
            animation: bounceFloat 4.2s ease-in-out infinite 0.2s;
        }

        .pet-5 {
            width: 60px;
            top: 48%;
            left: 3%;
            animation: bounceFloat 5.5s ease-in-out infinite 1s;
        }

        .pet-6 {
            width: 65px;
            top: 55%;
            right: 4%;
            animation: bounceFloat 4.8s ease-in-out infinite 0.6s;
        }

        @keyframes bounceFloat {

            0%,
            100% {
                transform: translateY(0) rotate(-3deg);
            }

            50% {
                transform: translateY(-18px) rotate(3deg);
            }
        }

        .paw-deco {
            position: absolute;
            font-size: 28px;
            opacity: .12;
            pointer-events: none;
            user-select: none;
            z-index: 0;
        }

        .paw-deco.d1 {
            top: 30%;
            left: 18%;
            animation: spin 20s linear infinite;
        }

        .paw-deco.d2 {
            top: 70%;
            left: 25%;
            animation: spin 25s linear infinite reverse;
        }

        .paw-deco.d3 {
            top: 25%;
            right: 22%;
            animation: spin 22s linear infinite;
        }

        .paw-deco.d4 {
            bottom: 30%;
            right: 18%;
            animation: spin 28s linear infinite reverse;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(.3);
                opacity: 0;
            }

            50% {
                transform: scale(1.05);
            }

            70% {
                transform: scale(.95);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes floatY {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes happyJump {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            25% {
                transform: translateY(-12px) scale(1.1);
            }

            50% {
                transform: translateY(0) scale(1);
            }

            75% {
                transform: translateY(-8px) scale(1.05);
            }
        }

        @keyframes peek {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-6px) scale(1.05);
            }
        }

        @keyframes spinLoader {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ============ CARD ============ */
        .login-card {
            width: 100%;
            max-width: 880px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            position: relative;
            z-index: 2;
            animation: bounceIn .7s cubic-bezier(.68, -.55, .265, 1.55) both;
            transition: box-shadow .3s ease;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            min-height: 540px;
        }

        .login-card:hover {
            box-shadow: var(--shadow-hover);
        }

        .card-left {
            background: linear-gradient(135deg, #fef3e2 0%, #f5e4cc 100%);
            padding: 48px 36px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-left::before {
            content: '🐾';
            position: absolute;
            font-size: 200px;
            opacity: .05;
            bottom: -40px;
            right: -30px;
            transform: rotate(-15deg);
        }

        /* MASCOT — gambar saja, tanpa lingkaran */
        .mascot {
            width: 160px;
            height: 160px;
            margin-bottom: 24px;
            position: relative;
            z-index: 2;
            cursor: pointer;
            filter: drop-shadow(0 12px 24px rgba(212, 136, 62, 0.35));
        }

        .mascot img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            pointer-events: none;
            user-select: none;
            -webkit-user-drag: none;
        }

        .mascot.idle {
            animation: floatY 3s ease-in-out infinite;
        }

        .mascot.peek {
            animation: peek .3s ease-out forwards;
        }

        .mascot.happy {
            animation: happyJump .8s ease-in-out 2;
        }

        .brand {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -.5px;
            position: relative;
            z-index: 2;
        }

        .brand .accent {
            color: var(--text);
        }

        .tagline {
            font-size: 14px;
            color: var(--text-muted);
            margin-top: 6px;
            font-weight: 500;
            position: relative;
            z-index: 2;
        }

        .left-quote {
            margin-top: 24px;
            font-size: 13px;
            color: var(--text-muted);
            font-style: italic;
            max-width: 260px;
            line-height: 1.6;
            position: relative;
            z-index: 2;
        }

        .card-right {
            padding: 40px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .header {
            margin-bottom: 24px;
            animation: fadeUp .6s .1s both;
        }

        .welcome {
            font-size: 24px;
            font-weight: 700;
        }

        .sub {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .field {
            animation: fadeUp .5s both;
        }

        .field.f1 {
            animation-delay: .2s;
        }

        .field.f2 {
            animation-delay: .3s;
        }

        .field.f3 {
            animation-delay: .4s;
        }

        .field.f4 {
            animation-delay: .5s;
        }

        .field.f5 {
            animation-delay: .55s;
        }

        .label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 6px;
            display: block;
        }

        .input-wrap {
            position: relative;
        }

        .input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            background: var(--bg);
            border: 2px solid var(--border);
            border-radius: 14px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: var(--text);
            font-weight: 500;
            transition: all .25s ease;
            outline: none;
        }

        .input:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px var(--primary-bg);
        }

        .input.has-error {
            border-color: var(--danger);
            background: var(--danger-bg);
        }

        .input::placeholder {
            color: #b8aa92;
            font-weight: 400;
        }

        /* ICON gambar di dalam input */
        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 22px;
            height: 22px;
            object-fit: contain;
            pointer-events: none;
            user-select: none;
            -webkit-user-drag: none;
            opacity: .9;
        }

        .toggle-eye {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform .2s, opacity .2s;
            opacity: .85;
        }

        .toggle-eye img {
            width: 22px;
            height: 22px;
            object-fit: contain;
            display: block;
            pointer-events: none;
            user-select: none;
            -webkit-user-drag: none;
        }

        .toggle-eye:hover {
            opacity: 1;
            transform: translateY(-50%) scale(1.15);
        }

        .toggle-eye.is-hidden img {
            opacity: .45;
        }

        .error-msg {
            font-size: 12px;
            color: var(--danger);
            margin-top: 6px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* password strength */
        .strength {
            margin-top: 8px;
            display: flex;
            gap: 4px;
            align-items: center;
        }

        .strength-bar {
            flex: 1;
            height: 5px;
            background: var(--border);
            border-radius: 4px;
            overflow: hidden;
        }

        .strength-bar span {
            display: block;
            height: 100%;
            width: 0%;
            background: var(--danger);
            transition: width .3s ease, background .3s ease;
        }

        .strength-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            min-width: 56px;
            text-align: right;
        }

        .row {
            display: flex;
            align-items: center;
            font-size: 13px;
            margin-top: -2px;
        }

        .check {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            cursor: pointer;
            user-select: none;
            color: var(--text-muted);
            font-weight: 500;
            line-height: 1.4;
        }

        .check input {
            display: none;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            border-radius: 6px;
            border: 2px solid var(--border);
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .check input:checked+.checkbox {
            background: var(--primary);
            border-color: var(--primary);
        }

        .check a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
        }

        .check a:hover {
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--primary), #e8a050);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all .25s ease;
            box-shadow: 0 6px 20px rgba(212, 136, 62, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 8px;
        }

        .btn-login:hover:not(:disabled) {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 10px 28px rgba(212, 136, 62, 0.45);
        }

        .btn-login:active:not(:disabled) {
            transform: translateY(0) scale(.98);
        }

        .btn-login:disabled {
            opacity: .85;
            cursor: wait;
        }

        .spinner {
            width: 18px;
            height: 18px;
            border: 2.5px solid rgba(255, 255, 255, .4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spinLoader .7s linear infinite;
        }

        .signup {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
            animation: fadeUp .5s .6s both;
        }

        .signup a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
        }

        .signup a:hover {
            text-decoration: underline;
        }

        /* ============ TOAST ============ */
        .toast {
            position: fixed;
            top: 24px;
            left: 50%;
            transform: translateX(-50%);
            padding: 14px 22px;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 28px rgba(60, 45, 20, .18);
            z-index: 100;
            animation: slideDown .4s cubic-bezier(.68, -.55, .265, 1.55) both;
            max-width: 90vw;
        }

        .toast.success {
            background: var(--accent-bg);
            color: var(--accent);
            border: 1px solid #b5e3cc;
        }

        .toast.error {
            background: var(--danger-bg);
            color: var(--danger);
            border: 1px solid #f5c2c2;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 820px) {
            .login-card {
                grid-template-columns: 1fr;
                max-width: 440px;
                min-height: auto;
            }

            .card-left {
                padding: 36px 24px 28px;
            }

            .mascot {
                width: 120px;
                height: 120px;
                margin-bottom: 16px;
            }

            .brand {
                font-size: 22px;
            }

            .left-quote {
                display: none;
            }

            .card-right {
                padding: 28px 28px 32px;
            }

            .pet-1,
            .pet-2,
            .pet-3,
            .pet-4 {
                width: 55px;
            }

            .pet-5,
            .pet-6 {
                display: none;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 16px;
            }

            .pet-1 {
                top: 2%;
                left: 2%;
            }

            .pet-2 {
                top: 4%;
                right: 2%;
            }

            .pet-3 {
                bottom: 4%;
                left: 2%;
            }

            .pet-4 {
                bottom: 2%;
                right: 2%;
            }
        }
    </style>
</head>

<body>

    {{-- ============ FLOATING MASCOT IMAGES ============ --}}
    <div class="floating-pet pet-1"><img src="{{ asset('images/banana-cat.png') }}" alt=""></div>
    <div class="floating-pet pet-2"><img src="{{ asset('images/doge-dog.png') }}" alt=""></div>
    <div class="floating-pet pet-3"><img src="{{ asset('images/matcha-cat.png') }}" alt=""></div>
    <div class="floating-pet pet-4"><img src="{{ asset('images/paw-prints.png') }}" alt=""></div>
    <div class="floating-pet pet-5"><img src="{{ asset('images/pixel-cat.png') }}" alt=""></div>
    <div class="floating-pet pet-6"><img src="{{ asset('images/poodle.png') }}" alt=""></div>

    {{-- background paws --}}
    <div class="paw-deco d1">🐾</div>
    <div class="paw-deco d2">🦴</div>
    <div class="paw-deco d3">🐾</div>
    <div class="paw-deco d4">🦴</div>

    {{-- TOAST flash --}}
    @if(session('success'))
        <div class="toast success" id="toast">✅ {{ session('success') }}</div>
    @elseif(session('error'))
        <div class="toast error" id="toast">⚠ {{ session('error') }}</div>
    @endif

    {{-- ============ SIGNUP CARD ============ --}}
    <div class="login-card">

        {{-- LEFT: branding --}}
        <div class="card-left">
            <div class="mascot idle" id="mascot">
                <img src="{{ asset('images/dimsum-cat.png') }}" alt="PawFeeder Mascot">
            </div>
            <div class="brand">Paw<span class="accent">Feeder</span></div>
            <div class="tagline">Smart Pet Feeder System</div>
            <div class="left-quote">
                Yuk, buat akun PawFeeder kamu biar anabul di rumah ga pernah telat makan,
                bahkan saat kamu lagi sibuk <3 </div>
            </div>

            {{-- RIGHT: form --}}
            <div class="card-right">
                <div class="header">
                    <div class="welcome">Yuk, bikin akun baru!</div>
                    <div class="sub">Daftar dulu, biar anabul kamu bisa makan teratur :D</div>
                </div>

                <form method="POST" action="{{ route('signup.post') }}" class="form" id="signupForm" novalidate>
                    @csrf

                    <div class="field f1">
                        <label class="label" for="name">Nama Lengkap</label>
                        <div class="input-wrap">
                            <img src="{{ asset('images/surat.png') }}" class="input-icon" alt="">
                            <input type="text" id="name" name="name" class="input @error('name') has-error @enderror"
                                placeholder="Nama kamu" value="{{ old('name') }}" autocomplete="name" required>
                        </div>
                        @error('name')
                            <div class="error-msg">⚠ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field f2">
                        <label class="label" for="email">Email</label>
                        <div class="input-wrap">
                            <img src="{{ asset('images/surat.png') }}" class="input-icon" alt="">
                            <input type="email" id="email" name="email"
                                class="input @error('email') has-error @enderror" placeholder="kamu@pawfeeder.com"
                                value="{{ old('email') }}" autocomplete="email" required>
                        </div>
                        @error('email')
                            <div class="error-msg">⚠ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field f3">
                        <label class="label" for="password">Password</label>
                        <div class="input-wrap">
                            <img src="{{ asset('images/gembok.png') }}" class="input-icon" alt="">
                            <input type="password" id="password" name="password"
                                class="input @error('password') has-error @enderror" placeholder="Minimal 8 karakter"
                                autocomplete="new-password" style="padding-right: 44px;" required>
                            <button type="button" id="toggleEye" class="toggle-eye is-hidden"
                                aria-label="Toggle password">
                                <img src="{{ asset('images/mata.png') }}" alt="">
                            </button>
                        </div>
                        <div class="strength" id="strengthWrap" style="display:none;">
                            <div class="strength-bar"><span id="strengthBar"></span></div>
                            <div class="strength-label" id="strengthLabel">Lemah</div>
                        </div>
                        @error('password')
                            <div class="error-msg">⚠ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field f4">
                        <label class="label" for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-wrap">
                            <img src="{{ asset('images/gembok.png') }}" class="input-icon" alt="">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="input"
                                placeholder="Ulangi password kamu" autocomplete="new-password"
                                style="padding-right: 44px;" required>
                            <button type="button" id="toggleEye2" class="toggle-eye is-hidden"
                                aria-label="Toggle password">
                                <img src="{{ asset('images/mata.png') }}" alt="">
                            </button>
                        </div>
                        <div class="error-msg" id="matchMsg" style="display:none;">⚠ Password tidak sama</div>
                    </div>

                    <div class="field f5 row">
                        <label class="check">
                            <input type="checkbox" name="terms" id="terms" required>
                            <span class="checkbox">✓</span>
                            <span>Saya setuju dengan <a href="#">Syarat &amp; Ketentuan</a> PawFeeder</span>
                        </label>
                    </div>

                    <button type="submit" class="btn-login" id="submitBtn">
                        <span id="btnText">Daftar Sekarang</span>
                    </button>

                    <div class="signup">
                        Sudah punya akun?
                        <a href="{{ route('login') }}">Login di sini</a>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // ===== MASCOT INTERACTIONS =====
            const mascot = document.getElementById('mascot');
            function setMascot(state) {
                if (!mascot) return;
                mascot.classList.remove('idle', 'peek', 'happy');
                mascot.classList.add(state);
                if (state === 'happy') {
                    setTimeout(() => setMascot('idle'), 1600);
                }
            }

            mascot?.addEventListener('click', () => setMascot('happy'));

            // Peek saat fokus di password / konfirmasi
            ['password', 'password_confirmation'].forEach(id => {
                const el = document.getElementById(id);
                el?.addEventListener('focus', () => setMascot('peek'));
                el?.addEventListener('blur', () => setMascot('idle'));
            });

            // Happy saat ketik nama / email
            ['name', 'email'].forEach(id => {
                const el = document.getElementById(id);
                let t;
                el?.addEventListener('input', () => {
                    clearTimeout(t);
                    setMascot('happy');
                    t = setTimeout(() => setMascot('idle'), 900);
                });
            });

            // ===== PASSWORD TOGGLE =====
            function bindToggle(btnId, inputId) {
                const btn = document.getElementById(btnId);
                const input = document.getElementById(inputId);
                btn?.addEventListener('click', () => {
                    const hidden = input.type === 'password';
                    input.type = hidden ? 'text' : 'password';
                    btn.classList.toggle('is-hidden', !hidden);
                    setMascot('happy');
                });
            }
            bindToggle('toggleEye', 'password');
            bindToggle('toggleEye2', 'password_confirmation');

            // ===== PASSWORD STRENGTH =====
            const pwd = document.getElementById('password');
            const strengthWrap = document.getElementById('strengthWrap');
            const strengthBar = document.getElementById('strengthBar');
            const strengthLabel = document.getElementById('strengthLabel');

            function scorePassword(p) {
                let score = 0;
                if (!p) return 0;
                if (p.length >= 8) score++;
                if (p.length >= 12) score++;
                if (/[A-Z]/.test(p)) score++;
                if (/[0-9]/.test(p)) score++;
                if (/[^A-Za-z0-9]/.test(p)) score++;
                return score;
            }

            pwd?.addEventListener('input', () => {
                const val = pwd.value;
                if (!val) { strengthWrap.style.display = 'none'; return; }
                strengthWrap.style.display = 'flex';
                const s = scorePassword(val);
                const pct = Math.min(100, (s / 5) * 100);
                strengthBar.style.width = pct + '%';
                let color = '#d45a5a', label = 'Lemah';
                if (s >= 4) { color = '#5bb88a'; label = 'Kuat'; }
                else if (s >= 2) { color = '#e8a050'; label = 'Sedang'; }
                strengthBar.style.background = color;
                strengthLabel.style.color = color;
                strengthLabel.textContent = label;
                checkMatch();
            });

            // ===== PASSWORD MATCH =====
            const pwd2 = document.getElementById('password_confirmation');
            const matchMsg = document.getElementById('matchMsg');
            function checkMatch() {
                if (!pwd2.value) { matchMsg.style.display = 'none'; pwd2.classList.remove('has-error'); return true; }
                const ok = pwd.value === pwd2.value;
                matchMsg.style.display = ok ? 'none' : 'flex';
                pwd2.classList.toggle('has-error', !ok);
                return ok;
            }
            pwd2?.addEventListener('input', checkMatch);

            // ===== FORM SUBMIT =====
            const form = document.getElementById('signupForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');

            form?.addEventListener('submit', (e) => {
                if (!checkMatch()) {
                    e.preventDefault();
                    setMascot('happy');
                    return;
                }
                submitBtn.disabled = true;
                btnText.textContent = 'Mendaftarkan...';
                const sp = document.createElement('span');
                sp.className = 'spinner';
                submitBtn.prepend(sp);
                setMascot('happy');
            });

            // ===== TOAST AUTO HIDE =====
            const toast = document.getElementById('toast');
            if (toast) {
                setTimeout(() => {
                    toast.style.transition = 'opacity .4s, transform .4s';
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(-50%) translateY(-20px)';
                    setTimeout(() => toast.remove(), 400);
                }, 3500);
            }
        </script>
</body>

</html>