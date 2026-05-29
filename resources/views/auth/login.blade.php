<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In - Hafidz Catering Management Portal</title>

    <style>
        :root {
            --primary: #064e3b; /* Emerald 900 */
            --primary-hover: #065f46;
            --accent: #c2410c; /* Orange 700 */
            --text-main: #1f2937;
            --text-muted: #9ca3af;
            --bg-gradient: linear-gradient(135deg, #065f46, #0f766e, #064e3b);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #374151;
            padding: 24px;
        }

        /* Container utama */
        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(8px);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 420px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Header Logo */
        .brand-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 32px;
        }

        .brand-icon {
            background: var(--primary);
            color: #ffffff;
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-icon svg {
            width: 32px;
            height: 32px;
        }

        .brand-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .brand-subtitle {
            font-size: 0.65rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-top: 4px;
        }

        /* Judul Section */
        .section-title {
            margin-bottom: 24px;
        }

        .section-title h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .section-title p {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 4px;
        }

        /* Form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: #4b5563;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
            display: block;
            width: 100%;
        }

        .input-wrapper svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            width: 20px;
            height: 20px;
            z-index: 5;
        }

        .form-input {
            display: block;
            width: 100%;
            padding: 12px 42px 12px 42px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            outline: none;
            background: #ffffff;
            transition: border-color 0.15s, box-shadow 0.15s;
            box-sizing: border-box;
        }

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(6, 78, 59, 0.2);
        }

        .forgot-password-link {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--accent);
            text-decoration: none;
        }

        .forgot-password-link:hover {
            text-decoration: underline;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            height: 20px;
            width: 20px;
        }

        .password-toggle:hover {
            color: #4b5563;
        }

        /* Checkbox Remember Me */
        .remember-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember-group input {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
        }

        .remember-group label {
            font-size: 0.875rem;
            color: #4b5563;
            margin-left: 8px;
            text-transform: none;
            letter-spacing: normal;
        }

        /* Tombol Submit */
        .submit-btn {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.15s;
        }

        .submit-btn:hover {
            background: var(--primary-hover);
        }

        /* Footer Support */
        .footer-support {
            margin-top: 32px;
            text-align: center;
            font-size: 0.75rem;
            color: #9ca3af;
            border-top: 1px solid #f3f4f6;
            padding-top: 20px;
        }

        .footer-support a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .footer-support a:hover {
            text-decoration: underline;
        }

        /* Footer Halaman */
        .page-footer {
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: center;
            color: rgba(204, 251, 241, 0.7);
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        @media (min-width: 768px) {
            .page-footer {
                flex-direction: row;
                justify-content: space-between;
            }
        }

        .page-footer a {
            color: inherit;
            text-decoration: none;
            margin-left: 16px;
        }

        .page-footer a:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>

    <div></div> <div class="login-wrapper">
        <div class="login-card">
            
            <div class="brand-container">
                <div class="brand-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h1 class="brand-title">Hafidz Catering</h1>
                <span class="brand-subtitle">Management Portal</span>
            </div>

            <div class="section-title">
                <h2>Sign In</h2>
                <p>Selamat datang kembali! Silakan masukkan email dan kata sandi Anda.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if ($errors->any())
            <div style="background-color: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 0.875rem; border: 1px solid #f87171;">
                {{ $errors->first() }}
            </div>
                @endif

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <input class="form-input" id="email" type="email" name="email" required autofocus autocomplete="username" placeholder="name@hafidzcatering.com">
                    </div>
                </div>

                <div class="form-group">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <label for="password" style="margin-bottom: 0;">Password</label>
                    </div>
                    <div class="input-wrapper">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input class="form-input" id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                        <button type="button" class="password-toggle">
                            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="remember-group">
                    <input id="remember_me" name="remember" type="checkbox">
                    <label for="remember_me">Remember this session</label>
                </div>

                <button type="submit" class="submit-btn">
                    Sign In to Portal &rarr;
                </button>
            </form>

            <div class="footer-support">
                Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const passwordInput = document.getElementById('password');
                    const passwordToggle = document.querySelector('.password-toggle');
                    
                    passwordToggle.addEventListener('click', function () {
                        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordInput.setAttribute('type', type);
                        
                        if (type === 'text') {
                            passwordToggle.style.color = '#064e3b';
                        } else {
                            passwordToggle.style.color = '#9ca3af';
                        }
                    });
                });
            </script>
        </div>
    </div>

    <div class="page-footer" style="justify-content: center; text-align: center;">
        <div>&copy; 2026 Hafidz Catering Management. Crafted for Culinary Excellence.</div>
    </div>

</body>
</html>