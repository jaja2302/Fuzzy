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
        if ($value && !empty($value)) {
            return $value;
        }
        return $this->Provinsi . ' - ' . $this->Kabupaten;
    }

    /**
     * Get the display name for forms and lists
     */
    public function getDisplayNameAttribute()
    {
        if ($this->nama_wilayah && !empty($this->nama_wilayah)) {
            return $this->nama_wilayah;
        }
        return $this->Provinsi . ' - ' . $this->Kabupaten;
    }

    /**
     * Get the ID for forms (compatibility with Laravel conventions)
     */
    public function getIdAttribute()
    {
        return $this->ID_Wilayah;
    }
}
