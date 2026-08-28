<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Services\ImageOptimizerService;

class CompressImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:compress {--width=1200 : Maximum width of images} {--quality=75 : Compression quality (1-100)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compress all static assets and dynamic uploads, converting dynamic ones to WebP and updating DB records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $maxWidth = (int) $this->option('width');
        $quality = (int) $this->option('quality');

        $this->info("Starting comprehensive image compression...");
        $this->line("Target Max Width: {$maxWidth}px");
        $this->line("Target Quality: {$quality}%");
        $this->line("----------------------------------------");

        $totalSavedBytes = 0;

        // Part 1: Process Dynamic Storage Images (storage/app/public)
        $totalSavedBytes += $this->processDynamicStorage($maxWidth, $quality);

        $this->line("----------------------------------------");

        // Part 2: Process Static Public Assets (public/assets/images)
        $totalSavedBytes += $this->processStaticAssets($maxWidth, $quality);

        $this->line("----------------------------------------");
        $savedMb = round($totalSavedBytes / (1024 * 1024), 2);
        $this->info("Compression process completed! Total space saved: {$savedMb} MB.");

        return Command::SUCCESS;
    }

    /**
     * Process dynamic storage images and update DB references
     */
    protected function processDynamicStorage(int $maxWidth, int $quality): int
    {
        $storagePath = storage_path('app/public');
        if (!File::exists($storagePath)) {
            $this->warn("Dynamic storage path does not exist: {$storagePath}");
            return 0;
        }

        $this->info("Scanning dynamic storage (storage/app/public)...");

        $allFiles = File::allFiles($storagePath);
        $targetFiles = [];
        $extensions = ['jpg', 'jpeg', 'png', 'webp', 'bmp', 'gif'];

        foreach ($allFiles as $file) {
            $ext = strtolower($file->getExtension());
            if (in_array($ext, $extensions)) {
                $targetFiles[] = $file;
            }
        }

        $totalFiles = count($targetFiles);
        if ($totalFiles === 0) {
            $this->info("No dynamic images found in storage.");
            return 0;
        }

        $this->info("Found {$totalFiles} dynamic images. Compressing & converting to WebP...");

        $dbColumns = [
            ['table' => 'banner_advertisements', 'column' => 'thumbnail'],
            ['table' => 'article_news', 'column' => 'thumbnail'],
            ['table' => 'galleries', 'column' => 'image_path'],
            ['table' => 'partners', 'column' => 'logo_path'],
            ['table' => 'testimonials', 'column' => 'photo'],
            ['table' => 'authors', 'column' => 'avatar'],
            ['table' => 'users', 'column' => 'avatar_url'],
        ];

        $savedBytes = 0;
        $bar = $this->output->createProgressBar($totalFiles);
        $bar->start();

        foreach ($targetFiles as $file) {
            $filePath = $file->getRealPath();
            $oldSize = filesize($filePath);
            
            // Normalize paths
            $normalizedStoragePath = str_replace('\\', '/', $storagePath);
            $normalizedFilePath = str_replace('\\', '/', $filePath);
            
            // Calculate relative path for database searching
            $relativePath = str_replace($normalizedStoragePath . '/', '', $normalizedFilePath);

            // Calculate relative folder for destination
            $relativeDir = str_replace($normalizedStoragePath, '', str_replace('\\', '/', $file->getPath()));
            $relativeDir = trim($relativeDir, '/');

            try {
                // Compress and convert to WebP
                $newRelativePath = ImageOptimizerService::optimize($filePath, $relativeDir, $maxWidth, $quality);

                // Check new size
                $newAbsolutePath = storage_path('app/public/' . $newRelativePath);
                $newSize = file_exists($newAbsolutePath) ? filesize($newAbsolutePath) : 0;
                $savedBytes += max(0, $oldSize - $newSize);

                // Update database references
                foreach ($dbColumns as $db) {
                    if (Schema::hasTable($db['table']) && Schema::hasColumn($db['table'], $db['column'])) {
                        DB::table($db['table'])
                            ->where($db['column'], $relativePath)
                            ->update([$db['column'] => $newRelativePath]);
                    }
                }
            } catch (\Exception $e) {
                // Skip if error, log to warning
                $this->newLine();
                $this->warn("Failed to optimize dynamic image: {$relativePath} - " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Dynamic storage compression completed.");
        return $savedBytes;
    }

    /**
     * Process static assets in-place
     */
    protected function processStaticAssets(int $maxWidth, int $quality): int
    {
        $assetsPath = public_path('assets/images');
        if (!File::exists($assetsPath)) {
            $this->warn("Static assets path does not exist: {$assetsPath}");
            return 0;
        }

        $this->info("Scanning static assets (public/assets/images)...");

        $allFiles = File::allFiles($assetsPath);
        $targetFiles = [];
        $extensions = ['jpg', 'jpeg', 'png', 'webp', 'bmp', 'gif'];

        foreach ($allFiles as $file) {
            $ext = strtolower($file->getExtension());
            if (in_array($ext, $extensions)) {
                $targetFiles[] = $file;
            }
        }

        $totalFiles = count($targetFiles);
        if ($totalFiles === 0) {
            $this->info("No static images found in public assets.");
            return 0;
        }

        $this->info("Found {$totalFiles} static images. Compressing in-place...");

        $savedBytes = 0;
        $bar = $this->output->createProgressBar($totalFiles);
        $bar->start();

        foreach ($targetFiles as $file) {
            $filePath = $file->getRealPath();
            $oldSize = filesize($filePath);
            $relativePath = str_replace(public_path() . DIRECTORY_SEPARATOR, '', $filePath);

            try {
                if ($this->compressInPlace($filePath, $maxWidth, $quality)) {
                    clearstatcache(true, $filePath);
                    $newSize = filesize($filePath);
                    $savedBytes += max(0, $oldSize - $newSize);
                }
            } catch (\Exception $e) {
                $this->newLine();
                $this->warn("Failed to optimize static image in-place: {$relativePath} - " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Static assets compression completed.");
        return $savedBytes;
    }

    /**
     * Compress an image in-place without changing extension/filename
     */
    protected function compressInPlace(string $filePath, int $maxWidth, int $quality): bool
    {
        $imageInfo = @getimagesize($filePath);
        if (!$imageInfo) {
            return false;
        }

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
            default:
                return false;
        }

        if (!$srcImage) {
            return false;
        }

        // Calculate new dimensions (never upscale)
        $newWidth = $srcWidth;
        $newHeight = $srcHeight;

        if ($srcWidth > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = (int) round(($srcHeight / $srcWidth) * $newWidth);
        }

        // Create canvas & preserve transparency
        $destImage = imagecreatetruecolor($newWidth, $newHeight);
        
        if ($mime === 'image/png' || $mime === 'image/webp' || $mime === 'image/gif') {
            imagealphablending($destImage, false);
            imagesavealpha($destImage, true);
            $transparent = imagecolorallocatealpha($destImage, 255, 255, 255, 127);
            imagefilledrectangle($destImage, 0, 0, $newWidth, $newHeight, $transparent);
        }

        // Resize image
        imagecopyresampled($destImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $srcWidth, $srcHeight);

        // Save back to same path
        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg':
                $success = imagejpeg($destImage, $filePath, $quality);
                break;
            case 'image/png':
                // PNG quality in GD is 0-9
                $pngQuality = (int) round((100 - $quality) / 10);
                $pngQuality = max(0, min(9, $pngQuality));
                $success = imagepng($destImage, $filePath, $pngQuality);
                break;
            case 'image/webp':
                $success = imagewebp($destImage, $filePath, $quality);
                break;
            case 'image/gif':
                $success = imagegif($destImage, $filePath);
                break;
            default:
                $success = false;
        }

        imagedestroy($srcImage);
        imagedestroy($destImage);

        return $success;
    }
}
