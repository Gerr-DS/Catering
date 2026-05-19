<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Menu Management - HafidzManage</title>
    <style>
        :root {
            --primary: #064e3b;
            --primary-light: #059669;
            --danger: #dc2626;
            --bg-color: #fafafa;
        }

        body {
            display: flex;
            font-family: 'Inter', sans-serif;
            background: var(--bg-color);
            margin: 0;
        }

        .sidebar {
            width: 250px;
            background: white;
            height: 100vh;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.02);
        }

        .sidebar h2 {
            color: var(--primary);
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            color: #6b7280;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .sidebar a.active {
            background: #f0fdf4;
            color: var(--primary-light);
            font-weight: bold;
        }

        .main-content {
            flex: 1;
            padding: 40px;
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
            background: var(--primary-light);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .status-ready {
            color: #059669;
            font-weight: bold;
        }

        .status-soldout {
            color: var(--danger);
            font-weight: bold;
        }
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
                            <button
                                type="button"

                                onclick="openEditModal(
        '{{ $menu->id }}',
        '{{ $menu->name }}',
        '{{ $menu->price }}',
        '{{ $menu->status }}'
    )"

                                style="
        background:#2563eb;
        color:white;
        border:none;
        padding:8px 12px;
        border-radius:6px;
        cursor:pointer;
    ">
                                Edit
                            </button>
                            </form>
                            |
                            <form action="{{ route('admin.menu.delete', $menu->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Hapus menu ini?')"
                                    style="
            background:#dc2626;
            color:white;
            border:none;
            padding:8px 12px;
            border-radius:6px;
            cursor:pointer;
        ">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
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
        border-radius:12px;
        width:450px;
    ">

            <h2 style="margin-bottom:20px;">
                Edit Menu
            </h2>

            <form
                id="editForm"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div style="margin-bottom:15px;">
                    <label>Nama Menu</label>

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
                    ">
                </div>

                <div style="margin-bottom:15px;">
                    <label>Harga</label>

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
                    ">
                </div>

                <div style="margin-bottom:15px;">
                    <label>Status</label>

                    <select
                        name="status"
                        id="editStatus"
                        style="
                        width:100%;
                        padding:10px;
                        border:1px solid #ddd;
                        border-radius:8px;
                    ">
                        <option value="1">Ready</option>
                        <option value="0">Habis</option>
                    </select>
                </div>

                <div style="margin-bottom:15px;">
                    <label>Gambar Baru</label>

                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        style="
                        width:100%;
                        padding:10px;
                        border:1px solid #ddd;
                        border-radius:8px;
                    ">
                </div>

                <div style="
                display:flex;
                gap:10px;
                margin-top:20px;
            ">

                    <button
                        type="submit"
                        style="
                        flex:1;
                        background:#059669;
                        color:white;
                        border:none;
                        padding:12px;
                        border-radius:8px;
                        cursor:pointer;
                    ">
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
                        cursor:pointer;
                    ">
                        Batal
                    </button>

                </div>
            </form>
        </div>
    </div>
    <script>
        function openEditModal(id, name, price, status) {
            document.getElementById('editModal').style.display = 'flex';

            document.getElementById('editName').value = name;

            document.getElementById('editPrice').value = price;

            document.getElementById('editStatus').value = status;

            document.getElementById('editForm').action =
                '/admin/menu/' + id + '/update';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>

</html>