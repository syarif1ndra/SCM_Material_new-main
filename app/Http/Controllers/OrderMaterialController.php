<?php

namespace App\Http\Controllers;

use App\Models\OrderMaterial;
use App\Models\Material;
use App\Models\MaterialPemasok;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class OrderMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderMaterials = OrderMaterial::with(['material', 'pengiriman'])->get();
        return view('admin.order-material.index', compact('orderMaterials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materials = MaterialPemasok::all(); // Data untuk dropdown material
        $pengirimen = Pengiriman::all(); // Data untuk dropdown pengiriman
        return view('admin.order-material.create', compact('materials', 'pengirimen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jumlah_order' => 'required|integer|min:1',
            'tanggal_order' => 'required|date',
            'keterangan' => 'nullable|string',
            'material_id' => 'required|exists:materials,id',
            'pengiriman_id' => 'nullable|exists:pengirimen,id',
            'harga_total' => 'required|numeric|min:0',
        ]);

        OrderMaterial::create($validated);

        return redirect()->route('admin.order-material.index')->with('success', 'Order material berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderMaterial $orderMaterial)
    {
        $orderMaterial->load(['material', 'pengiriman']);
        return view('admin.order-material.show', compact('orderMaterial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderMaterial $orderMaterial)
    {
        $materials = MaterialPemasok::all(); // Data untuk dropdown material
        $pengirimen = Pengiriman::all(); // Data untuk dropdown pengiriman
        return view('admin.order-material.edit', compact('orderMaterial', 'materials', 'pengirimen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderMaterial $orderMaterial)
    {
        $validated = $request->validate([
            'jumlah_order' => 'required|integer|min:1',
            'tanggal_order' => 'required|date',
            'keterangan' => 'nullable|string',
            'material_id' => 'required|exists:materials,id',
            'pengiriman_id' => 'nullable|exists:pengirimen,id',
            'harga_total' => 'required|numeric|min:0',
        ]);

        $orderMaterial->update($validated);

        return redirect()->route('admin.order-material.index')->with('success', 'Order material berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderMaterial $orderMaterial)
    {
        $orderMaterial->delete();

        return redirect()->route('admin.order-material.index')->with('success', 'Order material berhasil dihapus.');
    }
}
