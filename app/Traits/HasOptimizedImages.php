<?php

namespace App\Traits;

use App\Services\ImageOptimizerService;
use Illuminate\Support\Facades\File;

trait HasOptimizedImages
{
    public static function bootHasOptimizedImages()
    {
        static::saving(function ($model) {
            $imageFields = $model->getOptimizedImagesConfig();
            
            foreach ($imageFields as $field => $folder) {
                if ($model->isDirty($field) && $model->$field) {
                    $originalPath = $model->$field;
                    $absolutePath = storage_path('app/public/' . $originalPath);
                    
                    if (File::exists($absolutePath)) {
                        try {
                            $newPath = ImageOptimizerService::optimize($absolutePath, $folder);
                            $model->$field = $newPath;
                        } catch (\Exception $e) {
                            logger()->error("Image optimization failed for model " . get_class($model) . " field {$field}: " . $e->getMessage());
                        }
                    }
                }
            }
        });
    }

    public function getOptimizedImagesConfig(): array
    {
        return $this->optimizedImages ?? [];
    }
}
