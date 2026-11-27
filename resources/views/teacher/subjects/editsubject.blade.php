@extends('layouts.app')

@section('title', 'Edit Subject')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        ✏️ Edit Subject
                    </h4>
                </div>

                <div class="card-body">

                    <p class="text-muted">
                        Update the subject information below.
                    </p>

                    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                Subject Name <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="subject_name"
                                class="form-control"
                                value="{{ old('subject_name', $subject->subject_name) }}"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                Subject Code <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="subject_code"
                                class="form-control"
                                value="{{ old('subject_code', $subject->subject_code) }}"
                                maxlength="50"
                                required>

                            <small class="text-muted">
                                Enter a unique code for this subject.
                                Example: CS101, PHP101, AIT201
                            </small>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="4">{{ old('description', $subject->description) }}</textarea>

                        </div>

                        <div class="d-flex gap-2">

                            <button type="submit" class="btn btn-success">
                                ✓ Update Subject
                            </button>

                            <a href="{{ route('subjects.index') }}"
                               class="btn btn-secondary">
                                ← Back
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection