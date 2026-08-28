<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // Panggil seeder untuk kategori, penulis, artikel, testimoni, partner, footer, dan pelatihan
        $this->call([
            CategorySeeder::class,
            AuthorSeeder::class,
            ArticleNewsSeeder::class,
            TestimonialSeeder::class,
            TrainingScheduleSeeder::class,
            PartnerSeeder::class,
            FooterSettingSeeder::class,
            BannerAdvertisementSeeder::class,
        ]);
        
    }
}