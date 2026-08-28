@extends('front.master')

@php
    $setting = \App\Models\FooterSetting::first();
    $companyName = $setting->company_name ?? 'PT. SIAP INDONESIA GROUP';
    $companySlogan = $setting->company_slogan ?? 'Konsultan Keprotokolan & Pelatihan SDM Resmi';
    $companyPhone = $setting->office_phone ?? '021-1234567';
    $companyMobile = $setting->office_mobile ?? '08118087899';
    $companyEmail = $setting->office_email ?? 'info@siapindonesia.co.id';
    $companyAddress = $setting->office_address ?? 'Jakarta, Indonesia';
@endphp

@section('title', 'Siap Indonesia | Konsultan Keprotokolan & Pelatihan SDM Resmi')
@section('description', 'Layanan konsultasi keprotokolan resmi, bimtek pns, pelatihan MC, table manner, public speaking, grooming, dan sertifikasi SDM profesional untuk instansi pemerintah & swasta terbaik di Indonesia.')
@section('keywords', 'konsultan protokol, pelatihan keprotokolan, bimtek keprotokolan, pelatihan sdm, training grooming, public speaking training, table manner course, bimtek pns, mc profesional, sertifikasi bnsp, siap indonesia group, training protokol pemda, pelatihan humas pemerintah, diklat keprotokolan')

@section('og_title', 'Siap Indonesia - Konsultan Keprotokolan & Pelatihan SDM Terbaik')
@section('og_description', 'Layanan konsultasi keprotokolan resmi, bimtek pns, pelatihan MC, table manner, public speaking, grooming, dan sertifikasi SDM profesional.')
@section('og_image', asset('assets/images/og-beranda.webp'))

@section('schema')
    <script type="application/ld+json">
    [
      {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "{{ $companyName }}",
        "alternateName": "Siap Indonesia",
        "description": "{{ $companySlogan }}",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('assets/images/siapindo/logo-siapindo.png') }}",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "{{ $companyAddress }}",
          "addressLocality": "Jakarta",
          "addressCountry": "ID"
        },
        "contactPoint": [
          {
            "@type": "ContactPoint",
            "telephone": "{{ $companyMobile }}",
            "contactType": "customer service",
            "areaServed": "ID",
            "availableLanguage": ["id", "en"]
          }
        ],
        "sameAs": [
          "{{ $setting->instagram_url ?? 'https://www.instagram.com/siapindonesia.id' }}",
          "{{ $setting->tiktok_url ?? 'https://www.tiktok.com/@siapindonesia' }}"
        ]
      },
      {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
          {
            "@type": "Question",
            "name": "Layanan apa saja yang disediakan oleh SIAP Indonesia?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "SIAP Indonesia menyediakan layanan konsultasi keprotokolan resmi, bimbingan teknis (bimtek), workshop, seminar, in-house training kustom, dan sertifikasi kompetensi SDM untuk instansi pemerintah maupun perusahaan swasta."
            }
          },
          {
            "@type": "Question",
            "name": "Apakah kurikulum pelatihan di SIAP Indonesia bisa disesuaikan?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Ya, kami menyediakan kurikulum kustom untuk program In-House Training yang disesuaikan dengan kebutuhan dan studi kasus spesifik instansi Anda."
            }
          },
          {
            "@type": "Question",
            "name": "Bagaimana cara mendaftar kelas pelatihan?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Pendaftaran dapat dilakukan secara daring melalui tombol pendaftaran di menu Jadwal Pelatihan, yang terhubung langsung dengan WhatsApp Konsultan resmi kami."
            }
          }
        ]
      }
    ]
    </script>
@endsection

