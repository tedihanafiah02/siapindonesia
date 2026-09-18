@php
    $instagramUrl = $globalSetting->instagram_url ?? $setting->instagram_url ?? 'https://www.instagram.com/siapindonesia.id';
    $tiktokUrl = $globalSetting->tiktok_url ?? $setting->tiktok_url ?? 'https://www.tiktok.com/@siapindonesia';
    $whatsappUrl = $globalSetting->whatsapp_url ?? $setting->whatsapp_url ?? 'https://wa.me/628118087899';
@endphp

<!-- Mobile Menu Overlay Background -->
<div id="mobile-menu-overlay" class="fixed inset-0 bg-black/75 backdrop-blur-md z-40 opacity-0 pointer-events-none transition-opacity duration-300 md:hidden" onclick="closeMobileMenu()"></div>

<header id="main-navbar-header" class="fixed top-0 left-0 z-50 w-full transition-all duration-300">
    <nav id="main-navbar" class="w-full relative transition-all duration-300">
        <!-- Top Shimmer Ambient Gold Border -->
        <div class="absolute top-0 left-0 right-0 h-[1.5px] bg-gradient-to-r from-transparent via-[#c5a059]/80 to-transparent pointer-events-none z-50"></div>

        <!-- Top Social Bar (Collapsible on Scroll) -->
        <div id="navbar-top-bar" class="hidden md:block bg-[#05070d]/85 border-b border-white/[0.06] py-1.5 transition-all duration-300">
            <div class="container mx-auto px-5 lg:px-20 max-w-7xl flex justify-between items-center text-xs">
                <!-- Left Accent Text / Official Status -->
                <div class="flex items-center gap-2">
                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-[#c5a059] animate-pulse"></span>
                    <span class="text-[11px] text-zinc-400 font-medium tracking-wide">Pusat Diklat, Bimtek & Konsultasi Keprotokolan Resmi</span>
                </div>

                <!-- Right Social Channels -->
                <div class="flex items-center gap-4">
                    <span class="text-[10px] text-zinc-400 font-semibold tracking-widest uppercase">Ikuti Kami:</span>
                    <div class="flex items-center gap-2">
                        <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram" 
                           class="w-6 h-6 rounded-full bg-white/[0.05] border border-white/10 hover:border-[#c5a059]/60 hover:bg-[#c5a059]/20 text-zinc-400 hover:text-[#d4b26f] flex items-center justify-center transition-all duration-300 text-[11px] shadow-sm hover:scale-110">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{ $tiktokUrl }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok" 
                           class="w-6 h-6 rounded-full bg-white/[0.05] border border-white/10 hover:border-[#c5a059]/60 hover:bg-[#c5a059]/20 text-zinc-400 hover:text-[#d4b26f] flex items-center justify-center transition-all duration-300 text-[11px] shadow-sm hover:scale-110">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" 
                           class="w-6 h-6 rounded-full bg-white/[0.05] border border-white/10 hover:border-emerald-500/60 hover:bg-emerald-500/20 text-zinc-400 hover:text-emerald-400 flex items-center justify-center transition-all duration-300 text-[11px] shadow-sm hover:scale-110">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Primary Navbar Content -->
        <div class="navbar-primary-wrapper transition-all duration-300">
            <div class="container mx-auto px-5 lg:px-20 max-w-7xl flex items-center justify-between py-2 md:py-2.5 transition-all duration-300">
                <!-- Logo Brand -->
                <a href="/" class="flex items-center z-50 group/logo focus:outline-none shrink-0 py-0.5" aria-label="Beranda SIAP Indonesia">
                    <img src="{{ asset('assets/images/siapindo/logo-siapindo.png') }}" 
                         class="logo-img object-contain transform group-hover/logo:scale-105 transition-all duration-300 filter drop-shadow-[0_2px_12px_rgba(197,160,89,0.22)]" 
                         alt="Logo Siap Indonesia" />
                </a>

                <!-- Desktop Navigation Links (Center) -->
                <div class="hidden md:flex items-center justify-center flex-1 mx-6 lg:mx-10">
                    <ul class="flex items-center gap-1 lg:gap-2">
                        <li>
                            <a href="{{ route('front.beranda') }}" @class([
                                'nav-link-custom',
                                'active-link' => request()->routeIs('front.beranda'),
                            ])>
                                <span>Beranda</span>
                            </a>
                        </li>

                        {{-- Dynamic Hierarchical Menus --}}
                        @foreach($navigationMenus as $menu)
                            @if($menu->children->isEmpty())
                                <li>
                                    @if($menu->has_page)
                                        <a href="{{ route('front.program', $menu->slug) }}" @class([
                                            'nav-link-custom',
                                            'active-link' => request()->is('program/' . $menu->slug),
                                        ])>
                                            <span>{{ $menu->name }}</span>
                                        </a>
                                    @elseif($menu->url)
                                        <a href="{{ $menu->url }}" class="nav-link-custom" target="_blank" rel="noopener noreferrer">
                                            <span>{{ $menu->name }}</span>
                                        </a>
                                    @else
                                        <span class="nav-link-custom text-zinc-500 cursor-default">
                                            {{ $menu->name }}
                                        </span>
                                    @endif
                                </li>
                            @else
                                <li class="relative dropdown-submenu group/menu-root">
                                    <div class="inline-flex flex-row flex-nowrap items-center gap-1.5 nav-link-custom cursor-pointer menu-toggle-btn @if(request()->is('program/*')) active-link @endif">
                                        @if($menu->has_page)
                                            <a href="{{ route('front.program', $menu->slug) }}" class="inline-flex items-center hover:text-[#d4b26f] transition-colors">
                                                <span>{{ $menu->name }}</span>
                                            </a>
                                        @else
                                            <span class="inline-flex items-center">{{ $menu->name }}</span>
                                        @endif
                                        <svg class="w-2.5 h-2.5 transition-transform duration-200 submenu-arrow text-zinc-400 group-hover/menu-root:text-[#d4b26f] group-hover/menu-root:rotate-180 shrink-0 inline-block align-middle" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 10 6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </div>
                                    
                                    <!-- Dropdown Submenu Card (Desktop Acrylic Card) -->
                                    <div class="submenu-list hidden md:group-hover/menu-root:block transition-all duration-300">
                                        <div class="relative py-2 px-1.5 space-y-1">
                                            @foreach($menu->children as $child)
                                                <a href="{{ route('front.program', $child->slug) }}" 
                                                   class="flex items-center justify-between w-full px-3.5 py-2.5 rounded-xl text-zinc-300 hover:text-[#f3e3be] hover:bg-[#c5a059]/15 transition-all duration-200 group/item text-xs font-medium border border-transparent hover:border-[#c5a059]/30">
                                                    <div class="flex items-center gap-2.5">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-[#c5a059]/40 group-hover/item:bg-[#c5a059] group-hover/item:scale-125 transition-all duration-200"></span>
                                                        <span class="tracking-wide">{{ $child->name }}</span>
                                                    </div>
                                                    <svg class="w-3.5 h-3.5 opacity-0 -translate-x-2 group-hover/item:opacity-100 group-hover/item:translate-x-0 transition-all duration-200 text-[#d4b26f] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                                    </svg>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach

                        <li>
                            <a href="{{ route('front.index') }}" @class([
                                'nav-link-custom',
                                'active-link' => request()->routeIs('front.index') || request()->routeIs('front.details') || request()->routeIs('front.category') || request()->routeIs('front.author') || request()->routeIs('front.search'),
                            ])>
                                <span>Berita</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.jadwalPelatihan') }}" @class([
                                'nav-link-custom',
                                'active-link' => request()->routeIs('front.jadwalPelatihan'),
                            ])>
                                <span>Jadwal Pelatihan</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Right Actions: Search Box & Mobile Hamburger -->
                <div class="flex items-center gap-2.5">
                    <!-- Form Pencarian Desktop -->
                    <div class="relative hidden md:block group/search">
                        <form method="GET" action="{{ route('front.search') }}" class="relative flex items-center">
                            @csrf
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-slate-500 group-focus-within/search:text-slate-800 transition-colors duration-200">
                                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" name="keyword" id="search-navbar"
                                   class="block w-40 focus:w-60 lg:w-44 lg:focus:w-64 p-2 ps-9 pe-8 text-xs font-medium text-slate-900 border border-slate-300 rounded-full bg-slate-200 placeholder-slate-500 hover:bg-slate-100 hover:border-slate-400 focus:ring-2 focus:ring-[#c5a059]/40 focus:border-[#c5a059] focus:bg-white focus:outline-none transition-all duration-300 ease-out shadow-sm"
                                   placeholder="Cari topik..." value="{{ request('keyword') }}">
                            <button type="submit" aria-label="Submit Search" class="absolute end-1.5 p-1 text-slate-500 hover:text-slate-900 hover:bg-slate-300/60 rounded-full transition-all duration-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    <!-- Mobile Search Trigger Button -->
                    <button type="button" id="mobile-search-button" aria-label="Toggle search"
                            class="md:hidden text-zinc-300 hover:text-[#d4b26f] bg-slate-900/80 border border-white/10 hover:border-[#c5a059]/40 focus:outline-none rounded-full text-sm p-2.5 z-50 transition-all duration-200">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Cari</span>
                    </button>

                    <!-- Mobile Menu Hamburger Button -->
                    <button id="mobile-menu-toggle" type="button" aria-label="Toggle navigation"
                            class="relative w-10 h-10 flex items-center justify-center text-zinc-300 rounded-full md:hidden bg-slate-900/80 border border-white/10 hover:border-[#c5a059]/40 hover:text-[#d4b26f] focus:outline-none transition duration-200 z-50">
                        <!-- Hamburger Icon (3 lines) -->
                        <svg id="hamburger-icon" class="w-5 h-5 transition-all duration-300 transform scale-100 rotate-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Close Icon (X) -->
                        <svg id="close-icon" class="absolute w-5 h-5 transition-all duration-300 transform scale-0 opacity-0 rotate-90" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Form Pencarian Mobile (Dropdown Slide Down) -->
        <div id="mobile-search-form" class="hidden w-full px-5 py-3 bg-[#070a12]/95 border-b border-[#c5a059]/20 md:hidden z-50 transition-all duration-300 shadow-xl">
            <form method="GET" action="{{ route('front.search') }}" class="relative w-full">
                @csrf
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none text-slate-500">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" name="keyword" id="search-navbar-mobile"
                           class="block w-full p-2.5 ps-11 pe-16 text-xs font-medium text-slate-900 border border-slate-300 rounded-full bg-slate-200 placeholder-slate-500 focus:ring-2 focus:ring-[#c5a059]/40 focus:border-[#c5a059] focus:bg-white focus:outline-none shadow-sm"
                           placeholder="Ketik topik atau berita..." value="{{ request('keyword') }}">
                    <button type="submit" class="absolute end-1.5 px-3 py-1.5 bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] text-slate-950 font-bold text-[10px] uppercase rounded-full shadow-md hover:scale-105 transition-all">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </nav>
