@extends('layouts.app')

@section('title', 'Add Subject')

@section('content')

<style>
    .subject-page {
        min-height: calc(100vh - 80px);
        padding: 45px 15px;
        background: #f8fafc;
    }

    .subject-card {
        max-width: 750px;
        margin: auto;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,.10);
    }

    .subject-header {
        padding: 25px 30px;
        color: white;
        background: linear-gradient(135deg, #4f46e5, #2563eb);
    }

    .subject-header h3 {
        margin: 0;
        font-weight: 700;
    }

    .subject-header p {
        margin: 5px 0 0;
        font-size: 14px;
        opacity: .9;
    }

    .subject-body {
        padding: 30px;
    }

    .form-label {
        font-weight: 600;
        color: #1e293b;
    }

    .form-control {
        border-radius: 12px;
        border: 1px solid #dbe2ea;
        padding: 12px 15px;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99,102,241,.12);
    }

    .btn-save {
        background: linear-gradient(135deg, #4f46e5, #2563eb);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 11px 20px;
        font-weight: 600;
    }

    .btn-save:hover {
        color: white;
        transform: translateY(-1px);
    }

    .btn-back {
        border-radius: 10px;
        padding: 10px 20px;
    }
</style>

<div class="subject-page">

    <div class="subject-card">

        <!-- Header -->
        <div class="subject-header">

            <h3>📚 Add New Subject</h3>

            <p>Create a subject for AI Viva questions.</p>

        </div>

        <!-- Body -->
        <div class="subject-body">

            @if ($errors->any())

                <div class="alert alert-danger">

                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach

                </div>

            @endif

            <form action="{{ route('subjects.store') }}" method="POST">

                @csrf

                <!-- Subject Name -->
                <div class="mb-4">

                    <label class="form-label">
                        Subject Name <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="subject_name"
                        class="form-control"
                        value="{{ old('subject_name') }}"
                        placeholder="Example: Artificial Intelligence"
                        required>

                </div>

                <!-- Subject Code -->
                <div class="mb-4">

                    <label class="form-label">
                        Subject Code <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="subject_code"
                        class="form-control"
                        value="{{ old('subject_code') }}"
                        placeholder="Example: AIT701"
                        maxlength="50"
                        required>

                    <small class="text-muted">
                        Enter a unique subject code, e.g. AIT701.
                    </small>

                </div>

                <!-- Description -->
                <div class="mb-4">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"
                        placeholder="Enter subject description">{{ old('description') }}</textarea>

                </div>

                <!-- Buttons -->
                <div class="d-flex gap-2">

                    <button type="submit" class="btn-save">
                        💾 Save Subject
                    </button>

                    <a
                        href="{{ route('subjects.index') }}"
                        class="btn btn-secondary btn-back">

                        ← Back

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection