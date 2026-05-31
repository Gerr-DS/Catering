<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admins';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'nama',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * UML Class Diagram method: login
     */
    public function login()
    {
        // Autentikasi ditangani oleh Laravel Auth Guard
    }

    /**
     * UML Class Diagram method: logout
     */
    public function logout()
    {
        // Autentikasi ditangani oleh Laravel Auth Guard
    }

    // UML Relations
    public function stokBahans()
    {
        return $this->hasMany(StokBahan::class, 'id_admin', 'id_admin');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'id_admin', 'id_admin');
    }

    public function transaksiKeuangans()
    {
        return $this->hasMany(TransaksiKeuangan::class, 'id_admin', 'id_admin');
    }

    public function laporans()
    {
        return $this->hasMany(Laporan::class, 'id_admin', 'id_admin');
    }
}
