@extends('layouts.app')

@section('content')

<style>
    /* PAGE */
    .viva-result-page {
        background: #f4f7fb;
        min-height: calc(100vh - 90px);
    }

    /* HEADER */
    .result-header {
        background: linear-gradient(135deg, #172554, #312e81);
        border-radius: 18px;
        padding: 32px;
        color: white;
        box-shadow: 0 10px 30px rgba(23, 37, 84, 0.18);
    }

    .result-header h2 {
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .result-header p {
        color: #dbeafe;
    }

    /* OVERALL RESULT */
    .overall-card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        background: white;
        box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);
    }

    .overall-header {
        background: linear-gradient(135deg, #1e3a8a, #4338ca);
        color: white;
        padding: 18px 22px;
    }

    .overall-header h5 {
        margin: 0;
        font-weight: 600;
    }

    .overall-body {
        padding: 28px 20px;
    }

    .summary-box {
        padding: 20px;
        border-radius: 14px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        height: 100%;
    }

    .summary-label {
        color: #64748b;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .summary-value {
        font-size: 28px;
        font-weight: 700;
        color: #0f172a;
    }

    .groq-summary {
        border-left: 4px solid #2563eb;
    }

    .cloudflare-summary {
        border-left: 4px solid #f59e0b;
    }

    .openrouter-summary {
        border-left: 4px solid #9333ea;
    }

    .score-badge {
        display: inline-block;
        margin-top: 5px;
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
    }

    .groq-badge {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .cloudflare-badge {
        background: #fef3c7;
        color: #b45309;
    }

    .openrouter-badge {
        background: #f3e8ff;
        color: #7e22ce;
    }

    /* QUESTION CARD */
    .question-card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        background: white;
        box-shadow: 0 8px 25px rgba(15, 23, 42, 0.07);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .question-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.10);
    }

    .question-header {
        background: #172554;
        color: white;
        padding: 16px 22px;
    }

    .question-header strong {
        font-size: 16px;
    }

    .question-body {
        padding: 25px;
    }

    /* CONTENT SECTIONS */
    .content-label {
        font-size: 14px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
    }

    .content-box {
        padding: 15px 17px;
        border-radius: 12px;
        line-height: 1.6;
        border: 1px solid;
        overflow-wrap: anywhere;
    }

    .question-box {
        background: #f1f5f9;
        border-color: #e2e8f0;
        color: #1e293b;
    }

    .student-box {
        background: #fff7ed;
        border-color: #fed7aa;
        color: #7c2d12;
    }

    .correct-box {
        background: #ecfdf5;
        border-color: #a7f3d0;
        color: #065f46;
    }

    /* AI EVALUATION */
    .ai-section {
        margin-top: 25px;
    }

    .ai-card {
        border-radius: 15px;
        overflow: hidden;
        height: 100%;
        background: white;
    }

    .groq-card {
        border: 1px solid #bfdbfe;
    }

    .cloudflare-card {
        border: 1px solid #fde68a;
    }

    .openrouter-card {
        border: 1px solid #d8b4fe;
    }

    .ai-header {
        padding: 15px 18px;
        color: white;
        font-weight: 600;
    }

    .groq-header {
        background: linear-gradient(135deg, #1d4ed8, #2563eb);
    }

    .cloudflare-header {
        background: linear-gradient(135deg, #d97706, #f59e0b);
    }

    .openrouter-header {
        background: linear-gradient(135deg, #7e22ce, #9333ea);
    }

    .ai-body {
        padding: 22px;
    }

    /* SCORE */
    .score-container {
        text-align: center;
        padding: 10px 0 20px;
    }

    .score-number {
        font-size: 38px;
        font-weight: 800;
        line-height: 1;
        overflow-wrap: anywhere;
    }

    .groq-score {
        color: #2563eb;
    }

    .cloudflare-score {
        color: #d97706;
    }

    .openrouter-score {
        color: #9333ea;
    }

    .score-out-of {
        color: #94a3b8;
        font-size: 14px;
        margin-top: 6px;
    }

    /* FEEDBACK */
    .feedback-title {
        font-size: 14px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
    }

    .feedback-box {
        padding: 14px;
        border-radius: 10px;
        background: #f8fafc;
        color: #475569;
        line-height: 1.6;
        font-size: 14px;
        border: 1px solid #e2e8f0;
        overflow-wrap: anywhere;
    }

    /* BUTTON */
    .back-button {
        background: linear-gradient(135deg, #1e3a8a, #4338ca);
        border: none;
        color: white;
        padding: 11px 28px;
        border-radius: 10px;
        font-weight: 600;
        box-shadow: 0 6px 15px rgba(67, 56, 202, 0.20);
        transition: all 0.2s ease;
    }

    .back-button:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 9px 20px rgba(67, 56, 202, 0.28);
    }

    /* RESPONSIVE */
    @media (max-width: 767px) {
        .result-header {
            padding: 24px 18px;
        }

        .result-header h2 {
            font-size: 24px;
        }

        .question-body {
            padding: 18px;
        }

        .overall-body {
            padding: 20px 15px;
        }

        .summary-value {
            font-size: 24px;
        }
    }
</style>

<div class="viva-result-page">
    <div class="container py-5">

        <!-- PAGE HEADER -->
        <div class="result-header text-center mb-4">
            <h2 class="mb-2">AI Viva Final Result</h2>

            <p class="mb-0">
                AI-based evaluation comparison using Groq, Cloudflare and OpenRouter
            </p>
        </div>

        <!-- OVERALL RESULT -->
        <div class="overall-card mb-4">
            <div class="overall-header">
                <h5>Overall Performance</h5>
            </div>

            <div class="overall-body">
                <div class="row g-3">

                    <!-- TOTAL QUESTIONS -->
                    <div class="col-md-3">
                        <div class="summary-box">
                            <div class="summary-label">Total Questions</div>

                            <div class="summary-value">
                                {{ $totalQuestions }}
                            </div>
                        </div>
                    </div>

                    <!-- GROQ -->
                    <div class="col-md-3">
                        <div class="summary-box groq-summary">
                            <div class="summary-label">Groq AI Score</div>

                            <div class="summary-value">
                                {{ $groqTotal }} / {{ $maxMarks }}
                            </div>

                            <span class="score-badge groq-badge">
                                {{ $groqPercentage }}%
                            </span>
                        </div>
                    </div>

                    <!-- CLOUDFLARE -->
                    <div class="col-md-3">
                        <div class="summary-box cloudflare-summary">
                            <div class="summary-label">Cloudflare AI Score</div>

                            <div class="summary-value">
                                {{ $cloudflareTotal }} / {{ $maxMarks }}
                            </div>

                            <span class="score-badge cloudflare-badge">
                                {{ $cloudflarePercentage }}%
                            </span>
                        </div>
                    </div>

                    <!-- OPENROUTER -->
                    <div class="col-md-3">
                        <div class="summary-box openrouter-summary">
                            <div class="summary-label">OpenRouter AI Score</div>

                            <div class="summary-value">
                                {{ $openrouterTotal }} / {{ $maxMarks }}
                            </div>

                            <span class="score-badge openrouter-badge">
                                {{ $openrouterPercentage }}%
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- QUESTION RESULTS -->
        @foreach($answers as $answer)
            <div class="question-card mb-4">

                <!-- QUESTION HEADER -->
                <div class="question-header">
                    <strong>Question {{ $loop->iteration }}</strong>
                </div>

                <div class="question-body">

                    <!-- QUESTION -->
                    <div class="mb-4">
                        <div class="content-label">Question</div>

                        <div class="content-box question-box">
                            {{ $answer->question->question ?? 'Question not found' }}
                        </div>
                    </div>

                    <!-- STUDENT ANSWER -->
                    <div class="mb-4">
                        <div class="content-label">Your Answer</div>

                        <div class="content-box student-box">
                            {{ $answer->answer }}
                        </div>
                    </div>

                    <!-- EXPECTED ANSWER -->
                    <div class="mb-4">
                        <div class="content-label">Expected Answer</div>

                        <div class="content-box correct-box">
                            {{ $answer->correct_answer }}
                        </div>
                    </div>

                    <!-- AI EVALUATIONS -->
                    <div class="ai-section">
                        <div class="row g-4">

                            <!-- GROQ -->
                            <div class="col-lg-4 col-md-6">
                                <div class="ai-card groq-card">

                                    <div class="ai-header groq-header">
                                        🤖 Groq AI Evaluation
                                    </div>

                                    <div class="ai-body">
                                        <div class="score-container">
                                            <div class="score-number groq-score">
                                                {{ $answer->groq_score ?? 'N/A' }}/10
                                            </div>

                                            <div class="score-out-of">AI Score</div>
                                        </div>

                                        <div class="feedback-title">Feedback</div>

                                        <div class="feedback-box">
                                            {!! nl2br(e($answer->groq_feedback ?? 'No feedback available.')) !!}
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- CLOUDFLARE -->
                            <div class="col-lg-4 col-md-6">
                                <div class="ai-card cloudflare-card">

                                    <div class="ai-header cloudflare-header">
                                        ☁️ Cloudflare AI Evaluation
                                    </div>

                                    <div class="ai-body">
                                        <div class="score-container">
                                            <div class="score-number cloudflare-score">
                                                {{ $answer->cloudflare_score ?? 'N/A' }}/10
                                            </div>

                                            <div class="score-out-of">AI Score</div>
                                        </div>

                                        <div class="feedback-title">Feedback</div>

                                        <div class="feedback-box">
                                            {!! nl2br(e($answer->cloudflare_feedback ?? 'No feedback available.')) !!}
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- OPENROUTER -->
                            <div class="col-lg-4 col-md-12">
                                <div class="ai-card openrouter-card">

                                    <div class="ai-header openrouter-header">
                                        🔵 OpenRouter AI Evaluation
                                    </div>

                                    <div class="ai-body">
                                        <div class="score-container">
                                            <div class="score-number openrouter-score">
                                                {{ $answer->openrouter_score ?? 'N/A' }}/10
                                            </div>

                                            <div class="score-out-of">AI Score</div>
                                        </div>

                                        <div class="feedback-title">Feedback</div>

                                        <div class="feedback-box">
                                            {!! nl2br(e($answer->openrouter_feedback ?? 'No feedback available.')) !!}
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        @endforeach

        <!-- BACK BUTTON -->
        <div class="text-center mt-4 mb-3">
            <a href="{{ route('student.subjects') }}" class="btn back-button">
                Back to Subjects
            </a>
        </div>

    </div>
</div>

@endsection
