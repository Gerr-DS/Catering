<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKeuangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FinancialExport;
use Illuminate\Http\Request;

class ReportExportController extends Controller
{
    public function exportPdf(Request $request)
    {
        $query = TransaksiKeuangan::query();

        // 1. Filter Tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        // 2. Filter Jenis Transaksi
        if ($request->filled('type') && $request->type !== 'all') {
            $jenis = in_array(strtolower($request->type), ['pemasukan', 'pemasukkan']) ? 1 : 2;
            $query->where('jenis_transaksi', $jenis);
        }

        // 3. Pencarian Keterangan
        if ($request->filled('search')) {
            $query->where('deskripsi', 'like', '%' . $request->search . '%');
        }

        $reports = $query->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->get();

        // Calculate summaries dynamically
        $totalPemasukan = $reports->filter(fn($r) => $r->jenis_transaksi == 1)->sum('nominal');
        $totalPengeluaran = $reports->filter(fn($r) => $r->jenis_transaksi == 2)->sum('nominal');
        $labaBersih = $totalPemasukan - $totalPengeluaran;

        $pdf = Pdf::loadView('admin.reports-pdf', compact('reports', 'totalPemasukan', 'totalPengeluaran', 'labaBersih'));

        return $pdf->download('laporan-keuangan.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new FinancialExport($request),
            'laporan-keuangan.xlsx'
        );
    }
}