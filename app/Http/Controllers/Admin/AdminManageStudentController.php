<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminManageStudentController extends Controller
{
    // =========================
    // View All Students
    // =========================

    public function index()
    {
        $students = User::withTrashed()
                        ->where('role', 'student')
                        ->get();

        return view(
            'admin.students.index',
            compact('students')
        );
    }


    // =========================
    // Delete / Restore Student
    // =========================

    public function destroy($id)
    {
        $student = User::withTrashed()
                       ->where('role', 'student')
                       ->findOrFail($id);


        // Restore deleted student
        if ($student->trashed()) {

            $student->restore();

            return back()
                ->with(
                    'success',
                    'Student Restored Successfully'
                );
        }


        // Soft delete student
        else {

            $student->delete();

            return back()
                ->with(
                    'success',
                    'Student Deleted Successfully'
                );
        }
    }


    // =========================
    // Activate / Deactivate
    // =========================

    public function status($id)
    {
        $student = User::where('role', 'student')
                       ->findOrFail($id);


        $student->status = !$student->status;

        $student->save();


        return back()
            ->with(
                'success',
                'Student status updated'
            );
    }
}