@extends('front.master')

@section('title', $menu->name . ' | Siap Indonesia')
@section('description', $menu->slogan ?: 'Daftar program pelatihan ' . $menu->name)

@section('content')
    @php
        $setting = \App\Models\FooterSetting::first();
        $baseWaUrl = $setting->whatsapp_url ?? 'https://wa.me/628118087899';
        if (str_contains($baseWaUrl, '?')) {
            $baseWaUrl = explode('?', $baseWaUrl)[0];
        }

        $ctaText = 'HUBUNGI KAMI >>';
        $ctaUrl = $baseWaUrl . '?text=' . rawurlencode('Halo Siap Indonesia, saya tertarik dengan Pelatihan ' . $menu->name);
    @endphp
    
    <style>
        /* Prevent slick partner logos from stretching */
        .partner-slick-slider-1 img, .partner-slick-slider-2 img {
            width: auto !important;
            display: inline-block !important;
        }

        /* Spotlight Glow Cards Styling */
        [data-glow-card] {
            --base: 42; /* Gold theme hue */
            --spread: 40;
            --radius: 24;
            --border: 1.5;
            --backdrop: rgba(12, 16, 26, 0.8);
            --backup-border: rgba(197, 160, 89, 0.15);
            --size: 280;
            --outer: 1;
            --border-size: calc(var(--border, 1.5) * 1px);
            --spotlight-size: calc(var(--size, 280) * 1px);
            --hue: calc(var(--base) + (var(--xp, 0) * var(--spread, 0)));
            
            position: relative;
            background-color: var(--backdrop) !important;
            background-image: radial-gradient(
                var(--spotlight-size) var(--spotlight-size) at
                calc(var(--x, 0) * 1px)
                calc(var(--y, 0) * 1px),
                hsl(var(--hue, 42) 70% 55% / 0.08), transparent
            ) !important;
            background-size: calc(100% + (2 * var(--border-size))) calc(100% + (2 * var(--border-size))) !important;
            background-position: 50% 50% !important;
            background-attachment: fixed !important;
            border: var(--border-size) solid var(--backup-border) !important;
        }

        [data-glow-card]::before,
        [data-glow-card]::after {
            pointer-events: none;
            content: "";
            position: absolute;
            inset: calc(var(--border-size) * -1);
            border: var(--border-size) solid transparent;
            border-radius: calc(var(--radius) * 1px);
            background-attachment: fixed;
            background-size: calc(100% + (2 * var(--border-size))) calc(100% + (2 * var(--border-size)));
            background-repeat: no-repeat;
            background-position: 50% 50%;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            mask-composite: exclude;
            transition: opacity 0.5s ease;
        }
        
        [data-glow-card]::before {
            background-image: radial-gradient(
                calc(var(--spotlight-size) * 0.75) calc(var(--spotlight-size) * 0.75) at
                calc(var(--x, 0) * 1px)
                calc(var(--y, 0) * 1px),
                hsl(var(--hue, 42) 80% 60% / 0.55), transparent 100%
            );
            filter: brightness(1.5);
        }
        
        [data-glow-card]::after {
            background-image: radial-gradient(
                calc(var(--spotlight-size) * 0.5) calc(var(--spotlight-size) * 0.5) at
                calc(var(--x, 0) * 1px)
                calc(var(--y, 0) * 1px),
                hsl(42 100% 80% / 0.35), transparent 100%
            );
        }

        /* Hover state shadow */
        [data-glow-card]:hover {
            box-shadow: 0 0 30px rgba(197, 160, 89, 0.12);
        }
    </style>

    <style>
        .custom-navbar-padding {
            padding-top: 125px;
        }
        @media (min-width: 768px) {
            .custom-navbar-padding {
                padding-top: 160px;
            }
        }
    </style>
    <div class="w-full flex-grow flex flex-col bg-[#07090f] mt-0">
        <x-navbar />

        <!-- Hero Section -->
        <div class="relative custom-navbar-padding pb-12 md:pb-20 flex items-center justify-center bg-fixed bg-center bg-cover"
             style="background-image: url('{{ $menu->banner_path ? asset('storage/' . $menu->banner_path) : asset('assets/images/siapindo/carousel-1.webp') }}'); background-position: center top -50px;">
            <div class="bg-black bg-opacity-75 absolute inset-0"></div>
            <div class="relative text-center text-gray-100 z-10 max-w-4xl px-6">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-[#c5a059]/20 border border-[#c5a059]/30 flex items-center justify-center mb-4 shadow-[0_0_20px_rgba(197,160,89,0.25)]">
                    <i class="fas {{ $menu->icon ?: 'fa-graduation-cap' }} text-[#d4b26f] text-2xl"></i>
                </div>
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-black glow-text text-[#d4b26f] font-[Poppins]">
                    {{ $menu->name }}
                </h1>
                @if($menu->slogan)
                    <p class="text-gray-300 mt-3 text-sm md:text-base max-w-2xl mx-auto font-medium leading-relaxed">{{ $menu->slogan }}</p>
                @endif
            </div>
            <!-- Bottom Fade -->
            <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-[#07090f] to-transparent pointer-events-none"></div>
        </div>

        <!-- Listing Cards Grid -->
        <div class="container mx-auto px-5 lg:px-20 max-w-7xl my-16">
            <div class="border-l-4 border-[#c5a059] pl-4 py-1 mb-10">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white font-[Poppins] tracking-tight">
                    Pilih Program Pelatihan
                </h2>
                <p class="text-zinc-400 text-sm mt-2">Daftar pelatihan khusus di bawah bidang keahlian {{ $menu->name }}.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($menu->children()->where('is_active', true)->get() as $child)
                    <div data-glow-card class="group flex flex-col justify-between p-6 sm:p-8 rounded-3xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="relative z-10">
                            <!-- Card Icon / Header -->
                            <div class="w-12 h-12 rounded-xl bg-[#c5a059]/10 border border-[#c5a059]/20 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-[#c5a059]/20 transition-all duration-300">
                                <i class="fas {{ $child->icon ?: 'fa-graduation-cap' }} text-[#d4b26f] text-xl"></i>
                            </div>
                            
                            <!-- Card Title -->
                            <h3 class="text-lg sm:text-xl font-bold text-white group-hover:text-[#d4b26f] transition-colors duration-300 font-[Poppins] mb-3">
                                {{ $child->name }}
                            </h3>
                            
                            <!-- Card Description -->
                            <p class="text-zinc-400 text-sm leading-relaxed mb-6 line-clamp-3">
                                {!! strip_tags($child->slogan ?: $child->description ?: 'Pelatihan ' . $child->name . ' profesional.') !!}
                            </p>
                        </div>

                        <!-- Card Action Button -->
                        <div class="pt-4 border-t border-white/5 relative z-10">
                            <a href="{{ route('front.program', $child->slug) }}" 
                               class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-widest text-[#c5a059] group-hover:text-[#d4b26f] transition-colors duration-300">
                                <span>Lihat Detail Program</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transform group-hover:translate-x-2 transition-transform duration-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Pointer sync script --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const syncPointer = (e) => {
                    const { clientX: x, clientY: y } = e;
                    const cards = document.querySelectorAll('[data-glow-card]');
                    cards.forEach(card => {
                        card.style.setProperty('--x', x.toFixed(2));
                        card.style.setProperty('--xp', (x / window.innerWidth).toFixed(2));
                        card.style.setProperty('--y', y.toFixed(2));
                        card.style.setProperty('--yp', (y / window.innerHeight).toFixed(2));
                    });
                };
                document.addEventListener('pointermove', syncPointer);
            });
        </script>

        <!-- Testimonials Section -->
        <x-testimonial />

        <!-- Partners / Clients Section -->
        <x-our-client :partners="$partners" :show-button="false" :limit="18" />

        <!-- Bottom CTA Button -->
        <section class="py-16 text-center bg-gradient-to-b from-transparent to-[#c5a059]/10 border-t border-[#c5a059]/10">
            <div class="max-w-3xl mx-auto px-5">
                <h2 class="text-2xl md:text-3xl font-extrabold text-white font-[Poppins] mb-6 leading-tight">
                    Dapatkan Informasi & Penawaran Terbaik<br class="hidden sm:inline"> dengan Menghubungi Kami
                </h2>
                <a href="{{ $ctaUrl }}"
                   target="_blank"
                   class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-white font-extrabold text-sm uppercase tracking-widest rounded-full shadow-[0_4px_25px_rgba(16,185,129,0.3)] hover:shadow-[0_4px_35px_rgba(16,185,129,0.6)] hover:-translate-y-1 transition duration-300">
                    {{ $ctaText }}
                </a>
            </div>
        </section>

        <div class="mt-auto w-full">
            <x-footer />
        </div>
    </div>
@endsection


