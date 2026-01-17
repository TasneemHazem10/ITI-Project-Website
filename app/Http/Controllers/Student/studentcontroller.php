<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Student;

class studentcontroller extends Controller
{
    public function dashboard(){

        return view('student.student_pages.dashboard');
    }
    public function courses(){

        return view('student.student_pages.courses');
    }

    public function profile($id){
        $authStudent = Auth::guard('web_student')->user();
        if (!$authStudent || (string)$authStudent->id !== (string)$id) {
            return redirect()->route('student.dashboard');
        }
        $student = Student::findOrFail($id);
        return view('student.student_pages.profile', compact('student'));
    }
}
