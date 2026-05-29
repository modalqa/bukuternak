<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\FeedLog;
use App\Models\MortalityLog;
use App\Models\Expense;
use App\Models\Sale;
use App\Services\CycleSummaryService;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user         = auth()->user();
        $allCycles    = Cycle::where('user_id', $user->id)->orderByDesc('created_at')->get();
        $activeCycles = $allCycles->where('status', 'active');

        $totalInitialCount  = 0;
        $totalFeedCost      = 0;
        $totalExpenseAmount = 0;
        $totalSaleAmount    = 0;
        $totalMortality     = 0;
        $totalSold          = 0;

        foreach ($activeCycles as $cycle) {
            $totalInitialCount  += $cycle->initial_count;
            $totalFeedCost      += (float) FeedLog::where('cycle_id', $cycle->id)->sum('cost');
            $totalExpenseAmount += (float) Expense::where('cycle_id', $cycle->id)->sum('amount');
            $totalSaleAmount    += (float) Sale::where('cycle_id', $cycle->id)->sum('total_price');
            $totalMortality     += (int) MortalityLog::where('cycle_id', $cycle->id)->sum('count');
            $totalSold          += (float) Sale::where('cycle_id', $cycle->id)->where('quantity_unit', 'ekor')->sum('quantity');
        }

        $totalCapital       = $activeCycles->sum(fn($c) => (float)$c->initial_capital);
        $totalCost          = $totalCapital + $totalFeedCost + $totalExpenseAmount;
        $profitLoss         = $totalSaleAmount - $totalCost;
        $remainingLivestock = $totalInitialCount - $totalMortality - $totalSold;

        $firstName = explode(' ', $user->name)[0] ?? 'Peternak';

        return view('dashboard', compact(
            'user', 'activeCycles', 'allCycles',
            'totalInitialCount', 'totalCost', 'totalSaleAmount',
            'profitLoss', 'totalMortality', 'totalSold',
            'remainingLivestock', 'firstName'
        ));
    }
}
