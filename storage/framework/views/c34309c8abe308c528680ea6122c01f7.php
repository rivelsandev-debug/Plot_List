<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlotList — Platform Novel Digital</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        /* Animasi dasar */
        .anim-fade-up {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .anim-fade-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .anim-fade-right {
            opacity: 0;
            transform: translateX(40px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .anim-zoom {
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        /* State saat sudah muncul */
        .anim-visible {
            opacity: 1 !important;
            transform: none !important;
        }

        /* Delay untuk stagger effect */
        .anim-delay-1 {
            transition-delay: 0.1s;
        }

        .anim-delay-2 {
            transition-delay: 0.2s;
        }

        .anim-delay-3 {
            transition-delay: 0.3s;
        }

        .anim-delay-4 {
            transition-delay: 0.4s;
        }

        .anim-delay-5 {
            transition-delay: 0.5s;
        }
    </style>
    <script>
        // Anti-flash loading script for landing page
        if (localStorage.getItem('admin-theme') === 'theme-light') {
            document.documentElement.className = 'theme-light';
        } else {
            document.documentElement.className = 'theme-blue-black';
        }
    </script>
</head>

<body class="theme-app min-h-screen">

    
    <nav class="fixed top-0 w-full theme-header backdrop-blur-lg border-b shadow-lg z-50">
        <div class="px-4 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <img src="<?php echo e(asset('storage/logo/Desain tanpa judul (1).png')); ?>" alt="PlotList" class="h-20 w-auto">
                <div class="flex items-center gap-3">
                    <button id="theme-toggle-btn-landing"
                        class="mr-2 p-2 rounded-lg text-gray-400 hover:text-white focus:outline-none transition-colors duration-150">
                        <!-- Sun Icon (visible in dark theme) -->
                        <svg id="theme-toggle-sun-landing" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-11.314l.707.707m11.314 11.314l.707-.707M12 7a5 5 0 100 10 5 5 0 000-10z" />
                        </svg>
                        <!-- Moon Icon (visible in light theme) -->
                        <svg id="theme-toggle-moon-landing" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(auth()->user()->role === 'admin' ? route('admin.dashboard') : route('novels.index')); ?>"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            Home
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>"
                            class="theme-text-secondary hover:theme-text-primary px-4 py-2 rounded-lg text-sm font-medium transition">
                            Login
                        </a>
                        <a href="<?php echo e(route('register')); ?>"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            Daftar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    
    <div class="min-h-screen bg-cover bg-center bg-no-repeat flex items-center"
        style="background-image: url('https://storage.googleapis.com/ekrutassets/blogs/images/000/008/336/original/Cover_(Sasindo)_(1).jpg');">
        <div class="min-h-screen w-full bg-black/60 flex items-center">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
                <img src="<?php echo e(asset('storage/logo/Desain tanpa judul (1).png')); ?>" alt="PlotList"
                    class="h-48 w-auto mx-auto mb-6 anim-fade-up drop-shadow-lg">
                <h1 class="text-5xl sm:text-7xl font-bold text-white mb-6">
                    Selamat Datang di <span class="text-blue-700">PlotList</span>
                </h1>
                <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
                    Platform novel digital terbaik. Temukan, beli, dan nikmati ribuan novel favoritmu kapan saja dan di
                    mana saja.
                </p>
                <?php if(auth()->guard()->guest()): ?>
                    <div class="flex gap-4 justify-center">
                        <a href="<?php echo e(route('register')); ?>"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold text-lg transition">
                            Mulai Sekarang
                        </a>
                        <a href="<?php echo e(route('login')); ?>"
                            class="bg-blue-500/20 hover:bg-blue-500/30 text-blue-300 border border-blue-500/50 px-8 py-3 rounded-lg font-semibold text-lg transition">
                            Login
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="min-h-screen theme-card border-b flex items-center py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full">

            
            <div class="text-center mb-16 anim-fade-up">
                <p class="text-sm uppercase tracking-widest text-blue-400 font-semibold mb-3">Platform Terbaik</p>
                <h2 class="text-4xl font-bold theme-text-primary sm:text-5xl">Mengapa PlotList?</h2>
                <p class="mt-4 theme-text-secondary max-w-xl mx-auto">
                    Platform novel digital terbaik untuk menemukan, membeli, dan menikmati ribuan novel favoritmu.
                </p>
            </div>

            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-20">
                <div
                    class="theme-card border rounded-2xl p-8 text-center hover:border-blue-500/50 transition anim-fade-up anim-delay-1">
                    <div class="w-14 h-14 bg-blue-600/20 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="theme-text-primary font-semibold text-lg mb-2">Koleksi Lengkap</h3>
                    <p class="theme-text-secondary text-sm">Ribuan novel dari berbagai genre tersedia untuk kamu nikmati
                        kapan saja.</p>
                </div>

                <div
                    class="theme-card border rounded-2xl p-8 text-center hover:border-blue-500/50 transition anim-fade-up anim-delay-2">
                    <div class="w-14 h-14 bg-blue-600/20 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="theme-text-primary font-semibold text-lg mb-2">Pembayaran Aman</h3>
                    <p class="theme-text-secondary text-sm">Transaksi aman menggunakan Midtrans dengan berbagai metode
                        pembayaran.</p>
                </div>

                <div
                    class="theme-card border rounded-2xl p-8 text-center hover:border-blue-500/50 transition anim-fade-up anim-delay-3">
                    <div class="w-14 h-14 bg-blue-600/20 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </div>
                    <h3 class="theme-text-primary font-semibold text-lg mb-2">Download Mudah</h3>
                    <p class="theme-text-secondary text-sm">Setelah membeli, langsung download novel dalam format PDF
                        atau ePub.</p>
                </div>
            </div>

            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="anim-fade-left">
                    <p class="text-sm uppercase tracking-widest text-blue-400 font-semibold mb-3">Tentang Kami</p>
                    <h2 class="text-3xl font-bold theme-text-primary mb-4">Tentang PlotList</h2>
                    <p class="theme-text-secondary mb-8">PlotList adalah platform digital yang menghubungkan pembaca
                        dengan novel-novel berkualitas dari berbagai genre dan penulis.</p>
                    <div class="space-y-5">
                        <div class="flex gap-4">
                            <div
                                class="w-8 h-8 bg-blue-600/20 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="theme-text-primary font-semibold">Visi</h4>
                                <p class="theme-text-secondary text-sm mt-1">Menjadi platform novel digital terdepan di
                                    Indonesia yang menghubungkan penulis dan pembaca.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div
                                class="w-8 h-8 bg-blue-600/20 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="theme-text-primary font-semibold">Misi</h4>
                                <p class="theme-text-secondary text-sm mt-1">Menyediakan akses mudah ke novel
                                    berkualitas dengan harga terjangkau dan pengalaman membaca yang menyenangkan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="grid grid-cols-2 gap-4 anim-fade-right">
                    <div class="theme-card border rounded-2xl p-6 text-center hover:border-blue-500/50 transition">
                        <p class="text-4xl font-bold text-blue-400">100+</p>
                        <p class="theme-text-secondary text-sm mt-2">Novel Tersedia</p>
                    </div>
                    <div class="theme-card border rounded-2xl p-6 text-center hover:border-blue-500/50 transition">
                        <p class="text-4xl font-bold text-blue-400">50+</p>
                        <p class="theme-text-secondary text-sm mt-2">Penulis</p>
                    </div>
                    <div class="theme-card border rounded-2xl p-6 text-center hover:border-blue-500/50 transition">
                        <p class="text-4xl font-bold text-blue-400">1000+</p>
                        <p class="theme-text-secondary text-sm mt-2">Pembaca</p>
                    </div>
                    <div class="theme-card border rounded-2xl p-6 text-center hover:border-blue-500/50 transition">
                        <p class="text-4xl font-bold text-blue-400">10+</p>
                        <p class="theme-text-secondary text-sm mt-2">Genre</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <div class="theme-card border-b py-24 sm:py-32">
        <div class="mx-auto grid max-w-7xl gap-20 px-6 lg:px-8 xl:grid-cols-3">
            <div class="max-w-xl anim-fade-left">
                <h2 class="text-3xl font-semibold tracking-tight theme-text-primary sm:text-4xl">Meet our leadership
                </h2>
                <p class="mt-6 text-lg theme-text-secondary">Kami adalah kelompok individu yang dinamis, yang
                    bersemangat
                    dengan apa yang kami lakukan dan berdedikasi untuk memberikan hasil terbaik bagi klien kami.</p>
            </div>
            <ul role="list" class="grid gap-8 sm:grid-cols-2 xl:col-span-2">
                <li class="anim-fade-up anim-delay-1">
                    <div
                        class="theme-card border rounded-2xl p-6 flex flex-col items-center text-center gap-4 hover:border-blue-500/50 transition">
                        <img src="https://baliexploring.com/wp-content/uploads/2024/11/president.jpg" alt="Rivel"
                            class="w-28 h-28 rounded-full object-cover outline outline-2 outline-offset-2 outline-blue-500/40" />
                        <div>
                            <h3 class="text-base font-semibold theme-text-primary">Rivel</h3>
                            <p class="text-sm font-semibold text-blue-400 mt-1">Co-Founder / CEO</p>
                        </div>
                    </div>
                </li>
                <li class="anim-fade-up anim-delay-2">
                    <div
                        class="theme-card border rounded-2xl p-6 flex flex-col items-center text-center gap-4 hover:border-blue-500/50 transition">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJeHY9pgX79xfu-aLyC_VpRrqWUu-RpyE1yQ&s"
                            alt="Ahmad Fadlan"
                            class="w-28 h-28 rounded-full object-cover outline outline-2 outline-offset-2 outline-blue-500/40" />
                        <div>
                            <h3 class="text-base font-semibold theme-text-primary">Ahmad Fadlan Abu Ismail</h3>
                            <p class="text-sm font-semibold text-blue-400 mt-1">Co-Founder / CTO</p>
                        </div>
                    </div>
                </li>
                <li class="anim-fade-up anim-delay-3">
                    <div
                        class="theme-card border rounded-2xl p-6 flex flex-col items-center text-center gap-4 hover:border-blue-500/50 transition">
                        <img src="https://media.suara.com/pictures/653x366/2026/04/01/74060-ilustrasi-meme-pokoknya-ada.jpg"
                            alt="Dwi Farhan"
                            class="w-28 h-28 rounded-full object-cover outline outline-2 outline-offset-2 outline-blue-500/40" />
                        <div>
                            <h3 class="text-base font-semibold theme-text-primary">Dwi Farhan Syahputra</h3>
                            <p class="text-sm font-semibold text-blue-400 mt-1">Business Relations</p>
                        </div>
                    </div>
                </li>
                <li class="anim-fade-up anim-delay-4">
                    <div
                        class="theme-card border rounded-2xl p-6 flex flex-col items-center text-center gap-4 hover:border-blue-500/50 transition">
                        <img src="https://i.pinimg.com/474x/22/0e/15/220e1540ddacbc192b81ad3084097875.jpg"
                            alt="Dhito"
                            class="w-28 h-28 rounded-full object-cover outline outline-2 outline-offset-2 outline-blue-500/40" />
                        <div>
                            <h3 class="text-base font-semibold theme-text-primary">Dhito Ardhiansyah</h3>
                            <p class="text-sm font-semibold text-blue-400 mt-1">Front-end Developer</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    
    <div class="theme-card border-b px-6 py-24 sm:py-32 lg:px-8">
        <div class="mx-auto max-w-5xl">

            
            <div class="text-center mb-16 anim-fade-up">
                <p class="text-sm uppercase tracking-widest text-yellow-400 font-semibold mb-3">Kontak</p>
                <h2 class="text-4xl font-bold theme-text-primary sm:text-5xl">Hubungi Kami</h2>
                <p class="mt-4 text-lg theme-text-secondary max-w-xl mx-auto">
                    Butuh bantuan atau ingin konsultasi? Kami siap membantu kamu kapan saja.
                </p>
            </div>

            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

                
                <div
                    class="relative overflow-hidden rounded-2xl border theme-border p-8 flex flex-col items-start gap-4">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-green-500/5 rounded-full -translate-y-8 translate-x-8 anim-fade-left">
                    </div>
                    <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/1280px-WhatsApp.svg.png"
                            alt="WhatsApp" class="w-7 h-7">
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-green-400 font-semibold mb-1">WhatsApp</p>
                        <h3 class="text-2xl font-bold theme-text-primary">+62 896-6354-1283</h3>
                        <p class="mt-2 theme-text-secondary text-sm">Senin – Minggu, 08.00 – 22.00 WIB</p>
                    </div>
                    <a href="https://wa.me/6281234567890" target="_blank"
                        class="mt-2 inline-flex items-center gap-2 rounded-xl bg-green-500 hover:bg-green-600 px-5 py-2.5 font-semibold text-white text-sm transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Chat Sekarang
                    </a>
                </div>

                
                <div
                    class="relative overflow-hidden rounded-2xl border theme-border p-8 flex flex-col items-start gap-4 anim-fade-right">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-yellow-500/5 rounded-full -translate-y-8 translate-x-8">
                    </div>
                    <div class="w-12 h-12 bg-yellow-500/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-yellow-400 font-semibold mb-1">Lokasi Kantor
                        </p>
                        <h3 class="text-2xl font-bold theme-text-primary">PlotList Office</h3>
                        <p class="mt-2 theme-text-secondary text-sm">BSD Sektor XIV Blok C1/1, Jalan Letnan Sutopo,
                            Serpong, Lengkong Gudang Timur, Tangerang Selatan,<br>Banten 15311</p>
                        <p class="mt-2 theme-text-secondary text-sm">Senin – Jumat, 08.00 – 17.00 WIB</p>
                    </div>
                    <a href="https://maps.google.com/?q=-6.2088,106.8456" target="_blank"
                        class="mt-2 inline-flex items-center gap-2 rounded-xl bg-yellow-500 hover:bg-yellow-400 px-5 py-2.5 font-semibold text-black text-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Buka di Google Maps
                    </a>
                </div>
            </div>

            
            <div class="overflow-hidden rounded-2xl border theme-border anim-fade-up anim-delay-2">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.6919075685973!2d106.687102!3d-6.30415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fad394552115%3A0xbf0c8c4f234a7e79!2sUniversitas%20Bina%20Sarana%20Informatika%20Kampus%20Bumi%20Serpong%20Damai%20(UBSI%20Kampus%20BSD)!5e0!3m2!1sid!2sid!4v1783142173940!5m2!1sid!2sid"
                    width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin">
                </iframe>
            </div>

        </div>
    </div>

    
    <footer class="theme-header border-t py-6">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <p class="theme-text-secondary text-sm">© <?php echo e(date('Y')); ?> PlotList. All rights reserved.</p>
        </div>
    </footer>

    
    <script>
        const btn = document.getElementById('theme-toggle-btn-landing');
        const sunIcon = document.getElementById('theme-toggle-sun-landing');
        const moonIcon = document.getElementById('theme-toggle-moon-landing');

        function updateIcons() {
            if (document.documentElement.classList.contains('theme-light')) {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            } else {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            }
        }

        if (btn && sunIcon && moonIcon) {
            updateIcons();

            btn.addEventListener('click', function() {
                if (document.documentElement.classList.contains('theme-light')) {
                    document.documentElement.className = 'theme-blue-black';
                    localStorage.setItem('admin-theme', 'theme-blue-black');
                } else {
                    document.documentElement.className = 'theme-light';
                    localStorage.setItem('admin-theme', 'theme-light');
                }
                updateIcons();
            });
        }
    </script>
    <script>
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('anim-visible');
                    observer.unobserve(entry.target); // animasi hanya sekali
                }
            });
        }, {
            threshold: 0.15 // muncul saat 15% elemen terlihat
        });

        document.querySelectorAll('.anim-fade-up, .anim-fade-left, .anim-fade-right, .anim-zoom')
            .forEach(function(el) {
                observer.observe(el);
            });
    </script>
</body>

</html>
<?php /**PATH D:\laragon\www\Plot_List\resources\views/landing.blade.php ENDPATH**/ ?>