<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HealthService;
use App\Models\Information;
use App\Models\PublicMessage;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Beranda Publik SIP-Kes
     */
    public function index()
    {
        // Highlight / Featured Informasi
        $featured = Information::with('category')
            ->published()
            ->featured()
            ->latest('published_at')
            ->take(3)
            ->get();

        // Latest Informations (jika featured kurang, ambil yang terbaru)
        $latestInformations = Information::with('category')
            ->published()
            ->latest('published_at')
            ->take(6)
            ->get();

        // Kategori aktif dengan jumlah artikel
        $categories = Category::where('is_active', true)
            ->withCount(['informations' => function ($query) {
                $query->where('status', 'published');
            }])
            ->get();

        // Fasilitas Kesehatan Unggulan
        $services = HealthService::active()
            ->take(4)
            ->get();

        // Statistik portal
        $stats = [
            'total_info' => Information::published()->count(),
            'total_services' => HealthService::active()->count(),
            'total_categories' => Category::where('is_active', true)->count(),
            'total_views' => Information::sum('views'),
        ];

        return view('public.index', compact('featured', 'latestInformations', 'categories', 'services', 'stats'));
    }

    /**
     * Halaman Daftar Informasi / Berita / Edukasi Kesehatan
     */
    public function informations(Request $request)
    {
        $query = Information::with(['category', 'author'])->published();

        // Filter Pencarian
        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('summary', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        // Filter Kategori
        $activeCategory = null;
        if ($request->filled('kategori')) {
            $activeCategory = Category::where('slug', $request->kategori)->first();
            if ($activeCategory) {
                $query->where('category_id', $activeCategory->id);
            }
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        if ($sort === 'populer') {
            $query->orderByDesc('views');
        } else {
            $query->latest('published_at');
        }

        $informations = $query->paginate(9)->withQueryString();

        $categories = Category::where('is_active', true)
            ->withCount(['informations' => function ($q) {
                $q->where('status', 'published');
            }])
            ->get();

        // Artikel Populer untuk Sidebar
        $popularInformations = Information::published()
            ->orderByDesc('views')
            ->take(5)
            ->get();

        return view('public.informations', compact('informations', 'categories', 'activeCategory', 'popularInformations'));
    }

    /**
     * Halaman Detail Informasi Kesehatan
     */
    public function informationDetail($slug)
    {
        $information = Information::with(['category', 'author'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Increment view count secara dinamis
        $information->incrementViews();

        // Informasi terkait di kategori yang sama
        $relatedInformations = Information::where('category_id', $information->category_id)
            ->where('id', '!=', $information->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->take(4)
            ->get();

        // Kategori aktif untuk widget sidebar
        $categories = Category::where('is_active', true)
            ->withCount(['informations' => function ($q) {
                $q->where('status', 'published');
            }])
            ->get();

        return view('public.information-detail', compact('information', 'relatedInformations', 'categories'));
    }

    /**
     * Direktori Fasilitas & Layanan Kesehatan
     */
    public function services(Request $request)
    {
        $query = HealthService::active();

        if ($request->filled('tipe')) {
            $query->where('type', $request->tipe);
        }

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('address', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        $services = $query->paginate(8)->withQueryString();

        $serviceTypes = HealthService::select('type')
            ->distinct()
            ->pluck('type');

        return view('public.services', compact('services', 'serviceTypes'));
    }

    /**
     * Halaman Kontak & Pertanyaan Informasi
     */
    public function contact()
    {
        $settings = SystemSetting::pluck('value', 'key');
        return view('public.contact', compact('settings'));
    }

    /**
     * Proses Kirim Pesan / Aspirasi Pengunjung
     */
    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:2000',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'subject.required' => 'Topik pertanyaan / subjek wajib diisi.',
            'message.required' => 'Isi pesan tidak boleh kosong.',
        ]);

        PublicMessage::create($validated);

        return redirect()->route('public.contact')->with('success', 'Terima kasih! Pesan atau pertanyaan informasi Anda telah berhasil dikirim dan akan segera ditinjau oleh tim administrator SIP-Kes.');
    }
}

