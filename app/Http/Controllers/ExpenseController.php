<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function create(Cycle $cycle)
    {
        $this->authorize('view', $cycle);
        return view('cycles.expenses.create', compact('cycle'));
    }

    public function store(Request $request, Cycle $cycle)
    {
        $this->authorize('view', $cycle);

        $data = $request->validate([
            'date'     => 'required|date',
            'category' => 'required|in:obat_vitamin,listrik,air,transport,pekerja,lain_lain',
            'amount'   => 'required|numeric|min:0',
            'notes'    => 'nullable|string|max:500',
        ], [
            'date.required'     => 'Tanggal wajib diisi.',
            'category.required' => 'Kategori biaya wajib dipilih.',
            'amount.required'   => 'Jumlah biaya wajib diisi.',
            'amount.min'        => 'Biaya tidak boleh negatif.',
        ]);

        Expense::create([
            'cycle_id' => $cycle->id,
            'user_id'  => auth()->id(),
            'date'     => $data['date'],
            'category' => $data['category'],
            'amount'   => $data['amount'],
            'notes'    => $data['notes'] ?? null,
        ]);

        return redirect()->route('cycles.show', $cycle)->with('success', 'Catatan biaya berhasil ditambahkan.');
    }

    public function destroy(Cycle $cycle, Expense $expense)
    {
        $this->authorize('view', $cycle);
        abort_if($expense->user_id !== auth()->id(), 403);
        $expense->delete();
        return back()->with('success', 'Catatan biaya dihapus.');
    }
}
