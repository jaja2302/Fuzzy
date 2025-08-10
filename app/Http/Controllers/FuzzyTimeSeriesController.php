<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FuzzyTimeSeriesService;
use App\Models\Wilayah;

class FuzzyTimeSeriesController extends Controller
{
    protected $ftsService;

    public function __construct(FuzzyTimeSeriesService $ftsService)
    {
        $this->ftsService = $ftsService;
    }

    /**
     * Tampilkan halaman utama Fuzzy Time Series
     */
    public function index()
    {
        $wilayahs = Wilayah::where('status_aktif', true)->get();
        
        return view('fuzzy-time-series.index', compact('wilayahs'));
    }

    /**
     * Jalankan perhitungan FTS dan tampilkan hasil
     */
    public function calculate(Request $request)
    {
        $request->validate([
            'wilayah_id' => 'nullable|exists:wilayahs,id',
            'tahun_awal' => 'nullable|integer|min:2000|max:2030',
            'tahun_akhir' => 'nullable|integer|min:2000|max:2030'
        ]);

        $wilayahId = $request->input('wilayah_id');
        $tahunAwal = $request->input('tahun_awal');
        $tahunAkhir = $request->input('tahun_akhir');

        // Jalankan perhitungan FTS
        $results = $this->ftsService->runFuzzyTimeSeries($wilayahId, $tahunAwal, $tahunAkhir);
        
        $wilayahs = Wilayah::where('status_aktif', true)->get();
        
        return view('fuzzy-time-series.result', compact('results', 'wilayahs', 'wilayahId', 'tahunAwal', 'tahunAkhir'));
    }

    /**
     * API endpoint untuk mendapatkan data FTS (untuk AJAX)
     */
    public function getData(Request $request)
    {
        $request->validate([
            'wilayah_id' => 'nullable|exists:wilayahs,id',
            'tahun_awal' => 'nullable|integer|min:2000|max:2030',
            'tahun_akhir' => 'nullable|integer|min:2000|max:2030'
        ]);

        $wilayahId = $request->input('wilayah_id');
        $tahunAwal = $request->input('tahun_awal');
        $tahunAkhir = $request->input('tahun_akhir');

        $results = $this->ftsService->runFuzzyTimeSeries($wilayahId, $tahunAwal, $tahunAkhir);

        return response()->json($results);
    }
}
