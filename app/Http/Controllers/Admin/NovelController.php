<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Novel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NovelController extends Controller
{
    public function index(Request $request)
    {
        $query = Novel::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        $novels = $query->latest()->get();
        $totalNovels = Novel::count();

        return view('admin.novels.index', compact('novels', 'totalNovels'));
    }

    public function create()
    {
        return view('admin.novels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|array|min:1',
            'genre.*' => 'in:Action,Drama,Fantasy,Horror,Isekai,Mystery,Romance,Shounen,Slice of Life,Supernatural',
            'release_date' => 'required|date',
            'description' => 'required',
            'cover_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price' => 'required|numeric|min:1',
            'rating' => 'required|numeric|min:0|max:5',
            'file_path' => 'required|mimes:pdf,epub|max:51200',
        ], [
            'title.required' => 'Judul novel wajib diisi.',
            'author.required' => 'Nama penulis wajib diisi.',
            'genre.required' => 'Pilih minimal satu genre.',
            'genre.min' => 'Pilih minimal satu genre.',
            'release_date.required' => 'Tanggal rilis wajib diisi.',
            'description.required' => 'Sinopsis wajib diisi.',
            'cover_image.required' => 'Cover novel wajib diupload.',
            'cover_image.image' => 'Cover harus berupa file gambar.',
            'cover_image.mimes' => 'Format cover harus JPG, JPEG, PNG, atau WEBP.',
            'cover_image.max' => 'Ukuran cover maksimal 2MB.',
            'price.required' => 'Harga wajib diisi.',
            'price.min' => 'Harga minimal Rp 1.',
            'rating.required' => 'Rating wajib diisi.',
            'rating.min' => 'Rating minimal 0.',
            'rating.max' => 'Rating maksimal 5.',
            'file_path.required' => 'File novel wajib diupload.',
            'file_path.mimes' => 'File novel harus berformat PDF atau ePub.',
            'file_path.max' => 'Ukuran file novel maksimal 50MB.',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        }

        $filePath = null;
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('novels', 'public');
        }

        Novel::create([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => implode(',', $request->genre),
            'release_date' => $request->release_date,
            'description' => $request->description,
            'cover_image' => $coverPath,
            'price' => $request->price,
            'rating' => $request->rating ?? 0,
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.novels.index')->with('success', 'Novel berhasil ditambahkan!');
    }

    public function show(Novel $novel)
    {
        return view('admin.novels.show', compact('novel'));
    }

    public function edit(Novel $novel)
    {
        return view('admin.novels.edit', compact('novel'));
    }

    public function update(Request $request, Novel $novel)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|array|min:1',
            'genre.*' => 'in:Action,Drama,Fantasy,Horror,Isekai,Mystery,Romance,Shounen,Slice of Life,Supernatural',
            'release_date' => 'required|date',
            'description' => 'required',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'file_path' => 'nullable|mimes:pdf,epub|max:51200',
        ]);

        $coverPath = $novel->cover_image;
        if ($request->hasFile('cover_image')) {
            if ($novel->cover_image) {
                Storage::disk('public')->delete($novel->cover_image);
            }
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        }

        $filePath = $novel->file_path;
        if ($request->hasFile('file_path')) {
            if ($novel->file_path) {
                Storage::disk('public')->delete($novel->file_path);
            }
            $filePath = $request->file('file_path')->store('novels', 'public');
        }

        $novel->update([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => implode(',', $request->genre),
            'release_date' => $request->release_date,
            'description' => $request->description,
            'cover_image' => $coverPath,
            'price' => $request->price,
            'rating' => $request->rating ?? $novel->rating,
            'file_path' => $filePath,
        ]);
        return redirect()->route('admin.novels.index')->with('success', 'Novel berhasil diupdate!');
    }

    public function destroy(Novel $novel)
    {
        if ($novel->cover_image) {
            Storage::disk('public')->delete($novel->cover_image);
        }
        $novel->delete();
        return redirect()->route('admin.novels.index')->with('success', 'Novel berhasil dihapus!');
    }
}