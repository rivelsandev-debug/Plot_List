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
                Admin Dashboard
            </h2>
            <a href="<?php echo e(route('admin.novels.create')); ?>"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm transition">
                + Tambah Novel
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="theme-card rounded-lg p-5 border transition-all duration-300 hover:scale-105">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-blue-500/10 border border-blue-500/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs theme-text-secondary">Total User</p>
                            <p class="text-2xl font-bold theme-text-primary"><?php echo e($totalUsers); ?></p>
                        </div>
                    </div>
                </div>

                <div class="theme-card rounded-lg p-5 border transition-all duration-300 hover:scale-105">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-indigo-500/10 border border-indigo-500/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs theme-text-secondary">Total Novel</p>
                            <p class="text-2xl font-bold theme-text-primary"><?php echo e($totalNovels); ?></p>
                        </div>
                    </div>
                </div>

                <div class="theme-card rounded-lg p-5 border transition-all duration-300 hover:scale-105">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-yellow-500/10 border border-yellow-500/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs theme-text-secondary">Total Transaksi</p>
                            <p class="text-2xl font-bold theme-text-primary"><?php echo e($totalOrders); ?></p>
                        </div>
                    </div>
                </div>

                <div class="theme-card rounded-lg p-5 border transition-all duration-300 hover:scale-105">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-green-500/10 border border-green-500/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs theme-text-secondary">Pendapatan</p>
                            <p class="text-2xl font-bold text-green-400">Rp
                                <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="theme-card rounded-lg border p-6 mb-8">
                <h3 class="font-semibold theme-text-secondary mb-4">Grafik Penjualan <?php echo e(date('Y')); ?></h3>
                <canvas id="salesChart" height="80"></canvas>
            </div>

            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                
                <div class="theme-card rounded-lg border p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold theme-text-primary">Transaksi Terbaru</h3>
                        <a href="<?php echo e(route('admin.transactions.index')); ?>"
                            class="text-indigo-400 hover:text-indigo-300 text-xs font-semibold">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="space-y-3">
                        <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="flex items-center justify-between py-2 border-b theme-border">
                                <div class="flex items-center gap-3">
                                    <?php if($order->novel->cover_image): ?>
                                        <img src="<?php echo e(asset('storage/' . $order->novel->cover_image)); ?>"
                                            class="w-8 h-10 object-cover rounded">
                                    <?php endif; ?>
                                    <div>
                                        <p class="text-sm font-medium theme-text-primary"><?php echo e($order->novel->title); ?></p>
                                        <p class="text-xs theme-text-secondary"><?php echo e($order->user->name); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="theme-text-muted text-sm text-center py-4">Belum ada transaksi.</p>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="theme-card rounded-lg border p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold theme-text-primary">Novel Terlaris</h3>
                        <a href="<?php echo e(route('admin.novels.index')); ?>"
                            class="text-indigo-400 hover:text-indigo-300 text-xs font-semibold">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="space-y-3">
                        <?php $__empty_1 = true; $__currentLoopData = $bestSellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $novel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="flex items-center gap-3 py-2 border-b theme-border">
                                <?php if($novel->cover_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $novel->cover_image)); ?>"
                                        class="w-8 h-10 object-cover rounded">
                                <?php endif; ?>
                                <div class="flex-1">
                                    <p class="text-sm font-medium theme-text-primary"><?php echo e($novel->title); ?></p>
                                    <p class="text-xs theme-text-secondary"><?php echo e($novel->author); ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-indigo-400"><?php echo e($novel->orders_count); ?> terjual
                                    </p>
                                    <p class="text-xs theme-text-secondary">Rp <?php echo e(number_format($novel->price, 0, ',', '.')); ?>

                                    </p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="theme-text-muted text-sm text-center py-4">Belum ada data penjualan.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        const salesData = Array(12).fill(0);

        <?php $__currentLoopData = $monthlySales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            salesData[<?php echo e($data->month - 1); ?>] = <?php echo e($data->total); ?>;
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        const chartElement = document.getElementById('salesChart');
        let salesChart = null;

        function initChart() {
            const isDark = !document.documentElement.classList.contains('theme-light');
            const gridColor = isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
            const textColor = isDark ? '#94a3b8' : '#475569';

            if (salesChart) {
                salesChart.destroy();
            }

            salesChart = new Chart(chartElement, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: salesData,
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        borderColor: 'rgba(99, 102, 241, 1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: { color: gridColor },
                            ticks: { color: textColor }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: gridColor },
                            ticks: { color: textColor }
                        }
                    }
                }
            });
        }

        if (chartElement) {
            initChart();
            window.addEventListener('theme-changed', initChart);
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
<?php /**PATH D:\laragon\www\Plot_List\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>