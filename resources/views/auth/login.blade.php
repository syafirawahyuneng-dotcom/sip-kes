<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - SIP-Kes</title>
    
    @php $favicon = \App\Models\SystemSetting::getLogoUrl(); @endphp
    @if($favicon)
        <link rel="icon" type="image/png" href="{{ $favicon }}">
    @endif
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        medical: {
                            400: '#5cbde8', // Logo Cyan
                            500: '#32a8de',
                            600: '#1583c4',
                            700: '#0d57ae', // Primary Deep Blue Logo
                            800: '#0a4387',
                            900: '#073163',
                            950: '#041c38',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-slate-900 via-medical-950 to-slate-900 min-h-screen flex items-center justify-center p-4 antialiased">

    <div class="max-w-md w-full">
        <!-- Back to Home Link -->
        <div class="mb-6 text-center">
            <a href="{{ route('public.home') }}" class="inline-flex items-center gap-2 text-sm text-medical-400 hover:text-white transition font-medium">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Utama SIP-Kes
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-medical-800 to-medical-600 p-8 text-center text-white relative">
                @php $customLogo = \App\Models\SystemSetting::getLogoUrl(); @endphp
                @if($customLogo)
                    <div class="mb-4">
                        <img src="{{ $customLogo }}" alt="Logo {{ \App\Models\SystemSetting::get('site_name', 'SIP-Kes') }}" class="h-16 w-auto mx-auto object-contain bg-white/10 backdrop-blur-md p-2 rounded-2xl border border-white/20 shadow-inner">
                    </div>
                @else
                    <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mx-auto mb-4 text-3xl shadow-inner">
                        <i class="fa-solid fa-user-shield text-teal-200"></i>
                    </div>
                @endif
                <h2 class="text-2xl font-black tracking-tight">Login Administrator</h2>
                <p class="text-sm text-teal-100 mt-1">Sistem Informasi Pelayanan Kesehatan (SIP-Kes)</p>
            </div>

            <!-- Body Form -->
            <div class="p-8">
                @if(session('info'))
                    <div class="mb-5 p-3 rounded-xl bg-sky-50 border border-sky-200 text-sky-800 text-xs font-medium flex items-center gap-2">
                        <i class="fa-solid fa-info-circle text-sky-600"></i>
                        <span>{{ session('info') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-5 p-3 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-medium flex items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation text-red-500 flex-shrink-0"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form action="{{ route('login.attempt') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="email" name="email" id="email" value="{{ old('email', 'admin@sipkes.go.id') }}" required autofocus
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-medical-500 focus:border-medical-500 transition outline-none"
                                placeholder="nama@sipkes.go.id">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kata Sandi (Password)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" name="password" id="password" required
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-medical-500 focus:border-medical-500 transition outline-none"
                                placeholder="••••••••" value="admin123">
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-xs pt-1">
                        <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                            <input type="checkbox" name="remember" class="rounded border-slate-300 text-medical-600 focus:ring-medical-500" checked>
                            <span>Ingat sesi masuk saya</span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-medical-600 to-teal-600 hover:from-medical-700 hover:to-teal-700 text-white font-bold text-sm shadow-md shadow-medical-600/30 transition transform active:scale-[0.98]">
                            <i class="fa-solid fa-arrow-right-to-bracket mr-1.5"></i> Masuk ke Panel Administrator
                        </button>
                    </div>
                </form>

                <!-- Default Account Info Box -->
                <div class="mt-6 p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-600">
                    <p class="font-bold text-slate-800 flex items-center gap-1.5 mb-1 text-teal-700">
                        <i class="fa-solid fa-key"></i> Akun Pengujian Administrator:
                    </p>
                    <p class="font-mono text-[11px] text-slate-700">Email: <strong>admin@sipkes.go.id</strong></p>
                    <p class="font-mono text-[11px] text-slate-700">Password: <strong>admin123</strong></p>
                </div>
            </div>
        </div>
        
        <p class="text-center text-xs text-slate-400 mt-6">&copy; {{ date('Y') }} SIP-Kes. Hak Akses Terlindungi.</p>
    </div>

</body>
</html>

