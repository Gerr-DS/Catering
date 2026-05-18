<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menu Management - HafidzManage</title>
    <style>
        :root { --primary: #064e3b; --primary-light: #059669; --danger: #dc2626; --bg-color: #fafafa; }
        body { display: flex; font-family: 'Inter', sans-serif; background: var(--bg-color); margin:0; }
        .sidebar { width: 250px; background: white; height: 100vh; padding: 20px; box-shadow: 2px 0 5px rgba(0,0,0,0.02); }
        .sidebar h2 { color: var(--primary); margin-bottom:30px; }
        .sidebar a { display: block; padding: 12px; color: #6b7280; text-decoration: none; border-radius: 8px; margin-bottom: 5px; }
        .sidebar a.active { background: #f0fdf4; color: var(--primary-light); font-weight: bold; }
        .main-content { flex: 1; padding: 40px; }
        .card { background: white; padding: 25px; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.03); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        .btn-add { background: var(--primary-light); color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; }
        .status-ready { color: #059669; font-weight: bold; }
        .status-soldout { color: var(--danger); font-weight: bold; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <h2>HafidzManage</h2>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.stock.index') }}">Stock Management</a>
        <a href="{{ route('admin.menu.index') }}" class="active">Menu Management</a>
        <a href="{{ route('admin.reports') }}">Reports</a>
    </aside>

    <main class="main-content">
        <h1>Menu Management</h1>
        <p>Atur menu yang tampil di halaman pembeli.</p>

        @if(session('success')) <div style="color: green; margin-bottom: 20px;">{{ session('success') }}</div> @endif

        <div class="card">
            <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; gap: 10px; margin-bottom: 30px; align-items: center;">
                @csrf
        
                <input type="text" name="name" placeholder="Nama Menu" required style="padding: 10px; border-radius: 8px; border: 1px solid #ddd; flex: 2;">
        
                <input type="number" name="price" placeholder="Harga (Rp)" required style="padding: 10px; border-radius: 8px; border: 1px solid #ddd; flex: 1;">
        
                <select name="status" style="padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
                    <option value="1">Ready</option>
                    <option value="0">Habis</option>
                </select>

                <input type="file" name="image" accept="image/*" style="padding: 7px; border-radius: 8px; border: 1px solid #ddd; flex: 1.5; background-color: #fff;">

                <button type="submit" class="btn-add">+ Tambah Menu</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->name }}</td>
                    <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                    <td>
                        <span class="{{ $menu->status ? 'status-ready' : 'status-soldout' }}">
                            {{ $menu->status ? 'Ready' : 'Habis' }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" style="display:inline;">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="{{ $menu->status ? 0 : 1 }}">
                            <button type="submit" style="cursor:pointer; border:none; background:none; color:blue; text-decoration:underline;">
                                Ubah Status
                            </button>
                        </form>
                        |
                        <form action="{{ route('admin.menu.delete', $menu->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" style="color:red; border:none; background:none; cursor:pointer;" onclick="return confirm('Hapus menu ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </main>
</body>
</html>