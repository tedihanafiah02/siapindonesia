<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PartnerController;

Route::controller(FrontController::class)->group(function () {
    Route::get('/sitemap.xml', [FrontController::class, 'sitemap']);
    Route::get('/', 'beranda')->name('front.beranda');
    Route::get('/tentang-kami', 'tentangKami')->name('front.tentangKami');
    Route::get('/profil', 'profil')->name('front.profil');
    Route::get('/visimisi', 'visimisi')->name('front.visimisi');
    Route::get('/gallery', [PartnerController::class, 'index'])->name('front.gallery');
    Route::get('/our-client', 'partner')->name('front.partner');
    Route::get('/program/{slug}', 'program')->name('front.program');
    Route::get('/blog', 'index')->name('front.index');
    Route::get('/jadwal-pelatihan', 'jadwalPelatihan')->name('front.jadwalPelatihan');
    Route::get('/details/{article_news:slug}', 'details')->name('front.details');
    Route::get('/category/{category:slug}', 'category')->name('front.category');
    Route::get('/author/{author:slug}', 'author')->name('front.author');
    Route::get('/search', 'search')->name('front.search')->middleware('throttle:30,1');
});

// Fallback route for storage files if symlink is broken or unsupported on hosting
Route::get('/storage/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);
    if (!file_exists($fullPath)) {
        abort(404);
    }
    return response()->file($fullPath, [
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->where('path', '.*');

Route::get('/storage-link', function () {
    try {
        $target = storage_path('app/public');
        
        // List of possible public directories on shared hosting
        $publicFolders = ['public', 'public_html', 'httpdocs'];
        $results = [];
        
        foreach ($publicFolders as $folder) {
            $folderPath = base_path($folder);
            if (is_dir($folderPath)) {
                $shortcut = $folderPath . '/storage';
                
                // If it already exists, let's remove it first to recreate / overwrite
                if (file_exists($shortcut) || is_link($shortcut)) {
                    if (strncasecmp(PHP_OS, 'WIN', 3) === 0) {
                        if (is_dir($shortcut) && !is_link($shortcut)) {
                            // On Windows, directories can sometimes be removed with rmdir
                            @rmdir($shortcut);
                        } else {
                            @unlink($shortcut);
                        }
                    } else {
                        @unlink($shortcut);
                    }
                }
                
                // Create symlink
                if (@symlink($target, $shortcut)) {
                    $results[] = "Successfully linked storage in '{$folder}/storage'!";
                } else {
                    $results[] = "Failed to link storage in '{$folder}/storage'.";
                }
            }
        }
        
        if (empty($results)) {
            \Illuminate\Support\Facades\Artisan::call('storage:link');
            return 'Storage link created using default Artisan command.';
        }
        
        return implode('<br>', $results);
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});