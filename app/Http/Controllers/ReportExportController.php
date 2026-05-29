<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FinancialExport;
use Illuminate\Http\Request;

class ReportExportController extends Controller
{
    public function exportPdf(Request $request)
    {
        $query = Financial::query();

        // 1. Filter Tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // 2. Filter Jenis Transaksi
        if ($request->filled('type') && $request->type !== 'all') {
            if ($request->type === 'pemasukan') {
                $query->whereIn('type', ['pemasukan', 'pemasukkan']);
            } else {
                $query->where('type', $request->type);
            }
        }

        // 3. Pencarian Keterangan
        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        $reports = $query->orderBy('created_at', 'desc')->get();

        // Calculate summaries dynamically
        $totalPemasukan = $reports->filter(fn($r) => in_array(strtolower($r->type), ['pemasukan', 'pemasukkan']))->sum('amount');
        $totalPengeluaran = $reports->filter(fn($r) => strtolower($r->type) === 'pengeluaran')->sum('amount');
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