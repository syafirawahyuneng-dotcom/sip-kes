<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Informasi SIP-Kes') - Sistem Informasi Pelayanan Kesehatan Politeknik Negeri Jember</title>
    
    @php $favicon = \App\Models\SystemSetting::getLogoUrl(); @endphp
    @if($favicon)
        <link rel="icon" type="image/png" href="{{ $favicon }}">
    @endif
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 Icons -->
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
                            500: '#258ac7',
                            600: '#146dae',
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
                            700: '#0d57ae', // Primary Blue Logo
                            800: '#0a4387', // Button Hover
                            900: '#073163', // Dark Banner
                            950: '#041c38',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    },
                    animation: {
                        'spin-slow': 'spin 25s linear infinite',
                        'float': 'floating 4s ease-in-out infinite',
                        'float-delayed': 'floating 4s ease-in-out 2s infinite',
                    },
                    keyframes: {
                        floating: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-8px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @media print {
            header, footer, nav, button, .no-print { display: none !important; }
            body { background: #fff !important; color: #000 !important; }
        }
    </style>
</head>
<body class="bg-white text-slate-800 flex flex-col min-h-screen antialiased">

    <!-- Top Announcement / Emergency Bar -->
    <div class="bg-gradient-to-r from-medical-950 via-medical-900 to-brand-800 text-white text-xs sm:text-sm py-2.5 px-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-2 font-medium">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-500 text-white animate-pulse">
                    <i class="fa-solid fa-phone-volume mr-1"></i> HOTLINE 119
                </span>
                <span>Panggilan Darurat Medis & Ambulans 24 Jam: <strong>{{ \App\Models\SystemSetting::get('emergency_hotline', '119 / (021) 555-0119') }}</strong></span>
            </div>
            <div class="flex items-center gap-4 text-slate-300">
                <span class="hidden md:inline"><i class="fa-regular fa-clock mr-1"></i> {{ \App\Models\SystemSetting::get('office_hours', 'Senin - Jumat 08.00 - 16.00 WIB') }}</span>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-medical-400 hover:text-white font-medium inline-flex items-center gap-1 transition">
                        <i class="fa-solid fa-gauge-high"></i> Panel Admin
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-slate-300 hover:text-white inline-flex items-center gap-1 transition">
                        <i class="fa-solid fa-lock"></i> Login Petugas
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-sm transition-all duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo & Brand Name -->
                <a href="{{ route('public.home') }}" class="flex items-center group py-1.5">
                    @php $customLogo = \App\Models\SystemSetting::getLogoUrl(); @endphp
                    @if($customLogo)
                        <img src="{{ $customLogo }}" alt="{{ \App\Models\SystemSetting::get('site_name', 'SIP-Kes') }}" class="h-14 sm:h-16 w-auto max-h-16 max-w-[240px] sm:max-w-[320px] object-contain group-hover:scale-105 transition-transform">
                    @else
                        <div class="flex items-center gap-3.5">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-medical-600 to-teal-500 flex items-center justify-center text-white shadow-md shadow-medical-500/20 group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-heart-pulse text-2xl"></i>
                            </div>
                            <div>
                                <span class="text-2xl font-black tracking-tight text-slate-900 group-hover:text-medical-700 transition">{{ \App\Models\SystemSetting::get('site_name', 'SIP-Kes') }}</span>
                                <p class="text-xs text-slate-500 font-medium -mt-1 hidden sm:block">Sistem Informasi Pelayanan Kesehatan</p>
                            </div>
                        </div>
                    @endif
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-1 lg:gap-2">
                    <a href="{{ route('public.home') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('public.home') ? 'bg-medical-50 text-medical-700' : 'text-slate-600 hover:text-medical-700 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-house mr-1.5 text-xs"></i> Beranda
                    </a>
                    <a href="{{ route('public.informations') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('public.informations*') || request()->routeIs('public.information.detail') ? 'bg-medical-50 text-medical-700' : 'text-slate-600 hover:text-medical-700 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-newspaper mr-1.5 text-xs"></i> Informasi & Berita
                    </a>
                    <a href="{{ route('public.services') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('public.services') ? 'bg-medical-50 text-medical-700' : 'text-slate-600 hover:text-medical-700 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-hospital-user mr-1.5 text-xs"></i> Fasilitas Kesehatan
                    </a>
                    <a href="{{ route('public.contact') }}" class="px-3.5 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('public.contact') ? 'bg-medical-50 text-medical-700' : 'text-slate-600 hover:text-medical-700 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-envelope-open-text mr-1.5 text-xs"></i> Kontak & Aspirasi
                    </a>
                </nav>

                <!-- Action Button -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="tel:119" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-sm shadow-sm transition hover:shadow-md">
                        <i class="fa-solid fa-truck-medical"></i> Call 119
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <button id="mobileMenuBtn" type="button" class="md:hidden p-2.5 rounded-lg text-slate-600 hover:text-medical-700 hover:bg-slate-100 focus:outline-none" aria-label="Menu">
                    <i class="fa-solid fa-bars text-xl" id="menuIcon"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div id="mobileMenu" class="hidden md:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-2 shadow-lg">
            <a href="{{ route('public.home') }}" class="block px-3 py-2.5 rounded-lg text-base font-semibold {{ request()->routeIs('public.home') ? 'bg-medical-50 text-medical-700' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-house w-6 text-medical-600"></i> Beranda
            </a>
            <a href="{{ route('public.informations') }}" class="block px-3 py-2.5 rounded-lg text-base font-semibold {{ request()->routeIs('public.informations*') ? 'bg-medical-50 text-medical-700' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-newspaper w-6 text-medical-600"></i> Informasi & Berita
            </a>
            <a href="{{ route('public.services') }}" class="block px-3 py-2.5 rounded-lg text-base font-semibold {{ request()->routeIs('public.services') ? 'bg-medical-50 text-medical-700' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-hospital-user w-6 text-medical-600"></i> Fasilitas Kesehatan
            </a>
            <a href="{{ route('public.contact') }}" class="block px-3 py-2.5 rounded-lg text-base font-semibold {{ request()->routeIs('public.contact') ? 'bg-medical-50 text-medical-700' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-envelope-open-text w-6 text-medical-600"></i> Kontak & Aspirasi
            </a>
            <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
                <a href="tel:119" class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-red-600 text-white font-bold text-sm">
                    <i class="fa-solid fa-truck-medical"></i> Panggilan Darurat 119
                </a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 w-full py-2 rounded-xl bg-medical-700 text-white font-semibold text-sm">
                        <i class="fa-solid fa-gauge-high"></i> Masuk ke Panel Admin
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full py-2 rounded-xl border border-slate-300 text-slate-700 font-semibold text-sm hover:bg-slate-50">
                        <i class="fa-solid fa-lock"></i> Login Administrator
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Flash Messages Container -->
    @if(session('success') || session('error') || session('info') || $errors->any())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
            @if(session('success'))
                <div class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl shadow-sm">
                    <i class="fa-solid fa-circle-check text-xl text-emerald-600 flex-shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="flex items-center gap-3 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl shadow-sm">
                    <i class="fa-solid fa-circle-exclamation text-xl text-red-600 flex-shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
            @endif
            @if(session('info'))
                <div class="flex items-center gap-3 p-4 bg-sky-50 border border-sky-200 text-sky-800 rounded-xl shadow-sm">
                    <i class="fa-solid fa-circle-info text-xl text-sky-600 flex-shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('info') }}</p>
                </div>
            @endif
            @if($errors->any())
                <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl shadow-sm">
                    <div class="flex items-center gap-2 font-semibold text-sm mb-1">
                        <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
                        <span>Terdapat kesalahan pada input Anda:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs text-red-700 space-y-0.5 ml-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif

    <!-- Main Content Slot -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-b from-medical-900 to-medical-950 text-slate-300 mt-16 pt-16 pb-12 border-t border-medical-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Col 1: Identity -->
                <div class="space-y-4">
                    <div>
                        @php $customLogo = \App\Models\SystemSetting::getLogoUrl(); @endphp
                        @if($customLogo)
                            <img src="{{ $customLogo }}" alt="{{ \App\Models\SystemSetting::get('site_name', 'SIP-Kes') }}" class="h-12 sm:h-14 w-auto max-h-14 max-w-[220px] object-contain">
                        @else
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-medical-500 to-teal-400 flex items-center justify-center text-white shadow-md">
                                    <i class="fa-solid fa-heart-pulse text-xl"></i>
                                </div>
                                <span class="text-2xl font-black text-white">{{ \App\Models\SystemSetting::get('site_name', 'SIP-Kes') }}</span>
                            </div>
                        @endif
                    </div>
                    <p class="text-xs text-medical-400 font-semibold tracking-wide uppercase">{{ \App\Models\SystemSetting::get('agency_name', 'Dinas Kesehatan & Pelayanan Terpadu') }}</p>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        {{ \App\Models\SystemSetting::get('about_summary', 'Portal resmi sistem informasi pelayanan dan keterbukaan informasi kesehatan terintegrasi untuk masyarakat.') }}
                    </p>
                    <div class="pt-2 flex items-center gap-3 text-slate-400">
                        <a href="#" class="w-8 h-8 rounded-lg bg-medical-950 hover:bg-medical-600 hover:text-white flex items-center justify-center transition border border-medical-800"><i class="fa-brands fa-facebook-f text-sm"></i></a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-medical-950 hover:bg-medical-600 hover:text-white flex items-center justify-center transition border border-medical-800"><i class="fa-brands fa-instagram text-sm"></i></a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-medical-950 hover:bg-medical-600 hover:text-white flex items-center justify-center transition border border-medical-800"><i class="fa-brands fa-youtube text-sm"></i></a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-medical-950 hover:bg-medical-600 hover:text-white flex items-center justify-center transition border border-medical-800"><i class="fa-brands fa-whatsapp text-sm"></i></a>
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h3 class="text-white text-base font-bold mb-4 tracking-tight border-l-4 border-medical-400 pl-3">Navigasi Utama</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li>
                            <a href="{{ route('public.home') }}" class="hover:text-medical-300 transition inline-flex items-center gap-2">
                                <i class="fa-solid fa-angle-right text-xs text-medical-400"></i> Beranda Utama
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('public.informations') }}" class="hover:text-medical-300 transition inline-flex items-center gap-2">
                                <i class="fa-solid fa-angle-right text-xs text-medical-400"></i> Informasi & Berita Kesehatan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('public.services') }}" class="hover:text-medical-300 transition inline-flex items-center gap-2">
                                <i class="fa-solid fa-angle-right text-xs text-medical-400"></i> Direktori Fasilitas Kesehatan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('public.contact') }}" class="hover:text-medical-300 transition inline-flex items-center gap-2">
                                <i class="fa-solid fa-angle-right text-xs text-medical-400"></i> Kontak & Pengaduan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" class="hover:text-medical-300 transition inline-flex items-center gap-2">
                                <i class="fa-solid fa-angle-right text-xs text-medical-400"></i> Portal Login Petugas
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Categories -->
                <div>
                    <h3 class="text-white text-base font-bold mb-4 tracking-tight border-l-4 border-medical-400 pl-3">Topik Informasi</h3>
                    <ul class="space-y-2 text-sm">
                        @php
                            $footerCategories = \App\Models\Category::where('is_active', true)->take(5)->get();
                        @endphp
                        @foreach($footerCategories as $fcat)
                            <li>
                                <a href="{{ route('public.informations', ['kategori' => $fcat->slug]) }}" class="hover:text-medical-300 transition inline-flex items-center gap-2">
                                    <i class="{{ $fcat->icon }} text-xs text-medical-400"></i> {{ $fcat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Col 4: Contact & Emergency -->
                <div class="space-y-3">
                    <h3 class="text-white text-base font-bold mb-4 tracking-tight border-l-4 border-red-500 pl-3">Kontak Layanan</h3>
                    <div class="p-3.5 rounded-xl bg-red-950/40 border border-red-800/60 flex items-start gap-3">
                        <i class="fa-solid fa-phone-volume text-xl text-red-400 mt-1"></i>
                        <div>
                            <p class="text-xs uppercase font-bold text-red-400">Panggilan Darurat Medis</p>
                            <a href="tel:119" class="text-lg font-black text-white hover:text-red-300">119 (Bebas Pulsa)</a>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 flex items-start gap-2 pt-1">
                        <i class="fa-solid fa-location-dot mt-0.5 text-medical-400"></i>
                        <span>{{ \App\Models\SystemSetting::get('office_address', 'Jl. Kesehatan Nusantara No. 45') }}</span>
                    </p>
                    <p class="text-xs text-slate-400 flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-medical-400"></i>
                        <span>{{ \App\Models\SystemSetting::get('office_email', 'layanan@sipkes.go.id') }}</span>
                    </p>
                    <p class="text-xs text-slate-400 flex items-center gap-2">
                        <i class="fa-solid fa-phone text-medical-400"></i>
                        <span>{{ \App\Models\SystemSetting::get('office_phone', '(021) 555-0120') }}</span>
                    </p>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="mt-12 pt-6 border-t border-slate-800/80 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 gap-3">
                <p>&copy; {{ date('Y') }} <strong>SIP-Kes</strong> — Dikembangkan oleh <strong class="text-medical-400">Politeknik Negeri Jember</strong>. Seluruh Hak Cipta Dilindungi.</p>
                <p class="flex items-center gap-1">
                    <span>Sistem Informasi Pelayanan Kesehatan</span>
                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span>Poltek Jember — Jawa Timur</span>
                </p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                if (mobileMenu.classList.contains('hidden')) {
                    menuIcon.classList.replace('fa-xmark', 'fa-bars');
                } else {
                    menuIcon.classList.replace('fa-bars', 'fa-xmark');
                }
            });
        }
    </script>
</body>
</html>

