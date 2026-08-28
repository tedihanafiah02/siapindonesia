<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasOptimizedImages;

class Testimonial extends Model
{
    use HasFactory, HasOptimizedImages;

    protected $optimizedImages = [
        'photo' => 'testimonials',
    ];

    protected $fillable = [
        'name',
        'position',
        'message',
        'photo',
        'row',
        'video_url',
    ];

    /**
     * Booted method for cache busting.
     */
    protected static function booted()
    {
        static::saved(function ($model) {
            cache()->forget('all_testimonials');
        });
        static::deleted(function ($model) {
            cache()->forget('all_testimonials');
        });
    }
}
