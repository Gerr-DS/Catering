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
<table>
    <thead>
        <tr>
            <th colspan="4" style="font-weight: bold; font-size: 14pt; text-align: center;">Laporan Keuangan Hafidz Catering</th>
        </tr>
        <tr>
            <th colspan="4" style="text-align: center;"></th>
        </tr>
        <tr>
            <th style="font-weight: bold;">Periode:</th>
            <th colspan="3">{{ $periodeText }}</th>
        </tr>
        <tr>
            <th style="font-weight: bold;">Jenis Transaksi:</th>
            <th colspan="3">{{ $typeText }}</th>
        </tr>
        <tr>
            <th style="font-weight: bold;">Total Pemasukan:</th>
            <th colspan="3" style="text-align: left; color: #16a34a; font-weight: bold;">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</th>
        </tr>
        <tr>
            <th style="font-weight: bold;">Total Pengeluaran:</th>
            <th colspan="3" style="text-align: left; color: #dc2626; font-weight: bold;">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</th>
        </tr>
        <tr>
            <th style="font-weight: bold;">Laba Bersih:</th>
            <th colspan="3" style="text-align: left; font-weight: bold;">Rp {{ number_format($labaBersih, 0, ',', '.') }}</th>
        </tr>
        <tr>
            <th colspan="4"></th>
        </tr>
        <tr style="background-color: #f3f4f6;">
            <th style="font-weight: bold; border: 1px solid #000000; background: #e5e7eb;">Tanggal</th>
            <th style="font-weight: bold; border: 1px solid #000000; background: #e5e7eb;">Tipe</th>
            <th style="font-weight: bold; border: 1px solid #000000; background: #e5e7eb;">Keterangan</th>
            <th style="font-weight: bold; border: 1px solid #000000; background: #e5e7eb;">Nominal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $report)
        <tr>
            <td style="border: 1px solid #cbd5e1;">{{ $report->created_at->format('d M Y, H:i') }} WIB</td>
            <td style="border: 1px solid #cbd5e1;">{{ strtolower($report->type) == 'pemasukan' || strtolower($report->type) == 'pemasukkan' ? 'Pemasukan' : 'Pengeluaran' }}</td>
            <td style="border: 1px solid #cbd5e1;">{{ $report->description ?? 'Tidak ada keterangan' }}</td>
            <td style="border: 1px solid #cbd5e1; text-align: right; font-weight: 600; color: {{ strtolower($report->type) == 'pemasukan' || strtolower($report->type) == 'pemasukkan' ? '#16a34a' : '#dc2626' }};">
                {{ strtolower($report->type) == 'pemasukan' || strtolower($report->type) == 'pemasukkan' ? '+' : '-' }} Rp {{ number_format($report->amount, 0, ',', '.') }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
