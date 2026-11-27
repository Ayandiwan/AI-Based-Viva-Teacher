<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAuthController extends Controller
{
    // Show Teacher Login Page
    public function showLoginForm()
    {
        return view('auth.teacher-login');
    }

    // Teacher Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // Check role
            if (Auth::user()->role == 'teacher') {
                return redirect()->route('teacher.dashboard');
            }

            // Wrong role
            Auth::logout();

            return back()->withErrors([
                'email' => 'You are not authorized as a Teacher.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }
}