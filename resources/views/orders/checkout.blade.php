<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl theme-text-primary leading-tight">
                Checkout
            </h2>
            <a href="{{ route('cart.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm transition">
                Kembali ke Keranjang
            </a>
        </div>
    </x-slot>

    <div class="theme-app min-h-screen py-12">
        <div class="max-w-2xl mx-auto px-6 lg:px-8">
            <div class="theme-card border rounded-lg shadow-md p-6">

                <h3 class="text-lg font-semibold theme-text-primary mb-6">Detail Pembelian</h3>

                {{-- List Novel --}}
                <div class="mb-6 pb-6 border-b theme-border">
                    @foreach ($carts as $cart)
                        <div class="flex items-center gap-4 mb-4">
                            @if ($cart->novel->cover_image)
                                <img src="{{ asset('storage/' . $cart->novel->cover_image) }}"
                                    alt="{{ $cart->novel->title }}"
                                    class="w-12 h-16 object-cover rounded border theme-border">
                            @else
                                <div
                                    class="w-12 h-16 bg-gray-700/30 border theme-border rounded flex items-center justify-center">
                                    <span class="theme-text-muted text-xs">No Cover</span>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h4 class="font-semibold theme-text-primary text-sm">{{ $cart->novel->title }}</h4>
                                <p class="text-xs theme-text-secondary">{{ $cart->novel->author }}</p>
                            </div>
                            <span class="text-indigo-400 font-bold text-sm">
                                Rp {{ number_format($cart->novel->price, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach
                </div>

                {{-- Data Pembeli --}}
                <div class="mb-6 pb-6 border-b theme-border">
                    <h4 class="text-sm font-medium theme-text-primary mb-2">Data Pembeli</h4>
                    <p class="text-sm theme-text-secondary">{{ auth()->user()->name }}</p>
                    <p class="text-sm theme-text-secondary">{{ auth()->user()->email }}</p>
                </div>

                {{-- Total --}}
                <div class="flex justify-between items-center mb-6">
                    <span class="theme-text-secondary font-medium">Total Pembayaran</span>
                    <span class="text-xl font-bold theme-text-primary">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </span>
                </div>

                {{-- Tombol Bayar --}}
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold transition">
                        Bayar Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
