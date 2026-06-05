
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Keuangan - HafidzManage</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #059669;
            --primary-dark: #064e3b;
            --green: #059669;
            --red: #dc2626;

            --bg-color: #f8f9fa;
            --sidebar-width: 260px;

            --text-dark: #111827;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;

            --card-bg: #ffffff;
            --card-radius: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            background-color: var(--bg-color);
            color: var(--text-dark);
            overflow: hidden;
        }

        /* SIDEBAR */

        .sidebar {
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            padding: 30px 20px;
            height: 100vh;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 100;
            flex-shrink: 0;
        }

        .sidebar.collapsed {
            width: 0;
            padding: 30px 0;
            overflow: hidden;
            border-right: none;
        }

        /* Toggle Button */
        .sidebar-toggle-btn {
            background: white;
            border: 1px solid var(--border-color);
            color: var(--text-dark);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            flex-shrink: 0;
        }

        .sidebar-toggle-btn:hover {
            background: #f9fafb;
            border-color: #cbd5e1;
        }

        .sidebar-header {
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            background: var(--primary);
            color: white;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-header-text h2 {
            color: var(--primary);
            font-size: 1.1rem;
            font-weight: 700;
        }

        .sidebar-header-text span {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .sidebar-menu {
            list-style: none;
            flex: 1;
        }

        .sidebar-menu li {
            margin-bottom: 8px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            text-decoration: none;
            color: var(--text-muted);
            border-radius: 10px;
            font-weight: 500;
            transition: 0.2s;
        }

        .sidebar-menu a:hover {
            background: #ecfdf5;
            color: var(--primary);
        }

        .sidebar-menu a.active {
            background: #d1fae5;
            color: var(--primary);
        }

        .sidebar-bottom {
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .sidebar-bottom button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border: none;
            background: none;
            border-radius: 10px;
            cursor: pointer;
            color: var(--text-muted);
            font-weight: 500;
        }

        .sidebar-bottom button:hover {
            background: #f3f4f6;
        }

        /* MAIN */

        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .top-header {
            padding: 30px 40px 10px;
        }

        .header-title h1 {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .header-title p {
            color: var(--text-muted);
            margin-top: 4px;
            font-size: 0.9rem;
        }

        .main-content {
            flex: 1;
            overflow-y: auto;
            padding: 20px 40px 40px;
        }

        /* ALERT */

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-weight: 500;
        }

        /* CARD */

        .card,
        .stat-box,
        .chart-container,
        .form-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.05);
        }

        /* GRID */

        .financial-grid {
            display: grid;
            grid-template-columns: 1.2fr 2fr;
            gap: 24px;
            margin-bottom: 30px;
        }

        .side-stats {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* INCOME */

        .income-card h3 {
            color: var(--green);
            margin-bottom: 20px;
            font-size: 1.1rem;
        }

        .income-card .amount {
            font-size: 3rem;
            font-weight: 800;
        }

        .stat-box h3 {
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .pemasukkan-title {
            color: var(--green);
        }

        .pengeluaran-title {
            color: var(--red);
        }

        .stat-box .amount {
            font-size: 2rem;
            font-weight: 700;
        }

        /* CHART */

        /* TRADING VIEW CHART CUSTOM STYLE */
        .chart-container {
            background: #ffffff;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 10px 30px -5px rgba(26, 71, 42, 0.04), 0 4px 12px -5px rgba(26, 71, 42, 0.02);
            border: 1px solid rgba(26, 71, 42, 0.05);
            margin-bottom: 30px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .chart-container:hover {
            box-shadow: 0 20px 40px -5px rgba(26, 71, 42, 0.07), 0 10px 15px -5px rgba(26, 71, 42, 0.03);
            transform: translateY(-2px);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .period-selector {
            display: flex;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 12px;
            gap: 2px;
        }

        .period-btn {
            background: transparent;
            border: none;
            color: #64748b;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .period-btn:hover {
            color: #1e293b;
            background: rgba(255, 255, 255, 0.5);
        }

        .period-btn.active {
            color: #1e293b;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .change-indicator {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50px;
        }

        .change-indicator.positive {
            color: #10b981;
            background: rgba(16, 185, 129, 0.1);
        }

        .change-indicator.negative {
            color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
        }
        /* FORM */

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .form-card h3 {
            margin-bottom: 24px;
            font-size: 1.1rem;
        }

        .form-icon {
            width: 70px;
            height: 70px;
            margin: auto;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-icon i {
            font-size: 2.5rem;
        }

        .form-icon.red {
            color: var(--red);
        }

        .form-icon.green {
            color: var(--green);
        }

        .form-card p {
            text-align: center;
            margin-bottom: 24px;
            color: var(--text-muted);
        }

        .input-group {
            margin-bottom: 14px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #f9fafb;
            outline: none;
            transition: 0.2s;
        }

        .input-group input:focus {
            border-color: var(--primary);
            background: white;
        }

        .btn-pengeluaran,
        .btn-pemasukkan {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-pengeluaran {
            background: var(--red);
        }

        .btn-pemasukkan {
            background: var(--green);
        }

        .btn-pengeluaran:hover,
        .btn-pemasukkan:hover {
            opacity: 0.9;
        }



        @media (max-width: 768px) {
            body {
                position: relative;
            }

            .sidebar {
                position: fixed !important;
                left: 0;
                top: 0;
                height: 100vh !important;
                z-index: 1000 !important;
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                transform: translateX(0);
                width: 260px !important;
                padding: 30px 20px !important;
                border-right: 1px solid var(--border-color) !important;
                box-shadow: 10px 0 30px rgba(0,0,0,0.1);
            }

            .sidebar.collapsed {
                transform: translateX(-100%) !important;
                width: 260px !important;
                border-right: none !important;
                padding: 30px 20px !important;
            }

            .main-wrapper {
                width: 100% !important;
                height: 100vh !important;
                display: flex !important;
                flex-direction: column !important;
                padding: 0 !important;
                overflow: hidden !important;
            }

            .main-content {
                width: 100% !important;
                flex: 1 !important;
                padding: 12px !important;
                overflow-x: hidden !important;
                overflow-y: auto !important;
            }

            .top-header {
                padding: 15px 15px 5px !important;
            }

            .sidebar-close-btn {
                display: block !important;
            }

            .financial-grid {
                grid-template-columns: minmax(0, 1.1fr) minmax(0, 1.5fr) !important;
                gap: 8px !important;
                margin-bottom: 16px !important;
            }

            .financial-grid .card,
            .financial-grid .stat-box {
                padding: 10px !important;
            }

            .financial-grid .income-card .amount {
                font-size: 1.25rem !important;
            }

            .financial-grid .stat-box .amount {
                font-size: 0.95rem !important;
            }

            .financial-grid .side-stats {
                gap: 8px !important;
            }

            .financial-grid .income-card h3 {
                margin-bottom: 8px !important;
                font-size: 0.75rem !important;
            }

            .financial-grid .stat-box h3 {
                margin-bottom: 6px !important;
                font-size: 0.72rem !important;
            }

            .chart-container {
                padding: 12px !important;
                margin-bottom: 20px !important;
            }

            .chart-header {
                margin-bottom: 12px !important;
                gap: 8px !important;
            }

            .chart-title h3 {
                font-size: 0.95rem !important;
            }

            .chart-title p {
                font-size: 0.7rem !important;
            }

            .chart-title > div {
                flex-wrap: wrap !important;
                white-space: normal !important;
                gap: 6px !important;
            }

            .period-selector {
                gap: 1px !important;
                padding: 2px !important;
                width: 100% !important;
                justify-content: space-between !important;
            }

            .period-btn {
                padding: 4px 6px !important;
                font-size: 0.7rem !important;
                flex: 1 !important;
                text-align: center !important;
            }

            .form-grid {
                grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) !important;
                gap: 8px !important;
            }

            .form-card {
                padding: 10px !important;
                border-radius: 12px !important;
            }

            .form-card h3 {
                margin-bottom: 8px !important;
                font-size: 0.8rem !important;
                text-align: center;
            }

            .form-icon {
                width: 36px !important;
                height: 36px !important;
                margin-bottom: 6px !important;
            }

            .form-icon i {
                font-size: 1.25rem !important;
            }

            .form-card p {
                display: none !important;
            }

            .input-group {
                margin-bottom: 8px !important;
            }

            .input-group input {
                padding: 6px 8px !important;
                font-size: 0.75rem !important;
                border-radius: 6px !important;
            }

            .btn-pengeluaran,
            .btn-pemasukkan {
                padding: 8px 4px !important;
                font-size: 0.72rem !important;
                border-radius: 6px !important;
                white-space: normal !important;
                line-height: 1.2 !important;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div class="logo-icon">
                    <i class="fa-solid fa-utensils"></i>
                </div>

                <div class="sidebar-header-text">
                    <h2>Hafidz Catering</h2>
                    <span>PORTAL MANAJEMEN</span>
                </div>
            </div>
            <button class="sidebar-close-btn" onclick="toggleSidebar()" style="display: none; background: none; border: none; font-size: 1.5rem; color: var(--text-muted); cursor: pointer;">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="active">
                    <i class="fa-solid fa-border-all"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.stock.index') }}">
                    <i class="fa-solid fa-box"></i>
                    <span>Manajemen Stok</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.menu.index') }}">
                    <i class="fa-solid fa-list"></i>
                    <span>Manajemen Menu</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.reports') }}">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Laporan Keuangan</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-bottom">
            <form method="POST" action="/logout">
                @csrf

                <button type="submit">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>

    </aside>

    <div class="main-wrapper">

        <div class="top-header" style="display: flex; align-items: center; gap: 20px;">
            <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="header-title">
                <h1>Ringkasan Keuangan</h1>
                <p>Ringkasan kinerja operasional Hafidz Catering harian.</p>
            </div>
        </div>

        <main class="main-content">

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="financial-grid">

                <div class="side-stats">

                    <div class="stat-box">
                        <h3 class="pemasukkan-title">Total Pemasukkan</h3>

                        <div class="amount" id="pemasukkanAmount">
                            Rp. {{ number_format($totalPemasukkan ?? 0, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="stat-box">
                        <h3 class="pengeluaran-title">Total Pengeluaran</h3>

                        <div class="amount" id="pengeluaranAmount">
                            Rp. {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}
                        </div>
                    </div>

                </div>

                <div class="card income-card">
                    <h3>Pendapatan Bersih (Net Income)</h3>

                    <div class="amount" id="incomeAmount">
                        Rp. {{ number_format($income ?? 0, 0, ',', '.') }}
                    </div>
                </div>

            </div>

            <div class="chart-container">

                <div class="chart-header">

                    <div class="chart-title">
                        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: nowrap; white-space: nowrap;">
                            <h3 style="margin: 0; font-size: 1.2rem; font-weight: 700; color: #1e293b;">Analisis Keuangan Modern</h3>
                            <div id="chartChangeIndicator" class="change-indicator positive" style="flex-shrink: 0;">
                                <span class="arrow">▲</span> <span class="percentage">0.0%</span>
                            </div>
                        </div>
                        <p style="margin: 4px 0 0 0; font-size: 0.85rem; color: #64748b;">Performa Pemasukkan, Pengeluaran & Pendapatan Bersih</p>
                    </div>

                    <div class="period-selector">
                        <button class="period-btn" data-period="1D">1D</button>
                        <button class="period-btn" data-period="7D">7D</button>
                        <button class="period-btn active" data-period="1M">1M</button>
                        <button class="period-btn" data-period="3M">3M</button>
                        <button class="period-btn" data-period="6M">6M</button>
                        <button class="period-btn" data-period="1Y">1Y</button>
                        <button class="period-btn" data-period="ALL">ALL</button>
                    </div>

                </div>

                <div style="position: relative; height:320px; width:100%">
                    <canvas id="financeDynamicChart"></canvas>
                </div>

            </div>

            <div class="form-grid">

                <div class="form-card">

                    <h3>Catat Pemasukkan</h3>

                    <div class="form-icon green">
                        <i class="fa-solid fa-money-bill-trend-up"></i>
                    </div>

                    <p>Masukkan data pemasukkan anda disini</p>

                    <form action="{{ route('admin.financial.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="type" value="pemasukkan">

                        <div class="input-group">
                            <input type="number" name="amount"
                                placeholder="Nominal" required>
                        </div>

                        <div class="input-group">
                            <input type="text" name="description"
                                placeholder="Keterangan" required>
                        </div>

                        <button type="submit" class="btn-pemasukkan">
                            + Tambah Pemasukkan
                        </button>
                    </form>

                </div>

                <div class="form-card">

                    <h3>Catat Pengeluaran</h3>

                    <div class="form-icon red">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                    </div>

                    <p>Masukkan data pengeluaran anda disini</p>

                    <form action="{{ route('admin.financial.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="type" value="pengeluaran">

                        <div class="input-group">
                            <input type="number" name="amount"
                                placeholder="Nominal" required>
                        </div>

                        <div class="input-group">
                            <input type="text" name="description"
                                placeholder="Keterangan" required>
                        </div>

                        <button type="submit" class="btn-pengeluaran">
                            + Tambah Pengeluaran
                        </button>
                    </form>

                </div>

            </div>

        </main>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const ctx = document.getElementById('financeDynamicChart').getContext('2d');

            let myFinanceChart;

            // Ambil data transaksi mentah dari database via JSON
            const rawTransactions = @json($transactions);

            // Daftar hari, bulan bahasa Indonesia
            const indonesianDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const indonesianMonthsShort = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const indonesianMonthsFull = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            // Utilitas parsing tanggal & format local timezone
            const parseDate = (dateStr) => {
                const parts = dateStr.split('-');
                return new Date(parts[0], parts[1] - 1, parts[2]); // local timezone
            };

            const getLocalDateString = (date) => {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            };

            const getTxHour = (tx) => {
                if (!tx.created_at) return 12;
                const timePart = tx.created_at.split(' ')[1] || tx.created_at.split('T')[1];
                if (!timePart) return 12;
                return parseInt(timePart.split(':')[0], 10);
            };

            // Fungsi utama untuk memfilter dan mengelompokkan data berdasarkan periode
            function getChartDataForPeriod(period) {
                const now = new Date();
                let labels = [];
                let pemasukkan = [];
                let pengeluaran = [];
                let income = [];
                let totals = { pemasukkan: 0, pengeluaran: 0, income: 0 };

                if (period === '1D') {
                    // Filter transaksi hari ini saja
                    const todayStr = getLocalDateString(now);
                    const todayTxs = rawTransactions.filter(t => t.tanggal === todayStr);

                    labels = ['09:00', '12:00', '15:00', '18:00', '21:00'];
                    pemasukkan = [0, 0, 0, 0, 0];
                    pengeluaran = [0, 0, 0, 0, 0];
                    income = [0, 0, 0, 0, 0];

                    todayTxs.forEach(tx => {
                        const amount = parseFloat(tx.nominal);
                        const hour = getTxHour(tx);
                        let idx = 0;
                        if (hour < 11) idx = 0;
                        else if (hour < 14) idx = 1;
                        else if (hour < 17) idx = 2;
                        else if (hour < 20) idx = 3;
                        else idx = 4;

                        if (tx.jenis_transaksi == 1) {
                            pemasukkan[idx] += amount;
                            totals.pemasukkan += amount;
                        } else {
                            pengeluaran[idx] += amount;
                            totals.pengeluaran += amount;
                        }
                    });

                    // Akumulasi kumulatif untuk grafik garis yang halus
                    for (let i = 1; i < 5; i++) {
                        pemasukkan[i] += pemasukkan[i-1];
                        pengeluaran[i] += pengeluaran[i-1];
                    }
                    for (let i = 0; i < 5; i++) {
                        income[i] = pemasukkan[i] - pengeluaran[i];
                    }
                    totals.income = totals.pemasukkan - totals.pengeluaran;

                } else if (period === '7D') {
                    // 7 Hari Terakhir
                    const days = [];
                    for (let i = 6; i >= 0; i--) {
                        const d = new Date();
                        d.setDate(now.getDate() - i);
                        days.push(d);
                    }

                    labels = days.map(d => indonesianDays[d.getDay()]);
                    pemasukkan = [0, 0, 0, 0, 0, 0, 0];
                    pengeluaran = [0, 0, 0, 0, 0, 0, 0];
                    income = [0, 0, 0, 0, 0, 0, 0];

                    const dateStrings = days.map(d => getLocalDateString(d));

                    rawTransactions.forEach(tx => {
                        const idx = dateStrings.indexOf(tx.tanggal);
                        if (idx !== -1) {
                            const amount = parseFloat(tx.nominal);
                            if (tx.jenis_transaksi == 1) {
                                pemasukkan[idx] += amount;
                                totals.pemasukkan += amount;
                            } else {
                                pengeluaran[idx] += amount;
                                totals.pengeluaran += amount;
                            }
                        }
                    });

                    // Akumulasi kumulatif
                    for (let i = 1; i < 7; i++) {
                        pemasukkan[i] += pemasukkan[i-1];
                        pengeluaran[i] += pengeluaran[i-1];
                    }
                    for (let i = 0; i < 7; i++) {
                        income[i] = pemasukkan[i] - pengeluaran[i];
                    }
                    totals.income = totals.pemasukkan - totals.pengeluaran;

                } else if (period === '1M') {
                    // 1 Bulan Terakhir (dibagi 4 Minggu)
                    labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
                    pemasukkan = [0, 0, 0, 0];
                    pengeluaran = [0, 0, 0, 0];
                    income = [0, 0, 0, 0];

                    rawTransactions.forEach(tx => {
                        const txDate = parseDate(tx.tanggal);
                        const diffTime = now - txDate;
                        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));

                        if (diffDays >= 0 && diffDays < 30) {
                            const amount = parseFloat(tx.nominal);
                            let idx = 0;
                            if (diffDays >= 21) idx = 0;      // Minggu 1
                            else if (diffDays >= 14) idx = 1; // Minggu 2
                            else if (diffDays >= 7) idx = 2;  // Minggu 3
                            else idx = 3;                     // Minggu 4

                            if (tx.jenis_transaksi == 1) {
                                pemasukkan[idx] += amount;
                                totals.pemasukkan += amount;
                            } else {
                                pengeluaran[idx] += amount;
                                totals.pengeluaran += amount;
                            }
                        }
                    });

                    // Akumulasi kumulatif
                    for (let i = 1; i < 4; i++) {
                        pemasukkan[i] += pemasukkan[i-1];
                        pengeluaran[i] += pengeluaran[i-1];
                    }
                    for (let i = 0; i < 4; i++) {
                        income[i] = pemasukkan[i] - pengeluaran[i];
                    }
                    totals.income = totals.pemasukkan - totals.pengeluaran;

                } else if (period === '3M') {
                    // 3 Bulan Terakhir
                    const months = [];
                    for (let i = 2; i >= 0; i--) {
                        const d = new Date(now.getFullYear(), now.getMonth() - i, 1);
                        months.push(d);
                    }

                    labels = months.map(m => indonesianMonthsFull[m.getMonth()]);
                    pemasukkan = [0, 0, 0];
                    pengeluaran = [0, 0, 0];
                    income = [0, 0, 0];

                    rawTransactions.forEach(tx => {
                        const txDate = parseDate(tx.tanggal);
                        months.forEach((m, idx) => {
                            if (txDate.getFullYear() === m.getFullYear() && txDate.getMonth() === m.getMonth()) {
                                const amount = parseFloat(tx.nominal);
                                if (tx.jenis_transaksi == 1) {
                                    pemasukkan[idx] += amount;
                                    totals.pemasukkan += amount;
                                } else {
                                    pengeluaran[idx] += amount;
                                    totals.pengeluaran += amount;
                                }
                            }
                        });
                    });

                    // Akumulasi kumulatif
                    for (let i = 1; i < 3; i++) {
                        pemasukkan[i] += pemasukkan[i-1];
                        pengeluaran[i] += pengeluaran[i-1];
                    }
                    for (let i = 0; i < 3; i++) {
                        income[i] = pemasukkan[i] - pengeluaran[i];
                    }
                    totals.income = totals.pemasukkan - totals.pengeluaran;

                } else if (period === '6M') {
                    // 6 Bulan Terakhir
                    const months = [];
                    for (let i = 5; i >= 0; i--) {
                        const d = new Date(now.getFullYear(), now.getMonth() - i, 1);
                        months.push(d);
                    }

                    labels = months.map(m => indonesianMonthsShort[m.getMonth()]);
                    pemasukkan = [0, 0, 0, 0, 0, 0];
                    pengeluaran = [0, 0, 0, 0, 0, 0];
                    income = [0, 0, 0, 0, 0, 0];

                    rawTransactions.forEach(tx => {
                        const txDate = parseDate(tx.tanggal);
                        months.forEach((m, idx) => {
                            if (txDate.getFullYear() === m.getFullYear() && txDate.getMonth() === m.getMonth()) {
                                const amount = parseFloat(tx.nominal);
                                if (tx.jenis_transaksi == 1) {
                                    pemasukkan[idx] += amount;
                                    totals.pemasukkan += amount;
                                } else {
                                    pengeluaran[idx] += amount;
                                    totals.pengeluaran += amount;
                                }
                            }
                        });
                    });

                    // Akumulasi kumulatif
                    for (let i = 1; i < 6; i++) {
                        pemasukkan[i] += pemasukkan[i-1];
                        pengeluaran[i] += pengeluaran[i-1];
                    }
                    for (let i = 0; i < 6; i++) {
                        income[i] = pemasukkan[i] - pengeluaran[i];
                    }
                    totals.income = totals.pemasukkan - totals.pengeluaran;

                } else if (period === '1Y') {
                    // Filter tahunan dimulai dari tahun 2026
                    const startYear = 2026;
                    const currentYear = now.getFullYear();
                    const currentMonth = now.getMonth();

                    const monthPairs = [];
                    for (let y = startYear; y <= currentYear; y++) {
                        const maxM = (y === currentYear) ? currentMonth : 11;
                        for (let m = 0; m <= maxM; m++) {
                            monthPairs.push({ year: y, month: m });
                        }
                    }

                    labels = monthPairs.map(p => `${indonesianMonthsShort[p.month]} ${p.year}`);
                    pemasukkan = monthPairs.map(() => 0);
                    pengeluaran = monthPairs.map(() => 0);
                    income = monthPairs.map(() => 0);

                    rawTransactions.forEach(tx => {
                        const txDate = parseDate(tx.tanggal);
                        monthPairs.forEach((p, idx) => {
                            if (txDate.getFullYear() === p.year && txDate.getMonth() === p.month) {
                                const amount = parseFloat(tx.nominal);
                                if (tx.jenis_transaksi == 1) {
                                    pemasukkan[idx] += amount;
                                    totals.pemasukkan += amount;
                                } else {
                                    pengeluaran[idx] += amount;
                                    totals.pengeluaran += amount;
                                }
                            }
                        });
                    });

                    // Akumulasi kumulatif
                    for (let i = 1; i < monthPairs.length; i++) {
                        pemasukkan[i] += pemasukkan[i-1];
                        pengeluaran[i] += pengeluaran[i-1];
                    }
                    for (let i = 0; i < monthPairs.length; i++) {
                        income[i] = pemasukkan[i] - pengeluaran[i];
                    }
                    totals.income = totals.pemasukkan - totals.pengeluaran;

                } else if (period === 'ALL') {
                    // Filter data dari 2026 hingga tahun saat ini
                    const startYear = 2026;
                    const currentYear = now.getFullYear();
                    const years = [];
                    for (let y = startYear; y <= currentYear; y++) {
                        years.push(y);
                    }

                    labels = years.map(y => y.toString());
                    pemasukkan = years.map(() => 0);
                    pengeluaran = years.map(() => 0);
                    income = years.map(() => 0);

                    rawTransactions.forEach(tx => {
                        const txDate = parseDate(tx.tanggal);
                        const idx = years.indexOf(txDate.getFullYear());
                        if (idx !== -1) {
                            const amount = parseFloat(tx.nominal);
                            if (tx.jenis_transaksi == 1) {
                                pemasukkan[idx] += amount;
                                totals.pemasukkan += amount;
                            } else {
                                pengeluaran[idx] += amount;
                                totals.pengeluaran += amount;
                            }
                        }
                    });

                    // Akumulasi kumulatif
                    for (let i = 1; i < years.length; i++) {
                        pemasukkan[i] += pemasukkan[i-1];
                        pengeluaran[i] += pengeluaran[i-1];
                    }
                    for (let i = 0; i < years.length; i++) {
                        income[i] = pemasukkan[i] - pengeluaran[i];
                    }
                    totals.income = totals.pemasukkan - totals.pengeluaran;
                }

                return { labels, pemasukkan, pengeluaran, income, totals };
            }

            // Inisialisasi linear gradients untuk latar belakang chart
            function getGradients() {
                const greenGrad = ctx.createLinearGradient(0, 0, 0, 300);
                greenGrad.addColorStop(0, 'rgba(16, 185, 129, 0.22)');
                greenGrad.addColorStop(1, 'rgba(16, 185, 129, 0.00)');

                const redGrad = ctx.createLinearGradient(0, 0, 0, 300);
                redGrad.addColorStop(0, 'rgba(239, 68, 68, 0.22)');
                redGrad.addColorStop(1, 'rgba(239, 68, 68, 0.00)');

                const blueGrad = ctx.createLinearGradient(0, 0, 0, 300);
                blueGrad.addColorStop(0, 'rgba(59, 130, 246, 0.22)');
                blueGrad.addColorStop(1, 'rgba(59, 130, 246, 0.00)');

                return { greenGrad, redGrad, blueGrad };
            }

            const gradients = getGradients();

            // Hitung persentase kenaikan / penurunan
            function calculateChange(incomeArray) {
                if (!incomeArray || incomeArray.length < 2) return { percent: '0.0', isPositive: true };
                
                const first = incomeArray[0];
                const last = incomeArray[incomeArray.length - 1];
                
                if (first === 0) {
                    return {
                        percent: '100.0',
                        isPositive: last >= 0
                    };
                }

                const diff = last - first;
                const percent = ((diff / Math.abs(first)) * 100).toFixed(1);
                
                return {
                    percent: Math.abs(percent),
                    isPositive: diff >= 0
                };
            }

            // Memperbarui nominal kartu di bagian atas dashboard secara dinamis
            function updateCardTotals(period) {
                const data = getChartDataForPeriod(period);
                const totals = data.totals;
                
                const incomeEl = document.getElementById('incomeAmount');
                const pemasukkanEl = document.getElementById('pemasukkanAmount');
                const pengeluaranEl = document.getElementById('pengeluaranAmount');
                
                if (incomeEl) {
                    incomeEl.textContent = (totals.income < 0 ? '- ' : '') + 'Rp. ' + Math.abs(totals.income).toLocaleString('id-ID');
                    if (totals.income < 0) {
                        incomeEl.style.color = '#ef4444';
                    } else {
                        incomeEl.style.color = '';
                    }
                }
                
                if (pemasukkanEl) {
                    pemasukkanEl.textContent = 'Rp. ' + totals.pemasukkan.toLocaleString('id-ID');
                }
                
                if (pengeluaranEl) {
                    pengeluaranEl.textContent = 'Rp. ' + totals.pengeluaran.toLocaleString('id-ID');
                }
            }

            // Memperbarui persentase indikator kenaikan / penurunan di chart header
            function updateChangeIndicator(period) {
                const data = getChartDataForPeriod(period);
                const change = calculateChange(data.income);
                
                const indicator = document.getElementById('chartChangeIndicator');
                const arrow = indicator.querySelector('.arrow');
                const percentSpan = indicator.querySelector('.percentage');
                
                if (change.isPositive) {
                    indicator.className = 'change-indicator positive';
                    arrow.textContent = '▲';
                    percentSpan.textContent = `Naik ${change.percent}%`;
                } else {
                    indicator.className = 'change-indicator negative';
                    arrow.textContent = '▼';
                    percentSpan.textContent = `Turun ${change.percent}%`;
                }
            }

            function initChart(period) {
                const activeData = getChartDataForPeriod(period);
                
                const lastIncome = activeData.income[activeData.income.length - 1];
                const incomeColor = lastIncome >= 0 ? '#3b82f6' : '#ef4444';
                const incomeGrad = lastIncome >= 0 ? gradients.blueGrad : gradients.redGrad;

                const chartData = {
                    labels: activeData.labels,
                    datasets: [
                        {
                            label: 'Pemasukkan',
                            data: activeData.pemasukkan,
                            borderColor: '#10b981',
                            backgroundColor: gradients.greenGrad,
                            borderWidth: 2,
                            fill: true,
                            tension: 0.38,
                            pointRadius: 0,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#10b981',
                            pointHoverBorderColor: '#ffffff',
                            pointHoverBorderWidth: 2
                        },
                        {
                            label: 'Pengeluaran',
                            data: activeData.pengeluaran,
                            borderColor: '#ef4444',
                            backgroundColor: gradients.redGrad,
                            borderWidth: 2,
                            fill: true,
                            tension: 0.38,
                            pointRadius: 0,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#ef4444',
                            pointHoverBorderColor: '#ffffff',
                            pointHoverBorderWidth: 2
                        },
                        {
                            label: 'Income',
                            data: activeData.income,
                            borderColor: incomeColor,
                            backgroundColor: incomeGrad,
                            borderWidth: 2.5,
                            fill: true,
                            tension: 0.38,
                            pointRadius: 0,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: incomeColor,
                            pointHoverBorderColor: '#ffffff',
                            pointHoverBorderWidth: 2
                        }
                    ]
                };

                const chartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'end',
                            labels: {
                                boxWidth: 10,
                                boxHeight: 10,
                                padding: 20,
                                font: {
                                    family: "'Inter', sans-serif",
                                    size: 11,
                                    weight: 600
                                },
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.95)',
                            titleColor: '#ffffff',
                            bodyColor: '#e2e8f0',
                            padding: 12,
                            cornerRadius: 10,
                            titleFont: {
                                family: "'Inter', sans-serif",
                                size: 12,
                                weight: 700
                            },
                            bodyFont: {
                                family: "'Inter', sans-serif",
                                size: 12
                            },
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw;
                                    return context.dataset.label + ': ' + (value < 0 ? '-' : '') + 'Rp ' + Math.abs(value).toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            grid: {
                                color: 'rgba(15, 23, 42, 0.04)',
                                drawBorder: false
                            },
                            ticks: {
                                callback: function(value) {
                                    return (value < 0 ? '-' : '') + 'Rp ' + Math.abs(value).toLocaleString('id-ID');
                                },
                                font: {
                                    family: "'Inter', sans-serif",
                                    size: 11
                                },
                                color: '#94a3b8'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(15, 23, 42, 0.02)'
                            },
                            ticks: {
                                font: {
                                    family: "'Inter', sans-serif",
                                    size: 11
                                },
                                color: '#64748b'
                            }
                        }
                    },
                    animation: {
                        duration: 800,
                        easing: 'easeOutQuart'
                    }
                };

                myFinanceChart = new Chart(ctx, {
                    type: 'line',
                    data: chartData,
                    options: chartOptions
                });
            }

            // Bind click listeners untuk tombol pengubah periode
            document.querySelectorAll('.period-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const period = this.getAttribute('data-period');
                    myFinanceChart.destroy();
                    initChart(period);
                    updateChangeIndicator(period);
                    updateCardTotals(period);
                });
            });

            // Load chart awal (1M)
            initChart('1M');
            updateChangeIndicator('1M');
            updateCardTotals('1M');
        });

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const storedCollapse = localStorage.getItem('sidebarCollapsed');
            const isCollapsed = storedCollapse === null ? window.innerWidth <= 768 : storedCollapse === 'true';
            if (isCollapsed && sidebar) {
                sidebar.classList.add('collapsed');
            }

            // Click outside sidebar to close on mobile
            document.addEventListener('click', function (event) {
                const sidebar = document.getElementById('sidebar');
                const toggleBtn = document.querySelector('.sidebar-toggle-btn');
                if (window.innerWidth <= 768 && sidebar && !sidebar.classList.contains('collapsed')) {
                    if (!sidebar.contains(event.target) && (!toggleBtn || !toggleBtn.contains(event.target))) {
                        sidebar.classList.add('collapsed');
                        localStorage.setItem('sidebarCollapsed', 'true');
                    }
                }
            });
        });
    </script>
</body>
</html>
```
