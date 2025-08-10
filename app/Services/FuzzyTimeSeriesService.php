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
    }

    /**
     * Ambil data stunting berdasarkan wilayah dan periode
     */
    public function getStuntingData($wilayahId = null, $tahunAwal = null, $tahunAkhir = null): Collection
    {
        $query = Stunting::with('wilayah')->orderBy('tahun')->orderBy('bulan');

        if ($wilayahId) {
            $query->where('id_wilayah', $wilayahId);
        }

        if ($tahunAwal) {
            $query->where('tahun', '>=', $tahunAwal);
        }

        if ($tahunAkhir) {
            $query->where('tahun', '<=', $tahunAkhir);
        }

        $this->data = $query->get();
        
        // Tambahkan field persentase jika belum ada
        $this->data->each(function ($item) {
            if (!isset($item->persentase)) {
                // Hitung persentase berdasarkan jumlah stunting (contoh sederhana)
                $item->persentase = $item->jumlah_stunting; // Untuk sementara gunakan jumlah sebagai persentase
            }
        });
        
        return $this->data;
    }

    /**
     * Tentukan Universe of Discourse (UoD) - sesuai kode PHP native
     */
    public function determineUoD(): array
    {
        if ($this->data->isEmpty()) {
            return [];
        }

        $minValue = $this->data->min('jumlah_stunting');
        $maxValue = $this->data->max('jumlah_stunting');
        
        // Buat 7 interval (sesuai dengan contoh)
        $range = $maxValue - $minValue;
        $intervalSize = $range / 7;
        
        $this->uod = [];
        for ($i = 0; $i < 7; $i++) {
            $start = $minValue + ($i * $intervalSize);
            $end = $minValue + (($i + 1) * $intervalSize);
            $this->uod[] = [
                'start' => round($start, 2),
                'end' => round($end, 2),
                'midpoint' => round(($start + $end) / 2, 2),
                'label' => 'A' . ($i + 1)
            ];
        }

        return $this->uod;
    }

    /**
     * Fuzzifikasi data - sesuai kode PHP native
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
     * Temukan fuzzy set yang sesuai dengan nilai
     */
    private function findFuzzySet($value): array
    {
        foreach ($this->uod as $interval) {
            if ($value >= $interval['start'] && $value <= $interval['end']) {
                return $interval;
            }
        }
        
        // Fallback ke interval terdekat
        return $this->uod[0];
    }

    /**
     * Buat fuzzy logic groups - sesuai kode PHP native
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
     * Buat fuzzy relationships matrix - sesuai kode PHP native
     */
    public function createFuzzyRelationshipsMatrix(): array
    {
        if (empty($this->fuzzyLogicGroups)) {
            $this->createFuzzyLogicGroups();
        }

        $this->fuzzyRelationshipsMatrix = [];
        
        // Hitung frekuensi setiap relationship
        $relationships = collect($this->fuzzyLogicGroups)->groupBy('relationship');
        
        foreach ($relationships as $relationship => $group) {
            $this->fuzzyRelationshipsMatrix[] = [
                'relationship' => $relationship,
                'frequency' => $group->count(),
                'probability' => round($group->count() / count($this->fuzzyLogicGroups), 4)
            ];
        }

        return $this->fuzzyRelationshipsMatrix;
    }

    /**
     * Defuzzifikasi untuk prediksi - sesuai kode PHP native
     */
    public function defuzzify(): array
    {
        if (empty($this->fuzzyRelationshipsMatrix)) {
            $this->createFuzzyRelationshipsMatrix();
        }

        $this->defuzzification = [];
        
        // Ambil fuzzy set terakhir dari data
        $lastFuzzySet = end($this->fuzzySets);
        $lastLabel = $lastFuzzySet['fuzzy_set'];
        
        // Cari relationship yang dimulai dengan fuzzy set terakhir
        $nextRelationships = collect($this->fuzzyRelationshipsMatrix)
            ->filter(function ($item) use ($lastLabel) {
                return strpos($item['relationship'], $lastLabel . ' -> ') === 0;
            })
            ->sortByDesc('probability');
        
        if ($nextRelationships->isNotEmpty()) {
            $mostProbable = $nextRelationships->first();
            $nextFuzzySet = explode(' -> ', $mostProbable['relationship'])[1];
            
            // Cari midpoint dari fuzzy set berikutnya
            $nextInterval = collect($this->uod)->firstWhere('label', $nextFuzzySet);
            
            $this->defuzzification = [
                'last_fuzzy_set' => $lastLabel,
                'predicted_fuzzy_set' => $nextFuzzySet,
                'predicted_value' => $nextInterval['midpoint'],
                'confidence' => $mostProbable['probability'],
                'relationship_used' => $mostProbable['relationship']
            ];
        }

        return $this->defuzzification;
    }

    /**
     * Prediksi nilai berikutnya berdasarkan fuzzy set
     */
    private function predictNextValue($fuzzySet): float
    {
        $interval = collect($this->uod)->firstWhere('label', $fuzzySet);
        return $interval ? $interval['midpoint'] : 0;
    }

    /**
     * Hitung persentase error
     */
    private function calculateErrorPercentage($actual, $predicted): float
    {
        if ($actual == 0) return 0;
        return abs(($actual - $predicted) / $actual) * 100;
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
     * Buat summary hasil perhitungan
     */
    private function getSummary(): array
    {
        $totalData = $this->data->count();
        $totalWilayah = $this->data->unique('id_wilayah')->count();
        $tahunRange = $this->data->pluck('tahun')->unique()->sort();
        
        $minValue = $this->data->min('jumlah_stunting');
        $maxValue = $this->data->max('jumlah_stunting');
        $avgValue = $this->data->avg('jumlah_stunting');
        
        $prediction = $this->defuzzification['predicted_value'] ?? 0;
        $confidence = $this->defuzzification['confidence'] ?? 0;

        return [
            'total_data' => $totalData,
            'total_wilayah' => $totalWilayah,
            'tahun_range' => $tahunRange->values()->toArray(),
            'min_value' => $minValue,
            'max_value' => $maxValue,
            'avg_value' => round($avgValue, 2),
            'prediction' => round($prediction, 2),
            'confidence' => round($confidence * 100, 2),
            'algorithm' => 'Fuzzy Time Series (FTS)',
            'intervals_count' => count($this->uod)
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
            'total_records' => $data->count(),
            'wilayahs' => $data->unique('id_wilayah')->count(),
            'tahun_range' => $data->pluck('tahun')->unique()->sort()->values()->toArray(),
            'avg_stunting' => round($data->avg('jumlah_stunting'), 2)
        ];
    }
}
