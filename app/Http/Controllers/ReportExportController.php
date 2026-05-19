<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FinancialExport;

class ReportExportController extends Controller
{
    public function exportPdf()
    {
        $reports = Financial::latest()->get();

        $pdf = Pdf::loadView('admin.reports-pdf', compact('reports'));

        return $pdf->download('laporan-keuangan.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(
            new FinancialExport,
            'laporan-keuangan.xlsx'
        );
    }
}