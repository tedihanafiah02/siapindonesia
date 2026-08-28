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

        <!-- Header / Hero Section -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl mb-8 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white leading-tight font-[Poppins] mb-4 bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent">
                Jadwal Pelatihan & Training
            </h1>
            <p class="text-zinc-400 max-w-2xl mx-auto text-xs sm:text-sm md:text-base px-2">
                Program peningkatan kapasitas SDM instansi pemerintah dan korporasi swasta dengan narasumber bersertifikasi nasional dan internasional.
            </p>
        </div>

        <!-- Search Form Section -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl mb-10">
            <div class="p-6 md:p-8 rounded-3xl bg-[#0c101a] border border-white/5 shadow-2xl relative overflow-hidden">
                <!-- Ambient Glow behind form -->
                <div class="absolute -top-24 -left-24 w-48 h-48 bg-[#c5a059]/10 rounded-full blur-[80px] pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-[#c5a059]/10 rounded-full blur-[80px] pointer-events-none"></div>

                <h2 class="text-base sm:text-lg font-bold text-white font-[Poppins] mb-6 flex items-center gap-2">
                    <i class="fas fa-search text-[#c5a059]"></i> Cari & Filter Jadwal Pelatihan
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <!-- Judul Input -->
                    <div class="flex flex-col gap-2">
                        <label for="filter-title" class="text-xs font-semibold text-zinc-400 uppercase tracking-wider">Judul Training</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fas fa-book-open text-zinc-500 text-xs"></i>
                            </span>
                            <input type="text" id="filter-title" placeholder="Cari judul..." 
                                   class="w-full bg-neutral-950 border border-white/10 rounded-xl py-3 ps-10 pe-4 text-sm text-white focus:outline-none focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059] transition-all duration-300">
                        </div>
                    </div>

                    <!-- Tanggal Input -->
                    <div class="flex flex-col gap-2">
                        <label for="filter-date" class="text-xs font-semibold text-zinc-400 uppercase tracking-wider">Tanggal</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="far fa-calendar-alt text-zinc-500 text-xs"></i>
                            </span>
                            <input type="text" id="filter-date" placeholder="Contoh: Jan, 12, 2026..." 
                                   class="w-full bg-neutral-950 border border-white/10 rounded-xl py-3 ps-10 pe-4 text-sm text-white focus:outline-none focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059] transition-all duration-300">
                        </div>
                    </div>

                    <!-- Tempat / Media Input -->
                    <div class="flex flex-col gap-2">
                        <label for="filter-location" class="text-xs font-semibold text-zinc-400 uppercase tracking-wider">Media / Tempat</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fas fa-map-marker-alt text-zinc-500 text-xs"></i>
                            </span>
                            <input type="text" id="filter-location" placeholder="Contoh: Zoom, Jakarta, Bali..." 
                                   class="w-full bg-neutral-950 border border-white/10 rounded-xl py-3 ps-10 pe-4 text-sm text-white focus:outline-none focus:border-[#c5a059] focus:ring-1 focus:ring-[#c5a059] transition-all duration-300">
                        </div>
                    </div>
                </div>

                <!-- Reset Button -->
                <div class="flex justify-between items-center mt-6">
                    <span class="text-xs text-zinc-500">Pencarian interaktif akan memfilter secara otomatis.</span>
                    <button type="button" id="reset-filters" 
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-neutral-900 border border-white/10 hover:border-[#c5a059]/30 text-zinc-400 hover:text-[#c5a059] text-xs font-bold uppercase tracking-wider rounded-xl transition-all duration-300 cursor-pointer">
                        <i class="fas fa-undo text-xs"></i> Reset Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Global No Results Message -->
        <div id="no-schedules-found" class="container mx-auto px-4 max-w-7xl mb-12 text-center py-16 bg-[#0c101a]/50 border border-white/5 rounded-3xl hidden">
            <div class="w-16 h-16 mx-auto rounded-full bg-[#c5a059]/10 border border-[#c5a059]/20 flex items-center justify-center mb-4">
                <i class="fas fa-search text-[#c5a059] text-xl"></i>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">Jadwal Pelatihan Tidak Ditemukan</h3>
            <p class="text-zinc-400 text-sm max-w-md mx-auto">Maaf, kami tidak menemukan jadwal pelatihan yang cocok dengan filter pencarian Anda. Silakan coba kata kunci lain atau reset filter.</p>
        </div>

        <!-- Training Schedule Tables Grouped by Category -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl mb-12 space-y-10">
            @if ($categories->isNotEmpty())
                @foreach ($categories as $category)
                    <div class="space-y-4 category-group">
                        <!-- Category Header -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/5 pb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#c5a059]/10 flex items-center justify-center text-[#c5a059] shrink-0">
                                    <i class="fas fa-graduation-cap text-xs"></i>
                                </div>
                                <h2 class="text-lg sm:text-xl md:text-2xl font-bold font-[Poppins] text-white">
                                    Kategori: {{ $category->name }}
                                </h2>
                            </div>
                            <a href="{{ $baseWaUrl }}?text=Halo%20Admin%20Siap%20Indonesia,%20saya%20ingin%20konsultasi%20mengenai%20pelatihan%20kategori%20{{ rawurlencode($category->name) }}"
                               target="_blank"
                               class="inline-flex items-center justify-center gap-2 px-4 py-2 sm:px-5 sm:py-2.5 border border-[#c5a059]/40 hover:border-[#d4b26f] text-[#c5a059] hover:text-slate-950 hover:bg-gradient-to-r hover:from-[#e6c687] hover:to-[#d4b26f] font-extrabold text-[10px] sm:text-xs uppercase tracking-widest rounded-full transition-all duration-300 shadow-[0_0_15px_rgba(197,160,89,0.03)] hover:shadow-[0_4px_15px_rgba(197,160,89,0.25)] transform hover:-translate-y-0.5 group w-full sm:w-auto text-center shrink-0">
                                <i class="fab fa-whatsapp text-sm"></i>
                                <span>Konsultasi Gratis</span>
                            </a>
                        </div>

                        <!-- Desktop View: Glassmorphic Compact Table -->
                        <div class="hidden md:block w-full overflow-x-auto rounded-2xl border border-white/15 bg-slate-950/20 backdrop-blur-2xl shadow-xl news-scrollbar">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-900/60 text-zinc-300 font-[Poppins] border-b border-white/25">
                                        <th class="py-3 px-4 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-[#c5a059] border-r border-white/25 w-[12%]">Tanggal</th>
                                        <th class="py-3 px-4 text-[11px] sm:text-xs font-bold uppercase tracking-wider border-r border-white/25 w-[45%]">Judul Training / Pelatihan</th>
                                        <th class="py-3 px-4 text-[11px] sm:text-xs font-bold uppercase tracking-wider border-r border-white/25 w-[13%]">Waktu</th>
                                        <th class="py-3 px-4 text-[11px] sm:text-xs font-bold uppercase tracking-wider border-r border-white/25 w-[15%]">Media / Tempat</th>
                                        <th class="py-3 px-4 text-[11px] sm:text-xs font-bold uppercase tracking-wider border-r border-white/25 w-[10%]">Investasi</th>
                                        <th class="py-3 px-4 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-center w-[5%]">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-zinc-300">
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
                                        <tr class="hover:bg-slate-900/40 transition duration-300 border-b border-white/15">
                                            <!-- Date -->
                                            <td class="py-3 px-4 font-semibold text-[11px] sm:text-xs text-zinc-100 whitespace-nowrap border-r border-white/15">
                                                <div class="flex items-center gap-2">
                                                    <i class="far fa-calendar-alt text-[#c5a059]/80"></i>
                                                    <span>{{ $schedule->date }}</span>
                                                </div>
                                            </td>
                                            <!-- Title -->
                                            <td class="py-3 px-4 text-xs sm:text-sm font-extrabold text-zinc-200 border-r border-white/15">
                                                {{ $schedule->title }}
                                            </td>
                                            <!-- Time -->
                                            <td class="py-3 px-4 text-[11px] sm:text-xs whitespace-nowrap border-r border-white/15">
                                                <div class="flex items-center gap-2">
                                                    <i class="far fa-clock text-zinc-400"></i>
                                                    <span>{{ $schedule->time }}</span>
                                                </div>
                                            </td>
                                            <!-- Location / Media -->
                                            <td class="py-3 px-4 text-[11px] sm:text-xs text-zinc-400 border-r border-white/15">
                                                <div class="flex items-center gap-2">
                                                    @if (Str::contains(strtolower($schedule->location), ['zoom', 'online', 'daring']))
                                                        <i class="fas fa-video text-green-400"></i>
                                                    @else
                                                        <i class="fas fa-map-marker-alt text-amber-500"></i>
                                                    @endif
                                                    <span>{{ $schedule->location }}</span>
                                                </div>
                                            </td>
                                            <!-- Price -->
                                            <td class="py-3 px-4 font-bold text-[11px] sm:text-xs text-[#d4b26f] whitespace-nowrap border-r border-white/15">
                                                {{ $schedule->price }}
                                            </td>
                                            <!-- Action -->
                                            <td class="py-3 px-4 text-xs sm:text-sm text-center">
                                                <div class="flex flex-col xl:flex-row gap-1.5 justify-center items-center">
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
                                                            class="inline-flex items-center justify-center gap-1 px-2.5 py-1.5 bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-400 hover:to-green-500 text-white font-extrabold text-[10px] uppercase tracking-wider rounded-lg transition-all duration-300 shadow-sm transform hover:-translate-y-0.5 cursor-pointer w-full xl:w-auto">
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
                                                            class="inline-flex items-center justify-center gap-1 px-2.5 py-1.5 border border-[#c5a059]/40 hover:border-[#d4b26f] text-[#c5a059] hover:text-slate-950 hover:bg-gradient-to-r hover:from-[#e6c687] hover:to-[#d4b26f] font-extrabold text-[10px] uppercase tracking-wider rounded-lg transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer w-full xl:w-auto">
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

                        <!-- Mobile View: Elegant Training Cards -->
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
                                <div class="bg-slate-900/40 border border-white/5 rounded-2xl p-4 space-y-3.5 shadow-lg relative overflow-hidden mobile-schedule-card">
                                    <div class="flex justify-between items-start gap-2">
                                        <div class="flex items-center gap-1.5 text-[#c5a059] font-bold text-[11px] mobile-date">
                                            <i class="far fa-calendar-alt"></i>
                                            <span>{{ $schedule->date }}</span>
                                        </div>
                                        <span class="font-extrabold text-[11px] text-[#d4b26f] shrink-0">
                                            {{ $schedule->price }}
                                        </span>
                                    </div>
                                    
                                    <h3 class="text-zinc-100 font-extrabold text-xs leading-snug mobile-title">
                                        {{ $schedule->title }}
                                    </h3>

                                    <div class="grid grid-cols-2 gap-2 text-[10px] text-zinc-400 border-t border-white/5 pt-2">
                                        <div class="flex items-center gap-1.5 mobile-time">
                                            <i class="far fa-clock text-zinc-500"></i>
                                            <span class="truncate">{{ $schedule->time }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5 justify-end mobile-location">
                                            @if (Str::contains(strtolower($schedule->location), ['zoom', 'online', 'daring']))
                                                <i class="fas fa-video text-green-400/80"></i>
                                            @else
                                                <i class="fas fa-map-marker-alt text-amber-500/80"></i>
                                            @endif
                                            <span class="truncate max-w-[80px]">{{ $schedule->location }}</span>
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
                                                class="flex-grow justify-center items-center gap-1.5 py-2 px-3 bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-400 hover:to-green-500 text-white font-extrabold text-[10px] uppercase tracking-wider rounded-xl transition-all duration-300 shadow-md flex cursor-pointer">
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
                                                class="flex-grow justify-center items-center gap-1.5 py-2 px-3 border border-[#c5a059]/40 hover:border-[#d4b26f] text-[#c5a059] font-extrabold text-[10px] uppercase tracking-wider rounded-xl transition-all duration-300 flex cursor-pointer">
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
                <div class="py-16 px-4 bg-slate-900/10 border border-white/5 rounded-[24px] text-center">
                    <svg class="w-16 h-16 text-zinc-600 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <h2 class="text-xl font-bold font-[Poppins] text-white">Belum Ada Jadwal Pelatihan</h2>
                    <p class="text-xs text-zinc-500 mt-1 max-w-sm mx-auto">Silakan hubungi admin kami untuk informasi pelaksanaan bimtek atau pelatihan kelas privat/in-house.</p>
                </div>
            @endif
        </div>

        {{-- Advertisement Section --}}
        <x-banner-ad :bannerads="$bannerads" />


        <!-- Dokumentasi Training Section (Gallery) -->
        @if ($galleries->isNotEmpty())
            <section class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl mb-12 border-t border-white/5 pt-10">
                <div class="text-center mb-6">
                    <h2 class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent font-[Poppins] mb-3">
                        Dokumentasi Training
                    </h2>
                    <p class="text-zinc-400 text-xs sm:text-sm">Dokumentasi kegiatan diklat dan pelatihan yang telah kami selenggarakan.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($galleries as $gallery)
                        <div class="group relative overflow-hidden rounded-2xl border border-white/5 bg-slate-900/40 shadow-lg hover:shadow-[0_8px_30px_rgba(197,160,89,0.15)] hover:border-[#c5a059]/25 transition-all duration-500 transform hover:-translate-y-1.5 aspect-[4/3] cursor-pointer">
                            <a data-fancybox="pelatihan-gallery" href="{{ asset('storage/' . $gallery->image_path) }}" data-caption="{{ $gallery->alt_text }}">
                                <!-- Image -->
                                <img class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out" 
                                     src="{{ asset('storage/' . $gallery->image_path) }}" 
                                     alt="{{ $gallery->alt_text }}" />
                                
                                <!-- Elegant Dark Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-4 z-10">
                                    <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 ease-out">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-[#c5a059]/10 border border-[#c5a059]/30 rounded-full text-[9px] font-bold text-[#d4b26f] uppercase tracking-widest mb-2">
                                            Dokumentasi
                                        </span>
                                        <p class="text-xs font-bold text-white line-clamp-2 leading-snug font-[Poppins]">
                                            {{ $gallery->alt_text ?? 'Dokumentasi Training Siap Indonesia' }}
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- Zoom Icon Tag -->
                                <div class="absolute top-4 right-4 w-9 h-9 rounded-full bg-slate-950/80 backdrop-blur-md border border-white/10 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-75 group-hover:scale-100 shadow-md z-10">
                                    <i class="fas fa-search-plus text-xs text-[#c5a059]"></i>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Apa Kata Mereka Section (Testimonials Marquee) -->
        @if ($testimonials->isNotEmpty())
            <section class="py-12 border-t border-white/5 bg-[#0b0e14]/40 overflow-hidden">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl mb-6 text-center">
                    <h2 class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-[#e6c687] via-[#d4b26f] to-[#aa7c11] bg-clip-text text-transparent font-[Poppins] mb-3">
                        Apa Kata Mereka
                    </h2>
                    <p class="text-zinc-400 text-xs sm:text-sm">Ulasan dan kesan dari para peserta pelatihan SIAP Indonesia.</p>
                </div>

                @php
                    $count = $testimonials->count();
                    if ($count > 0) {
                        $allTestimonials = $testimonials;
                        while ($allTestimonials->count() < 8) {
                            $allTestimonials = $allTestimonials->concat($testimonials);
                        }
                        $totalCount = $allTestimonials->count();
                        $half = ceil($totalCount / 2);
                        $row1 = $allTestimonials->take($half);
                    } else {
                        $row1 = collect();
                    }
                @endphp

                <div class="w-full py-4">
                    <div class="marquee-wrapper fade-edges-mask mb-6">
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
                                                <span class="testimonial-position">{{ $testimonial->position }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- Double items for infinite marquee loop --}}
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
                                                <span class="testimonial-position">{{ $testimonial->position }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- Our Client Section -->
        @if ($partners->isNotEmpty())
            <x-our-client :partners="$partners" :show-button="true" :limit="18" />
        @endif

        <!-- Hubungi Kami Call-to-Action Banner -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl mb-4 mt-2">
            <div class="w-full bg-gradient-to-br from-yellow-600/20 via-yellow-900/10 to-transparent border border-yellow-500/20 rounded-[28px] p-6 sm:p-10 md:p-12 text-center space-y-6">
                <h2 class="text-xl sm:text-2xl md:text-4xl font-extrabold text-white leading-tight font-[Poppins] px-2">
                    Ingin Penyelenggaraan Kelas In-House / Bimtek Khusus?<br class="hidden sm:inline">Hubungi Kami Sekarang
                </h2>
                <p class="text-zinc-300 max-w-xl mx-auto text-xs sm:text-sm md:text-base px-2">
                    Kami melayani pelatihan dengan silabus kustom yang disesuaikan dengan kebutuhan instansi Anda, baik secara daring maupun luring.
                </p>
                <a href="{{ $baseWaUrl }}?text=Halo%20Admin%20Siap%20Indonesia,%20saya%20tertarik%20untuk%20konsultasi%20pelatihan%20in-house%20/Bimtek" 
                   target="_blank"
                   class="inline-flex items-center gap-2 px-6 sm:px-8 py-3.5 sm:py-4 bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-black font-extrabold text-xs sm:text-sm uppercase tracking-wider rounded-full shadow-lg transition-all duration-300 hover:scale-105">
                   <i class="fab fa-whatsapp text-base sm:text-lg"></i> HUBUNGI KAMI
                </a>
            </div>
        </section>

        <!-- Beautiful Glassmorphic Detail Modal -->
        <div id="training-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300">
            <div class="relative w-full max-w-2xl bg-[#0d111a]/95 border border-white/10 rounded-[32px] overflow-hidden shadow-[0_25px_60px_-15px_rgba(0,0,0,0.7)] flex flex-col md:flex-row transform scale-95 transition-all duration-300">
                <!-- Close Button -->
                <button onclick="closeTrainingModal()" class="absolute top-4 right-4 z-20 w-8 h-8 rounded-full bg-black/40 hover:bg-black/60 flex items-center justify-center text-zinc-400 hover:text-white transition duration-200 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Left: Image -->
                <div id="modal-img-container" class="w-full md:w-1/2 h-48 md:h-auto relative bg-slate-900 border-r border-white/5 flex-shrink-0 hidden">
                    <img id="modal-thumbnail" src="" class="w-full h-full object-cover" alt="Training Thumbnail">
                    <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-transparent to-[#0d111a]/95"></div>
                </div>

                <!-- Right: Details Content -->
                <div class="flex-grow p-6 sm:p-8 flex flex-col justify-between">
                    <div class="space-y-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-yellow-500/10 border border-yellow-500/20 rounded-full text-[10px] font-extrabold tracking-wider text-yellow-400 uppercase">
                            Detail Jadwal Pelatihan
                        </span>
                        
                        <h3 id="modal-title" class="text-xl sm:text-2xl font-black text-white leading-tight font-[Poppins]">
                            Judul Pelatihan
                        </h3>

                        <div class="space-y-3 pt-2 text-xs sm:text-sm text-zinc-300">
                            <!-- Tanggal -->
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-amber-500 shrink-0">
                                    <i class="far fa-calendar-alt text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-wider">Tanggal Pelaksanaan</p>
                                    <p id="modal-date" class="font-semibold text-zinc-200"></p>
                                </div>
                            </div>

                            <!-- Waktu -->
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-amber-500 shrink-0">
                                    <i class="far fa-clock text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-wider">Waktu Pelaksanaan</p>
                                    <p id="modal-time" class="font-semibold text-zinc-200"></p>
                                </div>
                            </div>

                            <!-- Tempat -->
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-amber-500 shrink-0">
                                    <i class="fas fa-map-marker-alt text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-wider">Media / Tempat</p>
                                    <p id="modal-location" class="font-semibold text-zinc-200"></p>
                                </div>
                            </div>

                            <!-- Investasi -->
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-amber-500 shrink-0">
                                    <i class="fas fa-wallet text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-wider">Biaya / Investasi</p>
                                    <p id="modal-price" class="font-black text-amber-400"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 mt-6 border-t border-white/5 pt-4">
                        <a id="modal-wa-btn" href="" target="_blank" class="flex-grow justify-center bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-400 hover:to-green-500 text-white font-extrabold text-xs uppercase tracking-wider py-3 px-5 rounded-xl inline-flex items-center gap-2 shadow-lg shadow-emerald-500/10 transition-all duration-300 hover:scale-[1.02]">
                            <i class="fab fa-whatsapp text-lg"></i>
                            Daftar Sekarang
                        </a>
                        <button onclick="closeTrainingModal()" class="border border-white/10 hover:border-white/20 hover:bg-white/5 text-white font-bold text-xs uppercase tracking-wider py-3 px-5 rounded-xl transition duration-300 cursor-pointer">
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
        /* Prevent slick partner logos from stretching */
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
