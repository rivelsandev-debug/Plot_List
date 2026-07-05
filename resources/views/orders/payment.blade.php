<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl theme-text-primary leading-tight">
            Pembayaran
        </h2>
    </x-slot>

    <div class="theme-app min-h-screen py-12">
        <div class="max-w-2xl mx-auto px-6 lg:px-8">
            <div class="theme-card border rounded-lg shadow-md p-6 text-center">

                <div class="mb-6">
                    <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold theme-text-primary mb-2">Selesaikan Pembayaran</h3>
                    <p class="theme-text-secondary text-sm mb-2">Order ID: <span
                            class="theme-text-primary font-mono font-semibold">{{ $groupId }}</span></p>
                    <p class="text-3xl font-bold theme-text-primary mb-6">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </p>
                </div>

                <button id="pay-button"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold mb-3 transition">
                    Bayar Sekarang
                </button>

                <p class="theme-text-muted text-xs">
                    Kamu akan diarahkan ke halaman pembayaran Midtrans
                </p>
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    // Kirim request ke server untuk update status
                    fetch('{{ route('orders.success') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            group_id: '{{ $groupId }}',
                            transaction_id: result.transaction_id
                        })
                    }).then(() => {
                        window.location.href = '{{ route('orders.history') }}';
                    });
                },
                onPending: function(result) {
                    window.location.href = '{{ route('orders.history') }}';
                },
                onError: function(result) {
                    alert('Pembayaran gagal!');
                },
                onClose: function() {
                    alert('Kamu menutup popup pembayaran.');
                }
            });
        });
    </script>
</x-app-layout>
