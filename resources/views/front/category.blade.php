@extends('front.master')
@section('title', 'Kategori: ' . $category->name . ' | Siap Indonesia')
@section('description', 'Kumpulan berita dan artikel keprotokolan terupdate untuk kategori ' . $category->name)
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

        {{-- Category Result Section --}}
        <section id="Category-result"
            class="container mx-auto flex items-center flex-col gap-[30px] px-5 lg:px-20 mt-10">
            {{-- Title --}}
            <div class="text-center flex flex-col items-center gap-2">
                <span class="news-badge bg-amber-500/10 text-amber-400 border-amber-500/20">
                    Eksplorasi Kategori
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight leading-tight mt-1">
                    Kategori: <span class="text-amber-400 font-[Poppins]">{{ $category->name }}</span>
                </h1>
                <p class="text-zinc-400 text-sm max-w-md mt-1">Menampilkan seluruh arsip berita dan edukasi seputar {{ $category->name }}.</p>
            </div>

            {{-- Content Cards --}}
            <div id="search-cards" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 w-full items-stretch mt-6">
                @forelse($category->news as $news)
                    <a href="{{ route('front.details', $news->slug) }}" class="group premium-news-card flex flex-col h-full overflow-hidden">
                        {{-- Thumbnail --}}
                        <div class="thumbnail-container h-[210px] relative overflow-hidden flex-shrink-0 border-b border-white/5">
                            <span class="news-badge absolute top-4 left-4 z-20">
                                {{ $news->category->name }}
                            </span>
                            <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="thumbnail foto"
                                class="object-cover w-full h-full img-zoom-child" />
                        </div>

                        {{-- Card Info --}}
                        <div class="p-6 flex flex-col justify-between flex-grow gap-4">
                            <div class="flex flex-col gap-2.5">
                                <h3 class="text-base md:text-lg leading-snug font-bold text-zinc-100 group-hover:text-amber-400 transition-colors duration-300 line-clamp-2">
                                    {{ $news->name }}
                                </h3>
                                <p class="text-zinc-400 text-xs line-clamp-2 leading-relaxed">
                                    {{ Str::limit(strip_tags($news->content), 90) }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between border-t border-white/5 pt-4 mt-2">
                                <p class="text-xs text-zinc-500 flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-amber-500/75">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                    </svg>
                                    {{ $news->created_at->format('M d, Y') }}
                                </p>
                                <span class="text-xs text-amber-500 font-bold group-hover:text-amber-400 flex items-center gap-0.5 transition-colors">
                                    Baca <span class="transform group-hover:translate-x-0.5 transition-transform">→</span>
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center text-zinc-500 py-16 bg-slate-900/10 border border-white/5 rounded-[24px]">
                        Belum ada berita terkait kategori berikut.
                    </div>
                @endforelse
            </div>
        </section>

        {{-- Advertisement Section --}}
        <x-banner-ad :bannerads="$bannerads" />

        <div class="mt-auto w-full">
            <x-footer />
        </div>
    </div>
@endsection
