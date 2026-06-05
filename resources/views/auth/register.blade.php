<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - Hafidz Catering</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #065f46, #0f766e, #064e3b);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .card {
            background: rgba(255, 255, 255, 0.96);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 420px;
        }
        h2 { text-align: center; color: #1f2937; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-size: 0.875rem; color: #4b5563; margin-bottom: 5px; font-weight: 600;}
        input { width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #064e3b; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; margin-top: 10px;}
        button:hover { background: #065f46; }
        .error-list { color: #b91c1c; background: #fee2e2; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 0.875rem;}
    </style>
</head>
<body>

    <div class="card">
        <h2>Sign Up</h2>

        @if (session('status'))
            <div style="background-color: #d1fae5; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.875rem; border: 1px solid #34d399; font-weight: 500; line-height: 1.5;">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-list">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/register') }}">
            @csrf

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required autofocus>
            </div>

            <div class="form-group">
                <label for="username">Email</label>
                <input type="email" id="username" name="username" placeholder="contoh@domain.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit">Register / Buat Akun</button>
            
            <div style="text-align: center; margin-top: 20px; font-size: 0.875rem;">
                Sudah punya akun? <a href="{{ route('login') }}" style="color: #c2410c; text-decoration: none; font-weight: bold;">Sign In di sini</a>
            </div>
        </form>
    </div>

</body>
</html>