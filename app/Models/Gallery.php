<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasOptimizedImages;

class Gallery extends Model
{
    use HasOptimizedImages;

    protected $optimizedImages = [
        'image_path' => 'gallery-images',
    ];

    // Tambahkan kolom yang boleh diisi secara massal
    protected $fillable = [
        'image_path', // Tambahkan ini
        'alt_text',  // Tambahkan ini jika kolom ini juga ada
    ];

    /**
     * Booted method for cache busting.
     */
    protected static function booted()
    {
        static::saved(function ($model) {
            cache()->forget('all_galleries');
        });
        static::deleted(function ($model) {
            cache()->forget('all_galleries');
        });
    }
}