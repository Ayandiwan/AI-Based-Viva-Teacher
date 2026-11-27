@extends('layouts.app')

@section('content')

<div class="container py-5">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            📚 Viva Question Bank
        </h2>

        <a href="{{ route('questions.create') }}" class="btn btn-primary">
            ➕ Add Question
        </a>

    </div>

    @php
        $groupedQuestions = $questions->groupBy('subject_id');
    @endphp

    @forelse($groupedQuestions as $subjectId => $subjectQuestions)

        <div class="card shadow mb-4">

            <div class="card-header table-primary">

                <h4 class="fw-bold mb-0">

                    📖 {{ $subjectQuestions->first()->subject->subject_code }}

                    <br>

                    <small class="text-muted">
                        {{ $subjectQuestions->first()->subject->subject_name }}
                    </small>

                </h4>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-primary">

                            <tr>

                                <th width="60">No</th>

                                <th width="250">Question</th>

                                <th>Expected Answer</th>

                                <th width="120">Difficulty</th>

                                <th width="170">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                        @foreach($subjectQuestions as $key => $question)

                            <tr>

                                <td>
                                    {{ $key + 1 }}
                                </td>

                                <td>
                                    {{ $question->question }}
                                </td>

                                <td>
                                    {{ Str::limit($question->answer, 150) }}
                                </td>

                                <td>

                                    @if($question->difficulty == 'Easy')

                                        <span class="badge bg-success">
                                            Easy
                                        </span>

                                    @elseif($question->difficulty == 'Medium')

                                        <span class="badge bg-warning text-dark">
                                            Medium
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Hard
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('questions.edit', $question->id) }}"
                                       class="btn btn-success btn-sm">

                                        Edit

                                    </a>

                                    <form action="{{ route('questions.destroy', $question->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this question?')">

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    @empty

        <div class="card shadow">

            <div class="card-body text-center">

                No Viva Questions Found.

            </div>

        </div>

    @endforelse

</div>

@endsection