<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function create(Cycle $cycle)
    {
        $this->authorize('view', $cycle);
        return view('cycles.sales.create', compact('cycle'));
    }

    public function store(Request $request, Cycle $cycle)
    {
        $this->authorize('view', $cycle);

        $data = $request->validate([
            'date'          => 'required|date',
            'quantity'      => 'required|numeric|min:0.01',
            'quantity_unit' => 'required|in:ekor,kg',
            'total_price'   => 'required|numeric|min:0',
            'buyer_name'    => 'nullable|string|max:100',
            'notes'         => 'nullable|string|max:500',
        ], [
            'date.required'          => 'Tanggal wajib diisi.',
            'quantity.required'      => 'Jumlah wajib diisi.',
            'quantity.min'           => 'Jumlah minimal 0.01.',
            'quantity_unit.required' => 'Satuan wajib dipilih.',
            'total_price.required'   => 'Total harga wajib diisi.',
            'total_price.min'        => 'Harga tidak boleh negatif.',
        ]);

        Sale::create([
            'cycle_id'      => $cycle->id,
            'user_id'       => auth()->id(),
            'date'          => $data['date'],
            'quantity'      => $data['quantity'],
            'quantity_unit' => $data['quantity_unit'],
            'total_price'   => $data['total_price'],
            'buyer_name'    => $data['buyer_name'] ?? null,
            'notes'         => $data['notes'] ?? null,
        ]);

        return redirect()->route('cycles.show', $cycle)->with('success', 'Catatan penjualan berhasil ditambahkan.');
    }

    public function destroy(Cycle $cycle, Sale $sale)
    {
        $this->authorize('view', $cycle);
        abort_if($sale->user_id !== auth()->id(), 403);
        $sale->delete();
        return back()->with('success', 'Catatan penjualan dihapus.');
    }
}
