<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PublicMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Tampilkan daftar pesan & aspirasi masuk
     */
    public function index(Request $request)
    {
        $query = PublicMessage::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%")
                  ->orWhere('subject', 'like', "%{$keyword}%")
                  ->orWhere('message', 'like', "%{$keyword}%");
            });
        }

        $messages = $query->latest()->paginate(10)->withQueryString();

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Tampilkan detail pesan
     */
    public function show($id)
    {
        $message = PublicMessage::findOrFail($id);

        // Jika status masih unread, tandai telah dibaca
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Balas pesan publik
     */
    public function reply(Request $request, $id)
    {
        $message = PublicMessage::findOrFail($id);

        $request->validate([
            'admin_reply' => 'required|string|max:2000',
        ], [
            'admin_reply.required' => 'Balasan tidak boleh kosong.',
        ]);

        $message->update([
            'admin_reply' => $request->admin_reply,
            'replied_at' => now(),
            'status' => 'replied',
        ]);

        return redirect()->route('admin.messages.show', $message->id)
            ->with('success', 'Balasan respon resmi berhasil disimpan.');
    }

    /**
     * Hapus pesan
     */
    public function destroy($id)
    {
        $message = PublicMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Pesan aspirasi berhasil dihapus.');
    }
}

