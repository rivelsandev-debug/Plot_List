<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl theme-text-primary leading-tight">
            Pembayaran
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="theme-app min-h-screen py-12">
        <div class="max-w-2xl mx-auto px-6 lg:px-8">
            <div class="theme-card border rounded-lg shadow-md p-6 text-center">

                <div class="mb-6">
                    <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold theme-text-primary mb-2">Selesaikan Pembayaran</h3>
                    <p class="theme-text-secondary text-sm mb-2">Order ID: <span
                            class="theme-text-primary font-mono font-semibold"><?php echo e($groupId); ?></span></p>
                    <p class="text-3xl font-bold theme-text-primary mb-6">
                        Rp <?php echo e(number_format($total, 0, ',', '.')); ?>

                    </p>
                </div>

                <button id="pay-button"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold mb-3 transition">
                    Bayar Sekarang
                </button>

                <p class="theme-text-muted text-xs">
                    Kamu akan diarahkan ke halaman pembayaran Midtrans
                </p>
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo e(config('midtrans.client_key')); ?>">
    </script>

    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            window.snap.pay('<?php echo e($snapToken); ?>', {
                onSuccess: function(result) {
                    // Kirim request ke server untuk update status
                    fetch('<?php echo e(route('orders.success')); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            group_id: '<?php echo e($groupId); ?>',
                            transaction_id: result.transaction_id
                        })
                    }).then(() => {
                        window.location.href = '<?php echo e(route('orders.history')); ?>';
                    });
                },
                onPending: function(result) {
                    window.location.href = '<?php echo e(route('orders.history')); ?>';
                },
                onError: function(result) {
                    alert('Pembayaran gagal!');
                },
                onClose: function() {
                    alert('Kamu menutup popup pembayaran.');
                }
            });
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\Plot_List\resources\views/orders/payment.blade.php ENDPATH**/ ?>