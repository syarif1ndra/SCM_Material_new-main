<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Proyek;
use App\Models\DetailProyek;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporan = Laporan::with(['proyek', 'detailproyek'])->get();
        return view('admin.laporan.index', compact('laporan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proyek = Proyek::all(); // Ambil semua data proyek
        $detailProyek = DetailProyek::all(); // Ambil semua data detail proyek
        return view('admin.laporan.create', compact('proyek', 'detailProyek'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_laporan' => 'required|date',
            'file_path' => 'required|string|max:255',
            'proyek_id' => 'required|exists:proyeks,id', // Validasi ID proyek
            'detailproyek_id' => 'required|exists:detail_proyeks,id', // Validasi ID detail proyek
        ]);

        Laporan::create($validated);

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        $laporan->load(['proyek', 'detailproyek']);
        return view('admin.laporan.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        $proyek = Proyek::all(); // Ambil semua proyek untuk dropdown
        $detailProyek = DetailProyek::all(); // Ambil semua detail proyek untuk dropdown
        return view('admin.laporan.edit', compact('laporan', 'proyek', 'detailProyek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        $validated = $request->validate([
            'tanggal_laporan' => 'required|date',
            'file_path' => 'required|string|max:255',
            'proyek_id' => 'required|exists:proyeks,id',
            'detailproyek_id' => 'required|exists:detail_proyeks,id',
        ]);

        $laporan->update($validated);

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        $laporan->delete();

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
