<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Show Admin Login Page
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    // Handle Admin Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // Check if the logged-in user is an admin
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // If not an admin, log out
            Auth::logout();

            return back()->withErrors([
                'email' => 'You are not authorized as an Admin.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }
}