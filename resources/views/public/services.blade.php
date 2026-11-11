@extends('layouts.public')

@section('title', 'Direktori Fasilitas Kesehatan - SIP-Kes')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-medical-950 via-medical-900 to-brand-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <nav class="flex items-center gap-2 text-xs text-medical-300 mb-3 font-medium">
                <a href="{{ route('public.home') }}" class="hover:text-white transition">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[10px] text-medical-400"></i>
                <span class="text-white">Direktori Fasilitas Kesehatan</span>
            </nav>
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight">Direktori Fasilitas & Layanan Kesehatan</h1>
            <p class="text-sm sm:text-base text-slate-200 mt-2">
                Informasi resmi alamat, kontak darurat, dan jam operasional Rumah Sakit Umum Daerah (RSUD), Puskesmas, serta Pos Layanan Medis 119.
            </p>
        </div>
    </div>
</section>

<!-- Filter & Search Bar -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-xs flex flex-col md:flex-row gap-4 items-center justify-between">
        <!-- Type Filter Pills -->
        <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
            <a href="{{ route('public.services') }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ !request('tipe') ? 'bg-medical-700 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                Semua Faskes
            </a>
            @foreach($serviceTypes as $t)
                <a href="{{ route('public.services', ['tipe' => $t]) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('tipe') == $t ? 'bg-medical-700 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    {{ $t }}
                </a>
            @endforeach
        </div>

        <!-- Search Input -->
        <form action="{{ route('public.services') }}" method="GET" class="w-full md:w-80 relative flex items-center">
            @if(request('tipe'))
                <input type="hidden" name="tipe" value="{{ request('tipe') }}">
            @endif
            <span class="absolute left-3 text-slate-400 text-xs">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama faskes atau lokasi..."
                class="w-full pl-9 pr-20 py-2 text-xs rounded-xl border border-slate-200 focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none">
            <button type="submit" class="absolute right-1 px-3 py-1.5 rounded-lg bg-medical-700 hover:bg-medical-800 text-white text-xs font-bold transition">
                Cari
            </button>
        </form>
    </div>

    <!-- Active Filter Reset -->
    @if(request('q') || request('tipe'))
        <div class="flex items-center gap-2 mt-4 text-xs">
            <span class="text-slate-500 font-semibold">Filter:</span>
            @if(request('tipe'))
                <span class="px-2.5 py-0.5 rounded-full bg-teal-50 text-teal-800 font-medium border border-teal-200">
                    Tipe: {{ request('tipe') }}
                </span>
            @endif
            @if(request('q'))
                <span class="px-2.5 py-0.5 rounded-full bg-teal-50 text-teal-800 font-medium border border-teal-200">
                    Kata kunci: "{{ request('q') }}"
                </span>
            @endif
            <a href="{{ route('public.services') }}" class="text-red-600 hover:underline font-bold ml-1">Reset</a>
        </div>
    @endif

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        @forelse($services as $srv)
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-xs hover:shadow-lg transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <span class="px-3 py-1 rounded-full text-xs font-black {{ $srv->type === 'RSUD' ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : ($srv->type === 'Puskesmas' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-red-50 text-red-700 border border-red-200') }}">
                            {{ $srv->type }}
                        </span>
                        <span class="text-xs font-semibold text-slate-500 flex items-center gap-1.5 bg-slate-50 px-2.5 py-1 rounded-lg">
                            <i class="fa-regular fa-clock text-medical-600"></i> {{ $srv->operational_hours }}
                        </span>
                    </div>

                    <h2 class="text-lg font-black text-slate-900 mb-2">{{ $srv->name }}</h2>

                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-4">
                        {{ $srv->description }}
                    </p>

                    <div class="space-y-2 text-xs text-slate-600 bg-slate-50 p-3.5 rounded-2xl border border-slate-100 mb-4">
                        <p class="flex items-start gap-2">
                            <i class="fa-solid fa-location-dot mt-0.5 text-medical-600 flex-shrink-0"></i>
                            <span class="font-medium text-slate-700">{{ $srv->address }}</span>
                        </p>
                        @if($srv->phone)
                            <p class="flex items-center gap-2">
                                <i class="fa-solid fa-phone text-medical-600 flex-shrink-0"></i>
                                <span>Telepon: <strong class="text-slate-800">{{ $srv->phone }}</strong></span>
                            </p>
                        @endif
                        @if($srv->emergency_phone)
                            <p class="flex items-center gap-2 text-red-600 font-bold">
                                <i class="fa-solid fa-truck-medical text-red-600 flex-shrink-0"></i>
                                <span>IGD Darurat: {{ $srv->emergency_phone }}</span>
                            </p>
                        @endif
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($srv->name . ' ' . $srv->address) }}" target="_blank" class="text-xs font-semibold text-teal-700 hover:text-teal-900 inline-flex items-center gap-1.5 transition">
                        <i class="fa-solid fa-map-location-dot text-medical-600"></i> Buka Petunjuk Arah Maps
                    </a>
                    <div class="flex items-center gap-2">
                        @if($srv->phone)
                            <a href="tel:{{ $srv->phone }}" class="px-3.5 py-1.5 rounded-xl bg-teal-50 text-teal-800 hover:bg-teal-100 font-bold text-xs transition inline-flex items-center gap-1">
                                <i class="fa-solid fa-phone"></i> Hubungi
                            </a>
                        @endif
                        @if($srv->emergency_phone)
                            <a href="tel:{{ $srv->emergency_phone }}" class="px-3.5 py-1.5 rounded-xl bg-red-600 text-white hover:bg-red-700 font-bold text-xs transition inline-flex items-center gap-1">
                                <i class="fa-solid fa-truck-medical"></i> IGD Darurat
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-2 text-center py-16 bg-white rounded-3xl border border-dashed border-slate-300">
                <i class="fa-solid fa-hospital text-4xl text-slate-300 mb-3"></i>
                <h3 class="text-base font-bold text-slate-800">Fasilitas kesehatan tidak ditemukan</h3>
                <p class="text-xs text-slate-500 mt-1">Coba gunakan kata kunci pencarian yang berbeda.</p>
                <a href="{{ route('public.services') }}" class="inline-block mt-4 px-4 py-2 rounded-xl bg-medical-700 text-white text-xs font-bold hover:bg-medical-800 transition">
                    Tampilkan Semua Faskes
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pt-8">
        {{ $services->links() }}
    </div>
</section>
@endsection

