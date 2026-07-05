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
            <h2 class="font-semibold text-xl theme-text-primary leading-tight">Semua Transaksi</h2>
            <a id="export-csv-btn" href="<?php echo e(route('admin.transactions.export', request()->query())); ?>"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm transition">
                Export CSV
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
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

            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="theme-card rounded-lg border p-4">
                    <p class="text-sm theme-text-secondary">Total Pendapatan</p>
                    <p class="text-xl font-bold theme-text-primary">Rp <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?>

                    </p>
                </div>
                <div class="theme-card rounded-lg border p-4">
                    <p class="text-sm theme-text-secondary">Total Order</p>
                    <p class="text-xl font-bold theme-text-primary"><?php echo e($totalOrders); ?></p>
                </div>
                <div class="theme-card rounded-lg border p-4">
                    <p class="text-sm theme-text-secondary">Order Sukses</p>
                    <p class="text-xl font-bold text-green-400"><?php echo e($successOrders); ?></p>
                </div>
                <div class="theme-card rounded-lg border p-4">
                    <p class="text-sm theme-text-secondary">Order Pending</p>
                    <p class="text-xl font-bold text-yellow-400"><?php echo e($pendingOrders); ?></p>
                </div>
            </div>

            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                
                <div class="theme-card rounded-lg border p-6">
                    <h3 class="font-semibold theme-text-secondary mb-4">Pendapatan Per Bulan (<?php echo e(date('Y')); ?>)</h3>
                    <canvas id="revenueChart"></canvas>
                </div>

                
                <div class="theme-card rounded-lg border p-6">
                    <h3 class="font-semibold theme-text-secondary mb-4">Status Transaksi</h3>
                    <canvas id="statusChart"></canvas>
                </div>
            </div>

            
            <form method="GET" action="<?php echo e(route('admin.transactions.index')); ?>"
                class="theme-card rounded-lg border p-4 mb-6">
                <div class="flex flex-col sm:flex-row gap-3">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                        placeholder="Cari nama user atau judul novel..."
                        class="theme-input flex-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <select name="status"
                        class="theme-input border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="success" <?php echo e(request('status') === 'success' ? 'selected' : ''); ?>>Success
                        </option>
                        <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Pending
                        </option>
                        
                    </select>

                    <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>"
                        class="theme-input border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>"
                        class="theme-input border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                        Filter
                    </button>

                    <a href="<?php echo e(route('admin.transactions.index')); ?>" id="search-reset"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm text-center <?php echo e(!request('search') && !request('status') && !request('date_from') && !request('date_to') ? 'hidden' : ''); ?> transition">
                        Reset
                    </a>
                </div>
            </form>

            
            <div id="admin-transactions-container" class="theme-card rounded-lg border shadow-sm overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="theme-table-header border-b text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3">Order ID</th>
                            <th class="px-6 py-3">User</th>
                            <th class="px-6 py-3">Novel</th>
                            <th class="px-6 py-3">Harga</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="theme-table-row border-b theme-border">
                                <td class="px-6 py-4 font-mono text-xs theme-text-muted"><?php echo e($order->order_id); ?></td>
                                <td class="px-6 py-4">
                                    <p class="font-semibold theme-text-primary"><?php echo e($order->user->name); ?></p>
                                    <p class="text-xs theme-text-secondary"><?php echo e($order->user->email); ?></p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <?php if($order->novel->cover_image): ?>
                                            <img src="<?php echo e(asset('storage/' . $order->novel->cover_image)); ?>"
                                                class="w-8 h-10 object-cover rounded shadow-sm">
                                        <?php endif; ?>
                                        <span class="font-medium theme-text-primary"><?php echo e($order->novel->title); ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold theme-text-primary">
                                    Rp <?php echo e(number_format($order->amount, 0, ',', '.')); ?>

                                </td>
                                <td class="px-6 py-4">
                                    <?php
                                        $statusClass = match ($order->status) {
                                            'success' => 'bg-green-500/10 text-green-400 border border-green-500/20',
                                            'pending' => 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20',
                                            'failed' => 'bg-red-500/10 text-red-400 border border-red-500/20',
                                            default => 'bg-gray-500/10 text-gray-400 border border-gray-500/20',
                                        };
                                    ?>
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold <?php echo e($statusClass); ?>">
                                        <?php echo e(ucfirst($order->status)); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 theme-text-secondary text-xs">
                                    <?php echo e($order->created_at->format('d M Y H:i')); ?>

                                </td>
                                <td class="px-6 py-4">
                                    <a href="<?php echo e(route('admin.transactions.show', $order)); ?>"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-xs transition">
                                        Detail
                                    </a>
                                    <?php if($order->status === 'failed'): ?>
                                        <form action="<?php echo e(route('admin.transactions.destroy', $order)); ?>" method="POST"
                                            class="inline-block ml-1"
                                            onsubmit="return confirm('Hapus transaksi gagal ini secara permanen?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-xs transition">
                                                Hapus
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center theme-text-muted">
                                    Belum ada transaksi.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data pendapatan per bulan
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        const revenueData = Array(12).fill(0);

        <?php $__currentLoopData = $monthlyRevenue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            revenueData[<?php echo e($data->month - 1); ?>] = <?php echo e($data->total); ?>;
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        const revenueChartEl = document.getElementById('revenueChart');
        const statusChartEl = document.getElementById('statusChart');
        let revenueChart = null;
        let statusChart = null;

        function initCharts() {
            const isDark = !document.documentElement.classList.contains('theme-light');
            const gridColor = isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
            const textColor = isDark ? '#94a3b8' : '#475569';

            if (revenueChart) revenueChart.destroy();
            if (statusChart) statusChart.destroy();

            if (revenueChartEl) {
                revenueChart = new Chart(revenueChartEl, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Pendapatan (Rp)',
                            data: revenueData,
                            backgroundColor: 'rgba(99, 102, 241, 0.5)',
                            borderColor: 'rgba(99, 102, 241, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                labels: {
                                    color: textColor
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    color: gridColor
                                },
                                ticks: {
                                    color: textColor
                                }
                            },
                            y: {
                                grid: {
                                    color: gridColor
                                },
                                ticks: {
                                    color: textColor
                                }
                            }
                        }
                    }
                });
            }

            if (statusChartEl) {
                statusChart = new Chart(statusChartEl, {
                    type: 'doughnut',
                    data: {
                        labels: ['Success', 'Pending'],
                        datasets: [{
                            data: [<?php echo e($statusData['success']); ?>, <?php echo e($statusData['pending']); ?>],
                            backgroundColor: ['#22c55e', '#eab308'],
                            borderWidth: isDark ? 2 : 1,
                            borderColor: isDark ? '#0f172a' : '#ffffff'
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                labels: {
                                    color: textColor
                                }
                            }
                        }
                    }
                });
            }
        }

        if (revenueChartEl || statusChartEl) {
            initCharts();
            window.addEventListener('theme-changed', initCharts);
        }

        // Real-time Search & Filter
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            const statusSelect = document.querySelector('select[name="status"]');
            const dateFromInput = document.querySelector('input[name="date_from"]');
            const dateToInput = document.querySelector('input[name="date_to"]');
            const container = document.getElementById('admin-transactions-container');
            const resetBtn = document.getElementById('search-reset');
            const exportBtn = document.getElementById('export-csv-btn');
            const form = searchInput ? searchInput.closest('form') : null;

            if (form && container) {
                let debounceTimeout;

                function performSearch() {
                    const searchVal = searchInput.value;
                    const statusVal = statusSelect.value;
                    const dateFromVal = dateFromInput.value;
                    const dateToVal = dateToInput.value;

                    const params = new URLSearchParams();
                    if (searchVal) params.append('search', searchVal);
                    if (statusVal) params.append('status', statusVal);
                    if (dateFromVal) params.append('date_from', dateFromVal);
                    if (dateToVal) params.append('date_to', dateToVal);

                    const url = `${form.action}?${params.toString()}`;

                    // Update URL
                    window.history.replaceState(null, '', url);

                    // Update CSV Export button link
                    if (exportBtn) {
                        const exportUrl = `${form.action}/export?${params.toString()}`;
                        exportBtn.setAttribute('href', exportUrl);
                    }

                    // Toggle reset button
                    if (resetBtn) {
                        if (searchVal || statusVal || dateFromVal || dateToVal) {
                            resetBtn.classList.remove('hidden');
                        } else {
                            resetBtn.classList.add('hidden');
                        }
                    }

                    // Loading effect
                    container.style.opacity = '0.5';

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newContent = doc.getElementById('admin-transactions-container');
                            if (newContent) {
                                container.innerHTML = newContent.innerHTML;
                            }
                            container.style.opacity = '1';
                        })
                        .catch(err => {
                            console.error(err);
                            container.style.opacity = '1';
                        });
                }

                searchInput.addEventListener('input', () => {
                    clearTimeout(debounceTimeout);
                    debounceTimeout = setTimeout(performSearch, 300);
                });

                statusSelect.addEventListener('change', performSearch);
                dateFromInput.addEventListener('change', performSearch);
                dateToInput.addEventListener('change', performSearch);

                if (resetBtn) {
                    resetBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        searchInput.value = '';
                        statusSelect.value = '';
                        dateFromInput.value = '';
                        dateToInput.value = '';
                        performSearch();
                    });
                }

                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    performSearch();
                });
            }
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
<?php /**PATH D:\laragon\www\Plot_List\resources\views/admin/transactions/index.blade.php ENDPATH**/ ?>