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
    <div class="theme-app min-h-screen">

        
        <div class="theme-hero pt-16 pb-12 px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl font-bold theme-text-primary mb-3">Temukan Novel Favoritmu</h1>
                <p class="theme-text-secondary mb-8">Ribuan novel dari berbagai genre siap untuk kamu baca</p>

                <form method="GET" action="<?php echo e(route('novels.index')); ?>">
                    <div class="flex gap-2 theme-card rounded-xl p-2 shadow-lg border">
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                            placeholder="Cari judul atau penulis..."
                            class="flex-1 bg-transparent theme-text-primary placeholder-gray-500 px-4 py-2 focus:outline-none text-sm">
                        <select name="genre"
                            class="theme-input rounded-lg pl-3 pr-8 py-2 text-sm focus:outline-none border-none appearance-none cursor-pointer"
                            style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%236b7280%22 stroke-width=%222%22><polyline points=%2219 9 12 16 5 9%22/></svg>'); background-repeat: no-repeat; background-position: right 8px center; background-size: 16px 16px;">

                            <option value="">Semua Genre</option>
                            <option value="Action" <?php echo e(request('genre') === 'Action' ? 'selected' : ''); ?>>Action</option>
                            <option value="Drama" <?php echo e(request('genre') === 'Drama' ? 'selected' : ''); ?>>Drama</option>
                            <option value="Fantasy" <?php echo e(request('genre') === 'Fantasy' ? 'selected' : ''); ?>>Fantasy
                            </option>
                            <option value="Horror" <?php echo e(request('genre') === 'Horror' ? 'selected' : ''); ?>>Horror</option>
                            <option value="Isekai" <?php echo e(request('genre') === 'Isekai' ? 'selected' : ''); ?>>Isekai</option>
                            <option value="Mystery" <?php echo e(request('genre') === 'Mystery' ? 'selected' : ''); ?>>Mystery
                            </option>
                            <option value="Romance" <?php echo e(request('genre') === 'Romance' ? 'selected' : ''); ?>>Romance
                            </option>
                            <option value="Shounen" <?php echo e(request('genre') === 'Shounen' ? 'selected' : ''); ?>>Shounen
                            </option>
                            <option value="Slice of Life" <?php echo e(request('genre') === 'Slice of Life' ? 'selected' : ''); ?>>
                                Slice of Life</option>
                            <option value="Supernatural" <?php echo e(request('genre') === 'Supernatural' ? 'selected' : ''); ?>>
                                Supernatural</option>
                        </select>
                        <a href="<?php echo e(route('novels.index')); ?>" id="search-reset"
                            class="bg-gray-600 hover:bg-gray-500 text-white px-4 py-2 rounded-lg text-sm transition <?php echo e(!request('search') && !request('genre') ? 'hidden' : ''); ?>">
                            ✕
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 pb-16" id="novels-container">

            <?php if(!request('search') && !request('genre')): ?>
                
                <div class="mb-12">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold theme-text-primary">🔥 Novel Populer</h2>
                    </div>
                    <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-4">
                        <?php $__currentLoopData = $popularNovels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $novel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('novels.show', $novel)); ?>" class="group">
                                <div
                                    class="relative overflow-hidden rounded-lg aspect-[2/3] bg-gray-800/50 border theme-border">
                                    <?php if($novel->cover_image): ?>
                                        <img src="<?php echo e(asset('storage/' . $novel->cover_image)); ?>"
                                            alt="<?php echo e($novel->title); ?>"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    <?php else: ?>
                                        <div
                                            class="w-full h-full bg-gray-700/30 flex items-center justify-center border theme-border">
                                            <span class="theme-text-muted text-xs">No Cover</span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-2">
                                        <div>
                                            <p class="text-white text-xs font-semibold truncate"><?php echo e($novel->title); ?>

                                            </p>
                                            <p class="text-blue-400 text-xs font-bold">Rp
                                                <?php echo e(number_format($novel->price, 0, ',', '.')); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <p class="theme-text-primary text-xs mt-2 truncate"><?php echo e($novel->title); ?></p>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="border-t theme-border mb-10"></div>
            <?php endif; ?>

            
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold theme-text-primary">
                        <?php if(request('search') || request('genre')): ?>
                            🔍 Hasil Pencarian
                        <?php else: ?>
                            📚 Semua Novel
                        <?php endif; ?>
                    </h2>
                    <?php if(request('search') || request('genre')): ?>
                        <span class="theme-text-secondary text-sm"><?php echo e($novels->count()); ?> novel ditemukan</span>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-5">
                    <?php $__empty_1 = true; $__currentLoopData = $novels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $novel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e(route('novels.show', $novel)); ?>" class="group">
                            <div
                                class="relative overflow-hidden rounded-xl aspect-[2/3] bg-gray-800/50 border theme-border mb-3">
                                <?php if($novel->cover_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $novel->cover_image)); ?>" alt="<?php echo e($novel->title); ?>"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <?php else: ?>
                                    <div
                                        class="w-full h-full bg-gray-800/30 flex items-center justify-center border theme-border">
                                        <span class="theme-text-muted text-xs">No Cover</span>
                                    </div>
                                <?php endif; ?>
                                
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-3">
                                    <div class="w-full">
                                        <p class="text-blue-400 text-sm font-bold">Rp
                                            <?php echo e(number_format($novel->price, 0, ',', '.')); ?></p>
                                        <div class="flex flex-wrap gap-1 mt-1">
                                            <?php $__currentLoopData = explode(',', $novel->genre); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span
                                                    class="bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs px-2 py-0.5 rounded-full"><?php echo e(trim($g)); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h3
                                class="theme-text-primary text-sm font-semibold truncate group-hover:text-blue-400 transition">
                                <?php echo e($novel->title); ?></h3>
                            <p class="theme-text-secondary text-xs truncate"><?php echo e($novel->author); ?></p>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-span-5 text-center py-20">
                            <p class="theme-text-muted text-lg">Novel tidak ditemukan.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Restore scroll position
            if (window.location.pathname === '/novels') {
                const y = localStorage.getItem('novelScrollY');
                if (y) {
                    setTimeout(function() {
                        window.scrollTo({
                            top: parseInt(y),
                            behavior: 'smooth'
                        });
                        localStorage.removeItem('novelScrollY');
                    }, 100);
                }
            }

            // Real-time Search
            const searchInput = document.querySelector('input[name="search"]');
            const genreSelect = document.querySelector('select[name="genre"]');
            const novelsContainer = document.getElementById('novels-container');
            const resetBtn = document.getElementById('search-reset');
            const form = searchInput ? searchInput.closest('form') : null;

            if (searchInput && genreSelect && novelsContainer && form) {
                let debounceTimeout;

                function performSearch() {
                    const searchVal = searchInput.value;
                    const genreVal = genreSelect.value;

                    const params = new URLSearchParams();
                    if (searchVal) params.append('search', searchVal);
                    if (genreVal) params.append('genre', genreVal);

                    const url = `${form.action}?${params.toString()}`;

                    // Update URL bar
                    window.history.replaceState(null, '', url);

                    // Show/hide reset button
                    if (resetBtn) {
                        if (searchVal || genreVal) {
                            resetBtn.classList.remove('hidden');
                        } else {
                            resetBtn.classList.add('hidden');
                        }
                    }

                    // Loading effect
                    novelsContainer.style.opacity = '0.5';

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newContent = doc.getElementById('novels-container');
                            if (newContent) {
                                novelsContainer.innerHTML = newContent.innerHTML;
                            }
                            novelsContainer.style.opacity = '1';
                        })
                        .catch(err => {
                            console.error(err);
                            novelsContainer.style.opacity = '1';
                        });
                }

                searchInput.addEventListener('input', () => {
                    clearTimeout(debounceTimeout);
                    debounceTimeout = setTimeout(performSearch, 300);
                });

                genreSelect.addEventListener('change', performSearch);

                if (resetBtn) {
                    resetBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        searchInput.value = '';
                        genreSelect.value = '';
                        performSearch();
                    });
                }

                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    performSearch();
                });
            }
        });

        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && window.location.pathname === '/novels') {
                localStorage.setItem('novelScrollY', window.scrollY);
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
<?php /**PATH D:\laragon\www\Plot_List\resources\views/novels/index.blade.php ENDPATH**/ ?>