</header>

<!-- Mobile Navigation Drawer (Modern Slide-out Sheet) -->
<div id="navbar-mobile-drawer" class="fixed top-0 right-0 h-screen w-[310px] sm:w-[350px] bg-[#070912]/98 backdrop-blur-2xl border-l border-[#c5a059]/25 z-50 p-6 flex flex-col justify-between transition-transform duration-300 ease-out transform translate-x-full md:hidden shadow-[-20px_0_50px_rgba(0,0,0,0.85)]">
    <div class="overflow-y-auto space-y-6 pt-12 pr-1">
        <!-- Drawer Header Badge -->
        <div class="flex items-center justify-between pb-4 border-b border-white/10">
            <span class="text-[11px] font-bold text-[#d4b26f] uppercase tracking-widest flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#c5a059] animate-pulse"></span>
                Menu Navigasi
            </span>
            <span class="text-[10px] text-zinc-400 font-mono">SIAP INDONESIA</span>
        </div>

        <!-- Navigation Links -->
        <ul class="flex flex-col gap-2">
            <li>
                <a href="{{ route('front.beranda') }}" @class([
                    'mobile-nav-link',
                    'active-mobile-link' => request()->routeIs('front.beranda'),
                ])>
                    <i class="fas fa-home text-xs opacity-70"></i>
                    <span>Beranda</span>
                </a>
            </li>

            {{-- Hierarchical Menus on Mobile --}}
            @foreach($navigationMenus as $menu)
                @if($menu->children->isEmpty())
                    <li>
                        @if($menu->has_page)
                            <a href="{{ route('front.program', $menu->slug) }}" @class([
                                'mobile-nav-link',
                                'active-mobile-link' => request()->is('program/' . $menu->slug),
                            ])>
                                <i class="fas fa-layer-group text-xs opacity-70"></i>
                                <span>{{ $menu->name }}</span>
                            </a>
                        @elseif($menu->url)
                            <a href="{{ $menu->url }}" class="mobile-nav-link" target="_blank" rel="noopener noreferrer">
                                <i class="fas fa-external-link-alt text-xs opacity-70"></i>
                                <span>{{ $menu->name }}</span>
                            </a>
                        @endif
                    </li>
                @else
                    <li class="rounded-xl overflow-hidden bg-white/[0.03] border border-white/[0.06]">
                        <div class="mobile-nav-link menu-toggle-btn cursor-pointer justify-between @if(request()->is('program/*')) text-[#d4b26f] @endif">
                            <div class="flex items-center gap-2.5">
                                <i class="fas fa-graduation-cap text-xs text-[#c5a059]"></i>
                                <span>{{ $menu->name }}</span>
                            </div>
                            <svg class="w-3 h-3 transition-transform duration-300 submenu-arrow shrink-0 text-zinc-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 10 6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m1 1 4 4 4-4" />
                            </svg>
                        </div>
                        
                        <!-- Mobile Accordion Submenu -->
                        <div class="hidden px-3 pb-3 space-y-1.5 submenu-list transition-all duration-200">
                            @foreach($menu->children as $child)
                                <a href="{{ route('front.program', $child->slug) }}" 
                                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs text-zinc-300 hover:text-[#d4b26f] hover:bg-[#c5a059]/15 transition-all">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#c5a059]/50"></span>
                                    <span>{{ $child->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </li>
                @endif
            @endforeach

            <li>
                <a href="{{ route('front.index') }}" @class([
                    'mobile-nav-link',
                    'active-mobile-link' => request()->routeIs('front.index') || request()->routeIs('front.details') || request()->routeIs('front.category') || request()->routeIs('front.author') || request()->routeIs('front.search'),
                ])>
                    <i class="fas fa-newspaper text-xs opacity-70"></i>
                    <span>Berita Terkini</span>
                </a>
            </li>
            <li>
                <a href="{{ route('front.jadwalPelatihan') }}" @class([
                    'mobile-nav-link',
                    'active-mobile-link' => request()->routeIs('front.jadwalPelatihan'),
                ])>
                    <i class="fas fa-calendar-alt text-xs opacity-70"></i>
                    <span>Jadwal Pelatihan</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Drawer Footer Actions -->
    <div class="pt-6 border-t border-white/10 space-y-4">
        <!-- Direct Fast WhatsApp CTA -->
        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" 
           class="flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-500 hover:to-emerald-600 text-white font-bold text-xs shadow-lg shadow-emerald-950/50 transition-all active:scale-95">
            <i class="fab fa-whatsapp text-sm"></i>
            <span>Konsultasi Cepat (WhatsApp)</span>
        </a>

        <!-- Social Icons -->
        <div class="flex items-center justify-between text-zinc-400 pt-1 text-xs">
            <span class="text-[11px] font-semibold text-zinc-400">Media Sosial:</span>
            <div class="flex items-center gap-3">
                <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#d4b26f] transition-colors"><i class="fab fa-instagram text-base"></i></a>
                <a href="{{ $tiktokUrl }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#d4b26f] transition-colors"><i class="fab fa-tiktok text-base"></i></a>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="hover:text-emerald-400 transition-colors"><i class="fab fa-whatsapp text-base"></i></a>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    <script>
        // Highly optimized 60fps navbar scroll handler
        let lastKnownScrollPosition = 0;
        let ticking = false;

        function handleNavbarScroll(scrollPos) {
            const navbar = document.getElementById("main-navbar");
            const topBar = document.getElementById("navbar-top-bar");
            
            if (!navbar) return;

            if (scrollPos > 20) {
                navbar.classList.add("navbar-scrolled-state");
                if (topBar) topBar.classList.add("top-bar-collapsed");
            } else {
                navbar.classList.remove("navbar-scrolled-state");
                if (topBar) topBar.classList.remove("top-bar-collapsed");
            }
        }

        window.addEventListener("scroll", function() {
            lastKnownScrollPosition = window.scrollY;
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    handleNavbarScroll(lastKnownScrollPosition);
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });

        // Mobile drawer handlers
        function openMobileMenu() {
            const drawer = document.getElementById("navbar-mobile-drawer");
            const overlay = document.getElementById("mobile-menu-overlay");
            const hamburgerIcon = document.getElementById("hamburger-icon");
            const closeIcon = document.getElementById("close-icon");

            if (!drawer) return;

            drawer.classList.remove("translate-x-full");
            drawer.classList.add("translate-x-0");

            if (overlay) {
                overlay.classList.remove("opacity-0", "pointer-events-none");
                overlay.classList.add("opacity-100", "pointer-events-auto");
            }

            if (hamburgerIcon) {
                hamburgerIcon.classList.remove("scale-100", "rotate-0");
                hamburgerIcon.classList.add("scale-0", "opacity-0", "-rotate-90");
            }
            if (closeIcon) {
                closeIcon.classList.remove("scale-0", "opacity-0", "rotate-90");
                closeIcon.classList.add("scale-100", "opacity-100", "rotate-0");
            }
            document.body.style.overflow = "hidden";
        }

        function closeMobileMenu() {
            const drawer = document.getElementById("navbar-mobile-drawer");
            const overlay = document.getElementById("mobile-menu-overlay");
            const hamburgerIcon = document.getElementById("hamburger-icon");
            const closeIcon = document.getElementById("close-icon");

            if (!drawer) return;

            drawer.classList.add("translate-x-full");
            drawer.classList.remove("translate-x-0");

            if (overlay) {
                overlay.classList.add("opacity-0", "pointer-events-none");
                overlay.classList.remove("opacity-100", "pointer-events-auto");
            }

            if (hamburgerIcon) {
                hamburgerIcon.classList.add("scale-100", "rotate-0");
                hamburgerIcon.classList.remove("scale-0", "opacity-0", "-rotate-90");
            }
            if (closeIcon) {
                closeIcon.classList.add("scale-0", "opacity-0", "rotate-90");
                closeIcon.classList.remove("scale-100", "opacity-100", "rotate-0");
            }
            document.body.style.overflow = "";
        }

        function initNavbarInteractions() {
            const toggleBtn = document.getElementById("mobile-menu-toggle");
            const mobileSearchBtn = document.getElementById("mobile-search-button");
            const mobileSearchForm = document.getElementById("mobile-search-form");

            if (toggleBtn) {
                toggleBtn.onclick = function(e) {
                    e.stopPropagation();
                    const drawer = document.getElementById("navbar-mobile-drawer");
                    if (drawer && drawer.classList.contains("translate-x-0")) {
                        closeMobileMenu();
                    } else {
                        openMobileMenu();
                    }
                };
            }

            if (mobileSearchBtn && mobileSearchForm) {
                mobileSearchBtn.onclick = function(e) {
                    e.stopPropagation();
                    mobileSearchForm.classList.toggle("hidden");
                };
            }

            // Accordion toggle on mobile
            document.querySelectorAll("#navbar-mobile-drawer .menu-toggle-btn").forEach(btn => {
                btn.onclick = function(e) {
                    e.stopPropagation();
                    const submenu = this.nextElementSibling;
                    const arrow = this.querySelector(".submenu-arrow");
                    if (submenu) {
                        submenu.classList.toggle("hidden");
                        if (arrow) arrow.classList.toggle("rotate-180");
                    }
                };
            });

            // Close mobile drawer when clicking any link
            document.querySelectorAll("#navbar-mobile-drawer a").forEach(link => {
                link.onclick = function() {
                    closeMobileMenu();
                };
            });

            // ESC key to close drawer
            document.addEventListener("keydown", function(e) {
                if (e.key === "Escape") {
                    closeMobileMenu();
                }
            });

            // Initial scroll check
            handleNavbarScroll(window.scrollY);
        }

        if (document.readyState !== "loading") {
            initNavbarInteractions();
        } else {
            document.addEventListener("DOMContentLoaded", initNavbarInteractions);
        }
    </script>
@endpush

@push('after-styles')
    <style>
        /* Modern Glassmorphism & Micro-Interactions */
        #main-navbar {
            background: linear-gradient(to bottom, rgba(7, 9, 15, 0.85), rgba(7, 9, 15, 0.45));
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Scrolled state with floating frosted glass */
        #main-navbar.navbar-scrolled-state {
            background: rgba(7, 9, 15, 0.94) !important;
            backdrop-filter: blur(24px) !important;
            -webkit-backdrop-filter: blur(24px) !important;
            border-bottom: 1px solid rgba(197, 160, 89, 0.25) !important;
            box-shadow: 0 12px 35px -10px rgba(0, 0, 0, 0.9), 0 0 25px rgba(197, 160, 89, 0.08) !important;
        }

        /* Collapsible Top Bar */
        #navbar-top-bar {
            max-height: 40px;
            opacity: 1;
            transition: max-height 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease, padding 0.3s ease, transform 0.4s ease;
        }
        #navbar-top-bar.top-bar-collapsed {
            max-height: 0 !important;
            opacity: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            transform: translateY(-100%);
            overflow: hidden !important;
            pointer-events: none !important;
        }

        /* Responsive Logo Scaling */
        .logo-img {
            height: 2.85rem;
            transition: height 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @media (min-width: 768px) {
            .logo-img {
                height: 3.25rem;
            }
            #main-navbar.navbar-scrolled-state .logo-img {
                height: 2.7rem;
            }
        }

        /* Desktop Nav Link Styles */
        .nav-link-custom {
            font-size: 0.845rem !important;
            letter-spacing: 0.025em;
            font-weight: 500 !important;
            color: #94a3b8 !important;
            padding: 0.5rem 0.85rem !important;
            border-radius: 8px;
            display: inline-flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            align-items: center !important;
            gap: 0.35rem !important;
            white-space: nowrap !important;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }
        .nav-link-custom::after {
            display: none !important;
            content: none !important;
        }
        .nav-link-custom:hover {
            color: #f3e3be !important;
            transform: translateY(-1.5px);
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }
        .nav-link-custom.active-link {
            color: #d4b26f !important;
            font-weight: 600 !important;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        .menu-toggle-btn {
            display: inline-flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            align-items: center !important;
            gap: 0.35rem !important;
            white-space: nowrap !important;
        }
        .menu-toggle-btn a,
        .menu-toggle-btn span {
            display: inline-flex !important;
            align-items: center !important;
        }
        .submenu-arrow {
            display: inline-block !important;
            margin-left: 0.2rem !important;
            flex-shrink: 0 !important;
            vertical-align: middle !important;
        }

        /* Desktop Submenu Acrylic Card */
        .submenu-list {
            position: absolute;
            left: 0;
            top: calc(100% + 0.35rem);
            min-width: 17.5rem;
            background: rgba(8, 12, 20, 0.96) !important;
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(197, 160, 89, 0.28) !important;
            border-radius: 20px;
            padding: 0.35rem;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.95), 0 0 25px rgba(197, 160, 89, 0.1) !important;
            animation: fadeInSubmenu 0.25s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            z-index: 60;
        }
        .submenu-list::before {
            content: '';
            position: absolute;
            top: -1px;
            left: 1.25rem;
            right: 1.25rem;
            height: 1.5px;
            background: linear-gradient(90deg, transparent, #c5a059, transparent);
        }

        @keyframes fadeInSubmenu {
            from {
                opacity: 0;
                transform: translateY(6px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile Nav Links */
        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 550;
            color: #cbd5e1;
            transition: all 0.2s ease;
        }
        .mobile-nav-link:hover {
            color: #f3e3be;
            background: rgba(197, 160, 89, 0.12);
        }
        .mobile-nav-link.active-mobile-link {
            color: #d4b26f !important;
            font-weight: 600;
            background: rgba(197, 160, 89, 0.08);
        }
    </style>
@endpush
