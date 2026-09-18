@props([
    'galleries' => null,
    'title' => 'Dokumentasi Kegiatan',
    'badge' => 'Galeri Foto',
    'subtitle' => 'Melihat lebih dekat keseruan, interaksi, dan antusiasme peserta dalam program pelatihan yang kami selenggarakan.',
    'showButton' => true,
    'limit' => 6,
    'cols' => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3',
])

@php
    if (is_null($galleries)) {
        $galleries = cache()->remember('home_galleries_six', 3600, function () use ($limit) {
            return \App\Models\Gallery::latest()->take($limit)->get();
        });
    }
@endphp

@if ($galleries && $galleries->isNotEmpty())
    <section class="py-20 lg:py-24 w-full border-t border-[#c5a059]/10 relative overflow-hidden bg-gradient-to-b from-[#07090f] via-[#090c17] to-[#07090f]">
        {{-- Background decorative glows --}}
        <div class="absolute top-1/2 left-0 w-80 h-80 bg-[#c5a059]/5 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-10 w-96 h-96 bg-indigo-500/5 rounded-full blur-[140px] pointer-events-none"></div>

        <div class="container mx-auto px-5 lg:px-20 max-w-7xl relative z-10">
            <div class="text-center flex flex-col items-center gap-3 mb-14 md:mb-16">
                <span class="news-badge bg-[#c5a059]/10 text-[#d4b26f] border-[#c5a059]/25 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">
                    {{ $badge }}
                </span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-black bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent font-[Poppins] tracking-tight leading-tight mt-1">
                    {{ $title }}
                </h2>
                @if($subtitle)
                <p class="text-zinc-400 max-w-xl mx-auto text-sm md:text-base leading-relaxed">
                    {{ $subtitle }}
                </p>
                @endif
            </div>

            <div class="grid {{ $cols }} gap-6">
                @foreach ($galleries as $gallery)
                    <div class="group relative overflow-hidden rounded-[24px] border border-white/10 bg-slate-900/50 shadow-xl hover:shadow-[0_12px_40px_rgba(197,160,89,0.18)] hover:border-[#c5a059]/50 transition-all duration-500 transform hover:-translate-y-1.5 aspect-[4/3] cursor-pointer">
                        <a data-fancybox="gallery-component" href="{{ asset('storage/' . $gallery->image_path) }}" data-caption="{{ $gallery->alt_text }}" class="block w-full h-full">
                            <!-- Image -->
                            <img class="w-full h-full object-cover transform scale-100 group-hover:scale-110 transition-transform duration-700 ease-out" 
                                 src="{{ asset('storage/' . $gallery->image_path) }}" 
                                 alt="{{ $gallery->alt_text ?? 'Dokumentasi Training Siap Indonesia' }}" 
                                 loading="lazy"
                                 onerror="this.onerror=null;this.src='{{ asset('assets/images/siapindo/carousel-1.webp') }}';" />
                            
                            <!-- Soft Dark Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-6 z-10">
                                <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 ease-out">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-[#c5a059]/20 border border-[#c5a059]/40 rounded-full text-[9px] font-bold text-[#d4b26f] uppercase tracking-widest mb-2.5 shadow-sm">
                                        Dokumentasi
                                    </span>
                                    <p class="text-xs sm:text-sm font-bold text-white line-clamp-2 leading-snug font-[Poppins]">
                                        {{ $gallery->alt_text ?? 'Dokumentasi Training Siap Indonesia' }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Zoom Icon Tag -->
                            <div class="absolute top-4 right-4 w-9 h-9 rounded-full bg-slate-950/80 backdrop-blur-md border border-white/20 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-75 group-hover:scale-100 shadow-md z-20">
                                <i class="fas fa-search-plus text-xs text-[#d4b26f]"></i>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            @if($showButton)
            <!-- Lihat Selengkapnya Button -->
            <div class="flex justify-center mt-12">
                <a href="{{ route('front.gallery') }}" class="oc-btn-outline group">
                    <span>Buka Galeri Lengkap</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="oc-btn-arrow" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
            @endif
        </div>
    </section>
@endif
