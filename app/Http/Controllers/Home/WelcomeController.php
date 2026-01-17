<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Course;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $featuredCourses = Course::where('featured', true)->latest()->take(6)->get();
        return view('home.users.home', compact('featuredCourses'));
    }
}
