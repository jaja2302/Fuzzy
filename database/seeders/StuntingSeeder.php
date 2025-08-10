<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stunting;
use App\Models\Wilayah;

class StuntingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wilayahs = Wilayah::all();
        
        if ($wilayahs->isEmpty()) {
            $this->command->info('Wilayah tidak ditemukan. Jalankan WilayahSeeder terlebih dahulu.');
            return;
        }

        $dataStunting = [];
        
        // Data untuk setiap wilayah dari tahun 2020-2024
        foreach ($wilayahs as $wilayah) {
            // Data tahun 2020
            $dataStunting[] = [
                'wilayah_id' => $wilayah->id,
                'tahun' => 2020,
                'bulan' => 1,
                'jumlah_balita' => rand(800, 1200),
                'jumlah_stunting' => rand(120, 300),
                'persentase_stunting' => rand(15.0, 25.0),
                'tinggi_badan_ratarata' => rand(85, 95),
                'berat_badan_ratarata' => rand(10, 15),
                'kategori_stunting' => 'Sedang',
                'catatan' => 'Data awal tahun 2020',
                'sumber_data' => 'Dinas Kesehatan',
                'status_validasi' => true
            ];
            
            $dataStunting[] = [
                'wilayah_id' => $wilayah->id,
                'tahun' => 2020,
                'bulan' => 6,
                'jumlah_balita' => rand(800, 1200),
                'jumlah_stunting' => rand(100, 280),
                'persentase_stunting' => rand(12.5, 23.5),
                'tinggi_badan_ratarata' => rand(86, 96),
                'berat_badan_ratarata' => rand(10.5, 15.5),
                'kategori_stunting' => 'Sedang',
                'catatan' => 'Data pertengahan tahun 2020',
                'sumber_data' => 'Dinas Kesehatan',
                'status_validasi' => true
            ];
            
            // Data tahun 2021
            $dataStunting[] = [
                'wilayah_id' => $wilayah->id,
                'tahun' => 2021,
                'bulan' => 1,
                'jumlah_balita' => rand(800, 1200),
                'jumlah_stunting' => rand(95, 275),
                'persentase_stunting' => rand(11.9, 23.0),
                'tinggi_badan_ratarata' => rand(87, 97),
                'berat_badan_ratarata' => rand(11, 16),
                'kategori_stunting' => 'Sedang',
                'catatan' => 'Data awal tahun 2021',
                'sumber_data' => 'Dinas Kesehatan',
                'status_validasi' => true
            ];
            
            $dataStunting[] = [
                'wilayah_id' => $wilayah->id,
                'tahun' => 2021,
                'bulan' => 6,
                'jumlah_balita' => rand(800, 1200),
                'jumlah_stunting' => rand(90, 270),
                'persentase_stunting' => rand(11.3, 22.5),
                'tinggi_badan_ratarata' => rand(88, 98),
                'berat_badan_ratarata' => rand(11.5, 16.5),
                'kategori_stunting' => 'Sedang',
                'catatan' => 'Data pertengahan tahun 2021',
                'sumber_data' => 'Dinas Kesehatan',
                'status_validasi' => true
            ];
            
            // Data tahun 2022
            $dataStunting[] = [
                'wilayah_id' => $wilayah->id,
                'tahun' => 2022,
                'bulan' => 1,
                'jumlah_balita' => rand(800, 1200),
                'jumlah_stunting' => rand(85, 265),
                'persentase_stunting' => rand(10.6, 22.1),
                'tinggi_badan_ratarata' => rand(89, 99),
                'berat_badan_ratarata' => rand(12, 17),
                'kategori_stunting' => 'Sedang',
                'catatan' => 'Data awal tahun 2022',
                'sumber_data' => 'Dinas Kesehatan',
                'status_validasi' => true
            ];
            
            $dataStunting[] = [
                'wilayah_id' => $wilayah->id,
                'tahun' => 2022,
                'bulan' => 6,
                'jumlah_balita' => rand(800, 1200),
                'jumlah_stunting' => rand(80, 260),
                'persentase_stunting' => rand(10.0, 21.7),
                'tinggi_badan_ratarata' => rand(90, 100),
                'berat_badan_ratarata' => rand(12.5, 17.5),
                'kategori_stunting' => 'Sedang',
                'catatan' => 'Data pertengahan tahun 2022',
                'sumber_data' => 'Dinas Kesehatan',
                'status_validasi' => true
            ];
            
            // Data tahun 2023
            $dataStunting[] = [
                'wilayah_id' => $wilayah->id,
                'tahun' => 2023,
                'bulan' => 1,
                'jumlah_balita' => rand(800, 1200),
                'jumlah_stunting' => rand(75, 255),
                'persentase_stunting' => rand(9.4, 21.2),
                'tinggi_badan_ratarata' => rand(91, 101),
                'berat_badan_ratarata' => rand(13, 18),
                'kategori_stunting' => 'Sedang',
                'catatan' => 'Data awal tahun 2023',
                'sumber_data' => 'Dinas Kesehatan',
                'status_validasi' => true
            ];
            
            $dataStunting[] = [
                'wilayah_id' => $wilayah->id,
                'tahun' => 2023,
                'bulan' => 6,
                'jumlah_balita' => rand(800, 1200),
                'jumlah_stunting' => rand(70, 250),
                'persentase_stunting' => rand(8.8, 20.8),
                'tinggi_badan_ratarata' => rand(92, 102),
                'berat_badan_ratarata' => rand(13.5, 18.5),
                'kategori_stunting' => 'Sedang',
                'catatan' => 'Data pertengahan tahun 2023',
                'sumber_data' => 'Dinas Kesehatan',
                'status_validasi' => true
            ];
            
            // Data tahun 2024
            $dataStunting[] = [
                'wilayah_id' => $wilayah->id,
                'tahun' => 2024,
                'bulan' => 1,
                'jumlah_balita' => rand(800, 1200),
                'jumlah_stunting' => rand(65, 245),
                'persentase_stunting' => rand(8.1, 20.4),
                'tinggi_badan_ratarata' => rand(93, 103),
                'berat_badan_ratarata' => rand(14, 19),
                'kategori_stunting' => 'Sedang',
                'catatan' => 'Data awal tahun 2024',
                'sumber_data' => 'Dinas Kesehatan',
                'status_validasi' => true
            ];
        }

        foreach ($dataStunting as $data) {
            Stunting::create($data);
        }
        
        $this->command->info('Data stunting berhasil dibuat: ' . count($dataStunting) . ' records');
    }
}
