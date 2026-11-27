@extends('layouts.app')

@section('title', 'Contact - AI Viva Teacher')

@section('content')

<style>

/* =========================================================
   CONTACT PAGE
========================================================= */

.contact-page {
    font-family: 'Inter', sans-serif;
    color: #172033;
    background: #f8fafc;
}


/* =========================================================
   HERO SECTION
========================================================= */

.contact-hero {
    position: relative;
    overflow: hidden;

    padding: 95px 20px 110px;

    background:
        radial-gradient(
            circle at 85% 20%,
            rgba(59, 130, 246, 0.20),
            transparent 28%
        ),
        radial-gradient(
            circle at 10% 80%,
            rgba(14, 165, 233, 0.12),
            transparent 25%
        ),
        linear-gradient(
            135deg,
            #07152d 0%,
            #0d2850 55%,
            #123d6d 100%
        );

    color: white;
}


.contact-hero::before {
    content: "";

    position: absolute;
    inset: 0;

    opacity: 0.06;

    background-image:
        linear-gradient(
            rgba(255,255,255,.5) 1px,
            transparent 1px
        ),
        linear-gradient(
            90deg,
            rgba(255,255,255,.5) 1px,
            transparent 1px
        );

    background-size: 42px 42px;
}


.contact-hero-content {
    position: relative;
    z-index: 2;

    max-width: 800px;

    margin: auto;

    text-align: center;
}


.contact-badge {
    display: inline-flex;

    align-items: center;
    gap: 9px;

    padding: 9px 17px;

    margin-bottom: 24px;

    border: 1px solid rgba(147,197,253,.25);

    border-radius: 50px;

    background: rgba(255,255,255,.07);

    color: #9bd5ff;

    font-size: 12px;
    font-weight: 700;

    letter-spacing: 1.2px;
}


.contact-badge-dot {
    width: 8px;
    height: 8px;

    border-radius: 50%;

    background: #60c4ff;

    box-shadow:
        0 0 14px rgba(96,196,255,.9);
}


.contact-hero h1 {
    margin-bottom: 20px;

    font-size: 58px;

    line-height: 1.1;

    font-weight: 800;

    letter-spacing: -2px;
}


.contact-hero h1 span {
    color: #67c4ff;
}


.contact-hero p {
    max-width: 700px;

    margin: auto;

    color: #b9c9df;

    font-size: 15px;

    line-height: 1.9;
}


/* =========================================================
   CONTACT MAIN SECTION
========================================================= */

.contact-section {
    padding: 90px 20px;
}


/* =========================================================
   CONTACT INFORMATION CARD
========================================================= */

.contact-info-card {
    height: 100%;

    padding: 40px;

    border-radius: 22px;

    background:
        linear-gradient(
            145deg,
            #0a1b38,
            #123b68
        );

    color: white;

    box-shadow:
        0 25px 60px rgba(15,23,42,.13);
}


.contact-info-label {
    margin-bottom: 11px;

    color: #67c4ff;

    font-size: 11px;

    font-weight: 800;

    letter-spacing: 1.5px;

    text-transform: uppercase;
}


.contact-info-card h2 {
    margin-bottom: 14px;

    font-size: 32px;

    font-weight: 800;
}


.contact-info-card > p {
    margin-bottom: 38px;

    color: #b6c6da;

    font-size: 13px;

    line-height: 1.8;
}


/* =========================================================
   CONTACT INFORMATION ITEMS
========================================================= */

.contact-info-item {
    display: flex;

    gap: 16px;

    margin-bottom: 27px;
}


.contact-info-icon {
    flex-shrink: 0;

    width: 46px;
    height: 46px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 12px;

    background: rgba(96,196,255,.10);

    border: 1px solid rgba(96,196,255,.15);

    color: #67c4ff;

    font-size: 17px;
}


.contact-info-item h5 {
    margin: 0 0 6px;

    font-size: 14px;

    font-weight: 700;
}


.contact-info-item p {
    margin: 0;

    color: #b6c6da;

    font-size: 12px;

    line-height: 1.7;
}


/* =========================================================
   FORM CARD
========================================================= */

.contact-form-card {
    padding: 42px;

    border: 1px solid #e5eaf1;

    border-radius: 22px;

    background: white;

    box-shadow:
        0 20px 50px rgba(15,23,42,.07);
}


.contact-form-card h2 {
    font-size: 30px;

    font-weight: 800;
}


.contact-form-card > div p {
    font-size: 13px !important;
}


/* =========================================================
   FORM LABELS
========================================================= */

.contact-form-label {
    display: block;

    margin-bottom: 9px;

    color: #3b4658;

    font-size: 12px;

    font-weight: 750;
}


/* =========================================================
   INPUTS
========================================================= */

.contact-input-group {
    position: relative;
}


