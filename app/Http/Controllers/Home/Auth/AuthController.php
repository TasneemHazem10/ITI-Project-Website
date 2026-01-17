<?php

namespace App\Http\Controllers\Home\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\Student;
use App\Http\Requests\Home\UserRegisterRequest;
use App\Http\Requests\Home\UserLoginRequest;
use App\Http\Requests\Home\UserPhotoUploadRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('home.users.userLog');
    }

    public function showRegisterForm()
    {
        return view('home.users.userReg');
    }

    public function register(UserRegisterRequest $request)
    {
        $student = Student::create([
            'full_name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'university' => $request->university,
            'is_verified' => Student::VERIFICATION_PENDING, 
        ]);


        Auth::guard('web_student')->login($student);

        return redirect()->route('home.upload')
            ->with('success', 'Account created successfully! Please upload your profile photo to continue.');
    }

    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web_student')->attempt($credentials, $request->filled('remember'))) {
            $student = Auth::guard('web_student')->user();
            
        
        }

        return redirect()->back()
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput();
    }

    public function loginInstructor(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web_instructor')->attempt($credentials, $request->filled('remember'))) {
            $instructor = Auth::guard('web_instructor')->user();
            return redirect()->route('instructor.dashboard', ['id' => $instructor->national_id])
                ->with('success', 'Welcome '.$instructor->full_name);
        }

        return redirect()->back()
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput();
    }

    public function uploadPhoto(UserPhotoUploadRequest $request)
    {
        $student = Auth::guard('web_student')->user();
        
        if (!$student) {
            return redirect()->route('home.userLog')
                ->with('error', 'Please login first');
        }


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $student->id . '.' . $file->getClientOriginalExtension();

            Storage::disk('public')->putFileAs('images/imagestudent', $file, $filename);

            // Save relative path and move status to UNDER_REVIEW so wait page is shown
            $student->update([
                'profile_image' => 'images/imagestudent/' . $filename,
                'is_verified' => Student::VERIFICATION_UNDER_REVIEW,
            ]);

            return redirect()->route('home.wait')
                ->with('success', 'Photo uploaded successfully! It will be reviewed by the administration.');
        }

        return redirect()->back()
            ->with('error', 'An error occurred while uploading the photo');
    }

    public function logout()
    {
        Auth::guard('web_student')->logout();
        return redirect()->route('home.userLog')
            ->with('success', 'Logged out successfully');
    }

    public function logoutInstructor()
    {
        Auth::guard('web_instructor')->logout();
        return redirect()->route('home.userLog')
            ->with('success', 'Logged out successfully');
    }

    public function checkStatus()
    {
        $student = Auth::guard('web_student')->user();
        
        if (!$student) {
            return redirect()->route('home.userLog');
        }

        if ($student->isVerified()) {
            return redirect()->route('student.dashboard')
                ->with('success', 'Your account has been verified! Welcome ' . $student->full_name);
        }

        if ($student->isPending()) {
            return redirect()->route('home.upload')
                ->with('info', 'Please upload your profile photo to complete verification');
        }

        return redirect()->route('home.wait')
            ->with('info', 'Your account is under review by the administration');
    }
}
