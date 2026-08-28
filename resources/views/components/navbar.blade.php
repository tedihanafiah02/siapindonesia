@php
    $instagramUrl = $globalSetting->instagram_url ?? $setting->instagram_url ?? 'https://www.instagram.com/siapindonesia.id';
    $tiktokUrl = $globalSetting->tiktok_url ?? $setting->tiktok_url ?? 'https://www.tiktok.com/@siapindonesia';
    $whatsappUrl = $globalSetting->whatsapp_url ?? $setting->whatsapp_url ?? 'https://wa.me/628118087899';
@endphp

<!-- Mobile Menu Overlay Background -->
<div id="mobile-menu-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-30 opacity-0 pointer-events-none transition-opacity duration-300 md:hidden"></div>

<nav id="main-navbar" class="fixed top-0 left-0 z-50 w-full transition-all duration-300">
    <!-- Top Social Bar (Desktop/Laptop) -->
    <div class="hidden md:block bg-neutral-900/50 border-b border-white/5 py-1 transition-all duration-300">
        <div class="container mx-auto px-5 lg:px-20 flex justify-end items-center gap-4">
            <span class="text-[10px] text-zinc-400 font-semibold tracking-widest uppercase">Ikuti Kami:</span>
            <div class="flex items-center gap-3.5">
                <a href="{{ $instagramUrl }}" target="_blank" aria-label="Instagram" class="text-zinc-400 hover:text-[#c5a059] transition-colors duration-200 text-xs">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="{{ $tiktokUrl }}" target="_blank" aria-label="TikTok" class="text-zinc-400 hover:text-[#c5a059] transition-colors duration-200 text-xs">
                    <i class="fab fa-tiktok"></i>
                </a>
                <a href="{{ $whatsappUrl }}" target="_blank" aria-label="WhatsApp" class="text-zinc-400 hover:text-[#c5a059] transition-colors duration-200 text-xs">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="container w-full flex flex-wrap items-center justify-between mx-auto px-5 lg:px-20 py-1.5 md:py-2">
        <!-- Logo -->
        <a href="/" class="flex items-center py-1 z-50">
            <img src="{{ asset('assets/images/siapindo/logo-siapindo.png') }}" class="logo-img object-contain" alt="Logo Siapindo" />
        </a>

        <!-- Tombol Pencarian dan Menu Mobile -->
        <div class="flex md:order-2 items-center gap-2">
            <!-- Tombol Pencarian Mobile -->
            <button type="button" id="mobile-search-button" aria-label="Toggle search"
                class="md:hidden text-zinc-400 hover:text-[#c5a059] hover:bg-neutral-900/60 focus:outline-none focus:ring-2 focus:ring-neutral-800 rounded-full text-sm p-2.5 z-50">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Cari</span>
            </button>

            <!-- Form Pencarian Desktop -->
            <div class="relative hidden md:block">
                <form method="GET" action="{{ route('front.search') }}" class="relative w-full">
                    @csrf
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-zinc-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" name="keyword" id="search-navbar"
                        class="block w-40 focus:w-56 p-2 ps-10 text-sm text-zinc-100 border border-neutral-800 rounded-full bg-neutral-900/40 placeholder-zinc-500 focus:ring-1 focus:ring-[#c5a059] focus:border-[#c5a059] focus:outline-none transition-all duration-300"
                        placeholder="Cari berita..." value="{{ request('keyword') }}">
                </form>
            </div>

            <!-- Tombol Menu Mobile (Hamburger & Close Morph) -->
            <button id="mobile-menu-toggle" type="button" aria-label="Toggle navigation"
                class="relative w-10 h-10 flex items-center justify-center text-zinc-400 rounded-full md:hidden hover:bg-neutral-900/60 hover:text-[#c5a059] focus:outline-none focus:ring-2 focus:ring-neutral-800 transition duration-200 z-50">
                <!-- Hamburger Icon (3 lines) -->
                <svg id="hamburger-icon" class="w-6 h-6 transition-all duration-300 transform scale-100 rotate-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <!-- Close Icon (X) -->
                <svg id="close-icon" class="absolute w-6 h-6 transition-all duration-300 transform scale-0 opacity-0 rotate-90" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Pencarian Mobile (Awalnya Disembunyikan) -->
        <div id="mobile-search-form" class="hidden w-full mt-3 md:hidden z-50">
            <form method="GET" action="{{ route('front.search') }}" class="relative w-full px-2">
                @csrf
                <div class="absolute inset-y-0 start-0 flex items-center ps-5 pointer-events-none">
                    <svg class="w-4 h-4 text-zinc-500" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" name="keyword" id="search-navbar-mobile"
                    class="block w-full p-2.5 ps-10 text-sm text-zinc-100 border border-neutral-800 rounded-full bg-neutral-900/90 placeholder-zinc-500 focus:ring-1 focus:ring-[#c5a059] focus:border-[#c5a059] focus:outline-none"
                    placeholder="Cari berita..." value="{{ request('keyword') }}">
            </form>
        </div>

        <!-- Menu Navigasi (Slide-out dari samping kanan pada mobile) -->
        <div id="navbar-search" class="fixed top-0 right-0 h-screen w-[280px] sm:w-[320px] bg-neutral-950/98 backdrop-blur-2xl border-l border-white/10 z-40 p-6 pt-28 transition-transform duration-300 transform translate-x-full md:translate-x-0 md:transition-none md:static md:h-auto md:w-auto md:bg-transparent md:border-0 md:p-0 md:flex md:items-center md:justify-between md:order-1">
            <ul class="text-base md:text-sm flex flex-col gap-5 w-full md:flex-row md:gap-0 md:space-x-8 md:rtl:space-x-reverse md:border-0 md:bg-transparent md:p-0 md:mt-0">
                <li>
                    <a href="{{ route('front.beranda') }}" @class([
                        'nav-link-custom w-full md:w-auto',
                        'active-link' => request()->routeIs('front.beranda'),
                    ])>
                        Beranda
                    </a>
                </li>

                {{-- Dynamic Hierarchical Menus --}}
                @foreach($navigationMenus as $menu)
                    @if($menu->children->isEmpty())
                        <li>
                            @if($menu->has_page)
                                <a href="{{ route('front.program', $menu->slug) }}" @class([
                                    'nav-link-custom w-full md:w-auto block',
                                    'active-link' => request()->is('program/' . $menu->slug),
                                ])>
                                    {{ $menu->name }}
                                </a>
                            @elseif($menu->url)
                                <a href="{{ $menu->url }}" class="nav-link-custom w-full md:w-auto block" target="_blank">
                                    {{ $menu->name }}
                                </a>
                            @else
                                <span class="nav-link-custom w-full md:w-auto text-zinc-500 cursor-default block">
                                    {{ $menu->name }}
                                </span>
                            @endif
                        </li>
                     @else
                        <li class="relative dropdown-submenu w-full md:w-auto group/menu-root">
                            <div class="flex flex-nowrap items-center gap-1.5 nav-link-custom py-2 cursor-pointer menu-toggle-btn w-full md:w-auto">
                                @if($menu->has_page)
                                    <a href="{{ route('front.program', $menu->slug) }}">
                                        {{ $menu->name }}
                                    </a>
                                @else
                                    <span>{{ $menu->name }}</span>
                                @endif
                                <svg class="w-2.5 h-2.5 transition-transform duration-300 submenu-arrow shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 10 6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m1 1 4 4 4-4" />
                                </svg>
                            </div>
                            
                            <!-- Dropdown menu (Level 1 Submenus) -->
                            <ul class="static hidden w-full mt-2 py-2 px-2 bg-white/5 border border-white/5 rounded-2xl md:absolute md:left-0 md:top-full md:mt-1 md:w-72 md:bg-slate-950/90 md:backdrop-blur-3xl md:border md:border-white/10 md:rounded-[24px] md:shadow-[0_20px_50px_rgba(0,0,0,0.85)] md:group-hover/menu-root:block submenu-list transition-all duration-300">
                                @foreach($menu->children as $child)
                                    <li class="w-full">
                                        <a href="{{ route('front.program', $child->slug) }}" 
                                           class="flex items-center justify-between w-full px-4 py-3 rounded-xl text-zinc-300 hover:text-[#d4b26f] hover:bg-white/5 transition-all duration-300 group/item text-xs sm:text-sm font-semibold">
                                            <span>{{ $child->name }}</span>
                                            <svg class="w-4 h-4 opacity-0 -translate-x-2 group-hover/item:opacity-100 group-hover/item:translate-x-0 transition-all duration-300 text-[#c5a059] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                            </svg>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach

                <li>
                    <a href="{{ route('front.index') }}" @class([
                        'nav-link-custom w-full md:w-auto block',
                        'active-link' => request()->routeIs('front.index') || request()->routeIs('front.details') || request()->routeIs('front.category') || request()->routeIs('front.author') || request()->routeIs('front.search'),
                    ])>
                        Berita Terkini
                    </a>
                </li>
                <li>
                    <a href="{{ route('front.jadwalPelatihan') }}" @class([
                        'nav-link-custom w-full md:w-auto block',
                        'active-link' => request()->routeIs('front.jadwalPelatihan'),
                    ])>
                        Jadwal Pelatihan
                    </a>
                </li>
            </ul>

            <!-- Mobile Social Icons at the bottom of menu -->
            <div class="mt-10 pt-8 border-t border-white/10 flex flex-col gap-3.5 md:hidden">
                <span class="text-xs text-zinc-400 font-semibold tracking-widest uppercase">Hubungi Kami:</span>
                <div class="flex items-center gap-4">
                    <a href="{{ $instagramUrl }}" target="_blank" aria-label="Instagram" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-zinc-300 hover:text-[#c5a059] hover:border-[#c5a059] transition-all duration-300">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                    <a href="{{ $tiktokUrl }}" target="_blank" aria-label="TikTok" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-zinc-300 hover:text-[#c5a059] hover:border-[#c5a059] transition-all duration-300">
                        <i class="fab fa-tiktok text-lg"></i>
                    </a>
                    <a href="{{ $whatsappUrl }}" target="_blank" aria-label="WhatsApp" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-zinc-300 hover:text-[#c5a059] hover:border-[#c5a059] transition-all duration-300">
                        <i class="fab fa-whatsapp text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

@push('after-scripts')
    <script>
        function debounce(func, wait) {
            let timeout;
            return function (...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        // Scroll state management
        window.addEventListener(
            "scroll",
            debounce(function () {
                const navbar = document.getElementById("main-navbar");
                const navbarSearch = document.getElementById("navbar-search");
                const isMenuOpen = navbarSearch ? navbarSearch.classList.contains("translate-x-0") : false;
                
                if (navbar) {
                    if (window.scrollY > 10 || isMenuOpen) {
                        navbar.classList.add("navbar-scrolled-state");
                    } else {
                        navbar.classList.remove("navbar-scrolled-state");
                    }
                }
            }, 10),
        );

        // Mobile & Desktop Interactions
        function initNavbar() {
            // Mobile menu toggle (Slide-out from right)
            const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
            const navbarSearch = document.getElementById("navbar-search");
            const mobileMenuOverlay = document.getElementById("mobile-menu-overlay");
            const hamburgerIcon = document.getElementById("hamburger-icon");
            const closeIcon = document.getElementById("close-icon");

            function openMobileMenu() {
                if (!navbarSearch) return;
                navbarSearch.classList.remove("translate-x-full");
                navbarSearch.classList.add("translate-x-0");
                
                // Add scrolled class for solid background color
                const navbar = document.getElementById("main-navbar");
                if (navbar) {
                    navbar.classList.add("navbar-scrolled-state");
                }
                
                if (mobileMenuOverlay) {
                    mobileMenuOverlay.classList.remove("opacity-0", "pointer-events-none");
                    mobileMenuOverlay.classList.add("opacity-100", "pointer-events-auto");
                }
                
                // Morph button icon
                if (hamburgerIcon) {
                    hamburgerIcon.classList.remove("scale-100", "rotate-0");
                    hamburgerIcon.classList.add("scale-0", "opacity-0", "-rotate-90");
                }
                if (closeIcon) {
                    closeIcon.classList.remove("scale-0", "opacity-0", "rotate-90");
                    closeIcon.classList.add("scale-100", "opacity-100", "rotate-0");
                }
            }

            function closeMobileMenu() {
                if (!navbarSearch) return;
                navbarSearch.classList.add("translate-x-full");
                navbarSearch.classList.remove("translate-x-0");
                
                // Remove scrolled class if at top
                const navbar = document.getElementById("main-navbar");
                if (navbar && window.scrollY <= 10) {
                    navbar.classList.remove("navbar-scrolled-state");
                }
                
                if (mobileMenuOverlay) {
                    mobileMenuOverlay.classList.add("opacity-0", "pointer-events-none");
                    mobileMenuOverlay.classList.remove("opacity-100", "pointer-events-auto");
                }
                
                // Morph button icon
                if (hamburgerIcon) {
                    hamburgerIcon.classList.add("scale-100", "rotate-0");
                    hamburgerIcon.classList.remove("scale-0", "opacity-0", "-rotate-90");
                }
                if (closeIcon) {
                    closeIcon.classList.add("scale-0", "opacity-0", "rotate-90");
                    closeIcon.classList.remove("scale-100", "opacity-100", "rotate-0");
                }
                
                // Close inner dropdowns if open on mobile
                if (window.innerWidth < 768) {
                    document.querySelectorAll('.submenu-list').forEach(list => {
                        list.classList.add('hidden');
                    });
                    document.querySelectorAll('.submenu-arrow').forEach(arrow => {
                        arrow.classList.remove('rotate-180');
                    });
                }
            }

            if (mobileMenuToggle && navbarSearch) {
                mobileMenuToggle.addEventListener("click", function(event) {
                    event.stopPropagation();
                    const isOpen = navbarSearch.classList.contains("translate-x-0");
                    if (isOpen) {
                        closeMobileMenu();
                    } else {
                        openMobileMenu();
                    }
                });

                if (mobileMenuOverlay) {
                    mobileMenuOverlay.addEventListener("click", closeMobileMenu);
                }

                // Close sidebar on menu links click (useful for anchor scroll or SPA-like transitions)
                navbarSearch.querySelectorAll("a").forEach(link => {
                    link.addEventListener("click", function() {
                        if (window.innerWidth < 768) {
                            closeMobileMenu();
                        }
                    });
                });
            }

            // Mobile search toggle
            const mobileSearchButton = document.getElementById("mobile-search-button");
            const mobileSearchForm = document.getElementById("mobile-search-form");

            if (mobileSearchButton && mobileSearchForm) {
                mobileSearchButton.addEventListener("click", function (event) {
                    event.stopPropagation();
                    mobileSearchForm.classList.toggle("hidden");
                    mobileSearchForm.classList.toggle("block");
                });
            }

            // Mobile recursive menu toggles
            document.querySelectorAll('.menu-toggle-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    if (window.innerWidth < 768) {
                        e.stopPropagation();
                        const submenu = this.nextElementSibling;
                        if (submenu) {
                            const isHidden = submenu.classList.contains('hidden');
                            if (isHidden) {
                                submenu.classList.remove('hidden');
                            } else {
                                submenu.classList.add('hidden');
                            }
                            
                            // Rotate arrow icon
                            const arrow = this.querySelector('.submenu-arrow');
                            if (arrow) {
                                if (isHidden) {
                                    arrow.classList.add('rotate-180');
                                } else {
                                    arrow.classList.remove('rotate-180');
                                }
                            }
                        }
                    }
                });
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
                anchor.addEventListener("click", function (e) {
                    const href = this.getAttribute("href");
                    if (href !== "#" && document.querySelector(href)) {
                        e.preventDefault();
                        document.querySelector(href).scrollIntoView({
                            behavior: "smooth",
                        });
                    }
                });
            });
        }

        if (document.readyState !== 'loading') {
            initNavbar();
        } else {
            document.addEventListener("DOMContentLoaded", initNavbar);
        }
    </script>
