<?php

namespace App\Services;

use App\Models\Stunting;
use App\Models\Wilayah;
use Illuminate\Support\Collection;

class FuzzyTimeSeriesService
{
    private $data;
    private $intervals;
    private $fuzzySets;
    private $fuzzyRelationships;
    private $predictions;
    private $uod;
    private $fuzzyLogicGroups;
    private $fuzzyRelationshipsMatrix;
    private $defuzzification;
    private $predictionYear;

    public function __construct()
    {
        $this->data = collect();
        $this->intervals = [];
        $this->fuzzySets = [];
        $this->fuzzyRelationships = [];
        $this->predictions = [];
        $this->uod = [];
        $this->fuzzyLogicGroups = [];
        $this->fuzzyRelationshipsMatrix = [];
        $this->defuzzification = [];
        $this->predictionYear = date('Y') + 1; // Default tahun prediksi
    }

    /**
     * Set tahun prediksi
     */
    public function setPredictionYear($year)
    {
        $this->predictionYear = $year;
        return $this;
    }

    /**
     * Ambil data stunting berdasarkan wilayah dan periode
     */
    public function getStuntingData($wilayahId = null, $tahunAwal = null, $tahunAkhir = null): Collection
    {
        $query = Stunting::with('wilayah');
        
        if ($wilayahId) {
            $query->where('id_wilayah', $wilayahId);
        }
        
        if ($tahunAwal) {
            $query->where('tahun', '>=', $tahunAwal);
        }
        
        if ($tahunAkhir) {
            $query->where('tahun', '<=', $tahunAkhir);
        }
        
        $this->data = $query->get()->map(function ($item) {
            return [
                'id_wilayah' => $item->id_wilayah,
                'nama_wilayah' => $item->wilayah->kabupaten ?? 'Unknown',
                'provinsi' => $item->wilayah->provinsi ?? 'Unknown',
                'tahun' => $item->tahun,
                'jumlah_stunting' => $item->jumlah_stunting
            ];
        });
        
        return $this->data;
    }

    /**
     * Tentukan Universe of Discourse (UoD) - SAMA DENGAN KODE LAMA
     */
    public function determineUoD(): array
    {
        // Gunakan Semesta U tetap (Bab 3) - SAMA DENGAN KODE LAMA
        // Min = 2,775; Jumlah interval (k) = 6; Ukuran interval = 11,005; Upper terakhir = 68,805
        $min = 2775;
        $jumlah_interval = 6;
        $interval_size = 11005;
        $upper_akhir = $min + ($jumlah_interval * $interval_size); // 68,805

        $this->uod = [];
        $current_value = $min;
        
        for ($i = 1; $i <= $jumlah_interval; $i++) {
            $is_last = ($i === $jumlah_interval);
            $next_value = $is_last ? $upper_akhir : ($current_value + $interval_size);
            
            $this->uod[] = [
                'start' => $current_value,
                'end' => $next_value,
                'midpoint' => ($current_value + $next_value) / 2,
                'label' => "A$i"
            ];
            
            $current_value = $next_value;
        }

        return $this->uod;
    }

    /**
     * Fuzzifikasi data - SAMA DENGAN KODE LAMA
     */
    public function fuzzify(): array
    {
        if (empty($this->uod)) {
            $this->determineUoD();
        }

        $this->fuzzySets = [];
        
        foreach ($this->data as $item) {
            $value = $item->jumlah_stunting;
            $fuzzySet = $this->findFuzzySet($value);
            
            $this->fuzzySets[] = [
                'id' => $item->id_stunting,
                'wilayah' => $item->wilayah->nama_wilayah ?? ($item->wilayah->Provinsi . ' - ' . $item->wilayah->Kabupaten),
                'tahun' => $item->tahun,
                'bulan' => $item->bulan,
                'nilai_asli' => $value,
                'fuzzy_set' => $fuzzySet['label'],
                'midpoint' => $fuzzySet['midpoint'],
                'interval_start' => $fuzzySet['start'],
                'interval_end' => $fuzzySet['end']
            ];
        }

        return $this->fuzzySets;
    }

    /**
     * Temukan fuzzy set yang sesuai dengan nilai - SAMA DENGAN KODE LAMA
     */
    private function findFuzzySet($value): array
    {
        foreach ($this->uod as $interval) {
            $lower = $interval['start'];
            $upper = $interval['end'];
            $is_last = ($interval['label'] === 'A6'); // A6 adalah interval terakhir
            
            // Konvensi batas: semua interval menggunakan [lower, upper) kecuali interval terakhir [lower, upper]
            if (($value >= $lower && $value < $upper) || ($is_last && $value >= $lower && $value <= $upper)) {
                return $interval;
            }
        }
        
        // Fallback ke interval terdekat
        return $this->uod[0];
    }

