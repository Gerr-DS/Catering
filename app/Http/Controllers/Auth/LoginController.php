<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi input (username harus email asli)
        $credentials = $request->validate([
            'username' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'username.email' => 'Format email tidak valid. Harap gunakan email asli.',
        ]);

        // 2. Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        // 3. Jika gagal, balikkan ke halaman login dengan pesan error
        return back()->withErrors([
            'username' => 'Email atau password salah.',
        ])->onlyInput('username');
    }
}
