<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     */
    protected $table = 'proyek';

    /**
     * Kolom yang dapat diisi secara massal (mass assignment).
     */
    protected $fillable = [
        'nama_proyek',
        'status',
        'lokasi',
    ];

    /**
     * Mendefinisikan atribut enum untuk status proyek.
     */
    public const STATUS = [
        'AKTIF' => 'aktif',
        'SELESAI' => 'selesai',
        'TERTUNDA' => 'tertunda',
    ];

    public function materialproyek(){
        return $this->belongsTo(MaterialProyek::class);
    }
}
