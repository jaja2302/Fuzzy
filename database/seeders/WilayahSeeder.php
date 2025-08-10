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
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Tapanuli Tengah', 'nama_wilayah' => 'Tapanuli Tengah', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Tapanuli Utara', 'nama_wilayah' => 'Tapanuli Utara', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Tapanuli Selatan', 'nama_wilayah' => 'Tapanuli Selatan', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Nias', 'nama_wilayah' => 'Nias', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Langkat', 'nama_wilayah' => 'Langkat', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Karo', 'nama_wilayah' => 'Karo', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Deli Serdang', 'nama_wilayah' => 'Deli Serdang', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Simalungun', 'nama_wilayah' => 'Simalungun', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Asahan', 'nama_wilayah' => 'Asahan', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Labuhan Batu', 'nama_wilayah' => 'Labuhan Batu', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Dairi', 'nama_wilayah' => 'Dairi', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Toba', 'nama_wilayah' => 'Toba', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Mandailing Natal', 'nama_wilayah' => 'Mandailing Natal', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Nias Selatan', 'nama_wilayah' => 'Nias Selatan', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Pakpak Bharat', 'nama_wilayah' => 'Pakpak Bharat', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Humbang Hasundutan', 'nama_wilayah' => 'Humbang Hasundutan', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Samosir', 'nama_wilayah' => 'Samosir', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Serdang Bedagai', 'nama_wilayah' => 'Serdang Bedagai', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Batu Bara', 'nama_wilayah' => 'Batu Bara', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Padang Lawas Utara', 'nama_wilayah' => 'Padang Lawas Utara', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Padang Lawas', 'nama_wilayah' => 'Padang Lawas', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Labuhan Batu Selatan', 'nama_wilayah' => 'Labuhan Batu Selatan', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Labuhan Batu Utara', 'nama_wilayah' => 'Labuhan Batu Utara', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Nias Utara', 'nama_wilayah' => 'Nias Utara', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Nias Barat', 'nama_wilayah' => 'Nias Barat', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Kota Medan', 'nama_wilayah' => 'Kota Medan', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Kota Pematang Siantar', 'nama_wilayah' => 'Kota Pematang Siantar', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Kota Sibolga', 'nama_wilayah' => 'Kota Sibolga', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Kota Tanjung Balai', 'nama_wilayah' => 'Kota Tanjung Balai', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Kota Binjai', 'nama_wilayah' => 'Kota Binjai', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Kota Tebing Tinggi', 'nama_wilayah' => 'Kota Tebing Tinggi', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Kota Padang Sidempuan', 'nama_wilayah' => 'Kota Padang Sidempuan', 'status_aktif' => true],
            ['Provinsi' => 'Sumatera Utara', 'Kabupaten' => 'Kota Gunung Sitoli', 'nama_wilayah' => 'Kota Gunung Sitoli', 'status_aktif' => true]
        ];

        foreach ($wilayahs as $wilayah) {
            Wilayah::create($wilayah);
        }
        
        $this->command->info('Data wilayah Sumatera Utara berhasil dibuat: ' . count($wilayahs) . ' records');
    }
}
