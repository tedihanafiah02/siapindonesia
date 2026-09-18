@extends('front.master')

@section('title', $articleNews->name . ' Blog | Siap Indonesia')
@section('description', Str::limit(strip_tags($articleNews->content), 160))
@section('keywords', $articleNews->tags)

@section('og_title', $articleNews->name)
@section('og_description', Str::limit(strip_tags($articleNews->content), 160))
@section('og_image', asset('storage/' . $articleNews->thumbnail))
@section('og_type', 'article')

@section('twitter_title', $articleNews->name)
@section('twitter_description', Str::limit(strip_tags($articleNews->content), 160))
@section('twitter_image', asset('storage/' . $articleNews->thumbnail))

@section('schema')
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "{{ $articleNews->title }}",
  "datePublished": "{{ $articleNews->created_at->toIso8601String() }}",
  "image": ["{{ asset('storage/' . $articleNews->thumbnail) }}"]
}
</script>
@endsection

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

        {{-- Centered Modern Header --}}
        <header class="container mx-auto px-5 lg:px-20 max-w-7xl mt-8 mb-10 text-center flex flex-col items-center">
            {{-- Breadcrumbs --}}
            <div class="flex items-center gap-2.5 text-xs text-zinc-400 mb-4 justify-center">
                <a href="{{ route('front.index') }}" class="hover:text-amber-500 transition-colors">Berita</a>
                <span>/</span>
                <a href="{{ route('front.category', $articleNews->category->slug) }}" class="hover:text-amber-500 transition-colors font-semibold text-amber-500">
                    {{ $articleNews->category->name }}
                </a>
            </div>
            
            {{-- Main Title --}}
            <h1 id="Title"
                class="font-black text-3xl sm:text-4xl md:text-5xl lg:text-6xl leading-tight text-white tracking-tight max-w-4xl mx-auto font-[Poppins]">
                {{ $articleNews->name }}
            </h1>
            
            {{-- Author Metadata --}}
            <div class="flex items-center gap-4 mt-6 text-zinc-400 text-xs md:text-sm border-t border-white/5 pt-6 w-full max-w-xl justify-center">
                <div class="flex items-center gap-3 text-left">
                    <div class="w-10 h-10 rounded-full overflow-hidden border border-white/10 shrink-0">
                        <img src="{{ $articleNews->author && $articleNews->author->avatar ? asset('storage/' . $articleNews->author->avatar) : asset('assets/images/siapindo/speaker-default.png') }}" class="w-full h-full object-cover" alt="{{ $articleNews->author->name ?? 'Author' }}" onerror="this.onerror=null;this.src='{{ asset('assets/images/siapindo/speaker-default.png') }}';" />
                    </div>
                    <div>
                        <p class="text-white font-semibold text-xs sm:text-sm">{{ $articleNews->author->name ?? 'Admin' }}</p>
                        <p class="text-[9px] sm:text-[10px] text-zinc-500 uppercase tracking-wider">{{ $articleNews->author->occupation ?? 'Editor' }}</p>
                    </div>
                </div>
                
                <span class="h-6 w-px bg-white/10"></span>
                
                <p class="flex items-center gap-1.5 text-zinc-400 text-xs sm:text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-amber-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    {{ $articleNews->created_at->format('M d, Y') }}
                </p>
            </div>
        </header>

        {{-- Wide Covered Image --}}
        <div class="container mx-auto px-5 lg:px-20 max-w-7xl mb-12">
            <div class="w-full aspect-[21/9] md:aspect-[16/7] rounded-[24px] overflow-hidden shadow-2xl border border-white/5 image-glow">
                <img src="{{ asset('storage/' . $articleNews->thumbnail) }}" class="object-cover w-full h-full"
                    alt="cover thumbnail"
                    onerror="this.onerror=null;this.src='{{ asset('assets/images/siapindo/carousel-1.webp') }}';">
            </div>
        </div>

        {{-- Article Layout Grid --}}
        <section id="Article-container"
            class="container mx-auto flex flex-col lg:flex-row gap-8 lg:gap-12 mt-4 px-5 lg:px-20 max-w-7xl relative">
            
            {{-- Left: Floating Share Bar (Desktop Only) --}}
            <div class="hidden lg:flex flex-col items-center gap-4 sticky top-36 w-12 shrink-0 self-start mr-4">
                <span class="text-[9px] text-zinc-500 uppercase tracking-widest font-bold rotate-180 write-vertical mb-2 select-none">Share</span>
                <div class="w-px h-8 bg-white/10 mb-2"></div>
                
                <a href="https://api.whatsapp.com/send?text={{ rawurlencode($articleNews->name . ' - ' . url()->current()) }}" 
                   target="_blank" 
                   class="w-10 h-10 rounded-full bg-green-500/10 hover:bg-green-500 text-green-500 hover:text-white flex items-center justify-center transition-all duration-300 hover:-translate-y-0.5 shadow-md">
                    <i class="fab fa-whatsapp text-lg"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                   target="_blank" 
                   class="w-10 h-10 rounded-full bg-blue-600/10 hover:bg-blue-600 text-blue-500 hover:text-white flex items-center justify-center transition-all duration-300 hover:-translate-y-0.5 shadow-md">
                    <i class="fab fa-facebook-f text-sm"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($articleNews->name) }}&url={{ urlencode(url()->current()) }}" 
                   target="_blank" 
                   class="w-10 h-10 rounded-full bg-sky-500/10 hover:bg-sky-500 text-sky-400 hover:text-white flex items-center justify-center transition-all duration-300 hover:-translate-y-0.5 shadow-md">
                    <i class="fab fa-twitter text-sm"></i>
                </a>
                <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($articleNews->name) }}" 
                   target="_blank" 
                   class="w-10 h-10 rounded-full bg-cyan-500/10 hover:bg-cyan-500 text-cyan-400 hover:text-white flex items-center justify-center transition-all duration-300 hover:-translate-y-0.5 shadow-md">
                    <i class="fab fa-telegram-plane text-lg"></i>
                </a>
                <button onclick="copyShareLink()" 
                        class="w-10 h-10 rounded-full bg-zinc-500/10 hover:bg-zinc-500 text-zinc-400 hover:text-white flex items-center justify-center transition-all duration-300 hover:-translate-y-0.5 shadow-md" 
                        title="Salin Tautan">
                    <i class="fas fa-link text-sm"></i>
                </button>
            </div>

            {{-- Center: Reading Column --}}
            <div class="flex-1 min-w-0 flex flex-col">
                {{-- Mobile/Tablet Share Bar --}}
                <div class="flex items-center gap-3 py-3 border-y border-white/5 mb-8 lg:hidden w-full overflow-x-auto scrollbar-none select-none font-[Poppins]">
                    <span class="text-xs text-zinc-500 uppercase tracking-wider font-semibold">Share:</span>
                    <a href="https://api.whatsapp.com/send?text={{ rawurlencode($articleNews->name . ' - ' . url()->current()) }}" 
                       target="_blank" 
                       class="w-8 h-8 rounded-full bg-green-500/10 hover:bg-green-500 text-green-500 hover:text-white flex items-center justify-center transition-all duration-300 shrink-0">
                        <i class="fab fa-whatsapp text-sm"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                       target="_blank" 
                       class="w-8 h-8 rounded-full bg-blue-600/10 hover:bg-blue-600 text-blue-500 hover:text-white flex items-center justify-center transition-all duration-300 shrink-0">
                        <i class="fab fa-facebook-f text-xs"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($articleNews->name) }}&url={{ urlencode(url()->current()) }}" 
                       target="_blank" 
                       class="w-8 h-8 rounded-full bg-sky-500/10 hover:bg-sky-500 text-sky-400 hover:text-white flex items-center justify-center transition-all duration-300 shrink-0">
                        <i class="fab fa-twitter text-xs"></i>
                    </a>
                    <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($articleNews->name) }}" 
                       target="_blank" 
                       class="w-8 h-8 rounded-full bg-cyan-500/10 hover:bg-cyan-500 text-cyan-400 hover:text-white flex items-center justify-center transition-all duration-300 shrink-0">
                        <i class="fab fa-telegram-plane text-sm"></i>
                    </a>
                    <button onclick="copyShareLink()" 
                            class="w-8 h-8 rounded-full bg-zinc-500/10 hover:bg-zinc-500 text-zinc-400 hover:text-white flex items-center justify-center transition-all duration-300 shrink-0" 
                            title="Salin Tautan">
                        <i class="fas fa-link text-xs"></i>
                    </button>
                </div>

                {{-- Main Article --}}
                <article id="Content-wrapper" class="prose prose-invert max-w-none text-zinc-200 leading-relaxed font-sans text-base sm:text-lg">
                    {!! $articleNews->content !!}
                </article>

                {{-- Bottom Share Bar --}}
                <div class="flex items-center gap-3 py-4 border-t border-white/5 mt-12 w-full select-none font-[Poppins]">
                    <span class="text-xs text-zinc-400 uppercase tracking-wider font-semibold">Share ke sosial media:</span>
                    <a href="https://api.whatsapp.com/send?text={{ rawurlencode($articleNews->name . ' - ' . url()->current()) }}" 
                       target="_blank" 
                       class="w-9 h-9 rounded-full bg-green-500/10 hover:bg-green-500 text-green-500 hover:text-white flex items-center justify-center transition-all duration-300 hover:-translate-y-0.5">
                        <i class="fab fa-whatsapp text-base"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                       target="_blank" 
                       class="w-9 h-9 rounded-full bg-blue-600/10 hover:bg-blue-600 text-blue-500 hover:text-white flex items-center justify-center transition-all duration-300 hover:-translate-y-0.5">
                        <i class="fab fa-facebook-f text-xs"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($articleNews->name) }}&url={{ urlencode(url()->current()) }}" 
                       target="_blank" 
                       class="w-9 h-9 rounded-full bg-sky-500/10 hover:bg-sky-500 text-sky-400 hover:text-white flex items-center justify-center transition-all duration-300 hover:-translate-y-0.5">
                        <i class="fab fa-twitter text-xs"></i>
                    </a>
                    <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($articleNews->name) }}" 
                       target="_blank" 
                       class="w-9 h-9 rounded-full bg-cyan-500/10 hover:bg-cyan-500 text-cyan-400 hover:text-white flex items-center justify-center transition-all duration-300 hover:-translate-y-0.5">
                        <i class="fab fa-telegram-plane text-sm"></i>
                    </a>
                    <button onclick="copyShareLink()" 
                            class="w-9 h-9 rounded-full bg-zinc-500/10 hover:bg-zinc-500 text-zinc-400 hover:text-white flex items-center justify-center transition-all duration-300 hover:-translate-y-0.5" 
                            title="Salin Tautan">
                        <i class="fas fa-link text-xs"></i>
                    </button>
                </div>
            </div>

            {{-- Right: Sidebar (Sticky) --}}
            @if ($square_ads_1 || ($articles && $articles->count() > 0))
                <div class="side-bar flex flex-col w-full lg:w-[320px] shrink-0 gap-8 sticky top-28 self-start">
                    {{-- Advertisement 1 --}}
                    @if ($square_ads_1)
                        <div class="flex flex-col w-full gap-2.5 ads font-[Poppins]">
                            <a href="{{ $square_ads_1->link }}" class="block overflow-hidden rounded-[20px] border border-white/5 hover:border-amber-500/25 transition-all">
                                <img src="{{ asset('storage/' . $square_ads_1->thumbnail) }}"
                                    class="object-cover w-full h-full" alt="ads" />
                            </a>
                            <p class="font-medium text-xs text-zinc-500 flex items-center gap-1">
                                Iklan Sponsor <a href="#" class="w-3.5 h-3.5 opacity-60"><img src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" /></a>
                            </p>
                        </div>
                    @endif

                    {{-- Berita Terpopuler --}}
                    @if ($articles && $articles->count() > 0)
                        <div id="More-from-author" class="flex flex-col gap-4 bg-slate-900/40 p-6 rounded-[24px] border border-white/5 shadow-xl font-[Poppins]">
                            <h3 class="font-extrabold text-white text-base border-b border-white/5 pb-3">
                                Berita Terpopuler
                            </h3>
                            <div class="flex flex-col gap-4">
                                @foreach($articles->take(3) as $item_news)
                                    <a href="{{ route('front.details', $item_news->slug) }}" class="group">
                                        <div class="flex gap-3 hover:-translate-y-0.5 transition-all duration-300 items-center">
                                            <div class="w-16 h-16 flex shrink-0 overflow-hidden rounded-xl border border-white/5 img-zoom-parent">
                                                <img src="{{ asset('storage/' . $item_news->thumbnail) }}"
                                                    class="object-cover w-full h-full img-zoom-child"
                                                    alt="thumbnail">
                                            </div>
                                            <div class="flex flex-col justify-center gap-1 flex-grow">
                                                <h4 class="font-bold text-xs md:text-sm line-clamp-2 text-zinc-200 group-hover:text-amber-400 transition-colors duration-300 leading-snug">
                                                    {{ $item_news->name }}
                                                </h4>
                                                <p class="text-[10px] text-zinc-500">
                                                    {{ $item_news->created_at->format('M d, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </section>



        {{-- Up-to-date Section --}}
        <section id="Up-to-date" class="container mx-auto px-5 lg:px-20 max-w-7xl mt-20">
            <div class="border-t border-white/5 pt-12">
                <h2 class="font-extrabold text-xl md:text-2xl text-white mb-8 tracking-tight font-[Poppins]">
                    Mungkin Anda Tertarik
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                    @forelse($articles as $article)
                        <a href="{{ route('front.details', $article->slug) }}" class="group premium-news-card flex flex-col h-full overflow-hidden font-[Poppins]">
                            <div class="thumbnail-container h-[190px] relative overflow-hidden flex-shrink-0 border-b border-white/5">
                                <span class="news-badge absolute top-4 left-4 z-20">
                                    {{ $article->category->name }}
                                </span>
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="thumbnail-photo"
                                    class="object-cover w-full h-full img-zoom-child" />
                            </div>
                            <div class="p-6 flex flex-col justify-between flex-grow gap-4">
                                <div class="flex flex-col gap-2.5">
                                    <h3 class="font-bold text-sm md:text-base leading-snug text-zinc-100 group-hover:text-amber-400 transition-colors duration-300 line-clamp-2">
                                        {{ $article->name }}
                                    </h3>
                                    <p class="text-zinc-400 text-xs line-clamp-2 leading-relaxed font-sans">
                                        {{ Str::limit(strip_tags($article->content), 90) }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-between border-t border-white/5 pt-4 mt-2">
                                    <p class="text-[11px] text-zinc-500 flex items-center gap-1">
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
                        <p class="col-span-full text-center text-zinc-500 py-12 bg-slate-900/10 border border-white/5 rounded-[24px]">Belum ada artikel lainnya.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <x-testimonial />

        {{-- Banner Advertisement --}}
        <x-banner-ad :bannerads="$bannerads" />

        <div class="mt-auto w-full">
            <x-footer />
        </div>

    </div>

@endsection

@push('after-styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
    <style>
        .write-vertical {
            writing-mode: vertical-rl;
            text-orientation: mixed;
        }
        /* Hide scrollbar for Chrome, Safari and Opera */
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for IE, Edge and Firefox */
        .scrollbar-none {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
@endpush

@push('after-scripts')
    <script src="{{ asset('js/two-lines-text.js') }}"></script>
    <script>
        function copyShareLink() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                // Remove existing toast if any
                const existingToast = document.getElementById('share-link-toast');
                if (existingToast) {
                    existingToast.remove();
                }

                // Create a premium toast notification
                const toast = document.createElement('div');
                toast.id = 'share-link-toast';
                toast.className = 'fixed bottom-6 right-6 bg-gradient-to-r from-yellow-500 to-yellow-600 text-slate-950 font-bold px-5 py-3 rounded-xl shadow-2xl z-[100] text-xs tracking-wide flex items-center gap-2 border border-yellow-400/20 transition-all duration-300 transform translate-y-10 opacity-0';
                toast.innerHTML = '<i class="fas fa-check-circle text-sm"></i> Link berhasil disalin ke clipboard!';
                document.body.appendChild(toast);
                
                // Trigger animation
                setTimeout(() => {
                    toast.classList.remove('translate-y-10', 'opacity-0');
                }, 50);
                
                // Auto dismiss
                setTimeout(() => {
                    toast.classList.add('translate-y-10', 'opacity-0');
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }
    </script>
@endpush
