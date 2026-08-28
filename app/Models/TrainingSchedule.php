<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasOptimizedImages;

class TrainingSchedule extends Model
{
    use HasFactory, HasOptimizedImages;

    protected $optimizedImages = [
        'thumbnail' => 'schedules',
    ];

    protected $fillable = [
        'training_category_id',
        'title',
        'date',
        'time',
        'location',
        'price',
        'registration_link',
        'is_active',
        'thumbnail',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(TrainingCategory::class, 'training_category_id');
    }
}
