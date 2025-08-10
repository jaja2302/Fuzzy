<?php

namespace App\Http\Controllers;

use App\Models\Stunting;
use App\Models\Wilayah;
use App\Services\FuzzyTimeSeriesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuzzyTimeSeriesController extends Controller
{
    protected $ftsService;

    public function __construct(FuzzyTimeSeriesService $ftsService)
    {
        $this->ftsService = $ftsService;
    }

    public function index()
    {
        $wilayahs = Wilayah::where('status_aktif', true)->get();
        return view('fuzzy-time-series.index', compact('wilayahs'));
    }

    public function data()
    {
        $stuntings = Stunting::with('wilayah')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('fuzzy-time-series.data', compact('stuntings'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'wilayah_id' => 'nullable|exists:wilayahs,ID_Wilayah',
            'tahun_awal' => 'nullable|integer|min:2000|max:2030',
            'tahun_akhir' => 'nullable|integer|min:2000|max:2030',
        ]);

        $wilayahId = $request->input('wilayah_id');
        $tahunAwal = $request->input('tahun_awal');
        $tahunAkhir = $request->input('tahun_akhir');

        // Jalankan perhitungan FTS menggunakan service
        $results = $this->ftsService->runFuzzyTimeSeries($wilayahId, $tahunAwal, $tahunAkhir);

        if (empty($results)) {
            return redirect()->back()
                ->withErrors(['message' => 'Tidak ada data stunting yang ditemukan dengan filter yang diberikan.']);
        }

        return view('fuzzy-time-series.result', compact('results', 'wilayahId', 'tahunAwal', 'tahunAkhir'));
    }

    public function result()
    {
        // Method untuk menampilkan halaman result jika diperlukan
        return view('fuzzy-time-series.result');
    }

    public function show($id)
    {
        $stunting = Stunting::with('wilayah')->findOrFail($id);
        return view('stunting.show', compact('stunting'));
    }
}

