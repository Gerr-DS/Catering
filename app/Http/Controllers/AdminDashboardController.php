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
    public function reports()
    {
        // Mengambil semua data keuangan, diurutkan dari yang paling baru
        $reports = \App\Models\Financial::orderBy('created_at', 'desc')->get();
        
        return view('admin.reports', compact('reports'));
    }
}