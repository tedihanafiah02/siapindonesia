<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Konfigurasi dinamis untuk URL public disk agar mendeteksi domain saat ini
        if (!app()->runningInConsole()) {
            config(['filesystems.disks.public.url' => asset('storage')]);
        }

        \Filament\Forms\Components\FileUpload::configureUsing(function (\Filament\Forms\Components\FileUpload $component) {
            $component
                ->maxSize(5120) // 5MB limit
                ->saveUploadedFileUsing(function (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file, \Filament\Forms\Components\FileUpload $component) {
                    // Get the directory configured for this FileUpload component (fallback to 'uploads')
                    $directory = $component->getDirectory() ?? 'uploads';
                    
                    // Optimize image using our service class
                    return \App\Services\ImageOptimizerService::optimize($file, $directory);
                });
        });

        // Share cached FooterSetting and navigation menus to all frontend and component views
        view()->composer(['front.*', 'components.*'], function ($view) {
            $setting = cache()->rememberForever('footer_setting', function () {
                return \App\Models\FooterSetting::first();
            });

            $navigationMenus = cache()->rememberForever('navigation_menus', function () {
                return \App\Models\Menu::whereNull('parent_id')
                    ->where('is_active', true)
                    ->orderBy('order_priority', 'asc')
                    ->with('allChildren')
                    ->get();
            });

            $view->with('setting', $setting);
            $view->with('globalSetting', $setting);
            $view->with('navigationMenus', $navigationMenus);
            $view->with('partners', cache()->rememberForever('all_partners', fn() => \App\Models\Partner::all()));
        });

        // Automatically invalidate caches when models are updated
        $clearNavCache = fn() => cache()->forget('navigation_menus');
        \App\Models\Menu::saved($clearNavCache);
        \App\Models\Menu::deleted($clearNavCache);

        $clearFooterCache = fn() => cache()->forget('footer_setting');
        \App\Models\FooterSetting::saved($clearFooterCache);
        \App\Models\FooterSetting::deleted($clearFooterCache);

        $clearPartnersCache = fn() => cache()->forget('all_partners');
        \App\Models\Partner::saved($clearPartnersCache);
        \App\Models\Partner::deleted($clearPartnersCache);

        $clearCategoriesCache = function() {
            cache()->forget('all_categories');
            cache()->forget('all_categories_with_news');
            cache()->forget('blog_category_sections');
        };
        \App\Models\Category::saved($clearCategoriesCache);
        \App\Models\Category::deleted($clearCategoriesCache);

        $clearArticlesCache = function() {
            cache()->forget('home_featured_blogs_pool');
            cache()->forget('home_latest_articles');
            cache()->forget('home_featured_articles_pool');
            cache()->forget('blog_category_sections');
            cache()->forget('all_categories_with_news');
        };
        \App\Models\ArticleNews::saved($clearArticlesCache);
        \App\Models\ArticleNews::deleted($clearArticlesCache);

        $clearTestimonialsCache = fn() => cache()->forget('all_testimonials');
        \App\Models\Testimonial::saved($clearTestimonialsCache);
        \App\Models\Testimonial::deleted($clearTestimonialsCache);

        $clearGalleriesCache = function () {
            cache()->forget('all_galleries');
            cache()->forget('home_galleries_six');
        };
        \App\Models\Gallery::saved($clearGalleriesCache);
        \App\Models\Gallery::deleted($clearGalleriesCache);

        $clearAuthorsCache = fn() => cache()->forget('all_authors');
        \App\Models\Author::saved($clearAuthorsCache);
        \App\Models\Author::deleted($clearAuthorsCache);

        $clearBannerAdsCache = fn() => cache()->forget('active_banner_ads_pool');
        \App\Models\BannerAdvertisement::saved($clearBannerAdsCache);
        \App\Models\BannerAdvertisement::deleted($clearBannerAdsCache);
    }
}