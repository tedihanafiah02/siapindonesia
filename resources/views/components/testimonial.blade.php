{{-- Testimonial Component --}}
<section class="py-20 overflow-hidden relative">
    <!-- Ambient background lights behind testimonials -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[250px] bg-amber-500/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="container mx-auto px-5 lg:px-20 max-w-7xl mb-12 text-center flex flex-col items-center gap-3">
        <span class="news-badge bg-[#c5a059]/10 text-[#d4b26f] border-[#c5a059]/25 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">
            Ulasan Peserta
        </span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-black bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent font-[Poppins] tracking-tight leading-tight mt-1">
            Testimonial & Reputasi Resmi
        </h2>
        <p class="text-zinc-300 text-xs sm:text-sm md:text-base max-w-2xl text-center leading-relaxed">
            Pengalaman nyata alumni dan instansi yang telah mempercayakan pelatihan SDM & konsultasi keprotokolan kepada SIAP Indonesia.
        </p>
        <div class="mt-2 flex justify-center">
            <x-hero-social-proof />
        </div>
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
                                            <svg class="w-5 h-5 fill-current text-[#d4b26f]" viewBox="0 0 24 24">
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
                                            <svg class="w-5 h-5 fill-current text-[#d4b26f]" viewBox="0 0 24 24">
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
                                            <svg class="w-5 h-5 fill-current text-[#d4b26f]" viewBox="0 0 24 24">
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
                                            <svg class="w-5 h-5 fill-current text-[#d4b26f]" viewBox="0 0 24 24">
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
                if (empty($url)) return null;
                $url = trim($url);

                // If it's already an 11-character video ID
                if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
                    return $url;
                }

                // Match standard YouTube URLs (watch?v=, youtu.be/, embed/, shorts/, live/)
                if (preg_match('/(?:youtu\.be\/|youtube(?:-nocookie)?\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=|shorts\/|live\/))([\w-]{11})/i', $url, $match)) {
                    return $match[1];
                }

                // Fallback 11-char match
                if (preg_match('/([a-zA-Z0-9_-]{11})/', $url, $match)) {
                    return $match[1];
                }

                return null;
            }
        }
        $videoTestimonials = \App\Models\Testimonial::where(function($q) {
                $q->whereNotNull('video_file')->where('video_file', '!=', '')
                  ->orWhere(function($sq) {
                      $sq->whereNotNull('video_url')->where('video_url', '!=', '');
                  });
            })
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
            <p class="text-xs sm:text-sm text-zinc-400 max-w-xl text-center">
                Simak langsung pengalaman nyata para alumni dan perwakilan instansi yang mengikuti program pelatihan kami.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center w-full">
            @foreach($videoTestimonials as $videoTest)
                @php
                    $hasLocalVideo = !empty($videoTest->video_file);
                    $localVideoUrl = $hasLocalVideo ? asset('storage/' . $videoTest->video_file) : null;
                    $youtubeId = !$hasLocalVideo ? getYoutubeId($videoTest->video_url) : null;
                    $fullYoutubeUrl = $youtubeId ? ('https://www.youtube.com/watch?v=' . $youtubeId) : null;
                    $thumbnailUrl = null;

                    if ($hasLocalVideo) {
                        $thumbnailUrl = $videoTest->photo ? asset('storage/' . $videoTest->photo) : asset('assets/images/siapindo/logo-siapindo.png');
                    } elseif ($youtubeId) {
                        $thumbnailUrl = 'https://i.ytimg.com/vi/' . $youtubeId . '/hqdefault.jpg';
                    }
                @endphp

                @if($hasLocalVideo || $youtubeId)
                <div class="group w-full flex flex-col justify-between rounded-3xl bg-[#0c101a] border border-[#c5a059]/20 hover:border-[#c5a059]/50 p-5 hover:shadow-[0_0_35px_rgba(197,160,89,0.18)] hover:-translate-y-1.5 transition-all duration-300">
                    <div class="space-y-4">
                        <!-- Video Card Poster with Trigger -->
                        <div class="relative w-full aspect-video rounded-2xl overflow-hidden border border-white/10 shadow-[0_8px_25px_rgba(0,0,0,0.6)] bg-slate-950/80 group/video cursor-pointer"
                             onclick="openCinemaVideoModal({
                                 name: '{{ addslashes($videoTest->name) }}',
                                 position: '{{ addslashes($videoTest->position ?? '') }}',
                                 type: '{{ $hasLocalVideo ? 'local' : 'youtube' }}',
                                 src: '{{ $hasLocalVideo ? $localVideoUrl : ('https://www.youtube.com/embed/' . $youtubeId . '?autoplay=1&rel=0&enablejsapi=1') }}',
                                 youtubeUrl: '{{ $fullYoutubeUrl }}'
                             })"
                             title="Klik untuk memutar video {{ $videoTest->name }}">
                            
                            <!-- Video Thumbnail -->
                            <img src="{{ $thumbnailUrl }}" 
                                 @if($youtubeId) onerror="this.onerror=null; this.src='https://i.ytimg.com/vi/{{ $youtubeId }}/mqdefault.jpg';" @endif
                                 alt="{{ $videoTest->name }} Video Testimonial" 
                                 class="absolute inset-0 w-full h-full object-cover transform group-hover/video:scale-105 transition-transform duration-700 ease-out"
                                 loading="lazy">
                            
                            <!-- Soft Dark Overlay -->
                            <div class="absolute inset-0 bg-slate-950/45 group-hover/video:bg-slate-950/25 transition-all duration-300"></div>
                            
                            <!-- Red Glowing Play Button Icon -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-14 h-14 rounded-full bg-red-600 hover:bg-red-500 text-white flex items-center justify-center shadow-[0_0_25px_rgba(220,38,38,0.65)] transform transition-all duration-300 group-hover/video:scale-115">
                                    <svg class="w-6 h-6 fill-current translate-x-0.5" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Top Right Badge -->
                            <div class="absolute top-3 right-3 px-2.5 py-1 bg-slate-950/85 border border-white/15 backdrop-blur-md rounded-full text-[10px] font-bold text-[#d4b26f] uppercase tracking-wider flex items-center gap-1.5 shadow-md">
                                @if($hasLocalVideo)
                                    <i class="fas fa-play-circle text-amber-400 text-xs"></i> Video Player
                                @else
                                    <i class="fab fa-youtube text-red-500 text-xs"></i> YouTube
                                @endif
                            </div>
                        </div>

                        <!-- User Info Profile & Direct Action -->
                        <div class="space-y-3 pt-1">
                            <div class="flex items-center justify-between gap-3">
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-bold text-white group-hover:text-[#d4b26f] transition-colors duration-300 truncate">{{ $videoTest->name }}</h4>
                                    @if($videoTest->position)
                                    <p class="text-[10px] text-zinc-400 font-semibold uppercase tracking-wider truncate">{{ $videoTest->position }}</p>
                                    @endif
                                </div>

                                <!-- Action Button -->
                                @if($fullYoutubeUrl)
                                <a href="{{ $fullYoutubeUrl }}" target="_blank" rel="noopener noreferrer" 
                                   class="inline-flex items-center gap-1.5 text-[11px] font-bold text-[#d4b26f] hover:text-white transition-colors bg-[#c5a059]/10 hover:bg-[#c5a059]/25 px-3 py-1.5 rounded-full border border-[#c5a059]/30 shrink-0"
                                   title="Buka langsung di tab baru YouTube">
                                    <i class="fab fa-youtube text-red-500 text-xs"></i>
                                    <span>Buka YouTube</span>
                                </a>
                                @else
                                <button type="button"
                                        onclick="openCinemaVideoModal({
                                            name: '{{ addslashes($videoTest->name) }}',
                                            position: '{{ addslashes($videoTest->position ?? '') }}',
                                            type: 'local',
                                            src: '{{ $localVideoUrl }}'
                                        })"
                                        class="inline-flex items-center gap-1.5 text-[11px] font-bold text-emerald-400 hover:text-white transition-colors bg-emerald-500/10 hover:bg-emerald-500/25 px-3 py-1.5 rounded-full border border-emerald-500/30 shrink-0">
                                    <i class="fas fa-play text-xs"></i>
                                    <span>Putar Video</span>
                                </button>
                                @endif
                            </div>
                            
                            @if($videoTest->message)
                            <p class="text-zinc-300 text-xs leading-relaxed italic line-clamp-2 pt-2 border-t border-white/5">
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

