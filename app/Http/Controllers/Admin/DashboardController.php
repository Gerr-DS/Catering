<?php

namespace App\Http\Controllers\Admin; // HURUF A BESAR PADA 'Admin'

use App\Http\Controllers\Controller;
use App\Models\Financial;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
}