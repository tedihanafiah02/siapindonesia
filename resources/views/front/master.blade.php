<!DOCTYPE html>

<head>
    <!-- Basic Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Dynamic SEO -->
    <title>@yield('title', 'Siap Indonesia | Konsultan Keprotokolan Profesional')</title>
    <meta name="description" content="@yield('description', 'Konsultan keprotokolan, pelatihan SDM, dan pengembangan profesional untuk instansi pemerintah dan perusahaan.')">
    <meta name="keywords" content="@yield('keywords', 'konsultan protokol, pelatihan SDM, public speaking, grooming profesional')">

    <!-- Canonical & Robots -->
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="robots" content="@yield('robots', 'index, follow')">

    <!-- OpenGraph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', 'Siap Indonesia | Konsultan Keprotokolan')">
    <meta property="og:description" content="@yield('og_description', 'Konsultan profesional untuk pelatihan keprotokolan dan pengembangan SDM.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Siap Indonesia">
    <meta property="og:image" content="@yield('og_image', asset('assets/images/og-default.webp'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Siap Indonesia | Konsultan Keprotokolan')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Konsultan profesional untuk pelatihan keprotokolan dan pengembangan SDM.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('assets/images/og-default.webp'))">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/siapindo/logo-siapindo.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/apple-touch-icon.png') }}">

    <!-- CSS & Fonts -->
    @stack('before-styles')
    <!-- Preconnect CDNs & Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Load modern Inter and Poppins fonts simultaneously with display=swap -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;700;800;900&display=swap" rel="stylesheet">
    @stack('after-styles')

    <!-- Schema.org Structured Data -->
    @yield('schema')

    <!-- Stylesheets only (Non-rendering blocking, scripts moved to body bottom) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />

    @stack('after-styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/filament/style.css') }}">
</head>

