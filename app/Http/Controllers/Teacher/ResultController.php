<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Subject;
use App\Models\StudentAnswer;

use Barryvdh\DomPDF\Facade\Pdf;

class ResultController extends Controller
{
    /**
     * =====================================================
     * Teacher Result List
     * =====================================================
     */
    public function index()
    {
        // GET SUBJECTS CREATED BY LOGGED-IN TEACHER

        $subjectIds = Subject::where(
            'teacher_id',
            Auth::id()
        )->pluck('id');

        // GET STUDENT ANSWERS

        $answers = StudentAnswer::with([
            'student',
            'subject',
            'question'
        ])
        ->whereIn('subject_id', $subjectIds)
        ->whereNotNull('student_id')
        ->orderByDesc('created_at')
        ->get();

        // GROUP STUDENT + SUBJECT

        $results = $answers
            ->groupBy(function ($answer) {
                return $answer->student_id .
                    '-' .
                    $answer->subject_id;
            })
            ->map(function ($studentAnswers) {

                $firstAnswer = $studentAnswers->first();

                // TOTAL QUESTIONS

                $totalQuestions = $studentAnswers->count();

                // MAXIMUM SCORE

                $maxMarks = $totalQuestions * 10;

                // GROQ TOTAL

                $groqTotal = $studentAnswers->sum(
                    function ($answer) {
                        return is_numeric($answer->groq_score)
                            ? (float) $answer->groq_score
                            : 0;
                    }
                );

                // CLOUDFLARE TOTAL

                $cloudflareTotal = $studentAnswers->sum(
                    function ($answer) {
                        return is_numeric($answer->cloudflare_score)
                            ? (float) $answer->cloudflare_score
                            : 0;
                    }
                );

                // OPENROUTER TOTAL

                $openrouterTotal = $studentAnswers->sum(
                    function ($answer) {
                        return is_numeric($answer->openrouter_score)
                            ? (float) $answer->openrouter_score
                            : 0;
                    }
                );

                // GROQ PERCENTAGE

                $groqPercentage = $maxMarks > 0
                    ? round(($groqTotal / $maxMarks) * 100, 2)
                    : 0;

                // CLOUDFLARE PERCENTAGE

                $cloudflarePercentage = $maxMarks > 0
                    ? round(($cloudflareTotal / $maxMarks) * 100, 2)
                    : 0;

                // OPENROUTER PERCENTAGE

                $openrouterPercentage = $maxMarks > 0
                    ? round(($openrouterTotal / $maxMarks) * 100, 2)
                    : 0;

                // AVERAGE SCORE

                $averageScore = round(
                    (
                        $groqPercentage +
                        $cloudflarePercentage +
                        $openrouterPercentage
                    ) / 3,
                    2
                );

                // RESULT OBJECT

                return (object) [

                    'id' => $firstAnswer->id,

                    'student' => $firstAnswer->student,

                    'subject' => $firstAnswer->subject,

                    'answers' => $studentAnswers,

                    'total_questions' => $totalQuestions,

                    'max_marks' => $maxMarks,

                    // GROQ

                    'groq_total' => $groqTotal,

                    'groq_percentage' => $groqPercentage,

                    // CLOUDFLARE

                    'cloudflare_total' => $cloudflareTotal,

                    'cloudflare_percentage' => $cloudflarePercentage,

                    // OPENROUTER

                    'openrouter_total' => $openrouterTotal,

                    'openrouter_percentage' => $openrouterPercentage,

                    // AVERAGE

                    'average_score' => $averageScore,

                    'created_at' => $studentAnswers->max('created_at'),

                    'overall_feedback' => $this->generateOverallFeedback(
                        $groqPercentage,
                        $cloudflarePercentage,
                        $openrouterPercentage
                    ),
                ];
            })
            ->values();

        // SEND RESULTS TO VIEW

        return view(
            'teacher.results.index',
            compact('results')
        );
    }

