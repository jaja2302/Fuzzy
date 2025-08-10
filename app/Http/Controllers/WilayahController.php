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
        $wilayahs = Wilayah::orderBy('ID_Wilayah', 'desc')->paginate(10);
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
            'Provinsi' => 'required|string|max:100',
            'Kabupaten' => 'required|string|max:100',
            'nama_wilayah' => 'nullable|string|max:255',
            'status_aktif' => 'boolean'
        ], [
            'Provinsi.required' => 'Provinsi harus diisi',
            'Provinsi.max' => 'Provinsi maksimal 100 karakter',
            'Kabupaten.required' => 'Kabupaten harus diisi',
            'Kabupaten.max' => 'Kabupaten maksimal 100 karakter',
            'nama_wilayah.max' => 'Nama wilayah maksimal 255 karakter'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $wilayah = new Wilayah();
            $wilayah->Provinsi = $request->Provinsi;
            $wilayah->Kabupaten = $request->Kabupaten;
            $wilayah->nama_wilayah = $request->nama_wilayah ?: $request->Provinsi . ' - ' . $request->Kabupaten;
            $wilayah->status_aktif = $request->has('status_aktif');
            $wilayah->save();

            return redirect()->route('wilayah.index')
                ->with('success', 'Wilayah berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Wilayah $wilayah)
    {
        $stuntings = $wilayah->stuntings()->orderBy('tahun', 'desc')->paginate(10);
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
            'Provinsi' => 'required|string|max:100',
            'Kabupaten' => 'required|string|max:100',
            'nama_wilayah' => 'nullable|string|max:255',
            'status_aktif' => 'boolean'
        ], [
            'Provinsi.required' => 'Provinsi harus diisi',
            'Provinsi.max' => 'Provinsi maksimal 100 karakter',
            'Kabupaten.required' => 'Kabupaten harus diisi',
            'Kabupaten.max' => 'Kabupaten maksimal 100 karakter',
            'nama_wilayah.max' => 'Nama wilayah maksimal 255 karakter'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $wilayah->Provinsi = $request->Provinsi;
            $wilayah->Kabupaten = $request->Kabupaten;
            $wilayah->nama_wilayah = $request->nama_wilayah ?: $request->Provinsi . ' - ' . $request->Kabupaten;
            $wilayah->status_aktif = $request->has('status_aktif');
            $wilayah->save();

            return redirect()->route('wilayah.index')
                ->with('success', 'Wilayah berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
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
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
