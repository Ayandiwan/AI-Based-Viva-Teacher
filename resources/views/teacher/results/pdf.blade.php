<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <title>AI Viva Result Report</title>

    <style>

        @page {
            margin: 25px 25px 30px 25px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #263238;
            background: #ffffff;
            line-height: 1.45;
        }

        /* HEADER */

        .header {
            background: #0b1f3a;
            color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-left {
            width: 70%;
            vertical-align: middle;
        }

        .header-right {
            width: 30%;
            text-align: right;
            vertical-align: middle;
        }

        .brand {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .subtitle {
            font-size: 11px;
            color: #cbd5e1;
            margin-top: 4px;
        }

        .report-badge {
            display: inline-block;
            background: #ffffff;
            color: #0b1f3a;
            padding: 7px 10px;
            border-radius: 5px;
            font-size: 9px;
            font-weight: bold;
        }

        /* SECTION TITLE */

        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #0b1f3a;
            margin-top: 18px;
            margin-bottom: 8px;
            border-left: 4px solid #2563eb;
            padding-left: 8px;
        }

        /* STUDENT INFORMATION */

        .info-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid #dbe3ec;
            border-radius: 7px;
            overflow: hidden;
        }

        .info-table td {
            padding: 9px 10px;
            border-bottom: 1px solid #e5eaf0;
        }

        .info-table tr:last-child td {
            border-bottom: none;
        }

        .info-label {
            width: 18%;
            background: #f3f6fa;
            color: #52606d;
            font-weight: bold;
        }

        .info-value {
            width: 32%;
            color: #172b4d;
            font-weight: 600;
        }

        /* OVERALL VIVA PERFORMANCE */

        .performance-box {
            margin-top: 5px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #f8fafc;
            padding: 12px;
        }

        .performance-title {
            font-size: 12px;
            font-weight: bold;
            color: #0b1f3a;
            margin-bottom: 8px;
        }

        .performance-table {
            width: 100%;
            border-collapse: collapse;
        }

        .performance-table td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
        }

        .performance-table tr:last-child td {
            border-bottom: none;
        }

        .performance-label {
            width: 35%;
            font-weight: bold;
            color: #475569;
            background: #f1f5f9;
        }

        .performance-value {
            color: #0f172a;
            font-weight: bold;
        }

        .groq-value {
            color: #15803d;
        }

        .cloudflare-value {
            color: #a16207;
        }

        .openrouter-value {
            color: #b45309;
        }

        .feedback-value {
            font-weight: normal;
            line-height: 1.5;
        }

        /* ASSESSMENT SUMMARY */

        .summary-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 5px;
            margin-left: -5px;
            margin-right: -5px;
        }

        .summary-card {
            width: 16.66%;
            text-align: center;
            border: 1px solid #dbe3ec;
            border-radius: 7px;
            padding: 12px 5px;
            background: #f8fafc;
        }

        .summary-number {
            font-size: 16px;
            font-weight: bold;
            color: #0b1f3a;
        }

        .summary-label {
            font-size: 7.5px;
            color: #64748b;
            margin-top: 3px;
        }

        /* QUESTION BOX */

        .question-box {
            border: 1px solid #dce4ed;
            border-radius: 7px;
            margin-bottom: 14px;
            page-break-inside: avoid;
        }

        .question-header {
            background: #f3f6fa;
            padding: 9px 11px;
            border-bottom: 1px solid #dce4ed;
        }

        .question-number {
            display: inline-block;
            background: #0b1f3a;
            color: #ffffff;
            padding: 3px 7px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
        }

        .question-text {
            font-size: 11px;
            font-weight: bold;
            color: #172b4d;
            margin-left: 7px;
        }

        .answer-section {
            padding: 10px;
        }

        /* ANSWER TABLE */

        .answer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .answer-table td {
            vertical-align: top;
            padding: 7px;
            border: 1px solid #e1e7ef;
        }

        .answer-label {
            width: 18%;
            background: #f8fafc;
            font-weight: bold;
            color: #475569;
        }

        .answer-content {
            width: 32%;
            color: #334155;
        }

        .no-answer {
            color: #dc2626;
            font-style: italic;
        }

        /* AI EVALUATION */

        .evaluation-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 5px 0;
            margin: 10px -5px 0;
        }

        .evaluation-box {
            width: 33.33%;
            vertical-align: top;
            padding: 9px;
            border-radius: 6px;
        }

        .evaluation-groq {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
        }

        .evaluation-cloudflare {
            background: #fffbeb;
            border: 1px solid #fde68a;
        }

        .evaluation-openrouter {
            background: #fffbeb;
            border: 1px solid #fde68a;
        }

        .evaluation-title {
            font-size: 9px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .evaluation-score {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .groq-score,
        .groq-name {
            color: #15803d;
        }

        .cloudflare-score,
        .cloudflare-name {
            color: #a16207;
        }

        .openrouter-score,
        .openrouter-name {
            color: #b45309;
        }

        .feedback {
            font-size: 8.5px;
            color: #475569;
            line-height: 1.45;
        }

        /* FOOTER */

        .footer {
            margin-top: 25px;
            padding-top: 9px;
            border-top: 1px solid #dbe3ec;
            text-align: center;
            font-size: 8px;
            color: #94a3b8;
        }

    </style>

</head>

<body>

{{-- PROFESSIONAL HEADER --}}

<div class="header">

    <table class="header-table">

        <tr>

            <td class="header-left">

                <div class="brand">
                    AI Viva Teacher
                </div>

                <div class="subtitle">
                    Intelligent Viva Assessment &amp; Evaluation System
                </div>

            </td>

            <td class="header-right">

                <span class="report-badge">
                    VIVA RESULT REPORT
                </span>

            </td>

        </tr>

    </table>

</div>

{{-- STUDENT & VIVA INFORMATION --}}

<div class="section-title">
    Student &amp; Viva Information
</div>

<table class="info-table">

    <tr>

        <td class="info-label">Student Name</td>

        <td class="info-value">
            {{ $result->student->name ?? 'N/A' }}
        </td>

        <td class="info-label">Email</td>

        <td class="info-value">
            {{ $result->student->email ?? 'N/A' }}
        </td>

    </tr>

    <tr>

        <td class="info-label">Subject</td>

        <td class="info-value">

            @if($result->subject && $result->subject->subject_code)
                {{ $result->subject->subject_code }} -
            @endif

            {{ $result->subject->subject_name ?? 'N/A' }}

        </td>

        <td class="info-label">Attempt</td>

        <td class="info-value">
            #{{ $result->attempt_no ?? 1 }}
        </td>

    </tr>

    <tr>

        <td class="info-label">Date &amp; Time</td>

        <td class="info-value">

            {{ $result->created_at
                ? $result->created_at->format('d M Y, h:i A')
                : 'N/A'
            }}

        </td>

        <td class="info-label">Assessment Type</td>

        <td class="info-value">
            AI Based Viva
        </td>

    </tr>

</table>

@php

    /*
    |--------------------------------------------------------------------------
    | Average AI Score
    |--------------------------------------------------------------------------
    */

    $groqPercentage = (float) (
        $result->groq_percentage ?? 0
    );

    $cloudflarePercentage = (float) (
        $result->cloudflare_percentage ?? 0
    );

    $openrouterPercentage = (float) (
        $result->openrouter_percentage ?? 0
    );

    $averageScore = (
        $groqPercentage +
        $cloudflarePercentage +
        $openrouterPercentage
    ) / 3;

@endphp

{{-- OVERALL VIVA PERFORMANCE --}}

<div class="section-title">
    Overall Viva Performance
</div>

<div class="performance-box">

    <div class="performance-title">
        AI Evaluation Summary
    </div>

    <table class="performance-table">

        {{-- GROQ TOTAL SCORE --}}

        <tr>

            <td class="performance-label">
                Groq AI Total Score
            </td>

            <td class="performance-value groq-value">

                {{ number_format($result->groq_total ?? 0, 2) }}
                /
                {{ $result->max_marks ?? 0 }}

            </td>

        </tr>

        {{-- GROQ PERCENTAGE --}}

        <tr>

            <td class="performance-label">
                Groq AI Percentage
            </td>

            <td class="performance-value groq-value">
                {{ number_format($result->groq_percentage ?? 0, 2) }}%
            </td>

        </tr>

        {{-- CLOUDFLARE TOTAL SCORE --}}

        <tr>

            <td class="performance-label">
                Cloudflare AI Total Score
            </td>

            <td class="performance-value cloudflare-value">

                {{ number_format($result->cloudflare_total ?? 0, 2) }}
                /
                {{ $result->max_marks ?? 0 }}

            </td>

        </tr>

        {{-- CLOUDFLARE PERCENTAGE --}}

        <tr>

            <td class="performance-label">
                Cloudflare AI Percentage
            </td>

            <td class="performance-value cloudflare-value">
                {{ number_format($result->cloudflare_percentage ?? 0, 2) }}%
            </td>

        </tr>

        {{-- OPENROUTER TOTAL SCORE --}}

        <tr>

            <td class="performance-label">
                OpenRouter AI Total Score
            </td>

            <td class="performance-value openrouter-value">

                {{ number_format($result->openrouter_total ?? 0, 2) }}
                /
                {{ $result->max_marks ?? 0 }}

            </td>

        </tr>

        {{-- OPENROUTER PERCENTAGE --}}

        <tr>

            <td class="performance-label">
                OpenRouter AI Percentage
            </td>

            <td class="performance-value openrouter-value">
                {{ number_format($result->openrouter_percentage ?? 0, 2) }}%
            </td>

        </tr>

        {{-- OVERALL FEEDBACK --}}

        <tr>

            <td class="performance-label">
                Overall Feedback
            </td>

            <td class="performance-value feedback-value">
                {{ $result->overall_feedback ?? 'No overall feedback available.' }}
            </td>

        </tr>

    </table>

</div>

{{-- ASSESSMENT SUMMARY --}}

<div class="section-title">
    Assessment Summary
</div>

<table class="summary-table">

    <tr>

        {{-- TOTAL QUESTIONS --}}

        <td class="summary-card">

            <div class="summary-number">
                {{ $result->total_questions ?? 0 }}
            </div>

            <div class="summary-label">
                TOTAL QUESTIONS
            </div>

        </td>

        {{-- MAXIMUM SCORE --}}

        <td class="summary-card">

            <div class="summary-number">
                {{ $result->max_marks ?? 0 }}
            </div>

            <div class="summary-label">
                MAXIMUM SCORE
            </div>

        </td>

        {{-- GROQ PERCENTAGE --}}

        <td class="summary-card">

            <div class="summary-number">
                {{ number_format($result->groq_percentage ?? 0, 1) }}%
            </div>

            <div class="summary-label">
                GROQ PERCENTAGE
            </div>

        </td>

        {{-- CLOUDFLARE PERCENTAGE --}}

        <td class="summary-card">

            <div class="summary-number">
                {{ number_format($result->cloudflare_percentage ?? 0, 1) }}%
            </div>

            <div class="summary-label">
                CLOUDFLARE PERCENTAGE
            </div>

        </td>

        {{-- OPENROUTER PERCENTAGE --}}

        <td class="summary-card">

            <div class="summary-number">
                {{ number_format($result->openrouter_percentage ?? 0, 1) }}%
            </div>

            <div class="summary-label">
                OPENROUTER PERCENTAGE
            </div>

        </td>

        {{-- AVERAGE SCORE --}}

        <td class="summary-card">

            <div class="summary-number">
                {{ number_format($averageScore, 1) }}%
            </div>

            <div class="summary-label">
                AVERAGE SCORE
            </div>

        </td>

    </tr>

</table>

{{-- QUESTION-WISE AI EVALUATION --}}

<div class="section-title">
    Question-wise AI Evaluation
</div>

@forelse($result->answers as $answer)

    <div class="question-box">

        {{-- QUESTION HEADER --}}

        <div class="question-header">

            <span class="question-number">
                QUESTION {{ $loop->iteration }}
            </span>

            <span class="question-text">
                {{ $answer->question->question ?? 'Question not available' }}
            </span>

        </div>

        <div class="answer-section">

            {{-- STUDENT ANSWER / EXPECTED ANSWER --}}

            <table class="answer-table">

                <tr>

                    <td class="answer-label">
                        Student Answer
                    </td>

                    <td class="answer-content">

                        @if(!empty($answer->answer))

                            {{ $answer->answer }}

                        @else

                            <span class="no-answer">
                                No answer provided
                            </span>

                        @endif

                    </td>

                    <td class="answer-label">
                        Expected Answer
                    </td>

                    <td class="answer-content">
                        {{ $answer->correct_answer ?? 'Not available' }}
                    </td>

                </tr>

            </table>

            {{-- THREE AI EVALUATIONS --}}

            <table class="evaluation-table">

                <tr>

                    {{-- GROQ --}}

                    <td class="evaluation-box evaluation-groq">

                        <div class="evaluation-title groq-name">
                            GROQ AI EVALUATION
                        </div>

                        <div class="evaluation-score groq-score">

                            Score:
                            {{ number_format($answer->groq_score ?? 0, 2) }}/10

                        </div>

                        <div class="feedback">

                            <strong>Feedback:</strong>

                            {{ $answer->groq_feedback ?? 'No Groq feedback available.' }}

                        </div>

                    </td>

                    {{-- CLOUDFLARE --}}

                    <td class="evaluation-box evaluation-cloudflare">

                        <div class="evaluation-title cloudflare-name">
                            CLOUDFLARE AI EVALUATION
                        </div>

                        <div class="evaluation-score cloudflare-score">

                            Score:
                            {{ number_format($answer->cloudflare_score ?? 0, 2) }}/10

                        </div>

                        <div class="feedback">

                            <strong>Feedback:</strong>

                            {{ $answer->cloudflare_feedback ?? 'No Cloudflare feedback available.' }}

                        </div>

                    </td>

                    {{-- OPENROUTER --}}

                    <td class="evaluation-box evaluation-openrouter">

                        <div class="evaluation-title openrouter-name">
                            OPENROUTER AI EVALUATION
                        </div>

                        <div class="evaluation-score openrouter-score">

                            Score:
                            {{ number_format($answer->openrouter_score ?? 0, 2) }}/10

                        </div>

                        <div class="feedback">

                            <strong>Feedback:</strong>

                            {{ $answer->openrouter_feedback ?? 'No OpenRouter feedback available.' }}

                        </div>

                    </td>

                </tr>

            </table>

        </div>

    </div>

@empty

    <div class="question-box">

        <div class="answer-section">
            No question-wise evaluation data available.
        </div>

    </div>

@endforelse

{{-- FOOTER --}}

<div class="footer">

    AI Viva Teacher

    &nbsp; | &nbsp;

    AI Based Viva Assessment System

    <br>

    This report contains AI-generated evaluation results
    from Groq AI, Cloudflare AI and OpenRouter AI.

</div>

</body>

</html>
