<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InformationController extends Controller
{
    /**
     * Tampilkan daftar informasi kesehatan
     */
    public function index(Request $request)
    {
        $query = Information::with(['category', 'author']);

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('summary', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $informations = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.informations.index', compact('informations', 'categories'));
    }

    /**
     * Form tambah informasi baru
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.informations.create', compact('categories'));
    }

    /**
     * Simpan informasi baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:published,draft',
            'is_featured' => 'nullable|boolean',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'image_url' => 'nullable|url|max:500',
        ], [
            'title.required' => 'Judul informasi wajib diisi.',
            'category_id.required' => 'Pilih kategori informasi.',
            'summary.required' => 'Ringkasan singkat wajib diisi.',
            'content.required' => 'Konten lengkap informasi wajib diisi.',
            'image_file.image' => 'File harus berupa gambar.',
            'image_file.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $fileName = time() . '_' . Str::slug(Str::limit($request->title, 20, '')) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/informations'), $fileName);
            $imagePath = asset('uploads/informations/' . $fileName);
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->image_url;
        }

        $baseSlug = Str::slug($request->title);
        $slug = $baseSlug;
        $counter = 1;
        while (Information::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        Information::create([
            'category_id' => $validated['category_id'],
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'slug' => $slug,
            'summary' => $validated['summary'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'status' => $validated['status'],
            'is_featured' => $request->boolean('is_featured'),
            'views' => 0,
            'published_at' => $validated['status'] === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.informations.index')
            ->with('success', 'Informasi kesehatan baru berhasil ditambahkan dan langsung terhubung dengan database!');
    }

    /**
     * Pratinjau informasi (arahkan ke halaman publik detail)
     */
    public function show($id)
    {
        $information = Information::findOrFail($id);
        return redirect()->route('public.information.detail', $information->slug);
    }

    /**
     * Form edit informasi
     */
    public function edit($id)
    {
        $information = Information::findOrFail($id);
        $categories = Category::all();
        return view('admin.informations.edit', compact('information', 'categories'));
    }

    /**
     * Update data informasi di database
     */
    public function update(Request $request, $id)
    {
        $information = Information::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:published,draft',
            'is_featured' => 'nullable|boolean',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'image_url' => 'nullable|url|max:500',
        ]);

        $imagePath = $information->image;

        if ($request->hasFile('image_file')) {
            // Hapus gambar lama jika file lokal
            if ($information->image && str_contains($information->image, '/uploads/informations/')) {
                $oldFileName = basename($information->image);
                $oldFilePath = public_path('uploads/informations/' . $oldFileName);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }

            $file = $request->file('image_file');
            $fileName = time() . '_' . Str::slug(Str::limit($request->title, 20, '')) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/informations'), $fileName);
            $imagePath = asset('uploads/informations/' . $fileName);
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->image_url;
        }

        // Cek jika judul berubah untuk update slug
        $slug = $information->slug;
        if ($information->title !== $request->title) {
            $baseSlug = Str::slug($request->title);
            $slug = $baseSlug;
            $counter = 1;
            while (Information::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
        }

        $publishedAt = $information->published_at;
        if ($validated['status'] === 'published' && !$publishedAt) {
            $publishedAt = now();
        }

        $information->update([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => $slug,
            'summary' => $validated['summary'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'status' => $validated['status'],
            'is_featured' => $request->boolean('is_featured'),
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('admin.informations.index')
            ->with('success', 'Data informasi kesehatan berhasil diperbarui.');
    }

    /**
     * Hapus informasi dari database
     */
    public function destroy($id)
    {
        $information = Information::findOrFail($id);

        if ($information->image && str_contains($information->image, '/uploads/informations/')) {
            $oldFileName = basename($information->image);
            $oldFilePath = public_path('uploads/informations/' . $oldFileName);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
        }

        $information->delete();

        return redirect()->route('admin.informations.index')
            ->with('success', 'Informasi berhasil dihapus dari database.');
    }
}

