@props(['bannerads'])

@php
    // If it's a single model instance, wrap it in a collection/array
    $banners = $bannerads instanceof \Illuminate\Database\Eloquent\Collection
        ? $bannerads
        : collect(array_filter([$bannerads]));
@endphp

@if ($banners->isNotEmpty())
    <section id="Advertisement" class="container mx-auto px-5 lg:px-20 max-w-7xl mb-20 flex flex-col items-center justify-center select-none">
        <div class="relative w-full group/ad">
            
            <!-- Professional Badge/Label above the image -->
            <div class="text-center text-[8px] sm:text-[10px] uppercase tracking-widest text-zinc-500 mb-2 font-bold font-[Poppins] select-none">
                — Sponsored Advertisement —
            </div>

            <!-- Image Container: Reduced height to aspect ratio (20% on mobile, 18% on desktop) -->
            <div class="relative w-full overflow-hidden aspect-[100/20] md:aspect-[100/18] rounded-[24px] border border-white/5 shadow-2xl transition-all duration-500 group-hover/ad:border-[#c5a059]/30">
                
                @foreach ($banners as $index => $banner)
                    <div class="banner-slide absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}"
                         data-duration="{{ $banner->duration ?: 10 }}"
                         data-index="{{ $index }}">
                        <a href="{{ $banner->link }}" class="block w-full h-full relative" target="_blank">
                            <img src="{{ asset('storage/' . $banner->thumbnail) }}" class="w-full h-full object-cover transform group-hover/ad:scale-[1.01] transition-transform duration-700 ease-out" alt="Advertisement" onerror="this.onerror=null;this.src='{{ asset('assets/images/siapindo/banner_iklan_bimtek.png') }}';" />
                            
                            <!-- Action Indicator -->
                            <span class="absolute bottom-3 right-3 z-20 px-3 py-1.5 bg-yellow-500 text-slate-950 text-[9px] sm:text-[10px] font-extrabold uppercase tracking-wider rounded-md opacity-0 translate-y-1 group-hover/ad:opacity-100 group-hover/ad:translate-y-0 transition-all duration-300 shadow-lg flex items-center gap-1">
                                Visit Site <i class="fas fa-external-link-alt text-[9px] sm:text-[10px]"></i>
                            </span>
                        </a>
                    </div>
                @endforeach

            </div>
            
        </div>
    </section>

    @if ($banners->count() > 1)
        <script>
            (function() {
                let slideshowTimeout = null;

                function initBannerSlideshow() {
                    if (slideshowTimeout) {
                        clearTimeout(slideshowTimeout);
                        slideshowTimeout = null;
                    }

                    const container = document.getElementById('Advertisement');
                    if (!container) return;
                    
                    const slides = container.querySelectorAll('.banner-slide');
                    if (slides.length <= 1) return;
                    
                    let currentIdx = 0;

                    function showNextSlide() {
                        const currentSlide = slides[currentIdx];
                        currentSlide.classList.remove('opacity-100', 'z-10');
                        currentSlide.classList.add('opacity-0', 'z-0');

                        currentIdx = (currentIdx + 1) % slides.length;

                        const nextSlide = slides[currentIdx];
                        nextSlide.classList.remove('opacity-0', 'z-0');
                        nextSlide.classList.add('opacity-100', 'z-10');

                        // Schedule next slide using its custom duration (1-60s)
                        const durationSeconds = parseInt(nextSlide.getAttribute('data-duration')) || 10;
                        slideshowTimeout = setTimeout(showNextSlide, durationSeconds * 1000);
                    }

                    // Start timer for the first slide transition
                    const initialDuration = parseInt(slides[0].getAttribute('data-duration')) || 10;
                    slideshowTimeout = setTimeout(showNextSlide, initialDuration * 1000);

                    // Mark as initialized to prevent double loading
                    container.dataset.slideshowInitialized = 'true';
                }

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initBannerSlideshow);
                } else {
                    initBannerSlideshow();
                }

                // Support SPA page transitions
                const appContainer = document.getElementById('app-container');
                if (appContainer) {
                    const observer = new MutationObserver(function() {
                        const container = document.getElementById('Advertisement');
                        if (container && !container.dataset.slideshowInitialized) {
                            initBannerSlideshow();
                        }
                    });
                    observer.observe(appContainer, { childList: true, subtree: true });
                }
            })();
        </script>
    @endif
@endif
