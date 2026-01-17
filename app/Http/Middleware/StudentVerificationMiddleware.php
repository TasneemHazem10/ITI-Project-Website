<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('web_student')->check()) {
            $student = Auth::guard('web_student')->user();
            
            // If student is not verified, redirect to appropriate page
            if ($student->isPending()) {
                return redirect()->route('home.upload')
                    ->with('info', 'Please upload your profile photo to complete verification');
            } elseif ($student->isUnderReview()) {
                return redirect()->route('home.wait')
                    ->with('info', 'Your account is under review by the administration');
            }
        }

        return $next($request);
    }
}
