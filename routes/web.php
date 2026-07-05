<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route khusus Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $novels = \App\Models\Novel::latest()->take(6)->get();
        $totalUsers = \App\Models\User::where('role', 'user')->count();
        $totalNovels = \App\Models\Novel::count();
        $totalOrders = \App\Models\Order::count();
        $totalRevenue = \App\Models\Order::where('status', 'success')->sum('amount');
        $recentOrders = \App\Models\Order::with(['user', 'novel'])->latest()->take(5)->get();
        $bestSellers = \App\Models\Novel::withCount([
            'orders' => function ($q) {
                $q->where('status', 'success');
            }
        ])->orderBy('orders_count', 'desc')->take(5)->get();
        $monthlySales = \App\Models\Order::where('status', 'success')
            ->selectRaw('MONTH(paid_at) as month, SUM(amount) as total')
            ->whereYear('paid_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        return view('admin.dashboard', compact(
            'novels',
            'totalUsers',
            'totalNovels',
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'bestSellers',
            'monthlySales'
        ));
    })->name('dashboard');

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('novels', \App\Http\Controllers\Admin\NovelController::class);
    Route::get('/transactions', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/export', [\App\Http\Controllers\Admin\TransactionController::class, 'export'])->name('transactions.export');
    Route::get('/transactions/{order}', [\App\Http\Controllers\Admin\TransactionController::class, 'show'])->name('transactions.show');
    Route::delete('/transactions/{order}', [\App\Http\Controllers\Admin\TransactionController::class, 'destroy'])->name('transactions.destroy');
});

// Route Novel untuk semua user
Route::middleware(['auth'])->group(function () {
    Route::get('/novels', [App\Http\Controllers\NovelController::class, 'index'])->name('novels.index');
    Route::get('/novels/{novel}', [App\Http\Controllers\NovelController::class, 'show'])->name('novels.show');
});

// Route Cart & Order (khusus user)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{novel}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cart}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/checkout', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/simulate', [App\Http\Controllers\OrderController::class, 'simulate'])->name('orders.simulate');
    Route::post('/orders/cancel', [App\Http\Controllers\OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/orders/success', [App\Http\Controllers\OrderController::class, 'success'])->name('orders.success');
    Route::get('/orders/history', [App\Http\Controllers\OrderController::class, 'history'])->name('orders.history');
    Route::delete('/orders/{order}/failed', [App\Http\Controllers\OrderController::class, 'destroyFailed'])->name('orders.destroyFailed');
    Route::delete('/orders/{order}/pending', [App\Http\Controllers\OrderController::class, 'destroyPending'])->name('orders.destroyPending');
    Route::get('/orders/{order}/repay', [App\Http\Controllers\OrderController::class, 'repay'])->name('orders.repay');
    Route::get('/orders/{order}/download', [App\Http\Controllers\OrderController::class, 'download'])->name('orders.download');
    Route::post('/novels/{novel}/buy-now', [App\Http\Controllers\OrderController::class, 'buyNow'])->name('orders.buyNow');
    Route::get('/novel-saya', [App\Http\Controllers\OrderController::class, 'myNovels'])->name('orders.myNovels');
});

// Callback Midtrans (tidak perlu auth)
Route::post('/midtrans/callback', [App\Http\Controllers\OrderController::class, 'callback'])->name('midtrans.callback');

require __DIR__ . '/auth.php';