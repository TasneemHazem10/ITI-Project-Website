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
        Schema::dropIfExists('instructors');
        
        Schema::create('instructors', function (Blueprint $table) {
            $table->string('national_id', 14)->primary();
            $table->string('email')->unique();
            $table->string('fname');
            $table->string('lname');
            $table->string('phone');
            $table->string('job_tittle');
            $table->string('img_name')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
