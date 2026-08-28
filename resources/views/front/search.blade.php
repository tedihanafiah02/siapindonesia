@extends('front.master')
@section('title', 'Pencarian: "' . $keyword . '" | Siap Indonesia')
@section('description', 'Hasil pencarian berita keprotokolan dan SDM untuk kata kunci: ' . $keyword)
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

        {{-- Navbar Category --}}
        <section class="container mx-auto px-5 lg:px-20 mb-10">
            <h2 class="text-zinc-300 text-center text-xs md:text-sm font-bold uppercase tracking-wider mb-4">Telusuri Kategori</h2>
            <nav id="Category"
                class="flex justify-start md:justify-center items-center overflow-x-auto gap-3 pb-3 snap-x snap-mandatory">
                @foreach ($categories as $category)
                    <a href="{{ route('front.category', $category->slug) }}"
                        class="snap-start category-chip whitespace-nowrap">
                        <div class="flex w-5 h-5 shrink-0">
                            <img src="{{ asset('storage/' . $category->icon) }}" alt="icon"
                                class="w-full h-full object-contain" />
                        </div>
                        <span>{{ $category->name }}</span>
                    </a>
                @endforeach
            </nav>
        </section>

        <!-- Heading & Search Input Section -->
        <section id="heading" class="container mx-auto px-5 lg:px-20 flex items-center flex-col gap-6 mt-10">
            <div class="text-center flex flex-col items-center gap-1.5">
                <span class="news-badge bg-amber-500/10 text-amber-400 border-amber-500/20">
                    Pencarian Berita
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight leading-tight mt-1">
                    Cari Berita Terkini
                </h1>
            </div>

            <form action="{{ route('front.search') }}" method="GET" class="w-full max-w-[550px]">
                <label for="search-bar"
                    class="w-full flex items-center px-5 py-3.5 transition-all duration-300 gap-3 border border-white/5 bg-slate-900/40 focus-within:border-amber-500/40 focus-within:ring-2 focus-within:ring-amber-500/10 rounded-full group shadow-2xl backdrop-blur-md">
                    <div class="w-5 h-5 flex items-center justify-center text-zinc-400 group-focus-within:text-amber-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" />
                        </svg>
                    </div>
                    <input autocomplete="off" type="text" id="search-bar" name="keyword"
                        placeholder="Ketik kata kunci berita..."
                        value="{{ $keyword }}"
                        class="bg-transparent border-none text-zinc-100 placeholder:text-zinc-500 text-sm outline-none focus:ring-0 w-full" />
                </label>
            </form>
        </section>

        <!-- Search Result Section -->
        <section id="search-result"
            class="container mx-auto px-5 lg:px-20 flex items-start flex-col gap-6 mt-16 mb-20 w-full">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white tracking-tight">
                Hasil Pencarian: <span class="text-amber-400 font-sans">"{{ $keyword }}"</span>
            </h2>

            <div id="search-cards" class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 items-stretch mt-2">
                @forelse($articles as $article)
                    <a href="{{ route('front.details', $article->slug) }}" class="group premium-news-card flex flex-col h-full overflow-hidden">
                        {{-- Thumbnail --}}
                        <div class="thumbnail-container h-[210px] relative overflow-hidden flex-shrink-0 border-b border-white/5">
                            <span class="news-badge absolute top-4 left-4 z-20">
                                {{ $article->category->name }}
                            </span>
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="thumbnail-img"
                                class="w-full h-full object-cover img-zoom-child" />
                        </div>

                        {{-- Card Info --}}
                        <div class="p-6 flex flex-col justify-between flex-grow gap-4">
                            <div class="flex flex-col gap-2.5">
                                <h3 class="text-base md:text-lg leading-snug font-bold text-zinc-100 group-hover:text-amber-400 transition-colors duration-300 line-clamp-2">
                                    {{ $article->name }}
                                </h3>
                                <p class="text-zinc-400 text-xs line-clamp-2 leading-relaxed">
                                    {{ Str::limit(strip_tags($article->content), 90) }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between border-t border-white/5 pt-4 mt-2">
                                <p class="text-xs text-zinc-500 flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-amber-500/75">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                    </svg>
                                    {{ $article->created_at->format('M d, Y') }}
                                </p>
                                <span class="text-xs text-amber-500 font-bold group-hover:text-amber-400 flex items-center gap-0.5 transition-colors">
                                    Baca <span class="transform group-hover:translate-x-0.5 transition-transform">→</span>
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center text-zinc-500 py-16 bg-slate-900/10 border border-white/5 rounded-[24px] w-full">
                        Tidak ada artikel yang cocok dengan kata kunci "{{ $keyword }}".
                    </div>
                @endforelse
            </div>
        </section>

        <div class="mt-auto w-full">
            <x-footer />
        </div>
    </div>
@endsection
