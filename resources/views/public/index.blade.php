@extends('layouts.public')

@section('title', 'Beranda Utama - SIP-Kes Sistem Informasi Pelayanan Kesehatan')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-b from-medical-950 via-medical-900 to-brand-900 text-white overflow-hidden py-16 lg:py-24">
    <!-- Decorative Glow Elements -->
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-medical-400/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Headline -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-medical-300 text-xs sm:text-sm font-semibold">
                    <span class="w-2 h-2 rounded-full bg-medical-400 animate-ping"></span>
                    Portal Informasi Kesehatan Terpadu Masyarakat
                </div>
                
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight sm:leading-tight lg:leading-tight">
                    Akses Informasi <span class="text-medical-400 underline decoration-medical-400/50">Pelayanan Kesehatan</span> Cepat, Akurat & Transparan
                </h1>

                <p class="text-base sm:text-lg text-slate-200 font-normal leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    SIP-Kes hadir memberikan informasi jadwal fasilitas kesehatan, edukasi pencegahan penyakit, panduan rujukan BPJS, serta layanan gawat darurat 24 jam untuk seluruh masyarakat.
                </p>

                <!-- Search Bar Direct on Hero -->
                <div class="pt-2 max-w-xl mx-auto lg:mx-0">
                    <form action="{{ route('public.informations') }}" method="GET" class="relative flex items-center shadow-2xl rounded-2xl overflow-hidden bg-white p-1.5">
                        <span class="pl-3.5 text-slate-400 text-lg">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" name="q" placeholder="Cari info penyakit, jadwal imunisasi, BPJS..." 
                            class="w-full px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 bg-transparent outline-none">
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-medical-700 hover:bg-medical-800 text-white font-bold text-sm transition">
                            Cari
                        </button>
                    </form>
                </div>

                <!-- Emergency & Direct Actions -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-3">
                    <a href="{{ route('public.informations') }}" class="px-5 py-3 rounded-xl bg-medical-400 hover:bg-medical-300 text-slate-950 font-black text-sm shadow-lg transition flex items-center gap-2">
                        <i class="fa-solid fa-book-medical"></i> Jelajahi Informasi Kesehatan
                    </a>
                    <a href="{{ route('public.services') }}" class="px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-sm transition flex items-center gap-2">
                        <i class="fa-solid fa-hospital"></i> Direktori Faskes & RS
                    </a>
                </div>
            </div>

            <!-- Right Visual (Free-floating Doctor Cutout with Organic Glow & Glass Badges) -->
            <div class="lg:col-span-5 relative flex items-center justify-center pt-8 lg:pt-0">
                <!-- Organic Background Halo Glow -->
                <div class="absolute w-72 sm:w-96 h-72 sm:h-96 rounded-full bg-gradient-to-tr from-medical-500/35 via-cyan-400/25 to-brand-400/20 blur-3xl top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>

                <!-- Decorative Subtle Orbital Ring -->
                <div class="absolute w-80 sm:w-[420px] h-80 sm:h-[420px] rounded-full border border-dashed border-white/15 pointer-events-none top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 animate-spin-slow"></div>

                <!-- Free-floating Doctor Cutout Image (No Box Frame) -->
                <div class="relative z-10 w-full max-w-[340px] sm:max-w-[400px] lg:max-w-[440px] flex justify-center">
                    <img src="{{ asset('image/hero-doctor.png') }}" 
                         alt="Dokter Pelayanan Kesehatan SIP-Kes" 
                         class="w-full h-auto object-contain drop-shadow-[0_20px_35px_rgba(0,0,0,0.45)] select-none pointer-events-none transform hover:scale-105 transition-transform duration-500">

                    <!-- Floating Badge 1 (Top-Left) -->
                    <div class="absolute -top-3 -left-3 sm:-left-6 bg-white/95 backdrop-blur-md py-2.5 px-4 rounded-2xl shadow-2xl border border-white/60 flex items-center gap-3 text-slate-800 animate-float">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center text-base shadow-md flex-shrink-0">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Tenaga Medis</p>
                            <p class="text-xs sm:text-sm font-extrabold text-slate-900">Siaga & Terverifikasi</p>
                        </div>
                    </div>

                    <!-- Floating Badge 2 (Mid-Right) -->
                    <div class="absolute top-1/3 -right-3 sm:-right-8 bg-white/95 backdrop-blur-md py-2.5 px-4 rounded-2xl shadow-2xl border border-white/60 flex items-center gap-3 text-slate-800 animate-float-delayed">
                        <div class="w-10 h-10 rounded-xl bg-medical-600 text-white flex items-center justify-center text-base shadow-md flex-shrink-0">
                            <i class="fa-solid fa-hospital-user"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Akses Terpadu</p>
                            <p class="text-xs sm:text-sm font-extrabold text-medical-800">Puskesmas & RSUD</p>
                        </div>
                    </div>

                    <!-- Floating Badge 3 (Bottom-Left) -->
                    <div class="absolute -bottom-2 -left-2 sm:-left-4 bg-slate-950/85 backdrop-blur-md py-2 px-3.5 rounded-xl border border-white/20 shadow-2xl flex items-center gap-2.5 text-white">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                        <span class="text-xs font-bold text-slate-100">Portal Edukasi & Layanan Resmi</span>
                    </div>

                    <!-- Floating Badge 4 (Bottom-Right Mini Stat) -->
                    <div class="absolute -bottom-2 -right-2 sm:-right-4 bg-medical-900/90 backdrop-blur-md py-2 px-3.5 rounded-xl border border-medical-400/30 shadow-2xl flex items-center gap-2 text-white">
                        <i class="fa-solid fa-shield-heart text-medical-300 text-sm"></i>
                        <span class="text-xs font-extrabold text-medical-200">100% Bebas Biaya</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Stats Bar -->
