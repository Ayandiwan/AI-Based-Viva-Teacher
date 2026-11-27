@extends('layouts.app')

@section('title', 'Viva Report Details')

@section('content')

<style>

body {
    background: #eef3f8;
}

.details-header {
    background:
        linear-gradient(
            135deg,
            #0f172a,
            #1e3a8a,
            #2563eb
        );

    color: white;

    border-radius: 24px;

    padding: 30px;

    margin-bottom: 25px;

    box-shadow:
        0 20px 45px rgba(0,0,0,.15);
}

.details-card {
    border: none;

    border-radius: 20px;

    background: white;

    box-shadow:
        0 12px 30px rgba(0,0,0,.08);

    overflow: hidden;

    margin-bottom: 25px;
}

.info-box {
    background: #f8fafc;

    border-radius: 15px;

    padding: 20px;

    height: 100%;
}

.info-label {
    color: #64748b;

    font-size: 13px;

    font-weight: 600;
}

.info-value {
    color: #0f172a;

    font-size: 20px;

    font-weight: 700;
}

.question-card {
    border: 1px solid #e2e8f0;

    border-radius: 16px;

    padding: 20px;

    margin-bottom: 15px;
}

.question-number {
    width: 38px;
    height: 38px;

    border-radius: 50%;

    background:
        linear-gradient(
            135deg,
            #2563eb,
            #7c3aed
        );

    color: white;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    font-weight: 700;

    margin-right: 10px;
}

.answer-box {
    background: #f8fafc;

    padding: 15px;

    border-radius: 12px;

    margin-top: 12px;
}

.marks-box {
    background: #eff6ff;

    color: #1d4ed8;

    padding: 8px 14px;

    border-radius: 50px;

    font-weight: 700;
}

.score-big {
    font-size: 38px;

    font-weight: 800;

    color: #2563eb;
}

</style>


<div class="container-fluid py-4">


    <!-- HEADER -->

    <div class="details-header">

        <div class="d-flex
                    justify-content-between
                    align-items-center
                    flex-wrap">

            <div>

                <h2 class="fw-bold mb-2">

                    📋 Viva Report Details

                </h2>

                <p class="mb-0">

                    Complete details of the selected
                    student viva attempt.

                </p>

            </div>


            <a
                href="{{ route('admin.reports') }}"
                class="btn btn-light
                       rounded-pill
                       px-4">

                ← Back to Reports

            </a>

        </div>

    </div>



    <!-- SUMMARY -->

    <div class="card details-card">

        <div class="card-body p-4">

            <div class="row g-4">


                <!-- STUDENT -->

                <div class="col-lg-3 col-md-6">

                    <div class="info-box">

                        <div class="info-label">
                            STUDENT
                        </div>

                        <div class="info-value">

                            {{ $first->student->name
                                ?? 'N/A' }}

                        </div>

                    </div>

                </div>


                <!-- SUBJECT -->

                <div class="col-lg-3 col-md-6">

                    <div class="info-box">

                        <div class="info-label">
                            SUBJECT
                        </div>

                        <div class="info-value">

                            {{ $first->subject->subject_name
                                ?? 'N/A' }}

                        </div>

                    </div>

                </div>


                <!-- QUESTIONS -->

                <div class="col-lg-3 col-md-6">

                    <div class="info-box">

                        <div class="info-label">
                            TOTAL QUESTIONS
                        </div>

                        <div class="info-value">

                            {{ $totalQuestions }}

                        </div>

                    </div>

                </div>


                <!-- SCORE -->

                <div class="col-lg-3 col-md-6">

                    <div class="info-box">

                        <div class="info-label">
                            FINAL SCORE
                        </div>

                        <div class="score-big">

                            {{ $totalMarks }}/{{ $totalPossibleMarks }}

                        </div>

                        <span class="text-muted">

                            {{ number_format(
                                $percentage,
                                2
                            ) }}%

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- QUESTIONS -->

    <div class="card details-card">

        <div class="card-header bg-white p-4">

            <h4 class="fw-bold mb-1">

                📝 Question-wise Performance

            </h4>

            <small class="text-muted">

                Answers and marks awarded for this
                viva attempt.

            </small>

        </div>


        <div class="card-body p-4">

            @forelse($answers as $index => $answer)

                <div class="question-card">


                    <div class="d-flex
                                justify-content-between
                                align-items-center
                                flex-wrap">

                        <div>

                            <span class="question-number">

                                {{ $index + 1 }}

                            </span>


                            <strong>

                                @if($answer->question)

                                    {{ $answer->question->question }}

                                @else

                                    Question {{ $index + 1 }}

                                @endif

                            </strong>

                        </div>


                        <span class="marks-box">

                            {{ $answer->marks ?? 0 }}/10

                        </span>

                    </div>



                    <div class="answer-box">

                        <small class="text-muted">

                            Student Answer

                        </small>

                        <div class="mt-2">

                            {{ $answer->answer
                                ?? $answer->student_answer
                                ?? 'No answer provided.' }}

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center py-5">

                    <div style="font-size:50px;">
                        📊
                    </div>

                    <h5>
                        No Answers Found
                    </h5>

                </div>

            @endforelse

        </div>

    </div>



    <!-- FOOTER -->

    <div class="text-center text-muted py-3">

        <small>

            AI Viva Teacher • Admin Reporting System

        </small>

    </div>

</div>

@endsection