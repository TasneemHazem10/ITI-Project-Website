<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\authRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        // إذا كان الأدمن مسجل دخول بالفعل، أرسله للوحة التحكم
        if (Auth::guard('web_admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.admin_login');
    }

    public function handleLogin(authRequest $request)
    {
        $data = $request->validated();

        $is_login = Auth::guard('web_admin')->attempt(
            ['email' => $request->email, 'password' => $request->password],
            $request->boolean('remember')
        );



        if (! $is_login) {
            return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web_admin')->logout();
        
        // إلغاء الجلسة ولكن مش شغالة 
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login')->with('msg', 'تم تسجيل الخروج بنجاح');
    }
}
