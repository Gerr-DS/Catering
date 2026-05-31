<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'id_admin',
        'nama_menu',
        'harga_menu',
        'status_menu',
        'deskripsi',
        'stok_menu',
        'gambar',
    ];

    /**
     * Backward compatibility helper for 'status' attribute
     */
    public function getStatusAttribute()
    {
        return $this->status_menu == '1';
    }

    /**
     * UML Class Diagram method: tambahMenu
     */
    public static function tambahMenu(array $attributes)
    {
        return self::create($attributes);
    }

    /**
     * UML Class Diagram method: UpdateMenu
     */
    public function UpdateMenu(array $attributes)
    {
        return $this->update($attributes);
    }

    /**
     * UML Class Diagram method: hapusMenu
     */
    public function hapusMenu()
    {
        return $this->delete();
    }

    /**
     * UML Class Diagram method: NonaktifkanMenu
     */
    public function NonaktifkanMenu()
    {
        return $this->update(['status_menu' => '0']);
    }

    // UML Relation
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}