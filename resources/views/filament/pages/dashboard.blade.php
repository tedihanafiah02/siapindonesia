<x-filament::page>
    <!-- CSS Styles to prevent Tailwind purging and ensure ultra-premium look -->
    <style>
        .db-container {
            display: flex;
            flex-direction: column;
            gap: 24px;
            font-family: 'Poppins', 'Inter', sans-serif;
            color: #cbd5e1;
        }

        /* Banner styling */
        .db-banner {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            border: 1px solid rgba(250, 204, 21, 0.2);
            border-left: 5px solid #d97706;
            background: linear-gradient(135deg, #090d16 0%, #0c1220 100%);
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 16px;
        }
        @media (min-width: 640px) {
            .db-banner {
                flex-direction: row;
                align-items: center;
            }
        }
        .db-banner-text h2 {
            font-size: 20px;
            font-weight: 800;
            color: #ffffff;
            margin: 0;
            letter-spacing: -0.01em;
        }
        .db-banner-text p {
            font-size: 12px;
            color: #94a3b8;
            margin: 4px 0 0 0;
        }
        .db-banner-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            background: linear-gradient(90deg, #eab308 0%, #ca8a04 100%);
            color: #080a0f !important;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-radius: 8px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(234, 179, 8, 0.2);
            text-decoration: none !important;
        }
        .db-banner-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(234, 179, 8, 0.4);
            filter: brightness(1.1);
        }

        /* Title styling */
        .db-title-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
        }
        .db-title-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #eab308;
            box-shadow: 0 0 8px #eab308;
        }
        .db-title-row h3 {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #94a3b8;
            margin: 0;
        }

        /* Grid layout */
        .db-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }
        @media (min-width: 640px) {
            .db-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (min-width: 1024px) {
            .db-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (min-width: 1280px) {
            .db-grid { grid-template-columns: repeat(4, 1fr); }
        }

        /* Card styles */
        .db-card {
            background-color: #0c1220;
            border-radius: 12px;
            padding: 20px;
            height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
            text-decoration: none !important;
            border: 1px solid rgba(255, 255, 255, 0.06);
        }
        .db-card:hover {
            transform: translateY(-4px);
        }

        /* Gold Card Theme */
        .card-gold {
            border-color: rgba(234, 179, 8, 0.18);
        }
        .card-gold:hover {
            border-color: #eab308;
            box-shadow: 0 0 25px rgba(234, 179, 8, 0.2);
        }
        .icon-gold {
            background-color: rgba(234, 179, 8, 0.08);
            border: 1px solid rgba(234, 179, 8, 0.2);
            color: #eab308;
        }
        .link-gold {
            color: #eab308 !important;
        }
        .link-gold:hover {
            color: #facc15 !important;
        }

        /* Blue Card Theme */
        .card-blue {
            border-color: rgba(59, 130, 246, 0.18);
        }
        .card-blue:hover {
            border-color: #3b82f6;
            box-shadow: 0 0 25px rgba(59, 130, 246, 0.2);
        }
        .icon-blue {
            background-color: rgba(59, 130, 246, 0.08);
            border: 1px solid rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }
        .link-blue {
            color: #3b82f6 !important;
        }
        .link-blue:hover {
            color: #60a5fa !important;
        }

        /* Card Inner Elements */
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }
        .card-header-text span {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
        }
        .card-header-text p {
            font-size: 11px;
            color: #64748b;
            margin: 4px 0 0 0;
            line-height: 1.3;
        }
        .card-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            flex-shrink: 0;
        }
        .card-value {
            font-size: 32px;
            font-weight: 800;
            color: #ffffff;
            margin: 8px 0;
            line-height: 1;
        }
        .card-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .card-footer-desc {
            font-size: 10px;
            color: #475569;
        }
        .card-footer-link {
            font-size: 10px;
            font-weight: 850;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            gap: 2px;
        }
    </style>

    <div class="db-container">
        <!-- Premium Welcome Banner -->
        <div class="db-banner">
            <div class="db-banner-text">
                <h2>Selamat Datang, {{ filament()->auth()->user()->name ?? 'Admin' }} di Panel Admin SIAP Indonesia</h2>
                <p>Kelola data, statistik konten, dan jalankan administrasi secara mudah dari portal eksekutif ini.</p>
            </div>
            <a href="/" target="_blank" class="db-banner-btn">
                <span>Lihat Website</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
            </a>
        </div>

        <!-- Section Title -->
        <div class="db-title-row">
            <div class="db-title-dot"></div>
            <h3>Panel Statistik Utama</h3>
        </div>

        <!-- Stats Grid -->
        <div class="db-grid">
            @foreach([
                [
                    'label' => 'Jadwal Pelatihan', 
                    'value' => $trainingSchedules, 
                    'desc' => 'Training aktif', 
                    'route' => 'filament.admin.resources.training-schedules.index',
                    'icon' => 'heroicon-m-calendar-days',
                    'theme' => 'gold'
                ],
                [
                    'label' => 'Kategori Pelatihan', 
                    'value' => $trainingCategories, 
                    'desc' => 'Urutan kelompok', 
                    'route' => 'filament.admin.resources.training-categories.index',
                    'icon' => 'heroicon-m-folder',
                    'theme' => 'blue'
                ],
                [
                    'label' => 'Artikel Berita', 
                    'value' => $articles, 
                    'desc' => 'Artikel keprotokolan', 
                    'route' => 'filament.admin.resources.article-news.index',
                    'icon' => 'heroicon-m-newspaper',
                    'theme' => 'blue'
                ],
                [
                    'label' => 'Kategori Berita', 
                    'value' => $categories, 
                    'desc' => 'Kelompok berita', 
                    'route' => 'filament.admin.resources.categories.index',
                    'icon' => 'heroicon-m-tag',
                    'theme' => 'gold'
                ],
                [
                    'label' => 'Penulis (Author)', 
                    'value' => $authors, 
                    'desc' => 'Kontributor berita', 
                    'route' => 'filament.admin.resources.authors.index',
                    'icon' => 'heroicon-m-users',
                    'theme' => 'blue'
                ],
                [
                    'label' => 'Galeri Dokumentasi', 
                    'value' => $galleries, 
                    'desc' => 'Foto dokumentasi', 
                    'route' => 'filament.admin.resources.galleries.index',
                    'icon' => 'heroicon-m-photo',
                    'theme' => 'gold'
                ],
                [
                    'label' => 'Klien & Partner', 
                    'value' => $partners, 
                    'desc' => 'Mitra & partner', 
                    'route' => 'filament.admin.resources.partners.index',
                    'icon' => 'heroicon-m-building-office-2',
                    'theme' => 'blue'
                ],
                [
                    'label' => 'Testimonial', 
                    'value' => $testimonials, 
                    'desc' => 'Ulasan alumni', 
                    'route' => 'filament.admin.resources.testimonials.index',
                    'icon' => 'heroicon-m-chat-bubble-bottom-center-text',
                    'theme' => 'gold'
                ],
                [
                    'label' => 'Iklan Banner', 
                    'value' => $banners, 
                    'desc' => 'Promosi horizontal', 
                    'route' => 'filament.admin.resources.banner-advertisements.index',
                    'icon' => 'heroicon-m-megaphone',
                    'theme' => 'blue'
                ],
            ] as $item)
                @php
                    $isGold = $item['theme'] === 'gold';
                    $themeClass = $isGold ? 'card-gold' : 'card-blue';
                    $iconClass = $isGold ? 'icon-gold' : 'icon-blue';
                    $linkClass = $isGold ? 'link-gold' : 'link-blue';
                @endphp
                <a href="{{ route($item['route']) }}" class="db-card {{ $themeClass }}">
                    <!-- Header -->
                    <div class="card-header">
                        <div class="card-header-text">
                            <span>{{ $item['label'] }}</span>
                            <p>{{ $item['desc'] }}</p>
                        </div>
                        <span class="card-icon {{ $iconClass }}">
                            @svg($item['icon'], 'w-5 h-5')
                        </span>
                    </div>

                    <!-- Value -->
                    <div class="card-value">
                        {{ $item['value'] }}
                    </div>

                    <!-- Footer Link -->
                    <div class="card-footer">
                        <span class="card-footer-desc">Klik untuk kelola</span>
                        <span class="card-footer-link {{ $linkClass }}">
                            Kelola <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-filament::page>
