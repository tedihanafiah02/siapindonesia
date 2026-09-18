@extends('front.master')
@section('title', 'Blog & Artikel Keprotokolan | Siap Indonesia')
@section('description', 'Portal berita, tips keprotokolan terbaru, public speaking, grooming, dan artikel bimbingan kompetensi SDM dari Siap Indonesia.')
@section('content')

    <style>
        .custom-navbar-offset {
            margin-top: 100px;
        }
        @media (min-width: 768px) {
            .custom-navbar-offset {
                margin-top: 130px;
            }
        }
    </style>

    <div class="w-full flex-grow flex flex-col custom-navbar-offset">
        <x-navbar />

        {{-- Hero Header Section --}}
        <section id="BlogHeader" class="relative py-12 md:py-16 overflow-hidden bg-gradient-to-b from-[#07090f] via-[#090d18] to-[#07090f] border-b border-[#c5a059]/10">
            <!-- Background Glow Lights -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-amber-500/5 rounded-full blur-[140px] pointer-events-none"></div>

            <div class="container mx-auto px-5 lg:px-20 max-w-7xl relative z-10 text-center flex flex-col items-center">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-[#c5a059]/10 border border-[#c5a059]/30 rounded-full text-xs font-bold text-[#d4b26f] uppercase tracking-widest mb-4">
                    <span class="w-2 h-2 rounded-full bg-[#c5a059] animate-pulse"></span>
                    Pusat Informasi & Edukasi Keprotokolan
                </span>

                <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-white font-[Poppins] tracking-tight leading-tight max-w-4xl">
                    Wawasan & Tips <br class="hidden sm:inline" />
                    <span class="bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent">
                        Keprotokolan Terkini
                    </span>
                </h1>

                <p class="text-zinc-400 text-xs sm:text-sm md:text-base max-w-2xl mt-4 leading-relaxed font-[Inter]">
                    Dapatkan insight mendalam seputar keprotokolan resmi, etiket kenegaraan, public speaking, grooming, dan strategi pengembangan SDM unggul.
                </p>

                <!-- Search Input Form -->
                <form action="{{ route('front.search') }}" method="GET" class="relative w-full max-w-xl mt-8 group">
                    <div class="relative flex items-center">
                        <div class="absolute left-4 text-zinc-400 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                        <input type="text"
                            name="keyword"
                            placeholder="Cari artikel, tips keprotokolan, MC, grooming..."
                            required
                            class="w-full pl-12 pr-32 py-3.5 bg-slate-900/90 border border-white/15 focus:border-[#c5a059] text-white placeholder-zinc-400 text-xs sm:text-sm rounded-full outline-none focus:ring-2 focus:ring-[#c5a059]/30 transition-all duration-300 shadow-xl" />
                        <button type="submit"
                            class="absolute right-1.5 px-5 py-2.5 bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] hover:from-[#edd1a1] hover:to-[#8a6109] text-slate-950 font-black text-xs uppercase tracking-wider rounded-full transition-all duration-300 shadow-md flex items-center gap-1.5">
                            <span>Cari</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </section>

        {{-- Section Featured: Magazine Hero Grid --}}
        <section id="Featured" class="container mx-auto px-5 lg:px-20 max-w-7xl my-14">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="text-[10px] text-[#d4b26f] font-bold uppercase tracking-widest">Berita Pilihan</span>
                    <h2 class="text-2xl md:text-3xl font-black text-white tracking-tight font-[Poppins] mt-0.5">
                        Sorotan Utama
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
                {{-- Left: Main Featured Article (Spans 7 columns) --}}
                @if ($featured_articles->isNotEmpty())
                    @php $mainFeatured = $featured_articles->first(); @endphp
                    <div class="lg:col-span-7">
                        <div class="group relative h-[360px] md:h-[460px] rounded-[24px] overflow-hidden border border-white/10 shadow-2xl flex flex-col justify-end transition-all duration-500">
                            <img src="{{ asset('storage/' . $mainFeatured->thumbnail) }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" alt="featured" onerror="this.onerror=null;this.src='{{ asset('assets/images/siapindo/carousel-1.webp') }}';">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/70 to-transparent z-10"></div>
                            <div class="relative z-20 p-6 md:p-8 flex flex-col gap-3">
                                <div>
                                    <span class="px-3.5 py-1 bg-[#c5a059]/20 border border-[#c5a059]/40 text-[#d4b26f] rounded-full text-[10px] font-bold uppercase tracking-widest inline-flex items-center gap-1.5 shadow-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        {{ $mainFeatured->category->name }}
                                    </span>
                                </div>
                                <a href="{{ route('front.details', $mainFeatured->slug) }}" class="block">
                                    <h2 class="font-black text-xl md:text-2xl lg:text-3xl text-white group-hover:text-[#d4b26f] transition-colors duration-300 leading-tight tracking-tight font-[Poppins]">
                                        {{ $mainFeatured->name }}
                                    </h2>
                                </a>
                                <div class="flex items-center gap-4 text-zinc-300 text-xs mt-1 font-[Inter]">
                                    <span class="flex items-center gap-1.5">
                                        <i class="far fa-calendar-alt text-[#c5a059]"></i>
                                        {{ $mainFeatured->created_at->format('d M Y') }}
                                    </span>
                                    <span class="text-zinc-500">•</span>
                                    <span class="text-[#d4b26f] font-semibold flex items-center gap-1">
                                        <i class="far fa-clock text-xs"></i> 5 Min Baca
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Right: Vertical list of featured articles (Spans 5 columns) --}}
                <div class="lg:col-span-5 flex flex-col gap-4 justify-between">
                    @forelse($featured_articles->skip(1)->take(3) as $featured)
                        <div class="group flex gap-4 p-4 rounded-[22px] bg-slate-50 text-slate-900 shadow-md hover:shadow-xl hover:border-[#c5a059]/40 hover:-translate-y-1 transition-all duration-300 flex-1 items-center border border-slate-200/90">
                            <div class="w-24 h-20 md:w-28 md:h-24 rounded-xl overflow-hidden shrink-0 relative shadow-sm">
                                <a href="{{ route('front.details', $featured->slug) }}" class="block w-full h-full">
                                    <img src="{{ asset('storage/' . $featured->thumbnail) }}" alt="featured" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" onerror="this.onerror=null;this.src='{{ asset('assets/images/siapindo/carousel-1.webp') }}';">
                                </a>
                            </div>
                            <div class="flex flex-col justify-center gap-1 py-0.5">
                                <span class="text-[9px] text-[#aa7c11] font-extrabold uppercase tracking-widest">
                                    {{ $featured->category->name }}
                                </span>
                                <a href="{{ route('front.details', $featured->slug) }}">
                                    <h3 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-[#b38e46] transition-colors leading-snug line-clamp-2 font-[Poppins]">
                                        {{ $featured->name }}
                                    </h3>
                                </a>
                                <p class="text-[10px] text-slate-500 flex items-center gap-1.5 mt-1 font-[Inter]">
                                    <i class="far fa-calendar-alt text-[#c5a059]"></i>
                                    {{ $featured->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="h-full flex items-center justify-center border border-white/5 rounded-[20px] p-6 bg-slate-900/30">
                            <p class="text-zinc-400 text-xs">Belum ada sorotan berita lainnya.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Category Chips Section --}}
        <section id="Category" class="container mx-auto px-5 lg:px-20 max-w-7xl mb-16">
            <div class="flex flex-col items-center text-center gap-2 mb-8">
                <span class="text-[10px] text-[#d4b26f] font-bold uppercase tracking-widest">Eksplorasi Topik</span>
                <h2 class="text-white text-2xl md:text-3xl font-black tracking-tight font-[Poppins]">Kategori Berita</h2>
            </div>
            
            <div class="flex justify-center flex-wrap gap-3">
                @foreach ($categories as $category)
                    <a href="{{ route('front.category', $category->slug) }}"
                        class="group flex items-center gap-2.5 px-5 py-3 rounded-2xl bg-slate-900/80 border border-white/10 hover:border-[#c5a059]/50 hover:bg-[#c5a059]/15 transition-all duration-300 shadow-md">
                        <div class="w-5 h-5 flex items-center justify-center shrink-0">
                            <img src="{{ asset('storage/' . $category->icon) }}" alt="icon" class="w-full h-full object-contain" />
                        </div>
                        <span class="text-xs font-bold text-zinc-200 group-hover:text-[#d4b26f] transition-colors font-[Poppins]">{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- Latest Articles Section --}}
        <section id="Up-to-date" class="container mx-auto px-5 lg:px-20 max-w-7xl mb-20">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
                <div>
                    <span class="text-[10px] text-[#d4b26f] font-bold uppercase tracking-widest">Update Terkini</span>
                    <h2 class="font-black text-2xl md:text-3xl leading-tight text-white tracking-tight font-[Poppins] mt-0.5">
                        Kabar Utama & Terbaru
                    </h2>
                </div>
                <div>
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] text-slate-950 font-black text-[10px] uppercase tracking-wider rounded-full shadow-lg">
                        <span class="w-2 h-2 rounded-full bg-slate-950 animate-pulse"></span>
                        Terbaru
                    </span>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
                @forelse($articles as $article)
                    <a href="{{ route('front.details', $article->slug) }}"
                        class="group flex flex-col h-full rounded-2xl bg-slate-50 text-slate-900 border border-slate-200/90 shadow-md hover:shadow-2xl hover:border-[#c5a059]/40 hover:-translate-y-1.5 transition-all duration-300 overflow-hidden">
                        
                        {{-- Thumbnail --}}
                        <div class="w-full h-[200px] overflow-hidden relative shrink-0">
                            <span class="px-3 py-1 bg-slate-900/90 backdrop-blur-md text-[#d4b26f] border border-[#c5a059]/30 rounded-full absolute top-3 left-3 z-20 text-[9px] font-extrabold uppercase tracking-wider shadow-md">
                                {{ $article->category->name }}
                            </span>
                            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500"
                                alt="thumbnail"
                                onerror="this.onerror=null;this.src='{{ asset('assets/images/siapindo/carousel-1.webp') }}';" />
                        </div>

                        {{-- Card Info --}}
                        <div class="p-5 flex flex-col justify-between flex-grow gap-4">
                            <div class="space-y-2">
                                <h3 class="font-bold text-base sm:text-lg leading-snug text-slate-900 group-hover:text-[#b38e46] transition-colors duration-300 line-clamp-2 font-[Poppins]">
                                    {{ $article->name }}
                                </h3>
                                <p class="text-slate-600 text-xs line-clamp-2 leading-relaxed font-[Inter]">
                                    {{ Str::limit(strip_tags($article->content), 95) }}
                                </p>
                            </div>
                            
                            <div class="flex items-center justify-between border-t border-slate-200/80 pt-3.5 mt-auto">
                                <p class="text-[11px] text-slate-500 font-semibold flex items-center gap-1.5 font-[Inter]">
                                    <i class="far fa-calendar-alt text-[#c5a059]"></i>
                                    {{ $article->created_at->format('d M Y') }}
                                </p>
                                <span class="text-xs text-[#aa7c11] font-extrabold group-hover:text-[#b38e46] flex items-center gap-1 transition-colors uppercase tracking-wider">
                                    Baca <i class="fas fa-arrow-right text-[10px] transform group-hover:translate-x-1 transition-transform"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12 bg-slate-900/30 border border-white/10 rounded-2xl text-zinc-400">
                        Belum ada berita terbaru...
                    </div>
                @endforelse
            </div>
        </section>

        {{-- Dynamic Category Sections --}}
        @foreach ($categories as $category)
            @if ($category_sections[$category->slug]['featured'] || count($category_sections[$category->slug]['articles']) > 0)
                <section id="Latest-{{ $category->slug }}" class="container mx-auto px-5 lg:px-20 max-w-7xl mb-20">
                    <div class="flex items-center justify-between border-b border-white/10 pb-4 mb-8">
                        <div>
                            <span class="text-[10px] text-[#d4b26f] font-bold uppercase tracking-widest">Kategori Terpilih</span>
                            <h2 class="font-black text-xl md:text-2xl text-white tracking-tight mt-0.5 font-[Poppins]">
                                Topik: <span class="bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent">{{ $category->name }}</span>
                            </h2>
                        </div>
                        <a href="{{ route('front.category', $category->slug) }}"
                            class="px-5 py-2 bg-[#c5a059]/10 border border-[#c5a059]/30 text-[#d4b26f] hover:bg-gradient-to-r hover:from-[#e6c687] hover:to-[#aa7c11] hover:text-slate-950 font-bold text-xs uppercase tracking-wider rounded-full transition-all duration-300 shadow-md">
                            Lihat Semua
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
                        {{-- Featured Article under Category --}}
                        @if ($category_sections[$category->slug]['featured'])
                            @php $catFeatured = $category_sections[$category->slug]['featured']; @endphp
                            <a href="{{ route('front.details', $catFeatured->slug) }}" 
                                class="group flex flex-col h-full rounded-2xl bg-slate-50 text-slate-900 border border-slate-200/90 shadow-md hover:shadow-2xl hover:border-[#c5a059]/40 hover:-translate-y-1.5 transition-all duration-300 overflow-hidden">
                                <div class="w-full h-[190px] relative overflow-hidden shrink-0">
                                    <span class="px-3 py-1 bg-[#c5a059] text-slate-950 rounded-full absolute top-3 left-3 z-20 text-[9px] font-black uppercase tracking-wider shadow-md">
                                        Sorotan
                                    </span>
                                    <img src="{{ asset('storage/' . $catFeatured->thumbnail) }}" alt="featured-thumbnail" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500" onerror="this.onerror=null;this.src='{{ asset('assets/images/siapindo/carousel-1.webp') }}';" />
                                </div>
                                <div class="p-5 flex flex-col justify-between flex-grow gap-4">
                                    <div class="space-y-2">
                                        <h3 class="font-bold text-base sm:text-lg text-slate-900 group-hover:text-[#b38e46] transition-all duration-300 line-clamp-2 leading-snug font-[Poppins]">
                                            {{ $catFeatured->name }}
                                        </h3>
                                        <p class="text-slate-600 text-xs line-clamp-2 leading-relaxed font-[Inter]">
                                            {{ Str::limit(strip_tags($catFeatured->content), 95) }}
                                        </p>
                                    </div>
                                    <div class="flex items-center justify-between border-t border-slate-200/80 pt-3.5 mt-auto">
                                        <p class="text-[11px] text-slate-500 font-semibold flex items-center gap-1.5 font-[Inter]">
                                            <i class="far fa-calendar-alt text-[#c5a059]"></i>
                                            {{ $catFeatured->created_at->format('d M Y') }}
                                        </p>
                                        <span class="text-xs text-[#aa7c11] font-extrabold group-hover:text-[#b38e46] flex items-center gap-1 transition-colors uppercase tracking-wider">
                                            Baca <i class="fas fa-arrow-right text-[10px] transform group-hover:translate-x-1 transition-transform"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endif

                        {{-- Secondary Articles under Category --}}
                        @foreach($category_sections[$category->slug]['articles']->take(2) as $article)
                            <a href="{{ route('front.details', $article->slug) }}" 
                                class="group flex flex-col h-full rounded-2xl bg-slate-50 text-slate-900 border border-slate-200/90 shadow-md hover:shadow-2xl hover:border-[#c5a059]/40 hover:-translate-y-1.5 transition-all duration-300 overflow-hidden">
                                <div class="w-full h-[190px] relative overflow-hidden shrink-0">
                                    <span class="px-3 py-1 bg-slate-900/90 text-[#d4b26f] border border-[#c5a059]/30 rounded-full absolute top-3 left-3 z-20 text-[9px] font-bold uppercase tracking-wider shadow-md">
                                        {{ $article->category->name }}
                                    </span>
                                    <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="thumbnail" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500" onerror="this.onerror=null;this.src='{{ asset('assets/images/siapindo/carousel-1.webp') }}';" />
                                </div>
                                <div class="p-5 flex flex-col justify-between flex-grow gap-4">
                                    <div class="space-y-2">
                                        <h3 class="font-bold text-base sm:text-lg text-slate-900 group-hover:text-[#b38e46] transition-all duration-300 line-clamp-2 leading-snug font-[Poppins]">
                                            {{ $article->name }}
                                        </h3>
                                        <p class="text-slate-600 text-xs line-clamp-2 leading-relaxed font-[Inter]">
                                            {{ Str::limit(strip_tags($article->content), 95) }}
                                        </p>
                                    </div>
                                    <div class="flex items-center justify-between border-t border-slate-200/80 pt-3.5 mt-auto">
                                        <p class="text-[11px] text-slate-500 font-semibold flex items-center gap-1.5 font-[Inter]">
                                            <i class="far fa-calendar-alt text-[#c5a059]"></i>
                                            {{ $article->created_at->format('d M Y') }}
                                        </p>
                                        <span class="text-xs text-[#aa7c11] font-extrabold group-hover:text-[#b38e46] flex items-center gap-1 transition-colors uppercase tracking-wider">
                                            Baca <i class="fas fa-arrow-right text-[10px] transform group-hover:translate-x-1 transition-transform"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        @endforeach

        {{-- Interactive Newsletter / Training Consultation CTA Widget --}}
        <section class="container mx-auto px-5 lg:px-20 max-w-7xl mb-20">
            <div class="relative rounded-3xl bg-gradient-to-r from-slate-900 via-[#0f172a] to-slate-900 border border-[#c5a059]/30 p-8 sm:p-12 overflow-hidden shadow-2xl">
                <!-- Background Ambient Lights -->
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-amber-500/10 rounded-full blur-[100px] pointer-events-none"></div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-8 space-y-3 text-center lg:text-left">
                        <span class="px-3.5 py-1 bg-[#c5a059]/15 border border-[#c5a059]/30 text-[#d4b26f] rounded-full text-xs font-extrabold uppercase tracking-widest inline-flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                            Konsultasi In-House Training & Keprotokolan
                        </span>
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white font-[Poppins] tracking-tight leading-tight">
                            Butuh Program Pelatihan Khusus untuk Instansi Anda?
                        </h3>
                        <p class="text-zinc-300 text-xs sm:text-sm max-w-2xl leading-relaxed">
                            Tim konsultan kami siap membantu merancang kurikulum in-house training keprotokolan, bimtek, public speaking, dan grooming sesuai kebutuhan instansi Anda.
                        </p>
                    </div>

                    <div class="lg:col-span-4 flex justify-center lg:justify-end shrink-0">
                        @php
                            $waUrl = 'https://wa.me/628118087899?text=Halo%20Admin%20Siap%20Indonesia,%20saya%20tertarik%20konsultasi%20pelatihan';
                        @endphp
                        <a href="{{ $waUrl }}" target="_blank"
                            class="px-8 py-4 bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] hover:from-[#edd1a1] hover:to-[#8a6109] text-slate-950 font-black text-xs uppercase tracking-wider rounded-full shadow-[0_10px_25px_-5px_rgba(197,160,89,0.4)] hover:scale-[1.03] transition-all duration-300 flex items-center gap-2.5">
                            <i class="fab fa-whatsapp text-base"></i>
                            <span>Hubungi Konsultan</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Advertisement Section --}}
        <x-banner-ad :bannerads="$bannerads" />

        <div class="mt-auto w-full">
            <x-footer />
        </div>
    </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/filament/testi.css') }}">
@endpush

@push('after-scripts')
    <script src="{{ asset('js/two-lines-text.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="{{ asset('js/carousel.js') }}"></script>
@endpush

