<x-app-layout>
    <div class="theme-app min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">

            <a href="{{ session('novel_back_url', route('novels.index')) }}"
                class="inline-flex items-center gap-2 theme-text-secondary hover:theme-text-primary text-sm mb-6 font-medium transition">
                ← Kembali
            </a>

            <div class="theme-card border rounded-xl p-6 shadow-sm">
                <div class="grid gap-8" style="grid-template-columns: 200px 1fr;">

                    {{-- Cover --}}
                    <div class="flex flex-col gap-3">
                        @if ($novel->cover_image)
                            <img src="{{ asset('storage/' . $novel->cover_image) }}" alt="{{ $novel->title }}"
                                class="w-full h-72 object-cover rounded-lg border theme-border">
                        @else
                            <div
                                class="w-full h-72 theme-bg-secondary border theme-border rounded-lg flex items-center justify-center">
                                <span class="theme-text-muted text-sm">No Cover</span>
                            </div>
                        @endif

                        @if (auth()->user()->role === 'user' && auth()->user()->hasPurchased($novel))
                            <div
                                class="flex items-center gap-2 text-green-400 text-xs font-medium bg-green-500/10 border border-green-500/20 rounded-lg px-3 py-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Sudah dibeli
                            </div>
                        @endif
                    </div>

                    {{-- Detail --}}
                    <div class="flex flex-col gap-4">

                        {{-- Judul & Genre --}}
                        <div>
                            <h1 class="text-2xl font-bold theme-text-primary mb-3">{{ $novel->title }}</h1>
                            <div class="flex flex-wrap gap-2">
                                @foreach (explode(',', $novel->genre) as $genre)
                                    <span
                                        class="px-3 py-1 bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs font-semibold rounded-full">
                                        {{ trim($genre) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-2 text-sm">
                                <svg class="w-4 h-4 theme-text-muted" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="theme-text-secondary">Penulis</span>
                                <span class="theme-text-primary font-medium">{{ $novel->author }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <svg class="w-4 h-4 theme-text-muted" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="theme-text-secondary">Tanggal Rilis</span>
                                <span
                                    class="theme-text-primary font-medium">{{ \Carbon\Carbon::parse($novel->release_date)->format('d F Y') }}</span>
                            </div>
                        </div>
                        {{-- Rating — tambahkan di sini --}}
                        <div class="flex items-center gap-2">
                            @if ($novel->rating > 0)
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($novel->rating))
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @elseif ($i - $novel->rating < 1)
                                        <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endif
                                @endfor
                                <span
                                    class="text-yellow-400 font-semibold text-sm">{{ number_format($novel->rating, 1) }}</span>
                                <span class="theme-text-muted text-sm">/ 5.0</span>
                            @else
                                <span class="theme-text-muted text-sm italic">Belum ada rating</span>
                            @endif
                        </div>
                        {{-- Sinopsis --}}
                        <div class="border-t theme-border pt-4">
                            <p class="text-xs font-semibold theme-text-secondary uppercase tracking-wider mb-2">Sinopsis
                            </p>
                            <p class="text-sm theme-text-secondary leading-relaxed">{{ $novel->description }}</p>
                        </div>

                        {{-- Harga --}}
                        <div
                            class="theme-bg-secondary border theme-border rounded-lg px-4 py-3 flex items-center justify-between">
                            <span class="text-xs theme-text-muted">Harga</span>
                            <span class="text-2xl font-bold theme-text-primary">
                                Rp {{ number_format($novel->price, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- Tombol Aksi --}}
                        @if (auth()->user()->role === 'user')
                            @if (auth()->user()->hasPurchased($novel))
                                @php
                                    $order = auth()
                                        ->user()
                                        ->orders()
                                        ->where('novel_id', $novel->id)
                                        ->where('status', 'success')
                                        ->first();
                                @endphp
                                <a href="{{ route('orders.download', $order) }}"
                                    class="w-full flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold text-sm transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Download Novel
                                </a>
                            @else
                                <div class="flex gap-3">
                                    <form action="{{ route('cart.store', $novel) }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="back_url"
                                            value="{{ session('novel_back_url', route('novels.index')) }}">
                                        <button type="submit"
                                            class="w-full flex items-center justify-center gap-2 border theme-border hover:border-blue-500/50 theme-text-primary py-3 rounded-lg font-semibold text-sm transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Tambah ke Keranjang
                                        </button>
                                    </form>

                                    <form action="{{ route('orders.buyNow', $novel) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold text-sm transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                            Beli Sekarang
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
