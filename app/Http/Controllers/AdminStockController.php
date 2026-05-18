<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class AdminStockController extends Controller
{
    public function index()
    {
        // Mengambil semua data stok dari database
        $stocks = Stock::latest()->get();
        return view('admin.stock', compact('stocks'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        // Simpan data ke database
        Stock::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
        ]);

        return back()->with('success', 'Bahan baku berhasil ditambahkan ke stok!');
    }
}
