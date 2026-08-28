<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasOptimizedImages;

class Partner extends Model
{
    use HasOptimizedImages;

    protected $optimizedImages = [
        'logo_path' => 'partners',
    ];

    /**
     * Kolom yang boleh diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'name',         // Nama partner
        'logo_path',    // Path untuk logo partner
        'alt_text',     // Teks alternatif untuk gambar
        'row_position', // Posisi baris slide (1 atau 2)
    ];

    /**
     * Booted method for cache busting.
     */
    protected static function booted()
    {
        static::saved(function ($model) {
            cache()->forget('all_partners');
        });
        static::deleted(function ($model) {
            cache()->forget('all_partners');
        });
    }
}