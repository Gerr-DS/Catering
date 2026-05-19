<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background: #f3f3f3;
        }
    </style>
</head>
<body>

    <h1>Laporan Keuangan Hafidz Catering</h1>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Tipe</th>
                <th>Keterangan</th>
                <th>Nominal</th>
            </tr>
        </thead>

        <tbody>
            @foreach($reports as $report)
            <tr>
                <td>
                    {{ $report->created_at->format('d M Y') }}
                </td>

                <td>
                    {{ $report->type }}
                </td>

                <td>
                    {{ $report->description }}
                </td>

                <td>
                    Rp {{ number_format($report->amount, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>