<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Instructor\instructor;
use Illuminate\Http\Request;

class instructController extends Controller
{
    public function courses_details()
    {
        return view('instructor.courses_pages.courses-details');
    }

    public function courses()
    {
        return view('instructor.courses_pages.courses');
    }

    public function dashboard($national_id )
    {
        $instructor = instructor::findorfail($national_id);
        return view('instructor.instructor_pages.dashboard',compact('instructor'));
    }

    public function profile()
    {
        return view('instructor.instructor_pages.profile');
    }

    public function attendance()
    {
        return view('instructor.student_pages.attendance');
        
    }

    public function students()
    {
        return view('instructor.student_pages.students');
    }
}