.contact-input-icon {
    position: absolute;

    left: 15px;
    top: 50%;

    transform: translateY(-50%);

    z-index: 2;

    color: #8a95a5;

    font-size: 14px;
}


.contact-form-control {
    width: 100%;

    padding: 13px 15px 13px 42px;

    border: 1px solid #e2e7ee;

    border-radius: 10px;

    background: #fbfcfe;

    color: #172033;

    font-size: 13px;

    outline: none;

    transition: .25s;
}


.contact-form-control:focus {
    border-color: #60a5fa;

    background: white;

    box-shadow:
        0 0 0 4px rgba(37,99,235,.08);
}


.contact-form-control::placeholder {
    color: #9aa4b2;

    font-size: 12px;
}


textarea.contact-form-control {
    min-height: 150px;

    resize: vertical;

    padding-top: 14px;
}


.contact-textarea-icon {
    position: absolute;

    left: 15px;
    top: 17px;

    color: #8a95a5;

    font-size: 14px;
}


/* =========================================================
   SUBMIT BUTTON
========================================================= */

.contact-submit {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 9px;

    width: 100%;

    padding: 14px 20px;

    border: 0;

    border-radius: 10px;

    background: #2563eb;

    color: white;

    font-size: 13px;

    font-weight: 750;

    transition: .25s;
}


.contact-submit:hover {
    background: #1d4ed8;

    transform: translateY(-2px);

    box-shadow:
        0 12px 25px rgba(37,99,235,.22);
}


/* =========================================================
   ALERTS
========================================================= */

.contact-form-card .alert {
    font-size: 12px !important;

    border-radius: 10px;
}


/* =========================================================
   FAQ SECTION
========================================================= */

.faq-section {
    padding: 95px 20px;

    background: white;
}


.faq-heading {
    max-width: 700px;

    margin: 0 auto 48px;

    text-align: center;
}


.faq-label {
    margin-bottom: 11px;

    color: #2563eb;

    font-size: 11px;

    font-weight: 800;

    letter-spacing: 1.5px;

    text-transform: uppercase;
}


.faq-heading h2 {
    margin-bottom: 13px;

    font-size: 38px;

    font-weight: 800;

    letter-spacing: -1px;
}


.faq-heading p {
    margin: 0;

    color: #7d8797;

    font-size: 13px;

    line-height: 1.8;
}


.faq-wrapper {
    max-width: 900px;

    margin: auto;
}


.faq-item {
    margin-bottom: 13px;

    overflow: hidden;

    border: 1px solid #e5eaf1 !important;

    border-radius: 13px !important;

    background: white;
}


.faq-button {
    padding: 20px !important;

    color: #172033 !important;

    background: white !important;

    box-shadow: none !important;

    font-size: 14px !important;

    font-weight: 700 !important;
}


.faq-button:not(.collapsed) {
    color: #2563eb !important;
}


.faq-body {
    padding: 0 20px 20px !important;

    color: #7d8797;

    font-size: 13px;

    line-height: 1.8;
}


/* =========================================================
   CTA SECTION
========================================================= */

.contact-cta {
    padding: 95px 20px;

    text-align: center;

    background:
        radial-gradient(
            circle at 85% 25%,
            rgba(96,165,250,.17),
            transparent 25%
        ),
        linear-gradient(
            135deg,
            #08172f,
            #123d6d
        );

    color: white;
}


.contact-cta h2 {
    margin-bottom: 15px;

    font-size: 38px;

    font-weight: 800;
}


.contact-cta p {
    max-width: 650px;

    margin: 0 auto 30px;

    color: #b9c9dd;

    font-size: 14px;

    line-height: 1.8;
}


.contact-cta-btn {
    display: inline-flex;

    align-items: center;

    gap: 9px;

    padding: 14px 27px;

    border-radius: 10px;

    background: white;

    color: #123d6d;

    text-decoration: none;

    font-size: 13px;

    font-weight: 750;

    transition: .25s;
}


.contact-cta-btn:hover {
    color: #123d6d;

    background: #f1f5f9;

    transform: translateY(-2px);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 991px) {

    .contact-info-card {
        margin-bottom: 25px;
    }

}


@media (max-width: 768px) {

    .contact-hero {
        padding: 75px 20px 85px;
    }


    .contact-hero h1 {
        font-size: 44px;
    }


    .contact-hero p {
        font-size: 14px;
    }


    .contact-section,
    .faq-section,
    .contact-cta {
        padding: 70px 20px;
    }


    .contact-form-card,
    .contact-info-card {
        padding: 30px;
    }


    .faq-heading h2,
    .contact-cta h2 {
        font-size: 31px;
    }

}


@media (max-width: 480px) {

    .contact-hero h1 {
        font-size: 36px;
    }


    .contact-info-card h2 {
        font-size: 27px;
    }


    .contact-form-card h2 {
        font-size: 26px;
    }


    .faq-heading h2,
    .contact-cta h2 {
        font-size: 28px;
    }


    .contact-form-card,
    .contact-info-card {
        padding: 24px;
    }

}

