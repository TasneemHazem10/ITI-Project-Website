<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\instructorRequest;
use App\Models\Admin\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstructorController extends Controller
{
        public function add_instructor() {
        return view('admin.instructors_pages.add_instructor_simple');
    }
    public function store_instructor(instructorRequest $request)
    {
        $instructors = $request->validated();
        
        $instructors['password'] = bcrypt($instructors['password']);
        
        if ($request->hasFile('img_name')) {
            $id = $request->national_id;
            $imgExt = $request->file('img_name')->getClientOriginalExtension();
            $photoName = $id . '.' . $imgExt;

            $photo = $request->file('img_name')->storeAs('images/imagesInstructor', $photoName, 'public');
            $instructors['img_name'] = $photo;
        } else {
            $instructors['img_name'] = null;
        }
        
        Instructor::create($instructors);
        return redirect()->back()->with('msg', "Instructor added successfully");
    }

    public function edit_instructors() {
        $instructors = Instructor::get();
        return view('admin.instructors_pages.edit_instructor', compact('instructors'));
    }

    public function get_instructor($id)
    {
        $instructor = Instructor::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => [
                'national_id' => $instructor->national_id,
                'fname' => $instructor->fname,
                'lname' => $instructor->lname,
                'email' => $instructor->email,
                'phone' => $instructor->phone,
                'job_tittle' => $instructor->job_tittle,
                'img_name' => $instructor->img_name ? asset('storage/' . $instructor->img_name) : null,
            ]
        ]);
    }

    public function update_instructor(instructorRequest $request, $id)
    {
        $instructor = Instructor::findOrFail($id);
        $data = $request->validated();
        
        // Hash password if provided
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        
        // Handle image upload
        if ($request->hasFile('img_name')) {
            // Delete old image if exists
            if ($instructor->img_name && \Storage::disk('public')->exists($instructor->img_name)) {
                \Storage::disk('public')->delete($instructor->img_name);
            }
            
            $imgExt = $request->file('img_name')->getClientOriginalExtension();
            $photoName = $id . '_' . time() . '.' . $imgExt;
            $photo = $request->file('img_name')->storeAs('images/imagesInstructor', $photoName, 'public');
            $data['img_name'] = $photo;
        }
        
        $instructor->update($data);
        
        return redirect()->back()->with('msg', 'Instructor updated successfully');
    }

    public function show_instructor() {
    $instructors=Instructor::get();

        return view('admin.instructors_pages.show_instructor',compact('instructors'));
    }

    public function destroy($id) {
    $instructors = Instructor::findOrFail($id);
    $instructors->delete();
    
    return redirect()->back()->with('msg', ' deleted successfully');
}
}
