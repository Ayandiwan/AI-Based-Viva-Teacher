<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Models\Subject;
use App\Models\Question;
use App\Models\StudentAnswer;
use App\Models\StudentVivaAttempt;
use App\Models\StudentVivaResult;

use App\Services\OpenRouterService;
use App\Services\CloudflareService;

class StudentVivaController extends Controller
{
    // ======================================================
    // STUDENT SUBJECTS
    // ======================================================

    public function subjects()
    {
        $subjects = Subject::orderBy('subject_name')->get();

        return view('student.subjects', compact('subjects'));
    }

    // ======================================================
    // START VIVA
    // ======================================================

    public function start(Request $request, Subject $subject)
    {
        $attemptedQuestions = StudentVivaAttempt::where(
            'student_id',
            Auth::id()
        )
            ->where('subject_id', $subject->id)
            ->pluck('question_id');

        $questions = Question::where('subject_id', $subject->id)
            ->whereNotIn('id', $attemptedQuestions)
            ->orderBy('id')
            ->get();

        if ($questions->isEmpty()) {
            $existingResult = StudentVivaResult::where(
                'student_id',
                Auth::id()
            )
                ->where('subject_id', $subject->id)
                ->latest()
                ->first();

            if ($existingResult) {
                return redirect()->route(
                    'student.result.show',
                    $existingResult->id
                );
            }

            return redirect()
                ->route('student.subjects')
                ->with(
                    'error',
                    'You have completed all questions for this subject.'
                );
        }

        if ($request->filled('question')) {
            $question = $questions->firstWhere(
                'id',
                $request->question
            );

            if (!$question) {
                $question = $questions->first();
            }
        } else {
            $question = $questions->first();
        }

        $total = Question::where(
            'subject_id',
            $subject->id
        )->count();

        $attempted = StudentVivaAttempt::where(
            'student_id',
            Auth::id()
        )
            ->where('subject_id', $subject->id)
            ->count();

        return view('student.viva', [
            'subject' => $subject,
            'question' => $question,
            'current' => $attempted + 1,
            'total' => $total,
        ]);
    }

    // ======================================================
    // EVALUATE ANSWER
    // GROQ + OPENROUTER + CLOUDFLARE
    // ======================================================

    public function evaluate(
        Request $request,
        OpenRouterService $openrouter,
        CloudflareService $cloudflare
    ) {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|string',
        ]);

        $question = Question::findOrFail($request->question_id);

        $studentAnswer = trim($request->answer);
        $correctAnswer = trim($question->answer);

        // ==================================================
        // COMMON PROMPT FOR GROQ
        // ==================================================

        $prompt = "
You are an AI Viva Examiner.

Evaluate the student's answer based on the question and expected answer.

Question:
{$question->question}

Expected Answer:
{$correctAnswer}

Student Answer:
{$studentAnswer}

Give a score from 0 to 10.

Scoring:
0 = Completely incorrect or irrelevant.
1-3 = Very poor understanding.
4-5 = Partially correct.
6-7 = Good answer.
8-9 = Very good answer.
10 = Excellent and complete answer.

Rules:
- Evaluate meaning and conceptual correctness.
- Do not compare character-by-character.
- Do not require exactly the same words.
- Give credit for correct concepts expressed differently.
- Consider important missing concepts.
- Do not give a high score for factually incorrect answers.
- Use decimal scores when appropriate.
- Do not give full marks for an incomplete answer.
- Keep feedback short and clear.

