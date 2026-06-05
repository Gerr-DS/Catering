<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminDashboardController; 
use App\Http\Controllers\AdminStockController;
use App\Http\Controllers\AdminMenuController;
use App\Models\Menu;
use App\Http\Controllers\ReportExportController;

// 1. Halaman Utama Pembeli (Tanpa Login)
Route::get('/dashboard', function () {
    $menus = Menu::latest()->get();

    return view('dashboard', compact('menus'));
})->name('dashboard');

Route::get('/menu', function () {
    $menus = Menu::latest()->get();

    return view('menu', compact('menus'));
})->name('menu.pembeli');

Route::get('/menu/{menu}', function (Menu $menu) {
    return view('menu-detail', compact('menu'));
})->name('menu.detail');

Route::redirect('/', '/dashboard');

// 2. Rute Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');

// 3. Rute Logout
Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/dashboard');
});

// 4. Rute Register (Berikan tanda // di depannya jika sudah selesai membuat akun Admin)
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Rute Persetujuan Admin Baru via Email
Route::get('/admin/approve/{token}', [RegisteredUserController::class, 'approve'])->name('admin.approve');
Route::get('/admin/reject/{token}', [RegisteredUserController::class, 'reject'])->name('admin.reject');

// 5. Rute Dashboard Admin & Keuangan (Wajib Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/financial/store', [AdminDashboardController::class, 'store'])->name('admin.financial.store');
    Route::put('/admin/financial/{id}/update', [AdminDashboardController::class, 'updateFinancial'])->name('admin.financial.update');
    Route::delete('/admin/financial/{id}/delete', [AdminDashboardController::class, 'destroyFinancial'])->name('admin.financial.delete');
});

// 6. Rute Stock Management (Wajib Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/stock', [AdminStockController::class, 'index'])->name('admin.stock.index');
    Route::post('/admin/stock/store', [AdminStockController::class, 'store'])->name('admin.stock.store');
    Route::put('/admin/stock/{id}/update', [AdminStockController::class, 'update'])->name('admin.stock.update');
    Route::delete('/admin/stock/{id}/delete', [AdminStockController::class, 'destroy'])->name('admin.stock.delete');
});

// 7. Rute Menu Management (Wajib Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/menu', [AdminMenuController::class, 'index'])->name('admin.menu.index');
    Route::post('/admin/menu/store', [AdminMenuController::class, 'store'])->name('admin.menu.store');
    Route::put('/admin/menu/{id}/update', [AdminMenuController::class, 'update'])->name('admin.menu.update');
    Route::delete('/admin/menu/{id}/delete', [AdminMenuController::class, 'destroy'])->name('admin.menu.delete');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/reports/pdf', [ReportExportController::class, 'exportPdf'])
        ->name('admin.reports.pdf');
    Route::get('/admin/reports', [App\Http\Controllers\AdminDashboardController::class, 'reports'])->name('admin.reports');
});

// Rute Diagnostik Email & Cache
Route::get('/clear-cache', function() {
    try {
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        return "Semua cache Laravel berhasil dibersihkan! Silakan coba kembali.";
    } catch (\Exception $e) {
        return "Gagal membersihkan cache. Error: " . $e->getMessage();
    }
});

Route::get('/test-email', function () {
    try {
        $mockNama = 'Admin Uji Coba';
        $mockEmail = 'test.admin' . rand(10, 99) . '@hafidzcatering.com';
        $mockToken = \Illuminate\Support\Str::random(60);
        
        // Simpan data pending admin uji coba ke database agar token valid saat diklik
        \App\Models\PendingAdmin::updateOrCreate(
            ['username' => $mockEmail],
            [
                'nama' => $mockNama,
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                'token' => $mockToken
            ]
        );
        
        \Illuminate\Support\Facades\Mail::to('gerry.dimasarya2006@gmail.com')
            ->send(new \App\Mail\AdminApprovalRequest($mockNama, $mockEmail, $mockToken));
            
        return "Email uji coba persetujuan berhasil terkirim! Silakan cek kotak masuk atau folder spam di gerry.dimasarya2006@gmail.com. Sekarang, jika Anda menekan tombol Setuju/Tolak di email tersebut, ia akan berfungsi karena tokennya terdaftar di database.";
    } catch (\Exception $e) {
        return "Gagal mengirim email persetujuan uji coba. Eror lengkap: " . $e->getMessage();
    }
});

Route::get('/show-pending', function () {
    $pending = \App\Models\PendingAdmin::all();
    if ($pending->isEmpty()) {
        return "Tidak ada pendaftaran admin yang sedang menunggu persetujuan (tabel pending_admins kosong).";
    }
    
    $html = "<h1>Daftar Permintaan Persetujuan Admin Baru</h1>";
    $html .= "<table border='1' cellpadding='10' style='border-collapse: collapse; font-family: sans-serif;'>";
    $html .= "<thead><tr style='background-color: #f3f4f6;'><th>Nama</th><th>Email</th><th>Tanggal Pengajuan</th><th>Aksi Langsung</th></tr></thead>";
    $html .= "<tbody>";
    foreach ($pending as $p) {
        $approveUrl = url('/admin/approve/' . $p->token);
        $rejectUrl = url('/admin/reject/' . $p->token);
        $html .= "<tr>";
        $html .= "<td>{$p->nama}</td>";
        $html .= "<td>{$p->username}</td>";
        $html .= "<td>{$p->created_at}</td>";
        $html .= "<td>";
        $html .= "<a href='{$approveUrl}' style='color: green; font-weight: bold; margin-right: 15px; text-decoration: none;'>[ Setuju ]</a>";
        $html .= "<a href='{$rejectUrl}' style='color: red; font-weight: bold; text-decoration: none;'>[ Tolak ]</a>";
        $html .= "</td>";
        $html .= "</tr>";
    }
    $html .= "</tbody></table>";
    return $html;
});