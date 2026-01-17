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
        Schema::table('admins', function (Blueprint $table) {
            if (!Schema::hasColumn('admins', 'img_admin')) {
                $table->text('img_admin')->after('phone')->nullable();
            }

            // Clean up any wrongly named column if it exists
            if (Schema::hasColumn('admins', 'img-name')) {
                try {
                    $table->dropColumn('img-name');
                } catch (\Throwable $e) {
                    // ignore if cannot drop due to platform limitations
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            if (Schema::hasColumn('admins', 'img_admin')) {
                $table->dropColumn('img_admin');
            }
        });
    }
};


