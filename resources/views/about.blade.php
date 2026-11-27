@extends('layouts.app')

@section('title', 'About - AI Viva Teacher')

@section('content')

<style>

    /* =====================================================
       ABOUT PAGE
    ===================================================== */

    .about-page {
        font-family: 'Inter', sans-serif;
        color: #172033;
        background: #f8fafc;
    }


    /* =====================================================
       HERO
    ===================================================== */

    .about-hero {
        position: relative;
        overflow: hidden;
        padding: 95px 20px;
        background:
            radial-gradient(circle at 85% 20%, rgba(59,130,246,.17), transparent 28%),
            radial-gradient(circle at 10% 85%, rgba(14,165,233,.10), transparent 25%),
            linear-gradient(135deg, #07152d, #0d2850 55%, #123d6d);
        color: white;
    }

    .about-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        opacity: .07;
        background-image:
            linear-gradient(rgba(255,255,255,.5) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.5) 1px, transparent 1px);
        background-size: 42px 42px;
    }

    .about-hero-content {
        position: relative;
        z-index: 2;
    }

    .about-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        margin-bottom: 22px;
        border-radius: 50px;
        border: 1px solid rgba(147,197,253,.2);
        background: rgba(255,255,255,.07);
        color: #9bd5ff;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .about-badge-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #60c4ff;
        box-shadow: 0 0 12px rgba(96,196,255,.9);
    }

    .about-hero h1 {
        max-width: 650px;
        margin-bottom: 22px;
        font-size: 52px;
        line-height: 1.1;
        font-weight: 800;
        letter-spacing: -2px;
    }

    .about-hero h1 span {
        color: #67c4ff;
    }

    .about-hero p {
        max-width: 650px;
        color: #b9c9df;
        font-size: 13px;
        line-height: 1.9;
    }

    .about-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 13px 23px;
        margin-top: 10px;
        border-radius: 10px;
        background: #2563eb;
        color: white;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        transition: .25s;
    }

    .about-btn:hover {
        color: white;
        background: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(37,99,235,.25);
    }


    /* =====================================================
       HERO VISUAL
    ===================================================== */

    .about-visual {
        position: relative;
        width: 390px;
        height: 390px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .about-circle {
        position: absolute;
        border-radius: 50%;
        border: 1px solid rgba(147,197,253,.18);
    }

    .about-circle.one {
        width: 360px;
        height: 360px;
    }

    .about-circle.two {
        width: 270px;
        height: 270px;
    }

    .about-circle.three {
        width: 180px;
        height: 180px;
    }

    .about-ai-card {
        position: relative;
        z-index: 3;
        width: 175px;
        padding: 27px 20px;
        text-align: center;
        border: 1px solid rgba(255,255,255,.13);
        border-radius: 20px;
        background: rgba(255,255,255,.08);
        backdrop-filter: blur(15px);
        box-shadow: 0 25px 70px rgba(0,0,0,.25);
    }

    .about-ai-icon {
        width: 62px;
        height: 62px;
        margin: auto auto 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        background: rgba(96,196,255,.12);
        color: #68c6ff;
        font-size: 27px;
    }

    .about-ai-card h4 {
        margin: 0 0 5px;
        color: white;
        font-size: 15px;
        font-weight: 750;
    }

    .about-ai-card p {
        margin: 0;
        color: #aebed2;
        font-size: 9px;
        line-height: 1.6;
    }


    /* =====================================================
       SECTION
    ===================================================== */

    .about-section {
        padding: 90px 20px;
    }

    .about-heading {
        max-width: 650px;
        margin: 0 auto 50px;
        text-align: center;
    }

    .about-label {
        margin-bottom: 10px;
        color: #2563eb;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .about-heading h2 {
        margin-bottom: 13px;
        font-size: 34px;
        font-weight: 800;
        letter-spacing: -1px;
    }

    .about-heading p {
        margin: 0;
        color: #7d8797;
        font-size: 12px;
        line-height: 1.8;
    }


    /* =====================================================
       MISSION CARDS
    ===================================================== */

    .mission-card {
        height: 100%;
        padding: 30px;
        border: 1px solid #e5eaf1;
        border-radius: 18px;
        background: white;
        transition: .28s;
    }

    .mission-card:hover {
        transform: translateY(-7px);
        border-color: #cbdcfb;
        box-shadow: 0 20px 45px rgba(15,23,42,.08);
    }

    .mission-icon {
        width: 52px;
        height: 52px;
        margin-bottom: 21px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 21px;
    }

    .mission-card h3 {
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: 750;
    }

    .mission-card p {
        margin: 0;
        color: #7d8797;
        font-size: 11px;
        line-height: 1.8;
    }


    /* =====================================================
       WHY SECTION
    ===================================================== */

    .why-section {
        padding: 90px 20px;
        background: white;
    }

    .why-item {
        display: flex;
        gap: 18px;
        height: 100%;
        padding: 25px;
        border: 1px solid #e8edf3;
        border-radius: 16px;
        transition: .25s;
    }

    .why-item:hover {
        border-color: #cbdcfb;
        box-shadow: 0 15px 35px rgba(15,23,42,.06);
    }

    .why-icon {
        flex-shrink: 0;
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 17px;
    }

    .why-item h4 {
        margin: 0 0 7px;
        font-size: 14px;
        font-weight: 750;
    }

    .why-item p {
        margin: 0;
        color: #7d8797;
        font-size: 10px;
        line-height: 1.75;
    }


    /* =====================================================
       PLATFORM SECTION
    ===================================================== */

    .platform-section {
        padding: 90px 20px;
        background: #f8fafc;
    }

    .platform-box {
        padding: 45px;
        border: 1px solid #e4eaf2;
        border-radius: 22px;
        background: white;
    }

    .platform-item {
        text-align: center;
        padding: 15px;
    }

    .platform-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 18px;
    }

    .platform-item h4 {
        margin-bottom: 6px;
        font-size: 14px;
        font-weight: 750;
    }

    .platform-item p {
        margin: 0;
        color: #8a94a3;
        font-size: 10px;
    }


    /* =====================================================
       TECHNOLOGY
    ===================================================== */

    .tech-section {
        padding: 90px 20px;
        background: white;
    }

    .tech-card {
        height: 100%;
        padding: 30px;
        border-radius: 18px;
        border: 1px solid #e5eaf1;
        background: #fff;
    }

    .tech-card h3 {
        margin-bottom: 12px;
        font-size: 16px;
        font-weight: 750;
    }

    .tech-card p {
        margin: 0;
        color: #7d8797;
        font-size: 11px;
        line-height: 1.8;
    }

    .tech-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 20px;
    }

    .tech-tag {
        padding: 7px 11px;
        border-radius: 7px;
        background: #f1f5f9;
        color: #536174;
        font-size: 9px;
        font-weight: 700;
    }


    /* =====================================================
       CTA
    ===================================================== */

    .about-cta {
        padding: 90px 20px;
        text-align: center;
        background:
            radial-gradient(circle at 85% 30%, rgba(96,165,250,.15), transparent 25%),
            linear-gradient(135deg, #08172f, #123d6d);
        color: white;
    }

    .about-cta h2 {
        margin-bottom: 14px;
        font-size: 34px;
        font-weight: 800;
    }

    .about-cta p {
        max-width: 600px;
        margin: 0 auto 28px;
        color: #b9c9dd;
        font-size: 12px;
        line-height: 1.8;
    }

    .about-cta .about-btn {
        background: white;
        color: #123d6d;
    }

    .about-cta .about-btn:hover {
        background: #f1f5f9;
        color: #123d6d;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 991px) {

        .about-hero {
            text-align: center;
        }

        .about-hero h1,
        .about-hero p {
            margin-left: auto;
            margin-right: auto;
        }

        .about-visual {
            margin-top: 55px;
        }
    }

    @media(max-width: 600px) {

        .about-hero {
            padding: 70px 20px;
        }

        .about-hero h1 {
            font-size: 37px;
        }

        .about-visual {
            width: 300px;
            height: 300px;
        }

        .about-circle.one {
            width: 280px;
            height: 280px;
        }

        .about-circle.two {
            width: 210px;
            height: 210px;
        }

        .about-circle.three {
            width: 140px;
            height: 140px;
        }

        .about-section,
        .why-section,
        .platform-section,
        .tech-section,
        .about-cta {
            padding: 65px 20px;
        }

        .about-heading h2,
        .about-cta h2 {
            font-size: 27px;
        }

        .platform-box {
            padding: 25px 15px;
        }
    }

</style>


<div class="about-page">


    <!-- =================================================
         HERO
    ================================================= -->

    <section class="about-hero">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-7">

                    <div class="about-hero-content">

                        <div class="about-badge">

                            <span class="about-badge-dot"></span>

                            ABOUT AI VIVA TEACHER

                        </div>


                        <h1>

                            Making Viva Preparation
                            <span>Smarter With AI</span>

                        </h1>


                        <p>

                            AI Based Viva Teacher is a web-based learning
                            platform designed to help students practice
                            viva examinations in a realistic and interactive
                            environment.

                        </p>


                        <p>

                            Students can answer questions using voice or
                            text, receive AI-based evaluation and review
                            their performance after completing a viva.

                        </p>


                        <a
                            href="{{ route('register') }}"
                            class="about-btn">

                            Get Started

                            <i class="bi bi-arrow-right"></i>

                        </a>

                    </div>

                </div>


                <!-- AI VISUAL -->

                <div class="col-lg-5">

                    <div class="about-visual">

                        <div class="about-circle one"></div>
                        <div class="about-circle two"></div>
                        <div class="about-circle three"></div>


                        <div class="about-ai-card">

                            <div class="about-ai-icon">

                                <i class="bi bi-robot"></i>

                            </div>

                            <h4>
                                AI Viva Teacher
                            </h4>

                            <p>
                                Intelligent Viva
                                Practice Platform
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =================================================
         MISSION
    ================================================= -->

    <section class="about-section">

        <div class="container">

            <div class="about-heading">

                <div class="about-label">
                    Our Mission
                </div>

                <h2>
                    Built to Make Viva Practice Better
                </h2>

                <p>
                    The platform focuses on helping students practice
                    communication, technical knowledge and confidence
                    before facing real viva examinations.
                </p>

            </div>


            <div class="row g-4">


                <div class="col-md-4">

                    <div class="mission-card">

                        <div class="mission-icon">

                            <i class="bi bi-lightbulb"></i>

                        </div>

                        <h3>
                            Smart Learning
                        </h3>

                        <p>
                            Students can practice subject-wise questions
                            through an interactive AI-based viva environment.
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="mission-card">

                        <div class="mission-icon">

                            <i class="bi bi-mic"></i>

                        </div>

                        <h3>
                            Interactive Practice
                        </h3>

                        <p>
                            Voice and text answer options provide students
                            with flexible ways to participate in a viva session.
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="mission-card">

                        <div class="mission-icon">

                            <i class="bi bi-graph-up-arrow"></i>

                        </div>

                        <h3>
                            Continuous Improvement
                        </h3>

                        <p>
                            Results, marks and feedback help students understand
                            their performance and improve future attempts.
                        </p>

                    </div>

                </div>


            </div>

        </div>

    </section>


    <!-- =================================================
         WHY CHOOSE
    ================================================= -->

    <section class="why-section">

        <div class="container">

            <div class="about-heading">

                <div class="about-label">
                    Platform Benefits
                </div>

                <h2>
                    Why AI Viva Teacher?
                </h2>

                <p>
                    A complete platform for structured and technology-driven
                    viva examination preparation.
                </p>

            </div>


            <div class="row g-4">


                <div class="col-md-6">

                    <div class="why-item">

                        <div class="why-icon">
                            <i class="bi bi-cpu"></i>
                        </div>

                        <div>

                            <h4>
                                AI-Based Evaluation
                            </h4>

                            <p>
                                Student answers can be evaluated using
                                AI-based analysis with marks and feedback.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="why-item">

                        <div class="why-icon">
                            <i class="bi bi-stopwatch"></i>
                        </div>

                        <div>

                            <h4>
                                Timed Viva Practice
                            </h4>

                            <p>
                                A question timer creates a structured
                                examination-style practice environment.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="why-item">

                        <div class="why-icon">
                            <i class="bi bi-book"></i>
                        </div>

                        <div>

                            <h4>
                                Subject-Based Questions
                            </h4>

                            <p>
                                Teachers can manage subjects and create
                                relevant question banks for students.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="why-item">

                        <div class="why-icon">
                            <i class="bi bi-bar-chart"></i>
                        </div>

                        <div>

                            <h4>
                                Performance Tracking
                            </h4>

                            <p>
                                Students can review their results and
                                previous viva performance.
                            </p>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </section>


    <!-- =================================================
         PLATFORM
    ================================================= -->

    <section class="platform-section">

        <div class="container">

            <div class="about-heading">

                <div class="about-label">
                    Platform Structure
                </div>

                <h2>
                    One Platform, Three Roles
                </h2>

                <p>
                    Each user gets access to features designed according
                    to their role in the viva management system.
                </p>

            </div>


            <div class="platform-box">

                <div class="row g-4">


                    <div class="col-md-4">

                        <div class="platform-item">

                            <div class="platform-icon">

                                <i class="bi bi-mortarboard"></i>

                            </div>

                            <h4>
                                Student
                            </h4>

                            <p>
                                Practice viva, submit answers and
                                review results.
                            </p>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="platform-item">

                            <div class="platform-icon">

                                <i class="bi bi-person-video2"></i>

                            </div>

                            <h4>
                                Teacher
                            </h4>

                            <p>
                                Manage subjects, questions and
                                student results.
                            </p>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="platform-item">

                            <div class="platform-icon">

                                <i class="bi bi-shield-check"></i>

                            </div>

                            <h4>
                                Administrator
                            </h4>

                            <p>
                                Manage and maintain the complete
                                platform.
                            </p>

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </section>


    <!-- =================================================
         TECHNOLOGY
    ================================================= -->

    <section class="tech-section">

        <div class="container">

            <div class="about-heading">

                <div class="about-label">
                    Technology
                </div>

                <h2>
                    Built With Modern Web Technologies
                </h2>

                <p>
                    The system combines a modern web framework,
                    database and AI services to provide an interactive
                    viva platform.
                </p>

            </div>


            <div class="row g-4">


                <div class="col-md-6">

                    <div class="tech-card">

                        <h3>
                            Application Layer
                        </h3>

                        <p>
                            The application uses Laravel and PHP to
                            manage authentication, roles, viva sessions,
                            questions, answers and results.
                        </p>

                        <div class="tech-tags">

                            <span class="tech-tag">
                                Laravel
                            </span>

                            <span class="tech-tag">
                                PHP
                            </span>

                            <span class="tech-tag">
                                Blade
                            </span>

                            <span class="tech-tag">
                                Bootstrap
                            </span>

                            <span class="tech-tag">
                                JavaScript
                            </span>

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="tech-card">

                        <h3>
                            Data & AI Layer
                        </h3>

                        <p>
                            The database stores users, subjects, questions,
                            answers and results while AI services support
                            automated answer evaluation.
                        </p>

                        <div class="tech-tags">

                            <span class="tech-tag">
                                MySQL
                            </span>

                            <span class="tech-tag">
                                AI Evaluation
                            </span>

                            <span class="tech-tag">
                                REST API
                            </span>

                            <span class="tech-tag">
                                AJAX
                            </span>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </section>


    <!-- =================================================
         CTA
    ================================================= -->

    <section class="about-cta">

        <div class="container">

            <h2>
                Start Preparing Smarter
            </h2>

            <p>
                Create your account and experience a structured,
                interactive and AI-powered approach to viva preparation.
            </p>


            <a
                href="{{ route('register') }}"
                class="about-btn">

                Create Your Account

                <i class="bi bi-arrow-right"></i>

            </a>

        </div>

    </section>


</div>

@endsection