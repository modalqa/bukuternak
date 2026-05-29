<?php $__env->startSection('title', 'Daftar - BukuTernak'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex min-h-screen items-center justify-center px-4 py-12 bg-[#F8FAF8]">
    <a href="/" class="absolute top-4 left-4 flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>

    <div class="w-full max-w-sm bg-white rounded-2xl shadow-sm p-8">
        <div class="text-center mb-6">
            <div class="flex justify-center mb-3">
                <div class="h-10 w-10 bg-[#3c8d5a] rounded-2xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2H5zm7 3a1 1 0 00-1 1v4a1 1 0 00.293.707l2 2a1 1 0 001.414-1.414L13 11.586V7a1 1 0 00-1-1z"/></svg>
                </div>
            </div>
            <h1 class="text-xl font-bold text-gray-900">Daftar BukuTernak</h1>
            <p class="text-sm text-gray-500 mt-1">Buat akun untuk mulai mencatat ternak</p>
        </div>

        <?php if($errors->any()): ?>
            <div class="rounded-xl bg-red-50 p-3 mb-4 text-sm text-red-700">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="/register" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div class="space-y-1.5">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input id="name" name="name" type="text" placeholder="Nama lengkap" required
                    value="<?php echo e(old('name')); ?>"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a] focus:border-transparent" />
            </div>
            <div class="space-y-1.5">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" placeholder="nama@email.com" required
                    value="<?php echo e(old('email')); ?>"
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a] focus:border-transparent" />
            </div>
            <div class="space-y-1.5">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" placeholder="Minimal 6 karakter" required
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a] focus:border-transparent" />
            </div>
            <div class="space-y-1.5">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Ulangi password" required
                    class="w-full h-12 rounded-xl border border-gray-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#3c8d5a] focus:border-transparent" />
            </div>
            <button type="submit" class="w-full h-12 rounded-xl bg-[#3c8d5a] text-white font-medium text-sm hover:bg-[#337a4e] transition-colors">
                Daftar
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-500">
            Sudah punya akun?
            <a href="<?php echo e(route('login')); ?>" class="text-[#3c8d5a] font-medium hover:underline">Masuk</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/auth/register.blade.php ENDPATH**/ ?>