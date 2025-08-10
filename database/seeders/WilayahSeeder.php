<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Wilayah;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wilayahs = [
            [
                'nama_wilayah' => 'Kecamatan Cilacap Utara',
                'kode_wilayah' => 'CLP001',
                'deskripsi' => 'Kecamatan di bagian utara Kabupaten Cilacap',
                'provinsi' => 'Jawa Tengah',
                'kabupaten' => 'Cilacap',
                'kecamatan' => 'Cilacap Utara',
                'desa' => null,
                'jumlah_penduduk' => 45000,
                'luas_wilayah' => 125.50,
                'satuan_luas' => 'km2',
                'status_aktif' => true
            ],
            [
                'nama_wilayah' => 'Kecamatan Cilacap Tengah',
                'kode_wilayah' => 'CLP002',
                'deskripsi' => 'Kecamatan di bagian tengah Kabupaten Cilacap',
                'provinsi' => 'Jawa Tengah',
                'kabupaten' => 'Cilacap',
                'kecamatan' => 'Cilacap Tengah',
                'desa' => null,
                'jumlah_penduduk' => 52000,
                'luas_wilayah' => 98.75,
                'satuan_luas' => 'km2',
                'status_aktif' => true
            ],
            [
                'nama_wilayah' => 'Kecamatan Cilacap Selatan',
                'kode_wilayah' => 'CLP003',
                'deskripsi' => 'Kecamatan di bagian selatan Kabupaten Cilacap',
                'provinsi' => 'Jawa Tengah',
                'kabupaten' => 'Cilacap',
                'kecamatan' => 'Cilacap Selatan',
                'desa' => null,
                'jumlah_penduduk' => 38000,
                'luas_wilayah' => 156.25,
                'satuan_luas' => 'km2',
                'status_aktif' => true
            ],
            [
                'nama_wilayah' => 'Kecamatan Kroya',
                'kode_wilayah' => 'CLP004',
                'deskripsi' => 'Kecamatan Kroya di Kabupaten Cilacap',
                'provinsi' => 'Jawa Tengah',
                'kabupaten' => 'Cilacap',
                'kecamatan' => 'Kroya',
                'desa' => null,
                'jumlah_penduduk' => 42000,
                'luas_wilayah' => 112.80,
                'satuan_luas' => 'km2',
                'status_aktif' => true
            ],
            [
                'nama_wilayah' => 'Kecamatan Sampang',
                'kode_wilayah' => 'CLP005',
                'deskripsi' => 'Kecamatan Sampang di Kabupaten Cilacap',
                'provinsi' => 'Jawa Tengah',
                'kabupaten' => 'Cilacap',
                'kecamatan' => 'Sampang',
                'desa' => null,
                'jumlah_penduduk' => 35000,
                'luas_wilayah' => 89.45,
                'satuan_luas' => 'km2',
                'status_aktif' => true
            ]
        ];

        foreach ($wilayahs as $wilayah) {
            Wilayah::create($wilayah);
        }
    }
}
