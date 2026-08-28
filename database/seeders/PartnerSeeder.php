<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Clear existing partner data safely
        Partner::query()->delete();

        $partners = [
            [
                'name' => 'Kementerian Keuangan RI',
                'logo_path' => 'partners/logo_kemenkeu.png',
                'alt_text' => 'Logo Kementerian Keuangan RI',
            ],
            [
                'name' => 'Badan Pemeriksa Keuangan',
                'logo_path' => 'partners/logo_bpk.png',
                'alt_text' => 'Logo Badan Pemeriksa Keuangan',
            ],
            [
                'name' => 'Kementerian BUMN',
                'logo_path' => 'partners/logo_bumn.png',
                'alt_text' => 'Logo Kementerian BUMN',
            ],
            [
                'name' => 'Komisi Pemberantasan Korupsi',
                'logo_path' => 'partners/logo_kpk.png',
                'alt_text' => 'Logo Komisi Pemberantasan Korupsi',
            ],
            [
                'name' => 'PT Pertamina (Persero)',
                'logo_path' => 'partners/logo_pertamina.png',
                'alt_text' => 'Logo PT Pertamina (Persero)',
            ],
            [
                'name' => 'PT Bank Mandiri (Persero) Tbk',
                'logo_path' => 'partners/logo_mandiri.png',
                'alt_text' => 'Logo PT Bank Mandiri (Persero) Tbk',
            ],
            [
                'name' => 'PT PLN (Persero)',
                'logo_path' => 'partners/logo_pln.png',
                'alt_text' => 'Logo PT PLN (Persero)',
            ],
            [
                'name' => 'Astra International',
                'logo_path' => 'partners/logo_astra.png',
                'alt_text' => 'Logo Astra International',
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}