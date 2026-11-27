@extends('layouts.app')

@section('title', 'AI Results')

@section('content')

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">📊 AI Viva Results</h3>
        </div>

        <div class="card-body">

            @if($results->count())

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>Total Questions</th>
                        <th>Total Marks</th>
                        <th>Percentage</th>
                        <th>Attempt Date</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                @foreach($results as $result)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $result->subject->subject_name }}</td>

                        <td>{{ $result->total_questions }}</td>

                        <td>{{ $result->total_marks }} / {{ $result->max_marks }}</td>

                        <td>{{ $result->percentage }}%</td>

                        <td>{{ $result->created_at->format('d-m-Y') }}</td>

                        <td>
                            <a href="{{ route('student.result.show',$result->id) }}"
                               class="btn btn-sm btn-primary">
                                View
                            </a>
                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

            @else

                <div class="alert alert-warning text-center">

                    No AI Viva Results Found.

                </div>

            @endif

            <div class="text-center mt-4">

                <a href="{{ route('student.dashboard') }}"
                   class="btn btn-secondary">

                    ← Back Dashboard

                </a>

            </div>

        </div>

    </div>

</div>

@endsection