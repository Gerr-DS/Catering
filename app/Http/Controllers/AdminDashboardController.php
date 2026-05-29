<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use Illuminate\Http\Request;

// Nama class di bawah ini HARUS SAMA PERSIS dengan nama file
class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalPemasukkan = Financial::where('type', 'pemasukkan')->sum('amount');
        $totalPengeluaran = Financial::where('type', 'pengeluaran')->sum('amount');
        $income = $totalPemasukkan - $totalPengeluaran;

        return view('admin.dashboard', compact('totalPemasukkan', 'totalPengeluaran', 'income'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pemasukkan,pengeluaran',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string'
        ]);

        Financial::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Data ' . $request->type . ' berhasil ditambahkan!');
    }
    public function reports(Request $request)
    {
        $query = \App\Models\Financial::query();

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

        // Dapatkan data terpaginasi (15 per halaman)
        $reports = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.reports', compact('reports'));
    }
}