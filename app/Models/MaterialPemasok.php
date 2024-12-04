<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialPemasok extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     */
    protected $table = 'material_pemasok';

    /**
     * Kolom yang dapat diisi secara massal (mass assignment).
     */
    protected $fillable = [
        'nama_material',
        'stok',
        'harga_total',
        'jenis_material',
        'pemasok_id',
    ];

    /**
     * Relasi ke model Pemasok (Many-to-One).
     */
    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'pemasok_id');
    }
}
