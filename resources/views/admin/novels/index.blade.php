<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl theme-text-primary leading-tight">
                Kelola Novel
            </h2>
            <a href="{{ route('admin.novels.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                + Tambah Novel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Statistik --}}
            <div class="grid grid-cols-1 gap-4 mb-6">
                <div class="theme-card rounded-lg border p-4 text-center">
                    <p class="text-sm theme-text-secondary">Total Novel</p>
                    <p class="text-2xl font-bold theme-text-primary">{{ $totalNovels }}</p>
                </div>
            </div>

            {{-- Search & Filter --}}
            <form method="GET" action="{{ route('admin.novels.index') }}" class="mb-6">
                <div class="flex gap-3">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul atau penulis..."
                        class="theme-input flex-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <a href="{{ route('admin.novels.index') }}" id="search-reset"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm text-center {{ !request('search') ? 'hidden' : '' }} transition">
                        Reset
                    </a>
                </div>
            </form>

            <div id="admin-novels-container" class="theme-card overflow-hidden rounded-lg border shadow-sm">
                <table class="w-full text-sm text-left">
                    <thead class="theme-table-header border-b text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Cover</th>
                            <th class="px-6 py-3">Judul</th>
                            <th class="px-6 py-3">Penulis</th>
                            <th class="px-6 py-3">Genre</th>
                            <th class="px-6 py-3">Harga</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($novels as $index => $novel)
                            <tr class="theme-table-row border-b theme-border">
                                <td class="px-6 py-4 theme-text-primary">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    @if ($novel->cover_image)
                                        <img src="{{ asset('storage/' . $novel->cover_image) }}"
                                            class="w-10 h-14 object-cover rounded shadow-sm">
                                    @else
                                        <div
                                            class="w-10 h-14 bg-gray-700/50 rounded flex items-center justify-center border theme-border">
                                            <span class="theme-text-muted text-xs">N/A</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold theme-text-primary">{{ $novel->title }}</td>
                                <td class="px-6 py-4 theme-text-secondary">{{ $novel->author }}</td>
                                <td class="px-6 py-4 theme-text-secondary">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach (explode(',', $novel->genre) as $g)
                                            <span
                                                class="bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-xs px-2 py-0.5 rounded-full">{{ trim($g) }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold theme-text-primary">Rp
                                    {{ number_format($novel->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.novels.show', $novel) }}"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-xs transition">
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.novels.edit', $novel) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded text-xs transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.novels.destroy', $novel) }}" method="POST"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-xs transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center theme-text-muted">
                                    Novel tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Event delegation for delete forms (persists after AJAX reload)
        document.addEventListener('submit', function(e) {
            const form = e.target.closest('.delete-form');
            if (!form) return;

            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Novel ini akan dihapus permanen dan tidak bisa dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                background: '#1f2937',
                color: '#fff',
            }).then(function(result) {
                if (result.isConfirmed) {
                    // Temporarily remove class or bypass listener to submit
                    form.submit();
                }
            });
        });

        // Real-time Search
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            const container = document.getElementById('admin-novels-container');
            const resetBtn = document.getElementById('search-reset');
            const form = searchInput ? searchInput.closest('form') : null;

            if (searchInput && container && form) {
                let debounceTimeout;

                function performSearch() {
                    const searchVal = searchInput.value;

                    const params = new URLSearchParams();
                    if (searchVal) params.append('search', searchVal);

                    const url = `${form.action}?${params.toString()}`;

                    // Update URL
                    window.history.replaceState(null, '', url);

                    // Toggle reset button
                    if (resetBtn) {
                        if (searchVal) {
                            resetBtn.classList.remove('hidden');
                        } else {
                            resetBtn.classList.add('hidden');
                        }
                    }

                    // Loading effect
                    container.style.opacity = '0.5';

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newContent = doc.getElementById('admin-novels-container');
                            if (newContent) {
                                container.innerHTML = newContent.innerHTML;
                            }
                            container.style.opacity = '1';
                        })
                        .catch(err => {
                            console.error(err);
                            container.style.opacity = '1';
                        });
                }

                searchInput.addEventListener('input', () => {
                    clearTimeout(debounceTimeout);
                    debounceTimeout = setTimeout(performSearch, 300);
                });

                if (resetBtn) {
                    resetBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        searchInput.value = '';
                        performSearch();
                    });
                }

                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    performSearch();
                });
            }
        });
    </script>
</x-app-layout>
