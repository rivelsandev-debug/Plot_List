<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Midtrans\Config;

class OrderController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    // Halaman checkout dari keranjang
    public function checkout()
    {
        $carts = auth()->user()->carts()->with('novel')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kamu kosong!');
        }

        $total = $carts->sum(fn($cart) => $cart->novel->price);

        return view('orders.checkout')->with('carts', $carts)->with('total', $total);
    }

    // Proses pembuatan order & snap token
    public function store(Request $request)
    {
        // Set Midtrans config
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        $carts = auth()->user()->carts()->with('novel')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kamu kosong!');
        }

        $total = $carts->sum(fn($cart) => $cart->novel->price);
        $groupId = 'PLT-' . strtoupper(\Illuminate\Support\Str::random(10));

        $orders = [];

        foreach ($carts as $cart) {
            $order = Order::create([
                'order_id' => $groupId . '-' . $cart->novel->id,
                'user_id' => auth()->id(),
                'novel_id' => $cart->novel->id,
                'amount' => $cart->novel->price,
                'status' => 'pending',
            ]);
            $orders[] = $order;
        }

        $params = [
            'transaction_details' => [
                'order_id' => $groupId,
                'gross_amount' => (int) $total,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => $carts->map(fn($cart) => [
                'id' => $cart->novel->id,
                'price' => (int) $cart->novel->price,
                'quantity' => 1,
                'name' => $cart->novel->title,
            ])->toArray(),
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        foreach ($orders as $order) {
            $order->update(['snap_token' => $snapToken]);
        }

        auth()->user()->carts()->delete();

        $order = $orders[0];

        return view('orders.payment', compact('order', 'snapToken', 'total', 'groupId'));
    }

    // Simulasi pembayaran berhasil
    public function simulate(Request $request)
    {
        $groupId = $request->group_id;

        // Update semua order dengan group_id yang sama
        Order::where('order_id', 'like', $groupId . '%')
            ->where('user_id', auth()->id())
            ->update([
                'status' => 'success',
                'paid_at' => now(),
            ]);

        return redirect()->route('orders.history')
            ->with('success', 'Pembayaran berhasil!');
    }

    // Simulasi pembayaran gagal
    public function cancel(Request $request)
    {
        $groupId = $request->group_id;

        Order::where('order_id', 'like', $groupId . '%')
            ->where('user_id', auth()->id())
            ->update(['status' => 'failed']);

        return redirect()->route('orders.history')
            ->with('error', 'Pembayaran dibatalkan.');
    }

    // Callback dari Midtrans
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashedKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashedKey !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $order = Order::where('order_id', $request->order_id)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($request->transaction_status === 'settlement' || $request->transaction_status === 'capture') {
            $order->update(['status' => 'success', 'paid_at' => now()]);
        } elseif (in_array($request->transaction_status, ['cancel', 'deny', 'expire'])) {
            $order->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'OK']);
    }

    // Riwayat pembelian
    public function history()
    {
        $orders = auth()->user()->orders()->with('novel')->latest()->get();
        return view('orders.history', compact('orders'));
    }

    // Download novel
    public function download(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status !== 'success') {
            abort(403, 'Pembayaran belum selesai.');
        }

        $filePath = storage_path('app/public/' . $order->novel->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath);
    }

    public function success(Request $request)
    {
        $groupId = $request->group_id;

        Order::where('order_id', 'like', $groupId . '%')
            ->where('user_id', auth()->id())
            ->update([
                'status' => 'success',
                'paid_at' => now(),
            ]);

        return response()->json(['message' => 'OK']);
    }
    // Lanjut bayar order pending
    public function repay(Order $order)
    {
        // Set Midtrans config
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        // Pastikan order milik user yang login
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Pastikan status masih pending
        if ($order->status !== 'pending') {
            return redirect()->route('orders.history')
                ->with('error', 'Order ini sudah tidak bisa dibayar.');
        }

        // Ambil semua order dengan group_id yang sama
        $groupId = explode('-', $order->order_id);
        $groupId = $groupId[0] . '-' . $groupId[1];

        $orders = Order::where('order_id', 'like', $groupId . '%')
            ->where('user_id', auth()->id())
            ->with('novel')
            ->get();

        $total = $orders->sum('amount');

        $params = [
            'transaction_details' => [
                'order_id' => $groupId . '-RETRY-' . time(),
                'gross_amount' => (int) $total,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => $orders->map(fn($o) => [
                'id' => $o->novel->id,
                'price' => (int) $o->amount,
                'quantity' => 1,
                'name' => $o->novel->title,
            ])->toArray(),
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Update snap token semua order dalam group
        $orders->each(fn($o) => $o->update(['snap_token' => $snapToken]));

        return view('orders.payment', compact('order', 'snapToken', 'total', 'groupId'));
    }
    public function buyNow(\App\Models\Novel $novel)
    {
        // Sudah pernah beli (status success)
        if (auth()->user()->hasPurchased($novel)) {
            return back()->with('error', 'Kamu sudah membeli novel ini!');
        }

        // Sudah ada order pending untuk novel ini -> redirect ke halaman repay
        $pendingOrder = auth()->user()->orders()
            ->where('novel_id', $novel->id)
            ->where('status', 'pending')
            ->latest()
            ->first();

        if ($pendingOrder) {
            return redirect()->route('orders.repay', $pendingOrder);
        }

        // Kalau novel ada di keranjang, hapus dulu biar gak nyangkut dobel
        auth()->user()->carts()->where('novel_id', $novel->id)->delete();

        $groupId = 'PLT-' . strtoupper(\Illuminate\Support\Str::random(10));

        $order = Order::create([
            'order_id' => $groupId . '-' . $novel->id,
            'user_id' => auth()->id(),
            'novel_id' => $novel->id,
            'amount' => $novel->price,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.repay', $order);
    }
    public function myNovels(Request $request)
    {
        $search = $request->query('search');

        $orders = auth()->user()->orders()
            ->where('status', 'success')
            ->with('novel')
            ->when($search, function ($query, $search) {
                $query->whereHas('novel', function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->get();

        return view('orders.my-novels', compact('orders', 'search'));
    }

    // Hapus order failed dari riwayat user (max 3x per hari)
    public function destroyFailed(Order $order)
    {
        // Pastikan order milik user yang login
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Hanya boleh hapus order dengan status failed
        if ($order->status !== 'failed') {
            return redirect()->route('orders.history')
                ->with('error', 'Hanya order gagal yang dapat dihapus.');
        }

        // Rate limit: maksimal 3 penghapusan per hari per user (shared dengan pending)
        $cacheKey = 'delete_order_' . auth()->id() . '_' . now()->toDateString();
        $deleteCount = Cache::get($cacheKey, 0);

        if ($deleteCount >= 3) {
            return redirect()->route('orders.history')
                ->with('error', 'Batas penghapusan harian tercapai (maks. 3x/hari). Coba lagi besok.');
        }

        $order->delete();

        // Tambah hitungan hapus hari ini
        Cache::put($cacheKey, $deleteCount + 1, now()->endOfDay());

        return redirect()->route('orders.history')
            ->with('success', 'Riwayat order gagal telah dihapus.');
    }

    // Hapus order pending dari riwayat user (max 3x per hari, shared limit)
    public function destroyPending(Order $order)
    {
        // Pastikan order milik user yang login
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Hanya boleh hapus order dengan status pending
        if ($order->status !== 'pending') {
            return redirect()->route('orders.history')
                ->with('error', 'Hanya order yang belum dibayar yang dapat dihapus.');
        }

        // Rate limit: maksimal 3 penghapusan per hari per user (shared dengan failed)
        $cacheKey = 'delete_order_' . auth()->id() . '_' . now()->toDateString();
        $deleteCount = Cache::get($cacheKey, 0);

        if ($deleteCount >= 3) {
            return redirect()->route('orders.history')
                ->with('error', 'Batas penghapusan harian tercapai (maks. 3x/hari). Coba lagi besok.');
        }

        $order->delete();

        // Tambah hitungan hapus hari ini
        Cache::put($cacheKey, $deleteCount + 1, now()->endOfDay());

        return redirect()->route('orders.history')
            ->with('success', 'Order belum bayar berhasil dihapus dari riwayat.');
    }
}