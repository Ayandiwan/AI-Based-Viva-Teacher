<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CloudflareService
{
    public function evaluateAnswer(
        $question,
        $studentAnswer,
        $correctAnswer
    ) {
        try {
            $accountId = config('services.cloudflare.account_id');
            $apiToken = config('services.cloudflare.api_token');

            if (empty($accountId) || empty($apiToken)) {
                Log::error('Cloudflare credentials are missing.');

                return $this->errorResult(
                    'Cloudflare credentials are missing.'
                );
            }

            $prompt = $this->buildPrompt(
                $question,
                $studentAnswer,
                $correctAnswer
            );

            $response = Http::connectTimeout(15)
                ->timeout(60)
                ->retry(2, 1000)
                ->withToken($apiToken)
                ->acceptJson()
                ->post(
                    "https://api.cloudflare.com/client/v4/accounts/{$accountId}/ai/run/@cf/meta/llama-3.1-8b-instruct",
                    [
                        'messages' => [
                            [
                                'role' => 'system',
                                'content' =>
                                    'You are a strict, fair AI viva examiner. Return only valid JSON containing concepts and feedback. Do not calculate a numerical score.'
                            ],
                            [
                                'role' => 'user',
                                'content' => $prompt,
                            ],
                        ],
                        'temperature' => 0,
                    ]
                );

            if (!$response->successful()) {
                Log::error('Cloudflare API Error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return $this->errorResult(
                    'Cloudflare API error: HTTP ' .
                    $response->status()
                );
            }

            $content = $response->json('result.response');

            // Some Cloudflare responses may return the content
            // in the OpenAI-compatible choices structure.
            if (is_array($content)) {
                $content = json_encode($content);
            }

            if (empty($content)) {
                $content = $response->json(
                    'result.choices.0.message.content'
                );
            }

            if (!is_string($content) || trim($content) === '') {
                Log::error('Cloudflare returned an empty response.');

                return $this->errorResult(
                    'Cloudflare returned an empty response.'
                );
            }

            return $this->parseResult($content, 'Cloudflare');

        } catch (\Throwable $e) {
            Log::error('Cloudflare Exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return $this->errorResult(
                'Cloudflare connection failed.'
            );
        }
    }

    private function buildPrompt(
        $question,
        $studentAnswer,
        $correctAnswer
    ) {
        return <<<PROMPT
You are a strict AI Viva Examiner.

QUESTION:
{$question}

TEACHER'S CORRECT ANSWER:
{$correctAnswer}

STUDENT'S ANSWER:
{$studentAnswer}

Evaluate the student's technical understanding against the teacher's answer.

Rules:
- Evaluate meaning, not exact wording.
- Do not penalize spelling, grammar, capitalization, or punctuation.
- Do not award credit for irrelevant keyword usage.
- Do not assume knowledge the student did not demonstrate.
- Identify important correct, incomplete, missing, or incorrect concepts.
- Return 4 to 6 relevant concepts when possible.
- Do not return a numerical score.
- Do not return a correctness label.

Use only these statuses:
correct, partial, missing, incorrect

Status meanings:
correct = concept is demonstrated correctly.
partial = concept is partly correct or incomplete.
missing = concept is not demonstrated.
incorrect = concept is technically wrong.

Return ONLY valid JSON in this format:
{
    "concepts": [
        {
            "concept": "Important concept",
            "status": "correct"
        }
    ],
    "feedback": "Short explanation of the answer."
}
PROMPT;
    }

    private function parseResult($content, $provider)
    {
        $content = trim($content);

        // Remove Markdown code fences if present.
        $content = preg_replace('/^```(?:json)?\s*/i', '', $content);
        $content = preg_replace('/\s*```$/', '', $content);
        $content = trim($content);

        // Extract the JSON object if extra text is returned.
        $jsonStart = strpos($content, '{');
        $jsonEnd = strrpos($content, '}');

        if (
            $jsonStart !== false &&
            $jsonEnd !== false &&
            $jsonEnd >= $jsonStart
        ) {
            $content = substr(
                $content,
                $jsonStart,
                $jsonEnd - $jsonStart + 1
            );
        }

        $result = json_decode($content, true);

        if (!is_array($result)) {
            Log::error($provider . ' Invalid JSON', [
                'json_error' => json_last_error_msg(),
                'content' => $content,
            ]);

            return $this->errorResult(
                'Invalid JSON response from ' . $provider . '.'
            );
        }

        $concepts = $result['concepts'] ?? [];

        if (!is_array($concepts)) {
            return $this->errorResult(
                'Invalid concepts response from ' . $provider . '.'
            );
        }

        $validConcepts = [];

        foreach ($concepts as $concept) {
            if (!is_array($concept)) {
                continue;
            }

            $name = trim((string) ($concept['concept'] ?? ''));
            $status = strtolower(
                trim((string) ($concept['status'] ?? ''))
            );

            if (
                $name === '' ||
                !in_array(
                    $status,
                    ['correct', 'partial', 'missing', 'incorrect'],
                    true
                )
            ) {
                continue;
            }

            $validConcepts[] = [
                'concept' => $name,
                'status' => $status,
            ];
        }

        // Prevent an invalid or empty evaluation from receiving
        // a misleading score of zero as if it were a real assessment.
        if (count($validConcepts) === 0) {
            Log::error($provider . ' returned no valid concepts.');

            return $this->errorResult(
                'No valid concept evaluation received from ' .
                $provider . '.'
            );
        }

        $validConcepts = array_slice($validConcepts, 0, 6);

        $points = 0.0;

        foreach ($validConcepts as $concept) {
            if ($concept['status'] === 'correct') {
                $points += 1.0;
            } elseif ($concept['status'] === 'partial') {
                $points += 0.5;
            }
        }

        $score = round(
            ($points / count($validConcepts)) * 10,
            2
        );

        $correctness = $score >= 8
            ? 'Correct'
            : ($score >= 4 ? 'Partially Correct' : 'Wrong');

        $feedback = trim(
            (string) ($result['feedback'] ?? '')
        );

        if ($feedback === '') {
            $feedback = 'No feedback received.';
        }

        return [
            'score' => $score,
            'correctness' => $correctness,
            'feedback' => $feedback,
            'concepts' => $validConcepts,
            'raw_score' => $score,
        ];
    }

    private function errorResult($message)
    {
        return [
            'score' => 0.00,
            'correctness' => 'Wrong',
            'feedback' => $message,
            'concepts' => [],
            'raw_score' => 0.00,
        ];
    }
}
