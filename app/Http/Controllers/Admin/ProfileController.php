<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil admin & pengaturan sistem
     */
    public function edit()
    {
        $user = Auth::user();
        $settings = SystemSetting::all();
        return view('admin.profile.edit', compact('user', 'settings'));
    }

    /**
     * Update akun admin (nama, email, password)
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => ['nullable', 'confirmed', Password::min(6)],
        ], [
            'name.required' => 'Nama administrator wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan pengguna lain.',
            'current_password.required_with' => 'Masukkan password saat ini untuk mengganti password baru.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
        ]);

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak cocok.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profil administrator berhasil diperbarui.');
    }

    /**
     * Update pengaturan sistem portal dinamis
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'site_logo_file' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'site_logo_url' => 'nullable|url|max:500',
        ]);

        // Upload Logo
        if ($request->hasFile('site_logo_file')) {
            $file = $request->file('site_logo_file');
            $fileName = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/logo'), $fileName);
            SystemSetting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => asset('uploads/logo/' . $fileName), 'label' => 'Logo Website', 'group' => 'general']
            );
        } elseif ($request->filled('site_logo_url')) {
            SystemSetting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => $request->site_logo_url, 'label' => 'Logo Website', 'group' => 'general']
            );
        }

        $fields = [
            'site_name',
            'site_tagline',
            'agency_name',
            'emergency_hotline',
            'office_phone',
            'office_whatsapp',
            'office_email',
            'office_address',
            'office_hours',
            'about_summary',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                SystemSetting::updateOrCreate(
                    ['key' => $field],
                    ['value' => $request->input($field)]
                );
            }
        }

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Konfigurasi identitas portal & logo SIP-Kes berhasil diperbarui secara dinamis!');
    }
}

