<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl theme-text-primary leading-tight">
                Tambah Novel
            </h2>
            <a href="{{ route('admin.novels.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12 theme-app min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="theme-card border rounded-xl shadow-sm p-6">

                @if ($errors->any())
                    <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-lg mb-5">
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.novels.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Judul Novel</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan judul novel">
                    </div>

                    {{-- Penulis --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Penulis</label>
                        <input type="text" name="author" value="{{ old('author') }}" required
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan nama penulis">
                    </div>

                    {{-- Genre --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-2">Genre</label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach (['Action', 'Drama', 'Fantasy', 'Horror', 'Isekai', 'Mystery', 'Romance', 'Shounen', 'Slice of Life', 'Supernatural'] as $genre)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="genre[]" value="{{ $genre }}" required
                                        {{ in_array($genre, old('genre', [])) ? 'checked' : '' }}
                                        class="accent-blue-500 w-4 h-4">
                                    <span class="text-sm theme-text-primary">{{ $genre }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Tanggal Rilis --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Tanggal Rilis</label>
                        <input type="date" name="release_date" value="{{ old('release_date') }}" required
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    {{-- Sinopsis --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Sinopsis</label>
                        <textarea name="description" rows="5" required
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan sinopsis novel">{{ old('description') }}</textarea>
                    </div>

                    {{-- Cover Novel --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Cover Novel</label>
                        <input type="file" name="cover_image" accept="image/*" required
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none">
                        <p class="text-xs theme-text-muted mt-1">Format: JPG, JPEG, PNG, WEBP. Maks: 2MB</p>
                    </div>

                    {{-- Harga --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ old('price', 0) }}" required
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Contoh: 50000">
                    </div>

                    {{-- Rating --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Rating (0–5)</label>
                        <input type="number" name="rating" value="{{ old('rating', 0) }} " required min="0"
                            max="5" step="0.1"
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Contoh: 4.5">
                        <p class="text-xs theme-text-muted mt-1">Masukkan nilai antara 0 – 5</p>
                    </div>

                    {{-- File Novel --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">File Novel (PDF /
                            ePub)</label>
                        <input type="file" name="file_path" accept=".pdf,.epub" required
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none">
                        <p class="text-xs theme-text-muted mt-1">Format: PDF atau ePub</p>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-lg font-semibold transition">
                        Simpan Novel
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
                                    background: '#1f2937',
                                    color: '#fff',
                                    confirmButtonColor: '#4f46e5',
                                });
                            }
                        });
                    </script>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
