<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\MortalityLog;
use Illuminate\Http\Request;

class MortalityLogController extends Controller
{
    public function create(Cycle $cycle)
    {
        $this->authorize('view', $cycle);
        return view('cycles.mortality.create', compact('cycle'));
    }

    public function store(Request $request, Cycle $cycle)
    {
        $this->authorize('view', $cycle);

        $data = $request->validate([
            'date'  => 'required|date',
            'count' => 'required|integer|min:1',
            'cause' => 'nullable|string|max:200',
            'notes' => 'nullable|string|max:500',
        ], [
            'date.required'  => 'Tanggal wajib diisi.',
            'count.required' => 'Jumlah kematian wajib diisi.',
            'count.min'      => 'Minimal 1 ekor.',
        ]);

        MortalityLog::create([
            'cycle_id' => $cycle->id,
            'user_id'  => auth()->id(),
            'date'     => $data['date'],
            'count'    => $data['count'],
            'cause'    => $data['cause'] ?? null,
            'notes'    => $data['notes'] ?? null,
        ]);

        return redirect()->route('cycles.show', $cycle)->with('success', 'Catatan kematian berhasil ditambahkan.');
    }

    public function destroy(Cycle $cycle, MortalityLog $mortalityLog)
    {
        $this->authorize('view', $cycle);
        abort_if($mortalityLog->user_id !== auth()->id(), 403);
        $mortalityLog->delete();
        return back()->with('success', 'Catatan kematian dihapus.');
    }
}
