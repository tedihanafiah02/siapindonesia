<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_slogan')->nullable();
            $table->string('company_profile_link')->nullable();
            
            // Social Media links
            $table->string('instagram_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('whatsapp_url')->nullable();
            $table->string('email_address')->nullable();
            
            // Description Column
            $table->string('description_title')->nullable();
            $table->text('description_1')->nullable();
            $table->text('description_2')->nullable();
            
            // Quick Links
            $table->json('quick_links')->nullable();
            
            // Office Contact Info
            $table->text('office_address')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('office_mobile')->nullable();
            $table->string('office_email')->nullable();
            
            // Copyright
            $table->string('copyright_text')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
