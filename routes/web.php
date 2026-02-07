<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController as AuthAuthController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\WelcomeController;
use App\Http\Controllers\Instructor\instructController;
use App\Http\Controllers\Student\SstudentController;
use App\Http\Controllers\Student\studentcontroller as StudentStudentcontroller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('prevent.back')->group(function () {

    // Redirect admin root to dashboard if authenticated, else to login
    Route::get('/', function () {
        if (Auth::guard('web_admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login');
    });

    Route::post('/logout', [AuthAuthController::class, 'logout'])->name('logout');
    
    Route::controller(AuthAuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/handleLogin', 'handleLogin')->name('handleLogin');
    });
    

    Route::middleware(['admin.auth','prevent.back'])->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::get('/add-admin', 'add_admin')->name('add.admin');
            Route::post('/add-admin', 'store_admin')->name('store.admin');
            Route::get('/edit-admin/{id}', 'edit_admin')->name('edit.admin'); 
            Route::get('/show-admin', 'show_admin')->name('show.admin');
            Route::get('/admin-profile', 'admin_profile')->name('admin_profile');
            Route::post('/change-password', 'change_password')->name('change_password');
            Route::delete('/admins/{id}','destroy')->name('admins.destroy');
            Route::put('/{id}', 'put_admin')->name('put_admin');
        });

        Route::controller(CoursesController::class)->group(function () {
            Route::get('/add-course', 'add_course')->name('add.course');
            Route::post('/store-course', 'store_course')->name('store.course');
            Route::get('/edit-course', 'edit_course')->name('edit.course');
            Route::get('/courses/{id}/data', 'get_course')->name('course.get');
            Route::put('/courses/{id}', 'update_course')->name('course.update');
            Route::get('/show-course', 'show_course')->name('show.course');
            Route::delete('/courses/{id}', 'destroy')->name('courses.destroy');
            Route::get('/verification-courses', 'verification_enrollments')->name('verification.courses');
            Route::post('/enrollments/{studentId}/{courseId}/approve', 'approve_enrollment')->name('enrollments.approve');
            Route::post('/enrollments/{studentId}/{courseId}/reject', 'reject_enrollment')->name('enrollments.reject');
        });

        Route::controller(InstructorController::class)->group(function () {
            Route::get('/add-instructor', 'add_instructor')->name('add.instructor');
            Route::get('/edit-instructors', 'edit_instructors')->name('edit.instructors');
            Route::get('/show-instructor', 'show_instructor')->name('show.instructor');
            Route::post('/store-instructor', 'store_instructor')->name('store.instructor');
            Route::get('/instructors/{id}/data', 'get_instructor')->name('instructor.get');
            Route::put('/instructors/{id}', 'update_instructor')->name('instructor.update');
            Route::delete('/instructors/{id}', 'destroy')->name('instructor.destroy');
        });

        Route::controller(StudentController::class)->group(function () {
            Route::get('/show-student', 'show_student')->name('show.student');
            Route::get('/verfi-student', 'verfi_student')->name('verfi.student');
            Route::post('/students/{id}/approve', 'approve')->name('students.approve');
            Route::post('/students/{id}/reject', 'reject')->name('students.reject');
            Route::delete('/students/{id}', 'destroy')->name('students.destroy');
        });
    });
});
Route::get('/', WelcomeController::class)->name('home'); 

Route::prefix('home')->name('home.')->middleware('prevent.back')->group(function () {
    // Public routes
    Route::get('/courses', [HomeController::class, 'courses'])->name('courses');
    Route::get('/userLog', [HomeController::class, 'userLog'])->name('userLog');
    Route::get('/userReg', [HomeController::class, 'userReg'])->name('userReg');
    Route::get('/adminLog', [HomeController::class, 'adminLog'])->name('adminLog');
    
    Route::controller(\App\Http\Controllers\Home\Auth\AuthController::class)->group(function () {
        Route::post('/register', 'register')->name('register');
        Route::post('/login-student', 'login')->name('login.student');
        Route::post('/login-instructor', 'loginInstructor')->name('login.instructor');
        Route::post('/logout', 'logout')->name('logout');
        Route::post('/logout-instructor', 'logoutInstructor')->name('logout.instructor');
        Route::post('/upload-photo', 'uploadPhoto')->name('uploadPhoto');
        Route::get('/check-status', 'checkStatus')->name('checkStatus');
    });
    
    Route::post('/logout', [\App\Http\Controllers\Home\Auth\AuthController::class, 'logout'])->name('logout');
    
    Route::get('/show/{id}', [HomeController::class, 'show'])->name('show');

    Route::middleware(['auth:web_student','prevent.back'])->group(function () {
        Route::get('/upload', [HomeController::class, 'upload'])->name('upload');
        Route::get('/wait', [HomeController::class, 'wait'])->name('wait');
        Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
        Route::get('/profile/edit', [HomeController::class, 'editProfile'])->name('profile.edit');
        Route::post('/profile/update', [HomeController::class, 'updateProfile'])->name('profile.update');
        Route::post('/enroll', [HomeController::class, 'enrollCourse'])->name('enroll');
    });
});

Route::prefix('instructor')->name('instructor.')->middleware(['auth:web_instructor','prevent.back'])->controller(instructController::class)->group(function () {
    Route::get('/courses-details', 'courses_details')->name('courses_details');
    Route::get('/courses', 'courses')->name('courses');
    Route::get('/dashboard/{id}', 'dashboard')->name('dashboard');
    Route::get('/profile', 'profile')->name('profile');
    Route::get('/attendance', 'attendance')->name('attendance');
    Route::get('/students', 'students')->name('students');
});
//     Route::prefix('student')->name('student.')->controller(SstudentController::class)->group(function () {
//     Route::get('/courses', 'courses')->name('courses');
//     Route::get('/dashboard', 'dashboard')->name('dashboard');
// });
Route::prefix('student')->name('student.')->middleware(['auth:web_student', 'student.verified'])->controller(StudentStudentcontroller::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/courses', 'courses')->name('courses');
        Route::get('/profile/{id}', 'profile')->name('profile');
    });


