<?php $__env->startSection('title', 'Buat Siklus - BukuTernak'); ?>

<?php $__env->startSection('app-content'); ?>
<?php
    $livestockTypes = ['Ayam Kampung','Ayam Pedaging','Lele','Bebek','Puyuh','Kambing','Sapi','Lainnya'];
?>
<div>
    <div class="flex items-center gap-2 mb-5">
        <a href="<?php echo e(route('cycles.index')); ?>" class="h-9 w-9 flex items-center justify-center rounded-xl hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-xl font-bold">Buat Siklus Baru</h1>
            <p class="text-xs text-gray-500">Tambahkan siklus ternak baru</p>
        </div>
    </div>

    <?php if($errors->any()): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-4"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <form method="POST" action="<?php echo e(route('cycles.store')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Nama Siklus</label>
                <input name="name" type="text" placeholder="Contoh: Ayam Batch 1" required value="<?php echo e(old('name')); ?>"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
            </div>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Jenis Ternak</label>
                <select name="livestock_type" required
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a] bg-white">
                    <option value="">Pilih jenis ternak</option>
                    <?php $__currentLoopData = $livestockTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type); ?>" <?php echo e(old('livestock_type') === $type ? 'selected' : ''); ?>><?php echo e($type); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input name="start_date" type="date" required value="<?php echo e(old('start_date', date('Y-m-d'))); ?>"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
            </div>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Jumlah Awal (ekor)</label>
                <input name="initial_count" type="number" min="1" placeholder="100" required value="<?php echo e(old('initial_count')); ?>"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
            </div>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Modal Awal (Rp)</label>
                <input name="initial_capital" type="number" min="0" step="0.01" placeholder="5000000" required value="<?php echo e(old('initial_capital', 0)); ?>"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
            </div>
            <button type="submit" class="w-full h-12 rounded-xl bg-[#3c8d5a] text-white font-medium text-sm hover:bg-[#337a4e] transition-colors">
                Buat Siklus
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/fataorgana/Project/buku-ternak/resources/views/cycles/create.blade.php ENDPATH**/ ?>