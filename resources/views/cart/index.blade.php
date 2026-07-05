    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl theme-text-primary leading-tight">
                    Keranjang Belanja
                </h2>
                <a href="{{ session('cart_back_url', route('novels.index')) }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    Kembali
                </a>
            </div>
        </x-slot>

        <div class="theme-app min-h-screen py-12">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">

                @if (session('success'))
                    <div class="bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-lg mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($carts->isEmpty())
                    <div class="theme-card border rounded-xl p-12 text-center">
                        <div class="w-16 h-16 bg-blue-600/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <p class="theme-text-secondary text-lg mb-4">Keranjang kamu kosong!</p>
                        <a href="{{ route('novels.index') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition inline-block font-semibold">
                            Cari Novel
                        </a>
                    </div>
                @else
                    <div class="theme-card border rounded-lg shadow overflow-hidden mb-6">
                        @foreach ($carts as $cart)
                            <div class="flex items-center gap-4 p-4 border-b theme-border">
                                {{-- Cover --}}
                                @if ($cart->novel->cover_image)
                                    <img src="{{ asset('storage/' . $cart->novel->cover_image) }}"
                                        alt="{{ $cart->novel->title }}" class="w-16 h-20 object-cover rounded border theme-border">
                                @else
                                    <div class="w-16 h-20 bg-gray-700/30 border theme-border rounded flex items-center justify-center">
                                        <span class="theme-text-muted text-xs">No Cover</span>
                                    </div>
                                @endif

                                {{-- Detail Novel --}}
                                <div class="flex-1">
                                    <h3 class="font-semibold theme-text-primary">{{ $cart->novel->title }}</h3>
                                    <p class="text-sm theme-text-secondary">{{ $cart->novel->author }}</p>
                                    <p class="text-sm text-blue-400 font-bold mt-1">
                                        Rp {{ number_format($cart->novel->price, 0, ',', '.') }}
                                    </p>
                                </div>

                                {{-- Hapus --}}
                                <form action="{{ route('cart.destroy', $cart) }}" method="POST"
                                    onsubmit="return confirm('Hapus novel ini dari keranjang?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-sm transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    {{-- Total & Checkout --}}
                    <div class="theme-card border rounded-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <span class="theme-text-secondary">Total ({{ $carts->count() }} novel)</span>
                            <span class="text-xl font-bold theme-text-primary">
                                Rp {{ number_format($carts->sum(fn($c) => $c->novel->price), 0, ',', '.') }}
                            </span>
                        </div>
                        <a href="{{ route('orders.checkout') }}"
                            class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">
                            Checkout Sekarang
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </x-app-layout>
