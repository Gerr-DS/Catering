<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman form register
     */
    public function create()
    {
        return view('auth.register'); 
    }

    /**
     * Memproses data saat tombol register ditekan
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:admins'],
            'password' => ['required', 'confirmed'], 
        ]);

        // 2. Simpan ke database MySQL
        $admin = Admin::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // 3. Langsung login otomatis setelah daftar
        Auth::login($admin);

        // 4. Lempar ke Dashboard Admin
        return redirect()->intended('/admin/dashboard');
    }
}