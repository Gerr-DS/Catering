<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
});

// // Rute untuk halaman utama atau login default (sesuaikan dengan aplikasi Anda)
// Route::get('/', function () {
//     return view('welcome');
// });

// // Rute Dashboard yang HANYA bisa diakses oleh admin yang sudah login
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');