@extends('front.master')

@section('title', 'Visi & Misi | Siap Indonesia')
@section('description', 'Visi dan misi Siap Indonesia dalam mencerdaskan masyarakat dan meningkatkan kualitas sumber daya manusia.')
@section('keywords', 'visi misi siap indonesia, pengembangan SDM, pelatihan pemerintah, pelatihan keprotokolan')

@section('og_title', 'Visi & Misi | Siap Indonesia')
@section('og_description', 'Komitmen Siap Indonesia dalam mencerdaskan masyarakat dan meningkatkan kualitas SDM melalui pelatihan dan pendidikan.')
@section('og_image', asset('assets/images/siapindo/carousel-1.webp'))

@section('twitter_title', 'Visi & Misi | Siap Indonesia')
@section('twitter_description', 'Visi dan misi Siap Indonesia untuk membangun SDM profesional dan berintegritas.')
@section('twitter_image', asset('assets/images/siapindo/carousel-1.webp'))

@section('schema')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Siap Indonesia",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('assets/images/siapindo/logo-siapindo.png') }}",
      "description": "Konsultan pelatihan keprotokolan dan pengembangan sumber daya manusia.",
      "sameAs": [
        "https://www.instagram.com/siapindonesia",
        "https://www.linkedin.com/company/siapindonesia"
      ]
    }
    </script>
