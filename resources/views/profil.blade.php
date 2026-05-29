@extends('layouts.app')
@section('title', 'Profil - BukuTernak')

@section('app-content')
@php use App\Services\CycleSummaryService as CSS; @endphp

<div class="space-y-5">
    <h1 class="text-2xl font-bold">Profil</h1>

    {{-- Avatar & name --}}
    <div class="bg-white rounded-2xl shadow-sm py-6 flex flex-col items-center gap-3">
        <div class="h-16 w-16 rounded-full bg-[#3c8d5a]/10 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#3c8d5a]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <div class="text-center">
            <p class="text-lg font-bold">{{ $user->name }}</p>
            <p class="text-sm text-gray-500">{{ $user->email }}</p>
        </div>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-3 gap-3">
        <div class="bg-white rounded-2xl shadow-sm py-4 text-center">
            <p class="text-xl font-bold text-[#3c8d5a]">{{ CSS::formatNumber($allCycles->count()) }}</p>
            <p class="text-xs text-gray-500 mt-0.5">Total Siklus</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm py-4 text-center">
            <p class="text-xl font-bold text-[#3c8d5a]">{{ CSS::formatNumber($activeCycles->count()) }}</p>
            <p class="text-xs text-gray-500 mt-0.5">Aktif</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm py-4 text-center">
            <p class="text-xl font-bold text-[#3c8d5a]">{{ CSS::formatNumber($completedCycles->count()) }}</p>
            <p class="text-xs text-gray-500 mt-0.5">Selesai</p>
        </div>
    </div>

    {{-- Info --}}
    <div class="bg-white rounded-2xl shadow-sm p-4 space-y-3">
        <div class="flex items-center gap-3">
            <div class="h-8 w-8 rounded-lg bg-[#3c8d5a]/10 flex items-center justify-center flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#3c8d5a]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Nama</p>
                <p class="text-sm font-medium">{{ $user->name }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="h-8 w-8 rounded-lg bg-[#3c8d5a]/10 flex items-center justify-center flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#3c8d5a]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Email</p>
                <p class="text-sm font-medium">{{ $user->email }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="h-8 w-8 rounded-lg bg-[#3c8d5a]/10 flex items-center justify-center flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#3c8d5a]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Versi</p>
                <p class="text-sm font-medium">BukuTernak MVP 1.0</p>
            </div>
        </div>
    </div>

    {{-- Plan --}}
    <div class="space-y-3">
        <h2 class="text-base font-semibold">Paket Langganan</h2>

        <div class="bg-white rounded-2xl border-2 border-[#3c8d5a] p-4 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#3c8d5a]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span class="font-semibold text-sm">Free</span>
                </div>
                <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-[#3c8d5a]/10 text-[#3c8d5a]">Paket Kamu Sekarang</span>
            </div>
            <p class="text-xs text-gray-500">Gratis selamanya</p>
            <ul class="space-y-2">
                @foreach([
                    ['label' => 'Buat & kelola siklus ternak',  'ok' => true],
                    ['label' => 'Catat pakan harian',            'ok' => true],
                    ['label' => 'Catat kematian ternak',         'ok' => true],
                    ['label' => 'Catat biaya operasional',       'ok' => true],
                    ['label' => 'Catat penjualan',               'ok' => true],
                    ['label' => 'Dashboard ringkasan',            'ok' => true],
                    ['label' => 'Laporan detail per siklus',     'ok' => true],
                    ['label' => 'Katalog peternak',              'ok' => false],
                    ['label' => 'Pembelian pakan online',        'ok' => false],
                    ['label' => 'Pembelian bibit ternak',        'ok' => false],
                ] as $item)
                <li class="flex items-center gap-2.5 text-sm">
                    @if($item['ok'])
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#3c8d5a] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-gray-800">{{ $item['label'] }}</span>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-gray-400">{{ $item['label'] }} <span class="text-amber-500 text-xs font-medium">segera hadir</span></span>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}"
        data-confirm
        data-confirm-title="Keluar dari BukuTernak"
        data-confirm-desc="Kamu akan keluar dari akun ini."
        data-confirm-icon="🚪"
        data-confirm-ok="Ya, Keluar"
        data-confirm-danger="false">
        @csrf
        <button type="submit" class="w-full h-12 rounded-xl border border-red-200 text-red-600 font-medium text-sm hover:bg-red-50 transition-colors">
            Keluar
        </button>
    </form>
</div>
@endsection
