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
    Schema::create('courses_enrollments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
        $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
        $table->string('instructor_id', 14);
        $table->foreign('instructor_id')->references('national_id')->on('instructors')->onDelete('cascade');
        $table->timestamp('enrolled_at')->useCurrent();
        $table->unique(['course_id', 'student_id']);
    });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_enrollments');
    }
};
