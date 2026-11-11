@extends('layouts.public')

@section('title', 'Katalog Informasi & Berita Kesehatan - SIP-Kes')

@section('content')
<!-- Page Header Banner -->
<section class="bg-gradient-to-r from-medical-950 via-medical-900 to-brand-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-medical-300 mb-3 font-medium">
                <a href="{{ route('public.home') }}" class="hover:text-white transition">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[10px] text-medical-400"></i>
                <span class="text-white">Informasi & Berita Kesehatan</span>
            </nav>
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight">Katalog Informasi & Berita Kesehatan</h1>
            <p class="text-sm sm:text-base text-slate-200 mt-2">
                Temukan panduan pencegahan penyakit, jadwal pelayanan poliklinik terpadu, program vaksinasi, dan regulasi dinas kesehatan.
            </p>
        </div>
    </div>
</section>

<!-- Filter, Search, & Content Area -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Main Content (8 cols) -->
        <div class="lg:col-span-8 space-y-6">
            <!-- Search & Sort Bar -->
            <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-xs flex flex-col sm:flex-row gap-3 items-center justify-between">
                <!-- Search Form -->
                <form action="{{ route('public.informations') }}" method="GET" class="w-full sm:w-auto flex-1 relative flex items-center">
                    @if(request('kategori'))
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                    <span class="absolute left-3 text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul atau topik informasi..."
                        class="w-full pl-9 pr-20 py-2 text-sm rounded-xl border border-slate-200 focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none">
                    <button type="submit" class="absolute right-1 px-3 py-1.5 rounded-lg bg-medical-700 hover:bg-medical-800 text-white text-xs font-bold transition">
                        Cari
                    </button>
                </form>

                <!-- Sort Filter -->
                <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                    <span class="text-xs text-slate-500 font-semibold whitespace-nowrap">Urutkan:</span>
                    <form id="sortForm" action="{{ route('public.informations') }}" method="GET">
                        @if(request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif
                        @if(request('kategori'))
                            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        @endif
                        <select name="sort" onchange="document.getElementById('sortForm').submit()" 
                            class="text-xs font-medium bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-2 text-slate-700 outline-none focus:ring-1 focus:ring-medical-500">
                            <option value="terbaru" {{ request('sort') != 'populer' ? 'selected' : '' }}>Terbaru</option>
                            <option value="populer" {{ request('sort') == 'populer' ? 'selected' : '' }}>Paling Banyak Dilihat</option>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Active Filter Badges -->
            @if(request('q') || request('kategori'))
                <div class="flex flex-wrap items-center gap-2 pt-1 text-xs">
                    <span class="font-semibold text-slate-500">Filter Aktif:</span>
                    @if(request('q'))
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-medical-50 border border-medical-200 text-medical-800 font-medium">
                            <span>Kata kunci: <strong>"{{ request('q') }}"</strong></span>
                            <a href="{{ route('public.informations', array_merge(request()->except('q'), ['page' => 1])) }}" class="hover:text-red-600"><i class="fa-solid fa-xmark"></i></a>
                        </span>
                    @endif
                    @if($activeCategory)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-teal-50 border border-teal-200 text-teal-800 font-medium">
                            <span>Kategori: <strong>{{ $activeCategory->name }}</strong></span>
                            <a href="{{ route('public.informations', array_merge(request()->except('kategori'), ['page' => 1])) }}" class="hover:text-red-600"><i class="fa-solid fa-xmark"></i></a>
                        </span>
                    @endif
                    <a href="{{ route('public.informations') }}" class="text-xs text-red-600 hover:underline font-semibold ml-1">
                        Reset Semua Filter
                    </a>
                </div>
            @endif

            <!-- List Articles -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($informations as $info)
                    <article class="bg-white rounded-3xl border border-slate-200 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden group">
                        <div class="relative h-48 bg-slate-100 overflow-hidden">
                            <img src="{{ $info->image ?: 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=800&q=80' }}" 
                                alt="{{ $info->title }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/95 backdrop-blur-md text-medical-800 shadow-sm">
                                    <i class="{{ $info->category->icon ?? 'fa-solid fa-notes-medical' }} mr-1"></i>
                                    {{ $info->category->name ?? 'Informasi' }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-2.5 text-xs text-slate-500 mb-2">
                                    <span><i class="fa-regular fa-calendar mr-1"></i>{{ $info->published_at ? $info->published_at->translatedFormat('d M Y') : $info->created_at->translatedFormat('d M Y') }}</span>
                                    <span>•</span>
                                    <span><i class="fa-regular fa-eye mr-1"></i>{{ number_format($info->views) }} views</span>
                                </div>

                                <h2 class="text-base font-bold text-slate-900 group-hover:text-medical-700 transition leading-snug line-clamp-2">
                                    <a href="{{ route('public.information.detail', $info->slug) }}">
                                        {{ $info->title }}
                                    </a>
                                </h2>

                                <p class="text-xs sm:text-sm text-slate-600 mt-2 line-clamp-3 leading-relaxed">
                                    {{ $info->summary }}
                                </p>
                            </div>

                            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-xs text-slate-500 font-medium">
                                    <i class="fa-solid fa-user-check text-medical-600 mr-1"></i> SIP-Kes
                                </span>
                                <a href="{{ route('public.information.detail', $info->slug) }}" class="text-xs font-bold text-medical-700 hover:text-medical-800 transition inline-flex items-center gap-1">
                                    Selengkapnya <i class="fa-solid fa-angle-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-2 text-center py-16 bg-white rounded-3xl border border-dashed border-slate-300">
                        <i class="fa-solid fa-circle-question text-4xl text-slate-300 mb-3"></i>
                        <h3 class="text-base font-bold text-slate-800">Tidak ada informasi yang sesuai</h3>
                        <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                            Coba ubah kata kunci pencarian atau pilih kategori informasi lainnya.
                        </p>
                        <a href="{{ route('public.informations') }}" class="inline-block mt-4 px-4 py-2 rounded-xl bg-medical-700 text-white text-xs font-bold hover:bg-medical-800 transition">
                            Tampilkan Semua Informasi
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Dynamic Pagination Links -->
            <div class="pt-4">
                {{ $informations->links() }}
            </div>
        </div>

        <!-- Sidebar (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Categories Widget -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-xs">
                <h3 class="text-base font-extrabold text-slate-900 mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-tags text-medical-600"></i> Kategori Informasi
                </h3>
                <ul class="space-y-1.5">
                    <li>
                        <a href="{{ route('public.informations') }}" 
                           class="flex items-center justify-between px-3 py-2 rounded-xl text-xs sm:text-sm font-semibold transition {{ !request('kategori') ? 'bg-medical-50 text-medical-800 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-medical-700' }}">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-layer-group text-slate-400"></i> Semua Kategori
                            </span>
                            <span class="text-xs font-mono px-2 py-0.5 rounded-md bg-slate-100 text-slate-600">
                                {{ \App\Models\Information::published()->count() }}
                            </span>
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('public.informations', ['kategori' => $cat->slug]) }}" 
                               class="flex items-center justify-between px-3 py-2 rounded-xl text-xs sm:text-sm font-semibold transition {{ request('kategori') == $cat->slug ? 'bg-medical-50 text-medical-800 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-medical-700' }}">
                                <span class="flex items-center gap-2 truncate">
                                    <i class="{{ $cat->icon }} text-teal-600"></i> {{ $cat->name }}
                                </span>
                                <span class="text-xs font-mono px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 ml-2">
                                    {{ $cat->informations_count }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Popular Articles Widget -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-xs">
                <h3 class="text-base font-extrabold text-slate-900 mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-fire text-amber-500"></i> Informasi Populer
                </h3>
                <div class="space-y-4">
                    @foreach($popularInformations as $idx => $pop)
                        <a href="{{ route('public.information.detail', $pop->slug) }}" class="flex items-start gap-3 group">
                            <span class="w-6 h-6 rounded-lg bg-slate-100 text-slate-700 group-hover:bg-medical-600 group-hover:text-white flex items-center justify-center text-xs font-black transition flex-shrink-0 mt-0.5">
                                {{ $idx + 1 }}
                            </span>
                            <div class="min-w-0">
                                <h4 class="text-xs font-bold text-slate-800 group-hover:text-medical-700 transition leading-snug line-clamp-2">
                                    {{ $pop->title }}
                                </h4>
                                <span class="text-[11px] text-slate-400 mt-1 block">
                                    <i class="fa-regular fa-eye mr-1"></i>{{ number_format($pop->views) }} views
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Emergency Box Widget -->
            <div class="bg-gradient-to-br from-red-600 to-rose-700 rounded-3xl p-6 text-white shadow-lg space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center text-2xl mb-2">
                    <i class="fa-solid fa-truck-medical"></i>
                </div>
                <h3 class="text-lg font-black leading-tight">Butuh Bantuan Medis Segera?</h3>
                <p class="text-xs text-rose-100 leading-relaxed">
                    Hubungi Pusat Panggilan Darurat Medis 119 untuk penjemputan ambulans atau konsultasi darurat 24 jam.
                </p>
                <div class="pt-2">
                    <a href="tel:119" class="w-full py-2.5 rounded-xl bg-white text-red-700 hover:bg-rose-50 font-black text-xs text-center block transition shadow-md">
                        <i class="fa-solid fa-phone-volume mr-1.5"></i> Hubungi 119 Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

