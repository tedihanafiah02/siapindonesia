<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Drop old foreign key constraint if category_id exists
        if (Schema::hasColumn('training_schedules', 'category_id')) {
            try {
                Schema::table('training_schedules', function (Blueprint $table) {
                    $table->dropForeign(['category_id']);
                });
            } catch (\Exception $e) {
                // Already dropped
            }
        }

        // 2. Insert existing categories into training_categories
        $existingCategories = DB::table('categories')->get();
        foreach ($existingCategories as $cat) {
            if (!DB::table('training_categories')->where('id', $cat->id)->exists()) {
                DB::table('training_categories')->insert([
                    'id' => $cat->id,
                    'name' => $cat->name,
                    'slug' => $cat->slug,
                    'sort_order' => $cat->sort_order ?? 0,
                    'created_at' => $cat->created_at,
                    'updated_at' => $cat->updated_at,
                ]);
            }
        }

        // 3. Add training_category_id column as nullable first if it doesn't exist
        if (!Schema::hasColumn('training_schedules', 'training_category_id')) {
            Schema::table('training_schedules', function (Blueprint $table) {
                $table->unsignedBigInteger('training_category_id')->nullable()->after('id');
            });
            // 4. Copy old category_id values to training_category_id
            DB::statement('UPDATE training_schedules SET training_category_id = category_id');
        }

        // 5. Add constraint, drop category_id column if it exists
        Schema::table('training_schedules', function (Blueprint $table) {
            try {
                $table->foreign('training_category_id')->references('id')->on('training_categories')->cascadeOnDelete();
            } catch (\Exception $e) {
                // Already added
            }

            if (Schema::hasColumn('training_schedules', 'category_id')) {
                $table->dropColumn('category_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('training_schedules', 'training_category_id')) {
            try {
                Schema::table('training_schedules', function (Blueprint $table) {
                    $table->dropForeign(['training_category_id']);
                });
            } catch (\Exception $e) {
                // Already dropped
            }
        }

        if (!Schema::hasColumn('training_schedules', 'category_id')) {
            Schema::table('training_schedules', function (Blueprint $table) {
                $table->unsignedBigInteger('category_id')->nullable()->after('id');
            });
            DB::statement('UPDATE training_schedules SET category_id = training_category_id');
        }

        Schema::table('training_schedules', function (Blueprint $table) {
            try {
                $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            } catch (\Exception $e) {
                // Already added
            }

            if (Schema::hasColumn('training_schedules', 'training_category_id')) {
                $table->dropColumn('training_category_id');
            }
        });
    }
};
