@extends('layouts.app')

@section('title', 'AI Viva Teacher')

@section('content')

<style>

/* =========================================================
   AI VIVA TEACHER - PREMIUM HOME PAGE
========================================================= */

:root {
    --navy: #07111f;
    --navy-2: #0b1930;
    --navy-3: #111f3d;

    --primary: #4f46e5;
    --primary-dark: #3730a3;

    --cyan: #06b6d4;
    --cyan-light: #67e8f9;

    --violet: #8b5cf6;

    --text-dark: #0f172a;
    --text: #334155;
    --muted: #64748b;

    --light: #f8fafc;
    --border: #e2e8f0;

    --success: #10b981;
}


/* =========================================================
   GLOBAL
========================================================= */

.ai-home {
    font-family: 'Poppins', sans-serif;
    color: var(--text-dark);
    overflow: hidden;
}


/* =========================================================
   HERO
========================================================= */

.ai-hero {

    position: relative;
    overflow: hidden;

    padding: 85px 0 95px;

    background:
        radial-gradient(
            circle at 85% 20%,
            rgba(79,70,229,.18),
            transparent 28%
        ),
        radial-gradient(
            circle at 15% 85%,
            rgba(6,182,212,.14),
            transparent 25%
        ),
        linear-gradient(
            135deg,
            #f8fbff 0%,
            #eef2ff 50%,
            #f0f9ff 100%
        );
}


/* Background Glow */

.ai-hero::before {

    content: "";

    position: absolute;

    width: 600px;
    height: 600px;

    border-radius: 50%;

    right: -220px;
    top: -260px;

    background:
        radial-gradient(
            circle,
            rgba(79,70,229,.12),
            transparent 65%
        );
}


.ai-hero::after {

    content: "";

    position: absolute;

    width: 350px;
    height: 350px;

    border-radius: 50%;

    left: -180px;
    bottom: -180px;

    background:
        radial-gradient(
            circle,
            rgba(6,182,212,.12),
            transparent 65%
        );
}


.hero-content {

    position: relative;

    z-index: 3;
}


/* =========================================================
   BADGE
========================================================= */

.hero-badge {

    display: inline-flex;

    align-items: center;

    gap: 9px;

    padding: 10px 18px;

    border-radius: 50px;

    color: #4338ca;

    background:
        rgba(255,255,255,.75);

    border: 1px solid #c7d2fe;

    box-shadow:
        0 8px 25px rgba(79,70,229,.08);

    font-size: 13px;

    font-weight: 600;

    margin-bottom: 25px;

    backdrop-filter: blur(10px);
}


.hero-badge i {

    color: var(--violet);

    font-size: 16px;
}


/* =========================================================
   HERO TITLE
========================================================= */

.hero-title {

    font-size: 62px;

    line-height: 1.05;

    font-weight: 800;

    letter-spacing: -2.5px;

    color: #0b1220;

    margin-bottom: 25px;
}


.hero-title span {

    background:
        linear-gradient(
            90deg,
            #4f46e5,
            #2563eb,
            #06b6d4
        );

    -webkit-background-clip: text;

    -webkit-text-fill-color: transparent;
}


/* =========================================================
   DESCRIPTION
========================================================= */

.hero-description {

    max-width: 610px;

    font-size: 16px;

    line-height: 1.85;

    color: #64748b;

    margin-bottom: 32px;
}


/* =========================================================
   BUTTONS
========================================================= */

.hero-buttons {

    display: flex;

    flex-wrap: wrap;

    gap: 14px;
}


.btn-start {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    padding: 15px 27px;

    border-radius: 13px;

    color: white;

    text-decoration: none;

    font-size: 14px;

    font-weight: 600;

    background:
        linear-gradient(
            135deg,
            #4f46e5,
            #2563eb
        );

    box-shadow:
        0 12px 30px rgba(79,70,229,.25);

    transition: all .3s ease;
}


.btn-start:hover {

    color: white;

    transform: translateY(-3px);

    box-shadow:
        0 18px 38px rgba(79,70,229,.32);
}


.btn-feature {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    padding: 15px 27px;

    border-radius: 13px;

    color: #3730a3;

    background: rgba(255,255,255,.85);

    border: 1px solid #cbd5e1;

    text-decoration: none;

    font-size: 14px;

    font-weight: 600;

    transition: all .3s ease;
}


.btn-feature:hover {

    color: #3730a3;

    border-color: #818cf8;

    background: white;

    transform: translateY(-3px);

    box-shadow:
        0 12px 25px rgba(15,23,42,.08);
}


