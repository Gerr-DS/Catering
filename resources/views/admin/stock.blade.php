<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management - HafidzManage</title>
    <style>
        :root {
            --primary: #064e3b; 
            --primary-light: #059669;
            --danger: #dc2626;
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
        .sidebar-menu a { display: flex; align-items: center; padding: 12px; color: #6b7280; text-decoration: none; border-radius: 8px; font-weight: 500; transition: all 0.2s;}
        .sidebar-menu a:hover { background-color: #f3f4f6; }
        .sidebar-menu a.active { background-color: #f0fdf4; color: var(--primary-light); }

        /* Konten Utama */
        .main-content { flex: 1; padding: 40px; overflow-y: auto; }
        .header-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; }
        .header-title h1 { font-size: 1.8rem; font-weight: 800; color: #111827; }
        .header-title p { font-size: 0.85rem; color: #6b7280; margin-top: 4px; }
        
        .alert-success { background-color: #d1fae5; color: #065f46; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;}

        /* Tata Letak Konten Stok */
        .stock-layout { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; }

        /* Tabel Stok */
        .table-card { background: #ffffff; padding: 24px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; }
        .table-card h3 { margin-bottom: 20px; color: #111827; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 14px 16px; text-align: left; border-bottom: 1px solid #f3f4f6; }
        th { background-color: #f9fafb; font-weight: 600; color: #4b5563; font-size: 0.9rem;}
        td { font-size: 0.95rem; color: #1f2937; }
        .badge { background-color: #e0e7ff; color: #3730a3; padding: 4px 8px; border-radius: 6px; font-size: 0.8rem; font-weight: bold; }
        .empty-state { text-align: center; padding: 30px; color: #9ca3af; font-style: italic; }

        /* Form Tambah Stok */
        .form-card { background: #ffffff; padding: 24px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); border: 1px solid #f3f4f6; height: fit-content;}
        .form-card h3 { margin-bottom: 20px; color: #111827; }
        .input-group { margin-bottom: 16px; }
        .input-group label { display: block; font-size: 0.85rem; color: #4b5563; margin-bottom: 6px; font-weight: 500; }
        .input-group input, .input-group select { width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; outline: none; transition: border 0.2s; }
        .input-group input:focus, .input-group select:focus { border-color: var(--primary-light); }
        .btn-submit { width: 100%; padding: 12px; background-color: var(--primary-light); color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: background 0.2s; }
        .btn-submit:hover { background-color: var(--primary); }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <h2><span style="background:var(--primary); color:white; padding:4px 8px; border-radius:6px;">H</span> HafidzManage</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="/admin/dashboard">Dashboard</a></li>
            <li><a href="/admin/stock" class="active">Stock Management</a></li>
            <li><a href="/admin/menu">Menu Management</a></li>
            <li><a href="/admin/reports">Reports</a></li>
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
                <h1>Stock Management</h1>
                <p>Pantau ketersediaan bahan baku katering Anda.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="stock-layout">
            <div class="table-card">
                <h3>Daftar Bahan Tersedia</h3>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bahan</th>
                            <th>Jumlah Stok</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stocks as $index => $stock)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td style="font-weight: 500;">{{ $stock->name }}</td>
                            <td>{{ $stock->quantity }} <span style="color:#6b7280; font-size:0.85rem;">{{ $stock->unit }}</span></td>
                            <td>
                                @if($stock->quantity <= 5)
                                    <span class="badge" style="background-color: #fee2e2; color: #991b1b;">Low Stock</span>
                                @else
                                    <span class="badge" style="background-color: #d1fae5; color: #065f46;">Aman</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="empty-state">Belum ada data stok bahan baku. Silakan tambahkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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
                            <option value="Liter">Liter (L)</option>
                            <option value="Gram">Gram (gr)</option>
                            <option value="Pcs">Pieces (Pcs/Buah)</option>
                            <option value="Ikat">Ikat</option>
                            <option value="Pack">Pack</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-submit">Simpan Stok</button>
                </form>
            </div>
        </div>

    </main>

</body>
</html>