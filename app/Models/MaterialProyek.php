<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialProyek extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi penamaan otomatis
    protected $table = 'material_proyek';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'nama_material',
        'stok',
        'harga_total',
        'jenis_material',
        'pengiriman_id',
    ];

    /**
     * Relasi ke model Pengiriman
     */
    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class, 'pengiriman_id');
    }

    /**
     * Relasi ke model Pemasok
     */

}
