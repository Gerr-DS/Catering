<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - HafidzManage</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        /* SIDEBAR STYLE */
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

        .sidebar-header {
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 12px;
            white-space: nowrap;
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
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .sidebar-header-text h2 {
            color: var(--primary);
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
        }

        .sidebar-header-text span {
            font-size: 0.7rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
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
            white-space: nowrap;
        }

        .sidebar-menu a:hover {
            background: #ecfdf5;
            color: var(--primary);
        }

        .sidebar-menu a.active {
            background: #d1fae5;
            color: var(--primary);
            font-weight: 600;
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
            transition: 0.2s;
            white-space: nowrap;
        }

        .sidebar-bottom button:hover {
            background: #f3f4f6;
            color: #ef4444;
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

        /* Pengaturan Konten Utama */
        .main-content {
            flex: 1;
            padding: 20px 40px 40px;
            overflow-y: auto;
        }

        .page-title {
            margin-bottom: 20px;
            color: #0f172a;
            font-size: 1.8rem;
        }

        /* Pengaturan Tabel */
        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            border: 1px solid #e2e8f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
        }

        th {
            color: #64748b;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background-color: #f8fafc;
        }

        td {
            font-size: 0.95rem;
        }

        tr:hover {
            background-color: #f8fafc;
        }

        /* Badge Warna */
        .badge-income {
            background: #dcfce7;
            color: #166534;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .badge-expense {
            background: #fee2e2;
            color: #991b1b;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .text-green {
            color: #16a34a;
            font-weight: bold;
        }

        .text-red {
            color: #dc2626;
            font-weight: bold;
        }

        /* Custom Pagination styles */
        .pagination-btn {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #4b5563;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .pagination-btn:hover:not(:disabled) {
            background: #f1f5f9;
            border-color: #94a3b8;
            color: #0f172a;
        }

        .pagination-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: #ffffff;
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</head>

<body>

    <aside class="sidebar" id="sidebar">
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
                <a href="{{ route('admin.dashboard') }}">
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
                <a href="{{ route('admin.reports') }}" class="active">
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

    <div class="main-content">
        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px;">
            <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars"></i>
            </button>
            <h2 class="page-title" style="margin: 0;">Laporan Keuangan</h2>
        </div>
        
        <div style="margin-bottom:20px; display:flex; gap:10px; align-items: center; flex-wrap: wrap;">
            <a
                href="{{ route('admin.reports.pdf', request()->all()) }}"
                style="
                    background:#dc2626;
                    color:white;
                    padding:10px 16px;
                    border-radius:8px;
                    text-decoration:none;
                    font-weight:bold;
                    transition: opacity 0.2s;
                "
                onmouseover="this.style.opacity='0.9'"
                onmouseout="this.style.opacity='1'">
                📄 Unduh PDF
            </a>

            <a
                href="{{ route('admin.reports.excel', request()->all()) }}"
                style="
                    background:#059669;
                    color:white;
                    padding:10px 16px;
                    border-radius:8px;
                    text-decoration:none;
                    font-weight:bold;
                    transition: opacity 0.2s;
                "
                onmouseover="this.style.opacity='0.9'"
                onmouseout="this.style.opacity='1'">
                📊 Unduh Excel
            </a>

            <button
                onclick="window.print()"
                style="
                    background:#2563eb;
                    color:white;
                    padding:10px 16px;
                    border:none;
                    border-radius:8px;
                    cursor:pointer;
                    font-weight:bold;
                    transition: opacity 0.2s;
                "
                onmouseover="this.style.opacity='0.9'"
                onmouseout="this.style.opacity='1'">
                🖨️ Cetak
            </button>
        </div>

        <!-- Dynamic Search & Date Period Filter Form Panel -->
        <form method="GET" action="{{ route('admin.reports') }}" style="background: white; border-radius: 16px; padding: 20px; border: 1px solid #e5e7eb; margin-bottom: 24px; display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)) auto; gap: 16px; align-items: flex-end; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
            <!-- Dari Tanggal -->
            <div class="search-container" style="margin: 0;">
                <label style="display: block; font-size: 0.78rem; font-weight: 600; color: #4b5563; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#cbd5e1'">
            </div>
            
            <!-- Sampai Tanggal -->
            <div class="search-container" style="margin: 0;">
                <label style="display: block; font-size: 0.78rem; font-weight: 600; color: #4b5563; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#cbd5e1'">
            </div>
            
            <!-- Jenis Transaksi -->
            <div class="search-container" style="margin: 0;">
                <label style="display: block; font-size: 0.78rem; font-weight: 600; color: #4b5563; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;">Jenis Transaksi</label>
                <select name="type" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; outline: none; background: white; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#cbd5e1'">
                    <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>Semua</option>
                    <option value="pemasukan" {{ request('type') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="pengeluaran" {{ request('type') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
            </div>
            
            <!-- Cari Keterangan -->
            <div class="search-container" style="margin: 0;">
                <label style="display: block; font-size: 0.78rem; font-weight: 600; color: #4b5563; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;">Cari Keterangan</label>
                <div style="position: relative;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari keterangan..." style="width: 100%; padding: 10px 10px 10px 36px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#cbd5e1'">
                    <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 0.85rem;"></i>
                </div>
            </div>
            
            <!-- Buttons -->
            <div style="display: flex; gap: 8px; flex-shrink: 0;">
                <button type="submit" style="background: var(--primary); color: white; border: none; padding: 10px 16px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; display: flex; align-items: center; gap: 6px; transition: background 0.2s;" onmouseover="this.style.background='var(--primary-dark)'" onmouseout="this.style.background='var(--primary)'">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>
                <a href="{{ route('admin.reports') }}" style="background: #e2e8f0; color: #4b5563; padding: 10px 16px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; text-decoration: none; text-align: center; display: inline-flex; align-items: center; gap: 6px; transition: background 0.2s;" onmouseover="this.style.background='#cbd5e1'" onmouseout="this.style.background='#e2e8f0'">
                    <i class="fa-solid fa-rotate-left"></i> Reset
                </a>
            </div>
        </form>

        <div class="card">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="padding: 15px; border-bottom: 1px solid #f1f5f9; background-color: #f8fafc; font-weight: 600; color: #64748b; font-size: 0.85rem;">Waktu Pencatatan</th>
                        <th style="padding: 15px; border-bottom: 1px solid #f1f5f9; background-color: #f8fafc; font-weight: 600; color: #64748b; font-size: 0.85rem;">Keterangan</th>
                        <th style="padding: 15px; border-bottom: 1px solid #f1f5f9; background-color: #f8fafc; font-weight: 600; color: #64748b; font-size: 0.85rem;">Tipe</th>
                        <th style="padding: 15px; border-bottom: 1px solid #f1f5f9; background-color: #f8fafc; font-weight: 600; color: #64748b; font-size: 0.85rem;">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr>
                        <td>{{ $report->created_at->format('d M Y, H:i') }} WIB</td>

                        <td style="font-weight: 500; color: #1e293b;">{{ $report->description ?? 'Tidak ada keterangan' }}</td>

                        <td>
                            @if(strtolower($report->type) == 'pemasukan' || strtolower($report->type) == 'pemasukkan')
                            <span class="badge-income">Pemasukan</span>
                            @else
                            <span class="badge-expense">Pengeluaran</span>
                            @endif
                        </td>

                        <td style="font-weight: 600;">
                            @if(strtolower($report->type) == 'pemasukan' || strtolower($report->type) == 'pemasukkan')
                            <span class="text-green">+ Rp. {{ number_format($report->amount, 0, ',', '.') }}</span>
                            @else
                            <span class="text-red">- Rp. {{ number_format($report->amount, 0, ',', '.') }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 40px; color: #94a3b8; font-style: italic;">
                            Belum ada riwayat pencatatan keuangan yang sesuai dengan kriteria filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Elegant custom Laravel Pagination Bar -->
            @if($reports->hasPages())
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 24px; padding-top: 16px; border-top: 1px solid #f1f5f9; flex-wrap: wrap; gap: 16px;">
                <div style="font-size: 0.85rem; color: #64748b;">
                    Menampilkan <span style="font-weight: 600; color: #1e293b;">{{ $reports->firstItem() }}</span> - <span style="font-weight: 600; color: #1e293b;">{{ $reports->lastItem() }}</span> dari <span style="font-weight: 600; color: #1e293b;">{{ $reports->total() }}</span> riwayat
                </div>
                <div style="display: flex; gap: 6px; align-items: center;">
                    {{-- Previous Page Link --}}
                    @if ($reports->onFirstPage())
                        <button class="pagination-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
                    @else
                        <a href="{{ $reports->appends(request()->all())->previousPageUrl() }}" class="pagination-btn"><i class="fa-solid fa-chevron-left"></i></a>
                    @endif

                    {{-- Page Number Links --}}
                    @foreach ($reports->getUrlRange(1, $reports->lastPage()) as $page => $url)
                        @if ($page == $reports->currentPage())
                            <span class="pagination-btn active">{{ $page }}</span>
                        @else
                            <a href="{{ $reports->appends(request()->all())->url($page) }}" class="pagination-btn">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($reports->hasMorePages())
                        <a href="{{ $reports->appends(request()->all())->nextPageUrl() }}" class="pagination-btn"><i class="fa-solid fa-chevron-right"></i></a>
                    @else
                        <button class="pagination-btn" disabled><i class="fa-solid fa-chevron-right"></i></button>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed && sidebar) {
                sidebar.classList.add('collapsed');
            }
        });
    </script>
</body>
</html>