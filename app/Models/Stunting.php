<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stunting extends Model
{
    protected $primaryKey = 'id_stunting';
    
    protected $fillable = [
        'id_wilayah',
        'tahun',
        'bulan',
        'jumlah_stunting'
    ];

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah', 'ID_Wilayah');
    }
}
