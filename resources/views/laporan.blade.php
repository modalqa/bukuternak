@extends('layouts.app')
@section('title', 'Laporan - BukuTernak')

@section('app-content')
@php use App\Services\CycleSummaryService as CSS; @endphp

<div class="space-y-5">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Laporan</h1>
        <p class="text-sm text-gray-500 mt-0.5">Ringkasan semua siklus ternak</p>
    </div>

    @if($cyclesWithSummary->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            <p class="text-gray-400 text-sm">Belum ada data untuk dilaporkan.</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach($cyclesWithSummary as $item)
            @php $cycle = $item['cycle']; @endphp
            <a href="{{ route('cycles.show', $cycle) }}" class="block">
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="font-semibold text-sm">{{ $cycle->name }}</p>
                            <p class="text-xs text-gray-500">{{ $cycle->livestock_type }} · {{ $cycle->start_date->translatedFormat('j M Y') }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $cycle->isActive() ? 'bg-[#3c8d5a]/10 text-[#3c8d5a]' : 'bg-gray-100 text-gray-500' }}">
                                {{ $cycle->isActive() ? 'Aktif' : 'Selesai' }}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-2 text-center">
                        <div class="bg-gray-50 rounded-xl py-2">
                            <p class="text-xs text-gray-500">Biaya</p>
                            <p class="text-sm font-semibold text-gray-900">{{ CSS::formatCurrency($item['totalCost']) }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl py-2">
                            <p class="text-xs text-gray-500">Penjualan</p>
                            <p class="text-sm font-semibold text-gray-900">{{ CSS::formatCurrency($item['totalSales']) }}</p>
                        </div>
                        <div class="rounded-xl py-2 {{ $item['profitLoss'] >= 0 ? 'bg-green-50' : 'bg-red-50' }}">
                            <p class="text-xs text-gray-500">Laba/Rugi</p>
                            <p class="text-sm font-semibold {{ $item['profitLoss'] >= 0 ? 'text-green-700' : 'text-red-600' }}">{{ CSS::formatCurrency($item['profitLoss']) }}</p>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
