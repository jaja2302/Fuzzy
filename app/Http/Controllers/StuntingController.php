<?php

namespace App\Http\Controllers;

use App\Models\Stunting;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StuntingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Stunting::with('wilayah');
        
        // Filter by wilayah
        if ($request->filled('wilayah_id')) {
            $query->where('wilayah_id', $request->wilayah_id);
        }
        
        // Filter by tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }
        
        $stuntings = $query->orderBy('tahun', 'desc')
                           ->orderBy('bulan', 'desc')
                           ->paginate(15);
        
        $wilayahs = Wilayah::orderBy('nama_wilayah')->get();
        
        return view('stunting.index', compact('stuntings', 'wilayahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wilayahs = Wilayah::where('status_aktif', true)->orderBy('nama_wilayah')->get();
        return view('stunting.create', compact('wilayahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wilayah_id' => 'required|exists:wilayahs,id',
            'tahun' => 'required|integer|min:2000|max:2030',
            'bulan' => 'nullable|integer|min:1|max:12',
            'jumlah_stunting' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check for duplicate data
        $existing = Stunting::where('wilayah_id', $request->wilayah_id)
                           ->where('tahun', $request->tahun)
                           ->where('bulan', $request->bulan)
                           ->first();
        
        if ($existing) {
            return redirect()->back()
                ->withErrors(['bulan' => 'Data untuk wilayah, tahun, dan bulan ini sudah ada.'])
                ->withInput();
        }

        Stunting::create($request->all());

        return redirect()->route('stunting.index')
            ->with('success', 'Data stunting berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stunting $stunting)
    {
        return view('stunting.show', compact('stunting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stunting $stunting)
    {
        $wilayahs = Wilayah::where('status_aktif', true)->orderBy('nama_wilayah')->get();
        return view('stunting.edit', compact('stunting', 'wilayahs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stunting $stunting)
    {
        $validator = Validator::make($request->all(), [
            'wilayah_id' => 'required|exists:wilayahs,id',
            'tahun' => 'required|integer|min:2000|max:2030',
            'bulan' => 'nullable|integer|min:1|max:12',
            'jumlah_stunting' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check for duplicate data (excluding current record)
        $existing = Stunting::where('wilayah_id', $request->wilayah_id)
                           ->where('tahun', $request->tahun)
                           ->where('bulan', $request->bulan)
                           ->where('id', '!=', $stunting->id)
                           ->first();
        
        if ($existing) {
            return redirect()->back()
                ->withErrors(['bulan' => 'Data untuk wilayah, tahun, dan bulan ini sudah ada.'])
                ->withInput();
        }

        $stunting->update($request->all());

        return redirect()->route('stunting.index')
            ->with('success', 'Data stunting berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stunting $stunting)
    {
        $stunting->delete();
        return redirect()->route('stunting.index')
            ->with('success', 'Data stunting berhasil dihapus!');
    }
}
