@extends('layouts.app')

@section('title', 'AI Viva Results History')

@section('content')

<div class="container mt-5">

    <div class="card shadow">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                🤖 AI Viva Results History
            </h3>
        </div>

        <!-- BODY -->
        <div class="card-body">

            @if($results->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <!-- TABLE HEADER -->
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Attempt No</th>
                                <th>Total Questions</th>
                                <th>🤖 Groq Score</th>
                                <th>☁️ Cloudflare Score</th>
                                <th>🌐 OpenRouter Score</th>
                                <th>📊 Average Score</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <!-- TABLE BODY -->
                        <tbody>

                            @foreach($results as $result)

                                @php
                                    // Get the three AI percentages
                                    $groqScore = (float) (
                                        $result->groq_percentage ?? 0
                                    );

                                    $cloudflareScore = (float) (
                                        $result->cloudflare_percentage ?? 0
                                    );

                                    $openrouterScore = (float) (
                                        $result->openrouter_percentage ?? 0
                                    );

                                    // Average of all three AI scores
                                    $averageScore = (
                                        $groqScore +
                                        $cloudflareScore +
                                        $openrouterScore
                                    ) / 3;
                                @endphp

                                <tr>

                                    <!-- NUMBER -->
                                    <td>{{ $loop->iteration }}</td>

                                    <!-- SUBJECT CODE -->
                                    <td>
                                        {{ $result->subject->subject_code ?? 'N/A' }}
                                    </td>

                                    <!-- SUBJECT NAME -->
                                    <td>
                                        {{ $result->subject->subject_name ?? 'N/A' }}
                                    </td>

                                    <!-- ATTEMPT -->
                                    <td>
                                        <span class="badge bg-success">
                                            Attempt {{ $result->attempt_no }}
                                        </span>
                                    </td>

                                    <!-- TOTAL QUESTIONS -->
                                    <td>
                                        {{ $result->total_questions }}
                                    </td>

                                    <!-- GROQ SCORE -->
                                    <td>
                                        <span class="badge bg-primary fs-6">
                                            🤖 {{ number_format($groqScore, 2) }}%
                                        </span>
                                    </td>

                                    <!-- CLOUDFLARE SCORE -->
                                    <td>
                                        <span class="badge bg-warning text-dark fs-6">
                                            ☁️ {{ number_format($cloudflareScore, 2) }}%
                                        </span>
                                    </td>

                                    <!-- OPENROUTER SCORE -->
                                    <td>
                                        <span
                                            class="badge fs-6"
                                            style="background-color: #9333ea;">
                                            🌐 {{ number_format($openrouterScore, 2) }}%
                                        </span>
                                    </td>

                                    <!-- AVERAGE SCORE -->
                                    <td>
                                        <span class="badge bg-dark fs-6">
                                            📊 {{ number_format($averageScore, 2) }}%
                                        </span>
                                    </td>

                                    <!-- DATE -->
                                    <td>
                                        {{ $result->created_at?->format('d-m-Y') ?? 'N/A' }}
                                    </td>

                                    <!-- ACTION -->
                                    <td>
                                        <a
                                            href="{{ route('student.result.show', $result->id) }}"
                                            class="btn btn-info btn-sm text-white">
                                            View Result →
                                        </a>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <!-- NO RESULT -->
                <div class="alert alert-warning text-center">
                    No Viva Result Found.
                </div>

            @endif

            <!-- BACK BUTTON -->
            <div class="text-center mt-4">
                <a
                    href="{{ route('student.dashboard') }}"
                    class="btn btn-secondary">
                    ← Back Dashboard
                </a>
            </div>

        </div>

    </div>

</div>

@endsection
