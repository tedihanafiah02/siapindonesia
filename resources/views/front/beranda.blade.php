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

                                    <!-- Social Proof Avatar & Rating Component -->
                                    <x-hero-social-proof />
                                </div>
                                
                                <!-- Right Card -->
                                <div class="lg:col-span-5 hidden lg:flex justify-end w-full">
                                    <!-- Floating Glassmorphic Stats Card -->
                                    <div class="w-full max-w-[380px] p-6 rounded-3xl bg-slate-50/95 backdrop-blur-xl border border-slate-200 text-slate-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform hover:scale-102 transition-all duration-500 relative overflow-hidden group/stats">
                                        <div class="flex items-center justify-between mb-4">
                                            <span class="px-3 py-1 bg-amber-100 border border-amber-300 rounded-full text-[9px] font-bold text-amber-800 uppercase tracking-widest flex items-center gap-1.5 shadow-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                Siap Indonesia Dalam Angka
                                            </span>
                                        </div>

                                        <div class="grid grid-cols-2 gap-5 my-2">
                                            <!-- Stat 1: Left Accent Border -->
                                            <div class="border-l-4 border-l-amber-500 pl-4 py-1">
                                                <p class="text-3xl font-black text-slate-900 tracking-tight">15+</p>
                                                <p class="text-[10px] text-slate-600 font-bold mt-0.5">Tahun Mengabdi</p>
                                            </div>
                                            <!-- Stat 2: Left Accent Border -->
                                            <div class="border-l-4 border-l-amber-500 pl-4 py-1">
                                                <p class="text-3xl font-black text-slate-900 tracking-tight">10K+</p>
                                                <p class="text-[10px] text-slate-600 font-bold mt-0.5">Alumni Terlatih</p>
                                            </div>
                                            <!-- Stat 3: Left Accent Border -->
                                            <div class="border-l-4 border-l-amber-500 pl-4 py-1">
                                                <p class="text-3xl font-black text-slate-900 tracking-tight">98%</p>
                                                <p class="text-[10px] text-slate-600 font-bold mt-0.5">Tingkat Kepuasan</p>
                                            </div>
                                            <!-- Stat 4: Left Accent Border -->
                                            <div class="border-l-4 border-l-amber-500 pl-4 py-1">
                                                <p class="text-3xl font-black text-slate-900 tracking-tight">500+</p>
                                                <p class="text-[10px] text-slate-600 font-bold mt-0.5">Mitra Instansi</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Decorative footer line inside stats card -->
                                        <div class="mt-4 pt-3 border-t border-slate-200/80 flex items-center justify-between text-[9px] text-slate-500 font-bold">
                                            <span class="flex items-center gap-1.5 text-emerald-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                                Terakreditasi & Resmi
                                            </span>
                                            <span>Update 2026</span>
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

                                    <!-- Social Proof Avatar & Rating Component -->
                                    <x-hero-social-proof />
                                </div>
                                
                                <!-- Right Card -->
                                <div class="lg:col-span-5 hidden lg:flex justify-end w-full">
                                    <!-- Interactive Program Ticket -->
                                    <div class="w-full max-w-[380px] p-6 rounded-3xl bg-slate-50/95 backdrop-blur-xl border border-slate-200 text-slate-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform hover:scale-102 transition-all duration-500 relative overflow-hidden group/ticket">
                                        <div class="flex items-center justify-between mb-4">
                                            <span class="px-3 py-1 bg-blue-100 border border-blue-300 rounded-full text-[8px] font-bold text-blue-800 uppercase tracking-wider flex items-center gap-1.5 shadow-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-ping"></span>
                                                Pendaftaran Dibuka
                                            </span>
                                            <span class="text-[9px] text-slate-500 font-bold uppercase tracking-wider">Topik Pilihan</span>
                                        </div>
                                        
                                        <h4 class="text-base font-extrabold text-slate-900 leading-snug mb-3 group-hover/ticket:text-blue-600 transition-colors font-[Poppins]">
                                            Ayo Ikuti Pelatihan Terkini!
                                        </h4>
                                        
                                        <p class="text-xs text-slate-600 leading-relaxed mb-4 font-normal">
                                            Tingkatkan keahlian dan kompetensi profesional Anda bersama ratusan peserta lainnya melalui program pelatihan terakreditasi resmi kami.
                                        </p>
                                        
                                        <div class="space-y-2.5 text-xs text-slate-700 border-t border-slate-200/80 pt-4 mb-4 font-medium">
                                            <div class="flex items-center gap-2.5">
                                                <i class="fas fa-check-circle text-blue-600 text-xs"></i>
                                                <span>Bimtek & Sertifikasi Resmi Nasional</span>
                                            </div>
                                            <div class="flex items-center gap-2.5">
                                                <i class="fas fa-check-circle text-blue-600 text-xs"></i>
                                                <span>Narasumber Pakar & Praktisi</span>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4 pt-3 border-t border-slate-200/80">
                                            <a href="{{ route('front.jadwalPelatihan') }}"
                                               class="w-full flex items-center justify-center text-center px-4 py-2.5 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-blue-600 hover:to-indigo-700 text-white font-extrabold text-[10px] uppercase tracking-wider rounded-xl transition-all duration-300 shadow-md">
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

                                    <!-- Social Proof Avatar & Rating Component -->
                                    <x-hero-social-proof />
                                </div>
                                
                                <!-- Right Card -->
                                <div class="lg:col-span-5 hidden lg:flex justify-end w-full">
                                    <!-- Testimonial Quote Card (Left Border Accent) -->
                                    <div class="w-full max-w-[380px] p-6 rounded-3xl bg-slate-50/95 backdrop-blur-xl border border-slate-200 border-l-4 border-l-emerald-500 text-slate-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform hover:scale-102 transition-all duration-500 relative overflow-hidden group/quote">
                                        <!-- Stars -->
                                        <div class="flex items-center gap-1 mb-4">
                                            <i class="fas fa-star text-xs text-emerald-500"></i>
                                            <i class="fas fa-star text-xs text-emerald-500"></i>
                                            <i class="fas fa-star text-xs text-emerald-500"></i>
                                            <i class="fas fa-star text-xs text-emerald-500"></i>
                                            <i class="fas fa-star text-xs text-emerald-500"></i>
                                        </div>
                                        
                                        <p class="text-xs sm:text-sm text-slate-700 leading-relaxed italic mb-4 font-medium">
                                            "Pelatihan In-House dari Siap Indonesia sangat berdampak. Protokol kami menjadi jauh lebih rapi, terstruktur, dan sesuai aturan keprotokolan resmi negara."
                                        </p>
                                        
                                        <div class="flex items-center gap-3 pt-3 border-t border-slate-200/80 mb-4">
                                            <div class="w-9 h-9 rounded-full bg-emerald-100 border border-emerald-300 flex items-center justify-center text-emerald-700 shrink-0 shadow-sm">
                                                <i class="fas fa-quote-right text-xs"></i>
                                            </div>
                                            <div class="leading-none">
                                                <p class="text-xs font-bold text-slate-900">Kepala Bagian Protokol & Umum</p>
                                                <p class="text-[9px] text-slate-500 font-semibold mt-1 uppercase tracking-wider">Instansi Pemerintah Daerah</p>
                                            </div>
                                        </div>
                                        
                                        <div class="pt-3 border-t border-slate-200/80">
                                            <a href="{{ route('front.partner') }}"
                                               class="flex items-center justify-center text-center px-4 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-teal-600 hover:to-emerald-700 text-white font-extrabold text-[10px] uppercase tracking-wider rounded-xl transition-all duration-300 w-full shadow-md">
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
                        <div class="absolute bottom-10 left-[-20px] bg-slate-50/95 backdrop-blur-xl border border-slate-200 text-slate-900 p-3.5 rounded-2xl shadow-[0_15px_30px_rgba(0,0,0,0.4)] flex items-center gap-3 max-w-[190px] sm:max-w-[210px] hover:translate-y-[-4px] hover:border-amber-400 transition-all duration-300 z-20">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-slate-950 shrink-0 shadow-md">
                                <i class="fas fa-history text-xs sm:text-sm"></i>
                            </div>
                            <div class="leading-tight">
                                <p class="text-[8px] text-slate-500 uppercase font-bold tracking-wider">Berdiri Sejak</p>
                                <p class="text-xs sm:text-sm font-black text-slate-900">Tahun 2009</p>
                            </div>
                        </div>

                        <!-- Floating Chip (Top Right) -->
                        <div class="absolute -top-4 right-[10%] bg-slate-50/95 backdrop-blur-xl border border-emerald-300 px-3.5 py-2 rounded-full shadow-lg flex items-center gap-2 hover:scale-105 transition-all duration-300 z-20">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-slate-800">10k+ Alumni</span>
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

                        <!-- Multi-Theme Soft Off-White Feature Grid (2x2) with Left Border Accents -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-4">
                            <!-- Card 1: Left Amber Border Accent -->
                            <div class="group/card relative overflow-hidden p-6 rounded-3xl bg-slate-50 border border-slate-200 border-l-4 border-l-amber-500 text-slate-800 shadow-xl hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-amber-500/10 transition-all duration-300 flex flex-col gap-3">
                                <div class="w-11 h-11 rounded-2xl bg-amber-100 border border-amber-300 flex items-center justify-center text-amber-700 group-hover/card:bg-amber-500 group-hover/card:text-white group-hover/card:border-transparent transition-all duration-300 shadow-sm">
                                    <i class="fas fa-user-tie text-base"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-extrabold text-slate-900 mb-1 group-hover/card:text-amber-600 transition-colors font-[Poppins]">Pendekatan Profesional</h4>
                                    <p class="text-xs text-slate-600 leading-relaxed font-normal">Dipandu eksklusif oleh praktisi & narasumber berpengalaman tingkat nasional.</p>
                                </div>
                            </div>

                            <!-- Card 2: Left Blue Border Accent -->
                            <div class="group/card relative overflow-hidden p-6 rounded-3xl bg-slate-50 border border-slate-200 border-l-4 border-l-blue-500 text-slate-800 shadow-xl hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-300 flex flex-col gap-3">
                                <div class="w-11 h-11 rounded-2xl bg-blue-100 border border-blue-300 flex items-center justify-center text-blue-700 group-hover/card:bg-blue-600 group-hover/card:text-white group-hover/card:border-transparent transition-all duration-300 shadow-sm">
                                    <i class="fas fa-graduation-cap text-base"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-extrabold text-slate-900 mb-1 group-hover/card:text-blue-600 transition-colors font-[Poppins]">Program Komprehensif</h4>
                                    <p class="text-xs text-slate-600 leading-relaxed font-normal">Kurikulum mencakup Etika & Keprotokolan, Public Speaking, hingga Tata Kelola SDM.</p>
                                </div>
                            </div>

                            <!-- Card 3: Left Emerald Border Accent -->
                            <div class="group/card relative overflow-hidden p-6 rounded-3xl bg-slate-50 border border-slate-200 border-l-4 border-l-emerald-500 text-slate-800 shadow-xl hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-emerald-500/10 transition-all duration-300 flex flex-col gap-3">
                                <div class="w-11 h-11 rounded-2xl bg-emerald-100 border border-emerald-300 flex items-center justify-center text-emerald-700 group-hover/card:bg-emerald-600 group-hover/card:text-white group-hover/card:border-transparent transition-all duration-300 shadow-sm">
                                    <i class="fas fa-award text-base"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-extrabold text-slate-900 mb-1 group-hover/card:text-emerald-600 transition-colors font-[Poppins]">Rekam Jejak Kredibel</h4>
                                    <p class="text-xs text-slate-600 leading-relaxed font-normal">Dipercaya oleh kementerian, instansi pemerintah daerah, dan BUMN sejak 2005.</p>
                                </div>
                            </div>

                            <!-- Card 4: Left Purple Border Accent -->
                            <div class="group/card relative overflow-hidden p-6 rounded-3xl bg-slate-50 border border-slate-200 border-l-4 border-l-purple-500 text-slate-800 shadow-xl hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-purple-500/10 transition-all duration-300 flex flex-col gap-3">
                                <div class="w-11 h-11 rounded-2xl bg-purple-100 border border-purple-300 flex items-center justify-center text-purple-700 group-hover/card:bg-purple-600 group-hover/card:text-white group-hover/card:border-transparent transition-all duration-300 shadow-sm">
                                    <i class="fas fa-sliders-h text-base"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-extrabold text-slate-900 mb-1 group-hover/card:text-purple-600 transition-colors font-[Poppins]">Kustomisasi Program</h4>
                                    <p class="text-xs text-slate-600 leading-relaxed font-normal">Silabus bimtek & in-house training disesuaikan penuh dengan kebutuhan instansi.</p>
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
        <section class="py-24 border-t border-[#c5a059]/15 relative overflow-hidden bg-gradient-to-b from-[#090c17] via-[#0d1222] to-[#090c17]">
            {{-- Background Glow Blobs --}}
            <div class="absolute top-10 left-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="absolute bottom-10 right-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-[140px] pointer-events-none"></div>

            <div class="container mx-auto px-5 lg:px-20 max-w-7xl relative z-10">
                <!-- Section Header -->
                <div class="text-center flex flex-col items-center gap-3 mb-16" data-aos="fade-up">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#c5a059]/15 border border-[#c5a059]/30 text-[#d4b26f] text-xs font-bold uppercase tracking-widest">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        Solusi & Program Pelatihan
                    </span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-black bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent font-[Poppins] tracking-tight leading-tight mt-1">
                        Layanan Unggulan Kami
                    </h2>
                    <p class="text-slate-300 max-w-2xl mx-auto text-sm md:text-base font-normal">
                        Pilihan program peningkatan kapasitas SDM dan keprotokolan terstandarisasi yang siap dilaksanakan secara In-House maupun Regular Bimtek.
                    </p>
                </div>

                <!-- Services Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                        $layananMenu = $navigationMenus->where('slug', 'layanan-kami')->first();
                        $layananChildren = $layananMenu ? $layananMenu->children->where('is_active', true)->sortBy('order_priority') : collect();
                        
                        $colorThemes = [
                            [
                                'accent_bar'    => 'from-amber-400 via-yellow-400 to-amber-600',
                                'icon_bg'       => 'bg-amber-500/10 border-amber-500/30 text-amber-600 group-hover:bg-amber-500 group-hover:text-white',
                                'badge_bg'      => 'bg-amber-50 text-amber-700 border-amber-200',
                                'title_hover'   => 'group-hover:text-amber-600',
                                'arrow_color'   => 'text-amber-600 group-hover:text-amber-700',
                                'card_shadow'   => 'hover:shadow-2xl hover:shadow-amber-500/20 hover:border-amber-300',
                            ],
                            [
                                'accent_bar'    => 'from-sky-400 via-blue-500 to-indigo-600',
                                'icon_bg'       => 'bg-blue-500/10 border-blue-500/30 text-blue-600 group-hover:bg-blue-600 group-hover:text-white',
                                'badge_bg'      => 'bg-blue-50 text-blue-700 border-blue-200',
                                'title_hover'   => 'group-hover:text-blue-600',
                                'arrow_color'   => 'text-blue-600 group-hover:text-blue-700',
                                'card_shadow'   => 'hover:shadow-2xl hover:shadow-blue-500/20 hover:border-blue-300',
                            ],
                            [
                                'accent_bar'    => 'from-emerald-400 via-teal-400 to-emerald-600',
                                'icon_bg'       => 'bg-emerald-500/10 border-emerald-500/30 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white',
                                'badge_bg'      => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'title_hover'   => 'group-hover:text-emerald-600',
                                'arrow_color'   => 'text-emerald-600 group-hover:text-emerald-700',
                                'card_shadow'   => 'hover:shadow-2xl hover:shadow-emerald-500/20 hover:border-emerald-300',
                            ],
                            [
                                'accent_bar'    => 'from-violet-400 via-purple-500 to-fuchsia-500',
                                'icon_bg'       => 'bg-purple-500/10 border-purple-500/30 text-purple-600 group-hover:bg-purple-600 group-hover:text-white',
                                'badge_bg'      => 'bg-purple-50 text-purple-700 border-purple-200',
                                'title_hover'   => 'group-hover:text-purple-600',
                                'arrow_color'   => 'text-purple-600 group-hover:text-purple-700',
                                'card_shadow'   => 'hover:shadow-2xl hover:shadow-purple-500/20 hover:border-purple-300',
                            ],
                        ];
                    @endphp

                    @forelse($layananChildren as $index => $child)
                        @php
                            $theme = $colorThemes[$index % 4];
                        @endphp
                        <a href="{{ route('front.program', $child->slug) }}" 
                           data-aos="fade-up" 
                           data-aos-delay="{{ ($index + 1) * 80 }}" 
                           class="flex flex-col justify-between h-full rounded-3xl p-7 bg-slate-50 text-slate-800 border border-slate-200/90 shadow-xl shadow-black/20 hover:-translate-y-2.5 transition-all duration-300 group relative overflow-hidden {{ $theme['card_shadow'] }}">
                            
                            <!-- Multi-Theme Top Gradient Accent Bar -->
                            <div class="h-1.5 w-full bg-gradient-to-r {{ $theme['accent_bar'] }} rounded-t-3xl absolute top-0 left-0 right-0 group-hover:h-2.5 transition-all duration-300"></div>

                            <div class="relative z-10 flex-grow pt-2">
                                <div class="flex items-center justify-between mb-5">
                                    <div class="w-14 h-14 rounded-2xl border flex items-center justify-center transition-all duration-300 shadow-sm {{ $theme['icon_bg'] }}">
                                        <i class="fas {{ $child->icon ?: 'fa-graduation-cap' }} text-2xl transition-all duration-300"></i>
                                    </div>
                                    <span class="text-[10px] font-bold px-3 py-1 rounded-full border uppercase tracking-wider shadow-sm {{ $theme['badge_bg'] }}">
                                        Program Resmi
                                    </span>
                                </div>

                                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 mb-3 font-[Poppins] {{ $theme['title_hover'] }} transition-colors duration-300 leading-snug">
                                    {{ $child->name }}
                                </h3>

                                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-6 font-normal">
                                    {!! Str::limit(strip_tags($child->description ?? ''), 120) ?: 'Program pelatihan peningkatan kompetensi dan pengembangan kapasitas SDM profesional.' !!}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-slate-200/80 flex items-center justify-between text-xs font-bold uppercase tracking-wider {{ $theme['arrow_color'] }} transition-colors">
                                <span>Jelajahi Program</span>
                                <i class="fas fa-arrow-right text-xs transform group-hover:translate-x-1.5 transition-transform duration-300"></i>
                            </div>
                        </a>
                    @empty
                        <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200 text-slate-700 col-span-3 text-center shadow-lg">
                            Belum ada program layanan yang ditambahkan.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        <x-testimonial />

        {{-- Advertisement Section --}}
        <x-banner-ad :bannerads="$bannerads" />


        {{-- Our Client Section --}}
        <x-our-client :partners="$partners" :show-button="true" :limit="18" />

        {{-- Dokumentasi Kegiatan Section --}}
        <x-gallery :galleries="$galleries" />

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
                    <div class="text-center py-16 px-4 bg-slate-50 border border-slate-200 rounded-3xl shadow-lg">
                        <p class="text-slate-600 text-sm font-medium">Belum ada artikel yang dipublikasikan saat ini.</p>
                    </div>
                @else
                    <div class="flex flex-col lg:flex-row gap-8 items-stretch">
                        
                        <!-- Konten Kiri - Berita Utama (Premium Glass Hero Card) -->
                        <div class="lg:w-2/3 flex flex-col">
                            @php $mainBlog = $featuredBlogs->first(); @endphp
                            <div class="group img-zoom-parent relative flex-grow h-[420px] md:h-[500px] lg:h-full rounded-[24px] overflow-hidden border border-white/10 shadow-2xl flex flex-col justify-end transition-all duration-500 hover:border-amber-400/50 hover:shadow-amber-500/10">
                                <!-- Gambar Utama -->
                                <img src="{{ asset('storage/' . $mainBlog->thumbnail) }}" alt="{{ $mainBlog->name }}"
                                    class="absolute inset-0 w-full h-full object-cover img-zoom-child transition-transform duration-[1.5s] ease-out">
                                
                                <!-- Premium Gradient Overlays -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent z-10"></div>

                                <!-- Overlay dengan informasi berita -->
                                <div class="relative z-20 p-8 md:p-12 flex flex-col gap-4">
                                    <!-- Kategori/Tag -->
                                    <div class="w-fit">
                                        <span class="bg-[#c5a059]/20 text-[#d4b26f] border border-[#c5a059]/40 rounded-full px-3.5 py-1 text-[10px] font-bold uppercase tracking-wider flex items-center gap-2 shadow-sm">
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
                                    <p class="text-zinc-200 text-xs md:text-sm line-clamp-2 leading-relaxed max-w-2xl font-[Inter]">
                                        {{ Str::limit(strip_tags($mainBlog->content ?? ''), 160) }}
                                    </p>

                                    <!-- Divider -->
                                    <div class="h-[1px] w-full bg-white/15 my-2"></div>

                                    <!-- Footer info -->
                                    <div class="flex items-center justify-between text-xs text-zinc-300">
                                        <span class="flex items-center gap-2 font-medium">
                                            <i class="far fa-calendar-alt text-[#d4b26f]"></i>
                                            {{ $mainBlog->created_at->format('d M, Y') }}
                                        </span>
                                        <a href="{{ route('front.details', $mainBlog->slug) }}" class="inline-flex items-center gap-1.5 text-[#d4b26f] hover:text-[#e6c687] font-bold uppercase tracking-widest text-[10px]">
                                            BACA SELENGKAPNYA <i class="fas fa-chevron-right text-[8px] transform group-hover:translate-x-1 transition-transform"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Konten Kanan - Daftar Berita Lainnya (Soft Off-White Cards dengan Border Kiri Warna-Warni) -->
                        <div class="lg:w-1/3 flex flex-col justify-between gap-4 max-h-[500px] lg:max-h-none overflow-y-auto pr-2 news-scrollbar">
                            <div class="flex flex-col gap-4">
                                @php
                                    $blogThemes = [
                                        ['border' => 'border-l-amber-500', 'badge' => 'text-amber-700', 'hover' => 'group-hover:text-amber-600'],
                                        ['border' => 'border-l-blue-500', 'badge' => 'text-blue-700', 'hover' => 'group-hover:text-blue-600'],
                                        ['border' => 'border-l-emerald-500', 'badge' => 'text-emerald-700', 'hover' => 'group-hover:text-emerald-600'],
                                        ['border' => 'border-l-purple-500', 'badge' => 'text-purple-700', 'hover' => 'group-hover:text-purple-600'],
                                    ];
                                @endphp
                                @foreach ($featuredBlogs->skip(1) as $index => $blog)
                                    @php $bTheme = $blogThemes[$index % 4]; @endphp
                                    <div class="group relative overflow-hidden flex gap-4 p-4 rounded-[20px] border border-slate-200 border-l-4 {{ $bTheme['border'] }} bg-slate-50 text-slate-800 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 items-center">
                                        <!-- Gambar Thumbnail -->
                                        <div class="flex-shrink-0 w-24 h-20 md:w-28 md:h-24 rounded-xl overflow-hidden img-zoom-parent border border-slate-200">
                                            <a href="{{ route('front.details', $blog->slug) }}" class="block w-full h-full">
                                                <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->name }}"
                                                    class="w-full h-full object-cover img-zoom-child">
                                            </a>
                                        </div>

                                        <!-- Konten -->
                                        <div class="flex flex-col justify-between py-1 flex-grow gap-1.5">
                                            <!-- Kategori Badge -->
                                            <span class="text-[9px] font-extrabold uppercase tracking-widest {{ $bTheme['badge'] }}">
                                                {{ $blog->category->name ?? 'Update' }}
                                            </span>

                                            <!-- Judul Artikel -->
                                            <a href="{{ route('front.details', $blog->slug) }}">
                                                <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 {{ $bTheme['hover'] }} transition-colors duration-300 line-clamp-2 leading-snug font-[Poppins]">
                                                    {{ $blog->name }}
                                                </h3>
                                            </a>

                                            <div class="flex items-center justify-between gap-2 mt-2 pt-2 border-t border-slate-200/80">
                                                <!-- Tanggal -->
                                                <p class="text-[10px] text-slate-500 font-medium flex items-center gap-1.5">
                                                    <i class="far fa-calendar-alt text-amber-500"></i>
                                                    {{ $blog->created_at->format('d M, Y') }}
                                                </p>

                                                <!-- Tombol Baca -->
                                                <a href="{{ route('front.details', $blog->slug) }}"
                                                    class="text-[10px] font-bold text-slate-700 hover:text-amber-600 transition-colors duration-300 flex items-center gap-1 shrink-0 uppercase tracking-wider">
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
