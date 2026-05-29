@extends('layouts.app')
@section('title', 'Dashboard - BukuTernak')

@section('app-content')
@php
    use App\Services\CycleSummaryService as CSS;
@endphp

<div class="space-y-5">

    {{-- Greeting --}}
    <div class="flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm">Selamat datang,</p>
            <h1 class="text-2xl font-bold text-gray-900">Halo, {{ $firstName }} 👋</h1>
        </div>
        <a href="{{ route('cycles.create') }}" class="inline-flex items-center gap-1.5 px-3 h-9 rounded-xl bg-[#3c8d5a] text-white text-sm font-medium shadow-sm hover:bg-[#337a4e] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Siklus Baru
        </a>
    </div>

    {{-- Active cycle badge --}}
    @if($activeCycles->count() > 0)
    <div class="bg-[#3c8d5a]/10 rounded-2xl px-4 py-3 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="h-2 w-2 rounded-full bg-[#3c8d5a] animate-pulse"></div>
            <span class="text-sm font-medium text-[#3c8d5a]">{{ $activeCycles->count() }} Siklus Aktif</span>
        </div>
        <span class="text-xs text-[#3c8d5a]/70">{{ CSS::formatNumber($totalInitialCount) }} ekor total</span>
    </div>
    @endif

    {{-- KPI Grid --}}
    <div class="grid grid-cols-2 gap-3">
        <div class="bg-green-50 rounded-2xl p-4">
            <div class="mb-2">
                <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2 py-0.5 rounded">Ternak Tersisa</span>
            </div>
            <p class="text-base font-bold text-gray-900">{{ CSS::formatNumber($remainingLivestock) }}</p>
            <p class="text-xs text-gray-500">dari {{ CSS::formatNumber($totalInitialCount) }} ekor</p>
        </div>
        <div class="bg-red-50 rounded-2xl p-4">
            <div class="mb-2">
                <span class="inline-block bg-red-100 text-red-700 text-xs font-semibold px-2 py-0.5 rounded">Total Mati</span>
            </div>
            <p class="text-base font-bold text-gray-900">{{ CSS::formatNumber($totalMortality) }}</p>
            <p class="text-xs text-gray-500">ekor</p>
        </div>
        <div class="bg-orange-50 rounded-2xl p-4">
            <div class="mb-2">
                <span class="inline-block bg-orange-100 text-orange-700 text-xs font-semibold px-2 py-0.5 rounded">Total Biaya</span>
            </div>
            <p class="text-base font-bold text-gray-900">{{ CSS::formatCurrency($totalCost) }}</p>
        </div>
        <div class="rounded-2xl p-4 {{ $profitLoss >= 0 ? 'bg-green-50' : 'bg-red-50' }}">
            <div class="mb-2">
                <span class="inline-block {{ $profitLoss >= 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} text-xs font-semibold px-2 py-0.5 rounded">Laba/Rugi</span>
            </div>
            <p class="text-base font-bold {{ $profitLoss >= 0 ? 'text-green-700' : 'text-red-600' }}">{{ CSS::formatCurrency($profitLoss) }}</p>
        </div>
    </div>

    {{-- Siklus Aktif --}}
    <div>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-base font-semibold">Siklus Aktif</h2>
            <a href="{{ route('cycles.index') }}" class="text-xs text-[#3c8d5a] font-medium flex items-center gap-0.5">
                Lihat semua
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if($activeCycles->isEmpty())
            <div class="bg-white rounded-2xl shadow-sm p-10 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7m16 0L12 11 4 7"/></svg>
                <p class="text-sm text-gray-500 mb-4">Belum ada siklus aktif.</p>
                <a href="{{ route('cycles.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#3c8d5a] text-white text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Buat Siklus
                </a>
            </div>
        @else
            <div class="space-y-3">
                @foreach($activeCycles->take(3) as $cycle)
                <div class="bg-white rounded-2xl shadow-sm p-4">
                    <a href="{{ route('cycles.show', $cycle) }}" class="block mb-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-sm">{{ $cycle->name }}</p>
                                <p class="text-xs text-gray-500">{{ $cycle->livestock_type }} · {{ $cycle->start_date->translatedFormat('j M Y') }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="bg-[#3c8d5a]/10 text-[#3c8d5a] text-xs px-2 py-0.5 rounded-full font-medium">Aktif</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </a>
                    {{-- Quick actions --}}
                    <div class="grid grid-cols-4 gap-1.5">
                        @foreach([
                            ['url' => route('cycles.feed.create', $cycle), 'label' => 'Pakan', 'emoji' => '🌾'],
                            ['url' => route('cycles.mortality.create', $cycle), 'label' => 'Mati', 'emoji' => null],
                            ['url' => route('cycles.expenses.create', $cycle), 'label' => 'Biaya', 'emoji' => '💰'],
                            ['url' => route('cycles.sales.create', $cycle), 'label' => 'Jual', 'emoji' => '🛒']
                        ] as $action)
                        <a href="{{ $action['url'] }}" class="bg-[#3c8d5a]/10 hover:bg-[#3c8d5a]/20 rounded-xl py-2.5 text-center transition-colors">
                            @if($action['label'] === 'Mati')
                                <span class="text-lg block">❌</span>
                            @elseif($action['emoji'])
                                <span class="text-lg block">{{ $action['emoji'] }}</span>
                            @endif
                            <span class="text-[10px] font-medium text-[#3c8d5a] block">{{ $action['label'] }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection
