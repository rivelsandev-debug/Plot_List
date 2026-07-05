<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl theme-text-primary leading-tight">
                Tambah User
            </h2>
            <a href="{{ route('admin.users.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12 theme-app min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="theme-card overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Notifikasi error --}}
                @if ($errors->any())
                    <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Nama</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan nama">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan email">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Password</label>
                        <input type="password" name="password"
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan password">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium theme-text-secondary mb-1">Role</label>
                        <select name="role"
                            class="theme-input w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium transition">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
