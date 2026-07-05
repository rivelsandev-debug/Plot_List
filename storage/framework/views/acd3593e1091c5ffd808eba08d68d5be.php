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
                Detail Transaksi
            </h2>
            <a href="<?php echo e(route('admin.transactions.index')); ?>"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm transition">
                Kembali
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="theme-card rounded-lg shadow p-6">

                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold theme-text-primary"><?php echo e($order->order_id); ?></h3>
                    <?php
                        $statusClass = match ($order->status) {
                            'success' => 'bg-green-500/10 text-green-400 border border-green-500/20',
                            'pending' => 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20',
                            'failed' => 'bg-red-500/10 text-red-400 border border-red-500/20',
                            default => 'bg-gray-500/10 text-gray-400 border border-gray-500/20',
                        };
                    ?>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold <?php echo e($statusClass); ?>">
                        <?php echo e(ucfirst($order->status)); ?>

                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    
                    <div class="theme-border border rounded-lg p-4">
                        <h4 class="font-semibold theme-text-primary mb-3">Info Pembeli</h4>
                        <div class="space-y-2">
                            <p class="text-sm theme-text-secondary">
                                <span class="font-medium theme-text-primary">Nama:</span> <?php echo e($order->user->name); ?>

                            </p>
                            <p class="text-sm theme-text-secondary">
                                <span class="font-medium theme-text-primary">Email:</span> <?php echo e($order->user->email); ?>

                            </p>
                        </div>
                    </div>

                    
                    <div class="theme-border border rounded-lg p-4">
                        <h4 class="font-semibold theme-text-primary mb-3">Info Transaksi</h4>
                        <div class="space-y-2">
                            <p class="text-sm theme-text-secondary">
                                <span class="font-medium theme-text-primary">Total:</span>
                                Rp <?php echo e(number_format($order->amount, 0, ',', '.')); ?>

                            </p>
                            <p class="text-sm theme-text-secondary">
                                <span class="font-medium theme-text-primary">Tanggal Order:</span>
                                <?php echo e($order->created_at->format('d M Y H:i')); ?>

                            </p>
                            <p class="text-sm theme-text-secondary">
                                <span class="font-medium theme-text-primary">Tanggal Bayar:</span>
                                <?php echo e($order->paid_at ? $order->paid_at->format('d M Y H:i') : '-'); ?>

                            </p>
                        </div>
                    </div>

                    
                    <div class="theme-border border rounded-lg p-4 sm:col-span-2">
                        <h4 class="font-semibold theme-text-primary mb-3">Novel yang Dibeli</h4>
                        <div class="flex gap-4">
                            <?php if($order->novel->cover_image): ?>
                                <img src="<?php echo e(asset('storage/' . $order->novel->cover_image)); ?>"
                                    alt="<?php echo e($order->novel->title); ?>" class="w-20 h-28 object-cover rounded shadow-sm">
                            <?php endif; ?>
                            <div>
                                <p class="font-semibold theme-text-primary"><?php echo e($order->novel->title); ?></p>
                                <p class="text-sm theme-text-secondary"><?php echo e($order->novel->author); ?></p>
                                <p class="text-sm theme-text-secondary"><?php echo e($order->novel->genre); ?></p>
                                <p class="text-sm font-semibold text-indigo-400 mt-1">
                                    Rp <?php echo e(number_format($order->novel->price, 0, ',', '.')); ?>

                                </p>
                            </div>
                        </div>
                    </div>

                </div>
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
<?php /**PATH D:\laragon\www\Plot_List\resources\views/admin/transactions/show.blade.php ENDPATH**/ ?>