@endsection

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
            <!-- Glassmorphism overlay gradient -->
            <div class="absolute inset-0 bg-gradient-to-b from-[#0b0e14]/90 via-[#0b0e14]/50 to-[#0b0e14] z-0"></div>
            
            <div class="relative text-center text-zinc-100 z-10 max-w-2xl px-4 mt-0">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 bg-yellow-500/10 border border-yellow-500/20 rounded-full text-[10px] font-extrabold tracking-wider text-yellow-400 uppercase mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span>
                    Komitmen & Nilai
                </span>
                <h1 class="text-3xl sm:text-4xl md:text-6xl font-black font-[Poppins] tracking-tight text-white leading-none">
                    Visi & Misi <span class="bg-gradient-to-r from-yellow-400 via-amber-400 to-yellow-500 bg-clip-text text-transparent">SIAP Indonesia</span>
                </h1>
                <p class="text-zinc-300 mt-3 text-xs sm:text-sm md:text-base leading-relaxed max-w-lg mx-auto">
                    Landasan visi luhur dan program misi kami dalam mencerdaskan kehidupan berbangsa serta melatih SDM nasional.
                </p>
            </div>
            
            <!-- Elegant bottom light effect -->
            <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-[#0b0e14] to-transparent pointer-events-none"></div>
        </div>

        <!-- Konten Visi & Misi -->
        <div class="container mx-auto px-5 lg:px-20 mt-8 mb-16 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

                <!-- Konten Utama (Left Column) -->
                <div class="lg:col-span-8 space-y-12">
                    
                    <!-- Visi Kami Section -->
                    <div class="space-y-6" data-aos="fade-up">
                        <div class="border-l-4 border-yellow-500 pl-4 py-1">
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white font-[Poppins] tracking-tight">
                                Visi Kami
                            </h2>
                        </div>

                        <!-- Vision Premium Blockquote Glass Card -->
                        <div class="relative p-6 sm:p-10 rounded-3xl border border-yellow-500/15 bg-gradient-to-br from-yellow-500/[0.03] to-[#0c101a] overflow-hidden shadow-2xl">
                            <!-- Background glow light effect -->
                            <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-yellow-500/[0.04] rounded-full blur-3xl pointer-events-none"></div>
                            
                            <span class="absolute top-4 left-6 text-7xl font-serif text-yellow-500/10 select-none pointer-events-none">“</span>
                            
                            <p class="text-zinc-200 text-base sm:text-xl leading-relaxed font-semibold italic text-justify relative z-10 pl-4">
                                Mewujudkan cita-cita luhur bangsa dalam mencerdaskan masyarakat dalam kehidupan berbangsa dan bernegara serta meningkatkan kapasitas Sumber Daya Manusia (SDM) bagi aparat pemerintah, baik Eksekutif maupun Legislatif, Pegawai/Karyawan Swasta, dan masyarakat guna terciptanya manusia Indonesia yang berkepribadian bersih, jujur, berwibawa, dan bertanggung jawab.
                            </p>
                        </div>
                    </div>

                    <!-- Misi Kami Section -->
                    <div class="space-y-6" data-aos="fade-up">
                        <div class="border-l-4 border-yellow-500 pl-4 py-1">
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white font-[Poppins] tracking-tight">
                                Misi Kami
                            </h2>
                        </div>
                        <p class="text-zinc-400 text-sm sm:text-base leading-relaxed">
                            Langkah strategis berkelanjutan yang kami lakukan untuk merealisasikan visi pengembangan kapasitas SDM:
                        </p>

                        <!-- Mission Cards Grid -->
                        <div class="grid grid-cols-1 gap-5">
                            
                            <!-- Misi 1 -->
                            <div class="flex flex-col sm:flex-row gap-4 p-5 rounded-2xl bg-[#0c101a] border border-white/5 hover:border-yellow-500/20 transition-all duration-300 group">
                                <div class="w-12 h-12 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center text-yellow-400 font-extrabold text-lg group-hover:bg-yellow-500 group-hover:text-slate-950 transition-all duration-300 shrink-0">
                                    01
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-base font-bold text-white group-hover:text-yellow-400 transition-colors">Pendidikan & Pelatihan Berkualitas</h4>
                                    <p class="text-xs sm:text-sm text-zinc-400 leading-relaxed">Meningkatkan kemampuan sumber daya manusia melalui kurikulum pendidikan dan pelatihan yang mutakhir, aplikatif, dan berstandar.</p>
                                </div>
                            </div>

                            <!-- Misi 2 -->
                            <div class="flex flex-col sm:flex-row gap-4 p-5 rounded-2xl bg-[#0c101a] border border-white/5 hover:border-yellow-500/20 transition-all duration-300 group">
                                <div class="w-12 h-12 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center text-yellow-400 font-extrabold text-lg group-hover:bg-yellow-500 group-hover:text-slate-950 transition-all duration-300 shrink-0">
                                    02
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-base font-bold text-white group-hover:text-yellow-400 transition-colors">Optimalisasi Peran Aparatur & Karyawan</h4>
                                    <p class="text-xs sm:text-sm text-zinc-400 leading-relaxed">Meningkatkan kemampuan aparatur pemerintah dan karyawan swasta dalam melaksanakan peran publik dan profesionalnya secara bertanggung jawab.</p>
                                </div>
                            </div>

                            <!-- Misi 3 -->
                            <div class="flex flex-col sm:flex-row gap-4 p-5 rounded-2xl bg-[#0c101a] border border-white/5 hover:border-yellow-500/20 transition-all duration-300 group">
                                <div class="w-12 h-12 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center text-yellow-400 font-extrabold text-lg group-hover:bg-yellow-500 group-hover:text-slate-950 transition-all duration-300 shrink-0">
                                    03
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-base font-bold text-white group-hover:text-yellow-400 transition-colors">Jejaring Kerja Sama Profesional</h4>
                                    <p class="text-xs sm:text-sm text-zinc-400 leading-relaxed">Melakukan kerja sama kemitraan profesional dengan perguruan tinggi terkemuka, kementerian/lembaga pemerintahan, serta entitas swasta.</p>
                                </div>
                            </div>

                            <!-- Misi 4 -->
                            <div class="flex flex-col sm:flex-row gap-4 p-5 rounded-2xl bg-[#0c101a] border border-white/5 hover:border-yellow-500/20 transition-all duration-300 group">
                                <div class="w-12 h-12 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center text-yellow-400 font-extrabold text-lg group-hover:bg-yellow-500 group-hover:text-slate-950 transition-all duration-300 shrink-0">
                                    04
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-base font-bold text-white group-hover:text-yellow-400 transition-colors">Instruktur Berstandar Internasional</h4>
                                    <p class="text-xs sm:text-sm text-zinc-400 leading-relaxed">Meningkatkan kualitas pengajar, pendidik, tenaga ahli, serta manajemen organisasi yang profesional dan berorientasi standar internasional.</p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Sidebar (Right Column) -->
                <div class="lg:col-span-4 space-y-6">

                    <!-- Menu Navigasi Sidebar -->
                    <div class="bg-[#0c101a] border border-white/5 shadow-xl rounded-2xl p-6">
                        <h3 class="text-lg font-bold text-zinc-100 mb-4 border-b border-white/5 pb-3 font-[Poppins]">
                            Menu Navigasi
                        </h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('front.beranda') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-yellow-400 hover:bg-white/5 transition duration-300">
                                    <i class="fas fa-home text-sm w-5 text-center"></i>
                                    <span>Beranda</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('front.profil') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-yellow-400 hover:bg-white/5 transition duration-300">
                                    <i class="fas fa-user text-sm w-5 text-center"></i>
                                    <span>Profil Lembaga</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('front.visimisi') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-gradient-to-r from-yellow-500/10 to-amber-500/5 border border-yellow-500/20 text-yellow-400 font-bold">
                                    <i class="fas fa-bullseye text-sm w-5 text-center"></i>
                                    <span>Visi & Misi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('front.partner') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-yellow-400 hover:bg-white/5 transition duration-300">
                                    <i class="fas fa-handshake text-sm w-5 text-center"></i>
                                    <span>Our Client</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('front.gallery') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-yellow-400 hover:bg-white/5 transition duration-300">
                                    <i class="fas fa-images text-sm w-5 text-center"></i>
                                    <span>Galeri Kegiatan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('front.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-yellow-400 hover:bg-white/5 transition duration-300">
                                    <i class="fas fa-newspaper text-sm w-5 text-center"></i>
                                    <span>Berita Terkini</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Hubungi Konsultan WA Card -->
                    <div class="bg-gradient-to-br from-yellow-600/10 via-yellow-900/5 to-transparent border border-yellow-500/20 shadow-xl rounded-2xl p-6 text-center relative overflow-hidden group">
                        <div class="absolute -right-10 -top-10 w-24 h-24 bg-yellow-500/5 rounded-full blur-2xl group-hover:bg-yellow-500/10 transition duration-500"></div>
                        <h3 class="text-base sm:text-lg font-bold text-zinc-100 mb-2 font-[Poppins]">Hubungi Konsultan Kami</h3>
                        <p class="text-xs text-zinc-400 mb-5 leading-relaxed">Konsultasikan kebutuhan diklat, bimtek khusus, atau in-house training instansi Anda secara gratis.</p>
                        <a href="{{ $baseWaUrl }}?text=Halo%20Admin%20Siap%20Indonesia,%20saya%20tertarik%20untuk%20konsultasi%20visi%20misi%20dan%20pelatihan" target="_blank"
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
@endpush
