@php
    $startDate = request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->translatedFormat('d F Y') : null;
    $endDate = request('end_date') ? \Carbon\Carbon::parse(request('end_date'))->translatedFormat('d F Y') : null;
    
    $periodeText = 'Semua Periode';
    if ($startDate && $endDate) {
        $periodeText = $startDate . ' - ' . $endDate;
    } elseif ($startDate) {
        $periodeText = 'Mulai ' . $startDate;
    } elseif ($endDate) {
        $periodeText = 'Sampai ' . $endDate;
    }

    $typeText = 'Semua Transaksi';
    if (request('type') === 'pemasukan') {
        $typeText = 'Pemasukan';
    } elseif (request('type') === 'pengeluaran') {
        $typeText = 'Pengeluaran';
    }
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: sans-serif;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 18pt;
            color: #111827;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .data-table, .data-table th, .data-table td {
            border: 1px solid #000;
        }

        .data-table th, .data-table td {
            padding: 8px 10px;
            text-align: left;
            font-size: 9pt;
        }

        .data-table th {
            background: #e5e7eb;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .font-semibold {
            font-weight: 600;
        }
    </style>
</head>
<body>

    <h1>Laporan Keuangan Hafidz Catering</h1>

    <!-- Summary Section -->
    <div style="margin-bottom: 25px; border: 1px solid #000; padding: 15px; background: #f9fafb; font-size: 9.5pt;">
        <table style="width: 100%; border: none; border-collapse: collapse;">
            <tr style="border: none;">
                <td style="width: 120px; font-weight: bold; border: none; padding: 4px 0;">Periode:</td>
                <td style="border: none; padding: 4px 0;">{{ $periodeText }}</td>
                <td style="width: 140px; font-weight: bold; border: none; padding: 4px 0;">Total Pemasukan:</td>
                <td style="border: none; padding: 4px 0; color: #16a34a; font-weight: bold;">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
            <tr style="border: none;">
                <td style="font-weight: bold; border: none; padding: 4px 0;">Jenis Transaksi:</td>
                <td style="border: none; padding: 4px 0;">{{ $typeText }}</td>
                <td style="font-weight: bold; border: none; padding: 4px 0;">Total Pengeluaran:</td>
                <td style="border: none; padding: 4px 0; color: #dc2626; font-weight: bold;">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none; padding: 4px 0;"></td>
                <td style="border: none; padding: 4px 0;"></td>
                <td style="font-weight: bold; border: none; padding: 4px 0;">Laba Bersih:</td>
                <td style="border: none; padding: 4px 0; font-weight: bold; color: {{ $labaBersih >= 0 ? '#16a34a' : '#dc2626' }};">Rp {{ number_format($labaBersih, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <!-- Data Table -->
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 20%;">Tanggal</th>
                <th style="width: 15%;">Tipe</th>
                <th style="width: 45%;">Keterangan</th>
                <th style="width: 20%; text-align: right;">Nominal</th>
            </tr>
        </thead>

        <tbody>
            @foreach($reports as $report)
            <tr>
                <td>
                    {{ $report->created_at->format('d M Y, H:i') }} WIB
                </td>

                <td class="font-semibold">
                    {{ strtolower($report->type) == 'pemasukan' || strtolower($report->type) == 'pemasukkan' ? 'Pemasukan' : 'Pengeluaran' }}
                </td>

                <td>
                    {{ $report->description ?? 'Tidak ada keterangan' }}
                </td>

                <td class="text-right font-semibold" style="color: {{ strtolower($report->type) == 'pemasukan' || strtolower($report->type) == 'pemasukkan' ? '#16a34a' : '#dc2626' }};">
                    {{ strtolower($report->type) == 'pemasukan' || strtolower($report->type) == 'pemasukkan' ? '+' : '-' }} Rp {{ number_format($report->amount, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>