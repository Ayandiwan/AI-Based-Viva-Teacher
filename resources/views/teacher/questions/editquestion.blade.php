@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <div class="card shadow">

                <div class="card-header bg-success text-white">

                    <h3 class="mb-0">
                        ✏️ Edit Viva Question
                    </h3>

                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ route('questions.update', $question->id) }}">

                        @csrf
                        @method('PUT')

                        <!-- Subject -->

                        <div class="mb-3">

                            <label class="form-label fw-bold">

                                Select Subject

                            </label>

                            <select
                                name="subject_id"
                                class="form-control"
                                required>

                                @foreach($subjects as $subject)

                                    <option
                                        value="{{ $subject->id }}"
                                        {{ $question->subject_id == $subject->id ? 'selected' : '' }}>

                                        {{ $subject->subject_code }}
                                        -
                                        {{ $subject->subject_name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <!-- Question -->

                        <div class="mb-3">

                            <label class="form-label fw-bold">

                                Viva Question

                            </label>

                            <textarea
                                name="question"
                                class="form-control"
                                rows="4"
                                required>{{ old('question', $question->question) }}</textarea>

                        </div>

                        <!-- Expected Answer -->

                        <div class="mb-3">

                            <label class="form-label fw-bold">

                                Expected Answer

                            </label>

                            <textarea
                                name="answer"
                                class="form-control"
                                rows="7"
                                required>{{ old('answer', $question->answer) }}</textarea>

                            <small class="text-muted">
                                AI will compare the student's answer with this expected answer.
                            </small>

                        </div>

                        <!-- Difficulty -->

                        <div class="mb-4">

                            <label class="form-label fw-bold">

                                Difficulty

                            </label>

                            <select
                                name="difficulty"
                                class="form-control"
                                required>

                                <option value="Easy"
                                    {{ $question->difficulty == 'Easy' ? 'selected' : '' }}>
                                    Easy
                                </option>

                                <option value="Medium"
                                    {{ $question->difficulty == 'Medium' ? 'selected' : '' }}>
                                    Medium
                                </option>

                                <option value="Hard"
                                    {{ $question->difficulty == 'Hard' ? 'selected' : '' }}>
                                    Hard
                                </option>

                            </select>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-success">

                            💾 Update Question

                        </button>

                        <a
                            href="{{ route('questions.index') }}"
                            class="btn btn-secondary">

                            Back

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection