<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasOptimizedImages;

class BannerAdvertisement extends Model
{
    use HasFactory, SoftDeletes, HasOptimizedImages;

    protected $optimizedImages = [
        'thumbnail' => 'banners',
    ];

    protected $fillable = [
        'link',
        'is_active',
        'type',
        'thumbnail',
        'display_order',
        'duration',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function scopeActiveAndScheduled($query)
    {
        $now = now();
        return $query->where('is_active', 'active')
            ->where(function($q) use ($now) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', $now);
            })
            ->where(function($q) use ($now) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', $now);
            });
    }

    public static function getActiveBanners()
    {
        return cache()->remember('active_banners_list', 60, function() {
            return self::activeAndScheduled()->where('type', 'banner')->orderBy('display_order', 'asc')->get();
        });
    }

    public static function getActiveSquares()
    {
        return cache()->remember('active_squares_list', 60, function() {
            return self::activeAndScheduled()->where('type', 'square')->orderBy('display_order', 'asc')->get();
        });
    }
}
