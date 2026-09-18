<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Partner;
use App\Models\Category;
use App\Models\ArticleNews;
use App\Models\Testimonial;
use App\Models\TrainingSchedule;
use App\Models\TrainingCategory;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BannerAdvertisement;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class FrontController extends Controller
{
    public function sitemap()
    {
        $articles = ArticleNews::latest()->get();
        $categories = cache()->rememberForever('all_categories', fn() => Category::all());

        return response()->view('front.sitemap', compact('articles', 'categories'))->header('Content-Type', 'application/xml');
    }

    public function beranda()
    {
        $testimonials = cache()->rememberForever('all_testimonials', fn() => Testimonial::all());
        $partners = cache()->rememberForever('all_partners', fn() => Partner::all());
        $galleries = cache()->remember('home_galleries_six', 3600, fn() => Gallery::latest()->take(6)->get());
        
        // Optimasi: Gunakan cache untuk pool artikel unggulan dan acak di memori PHP (menghindari ORDER BY RAND())
        $featuredBlogs = cache()->remember('home_featured_blogs_pool', 3600, function() {
            return ArticleNews::with(['author', 'category'])->where('is_featured', 'featured')->latest()->take(20)->get();
        })->shuffle()->take(7);

        // SEO Configuration
        SEOMeta::setTitle('Siap Indonesia | Konsultan Keprotokolan Profesional');
        SEOMeta::setDescription('Layanan konsultasi keprotokolan, pelatihan SDM, dan pengembangan profesional untuk instansi pemerintah dan perusahaan swasta terbaik di Indonesia.');
        SEOMeta::addKeyword(['konsultan protokol', 'pelatihan SDM profesional', 'sertifikasi keprotokolan', 'public speaking', 'pelatihan grooming']);

        OpenGraph::setTitle('Siap Indonesia - Konsultan Keprotokolan Terpercaya');
        OpenGraph::setDescription(SEOMeta::getDescription());
        OpenGraph::setUrl(url('/'));
        OpenGraph::addImage(asset('assets/images/og-beranda.jpg'));
        OpenGraph::setSiteName('Siap Indonesia');

        TwitterCard::setTitle(SEOMeta::getTitle());
        TwitterCard::setDescription(SEOMeta::getDescription());
        TwitterCard::setImage(asset('assets/images/twitter-beranda.jpg'));

        $bannerads = BannerAdvertisement::getActiveBanners();

        return view('front.beranda', compact('partners', 'featuredBlogs', 'testimonials', 'bannerads', 'galleries'));
    }

    public function tentangKami()
    {
        SEOMeta::setTitle('Tentang Kami | Siap Indonesia');
        SEOMeta::setDescription('Profil dan sejarah Siap Indonesia sebagai konsultan keprotokolan terpercaya di Indonesia.');
        OpenGraph::addImage(asset('assets/images/about-us.jpg'));

        return view('front.tentang-kami');
    }

    public function profil()
    {
        SEOMeta::setTitle('Profil Perusahaan | Siap Indonesia');
        SEOMeta::setDescription('Profil lengkap perusahaan Siap Indonesia - Spesialis konsultan keprotokolan dan pelatihan SDM.');

        return view('front.profil');
    }

    public function visimisi()
    {
        SEOMeta::setTitle('Visi & Misi | Siap Indonesia');
        SEOMeta::setDescription('Visi dan misi perusahaan Siap Indonesia dalam memberikan layanan keprotokolan profesional.');

        return view('front.visimisi');
    }

    public function partner()
    {
        SEOMeta::setTitle('Klien Kami | Siap Indonesia');
        SEOMeta::setDescription('Daftar mitra dan klien kerja Siap Indonesia dalam menyelenggarakan pelatihan keprotokolan.');

        $partners = cache()->rememberForever('all_partners', fn() => Partner::all());
        $latestNews = ArticleNews::latest()->take(3)->get();
        $bannerads = BannerAdvertisement::getActiveBanners();
        
        return view('front.partner', compact('partners', 'latestNews', 'bannerads'));
    }

    public function program($slug)
    {
        $menu = \App\Models\Menu::where('slug', $slug)->where('is_active', true)->first();
        if ($menu) {
            // Setup SEO
            $seoTitle = $menu->seo_title ?: 'Pelatihan ' . ($menu->title ?: $menu->name) . ' | Siap Indonesia';
            $seoDesc = $menu->seo_description ?: ($menu->slogan ?: 'Pelatihan ' . ($menu->title ?: $menu->name));
            
            \Artesaos\SEOTools\Facades\SEOMeta::setTitle($seoTitle);
            \Artesaos\SEOTools\Facades\SEOMeta::setDescription($seoDesc);
            if ($menu->seo_keywords) {
                \Artesaos\SEOTools\Facades\SEOMeta::addKeyword(explode(',', $menu->seo_keywords));
            }

            \Artesaos\SEOTools\Facades\OpenGraph::setTitle($seoTitle);
            \Artesaos\SEOTools\Facades\OpenGraph::setDescription($seoDesc);
            \Artesaos\SEOTools\Facades\OpenGraph::setUrl(url()->current());
            if ($menu->banner_path) {
                \Artesaos\SEOTools\Facades\OpenGraph::addImage(asset('storage/' . $menu->banner_path));
            }

            // Check if it has active child menus
            if ($menu->children()->where('is_active', true)->exists()) {
                return view('front.program.listing', compact('menu'));
            }

            // Otherwise, render the custom detail page if has_page is enabled
            if ($menu->has_page) {
                $partners = cache()->rememberForever('all_partners', fn() => \App\Models\Partner::all());
                return view('front.program.custom_detail', compact('menu', 'partners'));
            }
        }
        abort(404);
    }

    public function index()
    {
        SEOMeta::setTitle('Blog & Artikel | Siap Indonesia');
        SEOMeta::setDescription('Kumpulan artikel terbaru seputar keprotokolan, pelatihan SDM, dan pengembangan profesional.');

        $categories = cache()->rememberForever('all_categories_with_news', function() {
            return Category::with(['news' => function ($query) {
                $query->with(['author', 'category'])->latest();
            }])->get();
        });

        $articles = cache()->remember('home_latest_articles', 3600, function() {
            return ArticleNews::with(['category'])
                ->where('is_featured', 'not_featured')
                ->latest()
                ->take(3)
                ->get();
        });

        $featured_articles = cache()->remember('home_featured_articles_pool', 3600, function() {
            return ArticleNews::with(['category'])
                ->where('is_featured', 'featured')
                ->latest()
                ->take(15)
                ->get();
        })->shuffle()->take(3);

        $authors = cache()->rememberForever('all_authors', fn() => Author::all());

        $bannerads = BannerAdvertisement::getActiveBanners();

        // Data untuk section dinamis berdasarkan kategori - difilter di memori untuk kecepatan maksimal
        $category_sections = cache()->remember('blog_category_sections', 3600, function() use ($categories) {
            $sections = [];
            foreach ($categories as $category) {
                $sections[$category->slug] = [
                    'featured' => $category->news->where('is_featured', 'featured')->shuffle()->first(),
                    'articles' => $category->news->where('is_featured', 'not_featured')->take(6)->values(),
                ];
            }
            return $sections;
        });

        return view('front.index', compact('categories', 'articles', 'authors', 'featured_articles', 'bannerads', 'category_sections'));
    }

    public function category(Category $category)
    {
        SEOMeta::setTitle("Artikel {$category->name} | Siap Indonesia");
        SEOMeta::setDescription("Kumpulan artikel terbaru tentang {$category->name} dari Siap Indonesia");

        $category->load(['news.category']);
        $categories = cache()->rememberForever('all_categories', fn() => Category::all());
        $bannerads = BannerAdvertisement::getActiveBanners();

        return view('front.category', compact('category', 'categories', 'bannerads'));
    }

    public function author(Author $author)
    {
        SEOMeta::setTitle("Artikel oleh {$author->name} | Siap Indonesia");
        SEOMeta::setDescription("Kumpulan artikel yang ditulis oleh {$author->name}");

        $author->load(['news.category']);
        $categories = cache()->rememberForever('all_categories', fn() => Category::all());
        $bannerads = BannerAdvertisement::getActiveBanners();

        return view('front.author', compact('categories', 'author', 'bannerads'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'keyword' => ['required', 'string', 'max:255'],
        ]);

        $keyword = $request->keyword;

        SEOMeta::setTitle("Hasil pencarian: {$keyword} | Siap Indonesia");
        SEOMeta::setDescription("Hasil pencarian artikel untuk kata kunci {$keyword}");

        $categories = cache()->rememberForever('all_categories', fn() => Category::all());
        $articles = ArticleNews::with(['category', 'author'])
            ->where('name', 'like', '%' . $keyword . '%')
            ->paginate(6);

        return view('front.search', compact('articles', 'keyword', 'categories'));
    }

    public function details(ArticleNews $articleNews)
    {
        // SEO Configuration
        SEOMeta::setTitle($articleNews->name . ' | Siap Indonesia');
        SEOMeta::setDescription(Str::limit(strip_tags($articleNews->content), 160));
        SEOMeta::addMeta('article:published_time', $articleNews->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $articleNews->category->name, 'property');
        SEOMeta::addKeyword([strtolower($articleNews->category->name), 'artikel keprotokolan', 'pelatihan ' . strtolower($articleNews->category->name)]);

        OpenGraph::setTitle($articleNews->name);
        OpenGraph::setDescription(SEOMeta::getDescription());
        OpenGraph::setUrl(url()->current());
        OpenGraph::addImage(asset('storage/' . $articleNews->thumbnail));
        OpenGraph::setType('article');
        OpenGraph::addProperty('locale', 'id_ID');

        TwitterCard::setTitle($articleNews->name);
        TwitterCard::setDescription(SEOMeta::getDescription());
        TwitterCard::setImage(asset('storage/' . $articleNews->thumbnail));

        // Data Preparation
        $categories = cache()->rememberForever('all_categories', fn() => Category::all());
        
        // Memakai latest articles dari cache
        $articles = cache()->remember('home_latest_articles', 3600, function() {
            return ArticleNews::with(['category'])
                ->where('is_featured', 'not_featured')
                ->latest()
                ->take(3)
                ->get();
        });

        $bannerads = BannerAdvertisement::getActiveBanners();

        $square_ads = BannerAdvertisement::getActiveSquares();
        $square_ads_1 = $square_ads->count() > 0 ? $square_ads->get(0) : null;
        $square_ads_2 = $square_ads->count() > 1 ? $square_ads->get(1) : $square_ads_1;

        // Optimasi: Hindari ORDER BY RAND() pada query berita dari penulis yang sama
        $author_news = ArticleNews::with(['category'])
            ->where('author_id', $articleNews->author_id)
            ->where('id', '!=', $articleNews->id)
            ->latest()
            ->take(10)
            ->get()
            ->shuffle();

        return view('front.details', compact('author_news', 'square_ads_1', 'square_ads_2', 'articleNews', 'categories', 'articles', 'bannerads'));
    }


    public function jadwalPelatihan()
    {
        // Fetch training categories with active training schedules, sorted so that the category with the newest training schedule is at the top
        $categories = TrainingCategory::with(['trainingSchedules' => function ($query) {
            $query->where('is_active', true)->orderBy('id', 'desc');
        }])->get()->filter(function ($category) {
            return $category->trainingSchedules->isNotEmpty();
        })->sortByDesc(function ($category) {
            return $category->trainingSchedules->max('id');
        });

        $testimonials = cache()->rememberForever('all_testimonials', fn() => Testimonial::all());
        $partners = cache()->rememberForever('all_partners', fn() => Partner::all());
        $galleries = cache()->rememberForever('all_galleries', fn() => Gallery::all());

        // SEO Configuration
        SEOMeta::setTitle('Jadwal Training & Pelatihan Keprotokolan | Siap Indonesia');
        SEOMeta::setDescription('Temukan jadwal lengkap pelatihan dan bimtek keprotokolan, manajemen SDM, public speaking, dan etiket resmi untuk instansi Anda.');
        SEOMeta::addKeyword(['jadwal pelatihan', 'bimtek keprotokolan', 'training sdm', 'jadwal training siap indonesia']);

        OpenGraph::setTitle('Jadwal Training & Pelatihan - Siap Indonesia');
        OpenGraph::setDescription(SEOMeta::getDescription());
        OpenGraph::setUrl(url()->current());
        OpenGraph::addImage(asset('assets/images/siapindo/carousel-1.jpg'));

        TwitterCard::setTitle(SEOMeta::getTitle());
        TwitterCard::setDescription(SEOMeta::getDescription());

        $setting = cache()->rememberForever('footer_setting', fn() => \App\Models\FooterSetting::first());
        $bannerads = BannerAdvertisement::getActiveBanners();

        return view('front.jadwal_pelatihan', compact('categories', 'testimonials', 'partners', 'galleries', 'setting', 'bannerads'));
    }
}