@extends('layouts.app')
@section('title', 'Siklus Ternak - BukuTernak')

@section('app-content')
<div class="space-y-5">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Siklus Ternak</h1>
            <p class="text-sm text-gray-500">{{ $active->count() }} aktif · {{ $finished->count() }} selesai</p>
        </div>
        <a href="{{ route('cycles.create') }}" class="inline-flex items-center gap-1.5 px-3 h-9 rounded-xl bg-[#3c8d5a] text-white text-sm font-medium shadow-sm hover:bg-[#337a4e] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Siklus
        </a>
    </div>

    @if($allCycles->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7m16 0L12 11 4 7"/></svg>
            <p class="text-sm text-gray-500 mb-4">Belum ada siklus ternak. Mulai dengan membuat siklus pertamamu.</p>
            <a href="{{ route('cycles.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#3c8d5a] text-white text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Buat Siklus Baru
            </a>
        </div>
    @else
        <div class="space-y-5">
            @if($active->isNotEmpty())
            <section>
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2.5">Siklus Aktif</h2>
                <div class="grid gap-3">
                    @foreach($active as $cycle)
                        @include('cycles._card', compact('cycle'))
                    @endforeach
                </div>
            </section>
            @endif

            @if($finished->isNotEmpty())
            <section>
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2.5">Selesai</h2>
                <div class="grid gap-3">
                    @foreach($finished as $cycle)
                        @include('cycles._card', compact('cycle'))
                    @endforeach
                </div>
            </section>
            @endif
        </div>
    @endif

</div>
@endsection
