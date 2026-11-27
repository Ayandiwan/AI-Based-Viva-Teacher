@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <!-- Header -->
    <div class="row align-items-center mb-4">

        <div class="col-md-8">

            <h2 class="fw-bold mb-1">
                Welcome,
                {{ Auth::user()->name }}
                👋
            </h2>

            <p class="text-muted mb-0">
                AI Viva Teacher Dashboard
            </p>

        </div>

        <div class="col-md-4 text-md-end">

            <a href="{{ route('subjects.create') }}"
               class="btn btn-primary me-2">

                <i class="bi bi-plus-circle"></i>
                New Subject

            </a>

            <a href="{{ route('questions.create') }}"
               class="btn btn-success">

                <i class="bi bi-plus-circle"></i>
                New Question

            </a>

        </div>

    </div>


    <!-- Statistics -->

    <div class="row g-4 mb-5">

        <!-- Total Subjects -->
        <div class="col-lg-3 col-md-6">

            <div class="card border-0 shadow dashboard-card bg-primary text-white">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h6>Total Subjects</h6>

                            <h2>
                                {{ $totalSubjects ?? 0 }}
                            </h2>

                        </div>

                        <i class="bi bi-book fs-1"></i>

                    </div>

                </div>

            </div>

        </div>


        <!-- Total Questions -->
        <div class="col-lg-3 col-md-6">

            <div class="card border-0 shadow dashboard-card bg-success text-white">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h6>Total Questions</h6>

                            <h2>
                                {{ $totalQuestions ?? 0 }}
                            </h2>

                        </div>

                        <i class="bi bi-patch-question fs-1"></i>

                    </div>

                </div>

            </div>

        </div>


        <!-- Students -->
        <div class="col-lg-3 col-md-6">

            <div class="card border-0 shadow dashboard-card bg-warning text-dark">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h6>Students</h6>

                            <h2>
                                {{ $totalStudents ?? 0 }}
                            </h2>

                        </div>

                        <i class="bi bi-people fs-1"></i>

                    </div>

                </div>

            </div>

        </div>


        <!-- Completed Viva -->
        <div class="col-lg-3 col-md-6">

            <div class="card border-0 shadow dashboard-card bg-danger text-white">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h6>Completed Viva</h6>

                            <h2>
                                {{ $completedViva ?? 0 }}
                            </h2>

                        </div>

                        <i class="bi bi-award fs-1"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- Quick Actions -->

    <div class="row g-4 mb-4">


        <!-- Subjects -->

        <div class="col-lg-3 col-md-6">

            <div class="card shadow border-0 h-100">

                <div class="card-body text-center">

                    <i class="bi bi-book-half text-primary display-4"></i>

                    <h4 class="mt-3">
                        Subjects
                    </h4>

                    <p class="text-muted">
                        Create and manage all subjects.
                    </p>

                    <a href="{{ route('subjects.index') }}"
                       class="btn btn-primary w-100">

                        <i class="bi bi-book"></i>

                        Manage Subjects

                    </a>

                </div>

            </div>

        </div>



        <!-- Questions -->

        <div class="col-lg-3 col-md-6">

            <div class="card shadow border-0 h-100">

                <div class="card-body text-center">

                    <i class="bi bi-question-circle text-success display-4"></i>

                    <h4 class="mt-3">
                        Questions
                    </h4>

                    <p class="text-muted">
                        Add AI viva questions.
                    </p>

                    <a href="{{ route('questions.index') }}"
                       class="btn btn-success w-100">

                        <i class="bi bi-question-circle"></i>

                        Manage Questions

                    </a>

                </div>

            </div>

        </div>



        <!-- Manage Students -->

        <div class="col-lg-3 col-md-6">

            <div class="card shadow border-0 h-100">

                <div class="card-body text-center">

                    <i class="bi bi-people-fill text-warning display-4"></i>

                    <h4 class="mt-3">
                        Students
                    </h4>

                    <p class="text-muted">
                        View and manage students.
                    </p>

                    <a href="{{ route('teacher.students') }}"
                       class="btn btn-warning w-100">

                        <i class="bi bi-people-fill"></i>

                        Manage Students

                    </a>

                </div>

            </div>

        </div>



        <!-- Results -->

        <div class="col-lg-3 col-md-6">

            <div class="card shadow border-0 h-100">

                <div class="card-body text-center">

                    <i class="bi bi-bar-chart text-danger display-4"></i>

                    <h4 class="mt-3">
                        Results
                    </h4>

                    <p class="text-muted">
                        View student performance.
                    </p>

                    <a href="{{ route('teacher.results') }}"
                       class="btn btn-danger w-100">

                        <i class="bi bi-bar-chart-fill"></i>

                        View Student Results

                    </a>

                </div>

            </div>

        </div>

    </div>



    <!-- Recent Data -->

    <div class="row">


        <!-- Recent Subjects -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-book me-2"></i>

                        Recent Subjects

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-hover">

                        <thead>

                        <tr>

                            <th>
                                Subject
                            </th>

                            <th>
                                Created
                            </th>

                        </tr>

                        </thead>


                        <tbody>

                        @forelse($recentSubjects ?? [] as $subject)

                            <tr>

                                <td>
                                    {{ $subject->subject_name }}
                                </td>

                                <td>
                                    {{ $subject->created_at->format('d M Y') }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="2"
                                    class="text-center text-muted">

                                    No Subjects Found

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>



        <!-- Recent Questions -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-question-circle me-2"></i>

                        Recent Questions

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-hover">

                        <thead>

                        <tr>

                            <th>
                                Question
                            </th>

                        </tr>

                        </thead>


                        <tbody>

                        @forelse($recentQuestions ?? [] as $question)

                            <tr>

                                <td>

                                    {{ Str::limit($question->question, 60) }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td class="text-center text-muted">

                                    No Questions Found

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection