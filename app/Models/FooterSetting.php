<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    /**
     * Kolom yang boleh diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'company_slogan',
        'company_profile_link',
        
        // Social Media
        'instagram_url',
        'tiktok_url',
        'whatsapp_url',
        'email_address',
        
        // Description
        'description_title',
        'description_1',
        'description_2',
        
        // Quick Links
        'quick_links',
        
        // Contact
        'office_address',
        'office_phone',
        'office_mobile',
        'office_email',
        
        // Copyright
        'copyright_text',
    ];

    /**
     * Cast attributes to native types.
     *
     * @var array
     */
    protected $casts = [
        'quick_links' => 'array',
    ];

    /**
     * Booted method for cache busting.
     */
    protected static function booted()
    {
        static::saved(function ($model) {
            cache()->forget('footer_setting');
        });
        static::deleted(function ($model) {
            cache()->forget('footer_setting');
        });
    }
}
