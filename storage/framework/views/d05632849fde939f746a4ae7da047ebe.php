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
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl theme-text-primary leading-tight">
                Checkout
            </h2>
            <a href="<?php echo e(route('cart.index')); ?>"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm transition">
                Kembali ke Keranjang
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="theme-app min-h-screen py-12">
        <div class="max-w-2xl mx-auto px-6 lg:px-8">
            <div class="theme-card border rounded-lg shadow-md p-6">

                <h3 class="text-lg font-semibold theme-text-primary mb-6">Detail Pembelian</h3>

                
                <div class="mb-6 pb-6 border-b theme-border">
                    <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center gap-4 mb-4">
                            <?php if($cart->novel->cover_image): ?>
                                <img src="<?php echo e(asset('storage/' . $cart->novel->cover_image)); ?>"
                                    alt="<?php echo e($cart->novel->title); ?>" class="w-12 h-16 object-cover rounded border theme-border">
                            <?php else: ?>
                                <div class="w-12 h-16 bg-gray-700/30 border theme-border rounded flex items-center justify-center">
                                    <span class="theme-text-muted text-xs">No Cover</span>
                                </div>
                            <?php endif; ?>
                            <div class="flex-1">
                                <h4 class="font-semibold theme-text-primary text-sm"><?php echo e($cart->novel->title); ?></h4>
                                <p class="text-xs theme-text-secondary"><?php echo e($cart->novel->author); ?></p>
                            </div>
                            <span class="text-indigo-400 font-bold text-sm">
                                Rp <?php echo e(number_format($cart->novel->price, 0, ',', '.')); ?>

                            </span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="mb-6 pb-6 border-b theme-border">
                    <h4 class="text-sm font-medium theme-text-primary mb-2">Data Pembeli</h4>
                    <p class="text-sm theme-text-secondary"><?php echo e(auth()->user()->name); ?></p>
                    <p class="text-sm theme-text-secondary"><?php echo e(auth()->user()->email); ?></p>
                </div>

                
                <div class="flex justify-between items-center mb-6">
                    <span class="theme-text-secondary font-medium">Total Pembayaran</span>
                    <span class="text-xl font-bold theme-text-primary">
                        Rp <?php echo e(number_format($total, 0, ',', '.')); ?>

                    </span>
                </div>

                
                <form action="<?php echo e(route('orders.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold transition">
                        Bayar Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
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
<?php /**PATH D:\laragon\www\Plot_List\resources\views/orders/checkout.blade.php ENDPATH**/ ?>