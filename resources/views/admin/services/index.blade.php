@extends('layouts.admin')

@section('title', 'Kelola Fasilitas Kesehatan')
@section('page_title', 'Manajemen Fasilitas & Layanan Kesehatan')

@section('content')
<div class="space-y-6">
    <!-- Header Actions & Filters -->
    <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-xs flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Search & Filter Form -->
        <form action="{{ route('admin.services.index') }}" method="GET" class="flex flex-wrap items-center gap-3 w-full md:w-auto flex-1">
            <div class="relative min-w-[240px] flex-1">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari faskes atau alamat..."
                    class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-slate-200 focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none">
            </div>

            <select name="type" onchange="this.form.submit()"
                class="text-xs bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-700 outline-none focus:border-medical-500">
                <option value="">Semua Tipe Faskes</option>
                @foreach($types as $t)
                    <option value="{{ $t }}" {{ request('type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>

            @if(request('q') || request('type'))
                <a href="{{ route('admin.services.index') }}" class="text-xs text-red-600 hover:underline font-bold px-2">
                    Reset
                </a>
            @endif
        </form>

        <a href="{{ route('admin.services.create') }}" class="w-full md:w-auto px-4 py-2.5 rounded-xl bg-medical-700 hover:bg-medical-800 text-white font-extrabold text-xs shadow-sm transition inline-flex items-center justify-center gap-2">
            <i class="fa-solid fa-plus"></i> Tambah Faskes Baru
        </a>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-200/80">
                    <tr>
                        <th class="py-3.5 px-4">Nama Fasilitas Kesehatan</th>
                        <th class="py-3.5 px-3">Tipe</th>
                        <th class="py-3.5 px-4">Alamat</th>
                        <th class="py-3.5 px-3">Kontak / IGD</th>
                        <th class="py-3.5 px-3">Jam Layanan</th>
                        <th class="py-3.5 px-3">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($services as $srv)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-3.5 px-4 font-bold text-slate-900 text-sm max-w-xs">
                                {{ $srv->name }}
                                @if($srv->description)
                                    <p class="text-[11px] font-normal text-slate-500 line-clamp-1 mt-0.5">{{ $srv->description }}</p>
                                @endif
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-bold {{ $srv->type === 'RSUD' ? 'bg-indigo-50 text-indigo-700' : ($srv->type === 'Puskesmas' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700') }}">
                                    {{ $srv->type }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 max-w-xs truncate">
                                {{ $srv->address }}
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                <div class="text-xs">
                                    @if($srv->phone)
                                        <p class="text-slate-800"><i class="fa-solid fa-phone text-slate-400 mr-1 text-[10px]"></i>{{ $srv->phone }}</p>
                                    @endif
                                    @if($srv->emergency_phone)
                                        <p class="text-red-600 font-bold"><i class="fa-solid fa-truck-medical text-red-500 mr-1 text-[10px]"></i>{{ $srv->emergency_phone }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap text-slate-600">
                                <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 text-[11px] font-semibold">
                                    {{ $srv->operational_hours }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                @if($srv->is_active)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Nonaktif</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1">
                                    <a href="{{ route('admin.services.edit', $srv->id) }}" class="p-2 rounded-xl text-teal-700 hover:text-teal-900 hover:bg-teal-50 transition" title="Edit Faskes">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $srv->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data faskes ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-xl text-red-500 hover:text-red-700 hover:bg-red-50 transition" title="Hapus Faskes">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <i class="fa-solid fa-hospital text-3xl mb-2 text-slate-300"></i>
                                <p class="text-sm font-semibold">Tidak ada data faskes yang ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $services->links() }}
        </div>
    </div>
</div>
@endsection

