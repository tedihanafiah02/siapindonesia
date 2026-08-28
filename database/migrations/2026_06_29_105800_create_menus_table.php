<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('menus')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('order_priority')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('has_page')->default(false);
            $table->string('url')->nullable();
            
            // Content fields for details page
            $table->string('icon')->default('fa-graduation-cap')->nullable();
            $table->string('banner_path')->nullable();
            $table->string('title')->nullable();
            $table->string('slogan')->nullable();
            $table->text('description')->nullable();
            $table->text('background')->nullable();
            $table->text('objectives')->nullable();
            $table->text('syllabus')->nullable();
            $table->text('benefits')->nullable();
            $table->text('facilities')->nullable();
            $table->json('gallery')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('cta_url')->nullable();
            
            // SEO fields
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
