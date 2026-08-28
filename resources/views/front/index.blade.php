@extends('front.master')
@section('title', 'Siap Indonesia | Berita Terkini & Keprotokolan')
@section('description', 'Portal berita, info keprotokolan terbaru, dan artikel bimbingan kompetensi SDM.')
@section('content')

    <style>
        .custom-navbar-offset {
            margin-top: 125px;
        }
        @media (min-width: 768px) {
            .custom-navbar-offset {
                margin-top: 160px;
            }
        }
    </style>
    <div class="w-full flex-grow flex flex-col custom-navbar-offset">
        <x-navbar />

        {{-- Section Featured: BBC / Bloomberg-style Grid --}}
        <section id="Featured" class="container mx-auto px-5 lg:px-20 max-w-7xl mb-16 mt-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
                {{-- Left: Main Featured Article (Spans 7 columns) --}}
                @if ($featured_articles->isNotEmpty())
                    @php $mainFeatured = $featured_articles->first(); @endphp
                    <div class="lg:col-span-7">
                        <div class="group premium-news-card relative h-[340px] md:h-[450px] rounded-[24px] overflow-hidden border border-white/5 shadow-2xl flex flex-col justify-end transition-all duration-500">
                            <img src="{{ asset('storage/' . $mainFeatured->thumbnail) }}" class="absolute inset-0 w-full h-full object-cover img-zoom-child" alt="featured">
                            <div class="absolute inset-0 bg-gradient-to-t from-neutral-950 via-neutral-950/60 to-transparent z-10"></div>
                            <div class="relative z-20 p-5 md:p-7 flex flex-col gap-2.5">
                                <div>
                                    <span class="news-badge bg-[#c5a059]/10 text-[#d4b26f] border-[#c5a059]/25">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Sorotan Utama
                                    </span>
                                </div>
                                <a href="{{ route('front.details', $mainFeatured->slug) }}" class="block">
                                    <h2 class="font-extrabold text-lg md:text-xl lg:text-2xl text-white group-hover:text-[#d4b26f] transition-colors duration-300 leading-tight tracking-tight font-[Poppins]">
                                        {{ $mainFeatured->name }}
                                    </h2>
                                </a>
                                <p class="text-zinc-400 text-xs flex items-center gap-1.5 mt-1 font-[Inter]">
                                    <i class="far fa-calendar-alt text-[#c5a059]"></i>
                                    {{ $mainFeatured->created_at->format('M d, Y') }} • <span class="text-[#d4b26f] font-semibold">{{ $mainFeatured->category->name }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Right: Vertical list of 3 other featured articles (Spans 5 columns) --}}
                <div class="lg:col-span-5 flex flex-col gap-3 justify-between">
                    @forelse($featured_articles->skip(1)->take(3) as $featured)
                        <div class="group flex gap-4 p-3 rounded-[20px] border border-white/5 bg-slate-900/30 hover:border-[#c5a059]/25 hover:bg-slate-900/50 hover:-translate-y-0.5 transition-all duration-300 flex-1 items-center">
                            <div class="w-20 h-16 md:w-24 md:h-20 rounded-xl overflow-hidden img-zoom-parent border border-white/5 shrink-0">
                                <a href="{{ route('front.details', $featured->slug) }}" class="block w-full h-full">
                                    <img src="{{ asset('storage/' . $featured->thumbnail) }}" alt="featured" class="w-full h-full object-cover img-zoom-child">
                                </a>
                            </div>
                            <div class="flex flex-col justify-center gap-1 py-1">
                                <span class="text-[9px] text-[#d4b26f] font-bold uppercase tracking-wider">
                                    {{ $featured->category->name }}
                                </span>
                                <a href="{{ route('front.details', $featured->slug) }}">
                                    <h3 class="text-xs font-bold text-zinc-100 group-hover:text-[#d4b26f] transition-colors leading-snug line-clamp-2 font-[Poppins]">
                                        {{ $featured->name }}
                                    </h3>
                                </a>
                                <p class="text-[9px] text-zinc-500 flex items-center gap-1">
                                    <i class="far fa-calendar-alt text-[#c5a059]/75"></i>
                                    {{ $featured->created_at->format('d M, Y') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="h-full flex items-center justify-center border border-white/5 rounded-[20px] p-6 bg-slate-900/10">
                            <p class="text-zinc-500 text-xs">Belum ada sorotan berita lainnya.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Navbar Category --}}
        <section class="container mx-auto px-5 lg:px-20 max-w-7xl mb-16">
            <div class="text-center flex flex-col items-center gap-1.5 mb-6">
                <span class="text-[10px] text-[#d4b26f] font-bold uppercase tracking-widest">Temukan Topik</span>
                <h2 class="text-zinc-100 text-2xl md:text-3xl font-extrabold tracking-tight font-[Poppins]">Kategori Berita</h2>
            </div>
            <nav id="Category"
                class="flex justify-start md:justify-center items-center overflow-x-auto gap-3 pb-3 snap-x snap-mandatory news-scrollbar">
                @foreach ($categories as $category)
                    <a href="{{ route('front.category', $category->slug) }}"
                        class="snap-start category-chip whitespace-nowrap">
                        <div class="flex w-4 h-4 shrink-0">
                            <img src="{{ asset('storage/' . $category->icon) }}" alt="icon"
                                class="w-full h-full object-contain" />
                        </div>
                        <span>{{ $category->name }}</span>
                    </a>
                @endforeach
            </nav>
        </section>

        {{-- Latest Hot News Section --}}
        <section id="Up-to-date" class="container mx-auto px-5 lg:px-20 max-w-7xl mb-20">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="font-extrabold text-2xl md:text-3xl leading-tight text-white tracking-tight font-[Poppins]">
                        Kabar Utama & Terbaru
                    </h2>
                    <p class="text-zinc-400 text-xs mt-1">Inspirasi & informasi keprotokolan paling up-to-date</p>
                </div>
                <div class="w-fit">
                    <span class="flex items-center gap-1.5 px-4 py-1.5 bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] text-neutral-950 font-bold text-[10px] uppercase tracking-wider rounded-full shadow-lg">
                        <span class="w-2 h-2 rounded-full bg-neutral-950 animate-pulse"></span>
                        Terbaru
                    </span>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6 items-stretch">
                @forelse($articles as $article)
                    <a href="{{ route('front.details', $article->slug) }}"
                        class="group premium-news-card flex flex-col h-full overflow-hidden border border-white/5 hover:border-[#c5a059]/25 hover:bg-slate-900/50 transition-all duration-300">
                        
                        {{-- Thumbnail --}}
                        <div class="thumbnail-container w-full h-[180px] sm:h-[190px] overflow-hidden relative flex-shrink-0 border-b border-white/5">
                            <span class="news-badge bg-[#c5a059]/20 text-[#d4b26f] border-[#c5a059]/40 absolute top-3 left-3 z-20 text-[9px]">
                                {{ $article->category->name }}
                            </span>
                            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                class="object-cover w-full h-full img-zoom-child"
                                alt="thumbnail" />
                        </div>

                        {{-- Card Info --}}
                        <div class="p-5 flex flex-col justify-between flex-grow gap-3">
                            <div class="flex flex-col gap-2">
                                <h3 class="font-bold text-sm sm:text-base leading-snug text-zinc-100 group-hover:text-[#d4b26f] transition-colors duration-300 line-clamp-2 font-[Poppins]">
                                    {{ $article->name }}
                                </h3>
                                <p class="text-zinc-400 text-[11px] sm:text-xs line-clamp-2 leading-relaxed font-[Inter]">
                                    {{ Str::limit(strip_tags($article->content), 90) }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between border-t border-white/5 pt-3.5 mt-1">
                                <p class="text-[10px] text-zinc-500 flex items-center gap-1 font-[Inter]">
                                    <i class="far fa-calendar-alt text-[#c5a059]/75"></i>
                                    {{ $article->created_at->format('M d, Y') }}
                                </p>
                                <span class="text-[10px] text-[#c5a059] font-bold group-hover:text-[#d4b26f] flex items-center gap-0.5 transition-colors uppercase tracking-wider">
                                    Baca <i class="fas fa-arrow-right text-[8px] transform group-hover:translate-x-0.5 transition-transform"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-center text-zinc-500 py-12 bg-slate-900/10 border border-white/5 rounded-[24px]">Belum ada berita terbaru...</p>
                @endforelse
            </div>
        </section>



        {{-- Latest For You Sections (Category Loops) --}}
        @foreach ($categories as $category)
            @if ($category_sections[$category->slug]['featured'] || count($category_sections[$category->slug]['articles']) > 0)
                <section id="Latest-{{ $category->slug }}" class="container mx-auto px-5 lg:px-20 max-w-7xl mb-20">
                    <div class="flex items-center justify-between border-b border-white/5 pb-4 mb-8">
                        <div>
                            <span class="text-[10px] text-[#d4b26f] font-bold uppercase tracking-widest">Kategori Terpilih</span>
                            <h2 class="font-extrabold text-lg md:text-xl text-white tracking-tight mt-0.5">
                                Sorotan: <span class="text-[#d4b26f] font-[Poppins]">{{ $category->name }}</span>
                            </h2>
                        </div>
                        <a href="{{ route('front.category', $category->slug) }}"
                            class="px-5 py-2.5 bg-[#c5a059]/10 border border-[#c5a059]/20 text-[#d4b26f] hover:bg-gradient-to-r hover:from-[#e6c687] hover:to-[#aa7c11] hover:text-neutral-950 font-bold text-xs uppercase tracking-wider rounded-full shadow-lg transition-all duration-300">
                            Eksplorasi
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6 items-stretch">
                        {{-- Featured Article under Category --}}
                        @if ($category_sections[$category->slug]['featured'])
                            <a href="{{ route('front.details', $category_sections[$category->slug]['featured']->slug) }}" 
                                class="group premium-news-card flex flex-col h-full overflow-hidden border border-white/5 hover:border-[#c5a059]/25 hover:bg-slate-900/50 transition-all duration-300">
                                <div class="thumbnail-container h-[180px] sm:h-[190px] relative overflow-hidden flex-shrink-0 border-b border-white/5">
                                    <span class="news-badge bg-[#c5a059]/20 text-[#d4b26f] border-[#c5a059]/40 absolute top-3 left-3 z-20 text-[9px]">Sorotan</span>
                                    <img src="{{ asset('storage/' . $category_sections[$category->slug]['featured']->thumbnail) }}" alt="featured-thumbnail" class="object-cover w-full h-full img-zoom-child" />
                                </div>
                                <div class="p-5 flex flex-col justify-between flex-grow gap-3">
                                    <div class="flex flex-col gap-2">
                                        <h3 class="font-bold text-sm sm:text-base text-zinc-100 group-hover:text-[#d4b26f] transition-all duration-300 line-clamp-2 leading-snug font-[Poppins]">
                                            {{ $category_sections[$category->slug]['featured']->name }}
                                        </h3>
                                        <p class="text-zinc-400 text-[11px] sm:text-xs line-clamp-2 leading-relaxed font-[Inter]">
                                            {{ Str::limit(strip_tags($category_sections[$category->slug]['featured']->content), 90) }}
                                        </p>
                                    </div>
                                    <div class="flex items-center justify-between border-t border-white/5 pt-3.5 mt-1">
                                        <p class="text-[10px] text-zinc-500 flex items-center gap-1.5 font-[Inter]">
                                            <i class="far fa-calendar-alt text-[#c5a059]"></i>
                                            {{ $category_sections[$category->slug]['featured']->created_at->format('M d, Y') }}
                                        </p>
                                        <span class="text-[10px] text-[#c5a059] font-bold group-hover:text-[#d4b26f] flex items-center gap-0.5 transition-colors uppercase tracking-wider">
                                            Baca <i class="fas fa-arrow-right text-[8px] transform group-hover:translate-x-0.5 transition-transform"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endif

                        {{-- Secondary Articles under Category --}}
                        @foreach($category_sections[$category->slug]['articles']->take(2) as $article)
                            <a href="{{ route('front.details', $article->slug) }}" 
                                class="group premium-news-card flex flex-col h-full overflow-hidden border border-white/5 hover:border-[#c5a059]/25 hover:bg-slate-900/50 transition-all duration-300">
                                <div class="thumbnail-container h-[180px] sm:h-[190px] relative overflow-hidden flex-shrink-0 border-b border-white/5">
                                    <span class="news-badge bg-[#c5a059]/20 text-[#d4b26f] border-[#c5a059]/40 absolute top-3 left-3 z-20 text-[9px]">{{ $article->category->name }}</span>
                                    <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="thumbnail" class="object-cover w-full h-full img-zoom-child" />
                                </div>
                                <div class="p-5 flex flex-col justify-between flex-grow gap-3">
                                    <div class="flex flex-col gap-2">
                                        <h3 class="font-bold text-sm sm:text-base text-zinc-100 group-hover:text-[#d4b26f] transition-all duration-300 line-clamp-2 leading-snug font-[Poppins]">
                                            {{ $article->name }}
                                        </h3>
                                        <p class="text-zinc-400 text-[11px] sm:text-xs line-clamp-2 leading-relaxed font-[Inter]">
                                            {{ Str::limit(strip_tags($article->content), 90) }}
                                        </p>
                                    </div>
                                    <div class="flex items-center justify-between border-t border-white/5 pt-3.5 mt-1">
                                        <p class="text-[10px] text-zinc-500 flex items-center gap-1.5 font-[Inter]">
                                            <i class="far fa-calendar-alt text-[#c5a059]"></i>
                                            {{ $article->created_at->format('M d, Y') }}
                                        </p>
                                        <span class="text-[10px] text-[#c5a059] font-bold group-hover:text-[#d4b26f] flex items-center gap-0.5 transition-colors uppercase tracking-wider">
                                            Baca <i class="fas fa-arrow-right text-[8px] transform group-hover:translate-x-0.5 transition-transform"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        @endforeach

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

