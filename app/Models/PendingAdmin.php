<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendingAdmin extends Model
{
    use HasFactory;

    protected $table = 'pending_admins';
    protected $primaryKey = 'id_pending';

    protected $fillable = [
        'nama',
        'username',
        'password',
        'token',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            // Removed automatic hashing cast to prevent double hashing
        ];
    }
}
