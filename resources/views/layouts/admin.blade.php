<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - SIP-Kes Administrator</title>
    
    @php $favicon = \App\Models\SystemSetting::getLogoUrl(); @endphp
    @if($favicon)
        <link rel="icon" type="image/png" href="{{ $favicon }}">
    @endif
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50:  '#f0f7ff',
                            100: '#e0effe',
                            200: '#bae0fd',
                            300: '#7cc8fa',
                            400: '#5cbde8', // Cyan Logo
                            500: '#2693d4',
                            600: '#1474b8',
                            700: '#0d57ae', // Primary Deep Blue Logo
                            800: '#0a4387',
                            900: '#073163',
                            950: '#041c38',
                        },
                        medical: {
                            50:  '#f0f8fd',
                            100: '#e1f2fc',
                            200: '#c2e6fa',
                            300: '#92d5f6',
                            400: '#5cbde8', // Cyan Logo
                            500: '#32a8de',
                            600: '#1583c4',
                            700: '#0d57ae', // Primary Deep Blue Logo
                            800: '#0a4387',
                            900: '#073163',
                            950: '#041c38',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen flex flex-col md:flex-row">

    <!-- Mobile Top Bar -->
    <div class="md:hidden bg-slate-900 text-white px-4 py-3 flex items-center justify-between sticky top-0 z-40 border-b border-slate-800">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
            @php $customLogo = \App\Models\SystemSetting::getLogoUrl(); @endphp
            @if($customLogo)
                <img src="{{ $customLogo }}" alt="Logo" class="h-8 w-auto max-h-8 object-contain">
            @else
                <div class="w-8 h-8 rounded-lg bg-medical-600 flex items-center justify-center text-white">
                    <i class="fa-solid fa-heart-pulse text-sm"></i>
                </div>
            @endif
            <span class="font-bold text-lg">SIP-Kes Admin</span>
        </a>
        <button id="sidebarToggleBtn" class="p-2 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800">
            <i class="fa-solid fa-bars text-lg"></i>
        </button>
    </div>

    <!-- Sidebar Overlay for mobile -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/60 z-40 hidden md:hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-slate-300 flex flex-col transition-transform transform -translate-x-full md:translate-x-0 md:static md:inset-auto md:z-auto md:min-h-screen">
        <!-- Brand Header -->
        <div class="p-5 border-b border-slate-800 flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                @php $customLogo = \App\Models\SystemSetting::getLogoUrl(); @endphp
                @if($customLogo)
                    <img src="{{ $customLogo }}" alt="Logo" class="h-12 w-auto max-h-12 max-w-[180px] object-contain">
                @else
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-medical-500 to-teal-400 flex items-center justify-center text-white shadow-md shadow-medical-500/20">
                            <i class="fa-solid fa-heart-pulse text-xl"></i>
                        </div>
                        <div>
                            <span class="text-xl font-black text-white tracking-tight">{{ \App\Models\SystemSetting::get('site_name', 'SIP-Kes') }}</span>
                            <span class="block text-xs font-semibold text-teal-400 tracking-wider uppercase">Portal Admin</span>
                        </div>
                    </div>
                @endif
            </a>
            <button id="closeSidebarBtn" class="md:hidden text-slate-400 hover:text-white">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto">
            <div class="px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">Menu Utama</div>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-medical-700 text-white shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <i class="fa-solid fa-gauge-high w-5 text-center {{ request()->routeIs('admin.dashboard') ? 'text-teal-200' : 'text-slate-400' }}"></i>
                <span>Dashboard</span>
            </a>

            <div class="pt-4 px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">Konten & Informasi</div>

            <a href="{{ route('admin.informations.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.informations.*') ? 'bg-medical-700 text-white shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-newspaper w-5 text-center {{ request()->routeIs('admin.informations.*') ? 'text-teal-200' : 'text-slate-400' }}"></i>
                    <span>Kelola Informasi</span>
                </div>
                <span class="text-xs px-2 py-0.5 rounded-md bg-slate-800 text-slate-300 font-mono">
                    {{ \App\Models\Information::count() }}
                </span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.categories.*') ? 'bg-medical-700 text-white shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-tags w-5 text-center {{ request()->routeIs('admin.categories.*') ? 'text-teal-200' : 'text-slate-400' }}"></i>
                    <span>Kategori Info</span>
                </div>
                <span class="text-xs px-2 py-0.5 rounded-md bg-slate-800 text-slate-300 font-mono">
                    {{ \App\Models\Category::count() }}
                </span>
            </a>

            <a href="{{ route('admin.services.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.services.*') ? 'bg-medical-700 text-white shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-hospital-user w-5 text-center {{ request()->routeIs('admin.services.*') ? 'text-teal-200' : 'text-slate-400' }}"></i>
                    <span>Fasilitas Kesehatan</span>
                </div>
                <span class="text-xs px-2 py-0.5 rounded-md bg-slate-800 text-slate-300 font-mono">
                    {{ \App\Models\HealthService::count() }}
                </span>
            </a>

            <div class="pt-4 px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">Interaksi & Sistem</div>

            @php
                $unreadMessagesCount = \App\Models\PublicMessage::where('status', 'unread')->count();
            @endphp
            <a href="{{ route('admin.messages.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.messages.*') ? 'bg-medical-700 text-white shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-inbox w-5 text-center {{ request()->routeIs('admin.messages.*') ? 'text-teal-200' : 'text-slate-400' }}"></i>
                    <span>Pesan Aspirasi</span>
                </div>
                @if($unreadMessagesCount > 0)
                    <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-amber-500 text-slate-950 animate-pulse">
                        {{ $unreadMessagesCount }} baru
                    </span>
                @else
                    <span class="text-xs px-2 py-0.5 rounded-md bg-slate-800 text-slate-400 font-mono">0</span>
                @endif
            </a>

            <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.profile.*') ? 'bg-medical-700 text-white shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <i class="fa-solid fa-sliders w-5 text-center {{ request()->routeIs('admin.profile.*') ? 'text-teal-200' : 'text-slate-400' }}"></i>
                <span>Profil & Konfigurasi</span>
            </a>
        </nav>

        <!-- Sidebar Footer / User Info -->
        <div class="p-4 border-t border-slate-800 bg-slate-950/60">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-medical-800 border border-teal-500/40 flex items-center justify-center text-teal-300 font-bold">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email ?? 'admin@sipkes.go.id' }}</p>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-800/80 flex items-center justify-between text-xs">
                <a href="{{ route('public.home') }}" target="_blank" class="text-teal-400 hover:text-teal-300 inline-flex items-center gap-1 font-medium transition">
                    <i class="fa-solid fa-globe"></i> Lihat Website
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-300 inline-flex items-center gap-1 font-medium transition" onclick="return confirm('Apakah Anda yakin ingin keluar dari panel admin?')">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-w-0 min-h-screen">
        <!-- Top Navbar -->
        <header class="bg-white border-b border-slate-200/80 sticky top-0 z-30 px-6 py-4 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-3">
                <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">@yield('page_title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('public.home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-semibold text-slate-600 hover:text-medical-700 hover:bg-slate-50 transition">
                    <i class="fa-solid fa-external-link-alt text-teal-600"></i> Website Publik
                </a>
                <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>
                <div class="flex items-center gap-2">
                    <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    <span class="text-xs font-semibold text-slate-500 hidden sm:inline">Database Aktif</span>
                </div>
            </div>
        </header>

        <!-- Flash Alert Messages -->
        <div class="px-6 pt-5">
            @if(session('success'))
                <div class="mb-4 flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl shadow-xs">
                    <i class="fa-solid fa-circle-check text-xl text-emerald-600 flex-shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 flex items-center gap-3 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl shadow-xs">
                    <i class="fa-solid fa-circle-exclamation text-xl text-red-600 flex-shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
            @endif
            @if(session('info'))
                <div class="mb-4 flex items-center gap-3 p-4 bg-sky-50 border border-sky-200 text-sky-800 rounded-xl shadow-xs">
                    <i class="fa-solid fa-circle-info text-xl text-sky-600 flex-shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('info') }}</p>
                </div>
            @endif
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl shadow-xs">
                    <div class="flex items-center gap-2 font-semibold text-sm mb-1">
                        <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
                        <span>Mohon periksa formulir berikut:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs text-red-700 ml-2 space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Main View Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>

        <!-- Admin Footer -->
        <footer class="px-6 py-4 border-t border-slate-200 bg-white text-xs text-slate-500 flex flex-col sm:flex-row justify-between items-center gap-2">
            <p>&copy; {{ date('Y') }} <strong>SIP-Kes Admin</strong>. Terintegrasi Database Relasional.</p>
            <p>Status: <span class="text-emerald-600 font-semibold">Online & Aman</span></p>
        </footer>
    </div>

    <!-- Sidebar Mobile Toggle Script -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
        const closeSidebarBtn = document.getElementById('closeSidebarBtn');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        }

        if (sidebarToggleBtn) sidebarToggleBtn.addEventListener('click', toggleSidebar);
        if (closeSidebarBtn) closeSidebarBtn.addEventListener('click', toggleSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);
    </script>
    @stack('scripts')
</body>
</html>

