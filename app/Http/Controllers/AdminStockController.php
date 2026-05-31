<?php

namespace App\Http\Controllers;

use App\Models\StokBahan;
use Illuminate\Http\Request;

class AdminStockController extends Controller
{
    public function index()
    {
        // Mengambil semua data stok dari database menggunakan model StokBahan
        $stocks = StokBahan::latest()->get();
        return view('admin.stock', compact('stocks'));
    }

    public function store(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        // Simpan data ke database sesuai kolom Class Diagram
        StokBahan::create([
            'id_admin' => auth()->user()->id_admin ?? 1,
            'nama_bahan' => $request->name,
            'jumlah_stok' => $request->quantity,
            'satuan' => $request->unit,
        ]);

        return back()->with('success', 'Bahan baku berhasil ditambahkan ke stok!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        $stock = StokBahan::findOrFail($id);
        $stock->update([
            'nama_bahan' => $request->name,
            'jumlah_stok' => $request->quantity,
            'satuan' => $request->unit,
        ]);

        return back()->with('success', 'Stok berhasil diperbarui!');
    }
}
