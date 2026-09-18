@extends('front.master')

@section('title', 'Jadwal Training & Bimtek Pelatihan Keprotokolan Resmi | Siap Indonesia')
@section('description', 'Daftar lengkap jadwal training, bimbingan teknis (bimtek), diklat keprotokolan humas, public speaking, grooming, dan manajemen SDM oleh Siap Indonesia.')
@section('keywords', 'jadwal pelatihan, bimtek keprotokolan, diklat humas, jadwal training pns, sertifikasi bnsp, public speaking training, table manner, siap indonesia')

@section('schema')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ItemList",
      "name": "Jadwal Pelatihan Siap Indonesia",
      "description": "Jadwal lengkap bimtek keprotokolan dan pengembangan SDM oleh Siap Indonesia.",
      "url": "{{ url()->current() }}",
      "itemListElement": [
        @php $counter = 1; @endphp
        @foreach($categories as $category)
            @foreach($category->trainingSchedules as $schedule)
                {
                  "@type": "ListItem",
                  "position": {{ $counter }},
                  "item": {
                    "@type": "Course",
                    "name": "{{ $schedule->title }}",
                    "description": "Bimbingan Teknis dan Pelatihan Kategori {{ $category->name }} oleh Siap Indonesia.",
                    "provider": {
                      "@type": "Organization",
                      "name": "Siap Indonesia",
                      "sameAs": "{{ url('/') }}"
                    }
                  }
                }@if(!$loop->last || !$loop->parent->last),@endif
                @php $counter++; @endphp
            @endforeach
        @endforeach
      ]
    }
    </script>
@endsection

