<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMaterial extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     */
    protected $table = 'order_material';

    /**
     * Kolom yang dapat diisi secara massal (mass assignment).
     */
    protected $fillable = [
        'jumlah_order',
        'tanggal_order',
        'harga_total',
        'keterangan',
        'material_pemasok_id',
        'pengiriman_id',
        'proyek_id',
    ];

    /**
     * Relasi ke model MaterialPemasok (Many-to-One).
     */
    public function materialpemasok()
    {
        return $this->belongsTo(MaterialPemasok::class, 'material_pemasok_id');
    }

    /**
     * Relasi ke model Pengiriman (Many-to-One).
     */
    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class, 'pengiriman_id');
    }

    /**
     * Relasi ke model Proyek (Many-to-One).
     */
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }
}