<body class="bg-[#07090f] text-slate-100 font-[Poppins] antialiased min-h-screen flex flex-col">
    <!-- Dynamic SPA Content Container -->
    <div id="app-container" class="flex flex-col min-h-screen flex-grow">
        @yield('content')
        @stack('before-scripts')
        @stack('after-scripts')
    </div>

    {{-- fitur wa admin --}}
    <!-- WhatsApp Floating Widget (Outside container so it persists state across pages!) -->
    @php
        $globalWaUrl = ($globalSetting->whatsapp_url ?? $setting->whatsapp_url ?? 'https://wa.me/628118087899');
        if (str_contains($globalWaUrl, '?')) {
            $globalWaUrl = explode('?', $globalWaUrl)[0];
        }
    @endphp
    <div class="fixed bottom-5 right-5 z-50 w-[300px] sm:w-[380px] h-14 pointer-events-none">
        <div class="relative w-full h-full overflow-visible">
            
            <!-- Chat Window -->
            <div id="wa-chat-box" class="absolute bottom-0 right-0 w-full bg-[#f0f2f5] border border-slate-200/80 rounded-[24px] shadow-[0_20px_50px_rgba(0,0,0,0.3)] overflow-visible transition-all duration-300 transform translate-y-10 opacity-0 scale-95 pointer-events-none origin-bottom-right">
                
                <!-- Header -->
                <div class="bg-[#00a884] px-5 py-4 flex items-center justify-between rounded-t-[24px] shadow-sm">
                    <div class="flex items-center gap-2.5">
                        <!-- WhatsApp Icon -->
                        <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.004 2c-5.525 0-10 4.475-10 10a9.957 9.957 0 0 0 1.5 5.138L2 22l5.06-1.488a9.946 9.946 0 0 0 4.944 1.291c5.525 0 10-4.477 10-10s-4.475-10-10-10zm0 18a7.962 7.962 0 0 1-4.288-1.223l-.308-.194-2.973.89.89-2.89-.2-.315a8 8 0 1 1 6.879 3.732zm4.59-5.822c-.242-.121-1.437-.707-1.661-.787s-.386-.121-.548.121-.625.787-.766.949-.284.181-.526.06c-.242-.121-1.024-.377-1.951-1.203a7.37 7.37 0 0 1-1.366-1.666c-.144-.242-.016-.373.108-.493s.242-.283.363-.424a1.643 1.643 0 0 0 .242-.403c.08-.162.04-.303-.02-.424s-.548-1.316-.751-1.8c-.198-.472-.398-.406-.548-.414s-.303-.008-.464-.008a.89.89 0 0 0-.64.303c-.218.242-.833.81-.833 1.972s.854 2.288.974 2.448c.121.161 1.681 2.564 4.08 3.592 1.698.732 2.36.785 2.784.694.448-.095 1.437-.586 1.64-1.151s.201-1.048.142-1.151c-.06-.101-.22-.162-.462-.283z"/>
                        </svg>
                        <span class="font-bold text-white text-base tracking-wide">WhatsApp</span>
                    </div>
                    <!-- Close Button -->
                    <button type="button" id="close-wa-chat" class="w-8 h-8 rounded-full bg-black/15 hover:bg-black/25 flex items-center justify-center text-white transition duration-200 focus:outline-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                
                <!-- Body -->
                <div class="px-5 pt-5 pb-9 bg-[#f0f2f5] relative">
                    <!-- Chat Bubble -->
                    <div class="relative bg-white text-slate-700 p-4 rounded-2xl shadow-sm text-xs sm:text-sm leading-relaxed before:content-[''] before:absolute before:-left-2.5 before:bottom-4 before:w-0 before:h-0 before:border-t-[8px] before:border-t-transparent before:border-r-[10px] before:border-r-white before:border-b-[8px] before:border-b-transparent">
                        Halo selamat datang, ada pertanyaan dengan jadwal training-nya? Silahkan chat kami!
                    </div>
                </div>
                
                <!-- Footer -->
                <a href="{{ $globalWaUrl }}?text=Halo%20Admin%20Siap%20Indonesia,%20saya%20tertarik%20untuk%20bertanya%20tentang%20jadwal%20training" target="_blank" class="pointer-events-auto block bg-[#00a884] hover:bg-[#009675] px-5 py-4 transition-all duration-300 rounded-b-[24px] relative overflow-visible">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <!-- Admin Avatar with Overlap and Status Dot -->
                            <div class="relative -mt-9 w-12 h-12 rounded-full border-2 border-white shrink-0 shadow-md bg-white">
                                <img src="{{ asset('assets/images/siapindo/admin-wa.png') }}" class="w-full h-full rounded-full object-cover" alt="Admin Avatar">
                                <span class="absolute bottom-0.5 right-0.5 block h-3 w-3 rounded-full bg-emerald-500 ring-2 ring-white animate-pulse"></span>
                            </div>
                            <div class="text-white leading-normal">
                                <p class="font-bold text-sm">Admin</p>
                                <p class="text-[10px] text-teal-100 font-medium">Marketing</p>
                            </div>
                        </div>
                        <!-- Send/Fly Icon -->
                        <div class="text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 rotate-45 -translate-y-0.5 hover:scale-110 transition-transform duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                        </div>
                    </div>
                </a>
                
            </div>

            <!-- Floating Button -->
            <button type="button" id="toggle-wa-chat" class="absolute bottom-0 right-0 pointer-events-auto bg-[#00a884] text-white rounded-full shadow-[0_10px_25px_-5px_rgba(0,168,132,0.4)] transition-all duration-300 w-14 h-14 flex items-center justify-center hover:shadow-[0_15px_30px_rgba(0,168,132,0.6)] hover:scale-110 focus:outline-none opacity-100 scale-100">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                    <path fill-rule="evenodd" d="M12 1.998a10 10 0 0 0-8.5 15.001L2 22l5.001-1.499A9.956 9.956 0 0 0 12 22c5.523 0 10-4.478 10-10s-4.477-10.002-10-10.002zm0 18a7.96 7.96 0 0 1-4.287-1.223l-.309-.194-2.972.89.889-2.89-.201-.315A8 8 0 1 1 12 19.998zm4.59-5.822c-.242-.121-1.437-.707-1.661-.787s-.386-.121-.548.121c-.162.242-.625.787-.766.949s-.284.181-.526.06c-.242-.121-1.024-.377-1.951-1.203a7.37 7.37 0 0 1-1.366-1.666c-.144-.242-.016-.373.108-.493.11-.107.242-.283.363-.424a1.643 1.643 0 0 0 .242-.403c.08-.162.04-.303-.02-.424s-.548-1.316-.751-1.8c-.198-.472-.398-.406-.548-.414s-.303-.008-.464-.008a.89.89 0 0 0-.64.303c-.218.242-.833.81-.833 1.972s.854 2.288.974 2.448c.121.161 1.681 2.564 4.08 3.592 1.698.732 2.36.785 2.784.694.448-.095 1.437-.586 1.64-1.151s.201-1.048.142-1.151c-.06-.101-.22-.162-.462-.283z" clip-rule="evenodd" />
                </svg>
            </button>
            
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggle-wa-chat');
            const closeBtn = document.getElementById('close-wa-chat');
            const chatBox = document.getElementById('wa-chat-box');

            function toggleChat(show) {
                if (show) {
                    toggleBtn.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                    toggleBtn.classList.add('opacity-0', 'scale-75', 'pointer-events-none');
                    chatBox.classList.remove('pointer-events-none', 'translate-y-10', 'opacity-0', 'scale-95');
                    chatBox.classList.add('translate-y-0', 'opacity-100', 'scale-100', 'pointer-events-auto');
                } else {
                    chatBox.classList.add('pointer-events-none', 'translate-y-10', 'opacity-0', 'scale-95');
                    chatBox.classList.remove('translate-y-0', 'opacity-100', 'scale-100', 'pointer-events-auto');
                    toggleBtn.classList.remove('opacity-0', 'scale-75', 'pointer-events-none');
                    toggleBtn.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');
                }
            }

            toggleBtn.addEventListener('click', () => toggleChat(true));
            closeBtn.addEventListener('click', () => toggleChat(false));
            
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && !chatBox.classList.contains('pointer-events-none')) {
                    toggleChat(false);
                }
            });
        });
    </script>

    <!-- Premium Custom Top Progress Bar & SPA Router -->
    <style>
        #top-progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            width: 0;
            background: linear-gradient(to right, #facc15, #fbbf24, #f59e0b);
            z-index: 99999;
            transition: width 0.4s cubic-bezier(0.08, 0.82, 0.17, 1);
            pointer-events: none;
            box-shadow: 0 0 10px rgba(250, 204, 21, 0.5);
        }
    </style>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Create top progress bar
            const pBar = document.createElement('div');
            pBar.id = 'top-progress-bar';
            document.body.appendChild(pBar);

            const container = document.getElementById('app-container');

            function executeScripts(targetContainer) {
                const scripts = targetContainer.querySelectorAll('script');
                scripts.forEach(oldScript => {
                    if (oldScript.src && oldScript.src.includes('instantpage')) return;
                    
                    const newScript = document.createElement('script');
                    Array.from(oldScript.attributes).forEach(attr => {
                        newScript.setAttribute(attr.name, attr.value);
                    });
                    if (oldScript.src) {
                        newScript.src = oldScript.src;
                    } else {
                        newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                    }
                    oldScript.parentNode.replaceChild(newScript, oldScript);
                });
            }

            function navigateTo(url, pushState = true) {
                pBar.style.width = '30%';
                var progressInterval = setInterval(() => {
                    let w = parseFloat(pBar.style.width);
                    if (w < 85) pBar.style.width = (w + 5) + '%';
                }, 100);

                fetch(url)
                    .then(response => {
                        if (!response.ok) throw new Error('Response not OK');
                        return response.text();
                    })
                    .then(html => {
                        clearInterval(progressInterval);
                        pBar.style.width = '100%';

                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        document.title = doc.title;

                        const newContainer = doc.getElementById('app-container');
                        if (newContainer && container) {
                            container.innerHTML = newContainer.innerHTML;
                            window.scrollTo({ top: 0, behavior: 'instant' });
                            executeScripts(container);
                        } else {
                            window.location.href = url;
                            return;
                        }

                        if (pushState) {
                            history.pushState({ url: url }, doc.title, url);
                        }

                        setTimeout(() => {
                            pBar.style.width = '0%';
                        }, 250);
                    })
                    .catch(err => {
                        clearInterval(progressInterval);
                        pBar.style.width = '0%';
                        window.location.href = url;
                    });
            }

            document.addEventListener('click', function(e) {
                const link = e.target.closest('a');
                if (!link) return;

                if (
                    link.href &&
                    !link.href.includes('#') &&
                    link.target !== "_blank" &&
                    !link.hasAttribute('download') &&
                    !link.hasAttribute('data-fancybox') &&
                    link.hostname === window.location.hostname &&
                    !link.href.includes('/admin') &&
                    !link.href.includes('/storage-link')
                ) {
                    e.preventDefault();
                    navigateTo(link.href);
                }
            });

            window.addEventListener('popstate', function(e) {
                if (e.state && e.state.url) {
                    navigateTo(e.state.url, false);
                } else {
                    navigateTo(window.location.href, false);
                }
            });
        });
    </script>
    
    <!-- Global JS Libraries (Deferred & Loaded at the bottom to prevent render-blocking) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" defer></script>
    
    <!-- Preload links on hover/touch instantly before clicking -->
    <script src="https://cdn.jsdelivr.net/npm/instant.page@5.2.0/instantpage.js" type="module"></script>

</body>
</html>
