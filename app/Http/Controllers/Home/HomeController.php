<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Home\UserProfileUpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Course;

class HomeController extends Controller
{
    public function courses() {
        $courses = Course::latest()->get();
        return view('home.users.courses', compact('courses'));
    }

    public function userLog() {
        if (Auth::guard('web_student')->check()) {
            return redirect()->route('home');
        }
        return view('home.users.userLog');
    }

    public function userReg() {
        if (Auth::guard('web_student')->check()) {
            return redirect()->route('home');
        }
        return view('home.users.userReg');
    }

    public function profile() {
        return view('home.users.profile');
    }

    public function show($id) {
        $student = Auth::guard('web_student')->user();
        $hasApproved = false;
        if ($student) {
            $hasApproved = DB::table('courses_enrollments')->where('student_id', $student->id)->where('status','approved')->exists();
        }
        $course = Course::findOrFail($id);
        return view('home.users.show', compact('hasApproved','course'));
    }

    public function enrollCourse(Request $request) {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);
        $student = Auth::guard('web_student')->user();
        if (!$student) {
            return redirect()->route('home.userLog');
        }
        $already = DB::table('courses_enrollments')->where('student_id',$student->id)->where('status','approved')->exists();
        if ($already) {
            return back()->with('info','You are already enrolled in a course');
        }
        $instructorId = DB::table('courses_instructors')
            ->where('course_id', $request->course_id)
            ->value('instructor_id');

        if (!$instructorId) {
            return back()->with('error', 'No instructor assigned to this course yet. Please try later.');
        }

        // Create or update pending enrollment in courses_enrollments (unique by student_id,course_id)
        DB::table('courses_enrollments')->updateOrInsert(
            ['student_id' => $student->id, 'course_id' => $request->course_id],
            [
                'instructor_id' => $instructorId,
                'enrolled_at' => now(),
                'status' => 'pending',
            ]
        );

        return back()->with('success','Enrollment request sent. Awaiting admin approval.');
    }

    public function upload() {
        $student = Auth::guard('web_student')->user();
        
        if (!$student) {
            return redirect()->route('home.userLog')
                ->with('error', 'Please login first');
        }
        
        if ($student->isVerified()) {
            return redirect()->route('student.dashboard')
                ->with('info', 'Your account is already verified');
        }
        
        if ($student->isUnderReview()) {
            return redirect()->route('home.wait')
                ->with('info', 'Your account is under review');
        }
        
        return view('home.users.upload');
    }

    public function wait() {
        $student = Auth::guard('web_student')->user();
        
        if (!$student) {
            return redirect()->route('home.userLog')
                ->with('error', 'Please login first');
        }
        
        if ($student->isVerified()) {
            return redirect()->route('student.dashboard')
                ->with('success', 'Your account is verified! Welcome ' . $student->full_name);
        }
        
        if ($student->isPending()) {
            return redirect()->route('home.upload')
                ->with('info', 'Please upload your profile picture first');
        }
        
        return view('home.users.wait');
    }

    public function adminLog() {
        return view('home.users.adminLog');
    }

    public function editProfile() {
        $student = Auth::guard('web_student')->user();
        if (!$student) {
            return redirect()->route('home.userLog');
        }
        return view('home.users.profile_edit', compact('student'));
    }

    public function updateProfile(UserProfileUpdateRequest $request) {
        $student = Auth::guard('web_student')->user();
        if (!$student) {
            return redirect()->route('home.userLog');
        }

        $data = $request->only(['full_name','phone','university']);

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $student->id . '.' . $file->getClientOriginalExtension();
            \Illuminate\Support\Facades\Storage::disk('public')->putFileAs('images/imagestudent', $file, $filename);
            $data['profile_image'] = 'images/imagestudent/' . $filename;
        }

        $student->update($data);

        return redirect()->route('home.profile')->with('success', 'Profile updated successfully');
    }
}
