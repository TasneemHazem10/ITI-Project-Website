<?php

namespace Database\Seeders;

use App\Models\Admin\Course;
use App\Models\Admin\Module;
use App\Models\Admin\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Web Development Course
        $webCourse = Course::create([
            'course_name' => 'Full Stack Web Development',
            'duration' => '4 months',
            'course_description' => 'Comprehensive web development course covering HTML, CSS, JavaScript, PHP, and Laravel framework. Perfect for beginners who want to become professional web developers.',
            'skills' => 'HTML, CSS, JavaScript, PHP, Laravel, MySQL, Bootstrap',
            'max_students' => 25,
            'start_date' => '2025-01-15',
            'location' => 'Smart Village, Cairo',
            'certificate' => true,
            'featured' => true,
            'price' => 15000.00,
            'status' => 'published'
        ]);

        // Create modules for web course
        $module1 = Module::create([
            'module_name' => 'Frontend Fundamentals',
            'module_num_week' => 4,
            'module_index' => 1,
            'course_id' => $webCourse->id,
            'description' => 'Learn HTML, CSS, and JavaScript basics',
            'is_active' => true
        ]);

        $module2 = Module::create([
            'module_name' => 'Backend Development',
            'module_num_week' => 6,
            'module_index' => 2,
            'course_id' => $webCourse->id,
            'description' => 'PHP and Laravel development',
            'is_active' => true
        ]);

        // Create lessons for module 1
        Lesson::create([
            'ordered_day' => 1,
            'order_index' => 1,
            'module_id' => $module1->id,
            'lesson_title' => 'Introduction to HTML',
            'lesson_content' => 'Learn HTML structure and basic tags',
            'duration_minutes' => 90,
            'is_free' => true
        ]);

        Lesson::create([
            'ordered_day' => 2,
            'order_index' => 2,
            'module_id' => $module1->id,
            'lesson_title' => 'CSS Styling',
            'lesson_content' => 'Style your HTML with CSS',
            'duration_minutes' => 120,
            'is_free' => false
        ]);

        // Create AI Course
        $aiCourse = Course::create([
            'course_name' => 'Artificial Intelligence & Machine Learning',
            'duration' => '6 months',
            'course_description' => 'Advanced AI course covering machine learning, deep learning, and neural networks. Hands-on projects with Python and TensorFlow.',
            'skills' => 'Python, Machine Learning, Deep Learning, TensorFlow, Data Science',
            'max_students' => 20,
            'start_date' => '2025-02-01',
            'location' => 'New Capital, Cairo',
            'certificate' => true,
            'featured' => true,
            'price' => 25000.00,
            'status' => 'published'
        ]);

        // Create Mobile Development Course
        Course::create([
            'course_name' => 'Mobile App Development',
            'duration' => '3 months',
            'course_description' => 'Learn to build mobile applications for Android and iOS using Flutter framework.',
            'skills' => 'Flutter, Dart, Mobile UI/UX, API Integration',
            'max_students' => 30,
            'start_date' => '2025-03-01',
            'location' => 'Maadi, Cairo',
            'certificate' => true,
            'featured' => false,
            'price' => 12000.00,
            'status' => 'draft'
        ]);
    }
}
