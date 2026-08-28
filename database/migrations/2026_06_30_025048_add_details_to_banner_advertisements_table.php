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
        Schema::table('banner_advertisements', function (Blueprint $table) {
            $table->integer('display_order')->default(0)->after('type');
            $table->integer('duration')->default(10)->after('display_order'); // Default duration 10 seconds
            $table->dateTime('start_date')->nullable()->after('duration');
            $table->dateTime('end_date')->nullable()->after('start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banner_advertisements', function (Blueprint $table) {
            $table->dropColumn(['display_order', 'duration', 'start_date', 'end_date']);
        });
    }
};
