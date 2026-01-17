<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show_student()
    {
        $students = Student::get();

        return view('admin.students_pages.show_students', compact('students'));
    }

    public function verfi_student()
    {
        $pendingStudents = Student::whereIn('is_verified', [
            Student::VERIFICATION_PENDING,
            Student::VERIFICATION_UNDER_REVIEW,
        ])->get();

        return view('admin.students_pages.verification_students', compact('pendingStudents'));
    }
    public function destroy($id)
    {
        $students = Student::findOrFail($id);
        $students->delete();

        return redirect()->back()->with('msg', 'Student deleted successfully');
    }

    public function approve($id)
    {
        $student = Student::findOrFail($id);
        $student->is_verified = Student::VERIFICATION_APPROVED; // approved
        $student->save();

        return redirect()->back()->with('msg', 'Student approved successfully');
    }

    public function reject($id)
    {
        $student = Student::findOrFail($id);
        $student->is_verified = Student::VERIFICATION_PENDING; // back to pending (needs re-upload)
        $student->save();

        return redirect()->back()->with('msg', 'Student rejected and set to pending');
    }
}