<section class="relative -mt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-20">
    <div class="bg-white rounded-2xl shadow-xl border border-slate-200/80 p-6 grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
        <div class="border-r-0 lg:border-r border-slate-100 last:border-0 p-2">
            <div class="text-3xl sm:text-4xl font-black text-medical-700 font-mono">{{ $stats['total_info'] }}</div>
            <p class="text-xs sm:text-sm font-semibold text-slate-600 mt-1">Informasi Terpublikasi</p>
        </div>
        <div class="border-r-0 lg:border-r border-slate-100 last:border-0 p-2">
            <div class="text-3xl sm:text-4xl font-black text-teal-600 font-mono">{{ $stats['total_services'] }}</div>
            <p class="text-xs sm:text-sm font-semibold text-slate-600 mt-1">Fasilitas Kesehatan</p>
        </div>
        <div class="border-r-0 lg:border-r border-slate-100 last:border-0 p-2">
            <div class="text-3xl sm:text-4xl font-black text-emerald-600 font-mono">{{ $stats['total_categories'] }}</div>
            <p class="text-xs sm:text-sm font-semibold text-slate-600 mt-1">Kategori Edukasi</p>
        </div>
        <div class="p-2">
            <div class="text-3xl sm:text-4xl font-black text-sky-600 font-mono">{{ number_format($stats['total_views']) }}</div>
            <p class="text-xs sm:text-sm font-semibold text-slate-600 mt-1">Total Pembaca Info</p>
        </div>
    </div>
</section>

