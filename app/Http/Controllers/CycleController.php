<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Services\CycleSummaryService;
use Illuminate\Http\Request;

class CycleController extends Controller
{
    public function index()
    {
        $user      = auth()->user();
        $allCycles = Cycle::where('user_id', $user->id)->orderByDesc('created_at')->get();
        $active    = $allCycles->where('status', 'active');
        $finished  = $allCycles->where('status', 'completed');

        return view('cycles.index', compact('allCycles', 'active', 'finished'));
    }

    public function create()
    {
        return view('cycles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:100',
            'livestock_type'  => 'required|string|max:50',
            'start_date'      => 'required|date',
            'initial_count'   => 'required|integer|min:1',
            'initial_capital' => 'required|numeric|min:0',
        ], [
            'name.required'            => 'Nama siklus wajib diisi.',
            'livestock_type.required'  => 'Jenis ternak wajib dipilih.',
            'start_date.required'      => 'Tanggal mulai wajib diisi.',
            'initial_count.required'   => 'Jumlah awal ternak wajib diisi.',
            'initial_count.min'        => 'Jumlah awal minimal 1 ekor.',
            'initial_capital.required' => 'Modal awal wajib diisi.',
            'initial_capital.min'      => 'Modal awal tidak boleh negatif.',
        ]);

        $cycle = Cycle::create([
            'user_id'         => auth()->id(),
            'name'            => $data['name'],
            'livestock_type'  => $data['livestock_type'],
            'start_date'      => $data['start_date'],
            'initial_count'   => $data['initial_count'],
            'initial_capital' => $data['initial_capital'],
        ]);

        return redirect()->route('cycles.show', $cycle)->with('success', 'Siklus berhasil dibuat.');
    }

    public function show(Cycle $cycle)
    {
        $this->authorize('view', $cycle);

        $cycle->load(['feedLogs', 'mortalityLogs', 'expenses', 'sales']);
        $summary = CycleSummaryService::calculate($cycle);

        return view('cycles.show', compact('cycle', 'summary'));
    }

    public function edit(Cycle $cycle)
    {
        $this->authorize('view', $cycle);
        return view('cycles.edit', compact('cycle'));
    }

    public function update(Request $request, Cycle $cycle)
    {
        $this->authorize('view', $cycle);

        $data = $request->validate([
            'name'            => 'required|string|max:100',
            'livestock_type'  => 'required|string|max:50',
            'start_date'      => 'required|date',
            'initial_count'   => 'required|integer|min:1',
            'initial_capital' => 'required|numeric|min:0',
        ], [
            'name.required'            => 'Nama siklus wajib diisi.',
            'livestock_type.required'  => 'Jenis ternak wajib dipilih.',
            'start_date.required'      => 'Tanggal mulai wajib diisi.',
            'initial_count.required'   => 'Jumlah awal ternak wajib diisi.',
            'initial_count.min'        => 'Jumlah awal minimal 1 ekor.',
            'initial_capital.required' => 'Modal awal wajib diisi.',
            'initial_capital.min'      => 'Modal awal tidak boleh negatif.',
        ]);

        $cycle->update($data);

        return redirect()->route('cycles.show', $cycle)->with('success', 'Siklus berhasil diperbarui.');
    }

    public function complete(Cycle $cycle)
    {
        $this->authorize('view', $cycle);

        $cycle->update(['status' => 'completed', 'end_date' => now()->toDateString()]);

        return redirect()->route('cycles.show', $cycle)->with('success', 'Siklus telah diselesaikan.');
    }
}
