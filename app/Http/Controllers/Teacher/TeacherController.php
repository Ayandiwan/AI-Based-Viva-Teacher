<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Question;
use App\Models\User;
use App\Models\StudentAnswer;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    // ======================================================
    // TEACHER DASHBOARD
    // ======================================================

    public function dashboard()
    {
        $teacherId = Auth::id();


        // ==================================================
        // ONLY THIS TEACHER'S SUBJECTS
        // ==================================================

        $subjectIds = Subject::where(
            'teacher_id',
            $teacherId
        )->pluck('id');


        // ==================================================
        // TOTAL SUBJECTS
        // ==================================================

        $totalSubjects = Subject::where(
            'teacher_id',
            $teacherId
        )->count();


        // ==================================================
        // TOTAL QUESTIONS
        // ==================================================

        $totalQuestions = Question::whereIn(
            'subject_id',
            $subjectIds
        )->count();


        // ==================================================
        // ALL REGISTERED STUDENTS
        // ==================================================

        $totalStudents = User::where(
            'role',
            'student'
        )->count();


        // ==================================================
        // COMPLETED VIVA
        // ONLY FOR THIS TEACHER'S SUBJECTS
        // ==================================================

        $completedViva = StudentAnswer::whereIn(
            'subject_id',
            $subjectIds
        )
        ->distinct('student_id')
        ->count('student_id');


        // ==================================================
        // RECENT SUBJECTS
        // ==================================================

        $recentSubjects = Subject::where(
            'teacher_id',
            $teacherId
        )
        ->latest()
        ->take(5)
        ->get();


        // ==================================================
        // RECENT QUESTIONS
        // ==================================================

        $recentQuestions = Question::whereIn(
            'subject_id',
            $subjectIds
        )
        ->latest()
        ->take(5)
        ->get();


        // ==================================================
        // TEACHER DASHBOARD VIEW
        // ==================================================

        return view(
            'teacher.dashboard',
            compact(
                'totalSubjects',
                'totalQuestions',
                'totalStudents',
                'completedViva',
                'recentSubjects',
                'recentQuestions'
            )
        );
    }



    // ======================================================
    // MANAGE STUDENTS
    // ======================================================

    public function students()
    {
        /*
         * Get all students.
         *
         * withTrashed() is used because deleted students
         * should also be visible so they can be restored.
         */

        $students = User::withTrashed()
            ->where('role', 'student')
            ->latest()
            ->get();


        return view(
            'teacher.students.index',
            compact('students')
        );
    }



    // ======================================================
    // DELETE / RESTORE STUDENT
    // ======================================================

    public function destroyStudent($id)
    {
        /*
         * Find student including soft-deleted students.
         */

        $student = User::withTrashed()
            ->where('role', 'student')
            ->findOrFail($id);


        // ==================================================
        // RESTORE STUDENT
        // ==================================================

        if ($student->trashed()) {

            $student->restore();

            return back()->with(
                'success',
                'Student Restored Successfully'
            );
        }


        // ==================================================
        // SOFT DELETE STUDENT
        // ==================================================

        $student->delete();


        return back()->with(
            'success',
            'Student Deleted Successfully'
        );
    }



    // ======================================================
    // ACTIVATE / DEACTIVATE STUDENT
    // ======================================================

    public function studentStatus($id)
    {
        /*
         * Find only active/non-deleted student.
         */

        $student = User::where(
            'role',
            'student'
        )->findOrFail($id);


        // Toggle status

        $student->status = !$student->status;

        $student->save();


        return back()->with(
            'success',
            'Student status updated successfully'
        );
    }
}