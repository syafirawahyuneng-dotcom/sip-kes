@extends('layouts.admin')

@section('title', 'Kotak Masuk Aspirasi Publik')
@section('page_title', 'Pesan & Aspirasi Masyarakat')

@section('content')
<div class="space-y-6">
    <!-- Header Actions & Filters -->
    <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-xs flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Status Filter Pills -->
        <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
            <a href="{{ route('admin.messages.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ !request('status') ? 'bg-medical-700 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                Semua Pesan ({{ \App\Models\PublicMessage::count() }})
            </a>
            <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('status') == 'unread' ? 'bg-amber-500 text-slate-950 font-black shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                Belum Dibaca ({{ \App\Models\PublicMessage::where('status', 'unread')->count() }})
            </a>
            <a href="{{ route('admin.messages.index', ['status' => 'replied']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('status') == 'replied' ? 'bg-emerald-600 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                Sudah Dibalas ({{ \App\Models\PublicMessage::where('status', 'replied')->count() }})
            </a>
        </div>

        <!-- Search Bar -->
        <form action="{{ route('admin.messages.index') }}" method="GET" class="w-full md:w-72 relative flex items-center">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <span class="absolute left-3 text-slate-400 text-xs">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, email, isi..."
                class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-slate-200 focus:border-medical-500 focus:ring-1 focus:ring-medical-500 outline-none">
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-200/80">
                    <tr>
                        <th class="py-3.5 px-4">Pengirim</th>
                        <th class="py-3.5 px-4">Subjek & Isi Pesan</th>
                        <th class="py-3.5 px-3">Status</th>
                        <th class="py-3.5 px-4">Tanggal Masuk</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($messages as $msg)
                        <tr class="hover:bg-slate-50/70 transition {{ $msg->status === 'unread' ? 'bg-amber-50/30 font-semibold' : '' }}">
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="font-bold text-slate-900 text-sm flex items-center gap-2">
                                    @if($msg->status === 'unread')
                                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                                    @endif
                                    {{ $msg->name }}
                                </div>
                                <p class="text-[11px] text-slate-500">{{ $msg->email }}</p>
                                @if($msg->phone)
                                    <p class="text-[11px] text-slate-400 font-mono">{{ $msg->phone }}</p>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 max-w-md">
                                <p class="font-bold text-slate-900 text-xs mb-0.5 line-clamp-1">{{ $msg->subject }}</p>
                                <p class="text-slate-500 text-xs line-clamp-2 leading-relaxed">{{ $msg->message }}</p>
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                @if($msg->status === 'unread')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-amber-100 text-amber-900 uppercase">
                                        Baru
                                    </span>
                                @elseif($msg->status === 'replied')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        Dibalas
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">
                                        Dibaca
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-slate-500 whitespace-nowrap">
                                {{ $msg->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1">
                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="px-3 py-1.5 rounded-xl bg-teal-50 text-teal-800 hover:bg-teal-100 font-bold text-xs transition inline-flex items-center gap-1">
                                        <i class="fa-solid fa-envelope-open"></i> Buka Pesan
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-xl text-red-500 hover:text-red-700 hover:bg-red-50 transition" title="Hapus Pesan">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                <i class="fa-solid fa-inbox text-3xl mb-2 text-slate-300"></i>
                                <p class="text-sm font-semibold">Tidak ada pesan masuk pada kategori ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection

