<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     */
    protected $table = 'pengiriman';

    /**
     * Kolom yang dapat diisi secara massal (mass assignment).
     */
    protected $fillable = [
        'material_id',
        'tanggal_kirim',
        'tanggal_selesai',
        'status_pengiriman',
        'order_id',
    ];

    /**
     * Relasi ke model Material (Many-to-One).
     */
    public function materialpemasok()
    {
        return $this->belongsTo(MaterialPemasok::class, 'material_id');
    }

    /**
     * Relasi ke model OrderMaterial (Many-to-One).
     */
    public function order()
    {
        return $this->belongsTo(OrderMaterial::class, 'order_id');
    }
}
