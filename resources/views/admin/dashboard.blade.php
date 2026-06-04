
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

            .main-wrapper,
            .main-content {
                width: 100% !important;
                padding: 15px !important;
            }

            .top-header {
                padding: 15px 15px 5px !important;
            }

            .sidebar-close-btn {
                display: block !important;
            }

            .financial-grid {
                grid-template-columns: 1.15fr 1.5fr !important;
                gap: 12px !important;
                margin-bottom: 20px !important;
            }

            .financial-grid .card,
            .financial-grid .stat-box {
                padding: 12px !important;
            }

            .financial-grid .income-card .amount {
                font-size: 1.6rem !important;
            }

            .financial-grid .stat-box .amount {
                font-size: 1.15rem !important;
            }

            .financial-grid .side-stats {
                gap: 12px !important;
            }

            .financial-grid .income-card h3 {
                margin-bottom: 8px !important;
                font-size: 0.85rem !important;
            }

            .financial-grid .stat-box h3 {
                margin-bottom: 6px !important;
                font-size: 0.8rem !important;
            }

            .form-grid {
                grid-template-columns: 1fr 1fr !important;
                gap: 12px !important;
            }

            .form-card {
                padding: 12px !important;
                border-radius: 12px !important;
            }

            .form-card h3 {
                margin-bottom: 12px !important;
                font-size: 0.85rem !important;
                text-align: center;
            }

            .form-icon {
                width: 44px !important;
                height: 44px !important;
                margin-bottom: 10px !important;
            }

            .form-icon i {
                font-size: 1.5rem !important;
            }

            .form-card p {
                font-size: 0.72rem !important;
                margin-bottom: 12px !important;
                line-height: 1.3;
            }

            .input-group {
                margin-bottom: 10px !important;
            }

            .input-group input {
                padding: 8px 10px !important;
                font-size: 0.8rem !important;
                border-radius: 8px !important;
            }

            .btn-pengeluaran,
            .btn-pemasukkan {
                padding: 8px 6px !important;
                font-size: 0.75rem !important;
                border-radius: 8px !important;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
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

            const dataPemasukkan = {{ $totalPemasukkan ?? 0 }};
            const dataPengeluaran = {{ $totalPengeluaran ?? 0 }};
            const dataIncome = {{ $income ?? 0 }};

            // Structure to hold period data and dynamic metrics totals for responsiveness
            const chartPeriodData = {
                '1D': {
                    labels: ['09:00', '11:00', '13:00', '15:00', '17:00'],
                    pemasukkan: [Math.round(dataPemasukkan * 0.2), Math.round(dataPemasukkan * 0.5), Math.round(dataPemasukkan * 0.7), Math.round(dataPemasukkan * 0.9), dataPemasukkan],
                    pengeluaran: [Math.round(dataPengeluaran * 0.1), Math.round(dataPengeluaran * 0.4), Math.round(dataPengeluaran * 0.6), Math.round(dataPengeluaran * 0.8), dataPengeluaran],
                    income: [Math.round(dataIncome * 0.3), Math.round(dataIncome * 0.6), Math.round(dataIncome * 0.8), Math.round(dataIncome * 0.9), dataIncome],
                    totals: {
                        pemasukkan: Math.round(dataPemasukkan * 0.25),
                        pengeluaran: Math.round(dataPengeluaran * 0.15),
                        income: Math.round(dataIncome * 0.35)
                    }
                },
                '7D': {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    pemasukkan: [Math.round(dataPemasukkan * 0.4), Math.round(dataPemasukkan * 0.6), Math.round(dataPemasukkan * 0.55), Math.round(dataPemasukkan * 0.8), Math.round(dataPemasukkan * 0.9), Math.round(dataPemasukkan * 0.95), dataPemasukkan],
                    pengeluaran: [Math.round(dataPengeluaran * 0.3), Math.round(dataPengeluaran * 0.5), Math.round(dataPengeluaran * 0.7), Math.round(dataPengeluaran * 0.65), Math.round(dataPengeluaran * 0.85), Math.round(dataPengeluaran * 0.9), dataPengeluaran],
                    income: [Math.round(dataIncome * 0.5), Math.round(dataIncome * 0.7), Math.round(dataIncome * 0.4), Math.round(dataIncome * 0.95), Math.round(dataIncome * 0.92), Math.round(dataIncome * 1.05), dataIncome],
                    totals: {
                        pemasukkan: Math.round(dataPemasukkan * 0.65),
                        pengeluaran: Math.round(dataPengeluaran * 0.55),
                        income: Math.round(dataIncome * 0.75)
                    }
                },
                '1M': {
                    labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                    pemasukkan: [Math.round(dataPemasukkan * 0.6), Math.round(dataPemasukkan * 0.75), Math.round(dataPemasukkan * 0.9), dataPemasukkan],
                    pengeluaran: [Math.round(dataPengeluaran * 0.5), Math.round(dataPengeluaran * 0.7), Math.round(dataPengeluaran * 0.85), dataPengeluaran],
                    income: [Math.round(dataIncome * 0.7), Math.round(dataIncome * 0.8), Math.round(dataIncome * 0.95), dataIncome],
                    totals: {
                        pemasukkan: dataPemasukkan,
                        pengeluaran: dataPengeluaran,
                        income: dataIncome
                    }
                },
                '3M': {
                    labels: ['Maret', 'April', 'Mei'],
                    pemasukkan: [Math.round(dataPemasukkan * 0.75), Math.round(dataPemasukkan * 0.9), dataPemasukkan],
                    pengeluaran: [Math.round(dataPengeluaran * 0.8), Math.round(dataPengeluaran * 0.85), dataPengeluaran],
                    income: [Math.round(dataIncome * 0.7), Math.round(dataIncome * 0.95), dataIncome],
                    totals: {
                        pemasukkan: Math.round(dataPemasukkan * 2.8),
                        pengeluaran: Math.round(dataPengeluaran * 2.5),
                        income: Math.round(dataIncome * 3.2)
                    }
                },
                '6M': {
                    labels: ['Des', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
                    pemasukkan: [Math.round(dataPemasukkan * 0.5), Math.round(dataPemasukkan * 0.65), Math.round(dataPemasukkan * 0.8), Math.round(dataPemasukkan * 0.75), Math.round(dataPemasukkan * 0.9), dataPemasukkan],
                    pengeluaran: [Math.round(dataPengeluaran * 0.4), Math.round(dataPengeluaran * 0.55), Math.round(dataPengeluaran * 0.75), Math.round(dataPengeluaran * 0.7), Math.round(dataPengeluaran * 0.85), dataPengeluaran],
                    income: [Math.round(dataIncome * 0.6), Math.round(dataIncome * 0.75), Math.round(dataIncome * 0.85), Math.round(dataIncome * 0.8), Math.round(dataIncome * 0.95), dataIncome],
                    totals: {
                        pemasukkan: Math.round(dataPemasukkan * 5.4),
                        pengeluaran: Math.round(dataPengeluaran * 4.8),
                        income: Math.round(dataIncome * 6.2)
                    }
                },
                '1Y': {
                    labels: ['2025 Q1', '2025 Q2', '2025 Q3', '2025 Q4', '2026 Q1', 'Saat Ini'],
                    pemasukkan: [Math.round(dataPemasukkan * 0.45), Math.round(dataPemasukkan * 0.6), Math.round(dataPemasukkan * 0.75), Math.round(dataPemasukkan * 0.8), Math.round(dataPemasukkan * 0.95), dataPemasukkan],
                    pengeluaran: [Math.round(dataPengeluaran * 0.35), Math.round(dataPengeluaran * 0.5), Math.round(dataPengeluaran * 0.7), Math.round(dataPengeluaran * 0.75), Math.round(dataPengeluaran * 0.9), dataPengeluaran],
                    income: [Math.round(dataIncome * 0.55), Math.round(dataIncome * 0.7), Math.round(dataIncome * 0.8), Math.round(dataIncome * 0.85), Math.round(dataIncome * 1.05), dataIncome],
                    totals: {
                        pemasukkan: Math.round(dataPemasukkan * 11.2),
                        pengeluaran: Math.round(dataPengeluaran * 9.8),
                        income: Math.round(dataIncome * 12.5)
                    }
                },
                'ALL': {
                    labels: ['Awal Mulai', 'Tahun 1', 'Tahun 2', 'Saat Ini'],
                    pemasukkan: [Math.round(dataPemasukkan * 0.3), Math.round(dataPemasukkan * 0.6), Math.round(dataPemasukkan * 0.85), dataPemasukkan],
                    pengeluaran: [Math.round(dataPengeluaran * 0.2), Math.round(dataPengeluaran * 0.5), Math.round(dataPengeluaran * 0.8), dataPengeluaran],
                    income: [Math.round(dataIncome * 0.4), Math.round(dataIncome * 0.7), Math.round(dataIncome * 0.9), dataIncome],
                    totals: {
                        pemasukkan: Math.round(dataPemasukkan * 24.5),
                        pengeluaran: Math.round(dataPengeluaran * 21.2),
                        income: Math.round(dataIncome * 28.6)
                    }
                }
            };

            // Setup linear gradients for background areas
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

            // Calculate change percentage (Naik / Turun) compared to start of period
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

            // Dynamically updates metric cards on the dashboard based on active filter
            function updateCardTotals(period) {
                const totals = chartPeriodData[period].totals;
                
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

            function updateChangeIndicator(period) {
                const data = chartPeriodData[period];
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
                const activeData = chartPeriodData[period];
                
                // Income color adapts to negative trends
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

            // Bind click listeners for period switch buttons
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

            // Initial chart load
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
