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
                Riwayat Pembelian
            </h2>
            <a href="<?php echo e(url()->previous()); ?>"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm transition">
                Kembali
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="theme-app min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <?php if($orders->isEmpty()): ?>
                <div class="theme-card border rounded-lg p-12 text-center">
                    <p class="theme-text-secondary text-lg mb-4">Belum ada pembelian!</p>
                    <a href="<?php echo e(route('novels.index')); ?>"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition inline-block">
                        Cari Novel
                    </a>
                </div>
            <?php else: ?>
                <div class="theme-card border rounded-lg shadow overflow-hidden">
                    <table class="w-full text-sm text-left">
                        <thead class="theme-table-header border-b text-xs uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Novel</th>
                                <th class="px-6 py-4">Order ID</th>
                                <th class="px-6 py-4">Harga</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $cacheKey = 'delete_order_' . auth()->id() . '_' . now()->toDateString();
                                    $deleteCount = \Illuminate\Support\Facades\Cache::get($cacheKey, 0);
                                    $canDelete = $deleteCount < 3;
                                    $remaining = 3 - $deleteCount;

                                    $statusClass = match ($order->status) {
                                        'success' => 'bg-green-500/10 text-green-400 border border-green-500/20',
                                        'pending' => 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20',
                                        'failed'  => 'bg-red-500/10 text-red-400 border border-red-500/20',
                                        default   => 'bg-gray-500/10 text-gray-400 border border-gray-500/20',
                                    };
                                ?>
                                <tr class="theme-table-row border-b theme-border">

                                    
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-4">
                                            <?php if($order->novel->cover_image): ?>
                                                <img src="<?php echo e(asset('storage/' . $order->novel->cover_image)); ?>"
                                                    alt="<?php echo e($order->novel->title); ?>"
                                                    class="w-16 h-24 object-cover rounded-lg border theme-border shadow-sm flex-shrink-0">
                                            <?php else: ?>
                                                <div class="w-16 h-24 bg-gray-700/30 rounded-lg border theme-border flex items-center justify-center flex-shrink-0">
                                                    <span class="theme-text-muted text-xs">N/A</span>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <p class="font-semibold theme-text-primary text-sm"><?php echo e($order->novel->title); ?></p>
                                                <p class="text-xs theme-text-secondary mt-0.5"><?php echo e($order->novel->author); ?></p>
                                            </div>
                                        </div>
                                    </td>

                                    
                                    <td class="px-6 py-5 theme-text-muted font-mono text-xs">
                                        <?php echo e($order->order_id); ?>

                                    </td>

                                    
                                    <td class="px-6 py-5 theme-text-primary font-bold whitespace-nowrap">
                                        Rp <?php echo e(number_format($order->amount, 0, ',', '.')); ?>

                                    </td>

                                    
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold <?php echo e($statusClass); ?>">
                                            <?php echo e(ucfirst($order->status)); ?>

                                        </span>
                                    </td>

                                    
                                    <td class="px-6 py-5 theme-text-secondary text-xs whitespace-nowrap">
                                        <?php echo e($order->created_at->format('d M Y')); ?><br>
                                        <span class="theme-text-muted"><?php echo e($order->created_at->format('H:i')); ?></span>
                                    </td>

                                    
                                    <td class="px-6 py-5">

                                        
                                        <?php if($order->status === 'success' && $order->novel->file_path): ?>
                                            <a href="<?php echo e(route('orders.download', $order)); ?>"
                                                class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-xs font-medium transition whitespace-nowrap">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                Download
                                            </a>

                                        
                                        <?php elseif($order->status === 'pending'): ?>
                                            
                                            <?php if($canDelete): ?>
                                                <form id="form-pending-<?php echo e($order->id); ?>"
                                                    action="<?php echo e(route('orders.destroyPending', $order)); ?>"
                                                    method="POST" class="hidden">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>
                                            <?php endif; ?>

                                            <div class="flex flex-row items-center gap-2 flex-wrap">
                                                <a href="<?php echo e(route('orders.repay', $order)); ?>"
                                                    class="inline-flex items-center gap-1.5 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-xs font-medium transition whitespace-nowrap">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                    </svg>
                                                    Lanjut Bayar
                                                </a>

                                                <?php if($canDelete): ?>
                                                    <button type="button"
                                                        onclick="confirmDelete('pending', <?php echo e($order->id); ?>, '<?php echo e(addslashes($order->novel->title)); ?>')"
                                                        class="inline-flex items-center gap-1.5 border border-red-500/40 text-red-400 hover:bg-red-500/10 px-4 py-2 rounded-lg text-xs font-medium transition whitespace-nowrap">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Batalkan
                                                    </button>
                                                <?php else: ?>
                                                    <span class="inline-flex items-center gap-1.5 text-gray-500 border border-gray-500/20 px-4 py-2 rounded-lg text-xs cursor-not-allowed whitespace-nowrap">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636" />
                                                        </svg>
                                                        Limit Tercapai
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <?php if($canDelete): ?>
                                                <p class="text-[10px] theme-text-muted mt-1.5">Sisa batalkan: <?php echo e($remaining); ?>x hari ini</p>
                                            <?php endif; ?>

                                        
                                        <?php elseif($order->status === 'failed'): ?>
                                            <?php if($canDelete): ?>
                                                <form id="form-failed-<?php echo e($order->id); ?>"
                                                    action="<?php echo e(route('orders.destroyFailed', $order)); ?>"
                                                    method="POST" class="hidden">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>
                                                <button type="button"
                                                    onclick="confirmDelete('failed', <?php echo e($order->id); ?>, '<?php echo e(addslashes($order->novel->title)); ?>')"
                                                    class="inline-flex items-center gap-1.5 bg-red-600/80 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-xs font-medium transition whitespace-nowrap">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                                <p class="text-[10px] theme-text-muted mt-1.5">Sisa hapus: <?php echo e($remaining); ?>x hari ini</p>
                                            <?php else: ?>
                                                <span class="inline-flex items-center gap-1.5 bg-gray-500/10 text-gray-500 border border-gray-500/20 px-4 py-2 rounded-lg text-xs cursor-not-allowed whitespace-nowrap">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636" />
                                                    </svg>
                                                    Limit Tercapai
                                                </span>
                                            <?php endif; ?>

                                        <?php else: ?>
                                            <span class="theme-text-muted text-xs">—</span>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function confirmDelete(type, orderId, novelTitle) {
            const isDark = !document.documentElement.classList.contains('theme-light');
            const bg    = isDark ? '#0f172a' : '#ffffff';
            const color = isDark ? '#f8fafc' : '#0f172a';

            const messages = {
                pending: {
                    title: 'Batalkan Pesanan?',
                    text: `Pesanan "${novelTitle}" yang belum dibayar akan dihapus permanen.`,
                    confirmText: 'Ya, Batalkan',
                },
                failed: {
                    title: 'Hapus Riwayat?',
                    text: `Riwayat pesanan gagal "${novelTitle}" akan dihapus permanen.`,
                    confirmText: 'Ya, Hapus',
                },
            };

            const msg = messages[type];

            Swal.fire({
                title: msg.title,
                text: msg.text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: msg.confirmText,
                cancelButtonText: 'Batal',
                background: bg,
                color: color,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`form-${type}-${orderId}`).submit();
                }
            });
        }
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
<?php /**PATH D:\laragon\www\Plot_List\resources\views/orders/history.blade.php ENDPATH**/ ?>