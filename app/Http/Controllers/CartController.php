<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Novel;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Halaman keranjang
    public function index()
    {
        // Simpan halaman sebelumnya ke session
        if (!request()->is('cart')) {
            session(['cart_back_url' => url()->previous()]);
        }

        $carts = auth()->user()->carts()->with('novel')->latest()->get();
        return view('cart.index', compact('carts'));
    }

    // Tambah novel ke keranjang
    public function store(Request $request, Novel $novel)
    {
        // Cek apakah sudah pernah beli
        if (auth()->user()->hasPurchased($novel)) {
            return back()->with('error', 'Kamu sudah membeli novel ini!');
        }

        // Cek apakah ada order pending untuk novel ini
        $pendingOrder = auth()->user()->orders()
            ->where('novel_id', $novel->id)
            ->where('status', 'pending')
            ->latest()
            ->first();

        if ($pendingOrder) {
            return redirect()->route('orders.repay', $pendingOrder)
                ->with('error', 'Kamu masih punya transaksi belum selesai untuk novel ini. Silakan selesaikan pembayaran.');
        }

        // Cek apakah sudah ada di keranjang
        $exists = Cart::where('user_id', auth()->id())
            ->where('novel_id', $novel->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Novel sudah ada di keranjang!');
        }

        Cart::create([
            'user_id' => auth()->id(),
            'novel_id' => $novel->id,
        ]);

        if ($request->back_url) {
            session(['novel_back_url' => $request->back_url]);
        }

        return back()->with('success', 'Novel berhasil ditambahkan ke keranjang!');
    }

    // Hapus novel dari keranjang
    public function destroy(Cart $cart)
    {
        // Pastikan cart milik user yang login
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cart->delete();
        return back()->with('success', 'Novel berhasil dihapus dari keranjang!');
    }
}