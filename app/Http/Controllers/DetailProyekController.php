<?php

namespace App\Http\Controllers;

use App\Models\DetailProyek;
use App\Models\Proyek;
use Illuminate\Http\Request;

class DetailProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailProyek = DetailProyek::with('proyek')->get();
        return view('admin.detailproyek.index', compact('detailProyek'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proyek = Proyek::all(); // Fetch all Proyek for dropdown selection
        return view('admin.detailproyek.create', compact('proyek'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jumlah_digunakan' => 'required|integer',
            'tanggal_digunakan' => 'required|date',
            'biaya_penggunaan' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'proyek_id' => 'required|exists:proyeks,id', // Ensures valid Proyek ID
        ]);

        DetailProyek::create($validated);

        return redirect()->route('admin.detailproyek.index')->with('success', 'Detail Proyek berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailProyek $detailProyek)
    {
        $detailProyek->load('proyek');
        return view('admin.detailproyek.show', compact('detailProyek'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailProyek $detailProyek)
    {
        $proyek = Proyek::all(); // Fetch all Proyek for dropdown
        return view('admin.detailproyek.edit', compact('detailProyek', 'proyek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailProyek $detailProyek)
    {
        $validated = $request->validate([
            'jumlah_digunakan' => 'required|integer',
            'tanggal_digunakan' => 'required|date',
            'biaya_penggunaan' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'proyek_id' => 'required|exists:proyeks,id',
        ]);

        $detailProyek->update($validated);

        return redirect()->route('admin.detailproyek.index')->with('success', 'Detail Proyek berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailProyek $detailProyek)
    {
        $detailProyek->delete();

        return redirect()->route('detailproyek.index')->with('success', 'Detail Proyek berhasil dihapus.');
    }
}