</style>


<div class="contact-page">


    <!-- =====================================================
         HERO
    ===================================================== -->

    <section class="contact-hero">

        <div class="contact-hero-content">

            <div class="contact-badge">

                <span class="contact-badge-dot"></span>

                CONTACT AI VIVA TEACHER

            </div>


            <h1>

                Let's Start a
                <span>Conversation</span>

            </h1>


            <p>

                Have a question about AI Viva Teacher, need technical
                support, or want to share your feedback? Send us a
                message and we'll be happy to help.

            </p>

        </div>

    </section>


    <!-- =====================================================
         CONTACT INFORMATION + FORM
    ===================================================== -->

    <section class="contact-section">

        <div class="container">

            <div class="row g-4 align-items-stretch">


                <!-- ==============================
                     CONTACT INFORMATION
                =============================== -->

                <div class="col-lg-5">

                    <div class="contact-info-card">

                        <div class="contact-info-label">
                            Get In Touch
                        </div>


                        <h2>
                            Contact Information
                        </h2>


                        <p>

                            If you have questions, suggestions, or
                            require assistance with the AI Viva Teacher
                            platform, feel free to contact us.

                        </p>


                        <!-- ADDRESS -->

                        <div class="contact-info-item">

                            <div class="contact-info-icon">

                                <i class="bi bi-geo-alt"></i>

                            </div>


                            <div>

                                <h5>
                                    Address
                                </h5>

                                <p>
                                    Anand Agricultural University<br>
                                    Anand, Gujarat, India
                                </p>

                            </div>

                        </div>


                        <!-- EMAIL -->

                        <div class="contact-info-item">

                            <div class="contact-info-icon">

                                <i class="bi bi-envelope"></i>

                            </div>


                            <div>

                                <h5>
                                    Email
                                </h5>

                                <p>
                                    ayandiwan8769@gmail.com
                                </p>

                            </div>

                        </div>


                        <!-- PHONE -->

                        <div class="contact-info-item">

                            <div class="contact-info-icon">

                                <i class="bi bi-telephone"></i>

                            </div>


                            <div>

                                <h5>
                                    Phone
                                </h5>

                                <p>
                                    +91 97377 92966
                                </p>

                            </div>

                        </div>


                        <!-- WORKING HOURS -->

                        <div class="contact-info-item mb-0">

                            <div class="contact-info-icon">

                                <i class="bi bi-clock"></i>

                            </div>


                            <div>

                                <h5>
                                    Working Hours
                                </h5>

                                <p>
                                    Monday - Saturday<br>
                                    9:00 AM - 6:00 PM
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- ==============================
                     CONTACT FORM
                =============================== -->

                <div class="col-lg-7">

                    <div class="contact-form-card">

                        <div class="mb-4">

                            <div class="contact-info-label">
                                Send Message
                            </div>


                            <h2 class="mb-2">
                                How Can We Help?
                            </h2>


                            <p class="text-muted mb-0">

                                Fill in the form below and send us your
                                question, feedback, or request.

                            </p>

                        </div>


                        <!-- SUCCESS MESSAGE -->

                        @if(session('success'))

                            <div
                                class="alert alert-success alert-dismissible fade show"
                                role="alert">

                                <i class="bi bi-check-circle me-2"></i>

                                {{ session('success') }}

                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert">
                                </button>

                            </div>

                        @endif


                        <!-- VALIDATION ERRORS -->

                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <div class="fw-bold mb-2">
                                    Please check the following:
                                </div>


                                <ul class="mb-0 ps-3">

                                    @foreach ($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <!-- FORM -->

                        <form
                            action="{{ route('contact.store') }}"
                            method="POST">

                            @csrf


                            <div class="row g-3">


                                <!-- NAME -->

                                <div class="col-md-6">

                                    <label class="contact-form-label">

                                        Full Name

                                    </label>


                                    <div class="contact-input-group">

                                        <i
                                            class="bi bi-person contact-input-icon">
                                        </i>


                                        <input
                                            type="text"
                                            name="name"
                                            value="{{ old('name') }}"
                                            class="contact-form-control"
                                            placeholder="Enter your full name"
                                            required>

                                    </div>

                                </div>


                                <!-- EMAIL -->

                                <div class="col-md-6">

                                    <label class="contact-form-label">

                                        Email Address

                                    </label>


                                    <div class="contact-input-group">

                                        <i
                                            class="bi bi-envelope contact-input-icon">
                                        </i>


                                        <input
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            class="contact-form-control"
                                            placeholder="Enter your email"
                                            required>

                                    </div>

                                </div>


                                <!-- SUBJECT -->

                                <div class="col-12">

                                    <label class="contact-form-label">

                                        Subject

                                    </label>


                                    <div class="contact-input-group">

                                        <i
                                            class="bi bi-chat-square-text contact-input-icon">
                                        </i>


                                        <input
                                            type="text"
                                            name="subject"
                                            value="{{ old('subject') }}"
                                            class="contact-form-control"
                                            placeholder="What is your message about?"
                                            required>

                                    </div>

                                </div>


                                <!-- MESSAGE -->

                                <div class="col-12">

                                    <label class="contact-form-label">

                                        Message

                                    </label>


                                    <div class="contact-input-group">

                                        <i
                                            class="bi bi-pencil contact-textarea-icon">
                                        </i>


                                        <textarea
                                            name="message"
                                            class="contact-form-control"
                                            placeholder="Write your message here..."
                                            required>{{ old('message') }}</textarea>

                                    </div>

                                </div>


                                <!-- SUBMIT -->

                                <div class="col-12 pt-2">

                                    <button
                                        type="submit"
                                        class="contact-submit">

                                        <i class="bi bi-send"></i>

                                        Send Message

                                    </button>

                                </div>


                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         FAQ SECTION
    ===================================================== -->

    <section class="faq-section">

        <div class="container">

            <div class="faq-heading">

                <div class="faq-label">
                    Frequently Asked Questions
                </div>


                <h2>
                    Have Questions?
                </h2>


                <p>

                    Find quick answers to common questions
                    about AI Viva Teacher.

                </p>

            </div>


            <div class="faq-wrapper">

                <div
                    class="accordion"
                    id="faqAccordion">


                    <!-- FAQ 1 -->

                    <div class="accordion-item faq-item">

                        <h2 class="accordion-header">

                            <button
                                class="accordion-button faq-button"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq1">

                                <i class="bi bi-question-circle me-3"></i>

                                Is AI Viva Teacher free?

                            </button>

                        </h2>


                        <div
                            id="faq1"
                            class="accordion-collapse collapse show"
                            data-bs-parent="#faqAccordion">

                            <div class="accordion-body faq-body">

                                Yes. Students can register and practice
                                viva sessions through the platform.

                            </div>

                        </div>

                    </div>


                    <!-- FAQ 2 -->

                    <div class="accordion-item faq-item">

                        <h2 class="accordion-header">

                            <button
                                class="accordion-button faq-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq2">

                                <i class="bi bi-question-circle me-3"></i>

                                Can teachers create their own questions?

                            </button>

                        </h2>


                        <div
                            id="faq2"
                            class="accordion-collapse collapse"
                            data-bs-parent="#faqAccordion">

                            <div class="accordion-body faq-body">

                                Yes. Teachers can create and manage
                                subject-wise viva questions through
                                the teacher dashboard.

                            </div>

                        </div>

                    </div>


                    <!-- FAQ 3 -->

                    <div class="accordion-item faq-item">

                        <h2 class="accordion-header">

                            <button
                                class="accordion-button faq-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq3">

                                <i class="bi bi-question-circle me-3"></i>

                                Does AI evaluate student answers?

                            </button>

                        </h2>


                        <div
                            id="faq3"
                            class="accordion-collapse collapse"
                            data-bs-parent="#faqAccordion">

                            <div class="accordion-body faq-body">

                                Yes. The system uses AI-based evaluation
                                to analyze student answers and provide
                                marks and feedback.

                            </div>

                        </div>

                    </div>


                    <!-- FAQ 4 -->

                    <div class="accordion-item faq-item">

                        <h2 class="accordion-header">

                            <button
                                class="accordion-button faq-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq4">

                                <i class="bi bi-question-circle me-3"></i>

                                Can students answer using voice?

                            </button>

                        </h2>


                        <div
                            id="faq4"
                            class="accordion-collapse collapse"
                            data-bs-parent="#faqAccordion">

                            <div class="accordion-body faq-body">

                                Yes. Students can answer viva questions
                                using voice or text depending on the
                                available answer method.

                            </div>

                        </div>

                    </div>


                    <!-- FAQ 5 -->

                    <div class="accordion-item faq-item">

                        <h2 class="accordion-header">

                            <button
                                class="accordion-button faq-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq5">

                                <i class="bi bi-question-circle me-3"></i>

                                Can students view previous results?

                            </button>

                        </h2>


                        <div
                            id="faq5"
                            class="accordion-collapse collapse"
                            data-bs-parent="#faqAccordion">

                            <div class="accordion-body faq-body">

                                Yes. Students can view their previous
                                viva results and performance history
                                from the student dashboard.

                            </div>

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         CTA SECTION
    ===================================================== -->

    <section class="contact-cta">

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
                class="contact-cta-btn">

                Create Your Account

                <i class="bi bi-arrow-right"></i>

            </a>

        </div>

    </section>


</div>

@endsection