@props([
    'partners' => [],
    'showButton' => false,
])

@php
    $partnersRow1 = $partners->where('row_position', 1)->values();
    $partnersRow2 = $partners->where('row_position', 2)->values();

    // Fallback if seeder or database didn't assign row positions: split evenly
    if ($partnersRow1->isEmpty() && $partnersRow2->isEmpty() && $partners->isNotEmpty()) {
        $half = ceil($partners->count() / 2);
        $partnersRow1 = $partners->take($half)->values();
        $partnersRow2 = $partners->skip($half)->values();
    }

    $repeatCount = 1;
    if ($partners->isNotEmpty()) {
        $count = $partners->count();
        if ($count < 6) {
            $repeatCount = 4;
        } elseif ($count < 10) {
            $repeatCount = 2;
        }
    }

    $accentStyles = [
        'border-t-2 border-t-amber-500/90 shadow-[0_-3px_10px_rgba(245,158,11,0.2)]',
        'border-t-2 border-t-blue-500/90 shadow-[0_-3px_10px_rgba(59,130,246,0.2)]',
        'border-t-2 border-t-emerald-500/90 shadow-[0_-3px_10px_rgba(16,185,129,0.2)]',
        'border-t-2 border-t-purple-500/90 shadow-[0_-3px_10px_rgba(168,85,247,0.2)]',
    ];
@endphp