    /**
     * Buat fuzzy logic groups - SAMA DENGAN KODE LAMA
     */
    public function createFuzzyLogicGroups(): array
    {
        if (empty($this->fuzzySets)) {
            $this->fuzzify();
        }

        $this->fuzzyLogicGroups = [];
        
        for ($i = 0; $i < count($this->fuzzySets) - 1; $i++) {
            $current = $this->fuzzySets[$i]['fuzzy_set'];
            $next = $this->fuzzySets[$i + 1]['fuzzy_set'];
            
            $this->fuzzyLogicGroups[] = [
                'current' => $current,
                'next' => $next,
                'relationship' => $current . ' -> ' . $next
            ];
        }

        return $this->fuzzyLogicGroups;
    }

    /**
     * Buat fuzzy relationships matrix - SAMA DENGAN KODE LAMA
     */
    public function createFuzzyRelationshipsMatrix(): array
    {
        if (empty($this->fuzzyLogicGroups)) {
            $this->createFuzzyLogicGroups();
        }

        $this->fuzzyRelationshipsMatrix = [];
        $relationships = collect($this->fuzzyLogicGroups)->groupBy('relationship');
        
        foreach ($relationships as $relationship => $group) {
            $frequency = $group->count();
            $totalRelationships = count($this->fuzzyLogicGroups);
            $probability = $totalRelationships > 0 ? ($frequency / $totalRelationships) * 100 : 0;
            
            $this->fuzzyRelationshipsMatrix[] = [
                'relationship' => $relationship,
                'frequency' => $frequency,
                'probability' => round($probability, 2)
            ];
        }

        return $this->fuzzyRelationshipsMatrix;
    }

    /**
     * Defuzzifikasi dan prediksi - SAMA DENGAN KODE LAMA
     */
    public function defuzzify(): array
    {
        if (empty($this->fuzzySets)) {
            $this->fuzzify();
        }

        $this->defuzzification = [];
        
        // Ambil fuzzy set terakhir dari data
        $lastFuzzySet = end($this->fuzzySets);
        $lastLabel = $lastFuzzySet['fuzzy_set'];
        
        // SAMA DENGAN KODE LAMA: Hitung prediksi berdasarkan fuzzy set terakhir
        $prediksi = 0;
        
        // Cari interval yang sesuai dengan fuzzy set terakhir
        foreach ($this->uod as $interval) {
            if ($interval['label'] == $lastLabel) {
                $prediksi = ceil($interval['midpoint']);
                break;
            }
        }
        
        $this->defuzzification = [
            'last_fuzzy_set' => $lastLabel,
            'predicted_value' => $prediksi,
            'confidence' => 100, // Default confidence untuk kode lama
            'method' => 'midpoint_last_fuzzy_set'
        ];

        return $this->defuzzification;
    }

    /**
     * Jalankan seluruh proses Fuzzy Time Series
     */
    public function runFuzzyTimeSeries($wilayahId = null, $tahunAwal = null, $tahunAkhir = null): array
    {
        // Ambil data
        $this->getStuntingData($wilayahId, $tahunAwal, $tahunAkhir);
        
        if ($this->data->isEmpty()) {
            return [];
        }

        // Jalankan semua langkah FTS
        $uod = $this->determineUoD();
        $fuzzySets = $this->fuzzify();
        $fuzzyLogicGroups = $this->createFuzzyLogicGroups();
        $fuzzyRelationshipsMatrix = $this->createFuzzyRelationshipsMatrix();
        $defuzzification = $this->defuzzify();

        // Buat summary
        $summary = $this->getSummary();

        return [
            'data' => $this->data,
            'uod' => $uod,
            'fuzzy_sets' => $fuzzySets,
            'fuzzy_logic_groups' => $fuzzyLogicGroups,
            'fuzzy_relationships_matrix' => $fuzzyRelationshipsMatrix,
            'defuzzification' => $defuzzification,
            'summary' => $summary
        ];
    }

