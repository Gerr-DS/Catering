<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransaksiKeuangan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPemasukkan = TransaksiKeuangan::where('jenis_transaksi', 1)->sum('nominal');
        $totalPengeluaran = TransaksiKeuangan::where('jenis_transaksi', 2)->sum('nominal');
        $income = $totalPemasukkan - $totalPengeluaran;

        return view('admin.dashboard', compact('totalPemasukkan', 'totalPengeluaran', 'income'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pemasukan,pemasukkan,pengeluaran',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string'
        ]);

        $jenis = in_array(strtolower($request->type), ['pemasukan', 'pemasukkan']) ? 1 : 2;

        TransaksiKeuangan::create([
            'id_admin' => auth()->user()->id_admin ?? 1,
            'jenis_transaksi' => $jenis,
            'tanggal' => date('Y-m-d'),
            'nominal' => $request->amount,
            'deskripsi' => $request->description,
        ]);

        return back()->with('success', 'Data ' . $request->type . ' berhasil ditambahkan!');
    }
}