@extends('layouts.admin')

@section('title', 'Profil & Pengaturan Portal SIP-Kes')
@section('page_title', 'Profil & Konfigurasi Sistem Informasi')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Kolom 1: Profil & Akun Admin (5 cols) -->
    <div class="lg:col-span-5 space-y-6">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8">
            <div class="flex items-center gap-4 pb-6 border-b border-slate-100 mb-6">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-medical-600 to-teal-500 text-white flex items-center justify-center text-2xl font-black shadow-md shadow-medical-500/20">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-900">Akun Administrator</h3>
                    <p class="text-xs text-slate-500">Kelola kredensial dan kata sandi masuk</p>
                </div>
            </div>

            <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none">
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Alamat Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none">
                </div>

                <div class="pt-3 border-t border-slate-100">
                    <p class="text-xs font-bold text-slate-800 mb-2">Ganti Kata Sandi (Opsional)</p>
                    <p class="text-[11px] text-slate-500 mb-3">Kosongkan jika tidak ingin mengubah kata sandi.</p>

                    <div class="space-y-3">
                        <div>
                            <label for="current_password" class="block text-xs font-semibold text-slate-600 mb-1">
                                Kata Sandi Saat Ini
                            </label>
                            <input type="password" name="current_password" id="current_password"
                                class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs focus:border-medical-500 outline-none"
                                placeholder="••••••••">
                        </div>

                        <div>
                            <label for="new_password" class="block text-xs font-semibold text-slate-600 mb-1">
                                Kata Sandi Baru
                            </label>
                            <input type="password" name="new_password" id="new_password"
                                class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs focus:border-medical-500 outline-none"
                                placeholder="Minimal 6 karakter">
                        </div>

                        <div>
                            <label for="new_password_confirmation" class="block text-xs font-semibold text-slate-600 mb-1">
                                Konfirmasi Kata Sandi Baru
                            </label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs focus:border-medical-500 outline-none"
                                placeholder="Ulangi kata sandi baru">
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-medical-700 hover:bg-medical-800 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Profil Admin
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Kolom 2: Pengaturan Portal Dinamis (7 cols) -->
    <div class="lg:col-span-7">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8">
            <div class="flex items-center gap-4 pb-6 border-b border-slate-100 mb-6">
                <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center text-2xl font-black">
                    <i class="fa-solid fa-gears"></i>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-900">Identitas & Konfigurasi Portal Publik</h3>
                    <p class="text-xs text-slate-500">Perbarui kontak dan identitas website tanpa mengubah kode program</p>
                </div>
            </div>

            @php
                $settingMap = $settings->pluck('value', 'key');
            @endphp

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Logo Portal -->
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Logo Website (Header, Footer, & Admin)
                    </label>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                        @php $currentLogo = \App\Models\SystemSetting::getLogoUrl(); @endphp
                        <div class="w-16 h-16 rounded-2xl bg-white border border-slate-200 flex items-center justify-center p-2 overflow-hidden shadow-xs flex-shrink-0">
                            @if($currentLogo)
                                <img src="{{ $currentLogo }}" alt="Logo SIP-Kes" class="max-w-full max-h-full object-contain">
                            @else
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-medical-600 to-teal-500 flex items-center justify-center text-white">
                                    <i class="fa-solid fa-heart-pulse text-2xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 space-y-2">
                            <span class="text-[11px] font-semibold text-slate-600 block">Unggah Logo Baru (PNG, JPG, SVG, WEBP):</span>
                            <input type="file" name="site_logo_file" accept="image/*"
                                class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-700 file:text-white hover:file:bg-medical-800 cursor-pointer">
                            <span class="text-[11px] font-semibold text-slate-600 block">Atau gunakan URL Gambar:</span>
                            <input type="url" name="site_logo_url" value="{{ old('site_logo_url', $settingMap['site_logo'] ?? '') }}"
                                placeholder="https://..."
                                class="w-full px-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:border-medical-500 outline-none">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="site_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Nama Website
                        </label>
                        <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $settingMap['site_name'] ?? 'SIP-Kes') }}" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 outline-none">
                    </div>

                    <div>
                        <label for="emergency_hotline" class="block text-xs font-bold text-red-600 uppercase tracking-wider mb-1">
                            Hotline Darurat 119
                        </label>
                        <input type="text" name="emergency_hotline" id="emergency_hotline" value="{{ old('emergency_hotline', $settingMap['emergency_hotline'] ?? '119 / (021) 555-0119') }}" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-red-300 text-sm font-bold text-red-600 focus:border-red-500 outline-none">
                    </div>
                </div>

                <div>
                    <label for="site_tagline" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Slogan Website
                    </label>
                    <input type="text" name="site_tagline" id="site_tagline" value="{{ old('site_tagline', $settingMap['site_tagline'] ?? '') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 outline-none">
                </div>

                <div>
                    <label for="agency_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Instansi Pembina / Dinas
                    </label>
                    <input type="text" name="agency_name" id="agency_name" value="{{ old('agency_name', $settingMap['agency_name'] ?? '') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="office_phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Telepon Kantor
                        </label>
                        <input type="text" name="office_phone" id="office_phone" value="{{ old('office_phone', $settingMap['office_phone'] ?? '') }}"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 outline-none">
                    </div>

                    <div>
                        <label for="office_whatsapp" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            WhatsApp Pelayanan
                        </label>
                        <input type="text" name="office_whatsapp" id="office_whatsapp" value="{{ old('office_whatsapp', $settingMap['office_whatsapp'] ?? '') }}"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="office_email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Email Resmi
                        </label>
                        <input type="email" name="office_email" id="office_email" value="{{ old('office_email', $settingMap['office_email'] ?? '') }}"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 outline-none">
                    </div>

                    <div>
                        <label for="office_hours" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Jam Pelayanan
                        </label>
                        <input type="text" name="office_hours" id="office_hours" value="{{ old('office_hours', $settingMap['office_hours'] ?? '') }}"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 outline-none">
                    </div>
                </div>

                <div>
                    <label for="office_address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Alamat Lengkap Kantor
                    </label>
                    <input type="text" name="office_address" id="office_address" value="{{ old('office_address', $settingMap['office_address'] ?? '') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 outline-none">
                </div>

                <div>
                    <label for="about_summary" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Profil Singkat Tentang SIP-Kes
                    </label>
                    <textarea name="about_summary" id="about_summary" rows="3"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 outline-none">{{ old('about_summary', $settingMap['about_summary'] ?? '') }}</textarea>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-medical-700 hover:bg-medical-800 text-white font-extrabold text-xs shadow-md transition inline-flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Konfigurasi Portal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

