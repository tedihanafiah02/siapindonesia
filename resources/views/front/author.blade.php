@extends('front.master')
@section('title', 'Penulis: ' . $author->name . ' | Siap Indonesia')
@section('description', 'Kumpulan berita dan tulisan edukatif oleh ' . $author->name)
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

        {{-- Author Section --}}
        <section id="author"
            class="max-w-7xl mx-auto flex items-center flex-col gap-8 px-5 lg:px-20 mt-10">
            
            {{-- Author Profile Card --}}
            <div class="premium-news-card bg-neutral-950/50 p-6 md:p-8 border border-white/5 rounded-3xl flex flex-col md:flex-row items-center gap-6 md:gap-8 w-full shadow-2xl">
                <div class="w-20 h-20 md:w-24 md:h-24 rounded-full overflow-hidden border-2 border-yellow-500 shrink-0 shadow-xl shadow-yellow-500/10">
                    <img src="{{ asset('storage/' . $author->avatar) }}" alt="profile-img"
                        class="w-full h-full object-cover" />
                </div>
                <div class="flex flex-col text-center md:text-left gap-1 flex-grow">
                    <span class="news-badge bg-yellow-500/10 text-yellow-400 border-yellow-500/20 w-fit mx-auto md:mx-0">
                        Penulis Kontributor
                    </span>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-white mt-1 leading-none">
                        {{ $author->name }}
                    </h1>
                    <p class="text-sm text-zinc-400 mt-0.5">{{ $author->occupation }}</p>
                    <div class="flex items-center gap-2 mt-3 text-xs text-zinc-400 justify-center md:justify-start">
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-yellow-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                            {{ count($author->news) }} Artikel Ditulis
                        </span>
                    </div>
                </div>
            </div>

            {{-- Title --}}
            <div class="w-full text-left mt-6 border-b border-white/5 pb-3">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white tracking-tight">Koleksi Artikel Ditulis</h2>
            </div>

            {{-- Content Cards --}}
            <div id="content-cards" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 w-full items-stretch">
                @forelse($author->news as $news)
                    <a href="{{ route('front.details', $news->slug) }}" class="group premium-news-card flex flex-col h-full overflow-hidden">
                        {{-- Thumbnail --}}
                        <div class="thumbnail-container h-[200px] relative overflow-hidden flex-shrink-0 border-b border-white/5">
                            <span class="news-badge absolute top-4 left-4 z-20">
                                {{ $news->category->name }}
                            </span>
                            <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="thumbnail photo"
                                class="object-cover w-full h-full img-zoom-child" />
                        </div>

                        {{-- Card Info --}}
                        <div class="p-6 flex flex-col justify-between flex-grow gap-4">
                            <div class="flex flex-col gap-2">
                                <h3 class="text-base md:text-lg leading-snug font-bold text-zinc-100 group-hover:text-yellow-400 transition-colors duration-300 line-clamp-2">
                                    {{ $news->name }}
                                </h3>
                                <p class="text-xs text-zinc-400 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-yellow-500/75">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                    </svg>
                                    {{ $news->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center text-zinc-500 py-12 bg-[#0c101a] border border-white/5 rounded-3xl">
                        Belum ada data artikel yang ditulis.
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
