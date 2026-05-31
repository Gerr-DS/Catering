<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporans';
    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'id_admin',
        'periode',
    ];

    /**
     * UML Class Diagram method: BuatLaporan
     */
    public static function BuatLaporan(array $attributes)
    {
        return self::create($attributes);
    }

    /**
     * UML Class Diagram method: CetakLaporan
     */
    public function CetakLaporan()
    {
        // Fitur cetak laporan ke printer / PDF view
    }

    /**
     * UML Class Diagram method: UnduhLaporan
     */
    public function UnduhLaporan()
    {
        // Fitur download PDF / Excel laporan
    }

    // UML Relations
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    public function transaksiKeuangans()
    {
        return $this->hasMany(TransaksiKeuangan::class, 'id_laporan', 'id_laporan');
    }
}
