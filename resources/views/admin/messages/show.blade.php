@extends('layouts.admin')

@section('title', 'Detail Pesan: ' . $message->subject)
@section('page_title', 'Detail Aspirasi & Pertanyaan Masyarakat')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <nav class="flex items-center gap-2 text-xs text-slate-500 font-medium">
            <a href="{{ route('admin.messages.index') }}" class="hover:text-medical-700 transition">Pesan Masuk</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-slate-800 font-bold">Detail Pesan #{{ $message->id }}</span>
        </nav>
        <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900 transition flex items-center gap-1.5">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Kotak Masuk
        </a>
    </div>

    <!-- Message Content Card -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8 space-y-6">
        <!-- Header Info -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
            <div class="flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center text-xl font-black">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div>
                    <h2 class="text-base font-extrabold text-slate-900">{{ $message->name }}</h2>
                    <div class="flex flex-wrap items-center gap-2 text-xs text-slate-500 mt-0.5">
                        <a href="mailto:{{ $message->email }}" class="text-teal-700 hover:underline font-medium">
                            {{ $message->email }}
                        </a>
                        @if($message->phone)
                            <span>•</span>
                            <a href="tel:{{ $message->phone }}" class="text-slate-600 hover:underline font-mono">
                                {{ $message->phone }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="text-right">
                <span class="text-xs text-slate-400 block font-medium">Diterima pada:</span>
                <span class="text-xs font-bold text-slate-700">{{ $message->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
            </div>
        </div>

        <!-- Subject & Body -->
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Topik Subjek:</span>
                <h3 class="text-lg font-black text-slate-900">{{ $message->subject }}</h3>
            </div>

            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 text-sm text-slate-800 leading-relaxed whitespace-pre-line">
                {{ $message->message }}
            </div>
        </div>

        <!-- Previous Reply (If Exists) -->
        @if($message->admin_reply)
            <div class="p-5 rounded-2xl bg-emerald-50 border border-emerald-200 space-y-2">
                <div class="flex items-center justify-between text-xs font-bold text-emerald-800">
                    <span class="flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check text-emerald-600"></i> Tanggapan Resmi Administrator:
                    </span>
                    <span class="text-[11px] font-normal text-emerald-700">
                        {{ $message->replied_at ? $message->replied_at->translatedFormat('d M Y, H:i') : '' }}
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-emerald-950 leading-relaxed whitespace-pre-line">
                    {{ $message->admin_reply }}
                </p>
            </div>
        @endif

        <!-- Reply Form -->
        <div class="pt-6 border-t border-slate-100">
            <h4 class="text-sm font-black text-slate-900 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-reply text-medical-700"></i> 
                {{ $message->admin_reply ? 'Perbarui Respon / Tanggapan Resmi' : 'Kirim Tanggapan / Respon Resmi' }}
            </h4>

            <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <textarea name="admin_reply" rows="4" required
                        class="w-full px-4 py-3 rounded-2xl border border-slate-300 text-sm focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none"
                        placeholder="Tuliskan respon resmi dari tim administrator SIP-Kes...">{{ old('admin_reply', $message->admin_reply) }}</textarea>
                </div>

                <div class="flex items-center justify-between">
                    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs font-bold text-red-600 hover:text-red-700 transition">
                            <i class="fa-solid fa-trash-can mr-1"></i> Hapus Pesan
                        </button>
                    </form>

                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-medical-700 hover:bg-medical-800 text-white font-extrabold text-xs shadow-md transition inline-flex items-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i> Simpan Respon Resmi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

