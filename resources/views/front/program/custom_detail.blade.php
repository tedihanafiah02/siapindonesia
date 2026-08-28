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

        $ctaText = $menu->cta_text ?: 'HUBUNGI KAMI >>';
        $ctaUrl = $menu->cta_url ?: ($baseWaUrl . '?text=' . rawurlencode('Halo Siap Indonesia, saya tertarik dengan Pelatihan ' . ($menu->title ?: $menu->name)));
    @endphp
    
    <style>
        /* Rich Text Styling */
        .rich-text-content ul {
            list-style-type: disc !important;
            margin-left: 1.5rem !important;
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
        }
        .rich-text-content ol {
            list-style-type: decimal !important;
            margin-left: 1.5rem !important;
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
        }
        .rich-text-content li {
            margin-bottom: 0.25rem !important;
            color: #d1d5db !important; /* text-zinc-300 */
        }
        .rich-text-content p {
            margin-bottom: 0.75rem !important;
            color: #d1d5db !important; /* text-zinc-300 */
            line-height: 1.7 !important;
        }
        .rich-text-content strong {
            color: #fbbf24 !important; /* amber-400 */
            font-weight: 700 !important;
        }
        .rich-text-content a {
            color: #fbbf24 !important;
            text-decoration: underline !important;
        }

        /* Prevent slick partner logos from stretching */
        .partner-slick-slider-1 img, .partner-slick-slider-2 img {
            width: auto !important;
            display: inline-block !important;
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
        @keyframes aurora-blob-3 {
            0% { transform: translate(0px, 0px) scale(1) rotate(0deg); }
            40% { transform: translate(80px, 80px) scale(0.85) rotate(90deg); }
            80% { transform: translate(-60px, -40px) scale(1.1) rotate(270deg); }
            100% { transform: translate(0px, 0px) scale(1) rotate(360deg); }
        }

        .animate-aurora-blob-1 {
            animation: aurora-blob-1 20s infinite alternate ease-in-out;
        }
        .animate-aurora-blob-2 {
            animation: aurora-blob-2 25s infinite alternate ease-in-out;
        }
        .animate-aurora-blob-3 {
            animation: aurora-blob-3 22s infinite alternate ease-in-out;
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
    <div class="w-full flex-grow flex flex-col bg-[#07090f]">
        <x-navbar />

        <!-- Modern Header Section with Animated Gold Aurora -->
        <div class="relative custom-navbar-padding pb-16 md:pb-24 overflow-hidden border-b border-[#c5a059]/10 bg-gradient-to-b from-[#0a0d18] via-[#07090f] to-[#07090f]">
            
            <!-- Animated Aurora Fluid Background -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-60">
                <!-- Gold Fluid Blob 1 -->
                <div class="absolute top-[-20%] left-[-10%] w-[500px] h-[500px] rounded-full bg-gradient-to-br from-[#c5a059]/15 to-[#aa7c11]/5 blur-[120px] animate-aurora-blob-1"></div>
                <!-- Amber Fluid Blob 2 -->
                <div class="absolute bottom-[-20%] right-[-10%] w-[600px] h-[600px] rounded-full bg-gradient-to-tr from-amber-500/10 to-transparent blur-[140px] animate-aurora-blob-2"></div>
                <!-- Contrast Deep Blue/Purple Fluid Blob 3 -->
                <div class="absolute top-[20%] right-[20%] w-[450px] h-[450px] rounded-full bg-gradient-to-bl from-indigo-500/5 to-transparent blur-[130px] animate-aurora-blob-3"></div>
            </div>

            <div class="container mx-auto px-5 lg:px-20 max-w-7xl relative z-10 text-center flex flex-col items-center gap-6">
                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-[#c5a059]/10 border border-[#c5a059]/30 rounded-full text-xs font-bold text-[#d4b26f] uppercase tracking-widest">
                    Detail Program Pelatihan
                </span>
                
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-black bg-gradient-to-r from-white via-zinc-100 to-[#d4b26f] bg-clip-text text-transparent font-[Poppins] tracking-tight leading-tight max-w-4xl">
                    {{ $menu->title ?: $menu->name }}
                </h1>

                <!-- Rating -->
                <div class="flex items-center justify-center gap-2">
                    <div class="flex gap-1 text-[#d4b26f] text-sm">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="text-xs text-zinc-400 font-semibold">4.8/5 - (12 ulasan mitra)</span>
                </div>

                <!-- Share Button Section -->
                <div class="flex items-center justify-center gap-3 bg-white/5 border border-white/10 px-4 py-2 rounded-full backdrop-blur-md">
                    <span class="text-zinc-400 text-[10px] font-bold uppercase tracking-wider">Bagikan:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="text-zinc-400 hover:text-[#1877f2] transition-colors text-sm" aria-label="Share on Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($menu->title ?: $menu->name) }}" target="_blank" class="text-zinc-400 hover:text-[#1da1f2] transition-colors text-sm" aria-label="Share on Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($menu->title ?: $menu->name) }}" target="_blank" class="text-zinc-400 hover:text-[#0a66c2] transition-colors text-sm" aria-label="Share on LinkedIn">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode(($menu->title ?: $menu->name) . ' - ' . url()->current()) }}" target="_blank" class="text-zinc-400 hover:text-[#25d366] transition-colors text-sm" aria-label="Share on WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Detail Container -->
        <div class="container mx-auto px-5 lg:px-20 max-w-7xl py-16">
            <!-- Centered Banner Image -->
            @if($menu->banner_path)
                <div class="max-w-4xl mx-auto rounded-3xl overflow-hidden border border-yellow-500/10 mb-12 shadow-[0_15px_40px_rgba(0,0,0,0.6)]">
                    <img src="{{ asset('storage/' . $menu->banner_path) }}" alt="{{ $menu->title ?: $menu->name }} Banner" class="w-full h-auto max-h-[500px] object-cover">
                </div>
            @endif

            <!-- Main Content Area -->
            <div class="max-w-4xl mx-auto space-y-12 text-zinc-300">
                
                {{-- Latar Belakang --}}
                @if($menu->background)
                    <section class="space-y-4">
                        <h2 class="text-xl sm:text-2xl font-bold text-white font-[Poppins] border-b border-white/5 pb-2">
                            Latar Belakang {{ $menu->name }}
                        </h2>
                        <div class="rich-text-content">
                            {!! $menu->background !!}
                        </div>
                    </section>
                @endif

                {{-- Tujuan Pelatihan --}}
                @if($menu->objectives)
                    <section class="space-y-4">
                        <h2 class="text-xl sm:text-2xl font-bold text-white font-[Poppins] border-b border-white/5 pb-2">
                            Tujuan Pelatihan {{ $menu->name }}
                        </h2>
                        <div class="rich-text-content pl-1">
                            {!! $menu->objectives !!}
                        </div>
                    </section>
                @endif

                {{-- Garis Besar (Materi) --}}
                @if($menu->syllabus)
                    <section class="space-y-4">
                        <h2 class="text-xl sm:text-2xl font-bold text-white font-[Poppins] border-b border-white/5 pb-2">
                            Garis Besar {{ $menu->name }} Training Program
                        </h2>
                        <div class="rich-text-content pl-1">
                            {!! $menu->syllabus !!}
                        </div>
                    </section>
                @endif

                {{-- Fasilitas Online --}}
                @if($menu->facilities_online)
                    <section class="space-y-4">
                        <h2 class="text-xl sm:text-2xl font-bold text-white font-[Poppins] border-b border-white/5 pb-2 flex items-center gap-2">
                            <i class="fas fa-desktop text-yellow-500 text-lg"></i> Fasilitas Online Training [Webinar]
                        </h2>
                        <div class="rich-text-content">
                            {!! $menu->facilities_online !!}
                        </div>
                    </section>
                @endif

                {{-- Fasilitas Offline --}}
                @if($menu->facilities_offline)
                    <section class="space-y-4">
                        <h2 class="text-xl sm:text-2xl font-bold text-white font-[Poppins] border-b border-white/5 pb-2 flex items-center gap-2">
                            <i class="fas fa-building text-yellow-500 text-lg"></i> Fasilitas Offline Training
                        </h2>
                        <div class="rich-text-content">
                            {!! $menu->facilities_offline !!}
                        </div>
                    </section>
                @endif

                {{-- Jadwal & Investasi --}}
                <section class="space-y-4">
                    <h2 class="text-xl sm:text-2xl font-bold text-white font-[Poppins] border-b border-white/5 pb-2">
                        Jadwal & Investasi Training
                    </h2>
                    <p class="text-zinc-300 text-sm sm:text-base">
                        Silahkan <a href="{{ $ctaUrl }}" target="_blank" class="text-yellow-500 font-bold hover:underline">hubungi kami</a> untuk mendapatkan jadwal terupdate dan penawaran investasi terbaik.
                    </p>
                </section>

                {{-- Pendaftaran & Informasi --}}
                <section class="p-5 sm:p-6 bg-[#0d1020] border border-[#c5a059]/20 rounded-2xl shadow-lg space-y-3">
                    <h3 class="text-base sm:text-lg font-bold text-white font-[Poppins] leading-snug">
                        Pendaftaran Training & Informasi Lebih Lanjut
                    </h3>
                    <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed">
                        Hubungi tim admin marketing kami melalui tautan di bawah ini:
                    </p>
                    <div class="flex flex-col gap-2.5 sm:flex-row sm:items-center sm:gap-2 text-xs sm:text-sm">
                        <span class="text-zinc-500 font-medium">Admin Marketing Ke WhatsApp:</span>
                        <a href="{{ $ctaUrl }}" target="_blank" class="inline-flex items-center gap-1.5 font-extrabold text-green-500 hover:text-green-400 transition-colors bg-green-500/5 hover:bg-green-500/10 px-3 py-2 rounded-xl border border-green-500/10 self-start sm:p-0 sm:bg-transparent sm:border-none sm:self-auto">
                            <i class="fab fa-whatsapp text-sm sm:text-base"></i>
                            <span>{{ $waNumberDisplay }}</span>
                            <span class="text-[10px] sm:text-xs text-zinc-400 font-medium">(Klik untuk Chat)</span>
                        </a>
                    </div>
                </section>
            </div>
        </div>

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


