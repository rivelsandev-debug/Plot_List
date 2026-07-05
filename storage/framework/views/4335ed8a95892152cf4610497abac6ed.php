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
    <div class="theme-app min-h-screen py-12">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">
            <h1 class="text-2xl font-bold theme-text-primary mb-6">Novel Saya</h1>

            <form action="<?php echo e(route('orders.myNovels')); ?>" method="GET" class="flex gap-2 mb-8">
                <input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Cari judul novel..."
                    class="theme-input flex-1 border placeholder-gray-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    Cari
                </button>
            </form>

            <?php if($orders->isEmpty()): ?>
                <p class="theme-text-secondary">
                    <?php if($search): ?>
                        Novel dengan judul "<?php echo e($search); ?>" tidak ditemukan.
                    <?php else: ?>
                        Kamu belum punya novel yang dibeli.
                    <?php endif; ?>
                </p>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="theme-card border rounded-lg overflow-hidden flex flex-col shadow-sm">
                            <?php if($order->novel->cover_image): ?>
                                <img src="<?php echo e(asset('storage/' . $order->novel->cover_image)); ?>"
                                    alt="<?php echo e($order->novel->title); ?>" class="w-full h-56 object-cover border-b theme-border">
                            <?php else: ?>
                                <div class="w-full h-56 bg-gray-700/30 flex items-center justify-center border-b theme-border">
                                    <span class="theme-text-muted text-sm">No Cover</span>
                                </div>
                            <?php endif; ?>

                            <div class="p-4 flex flex-col flex-1">
                                <h3 class="theme-text-primary font-semibold mb-1"><?php echo e($order->novel->title); ?></h3>
                                <p class="theme-text-secondary text-sm mb-4"><?php echo e($order->novel->author); ?></p>
                                <a href="<?php echo e(route('orders.download', $order)); ?>"
                                    class="mt-auto bg-indigo-600 hover:bg-indigo-700 text-white text-center py-2 rounded-lg text-sm font-medium transition">
                                    Download
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH D:\laragon\www\Plot_List\resources\views/orders/my-novels.blade.php ENDPATH**/ ?>