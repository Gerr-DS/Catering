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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' 
        ]);

        $data = [
            'id_admin' => auth()->user()->id_admin ?? 1,
            'nama_menu' => $request->name,
            'deskripsi' => $request->description,
            'harga_menu' => $request->price,
            'status_menu' => $request->status,
            'stok_menu' => 50, // default stok menu sesuai kebutuhan diagram
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('menus', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        Menu::create($data);
        
        return back()->with('success', 'Menu dan gambar berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'status' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $menu = Menu::findOrFail($id);

        $data = [];
        if ($request->has('name')) $data['nama_menu'] = $request->name;
        if ($request->has('description')) $data['deskripsi'] = $request->description;
        if ($request->has('price')) $data['harga_menu'] = $request->price;
        if ($request->has('status')) $data['status_menu'] = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('menus', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        $menu->update($data);
        return back()->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy($id) {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return back()->with('success', 'Menu berhasil dihapus!');
    }
}