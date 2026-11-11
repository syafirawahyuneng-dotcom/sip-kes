@extends('layouts.public')

@section('title', $information->title . ' - SIP-Kes')

@section('content')
<!-- Detail Header & Breadcrumb -->
<section class="bg-gradient-to-r from-medical-950 via-medical-900 to-brand-800 text-white py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex flex-wrap items-center gap-2 text-xs text-medical-300 mb-4 font-medium">
            <a href="{{ route('public.home') }}" class="hover:text-white transition">Beranda</a>
            <i class="fa-solid fa-chevron-right text-[10px] text-medical-400"></i>
            <a href="{{ route('public.informations') }}" class="hover:text-white transition">Informasi & Berita</a>
            <i class="fa-solid fa-chevron-right text-[10px] text-medical-400"></i>
            <span class="text-medical-300">{{ $information->category->name ?? 'Kategori' }}</span>
        </nav>

        <div class="space-y-4">
            <!-- Category Badge -->
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-white/10 backdrop-blur-md border border-white/20 text-medical-300">
                <i class="{{ $information->category->icon ?? 'fa-solid fa-notes-medical' }}"></i>
                {{ $information->category->name ?? 'Informasi Kesehatan' }}
            </span>

            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight leading-snug">
                {{ $information->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-slate-300 pt-1">
                <span class="flex items-center gap-1.5">
                    <i class="fa-solid fa-user-doctor text-teal-400"></i>
                    {{ $information->author->name ?? 'Tim Redaksi SIP-Kes' }}
                </span>
                <span>•</span>
                <span class="flex items-center gap-1.5">
                    <i class="fa-regular fa-calendar text-teal-400"></i>
                    {{ $information->published_at ? $information->published_at->translatedFormat('d F Y') : $information->created_at->translatedFormat('d F Y') }}
                </span>
                <span>•</span>
                <span class="flex items-center gap-1.5">
                    <i class="fa-regular fa-eye text-teal-400"></i>
                    {{ number_format($information->views) }} kali dibaca
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Detail Content Container -->
<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <article class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden p-6 sm:p-10">
        <!-- Banner Image -->
        @if($information->image)
            <div class="rounded-2xl overflow-hidden mb-8 shadow-md">
                <img src="{{ $information->image }}" alt="{{ $information->title }}" class="w-full h-auto max-h-[480px] object-cover">
            </div>
        @endif

        <!-- Summary Lead Box -->
        @if($information->summary)
            <div class="p-5 rounded-2xl bg-medical-50/70 border-l-4 border-medical-600 text-slate-700 font-medium text-base leading-relaxed mb-8">
                {{ $information->summary }}
            </div>
        @endif

        <!-- Main Body Content -->
        <div class="prose prose-slate max-w-none text-slate-800 leading-relaxed space-y-4 text-base">
            {!! $information->content !!}
        </div>

        <!-- Social Share & Return Actions -->
        <div class="mt-12 pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Bagikan:</span>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($information->title . ' ' . url()->current()) }}" target="_blank" class="w-9 h-9 rounded-xl bg-emerald-500 text-white flex items-center justify-center hover:bg-emerald-600 transition shadow-sm" title="Bagikan ke WhatsApp">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition shadow-sm" title="Bagikan ke Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($information->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="w-9 h-9 rounded-xl bg-slate-900 text-white flex items-center justify-center hover:bg-slate-800 transition shadow-sm" title="Bagikan ke X">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
                <button type="button" onclick="window.print()" class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center hover:bg-slate-200 transition shadow-sm" title="Cetak / Unduh PDF">
                    <i class="fa-solid fa-print"></i>
                </button>
                <button type="button" onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan informasi berhasil disalin ke clipboard!');" class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center hover:bg-slate-200 transition shadow-sm" title="Salin Tautan">
                    <i class="fa-solid fa-link"></i>
                </button>
            </div>

            <a href="{{ route('public.informations') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 text-slate-700 hover:text-medical-700 hover:bg-slate-50 font-bold text-xs transition">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Informasi
            </a>
        </div>
    </article>

    <!-- Related Informations Section -->
    @if($relatedInformations->count() > 0)
        <div class="mt-12">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-extrabold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-newspaper text-medical-600"></i> Informasi Terkait Lainnya
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($relatedInformations as $rel)
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs hover:shadow-md transition flex gap-4 items-center">
                        @if($rel->image)
                            <img src="{{ $rel->image }}" alt="{{ $rel->title }}" class="w-20 h-20 rounded-xl object-cover flex-shrink-0 bg-slate-100">
                        @endif
                        <div class="min-w-0">
                            <span class="text-[11px] font-bold text-medical-700 block mb-1">
                                {{ $rel->category->name ?? 'Info' }}
                            </span>
                            <h4 class="text-sm font-bold text-slate-900 hover:text-medical-700 transition line-clamp-2">
                                <a href="{{ route('public.information.detail', $rel->slug) }}">
                                    {{ $rel->title }}
                                </a>
                            </h4>
                            <span class="text-[11px] text-slate-400 mt-1 block">
                                {{ $rel->published_at ? $rel->published_at->translatedFormat('d M Y') : $rel->created_at->translatedFormat('d M Y') }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection

