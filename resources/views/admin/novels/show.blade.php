<x-app-layout>
    <div class="theme-app min-h-screen">

        {{-- Hero Cover Section --}}
        <div class="relative w-full h-72 overflow-hidden">
            @if ($novel->cover_image)
                <img src="{{ asset('storage/' . $novel->cover_image) }}" alt="{{ $novel->title }}"
                    class="w-full h-full object-cover">
            @else
                <div class="w-full h-full theme-bg-secondary"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

            {{-- Tombol Kembali --}}
            <a href="{{ session('novel_back_url', route('novels.index')) }}"
                class="absolute top-6 left-6 inline-flex items-center gap-2 text-white bg-black/30 hover:bg-black/50 backdrop-blur-sm px-4 py-2 rounded-lg text-sm font-medium transition">
                ← Kembali
            </a>
        </div>

        <div class="max-w-5xl mx-auto px-6 lg:px-8 -mt-20 pb-16 relative z-10">
            <div class="grid gap-8" style="grid-template-columns: 220px 1fr;">

                {{-- Cover Besar --}}
                <div class="flex flex-col gap-4">
                    <div class="rounded-xl overflow-hidden border-4 border-white/10 shadow-2xl" style="height: 310px;">
                        @if ($novel->cover_image)
                            <img src="{{ asset('storage/' . $novel->cover_image) }}" alt="{{ $novel->title }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full theme-card flex items-center justify-center">
                                <span class="theme-text-muted text-sm">No Cover</span>
                            </div>
                        @endif
                    </div>

                    {{-- Status Badge --}}
                    @if (auth()->user()->role === 'user' && auth()->user()->hasPurchased($novel))
                        <div
                            class="flex items-center justify-center gap-2 text-green-400 text-xs font-semibold bg-green-500/10 border border-green-500/20 rounded-lg px-3 py-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Sudah Dibeli
                        </div>
                    @endif

                    {{-- Statistik Mini --}}
                    <div class="theme-card border rounded-xl p-4 flex flex-col gap-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="theme-text-secondary flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Tahun Rilis
                            </span>
                            <span class="theme-text-primary font-semibold">
                                {{ \Carbon\Carbon::parse($novel->release_date)->format('Y') }}
                            </span>
                        </div>
                        <div class="border-t theme-border"></div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="theme-text-secondary flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 012-2z" />
                                </svg>
                                Genre
                            </span>
                            <span class="theme-text-primary font-semibold">
                                {{ count(explode(',', $novel->genre)) }} Genre
                            </span>
                        </div>
                        <div class="border-t theme-border"></div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="theme-text-secondary flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                Pembeli
                            </span>
                            <span class="theme-text-primary font-semibold">
                                {{ $novel->orders()->where('status', 'success')->count() }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Detail Kanan --}}
                <div class="flex flex-col gap-5 pt-20">

                    {{-- Judul --}}
                    <div>
                        <h1 class="text-3xl font-bold theme-text-primary mb-1">{{ $novel->title }}</h1>
                        <p class="theme-text-secondary text-sm">oleh <span
                                class="theme-text-primary font-semibold">{{ $novel->author }}</span></p>
                    </div>

                    {{-- Rating --}}
                    @if ($novel->rating > 0)
                        <div class="flex items-center gap-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($novel->rating))
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @elseif ($i - $novel->rating < 1)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <defs>
                                            <linearGradient id="half-{{ $i }}">
                                                <stop offset="50%" stop-color="currentColor" />
                                                <stop offset="50%" stop-color="transparent" />
                                            </linearGradient>
                                        </defs>
                                        <path fill="url(#half-{{ $i }})"
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
                        </div>
                    @endif

                    {{-- Genre Badges --}}
                    <div class="flex flex-wrap gap-2">
                        @php
                            $genreColors = [
                                'Action' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                'Drama' => 'bg-purple-500/10 text-purple-400 border-purple-500/20',
                                'Fantasy' => 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20',
                                'Horror' => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
                                'Isekai' => 'bg-cyan-500/10 text-cyan-400 border-cyan-500/20',
                                'Mystery' => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                                'Romance' => 'bg-pink-500/10 text-pink-400 border-pink-500/20',
                                'Shounen' => 'bg-orange-500/10 text-orange-400 border-orange-500/20',
                                'Slice of Life' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                'Supernatural' => 'bg-violet-500/10 text-violet-400 border-violet-500/20',
                            ];
                        @endphp
                        @foreach (explode(',', $novel->genre) as $genre)
                            @php $genre = trim($genre); @endphp
                            <span
                                class="px-3 py-1.5 border text-xs font-semibold rounded-full {{ $genreColors[$genre] ?? 'bg-blue-500/10 text-blue-400 border-blue-500/20' }}">
                                {{ $genre }}
                            </span>
                        @endforeach
                    </div>

                    {{-- Info Detail --}}
                    <div class="theme-card border rounded-xl p-4 grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs theme-text-muted uppercase tracking-wider mb-1">Penulis</p>
                            <p class="theme-text-primary font-semibold text-sm">{{ $novel->author }}</p>
                        </div>
                        <div>
                            <p class="text-xs theme-text-muted uppercase tracking-wider mb-1">Tanggal Rilis</p>
                            <p class="theme-text-primary font-semibold text-sm">
                                {{ \Carbon\Carbon::parse($novel->release_date)->format('d F Y') }}</p>
                        </div>
                    </div>

                    {{-- Sinopsis dengan toggle --}}
                    <div class="theme-card border rounded-xl p-5">
                        <h3 class="text-xs font-semibold theme-text-muted uppercase tracking-wider mb-3">Sinopsis</h3>
                        <div id="synopsis-content" class="overflow-hidden transition-all duration-300"
                            style="max-height: 80px;">
                            <p class="text-sm theme-text-secondary leading-relaxed">{{ $novel->description }}</p>
                        </div>
                        <button id="synopsis-toggle" onclick="toggleSynopsis()"
                            class="mt-2 text-xs text-blue-400 hover:text-blue-300 font-semibold transition">
                            Baca selengkapnya ↓
                        </button>
                    </div>

                    {{-- Harga --}}
                    <div
                        class="bg-blue-500/5 border border-blue-500/20 rounded-xl px-5 py-4 flex items-center justify-between">
                        <div>
                            <p class="text-xs theme-text-muted uppercase tracking-wider mb-1">Harga</p>
                            <p class="text-3xl font-bold theme-text-primary">
                                Rp {{ number_format($novel->price, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
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
                                class="w-full flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white py-3.5 rounded-xl font-semibold text-sm transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                        class="w-full flex items-center justify-center gap-2 border theme-border hover:border-blue-500/50 theme-text-primary theme-card py-3.5 rounded-xl font-semibold text-sm transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        + Keranjang
                                    </button>
                                </form>
                                <form action="{{ route('orders.buyNow', $novel) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl font-semibold text-sm transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
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

    <script>
        let synopsisExpanded = false;

        function toggleSynopsis() {
            const content = document.getElementById('synopsis-content');
            const btn = document.getElementById('synopsis-toggle');
            if (synopsisExpanded) {
                content.style.maxHeight = '80px';
                btn.textContent = 'Baca selengkapnya ↓';
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                btn.textContent = 'Sembunyikan ↑';
            }
            synopsisExpanded = !synopsisExpanded;
        }
    </script>
</x-app-layout>
