@extends('layouts.app')

@section('title', 'Student Viva Result')

@section('content')

<div class="container py-4">

    <div class="card shadow border-0">

        {{-- HEADER --}}

        <div class="card-header bg-primary text-white">

            <div class="d-flex justify-content-between align-items-center">

                <h4 class="mb-0">
                    📊 Student Viva Result
                </h4>

                <a
                    href="{{ route('teacher.results.download', $result->id) }}"
                    class="btn btn-danger">
                    📄 Download PDF
                </a>

            </div>

        </div>

        <div class="card-body">

            {{-- STUDENT INFORMATION --}}

            <div class="row mb-4">

                <div class="col-md-6">

                    <h5>
                        <strong>Student:</strong>
                        {{ $result->student->name }}
                    </h5>

                    <p>
                        <strong>Email:</strong>
                        {{ $result->student->email }}
                    </p>

                </div>

                <div class="col-md-6">

                    <h5>
                        <strong>Subject:</strong>

                        @if($result->subject->subject_code)
                            {{ $result->subject->subject_code }} -
                        @endif

                        {{ $result->subject->subject_name }}
                    </h5>

                    <p>
                        <strong>Date:</strong>

                        {{ $result->created_at->format('d M Y h:i A') }}
                    </p>

                </div>

            </div>

            {{-- SUMMARY --}}

            <div class="row text-center mb-4">

                {{-- TOTAL QUESTIONS --}}

                <div class="col-md-3 mb-3">

                    <div class="card bg-primary text-white h-100">

                        <div class="card-body">

                            <h6>Total Questions</h6>

                            <h3>{{ $result->total_questions }}</h3>

                        </div>

                    </div>

                </div>

                {{-- GROQ --}}

                <div class="col-md-3 mb-3">

                    <div class="card bg-success text-white h-100">

                        <div class="card-body">

                            <h6>Groq Score</h6>

                            <h3>
                                {{ number_format($result->groq_total ?? 0, 2) }}
                                /
                                {{ $result->max_marks }}
                            </h3>

                            <small>
                                {{ number_format($result->groq_percentage ?? 0, 2) }}%
                            </small>

                        </div>

                    </div>

                </div>

                {{-- CLOUDFLARE --}}

                <div class="col-md-3 mb-3">

                    <div class="card bg-warning text-dark h-100">

                        <div class="card-body">

                            <h6>Cloudflare Score</h6>

                            <h3>
                                {{ number_format($result->cloudflare_total ?? 0, 2) }}
                                /
                                {{ $result->max_marks }}
                            </h3>

                            <small>
                                {{ number_format($result->cloudflare_percentage ?? 0, 2) }}%
                            </small>

                        </div>

                    </div>

                </div>

                {{-- OPENROUTER --}}

                <div class="col-md-3 mb-3">

                    <div class="card bg-info text-dark h-100">

                        <div class="card-body">

                            <h6>OpenRouter Score</h6>

                            <h3>
                                {{ number_format($result->openrouter_total ?? 0, 2) }}
                                /
                                {{ $result->max_marks }}
                            </h3>

                            <small>
                                {{ number_format($result->openrouter_percentage ?? 0, 2) }}%
                            </small>

                        </div>

                    </div>

                </div>

            </div>

            {{-- AVERAGE SCORE --}}

            @php

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

            <div class="alert alert-dark text-center mb-4">

                <strong>📊 Average AI Score:</strong>

                {{ number_format($averageScore, 2) }}%

            </div>

            {{-- MAXIMUM SCORE --}}

            <div class="alert alert-secondary text-center mb-4">

                <strong>Maximum Score:</strong>

                {{ $result->max_marks }}

            </div>

            {{-- QUESTION WISE --}}

            <h4 class="mb-3">
                Question Wise AI Evaluation
            </h4>

            @foreach($result->answers as $answer)

                <div class="card mb-4 border-start border-4 border-primary">

                    <div class="card-body">

                        <h5 class="mb-3">
                            Question {{ $loop->iteration }}
                        </h5>

                        {{-- QUESTION --}}

                        <div class="mb-3">

                            <strong>Question:</strong>

                            <p class="mt-1">
                                {{ $answer->question->question ?? 'Question not available.' }}
                            </p>

                        </div>

                        {{-- STUDENT ANSWER --}}

                        <div class="mb-3">

                            <strong>Student Answer:</strong>

                            <p class="mt-1">

                                @if($answer->answer)

                                    {{ $answer->answer }}

                                @else

                                    <span class="text-muted">
                                        No text answer available.
                                    </span>

                                @endif

                            </p>

                        </div>

                        {{-- CORRECT ANSWER --}}

                        <div class="mb-4">

                            <strong>Correct Answer:</strong>

                            <p class="mt-1">
                                {{ $answer->correct_answer ?? 'Not available.' }}
                            </p>

                        </div>

                        {{-- AI MODELS --}}

                        <div class="row">

                            {{-- GROQ --}}

                            <div class="col-md-4 mb-3">

                                <div class="card border-success h-100">

                                    <div class="card-header bg-success text-white">

                                        <h5 class="mb-0">
                                            🤖 Groq AI
                                        </h5>

                                    </div>

                                    <div class="card-body">

                                        <p>

                                            <strong>Score:</strong>

                                            <span class="badge bg-success">
                                                {{ number_format($answer->groq_score ?? 0, 2) }}/10
                                            </span>

                                        </p>

                                        <p class="mb-0">

                                            <strong>Feedback:</strong>

                                            <br>

                                            {{ $answer->groq_feedback ?? 'No Groq feedback available.' }}

                                        </p>

                                    </div>

                                </div>

                            </div>

                            {{-- CLOUDFLARE --}}

                            <div class="col-md-4 mb-3">

                                <div class="card border-warning h-100">

                                    <div class="card-header bg-warning text-dark">

                                        <h5 class="mb-0">
                                            ☁️ Cloudflare AI
                                        </h5>

                                    </div>

                                    <div class="card-body">

                                        <p>

                                            <strong>Score:</strong>

                                            <span class="badge bg-warning text-dark">
                                                {{ number_format($answer->cloudflare_score ?? 0, 2) }}/10
                                            </span>

                                        </p>

                                        <p class="mb-0">

                                            <strong>Feedback:</strong>

                                            <br>

                                            {{ $answer->cloudflare_feedback ?? 'No Cloudflare feedback available.' }}

                                        </p>

                                    </div>

                                </div>

                            </div>

                            {{-- OPENROUTER --}}

                            <div class="col-md-4 mb-3">

                                <div class="card border-info h-100">

                                    <div class="card-header bg-info text-dark">

                                        <h5 class="mb-0">
                                            🌐 OpenRouter AI
                                        </h5>

                                    </div>

                                    <div class="card-body">

                                        <p>

                                            <strong>Score:</strong>

                                            <span class="badge bg-info text-dark">
                                                {{ number_format($answer->openrouter_score ?? 0, 2) }}/10
                                            </span>

                                        </p>

                                        <p class="mb-0">

                                            <strong>Feedback:</strong>

                                            <br>

                                            {{ $answer->openrouter_feedback ?? 'No OpenRouter feedback available.' }}

                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

            {{-- OVERALL FEEDBACK --}}

            <div class="alert alert-success">

                <h5>📝 Overall AI Feedback</h5>

                <p class="mb-0">
                    {{ $result->overall_feedback ?? 'No overall feedback available.' }}
                </p>

            </div>

            {{-- BACK --}}

            <a
                href="{{ route('teacher.results') }}"
                class="btn btn-secondary">
                ← Back to Results
            </a>

        </div>

    </div>

</div>

@endsection
