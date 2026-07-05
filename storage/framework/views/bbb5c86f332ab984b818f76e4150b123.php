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
                Edit Novel
            </h2>
            <a href="<?php echo e(route('admin.novels.index')); ?>"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm transition">
                Kembali
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12 theme-app min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="theme-card border rounded-xl shadow-sm p-6">

                <?php if($errors->any()): ?>
                    <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-lg mb-5">
                        <ul class="list-disc list-inside text-sm space-y-1">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('admin.novels.update', $novel)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Judul Novel</label>
                        <input type="text" name="title" value="<?php echo e(old('title', $novel->title)); ?>"
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan judul novel">
                    </div>

                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Penulis</label>
                        <input type="text" name="author" value="<?php echo e(old('author', $novel->author)); ?>"
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan nama penulis">
                    </div>

                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-2">Genre</label>
                        <div class="grid grid-cols-2 gap-2">
                            <?php $__currentLoopData = ['Action', 'Drama', 'Fantasy', 'Horror', 'Isekai', 'Mystery', 'Romance', 'Shounen', 'Slice of Life', 'Supernatural']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="genre[]" value="<?php echo e($genre); ?>"
                                        <?php echo e(in_array($genre, old('genre', explode(',', $novel->genre))) ? 'checked' : ''); ?>

                                        class="accent-blue-500 w-4 h-4">
                                    <span class="text-sm theme-text-primary"><?php echo e($genre); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Tanggal Rilis</label>
                        <input type="date" name="release_date"
                            value="<?php echo e(old('release_date', $novel->release_date)); ?>"
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Sinopsis</label>
                        <textarea name="description" rows="5"
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan sinopsis novel"><?php echo e(old('description', $novel->description)); ?></textarea>
                    </div>

                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Cover Novel</label>

                        <?php if($novel->cover_image): ?>
                            <img src="<?php echo e(asset('storage/' . $novel->cover_image)); ?>" alt="<?php echo e($novel->title); ?>"
                                class="w-32 h-44 object-cover rounded-lg mb-2 border theme-border">
                            <p class="text-xs theme-text-muted mb-2">Cover saat ini. Upload baru untuk mengganti.</p>
                        <?php endif; ?>

                        <input type="file" name="cover_image" accept="image/*"
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none">
                        <p class="text-xs theme-text-muted mt-1">Format: JPG, JPEG, PNG, WEBP. Maks: 2MB</p>
                    </div>

                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Harga (Rp)</label>
                        <input type="number" name="price" value="<?php echo e(old('price', $novel->price)); ?>"
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Contoh: 50000">
                    </div>

                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Rating (0–5)</label>
                        <input type="number" name="rating" value="<?php echo e(old('rating', $novel->rating ?? 0)); ?>"
                            min="0" max="5" step="0.1"
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Contoh: 4.5">
                        <p class="text-xs theme-text-muted mt-1">Masukkan nilai antara 0 – 5</p>
                    </div>

                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">File Novel (PDF)</label>
                        <?php if($novel->file_path): ?>
                            <p class="text-xs theme-text-muted mb-2">File saat ini: <?php echo e(basename($novel->file_path)); ?></p>
                        <?php endif; ?>
                        <input type="file" name="file_path" accept=".pdf,.epub"
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none">
                        <p class="text-xs theme-text-muted mt-1">Format: PDF atau ePub. Kosongkan jika tidak ingin mengubah.</p>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-lg font-semibold transition">
                        Update Novel
                    </button>

                    <script>
                        document.querySelector('form').addEventListener('submit', function(e) {
                            const checked = document.querySelectorAll('input[name="genre[]"]:checked');
                            if (checked.length === 0) {
                                e.preventDefault();
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Genre belum dipilih!',
                                    text: 'Pilih minimal satu genre untuk novel ini.',
                                    background: document.documentElement.classList.contains('theme-light') ? '#ffffff' : '#1f2937',
                                    color: document.documentElement.classList.contains('theme-light') ? '#0f172a' : '#fff',
                                    confirmButtonColor: '#4f46e5',
                                });
                            }
                        });
                    </script>
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
<?php /**PATH D:\laragon\www\Plot_List\resources\views/admin/novels/edit.blade.php ENDPATH**/ ?>