Return ONLY valid JSON:
{
    \"score\": 0,
    \"feedback\": \"Short explanation of the evaluation\"
}
";

        // ==================================================
        // INITIAL VALUES
        // ==================================================

        $groqScore = null;
        $groqFeedback = null;

        $openrouterScore = null;
        $openrouterFeedback = null;

        $cloudflareScore = null;
        $cloudflareFeedback = null;

        // ==================================================
        // GROQ EVALUATION
        // ==================================================

        try {
            $groqApiKey = config('services.groq.key');

            if (empty($groqApiKey)) {
                $groqFeedback = 'Groq API key is missing.';
            } else {
                $groqResponse = Http::connectTimeout(15)
                    ->timeout(60)
                    ->retry(3, 1000)
                    ->withToken($groqApiKey)
                    ->acceptJson()
                    ->post(
                        'https://api.groq.com/openai/v1/chat/completions',
                        [
                            'model' => 'openai/gpt-oss-20b',
                            'messages' => [
                                [
                                    'role' => 'system',
                                    'content' =>
                                        'You are a strict but fair viva examiner. Return only valid JSON.',
                                ],
                                [
                                    'role' => 'user',
                                    'content' => $prompt,
                                ],
                            ],
                            'temperature' => 0.0,
                            'response_format' => [
                                'type' => 'json_object',
                            ],
                        ]
                    );

                if ($groqResponse->successful()) {
                    $groqData = $this->parseAiJson(
                        $groqResponse->json(
                            'choices.0.message.content'
                        )
                    );

                    if (is_array($groqData)) {
                        $groqScore = $this->validScore(
                            $groqData['score'] ?? null
                        );

                        $groqFeedback = $groqData['feedback']
                            ?? 'No Groq feedback received.';

                        if ($groqScore === null) {
                            $groqFeedback =
                                'Groq did not return a valid score.';
                        }
                    } else {
                        $groqFeedback =
                            'Groq returned invalid JSON.';
                    }
                } else {
                    $groqFeedback = 'Groq API error: HTTP '
                        . $groqResponse->status();

                    Log::warning('Groq evaluation failed', [
                        'status' => $groqResponse->status(),
                    ]);
                }
            }
        } catch (\Throwable $e) {
            $groqScore = null;
            $groqFeedback = 'Groq API request failed.';

            Log::error('Groq evaluation exception', [
                'message' => $e->getMessage(),
            ]);
        }

        // ==================================================
        // OPENROUTER EVALUATION
        // ==================================================

        try {
            $openrouterResponse = $openrouter->evaluateAnswer(
                $question->question,
                $studentAnswer,
                $correctAnswer
            );

            if (is_array($openrouterResponse)) {
                $openrouterData = $openrouterResponse;
            } else {
                $openrouterData = $this->parseAiJson(
                    $openrouterResponse
                );
            }

            if (is_array($openrouterData)) {
                $openrouterScore = $this->validScore(
                    $openrouterData['score'] ?? null
                );

                $openrouterFeedback =
                    $openrouterData['feedback']
                    ?? 'No OpenRouter feedback received.';

                if ($openrouterScore === null) {
                    $openrouterFeedback =
                        'OpenRouter did not return a valid score.';
                }
            } else {
                $openrouterFeedback =
                    'OpenRouter returned invalid JSON.';
            }
        } catch (\Throwable $e) {
            $openrouterScore = null;
            $openrouterFeedback =
                'OpenRouter API request failed.';

            Log::error('OpenRouter evaluation exception', [
                'message' => $e->getMessage(),
            ]);
        }

        // ==================================================
        // CLOUDFLARE WORKERS AI EVALUATION
        // ==================================================

        try {
            $cloudflareResponse = $cloudflare->evaluateAnswer(
                $question->question,
                $studentAnswer,
                $correctAnswer
            );

            if (
                is_array($cloudflareResponse) &&
                isset($cloudflareResponse['concepts']) &&
                is_array($cloudflareResponse['concepts']) &&
                count($cloudflareResponse['concepts']) > 0
            ) {
                $cloudflareScore = $this->validScore(
                    $cloudflareResponse['score'] ?? null
                );

                $cloudflareFeedback =
                    $cloudflareResponse['feedback']
                    ?? 'No Cloudflare feedback received.';

                if ($cloudflareScore === null) {
                    $cloudflareFeedback =
                        'Cloudflare did not return a valid score.';
                }
            } else {
                // An API or parsing error is not a real score of zero.
                $cloudflareScore = null;

                $cloudflareFeedback = is_array($cloudflareResponse)
                    ? (
                        $cloudflareResponse['feedback']
                        ?? 'Cloudflare returned no valid concept evaluation.'
                    )
                    : 'Cloudflare returned an invalid response.';

                Log::warning(
                    'Cloudflare evaluation returned no valid concepts.'
                );
            }
        } catch (\Throwable $e) {
            $cloudflareScore = null;
            $cloudflareFeedback =
                'Cloudflare API request failed.';

            Log::error('Cloudflare evaluation exception', [
                'message' => $e->getMessage(),
            ]);
        }

        // ==================================================
        // MAIN SCORE REMAINS GROQ
        // ==================================================

        $mainScore = $groqScore;
        $mainFeedback = $groqFeedback;

        // ==================================================
        // SAVE STUDENT ANSWER
        // ==================================================

        $answer = StudentAnswer::create([
            'student_id' => Auth::id(),
            'subject_id' => $question->subject_id,
            'question_id' => $question->id,
            'answer_type' => $request->answer_type ?? 'text',
            'answer' => $studentAnswer,
            'correct_answer' => $correctAnswer,

            'marks' => $mainScore ?? 0,
            'ai_score' => $mainScore ?? 0,
            'ai_feedback' => $mainFeedback,
            'feedback' => $mainFeedback,

            // Groq
            'groq_score' => $groqScore,
            'groq_feedback' => $groqFeedback,

            // OpenRouter
            'openrouter_score' => $openrouterScore,
            'openrouter_feedback' => $openrouterFeedback,

            // Cloudflare
            'cloudflare_score' => $cloudflareScore,
            'cloudflare_feedback' => $cloudflareFeedback,
        ]);

        // ==================================================
        // SAVE VIVA ATTEMPT
        // ==================================================

        StudentVivaAttempt::create([
            'student_id' => Auth::id(),
            'subject_id' => $question->subject_id,
            'question_id' => $question->id,
            'student_answer' => $studentAnswer,
            'marks' => $mainScore ?? 0,
            'ai_feedback' => $mainFeedback,
        ]);

        // ==================================================
        // CHECK COMPLETION
        // ==================================================

        $totalQuestions = Question::where(
            'subject_id',
            $question->subject_id
        )->count();

        $attemptedQuestions = StudentVivaAttempt::where(
            'student_id',
            Auth::id()
        )
            ->where('subject_id', $question->subject_id)
            ->count();

        $result = null;

        // ==================================================
        // CREATE FINAL RESULT WHEN ALL QUESTIONS ARE DONE
        // ==================================================

        if ($attemptedQuestions >= $totalQuestions) {
            $answers = StudentAnswer::where(
                'student_id',
                Auth::id()
            )
                ->where('subject_id', $question->subject_id)
                ->whereNull('result_id')
                ->get();

            $existingResult = StudentVivaResult::where(
                'student_id',
                Auth::id()
            )
                ->where('subject_id', $question->subject_id)
                ->latest()
                ->first();

            if (!$existingResult && $answers->count() > 0) {
                $resultQuestions = $answers->count();
                $maxMarks = $resultQuestions * 10;

                // Provider totals
                $groqTotal = $answers->sum(
                    fn ($item) => is_numeric($item->groq_score)
                        ? (float) $item->groq_score
                        : 0
                );

                $openrouterTotal = $answers->sum(
                    fn ($item) => is_numeric($item->openrouter_score)
                        ? (float) $item->openrouter_score
                        : 0
                );

                $cloudflareTotal = $answers->sum(
                    fn ($item) => is_numeric($item->cloudflare_score)
                        ? (float) $item->cloudflare_score
                        : 0
                );

                // Provider percentages
                $groqPercentage = $maxMarks > 0
                    ? round(($groqTotal / $maxMarks) * 100, 2)
                    : 0;

                $openrouterPercentage = $maxMarks > 0
                    ? round(($openrouterTotal / $maxMarks) * 100, 2)
                    : 0;

                $cloudflarePercentage = $maxMarks > 0
                    ? round(($cloudflareTotal / $maxMarks) * 100, 2)
                    : 0;

                $attemptNo = StudentVivaResult::where(
                    'student_id',
                    Auth::id()
                )
                    ->where('subject_id', $question->subject_id)
                    ->count() + 1;

                $result = StudentVivaResult::create([
                    'student_id' => Auth::id(),
                    'subject_id' => $question->subject_id,
                    'attempt_no' => $attemptNo,
                    'total_questions' => $resultQuestions,

                    // Main result remains Groq.
                    'total_marks' => (int) round($groqTotal),
                    'max_marks' => $maxMarks,
                    'percentage' => $groqPercentage,
                    'overall_feedback' =>
                        'AI Viva completed successfully.',

                    // Groq
                    'groq_total' => (int) round($groqTotal),
                    'groq_percentage' => $groqPercentage,

                    // OpenRouter
                    'openrouter_total' => $openrouterTotal,
                    'openrouter_percentage' => $openrouterPercentage,

                    // Cloudflare
                    'cloudflare_total' => $cloudflareTotal,
                    'cloudflare_percentage' => $cloudflarePercentage,
                ]);

                foreach ($answers as $item) {
                    $item->update([
                        'result_id' => $result->id,
                    ]);
                }
            } elseif ($existingResult) {
                $result = $existingResult;
            }
        }

        // ==================================================
        // RETURN JSON TO FRONTEND
        // ==================================================

        return response()->json([
            'success' => true,
            'completed' => $attemptedQuestions >= $totalQuestions,

            'groq' => [
                'score' => $groqScore,
                'feedback' => $groqFeedback,
            ],

            'openrouter' => [
                'score' => $openrouterScore,
                'feedback' => $openrouterFeedback,
            ],

            'cloudflare' => [
                'score' => $cloudflareScore,
                'feedback' => $cloudflareFeedback,
            ],

            'answer_id' => $answer->id,
            'result_id' => $result->id ?? null,
        ]);
    }

    // ======================================================
    // HELPER: PARSE JSON FROM AI
    // ======================================================

    private function parseAiJson($content): ?array
    {
        if (!is_string($content) || trim($content) === '') {
            return null;
        }

        $content = trim($content);

        $content = preg_replace(
            '/^```(?:json)?\s*/i',
            '',
            $content
        );

        $content = preg_replace('/\s*```$/', '', $content);

        $data = json_decode(trim($content), true);

        if (is_array($data)) {
            return $data;
        }

        // Handle text surrounding the JSON object.
        $start = strpos($content, '{');
        $end = strrpos($content, '}');

        if (
            $start !== false &&
            $end !== false &&
            $end >= $start
        ) {
            $data = json_decode(
                substr($content, $start, $end - $start + 1),
                true
            );

            if (is_array($data)) {
                return $data;
            }
        }

        return null;
    }

    // ======================================================
    // HELPER: VALIDATE SCORE
    // ======================================================

    private function validScore($score): ?float
    {
        if (!is_numeric($score)) {
            return null;
        }

        $score = (float) $score;

        if ($score < 0 || $score > 10) {
            return null;
        }

        return round($score, 2);
    }

    // ======================================================
    // FINAL RESULT
    // ======================================================

    public function result()
    {
        $lastAnswer = StudentAnswer::where(
            'student_id',
            Auth::id()
        )
            ->latest()
            ->first();

        if (!$lastAnswer) {
            return redirect()
                ->route('student.subjects')
                ->with('error', 'No viva answers found.');
        }

        $subjectId = $lastAnswer->subject_id;

        $existingResult = StudentVivaResult::where(
            'student_id',
            Auth::id()
        )
            ->where('subject_id', $subjectId)
            ->latest()
            ->first();

        if ($existingResult) {
            return redirect()->route(
                'student.result.show',
                $existingResult->id
            );
        }

        $answers = StudentAnswer::with([
            'question',
            'subject',
        ])
            ->where('student_id', Auth::id())
            ->where('subject_id', $subjectId)
            ->whereNull('result_id')
            ->orderBy('question_id', 'asc')
            ->get();

        if ($answers->isEmpty()) {
            return redirect()
                ->route('student.subjects')
                ->with('error', 'No unanswered viva result found.');
        }

        $totalQuestions = $answers->count();
        $maxMarks = $totalQuestions * 10;

        // Provider totals
        $groqTotal = $answers->sum(
            fn ($answer) => is_numeric($answer->groq_score)
                ? (float) $answer->groq_score
                : 0
        );

        $openrouterTotal = $answers->sum(
            fn ($answer) => is_numeric($answer->openrouter_score)
                ? (float) $answer->openrouter_score
                : 0
        );

        $cloudflareTotal = $answers->sum(
            fn ($answer) => is_numeric($answer->cloudflare_score)
                ? (float) $answer->cloudflare_score
                : 0
        );

        // Provider percentages
        $groqPercentage = $maxMarks > 0
            ? round(($groqTotal / $maxMarks) * 100, 2)
            : 0;

        $openrouterPercentage = $maxMarks > 0
            ? round(($openrouterTotal / $maxMarks) * 100, 2)
            : 0;

        $cloudflarePercentage = $maxMarks > 0
            ? round(($cloudflareTotal / $maxMarks) * 100, 2)
            : 0;

        $attemptNo = StudentVivaResult::where(
            'student_id',
            Auth::id()
        )
            ->where('subject_id', $subjectId)
            ->count() + 1;

        $result = StudentVivaResult::create([
            'student_id' => Auth::id(),
            'subject_id' => $subjectId,
            'attempt_no' => $attemptNo,
            'total_questions' => $totalQuestions,

            // Main result remains Groq.
            'total_marks' => (int) round($groqTotal),
            'max_marks' => $maxMarks,
            'percentage' => $groqPercentage,
            'overall_feedback' =>
                'AI Viva completed successfully.',

            // Groq
            'groq_total' => (int) round($groqTotal),
            'groq_percentage' => $groqPercentage,

            // OpenRouter
            'openrouter_total' => $openrouterTotal,
            'openrouter_percentage' => $openrouterPercentage,

            // Cloudflare
            'cloudflare_total' => $cloudflareTotal,
            'cloudflare_percentage' => $cloudflarePercentage,
        ]);

        foreach ($answers as $item) {
            $item->update([
                'result_id' => $result->id,
            ]);
        }

        return redirect()->route(
            'student.result.show',
            $result->id
        );
    }
}
