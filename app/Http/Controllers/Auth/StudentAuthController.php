<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthController extends Controller
{
    // Show Student Login Page
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    // Handle Student Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // Check if the logged-in user is a student
            if (Auth::user()->role == 'student') {
                return redirect()->route('student.dashboard');
            }

            // If not a student, log out
            Auth::logout();

            return back()->withErrors([
                'email' => 'You are not authorized as a Student.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }
}