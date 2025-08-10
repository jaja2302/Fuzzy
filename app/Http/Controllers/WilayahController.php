<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wilayahs = Wilayah::orderBy('nama_wilayah')->paginate(10);
        return view('wilayah.index', compact('wilayahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wilayah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_wilayah' => 'required|string|max:255',
            'kode_wilayah' => 'required|string|max:50|unique:wilayahs',
            'deskripsi' => 'nullable|string',
            'provinsi' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'desa' => 'nullable|string|max:100',
            'jumlah_penduduk' => 'nullable|integer|min:0',
            'luas_wilayah' => 'nullable|numeric|min:0',
            'satuan_luas' => 'nullable|string|max:20',
            'status_aktif' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Wilayah::create($request->all());

        return redirect()->route('wilayah.index')
            ->with('success', 'Wilayah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Wilayah $wilayah)
    {
        $stuntings = $wilayah->stuntings()->orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->paginate(10);
        return view('wilayah.show', compact('wilayah', 'stuntings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wilayah $wilayah)
    {
        return view('wilayah.edit', compact('wilayah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wilayah $wilayah)
    {
        $validator = Validator::make($request->all(), [
            'nama_wilayah' => 'required|string|max:255',
            'kode_wilayah' => 'required|string|max:50|unique:wilayahs,kode_wilayah,' . $wilayah->id,
            'deskripsi' => 'nullable|string',
            'provinsi' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'desa' => 'nullable|string|max:100',
            'jumlah_penduduk' => 'nullable|integer|min:0',
            'luas_wilayah' => 'nullable|numeric|min:0',
            'satuan_luas' => 'nullable|string|max:20',
            'status_aktif' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $wilayah->update($request->all());

        return redirect()->route('wilayah.index')
            ->with('success', 'Wilayah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wilayah $wilayah)
    {
        try {
            $wilayah->delete();
            return redirect()->route('wilayah.index')
                ->with('success', 'Wilayah berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('wilayah.index')
                ->with('error', 'Gagal menghapus wilayah. Pastikan tidak ada data stunting yang terkait.');
        }
    }
}
