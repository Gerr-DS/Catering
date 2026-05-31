<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
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

        .status-ready {
            color: #059669;
            font-weight: bold;
        }

        .status-soldout {
            color: var(--danger);
            font-weight: bold;
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

        @media (max-width: 600px) {
            .summary-grid {
                grid-template-columns: 1fr;
            }
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
        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 30px;">
            <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div>
                <h1 style="font-size: 1.8rem; font-weight: 800; color: #111827; margin: 0;">Menu Management</h1>
                <p style="font-size: 0.85rem; color: #6b7280; margin-top: 4px;">Atur menu yang tampil di halaman pembeli.</p>
            </div>
        </div>

        @if(session('success')) 
            <div style="background-color: #d1fae5; color: #065f46; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
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
                    <div class="search-container" style="width: 280px; margin: 0;">
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

            <table style="width: 100%; table-layout: fixed; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="width: 12%; padding: 12px; text-align: left; font-weight: 600; color: #4b5563; font-size: 0.95rem; background-color: #f9fafb; border-bottom: 1px solid #eee;">Foto</th>
                        <th style="width: 28%; padding: 12px; text-align: left; font-weight: 600; color: #4b5563; font-size: 0.95rem; background-color: #f9fafb; border-bottom: 1px solid #eee;">Nama Menu</th>
                        <th style="width: 18%; padding: 12px; text-align: left; font-weight: 600; color: #4b5563; font-size: 0.95rem; background-color: #f9fafb; border-bottom: 1px solid #eee;">Harga</th>
                        <th style="width: 17%; padding: 12px; text-align: left; font-weight: 600; color: #4b5563; font-size: 0.95rem; background-color: #f9fafb; border-bottom: 1px solid #eee;">Status</th>
                        <th style="width: 25%; padding: 12px; text-align: center; font-weight: 600; color: #4b5563; font-size: 0.95rem; background-color: #f9fafb; border-bottom: 1px solid #eee;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="menuTableBody">
                    @forelse($menus as $menu)
                    <tr class="menu-row" data-name="{{ strtolower($menu->nama_menu) }}" data-status="{{ $menu->status ? 'ready' : 'habis' }}">
                        <!-- Column Foto -->
                        <td style="padding: 12px; border-bottom: 1px solid #eee; text-align: left; vertical-align: middle;">
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

                        <td style="font-weight: 600; color: var(--text-dark); padding: 16px 12px; text-align: left; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; border-bottom: 1px solid #eee; vertical-align: middle;">{{ $menu->nama_menu }}</td>
                        <td style="color: var(--primary); font-weight: 600; padding: 16px 12px; text-align: left; border-bottom: 1px solid #eee; vertical-align: middle;">Rp {{ number_format($menu->harga_menu, 0, ',', '.') }}</td>
                        <td style="padding: 16px 12px; text-align: left; border-bottom: 1px solid #eee; vertical-align: middle;">
                            <span class="{{ $menu->status ? 'status-ready' : 'status-soldout' }}" style="
                                display: inline-block;
                                padding: 6px 12px;
                                border-radius: 50px;
                                font-size: 0.85rem;
                                font-weight: 600;
                                background-color: {{ $menu->status ? '#d1fae5' : '#fee2e2' }};
                                color: {{ $menu->status ? '#065f46' : '#991b1b' }};
                            ">
                                {{ $menu->status ? 'Ready' : 'Habis' }}
                            </span>
                        </td>
                        <td style="padding: 16px 12px; text-align: center; border-bottom: 1px solid #eee; vertical-align: middle;">
                            <div style="display: flex; gap: 8px; align-items: center; justify-content: center;">
                                <button
                                    type="button"
                                    onclick="openEditModal(
                                        '{{ $menu->id_menu }}',
                                        '{{ addslashes($menu->nama_menu) }}',
                                        '{{ $menu->harga_menu }}',
                                        '{{ $menu->status_menu }}',
                                        '{{ addslashes($menu->deskripsi) }}'
                                    )"
                                    style="
                                        background: #2563eb;
                                        color: white;
                                        border: none;
                                        padding: 8px 16px;
                                        border-radius: 8px;
                                        cursor: pointer;
                                        font-weight: 600;
                                        font-size: 0.85rem;
                                        transition: background 0.2s;
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 6px;
                                    "
                                    onmouseover="this.style.background='#1d4ed8'"
                                    onmouseout="this.style.background='#2563eb'">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                
                                <button
                                    type="button"
                                    onclick="openDeleteModal('{{ $menu->id_menu }}', '{{ addslashes($menu->nama_menu) }}')"
                                    style="
                                        background: #dc2626;
                                        color: white;
                                        border: none;
                                        padding: 8px 16px;
                                        border-radius: 8px;
                                        cursor: pointer;
                                        font-weight: 600;
                                        font-size: 0.85rem;
                                        transition: background 0.2s;
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 6px;
                                    "
                                    onmouseover="this.style.background='#991b1b'"
                                    onmouseout="this.style.background='#dc2626'">
                                    <i class="fa-solid fa-trash"></i> Hapus
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

            <!-- Client-side Pagination panel -->
            <div class="pagination-container" id="paginationContainer" style="display: flex; justify-content: space-between; align-items: center; margin-top: 24px; padding-top: 16px; border-top: 1px solid #f3f4f6;">
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
        z-index:9999;
    ">
        <div style="
            background:white;
            padding:30px;
            border-radius:16px;
            width:450px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        ">
            <h2 style="margin-bottom:20px; font-size: 1.35rem; font-weight: 700; color: var(--text-dark);">
                + Tambah Menu Baru
            </h2>

            <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="margin-bottom:15px;">
                    <label style="display: block; font-size: 0.85rem; color: #4b5563; margin-bottom: 6px; font-weight: 500;">Nama Menu</label>
                    <input
                        type="text"
                        name="name"
                        placeholder="Contoh: Nasi Tumpeng Spesial"
                        required
                        style="
                            width:100%;
                            padding:10px;
                            border:1px solid #ddd;
                            border-radius:8px;
                            outline: none;
                        ">
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display: block; font-size: 0.85rem; color: #4b5563; margin-bottom: 6px; font-weight: 500;">Deskripsi Menu</label>
                    <textarea
                        name="description"
                        placeholder="Masukkan penjelasan lezat mengenai menu katering ini..."
                        rows="3"
                        style="
                            width:100%;
                            padding:10px;
                            border:1px solid #ddd;
                            border-radius:8px;
                            outline: none;
                            resize: vertical;
                            font-family: inherit;
                        "></textarea>
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display: block; font-size: 0.85rem; color: #4b5563; margin-bottom: 6px; font-weight: 500;">Harga (Rp)</label>
                    <input
                        type="number"
                        name="price"
                        placeholder="Contoh: 25000"
                        required
                        style="
                            width:100%;
                            padding:10px;
                            border:1px solid #ddd;
                            border-radius:8px;
                            outline: none;
                        ">
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display: block; font-size: 0.85rem; color: #4b5563; margin-bottom: 6px; font-weight: 500;">Status</label>
                    <select
                        name="status"
                        style="
                            width:100%;
                            padding:10px;
                            border:1px solid #ddd;
                            border-radius:8px;
                            outline: none;
                        ">
                        <option value="1">Ready</option>
                        <option value="0">Habis</option>
                    </select>
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display: block; font-size: 0.85rem; color: #4b5563; margin-bottom: 6px; font-weight: 500;">Gambar Menu</label>
                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        required
                        style="
                            width:100%;
                            padding:10px;
                            border:1px solid #ddd;
                            border-radius:8px;
                            background-color: #f9fafb;
                        ">
                </div>

                <div style="display:flex; gap:10px; margin-top:25px;">
                    <button
                        type="submit"
                        style="
                            flex:1;
                            background:#059669;
                            color:white;
                            border:none;
                            padding:12px;
                            border-radius:8px;
                            font-weight: 600;
                            cursor:pointer;
                            transition: background 0.2s;
                        "
                        onmouseover="this.style.background='#064e3b'"
                        onmouseout="this.style.background='#059669'">
                        Simpan Menu
                    </button>

                    <button
                        type="button"
                        onclick="closeAddModal()"
                        style="
                            flex:1;
                            background:#dc2626;
                            color:white;
                            border:none;
                            padding:12px;
                            border-radius:8px;
                            font-weight: 600;
                            cursor:pointer;
                            transition: background 0.2s;
                        "
                        onmouseover="this.style.background='#991b1b'"
                        onmouseout="this.style.background='#dc2626'">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT MENU -->
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
        z-index:9999;
    ">
        <div style="
            background:white;
            padding:30px;
            border-radius:16px;
            width:450px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        ">
            <h2 style="margin-bottom:20px; font-weight: 700; color: var(--text-dark);">
                Edit Menu
            </h2>

            <form
                id="editForm"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div style="margin-bottom:15px;">
                    <label style="display: block; font-size: 0.85rem; color: #4b5563; margin-bottom: 6px; font-weight: 500;">Nama Menu</label>
                    <input
                        type="text"
                        name="name"
                        id="editName"
                        required
                        style="
                            width:100%;
                            padding:10px;
                            border:1px solid #ddd;
                            border-radius:8px;
                            outline: none;
                        ">
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display: block; font-size: 0.85rem; color: #4b5563; margin-bottom: 6px; font-weight: 500;">Deskripsi Menu</label>
                    <textarea
                        name="description"
                        id="editDescription"
                        placeholder="Masukkan penjelasan lezat mengenai menu katering ini..."
                        rows="3"
                        style="
                            width:100%;
                            padding:10px;
                            border:1px solid #ddd;
                            border-radius:8px;
                            outline: none;
                            resize: vertical;
                            font-family: inherit;
                        "></textarea>
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display: block; font-size: 0.85rem; color: #4b5563; margin-bottom: 6px; font-weight: 500;">Harga</label>
                    <input
                        type="number"
                        name="price"
                        id="editPrice"
                        required
                        style="
                            width:100%;
                            padding:10px;
                            border:1px solid #ddd;
                            border-radius:8px;
                            outline: none;
                        ">
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display: block; font-size: 0.85rem; color: #4b5563; margin-bottom: 6px; font-weight: 500;">Status</label>
                    <select
                        name="status"
                        id="editStatus"
                        style="
                            width:100%;
                            padding:10px;
                            border:1px solid #ddd;
                            border-radius:8px;
                            outline: none;
                        ">
                        <option value="1">Ready</option>
                        <option value="0">Habis</option>
                    </select>
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display: block; font-size: 0.85rem; color: #4b5563; margin-bottom: 6px; font-weight: 500;">Gambar Baru</label>
                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        style="
                            width:100%;
                            padding:10px;
                            border:1px solid #ddd;
                            border-radius:8px;
                            outline: none;
                            background-color: #f9fafb;
                        ">
                </div>

                <div style="display:flex; gap:10px; margin-top:25px;">
                    <button
                        type="submit"
                        style="
                            flex:1;
                            background:#059669;
                            color:white;
                            border:none;
                            padding:12px;
                            border-radius:8px;
                            font-weight: 600;
                            cursor:pointer;
                            transition: background 0.2s;
                        "
                        onmouseover="this.style.background='#064e3b'"
                        onmouseout="this.style.background='#059669'">
                        Simpan
                    </button>

                    <button
                        type="button"
                        onclick="closeEditModal()"
                        style="
                            flex:1;
                            background:#dc2626;
                            color:white;
                            border:none;
                            padding:12px;
                            border-radius:8px;
                            font-weight: 600;
                            cursor:pointer;
                            transition: background 0.2s;
                        "
                        onmouseover="this.style.background='#991b1b'"
                        onmouseout="this.style.background='#dc2626'">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DELETE CONFIRMATION -->
    <div id="deleteConfirmModal" style="
        display:none;
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.6);
        justify-content:center;
        align-items:center;
        z-index:10000;
        backdrop-filter: blur(4px);
        transition: all 0.3s;
    ">
        <div style="
            background:white;
            padding:30px;
            border-radius:16px;
            width:420px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: scale(0.9);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-align: center;
        " id="deleteModalContent">
            <div style="color: var(--red); font-size: 3rem; margin-bottom: 15px;">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3 style="font-size: 1.4rem; font-weight: 700; color: #111827; margin-bottom: 12px;">Hapus Menu</h3>
            <p style="color: #4b5563; font-size: 0.95rem; margin-bottom: 8px; line-height: 1.5;">Apakah Anda yakin ingin menghapus menu ini?</p>
            <div style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px; margin-bottom: 24px;">
                <span style="display: block; font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 4px;">Nama Menu</span>
                <strong id="deleteMenuName" style="color: #111827; font-size: 1rem; word-break: break-all;">-</strong>
            </div>
            <div style="display: flex; gap: 12px; justify-content: center;">
                <button type="button" onclick="closeDeleteModal()" style="
                    flex: 1;
                    background: #6b7280;
                    color: white;
                    border: none;
                    padding: 12px;
                    border-radius: 8px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: background 0.2s;
                " onmouseover="this.style.background='#4b5563'" onmouseout="this.style.background='#6b7280'">
                    Batal
                </button>
                <form id="deleteForm" method="POST" style="flex: 1; margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="
                        width: 100%;
                        background: var(--red);
                        color: white;
                        border: none;
                        padding: 12px;
                        border-radius: 8px;
                        font-weight: 600;
                        cursor: pointer;
                        transition: background 0.2s;
                    " onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">
                        Hapus
                    </button>
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
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed && sidebar) {
                sidebar.classList.add('collapsed');
            }

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