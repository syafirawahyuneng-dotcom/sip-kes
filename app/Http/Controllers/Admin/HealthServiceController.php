<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HealthService;
use Illuminate\Http\Request;

class HealthServiceController extends Controller
{
    /**
     * Tampilkan data fasilitas kesehatan
     */
    public function index(Request $request)
    {
        $query = HealthService::query();

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('address', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $services = $query->latest()->paginate(10)->withQueryString();
        $types = HealthService::select('type')->distinct()->pluck('type');

        return view('admin.services.index', compact('services', 'types'));
    }

    /**
     * Form tambah fasilitas kesehatan
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Simpan faskes baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'type' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'emergency_phone' => 'nullable|string|max:30',
            'operational_hours' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'nullable|boolean',
        ], [
            'name.required' => 'Nama faskes wajib diisi.',
            'type.required' => 'Jenis faskes wajib dipilih.',
            'address.required' => 'Alamat lengkap faskes wajib diisi.',
            'operational_hours.required' => 'Jam operasional wajib diisi.',
        ]);

        HealthService::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'emergency_phone' => $validated['emergency_phone'],
            'operational_hours' => $validated['operational_hours'],
            'description' => $validated['description'],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Fasilitas kesehatan berhasil ditambahkan ke database.');
    }

    /**
     * Tampilkan detail atau arahkan ke edit faskes
     */
    public function show($id)
    {
        return redirect()->route('admin.services.edit', $id);
    }

    /**
     * Form edit faskes
     */
    public function edit($id)
    {
        $service = HealthService::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update data faskes
     */
    public function update(Request $request, $id)
    {
        $service = HealthService::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'type' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'emergency_phone' => 'nullable|string|max:30',
            'operational_hours' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'nullable|boolean',
        ]);

        $service->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'emergency_phone' => $validated['emergency_phone'],
            'operational_hours' => $validated['operational_hours'],
            'description' => $validated['description'],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Data fasilitas kesehatan berhasil diperbarui.');
    }

    /**
     * Hapus data faskes
     */
    public function destroy($id)
    {
        $service = HealthService::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Data fasilitas kesehatan berhasil dihapus.');
    }
}

