@extends('layouts.app')
@section('title', 'Tambah Pakan - BukuTernak')

@section('app-content')
<div>
    <div class="flex items-center gap-2 mb-5">
        <a href="{{ route('cycles.show', $cycle) }}" class="h-9 w-9 flex items-center justify-center rounded-xl hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-xl font-bold">Tambah Pakan</h1>
            <p class="text-xs text-gray-500">Catat konsumsi pakan harian</p>
        </div>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-4">{{ $errors->first() }}</div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <form method="POST" action="{{ route('cycles.feed.store', $cycle) }}" class="space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input name="date" type="date" required value="{{ old('date', date('Y-m-d')) }}"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input name="quantity" type="number" step="0.01" min="0.01" placeholder="10" required value="{{ old('quantity') }}"
                        class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-gray-700">Satuan</label>
                    <select name="unit" class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a] bg-white">
                        <option value="kg" {{ old('unit', 'kg') === 'kg' ? 'selected' : '' }}>Kg</option>
                        <option value="karung" {{ old('unit') === 'karung' ? 'selected' : '' }}>Karung</option>
                        <option value="sak" {{ old('unit') === 'sak' ? 'selected' : '' }}>Sak</option>
                    </select>
                </div>
            </div>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Biaya (Rp)</label>
                <input name="cost" type="number" min="0" placeholder="150000" required value="{{ old('cost') }}"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
            </div>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Catatan (opsional)</label>
                <textarea name="notes" rows="2" placeholder="Catatan tambahan..."
                    class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a] resize-none">{{ old('notes') }}</textarea>
            </div>
            <button type="submit" class="w-full h-12 rounded-xl bg-[#3c8d5a] text-white font-medium text-sm hover:bg-[#337a4e] transition-colors">
                Simpan
            </button>
        </form>
    </div>
</div>
@endsection
