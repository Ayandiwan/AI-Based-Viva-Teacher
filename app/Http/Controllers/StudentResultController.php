<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\StudentVivaResult;
use App\Models\StudentAnswer;

class StudentResultController extends Controller
{
    // =====================================
    // SHOW ALL RESULTS HISTORY
    // =====================================

    public function index()
    {
        $results = StudentVivaResult::with('subject')
            ->where('student_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view(
            'student.result_history',
            compact('results')
        );
    }

    // =====================================
    // SHOW SINGLE RESULT
    // =====================================

    public function show($id)
    {
        $result = StudentVivaResult::with('subject')
            ->where('id', $id)
            ->where('student_id', Auth::id())
            ->first();

        if (!$result) {
            return redirect()
                ->route('student.results')
                ->with(
                    'error',
                    'Viva result not found. Result ID: ' . $id
                );
        }

        // Get answers belonging to this result.
        $answers = StudentAnswer::with([
            'question',
            'subject',
        ])
            ->where('student_id', Auth::id())
            ->where('result_id', $result->id)
            ->orderBy('question_id', 'asc')
            ->get();

        // Basic result information.
        $totalQuestions = $result->total_questions
            ?? $answers->count();

        $maxMarks = $result->max_marks
            ?? ($totalQuestions * 10);

        // =================================
        // GROQ
        // =================================

        $groqTotal = is_numeric($result->groq_total)
            ? (float) $result->groq_total
            : 0;

        $groqPercentage = $maxMarks > 0
            ? round(($groqTotal / $maxMarks) * 100, 2)
            : 0;

        // =================================
        // CLOUDFLARE (REPLACES HUGGING FACE)
        // =================================

        $cloudflareTotal = is_numeric($result->cloudflare_total)
            ? (float) $result->cloudflare_total
            : 0;

        $cloudflarePercentage = $maxMarks > 0
            ? round(($cloudflareTotal / $maxMarks) * 100, 2)
            : 0;

        // =================================
        // OPENROUTER
        // =================================

        $openrouterTotal = is_numeric($result->openrouter_total)
            ? (float) $result->openrouter_total
            : 0;

        $openrouterPercentage = $maxMarks > 0
            ? round(($openrouterTotal / $maxMarks) * 100, 2)
            : 0;

        // =================================
        // SEND DATA TO RESULT BLADE
        // =================================

        return view(
            'student.results',
            compact(
                'result',
                'answers',
                'totalQuestions',
                'maxMarks',
                'groqTotal',
                'groqPercentage',
                'cloudflareTotal',
                'cloudflarePercentage',
                'openrouterTotal',
                'openrouterPercentage'
            )
        );
    }
}
