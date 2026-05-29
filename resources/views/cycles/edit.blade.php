@extends('layouts.app')
@section('title', 'Edit Siklus - BukuTernak')

@section('app-content')
@php
    $livestockTypes = ['Ayam Kampung','Ayam Pedaging','Lele','Bebek','Puyuh','Kambing','Sapi','Lainnya'];
@endphp
<div>
    <div class="flex items-center gap-2 mb-5">
        <a href="{{ route('cycles.show', $cycle) }}" class="h-9 w-9 flex items-center justify-center rounded-xl hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-xl font-bold">Edit Siklus</h1>
            <p class="text-xs text-gray-500">{{ $cycle->name }}</p>
        </div>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-4">{{ $errors->first() }}</div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <form method="POST" action="{{ route('cycles.update', $cycle) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Nama Siklus</label>
                <input name="name" type="text" placeholder="Contoh: Ayam Batch 1" required value="{{ old('name', $cycle->name) }}"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
            </div>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Jenis Ternak</label>
                <select name="livestock_type" required
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a] bg-white">
                    <option value="">Pilih jenis ternak</option>
                    @foreach($livestockTypes as $type)
                        <option value="{{ $type }}" {{ old('livestock_type', $cycle->livestock_type) === $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input name="start_date" type="date" required value="{{ old('start_date', $cycle->start_date->format('Y-m-d')) }}"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
            </div>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Jumlah Awal (ekor)</label>
                <input name="initial_count" type="number" min="1" placeholder="100" required value="{{ old('initial_count', $cycle->initial_count) }}"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
            </div>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Modal Awal (Rp)</label>
                <input name="initial_capital" type="number" min="0" step="0.01" placeholder="5000000" required value="{{ old('initial_capital', $cycle->initial_capital) }}"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
            </div>
            <button type="submit" class="w-full h-12 rounded-xl bg-[#3c8d5a] text-white font-medium text-sm hover:bg-[#337a4e] transition-colors">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
