<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\adminRequest;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Course;
use App\Models\Admin\Instructor;
use App\Models\Admin\Student;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin_login');
    }

    public function dashboard()
    {
        $totalCourses = Course::count();
        $totalInstructors = Instructor::count();
        $totalStudents = Student::count();
        $verificationRequests = Student::whereIn('is_verified', [
            Student::VERIFICATION_PENDING,
            Student::VERIFICATION_UNDER_REVIEW,
        ])->count();

        return view('admin.admins_pages.dashboard', compact(
            'totalCourses', 'totalInstructors', 'totalStudents', 'verificationRequests'
        ));
    }

    public function add_admin()
    {
        return view('admin.admins_pages.add_admin');
    }

    public function store_admin(adminRequest $request)
    {
        $admin = $request->validated();

        if ($request->hasFile('img_admin')) {
            $id = $request->id;
            $imgExt = $request->file('img_admin')->getClientOriginalExtension();
            $photoName = $id . '.' . $imgExt;

            $photo = $request->file('img_admin')->storeAs('images', $photoName);
            $admin['img_admin'] = $photo;
        }

        Admin::create($admin);
        return redirect()->back()->with('msg', "added successfuly");

    }


    public function edit_admin($id)
    {
        $admin = Admin::findorfail($id);
        return view('admin.admins_pages.edit_admin',compact('admin'));
    }

    public function put_admin(adminRequest $request, $id)
    {
        $data = $request->validated();
        $admin = Admin::findOrFail($id);



        if ($request->hasFile('img_admin')) {
        
  
            $imgExt = $request->file('img_admin')->getClientOriginalExtension();
            $photoName = $admin->id  .time(). '.' . $imgExt;
            $photo = $request->file('img_admin')->storeAs('images/imagesAdmin', $photoName, 'public');

            $data['img_admin'] = $photo;
        }

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $admin->update($data);

        return redirect()->back()->with('msg', 'Admin updated successfully');
    }



    public function show_admin()
    {
        $admins = Admin::get();

        Auth::guard('web_admin')->attempt();

        return view('admin.admins_pages.show_admin', compact('admins'));
    }

    public function admin_profile()
    {
        $admin = Auth::guard('web_admin')->user();
        return view('admin.admins_pages.admin_profile', compact('admin'));
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Current password is required',
            'password.required' => 'New password is required',
            'password.min' => 'Password must be at least 6 characters',
            'password.confirmed' => 'Password confirmation does not match',
        ]);

        $admin = Auth::guard('web_admin')->user();

       
        if (!Hash::check($request->current_password, $admin->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        // Update the admin password
        $admin->update([
            'password' => Hash::make($request->password)
        ]);

        // Optionally regenerate the session to prevent fixation
        $request->session()->regenerate();

        return redirect()->back()->with('msg', 'Password changed successfully');
    }


    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        if (!empty($admin->img_admin) && Storage::exists($admin->img_admin)) {
            Storage::delete($admin->img_admin);

            if (empty(Storage::files('images'))) {
                Storage::deleteDirectory('images');
            }
        }
        $admin->delete();

        return redirect()->back()->with('msg', 'Admin deleted successfully');
    }
}
