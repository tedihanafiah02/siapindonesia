<?php

namespace Database\Seeders;

use App\Models\FooterSetting;
use Illuminate\Database\Seeder;

class FooterSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        FooterSetting::query()->delete();

        FooterSetting::create([
            'company_name' => 'SIAP INDONESIA',
            'company_slogan' => 'Your Success is Our Concern',
            'company_profile_link' => 'https://wa.me/628118087899?text=Halo%20Siap%20Indonesia,%20saya%20ingin%20meminta%20Company%20Profile',
            
            // Social Media
            'instagram_url' => 'https://www.instagram.com/siapindonesia.id',
            'tiktok_url' => 'https://www.tiktok.com/@siapindonesia',
            'whatsapp_url' => 'https://wa.me/628118087899',
            'email_address' => 'mailto:info@siapindonesia.id',
            
            // Description
            'description_title' => '(PT. SIAP INDONESIA GROUP)',
            'description_1' => 'SIAP Indonesia : Lembaga pengembangan dan peningkatan kompetensi sumber daya manusia yang berfokus pada pelatihan, bimbingan teknis, workshop, seminar, dan in-house training.',
            'description_2' => 'SIAP Keprotokolan : Pendampingan penyusunan pedoman & SOP keprotokolan resmi, grooming, public speaking, serta pelayanan luar biasa bagi instansi pemerintah dan swasta.',
            
            // Quick Links (Cast automatically as JSON)
            'quick_links' => [
                ['label' => 'Beranda', 'url' => '/'],
                ['label' => 'Tentang Kami', 'url' => '/profil'],
                ['label' => 'Partner Kami', 'url' => '/partner'],
                ['label' => 'Berita Terkini', 'url' => '/blog'],
                ['label' => 'Jadwal Pelatihan', 'url' => '/jadwal-pelatihan'],
                ['label' => 'Hubungi Kami', 'url' => 'https://wa.me/628118087899'],
            ],
            
            // Contact
            'office_address' => 'Menara 165 Lantai 14 Unit E, Jl. TB Simatupang, Cilandak Timur, Pasar Minggu, Jakarta Selatan',
            'office_phone' => '(021) 7808 7899',
            'office_mobile' => '0811 8087 899',
            'office_email' => 'info@siapindonesia.id',
            
            // Copyright
            'copyright_text' => 'Copyright &copy; 2026 SIAP Indonesia. All Rights Reserved.',
        ]);
    }
}
