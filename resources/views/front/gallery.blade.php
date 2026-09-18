@extends('front.master')

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

        <!-- Hero Section dengan Parallax -->
        <div class="relative custom-navbar-padding pb-12 md:pb-20 flex items-center justify-center bg-cover bg-center overflow-hidden"
            style="background-image: url('{{ asset('assets/images/siapindo/carousel-1.webp') }}');">
            <!-- Glassmorphic overlay gradient -->
            <div class="absolute inset-0 bg-gradient-to-b from-[#0b0e14]/90 via-[#0b0e14]/50 to-[#0b0e14] z-0"></div>
            
            <div class="relative text-center text-zinc-100 z-10 max-w-2xl px-4 mt-0">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 bg-[#c5a059]/10 border border-[#c5a059]/30 rounded-full text-[10px] font-extrabold tracking-wider text-[#d4b26f] uppercase mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#c5a059] animate-pulse"></span>
                    Dokumentasi Visual
                </span>
                <h1 class="text-3xl sm:text-4xl md:text-6xl font-black font-[Poppins] tracking-tight text-white leading-none">
                    Galeri <span class="bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent">Kegiatan</span>
                </h1>
                <p class="text-zinc-300 mt-3 text-xs sm:text-sm md:text-base leading-relaxed max-w-lg mx-auto">
                    Dokumentasi pelaksanaan kegiatan diklat, bimbingan teknis (bimtek), dan in-house training oleh Siap Indonesia.
                </p>
            </div>
            
            <!-- Elegant bottom light effect -->
            <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-[#0b0e14] to-transparent pointer-events-none"></div>
        </div>

        <!-- Gallery Section -->
        <div class="container mx-auto px-5 lg:px-20 mt-8 mb-16 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                
                <!-- Left Column: Gallery Grid (8 cols) -->
                <div class="lg:col-span-8 order-1 space-y-8">
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-[#c5a059]/10 border border-[#c5a059]/30 rounded-full text-xs font-bold text-[#d4b26f] uppercase tracking-widest mb-2">
                            Dokumentasi Resmi
                        </span>
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-black bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent font-[Poppins] tracking-tight">
                            Galeri Dokumentasi
                        </h2>
                    </div>
                    <p class="text-zinc-400 text-sm sm:text-base leading-relaxed">
                        Kumpulan foto dokumentasi interaktif dari berbagai sesi pelatihan yang telah sukses kami selenggarakan:
                    </p>

                    @if($galleries->isEmpty())
                        <div class="py-16 px-4 bg-[#0c101a] border border-white/5 rounded-[24px] text-center shadow-lg">
                            <svg class="w-16 h-16 text-zinc-600 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                            </svg>
                            <h2 class="text-xl font-bold font-[Poppins] text-white">Belum Ada Dokumentasi</h2>
                            <p class="text-xs text-zinc-500 mt-1 max-w-sm mx-auto">Kami sedang mengunggah dokumentasi kegiatan terbaru kami.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                            @foreach ($galleries as $gallery)
                                <div class="group relative overflow-hidden rounded-[24px] border border-white/10 bg-slate-900/50 shadow-xl hover:shadow-[0_12px_40px_rgba(197,160,89,0.18)] hover:border-[#c5a059]/50 transition-all duration-500 transform hover:-translate-y-1.5 aspect-[4/3] cursor-pointer">
                                    <a data-fancybox="gallery" href="{{ asset('storage/' . $gallery->image_path) }}" data-caption="{{ $gallery->alt_text }}">
                                        <!-- Image -->
                                        <img class="w-full h-full object-cover transform scale-100 group-hover:scale-110 transition-transform duration-700 ease-out" 
                                             src="{{ asset('storage/' . $gallery->image_path) }}" 
                                             alt="{{ $gallery->alt_text }}" />
                                        
                                        <!-- Soft Dark Overlay -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-5 z-10">
                                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 ease-out">
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-[#c5a059]/20 border border-[#c5a059]/40 rounded-full text-[9px] font-bold text-[#d4b26f] uppercase tracking-widest mb-2 shadow-sm">
                                                    Dokumentasi
                                                </span>
                                                <p class="text-xs font-bold text-white line-clamp-2 leading-snug font-[Poppins]">
                                                    {{ $gallery->alt_text ?? 'Dokumentasi Training Siap Indonesia' }}
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <!-- Zoom Icon Tag -->
                                        <div class="absolute top-4 right-4 w-9 h-9 rounded-full bg-slate-950/80 backdrop-blur-md border border-white/20 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-75 group-hover:scale-100 shadow-md z-20">
                                            <i class="fas fa-search-plus text-xs text-[#d4b26f]"></i>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right Column: Sidebar (4 cols) -->
                <div class="lg:col-span-4 order-2 space-y-6">
                    
                    <!-- Menu Navigasi Sidebar -->
                    <div class="bg-[#0c101a] border border-white/5 shadow-xl rounded-2xl p-6">
                        <h3 class="text-lg font-bold text-zinc-100 mb-4 border-b border-white/5 pb-3 font-[Poppins]">
                            Menu Navigasi
                        </h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('front.beranda') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-[#d4b26f] hover:bg-white/5 transition duration-300">
                                    <i class="fas fa-home text-sm w-5 text-center"></i>
                                    <span>Beranda</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('front.profil') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-[#d4b26f] hover:bg-white/5 transition duration-300">
                                    <i class="fas fa-user text-sm w-5 text-center"></i>
                                    <span>Profil Lembaga</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('front.visimisi') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-[#d4b26f] hover:bg-white/5 transition duration-300">
                                    <i class="fas fa-bullseye text-sm w-5 text-center"></i>
                                    <span>Visi & Misi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('front.partner') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-[#d4b26f] hover:bg-white/5 transition duration-300">
                                    <i class="fas fa-handshake text-sm w-5 text-center"></i>
                                    <span>Our Client</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('front.gallery') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#c5a059]/20 to-amber-500/10 border border-[#c5a059]/30 text-[#d4b26f] font-bold">
                                    <i class="fas fa-images text-sm w-5 text-center"></i>
                                    <span>Galeri Kegiatan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('front.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-[#d4b26f] hover:bg-white/5 transition duration-300">
                                    <i class="fas fa-newspaper text-sm w-5 text-center"></i>
                                    <span>Berita Terkini</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Hubungi Konsultan WA Card -->
                    <div class="bg-gradient-to-br from-[#c5a059]/15 via-slate-900/40 to-transparent border border-[#c5a059]/20 shadow-xl rounded-2xl p-6 text-center relative overflow-hidden group">
                        <div class="absolute -right-10 -top-10 w-24 h-24 bg-[#c5a059]/10 rounded-full blur-2xl group-hover:bg-[#c5a059]/20 transition duration-500"></div>
                        <h3 class="text-base sm:text-lg font-bold text-zinc-100 mb-2 font-[Poppins]">Hubungi Konsultan Kami</h3>
                        <p class="text-xs text-zinc-400 mb-5 leading-relaxed">Konsultasikan kebutuhan diklat, bimtek khusus, atau in-house training instansi Anda secara gratis.</p>
                        <a href="{{ $baseWaUrl }}?text=Halo%20Admin%20Siap%20Indonesia,%20saya%20tertarik%20untuk%20konsultasi%20galeri%20dan%20pelatihan" target="_blank"
                            class="w-full justify-center bg-[#10b981] hover:bg-[#059669] text-white font-extrabold text-xs uppercase tracking-wider py-3.5 px-6 rounded-full inline-flex items-center gap-2 shadow-lg shadow-emerald-500/10 hover:shadow-emerald-500/20 hover:scale-[1.02] transition-all duration-300">
                            <i class="fab fa-whatsapp text-lg"></i> Hubungi via WhatsApp
                        </a>
                    </div>

                </div>

            </div>
        </div>

        <div class="mt-auto w-full">
            <x-footer />
        </div>
    </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/filament/style.css') }}">
    <style>
        /* Custom fancybox transition override for smoother visual appearance */
        .fancybox-container {
            font-family: 'Poppins', sans-serif;
        }
        .fancybox-bg {
            background: rgba(8, 10, 15, 0.95) !important;
        }
    </style>
@endpush

@push('after-scripts')
    <script>
        $(document).ready(function(){
            $('[data-fancybox="gallery"]').fancybox({
                transitionEffect: "zoom-in-out",
                transitionDuration: 500,
                animationEffect: "zoom",
                animationDuration: 400,
                buttons: [
                    "zoom",
                    "slideShow",
                    "fullScreen",
                    "close"
                ]
            });
        });
    </script>
@endpush
