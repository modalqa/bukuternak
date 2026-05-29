<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\FeedLog;
use Illuminate\Http\Request;

class FeedLogController extends Controller
{
    public function create(Cycle $cycle)
    {
        $this->authorize('view', $cycle);
        return view('cycles.feed.create', compact('cycle'));
    }

    public function store(Request $request, Cycle $cycle)
    {
        $this->authorize('view', $cycle);

        $data = $request->validate([
            'date'     => 'required|date',
            'quantity' => 'required|numeric|min:0.01',
            'unit'     => 'required|in:kg,karung,sak',
            'cost'     => 'required|numeric|min:0',
            'notes'    => 'nullable|string|max:500',
        ], [
            'date.required'     => 'Tanggal wajib diisi.',
            'quantity.required' => 'Jumlah pakan wajib diisi.',
            'quantity.min'      => 'Jumlah minimal 0.01.',
            'unit.required'     => 'Satuan wajib dipilih.',
            'cost.required'     => 'Biaya wajib diisi.',
            'cost.min'          => 'Biaya tidak boleh negatif.',
        ]);

        FeedLog::create([
            'cycle_id' => $cycle->id,
            'user_id'  => auth()->id(),
            'date'     => $data['date'],
            'quantity' => $data['quantity'],
            'unit'     => $data['unit'],
            'cost'     => $data['cost'],
            'notes'    => $data['notes'] ?? null,
        ]);

        return redirect()->route('cycles.show', $cycle)->with('success', 'Catatan pakan berhasil ditambahkan.');
    }

    public function destroy(Cycle $cycle, FeedLog $feedLog)
    {
        $this->authorize('view', $cycle);
        abort_if($feedLog->user_id !== auth()->id(), 403);
        $feedLog->delete();
        return back()->with('success', 'Catatan pakan dihapus.');
    }
}
