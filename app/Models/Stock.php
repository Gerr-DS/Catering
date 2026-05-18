<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable; // Tambahkan ini jika pakai Laravel terbaru

#[Fillable(['name', 'quantity', 'unit'])] // DAFTARKAN KOLOM DI SINI
class Stock extends Model
{
    // Jika kode Anda tidak menggunakan tanda # di atas, gunakan cara manual di bawah ini:
    // protected $fillable = ['name', 'quantity', 'unit'];
}