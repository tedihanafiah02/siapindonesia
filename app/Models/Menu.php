<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'order_priority',
        'is_active',
        'has_page',
        'url',
        'icon',
        'banner_path',
        'title',
        'slogan',
        'description',
        'background',
        'objectives',
        'syllabus',
        'benefits',
        'facilities',
        'facilities_online',
        'facilities_offline',
        'gallery',
        'cta_text',
        'cta_url',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'has_page' => 'boolean',
        'gallery' => 'array',
    ];

    /**
     * Get parent menu
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Get child menus
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order_priority', 'asc');
    }

    /**
     * Recursive relation to load all levels of children
     */
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    /**
     * Booted method for cache busting.
     */
    protected static function booted()
    {
        static::saved(function ($model) {
            cache()->forget('navigation_menus');
        });
        static::deleted(function ($model) {
            cache()->forget('navigation_menus');
        });
    }
}