    /**
     * =====================================================
     * Show Individual Result
     * =====================================================
     */
    public function show($id)
    {
        // GET SELECTED ANSWER

        $selectedAnswer = StudentAnswer::with([
            'student',
            'subject',
            'question'
        ])->findOrFail($id);

        // TEACHER SECURITY CHECK

        $subject = Subject::where(
            'id',
            $selectedAnswer->subject_id
        )
        ->where('teacher_id', Auth::id())
        ->firstOrFail();

        // GET STUDENT ANSWERS

        $answers = StudentAnswer::with([
            'student',
            'subject',
            'question'
        ])
        ->where('student_id', $selectedAnswer->student_id)
        ->where('subject_id', $selectedAnswer->subject_id)
        ->orderBy('id')
        ->get();

        // TOTAL QUESTIONS

        $totalQuestions = $answers->count();

        // MAXIMUM SCORE

        $maxMarks = $totalQuestions * 10;

        // GROQ TOTAL

        $groqTotal = $answers->sum(
            function ($answer) {
                return is_numeric($answer->groq_score)
                    ? (float) $answer->groq_score
                    : 0;
            }
        );

        // CLOUDFLARE TOTAL

        $cloudflareTotal = $answers->sum(
            function ($answer) {
                return is_numeric($answer->cloudflare_score)
                    ? (float) $answer->cloudflare_score
                    : 0;
            }
        );

        // OPENROUTER TOTAL

        $openrouterTotal = $answers->sum(
            function ($answer) {
                return is_numeric($answer->openrouter_score)
                    ? (float) $answer->openrouter_score
                    : 0;
            }
        );

        // GROQ PERCENTAGE

        $groqPercentage = $maxMarks > 0
            ? round(($groqTotal / $maxMarks) * 100, 2)
            : 0;

        // CLOUDFLARE PERCENTAGE

        $cloudflarePercentage = $maxMarks > 0
            ? round(($cloudflareTotal / $maxMarks) * 100, 2)
            : 0;

        // OPENROUTER PERCENTAGE

        $openrouterPercentage = $maxMarks > 0
            ? round(($openrouterTotal / $maxMarks) * 100, 2)
            : 0;

        // AVERAGE SCORE

        $averageScore = round(
            (
                $groqPercentage +
                $cloudflarePercentage +
                $openrouterPercentage
            ) / 3,
            2
        );

        // RESULT OBJECT

        $result = (object) [

            'id' => $selectedAnswer->id,

            'student' => $selectedAnswer->student,

            'subject' => $subject,

            'answers' => $answers,

            'total_questions' => $totalQuestions,

            'max_marks' => $maxMarks,

            // GROQ

            'groq_total' => $groqTotal,

            'groq_percentage' => $groqPercentage,

            // CLOUDFLARE

            'cloudflare_total' => $cloudflareTotal,

            'cloudflare_percentage' => $cloudflarePercentage,

            // OPENROUTER

            'openrouter_total' => $openrouterTotal,

            'openrouter_percentage' => $openrouterPercentage,

            // AVERAGE

            'average_score' => $averageScore,

            'created_at' => $answers->max('created_at'),

            'overall_feedback' => $this->generateOverallFeedback(
                $groqPercentage,
                $cloudflarePercentage,
                $openrouterPercentage
            ),
        ];

        // SEND RESULT TO VIEW

        return view(
            'teacher.results.show',
            compact('result')
        );
    }