<!-- Layanan Kontak Cepat & Tanggap Darurat (PSC 119) -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-2">
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-medical-950 via-slate-900 to-medical-900 border border-slate-800 shadow-xl p-6 sm:p-8 text-white">
        <!-- Glow decoration -->
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-red-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-medical-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <!-- Left Info -->
            <div class="max-w-xl">
                <div class="flex items-center gap-2.5 mb-2.5">
                    <span class="w-8 h-8 rounded-lg bg-red-500/20 text-red-400 flex items-center justify-center text-sm shadow-inner">
                        <i class="fa-solid fa-phone-volume"></i>
                    </span>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-black bg-red-500 text-white uppercase tracking-wider shadow-sm">
                        24 JAM
                    </span>
                    <span class="text-xs text-medical-300 font-bold">Public Safety Center (PSC)</span>
                </div>
                <h3 class="text-xl sm:text-2xl font-black text-white tracking-tight">
                    Kontak Cepat Tanggap Darurat
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 mt-1.5 leading-relaxed">
                    Butuh respon gawat darurat medis, penjemputan ambulans darurat, atau informasi kesehatan mendesak? Tim PSC siaga 24 jam melayani Anda.
                </p>
                <div class="flex items-center gap-2 mt-3.5 text-xs text-medical-300">
                    <i class="fa-solid fa-shield-halved text-medical-400"></i>
                    <span>Terintegrasi resmi dengan seluruh Puskesmas & RSUD di wilayah.</span>
                </div>
            </div>

            <!-- Right Action Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 lg:w-[480px] flex-shrink-0">
                <!-- Card 1: Ambulans 119 -->
                <div class="bg-white/10 hover:bg-white/15 border border-white/15 rounded-2xl p-4 transition flex flex-col justify-between shadow-sm">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-red-600 flex items-center justify-center text-white text-lg shadow-md flex-shrink-0">
                            <i class="fa-solid fa-truck-medical"></i>
                        </div>
                        <span class="text-[11px] font-bold text-red-300 bg-red-950/60 border border-red-500/30 px-2 py-0.5 rounded-md">Bebas Pulsa</span>
                    </div>
                    <div>
                        <p class="text-xs text-slate-300">Call Center Ambulans 119</p>
                        <p class="text-lg font-black text-white">Bebas Pulsa: 119</p>
                    </div>
                    <a href="tel:119" class="mt-3.5 w-full py-2.5 px-3 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold text-xs text-center transition flex items-center justify-center gap-2 shadow-md">
                        <i class="fa-solid fa-phone"></i> Panggil Sekarang
                    </a>
                </div>

                <!-- Card 2: WhatsApp -->
                <div class="bg-white/10 hover:bg-white/15 border border-white/15 rounded-2xl p-4 transition flex flex-col justify-between shadow-sm">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-medical-500 flex items-center justify-center text-white text-lg shadow-md flex-shrink-0">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <span class="text-[11px] font-bold text-medical-300 bg-medical-950/60 border border-medical-500/30 px-2 py-0.5 rounded-md">Siaga Online</span>
                    </div>
                    <div>
                        <p class="text-xs text-slate-300">WhatsApp Info Kesehatan</p>
                        <p class="text-sm font-black text-white truncate">{{ \App\Models\SystemSetting::get('office_whatsapp', '0812-3456-7890') }}</p>
                    </div>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\SystemSetting::get('office_whatsapp', '081234567890')) }}" target="_blank" class="mt-3.5 w-full py-2.5 px-3 rounded-xl bg-medical-400 hover:bg-medical-300 text-slate-950 font-black text-xs text-center transition flex items-center justify-center gap-2 shadow-md">
                        <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Health Topics / Categories -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">
    <div class="text-center max-w-2xl mx-auto mb-10">
        <span class="text-xs font-bold uppercase tracking-wider text-medical-600 bg-medical-50 px-3 py-1 rounded-full">Topik Informasi</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Kategori Informasi Kesehatan</h2>
        <p class="text-slate-600 text-sm mt-2">Pilih kategori untuk melihat informasi, jadwal, dan panduan kesehatan terverifikasi.</p>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
        @foreach($categories as $cat)
            <a href="{{ route('public.informations', ['kategori' => $cat->slug]) }}" class="group bg-white p-5 rounded-2xl border border-slate-200/90 hover:border-medical-500 shadow-xs hover:shadow-md transition text-center flex flex-col items-center justify-center">
                <div class="w-12 h-12 rounded-2xl bg-medical-50 text-medical-700 group-hover:bg-medical-700 group-hover:text-white flex items-center justify-center text-xl transition mb-3">
                    <i class="{{ $cat->icon }}"></i>
                </div>
                <h3 class="text-xs sm:text-sm font-bold text-slate-800 group-hover:text-medical-700 transition line-clamp-2">{{ $cat->name }}</h3>
                <span class="mt-1 text-[11px] text-slate-500 font-medium font-mono">{{ $cat->informations_count }} artikel</span>
            </a>
        @endforeach
    </div>
</section>

<!-- Highlight / Latest Informations Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-medical-600 bg-medical-50 px-3 py-1 rounded-full">Kabar & Edukasi</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Informasi Terbaru SIP-Kes</h2>
            <p class="text-slate-600 text-sm mt-1">Dapatkan pembaruan terkini seputar layanan faskes, gizi, dan info darurat.</p>
        </div>
        <a href="{{ route('public.informations') }}" class="inline-flex items-center gap-2 text-sm font-bold text-medical-700 hover:text-medical-800 transition">
            Lihat Semua Informasi <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <!-- Grid Cards Informasi -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($latestInformations as $info)
            <article class="bg-white rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden group">
                <!-- Cover Image -->
                <div class="relative h-48 bg-slate-100 overflow-hidden">
                    <img src="{{ $info->image ?: 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=800&q=80' }}" 
                         alt="{{ $info->title }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/90 backdrop-blur-md text-medical-800 shadow-sm">
                            <i class="{{ $info->category->icon ?? 'fa-solid fa-notes-medical' }} mr-1"></i>
                            {{ $info->category->name ?? 'Informasi' }}
                        </span>
                    </div>
                    @if($info->is_featured)
                        <div class="absolute top-3 right-3">
                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-extrabold bg-amber-400 text-amber-950 shadow-sm flex items-center gap-1">
                                <i class="fa-solid fa-star"></i> Utama
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Content Body -->
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-3 text-xs text-slate-500 mb-2.5">
                            <span class="flex items-center gap-1">
                                <i class="fa-regular fa-calendar"></i>
                                {{ $info->published_at ? $info->published_at->translatedFormat('d M Y') : $info->created_at->translatedFormat('d M Y') }}
                            </span>
                            <span>•</span>
                            <span class="flex items-center gap-1">
                                <i class="fa-regular fa-eye"></i>
                                {{ number_format($info->views) }} kali dibaca
                            </span>
                        </div>

                        <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-medical-700 transition leading-snug line-clamp-2">
                            <a href="{{ route('public.information.detail', $info->slug) }}">
                                {{ $info->title }}
                            </a>
                        </h3>

                        <p class="text-xs sm:text-sm text-slate-600 mt-2.5 leading-relaxed line-clamp-3">
                            {{ $info->summary }}
                        </p>
                    </div>

                    <div class="pt-5 mt-5 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-medium text-slate-500 flex items-center gap-1.5">
                            <i class="fa-solid fa-user-doctor text-medical-600"></i>
                            <span>Admin SIP-Kes</span>
                        </span>

                        <a href="{{ route('public.information.detail', $info->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-medical-700 hover:text-medical-800 transition">
                            Baca Detail <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-3 text-center py-12 bg-white rounded-3xl border border-dashed border-slate-300">
                <i class="fa-solid fa-file-medical text-4xl text-slate-300 mb-3"></i>
                <p class="text-slate-600 font-medium text-sm">Belum ada informasi yang dipublikasikan saat ini.</p>
            </div>
        @endforelse
    </div>
