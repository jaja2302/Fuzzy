<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stunting extends Model
{
    protected $fillable = [
        'wilayah_id',
        'tahun',
        'bulan',
        'jumlah_balita',
        'jumlah_stunting',
        'persentase_stunting',
        'tinggi_badan_ratarata',
        'berat_badan_ratarata',
        'kategori_stunting',
        'catatan',
        'sumber_data',
        'status_validasi'
    ];

    protected $casts = [
        'tahun' => 'integer',
        'bulan' => 'integer',
        'jumlah_balita' => 'integer',
        'jumlah_stunting' => 'integer',
        'persentase_stunting' => 'decimal:2',
        'tinggi_badan_ratarata' => 'decimal:2',
        'berat_badan_ratarata' => 'decimal:2',
        'status_validasi' => 'boolean'
    ];

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }
}
