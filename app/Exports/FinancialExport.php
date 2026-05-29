<?php

namespace App\Exports;

use App\Models\Financial;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FinancialExport implements FromView, ShouldAutoSize
{
    protected $request;

    public function __construct($request = null)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Financial::query();

        if ($this->request) {
            // 1. Filter Tanggal
            if ($this->request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $this->request->start_date);
            }
            if ($this->request->filled('end_date')) {
                $query->whereDate('created_at', '<=', $this->request->end_date);
            }

            // 2. Filter Jenis Transaksi
            if ($this->request->filled('type') && $this->request->type !== 'all') {
                if ($this->request->type === 'pemasukan') {
                    $query->whereIn('type', ['pemasukan', 'pemasukkan']);
                } else {
                    $query->where('type', $this->request->type);
                }
            }

            // 3. Pencarian Keterangan
            if ($this->request->filled('search')) {
                $query->where('description', 'like', '%' . $this->request->search . '%');
            }
        }

        $reports = $query->orderBy('created_at', 'desc')->get();

        // Calculate summaries dynamically
        $totalPemasukan = $reports->filter(fn($r) => in_array(strtolower($r->type), ['pemasukan', 'pemasukkan']))->sum('amount');
        $totalPengeluaran = $reports->filter(fn($r) => strtolower($r->type) === 'pengeluaran')->sum('amount');
        $labaBersih = $totalPemasukan - $totalPengeluaran;

        return view('admin.reports-excel', compact('reports', 'totalPemasukan', 'totalPengeluaran', 'labaBersih'));
    }
}