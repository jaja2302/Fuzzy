<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wilayah extends Model
{
    protected $fillable = [
        'nama_wilayah',
        'kode_wilayah',
        'deskripsi',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa',
        'jumlah_penduduk',
        'luas_wilayah',
        'satuan_luas',
        'status_aktif'
    ];

    protected $casts = [
        'jumlah_penduduk' => 'integer',
        'luas_wilayah' => 'decimal:2',
        'status_aktif' => 'boolean'
    ];

    public function stuntings(): HasMany
    {
        return $this->hasMany(Stunting::class);
    }
}