    /**
     * =====================================================
     * Download PDF
     * =====================================================
     */
    public function download($id)
    {
        // GET SELECTED ANSWER

        $selectedAnswer = StudentAnswer::with([
            'student',
            'subject',
            'question'
        ])->findOrFail($id);

        // TEACHER SECURITY CHECK

        $subject = Subject::where(
            'id',
            $selectedAnswer->subject_id
        )
        ->where('teacher_id', Auth::id())
        ->firstOrFail();

        // GET STUDENT ANSWERS

        $answers = StudentAnswer::with([
            'student',
            'subject',
            'question'
        ])
        ->where('student_id', $selectedAnswer->student_id)
        ->where('subject_id', $selectedAnswer->subject_id)
        ->orderBy('id')
        ->get();

        // TOTAL QUESTIONS

        $totalQuestions = $answers->count();

        // MAXIMUM SCORE

        $maxMarks = $totalQuestions * 10;

        // GROQ TOTAL

        $groqTotal = $answers->sum(
            function ($answer) {
                return is_numeric($answer->groq_score)
                    ? (float) $answer->groq_score
                    : 0;
            }
        );

        // CLOUDFLARE TOTAL

        $cloudflareTotal = $answers->sum(
            function ($answer) {
                return is_numeric($answer->cloudflare_score)
                    ? (float) $answer->cloudflare_score
                    : 0;
            }
        );

        // OPENROUTER TOTAL

        $openrouterTotal = $answers->sum(
            function ($answer) {
                return is_numeric($answer->openrouter_score)
                    ? (float) $answer->openrouter_score
                    : 0;
            }
        );

        // GROQ PERCENTAGE

        $groqPercentage = $maxMarks > 0
            ? round(($groqTotal / $maxMarks) * 100, 2)
            : 0;

        // CLOUDFLARE PERCENTAGE

        $cloudflarePercentage = $maxMarks > 0
            ? round(($cloudflareTotal / $maxMarks) * 100, 2)
            : 0;

        // OPENROUTER PERCENTAGE

        $openrouterPercentage = $maxMarks > 0
            ? round(($openrouterTotal / $maxMarks) * 100, 2)
            : 0;

        // AVERAGE SCORE

        $averageScore = round(
            (
                $groqPercentage +
                $cloudflarePercentage +
                $openrouterPercentage
            ) / 3,
            2
        );

        // RESULT OBJECT

        $result = (object) [

            'id' => $selectedAnswer->id,

            'student' => $selectedAnswer->student,

            'subject' => $subject,

            'answers' => $answers,

            'total_questions' => $totalQuestions,

            'max_marks' => $maxMarks,

            // GROQ

            'groq_total' => $groqTotal,

            'groq_percentage' => $groqPercentage,

            // CLOUDFLARE

            'cloudflare_total' => $cloudflareTotal,

            'cloudflare_percentage' => $cloudflarePercentage,

            // OPENROUTER

            'openrouter_total' => $openrouterTotal,

            'openrouter_percentage' => $openrouterPercentage,

            // AVERAGE

            'average_score' => $averageScore,

            'created_at' => $answers->max('created_at'),

            'overall_feedback' => $this->generateOverallFeedback(
                $groqPercentage,
                $cloudflarePercentage,
                $openrouterPercentage
            ),
        ];

        // GENERATE PDF

        $pdf = Pdf::loadView(
            'teacher.results.pdf',
            compact('result')
        );

        // DOWNLOAD PDF

        return $pdf->download(
            'student-viva-result-' .
            $result->student->id .
            '.pdf'
        );
    }

    /**
     * =====================================================
     * Overall Feedback
     * =====================================================
     */
    private function generateOverallFeedback(
        $groqPercentage,
        $cloudflarePercentage,
        $openrouterPercentage
    ) {
        // AVERAGE OF THREE AI PROVIDERS

        $average = (
            $groqPercentage +
            $cloudflarePercentage +
            $openrouterPercentage
        ) / 3;

        // EXCELLENT

        if ($average >= 80) {
            return 'Excellent performance. The student demonstrated strong understanding of the viva questions.';
        }

        // GOOD

        if ($average >= 60) {
            return 'Good performance. The student has a good understanding of the subject but can improve further.';
        }

        // AVERAGE

        if ($average >= 40) {
            return 'Average performance. The student should improve conceptual understanding and answer accuracy.';
        }

        // NEEDS IMPROVEMENT

        return 'Needs improvement. The student should revise the subject concepts and practice more viva questions.';
    }
}