@section('content')
    @php
        $baseWaUrl = $setting->whatsapp_url ?? 'https://wa.me/628118087899';
        if (str_contains($baseWaUrl, '?')) {
            $baseWaUrl = explode('?', $baseWaUrl)[0];
        }
    @endphp
    <div class="w-full flex-grow flex flex-col">
        {{-- navbar --}}
        <x-navbar />
        {{-- akhir navbar --}}

        {{-- CAROSEL --}}
        <section class="relative h-screen overflow-hidden bg-[#07090f]">
            {{-- Custom Premium Fade & Ken Burns Zoom Effect --}}
            <style>
                #hero-carousel [data-carousel-item] {
                    display: block !important;
                    position: absolute;
                    inset: 0;
                    opacity: 0;
                    visibility: hidden;
                    transform: none !important;
                    transition: opacity 1.2s cubic-bezier(0.4, 0, 0.2, 1), visibility 1.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
                    z-index: 1;
                }

                /* Show slide when Flowbite makes it active (removes hidden / translates to 0) */
                #hero-carousel [data-carousel-item].translate-x-0,
                #hero-carousel [data-carousel-item]:not(.hidden):not(.translate-x-full):not(.-translate-x-full) {
                    opacity: 1;
                    visibility: visible;
                    z-index: 10;
                }

                /* Ken Burns Zoom Effect on Slide Images */
                #hero-carousel [data-carousel-item] img {
                    transform: scale(1.02);
                    transition: transform 7.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
                }

                #hero-carousel [data-carousel-item].translate-x-0 img,
                #hero-carousel [data-carousel-item]:not(.hidden):not(.translate-x-full):not(.-translate-x-full) img {
                    transform: scale(1.08);
                }

                /* Content slide-up fade animation */
                #hero-carousel [data-carousel-item] .container {
                    opacity: 0;
                    transform: translateY(20px);
                    transition: opacity 1s cubic-bezier(0.4, 0, 0.2, 1) 0.3s, transform 1s cubic-bezier(0.4, 0, 0.2, 1) 0.3s;
                }

                #hero-carousel [data-carousel-item].translate-x-0 .container,
                #hero-carousel [data-carousel-item]:not(.hidden):not(.translate-x-full):not(.-translate-x-full) .container {
                    opacity: 1;
                    transform: translateY(0);
                }
            </style>

            <div id="hero-carousel" class="relative w-full h-full" data-carousel="slide" data-carousel-interval="7000">

                {{-- WRAPPER --}}
                <div class="relative h-full overflow-hidden">

                    {{-- SLIDE 1 --}}
                    <div class="duration-700 ease-in-out z-20" data-carousel-item="active">
                        <!-- background -->
                        <div class="absolute inset-0">
                            <img src="{{ asset('assets/images/siapindo/carousel-1.webp') }}"
                                class="w-full h-full object-cover"
                                fetchpriority="high"
                                loading="eager"
                                decoding="sync"
                                alt="Hero Slide 1">
                        </div>
                        <!-- overlay gradient -->
                        <div class="absolute inset-0 bg-gradient-to-b from-neutral-950/95 via-neutral-950/75 to-neutral-950/95 lg:bg-gradient-to-r lg:from-neutral-950/95 lg:via-neutral-950/80 lg:to-transparent z-10"></div>
                        
                        <!-- content container -->
                        <div class="relative z-20 container mx-auto px-5 lg:px-20 max-w-7xl h-full flex items-center pt-[130px] pb-16 lg:py-0">
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center w-full">
                                <!-- Left Text -->
                                <div class="lg:col-span-7 flex flex-col items-center lg:items-start text-center lg:text-left gap-4 sm:gap-6 w-full">
                                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#c5a059]/10 border border-[#c5a059]/20 rounded-full text-[9px] sm:text-xs font-extrabold tracking-wider text-[#d4b26f] uppercase w-max">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#c5a059] animate-pulse"></span>
                                        Lembaga Pengembangan SDM Terpercaya
                                    </div>
                                    
                                    <h1 class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white leading-[1.15] tracking-tight">
                                        Akselerasi Kompetensi & <br class="hidden sm:inline" />
                                        <span class="bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent">
                                            Profesionalisme SDM
                                        </span>
                                    </h1>
                                    
                                    <p class="text-zinc-300 text-xs sm:text-sm md:text-base max-w-xl leading-relaxed">
                                        Siap Indonesia mendampingi instansi pemerintah, BUMN, dan korporasi swasta dalam melahirkan SDM unggul berstandar nasional melalui program pelatihan dan keprotokolan tepercaya.
                                    </p>
                                    
                                    <div class="flex flex-col sm:flex-row gap-3.5 w-full sm:w-auto justify-center lg:justify-start mt-2 px-4 sm:px-0">
                                        <a href="{{ $baseWaUrl }}?text=Halo%20Admin%20Siap%20Indonesia,%20saya%20tertarik%20untuk%20konsultasi%20pelatihan" target="_blank"
                                           class="w-full sm:w-auto justify-center bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] hover:from-[#edd1a1] hover:via-[#d4b26f] hover:to-[#8a6109] text-slate-950 font-black text-[11px] sm:text-xs uppercase tracking-wider px-6 sm:px-8 py-3.5 rounded-full shadow-[0_10px_20px_-10px_rgba(197,160,89,0.4)] hover:shadow-[0_15px_30px_-5px_rgba(197,160,89,0.5)] hover:scale-[1.03] transition-all duration-300 flex items-center gap-2 group">
                                            Konsultasi Sekarang
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                            </svg>
                                        </a>
                                        
                                        <a href="{{ route('front.profil') }}"
                                           class="w-full sm:w-auto text-center border border-white/20 hover:border-white/40 hover:bg-white/5 text-white font-black text-[11px] sm:text-xs uppercase tracking-wider px-6 sm:px-8 py-3.5 rounded-full transition-all duration-300">
                                            Tentang Kami
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Right Card -->
                                <div class="lg:col-span-5 hidden lg:flex justify-end w-full">
                                    <!-- Floating Glassmorphic Stats Card -->
                                    <div class="w-full max-w-[380px] p-6 rounded-3xl bg-slate-900/40 backdrop-blur-xl border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform hover:scale-102 transition-transform duration-500 relative overflow-hidden group/stats">
                                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-[#c5a059]/10 rounded-full blur-2xl group-hover/stats:bg-[#c5a059]/20 transition-all duration-700 pointer-events-none"></div>
                                        
                                        <p class="text-[10px] font-bold text-[#c5a059] tracking-widest uppercase mb-4">Siap Indonesia Dalam Angka</p>
                                        <div class="grid grid-cols-2 gap-6">
                                            <!-- Stat 1 -->
                                            <div class="border-l-2 border-[#c5a059]/50 pl-4">
                                                <p class="text-3xl font-black text-white tracking-tight">15+</p>
                                                <p class="text-[10px] text-zinc-400 font-semibold mt-1">Tahun Mengabdi</p>
                                            </div>
                                            <!-- Stat 2 -->
                                            <div class="border-l-2 border-[#c5a059]/50 pl-4">
                                                <p class="text-3xl font-black text-white tracking-tight">10K+</p>
                                                <p class="text-[10px] text-zinc-400 font-semibold mt-1">Alumni Terlatih</p>
                                            </div>
                                            <!-- Stat 3 -->
                                            <div class="border-l-2 border-[#c5a059]/50 pl-4">
                                                <p class="text-3xl font-black text-white tracking-tight">98%</p>
                                                <p class="text-[10px] text-zinc-400 font-semibold mt-1">Tingkat Kepuasan</p>
                                            </div>
                                            <!-- Stat 4 -->
                                            <div class="border-l-2 border-[#c5a059]/50 pl-4">
                                                <p class="text-3xl font-black text-white tracking-tight">500+</p>
                                                <p class="text-[10px] text-zinc-400 font-semibold mt-1">Mitra Instansi</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Decorative footer line inside stats card -->
                                        <div class="mt-6 pt-4 border-t border-white/5 flex items-center justify-between text-[9px] text-zinc-400">
                                            <span class="flex items-center gap-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                                Terakreditasi & Resmi
                                            </span>
                                            <span>Update Juni 2026</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SLIDE 2 --}}
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <!-- background -->
                        <div class="absolute inset-0">
                            <img src="{{ asset('assets/images/siapindo/carousel-2.webp') }}"
                                class="w-full h-full object-cover"
                                loading="lazy"
                                alt="Hero Slide 2">
                        </div>
                        <!-- overlay gradient -->
                        <div class="absolute inset-0 bg-gradient-to-b from-neutral-950/95 via-neutral-950/75 to-neutral-950/95 lg:bg-gradient-to-r lg:from-neutral-950/95 lg:via-neutral-950/80 lg:to-transparent z-10"></div>
                        
                        <!-- content container -->
                        <div class="relative z-20 container mx-auto px-5 lg:px-20 max-w-7xl h-full flex items-center pt-[130px] pb-16 lg:py-0">
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center w-full">
                                <!-- Left Text -->
                                <div class="lg:col-span-7 flex flex-col items-center lg:items-start text-center lg:text-left gap-4 sm:gap-6 w-full">
                                    <div class="inline-flex items-center gap-2 px-3.5 py-1 bg-[#c5a059]/10 border border-[#c5a059]/20 rounded-full text-[9px] sm:text-xs font-extrabold tracking-wider text-[#d4b26f] uppercase w-max">
                                        <span class="w-2 h-2 rounded-full bg-[#c5a059] animate-pulse"></span>
                                        Program Bimtek & Sertifikasi Resmi
                                    </div>
                                    
                                    <h1 class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white leading-[1.15] tracking-tight">
                                        Jadwal Pelatihan & <br class="hidden sm:inline" />
                                        <span class="bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent">
                                            Sertifikasi Resmi
                                        </span>
                                    </h1>
                                    
                                    <p class="text-zinc-300 text-xs sm:text-sm md:text-base max-w-xl leading-relaxed">
                                        Tingkatkan standar keahlian tim Anda dengan kurikulum ter-update, bimbingan intensif dari narasumber nasional, serta program sertifikasi resmi berskala nasional.
                                    </p>
                                    
                                    <div class="flex flex-col sm:flex-row gap-3.5 w-full sm:w-auto justify-center lg:justify-start mt-2 px-4 sm:px-0">
                                        <a href="{{ route('front.jadwalPelatihan') }}"
                                           class="w-full sm:w-auto justify-center bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] hover:from-[#edd1a1] hover:via-[#d4b26f] hover:to-[#8a6109] text-slate-950 font-black text-[11px] sm:text-xs uppercase tracking-wider px-6 sm:px-8 py-3.5 rounded-full shadow-[0_10px_20px_-10px_rgba(197,160,89,0.4)] hover:shadow-[0_15px_30px_-5px_rgba(197,160,89,0.5)] hover:scale-[1.03] transition-all duration-300 flex items-center gap-2 group">
                                            Lihat Jadwal Pelatihan
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Right Card -->
                                <div class="lg:col-span-5 hidden lg:flex justify-end w-full">
                                    <!-- Interactive Program Ticket -->
                                    <div class="w-full max-w-[380px] p-6 rounded-3xl bg-slate-900/40 backdrop-blur-xl border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform hover:scale-102 transition-transform duration-500 relative overflow-hidden group/ticket">
                                        <div class="absolute -right-8 -top-8 w-24 h-24 bg-yellow-500/5 rounded-full blur-2xl pointer-events-none"></div>
                                        
                                        <div class="flex items-center justify-between mb-4">
                                            <span class="px-2.5 py-0.5 bg-[#c5a059]/10 border border-[#c5a059]/30 rounded-full text-[8px] font-bold text-[#d4b26f] uppercase tracking-wider flex items-center gap-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-[#c5a059] animate-ping"></span>
                                                Pendaftaran Dibuka
                                            </span>
                                            <span class="text-[9px] text-zinc-400 font-bold uppercase tracking-wider">Topik Pilihan</span>
                                        </div>
                                        
                                        <h4 class="text-base font-bold text-white leading-snug mb-3 group-hover/ticket:text-amber-400 transition-colors font-[Poppins]">
                                            Ayo Ikuti Pelatihan Terkini!
                                        </h4>
                                        
                                        <p class="text-xs text-zinc-300 leading-relaxed mb-4">
                                            Tingkatkan keahlian dan kompetensi profesional Anda bersama ratusan peserta lainnya melalui program pelatihan terakreditasi resmi kami.
                                        </p>
                                        
                                        <div class="space-y-2.5 text-xs text-zinc-400 border-t border-white/5 pt-4 mb-4">
                                            <div class="flex items-center gap-2.5">
                                                <i class="fas fa-check-circle text-amber-500 text-xs"></i>
                                                <span>Bimtek & Sertifikasi Resmi Nasional</span>
                                            </div>
                                            <div class="flex items-center gap-2.5">
                                                <i class="fas fa-check-circle text-amber-500 text-xs"></i>
                                                <span>Narasumber Pakar & Praktisi</span>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4 pt-3 border-t border-white/5">
                                            <a href="{{ route('front.jadwalPelatihan') }}"
                                               class="w-full flex items-center justify-center text-center px-4 py-2 bg-gradient-to-r from-[#e6c687] to-[#d4b26f] hover:from-[#d4b26f] hover:to-[#c5a059] text-slate-950 font-extrabold text-[10px] uppercase tracking-wider rounded-lg transition-all duration-300 shadow-[0_0_10px_rgba(197,160,89,0.15)]">
                                                Lihat Jadwal Pelatihan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SLIDE 3 --}}
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <!-- background -->
                        <div class="absolute inset-0">
                            <img src="{{ asset('assets/images/siapindo/layanan-satu.webp') }}"
                                class="w-full h-full object-cover"
                                loading="lazy"
                                alt="Hero Slide 3">
                        </div>
                        <!-- overlay gradient -->
                        <div class="absolute inset-0 bg-gradient-to-b from-neutral-950/95 via-neutral-950/75 to-neutral-950/95 lg:bg-gradient-to-r lg:from-neutral-950/95 lg:via-neutral-950/80 lg:to-transparent z-10"></div>
                        
                        <!-- content container -->
                        <div class="relative z-20 container mx-auto px-5 lg:px-20 max-w-7xl h-full flex items-center pt-[130px] pb-16 lg:py-0">
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center w-full">
                                <!-- Left Text -->
                                <div class="lg:col-span-7 flex flex-col items-center lg:items-start text-center lg:text-left gap-4 sm:gap-6 w-full">
                                    <div class="inline-flex items-center gap-2 px-3.5 py-1 bg-[#c5a059]/10 border border-[#c5a059]/20 rounded-full text-[9px] sm:text-xs font-extrabold tracking-wider text-[#d4b26f] uppercase w-max">
                                        <span class="w-2 h-2 rounded-full bg-[#c5a059] animate-pulse"></span>
                                        In-House Training & Konsultasi Kustom
                                    </div>
                                    
                                    <h1 class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white leading-[1.15] tracking-tight">
                                        Solusi Kustom Pelatihan <br class="hidden sm:inline" />
                                        <span class="bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent">
                                            Spesifik Instansi Anda
                                        </span>
                                    </h1>
                                    
                                    <p class="text-zinc-300 text-xs sm:text-sm md:text-base max-w-xl leading-relaxed">
                                        Kami merancang modul, kurikulum, dan studi kasus yang disesuaikan penuh dengan tantangan strategis instansi Anda, dilaksanakan langsung di lokasi Anda secara eksklusif.
                                    </p>
                                    
                                    <div class="flex flex-col sm:flex-row gap-3.5 w-full sm:w-auto justify-center lg:justify-start mt-2 px-4 sm:px-0">
                                        <a href="{{ $baseWaUrl }}?text=Halo%20Admin%20Siap%20Indonesia,%20saya%20tertarik%20untuk%20program%20In-House%20Training" target="_blank"
                                           class="w-full sm:w-auto justify-center bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] hover:from-[#edd1a1] hover:via-[#d4b26f] hover:to-[#8a6109] text-slate-950 font-black text-[11px] sm:text-xs uppercase tracking-wider px-6 sm:px-8 py-3.5 rounded-full shadow-[0_10px_20px_-10px_rgba(197,160,89,0.4)] hover:shadow-[0_15px_30px_-5px_rgba(197,160,89,0.5)] hover:scale-[1.03] transition-all duration-300 flex items-center gap-2 group">
                                            Ajukan In-House Training
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                            </svg>
                                        </a>
                                        
                                        <a href="{{ route('front.profil') }}#layanan"
                                           class="w-full sm:w-auto text-center border border-white/20 hover:border-white/40 hover:bg-white/5 text-white font-black text-[11px] sm:text-xs uppercase tracking-wider px-6 sm:px-8 py-3.5 rounded-full transition-all duration-300">
                                            Layanan Kami
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Right Card -->
                                <div class="lg:col-span-5 hidden lg:flex justify-end w-full">
                                    <!-- Testimonial Quote Card -->
                                    <div class="w-full max-w-[380px] p-6 rounded-3xl bg-slate-900/40 backdrop-blur-xl border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform hover:scale-102 transition-transform duration-500 relative overflow-hidden group/quote">
                                        <div class="absolute -right-8 -top-8 w-24 h-24 bg-amber-500/10 rounded-full blur-2xl"></div>
                                        
                                        <!-- Stars -->
                                        <div class="flex items-center gap-1 mb-4">
                                            <i class="fas fa-star text-xs text-[#d4b26f]"></i>
                                            <i class="fas fa-star text-xs text-[#d4b26f]"></i>
                                            <i class="fas fa-star text-xs text-[#d4b26f]"></i>
                                            <i class="fas fa-star text-xs text-[#d4b26f]"></i>
                                            <i class="fas fa-star text-xs text-[#d4b26f]"></i>
                                        </div>
                                        
                                        <p class="text-xs sm:text-sm text-zinc-200 leading-relaxed italic mb-4">
                                            "Pelatihan In-House dari Siap Indonesia sangat berdampak. Protokol kami menjadi jauh lebih rapi, terstruktur, dan sesuai aturan keprotokolan resmi negara."
                                        </p>
                                        
                                        <div class="flex items-center gap-3 pt-3 border-t border-white/5 mb-4">
                                            <div class="w-8 h-8 rounded-full bg-[#c5a059]/20 flex items-center justify-center text-[#d4b26f] shrink-0">
                                                <i class="fas fa-quote-right text-xs"></i>
                                            </div>
                                            <div class="leading-none">
                                                <p class="text-xs font-bold text-white">Kepala Bagian Protokol & Umum</p>
                                                <p class="text-[9px] text-zinc-400 mt-1 uppercase tracking-wider">Instansi Pemerintah Daerah</p>
                                            </div>
                                        </div>
                                        
                                        <div class="pt-3 border-t border-white/5">
                                            <a href="{{ route('front.partner') }}"
                                               class="flex items-center justify-center text-center px-4 py-2 bg-gradient-to-r from-[#e6c687] to-[#d4b26f] hover:from-[#d4b26f] hover:to-[#c5a059] text-slate-950 font-extrabold text-[10px] uppercase tracking-wider rounded-lg transition-all duration-300 w-full shadow-[0_0_10px_rgba(197,160,89,0.15)]">
                                                Our Client
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    </div>

                </div>



                {{-- PREV --}}
                <button data-carousel-prev
                    class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 group focus:outline-none">
                    <span
                        class="w-12 h-12 flex items-center justify-center rounded-full
                         bg-slate-950/45 border border-white/10 backdrop-blur-md text-white
                         group-hover:bg-amber-500 group-hover:text-slate-950 group-hover:border-transparent transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </span>
                </button>

                {{-- NEXT --}}
                <button data-carousel-next
                    class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 group focus:outline-none">
                    <span
                        class="w-12 h-12 flex items-center justify-center rounded-full
                         bg-slate-950/45 border border-white/10 backdrop-blur-md text-white
                         group-hover:bg-amber-500 group-hover:text-slate-950 group-hover:border-transparent transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </span>
                </button>

            </div>
        </section>
        {{-- AKHIRCAROSEL --}}

        {{-- about --}}
        <section class="py-20 sm:py-28 relative overflow-hidden bg-gradient-to-b from-[#07090f] via-[#090c17] to-[#07090f]">
            <!-- Elegant Background Lights -->
            <div class="absolute top-1/4 left-10 w-96 h-96 bg-amber-500/5 rounded-full blur-[120px] pointer-events-none animate-pulse" style="animation-duration: 8s;"></div>
            <div class="absolute bottom-1/4 right-10 w-96 h-96 bg-yellow-600/5 rounded-full blur-[140px] pointer-events-none animate-pulse" style="animation-duration: 12s;"></div>

            <div class="container mx-auto px-5 lg:px-20 max-w-7xl relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                    
                    <!-- Left: Overlapping Premium Images Collage (5 cols) -->
                    <div data-aos="fade-right" data-aos-duration="1000" class="lg:col-span-5 relative pb-10 pr-10 lg:pb-8 lg:pr-8 group">
                        
                        <!-- Ambient back glow for the collage -->
                        <div class="absolute -inset-4 bg-gradient-to-tr from-amber-500/10 to-transparent rounded-[36px] blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>

                        <!-- Back Card (Image 1 - Main) -->
                        <div class="relative w-[85%] rounded-[32px] overflow-hidden border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.6)] bg-slate-950 aspect-[4/5] transform group-hover:scale-[1.01] transition-all duration-700 ease-out">
                            <img class="w-full h-full object-cover transform scale-100 group-hover:scale-105 transition-transform duration-[1200ms] ease-out"
                                 src="{{ asset('assets/images/siapindo/about.jpg') }}" alt="SIAP Indonesia Office / Team" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent pointer-events-none"></div>
                        </div>

                        <!-- Front Card (Image 2 - Secondary - Overlapping bottom-right) -->
                        <div class="absolute bottom-0 right-0 w-[55%] rounded-[24px] overflow-hidden border-4 border-[#0b0e14] shadow-[0_25px_50px_rgba(0,0,0,0.8)] bg-slate-950 aspect-[4/3] transform translate-y-4 translate-x-2 group-hover:translate-y-2 group-hover:translate-x-0 transition-all duration-700 ease-out animate-pulse" style="animation-duration: 4s;">
                            <img class="w-full h-full object-cover transform scale-100 group-hover:scale-105 transition-transform duration-[1200ms] ease-out"
                                 src="{{ asset('assets/images/siapindo/layanan-satu.webp') }}" alt="SIAP Indonesia Training Session" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent pointer-events-none"></div>
                        </div>

                        <!-- Floating Badge (Bottom Left - Overlapping Main Image) -->
                        <div class="absolute bottom-10 left-[-20px] bg-slate-950/90 backdrop-blur-xl border border-white/10 p-3.5 rounded-2xl shadow-[0_15px_30px_rgba(0,0,0,0.5)] flex items-center gap-3 max-w-[190px] sm:max-w-[210px] hover:translate-y-[-4px] hover:border-amber-500/30 transition-all duration-300 z-20">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-500 to-yellow-600 flex items-center justify-center text-neutral-950 shrink-0 shadow-lg shadow-amber-500/20">
                                <i class="fas fa-history text-xs sm:text-sm"></i>
                            </div>
                            <div class="leading-tight">
                                <p class="text-[8px] text-zinc-500 uppercase font-bold tracking-wider">Berdiri Sejak</p>
                                <p class="text-xs sm:text-sm font-black text-white">Tahun 2009</p>
                            </div>
                        </div>

                        <!-- Floating Chip (Top Right) -->
                        <div class="absolute -top-4 right-[10%] bg-slate-950/90 backdrop-blur-xl border border-amber-500/30 px-3.5 py-2 rounded-full shadow-lg flex items-center gap-2 hover:scale-105 transition-all duration-300 z-20">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-slate-200">10k+ Alumni</span>
                        </div>
                    </div>

                    <!-- Right: Elegant Copy (7 cols) -->
                    <div data-aos="fade-left" data-aos-duration="1200" class="lg:col-span-7 flex flex-col justify-center space-y-6">
                        <div class="space-y-4">
                            <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-500/10 border border-amber-500/20 rounded-full text-[11px] font-bold tracking-wider text-amber-400 uppercase w-max">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Tentang Lembaga Kami
                            </div>
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black font-[Poppins] tracking-tight leading-[1.15] text-white">
                                Membangun SDM Unggul Bersama <br class="hidden sm:inline"/>
                                <span class="bg-gradient-to-r from-yellow-400 via-amber-400 to-yellow-600 bg-clip-text text-transparent drop-shadow-sm">
                                    SIAP INDONESIA
                                </span>
                            </h2>
                        </div>
                        
                        <p class="text-zinc-300 leading-relaxed text-xs sm:text-sm md:text-base border-l-2 border-amber-500/40 pl-4">
                            Siap Indonesia adalah lembaga pengembangan dan peningkatan kompetensi sumber daya manusia terpercaya yang berfokus pada penyelenggaraan pelatihan, bimbingan teknis, workshop, seminar, dan in-house training. Kami berkomitmen mendukung instansi pemerintah, BUMN, BUMD, serta korporasi swasta dalam meningkatkan kualitas dan profesionalisme SDM secara berkelanjutan.
                        </p>

                        <!-- Elegant 2x2 Feature Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-4">
                            <!-- Card 1 -->
                            <div class="group/card p-5 rounded-2xl bg-slate-900/30 border border-white/5 hover:border-amber-500/20 hover:bg-[#0f1422]/50 shadow-lg hover:shadow-[0_15px_30px_rgba(0,0,0,0.4)] transition-all duration-300 flex flex-col gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 group-hover/card:bg-gradient-to-br group-hover/card:from-amber-500 group-hover/card:to-yellow-500 group-hover/card:text-slate-950 group-hover/card:border-transparent group-hover/card:shadow-[0_0_15px_rgba(245,158,11,0.2)] transition-all duration-300">
                                    <i class="fas fa-user-tie text-sm animate-pulse"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-white mb-1 group-hover/card:text-amber-400 transition-colors">Pendekatan Profesional</h4>
                                    <p class="text-xs text-zinc-400 leading-relaxed">Dipandu eksklusif oleh praktisi & narasumber berpengalaman tingkat nasional.</p>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="group/card p-5 rounded-2xl bg-slate-900/30 border border-white/5 hover:border-amber-500/20 hover:bg-[#0f1422]/50 shadow-lg hover:shadow-[0_15px_30px_rgba(0,0,0,0.4)] transition-all duration-300 flex flex-col gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 group-hover/card:bg-gradient-to-br group-hover/card:from-amber-500 group-hover/card:to-yellow-500 group-hover/card:text-slate-950 group-hover/card:border-transparent group-hover/card:shadow-[0_0_15px_rgba(245,158,11,0.2)] transition-all duration-300">
                                    <i class="fas fa-graduation-cap text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-white mb-1 group-hover/card:text-amber-400 transition-colors">Program Komprehensif</h4>
                                    <p class="text-xs text-zinc-400 leading-relaxed">Kurikulum mencakup Etika & Keprotokolan, Public Speaking, hingga Tata Kelola SDM.</p>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="group/card p-5 rounded-2xl bg-slate-900/30 border border-white/5 hover:border-amber-500/20 hover:bg-[#0f1422]/50 shadow-lg hover:shadow-[0_15px_30px_rgba(0,0,0,0.4)] transition-all duration-300 flex flex-col gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 group-hover/card:bg-gradient-to-br group-hover/card:from-amber-500 group-hover/card:to-yellow-500 group-hover/card:text-slate-950 group-hover/card:border-transparent group-hover/card:shadow-[0_0_15px_rgba(245,158,11,0.2)] transition-all duration-300">
                                    <i class="fas fa-award text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-white mb-1 group-hover/card:text-amber-400 transition-colors">Rekam Jejak Kredibel</h4>
                                    <p class="text-xs text-zinc-400 leading-relaxed">Dipercaya oleh kementerian, instansi pemerintah daerah, dan BUMN sejak 2005.</p>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="group/card p-5 rounded-2xl bg-slate-900/30 border border-white/5 hover:border-amber-500/20 hover:bg-[#0f1422]/50 shadow-lg hover:shadow-[0_15px_30px_rgba(0,0,0,0.4)] transition-all duration-300 flex flex-col gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 group-hover/card:bg-gradient-to-br group-hover/card:from-amber-500 group-hover/card:to-yellow-500 group-hover/card:text-slate-950 group-hover/card:border-transparent group-hover/card:shadow-[0_0_15px_rgba(245,158,11,0.2)] transition-all duration-300">
                                    <i class="fas fa-sliders-h text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-white mb-1 group-hover/card:text-amber-400 transition-colors">Kustomisasi Program</h4>
                                    <p class="text-xs text-zinc-400 leading-relaxed">Silabus bimtek & in-house training disesuaikan penuh dengan kebutuhan instansi.</p>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <div class="pt-4">
                            <a class="relative inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] hover:from-[#edd1a1] hover:via-[#d4b26f] hover:to-[#8a6109] text-slate-950 font-extrabold text-xs uppercase tracking-wider rounded-full shadow-[0_10px_20px_-10px_rgba(197,160,89,0.4)] hover:shadow-[0_15px_30px_-5px_rgba(197,160,89,0.5)] hover:scale-[1.03] transition-all duration-300 group"
                               href="{{ route('front.profil') }}">
                                Pelajari Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- akhir about --}}

        {{-- Program Pelatihan Section --}}
        <section class="py-20 border-t border-[#c5a059]/10 relative overflow-hidden">
            {{-- Styles for Spotlight Glow Cards --}}
            <style>
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

            <div class="container mx-auto px-5 lg:px-20 max-w-7xl">
                <h2 class="text-center text-3xl md:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent font-[Poppins] mb-4">
                    Layanan Kami
                </h2>
                <p class="text-center text-gray-400 mb-12 max-w-2xl mx-auto text-sm md:text-base">
                    Program peningkatan kapasitas SDM terbaik yang dirancang khusus untuk memenuhi kebutuhan instansi Anda.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                        $layananMenu = $navigationMenus->where('slug', 'layanan-kami')->first();
                        $layananChildren = $layananMenu ? $layananMenu->children->where('is_active', true)->sortBy('order_priority') : collect();
                    @endphp
                    @foreach($layananChildren as $index => $child)
                        <a href="{{ route('front.program', $child->slug) }}" 
                           data-aos="fade-up" 
                           data-aos-delay="{{ ($index + 1) * 100 }}" 
                           data-glow-card
                           class="flex flex-col justify-between h-full rounded-3xl p-6 hover:-translate-y-1.5 transition-all duration-300 group">
                            <div class="relative z-10">
                                <div class="w-14 h-14 rounded-2xl bg-[#c5a059]/10 border border-[#c5a059]/20 flex items-center justify-center mb-6 shadow-[0_0_15px_rgba(197,160,89,0.1)] group-hover:bg-[#c5a059] group-hover:border-transparent transition-all duration-300">
                                    <i class="fas {{ $child->icon ?: 'fa-graduation-cap' }} text-[#d4b26f] group-hover:text-slate-950 text-2xl transition-all duration-300"></i>
                                </div>
                                <h3 class="text-base sm:text-lg font-bold text-zinc-100 mb-3 font-[Poppins] group-hover:text-[#d4b26f] transition-colors duration-300 leading-snug">{{ $child->name }}</h3>
                                <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed">
                                    {!! Str::limit(strip_tags($child->description), 120) ?: 'Program pelatihan peningkatan kompetensi dan pengembangan kapasitas SDM profesional.' !!}
                                </p>
                            </div>
                        </a>
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
        </section>
        <x-testimonial />

        {{-- Advertisement Section --}}
        <x-banner-ad :bannerads="$bannerads" />


        {{-- Our Client Section --}}
        <x-our-client :partners="$partners" :show-button="true" :limit="18" />

        {{-- Dokumentasi Kegiatan Section --}}
        @if ($galleries->isNotEmpty())
            <section class="py-24 w-full border-t border-[#c5a059]/10 relative overflow-hidden bg-gradient-to-b from-[#07090f] via-[#090c17] to-[#07090f]">
                {{-- Background decorative glows --}}
                <div class="absolute top-1/2 left-0 w-80 h-80 bg-indigo-500/5 rounded-full blur-[120px] pointer-events-none"></div>
                <div class="absolute bottom-0 right-10 w-96 h-96 bg-[#c5a059]/5 rounded-full blur-[140px] pointer-events-none"></div>

                <div class="container mx-auto px-5 lg:px-20 max-w-7xl relative z-10">
                    <div class="text-center flex flex-col items-center gap-3 mb-16">
                        <span class="news-badge bg-[#c5a059]/10 text-[#d4b26f] border-[#c5a059]/25 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">
                            Galeri Foto
                        </span>
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-black bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent font-[Poppins] tracking-tight leading-tight mt-1">
                            Dokumentasi Kegiatan
                        </h2>
                        <p class="text-zinc-400 max-w-xl mx-auto text-sm md:text-base">
                            Melihat lebih dekat keseruan, interaksi, dan antusiasme peserta dalam program pelatihan yang kami selenggarakan.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($galleries as $gallery)
                            <div class="group relative overflow-hidden rounded-[24px] border border-white/10 bg-slate-900/40 shadow-lg hover:shadow-[0_12px_40px_rgba(197,160,89,0.15)] hover:border-[#c5a059]/30 transition-all duration-500 transform hover:-translate-y-1.5 aspect-[4/3] cursor-pointer">
                                <a data-fancybox="gallery" href="{{ asset('storage/' . $gallery->image_path) }}" data-caption="{{ $gallery->alt_text }}">
                                    <!-- Image -->
                                    <img class="w-full h-full object-cover transform scale-100 group-hover:scale-110 transition-transform duration-700 ease-out" 
                                         src="{{ asset('storage/' . $gallery->image_path) }}" 
                                         alt="{{ $gallery->alt_text }}" />
                                    
                                    <!-- Elegant Dark Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-6 z-10">
                                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 ease-out">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-[#c5a059]/20 border border-[#c5a059]/40 rounded-full text-[9px] font-bold text-[#d4b26f] uppercase tracking-widest mb-3">
                                                Dokumentasi
                                            </span>
                                            <p class="text-xs sm:text-sm font-bold text-white line-clamp-2 leading-snug font-[Poppins]">
                                                {{ $gallery->alt_text ?? 'Dokumentasi Training Siap Indonesia' }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Zoom Icon Tag -->
                                    <div class="absolute top-4 right-4 w-9 h-9 rounded-full bg-slate-950/80 backdrop-blur-md border border-white/10 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-75 group-hover:scale-100 shadow-md z-10">
                                        <i class="fas fa-search-plus text-xs text-[#c5a059]"></i>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Lihat Selengkapnya Button -->
                    <div class="flex justify-center mt-12">
                        <a href="{{ route('front.gallery') }}" class="oc-btn-outline group">
                            <span>Buka Galeri Lengkap</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="oc-btn-arrow" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        @endif

                {{-- blog --}}
        <section class="py-24 w-full border-t border-[#c5a059]/10 relative overflow-hidden bg-gradient-to-b from-[#07090f] via-[#090c17] to-[#07090f]">
            {{-- Background decorative glows --}}
            <div class="absolute top-1/2 right-0 w-80 h-80 bg-[#c5a059]/5 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-0 left-10 w-96 h-96 bg-indigo-500/5 rounded-full blur-[140px] pointer-events-none"></div>

            <div class="container mx-auto px-5 lg:px-20 max-w-7xl relative z-10">
                <div class="text-center flex flex-col items-center gap-3 mb-16">
                    <span class="news-badge bg-[#c5a059]/10 text-[#d4b26f] border-[#c5a059]/25 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">
                        Artikel & Edukasi
                    </span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-black bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent font-[Poppins] tracking-tight leading-tight mt-1">
                        Berita Terkini
                    </h2>
                    <p class="text-zinc-400 max-w-xl mx-auto text-sm md:text-base">
                        Ikuti perkembangan terbaru, wawasan keprotokolan resmi, dan tips pengembangan kapasitas SDM terbaik.
                    </p>
                </div>

                @if ($featuredBlogs->isEmpty())
                    <div class="text-center py-16 px-4 bg-[#0c101a] border border-white/5 rounded-3xl">
                        <p class="text-zinc-500 text-sm">Belum ada artikel yang dipublikasikan saat ini.</p>
                    </div>
                @else
                    <div class="flex flex-col lg:flex-row gap-8 items-stretch">
                        
                        <!-- Konten Kiri - Berita Utama (Premium Card) -->
                        <div class="lg:w-2/3 flex flex-col">
                            @php $mainBlog = $featuredBlogs->first(); @endphp
                            <div class="group img-zoom-parent relative flex-grow h-[420px] md:h-[500px] lg:h-full rounded-[24px] overflow-hidden border border-white/10 shadow-2xl flex flex-col justify-end transition-all duration-500 hover:border-[#c5a059]/30 hover:shadow-[0_15px_35px_rgba(0,0,0,0.6)]">
                                <!-- Gambar Utama -->
                                <img src="{{ asset('storage/' . $mainBlog->thumbnail) }}" alt="{{ $mainBlog->name }}"
                                    class="absolute inset-0 w-full h-full object-cover img-zoom-child transition-transform duration-[1.5s] ease-out">
                                
                                <!-- Premium Gradient Overlays -->
                                <div class="absolute inset-0 bg-gradient-to-t from-neutral-950 via-neutral-950/40 to-transparent z-10"></div>
                                <div class="absolute inset-0 bg-neutral-950/10 z-0"></div>

                                <!-- Overlay dengan informasi berita -->
                                <div class="relative z-20 p-8 md:p-12 flex flex-col gap-4">
                                    <!-- Kategori/Tag -->
                                    <div class="w-fit">
                                        <span class="news-badge bg-[#c5a059]/20 text-[#d4b26f] border-[#c5a059]/40 rounded-full px-3.5 py-1 text-[10px] font-bold uppercase tracking-wider flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            {{ $mainBlog->category->name ?? 'Sorotan Utama' }}
                                        </span>
                                    </div>

                                    <!-- Judul Berita -->
                                    <a href="{{ route('front.details', $mainBlog->slug) }}" class="block mt-2">
                                        <h3 class="text-xl md:text-3xl font-extrabold text-white group-hover:text-[#d4b26f] transition-colors duration-300 line-clamp-2 leading-tight tracking-tight font-[Poppins]">
                                            {{ $mainBlog->name }}
                                        </h3>
                                    </a>

                                    <!-- Deskripsi Singkat -->
                                    <p class="text-zinc-300 text-xs md:text-sm line-clamp-2 leading-relaxed max-w-2xl font-[Inter]">
                                        {{ Str::limit(strip_tags($mainBlog->content), 160) }}
                                    </p>

                                    <!-- Divider -->
                                    <div class="h-[1px] w-full bg-white/10 my-2"></div>

                                    <!-- Footer info -->
                                    <div class="flex items-center justify-between text-xs text-zinc-400">
                                        <span class="flex items-center gap-2">
                                            <i class="far fa-calendar-alt text-[#c5a059]"></i>
                                            {{ $mainBlog->created_at->format('d M, Y') }}
                                        </span>
                                        <a href="{{ route('front.details', $mainBlog->slug) }}" class="inline-flex items-center gap-1.5 text-[#d4b26f] hover:text-[#e6c687] font-bold uppercase tracking-widest text-[10px]">
                                            BACA SELENGKAPNYA <i class="fas fa-chevron-right text-[8px] transform group-hover:translate-x-1 transition-transform"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Konten Kanan - Daftar Berita Lainnya (Modern List) -->
                        <div class="lg:w-1/3 flex flex-col justify-between gap-4 max-h-[500px] lg:max-h-none overflow-y-auto pr-2 news-scrollbar">
                            <div class="flex flex-col gap-4">
                                @foreach ($featuredBlogs->skip(1) as $blog)
                                    <div class="group flex gap-4 p-4 rounded-[20px] border border-white/5 bg-slate-900/30 hover:border-[#c5a059]/25 hover:bg-slate-900/50 hover:-translate-y-0.5 transition-all duration-300 items-center">
                                        <!-- Gambar Thumbnail -->
                                        <div class="flex-shrink-0 w-24 h-20 md:w-28 md:h-24 rounded-xl overflow-hidden img-zoom-parent border border-white/5">
                                            <a href="{{ route('front.details', $blog->slug) }}" class="block w-full h-full">
                                                <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->name }}"
                                                    class="w-full h-full object-cover img-zoom-child">
                                            </a>
                                        </div>

                                        <!-- Konten -->
                                        <div class="flex flex-col justify-between py-1 flex-grow gap-1.5">
                                            <!-- Kategori Badge -->
                                            <span class="text-[9px] text-[#d4b26f] font-bold uppercase tracking-widest">
                                                {{ $blog->category->name ?? 'Update' }}
                                            </span>

                                            <!-- Judul Artikel -->
                                            <a href="{{ route('front.details', $blog->slug) }}">
                                                <h3 class="text-xs sm:text-sm font-bold text-zinc-100 group-hover:text-[#d4b26f] transition-colors duration-300 line-clamp-2 leading-snug font-[Poppins]">
                                                    {{ $blog->name }}
                                                </h3>
                                            </a>

                                            <div class="flex items-center justify-between gap-2 mt-2 pt-2 border-t border-white/5">
                                                <!-- Tanggal -->
                                                <p class="text-[10px] text-zinc-500 flex items-center gap-1.5">
                                                    <i class="far fa-calendar-alt text-[#c5a059]/75"></i>
                                                    {{ $blog->created_at->format('d M, Y') }}
                                                </p>

                                                <!-- Tombol Baca -->
                                                <a href="{{ route('front.details', $blog->slug) }}"
                                                    class="text-[10px] text-[#c5a059] font-bold hover:text-[#d4b26f] transition-colors duration-300 flex items-center gap-1 shrink-0 uppercase tracking-wider">
                                                    BACA <i class="fas fa-arrow-right text-[8px] transform group-hover:translate-x-0.5 transition-transform"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
        {{-- akhir blog --}}

        <div class="mt-auto w-full">
            <x-footer />
        </div>

    </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/filament/style.css') }}">
    <style>
        @keyframes marquee {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-marquee {
            animation: marquee 30s linear infinite;
        }
    </style>
@endpush
