{{-- <x-app-layout>

    {{-- Novel Terbaru --}}
<div class="bg-gray-900 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-semibold text-white">Novel Terbaru</h2>
            <a href="{{ route('novels.index') }}" class="text-indigo-400 hover:text-indigo-300 text-sm font-medium">
                Lihat Semua →
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($novels as $novel)
                <div class="bg-gray-800 rounded-lg shadow overflow-hidden">
                    @if ($novel->cover_image)
                        <img src="{{ asset('storage/' . $novel->cover_image) }}" alt="{{ $novel->title }}"
                            class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-700 flex items-center justify-center">
                            <span class="text-gray-400 text-sm">No Cover</span>
                        </div>
                    @endif

                    <div class="p-4">
                        <h3 class="font-semibold text-white truncate">{{ $novel->title }}</h3>
                        <p class="text-sm text-gray-400">{{ $novel->author }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $novel->genre }}</p>
                        <div class="mt-3">
                            <a href="{{ route('novels.show', $novel) }}"
                                class="w-full block text-center bg-indigo-600 hover:bg-indigo-700 text-white px-2 py-1 rounded text-xs">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-400 py-12">
                    Belum ada novel tersedia.
                </div>
            @endforelse
        </div>
    </div>
</div>
</x-app-layout> --}}
