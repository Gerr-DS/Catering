<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Persetujuan Registrasi Admin - Hafidz Catering</title>
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a472a;
            --primary-dark: #0f2b19;
            --accent: #c28e67;
            --success: #10b981;
            --danger: #ef4444;
            --bg-gradient: linear-gradient(135deg, #f5f9f6 0%, #fbfdfb 100%);
            --text-dark: #1b261e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--bg-gradient);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;
        }

        .result-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 15px 45px rgba(26, 71, 42, 0.08);
            border: 1px solid rgba(26, 71, 42, 0.05);
            padding: 40px;
            width: 100%;
            max-width: 480px;
            text-align: center;
        }

        .status-icon {
            width: 80px;
            height: 80px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }

        .status-icon.success {
            background-color: #ecfdf5;
            color: var(--success);
        }

        .status-icon.danger {
            background-color: #fef2f2;
            color: var(--danger);
        }

        .status-icon svg {
            width: 40px;
            height: 40px;
        }

        h2 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        p {
            font-size: 0.95rem;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #1a472a 0%, #2d613e 100%);
            color: #ffffff;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 6px 18px rgba(26, 71, 42, 0.15);
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(26, 71, 42, 0.25);
        }
    </style>
</head>
<body>
    <div class="result-card">
        @if ($status === 'approved')
            <div class="status-icon success">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h2>Pendaftaran Disetujui</h2>
            <p>{{ $message }}</p>
        @else
            <div class="status-icon danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <h2>Pendaftaran Ditolak</h2>
            <p>{{ $message }}</p>
        @endif

        <a href="{{ route('login') }}" class="btn">Kembali ke Halaman Login</a>
    </div>
</body>
</html>
