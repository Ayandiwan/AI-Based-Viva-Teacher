@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')

<div class="container py-5">

    <!-- Welcome Section -->
    <div class="row mb-5">

        <div class="col-12">

            <div class="card border-0 shadow-lg bg-primary text-white rounded-4">

                <div class="card-body p-4">

                    <h2 class="fw-bold">
                        👋 Welcome to AI Based Viva Teacher
                    </h2>

                    <p class="mb-0">
                        Welcome to your AI Viva Dashboard. Select an option below to continue.
                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- Dashboard Options -->

    <div class="row g-4">


        <!-- Start Viva -->

        <div class="col-lg-4 col-md-6">

            <a href="{{ route('student.subjects') }}" class="text-decoration-none">

                <div class="card dashboard-card shadow border-0 h-100">

                    <div class="card-body text-center p-4">

                        <div class="icon bg-primary">
                            🎤
                        </div>

                        <h4 class="mt-3 text-dark">
                            Start Viva
                        </h4>

                        <p class="text-muted">
                            Select subject and start AI viva.
                        </p>

                        <span class="btn btn-primary">
                            Start Now →
                        </span>

                    </div>

                </div>

            </a>

        </div>


        <!-- My Subjects -->

        <div class="col-lg-4 col-md-6">

            <a href="{{ route('student.subjects') }}" class="text-decoration-none">

                <div class="card dashboard-card shadow border-0 h-100">

                    <div class="card-body text-center p-4">

                        <div class="icon bg-success">
                            📚
                        </div>

                        <h4 class="mt-3 text-dark">
                            My Subjects
                        </h4>

                        <p class="text-muted">
                            View available viva subjects.
                        </p>

                        <span class="btn btn-success">
                            View Subjects →
                        </span>

                    </div>

                </div>

            </a>

        </div>


        <!-- Results -->

        <div class="col-lg-4 col-md-6">

            <a href="{{ route('student.results') }}" class="text-decoration-none">

                <div class="card dashboard-card shadow border-0 h-100">

                    <div class="card-body text-center p-4">

                        <div class="icon bg-danger">
                            📊
                        </div>

                        <h4 class="mt-3 text-dark">
                            AI Results
                        </h4>

                        <p class="text-muted">
                            Check marks and AI feedback.
                        </p>

                        <span class="btn btn-danger">
                            View Results →
                        </span>

                    </div>

                </div>

            </a>

        </div>


        <!-- Performance -->

        <div class="col-lg-4 col-md-6">

            <a href="{{ route('student.performance') }}" class="text-decoration-none">

                <div class="card dashboard-card shadow border-0 h-100">

                    <div class="card-body text-center p-4">

                        <div class="icon bg-info">
                            📈
                        </div>

                        <h4 class="mt-3 text-dark">
                            Performance
                        </h4>

                        <p class="text-muted">
                            Analyze your viva performance.
                        </p>

                        <span class="btn btn-info text-white">
                            View Analytics →
                        </span>

                    </div>

                </div>

            </a>

        </div>


        <!-- Profile -->

        <div class="col-lg-4 col-md-6">

            <a href="{{ route('profile.edit') }}" class="text-decoration-none">

                <div class="card dashboard-card shadow border-0 h-100">

                    <div class="card-body text-center p-4">

                        <div class="icon bg-secondary">
                            👤
                        </div>

                        <h4 class="mt-3 text-dark">
                            My Profile
                        </h4>

                        <p class="text-muted">
                            Update your profile information.
                        </p>

                        <span class="btn btn-secondary">
                            Edit Profile →
                        </span>

                    </div>

                </div>

            </a>

        </div>


        <!-- Logout -->

        <div class="col-lg-4 col-md-6">

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button type="submit"
                        class="border-0 bg-transparent p-0 w-100">

                    <div class="card dashboard-card shadow border-0 h-100">

                        <div class="card-body text-center p-4">

                            <div class="icon bg-dark">
                                🚪
                            </div>

                            <h4 class="mt-3 text-dark">
                                Logout
                            </h4>

                            <p class="text-muted">
                                Logout securely from account.
                            </p>

                            <span class="btn btn-dark">
                                Logout →
                            </span>

                        </div>

                    </div>

                </button>

            </form>

        </div>


    </div>

</div>


<!-- Dashboard CSS -->

<style>

    .dashboard-card {

        border-radius: 20px;

        transition: 0.35s;

        cursor: pointer;

    }


    .dashboard-card:hover {

        transform: translateY(-8px);

        box-shadow: 0 20px 35px rgba(0,0,0,.15) !important;

    }


    .icon {

        width: 75px;

        height: 75px;

        border-radius: 50%;

        display: flex;

        justify-content: center;

        align-items: center;

        font-size: 32px;

        color: white;

        margin: auto;

    }


    .bg-primary {

        background: #0d6efd !important;

    }


    .bg-success {

        background: #198754 !important;

    }


    .bg-danger {

        background: #dc3545 !important;

    }


    .bg-info {

        background: #0dcaf0 !important;

    }


    .bg-secondary {

        background: #6c757d !important;

    }


    .bg-dark {

        background: #212529 !important;

    }


</style>


@endsection