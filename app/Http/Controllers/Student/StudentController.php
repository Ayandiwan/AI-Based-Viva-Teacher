<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentVivaResult;

class StudentController extends Controller
{
    // STUDENT DASHBOARD
    public function dashboard()
    {
        return view('student.dashboard');
    }

    // STUDENT HISTORY
    public function history()
    {
        return view('student.history');
    }

    // STUDENT SUBJECT PERFORMANCE
    public function performance()
    {
        // Get all viva results of the logged-in student
        $results = StudentVivaResult::with('subject')
            ->where('student_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Group results subject-wise
        $performance = $results
            ->filter(function ($result) {
                return $result->subject !== null;
            })
            ->groupBy(function ($result) {
                return $result->subject->subject_name;
            })
            ->map(function ($subjectResults) {

                // Calculate average of all three AI providers
                $averageScores = $subjectResults->map(function ($result) {

                    $groq = (float) ($result->groq_percentage ?? 0);

                    $cloudflare = (float) ($result->cloudflare_percentage ?? 0);

                    $openrouter = (float) ($result->openrouter_percentage ?? 0);

                    return (
                        $groq +
                        $cloudflare +
                        $openrouter
                    ) / 3;
                });

                // Calculate average across all attempts
                return round($averageScores->avg(), 2);
            });

        // Prepare data for Chart.js
        $subjects = $performance->keys()->values();

        $marks = $performance->values();

        // Send data to performance Blade page
        return view('student.performance', compact(
            'subjects',
            'marks'
        ));
    }
}
