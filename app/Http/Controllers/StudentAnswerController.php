<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Question;
use App\Models\StudentAnswer;
use App\Models\StudentVivaAttempt;
use App\Models\StudentVivaResult;

use App\Services\GroqService;
use App\Services\CloudflareService;
use App\Services\OpenRouterService;

class StudentAnswerController extends Controller
{
    // =========================================================
    // SUBMIT STUDENT ANSWER
    // =========================================================

    public function submit(
        Request $request,
        GroqService $groq,
        CloudflareService $cloudflare,
        OpenRouterService $openrouter
    ) {
        $request->validate([
            'subject_id'  => 'required',
            'question_id' => 'required|exists:questions,id',
            'answer_type' => 'required',
            'answer'      => 'required|string',
        ]);

        $question = Question::findOrFail($request->question_id);

        // Prevent multiple attempts for the same question.
        $alreadyAttempted = StudentVivaAttempt::where(
            'student_id',
            Auth::id()
        )
            ->where('subject_id', $request->subject_id)
            ->where('question_id', $request->question_id)
            ->exists();

        if ($alreadyAttempted) {
            return redirect()
                ->route('student.subjects')
                ->with(
                    'error',
                    'You have already attempted this viva question. Multiple attempts are not allowed.'
                );
        }

        $studentAnswer = $request->answer;
        $correctAnswer = $question->answer;

        // Default values.
        $groqScore = 0;
        $groqFeedback = 'No Groq feedback available.';

        $cloudflareScore = 0;
        $cloudflareFeedback = 'No Cloudflare feedback available.';

        $openrouterScore = 0;
        $openrouterFeedback = 'No OpenRouter feedback available.';

        // =====================================================
        // GROQ EVALUATION
        // =====================================================

        try {
            $groqResponse = $groq->evaluateAnswer(
                $question->question,
                $studentAnswer,
                $correctAnswer
            );

            $groqResponse = (string) $groqResponse;

            $cleanGroqResponse = trim(
                preg_replace('/```json|```/i', '', $groqResponse)
            );

            $groqData = json_decode($cleanGroqResponse, true);

            if (is_array($groqData) && isset($groqData['score'])) {
                $groqScore = min(
                    10,
                    max(0, (float) $groqData['score'])
                );

                $groqFeedback = $groqData['feedback'] ?? $groqResponse;
            } elseif (
                preg_match('/(\d+(?:\.\d+)?)\s*\/\s*10/', $groqResponse, $match)
            ) {
                $groqScore = min(
                    10,
                    max(0, (float) $match[1])
                );

                $groqFeedback = $groqResponse;
            } else {
                $groqFeedback = $groqResponse
                    ?: 'No Groq feedback available.';
            }
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Groq AI evaluation failed: ' . $e->getMessage());
        }

        // =====================================================
        // CLOUDFLARE EVALUATION (REPLACES HUGGING FACE)
        // =====================================================

        try {
            $cloudflareResponse = $cloudflare->evaluateAnswer(
                $question->question,
                $studentAnswer,
                $correctAnswer
            );

            // CloudflareService returns concepts, score and feedback.
            // Empty concepts indicate a failed or invalid response.
            if (
                !is_array($cloudflareResponse) ||
                empty($cloudflareResponse['concepts']) ||
                !isset($cloudflareResponse['score']) ||
                !empty($cloudflareResponse['error'])
            ) {
                $errorMessage = is_array($cloudflareResponse)
                    ? ($cloudflareResponse['feedback']
                        ?? $cloudflareResponse['error']
                        ?? 'Cloudflare returned an invalid evaluation.')
                    : 'Cloudflare returned an invalid response.';

                return back()
                    ->withInput()
                    ->with('error', 'Cloudflare AI evaluation failed: ' . $errorMessage);
            }

            $cloudflareScore = min(
                10,
                max(0, (float) $cloudflareResponse['score'])
            );

            $cloudflareFeedback = $cloudflareResponse['feedback']
                ?? 'No Cloudflare feedback available.';
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Cloudflare AI evaluation failed: ' . $e->getMessage()
                );
        }

        // =====================================================
        // OPENROUTER EVALUATION
        // =====================================================

