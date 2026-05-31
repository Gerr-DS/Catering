<?php

namespace App\Exports;

use App\Models\TransaksiKeuangan;
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
        $query = TransaksiKeuangan::query();

        if ($this->request) {
            // 1. Filter Tanggal
            if ($this->request->filled('start_date')) {
                $query->whereDate('tanggal', '>=', $this->request->start_date);
            }
            if ($this->request->filled('end_date')) {
                $query->whereDate('tanggal', '<=', $this->request->end_date);
            }

            // 2. Filter Jenis Transaksi
            if ($this->request->filled('type') && $this->request->type !== 'all') {
                $jenis = in_array(strtolower($this->request->type), ['pemasukan', 'pemasukkan']) ? 1 : 2;
                $query->where('jenis_transaksi', $jenis);
            }

            // 3. Pencarian Keterangan
            if ($this->request->filled('search')) {
                $query->where('deskripsi', 'like', '%' . $this->request->search . '%');
            }
        }

        $reports = $query->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->get();

        // Calculate summaries dynamically
        $totalPemasukan = $reports->filter(fn($r) => $r->jenis_transaksi == 1)->sum('nominal');
        $totalPengeluaran = $reports->filter(fn($r) => $r->jenis_transaksi == 2)->sum('nominal');
        $labaBersih = $totalPemasukan - $totalPengeluaran;

        return view('admin.reports-excel', compact('reports', 'totalPemasukan', 'totalPengeluaran', 'labaBersih'));
    }
}