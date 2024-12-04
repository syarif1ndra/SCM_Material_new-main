<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialPemasok;
use App\Models\Pemasok;
use Illuminate\Http\Request;

class MaterialPemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = MaterialPemasok::with('pemasok')->get();
        return view('user.material.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pemasoks = Pemasok::all(); // Ambil semua data pemasok untuk dropdown
        return view('user.material.create', compact('pemasoks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_material' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'jenis_material' => 'required|string|max:100',
            'pemasok_id' => 'required|exists:pemasoks,id',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        MaterialPemasok::create($validated);

        return redirect()->route('user.material.index')->with('success', 'Material berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MaterialPemasok $material)
    {
        $material->load('pemasok');
        return view('user.material.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaterialPemasok $material)
    {
        $pemasoks = Pemasok::all(); // Ambil semua data pemasok untuk dropdown
        return view('user.material.edit', compact('material', 'pemasoks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaterialPemasok $material)
    {
        $validated = $request->validate([
            'nama_material' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'jenis_material' => 'required|string|max:100',
            'pemasok_id' => 'required|exists:pemasoks,id',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        $material->update($validated);

        return redirect()->route('user.material.index')->with('success', 'Material berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaterialPemasok $material)
    {
        $material->delete();

        return redirect()->route('user.material.index')->with('success', 'Material berhasil dihapus.');
    }
}
