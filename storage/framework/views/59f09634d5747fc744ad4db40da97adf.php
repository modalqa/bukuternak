<?php $__env->startSection('title', 'BukuTernak - Manajemen Ternak Modern'); ?>

<?php $__env->startPush('styles'); ?>
<style>
@keyframes fade-in-up {
  from { opacity: 0; transform: translateY(16px); }
  to   { opacity: 1; transform: translateY(0); }
}
.anim { animation: fade-in-up 0.5s ease both; }
.d100 { animation-delay: 0.1s; }
.d200 { animation-delay: 0.2s; }
.d300 { animation-delay: 0.3s; }
.d400 { animation-delay: 0.4s; }
.pulse-dot { animation: pulse 2s cubic-bezier(0.4,0,0.6,1) infinite; }
@keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.4} }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col min-h-screen bg-white">

  
  <header class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-gray-100 px-5 py-3.5 flex items-center justify-between">
    <div class="flex items-center gap-2">
      <div class="h-8 w-8 bg-[#3c8d5a] rounded-xl flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l9-3 9 3v6c0 5.25-3.75 9-9 10.5C6.75 21 3 18.25 3 12V6z"/></svg>
      </div>
      <span class="font-bold text-lg tracking-tight">BukuTernak</span>
    </div>
    <div class="flex items-center gap-2">
      <a href="<?php echo e(route('login')); ?>" class="text-sm font-medium px-3 py-1.5 rounded-xl text-gray-700 hover:bg-gray-100 transition-colors">Masuk</a>
      <a href="<?php echo e(route('register')); ?>" class="text-sm px-4 py-1.5 rounded-xl bg-[#3c8d5a] text-white font-medium hover:bg-[#337a4e] transition-colors">Daftar Gratis</a>
    </div>
  </header>

  <main class="flex-1">

    
    <section class="relative overflow-hidden px-5 pt-16 pb-20 text-center">
      <div class="absolute inset-0 -z-10" style="background:radial-gradient(ellipse 80% 50% at 50% -20%,rgba(60,141,90,.15),transparent)"></div>
      <div class="max-w-2xl mx-auto">
        <span class="anim inline-flex items-center gap-1.5 bg-[#3c8d5a]/10 text-[#3c8d5a] text-xs font-semibold px-3 py-1 rounded-full mb-5">
          <span class="h-1.5 w-1.5 bg-[#3c8d5a] rounded-full pulse-dot"></span>
          Manajemen Ternak Modern
        </span>
        <h1 class="anim d100 text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900 mb-5 leading-tight">
          Catat usaha ternakmu <span class="text-[#3c8d5a]">tanpa ribet.</span>
        </h1>
        <p class="anim d200 text-gray-500 text-lg mb-8 max-w-lg mx-auto leading-relaxed">
          Pantau pakan, kematian, biaya, dan laba-rugi dalam satu aplikasi sederhana. Dirancang untuk peternak kecil Indonesia.
        </p>
        <div class="anim d300 flex flex-col sm:flex-row gap-3 justify-center">
          <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center justify-center gap-2 text-base px-8 h-12 rounded-xl bg-[#3c8d5a] text-white font-medium shadow-lg shadow-[#3c8d5a]/30 hover:bg-[#337a4e] transition-colors w-full sm:w-auto">
            Mulai Gratis
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
          <a href="<?php echo e(route('login')); ?>" class="inline-flex items-center justify-center text-base px-8 h-12 rounded-xl border border-gray-200 text-gray-700 font-medium hover:bg-gray-50 transition-colors w-full sm:w-auto">
            Sudah punya akun
          </a>
        </div>
        <p class="anim d400 mt-5 text-xs text-gray-400">
          ✓ Gratis selamanya &nbsp;·&nbsp; ✓ Tidak perlu kartu kredit &nbsp;·&nbsp; ✓ Data aman
        </p>
      </div>
    </section>

    <!-- 
    <?php if(isset($userCount)): ?>
    <section class="px-5 py-16 bg-white">
      <div class="max-w-4xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-center gap-6">
          <div class="bg-[#f8faf8] rounded-2xl shadow-sm border border-gray-100 px-10 py-8 flex flex-col items-center w-full max-w-xs">
            <div class="h-14 w-14 rounded-full bg-[#3c8d5a]/10 flex items-center justify-center text-3xl text-[#3c8d5a] mb-3">
              <svg xmlns='http://www.w3.org/2000/svg' class='h-8 w-8' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-5a4 4 0 11-8 0 4 4 0 018 0z' /></svg>
            </div>
            <div class="text-4xl font-extrabold text-gray-900 mb-1"><?php echo e(number_format($userCount)); ?></div>
            <div class="text-sm text-gray-500 mb-1">Pengguna</div>
            <div class="text-xs text-gray-400">Bergabung di BukuTernak</div>
          </div>
          <div class="bg-[#f8faf8] rounded-2xl shadow-sm border border-gray-100 px-10 py-8 flex flex-col items-center w-full max-w-xs">
            <div class="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-3xl text-blue-600 mb-3">
              <svg xmlns='http://www.w3.org/2000/svg' class='h-8 w-8' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 17v-2a4 4 0 014-4h4a4 4 0 014 4v2M9 17v2a4 4 0 01-4 4H5a4 4 0 01-4-4v-2a4 4 0 014-4h4a4 4 0 014 4z' /></svg>
            </div>
            <div class="text-4xl font-extrabold text-gray-900 mb-1"><?php echo e(number_format($activeCycleCount)); ?></div>
            <div class="text-sm text-gray-500 mb-1">Siklus Aktif</div>
            <div class="text-xs text-gray-400">Dipantau peternak setiap hari</div>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?> -->

    
    <section class="px-5 py-16 bg-gradient-to-b from-white to-[#F8FAF8]">
      <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
          <h2 class="text-2xl font-bold text-gray-900 mb-2">Lihat bagaimana BukuTernak bekerja</h2>
          <p class="text-gray-500 text-sm max-w-md mx-auto">Tampilan yang sudah familiar — persis seperti yang kamu gunakan setiap hari.</p>
        </div>
        <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">

          
          <div class="shrink-0 mx-auto w-[220px] sm:w-[260px]">
            <div class="bg-gray-900 rounded-[2.2rem] p-2.5 shadow-2xl shadow-gray-900/50 ring-1 ring-white/10">
              <div class="w-16 h-3.5 bg-gray-800 rounded-full mx-auto mb-1.5"></div>
              <div class="bg-[#F8FAF8] rounded-[1.7rem] overflow-hidden flex flex-col" style="height:480px">
                
                <div class="shrink-0 bg-white px-4 py-1.5 flex items-center justify-between border-b border-gray-100/60">
                  <span class="text-[9px] font-semibold text-gray-500">9:41</span>
                  <div class="flex items-center gap-0.5">
                    <div class="w-3 h-1.5 rounded-sm bg-gray-400/70"></div>
                    <div class="w-1.5 h-1.5 rounded-full bg-gray-400/70"></div>
                  </div>
                </div>
                
                <div class="flex-1 overflow-hidden relative" id="phoneScreens">
                  
                  <div class="phone-screen absolute inset-0 px-3 py-3 space-y-2.5 overflow-hidden transition-opacity duration-300" data-screen="dashboard">
                    <div class="flex items-center justify-between">
                      <div>
                        <p class="text-[9px] text-gray-400">Selamat datang,</p>
                        <h1 class="text-[13px] font-bold leading-tight">Halo, Budi 👋</h1>
                      </div>
                      <div class="h-6 w-16 bg-[#3c8d5a] rounded-xl flex items-center justify-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                        <span class="text-[9px] text-white font-medium">Baru</span>
                      </div>
                    </div>
                    <div class="bg-[#3c8d5a]/10 rounded-xl px-3 py-1.5 flex items-center justify-between">
                      <div class="flex items-center gap-1.5">
                        <div class="h-1.5 w-1.5 rounded-full bg-[#3c8d5a] pulse-dot"></div>
                        <span class="text-[9px] font-semibold text-[#3c8d5a]">2 Siklus Aktif</span>
                      </div>
                      <span class="text-[8px] text-[#3c8d5a]/70">950 ekor total</span>
                    </div>
                    <div class="grid grid-cols-2 gap-1.5">
                      <div class="bg-green-50 rounded-xl p-2"><span class="text-base">🐄</span><p class="text-[8px] text-gray-500 mt-0.5">Ternak Tersisa</p><p class="text-[10px] font-bold text-gray-900 mt-0.5">438 ekor</p></div>
                      <div class="bg-red-50 rounded-xl p-2"><span class="text-base">💀</span><p class="text-[8px] text-gray-500 mt-0.5">Total Mati</p><p class="text-[10px] font-bold text-gray-900 mt-0.5">12 ekor</p></div>
                      <div class="bg-orange-50 rounded-xl p-2"><span class="text-base">💸</span><p class="text-[8px] text-gray-500 mt-0.5">Total Biaya</p><p class="text-[10px] font-bold text-gray-900 mt-0.5">Rp 8,2 jt</p></div>
                      <div class="bg-green-50 rounded-xl p-2"><span class="text-base">📈</span><p class="text-[8px] text-gray-500 mt-0.5">Laba/Rugi</p><p class="text-[10px] font-bold text-gray-900 mt-0.5">+Rp 2,4 jt</p></div>
                    </div>
                    <div>
                      <p class="text-[8px] font-semibold text-gray-400 uppercase tracking-wide mb-1">Siklus Aktif</p>
                      <div class="bg-white rounded-xl p-2.5 shadow-sm">
                        <div class="flex items-center justify-between">
                          <div><p class="text-[10px] font-semibold">Ayam Broiler Batch-3</p><p class="text-[8px] text-gray-400">Ayam Pedaging · 1 Mar 2026</p></div>
                          <span class="text-[8px] bg-[#3c8d5a]/10 text-[#3c8d5a] px-1.5 py-0.5 rounded-full font-medium">Aktif</span>
                        </div>
                        <div class="grid grid-cols-4 gap-1 mt-2">
                          <div class="bg-gray-50 rounded-lg py-1 text-center text-[7px] text-gray-500 font-medium">🌾 Pakan</div>
                          <div class="bg-gray-50 rounded-lg py-1 text-center text-[7px] text-gray-500 font-medium">💀 Mati</div>
                          <div class="bg-gray-50 rounded-lg py-1 text-center text-[7px] text-gray-500 font-medium">💸 Biaya</div>
                          <div class="bg-gray-50 rounded-lg py-1 text-center text-[7px] text-gray-500 font-medium">🛒 Jual</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="phone-screen absolute inset-0 px-3 py-3 space-y-2 overflow-hidden transition-opacity duration-300 opacity-0 pointer-events-none" data-screen="cycles">
                    <div class="flex items-center justify-between mb-0.5">
                      <div><h1 class="text-[13px] font-bold">Siklus Ternak</h1><p class="text-[9px] text-gray-400">2 aktif · 3 selesai</p></div>
                      <div class="h-6 w-6 bg-[#3c8d5a] rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                      </div>
                    </div>
                    <p class="text-[8px] font-semibold text-gray-400 uppercase tracking-wide">Siklus Aktif</p>
                    <div class="bg-white rounded-xl p-2.5 shadow-sm">
                      <div class="flex items-start justify-between">
                        <div><p class="text-[10px] font-semibold">Ayam Broiler Batch-3</p><p class="text-[8px] text-gray-400">Ayam Pedaging</p></div>
                        <span class="text-[8px] bg-[#3c8d5a]/10 text-[#3c8d5a] px-1.5 py-0.5 rounded-full font-medium shrink-0">Aktif</span>
                      </div>
                      <div class="flex gap-2 text-[8px] text-gray-400 mt-1"><span>Mulai 1 Mar 2026</span><span>·</span><span>500 ekor</span></div>
                    </div>
                    <div class="bg-white rounded-xl p-2.5 shadow-sm">
                      <div class="flex items-start justify-between">
                        <div><p class="text-[10px] font-semibold">Bebek Pedaging Batch-1</p><p class="text-[8px] text-gray-400">Bebek</p></div>
                        <span class="text-[8px] bg-[#3c8d5a]/10 text-[#3c8d5a] px-1.5 py-0.5 rounded-full font-medium shrink-0">Aktif</span>
                      </div>
                      <div class="flex gap-2 text-[8px] text-gray-400 mt-1"><span>Mulai 15 Mar 2026</span><span>·</span><span>450 ekor</span></div>
                    </div>
                    <p class="text-[8px] font-semibold text-gray-400 uppercase tracking-wide pt-0.5">Selesai</p>
                    <div class="bg-white rounded-xl p-2.5 shadow-sm opacity-60">
                      <div class="flex items-start justify-between">
                        <div><p class="text-[10px] font-semibold">Ayam Broiler Batch-2</p><p class="text-[8px] text-gray-400">Ayam Pedaging · 1 Jan 2026</p></div>
                        <span class="text-[8px] bg-gray-100 text-gray-500 px-1.5 py-0.5 rounded-full font-medium">Selesai</span>
                      </div>
                    </div>
                  </div>
                  
                  <div class="phone-screen absolute inset-0 flex flex-col overflow-hidden transition-opacity duration-300 opacity-0 pointer-events-none" data-screen="detail">
                    <div class="shrink-0 bg-white border-b border-gray-100 px-3 pt-3 pb-2">
                      <div class="flex items-center gap-1.5 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        <h1 class="text-[11px] font-bold flex-1 truncate">Ayam Broiler Batch-3</h1>
                        <span class="text-[8px] bg-[#3c8d5a]/10 text-[#3c8d5a] px-1.5 py-0.5 rounded-full font-medium shrink-0">Aktif</span>
                      </div>
                      <div class="grid grid-cols-3 gap-1 mb-2">
                        <div class="bg-gray-50 rounded-lg p-1.5 text-center"><p class="text-[7px] text-gray-400">Modal</p><p class="text-[9px] font-bold">Rp 5 jt</p></div>
                        <div class="bg-green-50 rounded-lg p-1.5 text-center"><p class="text-[7px] text-gray-400">Laba</p><p class="text-[9px] font-bold text-green-600">+Rp 2,4 jt</p></div>
                        <div class="bg-gray-50 rounded-lg p-1.5 text-center"><p class="text-[7px] text-gray-400">Tersisa</p><p class="text-[9px] font-bold">482 ekor</p></div>
                      </div>
                      <div class="flex gap-1">
                        <div class="text-[8px] font-medium px-1.5 py-1 rounded-lg bg-[#3c8d5a] text-white">🌾 Pakan</div>
                        <div class="text-[8px] font-medium px-1.5 py-1 rounded-lg text-gray-500 hover:bg-gray-100">💀 Mati</div>
                        <div class="text-[8px] font-medium px-1.5 py-1 rounded-lg text-gray-500 hover:bg-gray-100">💸 Biaya</div>
                        <div class="text-[8px] font-medium px-1.5 py-1 rounded-lg text-gray-500 hover:bg-gray-100">🛒 Jual</div>
                      </div>
                    </div>
                    <div class="flex-1 overflow-hidden px-3 py-2 space-y-1.5">
                      <div class="bg-white rounded-xl px-2.5 py-2 shadow-sm flex items-center justify-between"><div><p class="text-[9px] font-medium">Pakan starter 25 kg</p><p class="text-[7px] text-gray-400">7 Apr</p></div><p class="text-[9px] font-semibold text-[#3c8d5a]">Rp 185.000</p></div>
                      <div class="bg-white rounded-xl px-2.5 py-2 shadow-sm flex items-center justify-between"><div><p class="text-[9px] font-medium">Pakan grower 30 kg</p><p class="text-[7px] text-gray-400">6 Apr</p></div><p class="text-[9px] font-semibold text-[#3c8d5a]">Rp 210.000</p></div>
                      <div class="bg-white rounded-xl px-2.5 py-2 shadow-sm flex items-center justify-between"><div><p class="text-[9px] font-medium">Pakan starter 25 kg</p><p class="text-[7px] text-gray-400">5 Apr</p></div><p class="text-[9px] font-semibold text-[#3c8d5a]">Rp 185.000</p></div>
                    </div>
                  </div>
                </div>
                
                <div class="shrink-0 bg-white border-t border-gray-100 px-2 py-2 flex justify-around" id="phoneNav">
                  <button class="phone-nav-btn text-[9px] font-semibold px-2 py-0.5 rounded-lg text-[#3c8d5a] bg-[#3c8d5a]/10" data-target="dashboard">Dashboard</button>
                  <button class="phone-nav-btn text-[9px] font-semibold px-2 py-0.5 rounded-lg text-gray-400" data-target="cycles">Siklus</button>
                  <button class="phone-nav-btn text-[9px] font-semibold px-2 py-0.5 rounded-lg text-gray-400" data-target="detail">Detail</button>
                </div>
              </div>
            </div>
            
            <div class="flex justify-center gap-1.5 mt-4" id="phoneDots">
              <button class="phone-dot h-1.5 w-5 rounded-full bg-[#3c8d5a] transition-all duration-300" data-target="dashboard"></button>
              <button class="phone-dot h-1.5 w-1.5 rounded-full bg-gray-300 transition-all duration-300" data-target="cycles"></button>
              <button class="phone-dot h-1.5 w-1.5 rounded-full bg-gray-300 transition-all duration-300" data-target="detail"></button>
            </div>
          </div>

          
          <div class="flex-1 space-y-6">
            <div class="rounded-2xl border p-4 flex items-start gap-4 bg-green-50 border-green-100 anim">
              <div class="text-2xl shrink-0">📊</div>
              <div>
                <p class="text-xs font-bold uppercase tracking-wide mb-0.5 text-green-600">Dashboard</p>
                <p class="text-sm font-semibold text-gray-900 mb-1">Pantau semua siklus aktif</p>
                <p class="text-xs text-gray-500 leading-relaxed">Lihat rangkuman jumlah ternak tersisa, total biaya, dan laba-rugi dari semua siklus aktif pada satu layar.</p>
              </div>
            </div>
            <div class="rounded-2xl border p-4 flex items-start gap-4 bg-blue-50 border-blue-100 anim d100">
              <div class="text-2xl shrink-0">📋</div>
              <div>
                <p class="text-xs font-bold uppercase tracking-wide mb-0.5 text-blue-600">Siklus</p>
                <p class="text-sm font-semibold text-gray-900 mb-1">Kelola batch ternak per siklus</p>
                <p class="text-xs text-gray-500 leading-relaxed">Buat siklus baru, lihat semua batch aktif maupun yang sudah selesai, dan lacak performa setiap periode.</p>
              </div>
            </div>
            <div class="rounded-2xl border p-4 flex items-start gap-4 bg-[#3c8d5a]/5 border-[#3c8d5a]/10 anim d200">
              <div class="text-2xl shrink-0">🗂️</div>
              <div>
                <p class="text-xs font-bold uppercase tracking-wide mb-0.5 text-[#3c8d5a]">Detail Siklus</p>
                <p class="text-sm font-semibold text-gray-900 mb-1">Catat pakan, kematian, biaya & penjualan</p>
                <p class="text-xs text-gray-500 leading-relaxed">Tab terpisah untuk setiap jenis catatan. Tambah data harian dengan cepat dan lihat ringkasan laba-rugi otomatis.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <section class="px-5 py-16 bg-[#F8FAF8]">
      <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
          <h2 class="text-2xl font-bold text-gray-900 mb-2">Semua yang kamu butuhkan</h2>
          <p class="text-gray-500 text-sm">Dirancang khusus untuk kebutuhan peternakan skala kecil dan menengah</p>
        </div>
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
          <?php
          $features = [
            ['icon'=>'⚡','title'=>'Input Cepat','desc'=>'Catat pakan, kematian, dan biaya harian dalam hitungan detik.'],
            ['icon'=>'📈','title'=>'Analisis Untung-Rugi','desc'=>'Lihat performa usaha ternakmu per siklus secara otomatis dan akurat.'],
            ['icon'=>'📊','title'=>'Laporan Visual','desc'=>'Grafik biaya vs penjualan dan tren kematian yang mudah dibaca.'],
            ['icon'=>'📋','title'=>'Per Siklus / Batch','desc'=>'Kelola setiap periode ternak secara terpisah dan terstruktur.'],
            ['icon'=>'📖','title'=>'Catatan Digital','desc'=>'Ganti buku tulis manual dengan pencatatan digital yang rapi.'],
            ['icon'=>'🛡️','title'=>'Data Privat & Aman','desc'=>'Hanya kamu yang bisa mengakses data ternakmu sendiri.'],
          ];
          ?>
          <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-50">
            <div class="h-9 w-9 bg-[#3c8d5a]/10 rounded-xl flex items-center justify-center mb-3 text-lg"><?php echo e($f['icon']); ?></div>
            <h3 class="font-semibold text-sm text-gray-900 mb-1"><?php echo e($f['title']); ?></h3>
            <p class="text-xs text-gray-500 leading-relaxed"><?php echo e($f['desc']); ?></p>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>

    
    <section class="px-5 py-16">
      <div class="max-w-3xl mx-auto">
        <div class="grid gap-8 sm:grid-cols-2 items-center">
          <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Cocok untuk peternak kecil</h2>
            <p class="text-gray-500 text-sm mb-6 leading-relaxed">Tidak perlu jadi ahli teknologi. BukuTernak dibuat sesederhana buku catatan, namun dengan kecerdasan aplikasi modern.</p>
            <ul class="space-y-3">
              <?php $__currentLoopData = ['Catat konsumsi pakan harian','Pantau angka kematian ternak','Hitung total biaya operasional','Ketahui laba-rugi per siklus','Akses dari HP kapan saja']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="flex items-center gap-2.5 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#3c8d5a] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span><?php echo e($item); ?></span>
              </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
          <div class="bg-gradient-to-br from-[#3c8d5a]/10 to-[#3c8d5a]/5 rounded-3xl p-6 space-y-3">
            <?php
            $stats = [
              ['emoji'=>'🐄','label'=>'Siklus Aktif','value'=>'3 Siklus'],
              ['emoji'=>'💰','label'=>'Total Pendapatan','value'=>'Rp 24,5 jt'],
              ['emoji'=>'📈','label'=>'Laba Bersih','value'=>'Rp 6,2 jt'],
              ['emoji'=>'💀','label'=>'Angka Kematian','value'=>'1.2%'],
            ];
            ?>
            <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-xl px-4 py-3 flex items-center justify-between shadow-sm">
              <div class="flex items-center gap-2.5">
                <span class="text-lg"><?php echo e($s['emoji']); ?></span>
                <span class="text-xs text-gray-500"><?php echo e($s['label']); ?></span>
              </div>
              <span class="text-sm font-bold text-gray-900"><?php echo e($s['value']); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
    </section>

    
    <section class="px-5 py-14 bg-[#3c8d5a]">
      <div class="max-w-xl mx-auto text-center">
        <h2 class="text-2xl font-bold text-white mb-3">Siap mulai mencatat?</h2>
        <p class="text-white/80 text-sm mb-7">Bergabung dengan peternak lain yang sudah pakai BukuTernak untuk mengelola usaha mereka lebih cerdas.</p>
        <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center justify-center text-base h-12 px-8 rounded-xl bg-white text-[#3c8d5a] font-semibold hover:bg-gray-50 transition-colors">
          Daftar Sekarang — Gratis!
        </a>
      </div>
    </section>

  </main>

  
  <footer class="border-t px-5 py-7 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-gray-400">
    <div class="flex items-center gap-2">
      <div class="h-6 w-6 bg-[#3c8d5a] rounded-lg flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l9-3 9 3v6c0 5.25-3.75 9-9 10.5C6.75 21 3 18.25 3 12V6z"/></svg>
      </div>
      <span class="font-semibold text-gray-900">BukuTernak</span>
    </div>
    <p>&copy; <?php echo e(date('Y')); ?> BukuTernak. Semua hak dilindungi.</p>
    <div class="flex gap-4">
      <a href="<?php echo e(route('login')); ?>" class="hover:text-[#3c8d5a] transition-colors">Masuk</a>
      <a href="<?php echo e(route('register')); ?>" class="hover:text-[#3c8d5a] transition-colors">Daftar</a>
    </div>
  </footer>

</div>

<?php $__env->startPush('scripts'); ?>
<script>
(function(){
  var screens = ['dashboard','cycles','detail'];
  var current = 0;
  var timer;

  function switchTo(name) {
    document.querySelectorAll('.phone-screen').forEach(function(el){
      var active = el.dataset.screen === name;
      el.style.opacity = active ? '1' : '0';
      el.classList.toggle('pointer-events-none', !active);
    });
    document.querySelectorAll('.phone-nav-btn').forEach(function(btn){
      var active = btn.dataset.target === name;
      btn.className = 'phone-nav-btn text-[9px] font-semibold px-2 py-0.5 rounded-lg transition-all ' +
        (active ? 'text-[#3c8d5a] bg-[#3c8d5a]/10' : 'text-gray-400');
    });
    document.querySelectorAll('.phone-dot').forEach(function(dot){
      var active = dot.dataset.target === name;
      dot.className = 'phone-dot h-1.5 rounded-full transition-all duration-300 ' +
        (active ? 'w-5 bg-[#3c8d5a]' : 'w-1.5 bg-gray-300');
    });
    current = screens.indexOf(name);
  }

  function autoAdvance() {
    current = (current + 1) % screens.length;
    switchTo(screens[current]);
  }

  function startTimer() { timer = setInterval(autoAdvance, 3800); }
  function resetTimer() { clearInterval(timer); startTimer(); }

  document.querySelectorAll('.phone-nav-btn, .phone-dot').forEach(function(btn){
    btn.addEventListener('click', function(){ switchTo(btn.dataset.target); resetTimer(); });
  });

  startTimer();
})();
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/fataorgana/Project/buku-ternak/resources/views/welcome.blade.php ENDPATH**/ ?>