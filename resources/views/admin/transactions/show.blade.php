<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl theme-text-primary leading-tight">
                Detail Transaksi
            </h2>
            <a href="{{ route('admin.transactions.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="theme-card rounded-lg shadow p-6">

                {{-- Status Badge --}}
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold theme-text-primary">{{ $order->order_id }}</h3>
                    @php
                        $statusClass = match ($order->status) {
                            'success' => 'bg-green-500/10 text-green-400 border border-green-500/20',
                            'pending' => 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20',
                            'failed' => 'bg-red-500/10 text-red-400 border border-red-500/20',
                            default => 'bg-gray-500/10 text-gray-400 border border-gray-500/20',
                        };
                    @endphp
                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    {{-- Info Pembeli --}}
                    <div class="theme-border border rounded-lg p-4">
                        <h4 class="font-semibold theme-text-primary mb-3">Info Pembeli</h4>
                        <div class="space-y-2">
                            <p class="text-sm theme-text-secondary">
                                <span class="font-medium theme-text-primary">Nama:</span> {{ $order->user->name }}
                            </p>
                            <p class="text-sm theme-text-secondary">
                                <span class="font-medium theme-text-primary">Email:</span> {{ $order->user->email }}
                            </p>
                        </div>
                    </div>

                    {{-- Info Transaksi --}}
                    <div class="theme-border border rounded-lg p-4">
                        <h4 class="font-semibold theme-text-primary mb-3">Info Transaksi</h4>
                        <div class="space-y-2">
                            <p class="text-sm theme-text-secondary">
                                <span class="font-medium theme-text-primary">Total:</span>
                                Rp {{ number_format($order->amount, 0, ',', '.') }}
                            </p>
                            <p class="text-sm theme-text-secondary">
                                <span class="font-medium theme-text-primary">Tanggal Order:</span>
                                {{ $order->created_at->format('d M Y H:i') }}
                            </p>
                            <p class="text-sm theme-text-secondary">
                                <span class="font-medium theme-text-primary">Tanggal Bayar:</span>
                                {{ $order->paid_at ? $order->paid_at->format('d M Y H:i') : '-' }}
                            </p>
                        </div>
                    </div>

                    {{-- Info Novel --}}
                    <div class="theme-border border rounded-lg p-4 sm:col-span-2">
                        <h4 class="font-semibold theme-text-primary mb-3">Novel yang Dibeli</h4>
                        <div class="flex gap-4">
                            @if ($order->novel->cover_image)
                                <img src="{{ asset('storage/' . $order->novel->cover_image) }}"
                                    alt="{{ $order->novel->title }}" class="w-20 h-28 object-cover rounded shadow-sm">
                            @endif
                            <div>
                                <p class="font-semibold theme-text-primary">{{ $order->novel->title }}</p>
                                <p class="text-sm theme-text-secondary">{{ $order->novel->author }}</p>
                                <p class="text-sm theme-text-secondary">{{ $order->novel->genre }}</p>
                                <p class="text-sm font-semibold text-indigo-400 mt-1">
                                    Rp {{ number_format($order->novel->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
