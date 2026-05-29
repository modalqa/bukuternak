@extends('layouts.app')
@section('title', $cycle->name . ' - BukuTernak')

@section('app-content')
@php
    use App\Services\CycleSummaryService as CSS;

    $expenseCategoryLabels = [
        'obat_vitamin' => 'Obat / Vitamin',
        'listrik'      => 'Listrik',
        'air'          => 'Air',
        'transport'    => 'Transport',
        'pekerja'      => 'Pekerja',
        'lain_lain'    => 'Lain-lain',
    ];
    $feedUnitLabels = ['kg' => 'Kg', 'karung' => 'Karung', 'sak' => 'Sak'];
    $isActive = $cycle->isActive();
    $activeTab = request()->query('tab', 'summary');
@endphp

<div class="space-y-5">

    {{-- Header --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('cycles.index') }}" class="h-9 w-9 flex items-center justify-center rounded-xl hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2">
                <h1 class="text-xl font-bold truncate">{{ $cycle->name }}</h1>
                <span class="text-xs px-2 py-0.5 rounded-full font-medium flex-shrink-0 {{ $isActive ? 'bg-[#3c8d5a]/10 text-[#3c8d5a]' : 'bg-gray-100 text-gray-500' }}">
                    {{ $isActive ? 'Aktif' : 'Selesai' }}
                </span>
            </div>
            <p class="text-xs text-gray-500">{{ $cycle->livestock_type }} · {{ CSS::formatNumber($cycle->initial_count) }} ekor · Mulai {{ $cycle->start_date->translatedFormat('j M Y') }}</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('cycles.edit', $cycle) }}" class="text-xs px-3 py-1.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">Edit</a>
            @if($isActive)
            <form method="POST" action="{{ route('cycles.complete', $cycle) }}"
                data-confirm
                data-confirm-title="Selesaikan Siklus"
                data-confirm-desc="Siklus {{ $cycle->name }} akan ditandai selesai. Aksi ini tidak dapat dibatalkan."
                data-confirm-icon="✅"
                data-confirm-ok="Ya, Selesaikan"
                data-confirm-danger="false">
                @csrf
                <button type="submit" class="text-xs px-3 py-1.5 rounded-xl bg-[#3c8d5a] text-white hover:bg-[#337a4e] transition-colors">
                    Selesaikan
                </button>
            </form>
            @endif
        </div>
    </div>

    {{-- KPI Summary --}}
    <div class="grid grid-cols-2 gap-3">
        <div class="bg-orange-50 rounded-2xl p-4">
            <div class="mb-2">
                <span class="inline-block bg-orange-100 text-orange-700 text-xs font-semibold px-2 py-0.5 rounded">Total Biaya</span>
            </div>
            <p class="font-bold text-sm text-gray-900">{{ CSS::formatCurrency($summary['totalCost']) }}</p>
        </div>
        <div class="bg-blue-50 rounded-2xl p-4">
            <div class="mb-2">
                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-0.5 rounded">Penjualan</span>
            </div>
            <p class="font-bold text-sm text-gray-900">{{ CSS::formatCurrency($summary['totalSales']) }}</p>
        </div>
        <div class="rounded-2xl p-4 {{ $summary['profitLoss'] >= 0 ? 'bg-green-50' : 'bg-red-50' }}">
            <div class="mb-2">
                <span class="inline-block {{ $summary['profitLoss'] >= 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} text-xs font-semibold px-2 py-0.5 rounded">Laba/Rugi</span>
            </div>
            <p class="font-bold text-sm {{ $summary['profitLoss'] >= 0 ? 'text-green-700' : 'text-red-600' }}">{{ CSS::formatCurrency($summary['profitLoss']) }}</p>
        </div>
        <div class="bg-red-50 rounded-2xl p-4">
            <div class="mb-2">
                <span class="inline-block bg-red-100 text-red-700 text-xs font-semibold px-2 py-0.5 rounded">Angka Kematian</span>
            </div>
            <p class="font-bold text-sm text-gray-900">{{ $summary['mortalityRate'] }}%</p>
            <p class="text-xs text-gray-500">{{ CSS::formatNumber($summary['totalMortality']) }} ekor</p>
        </div>
    </div>

    {{-- Quick Actions --}}
    @if($isActive)
    <div class="grid grid-cols-4 gap-2">
        @foreach([
            ['href' => route('cycles.feed.create', $cycle), 'emoji' => '🌾', 'label' => 'Pakan'],
            ['href' => route('cycles.mortality.create', $cycle), 'emoji' => '❌', 'label' => 'Mati'],
            ['href' => route('cycles.expenses.create', $cycle), 'emoji' => '💵', 'label' => 'Biaya'],
            ['href' => route('cycles.sales.create', $cycle), 'emoji' => '🛒', 'label' => 'Jual']
        ] as $action)
        <a href="{{ $action['href'] }}" class="bg-[#3c8d5a]/10 hover:bg-[#3c8d5a]/20 rounded-2xl py-3 text-center transition-colors">
            <span class="text-xl block">{{ $action['emoji'] }}</span>
            <span class="text-xs font-medium text-[#3c8d5a] mt-0.5 block">{{ $action['label'] }}</span>
        </a>
        @endforeach
    </div>
    @endif

    {{-- Tabs --}}
    @php
        $tabs = [
            ['key' => 'summary',   'label' => 'Info'],
            ['key' => 'feed',      'label' => 'Pakan'],
            ['key' => 'mortality', 'label' => 'Mati'],
            ['key' => 'expenses',  'label' => 'Biaya'],
            ['key' => 'sales',     'label' => 'Jual'],
        ];
    @endphp

    <div>
        {{-- Tab Nav --}}
        <div class="grid grid-cols-5 rounded-xl bg-gray-100 p-0.5 gap-0.5 mb-4">
            @foreach($tabs as $tab)
            <a href="?tab={{ $tab['key'] }}"
               class="text-center py-1.5 rounded-lg text-xs font-medium transition-colors
                      {{ $activeTab === $tab['key'] ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                {{ $tab['label'] }}
            </a>
            @endforeach
        </div>

        {{-- Tab Content --}}
        @if($activeTab === 'summary')
        <div class="bg-white rounded-2xl shadow-sm">
            <div class="p-5 space-y-2.5 text-sm">
                @include('cycles._summary_row', ['label' => 'Jumlah Awal',        'value' => CSS::formatNumber($summary['initialCount']) . ' ekor'])
                @include('cycles._summary_row', ['label' => 'Modal Awal',         'value' => CSS::formatCurrency($summary['initialCapital'])])
                @include('cycles._summary_row', ['label' => 'Biaya Pakan',        'value' => CSS::formatCurrency($summary['totalFeedCost'])])
                @include('cycles._summary_row', ['label' => 'Biaya Operasional',  'value' => CSS::formatCurrency($summary['totalExpenses'])])
                <hr class="border-gray-100"/>
                @include('cycles._summary_row', ['label' => 'Total Biaya',        'value' => CSS::formatCurrency($summary['totalCost']),   'bold' => true])
                @include('cycles._summary_row', ['label' => 'Total Penjualan',    'value' => CSS::formatCurrency($summary['totalSales']),  'bold' => true])
                <hr class="border-gray-100"/>
                <div class="flex justify-between py-0.5">
                    <span class="text-gray-500 font-semibold">Laba/Rugi</span>
                    <span class="font-bold {{ $summary['profitLoss'] >= 0 ? 'text-green-600' : 'text-red-600' }}">{{ CSS::formatCurrency($summary['profitLoss']) }}</span>
                </div>
                @include('cycles._summary_row', ['label' => 'Total Kematian', 'value' => CSS::formatNumber($summary['totalMortality']) . ' ekor'])
                @if($summary['totalSold'] > 0)
                    @include('cycles._summary_row', ['label' => 'Total Terjual',  'value' => CSS::formatNumber($summary['totalSold']) . ' ekor'])
                @endif
                @if($summary['totalSoldWeight'] > 0)
                    @include('cycles._summary_row', ['label' => 'Total Terjual (berat)', 'value' => CSS::formatNumber($summary['totalSoldWeight']) . ' kg'])
                @endif
                @include('cycles._summary_row', ['label' => 'Sisa Ternak',        'value' => CSS::formatNumber($summary['remainingLivestock']) . ' ekor'])
                @include('cycles._summary_row', ['label' => 'Angka Mortalitas',   'value' => $summary['mortalityRate'] . '%'])
            </div>
        </div>

        @elseif($activeTab === 'feed')
        <div class="space-y-2.5">
            @if($cycle->feedLogs->isEmpty())
                @include('cycles._empty', ['label' => 'Belum ada catatan pakan'])
            @else
                @foreach($cycle->feedLogs as $log)
                <div class="bg-white rounded-2xl shadow-sm px-4 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium">{{ $log->quantity + 0 }} {{ $feedUnitLabels[$log->unit] }} — {{ CSS::formatCurrency((float)$log->cost) }}</p>
                        <p class="text-xs text-gray-500">{{ $log->date->translatedFormat('j M Y') }}{{ $log->notes ? ' · ' . $log->notes : '' }}</p>
                    </div>
                    <form method="POST" action="{{ route('cycles.feed.destroy', [$cycle, $log]) }}"
                        data-confirm
                        data-confirm-title="Hapus Catatan Pakan"
                        data-confirm-desc="Catatan pakan ini akan dihapus permanen."
                        data-confirm-icon="🗑️"
                        data-confirm-ok="Ya, Hapus">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-600 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
                @endforeach
            @endif
        </div>

        @elseif($activeTab === 'mortality')
        <div class="space-y-2.5">
            @if($cycle->mortalityLogs->isEmpty())
                @include('cycles._empty', ['label' => 'Belum ada catatan kematian'])
            @else
                @foreach($cycle->mortalityLogs as $log)
                <div class="bg-white rounded-2xl shadow-sm px-4 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium">{{ CSS::formatNumber($log->count) }} ekor mati</p>
                        <p class="text-xs text-gray-500">{{ $log->date->translatedFormat('j M Y') }}{{ $log->cause ? ' · '.$log->cause : '' }}{{ $log->notes ? ' · '.$log->notes : '' }}</p>
                    </div>
                    <form method="POST" action="{{ route('cycles.mortality.destroy', [$cycle, $log]) }}"
                        data-confirm
                        data-confirm-title="Hapus Catatan Kematian"
                        data-confirm-desc="Catatan kematian ini akan dihapus permanen."
                        data-confirm-icon="🗑️"
                        data-confirm-ok="Ya, Hapus">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-600 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
                @endforeach
            @endif
        </div>

        @elseif($activeTab === 'expenses')
        <div class="space-y-2.5">
            @if($cycle->expenses->isEmpty())
                @include('cycles._empty', ['label' => 'Belum ada catatan biaya'])
            @else
                @foreach($cycle->expenses as $log)
                <div class="bg-white rounded-2xl shadow-sm px-4 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium">{{ $expenseCategoryLabels[$log->category] }} — {{ CSS::formatCurrency((float)$log->amount) }}</p>
                        <p class="text-xs text-gray-500">{{ $log->date->translatedFormat('j M Y') }}{{ $log->notes ? ' · '.$log->notes : '' }}</p>
                    </div>
                    <form method="POST" action="{{ route('cycles.expenses.destroy', [$cycle, $log]) }}"
                        data-confirm
                        data-confirm-title="Hapus Catatan Biaya"
                        data-confirm-desc="Catatan biaya ini akan dihapus permanen."
                        data-confirm-icon="🗑️"
                        data-confirm-ok="Ya, Hapus">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-600 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
                @endforeach
            @endif
        </div>

        @elseif($activeTab === 'sales')
        <div class="space-y-2.5">
            @if($cycle->sales->isEmpty())
                @include('cycles._empty', ['label' => 'Belum ada catatan penjualan'])
            @else
                @foreach($cycle->sales as $log)
                <div class="bg-white rounded-2xl shadow-sm px-4 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium">{{ $log->quantity + 0 }} {{ $log->quantity_unit }} — {{ CSS::formatCurrency((float)$log->total_price) }}</p>
                        <p class="text-xs text-gray-500">{{ $log->date->translatedFormat('j M Y') }}{{ $log->buyer_name ? ' · '.$log->buyer_name : '' }}{{ $log->notes ? ' · '.$log->notes : '' }}</p>
                    </div>
                    <form method="POST" action="{{ route('cycles.sales.destroy', [$cycle, $log]) }}"
                        data-confirm
                        data-confirm-title="Hapus Catatan Penjualan"
                        data-confirm-desc="Catatan penjualan ini akan dihapus permanen."
                        data-confirm-icon="🗑️"
                        data-confirm-ok="Ya, Hapus">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-600 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
                @endforeach
            @endif
        </div>
        @endif

    </div>

</div>
@endsection