@endpush

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/filament/style.css') }}?v=1.0.2">
    <style>
        /* Modernized Header & Navigation Overrides */
        #main-navbar {
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            background: linear-gradient(to bottom, rgba(8, 10, 15, 0.8), rgba(8, 10, 15, 0));
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        @media (min-width: 768px) {
            #main-navbar {
                padding-top: 0px !important;
                padding-bottom: 0px !important;
            }
            #main-navbar.navbar-scrolled-state {
                padding-top: 0px !important;
                padding-bottom: 0px !important;
            }
            #main-navbar .logo-img {
                height: 3.5rem !important;
            }
            #main-navbar.navbar-scrolled-state .logo-img {
                height: 2.75rem !important;
            }
        }
        #main-navbar.navbar-scrolled-state {
            background: rgba(8, 10, 15, 0.95) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            border-bottom: 1px solid rgba(197, 160, 89, 0.12) !important;
            box-shadow: 0 10px 40px -15px rgba(0, 0, 0, 0.8), 0 8px 30px -10px rgba(197, 160, 89, 0.08) !important;
        }

        @media (max-width: 767px) {
            #main-navbar {
                background: #090c15 !important;
                padding-top: 0.85rem !important;
                padding-bottom: 0.85rem !important;
                border-bottom: 1px solid rgba(197, 160, 89, 0.2) !important;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4) !important;
            }
            #main-navbar.navbar-scrolled-state {
                background: #090c15 !important;
                padding-top: 0.75rem !important;
                padding-bottom: 0.75rem !important;
                border-bottom: 1px solid rgba(197, 160, 89, 0.25) !important;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
            }
            #main-navbar .logo-img {
                height: 3rem !important;
            }
            #main-navbar.navbar-scrolled-state .logo-img {
                height: 2.25rem !important;
            }
            #navbar-search {
                background: #090c15 !important;
                border-left: 1px solid rgba(255, 255, 255, 0.08) !important;
            }
        }
        
        .nav-link-custom {
            font-size: 0.825rem !important;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            font-weight: 750 !important;
            color: #94a3b8 !important;
            transition: all 0.3s ease;
        }
        .nav-link-custom:hover {
            color: #c5a059 !important;
        }
        .nav-link-custom.active-link {
            color: #c5a059 !important;
        }
        
        @media (max-width: 767px) {
            .nav-link-custom {
                text-transform: none;
                font-size: 0.95rem !important;
                font-weight: 600 !important;
                border-radius: 12px;
                padding: 10px 16px !important;
                letter-spacing: normal;
                color: #cbd5e1 !important;
            }
            .nav-link-custom.active-link {
                background: rgba(197, 160, 89, 0.08) !important;
                color: #c5a059 !important;
                border-left: 3px solid #c5a059;
                border-radius: 0 12px 12px 0;
            }
        }

        /* Desktop dropdown hover & arrow styling */
        @media (min-width: 768px) {
            .menu-toggle-btn.nav-link-custom {
                display: inline-flex !important;
                align-items: center;
                gap: 6px;
            }
            .group\/menu-root:hover > .submenu-list {
                display: block !important;
            }
            .group\/menu-root:hover .submenu-arrow {
                transform: rotate(180deg) !important;
                color: #c5a059 !important;
            }
            .dropdown-submenu:hover > .submenu-list {
                display: block !important;
            }
        }

        /* Mobile menu toggle button layout fixes */
        @media (max-width: 767px) {
            .menu-toggle-btn {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                align-items: center !important;
                justify-content: flex-start !important;
                gap: 0.5rem !important;
                width: 100% !important;
            }
            .menu-toggle-btn a,
            .menu-toggle-btn span {
                display: inline-block !important;
                width: auto !important;
                flex-shrink: 1 !important;
            }
            .menu-toggle-btn .submenu-arrow {
                flex-shrink: 0 !important;
                display: inline-block !important;
                margin-left: 0.25rem !important;
            }
        }
    </style>
@endpush
