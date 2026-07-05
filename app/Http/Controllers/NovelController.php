<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    // Halaman list semua novel
    public function index(Request $request)
    {
        $popularNovels = Novel::withCount([
            'orders' => function ($q) {
                $q->where('status', 'success');
            }
        ])->orderBy('orders_count', 'desc')
          ->orderBy('created_at', 'desc')
          ->take(6)
          ->get();

        $query = Novel::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        if ($request->genre) {
            $query->where('genre', 'like', '%' . $request->genre . '%');
        }

        $novels = $query->latest()->get();

        return view('novels.index', compact('novels', 'popularNovels'));
    }

    // Halaman detail novel
    public function show(Novel $novel)
    {
        // Simpan URL halaman sebelumnya ke session
        if (!request()->is('novels/' . $novel->id)) {
            session(['novel_back_url' => url()->previous()]);
        }

        return view('novels.show', compact('novel'));
    }
}