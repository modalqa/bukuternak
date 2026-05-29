<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\FeedLog;
use App\Models\MortalityLog;
use App\Models\Expense;
use App\Models\Sale;
use App\Services\CycleSummaryService;

class LaporanController extends Controller
{
    public function index()
    {
        $user      = auth()->user();
        $allCycles = Cycle::where('user_id', $user->id)->orderByDesc('created_at')->get();

        $cyclesWithSummary = $allCycles->map(function ($cycle) use ($user) {
            $totalFeedCost  = (float) FeedLog::where('cycle_id', $cycle->id)->sum('cost');
            $totalExpenses  = (float) Expense::where('cycle_id', $cycle->id)->sum('amount');
            $totalSales     = (float) Sale::where('cycle_id', $cycle->id)->sum('total_price');
            $totalCost      = (float)$cycle->initial_capital + $totalFeedCost + $totalExpenses;
            $profitLoss     = $totalSales - $totalCost;

            return [
                'cycle'      => $cycle,
                'totalCost'  => $totalCost,
                'totalSales' => $totalSales,
                'profitLoss' => $profitLoss,
            ];
        });

        return view('laporan', compact('cyclesWithSummary'));
    }
}
