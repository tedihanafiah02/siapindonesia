{{-- Testimonial Component --}}
<section class="py-20 overflow-hidden relative">
    <!-- Ambient background lights behind testimonials -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[250px] bg-amber-500/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="container mx-auto px-5 lg:px-20 max-w-7xl mb-12 text-center flex flex-col items-center gap-3">
        <span class="news-badge bg-[#c5a059]/10 text-[#d4b26f] border-[#c5a059]/25 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">
            Ulasan Peserta
        </span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-black bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent font-[Poppins] tracking-tight leading-tight mt-1">
            Testimonial
        </h2>
    </div>

    @if($count > 0)
        <div class="container mx-auto px-5 lg:px-20 max-w-7xl overflow-hidden py-4 relative z-10">
            <!-- Row 1: Scroll to the Right -->
            <div class="marquee-wrapper fade-edges-mask mb-8">
                <div class="marquee-container animate-marquee-right">
                    @foreach ($row1 as $testimonial)
                        <div class="testimonial-card">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <div class="testimonial-stars">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="testimonial-text mb-6">“{{ $testimonial->message }}”</p>
                                </div>
                                <div class="testimonial-header">
                                    <img class="testimonial-avatar" src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}">
                                    <div class="testimonial-user-info">
                                        <h4 class="testimonial-name">{{ $testimonial->name }}</h4>
                                        @if($testimonial->position)
                                        <span class="testimonial-position">{{ $testimonial->position }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- Double items for seamless infinite loop --}}
                    @foreach ($row1 as $testimonial)
                        <div class="testimonial-card">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <div class="testimonial-stars">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="testimonial-text mb-6">“{{ $testimonial->message }}”</p>
                                </div>
                                <div class="testimonial-header">
                                    <img class="testimonial-avatar" src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}">
                                    <div class="testimonial-user-info">
                                        <h4 class="testimonial-name">{{ $testimonial->name }}</h4>
                                        @if($testimonial->position)
                                        <span class="testimonial-position">{{ $testimonial->position }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Row 2: Scroll to the Left -->
            <div class="marquee-wrapper fade-edges-mask">
                <div class="marquee-container animate-marquee-left">
                    @foreach ($row2 as $testimonial)
                        <div class="testimonial-card">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <div class="testimonial-stars">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="testimonial-text mb-6">“{{ $testimonial->message }}”</p>
                                </div>
                                <div class="testimonial-header">
                                    <img class="testimonial-avatar" src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}">
                                    <div class="testimonial-user-info">
                                        <h4 class="testimonial-name">{{ $testimonial->name }}</h4>
                                        @if($testimonial->position)
                                        <span class="testimonial-position">{{ $testimonial->position }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- Double items for seamless infinite loop --}}
                    @foreach ($row2 as $testimonial)
                        <div class="testimonial-card">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <div class="testimonial-stars">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="testimonial-text mb-6">“{{ $testimonial->message }}”</p>
                                </div>
                                <div class="testimonial-header">
                                    <img class="testimonial-avatar" src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}">
                                    <div class="testimonial-user-info">
                                        <h4 class="testimonial-name">{{ $testimonial->name }}</h4>
                                        @if($testimonial->position)
                                        <span class="testimonial-position">{{ $testimonial->position }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- Video Testimonials Subsection --}}
    @php
        if (!function_exists('getYoutubeId')) {
            function getYoutubeId($url) {
                // Matches standard watch URLs, shorteners (youtu.be), embeds, shorts, and live streams
                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)|shorts|live)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $url, $match)) {
                    return $match[1];
                }
                return null;
            }
        }
        $videoTestimonials = \App\Models\Testimonial::whereNotNull('video_url')
            ->where('video_url', '!=', '')
            ->inRandomOrder()
            ->take(3)
            ->get();
    @endphp

    @if($videoTestimonials->isNotEmpty())
    <div class="container mx-auto px-5 lg:px-20 max-w-7xl relative z-10 pt-16 pb-12 border-t border-[#c5a059]/10 mt-16">
        <div class="text-center flex flex-col items-center gap-3 mb-12">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-[#c5a059]/10 border border-[#c5a059]/30 rounded-full text-xs font-bold text-[#d4b26f] uppercase tracking-widest">
                Ulasan Video
            </span>
            <h3 class="text-2xl md:text-3xl lg:text-4xl font-black bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent font-[Poppins] tracking-tight mt-1">
                Testimoni Video Peserta
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center w-full">
            @foreach($videoTestimonials as $videoTest)
                @php
                    $youtubeId = getYoutubeId($videoTest->video_url);
                @endphp
                @if($youtubeId)
                <div class="group w-full flex flex-col justify-between rounded-3xl bg-[#0c101a] border border-[#c5a059]/15 hover:border-[#c5a059]/40 p-5 hover:shadow-[0_0_30px_rgba(197,160,89,0.12)] hover:-translate-y-1.5 transition-all duration-300">
                    <div class="space-y-4">
                        <!-- Video Player Container (Lazy Loaded on Click for Max PageSpeed Performance) -->
                        <div class="relative w-full aspect-video rounded-2xl overflow-hidden border border-white/5 shadow-[0_8px_20px_rgba(0,0,0,0.5)] bg-slate-950/60 group/video cursor-pointer"
                             onclick="this.innerHTML = '<iframe class=\'w-full h-full\' src=\'https://www.youtube.com/embed/{{ $youtubeId }}?autoplay=1\' title=\'{{ $videoTest->name }} - Video Testimonial\' frameborder=\'0\' allow=\'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\' allowfullscreen></iframe>'">
                            
                            <!-- YouTube High Quality Thumbnail -->
                            <img src="https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg" 
                                 alt="{{ $videoTest->name }} Thumbnail" 
                                 class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover/video:scale-105"
                                 loading="lazy">
                            
                            <!-- Semi-transparent dark overlay -->
                            <div class="absolute inset-0 bg-black/40 group-hover/video:bg-black/20 transition-all duration-300"></div>
                            
                            <!-- Play button icon -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-red-600 hover:bg-red-500 text-white flex items-center justify-center shadow-lg transform transition-all duration-300 group-hover/video:scale-110 group-hover/video:shadow-[0_0_20px_rgba(220,38,38,0.5)]">
                                    <svg class="w-5 h-5 fill-current translate-x-0.5" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>


                        <!-- User Info Profile & Written message -->
                        <div class="space-y-3 pt-2">
                            <div class="flex items-center gap-3">
                                @if($videoTest->photo)
                                <img src="{{ asset('storage/' . $videoTest->photo) }}" alt="{{ $videoTest->name }}" class="w-10 h-10 rounded-full object-cover border border-[#c5a059]/30">
                                @endif
                                <div>
                                    <h4 class="text-sm font-bold text-white group-hover:text-[#d4b26f] transition-colors duration-300">{{ $videoTest->name }}</h4>
                                    @if($videoTest->position)
                                    <p class="text-[10px] text-zinc-400 font-semibold uppercase tracking-wider">{{ $videoTest->position }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            @if($videoTest->message)
                            <p class="text-zinc-300 text-xs leading-relaxed italic line-clamp-2 pt-1 border-t border-white/5">
                                "{{ $videoTest->message }}"
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif
</section>
