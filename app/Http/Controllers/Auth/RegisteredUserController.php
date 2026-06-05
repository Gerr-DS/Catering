<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\PendingAdmin;
use App\Mail\AdminApprovalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        // 1. Validasi (username harus email asli)
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'confirmed'], 
        ], [
            'username.email' => 'Format email tidak valid. Harap gunakan email asli.',
            'username.unique' => 'Email ini sudah terdaftar sebagai Admin.',
        ]);

        $email = $request->username;

        // Akun Utama langsung dibuat di database tanpa approval
        if ($email === 'gerry.dimasarya2006@gmail.com') {
            $admin = Admin::create([
                'nama' => $request->nama,
                'username' => $email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($admin);
            return redirect()->intended('/admin/dashboard');
        }

        // Cek apakah email sudah ada di request pending
        if (PendingAdmin::where('username', $email)->exists()) {
            return back()->withErrors([
                'username' => 'Permintaan persetujuan untuk email ini sudah dikirim sebelumnya dan sedang menunggu persetujuan.',
            ])->withInput();
        }

        // Simpan sementara ke pending_admins
        $token = Str::random(60);
        $pending = PendingAdmin::create([
            'nama' => $request->nama,
            'username' => $email,
            'password' => Hash::make($request->password),
            'token' => $token,
        ]);

        // Kirim email persetujuan ke Admin Utama
        try {
            Mail::to('gerry.dimasarya2006@gmail.com')->send(new AdminApprovalRequest($pending->nama, $pending->username, $token));
        } catch (\Exception $e) {
            // Hapus request jika gagal mengirim email (agar tidak gantung)
            $pending->delete();
            return back()->withErrors([
                'username' => 'Gagal mengirim email persetujuan. Pastikan konfigurasi mailer aktif. Error: ' . $e->getMessage(),
            ])->withInput();
        }

        return redirect()->route('register')->with('status', 'Pendaftaran Berhasil! Permintaan persetujuan telah dikirim ke Administrator utama via email. Akun Anda belum tersimpan di database dan baru dapat digunakan setelah disetujui.');
    }

    /**
     * Menyetujui pendaftaran admin baru
     */
    public function approve($token)
    {
        $pending = PendingAdmin::where('token', $token)->first();

        if (!$pending) {
            return view('auth.approval_result', [
                'status' => 'rejected',
                'message' => 'Permintaan persetujuan tidak ditemukan atau sudah kedaluwarsa/disetujui.'
            ]);
        }

        // Cek apakah email sudah terdaftar di admins (safety check)
        if (Admin::where('username', $pending->username)->exists()) {
            $pending->delete();
            return view('auth.approval_result', [
                'status' => 'rejected',
                'message' => 'Akun ini sudah terdaftar sebagai Admin sebelumnya.'
            ]);
        }

        // Simpan ke database utama
        Admin::create([
            'nama' => $pending->nama,
            'username' => $pending->username,
            'password' => $pending->password, // Sudah berupa hash dari database pending
        ]);

        // Hapus dari pending_admins
        $pending->delete();

        return view('auth.approval_result', [
            'status' => 'approved',
            'message' => "Akun dengan email {$pending->username} telah berhasil disetujui dan kini tersimpan di database utama serta dapat digunakan untuk masuk ke portal."
        ]);
    }

    /**
     * Menolak pendaftaran admin baru
     */
    public function reject($token)
    {
        $pending = PendingAdmin::where('token', $token)->first();

        if (!$pending) {
            return view('auth.approval_result', [
                'status' => 'rejected',
                'message' => 'Permintaan persetujuan tidak ditemukan atau sudah kedaluwarsa/ditolak.'
            ]);
        }

        $pendingEmail = $pending->username;
        $pending->delete();

        return view('auth.approval_result', [
            'status' => 'rejected',
            'message' => "Pendaftaran akun dengan email {$pendingEmail} telah berhasil ditolak dan dihapus dari daftar permintaan."
        ]);
    }
}