<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Stok - HafidzManage</title>
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

        /* Konten Utama */
        .main-content {
            flex: 1;
            padding: 20px 40px 40px;
            overflow-y: auto;
        }


        .header-top {
            /* display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px; */
            padding: 30px 40px 10px;
        }


        .header-title h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #111827;
        }

        .header-title p {
            font-size: 0.9rem;
            color: #6b7280;
            margin-top: 4px;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        /* Tata Letak Konten Stok */
        .stock-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        /* Tabel Stok */
        .table-card {
            background: #ffffff;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid #f3f4f6;
        }

        .table-card h3 {
            margin-bottom: 20px;
            color: #111827;
        }

        .table-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            flex: 1;
            justify-content: flex-end;
        }

        .search-wrapper {
            width: 280px;
        }

        .btn-add-mobile {
            display: none;
            background: var(--primary);
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-add-mobile:hover {
            background: var(--primary-dark);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #f3f4f6;
        }

        th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #4b5563;
            font-size: 0.9rem;
        }

        td {
            font-size: 0.95rem;
            color: #1f2937;
        }

        .badge {
            background-color: #e0e7ff;
            color: #3730a3;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .empty-state {
            text-align: center;
            padding: 30px;
            color: #9ca3af;
            font-style: italic;
        }

        /* Form Tambah Stok */
        .form-card {
            background: #ffffff;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid #f3f4f6;
            height: fit-content;
        }

        .form-card h3 {
            margin-bottom: 20px;
            color: #111827;
        }

        .input-group {
            margin-bottom: 16px;
        }

        .input-group label {
            display: block;
            font-size: 0.85rem;
            color: #4b5563;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            transition: border 0.2s;
        }

        .input-group input:focus,
        .input-group select:focus {
            border-color: var(--primary);
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background-color: var(--primary-dark);
        }

        /* Dynamic Stock Summary Cards */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: white;
            border-radius: 16px;
            padding: 20px 24px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.01);
            border: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.2s ease-in-out;
        }

        .summary-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
        }

        .summary-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .summary-info h4 {
            font-size: 0.75rem;
            color: #6b7280;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }

        .summary-info .value {
            font-size: 1.6rem;
            font-weight: 700;
            color: #111827;
        }

        /* Summary Colors consistent with dashboard */
        .theme-total .summary-icon { background: #eff6ff; color: #2563eb; }
        .theme-aman .summary-icon { background: #ecfdf5; color: #059669; }
        .theme-menipis .summary-icon { background: #fffbeb; color: #d97706; }
        .theme-habis .summary-icon { background: #fef2f2; color: #dc2626; }

        /* Real-time search container */
        .search-container {
            position: relative;
            margin-bottom: 20px;
            width: 100%;
        }

        .search-container i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 0.95rem;
        }

        .search-input {
            width: 100%;
            padding: 12px 16px 12px 42px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #f9fafb;
            outline: none;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .search-input:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
        }

        /* Low Stock Row Colors */
        tr.low-stock-warning {
            background-color: #fffbeb !important;
        }

        tr.low-stock-critical {
            background-color: #fef2f2 !important;
        }

        tr.low-stock-warning:hover {
            background-color: #fef3c7 !important;
        }

        tr.low-stock-critical:hover {
            background-color: #fee2e2 !important;
        }

        /* Status badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            border-width: 1px;
            border-style: solid;
        }

        .status-badge.aman {
            background-color: #ecfdf5;
            color: #047857;
            border-color: #a7f3d0;
        }

        .status-badge.menipis {
            background-color: #fffbeb;
            color: #b45309;
            border-color: #fde68a;
        }

        .status-badge.hampir-habis {
            background-color: #fef2f2;
            color: #b91c1c;
            border-color: #fecaca;
        }

        .status-badge.habis {
            background-color: #f3f4f6;
            color: #374151;
            border-color: #cbd5e1;
        }

        /* Low Stock inline warnings */
        .warning-label {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 4px;
            margin-left: 8px;
            vertical-align: middle;
        }

        .warning-label.critical {
            color: #dc2626;
            background: #fee2e2;
        }

        .warning-label.warning {
            color: #d97706;
            background: #fef3c7;
        }

        /* Custom Action buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            border: none;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
        }

        .action-btn.edit {
            background-color: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
        }

        .action-btn.edit:hover {
            background-color: #2563eb;
            color: white;
            transform: scale(1.05);
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
        }

        .action-btn.delete {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .action-btn.delete:hover {
            background-color: #dc2626;
            color: white;
            transform: scale(1.05);
            box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.2);
        }

        @media (max-width: 1200px) {
            .summary-grid {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto auto;
                grid-auto-flow: column;
                gap: 16px;
            }
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

            .main-content {
                width: 100% !important;
                padding: 15px !important;
            }

            .sidebar-close-btn {
                display: block !important;
            }

            .stock-layout {
                grid-template-columns: 1fr !important;
                gap: 16px !important;
            }

            .summary-grid {
                grid-template-columns: 1fr 1fr !important;
                grid-template-rows: auto auto !important;
                grid-auto-flow: column !important;
                gap: 12px !important;
            }

            .summary-card {
                padding: 12px 14px !important;
                gap: 12px !important;
                border-radius: 12px !important;
            }

            .summary-icon {
                width: 40px !important;
                height: 40px !important;
                font-size: 1.05rem !important;
                border-radius: 10px !important;
            }

            .summary-info h4 {
                font-size: 0.72rem !important;
                margin-bottom: 2px !important;
            }

            .summary-info .value {
                font-size: 1.3rem !important;
            }

            .table-card-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 12px !important;
            }

            .header-actions {
                width: 100% !important;
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 12px !important;
            }

            .btn-add-mobile {
                display: flex !important;
                width: 100% !important;
                justify-content: center !important;
            }

            .search-wrapper {
                width: 100% !important;
            }

            .form-card {
                display: none !important;
            }

            /* Responsive tables styling */
            .table-responsive {
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                border-radius: 8px;
                border: 1px solid #cbd5e1;
                margin-bottom: 15px;
            }

            .table-responsive table {
                min-width: 600px;
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
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-border-all"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.stock.index') }}" class="active">
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

    <main class="main-content">
        <div class="header-top" style="display: flex; align-items: center; gap: 20px; margin-bottom: 15px;">
            <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="header-title">
                <h1>Manajemen Stok</h1>
                <p>Pantau ketersediaan bahan baku katering Anda.</p>
            </div>
        </div>

        @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Dynamic Stock Summary Cards -->
        <div class="summary-grid">
            <div class="summary-card theme-menipis">
                <div class="summary-icon"><i class="fa-solid fa-circle-exclamation"></i></div>
                <div class="summary-info">
                    <h4>Stok Menipis</h4>
                    <div class="value">{{ $stocks->filter(fn($s) => $s->jumlah_stok >= 1 && $s->jumlah_stok <= 10)->count() }}</div>
                </div>
            </div>
            <div class="summary-card theme-habis">
                <div class="summary-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                <div class="summary-info">
                    <h4>Stok Habis</h4>
                    <div class="value">{{ $stocks->where('jumlah_stok', 0)->count() }}</div>
                </div>
            </div>
            <div class="summary-card theme-total">
                <div class="summary-icon"><i class="fa-solid fa-box"></i></div>
                <div class="summary-info">
                    <h4>Total Bahan</h4>
                    <div class="value">{{ $stocks->count() }}</div>
                </div>
            </div>
            <div class="summary-card theme-aman">
                <div class="summary-icon"><i class="fa-solid fa-circle-check"></i></div>
                <div class="summary-info">
                    <h4>Stok Aman</h4>
                    <div class="value">{{ $stocks->where('jumlah_stok', '>', 10)->count() }}</div>
                </div>
            </div>
        </div>

        <div class="stock-layout">
            <div class="table-card">
                <div class="table-card-header">
                    <h3 style="margin: 0; font-size: 1.15rem; font-weight: 700; color: #111827;">Daftar Bahan Tersedia</h3>
                    
                    <div class="header-actions">
                        <!-- Add Button (Mobile Only) -->
                        <button onclick="openAddModal()" class="btn-add-mobile">
                            <i class="fa-solid fa-plus"></i> Tambah Bahan Baru
                        </button>
                        
                        <!-- Search container -->
                        <div class="search-wrapper">
                            <div class="search-container">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="text" id="searchInput" class="search-input" placeholder="Cari bahan baku...">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bahan</th>
                            <th>Jumlah Stok</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="stockTableBody">
                        @forelse($stocks as $index => $stock)
                        @php
                            $qty = $stock->jumlah_stok;
                            $rowClass = '';
                            $warningLabel = '';
                            $badgeClass = '';
                            $badgeText = '';
                            
                            if ($qty > 10) {
                                $rowClass = '';
                                $badgeClass = 'aman';
                                $badgeText = '🟢 Aman';
                            } elseif ($qty >= 1 && $qty <= 10) {
                                $rowClass = 'low-stock-warning';
                                $badgeClass = 'menipis';
                                $badgeText = '🟡 Menipis';
                                $warningLabel = '<span class="warning-label warning"><i class="fa-solid fa-triangle-exclamation"></i> Stok Menipis</span>';
                            } else {
                                $rowClass = 'low-stock-critical';
                                $badgeClass = 'habis';
                                $badgeText = '⚫ Habis';
                                $warningLabel = '<span class="warning-label critical"><i class="fa-solid fa-triangle-exclamation"></i> Stok Habis</span>';
                            }
                        @endphp
                        <tr class="{{ $rowClass }} stock-row" data-name="{{ strtolower($stock->nama_bahan) }}">
                            <td>{{ $index + 1 }}</td>
                            <td style="font-weight: 500;">
                                {{ $stock->nama_bahan }}
                                {!! $warningLabel !!}
                            </td>
                            <td>{{ $qty }} <span style="color:#6b7280; font-size:0.85rem;">{{ $stock->satuan }}</span></td>
                            <td>
                                <span class="status-badge {{ $badgeClass }}">{{ $badgeText }}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button onclick="openEditModal('{{ $stock->id_stok }}', '{{ addslashes($stock->nama_bahan) }}', '{{ $qty }}', '{{ addslashes($stock->satuan) }}')" class="action-btn edit" title="Edit Bahan Baku">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button onclick="confirmDelete('{{ $stock->id_stok }}', '{{ addslashes($stock->nama_bahan) }}')" class="action-btn delete" title="Hapus Bahan Baku">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="empty-state">Belum ada data stok bahan baku. Silakan tambahkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>

            <div class="form-card">
                <h3>+ Tambah Bahan Baru</h3>
                <form action="{{ route('admin.stock.store') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label>Nama Bahan Baku</label>
                        <input type="text" name="name" placeholder="Contoh: Beras Putih, Daging Ayam" required>
                    </div>

                    <div class="input-group">
                        <label>Jumlah</label>
                        <input type="number" name="quantity" placeholder="Contoh: 50" required min="0">
                    </div>

                    <div class="input-group">
                        <label>Satuan Ukur</label>
                        <select name="unit" required>
                            <option value="Kg">Kilogram (Kg)</option>
                            <option value="gr">Gram (gr)</option>
                            <option value="L">Liter (L)</option>
                            <option value="ml">Mililiter (ml)</option>
                            <option value="Butir">Butir</option>
                            <option value="Pcs">Buah / Pcs</option>
                            <option value="Pack">Pack</option>
                            <option value="Dus">Dus</option>
                            <option value="Botol">Botol</option>
                            <option value="Kaleng">Kaleng</option>
                            <option value="Ikat">Ikat</option>
                            <option value="Sachet">Sachet</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-submit">Simpan Stok</button>
                </form>
            </div>
        </div>

    </main>
    <!-- MODAL TAMBAH STOK -->
    <div id="addModal" style="
        display:none;
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.5);
        justify-content:center;
        align-items:center;
        z-index: 1000;
        backdrop-filter: blur(4px);
        padding: 20px;
        box-sizing: border-box;
    ">
        <div style="
            background:white;
            padding:30px;
            border-radius:16px;
            width:100%;
            max-width:400px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            position: relative;
            box-sizing: border-box;
        ">
            <!-- Modal Close X Button -->
            <button onclick="closeAddModal()" style="
                position: absolute;
                right: 20px;
                top: 20px;
                background: none;
                border: none;
                font-size: 1.25rem;
                color: var(--text-muted);
                cursor: pointer;
            ">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <h2 style="margin-bottom:20px; font-weight: 700; color: #111827;">+ Tambah Bahan Baru</h2>

            <form action="{{ route('admin.stock.store') }}" method="POST">
                @csrf

                <div class="input-group">
                    <label>Nama Bahan Baku</label>
                    <input type="text" name="name" placeholder="Contoh: Beras Putih, Daging Ayam" required>
                </div>

                <div class="input-group">
                    <label>Jumlah</label>
                    <input type="number" name="quantity" placeholder="Contoh: 50" required min="0">
                </div>

                <div class="input-group">
                    <label>Satuan Ukur</label>
                    <select name="unit" required>
                        <option value="Kg">Kilogram (Kg)</option>
                        <option value="gr">Gram (gr)</option>
                        <option value="L">Liter (L)</option>
                        <option value="ml">Mililiter (ml)</option>
                        <option value="Butir">Butir</option>
                        <option value="Pcs">Buah / Pcs</option>
                        <option value="Pack">Pack</option>
                        <option value="Dus">Dus</option>
                        <option value="Botol">Botol</option>
                        <option value="Kaleng">Kaleng</option>
                        <option value="Ikat">Ikat</option>
                        <option value="Sachet">Sachet</option>
                    </select>
                </div>

                <div style="display:flex; gap:10px; margin-top:24px;">
                    <button type="submit" class="btn-submit" style="flex: 1;">
                        Simpan
                    </button>
                    <button type="button" onclick="closeAddModal()" style="
                        flex: 1;
                        background:#dc2626;
                        color:white;
                        border:none;
                        padding:12px;
                        border-radius:8px;
                        font-weight: bold;
                        cursor:pointer;
                        transition: background 0.2s;
                    "
                    onmouseover="this.style.background='#b91c1c'"
                    onmouseout="this.style.background='#dc2626'">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div id="editModal" style="
        display:none;
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.5);
        justify-content:center;
        align-items:center;
        z-index: 1000;
        backdrop-filter: blur(4px);
        padding: 20px;
        box-sizing: border-box;
    ">

        <div style="
            background:white;
            padding:30px;
            border-radius:16px;
            width:100%;
            max-width:400px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            position: relative;
            box-sizing: border-box;
        ">
            <!-- Modal Close X Button -->
            <button onclick="closeEditModal()" type="button" style="
                position: absolute;
                right: 20px;
                top: 20px;
                background: none;
                border: none;
                font-size: 1.25rem;
                color: var(--text-muted);
                cursor: pointer;
            ">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <h2 style="margin-bottom:20px; font-weight: 700; color: #111827;">Ubah Stok</h2>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="input-group">
                    <label>Nama Bahan</label>
                    <input type="text" name="name" id="editName" required>
                </div>

                <div class="input-group">
                    <label>Jumlah</label>
                    <input type="number" name="quantity" id="editQuantity" required min="0">
                </div>

                <div class="input-group">
                    <label>Satuan</label>
                    <select name="unit" id="editUnitSelect" required>
                        <option value="Kg">Kilogram (Kg)</option>
                        <option value="gr">Gram (gr)</option>
                        <option value="L">Liter (L)</option>
                        <option value="ml">Mililiter (ml)</option>
                        <option value="Butir">Butir</option>
                        <option value="Pcs">Buah / Pcs</option>
                        <option value="Pack">Pack</option>
                        <option value="Dus">Dus</option>
                        <option value="Botol">Botol</option>
                        <option value="Kaleng">Kaleng</option>
                        <option value="Ikat">Ikat</option>
                        <option value="Sachet">Sachet</option>
                    </select>
                </div>

                <div style="display:flex; gap:10px; margin-top:24px;">
                    <button type="submit" class="btn-submit" style="flex: 1;">
                        Simpan
                    </button>

                    <button
                        type="button"
                        onclick="closeEditModal()"
                        style="
                        flex: 1;
                        background:#dc2626;
                        color:white;
                        border:none;
                        padding:12px;
                        border-radius:8px;
                        font-weight: bold;
                        cursor:pointer;
                        transition: background 0.2s;
                    "
                    onmouseover="this.style.background='#b91c1c'"
                    onmouseout="this.style.background='#dc2626'">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addModal').style.display = 'flex';
        }

        function closeAddModal() {
            document.getElementById('addModal').style.display = 'none';
        }

        function openEditModal(id, name, quantity, unit) {
            document.getElementById('editModal').style.display = 'flex';

            document.getElementById('editName').value = name;
            document.getElementById('editQuantity').value = quantity;
            
            const select = document.getElementById('editUnitSelect');
            
            // Check if unit option exists, if not create it dynamically (UX fallback)
            let found = false;
            for (let i = 0; i < select.options.length; i++) {
                if (select.options[i].value === unit) {
                    found = true;
                    break;
                }
            }
            if (!found && unit.trim() !== '') {
                const opt = document.createElement('option');
                opt.value = unit;
                opt.text = unit;
                select.add(opt);
            }
            select.value = unit;

            document.getElementById('editForm').action =
                '/admin/stock/' + id + '/update';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function confirmDelete(id, name) {
            if (confirm(`Apakah Anda yakin ingin menghapus bahan baku "${name}" secara permanen?`)) {
                const form = document.getElementById('delete-form');
                form.action = '/admin/stock/' + id + '/delete';
                form.submit();
            }
        }
    </script>

    <!-- Hidden Delete Form untuk Stok -->
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar collapse preference
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

            // Real-time client-side search filtering
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const query = this.value.toLowerCase().trim();
                    const rows = document.querySelectorAll('.stock-row');
                    rows.forEach(row => {
                        const name = row.getAttribute('data-name');
                        if (name.includes(query)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
</body>

</html>