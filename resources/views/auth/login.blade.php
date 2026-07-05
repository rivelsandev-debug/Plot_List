<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="mb-2 text-3xl font-bold tracking-tight theme-text-primary">
        Selamat datang kembali
    </h2>
    <p class="mb-8 theme-text-secondary text-sm">Masuk ke akun PlotList kamu</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-100">Email</label>
            <div class="mt-2">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="block w-full rounded-md bg-white/5 px-3 py-2 text-white outline outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 text-sm">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        {{-- Password --}}
        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium text-gray-100">Password</label>
            </div>
            <div class="mt-2">
                <input id="password" type="password" name="password" required
                    class="block w-full rounded-md bg-white/5 px-3 py-2 text-white outline outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 text-sm">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm font-semibold text-indigo-400 hover:text-indigo-300">
                        Lupa password?
                    </a>
                @endif
            </div>
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center gap-2">
            <input id="remember_me" type="checkbox" name="remember"
                class="rounded border-gray-600 bg-white/5 text-indigo-600">
            <label for="remember_me" class="text-sm text-gray-300">Ingat saya</label>
        </div>

        {{-- Tombol Login --}}
        <button type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-500 hover:bg-indigo-400 px-3 py-2 text-sm font-semibold text-white transition">
            Login
        </button>

        {{-- Link Register --}}
        <p class="text-center text-sm text-gray-400">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-indigo-400 hover:text-indigo-300">
                Daftar sekarang
            </a>
        </p>
    </form>
</x-guest-layout>
