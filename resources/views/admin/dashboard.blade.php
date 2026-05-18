<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Overview - HafidzManage</title>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #064e3b; 
            --primary-light: #059669;
            --danger: #dc2626;
            --blue: #1e3a8a; 
            --bg-color: #fafafa;
            --sidebar-width: 250px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', system-ui, sans-serif; }
        body { display: flex; height: 100vh; background-color: var(--bg-color); color: #1f2937; }

        /* Sidebar */
        .sidebar { width: var(--sidebar-width); background: #ffffff; box-shadow: 2px 0 5px rgba(0,0,0,0.02); display: flex; flex-direction: column; padding: 20px; }
        .sidebar-header { margin-bottom: 40px; }
        .sidebar-header h2 { color: var(--primary); font-size: 1.2rem; display: flex; align-items: center; gap: 8px;}
        .sidebar-menu { list-style: none; flex: 1; }
        .sidebar-menu li { margin-bottom: 8px; }
        .sidebar-menu a { display: flex; align-items: center; padding: 12px; color: #6b7280; text-decoration: none; border-radius: 8px; font-weight: 500; }
        .sidebar-menu a.active { background-color: #f0fdf4; color: var(--primary-light); }

        /* Konten Utama */
        .main-content { flex: 1; padding: 40px; overflow-y: auto; }
        
        .header-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; }
        .header-title h1 { font-size: 1.8rem; font-weight: 800; color: #111827; }
        .header-title p { font-size: 0.85rem; color: #6b7280; margin-top: 4px; }
        
        /* Grid Keuangan */
        .financial-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 30px; }
        .card { background: #ffffff; padding: 24px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; }
        
        .income-card { display: flex; flex-direction: column; justify-content: center; }
        .income-card h3 { color: var(--blue); font-size: 1rem; margin-bottom: 10px; }
        .income-card .amount { font-size: 3rem; font-weight: 800; color: #111827; }

        .side-stats { display: flex; flex-direction: column; gap: 20px; }
        .stat-box { background: #ffffff; padding: 20px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; }
        .stat-box h3.pemasukkan-title { color: var(--primary-light); font-size: 0.9rem; margin-bottom: 5px; }
        .stat-box h3.pengeluaran-title { color: var(--danger); font-size: 0.9rem; margin-bottom: 5px; }
        .stat-box .amount { font-size: 1.8rem; font-weight: 800; color: #111827; }

        /* Area Grafik & Dropdown Selector */
        .chart-container { background: #ffffff; padding: 24px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; margin-bottom: 30px; }
        .chart-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .chart-title h3 { font-size: 1.2rem; color: #111827; margin-bottom: 4px; }
        .chart-title p { font-size: 0.85rem; color: #6b7280; }
        
        /* Desain Dropdown */
        .chart-selector { padding: 8px 16px; border-radius: 8px; border: 1px solid #d1d5db; background-color: #f9fafb; font-weight: 600; color: #374151; cursor: pointer; outline: none; }
        .chart-selector:focus { border-color: var(--primary-light); }

        /* Form Grid */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-card { background: #ffffff; padding: 30px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; text-align: center; }
        .form-card h3 { font-size: 1.1rem; margin-bottom: 20px; color: #111827; text-align: left; }
        
        .input-group { margin-bottom: 15px; text-align: left; }
        .input-group input { width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; outline: none; }
        .input-group input:focus { border-color: var(--primary-light); }

        .btn-pengeluaran { width: 100%; padding: 12px; background-color: var(--danger); color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; }
        .btn-pemasukkan { width: 100%; padding: 12px; background-color: var(--primary-light); color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; }
        
        .alert-success { background-color: #d1fae5; color: #065f46; padding: 12px; border-radius: 8px; margin-bottom: 20px; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <h2><span style="background:var(--primary); color:white; padding:4px 8px; border-radius:6px;">H</span> HafidzManage</h2>
        </div>
        <ul class="sidebar-menu">
    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    
    <li><a href="{{ route('admin.stock.index') }}">Stock Management</a></li>
    
    <li><a href="{{ route('admin.menu.index') }}">Menu Management</a></li>

    <li><a href="{{ route('admin.reports') }}">Reports</a></li>
</ul>
        <div style="margin-top: auto;">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" style="background:none; border:none; color:#6b7280; font-weight:bold; cursor:pointer;">🚪 Keluar (Logout)</button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <div class="header-top">
            <div class="header-title">
                <h1>Financial Overview</h1>
                <p>Ringkasan kinerja operasional Hafidz Catering harian.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="financial-grid">
            <div class="card income-card">
                <h3>Income (Pendapatan Bersih)</h3>
                <div class="amount">Rp. {{ number_format($income ?? 0, 0, ',', '.') }}</div>
            </div>
            
            <div class="side-stats">
                <div class="stat-box">
                    <h3 class="pemasukkan-title">Total Pemasukkan</h3>
                    <div class="amount">Rp. {{ number_format($totalPemasukkan ?? 0, 0, ',', '.') }}</div>
                </div>
                <div class="stat-box">
                    <h3 class="pengeluaran-title">Total Pengeluaran</h3>
                    <div class="amount">Rp. {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}</div>
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
                    <option value="line">📈 Line Chart (Garis)</option>
                    <option value="area">🌊 Area Chart (Area)</option>
                    <option value="bar">📊 Bar Chart (Batang)</option>
                    <option value="pie">🍕 Pie Chart (Bulat)</option>
                    <option value="doughnut">🍩 Doughnut Chart (Donat)</option>
                </select>
            </div>
            <div style="position: relative; height:300px; width:100%">
                <canvas id="financeDynamicChart"></canvas>
            </div>
        </div>

        <div class="form-grid">
            <div class="form-card">
                <h3>Catat Pengeluaran</h3>
                <form action="{{ route('admin.financial.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="pengeluaran">
                    <div class="input-group">
                        <input type="number" name="amount" placeholder="Nominal (Contoh: 500000)" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="description" placeholder="Keterangan (Contoh: Beli Sayuran)" required>
                    </div>
                    <button type="submit" class="btn-pengeluaran">+ Tambah Pengeluaran</button>
                </form>
            </div>

            <div class="form-card">
                <h3>Catat Pemasukkan</h3>
                <form action="{{ route('admin.financial.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="pemasukkan">
                    <div class="input-group">
                        <input type="number" name="amount" placeholder="Nominal (Contoh: 1500000)" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="description" placeholder="Keterangan (Contoh: DP Pesanan Nikahan)" required>
                    </div>
                    <button type="submit" class="btn-pemasukkan">+ Tambah Pemasukkan</button>
                </form>
            </div>
        </div>
        
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('financeDynamicChart').getContext('2d');
            let myFinanceChart; // Variabel untuk menyimpan grafik saat ini

            // Mengambil data dari database Laravel
            const dataPemasukkan = {{ $totalPemasukkan ?? 0 }};
            const dataPengeluaran = {{ $totalPengeluaran ?? 0 }};
            const dataIncome = {{ $income ?? 0 }};

            // Fungsi untuk menggambar grafik berdasarkan pilihan
            function renderChart(selectedType) {
                // Hapus grafik lama jika sudah ada agar tidak menumpuk
                if (myFinanceChart) {
                    myFinanceChart.destroy();
                }

                // Menentukan Tipe Chart & Status Fill (Untuk Area)
                let actualChartType = selectedType === 'area' ? 'line' : selectedType;
                let isFilled = selectedType === 'area' ? true : false;

                let chartData, chartOptions;

                // Logika khusus untuk Pie dan Doughnut (Membutuhkan struktur data yang berbeda)
                if (selectedType === 'pie' || selectedType === 'doughnut') {
                    chartData = {
                        labels: ['Pemasukkan', 'Pengeluaran', 'Income'],
                        datasets: [{
                            data: [dataPemasukkan, dataPengeluaran, dataIncome],
                            backgroundColor: ['#059669', '#dc2626', '#1e3a8a'],
                            hoverOffset: 10
                        }]
                    };
                    chartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'right' } }
                    };
                } 
                // Logika untuk Line, Area, dan Bar
                else {
                    chartData = {
                        labels: ['Titik Awal (0)', 'Total Saat Ini'],
                        datasets: [
                            {
                                label: 'Pemasukkan',
                                data: [0, dataPemasukkan],
                                borderColor: '#059669',
                                backgroundColor: selectedType === 'area' ? 'rgba(5, 150, 105, 0.2)' : '#059669',
                                borderWidth: 3,
                                fill: isFilled,
                                tension: 0.4
                            },
                            {
                                label: 'Pengeluaran',
                                data: [0, dataPengeluaran],
                                borderColor: '#dc2626',
                                backgroundColor: selectedType === 'area' ? 'rgba(220, 38, 38, 0.2)' : '#dc2626',
                                borderWidth: 3,
                                fill: isFilled,
                                tension: 0.4
                            },
                            {
                                label: 'Income (Bersih)',
                                data: [0, dataIncome],
                                borderColor: '#1e3a8a',
                                backgroundColor: selectedType === 'area' ? 'rgba(30, 58, 138, 0.2)' : '#1e3a8a',
                                borderWidth: 3,
                                fill: isFilled,
                                tension: 0.4
                            }
                        ]
                    };
                    chartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'top' } },
                        scales: {
                            y: { beginAtZero: true, ticks: { callback: value => 'Rp ' + value.toLocaleString('id-ID') } },
                            x: { grid: { display: false } }
                        }
                    };
                }

                // Membangun ulang grafiknya
                myFinanceChart = new Chart(ctx, {
                    type: actualChartType,
                    data: chartData,
                    options: chartOptions
                });
            }

            // Memanggil grafik Line secara default saat pertama kali dimuat
            renderChart('line');

            // Mendengarkan perubahan pada Dropdown
            document.getElementById('chartTypeSelector').addEventListener('change', function(e) {
                renderChart(e.target.value);
            });
        });
    </script>
</body>
</html>