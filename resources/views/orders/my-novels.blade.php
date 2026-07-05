<x-app-layout>
    <div class="theme-app min-h-screen py-12">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">
            <h1 class="text-2xl font-bold theme-text-primary mb-6">Novel Saya</h1>

            <form action="{{ route('orders.myNovels') }}" method="GET" class="flex gap-2 mb-8">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul novel..."
                    class="theme-input flex-1 border placeholder-gray-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    Cari
                </button>
            </form>

            @if ($orders->isEmpty())
                <p class="theme-text-secondary">
                    @if ($search)
                        Novel dengan judul "{{ $search }}" tidak ditemukan.
                    @else
                        Kamu belum punya novel yang dibeli.
                    @endif
                </p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($orders as $order)
                        <div class="theme-card border rounded-lg overflow-hidden flex flex-col shadow-sm">
                            @if ($order->novel->cover_image)
                                <img src="{{ asset('storage/' . $order->novel->cover_image) }}"
                                    alt="{{ $order->novel->title }}" class="w-full h-56 object-cover border-b theme-border">
                            @else
                                <div class="w-full h-56 bg-gray-700/30 flex items-center justify-center border-b theme-border">
                                    <span class="theme-text-muted text-sm">No Cover</span>
                                </div>
                            @endif

                            <div class="p-4 flex flex-col flex-1">
                                <h3 class="theme-text-primary font-semibold mb-1">{{ $order->novel->title }}</h3>
                                <p class="theme-text-secondary text-sm mb-4">{{ $order->novel->author }}</p>
                                <a href="{{ route('orders.download', $order) }}"
                                    class="mt-auto bg-indigo-600 hover:bg-indigo-700 text-white text-center py-2 rounded-lg text-sm font-medium transition">
                                    Download
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
