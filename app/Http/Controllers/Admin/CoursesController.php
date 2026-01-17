<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Course;
use App\Models\Admin\Module;
use App\Models\Admin\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{
    public function add_course() 
    {
        $instructors = Instructor::all();
        return view('admin.courses_pages.add_course', compact('instructors'));
    }

    public function store_course(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'duration' => 'required|string',
            'course_description' => 'required|string',
            'skills' => 'required|string',
            'max_students' => 'required|integer|min:1|max:50',
            'start_date' => 'required|date',
            'location' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $imagePath = $request->image->storeAs('images/courses', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        // Handle boolean fields properly
        $data['certificate'] = $request->input('certificate', 0);
        $data['featured'] = $request->input('featured', 0);
        $data['status'] = 'published';

        Course::create($data);

        return redirect()->back()->with('msg', 'Course created successfully');
    }

    public function edit_course() 
    {
        $courses = Course::all();
        $instructors = Instructor::all();
        return view('admin.courses_pages.edit_course', compact('courses', 'instructors'));
    }

    public function get_course($id)
    {
        $course = Course::with('modules.lessons')->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $course
        ]);
    }

    public function update_course(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        
        $request->validate([
            'course_name' => 'required|string|max:255',
            'duration' => 'required|string',
            'course_description' => 'required|string',
            'skills' => 'required|string',
            'max_students' => 'required|integer|min:1|max:50',
            'start_date' => 'required|date',
            'location' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($course->image && Storage::disk('public')->exists($course->image)) {
                Storage::disk('public')->delete($course->image);
            }
            
            $imageName = time() . '.' . $request->image->extension();
            $imagePath = $request->image->storeAs('images/courses', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        // Handle boolean fields properly
        $data['certificate'] = $request->input('certificate', 0);
        $data['featured'] = $request->input('featured', 0);

        $course->update($data);

        return redirect()->back()->with('msg', 'Course updated successfully');
    }

    public function show_course() 
    {
        $courses = Course::with('modules')->get();
        return view('admin.courses_pages.show_course', compact('courses'));
    }

    public function verification_enrollments()
    {
        $pending = DB::table('courses_enrollments')->where('status','pending')->get();
        return view('admin.students_pages.verification_courses', compact('pending'));
    }

    public function approve_enrollment($studentId, $courseId)
    {
        DB::table('courses_enrollments')
            ->where('student_id',$studentId)
            ->where('course_id',$courseId)
            ->update(['status'=>'approved']);
        return back()->with('msg','Enrollment approved');
    }

    public function reject_enrollment($studentId, $courseId)
    {
        DB::table('courses_enrollments')
            ->where('student_id',$studentId)
            ->where('course_id',$courseId)
            ->update(['status'=>'rejected']);
        return back()->with('msg','Enrollment rejected');
    }

    public function destroy($id) 
    {
        $course = Course::findOrFail($id);
        
        // Delete course image if exists
        if ($course->image && Storage::disk('public')->exists($course->image)) {
            Storage::disk('public')->delete($course->image);
        }
        
        $course->delete();
        
        return redirect()->back()->with('msg', 'Course deleted successfully');
    }
}
