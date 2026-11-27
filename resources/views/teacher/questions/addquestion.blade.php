@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            {{-- Success Message --}}
            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif


            {{-- Validation Errors --}}
            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- Main Card --}}
            <div class="card shadow">

                {{-- Card Header --}}
                <div class="card-header bg-primary text-white">

                    <h3 class="mb-0">
                        ➕ Add Viva Question
                    </h3>

                </div>


                <div class="card-body">

                    <form
                        action="{{ route('questions.store') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf


                        {{-- ========================= --}}
                        {{-- SELECT SUBJECT --}}
                        {{-- ========================= --}}

                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                Select Subject
                            </label>

                            <select
                                name="subject_id"
                                class="form-control"
                                required>

                                <option value="">
                                    -- Select Subject --
                                </option>

                                @foreach($subjects as $subject)

                                    <option
                                        value="{{ $subject->id }}"
                                        {{ old('subject_id') == $subject->id ? 'selected' : '' }}>

                                        {{ $subject->subject_code }}
                                        -
                                        {{ $subject->subject_name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- ========================= --}}
                        {{-- QUESTION TYPE --}}
                        {{-- ========================= --}}

                        <div class="mb-4">

                            <label class="form-label fw-bold">
                                Select Question Type
                            </label>

                            <div class="d-flex gap-4">

                                {{-- Manual --}}
                                <div class="form-check">

                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="question_type"
                                        id="manualQuestion"
                                        value="manual"
                                        {{ old('question_type', 'manual') == 'manual' ? 'checked' : '' }}>

                                    <label
                                        class="form-check-label fw-semibold"
                                        for="manualQuestion">

                                        ✍️ Manual Question

                                    </label>

                                </div>


                                {{-- AI --}}
                                <div class="form-check">

                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="question_type"
                                        id="aiQuestion"
                                        value="ai"
                                        {{ old('question_type') == 'ai' ? 'checked' : '' }}>

                                    <label
                                        class="form-check-label fw-semibold"
                                        for="aiQuestion">

                                        🤖 Generate with AI

                                    </label>

                                </div>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- MANUAL QUESTION SECTION --}}
                        {{-- ================================================= --}}

                        <div id="manualSection">


                            {{-- ========================= --}}
                            {{-- QUESTION --}}
                            {{-- ========================= --}}

                            <div class="mb-3">

                                <label class="form-label fw-bold">
                                    Viva Question
                                </label>

                                <textarea
                                    name="question"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Enter Viva Question">{{ old('question') }}</textarea>

                            </div>


                            {{-- ========================= --}}
                            {{-- EXPECTED ANSWER --}}
                            {{-- ========================= --}}

                            <div class="mb-3">

                                <label class="form-label fw-bold">
                                    Expected Answer
                                </label>

                                <textarea
                                    name="answer"
                                    class="form-control"
                                    rows="7"
                                    placeholder="Enter Expected Answer">{{ old('answer') }}</textarea>

                                <small class="text-muted">

                                    AI will compare the student's answer with this answer.

                                </small>

                            </div>


                            {{-- ========================= --}}
                            {{-- DIFFICULTY --}}
                            {{-- ========================= --}}

                            <div class="mb-4">

                                <label class="form-label fw-bold">
                                    Difficulty Level
                                </label>

                                <select
                                    name="difficulty"
                                    class="form-control">

                                    <option
                                        value="Easy"
                                        {{ old('difficulty') == 'Easy' ? 'selected' : '' }}>

                                        Easy

                                    </option>

                                    <option
                                        value="Medium"
                                        {{ old('difficulty') == 'Medium' ? 'selected' : '' }}>

                                        Medium

                                    </option>

                                    <option
                                        value="Hard"
                                        {{ old('difficulty') == 'Hard' ? 'selected' : '' }}>

                                        Hard

                                    </option>

                                </select>

                            </div>


                            {{-- SAVE MANUAL QUESTION --}}

                            <button
                                type="submit"
                                class="btn btn-success">

                                💾 Save Question

                            </button>

                        </div>


                        {{-- ================================================= --}}
                        {{-- AI QUESTION GENERATION SECTION --}}
                        {{-- ================================================= --}}

                        <div
                            id="aiSection"
                            style="display: none;">

                            <div class="card border-primary mb-4">

                                <div class="card-header bg-light">

                                    <h5 class="mb-0 text-primary fw-bold">

                                        🤖 Generate Questions from File

                                    </h5>

                                </div>


                                <div class="card-body">

                                    <p class="text-muted mb-3">

                                        Upload your study material and AI will analyze
                                        the content to generate viva questions.

                                    </p>


                                    {{-- File Upload --}}

                                    <div class="mb-3">

                                        <label class="form-label fw-bold">

                                            📄 Choose File

                                        </label>

                                        <input
                                            type="file"
                                            name="question_file"
                                            id="question_file"
                                            class="form-control"
                                            accept=".pdf,.docx,.txt">

                                        <small class="text-muted">

                                            Supported formats:
                                            <strong>PDF, DOCX, TXT</strong>

                                        </small>

                                    </div>


                                    {{-- Generate Button --}}

                                    <button
                                        type="submit"
                                        name="generate_ai"
                                        value="1"
                                        class="btn btn-primary">

                                        🤖 Upload & Generate Questions

                                    </button>

                                </div>

                            </div>

                        </div>


                        {{-- ========================= --}}
                        {{-- BACK BUTTON --}}
                        {{-- ========================= --}}

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


{{-- ================================================= --}}
{{-- QUESTION TYPE JAVASCRIPT --}}
{{-- ================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const manualRadio = document.getElementById('manualQuestion');
    const aiRadio = document.getElementById('aiQuestion');

    const manualSection = document.getElementById('manualSection');
    const aiSection = document.getElementById('aiSection');

    function changeQuestionType() {

        if (manualRadio.checked) {

            // Show Manual Section
            manualSection.style.display = 'block';

            // Hide AI Section
            aiSection.style.display = 'none';

        } else if (aiRadio.checked) {

            // Hide Manual Section
            manualSection.style.display = 'none';

            // Show AI Section
            aiSection.style.display = 'block';

        }

    }


    // Manual radio change
    manualRadio.addEventListener('change', function () {

        changeQuestionType();

    });


    // AI radio change
    aiRadio.addEventListener('change', function () {

        changeQuestionType();

    });


    // Run when page loads
    changeQuestionType();

});

</script>


@endsection