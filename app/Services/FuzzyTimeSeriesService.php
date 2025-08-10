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

    public function __construct()
    {
        $this->data = collect();
        $this->intervals = [];
        $this->fuzzySets = [];
        $this->fuzzyRelationships = [];
        $this->predictions = [];
    }

    /**
     * Ambil data stunting berdasarkan wilayah dan periode
     */
    public function getStuntingData($wilayahId = null, $tahunAwal = null, $tahunAkhir = null): Collection
    {
        $query = Stunting::with('wilayah')->orderBy('tahun')->orderBy('bulan');

        if ($wilayahId) {
            $query->where('wilayah_id', $wilayahId);
        }

        if ($tahunAwal) {
            $query->where('tahun', '>=', $tahunAwal);
        }

        if ($tahunAkhir) {
            $query->where('tahun', '<=', $tahunAkhir);
        }

        $this->data = $query->get();
        return $this->data;
    }

    /**
     * Tentukan interval untuk fuzzy sets
     */
    public function determineIntervals(): array
    {
        if ($this->data->isEmpty()) {
            return [];
        }

        $minValue = $this->data->min('persentase_stunting');
        $maxValue = $this->data->max('persentase_stunting');
        
        // Buat 7 interval (sesuai dengan contoh)
        $range = $maxValue - $minValue;
        $intervalSize = $range / 7;
        
        $this->intervals = [];
        for ($i = 0; $i < 7; $i++) {
            $start = $minValue + ($i * $intervalSize);
            $end = $minValue + (($i + 1) * $intervalSize);
            $this->intervals[] = [
                'start' => round($start, 2),
                'end' => round($end, 2),
                'midpoint' => round(($start + $end) / 2, 2),
                'label' => 'A' . ($i + 1)
            ];
        }

        return $this->intervals;
    }

    /**
     * Fuzzifikasi data
     */
    public function fuzzify(): array
    {
        if (empty($this->intervals)) {
            $this->determineIntervals();
        }

        $this->fuzzySets = [];
        
        foreach ($this->data as $item) {
            $value = $item->persentase_stunting;
            $fuzzySet = $this->findFuzzySet($value);
            
            $this->fuzzySets[] = [
                'id' => $item->id,
                'wilayah' => $item->wilayah->nama_wilayah,
                'tahun' => $item->tahun,
                'bulan' => $item->bulan,
                'nilai_asli' => $value,
                'fuzzy_set' => $fuzzySet['label'],
                'midpoint' => $fuzzySet['midpoint']
            ];
        }

        return $this->fuzzySets;
    }

    /**
     * Temukan fuzzy set yang sesuai dengan nilai
     */
    private function findFuzzySet($value): array
    {
        foreach ($this->intervals as $interval) {
            if ($value >= $interval['start'] && $value <= $interval['end']) {
                return $interval;
            }
        }
        
        // Fallback ke interval terdekat
        return $this->intervals[0];
    }

    /**
     * Buat fuzzy relationships
     */
    public function createFuzzyRelationships(): array
    {
        if (empty($this->fuzzySets)) {
            $this->fuzzify();
        }

        $this->fuzzyRelationships = [];
        
        for ($i = 0; $i < count($this->fuzzySets) - 1; $i++) {
            $current = $this->fuzzySets[$i]['fuzzy_set'];
            $next = $this->fuzzySets[$i + 1]['fuzzy_set'];
            
            $this->fuzzyRelationships[] = [
                'from' => $current,
                'to' => $next,
                'tahun' => $this->fuzzySets[$i]['tahun'],
                'bulan' => $this->fuzzySets[$i]['bulan']
            ];
        }

        return $this->fuzzyRelationships;
    }

    /**
     * Buat prediksi
     */
    public function makePredictions(): array
    {
        if (empty($this->fuzzyRelationships)) {
            $this->createFuzzyRelationships();
        }

        $this->predictions = [];
        
        foreach ($this->fuzzyRelationships as $relationship) {
            $predictedSet = $relationship['to'];
            $predictedValue = $this->getMidpointByLabel($predictedSet);
            
            $this->predictions[] = [
                'tahun' => $relationship['tahun'],
                'bulan' => $relationship['bulan'],
                'fuzzy_set_aktual' => $relationship['from'],
                'fuzzy_set_prediksi' => $predictedSet,
                'nilai_prediksi' => $predictedValue,
                'akurasi' => $this->calculateAccuracy($relationship['from'], $predictedSet)
            ];
        }

        return $this->predictions;
    }

    /**
     * Dapatkan midpoint berdasarkan label fuzzy set
     */
    private function getMidpointByLabel($label): float
    {
        foreach ($this->intervals as $interval) {
            if ($interval['label'] === $label) {
                return $interval['midpoint'];
            }
        }
        return 0;
    }

    /**
     * Hitung akurasi prediksi
     */
    private function calculateAccuracy($actual, $predicted): float
    {
        if ($actual === $predicted) {
            return 100.0;
        }
        
        // Hitung jarak antar fuzzy set
        $actualIndex = $this->getFuzzySetIndex($actual);
        $predictedIndex = $this->getFuzzySetIndex($predicted);
        
        $distance = abs($actualIndex - $predictedIndex);
        $maxDistance = count($this->intervals) - 1;
        
        return max(0, 100 - (($distance / $maxDistance) * 100));
    }

    /**
     * Dapatkan index fuzzy set
     */
    private function getFuzzySetIndex($label): int
    {
        foreach ($this->intervals as $index => $interval) {
            if ($interval['label'] === $label) {
                return $index;
            }
        }
        return 0;
    }

    /**
     * Jalankan seluruh proses FTS
     */
    public function runFuzzyTimeSeries($wilayahId = null, $tahunAwal = null, $tahunAkhir = null): array
    {
        $this->getStuntingData($wilayahId, $tahunAwal, $tahunAkhir);
        $this->determineIntervals();
        $this->fuzzify();
        $this->createFuzzyRelationships();
        $this->makePredictions();

        return [
            'data_mentah' => $this->data,
            'intervals' => $this->intervals,
            'fuzzy_sets' => $this->fuzzySets,
            'fuzzy_relationships' => $this->fuzzyRelationships,
            'predictions' => $this->predictions,
            'summary' => $this->getSummary()
        ];
    }

    /**
     * Dapatkan ringkasan hasil
     */
    private function getSummary(): array
    {
        if (empty($this->predictions)) {
            return [];
        }

        $totalPredictions = count($this->predictions);
        $accuratePredictions = collect($this->predictions)->where('akurasi', 100)->count();
        $averageAccuracy = collect($this->predictions)->avg('akurasi');
        $averagePrediction = collect($this->predictions)->avg('nilai_prediksi');

        return [
            'total_prediksi' => $totalPredictions,
            'prediksi_akurat' => $accuratePredictions,
            'akurasi_rata_rata' => round($averageAccuracy, 2),
            'prediksi_rata_rata' => round($averagePrediction, 2),
            'tingkat_keberhasilan' => round(($accuratePredictions / $totalPredictions) * 100, 2)
        ];
    }
}
