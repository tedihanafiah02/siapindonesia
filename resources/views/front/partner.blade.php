@extends('front.master')

@section('title', 'Our Client | Siap Indonesia')
@section('description', 'Daftar client, instansi pemerintah, BUMN, dan korporasi swasta yang telah bekerja sama dengan Siap Indonesia.')
@section('keywords', 'our client, client siap indonesia, bimtek, mitra pelatihan, instansi pemerintah daerah')

@section('content')
    @php
        $setting = \App\Models\FooterSetting::first();
        $baseWaUrl = $setting->whatsapp_url ?? 'https://wa.me/628118087899';
    @endphp

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
    <div class="w-full flex-grow flex flex-col mt-0">
        <x-navbar />

        <!-- Hero Section -->
        <div class="relative custom-navbar-padding pb-14 md:pb-20 flex items-center justify-center overflow-hidden"
            style="background-image: url('{{ asset('assets/images/siapindo/carousel-1.webp') }}'); background-size: cover; background-position: center;">
            <!-- Deep overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-[#07090f]/95 via-[#07090f]/70 to-[#07090f] z-0"></div>
            <!-- Grid pattern -->
            <div class="absolute inset-0 z-0" style="background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px); background-size: 60px 60px;"></div>
            <!-- Gold ambient glow -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-[#c5a059]/5 rounded-full blur-[100px] z-0 pointer-events-none"></div>

            <div class="relative text-center text-zinc-100 z-10 max-w-2xl px-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-[#c5a059]/10 border border-[#c5a059]/25 rounded-full mb-5">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#c5a059] animate-pulse shadow-[0_0_8px_rgba(197,160,89,0.6)]"></span>
                    <span class="text-[10px] font-bold tracking-widest text-[#d4b26f] uppercase">Jejaring Kemitraan</span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-6xl font-black font-[Poppins] tracking-tight text-white leading-none">
                    Our <span class="bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent">Client</span>
                </h1>
                <p class="text-zinc-400 mt-4 text-sm md:text-base leading-relaxed max-w-lg mx-auto">
                    Kementerian, Pemerintah Daerah, BUMN, BUMD, serta Korporasi Swasta yang mempercayakan pengembangan SDM-nya kepada kami.
                </p>
                <!-- Decorative stat pills -->
                <div class="flex items-center justify-center gap-4 mt-8 flex-wrap">
                    <div class="flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-full backdrop-blur-md">
                        <span class="text-base font-black text-white">500<span class="text-[#c5a059]">+</span></span>
                        <span class="text-[11px] text-zinc-400">Instansi</span>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-full backdrop-blur-md">
                        <span class="text-base font-black text-white">15<span class="text-[#c5a059]">+</span></span>
                        <span class="text-[11px] text-zinc-400">Tahun</span>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-full backdrop-blur-md">
                        <span class="text-base font-black text-white">34</span>
                        <span class="text-[11px] text-zinc-400">Provinsi</span>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-[#07090f] to-transparent pointer-events-none"></div>
        </div>

        <!-- partner kami Section -->
        <section class="py-12 md:py-16 bg-[#07090f] relative z-10">
            <div class="container mx-auto px-5 lg:px-20">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                    
                    <!-- Left Column: Partner Logos Grid (8 cols) -->
                    <div class="lg:col-span-8 order-1 space-y-8">
                        <div class="border-l-4 border-[#c5a059] pl-5 py-1">
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white font-[Poppins] tracking-tight">
                                Our Client
                            </h2>
                            <p class="text-zinc-400 text-sm mt-2 leading-relaxed">
                                Kami bangga mendukung ribuan staf dan profesional dari berbagai client di bawah ini.
                            </p>
                        </div>
 
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-4">
                            @forelse ($partners as $partner)
                                <div class="partner-logo-card group">
                                    <div class="partner-logo-inner">
                                        <img src="{{ asset('storage/' . $partner->logo_path) }}"
                                            alt="{{ $partner->alt_text ?? $partner->name }}"
                                            class="partner-logo-img"
                                            loading="lazy">
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full py-16 px-4 bg-[#0d1020] border border-white/5 rounded-[24px] text-center">
                                    <p class="text-zinc-500 text-sm">Client sedang diperbarui.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
 
                    <!-- Right Column: Sidebar (4 cols) -->
                    <div class="lg:col-span-4 order-2 space-y-6 lg:sticky lg:top-24">
                        
                        <!-- Menu Navigasi Sidebar -->
                        <div class="bg-[#0d1020] border border-white/5 shadow-xl rounded-2xl p-6">
                            <h3 class="text-sm font-bold text-zinc-100 mb-4 border-b border-white/5 pb-3 font-[Poppins] uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-compass text-[#c5a059] text-xs"></i>
                                Menu Navigasi
                            </h3>
                            <ul class="space-y-1">
                                <li>
                                    <a href="{{ route('front.beranda') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-[#d4b26f] hover:bg-white/5 transition duration-300 text-sm">
                                        <i class="fas fa-home text-xs w-4 text-center"></i>
                                        <span>Beranda</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('front.profil') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-[#d4b26f] hover:bg-white/5 transition duration-300 text-sm">
                                        <i class="fas fa-user text-xs w-4 text-center"></i>
                                        <span>Profil Lembaga</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('front.visimisi') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-[#d4b26f] hover:bg-white/5 transition duration-300 text-sm">
                                        <i class="fas fa-bullseye text-xs w-4 text-center"></i>
                                        <span>Visi & Misi</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('front.partner') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#c5a059]/10 to-transparent border border-[#c5a059]/20 text-[#d4b26f] font-bold text-sm">
                                        <i class="fas fa-handshake text-xs w-4 text-center"></i>
                                        <span>Our Client</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('front.gallery') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-[#d4b26f] hover:bg-white/5 transition duration-300 text-sm">
                                        <i class="fas fa-images text-xs w-4 text-center"></i>
                                        <span>Galeri Kegiatan</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('front.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-[#d4b26f] hover:bg-white/5 transition duration-300 text-sm">
                                        <i class="fas fa-newspaper text-xs w-4 text-center"></i>
                                        <span>Berita Terkini</span>
                                    </a>
                                </li>
                            </ul>
                        </div>



                        <!-- LATEST NEWS / BERITA TERKINI CARD -->
                        <div class="bg-[#0c101a] border border-white/5 rounded-3xl p-6 shadow-2xl">
                            <h3 class="text-sm font-bold text-zinc-100 uppercase tracking-wider font-[Poppins] mb-6 flex items-center gap-2">
                                <i class="fas fa-newspaper text-yellow-500"></i>
                                Berita Terkini
                            </h3>
                            
                            <div class="space-y-4">
                                @if($latestNews->isEmpty())
                                    <p class="text-zinc-500 text-xs text-center py-6">Belum ada artikel terbaru.</p>
                                @else
                                    @foreach($latestNews->take(3) as $news)
                                        <div class="group flex gap-3 items-center p-2 rounded-xl border border-white/5 bg-slate-900/20 hover:border-yellow-500/20 hover:bg-slate-900/40 transition-all duration-300">
                                            <div class="w-16 h-14 rounded-lg overflow-hidden shrink-0 border border-white/5 img-zoom-parent">
                                                <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->name }}" class="w-full h-full object-cover img-zoom-child">
                                            </div>
                                            <div class="min-w-0 flex-grow">
                                                <h4 class="text-xs font-bold text-zinc-200 line-clamp-2 group-hover:text-yellow-400 transition-colors leading-snug">
                                                    <a href="{{ route('front.details', $news->slug) }}">{{ $news->name }}</a>
                                                </h4>
                                                <span class="text-[9px] text-zinc-500 block mt-1">
                                                    {{ $news->created_at->format('d M, Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Hubungi Konsultan WA Card -->
                        <div class="relative overflow-hidden rounded-2xl p-6 text-center border border-[#c5a059]/15 shadow-xl group" style="background: linear-gradient(135deg, rgba(197,160,89,0.06) 0%, rgba(13,16,32,0.9) 100%)">
                            <div class="absolute -right-8 -top-8 w-32 h-32 bg-[#c5a059]/8 rounded-full blur-2xl group-hover:bg-[#c5a059]/14 transition duration-700 pointer-events-none"></div>
                            <div class="relative z-10">
                                <div class="w-12 h-12 rounded-full bg-[#c5a059]/10 border border-[#c5a059]/25 flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-headset text-[#c5a059]"></i>
                                </div>
                                <h3 class="text-base font-bold text-zinc-100 mb-2 font-[Poppins]">Konsultasi Gratis</h3>
                                <p class="text-xs text-zinc-400 mb-5 leading-relaxed">Konsultasikan kebutuhan diklat, bimtek, atau in-house training instansi Anda.</p>
                                <a href="{{ $baseWaUrl }}?text=Halo%20Admin%20Siap%20Indonesia,%20saya%20tertarik%20untuk%20konsultasi%20mitra%20pelatihan" target="_blank"
                                    class="w-full justify-center bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-400 hover:to-green-500 text-white font-extrabold text-xs uppercase tracking-wider py-3.5 px-6 rounded-xl inline-flex items-center gap-2 shadow-lg shadow-emerald-900/30 hover:shadow-emerald-700/30 hover:-translate-y-0.5 transition-all duration-300">
                                    <i class="fab fa-whatsapp text-lg"></i> Hubungi via WhatsApp
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- Akhir partner kami Section -->

        <!-- Banner Advertisement Component -->
        <x-banner-ad :bannerads="$bannerads" />

        <div class="mt-auto w-full">
            <x-footer />
        </div>
    </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/filament/style.css') }}">
    <style>
        /* Partner logo grid cards */
        .partner-logo-card {
            aspect-ratio: 2 / 1;
        }
        .partner-logo-inner {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 1.25rem;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }
        .partner-logo-inner::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 50%;
            background: linear-gradient(180deg, rgba(255,255,255,0.025) 0%, transparent 100%);
            border-radius: 14px 14px 0 0;
            pointer-events: none;
        }
        .partner-logo-card:hover .partner-logo-inner {
            background: rgba(197, 160, 89, 0.08);
            border-color: rgba(197, 160, 89, 0.4);
            /* Glowing gold shadow effect on card hover */
            box-shadow: 
                0 0 25px rgba(197, 160, 89, 0.25), 
                0 8px 30px rgba(0, 0, 0, 0.45);
            transform: translateY(-4px);
        }
        .partner-logo-img {
            width: auto;
            height: auto;
            max-height: 38px; /* Mobile size: balanced, not too small, not too large */
            max-width: 95px;
            object-fit: contain;
            /* Bright from the beginning */
            filter: none;
            opacity: 1;
            transition: transform 0.4s ease;
            user-select: none;
            pointer-events: none;
            -webkit-user-drag: none;
        }
        @media (min-width: 640px) {
            .partner-logo-img {
                max-height: 44px; /* Tablet (sm) size */
                max-width: 110px;
            }
        }
        @media (min-width: 768px) {
            .partner-logo-img {
                max-height: 50px; /* Medium desktop (md) size */
                max-width: 130px;
            }
        }
        @media (min-width: 1024px) {
            .partner-logo-img {
                max-height: 56px; /* Large desktop size */
                max-width: 145px;
            }
        }
        .partner-logo-card:hover .partner-logo-img {
            transform: scale(1.05);
        }
    </style>
@endpush

@push('after-scripts')
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
@endpush
