<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $__env->yieldContent('title', 'BukuTernak'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#3c8d5a', foreground: '#ffffff' },
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .animate-pulse-dot { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">
    <?php echo $__env->yieldContent('content'); ?>

    
    <div id="confirmModal" class="fixed inset-0 z-[999] flex items-end sm:items-center justify-center p-4"
         style="display:none!important" aria-modal="true" role="dialog">
        
        <div id="confirmBackdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity duration-200 opacity-0"></div>
        
        <div id="confirmSheet"
             class="relative w-full max-w-sm bg-white rounded-2xl shadow-2xl p-5 translate-y-4 opacity-0 transition-all duration-200 ease-out">
            <div class="flex flex-col items-center text-center gap-3 mb-5">
                <div id="confirmIconWrap" class="h-12 w-12 rounded-full flex items-center justify-center text-2xl">
                    <span id="confirmIcon"></span>
                </div>
                <div>
                    <p id="confirmTitle" class="font-semibold text-gray-900 text-base"></p>
                    <p id="confirmDesc" class="text-sm text-gray-500 mt-1"></p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2.5">
                <button id="confirmCancel"
                    class="h-11 rounded-xl border border-gray-200 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button id="confirmOk"
                    class="h-11 rounded-xl text-white text-sm font-medium transition-colors">
                    Lanjutkan
                </button>
            </div>
        </div>
    </div>

    <?php echo $__env->yieldPushContent('scripts'); ?>

    <script>
    (function () {
        var modal   = document.getElementById('confirmModal');
        var backdrop = document.getElementById('confirmBackdrop');
        var sheet   = document.getElementById('confirmSheet');
        var titleEl = document.getElementById('confirmTitle');
        var descEl  = document.getElementById('confirmDesc');
        var iconEl  = document.getElementById('confirmIcon');
        var iconWrap = document.getElementById('confirmIconWrap');
        var cancelBtn = document.getElementById('confirmCancel');
        var okBtn   = document.getElementById('confirmOk');
        var pendingCallback = null;

        function open(opts) {
            titleEl.textContent  = opts.title  || 'Konfirmasi';
            descEl.textContent   = opts.desc   || '';
            iconEl.textContent   = opts.icon   || '❓';
            okBtn.textContent    = opts.okText || 'Ya, Lanjutkan';

            var danger = opts.danger !== false; // default danger=true
            if (danger) {
                iconWrap.className = 'h-12 w-12 rounded-full flex items-center justify-center text-2xl bg-red-50';
                okBtn.className    = 'h-11 rounded-xl text-white text-sm font-medium transition-colors bg-red-500 hover:bg-red-600';
            } else {
                iconWrap.className = 'h-12 w-12 rounded-full flex items-center justify-center text-2xl bg-[#3c8d5a]/10';
                okBtn.className    = 'h-11 rounded-xl text-white text-sm font-medium transition-colors bg-[#3c8d5a] hover:bg-[#337a4e]';
            }

            pendingCallback = opts.onConfirm;
            modal.style.removeProperty('display');
            requestAnimationFrame(function () {
                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');
                sheet.classList.remove('translate-y-4', 'opacity-0');
                sheet.classList.add('translate-y-0', 'opacity-100');
            });
        }

        function close() {
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            sheet.classList.add('translate-y-4', 'opacity-0');
            sheet.classList.remove('translate-y-0', 'opacity-100');
            setTimeout(function () {
                modal.style.display = 'none';
                pendingCallback = null;
            }, 200);
        }

        cancelBtn.addEventListener('click', close);
        backdrop.addEventListener('click', close);
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') close(); });

        okBtn.addEventListener('click', function () {
            close();
            if (typeof pendingCallback === 'function') {
                setTimeout(pendingCallback, 220);
            }
        });

        // Public API
        window.confirmModal = open;

        // Auto-wire: data-confirm on forms
        document.addEventListener('submit', function (e) {
            var form = e.target;
            if (!form.hasAttribute('data-confirm')) return;
            e.preventDefault();
            open({
                title:  form.dataset.confirmTitle  || 'Konfirmasi Aksi',
                desc:   form.dataset.confirmDesc   || 'Apakah kamu yakin?',
                icon:   form.dataset.confirmIcon   || '⚠️',
                okText: form.dataset.confirmOk     || 'Ya, Lanjutkan',
                danger: form.dataset.confirmDanger !== 'false',
                onConfirm: function () { form.submit(); }
            });
        }, true);
    })();
    </script>
</body>
</html>
<?php /**PATH /Users/fataorgana/Project/buku-ternak/resources/views/layouts/base.blade.php ENDPATH**/ ?>