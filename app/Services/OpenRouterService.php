<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenRouterService
{
    public function evaluateAnswer(
        $question,
        $studentAnswer,
        $correctAnswer
    ) {
        $prompt = $this->buildPrompt(
            $question,
            $studentAnswer,
            $correctAnswer
        );

        try {

            $apiKey = env('OPENROUTER_API_KEY');

            if (empty($apiKey)) {

                Log::error(
                    'OpenRouter API key is missing.'
                );

                return $this->errorResult(
                    'OpenRouter API key is missing.'
                );
            }

            $response = Http::connectTimeout(15)
                ->timeout(60)
                ->retry(2, 1000)
                ->withHeaders([
                    'Authorization' =>
                        'Bearer ' . $apiKey,

                    'Content-Type' =>
                        'application/json',

                    'HTTP-Referer' =>
                        config('app.url'),

                    'X-Title' =>
                        'AI Viva Teacher',
                ])
                ->acceptJson()
                ->post(
                    'https://openrouter.ai/api/v1/chat/completions',
                    [
                        'model' =>
                            'openai/gpt-4o-mini',

                        'messages' => [

                            [
                                'role' => 'system',

                                'content' =>
                                    'You are a strict, fair and consistent AI Viva Examiner. Analyze important concepts carefully. Do not calculate or return a final score. Return only valid JSON.'
                            ],

                            [
                                'role' => 'user',

                                'content' => $prompt
                            ]

                        ],

                        'temperature' => 0.0,

                        'response_format' => [
                            'type' => 'json_object'
                        ]
                    ]
                );

            if (!$response->successful()) {

                Log::error(
                    'OpenRouter API Error',
                    [
                        'status' => $response->status(),
                        'body' => $response->body()
                    ]
                );

                return $this->errorResult(
                    'OpenRouter API error: HTTP ' .
                    $response->status()
                );
            }

            $content = $response->json(
                'choices.0.message.content'
            );

            if (empty($content)) {

                Log::error(
                    'OpenRouter Empty Response',
                    [
                        'response' => $response->body()
                    ]
                );

                return $this->errorResult(
                    'OpenRouter returned an empty response.'
                );
            }

            return $this->parseResult(
                $content,
                'OpenRouter'
            );

        } catch (\Throwable $e) {

            Log::error(
                'OpenRouter Exception',
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            );

            return $this->errorResult(
                'OpenRouter connection failed.'
            );
        }
    }


    /**
     * Build concept-based evaluation prompt
     */
    private function buildPrompt(
        $question,
        $studentAnswer,
        $correctAnswer
    ) {
        return <<<PROMPT
You are a STRICT AI Viva Examiner.

Evaluate the student's answer against the teacher's correct answer.

QUESTION:
$question

TEACHER'S CORRECT ANSWER:
$correctAnswer

STUDENT'S ANSWER:
$studentAnswer


YOUR TASK:

1. Understand exactly what the question asks.

2. Understand the technical meaning of the teacher's answer.

3. Identify the important concepts actually required to answer the question.

4. Compare the student's answer with those important concepts.

5. Evaluate conceptual understanding, NOT exact wording.

6. Return 4 to 6 important concepts.

7. Do NOT calculate or return a numerical score.


IMPORTANT EVALUATION RULES:

- Do NOT compare character-by-character.
- Do NOT compare word-by-word.
- Do NOT require the same sentence as the teacher.
- Different wording with the same technical meaning is correct.
- Accept valid alternative explanations.
- Do NOT penalize spelling mistakes.
- Do NOT penalize grammar mistakes.
- Do NOT penalize capitalization.
- Do NOT penalize punctuation.
- Do NOT penalize minor English mistakes.
- Do NOT reduce marks simply because an answer is short.
- A short answer can be excellent if it correctly contains all important concepts.
- Do NOT give credit merely because keywords appear.
- A keyword counts only when it is technically relevant and correctly used.
- Do NOT assume knowledge that the student did not write.
- Missing important information must be identified.
- Incorrect information must be identified.
- Contradictory information must be identified.
- Do NOT invent information for the student.
- Use the teacher's answer as the main reference.
- Focus only on concepts actually required by the question.


CONCEPT STATUS:

Use ONLY these four statuses:

correct
partial
missing
incorrect


STATUS DEFINITIONS:

correct:
The student's answer clearly demonstrates the concept correctly.

partial:
The student demonstrates part of the concept, but an important part is missing or incomplete.

missing:
The student does not demonstrate the concept.

incorrect:
The student gives technically incorrect or contradictory information about the concept.


IMPORTANT:

Do NOT return a numerical score.

Do NOT return correctness.

Laravel will calculate the final score from your concept statuses.


CONCEPT SELECTION:

Return between 4 and 6 important concepts.

Do not create unnecessary concepts just to increase or decrease the result.

Every concept must be relevant to the question.

Use the teacher's answer as the primary reference.

If several statements describe the same concept, combine them.


EXAMPLE:

Teacher answer:

"Abstraction hides implementation details and shows only the essential functionality. It can be implemented using abstract classes and interfaces."

Student answer:

"Abstraction hides unnecessary details and shows only important functionality."

Expected:

{
    "concepts": [
        {
            "concept": "Hiding implementation details",
            "status": "correct"
        },
        {
            "concept": "Showing essential functionality",
            "status": "correct"
        },
        {
            "concept": "Abstract classes as an implementation mechanism",
            "status": "missing"
        },
        {
            "concept": "Interfaces as an implementation mechanism",
            "status": "missing"
        }
    ],
    "feedback": "The main abstraction concept is correct, but abstract classes and interfaces are not mentioned."
}


RETURN ONLY THIS JSON:

{
    "concepts": [
        {
            "concept": "Important concept",
            "status": "correct"
        }
    ],
    "feedback": "Short explanation"
}

IMPORTANT:

- Return 4 to 6 concepts.
- Status must be exactly one of:
  correct
  partial
  missing
  incorrect
- Do NOT return score.
- Do NOT return correctness.
- Do NOT return Markdown.
- Do NOT return code fences.
- Do NOT return text outside the JSON object.
PROMPT;
    }


    /**
     * Parse concept response
     */
    private function parseResult(
        $content,
        $provider
    ) {
        $content = trim($content);

        /*
         * Remove Markdown code fences
         */
        $content = preg_replace(
            '/^```json\s*/i',
            '',
            $content
        );

        $content = preg_replace(
            '/^```\s*/i',
            '',
            $content
        );

        $content = preg_replace(
            '/\s*```$/',
            '',
            $content
        );

        $content = trim($content);

        /*
         * Find JSON object
         */
        $jsonStart = strpos(
            $content,
            '{'
        );

        $jsonEnd = strrpos(
            $content,
            '}'
        );

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

        $result = json_decode(
            $content,
            true
        );

        if (!is_array($result)) {

            Log::error(
                $provider . ' Invalid JSON',
                [
                    'content' => $content,
                    'json_error' => json_last_error_msg()
                ]
            );

            return $this->errorResult(
                'Invalid JSON response from ' .
                $provider . '.'
            );
        }

        $concepts = $result['concepts'] ?? [];

        if (
            !is_array($concepts) ||
            count($concepts) === 0
        ) {

            Log::error(
                $provider . ' No concepts returned',
                [
                    'content' => $content
                ]
            );

            return $this->errorResult(
                'No concept evaluation received from ' .
                $provider . '.'
            );
        }

        /*
         * Keep only valid concept objects
         */
        $validConcepts = [];

        foreach ($concepts as $concept) {

            if (!is_array($concept)) {
                continue;
            }

            $name = trim(
                (string) (
                    $concept['concept'] ?? ''
                )
            );

            $status = strtolower(
                trim(
                    (string) (
                        $concept['status'] ?? ''
                    )
                )
            );

            if (
                empty($name) ||
                !in_array(
                    $status,
                    [
                        'correct',
                        'partial',
                        'missing',
                        'incorrect'
                    ],
                    true
                )
            ) {
                continue;
            }

            $validConcepts[] = [
                'concept' => $name,
                'status' => $status
            ];
        }

        if (count($validConcepts) === 0) {

            Log::error(
                $provider . ' No valid concepts returned',
                [
                    'content' => $content
                ]
            );

            return $this->errorResult(
                'No valid concept evaluation received from ' .
                $provider . '.'
            );
        }

        /*
         * Maximum 6 concepts
         */
        $validConcepts = array_slice(
            $validConcepts,
            0,
            6
        );

        /*
         * Deterministic Laravel scoring
         *
         * correct   = 1.0
         * partial   = 0.5
         * missing   = 0.0
         * incorrect = 0.0
         */

        $totalConcepts = count(
            $validConcepts
        );

        $conceptPoints = 0.0;

        foreach ($validConcepts as $concept) {

            switch ($concept['status']) {

                case 'correct':

                    $conceptPoints += 1.0;

                    break;

                case 'partial':

                    $conceptPoints += 0.5;

                    break;

                case 'missing':

                    $conceptPoints += 0.0;

                    break;

                case 'incorrect':

                    $conceptPoints += 0.0;

                    break;
            }
        }

        /*
         * Calculate score out of 10
         *
         * NO integer rounding.
         */

        $rawScore = (
            $conceptPoints /
            $totalConcepts
        ) * 10;

        /*
         * Keep 2 decimal places
         */
        $score = round(
            $rawScore,
            2
        );

        /*
         * Keep score between 0 and 10
         */
        $score = max(
            0,
            min(10, $score)
        );

        /*
         * Determine correctness
         */
        if ($score >= 8) {

            $correctness = 'Correct';

        } elseif ($score >= 4) {

            $correctness = 'Partially Correct';

        } else {

            $correctness = 'Wrong';
        }

        /*
         * Feedback
         */
        $feedback = trim(
            (string) (
                $result['feedback'] ??
                'No feedback received.'
            )
        );

        if (empty($feedback)) {

            $feedback = 'No feedback received.';
        }

        /*
         * Return final result
         */
        return [
            'score' => $score,

            'correctness' => $correctness,

            'feedback' => $feedback,

            'concepts' => $validConcepts,

            'raw_score' => $score
        ];
    }


    /**
     * Return error result
     */
    private function errorResult(
        $message
    ) {
        return [
            'score' => 0.00,

            'correctness' => 'Wrong',

            'feedback' => $message,

            'concepts' => [],

            'raw_score' => 0.00
        ];
    }
}