{{-- Cinema Video Lightbox Modal --}}
<div id="cinema-video-modal" class="fixed inset-0 z-[99999] flex items-center justify-center p-3 sm:p-6 md:p-10 opacity-0 pointer-events-none transition-all duration-300" role="dialog" aria-modal="true">
    <!-- Backdrop Overlay with High Blur -->
    <div class="fixed inset-0 bg-slate-950/90 backdrop-blur-md transition-opacity duration-300" onclick="closeCinemaVideoModal()"></div>

    <!-- Modal Card Container -->
    <div class="cinema-modal-card relative w-full max-w-4xl bg-[#090d16] border border-[#c5a059]/35 rounded-2xl sm:rounded-3xl shadow-[0_0_60px_rgba(0,0,0,0.9)] overflow-hidden transform scale-95 transition-all duration-300 z-10 flex flex-col">
        <!-- Header -->
        <div class="flex items-center justify-between px-5 sm:px-6 py-3.5 sm:py-4 border-b border-white/10 bg-slate-900/80 backdrop-blur-sm">
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 bg-[#c5a059]/15 border border-[#c5a059]/30 rounded-full text-[10px] sm:text-xs font-bold text-[#d4b26f] uppercase tracking-wider">
                    Ulasan Video
                </span>
                <div>
                    <h3 id="cinema-modal-name" class="text-sm sm:text-base font-bold text-white leading-tight"></h3>
                    <p id="cinema-modal-position" class="text-[10px] sm:text-xs text-zinc-400 font-medium mt-0.5"></p>
                </div>
            </div>
            <button type="button" onclick="closeCinemaVideoModal()" class="w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 text-zinc-300 hover:text-white flex items-center justify-center transition-all duration-200" title="Tutup (ESC)">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Player Body Container (16:9) -->
        <div id="cinema-modal-player" class="relative w-full aspect-video bg-black flex items-center justify-center">
            <!-- Dynamic Iframe or Video element injected here -->
        </div>

        <!-- Footer Bar -->
        <div class="px-5 sm:px-6 py-3 sm:py-3.5 bg-slate-950 border-t border-white/10 flex items-center justify-between gap-3 text-xs">
            <div class="flex items-center gap-2 text-zinc-400 text-xs">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-zinc-300 font-medium text-[11px] sm:text-xs">SIAP Indonesia Alumni Network</span>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <a id="cinema-modal-direct-btn" href="#" target="_blank" rel="noopener noreferrer" class="hidden items-center gap-2 px-4 py-2 rounded-full bg-[#c5a059]/20 hover:bg-[#c5a059]/35 text-[#d4b26f] hover:text-white border border-[#c5a059]/40 font-semibold text-xs transition-all">
                    <i class="fab fa-youtube text-red-500 text-sm"></i>
                    <span>Buka di YouTube ↗</span>
                </a>
                <button type="button" onclick="closeCinemaVideoModal()" class="px-4 py-2 rounded-full bg-white/10 hover:bg-white/20 text-zinc-200 font-medium text-xs transition-all">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
<script>
    function openCinemaVideoModal(data) {
        const modal = document.getElementById('cinema-video-modal');
        const player = document.getElementById('cinema-modal-player');
        const nameEl = document.getElementById('cinema-modal-name');
        const posEl = document.getElementById('cinema-modal-position');
        const directBtn = document.getElementById('cinema-modal-direct-btn');
        const card = modal ? modal.querySelector('.cinema-modal-card') : null;

        if (!modal || !player) return;

        nameEl.textContent = data.name || 'Testimoni Peserta';
        posEl.textContent = data.position || '';

        // Reset player container
        player.innerHTML = '';

        if (data.type === 'local') {
            const video = document.createElement('video');
            video.src = data.src;
            video.controls = true;
            video.autoplay = true;
            video.playsInline = true;
            video.className = 'w-full h-full object-contain';
            player.appendChild(video);

            if (directBtn) directBtn.classList.add('hidden');
        } else {
            const iframe = document.createElement('iframe');
            iframe.src = data.src;
            iframe.className = 'w-full h-full border-0';
            iframe.title = 'Testimoni Peserta';
            iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
            iframe.referrerPolicy = 'strict-origin-when-cross-origin';
            iframe.allowFullscreen = true;
            player.appendChild(iframe);

            if (data.youtubeUrl && directBtn) {
                directBtn.href = data.youtubeUrl;
                directBtn.classList.remove('hidden');
                directBtn.classList.add('inline-flex');
            } else if (directBtn) {
                directBtn.classList.add('hidden');
            }
        }

        // Display modal
        modal.classList.remove('opacity-0', 'pointer-events-none');
        if (card) {
            card.classList.remove('scale-95');
            card.classList.add('scale-100');
        }
        document.body.style.overflow = 'hidden';
    }

    function closeCinemaVideoModal() {
        const modal = document.getElementById('cinema-video-modal');
        const player = document.getElementById('cinema-modal-player');
        const card = modal ? modal.querySelector('.cinema-modal-card') : null;
        if (!modal) return;

        modal.classList.add('opacity-0', 'pointer-events-none');
        if (card) {
            card.classList.remove('scale-100');
            card.classList.add('scale-95');
        }
        document.body.style.overflow = '';

        // Stop video immediately upon close
        setTimeout(() => {
            if (player) player.innerHTML = '';
        }, 200);
    }

    // Global Key Listener for ESC
    if (!window.cinemaModalKeyBound) {
        window.cinemaModalKeyBound = true;
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCinemaVideoModal();
            }
        });
    }
</script>
@endpush
