<?php

namespace App\Services;

use App\Models\Cycle;

class CycleSummaryService
{
    public static function calculate(Cycle $cycle): array
    {
        $feedLogs     = $cycle->feedLogs;
        $mortalityLogs = $cycle->mortalityLogs;
        $expenses     = $cycle->expenses;
        $sales        = $cycle->sales;

        $totalFeedCost  = $feedLogs->sum(fn($f) => (float)$f->cost);
        $totalExpenses  = $expenses->sum(fn($e) => (float)$e->amount);
        $totalSales     = $sales->sum(fn($s) => (float)$s->total_price);
        $totalMortality = $mortalityLogs->sum('count');

        $totalSold = $sales
            ->filter(fn($s) => $s->quantity_unit === 'ekor')
            ->sum(fn($s) => (float)$s->quantity);

        $totalSoldWeight = $sales
            ->filter(fn($s) => $s->quantity_unit === 'kg')
            ->sum(fn($s) => (float)$s->quantity);

        $initialCapital = (float)$cycle->initial_capital;
        $initialCount   = $cycle->initial_count;

        $totalCost          = $initialCapital + $totalFeedCost + $totalExpenses;
        $remainingLivestock = $initialCount - $totalMortality - $totalSold;
        $mortalityRate      = $initialCount > 0 ? round(($totalMortality / $initialCount) * 100, 2) : 0;
        $profitLoss         = $totalSales - $totalCost;

        return compact(
            'initialCount', 'initialCapital',
            'totalFeedCost', 'totalExpenses', 'totalCost',
            'totalSales', 'totalMortality', 'totalSold', 'totalSoldWeight',
            'remainingLivestock', 'mortalityRate', 'profitLoss'
        );
    }

    public static function formatCurrency(float $amount): string
    {
        $formatted = number_format(abs($amount), 0, ',', '.');
        return ($amount < 0 ? '-' : '') . 'Rp' . $formatted;
    }

    public static function formatNumber(float $num): string
    {
        return number_format($num, 0, ',', '.');
    }
}