</section>

<!-- Featured Health Facilities (Faskes) -->
<section class="bg-gradient-to-b from-slate-100 to-white py-16 border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-medical-600 bg-white px-3 py-1 rounded-full border border-slate-200">Fasilitas Medis</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Fasilitas Kesehatan Mitra SIP-Kes</h2>
                <p class="text-slate-600 text-sm mt-1">Direktori resmi Rumah Sakit Umum Daerah, Puskesmas, dan Pos Pelayanan Darurat.</p>
            </div>
            <a href="{{ route('public.services') }}" class="inline-flex items-center gap-2 text-sm font-bold text-medical-700 hover:text-medical-800 transition">
                Lihat Seluruh Faskes <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($services as $srv)
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold {{ $srv->type === 'RSUD' ? 'bg-indigo-50 text-indigo-700' : ($srv->type === 'Puskesmas' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700') }}">
                                {{ $srv->type }}
                            </span>
                            <span class="text-[11px] font-semibold text-slate-500 flex items-center gap-1">
                                <i class="fa-regular fa-clock"></i> {{ $srv->operational_hours }}
                            </span>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 mb-2">{{ $srv->name }}</h3>
                        <p class="text-xs text-slate-600 line-clamp-2 mb-3 leading-relaxed">
                            {{ $srv->description }}
                        </p>
                        <p class="text-xs text-slate-500 flex items-start gap-1.5 mb-2">
                            <i class="fa-solid fa-location-dot mt-0.5 text-medical-600 flex-shrink-0"></i>
                            <span class="line-clamp-2">{{ $srv->address }}</span>
                        </p>
                    </div>

                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-medium">
                        @if($srv->phone)
                            <a href="tel:{{ $srv->phone }}" class="text-teal-700 hover:text-teal-800 font-bold inline-flex items-center gap-1">
                                <i class="fa-solid fa-phone"></i> {{ $srv->phone }}
                            </a>
                        @endif
                        @if($srv->emergency_phone)
                            <a href="tel:{{ $srv->emergency_phone }}" class="text-red-600 hover:text-red-700 font-bold inline-flex items-center gap-1">
                                <i class="fa-solid fa-truck-medical"></i> IGD
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action Aspirasi & Bantuan -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="bg-gradient-to-r from-medical-900 via-medical-800 to-brand-800 rounded-3xl p-8 sm:p-12 text-white shadow-xl flex flex-col lg:flex-row items-center justify-between gap-8">
        <div class="space-y-3 max-w-xl text-center lg:text-left">
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/10 border border-white/20 text-medical-300 uppercase tracking-wide">
                Keterbukaan Informasi Publik
            </span>
            <h2 class="text-2xl sm:text-3xl font-black">Punya Pertanyaan atau Pengaduan Layanan?</h2>
            <p class="text-sm text-medical-100 leading-relaxed">
                Kirimkan pertanyaan seputar jadwal faskes, ketersediaan vaksin, maupun aspirasi perbaikan layanan kesehatan kepada tim pengelola SIP-Kes secara langsung.
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <a href="{{ route('public.contact') }}" class="px-6 py-3.5 rounded-xl bg-white text-medical-800 hover:bg-medical-50 font-extrabold text-sm text-center shadow-lg transition">
                <i class="fa-solid fa-envelope mr-1.5"></i> Kirim Pertanyaan / Aspirasi
            </a>
            <a href="tel:119" class="px-6 py-3.5 rounded-xl bg-red-600 hover:bg-red-500 text-white font-extrabold text-sm text-center shadow-lg transition">
                <i class="fa-solid fa-phone-volume mr-1.5"></i> Panggil 119
            </a>
        </div>
    </div>
</section>
@endsection

