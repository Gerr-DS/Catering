<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - HafidzManage</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            display: flex;
            color: #333;
        }

        /* Pengaturan Sidebar */
        .sidebar {
            width: 250px;
            background: white;
            height: 100vh;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            position: fixed;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #064e3b;
            margin-bottom: 40px;
        }

        .brand-icon {
            background: #064e3b;
            color: white;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #64748b;
            font-weight: 600;
            display: block;
            padding: 12px 15px;
            border-radius: 8px;
            transition: 0.2s;
        }

        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background: #ecfdf5;
            color: #059669;
        }

        .logout-btn {
            position: absolute;
            bottom: 20px;
            text-decoration: none;
            color: #ef4444;
            font-weight: bold;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Pengaturan Konten Utama */
        .main-content {
            margin-left: 290px;
            padding: 40px;
            flex: 1;
            width: calc(100% - 290px);
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
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="brand-logo">
            <div class="brand-icon">H</div>
            HafidzManage
        </div>
        <ul>
            <li><a href="/admin/dashboard">Dashboard</a></li>
            <li><a href="/admin/stock">Stock Management</a></li>
            <li><a href="/admin/menu">Menu Management</a></li>
            <li><a href="/admin/reports" class="active">Reports</a></li>
        </ul>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="logout-btn" style="background:none; border:none; cursor:pointer;">
                <span style="background:#ef4444; width:8px; height:16px; border-radius:4px; display:inline-block;"></span>
                Keluar (Logout)
            </button>
        </form>
    </div>

    <div class="main-content">
        <h2 class="page-title">Laporan Keuangan</h2>
        <div style="margin-bottom:20px; display:flex; gap:10px;">

            <a
                href="{{ route('admin.reports.pdf') }}"
                style="
            background:#dc2626;
            color:white;
            padding:10px 16px;
            border-radius:8px;
            text-decoration:none;
            font-weight:bold;
        ">
                📄 Unduh PDF
            </a>

            <a
                href="{{ route('admin.reports.excel') }}"
                style="
            background:#059669;
            color:white;
            padding:10px 16px;
            border-radius:8px;
            text-decoration:none;
            font-weight:bold;
        ">
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
        ">
                🖨️ Cetak
            </button>

        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Waktu Pencatatan</th>
                        <th>Keterangan</th>
                        <th>Tipe</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr>
                        <td>{{ $report->created_at->format('d M Y, H:i') }} WIB</td>

                        <td>{{ $report->description ?? 'Tidak ada keterangan' }}</td>

                        <td>
                            @if(strtolower($report->type) == 'pemasukan' || strtolower($report->type) == 'pemasukkan')
                            <span class="badge-income">Pemasukan</span>
                            @else
                            <span class="badge-expense">Pengeluaran</span>
                            @endif
                        </td>

                        <td>
                            @if(strtolower($report->type) == 'pemasukan' || strtolower($report->type) == 'pemasukkan')
                            <span class="text-green">+ Rp. {{ number_format($report->amount, 0, ',', '.') }}</span>
                            @else
                            <span class="text-red">- Rp. {{ number_format($report->amount, 0, ',', '.') }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 30px; color: #94a3b8;">
                            Belum ada riwayat pencatatan keuangan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>