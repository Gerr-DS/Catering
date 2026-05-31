<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKeuangan;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
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

    public function updateFinancial(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:pemasukan,pemasukkan,pengeluaran',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'date' => 'nullable|date'
        ]);

        $jenis = in_array(strtolower($request->type), ['pemasukan', 'pemasukkan']) ? 1 : 2;
        $transaction = TransaksiKeuangan::findOrFail($id);

        $transaction->update([
            'jenis_transaksi' => $jenis,
            'nominal' => $request->amount,
            'deskripsi' => $request->description,
            'tanggal' => $request->filled('date') ? $request->date : $transaction->tanggal,
        ]);

        return back()->with('success', 'Transaksi keuangan berhasil diperbarui!');
    }

    public function destroyFinancial($id)
    {
        $transaction = TransaksiKeuangan::findOrFail($id);
        $transaction->delete();

        return back()->with('success', 'Transaksi keuangan berhasil dihapus!');
    }

    public function reports(Request $request)
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

        // Dapatkan data terpaginasi (15 per halaman)
        $reports = $query->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.reports', compact('reports'));
    }
}