    /**
     * Method baru yang mengembalikan struktur data seperti kode lama
     * SAMA DENGAN KODE LAMA: Mengembalikan array hasil per wilayah
     */
    public function defuzzification(): array
    {
        $results = [];
        
        foreach ($this->data as $wilayah) {
            $id_wilayah = $wilayah['id_wilayah'];
            $nama_wilayah = $wilayah['nama_wilayah'];
            $provinsi = $wilayah['provinsi'];
            
            // Ambil data historis untuk wilayah ini
            $data_historis = $this->getHistoricalData($id_wilayah);
            
            if (count($data_historis) < 2) {
                continue; // Skip jika data tidak cukup
            }
            
            // Cari data tahun terakhir yang tersedia
            $tahun_terakhir = max(array_column($data_historis, 'tahun'));
            
            // Jika tahun tujuan sudah ada datanya, gunakan data aktual (validasi)
            $data_tujuan = null;
            foreach ($data_historis as $data) {
                if ($data['tahun'] == $this->predictionYear) {
                    $data_tujuan = $data;
                    break;
                }
            }
            
            if ($data_tujuan !== null) {
                // Data tahun tujuan sudah ada, hitung selisih dengan prediksi (validasi)
                $data_sebelum = array_filter($data_historis, function($data) {
                    return $data['tahun'] < $this->predictionYear;
                });
                
                if (count($data_sebelum) >= 2) {
                    // Ambil 2 data terakhir sebelum tahun tujuan
                    $data_terakhir = array_slice(array_values($data_sebelum), -2);
                    
                    $hasil_fts = $this->hitungFTSAlgorithm($data_terakhir);
                    $jumlah_aktual = $data_tujuan['jumlah'];
                    $jumlah_perkiraan = $hasil_fts['prediksi'];
                    $selisih = $jumlah_aktual - $jumlah_perkiraan;
                    $persentase = ($jumlah_perkiraan > 0) ? (($selisih / $jumlah_perkiraan) * 100) : 0;
                    
                    $results[] = [
                        'id_wilayah' => $id_wilayah,
                        'nama_wilayah' => $nama_wilayah,
                        'provinsi' => $provinsi,
                        'tahun_terakhir' => $data_terakhir[count($data_terakhir) - 1]['tahun'],
                        'jumlah_terakhir' => $data_terakhir[count($data_terakhir) - 1]['jumlah'],
                        'tahun_perkiraan' => $this->predictionYear,
                        'jumlah_perkiraan' => $jumlah_perkiraan,
                        'jumlah_aktual' => $jumlah_aktual,
                        'selisih' => $selisih,
                        'persentase' => $persentase,
                        'metode' => 'FTS',
                        'data_historis' => $data_historis,
                        'tipe' => 'validasi',
                        'fuzzy_sets' => $hasil_fts['fuzzy_sets'],
                        'intervals' => $hasil_fts['intervals'],
                        'fuzzy_values' => $hasil_fts['fuzzy_values'],
                        'min' => $hasil_fts['min'],
                        'max' => $hasil_fts['max'],
                        'jumlah_interval' => $hasil_fts['jumlah_interval'],
                        'interval_size' => $hasil_fts['interval_size']
                    ];
                }
            } else {
                // Tahun tujuan belum ada, lakukan prediksi
                $data_terakhir = array_slice($data_historis, -2);
                
                $hasil_fts = $this->hitungFTSAlgorithm($data_terakhir);
                $jumlah_terakhir = $data_terakhir[count($data_terakhir) - 1]['jumlah'];
                $jumlah_perkiraan = $hasil_fts['prediksi'];
                $selisih = $jumlah_perkiraan - $jumlah_terakhir;
                $persentase = ($jumlah_terakhir > 0) ? (($selisih / $jumlah_terakhir) * 100) : 0;
                
                $results[] = [
                    'id_wilayah' => $id_wilayah,
                    'nama_wilayah' => $nama_wilayah,
                    'provinsi' => $provinsi,
                    'tahun_terakhir' => $data_terakhir[count($data_terakhir) - 1]['tahun'],
                    'jumlah_terakhir' => $data_terakhir[count($data_terakhir) - 1]['jumlah'],
                    'tahun_perkiraan' => $this->predictionYear,
                    'jumlah_perkiraan' => $jumlah_perkiraan,
                    'selisih' => $selisih,
                    'persentase' => $persentase,
                    'metode' => 'FTS',
                    'data_historis' => $data_historis,
                    'tipe' => 'prediksi',
                    'fuzzy_sets' => $hasil_fts['fuzzy_sets'],
                    'intervals' => $hasil_fts['intervals'],
                    'fuzzy_values' => $hasil_fts['fuzzy_values'],
                    'min' => $hasil_fts['min'],
                    'max' => $hasil_fts['max'],
                    'jumlah_interval' => $hasil_fts['jumlah_interval'],
                    'interval_size' => $hasil_fts['interval_size']
                ];
            }
        }
        
        return $results;
    }

