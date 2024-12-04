<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyeks = Proyek::all();
        return view('admin.proyek.index', compact('proyeks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.proyek.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'status' => 'required|in:aktif,selesai,tertunda',
            'lokasi' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
        ]);

        Proyek::create($validated);

        return redirect()->route('admin.proyek.index')->with('success', 'Proyek berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyek $proyek)
    {
        return view('admin.proyek.show', compact('proyek'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyek $proyek)
    {
        return view('admin.proyek.edit', compact('proyek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyek $proyek)
    {
        $validated = $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'status' => 'required|in:aktif,selesai,tertunda',
            'lokasi' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
        ]);

        $proyek->update($validated);

        return redirect()->route('admin.proyek.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyek $proyek)
    {
        $proyek->delete();

        return redirect()->route('admin.proyek.index')->with('success', 'Proyek berhasil dihapus.');
    }
}

