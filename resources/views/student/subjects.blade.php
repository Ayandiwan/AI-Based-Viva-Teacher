@extends('layouts.app')

@section('title', 'AI Viva Teacher')

@section('content')

<style>

    /* ================================
       MAIN PAGE
    ================================= */

    .viva-page {
        min-height: 90vh;
        background: #f5f8fc;
    }


    /* ================================
       COMPACT HERO
    ================================= */

    .viva-hero {
        position: relative;
        overflow: hidden;
        border-radius: 22px;
        background: linear-gradient(135deg, #0d6efd 0%, #084298 100%);
        color: #fff;
        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.16);
    }

    .viva-hero::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
        right: -80px;
        top: -120px;
    }

    .viva-hero::after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        left: -70px;
        bottom: -100px;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }


    /* ================================
       ROBOT
    ================================= */

    .robot-box {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.14);
        font-size: 30px;
        margin-bottom: 12px;
    }


    /* ================================
       HERO TITLE
    ================================= */

    .hero-title {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-bottom: 8px;
    }


    /* ================================
       HERO DESCRIPTION
    ================================= */

    .hero-text {
        max-width: 600px;
        color: rgba(255, 255, 255, 0.82);
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 14px;
    }


    /* ================================
       HERO BADGES
    ================================= */

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        margin: 2px;
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.13);
        border: 1px solid rgba(255, 255, 255, 0.12);
        font-size: 11px;
        font-weight: 600;
    }


    /* ================================
       HERO STUDENT
    ================================= */

    .hero-student {
        text-align: center;
        font-size: 75px;
        line-height: 1;
    }


    /* ================================
       SECTION
    ================================= */

    .section-title {
        color: #172033;
        font-size: 28px;
        font-weight: 800;
    }

    .section-text {
        color: #718096;
    }

    .subject-count {
        background: #e8f1ff;
        color: #0d6efd;
        padding: 10px 17px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 13px;
    }


    /* ================================
       SUBJECT CARD
    ================================= */

    .subject-card {
        height: 100%;
        background: #ffffff;
        border: 1px solid #e8edf5;
        border-radius: 22px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .subject-card:hover {
        transform: translateY(-7px);
        border-color: #cbdcff;
        box-shadow: 0 18px 40px rgba(31, 60, 114, 0.12);
    }

    .subject-top {
        height: 7px;
        background: linear-gradient(90deg, #0d6efd, #6ea8fe);
    }

    .subject-body {
        padding: 25px;
    }


    /* ================================
       SUBJECT ICON
    ================================= */

    .subject-icon {
        width: 62px;
        height: 62px;
        border-radius: 17px;
        background: #edf4ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }


    /* ================================
       AVAILABLE BADGE
    ================================= */

    .available-badge {
        background: #e8f8ef;
        color: #198754;
        padding: 7px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
    }


    /* ================================
       SUBJECT NAME
    ================================= */

    .subject-name {
        font-size: 21px;
        font-weight: 750;
        color: #172033;
        margin-top: 20px;
        margin-bottom: 10px;
    }


    /* ================================
       SUBJECT CODE
    ================================= */

    .subject-code {
        display: inline-block;
        background: #f3f5f8;
        color: #596579;
        border-radius: 8px;
        padding: 7px 12px;
        font-size: 13px;
        font-weight: 700;
    }


    /* ================================
       DESCRIPTION
    ================================= */

    .subject-description {
        min-height: 48px;
        color: #7a8494;
        font-size: 14px;
        line-height: 1.6;
        margin-top: 17px;
        margin-bottom: 20px;
    }


    /* ================================
       START BUTTON
    ================================= */

    .start-button {
        width: 100%;
        border: none;
        border-radius: 13px;
        padding: 13px 18px;
        background: #0d6efd;
        color: #ffffff;
        font-weight: 700;
        transition: all 0.25s ease;
    }

    .start-button:hover {
        background: #084298;
        color: #ffffff;
        transform: translateY(-2px);
    }


    /* ================================
       INFORMATION CARD
    ================================= */

    .info-card {
        background: #ffffff;
        border: 1px solid #e8edf5;
        border-radius: 22px;
        padding: 28px;
    }

    .info-title {
        font-size: 19px;
        font-weight: 800;
        color: #172033;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .info-icon {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        border-radius: 14px;
        background: #edf4ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .info-heading {
        font-weight: 700;
        color: #263247;
        font-size: 14px;
    }

    .info-text {
        color: #7a8494;
        font-size: 12px;
    }


    /* ================================
       EMPTY STATE
    ================================= */

    .empty-card {
        background: #ffffff;
        border: 1px dashed #ccd5e3;
        border-radius: 22px;
        padding: 60px 25px;
        text-align: center;
    }

    .empty-icon {
        font-size: 65px;
        margin-bottom: 15px;
    }


    /* ================================
       TABLET
    ================================= */

    @media (max-width: 991px) {

        .hero-title {
            font-size: 28px;
        }

        .hero-student {
            display: none;
        }

    }


    /* ================================
       MOBILE
    ================================= */

    @media (max-width: 576px) {

        .viva-page {
            padding-top: 20px !important;
        }

        .viva-hero {
            border-radius: 18px;
        }

        .hero-title {
            font-size: 25px;
        }

        .hero-text {
            font-size: 13px;
        }

        .hero-badge {
            font-size: 10px;
            padding: 5px 8px;
        }

        .subject-body {
            padding: 22px;
        }

        .section-title {
            font-size: 24px;
        }

    }

</style>

<div class="viva-page py-5">

<div class="container">


    {{-- ==========================================
         SUCCESS MESSAGE
    =========================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4">

            <strong>✓ Success!</strong>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- ==========================================
         ERROR MESSAGE
    =========================================== --}}

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4">

            <strong>⚠ Error!</strong>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- ==========================================
         HERO SECTION
    =========================================== --}}

    <div class="viva-hero mb-4">

        <div class="hero-content px-4 py-4">

            <div class="row align-items-center">


                {{-- HERO LEFT --}}

                <div class="col-lg-9">

                    <div class="robot-box">
                        🤖
                    </div>

                    <h1 class="hero-title">
                        AI Viva Teacher
                    </h1>

                    <p class="hero-text">
                        Welcome to your AI-powered viva examination.
                        Choose a subject, answer questions using text or voice,
                        and receive intelligent AI-based evaluation.
                    </p>


                    {{-- FEATURES --}}

                    <div>

                        <span class="hero-badge">
                            🎯 AI Evaluation
                        </span>

                        <span class="hero-badge">
                            🎤 Voice Answer
                        </span>

                        <span class="hero-badge">
                            📝 Text Answer
                        </span>

                        <span class="hero-badge">
                            ⏱️ Timed Questions
                        </span>

                    </div>

                </div>


                {{-- HERO RIGHT --}}

                <div class="col-lg-3">

                    <div class="hero-student">
                        🧑‍💻
                    </div>

                    <div class="text-center small opacity-75">
                        Ready?
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ==========================================
         SECTION HEADER
    =========================================== --}}

    <div class="d-flex flex-column flex-md-row
                justify-content-between
                align-items-md-end
                mb-4">

        <div>

            <h2 class="section-title mb-2">
                📚 Choose Your Subject
            </h2>

            <p class="section-text mb-0">
                Select a subject below to start your AI viva examination.
            </p>

        </div>


        <div class="mt-3 mt-md-0">

            <span class="subject-count">
                {{ $subjects->count() }} Subjects Available
            </span>

        </div>

    </div>


    {{-- ==========================================
         SUBJECT CARDS
    =========================================== --}}

    <div class="row g-4">

        @forelse($subjects as $subject)

            <div class="col-md-6 col-xl-4">

                <div class="subject-card">


                    {{-- TOP LINE --}}

                    <div class="subject-top"></div>


                    <div class="subject-body">


                        {{-- ICON + STATUS --}}

                        <div class="d-flex
                                    justify-content-between
                                    align-items-start">

                            <div class="subject-icon">
                                📚
                            </div>

                            <span class="available-badge">
                                ● Available
                            </span>

                        </div>


                        {{-- SUBJECT NAME --}}

                        <h3 class="subject-name">

                            {{ $subject->subject_name }}

                        </h3>


                        {{-- SUBJECT CODE --}}

                        <span class="subject-code">

                            🏷️
                            {{ $subject->subject_code ?? 'No Code' }}

                        </span>


                        {{-- DESCRIPTION --}}

                        @if($subject->description)

                            <p class="subject-description">

                                {{ Str::limit($subject->description, 100) }}

                            </p>

                        @else

                            <p class="subject-description">

                                Test your knowledge with an
                                AI-powered viva examination.

                            </p>

                        @endif


                        <hr class="mb-4">


                        {{-- START BUTTON --}}

                        <a href="{{ route('student.viva.start', $subject->id) }}"
                           class="start-button d-block text-center text-decoration-none">

                            ▶ &nbsp; Start AI Viva

                            <span class="float-end">
                                →
                            </span>

                        </a>


                    </div>

                </div>

            </div>


        @empty


            {{-- ==========================================
                 NO SUBJECTS
            =========================================== --}}

            <div class="col-12">

                <div class="empty-card shadow-sm">

                    <div class="empty-icon">
                        📚
                    </div>

                    <h3 class="fw-bold text-dark">
                        No Subjects Available
                    </h3>

                    <p class="text-muted mb-0">
                        There are currently no subjects available
                        for your viva examination.
                    </p>

                </div>

            </div>


        @endforelse

    </div>


    {{-- ==========================================
         INFORMATION SECTION
    =========================================== --}}

    @if($subjects->count() > 0)

        <div class="info-card shadow-sm mt-5">

            <h3 class="info-title mb-4">
                💡 Before You Start
            </h3>


            <div class="row g-4">


                {{-- AI EVALUATION --}}

                <div class="col-md-4">

                    <div class="info-item">

                        <div class="info-icon">
                            🎯
                        </div>

                        <div>

                            <div class="info-heading">
                                AI Evaluation
                            </div>

                            <div class="info-text">
                                Your answers are evaluated using AI.
                            </div>

                        </div>

                    </div>

                </div>


                {{-- VOICE OR TEXT --}}

                <div class="col-md-4">

                    <div class="info-item">

                        <div class="info-icon">
                            🎤
                        </div>

                        <div>

                            <div class="info-heading">
                                Voice or Text
                            </div>

                            <div class="info-text">
                                Answer questions using voice or text.
                            </div>

                        </div>

                    </div>

                </div>


                {{-- TIMER --}}

                <div class="col-md-4">

                    <div class="info-item">

                        <div class="info-icon">
                            ⏱️
                        </div>

                        <div>

                            <div class="info-heading">
                                Timed Examination
                            </div>

                            <div class="info-text">
                                Manage your time for each question.
                            </div>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    @endif


</div>


</div>

@endsection
