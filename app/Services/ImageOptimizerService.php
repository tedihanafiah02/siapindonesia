<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageOptimizerService
{
    /**
     * Optimize and convert an uploaded image to WebP format.
     *
     * @param string|UploadedFile|TemporaryUploadedFile $file
     * @param string $folder Destination folder inside public storage (e.g. 'banners')
     * @param int $maxWidth Max width allowed (default 1200)
     * @param int $quality Compression quality (default 80)
     * @return string Relative path of the optimized image (e.g. 'banners/uuid.webp')
     */
    public static function optimize($file, string $folder = 'uploads', int $maxWidth = 1200, int $quality = 80): string
    {
        $filePath = is_string($file) ? $file : $file->getRealPath();

        if (!file_exists($filePath)) {
            throw new \Exception("File does not exist: " . $filePath);
        }

        // 1. Ensure destination path exists
        $destDir = storage_path('app/public' . ($folder ? '/' . $folder : ''));
        if (!File::exists($destDir)) {
            File::makeDirectory($destDir, 0755, true);
        }

        // 2. Load image using GD based on type
        $imageInfo = @getimagesize($filePath);
        if (!$imageInfo) {
            // Handle SVGs and other files by copying them as-is
            $mime = @mime_content_type($filePath);
            $ext = pathinfo($filePath, PATHINFO_EXTENSION);
            if (!$ext && is_object($file) && method_exists($file, 'getClientOriginalExtension')) {
                $ext = $file->getClientOriginalExtension();
            }
            $ext = $ext ? strtolower($ext) : 'bin';
            
            $uuidName = Str::uuid()->toString() . '.' . $ext;
            $destPath = $destDir . '/' . $uuidName;
            
            File::copy($filePath, $destPath);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
            
            return ($folder ? $folder . '/' : '') . $uuidName;
        }

        $uuidName = Str::uuid()->toString() . '.webp';
        $destPath = $destDir . '/' . $uuidName;

        $mime = $imageInfo['mime'];
        $srcWidth = $imageInfo[0];
        $srcHeight = $imageInfo[1];

        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg':
                $srcImage = @imagecreatefromjpeg($filePath);
                break;
            case 'image/png':
                $srcImage = @imagecreatefrompng($filePath);
                break;
            case 'image/webp':
                $srcImage = @imagecreatefromwebp($filePath);
                break;
            case 'image/gif':
                $srcImage = @imagecreatefromgif($filePath);
                break;
            case 'image/bmp':
                $srcImage = @imagecreatefrombmp($filePath);
                break;
            default:
                // Fallback for any other formats: copy as-is
                $ext = pathinfo($filePath, PATHINFO_EXTENSION);
                if (!$ext && is_object($file) && method_exists($file, 'getClientOriginalExtension')) {
                    $ext = $file->getClientOriginalExtension();
                }
                $ext = $ext ? strtolower($ext) : 'bin';
                $uuidName = Str::uuid()->toString() . '.' . $ext;
                $destPath = $destDir . '/' . $uuidName;
                
                File::copy($filePath, $destPath);
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
                return ($folder ? $folder . '/' : '') . $uuidName;
        }

        if (!$srcImage) {
            throw new \Exception("Could not load image resource for mime type: " . $mime);
        }

        // 4. Calculate new dimensions (never upscale)
        $newWidth = $srcWidth;
        $newHeight = $srcHeight;

        if ($srcWidth > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = (int) round(($srcHeight / $srcWidth) * $newWidth);
        }

        // 5. Create new truecolor image & preserve transparency
        $destImage = imagecreatetruecolor($newWidth, $newHeight);
        
        // Handle transparency for PNG/WebP/GIF
        if ($mime === 'image/png' || $mime === 'image/webp' || $mime === 'image/gif') {
            imagealphablending($destImage, false);
            imagesavealpha($destImage, true);
            $transparent = imagecolorallocatealpha($destImage, 255, 255, 255, 127);
            imagefilledrectangle($destImage, 0, 0, $newWidth, $newHeight, $transparent);
        }

        // 6. Resize image
        imagecopyresampled($destImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $srcWidth, $srcHeight);

        // 7. Convert and save to WebP
        $success = imagewebp($destImage, $destPath, $quality);

        // 8. Clean up memory
        imagedestroy($srcImage);
        imagedestroy($destImage);

        if (!$success) {
            throw new \Exception("Failed to save WebP image to " . $destPath);
        }

        // 9. Delete original file
        if (file_exists($filePath) && realpath($filePath) !== realpath($destPath)) {
            @unlink($filePath);
        }

        // Return relative path
        return ($folder ? $folder . '/' : '') . $uuidName;
    }
}
