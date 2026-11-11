@extends('layouts.admin')

@section('title', 'Kelola Informasi Kesehatan')
@section('page_title', 'Manajemen Informasi & Berita Kesehatan')

@section('content')
<div class="space-y-6">
    <!-- Header Actions & Filters -->
    <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-xs flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Search & Filter Form -->
        <form action="{{ route('admin.informations.index') }}" method="GET" class="flex flex-wrap items-center gap-3 w-full md:w-auto flex-1">
            <div class="relative min-w-[240px] flex-1">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul informasi..."
                    class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-slate-200 focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none">
            </div>

            <select name="category_id" onchange="this.form.submit()"
                class="text-xs bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-700 outline-none focus:border-medical-500">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <select name="status" onchange="this.form.submit()"
                class="text-xs bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-700 outline-none focus:border-medical-500">
                <option value="">Semua Status</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published (Terbit)</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
            </select>

            @if(request('q') || request('category_id') || request('status'))
                <a href="{{ route('admin.informations.index') }}" class="text-xs text-red-600 hover:underline font-bold px-2">
                    Reset
                </a>
            @endif
        </form>

        <!-- Tambah Tombol -->
        <a href="{{ route('admin.informations.create') }}" class="w-full md:w-auto px-4 py-2.5 rounded-xl bg-medical-700 hover:bg-medical-800 text-white font-extrabold text-xs shadow-sm transition inline-flex items-center justify-center gap-2">
            <i class="fa-solid fa-plus"></i> Tambah Informasi Baru
        </a>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-200/80">
                    <tr>
                        <th class="py-3.5 px-4">Sampul</th>
                        <th class="py-3.5 px-4">Judul & Ringkasan</th>
                        <th class="py-3.5 px-4">Kategori</th>
                        <th class="py-3.5 px-3">Status</th>
                        <th class="py-3.5 px-3">Views</th>
                        <th class="py-3.5 px-4">Tanggal Publikasi</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($informations as $info)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-3 px-4 w-20">
                                @if($info->image)
                                    <img src="{{ $info->image }}" alt="{{ $info->title }}" class="w-14 h-14 rounded-xl object-cover bg-slate-100 border border-slate-200">
                                @else
                                    <div class="w-14 h-14 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400">
                                        <i class="fa-regular fa-image text-lg"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3 px-4 max-w-sm">
                                <div class="font-bold text-slate-900 text-sm mb-1 leading-snug line-clamp-1">
                                    {{ $info->title }}
                                </div>
                                <p class="text-slate-500 text-xs line-clamp-2 leading-relaxed">
                                    {{ $info->summary }}
                                </p>
                                @if($info->is_featured)
                                    <span class="inline-block mt-1 px-2 py-0.2 rounded-md bg-amber-100 text-amber-800 text-[10px] font-bold">
                                        <i class="fa-solid fa-star text-amber-600"></i> Artikel Unggulan
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-teal-50 text-teal-800">
                                    <i class="{{ $info->category->icon ?? 'fa-solid fa-tag' }} text-[11px]"></i>
                                    {{ $info->category->name ?? '-' }}
                                </span>
                            </td>
                            <td class="py-3 px-3 whitespace-nowrap">
                                @if($info->status === 'published')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 inline-flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Terbit
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 inline-flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Draft
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-3 font-mono font-bold text-slate-600 whitespace-nowrap">
                                {{ number_format($info->views) }}
                            </td>
                            <td class="py-3 px-4 text-slate-500 whitespace-nowrap">
                                {{ $info->published_at ? $info->published_at->format('d/m/Y H:i') : ($info->created_at ? $info->created_at->format('d/m/Y') : '-') }}
                            </td>
                            <td class="py-3 px-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1">
                                    <a href="{{ route('public.information.detail', $info->slug) }}" target="_blank" class="p-2 rounded-xl text-slate-500 hover:text-medical-700 hover:bg-slate-100 transition" title="Lihat di Halaman Publik">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                    <a href="{{ route('admin.informations.edit', $info->id) }}" class="p-2 rounded-xl text-teal-700 hover:text-teal-900 hover:bg-teal-50 transition" title="Edit Informasi">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.informations.destroy', $info->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-xl text-red-500 hover:text-red-700 hover:bg-red-50 transition" title="Hapus Informasi">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <i class="fa-solid fa-file-circle-question text-3xl mb-2 text-slate-300"></i>
                                <p class="text-sm font-semibold">Tidak ada data informasi yang ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $informations->links() }}
        </div>
    </div>
</div>
@endsection

