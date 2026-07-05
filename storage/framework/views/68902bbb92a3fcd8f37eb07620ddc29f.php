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
                Kelola User
            </h2>
            <a href="<?php echo e(route('admin.users.create')); ?>"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                + Tambah User
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="theme-card rounded-lg border p-4 text-center">
                    <p class="text-sm theme-text-secondary">Total User</p>
                    <p class="text-2xl font-bold text-blue-500"><?php echo e($totalUsers); ?></p>
                </div>
                <div class="theme-card rounded-lg border p-4 text-center">
                    <p class="text-sm theme-text-secondary">Total Admin</p>
                    <p class="text-2xl font-bold text-red-500"><?php echo e($totalAdmins); ?></p>
                </div>
            </div>

            
            <form method="GET" action="<?php echo e(route('admin.users.index')); ?>" class="mb-6">
                <div class="flex gap-3">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                        placeholder="Cari nama atau email user..."
                        class="theme-input flex-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <a href="<?php echo e(route('admin.users.index')); ?>" id="search-reset"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm text-center <?php echo e(!request('search') ? 'hidden' : ''); ?> transition">
                        Reset
                    </a>
                </div>
            </form>

            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div id="admin-users-container" class="theme-card overflow-hidden rounded-lg border shadow-sm">
                <table class="w-full text-sm text-left">
                    <thead class="theme-table-header border-b text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Role</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="theme-table-row border-b theme-border">
                                <td class="px-6 py-4 theme-text-primary"><?php echo e($index + 1); ?></td>
                                <td class="px-6 py-4 font-semibold theme-text-primary"><?php echo e($user->name); ?></td>
                                <td class="px-6 py-4 theme-text-secondary"><?php echo e($user->email); ?></td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2.5 py-1 rounded-full text-xs font-semibold
                                        <?php echo e($user->role === 'admin' ? 'bg-red-500/10 text-red-400 border border-red-500/20' : 'bg-blue-500/10 text-blue-400 border border-blue-500/20'); ?>">
                                        <?php echo e(ucfirst($user->role)); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="<?php echo e(route('admin.users.edit', $user)); ?>"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded text-xs transition">
                                        Edit
                                    </a>
                                    <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST"
                                        onsubmit="return confirm('Yakin hapus user ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-xs transition">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center theme-text-muted">
                                    User tidak ditemukan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            const container = document.getElementById('admin-users-container');
            const resetBtn = document.getElementById('search-reset');
            const form = searchInput ? searchInput.closest('form') : null;

            if (searchInput && container && form) {
                let debounceTimeout;

                function performSearch() {
                    const searchVal = searchInput.value;

                    const params = new URLSearchParams();
                    if (searchVal) params.append('search', searchVal);

                    const url = `${form.action}?${params.toString()}`;

                    // Update URL
                    window.history.replaceState(null, '', url);

                    // Toggle reset button
                    if (resetBtn) {
                        if (searchVal) {
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
                            const newContent = doc.getElementById('admin-users-container');
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

                if (resetBtn) {
                    resetBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        searchInput.value = '';
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
<?php /**PATH D:\laragon\www\Plot_List\resources\views/admin/users/index.blade.php ENDPATH**/ ?>