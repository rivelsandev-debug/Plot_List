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
                    Keranjang Belanja
                </h2>
                <a href="<?php echo e(session('cart_back_url', route('novels.index'))); ?>"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    Kembali
                </a>
            </div>
         <?php $__env->endSlot(); ?>

        <div class="theme-app min-h-screen py-12">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">

                <?php if(session('success')): ?>
                    <div class="bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3 rounded-lg mb-4">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-lg mb-4">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php if($carts->isEmpty()): ?>
                    <div class="theme-card border rounded-xl p-12 text-center">
                        <div class="w-16 h-16 bg-blue-600/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <p class="theme-text-secondary text-lg mb-4">Keranjang kamu kosong!</p>
                        <a href="<?php echo e(route('novels.index')); ?>"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition inline-block font-semibold">
                            Cari Novel
                        </a>
                    </div>
                <?php else: ?>
                    <div class="theme-card border rounded-lg shadow overflow-hidden mb-6">
                        <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center gap-4 p-4 border-b theme-border">
                                
                                <?php if($cart->novel->cover_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $cart->novel->cover_image)); ?>"
                                        alt="<?php echo e($cart->novel->title); ?>" class="w-16 h-20 object-cover rounded border theme-border">
                                <?php else: ?>
                                    <div class="w-16 h-20 bg-gray-700/30 border theme-border rounded flex items-center justify-center">
                                        <span class="theme-text-muted text-xs">No Cover</span>
                                    </div>
                                <?php endif; ?>

                                
                                <div class="flex-1">
                                    <h3 class="font-semibold theme-text-primary"><?php echo e($cart->novel->title); ?></h3>
                                    <p class="text-sm theme-text-secondary"><?php echo e($cart->novel->author); ?></p>
                                    <p class="text-sm text-blue-400 font-bold mt-1">
                                        Rp <?php echo e(number_format($cart->novel->price, 0, ',', '.')); ?>

                                    </p>
                                </div>

                                
                                <form action="<?php echo e(route('cart.destroy', $cart)); ?>" method="POST"
                                    onsubmit="return confirm('Hapus novel ini dari keranjang?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-sm transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    
                    <div class="theme-card border rounded-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <span class="theme-text-secondary">Total (<?php echo e($carts->count()); ?> novel)</span>
                            <span class="text-xl font-bold theme-text-primary">
                                Rp <?php echo e(number_format($carts->sum(fn($c) => $c->novel->price), 0, ',', '.')); ?>

                            </span>
                        </div>
                        <a href="<?php echo e(route('orders.checkout')); ?>"
                            class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">
                            Checkout Sekarang
                        </a>
                    </div>
                <?php endif; ?>
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
<?php /**PATH D:\laragon\www\Plot_List\resources\views/cart/index.blade.php ENDPATH**/ ?>