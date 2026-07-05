<x-guest-layout>
    <h2 class="mb-2 text-3xl font-bold tracking-tight theme-text-primary">
        Buat akun baru
    </h2>
    <p class="mb-8 theme-text-secondary text-sm">Bergabung dengan komunitas pembaca PlotList</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        {{-- Nama --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-100">Nama</label>
            <div class="mt-2">
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    placeholder="Masukkan nama lengkap"
                    class="block w-full rounded-md bg-white/5 px-3 py-2 text-white outline outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 text-sm">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-100">Email</label>
            <div class="mt-2">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    placeholder="Masukkan email"
                    class="block w-full rounded-md bg-white/5 px-3 py-2 text-white outline outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 text-sm">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-100">Password</label>
            <div class="mt-2">
                <input id="password" type="password" name="password" required placeholder="Masukkan password"
                    class="block w-full rounded-md bg-white/5 px-3 py-2 text-white outline outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 text-sm">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-100">Konfirmasi
                Password</label>
            <div class="mt-2">
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    placeholder="Ulangi password"
                    class="block w-full rounded-md bg-white/5 px-3 py-2 text-white outline outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 text-sm">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        {{-- Tombol Daftar --}}
        <button type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-500 hover:bg-indigo-400 px-3 py-2 text-sm font-semibold text-white transition">
            Daftar
        </button>

        {{-- Link Login --}}
        <p class="text-center text-sm text-gray-400">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-indigo-400 hover:text-indigo-300">
                Login sekarang
            </a>
        </p>
    </form>
</x-guest-layout>
