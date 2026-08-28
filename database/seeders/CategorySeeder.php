<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Pastikan folder storage icons ada
        $storageIconPath = storage_path('app/public/icons');
        if (!file_exists($storageIconPath)) {
            mkdir($storageIconPath, 0755, true);
        }

        $publicIconPath = public_path('assets/images/icons');

        $categories = [
            [
                'name' => 'Kegiatan Pelatihan',
                'icon_filename' => 'courthouse.svg'
            ],
            [
                'name' => 'Artikel & Insight',
                'icon_filename' => 'favorite-chart.svg'
            ],
            [
                'name' => 'Tips & Edukasi',
                'icon_filename' => 'global.svg'
            ]
        ];

        foreach ($categories as $cat) {
            $sourceFile = $publicIconPath . '/' . $cat['icon_filename'];
            $destFile = $storageIconPath . '/' . $cat['icon_filename'];
            
            // Copy file jika ada di assets
            if (file_exists($sourceFile)) {
                copy($sourceFile, $destFile);
            }

            Category::updateOrCreate(
                ['name' => $cat['name']],
                [
                    'icon' => 'icons/' . $cat['icon_filename']
                ]
            );
        }
    }
}