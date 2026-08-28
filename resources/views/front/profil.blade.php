@extends('front.master')

@section('title', 'Profil Lembaga | SIAP Indonesia')
@section('meta_description', 'Profil lengkap SIAP Indonesia sebagai lembaga pelatihan dan pengembangan SDM sejak 2005.')
@section('meta_keywords', 'profil siap indonesia, lembaga pelatihan, pelatihan pegawai, pelatihan pemerintah')

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
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 bg-[#c5a059]/10 border border-[#c5a059]/20 rounded-full text-[10px] font-extrabold tracking-wider text-[#d4b26f] uppercase mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#c5a059] animate-pulse"></span>
                    Tentang Lembaga
                </span>
                <h1 class="text-3xl sm:text-4xl md:text-6xl font-black font-[Poppins] tracking-tight text-white leading-none">
                    Profil <span class="bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent">SIAP Indonesia</span>
                </h1>
                <p class="text-zinc-300 mt-3 text-xs sm:text-sm md:text-base leading-relaxed max-w-lg mx-auto">
                    Partner tepercaya instansi pemerintah, BUMN, dan swasta dalam melahirkan SDM unggul berstandar nasional sejak 2005.
                </p>
            </div>
            
            <!-- Elegant bottom light effect -->
            <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-[#0b0e14] to-transparent pointer-events-none"></div>
        </div>

        <!-- Konten Profil -->
        <div class="container mx-auto px-5 lg:px-20 mt-8 mb-16 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

                <!-- Konten Utama (Left Column) -->
                <div class="lg:col-span-8 space-y-12">
                    
                    <!-- Tentang Kami Section -->
                    <div class="space-y-6" data-aos="fade-up">
                        <div class="border-l-4 border-[#c5a059] pl-4 py-1">
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white font-[Poppins] tracking-tight">
                                Kiprah & Sejarah Kami
                            </h2>
                        </div>

                        <div class="prose prose-invert max-w-none text-zinc-300 space-y-5 leading-relaxed text-sm sm:text-base">
                            <p class="text-zinc-200 text-base sm:text-lg leading-relaxed">
                                <strong class="text-[#d4b26f]">SIAP Indonesia</strong> adalah Lembaga Pengembangan dan Peningkatan Sumber Daya Manusia tepercaya yang bergerak di bidang penyelenggaraan Pendidikan dan Pelatihan, Bimbingan Teknis (Bimtek), Workshop, Seminar, Lokakarya, serta In-House Training kustom.
                            </p>
                            <p>
                                Berdiri sejak tahun <strong class="text-white">2005</strong>, kami berkomitmen mendampingi berbagai instansi Pemerintah Daerah, Kementerian, lembaga Legislatif, BUMN, BUMD, hingga korporasi swasta dalam mengakselerasi kompetensi dan kapasitas kerja para SDM secara berkelanjutan.
                            </p>
                            <p>
                                Kami didukung oleh narasumber, pendidik, praktisi berpengalaman, dan instruktur profesional bersertifikasi nasional maupun internasional. Hal ini memastikan kurikulum dan modul pelatihan yang kami sajikan selalu mutakhir dan relevan dengan tantangan strategis terbaru.
                            </p>
                        </div>
                    </div>

                    <!-- Bidang Fokus Pelatihan -->
                    <div class="space-y-6" data-aos="fade-up">
                        <div class="border-l-4 border-[#c5a059] pl-4 py-1">
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white font-[Poppins] tracking-tight">
                                Layanan & Fokus Pelatihan
                            </h2>
                        </div>
                        <p class="text-zinc-400 text-sm sm:text-base leading-relaxed">
                            Kami merancang program pembelajaran terstruktur dengan pendekatan interaktif yang berfokus pada peningkatan keahlian kerja nyata (soft skills & hard skills):
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Card 1 -->
                            <div class="p-5 rounded-2xl bg-[#0c101a] border border-white/5 hover:border-[#c5a059]/20 transition-all duration-300 flex items-start gap-4 group">
                                <div class="w-10 h-10 rounded-xl bg-[#c5a059]/10 border border-[#c5a059]/20 flex items-center justify-center text-[#d4b26f] group-hover:bg-[#c5a059] group-hover:text-slate-950 transition-all duration-300 shrink-0">
                                    <i class="fas fa-gavel text-sm"></i>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-sm font-bold text-white group-hover:text-[#d4b26f] transition-colors">Etika & Keprotokolan Resmi</h4>
                                    <p class="text-xs text-zinc-400 leading-relaxed">Tata tempat, tata upacara, tata penghormatan resmi negara, grooming, serta personal branding eksekutif.</p>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="p-5 rounded-2xl bg-[#0c101a] border border-white/5 hover:border-[#c5a059]/20 transition-all duration-300 flex items-start gap-4 group">
                                <div class="w-10 h-10 rounded-xl bg-[#c5a059]/10 border border-[#c5a059]/20 flex items-center justify-center text-[#d4b26f] group-hover:bg-[#c5a059] group-hover:text-slate-950 transition-all duration-300 shrink-0">
                                    <i class="fas fa-bullhorn text-sm"></i>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-sm font-bold text-white group-hover:text-[#d4b26f] transition-colors">Public Speaking & Komunikasi</h4>
                                    <p class="text-xs text-zinc-400 leading-relaxed">Keahlian berbicara di depan publik, teknik presentasi persuasif, negosiasi bisnis, dan kehumasan.</p>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="p-5 rounded-2xl bg-[#0c101a] border border-white/5 hover:border-[#c5a059]/20 transition-all duration-300 flex items-start gap-4 group">
                                <div class="w-10 h-10 rounded-xl bg-[#c5a059]/10 border border-[#c5a059]/20 flex items-center justify-center text-[#d4b26f] group-hover:bg-[#c5a059] group-hover:text-slate-950 transition-all duration-300 shrink-0">
                                    <i class="fas fa-briefcase text-sm"></i>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-sm font-bold text-white group-hover:text-[#d4b26f] transition-colors">Revolusi Mental & Pelayanan</h4>
                                    <p class="text-xs text-zinc-400 leading-relaxed">Penyusunan standar pelayanan prima (service excellence), karakter kerja berintegritas, dan motivasi berprestasi.</p>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="p-5 rounded-2xl bg-[#0c101a] border border-white/5 hover:border-[#c5a059]/20 transition-all duration-300 flex items-start gap-4 group">
                                <div class="w-10 h-10 rounded-xl bg-[#c5a059]/10 border border-[#c5a059]/20 flex items-center justify-center text-[#d4b26f] group-hover:bg-[#c5a059] group-hover:text-slate-950 transition-all duration-300 shrink-0">
                                    <i class="fas fa-users-cog text-sm"></i>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-sm font-bold text-white group-hover:text-[#d4b26f] transition-colors">Bimtek & In-House Training</h4>
                                    <p class="text-xs text-zinc-400 leading-relaxed">Pelatihan kurikulum kustom di lokasi instansi Anda (In-House) dengan materi teknis tata kelola terkini.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kenapa Memilih Kami Section -->
                    <div class="space-y-6" data-aos="fade-up">
                        <div class="border-l-4 border-[#c5a059] pl-4 py-1">
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white font-[Poppins] tracking-tight">
                                Kenapa Memilih SIAP Indonesia?
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Feature 1 -->
                            <div class="flex gap-3 items-start p-4 bg-[#0c101a]/50 rounded-2xl border border-white/5">
                                <i class="fas fa-check-circle text-[#c5a059] text-lg mt-0.5 shrink-0"></i>
                                <div class="space-y-1">
                                    <h4 class="text-sm sm:text-base font-bold text-zinc-100">Instruktur Nasional & Kredibel</h4>
                                    <p class="text-xs text-zinc-400 leading-relaxed">Materi dipandu langsung oleh narasumber kementerian dan praktisi ahli tingkat nasional.</p>
                                </div>
                            </div>

                            <!-- Feature 2 -->
                            <div class="flex gap-3 items-start p-4 bg-[#0c101a]/50 rounded-2xl border border-white/5">
                                <i class="fas fa-check-circle text-[#c5a059] text-lg mt-0.5 shrink-0"></i>
                                <div class="space-y-1">
                                    <h4 class="text-sm sm:text-base font-bold text-zinc-100">Kurikulum Aplikatif & Kustom</h4>
                                    <p class="text-xs text-zinc-400 leading-relaxed">Materi dan studi kasus dirancang fleksibel menyesuaikan kebutuhan spesifik instansi Anda.</p>
                                </div>
                            </div>

                            <!-- Feature 3 -->
                            <div class="flex gap-3 items-start p-4 bg-[#0c101a]/50 rounded-2xl border border-white/5">
                                <i class="fas fa-check-circle text-[#c5a059] text-lg mt-0.5 shrink-0"></i>
                                <div class="space-y-1">
                                    <h4 class="text-sm sm:text-base font-bold text-zinc-100">Rekam Jejak Kredibel (Sejak 2005)</h4>
                                    <p class="text-xs text-zinc-400 leading-relaxed">Dipercaya oleh ribuan alumni dari berbagai kementerian, pemerintah daerah, BUMN, dan swasta.</p>
                                </div>
                            </div>

                            <!-- Feature 4 -->
                            <div class="flex gap-3 items-start p-4 bg-[#0c101a]/50 rounded-2xl border border-white/5">
                                <i class="fas fa-check-circle text-[#c5a059] text-lg mt-0.5 shrink-0"></i>
                                <div class="space-y-1">
                                    <h4 class="text-sm sm:text-base font-bold text-zinc-100">Fasilitas & Layanan Prima</h4>
                                    <p class="text-xs text-zinc-400 leading-relaxed">Penyelenggaraan kegiatan yang profesional, akomodatif, dan ramah dengan orientasi kepuasan mitra.</p>
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
                                <a href="{{ route('front.beranda') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-[#d4b26f] hover:bg-white/5 transition duration-300">
                                    <i class="fas fa-home text-sm w-5 text-center"></i>
                                    <span>Beranda</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('front.profil') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#c5a059]/10 to-amber-500/5 border border-[#c5a059]/20 text-[#d4b26f] font-bold">
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
                                <a href="{{ route('front.gallery') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-zinc-400 hover:text-[#d4b26f] hover:bg-white/5 transition duration-300">
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
                    <div class="bg-gradient-to-br from-yellow-600/10 via-yellow-900/5 to-transparent border border-[#c5a059]/20 shadow-xl rounded-2xl p-6 text-center relative overflow-hidden group">
                        <div class="absolute -right-10 -top-10 w-24 h-24 bg-[#c5a059]/5 rounded-full blur-2xl group-hover:bg-[#c5a059]/10 transition duration-500"></div>
                        <h3 class="text-base sm:text-lg font-bold text-zinc-100 mb-2 font-[Poppins]">Hubungi Konsultan Kami</h3>
                        <p class="text-xs text-zinc-400 mb-5 leading-relaxed">Konsultasikan kebutuhan diklat, bimtek khusus, atau in-house training instansi Anda secara gratis.</p>
                        <a href="{{ $baseWaUrl }}?text=Halo%20Admin%20Siap%20Indonesia,%20saya%20tertarik%20untuk%20konsultasi%20pelatihan" target="_blank"
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

@push('after-scripts')
    <!-- Structured Data JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "SIAP Indonesia",
      "url": "https://siapindonesia.co.id",
      "logo": "https://siapindonesia.co.id/assets/images/logo.png",
      "sameAs": [
        "{{ $baseWaUrl }}"
      ],
      "description": "Lembaga pelatihan dan pengembangan sumber daya manusia sejak 2005.",
      "foundingDate": "2005"
    }
    </script>
@endpush
