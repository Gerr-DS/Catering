
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Overview - HafidzManage</title>

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
            grid-template-columns: 2fr 1fr;
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

        .chart-container {
            margin-bottom: 30px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title h3 {
            font-size: 1.1rem;
            margin-bottom: 4px;
        }

        .chart-title p {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .chart-selector {
            padding: 10px 16px;
            border-radius: 10px;
            border: none;
            background: #f3f4f6;
            cursor: pointer;
            font-weight: 500;
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

        @media (max-width: 900px) {
            .financial-grid,
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">

        <div class="sidebar-header">
            <div class="logo-icon">
                <i class="fa-solid fa-utensils"></i>
            </div>

            <div class="sidebar-header-text">
                <h2>Hafidz Catering</h2>
                <span>MANAGEMENT PORTAL</span>
            </div>
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
                    <span>Stock Management</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.menu.index') }}">
                    <i class="fa-solid fa-list"></i>
                    <span>Menu Management</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.reports') }}">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Reports</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-bottom">
            <form method="POST" action="/logout">
                @csrf

                <button type="submit">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </aside>

    <div class="main-wrapper">

        <div class="top-header">
            <div class="header-title">
                <h1>Financial Overview</h1>
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

                <div class="card income-card">
                    <h3>Income (Pendapatan Bersih)</h3>

                    <div class="amount">
                        Rp. {{ number_format($income ?? 0, 0, ',', '.') }}
                    </div>
                </div>

                <div class="side-stats">

                    <div class="stat-box">
                        <h3 class="pemasukkan-title">Total Pemasukkan</h3>

                        <div class="amount">
                            Rp. {{ number_format($totalPemasukkan ?? 0, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="stat-box">
                        <h3 class="pengeluaran-title">Total Pengeluaran</h3>

                        <div class="amount">
                            Rp. {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}
                        </div>
                    </div>

                </div>
            </div>

            <div class="chart-container">

                <div class="chart-header">

                    <div class="chart-title">
                        <h3>Revenue vs Expenses vs Income</h3>
                        <p>Pergerakan Keuangan Anda</p>
                    </div>

                    <select id="chartTypeSelector" class="chart-selector">
                        <option value="line">📈 Line Chart</option>
                        <option value="area">🌊 Area Chart</option>
                        <option value="bar">📊 Bar Chart</option>
                        <option value="pie">🍕 Pie Chart</option>
                        <option value="doughnut">🍩 Doughnut Chart</option>
                    </select>

                </div>

                <div style="position: relative; height:300px; width:100%">
                    <canvas id="financeDynamicChart"></canvas>
                </div>

            </div>

            <div class="form-grid">

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

            function renderChart(selectedType) {

                if (myFinanceChart) {
                    myFinanceChart.destroy();
                }

                let actualChartType = selectedType === 'area'
                    ? 'line'
                    : selectedType;

                let isFilled = selectedType === 'area';

                let chartData, chartOptions;

                if (selectedType === 'pie' || selectedType === 'doughnut') {

                    chartData = {
                        labels: ['Pemasukkan', 'Pengeluaran', 'Income'],
                        datasets: [{
                            data: [
                                dataPemasukkan,
                                dataPengeluaran,
                                dataIncome
                            ],
                            backgroundColor: [
                                '#059669',
                                '#dc2626',
                                '#059669'
                            ],
                            hoverOffset: 10
                        }]
                    };

                    chartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right'
                            }
                        }
                    };

                } else {

                    chartData = {
                        labels: ['Titik Awal (0)', 'Total Saat Ini'],
                        datasets: [

                            {
                                label: 'Pemasukkan',
                                data: [0, dataPemasukkan],
                                borderColor: '#059669',
                                backgroundColor: selectedType === 'area'
                                    ? 'rgba(5,150,105,0.2)'
                                    : '#059669',
                                borderWidth: 3,
                                fill: isFilled,
                                tension: 0.4
                            },

                            {
                                label: 'Pengeluaran',
                                data: [0, dataPengeluaran],
                                borderColor: '#dc2626',
                                backgroundColor: selectedType === 'area'
                                    ? 'rgba(220,38,38,0.2)'
                                    : '#dc2626',
                                borderWidth: 3,
                                fill: isFilled,
                                tension: 0.4
                            },

                            {
                                label: 'Income',
                                data: [0, dataIncome],
                                borderColor: '#059669',
                                backgroundColor: selectedType === 'area'
                                    ? 'rgba(5,150,105,0.2)'
                                    : '#059669',
                                borderWidth: 3,
                                fill: isFilled,
                                tension: 0.4
                            }

                        ]
                    };

                    chartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,

                        plugins: {
                            legend: {
                                position: 'top'
                            }
                        },

                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: value =>
                                        'Rp ' + value.toLocaleString('id-ID')
                                }
                            },

                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    };
                }

                myFinanceChart = new Chart(ctx, {
                    type: actualChartType,
                    data: chartData,
                    options: chartOptions
                });
            }

            renderChart('line');

            document.getElementById('chartTypeSelector')
                .addEventListener('change', function(e) {

                    renderChart(e.target.value);

                });

        });
    </script>

</body>
</html>
```
