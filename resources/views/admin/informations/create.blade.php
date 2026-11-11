@extends('layouts.admin')

@section('title', 'Tambah Informasi Baru')
@section('page_title', 'Tambah Informasi Kesehatan Baru')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Top Return & Breadcrumbs -->
    <div class="flex items-center justify-between">
        <nav class="flex items-center gap-2 text-xs text-slate-500 font-medium">
            <a href="{{ route('admin.informations.index') }}" class="hover:text-medical-700 transition">Informasi</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-slate-800 font-bold">Tambah Baru</span>
        </nav>
        <a href="{{ route('admin.informations.index') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900 transition flex items-center gap-1.5">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8">
        <form action="{{ route('admin.informations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Judul Informasi -->
            <div>
                <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Judul Informasi / Berita <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required autofocus
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                    placeholder="Contoh: Jadwal Pelayanan Poliklinik Terpadu Minggu Ini">
            </div>

            <!-- Kategori & Status Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Kategori -->
                <div>
                    <label for="category_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" id="category_id" required
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Publikasi -->
                <div>
                    <label for="status" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status" required
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none bg-white">
                        <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>Published (Langsung Terbit)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Simpan Konsep)</option>
                    </select>
                </div>

                <!-- Unggulan Checkbox -->
                <div class="flex items-center sm:pt-6">
                    <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-slate-300 text-medical-600 focus:ring-medical-500">
                        <span>Tampilkan sebagai Berita Utama (Featured)</span>
                    </label>
                </div>
            </div>

            <!-- Ringkasan Singkat -->
            <div>
                <label for="summary" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Ringkasan Singkat (Summary) <span class="text-red-500">*</span>
                </label>
                <textarea name="summary" id="summary" rows="2" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                    placeholder="Tuliskan 1-2 kalimat ringkasan yang menjelaskan inti informasi ini...">{{ old('summary') }}</textarea>
                <p class="text-[11px] text-slate-400 mt-1">Ringkasan akan ditampilkan pada kartu informasi di halaman beranda & katalog.</p>
            </div>

            <!-- Gambar Cover: Upload atau URL -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Foto Sampul / Banner Informasi
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <span class="text-[11px] font-semibold text-slate-500 block mb-1">Opsi A: Unggah Berkas Gambar</span>
                        <input type="file" name="image_file" accept="image/*"
                            class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-700 file:text-white hover:file:bg-medical-800 cursor-pointer">
                        <span class="text-[10px] text-slate-400 block mt-1">Format: JPG, PNG, WEBP (Maksimal 2MB)</span>
                    </div>
                    <div>
                        <span class="text-[11px] font-semibold text-slate-500 block mb-1">Opsi B: Atau Tautkan URL Gambar Online</span>
                        <input type="url" name="image_url" value="{{ old('image_url') }}"
                            placeholder="https://images.unsplash.com/photo-..."
                            class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none">
                    </div>
                </div>
            </div>

            <!-- Konten Lengkap -->
            <div>
                <label for="content" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Konten Lengkap Informasi <span class="text-red-500">*</span>
                </label>
                <textarea name="content" id="content" rows="12" required
                    class="w-full p-4 rounded-2xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none font-sans"
                    placeholder="Tuliskan isi informasi secara terstruktur. Anda dapat menggunakan format paragraf, poin-poin (bullet), atau tag HTML dasar seperti &lt;h3&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;, dll.">{{ old('content') }}</textarea>
                <p class="text-[11px] text-slate-400 mt-1">Mendukung format paragraf dan HTML dasar yang aman.</p>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.informations.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-medical-700 hover:bg-medical-800 text-white font-extrabold text-xs shadow-md transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan & Publikasikan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

