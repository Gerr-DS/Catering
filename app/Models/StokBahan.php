<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokBahan extends Model
{
    protected $table = 'stok_bahans';
    protected $primaryKey = 'id_stok';

    protected $fillable = [
        'id_admin',
        'nama_bahan',
        'jumlah_stok',
        'satuan',
    ];

    /**
     * UML Class Diagram method: UpdateStok
     */
    public function UpdateStok(array $attributes)
    {
        return $this->update($attributes);
    }

    /**
     * UML Class Diagram method: TambahStok
     */
    public static function TambahStok(array $attributes)
    {
        return self::create($attributes);
    }

    /**
     * UML Class Diagram method: HapusStok
     */
    public function HapusStok()
    {
        return $this->delete();
    }

    // UML Relation
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
