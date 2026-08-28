<footer class="text-zinc-300 bg-neutral-950 border-t border-neutral-900/80">
    <div class="container mx-auto px-5 lg:px-20 py-12 md:py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- KOLOM 1: LOGO & BRAND -->
            <div class="flex flex-col space-y-5">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('assets/images/siapindo/logo-siapindo.png') }}"
                         class="h-20 object-contain"
                         alt="Siap Indonesia Logo" />
                </a>
                <div class="text-zinc-100">
                    <h3 class="font-bold text-lg tracking-wide uppercase">{{ $setting->company_name ?? 'SIAP INDONESIA' }}</h3>
                    <p class="text-xs text-[#c5a059] font-semibold tracking-wider">{{ $setting->company_slogan ?? 'Your Success is Our Concern' }}</p>
                </div>
                
                <a href="{{ $setting->company_profile_link ?? 'https://wa.me/628118087899?text=Halo%20Siap%20Indonesia,%20saya%20ingin%20meminta%20Company%20Profile' }}"
                   target="_blank"
                   class="btn-gold-glow px-5 py-2.5 rounded-full inline-block text-xs font-bold tracking-wider text-center uppercase w-max">
                    Download Company Profile
                </a>

                <!-- SOSMED HORIZONTAL -->
                <div class="flex items-center gap-4 pt-2">
                    @if($setting->instagram_url ?? 'https://www.instagram.com/siapindonesia.id')
                        <a href="{{ $setting->instagram_url ?? 'https://www.instagram.com/siapindonesia.id' }}" target="_blank" aria-label="Instagram" class="social-icon-gold">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    @endif
                    @if($setting->tiktok_url ?? 'https://www.tiktok.com/@siapindonesia')
                        <a href="{{ $setting->tiktok_url ?? 'https://www.tiktok.com/@siapindonesia' }}" target="_blank" aria-label="TikTok" class="social-icon-gold">
                            <i class="fab fa-tiktok text-xl"></i>
                        </a>
                    @endif
                    @if($setting->whatsapp_url ?? 'https://wa.me/628118087899')
                        <a href="{{ $setting->whatsapp_url ?? 'https://wa.me/628118087899' }}" target="_blank" aria-label="WhatsApp" class="social-icon-gold">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                    @endif
                    @if($setting->email_address ?? 'mailto:info@siapindonesia.id')
                        <a href="{{ $setting->email_address ?? 'mailto:info@siapindonesia.id' }}" aria-label="Email" class="social-icon-gold">
                            <i class="fas fa-envelope text-xl"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- KOLOM 2: DESKRIPSI PERUSAHAAN -->
            <div class="flex flex-col space-y-4">
                <h4 class="text-[#c5a059] font-bold text-sm tracking-widest uppercase mb-1">
                    {{ $setting->description_title ?? '(PT. SIAP INDONESIA GROUP)' }}
                </h4>
                <p class="text-sm leading-relaxed text-zinc-300">
                    {{ $setting->description_1 ?? 'SIAP Indonesia : Lembaga pengembangan and peningkatan kompetensi sumber daya manusia yang berfokus pada pelatihan, bimbingan teknis, workshop, seminar, dan in-house training.' }}
                </p>
                <p class="text-sm leading-relaxed text-zinc-300">
                    {{ $setting->description_2 ?? 'SIAP Keprotokolan : Pendampingan penyusunan pedoman & SOP keprotokolan resmi, grooming, public speaking, serta pelayanan luar biasa bagi instansi pemerintah dan swasta.' }}
                </p>
            </div>

            <!-- KOLOM 3: INFORMASI LAINNYA -->
            <div class="flex flex-col space-y-4">
                <h4 class="text-[#c5a059] font-bold text-sm tracking-widest uppercase mb-1">
                    INFORMASI LAINNYA :
                </h4>
                <ul class="space-y-2.5 text-sm">
                    @if($setting && !empty($setting->quick_links))
                        @foreach($setting->quick_links as $link)
                            <li class="flex items-center gap-2">
                                <span class="text-[#c5a059] text-[10px]">•</span>
                                <a href="{{ $link['url'] }}" class="text-zinc-300 hover:text-[#d4b26f] transition-colors duration-200">{{ $link['label'] }}</a>
                            </li>
                        @endforeach
                    @else
                        <!-- Fallback static menu links -->
                        <li class="flex items-center gap-2">
                            <span class="text-[#c5a059] text-[10px]">•</span>
                            <a href="{{ route('front.beranda') }}" class="text-zinc-300 hover:text-[#d4b26f] transition-colors duration-200">Beranda</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#c5a059] text-[10px]">•</span>
                            <a href="{{ route('front.profil') }}" class="text-zinc-300 hover:text-[#d4b26f] transition-colors duration-200">Tentang Kami</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#c5a059] text-[10px]">•</span>
                            <a href="{{ route('front.partner') }}" class="text-zinc-300 hover:text-[#d4b26f] transition-colors duration-200">Our Client</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#c5a059] text-[10px]">•</span>
                            <a href="{{ route('front.index') }}" class="text-zinc-300 hover:text-[#d4b26f] transition-colors duration-200">Berita Terkini</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#c5a059] text-[10px]">•</span>
                            <a href="https://wa.me/628118087899" target="_blank" class="text-zinc-300 hover:text-[#d4b26f] transition-colors duration-200">Hubungi Kami</a>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- KOLOM 4: INFORMASI KANTOR -->
            <div class="flex flex-col space-y-4">
                <h4 class="text-[#c5a059] font-bold text-sm tracking-widest uppercase mb-1">
                    KANTOR :
                </h4>
                <div class="text-sm leading-relaxed space-y-2 text-zinc-300">
                    <p class="flex items-start gap-2.5">
                        <i class="fas fa-map-marker-alt text-[#c5a059] mt-1 shrink-0"></i>
                        <span>{{ $setting->office_address ?? 'Menara 165 Lantai 14 Unit E, Jl. TB Simatupang, Cilandak Timur, Pasar Minggu, Jakarta Selatan' }}</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <i class="fas fa-phone-alt text-[#c5a059] shrink-0"></i>
                        <span>Telepon : {{ $setting->office_phone ?? '(021) 7808 7899' }}</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <i class="fas fa-mobile-alt text-[#c5a059] shrink-0"></i>
                        <span>Mobile : {{ $setting->office_mobile ?? '0811 8087 899' }}</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <i class="fas fa-envelope text-[#c5a059] shrink-0"></i>
                        <span>Email : {{ $setting->office_email ?? 'info@siapindonesia.id' }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- COPYRIGHT BAR -->
    <div class="w-full bg-neutral-950 border-t border-neutral-900/60 py-4">
        <div class="container mx-auto px-5 lg:px-20 text-center text-zinc-500 text-xs md:text-sm">
            {!! $setting->copyright_text ?? 'Copyright &copy; 2026 <span class="text-[#c5a059] font-semibold hover:text-[#d4b26f] transition-colors">SIAP Indonesia</span>. All Rights Reserved.' !!}
        </div>
    </div>
</footer>
