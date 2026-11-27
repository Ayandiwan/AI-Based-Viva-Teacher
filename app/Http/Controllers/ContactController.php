<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Display Contact Page
    public function index()
    {
        return view('contact'); 
    }

    // Handle Contact Form
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);

        // We'll save the message in the next steps.

        return back()->with('success', 'Your message has been sent successfully!');
    }
}