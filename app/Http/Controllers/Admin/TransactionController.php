<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'novel'])->latest();

        // Search berdasarkan nama user atau judul novel
        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->orWhereHas('novel', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->get();

        $totalRevenue = Order::where('status', 'success')->sum('amount');
        $totalOrders = Order::count();
        $successOrders = Order::where('status', 'success')->count();
        $pendingOrders = Order::where('status', 'pending')->count();

        // Data untuk grafik pendapatan per bulan
        $monthlyRevenue = Order::where('status', 'success')
            ->selectRaw('MONTH(paid_at) as month, SUM(amount) as total')
            ->whereYear('paid_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Data untuk pie chart status
        $statusData = [
            'success' => Order::where('status', 'success')->count(),
            'pending' => Order::where('status', 'pending')->count(),
            'failed' => Order::where('status', 'failed')->count(),
        ];

        return view('admin.transactions.index', compact(
            'orders',
            'totalRevenue',
            'totalOrders',
            'successOrders',
            'pendingOrders',
            'monthlyRevenue',
            'statusData'
        ));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'novel']);
        return view('admin.transactions.show', compact('order'));
    }

    public function export(Request $request)
    {
        $query = Order::with(['user', 'novel'])->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->get();

        $statusLabel = $request->status ? strtoupper($request->status) : 'SEMUA';
        $filename = 'laporan_transaksi_' . $statusLabel . '_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($orders, $statusLabel) {
            $file = fopen('php://output', 'w');

            // UTF-8 BOM — agar Excel membaca karakter Indonesia dengan benar
            fputs($file, "\xEF\xBB\xBF");

            // ===== JUDUL LAPORAN =====
            fputcsv($file, ['LAPORAN TRANSAKSI PLOTLIST']);
            fputcsv($file, ['Tanggal Export', date('d/m/Y H:i')]);
            fputcsv($file, ['Filter Status', $statusLabel]);
            fputcsv($file, ['Total Data', $orders->count() . ' transaksi']);
            fputcsv($file, []); // baris kosong

            // ===== HEADER KOLOM =====
            fputcsv($file, [
                'No',
                'Order ID',
                'Nama User',
                'Email',
                'Judul Novel',
                'Genre',
                'Harga (Rp)',
                'Status',
                'Tanggal Order',
                'Tanggal Bayar',
            ]);

            // ===== DATA TRANSAKSI =====
            $no             = 1;
            $totalSuccess   = 0;
            $totalPending   = 0;
            $totalFailed    = 0;
            $grandTotal     = 0;

            foreach ($orders as $order) {
                $harga = (int) $order->amount;

                fputcsv($file, [
                    $no++,
                    $order->order_id,
                    $order->user->name ?? '-',
                    $order->user->email ?? '-',
                    $order->novel->title ?? '-',
                    $order->novel->genre ?? '-',
                    number_format($harga, 0, ',', '.'),
                    ucfirst($order->status),
                    $order->created_at->format('d/m/Y H:i'),
                    $order->paid_at ? \Carbon\Carbon::parse($order->paid_at)->format('d/m/Y H:i') : '-',
                ]);

                if ($order->status === 'success') {
                    $totalSuccess += $harga;
                    $grandTotal   += $harga;
                } elseif ($order->status === 'pending') {
                    $totalPending += $harga;
                } else {
                    $totalFailed += $harga;
                }
            }

            // ===== RINGKASAN =====
            fputcsv($file, []); // baris kosong
            fputcsv($file, ['--- RINGKASAN ---']);
            fputcsv($file, ['Total Transaksi',    '', '', '', '', '', $orders->count() . ' transaksi']);
            fputcsv($file, ['Total Berhasil (Success)', '', '', '', '', '', 'Rp ' . number_format($totalSuccess, 0, ',', '.')]);
            fputcsv($file, ['Total Pending',      '', '', '', '', '', 'Rp ' . number_format($totalPending, 0, ',', '.')]);
            fputcsv($file, ['Total Gagal (Failed)', '', '', '', '', '', 'Rp ' . number_format($totalFailed, 0, ',', '.')]);
            fputcsv($file, ['TOTAL PENDAPATAN BERSIH', '', '', '', '', '', 'Rp ' . number_format($grandTotal, 0, ',', '.')]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Admin hapus order failed
    public function destroy(Order $order)
    {
        if ($order->status !== 'failed') {
            return redirect()->route('admin.transactions.index')
                ->with('error', 'Hanya transaksi dengan status Failed yang dapat dihapus.');
        }

        $order->delete();

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi gagal berhasil dihapus.');
    }
}