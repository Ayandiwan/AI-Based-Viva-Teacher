@extends('layouts.app')

@section('title', 'Features - AI Viva Teacher')

@section('content')

<style>
    /* =====================================================
       AI VIVA TEACHER — FEATURES PAGE
    ===================================================== */

    .features-page {
        font-family: 'Inter', sans-serif;
        background: #f8fafc;
        color: #172033;
    }

    /* =====================================================
       HERO
    ===================================================== */

    .fv-hero {
        position: relative;
        overflow: hidden;
        padding: 105px 20px 120px;
        background:
            radial-gradient(circle at 85% 25%, rgba(59,130,246,.18), transparent 28%),
            radial-gradient(circle at 15% 80%, rgba(14,165,233,.10), transparent 25%),
            linear-gradient(135deg, #07152d 0%, #0d2850 55%, #123d6d 100%);
        color: #fff;
    }

    .fv-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        opacity: .08;
        background-image:
            linear-gradient(rgba(255,255,255,.5) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.5) 1px, transparent 1px);
        background-size: 42px 42px;
    }

    .fv-orb {
        position: absolute;
        border-radius: 50%;
        border: 1px solid rgba(147,197,253,.15);
    }

    .fv-orb.one {
        width: 480px;
        height: 480px;
        right: -240px;
        top: -250px;
    }

    .fv-orb.two {
        width: 300px;
        height: 300px;
        left: -170px;
        bottom: -180px;
    }

    .fv-hero-content {
        position: relative;
        z-index: 2;
        max-width: 850px;
        margin: auto;
        text-align: center;
    }

    .fv-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        border: 1px solid rgba(147,197,253,.20);
        border-radius: 50px;
        background: rgba(255,255,255,.07);
        color: #9bd5ff;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 25px;
    }

    .fv-badge-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #60c4ff;
        box-shadow: 0 0 12px rgba(96,196,255,.9);
    }

    .fv-hero h1 {
        margin: 0 auto 22px;
        max-width: 780px;
        font-size: 54px;
        line-height: 1.08;
        font-weight: 800;
        letter-spacing: -2px;
    }

    .fv-hero h1 span {
        color: #66c4ff;
    }

    .fv-hero p {
        max-width: 690px;
        margin: auto;
        color: #b9c9df;
        font-size: 14px;
        line-height: 1.9;
    }

    /* =====================================================
       SECTION HEADER
    ===================================================== */

    .fv-section {
        padding: 90px 20px;
    }

    .fv-heading {
        max-width: 680px;
        margin: 0 auto 55px;
        text-align: center;
    }

    .fv-label {
        margin-bottom: 10px;
        color: #2563eb;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .fv-heading h2 {
        margin: 0 0 13px;
        font-size: 34px;
        font-weight: 800;
        letter-spacing: -1px;
    }

    .fv-heading p {
        margin: 0;
        color: #7d8797;
        font-size: 13px;
        line-height: 1.8;
    }

    /* =====================================================
       FEATURE CARDS
    ===================================================== */

    .fv-card {
        position: relative;
        height: 100%;
        padding: 30px;
        overflow: hidden;
        border: 1px solid #e7ebf2;
        border-radius: 18px;
        background: #fff;
        transition: all .28s ease;
    }

    .fv-card:hover {
        transform: translateY(-7px);
        border-color: #cbdcfb;
        box-shadow: 0 20px 45px rgba(15,23,42,.09);
    }

    .fv-card::after {
        content: "";
        position: absolute;
        width: 130px;
        height: 130px;
        border-radius: 50%;
        right: -75px;
        top: -75px;
        background: #eff6ff;
    }

    .fv-icon {
        position: relative;
        z-index: 2;
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 21px;
        margin-bottom: 22px;
    }

    .fv-card h3 {
        margin: 0 0 10px;
        font-size: 16px;
        font-weight: 750;
        color: #172033;
    }

    .fv-card p {
        margin: 0;
        color: #7d8797;
        font-size: 11px;
        line-height: 1.8;
    }

    .fv-number {
        position: absolute;
        right: 22px;
        bottom: 12px;
        color: #f0f3f8;
        font-size: 42px;
        font-weight: 800;
        line-height: 1;
    }

    /* =====================================================
       WORKFLOW
    ===================================================== */

    .fv-workflow {
        padding: 95px 20px;
        background: #fff;
        border-top: 1px solid #edf1f5;
        border-bottom: 1px solid #edf1f5;
    }

    .fv-step {
        position: relative;
        text-align: center;
    }

    .fv-step-number {
        width: 68px;
        height: 68px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #eff6ff;
        border: 6px solid #fff;
        box-shadow: 0 0 0 1px #d9e3f2;
        color: #2563eb;
        font-size: 20px;
        position: relative;
        z-index: 2;
    }

    .fv-step-line {
        position: absolute;
        top: 34px;
        left: 63%;
        width: 74%;
        height: 1px;
        background: #dbe3ee;
    }

    .fv-step:last-child .fv-step-line {
        display: none;
    }

    .fv-step h4 {
        margin: 20px 0 8px;
        font-size: 14px;
        font-weight: 750;
    }

    .fv-step p {
        max-width: 190px;
        margin: auto;
        color: #8993a1;
        font-size: 10px;
        line-height: 1.7;
    }

    /* =====================================================
       ROLE SECTION
    ===================================================== */

    .fv-role-section {
        padding: 95px 20px;
        background: #f8fafc;
    }

    .fv-role {
        height: 100%;
        padding: 32px;
        border-radius: 18px;
        border: 1px solid #e5eaf1;
        background: #fff;
        transition: .25s;
    }

    .fv-role:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 40px rgba(15,23,42,.07);
    }

    .fv-role-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 19px;
        margin-bottom: 20px;
    }

    .fv-role h3 {
        margin: 0 0 10px;
        font-size: 17px;
        font-weight: 750;
    }

    .fv-role p {
        margin: 0 0 20px;
        color: #7d8797;
        font-size: 11px;
        line-height: 1.75;
    }

    .fv-role ul {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .fv-role li {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        color: #596577;
        font-size: 10px;
    }

    .fv-role li i {
        color: #2563eb;
    }

    /* =====================================================
       AI EVALUATION BANNER
    ===================================================== */

    .fv-ai-section {
        padding: 90px 20px;
        background: #fff;
    }

    .fv-ai-box {
        position: relative;
        overflow: hidden;
        padding: 55px;
        border-radius: 24px;
        background:
            radial-gradient(circle at 90% 20%, rgba(96,165,250,.18), transparent 25%),
            linear-gradient(135deg, #08172f, #123d6d);
        color: white;
    }

    .fv-ai-box::before {
        content: "";
        position: absolute;
        width: 350px;
        height: 350px;
        right: -180px;
        bottom: -210px;
        border-radius: 50%;
        border: 1px solid rgba(147,197,253,.13);
    }

    .fv-ai-content {
        position: relative;
        z-index: 2;
        max-width: 720px;
    }

    .fv-ai-label {
        color: #67c2ff;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .fv-ai-box h2 {
        margin: 0 0 15px;
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -.8px;
    }

    .fv-ai-box p {
        margin: 0 0 28px;
        color: #b9c9dd;
        font-size: 12px;
        line-height: 1.8;
    }

    .fv-ai-points {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .fv-ai-point {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 9px 13px;
        border-radius: 8px;
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.08);
        color: #dce8f5;
        font-size: 10px;
    }

    .fv-ai-point i {
        color: #64c5ff;
    }

    /* =====================================================
       CTA
    ===================================================== */

    .fv-cta {
        padding: 95px 20px;
        text-align: center;
        background: #f8fafc;
    }

    .fv-cta h2 {
        margin: 0 0 15px;
        font-size: 34px;
        font-weight: 800;
        letter-spacing: -1px;
    }

    .fv-cta p {
        max-width: 600px;
        margin: 0 auto 28px;
        color: #7d8797;
        font-size: 13px;
        line-height: 1.8;
    }

    .fv-cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 13px 25px;
        border-radius: 10px;
        background: #2563eb;
        color: #fff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        transition: .25s;
    }

    .fv-cta-btn:hover {
        color: #fff;
        background: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(37,99,235,.22);
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 768px) {

        .fv-hero {
            padding: 75px 20px 85px;
        }

        .fv-hero h1 {
            font-size: 38px;
        }

        .fv-section,
        .fv-workflow,
        .fv-role-section,
        .fv-ai-section,
        .fv-cta {
            padding: 65px 20px;
        }

        .fv-step-line {
            display: none;
        }

        .fv-ai-box {
            padding: 35px 25px;
        }

        .fv-ai-box h2 {
            font-size: 27px;
        }
    }

    @media(max-width: 480px) {

        .fv-hero h1 {
            font-size: 31px;
        }

        .fv-heading h2,
        .fv-cta h2 {
            font-size: 27px;
        }
    }

</style>


<div class="features-page">


    {{-- =================================================
         HERO
    ================================================= --}}

    <section class="fv-hero">

        <div class="fv-orb one"></div>
        <div class="fv-orb two"></div>

        <div class="fv-hero-content">

            <div class="fv-badge">

                <span class="fv-badge-dot"></span>

                AI POWERED VIVA PLATFORM

            </div>

            <h1>

                A Smarter Way to
                <span>Prepare for Viva</span>

            </h1>

            <p>

                AI Based Viva Teacher provides intelligent question
                practice, voice and text answers, automated evaluation,
                detailed feedback and performance tracking in one
                modern learning platform.

            </p>

        </div>

    </section>


    {{-- =================================================
         CORE FEATURES
    ================================================= --}}

    <section class="fv-section">

        <div class="container">

            <div class="fv-heading">

                <div class="fv-label">
                    Core Features
                </div>

                <h2>
                    Everything You Need to Practice Better
                </h2>

                <p>
                    Powerful features designed to make viva preparation
                    more realistic, measurable and effective.
                </p>

            </div>


            <div class="row g-4">


                {{-- 01 --}}

                <div class="col-md-6 col-lg-4">

                    <div class="fv-card">

                        <div class="fv-icon">
                            <i class="bi bi-cpu"></i>
                        </div>

                        <h3>
                            AI Question Generation
                        </h3>

                        <p>
                            Practice with intelligent viva questions
                            based on subjects and available question
                            banks.
                        </p>

                        <span class="fv-number">
                            01
                        </span>

                    </div>

                </div>


                {{-- 02 --}}

                <div class="col-md-6 col-lg-4">

                    <div class="fv-card">

                        <div class="fv-icon">
                            <i class="bi bi-mic"></i>
                        </div>

                        <h3>
                            Voice Answer
                        </h3>

                        <p>
                            Submit answers through voice to simulate
                            a real face-to-face viva examination.
                        </p>

                        <span class="fv-number">
                            02
                        </span>

                    </div>

                </div>


                {{-- 03 --}}

                <div class="col-md-6 col-lg-4">

                    <div class="fv-card">

                        <div class="fv-icon">
                            <i class="bi bi-keyboard"></i>
                        </div>

                        <h3>
                            Text Answer
                        </h3>

                        <p>
                            Provide written answers when text-based
                            communication is more convenient.
                        </p>

                        <span class="fv-number">
                            03
                        </span>

                    </div>

                </div>


                {{-- 04 --}}

                <div class="col-md-6 col-lg-4">

                    <div class="fv-card">

                        <div class="fv-icon">
                            <i class="bi bi-stopwatch"></i>
                        </div>

                        <h3>
                            Smart Timer
                        </h3>

                        <p>
                            Practice within a controlled time limit
                            and develop faster thinking and answering.
                        </p>

                        <span class="fv-number">
                            04
                        </span>

                    </div>

                </div>


                {{-- 05 --}}

                <div class="col-md-6 col-lg-4">

                    <div class="fv-card">

                        <div class="fv-icon">
                            <i class="bi bi-robot"></i>
                        </div>

                        <h3>
                            AI Answer Evaluation
                        </h3>

                        <p>
                            Answers are evaluated using AI to provide
                            marks and meaningful feedback.
                        </p>

                        <span class="fv-number">
                            05
                        </span>

                    </div>

                </div>


                {{-- 06 --}}

                <div class="col-md-6 col-lg-4">

                    <div class="fv-card">

                        <div class="fv-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>

                        <h3>
                            Performance Analytics
                        </h3>

                        <p>
                            Review results, previous attempts and
                            performance information to track progress.
                        </p>

                        <span class="fv-number">
                            06
                        </span>

                    </div>

                </div>


                {{-- 07 --}}

                <div class="col-md-6 col-lg-4">

                    <div class="fv-card">

                        <div class="fv-icon">
                            <i class="bi bi-person-workspace"></i>
                        </div>

                        <h3>
                            Student Dashboard
                        </h3>

                        <p>
                            Manage subjects, viva sessions, results,
                            history and profile information.
                        </p>

                        <span class="fv-number">
                            07
                        </span>

                    </div>

                </div>


                {{-- 08 --}}

                <div class="col-md-6 col-lg-4">

                    <div class="fv-card">

                        <div class="fv-icon">
                            <i class="bi bi-person-video3"></i>
                        </div>

                        <h3>
                            Teacher Dashboard
                        </h3>

                        <p>
                            Manage subjects, questions and review
                            student performance and results.
                        </p>

                        <span class="fv-number">
                            08
                        </span>

                    </div>

                </div>


                {{-- 09 --}}

                <div class="col-md-6 col-lg-4">

                    <div class="fv-card">

                        <div class="fv-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>

                        <h3>
                            Admin Management
                        </h3>

                        <p>
                            Centralized administration for managing
                            users, teachers and platform activities.
                        </p>

                        <span class="fv-number">
                            09
                        </span>

                    </div>

                </div>


            </div>

        </div>

    </section>


    {{-- =================================================
         HOW IT WORKS
    ================================================= --}}

    <section class="fv-workflow">

        <div class="container">

            <div class="fv-heading">

                <div class="fv-label">
                    Simple Process
                </div>

                <h2>
                    How Your Viva Works
                </h2>

                <p>
                    From selecting a subject to receiving your AI result.
                </p>

            </div>


            <div class="row g-4">


                <div class="col-md-3">

                    <div class="fv-step">

                        <div class="fv-step-number">
                            <i class="bi bi-person-plus"></i>
                        </div>

                        <div class="fv-step-line"></div>

                        <h4>
                            Create Account
                        </h4>

                        <p>
                            Register and access your
                            student dashboard.
                        </p>

                    </div>

                </div>


                <div class="col-md-3">

                    <div class="fv-step">

                        <div class="fv-step-number">
                            <i class="bi bi-book"></i>
                        </div>

                        <div class="fv-step-line"></div>

                        <h4>
                            Select Subject
                        </h4>

                        <p>
                            Choose the subject you want
                            to practice.
                        </p>

                    </div>

                </div>


                <div class="col-md-3">

                    <div class="fv-step">

                        <div class="fv-step-number">
                            <i class="bi bi-chat-square-text"></i>
                        </div>

                        <div class="fv-step-line"></div>

                        <h4>
                            Answer Questions
                        </h4>

                        <p>
                            Answer using voice or text
                            within the given time.
                        </p>

                    </div>

                </div>


                <div class="col-md-3">

                    <div class="fv-step">

                        <div class="fv-step-number">
                            <i class="bi bi-award"></i>
                        </div>

                        <h4>
                            Get Result
                        </h4>

                        <p>
                            Receive AI marks, feedback
                            and performance results.
                        </p>

                    </div>

                </div>


            </div>

        </div>

    </section>


    {{-- =================================================
         ROLE BASED PLATFORM
    ================================================= --}}

    <section class="fv-role-section">

        <div class="container">

            <div class="fv-heading">

                <div class="fv-label">
                    Role Based System
                </div>

                <h2>
                    Designed for Every User
                </h2>

                <p>
                    Separate dashboards provide the right tools
                    for students, teachers and administrators.
                </p>

            </div>


            <div class="row g-4">


                {{-- STUDENT --}}

                <div class="col-lg-4">

                    <div class="fv-role">

                        <div class="fv-role-icon">

                            <i class="bi bi-mortarboard"></i>

                        </div>

                        <h3>
                            Student
                        </h3>

                        <p>
                            Practice viva examinations and
                            monitor your learning progress.
                        </p>

                        <ul>

                            <li>
                                <i class="bi bi-check2"></i>
                                Subject selection
                            </li>

                            <li>
                                <i class="bi bi-check2"></i>
                                Voice and text answers
                            </li>

                            <li>
                                <i class="bi bi-check2"></i>
                                AI evaluation
                            </li>

                            <li>
                                <i class="bi bi-check2"></i>
                                Results and history
                            </li>

                        </ul>

                    </div>

                </div>


                {{-- TEACHER --}}

                <div class="col-lg-4">

                    <div class="fv-role">

                        <div class="fv-role-icon">

                            <i class="bi bi-person-video2"></i>

                        </div>

                        <h3>
                            Teacher
                        </h3>

                        <p>
                            Manage academic content and
                            monitor student viva performance.
                        </p>

                        <ul>

                            <li>
                                <i class="bi bi-check2"></i>
                                Subject management
                            </li>

                            <li>
                                <i class="bi bi-check2"></i>
                                Question management
                            </li>

                            <li>
                                <i class="bi bi-check2"></i>
                                Student results
                            </li>

                            <li>
                                <i class="bi bi-check2"></i>
                                Performance monitoring
                            </li>

                        </ul>

                    </div>

                </div>


                {{-- ADMIN --}}

                <div class="col-lg-4">

                    <div class="fv-role">

                        <div class="fv-role-icon">

                            <i class="bi bi-shield-lock"></i>

                        </div>

                        <h3>
                            Administrator
                        </h3>

                        <p>
                            Maintain and control the complete
                            viva management platform.
                        </p>

                        <ul>

                            <li>
                                <i class="bi bi-check2"></i>
                                User management
                            </li>

                            <li>
                                <i class="bi bi-check2"></i>
                                Teacher management
                            </li>

                            <li>
                                <i class="bi bi-check2"></i>
                                System monitoring
                            </li>

                            <li>
                                <i class="bi bi-check2"></i>
                                Platform administration
                            </li>

                        </ul>

                    </div>

                </div>


            </div>

        </div>

    </section>


    {{-- =================================================
         AI EVALUATION
    ================================================= --}}

    <section class="fv-ai-section">

        <div class="container">

            <div class="fv-ai-box">

                <div class="fv-ai-content">

                    <div class="fv-ai-label">
                        Intelligent Evaluation
                    </div>

                    <h2>
                        Turn Every Answer Into Useful Feedback
                    </h2>

                    <p>
                        AI Based Viva Teacher analyzes student answers
                        and provides evaluation information that helps
                        students understand their performance and
                        identify areas for improvement.
                    </p>


                    <div class="fv-ai-points">

                        <div class="fv-ai-point">

                            <i class="bi bi-check-circle"></i>

                            Answer Evaluation

                        </div>

                        <div class="fv-ai-point">

                            <i class="bi bi-check-circle"></i>

                            Marks

                        </div>

                        <div class="fv-ai-point">

                            <i class="bi bi-check-circle"></i>

                            Feedback

                        </div>

                        <div class="fv-ai-point">

                            <i class="bi bi-check-circle"></i>

                            Performance Tracking

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =================================================
         CTA
    ================================================= --}}

    <section class="fv-cta">

        <div class="container">

            <h2>
                Ready to Practice Smarter?
            </h2>

            <p>
                Create your account and start preparing for
                technical viva examinations with AI Based
                Viva Teacher.
            </p>


            <a
                href="{{ route('register') }}"
                class="fv-cta-btn">

                Get Started

                <i class="bi bi-arrow-right"></i>

            </a>

        </div>

    </section>


</div>

@endsection