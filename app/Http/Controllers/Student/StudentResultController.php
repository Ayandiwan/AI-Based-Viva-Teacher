<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Models\StudentAnswer;


class StudentResultController extends Controller
{

    public function index()
    {

        // Get student's viva answers
        $answers = StudentAnswer::with('question')
                    ->where('student_id', Auth::id())
                    ->latest()
                    ->get();



        // Total Questions attempted
        $totalQuestions = $answers->count();



        // Total obtained marks
        $totalMarks = $answers->sum('marks');



        // Maximum marks
        $maxMarks = $totalQuestions * 10;



        // Percentage calculation
        if($maxMarks > 0)
        {
            $percentage = round(
                ($totalMarks / $maxMarks) * 100,
                2
            );
        }
        else
        {
            $percentage = 0;
        }



        return view('student.results', compact(
            'answers',
            'totalQuestions',
            'totalMarks',
            'maxMarks',
            'percentage'
        ));

    }

}