@section('content')
    @php
        $baseWaUrl = $setting->whatsapp_url ?? 'https://wa.me/628118087899';
        if (str_contains($baseWaUrl, '?')) {
            $baseWaUrl = explode('?', $baseWaUrl)[0];
        }
    @endphp
    <style>
        .custom-navbar-offset {
            margin-top: 100px;
        }
        @media (min-width: 768px) {
            .custom-navbar-offset {
                margin-top: 130px;
            }
        }
    </style>

    <div class="w-full flex-grow flex flex-col custom-navbar-offset">
        <x-navbar />

        <!-- Header / Hero Section -->
        <section id="ScheduleHero" class="relative py-12 md:py-16 overflow-hidden bg-gradient-to-b from-[#07090f] via-[#090d18] to-[#07090f] border-b border-[#c5a059]/10">
            <!-- Ambient Glow Lights -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-amber-500/5 rounded-full blur-[140px] pointer-events-none"></div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl relative z-10 text-center flex flex-col items-center">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-[#c5a059]/10 border border-[#c5a059]/30 rounded-full text-xs font-bold text-[#d4b26f] uppercase tracking-widest mb-4">
                    <span class="w-2 h-2 rounded-full bg-[#c5a059] animate-pulse"></span>
                    Jadwal Resmi Pelatihan & Bimtek SDM
                </span>

                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight font-[Poppins] mb-4">
                    Jadwal Pelatihan & <br class="hidden sm:inline" />
                    <span class="bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent">
                        Bimbingan Teknis
                    </span>
                </h1>

                <p class="text-zinc-400 max-w-2xl mx-auto text-xs sm:text-sm md:text-base leading-relaxed font-[Inter]">
                    Program peningkatan kapasitas SDM instansi pemerintah, BUMN, dan korporasi swasta dengan narasumber bersertifikasi kompetensi nasional.
                </p>
            </div>
        </section>

        <!-- Search & Filter Form Section -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl my-10">
            <div class="p-6 md:p-8 rounded-3xl bg-slate-900/90 border border-[#c5a059]/25 backdrop-blur-xl shadow-2xl relative overflow-hidden">
                <!-- Ambient Glow behind form -->
                <div class="absolute -top-24 -left-24 w-48 h-48 bg-[#c5a059]/10 rounded-full blur-[80px] pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-[#c5a059]/10 rounded-full blur-[80px] pointer-events-none"></div>

                <div class="flex items-center justify-between mb-6 pb-4 border-b border-white/10">
                    <h2 class="text-base sm:text-lg font-bold text-white font-[Poppins] flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-[#c5a059]/15 border border-[#c5a059]/30 flex items-center justify-center text-[#d4b26f]">
                            <i class="fas fa-search text-xs"></i>
                        </div>
                        <span>Cari & Filter Jadwal Pelatihan</span>
                    </h2>
                    <span class="text-[11px] text-[#d4b26f] font-semibold hidden sm:inline">Pencarian Interaktif Real-time</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <!-- Judul Input -->
                    <div class="flex flex-col gap-2">
                        <label for="filter-title" class="text-[11px] font-extrabold text-[#d4b26f] uppercase tracking-wider">Judul Training</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fas fa-book-open text-zinc-400 text-xs"></i>
                            </span>
                            <input type="text" id="filter-title" placeholder="Cari berdasarkan judul..." 
                                   class="w-full bg-slate-950/80 border border-white/15 focus:border-[#c5a059] rounded-xl py-3 ps-10 pe-4 text-xs sm:text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#c5a059]/30 transition-all duration-300 shadow-inner">
                        </div>
                    </div>

                    <!-- Tanggal Input -->
                    <div class="flex flex-col gap-2">
                        <label for="filter-date" class="text-[11px] font-extrabold text-[#d4b26f] uppercase tracking-wider">Tanggal</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="far fa-calendar-alt text-zinc-400 text-xs"></i>
                            </span>
                            <input type="text" id="filter-date" placeholder="Contoh: Jan, 12, 2026..." 
                                   class="w-full bg-slate-950/80 border border-white/15 focus:border-[#c5a059] rounded-xl py-3 ps-10 pe-4 text-xs sm:text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#c5a059]/30 transition-all duration-300 shadow-inner">
                        </div>
                    </div>

                    <!-- Tempat / Media Input -->
                    <div class="flex flex-col gap-2">
                        <label for="filter-location" class="text-[11px] font-extrabold text-[#d4b26f] uppercase tracking-wider">Media / Tempat</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fas fa-map-marker-alt text-zinc-400 text-xs"></i>
                            </span>
                            <input type="text" id="filter-location" placeholder="Contoh: Zoom, Jakarta, Bali..." 
                                   class="w-full bg-slate-950/80 border border-white/15 focus:border-[#c5a059] rounded-xl py-3 ps-10 pe-4 text-xs sm:text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#c5a059]/30 transition-all duration-300 shadow-inner">
                        </div>
                    </div>
                </div>

                <!-- Reset Button -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-3 mt-6 pt-4 border-t border-white/10">
                    <span class="text-xs text-zinc-400">Pencarian interaktif akan memfilter secara otomatis.</span>
                    <button type="button" id="reset-filters" 
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-950 border border-white/15 hover:border-[#c5a059]/50 text-zinc-300 hover:text-[#d4b26f] text-xs font-bold uppercase tracking-wider rounded-xl transition-all duration-300 cursor-pointer shadow-sm">
                        <i class="fas fa-undo text-xs"></i> Reset Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Global No Results Message -->
        <div id="no-schedules-found" class="container mx-auto px-4 max-w-7xl mb-12 text-center py-16 bg-slate-900/60 border border-white/10 rounded-3xl hidden">
            <div class="w-16 h-16 mx-auto rounded-full bg-[#c5a059]/15 border border-[#c5a059]/30 flex items-center justify-center mb-4">
                <i class="fas fa-search text-[#d4b26f] text-xl"></i>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">Jadwal Pelatihan Tidak Ditemukan</h3>
            <p class="text-zinc-400 text-sm max-w-md mx-auto">Maaf, kami tidak menemukan jadwal pelatihan yang cocok dengan filter pencarian Anda. Silakan coba kata kunci lain atau reset filter.</p>
        </div>

        <!-- Training Schedule Tables Grouped by Category -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl mb-16 space-y-12">
            @if ($categories->isNotEmpty())
                @foreach ($categories as $category)
                    <div class="space-y-4 category-group">
                        <!-- Category Header -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-[#c5a059]/15 border border-[#c5a059]/30 flex items-center justify-center text-[#d4b26f] shrink-0 shadow-md">
                                    <i class="fas fa-graduation-cap text-sm"></i>
                                </div>
                                <h2 class="text-xl sm:text-2xl font-black font-[Poppins] text-white">
                                    Kategori: <span class="bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent">{{ $category->name }}</span>
                                </h2>
                            </div>
                            <a href="{{ $baseWaUrl }}?text=Halo%20Admin%20Siap%20Indonesia,%20saya%20ingin%20konsultasi%20mengenai%20pelatihan%20kategori%20{{ rawurlencode($category->name) }}"
                               target="_blank"
                               class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-[#c5a059]/40 hover:border-[#d4b26f] text-[#d4b26f] hover:text-slate-950 hover:bg-gradient-to-r hover:from-[#e6c687] hover:to-[#d4b26f] font-extrabold text-xs uppercase tracking-wider rounded-full transition-all duration-300 shadow-md transform hover:-translate-y-0.5 group w-full sm:w-auto text-center shrink-0">
                                <i class="fab fa-whatsapp text-sm"></i>
                                <span>Konsultasi Gratis</span>
                            </a>
                        </div>

                        <!-- Desktop View: Glassmorphic Executive Table -->
                        <div class="hidden md:block w-full overflow-x-auto rounded-2xl border border-white/10 bg-slate-900/60 backdrop-blur-xl shadow-2xl news-scrollbar">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-950/80 text-[#d4b26f] font-[Poppins] border-b border-white/10">
                                        <th class="py-3.5 px-4 text-xs font-extrabold uppercase tracking-wider w-[14%]">Tanggal</th>
                                        <th class="py-3.5 px-4 text-xs font-extrabold uppercase tracking-wider w-[42%]">Judul Training / Pelatihan</th>
                                        <th class="py-3.5 px-4 text-xs font-extrabold uppercase tracking-wider w-[14%]">Waktu</th>
                                        <th class="py-3.5 px-4 text-xs font-extrabold uppercase tracking-wider w-[15%]">Media / Tempat</th>
                                        <th class="py-3.5 px-4 text-xs font-extrabold uppercase tracking-wider w-[10%]">Investasi</th>
                                        <th class="py-3.5 px-4 text-xs font-extrabold uppercase tracking-wider text-center w-[5%]">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5 text-zinc-200">
                                    @foreach ($category->trainingSchedules as $schedule)
                                        @php
                                            $waMessage = "Halo Admin Siap Indonesia, saya ingin mendaftar pelatihan berikut:\n\n" .
                                                         "• Judul: " . $schedule->title . "\n" .
                                                         "• Tanggal: " . $schedule->date . "\n" .
                                                         "• Waktu: " . $schedule->time . "\n" .
                                                         "• Tempat/Media: " . $schedule->location . "\n" .
                                                         "• Investasi: " . $schedule->price . "\n\n" .
                                                         "Mohon informasi selanjutnya untuk proses pendaftaran. Terima kasih.";
                                            $waUrl = $baseWaUrl . "?text=" . rawurlencode($waMessage);
                                        @endphp
                                        <tr class="hover:bg-slate-800/60 transition-colors duration-200">
                                            <!-- Date -->
                                            <td class="py-3.5 px-4 font-semibold text-xs text-zinc-100 whitespace-nowrap">
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-[#c5a059]/15 border border-[#c5a059]/30 rounded-lg text-[#d4b26f] text-xs font-bold">
                                                    <i class="far fa-calendar-alt"></i>
                                                    <span>{{ $schedule->date }}</span>
                                                </span>
                                            </td>
                                            <!-- Title -->
                                            <td class="py-3.5 px-4 text-xs sm:text-sm font-extrabold text-white font-[Poppins]">
                                                {{ $schedule->title }}
                                            </td>
                                            <!-- Time -->
                                            <td class="py-3.5 px-4 text-xs whitespace-nowrap text-zinc-300">
                                                <div class="flex items-center gap-1.5">
                                                    <i class="far fa-clock text-[#c5a059]"></i>
                                                    <span>{{ $schedule->time }}</span>
                                                </div>
                                            </td>
                                            <!-- Location / Media -->
                                            <td class="py-3.5 px-4 text-xs text-zinc-300">
                                                @if (Str::contains(strtolower($schedule->location), ['zoom', 'online', 'daring']))
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded-full text-emerald-400 text-xs font-bold">
                                                        <i class="fas fa-video text-xs"></i>
                                                        <span>{{ $schedule->location }}</span>
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-amber-500/10 border border-amber-500/20 rounded-full text-amber-300 text-xs font-bold">
                                                        <i class="fas fa-map-marker-alt text-xs"></i>
                                                        <span>{{ $schedule->location }}</span>
                                                    </span>
                                                @endif
                                            </td>
                                            <!-- Price -->
                                            <td class="py-3.5 px-4 font-black text-xs sm:text-sm text-[#e6c687] whitespace-nowrap">
                                                {{ $schedule->price }}
                                            </td>
                                            <!-- Action Buttons -->
                                            <td class="py-3.5 px-4 text-center">
                                                <div class="flex flex-col xl:flex-row gap-2 justify-center items-center">
                                                    <!-- Daftar Sekarang -->
                                                    <button type="button"
                                                            onclick="showTrainingDetails(this)"
                                                            data-title="{{ $schedule->title }}"
                                                            data-date="{{ $schedule->date }}"
                                                            data-time="{{ $schedule->time }}"
                                                            data-location="{{ $schedule->location }}"
                                                            data-price="{{ $schedule->price }}"
                                                            data-thumbnail="{{ $schedule->thumbnail ? asset('storage/' . $schedule->thumbnail) : '' }}"
                                                            data-wa-url="{{ $waUrl }}"
                                                            class="inline-flex items-center justify-center gap-1 px-3 py-1.5 bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] hover:from-[#edd1a1] hover:to-[#8a6109] text-slate-950 font-black text-[10px] uppercase tracking-wider rounded-lg transition-all duration-300 shadow-sm transform hover:-translate-y-0.5 cursor-pointer w-full xl:w-auto">
                                                        <i class="fab fa-whatsapp"></i>
                                                        <span>Daftar</span>
                                                    </button>
                                                    <!-- Lihat Nanti -->
                                                    <button type="button"
                                                            onclick="showTrainingDetails(this)"
                                                            data-title="{{ $schedule->title }}"
                                                            data-date="{{ $schedule->date }}"
                                                            data-time="{{ $schedule->time }}"
                                                            data-location="{{ $schedule->location }}"
                                                            data-price="{{ $schedule->price }}"
                                                            data-thumbnail="{{ $schedule->thumbnail ? asset('storage/' . $schedule->thumbnail) : '' }}"
                                                            data-wa-url="{{ $waUrl }}"
                                                            class="inline-flex items-center justify-center gap-1 px-3 py-1.5 border border-white/20 hover:border-[#c5a059] text-zinc-300 hover:text-[#d4b26f] font-extrabold text-[10px] uppercase tracking-wider rounded-lg transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer w-full xl:w-auto">
                                                        <i class="far fa-eye text-[10px]"></i>
                                                        <span>Detail</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile View: Modern Training Cards -->
                        <div class="grid grid-cols-1 gap-4 md:hidden">
                            @foreach ($category->trainingSchedules as $schedule)
                                @php
                                    $waMessage = "Halo Admin Siap Indonesia, saya ingin mendaftar pelatihan berikut:\n\n" .
                                                 "• Judul: " . $schedule->title . "\n" .
                                                 "• Tanggal: " . $schedule->date . "\n" .
                                                 "• Waktu: " . $schedule->time . "\n" .
                                                 "• Tempat/Media: " . $schedule->location . "\n" .
                                                 "• Investasi: " . $schedule->price . "\n\n" .
                                                 "Mohon informasi selanjutnya untuk proses pendaftaran. Terima kasih.";
                                    $waUrl = $baseWaUrl . "?text=" . rawurlencode($waMessage);
                                @endphp
                                <div class="bg-slate-900/80 border border-white/10 hover:border-[#c5a059]/40 rounded-2xl p-5 space-y-3.5 shadow-xl relative overflow-hidden mobile-schedule-card">
                                    <div class="flex justify-between items-start gap-2">
                                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-[#c5a059]/15 border border-[#c5a059]/30 rounded-lg text-[#d4b26f] font-bold text-[11px] mobile-date">
                                            <i class="far fa-calendar-alt"></i>
                                            <span>{{ $schedule->date }}</span>
                                        </div>
                                        <span class="font-black text-xs text-[#e6c687] shrink-0">
                                            {{ $schedule->price }}
                                        </span>
                                    </div>
                                    
                                    <h3 class="text-white font-black text-xs sm:text-sm leading-snug font-[Poppins] mobile-title">
                                        {{ $schedule->title }}
                                    </h3>

                                    <div class="grid grid-cols-2 gap-2 text-[11px] text-zinc-300 border-t border-white/10 pt-2.5">
                                        <div class="flex items-center gap-1.5 mobile-time">
                                            <i class="far fa-clock text-[#c5a059]"></i>
                                            <span class="truncate">{{ $schedule->time }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5 justify-end mobile-location">
                                            @if (Str::contains(strtolower($schedule->location), ['zoom', 'online', 'daring']))
                                                <i class="fas fa-video text-emerald-400"></i>
                                            @else
                                                <i class="fas fa-map-marker-alt text-amber-400"></i>
                                            @endif
                                            <span class="truncate max-w-[90px] font-semibold text-white">{{ $schedule->location }}</span>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex gap-2 pt-1">
                                        <!-- Daftar Sekarang -->
                                        <button type="button"
                                                onclick="showTrainingDetails(this)"
                                                data-title="{{ $schedule->title }}"
                                                data-date="{{ $schedule->date }}"
                                                data-time="{{ $schedule->time }}"
                                                data-location="{{ $schedule->location }}"
                                                data-price="{{ $schedule->price }}"
                                                data-thumbnail="{{ $schedule->thumbnail ? asset('storage/' . $schedule->thumbnail) : '' }}"
                                                data-wa-url="{{ $waUrl }}"
                                                class="flex-grow justify-center items-center gap-1.5 py-2.5 px-3 bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] text-slate-950 font-black text-[10px] uppercase tracking-wider rounded-xl transition-all duration-300 shadow-md flex cursor-pointer">
                                            <i class="fab fa-whatsapp"></i>
                                            <span>Daftar</span>
                                        </button>
                                        <!-- Lihat Nanti -->
                                        <button type="button"
                                                onclick="showTrainingDetails(this)"
                                                data-title="{{ $schedule->title }}"
                                                data-date="{{ $schedule->date }}"
                                                data-time="{{ $schedule->time }}"
                                                data-location="{{ $schedule->location }}"
                                                data-price="{{ $schedule->price }}"
                                                data-thumbnail="{{ $schedule->thumbnail ? asset('storage/' . $schedule->thumbnail) : '' }}"
                                                data-wa-url="{{ $waUrl }}"
                                                class="flex-grow justify-center items-center gap-1.5 py-2.5 px-3 border border-white/20 hover:border-[#c5a059] text-zinc-300 hover:text-[#d4b26f] font-extrabold text-[10px] uppercase tracking-wider rounded-xl transition-all duration-300 flex cursor-pointer">
                                            <i class="far fa-eye"></i>
                                            <span>Detail</span>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Empty State -->
                <div class="py-16 px-4 bg-slate-900/30 border border-white/10 rounded-[24px] text-center">
                    <svg class="w-16 h-16 text-zinc-500 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <h2 class="text-xl font-bold font-[Poppins] text-white">Belum Ada Jadwal Pelatihan</h2>
                    <p class="text-xs text-zinc-400 mt-1 max-w-sm mx-auto">Silakan hubungi admin kami untuk informasi pelaksanaan bimtek atau pelatihan kelas privat/in-house.</p>
                </div>
            @endif
        </div>

        {{-- Advertisement Section --}}
        <x-banner-ad :bannerads="$bannerads" />

        {{-- Dokumentasi Training Section (Gallery Component) --}}
        <x-gallery :galleries="$galleries" title="Kegiatan Training & Bimtek Terkini" badge="Dokumentasi Pelatihan" subtitle="Dokumentasi kegiatan diklat dan pelatihan yang telah kami selenggarakan di berbagai instansi." />

        <!-- Apa Kata Mereka Section (Testimonials Marquee) -->
        @if ($testimonials->isNotEmpty())
            <x-testimonial />
        @endif

        <!-- Our Client Section -->
        @if ($partners->isNotEmpty())
            <x-our-client :partners="$partners" :show-button="true" :limit="18" />
        @endif

        <!-- Hubungi Kami Call-to-Action Banner -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl mb-16">
            <div class="relative rounded-3xl bg-gradient-to-r from-slate-900 via-[#0f172a] to-slate-900 border border-[#c5a059]/30 p-8 sm:p-12 overflow-hidden shadow-2xl">
                <!-- Background Ambient Lights -->
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-amber-500/10 rounded-full blur-[100px] pointer-events-none"></div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-8 space-y-3 text-center lg:text-left">
                        <span class="px-3.5 py-1 bg-[#c5a059]/15 border border-[#c5a059]/30 text-[#d4b26f] rounded-full text-xs font-extrabold uppercase tracking-widest inline-flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                            In-House Training & Bimtek Khusus
                        </span>
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white font-[Poppins] tracking-tight leading-tight">
                            Ingin Penyelenggaraan Kelas In-House / Bimtek Khusus?
                        </h2>
                        <p class="text-zinc-300 text-xs sm:text-sm max-w-2xl leading-relaxed">
                            Kami melayani pelatihan dengan silabus kustom yang disesuaikan dengan kebutuhan instansi Anda, baik secara daring maupun luring di seluruh wilayah Indonesia.
                        </p>
                    </div>

                    <div class="lg:col-span-4 flex justify-center lg:justify-end shrink-0">
                        <a href="{{ $baseWaUrl }}?text=Halo%20Admin%20Siap%20Indonesia,%20saya%20tertarik%20untuk%20konsultasi%20pelatihan%20in-house%20/Bimtek" 
                           target="_blank"
                           class="px-8 py-4 bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] hover:from-[#edd1a1] hover:to-[#8a6109] text-slate-950 font-black text-xs uppercase tracking-wider rounded-full shadow-[0_10px_25px_-5px_rgba(197,160,89,0.4)] hover:scale-[1.03] transition-all duration-300 flex items-center gap-2.5">
                           <i class="fab fa-whatsapp text-base"></i>
                           <span>Hubungi Kami</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Beautiful Glassmorphic Detail Modal -->
        <div id="training-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300">
            <div class="relative w-full max-w-2xl bg-slate-900/95 border border-white/10 rounded-[32px] overflow-hidden shadow-[0_25px_60px_-15px_rgba(0,0,0,0.7)] flex flex-col md:flex-row transform scale-95 transition-all duration-300">
                <!-- Close Button -->
                <button onclick="closeTrainingModal()" class="absolute top-4 right-4 z-20 w-8 h-8 rounded-full bg-black/40 hover:bg-black/60 flex items-center justify-center text-zinc-400 hover:text-white transition duration-200 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Left: Image -->
                <div id="modal-img-container" class="w-full md:w-1/2 h-48 md:h-auto relative bg-slate-950 border-r border-white/5 flex-shrink-0 hidden">
                    <img id="modal-thumbnail" src="" class="w-full h-full object-cover" alt="Training Thumbnail">
                    <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-transparent to-slate-900/95"></div>
                </div>

                <!-- Right: Details Content -->
                <div class="flex-grow p-6 sm:p-8 flex flex-col justify-between">
                    <div class="space-y-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-[#c5a059]/15 border border-[#c5a059]/30 rounded-full text-[10px] font-extrabold tracking-wider text-[#d4b26f] uppercase">
                            Detail Jadwal Pelatihan
                        </span>
                        
                        <h3 id="modal-title" class="text-xl sm:text-2xl font-black text-white leading-tight font-[Poppins]">
                            Judul Pelatihan
                        </h3>

                        <div class="space-y-3 pt-2 text-xs sm:text-sm text-zinc-300">
                            <!-- Tanggal -->
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-[#c5a059] shrink-0">
                                    <i class="far fa-calendar-alt text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-wider">Tanggal Pelaksanaan</p>
                                    <p id="modal-date" class="font-semibold text-white"></p>
                                </div>
                            </div>

                            <!-- Waktu -->
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-[#c5a059] shrink-0">
                                    <i class="far fa-clock text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-wider">Waktu Pelaksanaan</p>
                                    <p id="modal-time" class="font-semibold text-white"></p>
                                </div>
                            </div>

                            <!-- Tempat -->
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-[#c5a059] shrink-0">
                                    <i class="fas fa-map-marker-alt text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-wider">Media / Tempat</p>
                                    <p id="modal-location" class="font-semibold text-white"></p>
                                </div>
                            </div>

                            <!-- Investasi -->
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-[#c5a059] shrink-0">
                                    <i class="fas fa-wallet text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-wider">Biaya / Investasi</p>
                                    <p id="modal-price" class="font-black text-[#e6c687] text-base"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 mt-6 border-t border-white/10 pt-4">
                        <a id="modal-wa-btn" href="" target="_blank" class="flex-grow justify-center bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] text-slate-950 font-black text-xs uppercase tracking-wider py-3 px-5 rounded-xl inline-flex items-center gap-2 shadow-lg transition-all duration-300 hover:scale-[1.02]">
                            <i class="fab fa-whatsapp text-lg"></i>
                            Daftar Sekarang
                        </a>
                        <button onclick="closeTrainingModal()" class="border border-white/15 hover:border-white/30 hover:bg-white/5 text-white font-bold text-xs uppercase tracking-wider py-3 px-5 rounded-xl transition duration-300 cursor-pointer">
                            Lihat Nanti
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-auto w-full">
            <x-footer />
        </div>
    </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/filament/style.css') }}">
    <style>
        .partner-slick-slider img {
            width: auto !important;
            display: inline-block !important;
        }
    </style>
@endpush

@push('after-scripts')
    <script>
        $(document).ready(function(){
            $('.partner-slick-slider').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 0,
                speed: 8000,
                cssEase: 'linear',
                arrows: false,
                dots: false,
                infinite: true,
                pauseOnHover: false,
                pauseOnFocus: false,
                responsive: [
                    {
                        breakpoint: 1280,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            $('[data-fancybox="pelatihan-gallery"]').fancybox({
                transitionEffect: "zoom-in-out",
                transitionDuration: 500,
                animationEffect: "zoom",
                animationDuration: 400,
                buttons: [
                    "zoom",
                    "slideShow",
                    "fullScreen",
                    "close"
                ]
            });
        });

        // Global functions for Training Details Modal
        function showTrainingDetails(btn) {
            const title = btn.getAttribute('data-title');
            const date = btn.getAttribute('data-date');
            const time = btn.getAttribute('data-time');
            const location = btn.getAttribute('data-location');
            const price = btn.getAttribute('data-price');
            const thumbnail = btn.getAttribute('data-thumbnail');
            const waUrl = btn.getAttribute('data-wa-url');

            document.getElementById('modal-title').textContent = title;
            document.getElementById('modal-date').textContent = date;
            document.getElementById('modal-time').textContent = time;
            document.getElementById('modal-location').textContent = location;
            document.getElementById('modal-price').textContent = price;
            document.getElementById('modal-wa-btn').href = waUrl;

            const imgContainer = document.getElementById('modal-img-container');
            const modalThumbnail = document.getElementById('modal-thumbnail');

            if (thumbnail && thumbnail.trim() !== "") {
                modalThumbnail.src = thumbnail;
                imgContainer.classList.remove('hidden');
            } else {
                modalThumbnail.src = '';
                imgContainer.classList.add('hidden');
            }

            const modal = document.getElementById('training-modal');
            const modalContent = modal.querySelector('.relative');
            
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }

        function closeTrainingModal() {
            const modal = document.getElementById('training-modal');
            const modalContent = modal.querySelector('.relative');
            
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
        }

        // Client-side search and filtering for schedules
        $(document).ready(function() {
            const $filterTitle = $('#filter-title');
            const $filterDate = $('#filter-date');
            const $filterLocation = $('#filter-location');
            const $resetBtn = $('#reset-filters');
            
            function performFilter() {
                const titleVal = $filterTitle.val().toLowerCase().trim();
                const dateVal = $filterDate.val().toLowerCase().trim();
                const locationVal = $filterLocation.val().toLowerCase().trim();
                
                let globalVisibleCount = 0;
                
                $('.category-group').each(function() {
                    const $catGroup = $(this);
                    let catVisibleCount = 0;
                    
                    // Filter Desktop Rows
                    $catGroup.find('tbody tr').each(function() {
                        const $row = $(this);
                        const dateText = $row.find('td:nth-child(1)').text().toLowerCase();
                        const titleText = $row.find('td:nth-child(2)').text().toLowerCase();
                        const locationText = $row.find('td:nth-child(4)').text().toLowerCase();
                        
                        const matchesTitle = titleText.includes(titleVal);
                        const matchesDate = dateText.includes(dateVal);
                        const matchesLocation = locationText.includes(locationVal);
                        
                        if (matchesTitle && matchesDate && matchesLocation) {
                            $row.show();
                            catVisibleCount++;
                        } else {
                            $row.hide();
                        }
                    });
                    
                    // Filter Mobile Cards
                    let mobileVisibleCount = 0;
                    $catGroup.find('.mobile-schedule-card').each(function() {
                        const $card = $(this);
                        const dateText = $card.find('.mobile-date').text().toLowerCase();
                        const titleText = $card.find('.mobile-title').text().toLowerCase();
                        const locationText = $card.find('.mobile-location').text().toLowerCase();
                        
                        const matchesTitle = titleText.includes(titleVal);
                        const matchesDate = dateText.includes(dateVal);
                        const matchesLocation = locationText.includes(locationVal);
                        
                        if (matchesTitle && matchesDate && matchesLocation) {
                            $card.show();
                            mobileVisibleCount++;
                        } else {
                            $card.hide();
                        }
                    });
                    
                    // Count max visible items between desktop/mobile views
                    const totalVisible = Math.max(catVisibleCount, mobileVisibleCount);
                    if (totalVisible > 0) {
                        $catGroup.show();
                        globalVisibleCount += totalVisible;
                    } else {
                        $catGroup.hide();
                    }
                });
                
                // Show/hide "No schedules found" message
                if (globalVisibleCount === 0) {
                    $('#no-schedules-found').removeClass('hidden');
                } else {
                    $('#no-schedules-found').addClass('hidden');
                }
            }
            
            // Bind input event listeners
            $('#filter-title, #filter-date, #filter-location').on('input', performFilter);
            
            // Reset filters click handler
            $resetBtn.on('click', function() {
                $filterTitle.val('');
                $filterDate.val('');
                $filterLocation.val('');
                performFilter();
            });
        });
    </script>
@endpush
