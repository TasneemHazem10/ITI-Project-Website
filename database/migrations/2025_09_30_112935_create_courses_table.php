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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->string('duration'); 
            $table->text('course_description'); 
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->string('skills'); 
            $table->integer('max_students')->check('max_students >= 1 AND max_students <= 50');
            $table->date('start_date');
            $table->string('location'); 
            $table->boolean('certificate')->default(false); 
            $table->boolean('featured')->default(false); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
