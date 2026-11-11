@extends('layouts.admin')

@section('title', 'Dashboard Administrator')
@section('page_title', 'Dashboard Ringkasan SIP-Kes')

@section('content')
<div class="space-y-8">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-medical-900 via-medical-800 to-brand-900 rounded-3xl p-6 sm:p-8 text-white shadow-md flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div class="space-y-2">
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/10 border border-white/20 text-medical-300">
                <i class="fa-solid fa-circle-check text-medical-400 mr-1"></i> Terhubung dengan Database Relasional
            </span>
            <h2 class="text-2xl sm:text-3xl font-black tracking-tight">Selamat Datang, {{ Auth::user()->name }}!</h2>
            <p class="text-xs sm:text-sm text-slate-300 max-w-2xl leading-relaxed">
                Kelola konten edukasi kesehatan, publikasikan pengumuman faskes, serta tanggapi pesan aspirasi masyarakat secara terpusat dan dinamis.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.informations.create') }}" class="px-4 py-2.5 rounded-xl bg-medical-400 hover:bg-medical-300 text-slate-950 font-extrabold text-xs shadow-md transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Informasi
            </a>
            <a href="{{ route('public.home') }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs border border-white/20 transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Cek Publik
            </a>
        </div>
    </div>

    <!-- Statistics Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Total Informasi -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Informasi</p>
                <h3 class="text-2xl font-black text-slate-900 mt-1 font-mono">{{ $stats['total_info'] }}</h3>
                <p class="text-[11px] text-slate-500 mt-1">
                    <span class="text-emerald-600 font-bold">{{ $stats['published_info'] }} Terbit</span> • 
                    <span class="text-slate-400">{{ $stats['draft_info'] }} Draft</span>
                </p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center text-xl">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>

        <!-- Fasilitas Kesehatan -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Fasilitas Kesehatan</p>
                <h3 class="text-2xl font-black text-slate-900 mt-1 font-mono">{{ $stats['total_services'] }}</h3>
                <p class="text-[11px] text-teal-600 font-bold mt-1">RSUD, Puskesmas, Pos 119</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-700 flex items-center justify-center text-xl">
                <i class="fa-solid fa-hospital-user"></i>
            </div>
        </div>

        <!-- Pesan Masuk Publik -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pesan / Aspirasi</p>
                <h3 class="text-2xl font-black text-slate-900 mt-1 font-mono">{{ $stats['total_messages'] }}</h3>
                <p class="text-[11px] mt-1 font-bold {{ $stats['unread_messages'] > 0 ? 'text-amber-600' : 'text-slate-400' }}">
                    {{ $stats['unread_messages'] }} Belum Dibaca
                </p>
            </div>
            <div class="w-12 h-12 rounded-2xl {{ $stats['unread_messages'] > 0 ? 'bg-amber-50 text-amber-600' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center text-xl">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
        </div>

        <!-- Total Pembaca (Views) -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Pembaca</p>
                <h3 class="text-2xl font-black text-slate-900 mt-1 font-mono">{{ number_format($stats['total_views']) }}</h3>
                <p class="text-[11px] text-slate-400 mt-1">Akumulasi Klik Artikel</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-700 flex items-center justify-center text-xl">
                <i class="fa-solid fa-chart-line"></i>
            </div>
        </div>
    </div>

    <!-- Tables Grid: Recent Information & Recent Messages -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- 5 Informasi Terkini (7 cols) -->
        <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden flex flex-col">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="font-extrabold text-slate-900 text-base">Informasi Kesehatan Terkini</h3>
                    <p class="text-xs text-slate-500">Pembaruan konten yang tampil di halaman publik</p>
                </div>
                <a href="{{ route('admin.informations.index') }}" class="text-xs font-bold text-medical-700 hover:text-medical-800 transition">
                    Lihat Semua <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </a>
            </div>

            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-100">
                        <tr>
                            <th class="py-3 px-4">Judul & Kategori</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3">Views</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($latestInformations as $info)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3.5 px-4 max-w-xs">
                                    <div class="font-bold text-slate-900 line-clamp-1 mb-0.5">{{ $info->title }}</div>
                                    <span class="text-[11px] text-medical-700 flex items-center gap-1 font-semibold">
                                        <i class="{{ $info->category->icon ?? 'fa-solid fa-tag' }} text-[10px]"></i>
                                        {{ $info->category->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-3 whitespace-nowrap">
                                    @if($info->status === 'published')
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            Published
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-3 font-mono text-slate-600 whitespace-nowrap">
                                    {{ number_format($info->views) }}
                                </td>
                                <td class="py-3.5 px-4 text-right whitespace-nowrap space-x-1">
                                    <a href="{{ route('admin.informations.edit', $info->id) }}" class="p-1.5 rounded-lg text-slate-600 hover:text-medical-700 hover:bg-slate-100" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ route('public.information.detail', $info->slug) }}" target="_blank" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-800 hover:bg-slate-100" title="Pratinjau">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-400">Belum ada informasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 5 Pesan Terkini (5 cols) -->
        <div class="lg:col-span-5 bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden flex flex-col">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="font-extrabold text-slate-900 text-base">Aspirasi & Pesan Publik</h3>
                    <p class="text-xs text-slate-500">Pertanyaan masyarakat dari form kontak</p>
                </div>
                <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-medical-700 hover:text-medical-800 transition">
                    Semua Pesan <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </a>
            </div>

            <div class="p-4 flex-1 space-y-3">
                @forelse($latestMessages as $msg)
                    <div class="p-3.5 rounded-2xl border border-slate-100 {{ $msg->status === 'unread' ? 'bg-amber-50/50 border-amber-200' : 'bg-slate-50/50' }} flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-bold text-slate-900 text-xs truncate">{{ $msg->name }}</span>
                                @if($msg->status === 'unread')
                                    <span class="px-1.5 py-0.2 rounded-full text-[9px] font-black bg-amber-500 text-slate-950 uppercase">Baru</span>
                                @elseif($msg->status === 'replied')
                                    <span class="px-1.5 py-0.2 rounded-full text-[9px] font-bold bg-emerald-100 text-emerald-800">Dibalas</span>
                                @endif
                            </div>
                            <p class="text-xs font-semibold text-slate-700 truncate">{{ $msg->subject }}</p>
                            <p class="text-[11px] text-slate-500 line-clamp-1 mt-0.5">{{ $msg->message }}</p>
                        </div>
                        <a href="{{ route('admin.messages.show', $msg->id) }}" class="px-2.5 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 text-xs font-bold transition flex-shrink-0">
                            Buka
                        </a>
                    </div>
                @empty
                    <div class="py-8 text-center text-slate-400 text-xs">Belum ada pesan masuk.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

