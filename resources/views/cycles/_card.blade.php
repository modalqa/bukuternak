@php use App\Services\CycleSummaryService as CSS; @endphp
<a href="{{ route('cycles.show', $cycle) }}">
    <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow cursor-pointer px-4 py-4">
        <div class="flex items-start justify-between mb-2">
            <div>
                <p class="font-semibold text-sm">{{ $cycle->name }}</p>
                <p class="text-xs text-gray-500">{{ $cycle->livestock_type }}</p>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $cycle->isActive() ? 'bg-[#3c8d5a]/10 text-[#3c8d5a]' : 'bg-gray-100 text-gray-500' }}">
                    {{ $cycle->isActive() ? 'Aktif' : 'Selesai' }}
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </div>
        <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-500">
            <span>Mulai {{ $cycle->start_date->translatedFormat('j M Y') }}</span>
            @if(!$cycle->isActive() && $cycle->end_date)
                <span>Selesai {{ $cycle->end_date->translatedFormat('j M Y') }}</span>
            @endif
            <span>{{ CSS::formatNumber($cycle->initial_count) }} ekor</span>
            <span>Modal {{ CSS::formatCurrency((float)$cycle->initial_capital) }}</span>
        </div>
    </div>
</a>
