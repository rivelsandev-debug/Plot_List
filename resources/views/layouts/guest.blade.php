<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('admin-theme') === 'theme-light') {
            document.documentElement.className = 'theme-light';
        } else {
            document.documentElement.className = 'theme-blue-black';
        }
    </script>
</head>

<body class="h-full font-sans antialiased theme-app">
    <div class="min-h-screen flex">

        {{-- Kiri: Branding --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            {{-- Background Image --}}
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                style="background-image: url('https://storage.googleapis.com/ekrutassets/blogs/images/000/008/336/original/Cover_(Sasindo)_(1).jpg');">
            </div>
            {{-- Overlay --}}
            <div class="absolute inset-0 bg-black/65"></div>
            {{-- Dekorasi lingkaran --}}
            <div class="absolute top-[-80px] left-[-80px] w-72 h-72 bg-indigo-600/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-[-60px] right-[-60px] w-64 h-64 bg-yellow-500/10 rounded-full blur-3xl"></div>

            {{-- Konten Branding --}}
            <div class="relative z-10 flex flex-col justify-between p-12 w-full">
                {{-- Logo --}}
                <a href="/">
                    <img src="{{ asset('storage/logo/Desain tanpa judul (1).png') }}" alt="PlotList"
                        class="h-16 w-auto">
                </a>

                {{-- Tagline Tengah --}}
                <div>
                    <h2 class="text-4xl font-bold text-white leading-tight mb-4">
                        Dunia novel ada<br>di genggamanmu.
                    </h2>
                    <p class="text-gray-300 text-lg max-w-sm">
                        Temukan, beli, dan nikmati ribuan novel favoritmu kapan saja dan di mana saja.
                    </p>

                    {{-- Stats --}}
                    <div class="flex gap-8 mt-10">
                        <div>
                            <p class="text-3xl font-bold text-yellow-400">100+</p>
                            <p class="text-gray-400 text-sm mt-1">Novel Tersedia</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-yellow-400">1000+</p>
                            <p class="text-gray-400 text-sm mt-1">Pembaca</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-yellow-400">10+</p>
                            <p class="text-gray-400 text-sm mt-1">Genre</p>
                        </div>
                    </div>
                </div>

                {{-- Footer kecil --}}
                <p class="text-gray-500 text-sm">© {{ date('Y') }} PlotList. All rights reserved.</p>
            </div>
        </div>

        {{-- Kanan: Form --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-6 py-12 lg:px-16">

            {{-- Logo mobile (hanya muncul di layar kecil) --}}
            <div class="lg:hidden mb-8">
                <a href="/">
                    <img src="{{ asset('storage/logo/Desain tanpa judul (1).png') }}" alt="PlotList"
                        class="h-14 w-auto mx-auto">
                </a>
            </div>

            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>

    </div>
</body>

</html>
