<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Models\Author;
use App\Models\ArticleNews;
use App\Models\Category;
use App\Models\BannerAdvertisement;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\TrainingCategory;
use App\Models\TrainingSchedule;
use App\Models\Testimonial;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    public function getViewData(): array
    {
        return [
            'authors' => Author::count(),
            'articles' => ArticleNews::count(),
            'categories' => Category::count(),
            'banners' => BannerAdvertisement::count(),
            'galleries' => Gallery::count(),
            'partners' => Partner::count(),
            'trainingCategories' => TrainingCategory::count(),
            'trainingSchedules' => TrainingSchedule::count(),
            'testimonials' => Testimonial::count(),
        ];
    }
}