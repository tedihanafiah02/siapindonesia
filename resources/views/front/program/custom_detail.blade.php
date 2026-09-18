@extends('front.master')

@section('title', ($menu->title ?: $menu->name) . ' | Siap Indonesia')
@section('description', $menu->slogan)

@section('schema')
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Course",
  "name": "{{ $menu->title ?: $menu->name }}",
  "description": "{{ $menu->slogan }}",
  "provider": {
    "@type": "Organization",
    "name": "Siap Indonesia",
    "sameAs": "{{ url('/') }}"
  }
}
</script>
@endsection

@section('content')
    @php
        $setting = \App\Models\FooterSetting::first();
        $baseWaUrl = $setting->whatsapp_url ?? 'https://wa.me/628118087899';
        if (str_contains($baseWaUrl, '?')) {
            $baseWaUrl = explode('?', $baseWaUrl)[0];
        }

        // Clean WA number for display
        $waNumberDisplay = '0811-8087-899';
        if (preg_match('/wa\.me\/([0-9]+)/', $baseWaUrl, $matches)) {
            $rawNum = $matches[1];
            if (str_starts_with($rawNum, '62')) {
                $waNumberDisplay = '0' . substr($rawNum, 2);
            } else {
                $waNumberDisplay = $rawNum;
            }
        }

        $ctaText = $menu->cta_text ?: 'KONSULTASI SEKARANG VIA WHATSAPP';
        $ctaUrl = $menu->cta_url ?: ($baseWaUrl . '?text=' . rawurlencode('Halo Siap Indonesia, saya tertarik dengan Pelatihan ' . ($menu->title ?: $menu->name)));
    @endphp
    
    <style>
        /* Rich Text Styling Override for High Contrast & Modern Readability */
        .rich-text-content {
            font-size: 0.95rem;
            line-height: 1.8;
            color: #cbd5e1; /* text-slate-300 */
        }
        .rich-text-content ul {
            list-style-type: none !important;
            margin-left: 0 !important;
            margin-top: 0.75rem !important;
            margin-bottom: 0.75rem !important;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }
        .rich-text-content ul li {
            position: relative;
            padding-left: 1.75rem;
            color: #e2e8f0 !important;
        }
        .rich-text-content ul li::before {
            content: '✓';
            position: absolute;
            left: 0;
            top: 0.1rem;
            width: 1.2rem;
            height: 1.2rem;
            background: rgba(197, 160, 89, 0.15);
            border: 1px solid rgba(197, 160, 89, 0.4);
            border-radius: 9999px;
            color: #d4b26f;
            font-size: 0.7rem;
            font-weight: 900;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .rich-text-content ol {
            list-style-type: decimal !important;
            margin-left: 1.5rem !important;
            margin-top: 0.75rem !important;
            margin-bottom: 0.75rem !important;
        }
        .rich-text-content ol li {
            margin-bottom: 0.5rem !important;
            color: #e2e8f0 !important;
        }
        .rich-text-content p {
            margin-bottom: 1rem !important;
            color: #cbd5e1 !important;
        }
        .rich-text-content strong {
            color: #d4b26f !important; /* Royal Gold Accent */
            font-weight: 700 !important;
        }
        .rich-text-content a {
            color: #d4b26f !important;
            text-decoration: underline !important;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .rich-text-content a:hover {
            color: #e6c687 !important;
        }

        /* Parallax Background Effect */
        .parallax-hero-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        @media (max-width: 1024px) {
            .parallax-hero-bg {
                background-attachment: scroll; /* Smooth fallback for mobile/tablets */
            }
        }

        /* Aurora Fluid Gradients Animations */
        @keyframes aurora-blob-1 {
            0% { transform: translate(0px, 0px) scale(1) rotate(0deg); }
            33% { transform: translate(60px, -80px) scale(1.2) rotate(120deg); }
            66% { transform: translate(-40px, 40px) scale(0.9) rotate(240deg); }
            100% { transform: translate(0px, 0px) scale(1) rotate(360deg); }
        }
        @keyframes aurora-blob-2 {
            0% { transform: translate(0px, 0px) scale(1) rotate(0deg); }
            50% { transform: translate(-80px, 60px) scale(1.15) rotate(-180deg); }
            100% { transform: translate(0px, 0px) scale(1) rotate(0deg); }
        }

        .animate-aurora-blob-1 {
            animation: aurora-blob-1 20s infinite alternate ease-in-out;
        }
        .animate-aurora-blob-2 {
            animation: aurora-blob-2 25s infinite alternate ease-in-out;
        }

        .custom-navbar-padding {
            padding-top: 125px;
        }
        @media (min-width: 768px) {
            .custom-navbar-padding {
                padding-top: 160px;
            }
        }
    </style>

    <div class="w-full flex-grow flex flex-col bg-[#07090f] text-slate-100 overflow-hidden">
        <x-navbar />

        <!-- Parallax Hero Header Section -->
        <div class="relative custom-navbar-padding pb-20 md:pb-28 overflow-hidden border-b border-[#c5a059]/15 parallax-hero-bg"
             style="background-image: linear-gradient(to bottom, rgba(7, 9, 15, 0.4), rgba(7, 9, 15, 0.75)), url('{{ asset('assets/images/siapindo/carousel-1.webp') }}');">
            
            <!-- Animated Aurora Ambient Background -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-40">
                <div class="absolute top-[-10%] left-[-5%] w-[600px] h-[600px] rounded-full bg-gradient-to-br from-[#c5a059]/20 to-[#aa7c11]/5 blur-[140px] animate-aurora-blob-1"></div>
                <div class="absolute bottom-[-10%] right-[-5%] w-[700px] h-[700px] rounded-full bg-gradient-to-tr from-amber-500/10 to-transparent blur-[160px] animate-aurora-blob-2"></div>
            </div>

            <div class="container mx-auto px-5 lg:px-20 max-w-7xl relative z-10 text-center flex flex-col items-center gap-6">
                <!-- Top Badge Pill -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-[#c5a059]/15 border border-[#c5a059]/35 rounded-full text-xs font-bold text-[#d4b26f] uppercase tracking-widest backdrop-blur-md shadow-lg">
                    <span class="w-2 h-2 rounded-full bg-[#c5a059] animate-pulse"></span>
                    Program Diklat & Bimtek SDM Unggul
                </div>
                
                <!-- Main Program Title -->
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black bg-gradient-to-r from-white via-slate-100 to-[#d4b26f] bg-clip-text text-transparent font-[Poppins] tracking-tight leading-tight max-w-4xl drop-shadow-sm">
                    {{ $menu->title ?: $menu->name }}
                </h1>

                <!-- Slogan / Subtitle -->
                @if($menu->slogan)
                <p class="text-zinc-300 max-w-2xl text-sm sm:text-base md:text-lg leading-relaxed">
                    {{ $menu->slogan }}
                </p>
                @endif

                <!-- Rating & Quick Trust Metrics -->
                <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 mt-2 pt-4 border-t border-white/10">
                    <div class="flex items-center gap-2 bg-slate-900/80 border border-white/10 px-4 py-2 rounded-full backdrop-blur-md">
                        <div class="flex text-[#d4b26f] text-xs">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-xs text-zinc-300 font-bold">4.9/5</span>
                        <span class="text-[11px] text-zinc-400 font-medium">(500+ Alumni Instansi)</span>
                    </div>

                    <div class="flex items-center gap-2 bg-slate-900/80 border border-white/10 px-4 py-2 rounded-full backdrop-blur-md">
                        <i class="fas fa-certificate text-emerald-400 text-xs"></i>
                        <span class="text-xs text-zinc-300 font-bold">Sertifikat Bimtek Resmi</span>
                    </div>

                    <div class="flex items-center gap-2 bg-slate-900/80 border border-white/10 px-4 py-2 rounded-full backdrop-blur-md">
                        <i class="fas fa-user-shield text-[#d4b26f] text-xs"></i>
                        <span class="text-xs text-zinc-300 font-bold">Narasumber Pakar/Ahli</span>
                    </div>
                </div>

                <!-- Share Buttons Floating Bar -->
                <div class="flex items-center justify-center gap-3 bg-slate-950/70 border border-white/10 px-4 py-2 rounded-full backdrop-blur-md mt-2">
                    <span class="text-zinc-400 text-[10px] font-bold uppercase tracking-wider">Bagikan:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-7 h-7 rounded-full bg-white/5 flex items-center justify-center text-zinc-400 hover:text-[#1877f2] hover:bg-white/10 transition-all text-xs" aria-label="Share on Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($menu->title ?: $menu->name) }}" target="_blank" class="w-7 h-7 rounded-full bg-white/5 flex items-center justify-center text-zinc-400 hover:text-[#1da1f2] hover:bg-white/10 transition-all text-xs" aria-label="Share on Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($menu->title ?: $menu->name) }}" target="_blank" class="w-7 h-7 rounded-full bg-white/5 flex items-center justify-center text-zinc-400 hover:text-[#0a66c2] hover:bg-white/10 transition-all text-xs" aria-label="Share on LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode(($menu->title ?: $menu->name) . ' - ' . url()->current()) }}" target="_blank" class="w-7 h-7 rounded-full bg-white/5 flex items-center justify-center text-zinc-400 hover:text-[#25d366] hover:bg-white/10 transition-all text-xs" aria-label="Share on WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Detail Content Grid (2 Columns: Left Main Content 8-cols, Right Sticky Form 4-cols) -->
        <div class="container mx-auto px-5 lg:px-20 max-w-7xl py-14 lg:py-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <!-- Left Column (8 Columns: Main Information) -->
                <div class="lg:col-span-8 space-y-10 order-1">

                    <!-- Featured Banner Image Showcase (Bright & Vivid) -->
                    @if($menu->banner_path)
                        <div class="group relative rounded-[28px] overflow-hidden border border-[#c5a059]/40 bg-slate-900/40 shadow-[0_20px_50px_rgba(0,0,0,0.6)] backdrop-blur-xl">
                            <div class="relative overflow-hidden aspect-[16/9] sm:aspect-[21/9] md:aspect-[16/8]">
                                <img src="{{ asset('storage/' . $menu->banner_path) }}" alt="{{ $menu->title ?: $menu->name }} Banner" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out">
                                <div class="absolute bottom-0 inset-x-0 h-24 bg-gradient-to-t from-slate-950/90 to-transparent"></div>
                                <div class="absolute bottom-5 left-6 right-6 flex justify-between items-end z-10">
                                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-slate-950/80 border border-[#c5a059]/40 backdrop-blur-md rounded-full text-[11px] font-bold text-[#d4b26f] uppercase tracking-widest shadow-lg">
                                        <i class="fas fa-camera text-[#d4b26f]"></i>
                                        Dokumentasi Pelatihan Resmi
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Latar Belakang --}}
                    @if($menu->background)
                        <div class="bg-slate-900/80 border border-white/10 hover:border-[#c5a059]/30 rounded-[28px] p-6 sm:p-8 backdrop-blur-xl shadow-2xl transition-all duration-300">
                            <div class="flex items-center gap-3.5 mb-6 border-b border-white/10 pb-4">
                                <div class="w-10 h-10 rounded-2xl bg-[#c5a059]/15 border border-[#c5a059]/30 flex items-center justify-center text-[#d4b26f] shrink-0">
                                    <i class="fas fa-book-open text-base"></i>
                                </div>
                                <div>
                                    <span class="text-[10px] text-[#d4b26f] font-bold uppercase tracking-widest">Pendahuluan & Urgensi</span>
                                    <h2 class="text-xl sm:text-2xl font-bold text-white font-[Poppins]">
                                        Latar Belakang {{ $menu->name }}
                                    </h2>
                                </div>
                            </div>
                            <div class="rich-text-content">
                                {!! $menu->background !!}
                            </div>
                        </div>
                    @endif

                    {{-- Tujuan Pelatihan --}}
                    @if($menu->objectives)
                        <div class="bg-slate-900/80 border border-white/10 hover:border-[#c5a059]/30 rounded-[28px] p-6 sm:p-8 backdrop-blur-xl shadow-2xl transition-all duration-300">
                            <div class="flex items-center gap-3.5 mb-6 border-b border-white/10 pb-4">
                                <div class="w-10 h-10 rounded-2xl bg-[#c5a059]/15 border border-[#c5a059]/30 flex items-center justify-center text-[#d4b26f] shrink-0">
                                    <i class="fas fa-bullseye text-base"></i>
                                </div>
                                <div>
                                    <span class="text-[10px] text-[#d4b26f] font-bold uppercase tracking-widest">Target & Output Pelatihan</span>
                                    <h2 class="text-xl sm:text-2xl font-bold text-white font-[Poppins]">
                                        Tujuan Pelatihan {{ $menu->name }}
                                    </h2>
                                </div>
                            </div>
                            <div class="rich-text-content">
                                {!! $menu->objectives !!}
                            </div>
                        </div>
                    @endif

                    {{-- Garis Besar (Materi/Silabus) --}}
                    @if($menu->syllabus)
                        <div class="bg-slate-900/80 border border-white/10 hover:border-[#c5a059]/30 rounded-[28px] p-6 sm:p-8 backdrop-blur-xl shadow-2xl transition-all duration-300">
                            <div class="flex items-center gap-3.5 mb-6 border-b border-white/10 pb-4">
                                <div class="w-10 h-10 rounded-2xl bg-[#c5a059]/15 border border-[#c5a059]/30 flex items-center justify-center text-[#d4b26f] shrink-0">
                                    <i class="fas fa-layer-group text-base"></i>
                                </div>
                                <div>
                                    <span class="text-[10px] text-[#d4b26f] font-bold uppercase tracking-widest">Materi & Modul Utama</span>
                                    <h2 class="text-xl sm:text-2xl font-bold text-white font-[Poppins]">
                                        Garis Besar Silabus Program
                                    </h2>
                                </div>
                            </div>
                            <div class="rich-text-content">
                                {!! $menu->syllabus !!}
                            </div>
                        </div>
                    @endif

                    {{-- Fasilitas Comparative Section --}}
                    @if($menu->facilities_online || $menu->facilities_offline)
                        <div class="space-y-6">
                            <div class="flex flex-col gap-1">
                                <span class="text-[10px] text-[#d4b26f] font-bold uppercase tracking-widest">Layanan Pelaksanaan</span>
                                <h2 class="text-2xl font-bold text-white font-[Poppins]">Fasilitas Pelatihan Diklat & Bimtek</h2>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                {{-- Online Training Card --}}
                                @if($menu->facilities_online)
                                    <div class="bg-slate-900/80 border border-white/10 hover:border-emerald-500/40 rounded-[24px] p-6 backdrop-blur-xl shadow-xl transition-all duration-300 group">
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="w-9 h-9 rounded-xl bg-emerald-500/15 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                                                <i class="fas fa-desktop text-sm"></i>
                                            </div>
                                            <h3 class="text-base font-bold text-white font-[Poppins]">Fasilitas Online [Webinar]</h3>
                                        </div>
                                        <div class="rich-text-content text-xs leading-relaxed">
                                            {!! $menu->facilities_online !!}
                                        </div>
                                    </div>
                                @endif

                                {{-- Offline Training Card --}}
                                @if($menu->facilities_offline)
                                    <div class="bg-slate-900/80 border border-white/10 hover:border-[#c5a059]/40 rounded-[24px] p-6 backdrop-blur-xl shadow-xl transition-all duration-300 group">
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="w-9 h-9 rounded-xl bg-[#c5a059]/15 border border-[#c5a059]/30 flex items-center justify-center text-[#d4b26f]">
                                                <i class="fas fa-hotel text-sm"></i>
                                            </div>
                                            <h3 class="text-base font-bold text-white font-[Poppins]">Fasilitas Offline [Tatap Muka]</h3>
                                        </div>
                                        <div class="rich-text-content text-xs leading-relaxed">
                                            {!! $menu->facilities_offline !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Right Column (4 Columns: Sticky Quick Action Card & Info) -->
                <div class="lg:col-span-4 space-y-6 order-2 lg:sticky lg:top-28">
                    
                    <!-- Executive Registration & Consultation Card -->
                    <div class="bg-gradient-to-b from-slate-900/95 via-slate-900/90 to-slate-950 border border-[#c5a059]/35 rounded-[32px] p-6 sm:p-8 shadow-[0_20px_50px_rgba(0,0,0,0.9)] backdrop-blur-2xl relative overflow-hidden group">
                        
                        <!-- Ambient Top Glow line -->
                        <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-[#c5a059] to-transparent"></div>
                        <div class="absolute top-[-20%] right-[-20%] w-32 h-32 bg-[#c5a059]/10 rounded-full blur-2xl group-hover:bg-[#c5a059]/20 transition duration-500"></div>

                        <div class="text-center space-y-3 mb-6">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-[#c5a059]/10 border border-[#c5a059]/30 rounded-full text-[10px] font-bold text-[#d4b26f] uppercase tracking-widest">
                                Layanan Resmi Siap Indonesia
                            </span>
                            <h3 class="text-xl font-black text-white font-[Poppins]">
                                Pendaftaran & Penawaran Bimtek
                            </h3>
                            <p class="text-xs text-zinc-400 leading-relaxed">
                                Konsultasikan kebutuhan jadwal, lokasi hotel, serta proposal investasi resmi untuk instansi Anda secara langsung.
                            </p>
                        </div>

                        <!-- Key Value Highlights -->
                        <div class="space-y-3 mb-8">
                            <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/5 text-xs text-zinc-200">
                                <div class="w-7 h-7 rounded-xl bg-emerald-500/15 border border-emerald-500/30 flex items-center justify-center text-emerald-400 shrink-0">
                                    <i class="fas fa-calendar-alt text-xs"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-white">Jadwal Fleksibel</span>
                                    <span class="text-[11px] text-zinc-400">Bisa disesuaikan dengan permintaan instansi</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/5 text-xs text-zinc-200">
                                <div class="w-7 h-7 rounded-xl bg-[#c5a059]/15 border border-[#c5a059]/30 flex items-center justify-center text-[#d4b26f] shrink-0">
                                    <i class="fas fa-map-marker-alt text-xs"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-white">Pilihan Lokasi Pelaksanaan</span>
                                    <span class="text-[11px] text-zinc-400">Jakarta, Bandung, Bali, Jogja, atau In-House</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/5 text-xs text-zinc-200">
                                <div class="w-7 h-7 rounded-xl bg-blue-500/15 border border-blue-500/30 flex items-center justify-center text-blue-400 shrink-0">
                                    <i class="fas fa-file-pdf text-xs"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-white">Proposal & Brosur Resmi</span>
                                    <span class="text-[11px] text-zinc-400">Langsung dikirimkan ke WhatsApp Anda</span>
                                </div>
                            </div>
                        </div>

                        <!-- Main CTA Button -->
                        <div class="space-y-3">
                            <a href="{{ $ctaUrl }}" target="_blank"
                               class="w-full py-4 px-6 bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] text-slate-950 font-black text-xs uppercase tracking-wider rounded-full shadow-[0_8px_25px_rgba(197,160,89,0.3)] hover:shadow-[0_12px_35px_rgba(197,160,89,0.5)] hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                                <i class="fab fa-whatsapp text-base"></i>
                                <span>{{ $ctaText }}</span>
                                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>

                            <div class="text-center pt-2">
                                <span class="text-[11px] text-zinc-400 block font-medium">Customer Service Fast Response:</span>
                                <a href="{{ $ctaUrl }}" target="_blank" class="text-xs font-extrabold text-emerald-400 hover:text-emerald-300 transition-colors inline-flex items-center gap-1.5 mt-1">
                                    <i class="fab fa-whatsapp"></i> {{ $waNumberDisplay }} (Klik untuk Chat)
                                </a>
                            </div>
                        </div>

                    </div>

                    <!-- Direct Fast Links Card -->
                    <div class="bg-slate-900/60 border border-white/5 rounded-[24px] p-5 backdrop-blur-xl">
                        <h4 class="text-xs font-bold text-zinc-300 uppercase tracking-wider mb-3 font-[Poppins]">Navigasi Program Lainnya</h4>
                        <ul class="space-y-2 text-xs">
                            <li>
                                <a href="{{ route('front.jadwalPelatihan') }}" class="flex items-center justify-between p-2.5 rounded-xl bg-white/5 hover:bg-[#c5a059]/15 text-zinc-300 hover:text-[#d4b26f] transition-all font-semibold">
                                    <span>Jadwal Bimtek Terlengkap</span>
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('front.gallery') }}" class="flex items-center justify-between p-2.5 rounded-xl bg-white/5 hover:bg-[#c5a059]/15 text-zinc-300 hover:text-[#d4b26f] transition-all font-semibold">
                                    <span>Dokumentasi Pelatihan</span>
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>

        <!-- Unified Testimonials Section -->
        <x-testimonial />

        <!-- Unified Our Clients Section -->
        @if(isset($partners) && $partners->isNotEmpty())
            <x-our-client :partners="$partners" :show-button="true" :limit="18" />
        @endif

        <!-- Bottom CTA Consultation Banner -->
        <section class="py-20 text-center relative overflow-hidden bg-gradient-to-b from-[#07090f] via-[#0b0e1a] to-[#07090f] border-t border-[#c5a059]/15">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-[#c5a059]/5 rounded-full blur-[140px] pointer-events-none"></div>
            
            <div class="max-w-4xl mx-auto px-5 relative z-10 space-y-6">
                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-[#c5a059]/10 border border-[#c5a059]/30 rounded-full text-xs font-bold text-[#d4b26f] uppercase tracking-widest">
                    Layanan In-House & Customized Training
                </span>
                <h2 class="text-2xl sm:text-4xl md:text-5xl font-black bg-gradient-to-r from-white via-zinc-100 to-[#d4b26f] bg-clip-text text-transparent font-[Poppins] leading-tight">
                    Butuh Penawaran Khusus & Proposal Pelatihan Instansi Anda?
                </h2>
                <p class="text-zinc-400 text-sm sm:text-base max-w-xl mx-auto leading-relaxed">
                    Tim kami siap merancang materi, silabus, dan opsi investasi yang disesuaikan secara presisi dengan kebutuhan SDM instansi Anda.
                </p>
                <div class="pt-4 flex justify-center">
                    <a href="{{ $ctaUrl }}" target="_blank"
                       class="inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] text-slate-950 font-black text-xs uppercase tracking-widest rounded-full shadow-[0_8px_30px_rgba(197,160,89,0.35)] hover:shadow-[0_12px_40px_rgba(197,160,89,0.6)] hover:scale-105 transition-all duration-300">
                        <i class="fab fa-whatsapp text-lg"></i>
                        <span>Hubungi Tim Konsultan Kami</span>
                    </a>
                </div>
            </div>
        </section>

        <div class="mt-auto w-full">
            <x-footer />
        </div>
    </div>
@endsection
