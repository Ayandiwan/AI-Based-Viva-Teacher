@extends('layouts.app')

@section('title', 'Student Viva Results')

@section('content')

<style>
    .results-container {
        max-width: 1200px;
        margin: 40px auto;
    }

    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #243b5a;
        margin-bottom: 5px;
    }

    .page-subtitle {
        color: #555;
        font-size: 17px;
        margin-bottom: 28px;
    }

    .subject-card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        margin-bottom: 30px;
    }

    .subject-header {
        background: linear-gradient(90deg, #4f46e5, #6366f1);
        color: white;
        padding: 12px 20px;
        font-size: 20px;
        font-weight: 700;
    }

    .table-wrapper {
        padding: 24px;
        overflow-x: auto;
    }

    .results-table {
        width: 100%;
        min-width: 1250px;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 15px;
    }

    .results-table thead th {
        background: #f1f3f5;
        color: #222;
        font-weight: 700;
        text-align: center;
        vertical-align: middle;
        padding: 14px 10px;
        border: 1px solid #d8d8d8;
        white-space: nowrap;
    }

    .results-table tbody td {
        padding: 15px 10px;
        text-align: center;
        vertical-align: middle;
        border: 1px solid #ddd;
        background: white;
    }

    .results-table tbody tr:hover td {
        background: #f8f9ff;
    }

    .student-name {
        text-align: left !important;
        font-weight: 600;
        color: #333;
        min-width: 130px;
    }

    .score-badge {
        display: inline-block;
        min-width: 85px;
        padding: 7px 10px;
        border-radius: 7px;
        font-weight: 700;
        font-size: 14px;
    }

    .groq-badge {
        background: #20c997;
        color: white;
    }

    .cloudflare-badge {
        background: #facc15;
        color: #111;
    }

    .openrouter-badge {
        background: #ffae00;
        color: #222;
    }

    .percentage-badge {
        display: inline-block;
        min-width: 75px;
        padding: 7px 9px;
        border-radius: 7px;
        font-weight: 700;
        font-size: 14px;
    }

    .percentage-good {
        background: #20c997;
        color: white;
    }

    .percentage-low {
        background: #dc3545;
        color: white;
    }

    .average-badge {
        display: inline-block;
        min-width: 85px;
        padding: 8px 10px;
        border-radius: 8px;
        background: #4f46e5;
        color: white;
        font-weight: 800;
        font-size: 14px;
        box-shadow: 0 3px 8px rgba(79, 70, 229, 0.25);
    }

    .date-column {
        white-space: nowrap;
        line-height: 1.5;
    }

    .action-column {
        min-width: 145px;
        white-space: nowrap;
    }

    .view-btn {
        background: #4f46e5;
        color: white;
        border: none;
        padding: 7px 12px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
        margin-right: 4px;
    }

    .view-btn:hover {
        background: #3730a3;
        color: white;
    }

    .pdf-btn {
        background: #dc3545;
        color: white;
        border: none;
        padding: 7px 12px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
    }

    .pdf-btn:hover {
        background: #b02a37;
        color: white;
    }

    .empty-result {
        text-align: center;
        padding: 35px;
        color: #777;
        font-size: 17px;
    }

    @media (max-width: 768px) {
        .results-container {
            margin: 25px 10px;
        }

        .page-title {
            font-size: 26px;
        }

        .page-subtitle {
            font-size: 15px;
        }

        .table-wrapper {
            padding: 15px;
        }
    }
</style>

<div class="container results-container">

    {{-- PAGE HEADER --}}

    <div class="mb-4">
        <h2 class="page-title">
            📊 Student Viva Results
        </h2>

        <p class="page-subtitle">
            View completed AI viva results subject-wise.
        </p>
    </div>

    {{-- RESULTS --}}

    @forelse($results->groupBy(function($result) {
        return $result->subject->id;
    }) as $subjectId => $subjectResults)

        @php
            $subject = $subjectResults->first()->subject;
        @endphp

        <div class="subject-card">

            {{-- SUBJECT HEADER --}}

            <div class="subject-header">
                📖 {{ $subject->subject_code ?? '' }} -
                {{ $subject->subject_name ?? 'N/A' }}
            </div>

            {{-- TABLE --}}

            <div class="table-wrapper">

                <table class="results-table">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Total<br>Questions</th>
                            <th>Groq<br>Score</th>
                            <th>Cloudflare<br>Score</th>
                            <th>OpenRouter<br>Score</th>
                            <th>Groq %</th>
                            <th>Cloudflare %</th>
                            <th>OpenRouter %</th>
                            <th>📊 Average<br>Score</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($subjectResults as $result)

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

                            <tr>

                                {{-- NUMBER --}}

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                {{-- STUDENT --}}

                                <td class="student-name">
                                    {{ $result->student->name ?? 'N/A' }}
                                </td>

                                {{-- TOTAL QUESTIONS --}}

                                <td>
                                    <strong>
                                        {{ $result->total_questions ?? 0 }}
                                    </strong>
                                </td>

                                {{-- GROQ SCORE --}}

                                <td>
                                    <span class="score-badge groq-badge">
                                        {{ number_format($result->groq_total ?? 0, 2) }}
                                        /
                                        {{ $result->max_marks ?? 0 }}
                                    </span>
                                </td>

                                {{-- CLOUDFLARE SCORE --}}

                                <td>
                                    <span class="score-badge cloudflare-badge">
                                        {{ number_format($result->cloudflare_total ?? 0, 2) }}
                                        /
                                        {{ $result->max_marks ?? 0 }}
                                    </span>
                                </td>

                                {{-- OPENROUTER SCORE --}}

                                <td>
                                    <span class="score-badge openrouter-badge">
                                        {{ number_format($result->openrouter_total ?? 0, 2) }}
                                        /
                                        {{ $result->max_marks ?? 0 }}
                                    </span>
                                </td>

                                {{-- GROQ PERCENTAGE --}}

                                <td>
                                    <span class="percentage-badge {{ $groqPercentage >= 50 ? 'percentage-good' : 'percentage-low' }}">
                                        {{ number_format($groqPercentage, 2) }}%
                                    </span>
                                </td>

                                {{-- CLOUDFLARE PERCENTAGE --}}

                                <td>
                                    <span class="percentage-badge {{ $cloudflarePercentage >= 50 ? 'percentage-good' : 'percentage-low' }}">
                                        {{ number_format($cloudflarePercentage, 2) }}%
                                    </span>
                                </td>

                                {{-- OPENROUTER PERCENTAGE --}}

                                <td>
                                    <span class="percentage-badge {{ $openrouterPercentage >= 50 ? 'percentage-good' : 'percentage-low' }}">
                                        {{ number_format($openrouterPercentage, 2) }}%
                                    </span>
                                </td>

                                {{-- AVERAGE SCORE --}}

                                <td>
                                    <span class="average-badge">
                                        📊 {{ number_format($averageScore, 2) }}%
                                    </span>
                                </td>

                                {{-- DATE --}}

                                <td class="date-column">
                                    {{ \Carbon\Carbon::parse($result->created_at)->format('d') }}
                                    <br>
                                    {{ \Carbon\Carbon::parse($result->created_at)->format('M Y') }}
                                </td>

                                {{-- ACTIONS --}}

                                <td class="action-column">

                                    <a
                                        href="{{ route('teacher.results.show', $result->id) }}"
                                        class="view-btn">
                                        👁 View
                                    </a>

                                    <a
                                        href="{{ route('teacher.results.download', $result->id) }}"
                                        class="pdf-btn">
                                        📄 PDF
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    @empty

        <div class="subject-card">
            <div class="empty-result">
                📭 No student viva results available.
            </div>
        </div>

    @endforelse

</div>

@endsection
