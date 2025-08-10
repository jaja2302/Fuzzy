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
        $wilayahs = Wilayah::orderBy('Kabupaten')->paginate(10);
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
            'nama_wilayah' => 'nullable|string|max:200',
            'status_aktif' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['status_aktif'] = $request->has('status_aktif') ? true : false;
        
        Wilayah::create($data);

        return redirect()->route('wilayah.index')
            ->with('success', 'Wilayah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $wilayah = Wilayah::where('ID_Wilayah', $id)->firstOrFail();
        $stuntings = $wilayah->stuntings()->orderBy('tahun', 'desc')->paginate(10);
        return view('wilayah.show', compact('wilayah', 'stuntings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $wilayah = Wilayah::where('ID_Wilayah', $id)->firstOrFail();
        return view('wilayah.edit', compact('wilayah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $wilayah = Wilayah::where('ID_Wilayah', $id)->firstOrFail();
        
        $validator = Validator::make($request->all(), [
            'Provinsi' => 'required|string|max:100',
            'Kabupaten' => 'required|string|max:100',
            'nama_wilayah' => 'nullable|string|max:200',
            'status_aktif' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['status_aktif'] = $request->has('status_aktif') ? true : false;
        
        $wilayah->update($data);

        return redirect()->route('wilayah.index')
            ->with('success', 'Wilayah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource in storage.
     */
    public function destroy($id)
    {
        try {
            $wilayah = Wilayah::where('ID_Wilayah', $id)->firstOrFail();
            $wilayah->delete();
            return redirect()->route('wilayah.index')
                ->with('success', 'Wilayah berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('wilayah.index')
                ->with('error', 'Gagal menghapus wilayah. Pastikan tidak ada data stunting yang terkait.');
        }
    }
}
