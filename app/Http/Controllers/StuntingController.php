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
        if ($request->filled('id_wilayah')) {
            $query->where('id_wilayah', $request->id_wilayah);
        }
        
        // Filter by tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }
        
        $stuntings = $query->orderBy('tahun', 'desc')
                           ->paginate(15);
        
        $wilayahs = Wilayah::orderBy('Kabupaten')->get();
        
        return view('stunting.index', compact('stuntings', 'wilayahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wilayahs = Wilayah::orderBy('Kabupaten')->get();
        return view('stunting.create', compact('wilayahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_wilayah' => 'required|exists:wilayahs,ID_Wilayah',
            'tahun' => 'required|integer',
            'jumlah_stunting' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check for duplicate data
        $existing = Stunting::where('id_wilayah', $request->id_wilayah)
                           ->where('tahun', $request->tahun)
                           ->first();
        
        if ($existing) {
            return redirect()->back()
                ->withErrors(['duplicate' => 'Data stunting untuk wilayah dan tahun ini sudah ada.'])
                ->withInput();
        }

        Stunting::create([
            'id_wilayah' => $request->id_wilayah,
            'tahun' => $request->tahun,
            'jumlah_stunting' => $request->jumlah_stunting
        ]);

        return redirect()->route('stunting.index')
            ->with('success', 'Data stunting berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_stunting)
    {
        $stunting = Stunting::where('id_stunting', $id_stunting)->firstOrFail();
        return view('stunting.show', compact('stunting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_stunting)
    {
        $stunting = Stunting::where('id_stunting', $id_stunting)->firstOrFail();
        $wilayahs = Wilayah::orderBy('Kabupaten')->get();
        return view('stunting.edit', compact('stunting', 'wilayahs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_stunting)
    {
        $stunting = Stunting::where('id_stunting', $id_stunting)->firstOrFail();
        
        $validator = Validator::make($request->all(), [
            'id_wilayah' => 'required|exists:wilayahs,ID_Wilayah',
            'tahun' => 'required|integer',
            'jumlah_stunting' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check for duplicate data (excluding current record)
        $existing = Stunting::where('id_wilayah', $request->id_wilayah)
                           ->where('tahun', $request->tahun)
                           ->where('id_stunting', '!=', $id_stunting)
                           ->first();
        
        if ($existing) {
            return redirect()->back()
                ->withErrors(['duplicate' => 'Data stunting untuk wilayah dan tahun ini sudah ada.'])
                ->withInput();
        }

        $stunting->update([
            'id_wilayah' => $request->id_wilayah,
            'tahun' => $request->tahun,
            'jumlah_stunting' => $request->jumlah_stunting
        ]);

        return redirect()->route('stunting.index')
            ->with('success', 'Data stunting berhasil diperbarui.');
    }

    /**
     * Remove the specified resource in storage.
     */
    public function destroy($id_stunting)
    {
        $stunting = Stunting::where('id_stunting', $id_stunting)->firstOrFail();
        $stunting->delete();
        return redirect()->route('stunting.index')
            ->with('success', 'Data stunting berhasil dihapus!');
    }
}
