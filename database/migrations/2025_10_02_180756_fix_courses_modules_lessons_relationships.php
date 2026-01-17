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
        // First, drop the problematic foreign key from courses table
        if (Schema::hasTable('courses')) {
            Schema::table('courses', function (Blueprint $table) {
                if (Schema::hasColumn('courses', 'module_id')) {
                    try {
                        $table->dropForeign(['module_id']);
                        $table->dropColumn('module_id');
                    } catch (\Throwable $e) {
                        // ignore if doesn't exist
                    }
                }
            });
        }

        // Drop the problematic column from modules table
        if (Schema::hasTable('modules')) {
            Schema::table('modules', function (Blueprint $table) {
                if (Schema::hasColumn('modules', 'id-course')) {
                    try {
                        $table->dropForeign(['id-course']);
                        $table->dropColumn('id-course');
                    } catch (\Throwable $e) {
                        // ignore if doesn't exist
                    }
                }
            });
        }

        // Add proper course_id to modules table
        if (Schema::hasTable('modules')) {
            Schema::table('modules', function (Blueprint $table) {
                if (!Schema::hasColumn('modules', 'course_id')) {
                    $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('cascade');
                }
            });
        }

        // Add missing columns to courses table
        if (Schema::hasTable('courses')) {
            Schema::table('courses', function (Blueprint $table) {
                if (!Schema::hasColumn('courses', 'price')) {
                    $table->decimal('price', 8, 2)->default(0);
                }
                if (!Schema::hasColumn('courses', 'image')) {
                    $table->string('image')->nullable();
                }
                if (!Schema::hasColumn('courses', 'status')) {
                    $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
                }
            });
        }

        // Add missing columns to lessons table
        if (Schema::hasTable('lessons')) {
            Schema::table('lessons', function (Blueprint $table) {
                if (!Schema::hasColumn('lessons', 'lesson_title')) {
                    $table->string('lesson_title');
                }
                if (!Schema::hasColumn('lessons', 'lesson_content')) {
                    $table->text('lesson_content')->nullable();
                }
                if (!Schema::hasColumn('lessons', 'duration_minutes')) {
                    $table->integer('duration_minutes')->default(60);
                }
                if (!Schema::hasColumn('lessons', 'video_url')) {
                    $table->string('video_url')->nullable();
                }
                if (!Schema::hasColumn('lessons', 'is_free')) {
                    $table->boolean('is_free')->default(false);
                }
            });
        }

        // Add missing columns to modules table
        if (Schema::hasTable('modules')) {
            Schema::table('modules', function (Blueprint $table) {
                if (!Schema::hasColumn('modules', 'description')) {
                    $table->text('description')->nullable();
                }
                if (!Schema::hasColumn('modules', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the changes
        if (Schema::hasTable('courses')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->dropColumn(['price', 'image', 'status']);
            });
        }

        if (Schema::hasTable('lessons')) {
            Schema::table('lessons', function (Blueprint $table) {
                $table->dropColumn(['lesson_title', 'lesson_content', 'duration_minutes', 'video_url', 'is_free']);
            });
        }

        if (Schema::hasTable('modules')) {
            Schema::table('modules', function (Blueprint $table) {
                $table->dropForeign(['course_id']);
                $table->dropColumn(['course_id', 'description', 'is_active']);
            });
        }
    }
};