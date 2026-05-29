<?php $__env->startSection('title', $cycle->name . ' - BukuTernak'); ?>

<?php $__env->startSection('app-content'); ?>
<?php
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
?>

<div class="space-y-5">

    
    <div class="flex items-center gap-3">
        <a href="<?php echo e(route('cycles.index')); ?>" class="h-9 w-9 flex items-center justify-center rounded-xl hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2">
                <h1 class="text-xl font-bold truncate"><?php echo e($cycle->name); ?></h1>
                <span class="text-xs px-2 py-0.5 rounded-full font-medium flex-shrink-0 <?php echo e($isActive ? 'bg-[#3c8d5a]/10 text-[#3c8d5a]' : 'bg-gray-100 text-gray-500'); ?>">
                    <?php echo e($isActive ? 'Aktif' : 'Selesai'); ?>

                </span>
            </div>
            <p class="text-xs text-gray-500"><?php echo e($cycle->livestock_type); ?> · <?php echo e(CSS::formatNumber($cycle->initial_count)); ?> ekor · Mulai <?php echo e($cycle->start_date->translatedFormat('j M Y')); ?></p>
        </div>
        <div class="flex items-center gap-2">
            <a href="<?php echo e(route('cycles.edit', $cycle)); ?>" class="text-xs px-3 py-1.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">Edit</a>
            <?php if($isActive): ?>
            <form method="POST" action="<?php echo e(route('cycles.complete', $cycle)); ?>"
                data-confirm
                data-confirm-title="Selesaikan Siklus"
                data-confirm-desc="Siklus <?php echo e($cycle->name); ?> akan ditandai selesai. Aksi ini tidak dapat dibatalkan."
                data-confirm-icon="✅"
                data-confirm-ok="Ya, Selesaikan"
                data-confirm-danger="false">
                <?php echo csrf_field(); ?>
                <button type="submit" class="text-xs px-3 py-1.5 rounded-xl bg-[#3c8d5a] text-white hover:bg-[#337a4e] transition-colors">
                    Selesaikan
                </button>
            </form>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="grid grid-cols-2 gap-3">
        <div class="bg-orange-50 rounded-2xl p-4">
            <div class="mb-2">
                <span class="inline-block bg-orange-100 text-orange-700 text-xs font-semibold px-2 py-0.5 rounded">Total Biaya</span>
            </div>
            <p class="font-bold text-sm text-gray-900"><?php echo e(CSS::formatCurrency($summary['totalCost'])); ?></p>
        </div>
        <div class="bg-blue-50 rounded-2xl p-4">
            <div class="mb-2">
                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-0.5 rounded">Penjualan</span>
            </div>
            <p class="font-bold text-sm text-gray-900"><?php echo e(CSS::formatCurrency($summary['totalSales'])); ?></p>
        </div>
        <div class="rounded-2xl p-4 <?php echo e($summary['profitLoss'] >= 0 ? 'bg-green-50' : 'bg-red-50'); ?>">
            <div class="mb-2">
                <span class="inline-block <?php echo e($summary['profitLoss'] >= 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'); ?> text-xs font-semibold px-2 py-0.5 rounded">Laba/Rugi</span>
            </div>
            <p class="font-bold text-sm <?php echo e($summary['profitLoss'] >= 0 ? 'text-green-700' : 'text-red-600'); ?>"><?php echo e(CSS::formatCurrency($summary['profitLoss'])); ?></p>
        </div>
        <div class="bg-red-50 rounded-2xl p-4">
            <div class="mb-2">
                <span class="inline-block bg-red-100 text-red-700 text-xs font-semibold px-2 py-0.5 rounded">Angka Kematian</span>
            </div>
            <p class="font-bold text-sm text-gray-900"><?php echo e($summary['mortalityRate']); ?>%</p>
            <p class="text-xs text-gray-500"><?php echo e(CSS::formatNumber($summary['totalMortality'])); ?> ekor</p>
        </div>
    </div>

    
    <?php if($isActive): ?>
    <div class="grid grid-cols-4 gap-2">
        <?php $__currentLoopData = [
            ['href' => route('cycles.feed.create', $cycle), 'emoji' => '🌾', 'label' => 'Pakan'],
            ['href' => route('cycles.mortality.create', $cycle), 'emoji' => '❌', 'label' => 'Mati'],
            ['href' => route('cycles.expenses.create', $cycle), 'emoji' => '💵', 'label' => 'Biaya'],
            ['href' => route('cycles.sales.create', $cycle), 'emoji' => '🛒', 'label' => 'Jual']
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($action['href']); ?>" class="bg-[#3c8d5a]/10 hover:bg-[#3c8d5a]/20 rounded-2xl py-3 text-center transition-colors">
            <span class="text-xl block"><?php echo e($action['emoji']); ?></span>
            <span class="text-xs font-medium text-[#3c8d5a] mt-0.5 block"><?php echo e($action['label']); ?></span>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

    
    <?php
        $tabs = [
            ['key' => 'summary',   'label' => 'Info'],
            ['key' => 'feed',      'label' => 'Pakan'],
            ['key' => 'mortality', 'label' => 'Mati'],
            ['key' => 'expenses',  'label' => 'Biaya'],
            ['key' => 'sales',     'label' => 'Jual'],
        ];
    ?>

    <div>
        
        <div class="grid grid-cols-5 rounded-xl bg-gray-100 p-0.5 gap-0.5 mb-4">
            <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="?tab=<?php echo e($tab['key']); ?>"
               class="text-center py-1.5 rounded-lg text-xs font-medium transition-colors
                      <?php echo e($activeTab === $tab['key'] ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700'); ?>">
                <?php echo e($tab['label']); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <?php if($activeTab === 'summary'): ?>
        <div class="bg-white rounded-2xl shadow-sm">
            <div class="p-5 space-y-2.5 text-sm">
                <?php echo $__env->make('cycles._summary_row', ['label' => 'Jumlah Awal',        'value' => CSS::formatNumber($summary['initialCount']) . ' ekor'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo $__env->make('cycles._summary_row', ['label' => 'Modal Awal',         'value' => CSS::formatCurrency($summary['initialCapital'])], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo $__env->make('cycles._summary_row', ['label' => 'Biaya Pakan',        'value' => CSS::formatCurrency($summary['totalFeedCost'])], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo $__env->make('cycles._summary_row', ['label' => 'Biaya Operasional',  'value' => CSS::formatCurrency($summary['totalExpenses'])], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <hr class="border-gray-100"/>
                <?php echo $__env->make('cycles._summary_row', ['label' => 'Total Biaya',        'value' => CSS::formatCurrency($summary['totalCost']),   'bold' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo $__env->make('cycles._summary_row', ['label' => 'Total Penjualan',    'value' => CSS::formatCurrency($summary['totalSales']),  'bold' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <hr class="border-gray-100"/>
                <div class="flex justify-between py-0.5">
                    <span class="text-gray-500 font-semibold">Laba/Rugi</span>
                    <span class="font-bold <?php echo e($summary['profitLoss'] >= 0 ? 'text-green-600' : 'text-red-600'); ?>"><?php echo e(CSS::formatCurrency($summary['profitLoss'])); ?></span>
                </div>
                <?php echo $__env->make('cycles._summary_row', ['label' => 'Total Kematian', 'value' => CSS::formatNumber($summary['totalMortality']) . ' ekor'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php if($summary['totalSold'] > 0): ?>
                    <?php echo $__env->make('cycles._summary_row', ['label' => 'Total Terjual',  'value' => CSS::formatNumber($summary['totalSold']) . ' ekor'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endif; ?>
                <?php if($summary['totalSoldWeight'] > 0): ?>
                    <?php echo $__env->make('cycles._summary_row', ['label' => 'Total Terjual (berat)', 'value' => CSS::formatNumber($summary['totalSoldWeight']) . ' kg'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endif; ?>
                <?php echo $__env->make('cycles._summary_row', ['label' => 'Sisa Ternak',        'value' => CSS::formatNumber($summary['remainingLivestock']) . ' ekor'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo $__env->make('cycles._summary_row', ['label' => 'Angka Mortalitas',   'value' => $summary['mortalityRate'] . '%'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>

        <?php elseif($activeTab === 'feed'): ?>
        <div class="space-y-2.5">
            <?php if($cycle->feedLogs->isEmpty()): ?>
                <?php echo $__env->make('cycles._empty', ['label' => 'Belum ada catatan pakan'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php else: ?>
                <?php $__currentLoopData = $cycle->feedLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl shadow-sm px-4 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium"><?php echo e($log->quantity + 0); ?> <?php echo e($feedUnitLabels[$log->unit]); ?> — <?php echo e(CSS::formatCurrency((float)$log->cost)); ?></p>
                        <p class="text-xs text-gray-500"><?php echo e($log->date->translatedFormat('j M Y')); ?><?php echo e($log->notes ? ' · ' . $log->notes : ''); ?></p>
                    </div>
                    <form method="POST" action="<?php echo e(route('cycles.feed.destroy', [$cycle, $log])); ?>"
                        data-confirm
                        data-confirm-title="Hapus Catatan Pakan"
                        data-confirm-desc="Catatan pakan ini akan dihapus permanen."
                        data-confirm-icon="🗑️"
                        data-confirm-ok="Ya, Hapus">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-400 hover:text-red-600 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <?php elseif($activeTab === 'mortality'): ?>
        <div class="space-y-2.5">
            <?php if($cycle->mortalityLogs->isEmpty()): ?>
                <?php echo $__env->make('cycles._empty', ['label' => 'Belum ada catatan kematian'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php else: ?>
                <?php $__currentLoopData = $cycle->mortalityLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl shadow-sm px-4 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium"><?php echo e(CSS::formatNumber($log->count)); ?> ekor mati</p>
                        <p class="text-xs text-gray-500"><?php echo e($log->date->translatedFormat('j M Y')); ?><?php echo e($log->cause ? ' · '.$log->cause : ''); ?><?php echo e($log->notes ? ' · '.$log->notes : ''); ?></p>
                    </div>
                    <form method="POST" action="<?php echo e(route('cycles.mortality.destroy', [$cycle, $log])); ?>"
                        data-confirm
                        data-confirm-title="Hapus Catatan Kematian"
                        data-confirm-desc="Catatan kematian ini akan dihapus permanen."
                        data-confirm-icon="🗑️"
                        data-confirm-ok="Ya, Hapus">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-400 hover:text-red-600 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <?php elseif($activeTab === 'expenses'): ?>
        <div class="space-y-2.5">
            <?php if($cycle->expenses->isEmpty()): ?>
                <?php echo $__env->make('cycles._empty', ['label' => 'Belum ada catatan biaya'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php else: ?>
                <?php $__currentLoopData = $cycle->expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl shadow-sm px-4 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium"><?php echo e($expenseCategoryLabels[$log->category]); ?> — <?php echo e(CSS::formatCurrency((float)$log->amount)); ?></p>
                        <p class="text-xs text-gray-500"><?php echo e($log->date->translatedFormat('j M Y')); ?><?php echo e($log->notes ? ' · '.$log->notes : ''); ?></p>
                    </div>
                    <form method="POST" action="<?php echo e(route('cycles.expenses.destroy', [$cycle, $log])); ?>"
                        data-confirm
                        data-confirm-title="Hapus Catatan Biaya"
                        data-confirm-desc="Catatan biaya ini akan dihapus permanen."
                        data-confirm-icon="🗑️"
                        data-confirm-ok="Ya, Hapus">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-400 hover:text-red-600 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <?php elseif($activeTab === 'sales'): ?>
        <div class="space-y-2.5">
            <?php if($cycle->sales->isEmpty()): ?>
                <?php echo $__env->make('cycles._empty', ['label' => 'Belum ada catatan penjualan'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php else: ?>
                <?php $__currentLoopData = $cycle->sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl shadow-sm px-4 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium"><?php echo e($log->quantity + 0); ?> <?php echo e($log->quantity_unit); ?> — <?php echo e(CSS::formatCurrency((float)$log->total_price)); ?></p>
                        <p class="text-xs text-gray-500"><?php echo e($log->date->translatedFormat('j M Y')); ?><?php echo e($log->buyer_name ? ' · '.$log->buyer_name : ''); ?><?php echo e($log->notes ? ' · '.$log->notes : ''); ?></p>
                    </div>
                    <form method="POST" action="<?php echo e(route('cycles.sales.destroy', [$cycle, $log])); ?>"
                        data-confirm
                        data-confirm-title="Hapus Catatan Penjualan"
                        data-confirm-desc="Catatan penjualan ini akan dihapus permanen."
                        data-confirm-icon="🗑️"
                        data-confirm-ok="Ya, Hapus">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-400 hover:text-red-600 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/fataorgana/Project/buku-ternak/resources/views/cycles/show.blade.php ENDPATH**/ ?>