/* =========================================================
   TRUST POINTS
========================================================= */

.trust-points {

    display: flex;

    flex-wrap: wrap;

    gap: 22px;

    margin-top: 27px;
}


.trust-point {

    color: #64748b;

    font-size: 12px;

    font-weight: 500;
}


.trust-point i {

    color: #10b981;

    margin-right: 5px;
}


/* =========================================================
   HERO VISUAL
========================================================= */

.hero-visual {

    position: relative;

    z-index: 3;

    padding-left: 35px;
}


/* Main image container */

.image-wrapper {

    position: relative;

    padding: 11px;

    border-radius: 25px;

    background:
        linear-gradient(
            135deg,
            rgba(255,255,255,.95),
            rgba(255,255,255,.65)
        );

    border: 1px solid rgba(255,255,255,.9);

    box-shadow:
        0 35px 80px rgba(15,23,42,.16),
        0 10px 30px rgba(79,70,229,.10);

    backdrop-filter: blur(15px);
}


.image-wrapper::before {

    content: "";

    position: absolute;

    inset: -1px;

    border-radius: 25px;

    padding: 1px;

    background:
        linear-gradient(
            135deg,
            rgba(79,70,229,.35),
            rgba(6,182,212,.25),
            transparent
        );

    -webkit-mask:
        linear-gradient(#fff 0 0) content-box,
        linear-gradient(#fff 0 0);

    -webkit-mask-composite: xor;

    mask-composite: exclude;

    pointer-events: none;
}


.image-wrapper img {

    width: 100%;

    display: block;

    border-radius: 18px;
}


/* =========================================================
   FLOATING CARDS
========================================================= */

.floating-card {

    position: absolute;

    z-index: 10;

    display: flex;

    align-items: center;

    gap: 11px;

    padding: 13px 17px;

    border-radius: 15px;

    background:
        rgba(255,255,255,.94);

    border: 1px solid rgba(255,255,255,.8);

    box-shadow:
        0 18px 40px rgba(15,23,42,.16);

    backdrop-filter: blur(15px);
}


.floating-card i {

    width: 40px;

    height: 40px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;

    color: #4f46e5;

    background:
        linear-gradient(
            135deg,
            #eef2ff,
            #ecfeff
        );

    font-size: 17px;
}


.floating-card strong {

    display: block;

    color: #0f172a;

    font-size: 12px;

    font-weight: 700;
}


.floating-card small {

    display: block;

    color: #64748b;

    font-size: 10px;

    margin-top: 2px;
}


.card-ai {

    left: -35px;

    top: 35px;
}


.card-score {

    right: -30px;

    bottom: 35px;
}


.score-number {

    color: #10b981 !important;

    font-size: 14px !important;
}


/* =========================================================
   MINI AI GLOW
========================================================= */

.hero-glow {

    position: absolute;

    width: 170px;

    height: 170px;

    border-radius: 50%;

    background:
        radial-gradient(
            circle,
            rgba(6,182,212,.25),
            transparent 70%
        );

    right: 10%;

    bottom: 5%;

    filter: blur(5px);
}


/* =========================================================
   STATISTICS
========================================================= */

.stats-section {

    position: relative;

    background: #ffffff;

    padding: 34px 0;

    border-bottom: 1px solid #e2e8f0;

    box-shadow:
        0 8px 25px rgba(15,23,42,.03);
}


.stat-box {

    text-align: center;

    border-right: 1px solid #e2e8f0;

    transition: .25s;
}


.stat-box:last-child {

    border-right: none;
}


.stat-box:hover {

    transform: translateY(-3px);
}


.stat-number {

    font-size: 32px;

    font-weight: 800;

    background:
        linear-gradient(
            90deg,
            #4f46e5,
            #06b6d4
        );

    -webkit-background-clip: text;

    -webkit-text-fill-color: transparent;
}


.stat-label {

    color: #64748b;

    font-size: 12px;

    margin-top: 4px;
}


/* =========================================================
   FEATURES
========================================================= */

.features-section {

    padding: 95px 0;

    background:
        linear-gradient(
            180deg,
            #ffffff,
            #f8fafc
        );
}


.section-heading {

    max-width: 720px;

    margin: 0 auto 55px;

    text-align: center;
}


.section-tag {

    display: inline-block;

    color: #4f46e5;

    background: #eef2ff;

    padding: 7px 13px;

    border-radius: 50px;

    font-size: 11px;

    font-weight: 700;

    letter-spacing: .8px;

    text-transform: uppercase;
}


.section-heading h2 {

    font-size: 38px;

    line-height: 1.2;

    font-weight: 800;

    color: #0f172a;

    margin: 15px 0 13px;
}


.section-heading p {

    color: #64748b;

    font-size: 14px;

    line-height: 1.7;
}


/* =========================================================
   FEATURE CARD
========================================================= */

.feature-card {

    position: relative;

    height: 100%;

    padding: 31px;

    border-radius: 20px;

    background: rgba(255,255,255,.9);

    border: 1px solid #e2e8f0;

    box-shadow:
        0 8px 25px rgba(15,23,42,.035);

    transition:
        transform .3s ease,
        box-shadow .3s ease,
        border-color .3s ease;
}


.feature-card::before {

    content: "";

    position: absolute;

    left: 0;

    top: 25px;

    width: 3px;

    height: 40px;

    border-radius: 0 5px 5px 0;

    background:
        linear-gradient(
            180deg,
            #4f46e5,
            #06b6d4
        );

    opacity: 0;

    transition: .3s;
}


.feature-card:hover {

    transform: translateY(-8px);

    border-color: #c7d2fe;

    box-shadow:
        0 20px 50px rgba(15,23,42,.09);
}


.feature-card:hover::before {

    opacity: 1;
}


.feature-icon {

    width: 57px;

    height: 57px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 16px;

    color: #4f46e5;

    background:
        linear-gradient(
            135deg,
            #eef2ff,
            #ecfeff
        );

    font-size: 23px;

    margin-bottom: 21px;
}


.feature-card h4 {

    color: #0f172a;

    font-size: 18px;

    font-weight: 700;

    margin-bottom: 10px;
}


.feature-card p {

    color: #64748b;

    font-size: 13px;

    line-height: 1.75;

    margin: 0;
}


/* =========================================================
   HOW IT WORKS
========================================================= */

.how-section {

    padding: 95px 0;

    background: #f8fafc;
}


.step-card {

    position: relative;

    text-align: center;
}


.step-number {

    position: relative;

    width: 65px;

    height: 65px;

    margin: auto;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    color: white;

    background:
        linear-gradient(
            135deg,
            #4f46e5,
            #06b6d4
        );

    font-size: 17px;

    font-weight: 800;

    box-shadow:
        0 12px 30px rgba(79,70,229,.22);
}


.step-card h5 {

    margin-top: 19px;

    color: #0f172a;

    font-size: 16px;

    font-weight: 700;
}


.step-card p {

    max-width: 220px;

    margin: auto;

    color: #64748b;

    font-size: 12px;

    line-height: 1.7;
}


/* =========================================================
   CTA
========================================================= */

.cta-section {

    padding: 90px 0;

    background: white;
}


.cta-box {

    position: relative;

    overflow: hidden;

    padding: 75px 30px;

    border-radius: 28px;

    text-align: center;

    color: white;

    background:
        radial-gradient(
            circle at 15% 20%,
            rgba(6,182,212,.20),
            transparent 25%
        ),
        radial-gradient(
            circle at 85% 80%,
            rgba(139,92,246,.25),
            transparent 30%
        ),
        linear-gradient(
            135deg,
            #07111f,
            #111c3a,
            #312e81
        );

    box-shadow:
        0 25px 60px rgba(15,23,42,.16);
}


.cta-box::before {

    content: "";

    position: absolute;

    width: 280px;

    height: 280px;

    border-radius: 50%;

    border: 1px solid rgba(255,255,255,.08);

    right: -100px;

    top: -120px;
}


.cta-box h2 {

    position: relative;

    font-size: 36px;

    font-weight: 800;

    margin-bottom: 15px;
}


.cta-box p {

    position: relative;

    max-width: 650px;

    margin: 0 auto 30px;

    color: #cbd5e1;

    font-size: 14px;

    line-height: 1.8;
}


.cta-button {

    position: relative;

    display: inline-flex;

    align-items: center;

    padding: 15px 28px;

    border-radius: 13px;

    color: #312e81;

    background: white;

    text-decoration: none;

    font-size: 14px;

    font-weight: 700;

    transition: .3s;

    box-shadow:
        0 10px 25px rgba(0,0,0,.15);
}


.cta-button:hover {

    color: #312e81;

    transform: translateY(-3px);

    box-shadow:
        0 15px 30px rgba(0,0,0,.22);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1100px) {

    .hero-title {

        font-size: 52px;
    }

    .hero-visual {

        padding-left: 15px;
    }

    .card-ai {

        left: -10px;
    }

    .card-score {

        right: -10px;
    }
}


@media (max-width: 991px) {

    .ai-hero {

        padding: 70px 0;
    }

    .hero-title {

        font-size: 48px;
    }

    .hero-visual {

        margin-top: 60px;

        padding-left: 0;
    }

    .stat-box {

        border-right: none;

        margin-bottom: 20px;
    }
}


@media (max-width: 576px) {

    .ai-hero {

        padding: 55px 0;
    }

    .hero-title {

        font-size: 39px;

        letter-spacing: -1.2px;
    }

    .hero-description {

        font-size: 14px;
    }

    .hero-buttons {

        flex-direction: column;
    }

    .btn-start,
    .btn-feature {

        width: 100%;
    }

    .trust-points {

        flex-direction: column;

        gap: 9px;
    }

    .hero-visual {

        margin-top: 45px;
    }

    .floating-card {

        padding: 9px 11px;
    }

    .floating-card i {

        width: 32px;

        height: 32px;

        font-size: 14px;
    }

    .card-ai {

        left: -5px;

        top: 15px;
    }

    .card-score {

        right: -5px;

        bottom: 15px;
    }

    .features-section,
    .how-section {

        padding: 65px 0;
    }

    .section-heading h2 {

        font-size: 29px;
    }

    .cta-section {

        padding: 60px 0;
    }

    .cta-box {

        padding: 55px 22px;

        border-radius: 22px;
    }

    .cta-box h2 {

        font-size: 28px;
    }
}

</style>


<div class="ai-home">


<!-- =========================================================
     HERO SECTION
========================================================= -->

<section class="ai-hero">

    <div class="container">

        <div class="row align-items-center">

            <!-- LEFT -->

            <div class="col-lg-6">

                <div class="hero-content">

                    <div class="hero-badge">

                        <i class="bi bi-stars"></i>

                        AI Powered Viva Preparation

                    </div>


                    <h1 class="hero-title">

                        Prepare Smarter.
                        <br>

                        <span>Perform Better.</span>

                    </h1>


                    <p class="hero-description">

                        Practice your viva examinations with an
                        intelligent AI-powered platform. Answer technical
                        questions using voice or text and receive
                        instant evaluation, marks and personalized feedback.

                    </p>


                    <div class="hero-buttons">

                        <a href="{{ route('register') }}"
                           class="btn-start">

                            <i class="bi bi-rocket-takeoff me-2"></i>

                            Start Practicing

                        </a>


                        <a href="{{ route('features') }}"
                           class="btn-feature">

                            <i class="bi bi-grid-3x3-gap me-2"></i>

                            Explore Features

                        </a>

                    </div>


                    <div class="trust-points">

                        <div class="trust-point">

                            <i class="bi bi-check-circle-fill"></i>

                            Voice & Text Practice

                        </div>


                        <div class="trust-point">

                            <i class="bi bi-check-circle-fill"></i>

                            AI Evaluation

                        </div>


                        <div class="trust-point">

                            <i class="bi bi-check-circle-fill"></i>

                            Performance Tracking

                        </div>

                    </div>

                </div>

            </div>


            <!-- RIGHT -->

            <div class="col-lg-6">

                <div class="hero-visual">

                    <div class="hero-glow"></div>


                    <div class="image-wrapper">

                        <img
                            src="{{ asset('images/ai_img.png') }}"
                            alt="AI Viva Teacher">

                    </div>


                    <!-- AI CARD -->

                    <div class="floating-card card-ai">

                        <i class="bi bi-robot"></i>

                        <div>

                            <strong>
                                AI Evaluation
                            </strong>

                            <small>
                                Instant feedback
                            </small>

                        </div>

                    </div>


                    <!-- SCORE CARD -->

                    <div class="floating-card card-score">

                        <i class="bi bi-graph-up-arrow"></i>

                        <div>

                            <strong class="score-number">
                                85/100
                            </strong>

                            <small>
                                Viva Performance
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================================
     STATISTICS
========================================================= -->

<section class="stats-section">

    <div class="container">

        <div class="row">

            <div class="col-6 col-md-3">

                <div class="stat-box">

                    <div class="stat-number">
                        500+
                    </div>

                    <div class="stat-label">
                        Students
                    </div>

                </div>

            </div>


            <div class="col-6 col-md-3">

                <div class="stat-box">

                    <div class="stat-number">
                        50+
                    </div>

                    <div class="stat-label">
                        Teachers
                    </div>

                </div>

            </div>


            <div class="col-6 col-md-3">

                <div class="stat-box">

                    <div class="stat-number">
                        1000+
                    </div>

                    <div class="stat-label">
                        Viva Questions
                    </div>

                </div>

            </div>


            <div class="col-6 col-md-3">

                <div class="stat-box">

                    <div class="stat-number">
                        24/7
                    </div>

                    <div class="stat-label">
                        Practice Access
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================================
     FEATURES
========================================================= -->

<section class="features-section">

    <div class="container">

        <div class="section-heading">

            <div class="section-tag">
                Powerful Features
            </div>

            <h2>
                Everything You Need for Viva Preparation
            </h2>

            <p>
                Practice, evaluate and improve your viva performance
                with one intelligent platform.
            </p>

        </div>


        <div class="row g-4">


            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">

                        <i class="bi bi-robot"></i>

                    </div>

                    <h4>
                        AI Evaluation
                    </h4>

                    <p>
                        Get intelligent evaluation of your answers
                        with marks, correctness analysis and
                        useful AI feedback.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">

                        <i class="bi bi-mic-fill"></i>

                    </div>

                    <h4>
                        Voice Viva
                    </h4>

                    <p>
                        Practice answering questions through voice
                        for a more realistic viva experience.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">

                        <i class="bi bi-chat-left-text-fill"></i>

                    </div>

                    <h4>
                        Text Answers
                    </h4>

                    <p>
                        Type your answers when you prefer text-based
                        viva practice.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">

                        <i class="bi bi-stopwatch-fill"></i>

                    </div>

                    <h4>
                        Smart Timer
                    </h4>

                    <p>
                        Practice within a timed environment to improve
                        answering speed and confidence.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">

                        <i class="bi bi-bar-chart-fill"></i>

                    </div>

                    <h4>
                        Performance Tracking
                    </h4>

                    <p>
                        Track your scores, previous attempts and
                        overall viva performance.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">

                        <i class="bi bi-book-fill"></i>

                    </div>

                    <h4>
                        Subject-wise Practice
                    </h4>

                    <p>
                        Practice questions according to your subjects
                        and academic requirements.
                    </p>

                </div>

            </div>


        </div>

    </div>

</section>


<!-- =========================================================
     HOW IT WORKS
========================================================= -->

<section class="how-section">

    <div class="container">

        <div class="section-heading">

            <div class="section-tag">
                Simple Process
            </div>

            <h2>
                How AI Viva Teacher Works
            </h2>

            <p>
                Start your AI-powered viva practice in four simple steps.
            </p>

        </div>


        <div class="row g-4">


            <div class="col-6 col-lg-3">

                <div class="step-card">

                    <div class="step-number">
                        01
                    </div>

                    <h5>
                        Create Account
                    </h5>

                    <p>
                        Register and create your student account.
                    </p>

                </div>

            </div>


            <div class="col-6 col-lg-3">

                <div class="step-card">

                    <div class="step-number">
                        02
                    </div>

                    <h5>
                        Select Subject
                    </h5>

                    <p>
                        Choose the subject you want to practice.
                    </p>

                </div>

            </div>


            <div class="col-6 col-lg-3">

                <div class="step-card">

                    <div class="step-number">
                        03
                    </div>

                    <h5>
                        Answer Questions
                    </h5>

                    <p>
                        Answer questions using voice or text.
                    </p>

                </div>

            </div>


            <div class="col-6 col-lg-3">

                <div class="step-card">

                    <div class="step-number">
                        04
                    </div>

                    <h5>
                        Get AI Result
                    </h5>

                    <p>
                        Receive marks and AI-powered feedback.
                    </p>

                </div>

            </div>


        </div>

    </div>

</section>


<!-- =========================================================
     CTA
========================================================= -->

<section class="cta-section">

    <div class="container">

        <div class="cta-box">

            <h2>
                Ready to Master Your Viva?
            </h2>

            <p>
                Practice smarter, build confidence and improve your
                technical knowledge with AI-powered viva preparation.
            </p>

            <a href="{{ route('register') }}"
               class="cta-button">

                <i class="bi bi-rocket-takeoff me-2"></i>

                Create Your Account

            </a>
        </div>

    </div>

</section>


</div>

@endsection