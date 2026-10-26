<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login | InvenTrack</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --maroon: #35101f;
            --maroon2: #60243b;
            --accent: #93415e;
            --bg: #f8f4f5;
            --text: #30212a;
            --muted: #8b7b83;
            --border: #eee3e8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            height: 82px;
            padding: 0 6%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            border-bottom: 1px solid var(--border);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: linear-gradient(135deg, #a44765, #60243b);
            color: #fff;
            font-size: 21px;
            font-weight: 800;
        }

        .brand-name {
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -.6px;
        }

        .brand-sub {
            margin-top: 4px;
            color: var(--muted);
            font-size: 10px;
        }

        .top-label {
            color: var(--muted);
            font-size: 12px;
        }

        .main {
            width: 100%;
            max-width: 1320px;
            flex: 1;
            margin: 0 auto;
            padding: 45px 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 1120px;
            min-height: 590px;
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 22px;
            background: #fff;
            box-shadow: 0 25px 70px rgba(53, 16, 31, .09);
        }

        .hero {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 55px 58px;
            overflow: hidden;
            color: #fff;
            background: linear-gradient(145deg, #35101f, #542039 58%, #84344f);
        }

        .hero::before,
        .hero::after {
            position: absolute;
            content: "";
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero::before {
            width: 430px;
            height: 430px;
            right: -190px;
            top: 70px;
        }

        .hero::after {
            width: 310px;
            height: 310px;
            right: -130px;
            top: 130px;
        }

        .hero-content,
        .hero-footer {
            position: relative;
            z-index: 1;
        }

        .eyebrow {
            display: inline-block;
            padding: 9px 13px;
            border: 1px solid #ffffff35;
            border-radius: 30px;
            color: #f0dce4;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .hero h1 {
            max-width: 430px;
            margin: 27px 0 17px;
            font-size: clamp(32px, 3.2vw, 45px);
            line-height: 1.2;
            letter-spacing: -1.7px;
        }

        .hero p {
            max-width: 390px;
            margin: 0;
            color: #e0c7d1;
            font-size: 13px;
            line-height: 2;
        }

        .features {
            display: grid;
            gap: 17px;
            margin-top: 35px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #f3e5ea;
            font-size: 12px;
        }

        .feature-icon {
            width: 31px;
            height: 31px;
            display: grid;
            place-items: center;
            border: 1px solid #ffffff2b;
            border-radius: 9px;
            background: #ffffff0c;
        }

        .hero-footer {
            margin-top: 45px;
            color: #d6b5c2;
            font-size: 10px;
        }

        .form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 65px;
        }

        .form-heading {
            margin-bottom: 32px;
        }

        .form-heading .small-title {
            margin-bottom: 12px;
            color: var(--accent);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.7px;
            text-transform: uppercase;
        }

        .form-heading h2 {
            margin: 0;
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .form-heading p {
            margin: 12px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
        }

        .status {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 9px;
            background: #eaf8f0;
            color: #16734e;
            font-size: 12px;
        }

        .error-box {
            margin-bottom: 20px;
            padding: 13px 15px;
            border: 1px solid #f2d4d9;
            border-radius: 9px;
            background: #fff3f4;
            color: #b42336;
            font-size: 11px;
            line-height: 1.7;
        }

        .field {
            margin-bottom: 22px;
        }

        .field label {
            display: block;
            margin-bottom: 10px;
            color: #493540;
            font-size: 12px;
            font-weight: 700;
        }

        .field input[type="email"],
        .field input[type="password"],
        .field input[type="text"] {
            width: 100%;
            height: 49px;
            padding: 0 15px;
            border: 1px solid #e6dbe0;
            border-radius: 10px;
            outline: none;
            background: #fdfbfc;
            color: var(--text);
            font: inherit;
            font-size: 12px;
            transition: .2s;
        }

        .field input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px #93415e16;
        }

        .field input::placeholder {
            color: #b4a6ad;
        }

        .password-wrap {
            position: relative;
        }

        .password-wrap input {
            padding-right: 78px !important;
        }

        .show-password {
            position: absolute;
            top: 50%;
            right: 13px;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: var(--accent);
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .field-error {
            margin-top: 7px;
            color: #c52b40;
            font-size: 11px;
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin: 2px 0 27px;
            font-size: 11px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #796772;
            cursor: pointer;
        }

        .remember input {
            width: 15px;
            height: 15px;
            accent-color: var(--accent);
        }

        .forgot {
            color: var(--accent);
            font-weight: 700;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .submit-button {
            width: 100%;
            height: 49px;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(100deg, #35101f, #84344f);
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 8px 20px #84344f25;
            transition: .2s;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px #84344f35;
        }

        .form-footer {
            margin-top: 30px;
            padding-top: 19px;
            border-top: 1px solid var(--border);
            color: #a3949c;
            font-size: 10px;
            text-align: center;
        }

        .bottom-footer {
            padding: 18px;
            color: #a3949c;
            font-size: 10px;
            text-align: center;
        }

        @media (max-width: 900px) {
            .main {
                padding: 30px 24px;
            }

            .login-card {
                max-width: 680px;
                grid-template-columns: 1fr;
            }

            .hero {
                min-height: 300px;
                padding: 35px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .features {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .hero-footer {
                margin-top: 30px;
            }

            .form-panel {
                padding: 40px 45px;
            }
        }

        @media (max-width: 520px) {
            .topbar {
                height: 70px;
                padding: 0 20px;
            }

            .top-label {
                display: none;
            }

            .main {
                padding: 18px 12px;
            }

            .login-card {
                border-radius: 16px;
            }

            .hero {
                min-height: auto;
                padding: 27px 24px;
            }

            .hero h1 {
                margin-top: 22px;
                font-size: 29px;
            }

            .hero p {
                font-size: 12px;
            }

            .features {
                grid-template-columns: 1fr;
                gap: 10px;
                margin-top: 24px;
            }

            .hero-footer {
                margin-top: 25px;
            }

            .form-panel {
                padding: 32px 24px;
            }

            .form-heading h2 {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>
<div class="page">

    <header class="topbar">
        <a href="{{ route('login') }}" class="brand">
            <div class="brand-icon">I</div>
            <div>
                <div class="brand-name">InvenTrack</div>
                <div class="brand-sub">Inventory Management System</div>
            </div>
        </a>

        <div class="top-label">Inventory Management Platform</div>
    </header>

    <main class="main">
        <div class="login-card">

            <section class="hero">
                <div class="brand">
                    <div class="brand-icon">I</div>
                    <div>
                        <div class="brand-name">InvenTrack</div>
                        <div class="brand-sub">Inventory Management</div>
                    </div>
                </div>

                <div class="hero-content">
                    <span class="eyebrow">Smart Inventory System</span>

                    <h1>Kelola inventaris dengan lebih teratur.</h1>

                    <p>
                        Pantau stok, kelola produk, dan awasi transaksi
                        bisnis dalam satu sistem yang praktis dan terintegrasi.
                    </p>

                    <div class="features">
                        <div class="feature">
                            <span class="feature-icon">▣</span>
                            Manajemen produk dan stok
                        </div>
                        <div class="feature">
                            <span class="feature-icon">⇧</span>
                            Pemantauan transaksi
                        </div>
                        <div class="feature">
                            <span class="feature-icon">♧</span>
                            Data supplier terorganisir
                        </div>
                    </div>
                </div>

                <div class="hero-footer">
                    Sistem manajemen inventaris untuk bisnis yang lebih teratur.
                </div>
            </section>

            <section class="form-panel">
                <div class="form-heading">
                    <div class="small-title">Selamat datang kembali</div>
                    <h2>Masuk ke akun</h2>
                    <p>
                        Gunakan akun kamu untuk melanjutkan ke Dashboard InvenTrack.
                    </p>
                </div>

                @if (session('status'))
                    <div class="status">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="error-box">
                        Email atau password tidak valid. Periksa kembali data login kamu.
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">
                        <label for="email">Alamat Email</label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            required
                            autofocus
                            autocomplete="username"
                        >

                        @error('email')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password">Password</label>

                        <div class="password-wrap">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Masukkan password"
                                required
                                autocomplete="current-password"
                            >

                            <button
                                type="button"
                                class="show-password"
                                id="password-toggle"
                                onclick="togglePassword()"
                            >Lihat</button>
                        </div>

                        @error('password')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="options">
                        <label class="remember" for="remember_me">
                            <input
                                id="remember_me"
                                type="checkbox"
                                name="remember"
                            >
                            Ingat saya
                        </label>

                        @if (Route::has('password.request'))
                            <a class="forgot" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="submit-button">
                        Masuk ke InvenTrack &nbsp; →
                    </button>
                </form>

                <div class="form-footer">
                    InvenTrack · Inventory Management System · {{ date('Y') }}
                </div>
            </section>

        </div>
    </main>

    <footer class="bottom-footer">
        InvenTrack Inventory Management System
    </footer>

</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const button = document.getElementById('password-toggle');

        if (input.type === 'password') {
            input.type = 'text';
            button.textContent = 'Sembunyi';
        } else {
            input.type = 'password';
            button.textContent = 'Lihat';
        }
    }
</script>
</body>
</html>