<section class="oc-section relative w-full overflow-hidden">

    {{-- Decorative ambient background --}}
    <div class="oc-bg-glow oc-bg-glow--left" aria-hidden="true"></div>
    <div class="oc-bg-glow oc-bg-glow--right" aria-hidden="true"></div>
    <div class="oc-grid-overlay" aria-hidden="true"></div>

    {{-- Section Header --}}
    <div class="relative z-10 max-w-7xl mx-auto px-5 lg:px-20 pt-20 md:pt-28 pb-14 md:pb-20">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full oc-badge">
                    <span class="oc-badge-dot" aria-hidden="true"></span>
                    <span class="oc-badge-text">500+ Mitra Instansi Resmi</span>
                </div>
                <h2 class="oc-heading">
                    Dipercaya oleh <br class="hidden sm:block"/>
                    <span class="oc-heading-gradient">Ribuan Instansi</span>
                </h2>
                <p class="oc-subtext">
                    Dari kementerian, BUMN, pemerintah daerah, hingga korporasi swasta — kami hadir untuk mendampingi akselerasi SDM unggul.
                </p>
            </div>

            @if($showButton)
            <div class="shrink-0">
                <a href="{{ route('front.partner') }}" class="oc-btn-outline group" id="btn-lihat-semua-client">
                    <span>Lihat Semua Client</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="oc-btn-arrow" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
            @endif
        </div>

        <div class="oc-divider mt-10"></div>
    </div>

    {{-- Marquee Rows --}}
    <div class="container mx-auto px-5 lg:px-20 max-w-7xl relative z-10 pb-20 md:pb-28">
        <div class="space-y-6 md:space-y-8 relative">

            {{-- Row 1: Left to Right --}}
            @if($partnersRow1->isNotEmpty())
            <div class="oc-marquee-row">
                <div class="oc-marquee-track oc-marquee-track-ltr">
                    <!-- Group 1 -->
                    <div class="oc-marquee-group">
                        @for ($i = 0; $i < $repeatCount; $i++)
                            @foreach ($partnersRow1 as $index => $partner)
                            @php
                                $accent = $accentStyles[$index % count($accentStyles)];
                            @endphp
                            <div class="oc-card">
                                <div class="oc-card-inner {{ $accent }}">
                                    <img
                                        src="{{ asset('storage/' . $partner->logo_path) }}"
                                        alt="{{ $partner->alt_text ?? $partner->name }}"
                                        class="oc-logo"
                                        loading="eager"
                                        draggable="false"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/siapindo/logo-siapindo.png') }}';" />
                                    @if($partner->name)
                                        <span class="text-[10px] sm:text-[11px] font-bold text-slate-700 group-hover:text-slate-900 leading-tight text-center truncate max-w-full px-1">
                                            {{ $partner->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @endfor
                    </div>
                    <!-- Group 2 (Duplicate for Seamless Loop) -->
                    <div class="oc-marquee-group" aria-hidden="true">
                        @for ($i = 0; $i < $repeatCount; $i++)
                            @foreach ($partnersRow1 as $index => $partner)
                            @php
                                $accent = $accentStyles[$index % count($accentStyles)];
                            @endphp
                            <div class="oc-card">
                                <div class="oc-card-inner {{ $accent }}">
                                    <img
                                        src="{{ asset('storage/' . $partner->logo_path) }}"
                                        alt="{{ $partner->alt_text ?? $partner->name }}"
                                        class="oc-logo"
                                        loading="eager"
                                        draggable="false"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/siapindo/logo-siapindo.png') }}';" />
                                    @if($partner->name)
                                        <span class="text-[10px] sm:text-[11px] font-bold text-slate-700 group-hover:text-slate-900 leading-tight text-center truncate max-w-full px-1">
                                            {{ $partner->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @endfor
                    </div>
                </div>
            </div>
            @endif

            {{-- Row 2: Right to Left --}}
            @if($partnersRow2->isNotEmpty())
            <div class="oc-marquee-row">
                <div class="oc-marquee-track oc-marquee-track-rtl">
                    <!-- Group 1 -->
                    <div class="oc-marquee-group">
                        @for ($i = 0; $i < $repeatCount; $i++)
                            @foreach ($partnersRow2 as $index => $partner)
                            @php
                                $accent = $accentStyles[($index + 2) % count($accentStyles)];
                            @endphp
                            <div class="oc-card">
                                <div class="oc-card-inner {{ $accent }}">
                                    <img
                                        src="{{ asset('storage/' . $partner->logo_path) }}"
                                        alt="{{ $partner->alt_text ?? $partner->name }}"
                                        class="oc-logo"
                                        loading="eager"
                                        draggable="false"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/siapindo/logo-siapindo.png') }}';" />
                                    @if($partner->name)
                                        <span class="text-[10px] sm:text-[11px] font-bold text-slate-700 group-hover:text-slate-900 leading-tight text-center truncate max-w-full px-1">
                                            {{ $partner->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @endfor
                    </div>
                    <!-- Group 2 (Duplicate for Seamless Loop) -->
                    <div class="oc-marquee-group" aria-hidden="true">
                        @for ($i = 0; $i < $repeatCount; $i++)
                            @foreach ($partnersRow2 as $index => $partner)
                            @php
                                $accent = $accentStyles[($index + 2) % count($accentStyles)];
                            @endphp
                            <div class="oc-card">
                                <div class="oc-card-inner {{ $accent }}">
                                    <img
                                        src="{{ asset('storage/' . $partner->logo_path) }}"
                                        alt="{{ $partner->alt_text ?? $partner->name }}"
                                        class="oc-logo"
                                        loading="eager"
                                        draggable="false"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/siapindo/logo-siapindo.png') }}';" />
                                    @if($partner->name)
                                        <span class="text-[10px] sm:text-[11px] font-bold text-slate-700 group-hover:text-slate-900 leading-tight text-center truncate max-w-full px-1">
                                            {{ $partner->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @endfor
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

</section>

<style>
/* ============================================================
   OUR CLIENT — Soft Off-White Eye-Comfortable Compact Cards
   ============================================================ */

.oc-section {
    background: linear-gradient(180deg, #07090f 0%, #0b0f19 50%, #07090f 100%);
    position: relative;
}

.oc-bg-glow {
    position: absolute;
    width: 550px;
    height: 550px;
    border-radius: 50%;
    filter: blur(140px);
    pointer-events: none;
    z-index: 0;
}
.oc-bg-glow--left {
    top: -100px;
    left: -150px;
    background: radial-gradient(circle, rgba(197,160,89,0.1) 0%, transparent 70%);
}
.oc-bg-glow--right {
    bottom: -100px;
    right: -150px;
    background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, transparent 70%);
}

.oc-grid-overlay {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px);
    background-size: 60px 60px;
    pointer-events: none;
    z-index: 0;
}

/* --- Badge --- */
.oc-badge {
    background: rgba(197, 160, 89, 0.1);
    border: 1px solid rgba(197, 160, 89, 0.25);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
}
.oc-badge-dot {
    display: inline-block;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #c5a059;
    box-shadow: 0 0 8px rgba(197,160,89,0.6);
    animation: oc-pulse 2s ease-in-out infinite;
}
.oc-badge-text {
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #d4b26f;
}

/* --- Heading --- */
.oc-heading {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(1.75rem, 4vw, 3rem);
    font-weight: 900;
    line-height: 1.15;
    letter-spacing: -0.02em;
    color: #fff;
}
.oc-heading-gradient {
    background: linear-gradient(135deg, #e6c687 0%, #d4b26f 50%, #aa7c11 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.oc-subtext {
    font-size: 0.875rem;
    color: #94a3b8;
    max-width: 28rem;
    line-height: 1.7;
}

/* --- Divider --- */
.oc-divider {
    height: 1px;
    background: linear-gradient(90deg,
        transparent 0%,
        rgba(197,160,89,0.15) 20%,
        rgba(197,160,89,0.35) 50%,
        rgba(197,160,89,0.15) 80%,
        transparent 100%
    );
}

/* --- Outline button --- */
.oc-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.65rem 1.5rem;
    border-radius: 9999px;
    border: 1px solid rgba(197, 160, 89, 0.35);
    background: rgba(197, 160, 89, 0.05);
    color: #c5a059;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    text-decoration: none;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    white-space: nowrap;
}
.oc-btn-outline:hover {
    background: linear-gradient(135deg, #e6c687, #d4b26f);
    border-color: transparent;
    color: #0d1020;
    box-shadow: 0 8px 25px -5px rgba(197, 160, 89, 0.4);
    transform: translateY(-2px);
}
.oc-btn-arrow {
    width: 0.875rem;
    height: 0.875rem;
    transition: transform 0.3s ease;
}
.oc-btn-outline:hover .oc-btn-arrow {
    transform: translateX(4px);
}

/* --- Marquee Layout --- */
.oc-marquee-row {
    display: flex;
    overflow: hidden;
    width: 100%;
    user-select: none;
    position: relative;
    padding: 14px 0;
    margin: -14px 0;
    -webkit-mask-image: linear-gradient(90deg, transparent 0%, rgba(0,0,0,1) 12%, rgba(0,0,0,1) 88%, transparent 100%);
    mask-image: linear-gradient(90deg, transparent 0%, rgba(0,0,0,1) 12%, rgba(0,0,0,1) 88%, transparent 100%);
}

.oc-marquee-track {
    display: flex;
    width: max-content;
}

.oc-marquee-group {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    padding-right: 1.25rem;
    flex-shrink: 0;
}

.oc-marquee-track-ltr {
    animation: oc-marquee-ltr 34s linear infinite;
}

.oc-marquee-track-rtl {
    animation: oc-marquee-rtl 34s linear infinite;
}

.oc-marquee-row:hover .oc-marquee-track {
    animation-play-state: paused;
}

/* --- Cards (Compact Soft Off-White Eye-Comfortable Styling) --- */
.oc-card {
    flex-shrink: 0;
    width: 145px;
    height: 95px;
}
@media (min-width: 640px) {
    .oc-card { width: 165px; height: 105px; }
}
@media (min-width: 1024px) {
    .oc-card { width: 185px; height: 110px; }
}

.oc-card-inner {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.35rem;
    padding: 0.75rem 0.9rem;
    border-radius: 18px;
    /* Soft Off-White Light Slate Gradient - Eye Comfortable */
    background: linear-gradient(145deg, rgba(248, 250, 252, 0.96) 0%, rgba(241, 245, 249, 0.92) 100%);
    border: 1px solid rgba(226, 232, 240, 0.85);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    box-shadow: 
        0 8px 20px -4px rgba(0, 0, 0, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.9);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
}

/* Subtle Shimmer Sheen Effect on Hover */
.oc-card-inner::before {
    content: '';
    position: absolute;
    top: 0; left: -100%; width: 100%; height: 100%;
    background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.6) 50%, transparent 100%);
    transition: left 0.75s ease;
    pointer-events: none;
}

.oc-card-inner:hover::before {
    left: 100%;
}

.oc-card-inner:hover {
    background: #ffffff;
    border-color: rgba(197, 160, 89, 0.5);
    box-shadow:
        0 14px 30px -5px rgba(0, 0, 0, 0.35),
        0 0 20px rgba(197, 160, 89, 0.25),
        inset 0 0 0 1px rgba(197, 160, 89, 0.3);
    transform: translateY(-5px) scale(1.04);
}

/* --- Logos --- */
.oc-logo {
    max-height: 40px;
    max-width: 115px;
    width: auto;
    height: auto;
    object-fit: contain;
    filter: drop-shadow(0 1.5px 3px rgba(0, 0, 0, 0.08));
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), filter 0.4s ease;
    user-select: none;
    pointer-events: none;
    -webkit-user-drag: none;
}
@media (min-width: 640px) {
    .oc-logo { max-height: 44px; max-width: 130px; }
}
@media (min-width: 1024px) {
    .oc-logo { max-height: 48px; max-width: 145px; }
}

.oc-card-inner:hover .oc-logo {
    transform: scale(1.06);
    filter: drop-shadow(0 3px 8px rgba(0, 0, 0, 0.15));
}

/* --- Keyframe Animations --- */
@keyframes oc-marquee-ltr {
    0% { transform: translateX(-50%); }
    100% { transform: translateX(0%); }
}

@keyframes oc-marquee-rtl {
    0% { transform: translateX(0%); }
    100% { transform: translateX(-50%); }
}

@keyframes oc-pulse {
    0%, 100% { opacity: 1; box-shadow: 0 0 8px rgba(197,160,89,0.6); }
    50%       { opacity: 0.6; box-shadow: 0 0 16px rgba(197,160,89,0.3); }
}

@media (prefers-reduced-motion: reduce) {
    .oc-marquee-track { animation: none !important; }
}
</style>