        try {
            $openrouterResponse = $openrouter->evaluateAnswer(
                $question->question,
                $studentAnswer,
                $correctAnswer
            );

            $openrouterResponse = (string) $openrouterResponse;

            $cleanOpenRouterResponse = trim(
                preg_replace('/```json|```/i', '', $openrouterResponse)
            );

            $openrouterData = json_decode($cleanOpenRouterResponse, true);

            if (
                is_array($openrouterData) &&
                isset($openrouterData['score'])
            ) {
                $openrouterScore = min(
                    10,
                    max(0, (float) $openrouterData['score'])
                );

                $openrouterFeedback =
                    $openrouterData['feedback'] ?? $openrouterResponse;
            } elseif (
                preg_match(
                    '/(\d+(?:\.\d+)?)\s*\/\s*10/',
                    $openrouterResponse,
                    $match
                )
            ) {
                $openrouterScore = min(
                    10,
                    max(0, (float) $match[1])
                );

                $openrouterFeedback = $openrouterResponse;
            } else {
                $openrouterFeedback = $openrouterResponse
                    ?: 'No OpenRouter feedback available.';
            }
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'OpenRouter AI evaluation failed: ' . $e->getMessage()
                );
        }

        // =====================================================
        // SAVE STUDENT ANSWER
        // =====================================================

        StudentAnswer::updateOrCreate(
            [
                'student_id'  => Auth::id(),
                'question_id' => $question->id,
            ],
            [
                'subject_id'    => $request->subject_id,
                'answer_type'   => $request->answer_type,
                'answer'        => $studentAnswer,
                'correct_answer' => $correctAnswer,

                // Main result remains Groq.
                'marks'       => $groqScore,
                'ai_score'    => $groqScore,
                'ai_feedback' => $groqFeedback,
                'feedback'    => $groqFeedback,

                // Groq.
                'groq_score'    => $groqScore,
                'groq_feedback' => $groqFeedback,

                // Cloudflare replaces Hugging Face.
                'cloudflare_score'    => $cloudflareScore,
                'cloudflare_feedback' => $cloudflareFeedback,

                // OpenRouter.
                'openrouter_score'    => $openrouterScore,
                'openrouter_feedback' => $openrouterFeedback,
            ]
        );

        // =====================================================
        // SAVE VIVA ATTEMPT
        // =====================================================

        StudentVivaAttempt::updateOrCreate(
            [
                'student_id'  => Auth::id(),
                'subject_id'  => $request->subject_id,
                'question_id' => $question->id,
            ],
            [
                'student_answer' => $studentAnswer,
                'marks'          => $groqScore,
                'ai_feedback'    => $groqFeedback,
            ]
        );

        // =====================================================
        // FIND REMAINING QUESTIONS
        // =====================================================

        $attemptedQuestions = StudentVivaAttempt::where(
            'student_id',
            Auth::id()
        )
            ->where('subject_id', $request->subject_id)
            ->pluck('question_id');

        $questions = Question::where(
            'subject_id',
            $request->subject_id
        )
            ->whereNotIn('id', $attemptedQuestions)
            ->orderBy('id')
            ->get();

        // =====================================================
        // VIVA COMPLETED
        // =====================================================

        if ($questions->count() === 0) {
            $answers = StudentAnswer::where(
                'student_id',
                Auth::id()
            )
                ->where('subject_id', $request->subject_id)
                ->get();

            $totalQuestions = $answers->count();
            $maxMarks = $totalQuestions * 10;

            $groqTotal = $answers->sum('groq_score');
            $cloudflareTotal = $answers->sum('cloudflare_score');
            $openrouterTotal = $answers->sum('openrouter_score');

            $groqPercentage = $maxMarks > 0
                ? round(($groqTotal / $maxMarks) * 100, 2)
                : 0;

            $cloudflarePercentage = $maxMarks > 0
                ? round(($cloudflareTotal / $maxMarks) * 100, 2)
                : 0;

            $openrouterPercentage = $maxMarks > 0
                ? round(($openrouterTotal / $maxMarks) * 100, 2)
                : 0;

            $attemptNo = StudentVivaResult::where(
                'student_id',
                Auth::id()
            )
                ->where('subject_id', $request->subject_id)
                ->count() + 1;

            // Create final result.
            $result = StudentVivaResult::create([
                'student_id'      => Auth::id(),
                'subject_id'      => $request->subject_id,
                'attempt_no'      => $attemptNo,
                'total_questions' => $totalQuestions,

                // Main result remains Groq.
                'total_marks' => $groqTotal,
                'max_marks'   => $maxMarks,
                'percentage'  => $groqPercentage,

                // Groq totals.
                'groq_total'      => $groqTotal,
                'groq_percentage' => $groqPercentage,

                // Cloudflare replaces Hugging Face.
                'cloudflare_total'      => $cloudflareTotal,
                'cloudflare_percentage' => $cloudflarePercentage,

                // OpenRouter totals.
                'openrouter_total'      => $openrouterTotal,
                'openrouter_percentage' => $openrouterPercentage,

                'overall_feedback' =>
                    'AI Viva completed successfully using Groq, Cloudflare and OpenRouter.',
            ]);

            // Link all answers to this result.
            StudentAnswer::where(
                'student_id',
                Auth::id()
            )
                ->where('subject_id', $request->subject_id)
                ->update(['result_id' => $result->id]);

            return redirect()
                ->route('student.result.show', $result->id)
                ->with(
                    'success',
                    'Viva completed successfully with Groq, Cloudflare and OpenRouter evaluation.'
                );
        }

        // =====================================================
        // GO TO NEXT QUESTION
        // =====================================================

        return redirect()->route(
            'student.viva.start',
            [
                'subject'  => $request->subject_id,
                'question' => $questions->first()->id,
            ]
        );
    }

    // =========================================================
    // RESULT METHOD
    // =========================================================

    public function result()
    {
        $answers = StudentAnswer::with([
            'question',
            'subject',
        ])
            ->where('student_id', Auth::id())
            ->orderBy('question_id', 'asc')
            ->get();

        $totalQuestions = $answers->count();
        $maxMarks = $totalQuestions * 10;

        $groqTotal = $answers->sum('groq_score');
        $cloudflareTotal = $answers->sum('cloudflare_score');
        $openrouterTotal = $answers->sum('openrouter_score');

        $groqPercentage = $maxMarks > 0
            ? round(($groqTotal / $maxMarks) * 100, 2)
            : 0;

        $cloudflarePercentage = $maxMarks > 0
            ? round(($cloudflareTotal / $maxMarks) * 100, 2)
            : 0;

        $openrouterPercentage = $maxMarks > 0
            ? round(($openrouterTotal / $maxMarks) * 100, 2)
            : 0;

        return view('student.results', compact(
            'answers',
            'totalQuestions',
            'groqTotal',
            'groqPercentage',
            'cloudflareTotal',
            'cloudflarePercentage',
            'openrouterTotal',
            'openrouterPercentage',
            'maxMarks'
        ));
    }
}
