<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wilayah extends Model
{
    protected $primaryKey = 'ID_Wilayah';
    
    protected $fillable = [
        'Provinsi',
        'Kabupaten',
        'nama_wilayah',
        'status_aktif'
    ];

    protected $casts = [
        'status_aktif' => 'boolean'
    ];

    public function stuntings(): HasMany
    {
        return $this->hasMany(Stunting::class, 'id_wilayah', 'ID_Wilayah');
    }

    /**
     * Get the full wilayah name (Provinsi - Kabupaten)
     */
    public function getNamaWilayahAttribute($value)
    {
        if ($value) {
            return $value;
        }
        return $this->Provinsi . ' - ' . $this->Kabupaten;
    }
}
