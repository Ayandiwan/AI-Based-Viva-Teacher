<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subject;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    // ======================================================
    // ADMIN DASHBOARD
    // ======================================================

    public function dashboard()
    {
        $teacherCount = User::where('role', 'teacher')->count();

        $studentCount = User::where('role', 'student')->count();

        $subjectCount = Subject::count();

        $vivaCount = StudentAnswer::whereNotNull('result_id')
            ->distinct('result_id')
            ->count('result_id');

        return view('admin.dashboard', compact(
            'teacherCount',
            'studentCount',
            'subjectCount',
            'vivaCount'
        ));
    }


    // ======================================================
    // ADMIN REPORTS
    // ======================================================

    public function reports()
    {
        // ==================================================
        // BASIC COUNTS
        // ==================================================

        $teacherCount = User::where('role', 'teacher')->count();

        $studentCount = User::where('role', 'student')->count();

        $subjectCount = Subject::count();


        // ==================================================
        // GET COMPLETED VIVA ANSWERS
        // ==================================================

        $allAnswers = StudentAnswer::with([
            'student',
            'subject'
        ])
        ->whereNotNull('result_id')
        ->get();


        // ==================================================
        // GROUP ANSWERS BY RESULT ID
        //
        // One result_id = one complete viva attempt
        // ==================================================

        $attempts = $allAnswers
            ->groupBy('result_id')
            ->map(function ($answers) {

                $firstAnswer = $answers->first();

                // ------------------------------------------
                // TOTAL OBTAINED MARKS
                // ------------------------------------------

                $totalMarks = $answers->sum(function ($answer) {
                    return (float) ($answer->marks ?? 0);
                });


                // ------------------------------------------
                // TOTAL QUESTIONS
                // ------------------------------------------

                $totalQuestions = $answers->count();


                // ------------------------------------------
                // MAXIMUM MARKS
                //
                // Each question = 10 marks
                // ------------------------------------------

                $totalPossibleMarks = $totalQuestions * 10;


                // ------------------------------------------
                // PERCENTAGE
                // ------------------------------------------

                $percentage = 0;

                if ($totalPossibleMarks > 0) {
                    $percentage =
                        ($totalMarks / $totalPossibleMarks) * 100;
                }


                // ------------------------------------------
                // STUDENT
                // ------------------------------------------

                $student = $firstAnswer->student ?? null;


                // ------------------------------------------
                // SUBJECT
                // ------------------------------------------

                $subject = $firstAnswer->subject ?? null;


                return (object) [

                    'result_id' => $firstAnswer->result_id,

                    'student' => $student,

                    'subject' => $subject,

                    'student_name' =>
                        $student->name ?? 'N/A',

                    'subject_name' =>
                        $subject->subject_name ?? 'N/A',

                    'total_questions' =>
                        $totalQuestions,

                    'total_marks' =>
                        $totalMarks,

                    'total_possible_marks' =>
                        $totalPossibleMarks,

                    'score' =>
                        $totalMarks . '/' . $totalPossibleMarks,

                    'percentage' =>
                        $percentage,

                    'created_at' =>
                        $answers->max('created_at'),

                    'answers' =>
                        $answers,
                ];
            })
            ->sortByDesc('created_at')
            ->values();


        // ==================================================
        // TOTAL VIVA ATTEMPTS
        // ==================================================

        $totalAttempts = $attempts->count();


        // ==================================================
        // AVERAGE SCORE
        // ==================================================

        $averageScore = $attempts->avg('percentage') ?? 0;


        // ==================================================
        // HIGHEST SCORE
        // ==================================================

        $highestScore = $attempts->max('percentage') ?? 0;


        // ==================================================
        // RECENT ATTEMPTS
        // ==================================================

        $recentAttempts = $attempts->take(10);


        // ==================================================
        // STUDENT PERFORMANCE
        // ==================================================

        $studentReports = User::where('role', 'student')
            ->get()
            ->map(function ($student) use ($attempts) {

                $studentAttempts = $attempts->filter(
                    function ($attempt) use ($student) {

                        return $attempt->student
                            && $attempt->student->id == $student->id;
                    }
                );


                $student->total_attempts =
                    $studentAttempts->count();


                $student->average_score =
                    $studentAttempts->count() > 0
                        ? $studentAttempts->avg('percentage')
                        : 0;


                $student->highest_score =
                    $studentAttempts->count() > 0
                        ? $studentAttempts->max('percentage')
                        : 0;


                return $student;
            });


        // ==================================================
        // REPORT VIEW
        // ==================================================

        return view('admin.reports', compact(
            'teacherCount',
            'studentCount',
            'subjectCount',
            'totalAttempts',
            'averageScore',
            'highestScore',
            'recentAttempts',
            'studentReports'
        ));
    }


    // ======================================================
    // DOWNLOAD ADMIN REPORT
    // ======================================================

    public function downloadReport(): StreamedResponse
    {
        $answers = StudentAnswer::with([
            'student',
            'subject'
        ])
        ->whereNotNull('result_id')
        ->get();


        // ==================================================
        // GROUP BY RESULT
        // ==================================================

        $attempts = $answers
            ->groupBy('result_id')
            ->map(function ($answers) {

                $first = $answers->first();

                $totalMarks = $answers->sum(
                    function ($answer) {
                        return (float) ($answer->marks ?? 0);
                    }
                );

                $totalQuestions = $answers->count();

                $totalPossibleMarks =
                    $totalQuestions * 10;

                $percentage = 0;

                if ($totalPossibleMarks > 0) {
                    $percentage =
                        ($totalMarks / $totalPossibleMarks) * 100;
                }

                return [
                    'student' =>
                        $first->student->name ?? 'N/A',

                    'subject' =>
                        $first->subject->subject_name ?? 'N/A',

                    'total_questions' =>
                        $totalQuestions,

                    'score' =>
                        $totalMarks . '/' . $totalPossibleMarks,

                    'percentage' =>
                        number_format($percentage, 2) . '%',

                    'date' =>
                        optional($answers->max('created_at'))
                            ->format('d-m-Y'),
                ];
            })
            ->sortByDesc(function ($attempt) {
                return $attempt['date'];
            })
            ->values();


        // ==================================================
        // CSV DOWNLOAD
        // ==================================================

        $fileName =
            'AI_Viva_Admin_Report_' .
            date('d-m-Y_H-i-s') .
            '.csv';


        return response()->streamDownload(
            function () use ($attempts) {

                $file = fopen('php://output', 'w');


                // ------------------------------------------
                // REPORT TITLE
                // ------------------------------------------

                fputcsv($file, [
                    'AI VIVA TEACHER - ADMIN REPORT'
                ]);

                fputcsv($file, [
                    'Generated Date',
                    date('d-m-Y H:i:s')
                ]);

                fputcsv($file, []);


                // ------------------------------------------
                // TABLE HEADER
                // ------------------------------------------

                fputcsv($file, [
                    '#',
                    'Student',
                    'Subject',
                    'Total Questions',
                    'Score',
                    'Percentage',
                    'Date'
                ]);


                // ------------------------------------------
                // DATA
                // ------------------------------------------

                foreach ($attempts as $index => $attempt) {

                    fputcsv($file, [
                        $index + 1,
                        $attempt['student'],
                        $attempt['subject'],
                        $attempt['total_questions'],
                        $attempt['score'],
                        $attempt['percentage'],
                        $attempt['date'],
                    ]);
                }


                fclose($file);
            },
            $fileName,
            [
                'Content-Type' =>
                    'text/csv; charset=UTF-8',
            ]
        );
    }


    // ======================================================
    // VIEW SINGLE VIVA ATTEMPT
    // ======================================================

    public function viewAttempt($resultId)
    {
        $answers = StudentAnswer::with([
            'student',
            'subject',
            'question'
        ])
        ->where('result_id', $resultId)
        ->get();


        if ($answers->isEmpty()) {

            return redirect()
                ->route('admin.reports')
                ->with('error', 'Viva attempt not found.');
        }


        $first = $answers->first();


        $totalMarks = $answers->sum(
            function ($answer) {
                return (float) ($answer->marks ?? 0);
            }
        );


        $totalQuestions = $answers->count();


        $totalPossibleMarks =
            $totalQuestions * 10;


        $percentage = $totalPossibleMarks > 0
            ? ($totalMarks / $totalPossibleMarks) * 100
            : 0;


        return view(
            'admin.report-details',
            compact(
                'answers',
                'first',
                'totalMarks',
                'totalQuestions',
                'totalPossibleMarks',
                'percentage'
            )
        );
    }
}