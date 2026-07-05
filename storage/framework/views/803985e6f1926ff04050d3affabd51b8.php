<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Anti-flash theme loader script -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('admin-theme') || 'theme-blue-black';
            document.documentElement.className = savedTheme;
        })();
    </script>

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="font-sans antialiased theme-app">
    <div id="theme-wrapper" class="min-h-screen theme-app">
        <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Page Heading -->
        <?php if(isset($header)): ?>
            <header class="theme-header border-b shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <!-- Page Content -->
        <main>
            <?php echo e($slot); ?>

        </main>

        <?php if(auth()->check() && auth()->user()->role === 'user'): ?>
            <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?>
    </div>
    <script>
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }

        // Simpan scroll position saat klik link apapun dari halaman novels
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && window.location.pathname === '/novels') {
                localStorage.setItem('novelScrollY', window.scrollY);
            }
        });

        // Restore saat kembali ke /novels
        window.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>
    <script>
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }

        // Simpan scroll position saat klik link apapun dari halaman novels
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && window.location.pathname === '/novels') {
                localStorage.setItem('novelScrollY', window.scrollY);
            }
        });

        // Restore saat kembali ke /novels
        window.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if(session('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: <?php echo json_encode(session('success'), 15, 512) ?>,
                background: '#1f2937',
                color: '#fff',
                confirmButtonColor: '#2563eb',
            });
        <?php endif; ?>

        <?php if(session('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: <?php echo json_encode(session('error'), 15, 512) ?>,
                background: '#1f2937',
                color: '#fff',
                confirmButtonColor: '#2563eb',
            });
        <?php endif; ?>

        <?php if($errors->any()): ?>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                html: `<?php echo implode('<br>', $errors->all()); ?>`,
                background: '#1f2937',
                color: '#fff',
                confirmButtonColor: '#2563eb',
            });
        <?php endif; ?>
    </script>

    <!-- Theme Switcher Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeBtn = document.getElementById('theme-toggle-btn');
            const themeBtnMobile = document.getElementById('theme-toggle-btn-mobile');
            const sunIcon = document.getElementById('theme-toggle-sun');
            const moonIcon = document.getElementById('theme-toggle-moon');
            const themeTextMobile = document.getElementById('theme-text-mobile');

            if (themeBtn && sunIcon && moonIcon) {
                function updateIcons(theme) {
                    if (theme === 'theme-light') {
                        sunIcon.classList.add('hidden');
                        moonIcon.classList.remove('hidden');
                        if (themeTextMobile) themeTextMobile.textContent = 'Light Mode';
                    } else {
                        sunIcon.classList.remove('hidden');
                        moonIcon.classList.add('hidden');
                        if (themeTextMobile) themeTextMobile.textContent = 'Dark/Blue-Black';
                    }
                }

                let currentTheme = localStorage.getItem('admin-theme') || 'theme-blue-black';
                updateIcons(currentTheme);

                function toggleTheme() {
                    if (currentTheme === 'theme-blue-black') {
                        document.documentElement.className = 'theme-light';
                        currentTheme = 'theme-light';
                    } else {
                        document.documentElement.className = 'theme-blue-black';
                        currentTheme = 'theme-blue-black';
                    }
                    localStorage.setItem('admin-theme', currentTheme);
                    updateIcons(currentTheme);
                    window.dispatchEvent(new Event('theme-changed'));
                }

                themeBtn.addEventListener('click', toggleTheme);
                if (themeBtnMobile) {
                    themeBtnMobile.addEventListener('click', toggleTheme);
                }
            }
        });
    </script>
</body>
</html>
<?php /**PATH D:\laragon\www\Plot_List\resources\views/layouts/app.blade.php ENDPATH**/ ?>