<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiKeuangan extends Model
{
    protected $table = 'transaksi_keuangans';
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_admin',
        'id_laporan',
        'jenis_transaksi', // 1 = Pemasukan, 2 = Pengeluaran
        'tanggal',
        'nominal',
        'deskripsi',
    ];

    /**
     * Backward compatibility helper for 'type' attribute
     */
    public function getTypeAttribute()
    {
        return $this->jenis_transaksi == 1 ? 'pemasukkan' : 'pengeluaran';
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['jenis_transaksi'] = in_array(strtolower($value), ['pemasukan', 'pemasukkan']) ? 1 : 2;
    }

    /**
     * Backward compatibility helper for 'amount' attribute
     */
    public function getAmountAttribute()
    {
        return $this->nominal;
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['nominal'] = $value;
    }

    /**
     * Backward compatibility helper for 'description' / 'Deskripsi' attribute
     */
    public function getDescriptionAttribute()
    {
        return $this->deskripsi;
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['deskripsi'] = $value;
    }

    /**
     * UML Class Diagram method: TambahTransaksi
     */
    public static function TambahTransaksi(array $attributes)
    {
        return self::create($attributes);
    }

    /**
     * UML Class Diagram method: UbahTransaksi
     */
    public function UbahTransaksi(array $attributes)
    {
        return $this->update($attributes);
    }

    // UML Relations
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan', 'id_laporan');
    }
}
