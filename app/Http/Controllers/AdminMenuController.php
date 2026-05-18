<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function index() {
        $menus = Menu::latest()->get();
        return view('admin.menu', compact('menus'));
    }

    public function store(Request $request) {
        // 1. Validasi input (Disesuaikan 'status' agar cocok dengan tampilan form Anda)
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required', // Mengubah 'is_ready' menjadi 'status' sesuai UI Anda
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' 
        ]);

        // 2. Ambil semua data teks dari form
        $data = $request->only(['name', 'price', 'status']);

        // 3. Cek apakah ada file gambar yang diupload 
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Buat nama file unik agar tidak bentrok 
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Simpan gambar ke folder storage/app/public/menus/ 
            $image->storeAs('public/menus', $imageName);
            
            // Masukkan nama file ini ke array data 
            $data['image'] = $imageName;
        }

        // 4. Simpan ke database 
        Menu::create($data);
        
        return back()->with('success', 'Menu dan gambar berhasil ditambahkan!');
    }

    // BONUS: Memperbaiki fungsi update agar kedepannya fitur "Ubah Status" atau edit gambar berjalan lancar
    public function update(Request $request, Menu $menu) {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'status' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['name', 'price', 'status']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/menus', $imageName);
            $data['image'] = $imageName;
        }

        $menu->update($data);
        return back()->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu) {
        $menu->delete();
        return back()->with('success', 'Menu berhasil dihapus!');
    }
}