@extends('layouts.base')

@section('content')
<div class="flex flex-col min-h-screen bg-gray-50">

    {{-- Top Bar --}}
    <header class="sticky top-0 z-50 bg-[#3c8d5a] text-white shadow-md">
        <div class="flex h-14 items-center px-4 max-w-xl mx-auto gap-3">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 mr-auto">
                <div class="bg-white/20 rounded-lg p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <span class="font-bold text-white text-base tracking-tight">BukuTernak</span>
            </a>
            @auth
                <span class="text-sm text-white/80 hidden sm:block">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}"
                    data-confirm
                    data-confirm-title="Keluar dari BukuTernak"
                    data-confirm-desc="Kamu akan keluar dari akun ini."
                    data-confirm-icon="🚪"
                    data-confirm-ok="Ya, Keluar"
                    data-confirm-danger="false">
                    @csrf
                    <button type="submit" class="p-2 rounded-lg hover:bg-white/10 transition-colors" title="Logout">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            @endauth
        </div>
    </header>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-xl mx-auto w-full px-4 pt-3">
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-xl mx-auto w-full px-4 pt-3">
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="flex-1 pb-24">
        <div class="max-w-xl mx-auto px-4 py-5">
            @yield('app-content')
        </div>
    </main>

    {{-- Bottom Nav --}}
    <nav class="fixed bottom-0 left-0 right-0 z-50 border-t bg-white shadow-lg">
        <div class="flex items-center justify-around py-2 max-w-lg mx-auto">
            @php
                $currentPath = request()->path();
                $navItems = [
                    ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'grid'],
                    ['route' => 'cycles.index', 'label' => 'Siklus', 'icon' => 'refresh'],
                    ['route' => 'laporan', 'label' => 'Laporan', 'icon' => 'chart'],
                    ['route' => 'profil', 'label' => 'Profil', 'icon' => 'user'],
                ];
            @endphp
            @foreach($navItems as $item)
                @php
                    $routePath = ltrim(route($item['route'], [], false), '/');
                    $isActive = $currentPath === $routePath
                        || ($item['route'] === 'cycles.index' && str_starts_with($currentPath, 'cycles') && $currentPath !== 'cycles/new');
                @endphp
                <a href="{{ route($item['route']) }}" class="flex flex-col items-center gap-0.5 px-5 py-1 rounded-xl transition-colors {{ $isActive ? 'text-[#3c8d5a]' : 'text-gray-400' }}">
                    @if($item['icon'] === 'grid')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $isActive ? 'stroke-[2.5]' : 'stroke-[1.5]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"/></svg>
                    @elseif($item['icon'] === 'refresh')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $isActive ? 'stroke-[2.5]' : 'stroke-[1.5]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    @elseif($item['icon'] === 'chart')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $isActive ? 'stroke-[2.5]' : 'stroke-[1.5]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $isActive ? 'stroke-[2.5]' : 'stroke-[1.5]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    @endif
                    <span class="text-[10px] {{ $isActive ? 'font-semibold' : 'font-normal' }}">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </div>
    </nav>
</div>
@endsection
