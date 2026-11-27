<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;

class SubjectController extends Controller
{
    // Display all subjects of logged-in teacher
    public function index()
    {
        $subjects = Subject::where('teacher_id', Auth::id())->get();

        return view('teacher.subjects.listsubject', compact('subjects'));
    }

    // Show Add Subject Page
    public function create()
    {
        return view('teacher.subjects.addsubject');
    }

    // Store Subject
    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
            'subject_code' => 'required|string|max:50|unique:subjects,subject_code',
            'description'  => 'nullable|string',
        ], [
            'subject_code.required' => 'Subject Code is required.',
            'subject_code.unique'   => 'This Subject Code already exists.',
        ]);

        Subject::create([
            'teacher_id'   => Auth::id(),
            'subject_name' => $request->subject_name,
            'subject_code' => strtoupper($request->subject_code),
            'description'  => $request->description,
        ]);

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject Added Successfully.');
    }

    // Edit Subject
    public function edit($id)
    {
        $subject = Subject::where('teacher_id', Auth::id())
            ->findOrFail($id);

        return view('teacher.subjects.editsubject', compact('subject'));
    }

    // Update Subject
    public function update(Request $request, $id)
    {
        $subject = Subject::where('teacher_id', Auth::id())
            ->findOrFail($id);

        $request->validate([
            'subject_name' => 'required|string|max:255',

            'subject_code' => 'required|string|max:50|unique:subjects,subject_code,' . $subject->id,

            'description' => 'nullable|string',
        ], [
            'subject_code.required' => 'Subject Code is required.',
            'subject_code.unique'   => 'This Subject Code already exists.',
        ]);

        $subject->update([
            'subject_name' => $request->subject_name,
            'subject_code' => strtoupper($request->subject_code),
            'description'  => $request->description,
        ]);

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject Updated Successfully.');
    }

    // Delete Subject
    public function destroy($id)
    {
        $subject = Subject::where('teacher_id', Auth::id())
            ->findOrFail($id);

        $subject->delete();

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject Deleted Successfully.');
    }
}