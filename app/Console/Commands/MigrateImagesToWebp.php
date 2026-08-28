<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Services\ImageOptimizerService;

class MigrateImagesToWebp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:migrate-webp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan public storage, convert JPG/JPEG/PNG files to WebP (max-width 1200px, quality 80%), delete old files, and update DB references';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $storagePath = storage_path('app/public');

        if (!File::exists($storagePath)) {
            $this->error("Storage path does not exist: {$storagePath}");
            return Command::FAILURE;
        }

        $this->info("Scanning public storage for JPG, JPEG, and PNG files...");

        // 1. Gather all files recursive
        $allFiles = File::allFiles($storagePath);
        $targetFiles = [];

        foreach ($allFiles as $file) {
            $ext = strtolower($file->getExtension());
            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $targetFiles[] = $file;
            }
        }

        $totalFiles = count($targetFiles);

        if ($totalFiles === 0) {
            $this->info("No JPG, JPEG, or PNG files found in storage.");
            return Command::SUCCESS;
        }

        $this->info("Found {$totalFiles} files to migrate.");

        // Define database tables and columns containing image paths
        $dbColumns = [
            ['table' => 'banner_advertisements', 'column' => 'thumbnail'],
            ['table' => 'article_news', 'column' => 'thumbnail'],
            ['table' => 'galleries', 'column' => 'image_path'],
            ['table' => 'partners', 'column' => 'logo_path'],
            ['table' => 'testimonials', 'column' => 'photo'],
            ['table' => 'authors', 'column' => 'avatar'],
            ['table' => 'users', 'column' => 'avatar_url'],
        ];

        $bar = $this->output->createProgressBar($totalFiles);
        $bar->start();

        $processedCount = 0;
        $dbUpdatedCount = 0;
        $failedFiles = [];

        foreach ($targetFiles as $file) {
            $filePath = $file->getRealPath();
            
            // Normalize both paths to use forward slashes
            $normalizedStoragePath = str_replace('\\', '/', $storagePath);
            $normalizedFilePath = str_replace('\\', '/', $filePath);
            
            // Calculate relative path for database searching
            $relativePath = str_replace($normalizedStoragePath . '/', '', $normalizedFilePath);

            // Calculate relative folder for destination
            $relativeDir = str_replace($normalizedStoragePath, '', str_replace('\\', '/', $file->getPath()));
            $relativeDir = trim($relativeDir, '/');

            try {
                // Optimize and convert to WebP (deletes original image inside)
                $newRelativePath = ImageOptimizerService::optimize($filePath, $relativeDir);

                // Update database references
                $affectedRecords = 0;
                foreach ($dbColumns as $db) {
                    if (Schema::hasTable($db['table']) && Schema::hasColumn($db['table'], $db['column'])) {
                        $affected = DB::table($db['table'])
                            ->where($db['column'], $relativePath)
                            ->update([$db['column'] => $newRelativePath]);
                        $affectedRecords += $affected;
                    }
                }

                $dbUpdatedCount += $affectedRecords;
                $processedCount++;
            } catch (\Exception $e) {
                $failedFiles[] = [
                    'file' => $relativePath,
                    'error' => $e->getMessage()
                ];
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $this->info("Migration completed successfully!");
        $this->line("----------------------------------------");
        $this->info("Files converted to WebP: {$processedCount} / {$totalFiles}");
        $this->info("Database records updated: {$dbUpdatedCount}");

        if (count($failedFiles) > 0) {
            $this->newLine();
            $this->warn("Failed to process the following " . count($failedFiles) . " file(s):");
            foreach ($failedFiles as $fail) {
                $this->line("- {$fail['file']}: {$fail['error']}");
            }
        }

        return Command::SUCCESS;
    }
}
