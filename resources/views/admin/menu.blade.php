<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Management - HafidzManage</title>
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

        .main-content {
            flex: 1;
            padding: 20px 40px 40px;
            overflow-y: auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.03);
            border: 1px solid #f3f4f6;
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
            vertical-align: middle;
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

        .btn-add {
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-add:hover {
            background: var(--primary-dark);
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
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

        .status-badge.ready {
            background-color: #ecfdf5;
            color: #047857;
            border-color: #a7f3d0;
        }

        .status-badge.habis {
            background-color: #fef2f2;
            color: #b91c1c;
            border-color: #fecaca;
        }

        /* Custom Action buttons similar to stock */
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

        /* Premium Modal Styles */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
            backdrop-filter: blur(4px);
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 480px;
            padding: 32px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            position: relative;
        }

        .modal-close-btn {
            position: absolute;
            right: 24px;
            top: 24px;
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #94a3b8;
            cursor: pointer;
            transition: color 0.2s;
        }

        .modal-close-btn:hover {
            color: var(--text-dark);
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 24px;
        }

        /* Form styling inside Modals */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.9rem;
            outline: none;
            background: white;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
        }

        textarea.form-control {
            height: 80px;
            resize: none;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .btn {
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            outline: none;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #4b5563;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        /* Dynamic Menu Statistics Cards */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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

        .theme-total .summary-icon { background: #eff6ff; color: #2563eb; }
        .theme-aman .summary-icon { background: #ecfdf5; color: #059669; }
        .theme-habis .summary-icon { background: #fef2f2; color: #dc2626; }

        /* Search input & container */
        .search-container {
            position: relative;
            width: 280px;
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
            padding: 10px 16px 10px 42px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
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

        /* Filter Pills */
        .filter-pills {
            display: flex;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 10px;
            gap: 2px;
        }

        .filter-pill {
            background: transparent;
            border: none;
            color: #64748b;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .filter-pill:hover {
            color: #1e293b;
            background: rgba(255, 255, 255, 0.5);
        }

        .filter-pill.active {
            color: var(--primary);
            background: #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        /* Pagination Buttons */
        .pagination-btn {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            color: #4b5563;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .pagination-btn:hover:not(:disabled) {
            background: #f9fafb;
            border-color: #cbd5e1;
            color: #1f2937;
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

        @media (max-width: 900px) {
            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
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

            .summary-grid {
                grid-template-columns: 1fr !important;
                gap: 16px !important;
            }

            .card > div:first-child {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 12px !important;
            }

            .card > div:first-child > div {
                width: 100% !important;
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 12px !important;
            }

            .filter-pills {
                display: flex;
                width: 100% !important;
            }

            .filter-pill {
                flex: 1;
                text-align: center;
            }

            .search-container {
                width: 100% !important;
            }

            .btn-add {
                width: 100% !important;
                justify-content: center;
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

            .card {
                padding: 16px !important;
            }

            .pagination-container {
                flex-direction: column !important;
                gap: 12px !important;
                align-items: center !important;
                text-align: center;
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
                    <span>MANAGEMENT PORTAL</span>
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
                <a href="{{ route('admin.stock.index') }}">
                    <i class="fa-solid fa-box"></i>
                    <span>Stock Management</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.menu.index') }}" class="active">
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

    <main class="main-content">
        <div class="header-top" style="display: flex; align-items: center; gap: 20px; margin-bottom: 25px;">
            <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="header-title">
                <h1>Menu Management</h1>
                <p>Atur menu yang tampil di halaman pembeli.</p>
            </div>
        </div>

        @if(session('success')) 
            <div class="alert-success">
                {{ session('success') }}
            </div> 
        @endif

        <!-- Dynamic Menu Statistics Cards -->
        <div class="summary-grid">
            <div class="summary-card theme-total">
                <div class="summary-icon"><i class="fa-solid fa-list"></i></div>
                <div class="summary-info">
                    <h4>Total Menu</h4>
                    <div class="value">{{ $menus->count() }}</div>
                </div>
            </div>
            <div class="summary-card theme-aman">
                <div class="summary-icon"><i class="fa-solid fa-circle-check"></i></div>
                <div class="summary-info">
                    <h4>Menu Ready</h4>
                    <div class="value">{{ $menus->where('status_menu', '1')->count() }}</div>
                </div>
            </div>
            <div class="summary-card theme-habis">
                <div class="summary-icon"><i class="fa-solid fa-circle-xmark"></i></div>
                <div class="summary-info">
                    <h4>Menu Habis</h4>
                    <div class="value">{{ $menus->where('status_menu', '0')->count() }}</div>
                </div>
            </div>
        </div>

        <div class="card">
            <!-- Filter, Search and Add Row -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px solid var(--border-color); padding-bottom: 20px; flex-wrap: wrap; gap: 16px;">
                <div style="display: flex; gap: 16px; align-items: center; flex-wrap: wrap; flex: 1;">
                    <!-- Search input -->
                    <div class="search-container" style="margin: 0;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="searchInput" class="search-input" placeholder="Cari nama menu...">
                    </div>
                    
                    <!-- Filter pills -->
                    <div class="filter-pills">
                        <button class="filter-pill active" data-filter="semua">Semua</button>
                        <button class="filter-pill" data-filter="ready">Ready</button>
                        <button class="filter-pill" data-filter="habis">Habis</button>
                    </div>
                </div>

                <button onclick="openAddModal()" class="btn-add" style="display: flex; align-items: center; gap: 8px; font-weight: 600; font-size: 0.9rem;">
                    <i class="fa-solid fa-plus"></i> Tambah Menu Baru
                </button>
            </div>

            <div class="table-responsive">
                <table>
                <thead>
                    <tr>
                        <th style="width: 12%;">Foto</th>
                        <th style="width: 33%;">Nama Menu</th>
                        <th style="width: 20%;">Harga</th>
                        <th style="width: 18%;">Status</th>
                        <th style="width: 17%; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="menuTableBody">
                    @forelse($menus as $menu)
                    <tr class="menu-row" data-name="{{ strtolower($menu->nama_menu) }}" data-status="{{ $menu->status ? 'ready' : 'habis' }}">
                        <!-- Column Foto -->
                        <td>
                            <div style="width: 56px; height: 56px; border-radius: 10px; overflow: hidden; background: #f3f4f6; border: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                @if($menu->gambar)
                                    <img src="{{ asset('storage/menus/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div style="width: 100%; height: 100%; display: none; align-items: center; justify-content: center; background: #ecfdf5; color: #059669;">
                                        <i class="fa-solid fa-utensils" style="font-size: 1.15rem;"></i>
                                    </div>
                                @else
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #ecfdf5; color: #059669;">
                                        <i class="fa-solid fa-utensils" style="font-size: 1.15rem;"></i>
                                    </div>
                                @endif
                            </div>
                        </td>

                        <td style="font-weight: 600; color: var(--text-dark); max-width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $menu->nama_menu }}</td>
                        <td style="color: var(--primary); font-weight: 600;">Rp {{ number_format($menu->harga_menu, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge {{ $menu->status ? 'ready' : 'habis' }}">
                                <i class="fa-solid {{ $menu->status ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>
                                {{ $menu->status ? 'Ready' : 'Habis' }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 8px; align-items: center; justify-content: center;">
                                <button
                                    type="button"
                                    class="action-btn edit"
                                    title="Edit Menu"
                                    onclick="openEditModal(
                                        '{{ $menu->id_menu }}',
                                        '{{ addslashes($menu->nama_menu) }}',
                                        '{{ $menu->harga_menu }}',
                                        '{{ $menu->status_menu }}',
                                        '{{ addslashes($menu->deskripsi) }}'
                                    )">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                
                                <button
                                    type="button"
                                    class="action-btn delete"
                                    title="Hapus Menu"
                                    onclick="openDeleteModal('{{ $menu->id_menu }}', '{{ addslashes($menu->nama_menu) }}')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="5" class="empty-state" style="text-align: center; padding: 40px; color: #9ca3af; font-style: italic;">
                            Belum ada data menu. Silakan tambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            </div>

            <!-- Client-side Pagination panel -->
            <div class="pagination-container" id="paginationContainer" style="display: flex; justify-content: space-between; align-items: center; margin-top: 24px; padding-top: 16px; border-top: 1px solid #f3f4f6; flex-wrap: wrap; gap: 16px;">
                <div class="pagination-info" style="font-size: 0.85rem; color: #6b7280;" id="paginationInfo">
                    Menampilkan <span id="startIdx" style="font-weight: 600; color: #111827;">0</span> - <span id="endIdx" style="font-weight: 600; color: #111827;">0</span> dari <span id="totalIdx" style="font-weight: 600; color: #111827;">0</span> menu
                </div>
                <div class="pagination-buttons" style="display: flex; gap: 6px; align-items: center;" id="paginationButtons">
                    <!-- Dynamic page elements -->
                </div>
            </div>
        </div>
    </main>

    <!-- MODAL TAMBAH MENU -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <button onclick="closeAddModal()" class="modal-close-btn"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="modal-title">+ Tambah Menu Baru</h3>

            <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Nama Menu</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Nasi Tumpeng Spesial" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi Menu</label>
                    <textarea name="description" class="form-control" placeholder="Masukkan penjelasan lezat mengenai menu katering ini..."></textarea>
                </div>

                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" name="price" class="form-control" placeholder="Contoh: 25000" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Ready</option>
                        <option value="0">Habis</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Gambar Menu</label>
                    <input type="file" name="image" accept="image/*" class="form-control" required style="background-color: #f9fafb;">
                </div>

                <div class="modal-actions">
                    <button type="button" onclick="closeAddModal()" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Menu</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT MENU -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <button onclick="closeEditModal()" class="modal-close-btn"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="modal-title">Edit Menu</h3>

            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Menu</label>
                    <input type="text" name="name" id="editName" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi Menu</label>
                    <textarea name="description" id="editDescription" class="form-control" placeholder="Masukkan penjelasan lezat mengenai menu katering ini..."></textarea>
                </div>

                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" name="price" id="editPrice" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="editStatus" class="form-control">
                        <option value="1">Ready</option>
                        <option value="0">Habis</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Gambar Baru</label>
                    <input type="file" name="image" accept="image/*" class="form-control" style="background-color: #f9fafb;">
                </div>

                <div class="modal-actions">
                    <button type="button" onclick="closeEditModal()" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DELETE CONFIRMATION -->
    <div id="deleteConfirmModal" class="modal">
        <div class="modal-content" style="text-align: center;">
            <div style="color: var(--red); font-size: 3rem; margin-bottom: 15px;">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3 class="modal-title" style="margin-bottom: 12px;">Hapus Menu</h3>
            <p style="color: #4b5563; font-size: 0.95rem; margin-bottom: 16px; line-height: 1.5;">Apakah Anda yakin ingin menghapus menu ini?</p>
            
            <div style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px; margin-bottom: 24px;">
                <span style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 4px;">Nama Menu</span>
                <strong id="deleteMenuName" style="color: #111827; font-size: 1rem; word-break: break-all;">-</strong>
            </div>

            <div style="display: flex; gap: 12px; justify-content: center;">
                <button type="button" onclick="closeDeleteModal()" class="btn btn-secondary" style="flex: 1;">Batal</button>
                <form id="deleteForm" method="POST" style="flex: 1; margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary" style="width: 100%; background: var(--red);">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addModal').style.display = 'flex';
        }

        function closeAddModal() {
            document.getElementById('addModal').style.display = 'none';
        }

        function openEditModal(id, name, price, status, description) {
            document.getElementById('editModal').style.display = 'flex';
            document.getElementById('editName').value = name;
            document.getElementById('editPrice').value = price;
            document.getElementById('editStatus').value = status;
            document.getElementById('editDescription').value = description || '';

            document.getElementById('editForm').action =
                '/admin/menu/' + id + '/update';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        // Custom Delete Confirmation Modal
        function openDeleteModal(id, name) {
            document.getElementById('deleteMenuName').textContent = name;
            document.getElementById('deleteForm').action = '/admin/menu/' + id + '/delete';
            
            const modal = document.getElementById('deleteConfirmModal');
            const content = document.getElementById('deleteModalContent');
            modal.style.display = 'flex';
            setTimeout(() => {
                content.style.transform = 'scale(1)';
            }, 10);
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteConfirmModal');
            const content = document.getElementById('deleteModalContent');
            content.style.transform = 'scale(0.9)';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 150);
        }
    </script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        // JavaScript Client-side Search, Filter & Pagination Engine
        let currentPage = 1;
        const itemsPerPage = 8;
        let filteredRows = [];

        function applyFilters() {
            const query = document.getElementById('searchInput').value.toLowerCase().trim();
            const activePill = document.querySelector('.filter-pill.active');
            const statusFilter = activePill ? activePill.getAttribute('data-filter') : 'semua';
            
            const rows = Array.from(document.querySelectorAll('.menu-row'));
            
            filteredRows = rows.filter(row => {
                const name = row.getAttribute('data-name');
                const status = row.getAttribute('data-status');
                
                const matchesSearch = name.includes(query);
                const matchesStatus = (statusFilter === 'semua') || (status === statusFilter);
                
                return matchesSearch && matchesStatus;
            });

            currentPage = 1;
            renderPagination();
        }

        function renderPagination() {
            const totalItems = filteredRows.length;
            const totalPages = Math.ceil(totalItems / itemsPerPage) || 1;
            
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;
            
            const start = (currentPage - 1) * itemsPerPage;
            const end = Math.min(start + itemsPerPage, totalItems);
            
            // Hide all rows
            const allRows = document.querySelectorAll('.menu-row');
            allRows.forEach(row => row.style.display = 'none');
            
            // Show only paginated rows
            for (let i = start; i < end; i++) {
                filteredRows[i].style.display = '';
            }
            
            // Handle Empty State row visibility
            const emptyRow = document.querySelector('.empty-row');
            if (emptyRow) {
                emptyRow.style.display = totalItems === 0 ? '' : 'none';
            }
            
            // Update info labels
            document.getElementById('startIdx').textContent = totalItems === 0 ? 0 : start + 1;
            document.getElementById('endIdx').textContent = end;
            document.getElementById('totalIdx').textContent = totalItems;
            
            // Update buttons container
            const container = document.getElementById('paginationButtons');
            container.innerHTML = '';
            
            if (totalPages > 1) {
                // Prev Arrow
                const prevBtn = document.createElement('button');
                prevBtn.className = 'pagination-btn';
                prevBtn.innerHTML = '<i class="fa-solid fa-chevron-left"></i>';
                prevBtn.disabled = currentPage === 1;
                prevBtn.onclick = () => { currentPage--; renderPagination(); };
                container.appendChild(prevBtn);
                
                // Page Numbers
                for (let i = 1; i <= totalPages; i++) {
                    const pageBtn = document.createElement('button');
                    pageBtn.className = `pagination-btn ${i === currentPage ? 'active' : ''}`;
                    pageBtn.textContent = i;
                    pageBtn.onclick = () => { currentPage = i; renderPagination(); };
                    container.appendChild(pageBtn);
                }
                
                // Next Arrow
                const nextBtn = document.createElement('button');
                nextBtn.className = 'pagination-btn';
                nextBtn.innerHTML = '<i class="fa-solid fa-chevron-right"></i>';
                nextBtn.disabled = currentPage === totalPages;
                nextBtn.onclick = () => { currentPage++; renderPagination(); };
                container.appendChild(nextBtn);
                
                document.getElementById('paginationContainer').style.display = 'flex';
            } else {
                document.getElementById('paginationContainer').style.display = totalItems > 0 ? 'flex' : 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar preference
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

            // Real-time Search Box trigger
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', applyFilters);
            }

            // Filter pills toggle triggers
            document.querySelectorAll('.filter-pill').forEach(pill => {
                pill.addEventListener('click', function() {
                    document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
                    this.classList.add('active');
                    applyFilters();
                });
            });

            // Initial load of the search pagination engine
            applyFilters();
        });
    </script>
</body>

</html>