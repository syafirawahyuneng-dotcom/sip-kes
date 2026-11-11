@extends('layouts.public')

@section('title', 'Kontak Layanan & Aspirasi Informasi - SIP-Kes')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-medical-950 via-medical-900 to-brand-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <nav class="flex items-center gap-2 text-xs text-medical-300 mb-3 font-medium">
                <a href="{{ route('public.home') }}" class="hover:text-white transition">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[10px] text-medical-400"></i>
                <span class="text-white">Kontak & Aspirasi Informasi</span>
            </nav>
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight">Kontak Layanan & Aspirasi Informasi</h1>
            <p class="text-sm sm:text-base text-slate-200 mt-2">
                Sampaikan pertanyaan seputar alur rujukan faskes, ketersediaan vaksin, maupun masukan perbaikan sistem informasi kesehatan.
            </p>
        </div>
    </div>
</section>

<!-- Content Container -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Contact Information Cards (5 cols) -->
        <div class="lg:col-span-5 space-y-6">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-medical-600 bg-medical-50 px-3 py-1 rounded-full">Pusat Bantuan</span>
                <h2 class="text-2xl font-black text-slate-900 mt-2">Informasi Kontak Resmi</h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1">Kami siap melayani kebutuhan informasi kesehatan Anda pada jam operasional kerja.</p>
            </div>

            <!-- Emergency Card -->
            <div class="p-6 rounded-3xl bg-gradient-to-br from-red-600 to-rose-700 text-white shadow-lg space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-xs uppercase font-extrabold tracking-wider bg-white/20 px-2.5 py-0.5 rounded-full">Call Center Darurat</span>
                    <i class="fa-solid fa-truck-medical text-2xl text-rose-200"></i>
                </div>
                <h3 class="text-3xl font-black font-mono">119</h3>
                <p class="text-xs text-rose-100">Siaga 24 jam untuk kegawatdaruratan medis, kecelakaan, dan permintaan ambulans.</p>
            </div>

            <!-- Contact List Items -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-xs space-y-5">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-medical-50 text-medical-700 flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Alamat Kantor Dinas</h4>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 mt-0.5 leading-relaxed">
                            {{ $settings['office_address'] ?? 'Jl. Kesehatan Nusantara No. 45, Kompleks Pusat Layanan Publik' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-medical-50 text-medical-700 flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Email Pelayanan Informasi</h4>
                        <a href="mailto:{{ $settings['office_email'] ?? 'layanan@sipkes.go.id' }}" class="text-xs sm:text-sm font-semibold text-teal-700 hover:underline mt-0.5 block">
                            {{ $settings['office_email'] ?? 'layanan@sipkes.go.id' }}
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-medical-50 text-medical-700 flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fa-brands fa-whatsapp text-xl text-emerald-600"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">WhatsApp Hotline Pelayanan</h4>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 mt-0.5">
                            {{ $settings['office_whatsapp'] ?? '0812-3456-7890' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-medical-50 text-medical-700 flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jam Pelayanan Kantor</h4>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 mt-0.5">
                            {{ $settings['office_hours'] ?? 'Senin - Jumat: 08:00 - 16:00 WIB' }}
                        </p>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs text-slate-500 font-medium">Navigasi ke Kantor Dinas:</span>
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($settings['office_address'] ?? 'Dinas Kesehatan') }}" target="_blank" class="px-3.5 py-1.5 rounded-xl bg-teal-50 text-teal-800 hover:bg-teal-100 font-bold text-xs transition inline-flex items-center gap-1.5">
                        <i class="fa-solid fa-map-location-dot text-medical-600"></i> Buka Google Maps
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Card (7 cols) -->
        <div class="lg:col-span-7">
            <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200 shadow-md">
                <div class="mb-6">
                    <span class="text-xs font-bold uppercase tracking-wider text-medical-600 bg-medical-50 px-3 py-1 rounded-full">Formulir Publik</span>
                    <h2 class="text-2xl font-black text-slate-900 mt-2">Kirim Pertanyaan / Aspirasi</h2>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1">
                        Pesan Anda langsung tersimpan ke sistem database pengelola SIP-Kes untuk segera ditindaklanjuti.
                    </p>
                </div>

                <form action="{{ route('public.contact.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                                placeholder="Contoh: Budi Santoso">
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Alamat Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                                placeholder="budi@example.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Nomor Telepon / WhatsApp
                            </label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                                placeholder="0812xxxxxxxx">
                        </div>

                        <div>
                            <label for="subject" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Topik Pertanyaan / Subjek <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                                placeholder="Contoh: Informasi Jadwal Poli Gigi">
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Isi Pesan / Pertanyaan Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message" id="message" rows="5" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                            placeholder="Tuliskan pertanyaan, keluhan, atau informasi yang Anda butuhkan secara jelas...">{{ old('message') }}</textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto px-8 py-3 rounded-xl bg-medical-700 hover:bg-medical-800 text-white font-extrabold text-sm shadow-md transition inline-flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i> Kirim Pesan Informasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

