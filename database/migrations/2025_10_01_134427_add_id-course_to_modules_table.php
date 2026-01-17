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
        Schema::table('modules', function (Blueprint $table) {
            if (!Schema::hasColumn('modules', 'id-course')) {
                $table->foreignId('id-course')->constrained('courses')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            if (Schema::hasColumn('modules', 'id-course')) {
                // drop foreign key then column
                try {
                    $table->dropForeign(['id-course']);
                } catch (\Throwable $e) {
                    // ignore if foreign not exists
                }
                $table->dropColumn('id-course');
            }
        });
    }
};
