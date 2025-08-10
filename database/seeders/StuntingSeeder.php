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

        // Data stunting sesuai dengan database lama
        $dataStunting = [
            // Tahun 2023 - Januari
            ['id_wilayah' => 1, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 25686],
            ['id_wilayah' => 2, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 17331],
            ['id_wilayah' => 3, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 23610],
            ['id_wilayah' => 4, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 14376],
            ['id_wilayah' => 5, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 37908],
            ['id_wilayah' => 6, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 22467],
            ['id_wilayah' => 7, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 69296],
            ['id_wilayah' => 8, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 37407],
            ['id_wilayah' => 9, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 28746],
            ['id_wilayah' => 10, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 27240],
            ['id_wilayah' => 11, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 17570],
            ['id_wilayah' => 12, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 9814],
            ['id_wilayah' => 13, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 37654],
            ['id_wilayah' => 14, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 29915],
            ['id_wilayah' => 15, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 3516],
            ['id_wilayah' => 16, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 10456],
            ['id_wilayah' => 17, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 8832],
            ['id_wilayah' => 18, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 24003],
            ['id_wilayah' => 19, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 19061],
            ['id_wilayah' => 20, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 14099],
            ['id_wilayah' => 21, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 20124],
            ['id_wilayah' => 22, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 16129],
            ['id_wilayah' => 23, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 19805],
            ['id_wilayah' => 24, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 13338],
            ['id_wilayah' => 25, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 8592],
            ['id_wilayah' => 26, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 63450],
            ['id_wilayah' => 27, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 8641],
            ['id_wilayah' => 28, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 7118],
            ['id_wilayah' => 29, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 5574],
            ['id_wilayah' => 30, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 6108],
            ['id_wilayah' => 31, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 5329],
            ['id_wilayah' => 32, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 12076],
            ['id_wilayah' => 33, 'tahun' => 2023, 'bulan' => 1, 'jumlah_stunting' => 10140],
            
            // Tahun 2024 - Januari
            ['id_wilayah' => 1, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 21526],
            ['id_wilayah' => 2, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 13496],
            ['id_wilayah' => 3, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 11075],
            ['id_wilayah' => 4, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 14190],
            ['id_wilayah' => 5, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 28899],
            ['id_wilayah' => 6, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 18244],
            ['id_wilayah' => 7, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 42042],
            ['id_wilayah' => 8, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 24560],
            ['id_wilayah' => 9, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 20783],
            ['id_wilayah' => 10, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 20751],
            ['id_wilayah' => 11, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 14510],
            ['id_wilayah' => 12, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 7012],
            ['id_wilayah' => 13, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 30609],
            ['id_wilayah' => 14, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 28675],
            ['id_wilayah' => 15, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 2775],
            ['id_wilayah' => 16, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 8363],
            ['id_wilayah' => 17, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 5819],
            ['id_wilayah' => 18, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 14994],
            ['id_wilayah' => 19, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 15229],
            ['id_wilayah' => 20, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 9133],
            ['id_wilayah' => 21, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 14437],
            ['id_wilayah' => 22, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 11307],
            ['id_wilayah' => 23, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 9618],
            ['id_wilayah' => 24, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 11804],
            ['id_wilayah' => 25, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 8203],
            ['id_wilayah' => 26, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 40486],
            ['id_wilayah' => 27, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 6517],
            ['id_wilayah' => 28, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 6265],
            ['id_wilayah' => 29, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 3487],
            ['id_wilayah' => 30, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 3692],
            ['id_wilayah' => 31, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 2988],
            ['id_wilayah' => 32, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 6756],
            ['id_wilayah' => 33, 'tahun' => 2024, 'bulan' => 1, 'jumlah_stunting' => 7642]
        ];

        foreach ($dataStunting as $data) {
            Stunting::create($data);
        }
        
        $this->command->info('Data stunting berhasil dibuat: ' . count($dataStunting) . ' records');
    }
}
