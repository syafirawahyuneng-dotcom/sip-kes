@extends('layouts.admin')

@section('title', 'Kelola Kategori Informasi')
@section('page_title', 'Manajemen Kategori Informasi Kesehatan')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Form Tambah Kategori Baru (5 cols) -->
    <div class="lg:col-span-5 bg-white rounded-3xl border border-slate-200 shadow-xs p-6 self-start">
        <div class="mb-5 pb-3 border-b border-slate-100">
            <h3 class="text-base font-extrabold text-slate-900">Tambah Kategori Baru</h3>
            <p class="text-xs text-slate-500 mt-0.5">Kelompokkan informasi kesehatan sesuai bidang topik</p>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                    placeholder="Contoh: Info Gizi & Nutrisi">
            </div>

            <div>
                <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Deskripsi Singkat
                </label>
                <textarea name="description" id="description" rows="2"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                    placeholder="Penjelasan singkat mengenai kategori ini...">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="icon" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Ikon FontAwesome
                    </label>
                    <input type="text" name="icon" id="icon" value="{{ old('icon', 'fa-solid fa-notes-medical') }}"
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none font-mono"
                        placeholder="fa-solid fa-heart-pulse">
                </div>

                <div>
                    <label for="color" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Warna Tema <span class="text-red-500">*</span>
                    </label>
                    <select name="color" id="color" required
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none bg-white">
                        <option value="emerald" {{ old('color') == 'emerald' ? 'selected' : '' }}>Emerald (Hijau)</option>
                        <option value="teal" {{ old('color') == 'teal' ? 'selected' : '' }}>Teal (Toska)</option>
                        <option value="blue" {{ old('color') == 'blue' ? 'selected' : '' }}>Blue (Biru)</option>
                        <option value="amber" {{ old('color') == 'amber' ? 'selected' : '' }}>Amber (Kuning/Oranye)</option>
                        <option value="purple" {{ old('color') == 'purple' ? 'selected' : '' }}>Purple (Ungu)</option>
                        <option value="red" {{ old('color') == 'red' ? 'selected' : '' }}>Red (Merah Darurat)</option>
                    </select>
                </div>
            </div>

            <div class="pt-1">
                <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                    <input type="checkbox" name="is_active" value="1" checked
                        class="w-4 h-4 rounded border-slate-300 text-medical-600 focus:ring-medical-500">
                    <span>Kategori Aktif & Tampil di Publik</span>
                </label>
            </div>

            <div class="pt-3">
                <button type="submit" class="w-full py-2.5 rounded-xl bg-medical-700 hover:bg-medical-800 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-plus"></i> Simpan Kategori
                </button>
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Kategori (7 cols) -->
    <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="text-base font-extrabold text-slate-900">Daftar Kategori Terdaftar</h3>
                <p class="text-xs text-slate-500">Semua kategori relasional yang digunakan oleh artikel informasi</p>
            </div>
            <span class="text-xs font-bold text-slate-600 bg-slate-100 px-3 py-1 rounded-full font-mono">
                Total: {{ $categories->count() }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-200/80">
                    <tr>
                        <th class="py-3 px-4">Ikon & Nama Kategori</th>
                        <th class="py-3 px-3">Slug</th>
                        <th class="py-3 px-3 text-center">Jumlah Artikel</th>
                        <th class="py-3 px-3">Status</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($categories as $cat)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center text-sm flex-shrink-0">
                                        <i class="{{ $cat->icon }}"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 text-xs">{{ $cat->name }}</p>
                                        @if($cat->description)
                                            <p class="text-[11px] text-slate-400 line-clamp-1">{{ $cat->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-3 font-mono text-[11px] text-slate-500">
                                {{ $cat->slug }}
                            </td>
                            <td class="py-3.5 px-3 text-center">
                                <span class="px-2 py-0.5 rounded-full text-xs font-mono font-bold {{ $cat->informations_count > 0 ? 'bg-teal-100 text-teal-800' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $cat->informations_count }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                @if($cat->is_active)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Nonaktif</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1">
                                    <!-- Edit Trigger Button (In-place modal or form) -->
                                    <button type="button" onclick="editCategory({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ addslashes($cat->description ?? '') }}', '{{ $cat->icon }}', '{{ $cat->color }}', {{ $cat->is_active ? 'true' : 'false' }})" class="p-1.5 rounded-lg text-teal-700 hover:text-teal-900 hover:bg-teal-50 transition" title="Ubah Kategori">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-red-500 hover:text-red-700 hover:bg-red-50 transition" title="Hapus Kategori">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori -->
<div id="editCategoryModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
            <h3 class="font-black text-slate-900 text-base">Ubah Data Kategori</h3>
            <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-700">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form id="editCategoryForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="edit_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="edit_name" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 outline-none">
            </div>

            <div>
                <label for="edit_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Deskripsi Singkat
                </label>
                <textarea name="description" id="edit_description" rows="2"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 outline-none"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="edit_icon" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Ikon FontAwesome
                    </label>
                    <input type="text" name="icon" id="edit_icon"
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:border-medical-500 outline-none font-mono">
                </div>

                <div>
                    <label for="edit_color" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Warna Tema <span class="text-red-500">*</span>
                    </label>
                    <select name="color" id="edit_color" required
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:border-medical-500 outline-none bg-white">
                        <option value="emerald">Emerald (Hijau)</option>
                        <option value="teal">Teal (Toska)</option>
                        <option value="blue">Blue (Biru)</option>
                        <option value="amber">Amber (Kuning/Oranye)</option>
                        <option value="purple">Purple (Ungu)</option>
                        <option value="red">Red (Merah Darurat)</option>
                    </select>
                </div>
            </div>

            <div class="pt-1">
                <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                    <input type="checkbox" name="is_active" id="edit_is_active" value="1"
                        class="w-4 h-4 rounded border-slate-300 text-medical-600 focus:ring-medical-500">
                    <span>Kategori Aktif & Tampil di Publik</span>
                </label>
            </div>

            <div class="pt-3 flex items-center justify-end gap-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50 transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-medical-700 hover:bg-medical-800 text-white font-extrabold text-xs shadow-md transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function editCategory(id, name, description, icon, color, isActive) {
        const form = document.getElementById('editCategoryForm');
        form.action = `/admin/categories/${id}`;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_icon').value = icon;
        document.getElementById('edit_color').value = color;
        document.getElementById('edit_is_active').checked = isActive;
        document.getElementById('editCategoryModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editCategoryModal').classList.add('hidden');
    }
</script>
@endpush
@endsection

