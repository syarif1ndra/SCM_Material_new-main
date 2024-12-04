<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProyek extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     */
    protected $table = 'detail_proyek';

    /**
     * Kolom yang dapat diisi secara massal (mass assignment).
     */
    protected $fillable = [
        'material_id',
        'proyek_id',
        'jumlah_digunakan',
        'tanggal_digunakan',
        'keterangan',
        'biaya_penggunaan',
    ];

    /**
     * Relasi ke model Material (Many-to-One).
     */
    public function materialproyek()
    {
        return $this->belongsTo(MaterialProyek::class);
    }

    /**
     * Relasi ke model Proyek (Many-to-One).
     */
    public function proyek()
    {
        return $this->belongsTo(Proyek::class);
    }
}
