@extends('layouts.admin')

@section('title', 'Tambah Fasilitas Kesehatan Baru')
@section('page_title', 'Tambah Fasilitas Kesehatan Baru')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <nav class="flex items-center gap-2 text-xs text-slate-500 font-medium">
            <a href="{{ route('admin.services.index') }}" class="hover:text-medical-700 transition">Fasilitas Kesehatan</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-slate-800 font-bold">Tambah Baru</span>
        </nav>
        <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900 transition flex items-center gap-1.5">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8">
        <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Nama Fasilitas Kesehatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                        placeholder="Contoh: Puskesmas Sehat Terpadu">
                </div>

                <div>
                    <label for="type" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Tipe / Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="type" id="type" required
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none bg-white">
                        <option value="RSUD" {{ old('type') == 'RSUD' ? 'selected' : '' }}>RSUD</option>
                        <option value="Puskesmas" {{ old('type') == 'Puskesmas' ? 'selected' : '' }}>Puskesmas</option>
                        <option value="Klinik Pratama" {{ old('type') == 'Klinik Pratama' ? 'selected' : '' }}>Klinik Pratama</option>
                        <option value="PSC 119" {{ old('type') == 'PSC 119' ? 'selected' : '' }}>PSC 119 (Darurat)</option>
                        <option value="Laboratorium Kesehatan" {{ old('type') == 'Laboratorium Kesehatan' ? 'selected' : '' }}>Labkesda</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Alamat Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" name="address" id="address" value="{{ old('address') }}" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                    placeholder="Contoh: Jl. Diponegoro No. 10, Kelurahan Sehat, Kecamatan Pusat">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Telepon Reguler
                    </label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                        placeholder="(021) 555-xxxx">
                </div>

                <div>
                    <label for="emergency_phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Hotline IGD / Darurat
                    </label>
                    <input type="text" name="emergency_phone" id="emergency_phone" value="{{ old('emergency_phone') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                        placeholder="119 / 0812-xxxx">
                </div>

                <div>
                    <label for="operational_hours" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Jam Operasional <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="operational_hours" id="operational_hours" value="{{ old('operational_hours', '24 Jam') }}" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                        placeholder="24 Jam / 08:00 - 15:00 WIB">
                </div>
            </div>

            <div>
                <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                    Deskripsi Pelayanan & Fasilitas
                </label>
                <textarea name="description" id="description" rows="3"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                    placeholder="Jelaskan fasilitas rawat jalan, rawat inap, poli spesialis, apotek, atau keunggulan faskes...">{{ old('description') }}</textarea>
            </div>

            <div class="pt-1">
                <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                    <input type="checkbox" name="is_active" value="1" checked
                        class="w-4 h-4 rounded border-slate-300 text-medical-600 focus:ring-medical-500">
                    <span>Fasilitas Aktif & Ditampilkan di Direktori Publik</span>
                </label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.services.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-medical-700 hover:bg-medical-800 text-white font-extrabold text-xs shadow-md transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Faskes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

