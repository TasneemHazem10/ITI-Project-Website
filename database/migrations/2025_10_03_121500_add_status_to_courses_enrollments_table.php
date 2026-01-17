<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses_enrollments', function (Blueprint $table) {
            if (!Schema::hasColumn('courses_enrollments', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('enrolled_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('courses_enrollments', function (Blueprint $table) {
            if (Schema::hasColumn('courses_enrollments', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};


