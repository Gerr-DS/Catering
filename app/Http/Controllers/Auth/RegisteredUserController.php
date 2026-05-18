<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'], 
        ]);

        // 2. Simpan ke database MySQL
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // Otomatis jadi admin
        ]);

        // 3. Langsung login otomatis setelah daftar
        Auth::login($user);

        // 4. Lempar ke Dashboard Admin
        return redirect()->intended('/admin/dashboard');
    }
}