    /**
     * Method untuk menghitung FTS Algorithm seperti kode lama
     */
    private function hitungFTSAlgorithm($data_historis)
    {
        // Ambil nilai-nilai dari data historis
        $nilai_historis = array_column($data_historis, 'jumlah');

        // SAMA DENGAN KODE LAMA: Gunakan Semesta U tetap (Bab 3)
        // Min = 2,775; Jumlah interval (k) = 6; Ukuran interval = 11,005; Upper terakhir = 68,805
        $min = 2775;
        $jumlah_interval = 6;
        $interval_size = 11005;
        $upper_akhir = $min + ($jumlah_interval * $interval_size); // 68,805

        // Buat interval fuzzy
        $intervals = array();
        $fuzzy_sets = array();

        $current_value = $min;
        for ($i = 1; $i <= $jumlah_interval; $i++) {
            $is_last = ($i === $jumlah_interval);
            $next_value = $is_last ? $upper_akhir : ($current_value + $interval_size);
            $intervals[$i] = array(
                'lower' => $current_value,
                'upper' => $next_value,
                'midpoint' => ($current_value + $next_value) / 2
            );
            $fuzzy_sets[$i] = "A$i";
            $current_value = $next_value;
        }

        // Fuzzifikasi data historis
        $fuzzy_values = array();
        foreach ($nilai_historis as $nilai) {
            $fuzzy_set = "";
            for ($i = 1; $i <= $jumlah_interval; $i++) {
                $lower = $intervals[$i]['lower'];
                $upper = $intervals[$i]['upper'];
                $is_last = ($i === $jumlah_interval);
                if (($nilai >= $lower && $nilai < $upper) || ($is_last && $nilai >= $lower)) {
                    $fuzzy_set = $fuzzy_sets[$i];
                    break;
                }
            }
            $fuzzy_values[] = $fuzzy_set;
        }

        // Hitung prediksi berdasarkan fuzzy set terakhir
        $fuzzy_terakhir = end($fuzzy_values);
        $prediksi = 0;

        // Cari interval yang sesuai dengan fuzzy set terakhir
        for ($i = 1; $i <= $jumlah_interval; $i++) {
            if ($fuzzy_sets[$i] == $fuzzy_terakhir) {
                $prediksi = ceil($intervals[$i]['midpoint']);
                break;
            }
        }

        return array(
            'prediksi' => $prediksi,
            'fuzzy_sets' => $fuzzy_sets,
            'intervals' => $intervals,
            'fuzzy_values' => $fuzzy_values,
            'min' => $min,
            'max' => $upper_akhir,
            'jumlah_interval' => $jumlah_interval,
            'interval_size' => $interval_size
        );
    }

    /**
     * Method untuk mendapatkan data historis wilayah
     */
    private function getHistoricalData($id_wilayah)
    {
        $data_historis = [];
        
        $stuntingData = Stunting::where('id_wilayah', $id_wilayah)
            ->orderBy('tahun', 'ASC')
            ->get();
            
        foreach ($stuntingData as $row) {
            $data_historis[] = [
                'tahun' => $row->tahun,
                'jumlah' => (int)$row->jumlah_stunting
            ];
        }
        
        return $data_historis;
    }

    /**
     * Buat summary hasil perhitungan
     */
    private function getSummary(): array
    {
        $totalData = $this->data->count();
        $totalWilayah = $this->data->unique('id_wilayah')->count();
        $tahunRange = $this->data->pluck('tahun')->unique()->sort();
        
        $minValue = $this->data->min('jumlah_stunting');
        $maxValue = $this->data->max('jumlah_stunting');
        
        $confidence = 0;
        $prediction = 0;
        
        if (!empty($this->defuzzification)) {
            $confidence = $this->defuzzification['confidence'] ?? 0;
            $prediction = $this->defuzzification['predicted_value'] ?? 0;
        }

        return [
            'total_data' => $totalData,
            'total_wilayah' => $totalWilayah,
            'tahun_awal' => $tahunRange->first(),
            'tahun_akhir' => $tahunRange->last(),
            'min_value' => $minValue,
            'max_value' => $maxValue,
            'confidence' => $confidence,
            'prediction' => $prediction
        ];
    }

    /**
     * Dapatkan statistik wilayah
     */
    public function getWilayahStats($wilayahId = null): array
    {
        $query = Stunting::with('wilayah');
        
        if ($wilayahId) {
            $query->where('id_wilayah', $wilayahId);
        }
        
        $data = $query->get();
        
        return [
            'total_wilayah' => $data->unique('id_wilayah')->count(),
            'total_data' => $data->count(),
            'tahun_range' => [
                'min' => $data->min('tahun'),
                'max' => $data->max('tahun')
            ]
        ];
    }
}
