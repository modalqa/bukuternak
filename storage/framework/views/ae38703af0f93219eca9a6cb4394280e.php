<?php $__env->startSection('title', 'Tambah Penjualan - BukuTernak'); ?>

<?php $__env->startSection('app-content'); ?>
<div>
    <div class="flex items-center gap-2 mb-5">
        <a href="<?php echo e(route('cycles.show', $cycle)); ?>" class="h-9 w-9 flex items-center justify-center rounded-xl hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-xl font-bold">Tambah Penjualan</h1>
            <p class="text-xs text-gray-500">Catat penjualan ternak</p>
        </div>
    </div>

    <?php if($errors->any()): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-4"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <form method="POST" action="<?php echo e(route('cycles.sales.store', $cycle)); ?>" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input name="date" type="date" required value="<?php echo e(old('date', date('Y-m-d'))); ?>"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input name="quantity" type="number" step="0.01" min="0.01" placeholder="50" required value="<?php echo e(old('quantity')); ?>"
                        class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-gray-700">Satuan</label>
                    <select name="quantity_unit" class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a] bg-white">
                        <option value="ekor" <?php echo e(old('quantity_unit', 'ekor') === 'ekor' ? 'selected' : ''); ?>>ekor</option>
                        <option value="kg"   <?php echo e(old('quantity_unit') === 'kg'   ? 'selected' : ''); ?>>kg</option>
                    </select>
                </div>
            </div>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Total Harga (Rp)</label>
                <input name="total_price" type="number" min="0" placeholder="2500000" required value="<?php echo e(old('total_price')); ?>"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
            </div>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Nama Pembeli (opsional)</label>
                <input name="buyer_name" type="text" placeholder="Nama pembeli" value="<?php echo e(old('buyer_name')); ?>"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a]" />
            </div>
            <div class="space-y-1.5">
                <label class="block text-sm font-medium text-gray-700">Catatan (opsional)</label>
                <textarea name="notes" rows="2" placeholder="Catatan tambahan..."
                    class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a] resize-none"><?php echo e(old('notes')); ?></textarea>
            </div>
            <button type="submit" class="w-full h-12 rounded-xl bg-[#3c8d5a] text-white font-medium text-sm hover:bg-[#337a4e] transition-colors">
                Simpan
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/fataorgana/Project/buku-ternak/resources/views/cycles/sales/create.blade.php ENDPATH**/ ?>