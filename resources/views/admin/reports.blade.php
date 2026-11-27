@extends('layouts.app')

@section('title', 'Admin Reports')

@section('content')

<style>

/* =========================================================
   ADMIN REPORTS
========================================================= */

body {
    background: #eef3f8;
}


/* =========================================================
   HEADER
========================================================= */

.report-header {
    background: linear-gradient(
        135deg,
        #0f172a,
        #1e3a8a,
        #2563eb
    );

    color: white;

    border-radius: 24px;

    padding: 35px;

    margin-bottom: 30px;

    box-shadow:
        0 20px 45px rgba(0,0,0,.15);
}

.report-header h2 {
    font-weight: 700;
    margin-bottom: 8px;
}

.report-header p {
    margin: 0;
    color: rgba(255,255,255,.85);
}


/* =========================================================
   DOWNLOAD BUTTON
========================================================= */

.download-btn {
    border-radius: 50px;

    padding: 11px 22px;

    font-weight: 700;

    border: none;

    transition: .3s;
}

.download-btn:hover {
    transform: translateY(-2px);

    box-shadow:
        0 10px 25px rgba(0,0,0,.20);
}


/* =========================================================
   STAT CARDS
========================================================= */

.report-card {
    border: none;

    border-radius: 20px;

    background: white;

    box-shadow:
        0 12px 30px rgba(0,0,0,.08);

    transition: .3s;

    height: 100%;
}

.report-card:hover {
    transform: translateY(-7px);

    box-shadow:
        0 20px 40px rgba(0,0,0,.13);
}


.report-icon {
    width: 65px;
    height: 65px;

    border-radius: 18px;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 28px;

    color: white;
}


.icon-blue {
    background:
        linear-gradient(
            135deg,
            #2563eb,
            #60a5fa
        );
}


.icon-green {
    background:
        linear-gradient(
            135deg,
            #16a34a,
            #4ade80
        );
}


.icon-orange {
    background:
        linear-gradient(
            135deg,
            #f59e0b,
            #facc15
        );
}


.icon-purple {
    background:
        linear-gradient(
            135deg,
            #7c3aed,
            #a78bfa
        );
}


.icon-red {
    background:
        linear-gradient(
            135deg,
            #dc2626,
            #f87171
        );
}


/* =========================================================
   SECTION CARD
========================================================= */

.section-card {
    border: none;

    border-radius: 22px;

    background: white;

    box-shadow:
        0 12px 30px rgba(0,0,0,.08);

    overflow: hidden;
}


.section-header {
    padding: 22px 25px;

    border-bottom:
        1px solid #e5e7eb;
}


.section-title {
    font-weight: 700;

    color: #0f172a;
}


/* =========================================================
   TABLE
========================================================= */

.report-table {
    margin-bottom: 0;
}


.report-table thead {
    background: #f8fafc;
}


.report-table th {
    color: #475569;

    font-size: 14px;

    font-weight: 700;

    padding: 15px;

    border-bottom:
        1px solid #e2e8f0;

    white-space: nowrap;
}


.report-table td {
    padding: 15px;

    vertical-align: middle;

    color: #334155;
}


.report-table tbody tr {
    transition: .2s;
}


.report-table tbody tr:hover {
    background: #f8fafc;
}


/* =========================================================
   SCORE BADGES
========================================================= */

.score-badge {
    padding: 7px 14px;

    border-radius: 50px;

    font-weight: 700;

    font-size: 13px;

    display: inline-block;
}


.score-good {
    background: #dcfce7;

    color: #166534;
}


.score-average {
    background: #fef3c7;

    color: #92400e;
}


.score-low {
    background: #fee2e2;

    color: #991b1b;
}


/* =========================================================
   VIEW BUTTON
========================================================= */

.view-btn {
    border-radius: 50px;

    padding: 7px 15px;

    font-size: 13px;

    font-weight: 600;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.empty-state {
    padding: 45px 20px;

    text-align: center;

    color: #64748b;
}


.empty-state .empty-icon {
    font-size: 50px;

    margin-bottom: 15px;
}


/* =========================================================
   STUDENT AVATAR
========================================================= */

.student-avatar {
    width: 40px;
    height: 40px;

    border-radius: 50%;

    background:
        linear-gradient(
            135deg,
            #2563eb,
            #7c3aed
        );

    color: white;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    font-weight: 700;

    margin-right: 10px;
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 768px) {

    .report-header {
        padding: 25px;
    }

    .report-header h2 {
        font-size: 24px;
    }

    .download-btn {
        width: 100%;
        margin-top: 15px;
    }

}

</style>


<div class="container-fluid py-4">


    {{-- =====================================================
         SUCCESS / ERROR MESSAGE
    ====================================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <strong>Success!</strong>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            <strong>Error!</strong>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif



    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="report-header">

        <div class="d-flex flex-wrap
                    justify-content-between
                    align-items-center">

            <div>

                <h2>
                    📊 Admin Reports
                </h2>

                <p>
                    Monitor AI Viva performance, students,
                    teachers and overall system activity.
                </p>

            </div>


            <div class="d-flex flex-wrap gap-2 mt-3 mt-md-0">


                {{-- DOWNLOAD REPORT --}}

                <a
                    href="{{ route('admin.reports.download') }}"
                    class="btn btn-success download-btn">

                    📥 Download Report

                </a>


                {{-- BACK BUTTON --}}

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="btn btn-light download-btn">

                    ← Back to Dashboard

                </a>

            </div>

        </div>

    </div>



    <!-- =====================================================
         STATISTICS
    ====================================================== -->

    <div class="row g-4 mb-4">


        {{-- TEACHERS --}}

        <div class="col-xl-3 col-md-6">

            <div class="card report-card">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center">

                        <div class="report-icon icon-blue">
                            👨‍🏫
                        </div>

                        <div class="ms-3">

                            <h3 class="fw-bold mb-1">

                                {{ $teacherCount ?? 0 }}

                            </h3>

                            <span class="text-muted">

                                Total Teachers

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- STUDENTS --}}

        <div class="col-xl-3 col-md-6">

            <div class="card report-card">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center">

                        <div class="report-icon icon-green">
                            👨‍🎓
                        </div>

                        <div class="ms-3">

                            <h3 class="fw-bold mb-1">

                                {{ $studentCount ?? 0 }}

                            </h3>

                            <span class="text-muted">

                                Total Students

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- SUBJECTS --}}

        <div class="col-xl-3 col-md-6">

            <div class="card report-card">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center">

                        <div class="report-icon icon-orange">
                            📚
                        </div>

                        <div class="ms-3">

                            <h3 class="fw-bold mb-1">

                                {{ $subjectCount ?? 0 }}

                            </h3>

                            <span class="text-muted">

                                Total Subjects

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- VIVA ATTEMPTS --}}

        <div class="col-xl-3 col-md-6">

            <div class="card report-card">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center">

                        <div class="report-icon icon-purple">
                            📝
                        </div>

                        <div class="ms-3">

                            <h3 class="fw-bold mb-1">

                                {{ $totalAttempts ?? 0 }}

                            </h3>

                            <span class="text-muted">

                                Viva Attempts

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- =====================================================
         PERFORMANCE
    ====================================================== -->

    <div class="row g-4 mb-4">


        {{-- AVERAGE --}}

        <div class="col-lg-6">

            <div class="card report-card">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center">

                        <div class="report-icon icon-blue">
                            📈
                        </div>

                        <div class="ms-3">

                            <small class="text-muted">
                                Average Score
                            </small>

                            <h3 class="fw-bold mb-0">

                                {{ number_format($averageScore ?? 0, 2) }}%

                            </h3>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- HIGHEST --}}

        <div class="col-lg-6">

            <div class="card report-card">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center">

                        <div class="report-icon icon-green">
                            🏆
                        </div>

                        <div class="ms-3">

                            <small class="text-muted">
                                Highest Score
                            </small>

                            <h3 class="fw-bold mb-0">

                                {{ number_format($highestScore ?? 0, 2) }}%

                            </h3>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- =====================================================
         RECENT VIVA ATTEMPTS
    ====================================================== -->

    <div class="card section-card mb-4">


        <div class="section-header">

            <div class="d-flex
                        flex-wrap
                        justify-content-between
                        align-items-center">

                <div>

                    <h4 class="section-title mb-1">

                        📝 Recent Viva Attempts

                    </h4>

                    <small class="text-muted">

                        Latest completed student viva performance

                    </small>

                </div>


                <div>

                    <span class="badge bg-primary px-3 py-2">

                        {{ $totalAttempts ?? 0 }}
                        Total Attempts

                    </span>

                </div>

            </div>

        </div>



        <div class="table-responsive">

            <table class="table report-table">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Student</th>

                        <th>Subject</th>

                        <th>Questions</th>

                        <th>Score</th>

                        <th>Percentage</th>

                        <th>Date</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($recentAttempts ?? [] as $index => $attempt)

                        <tr>


                            {{-- NUMBER --}}

                            <td>

                                <strong>
                                    {{ $index + 1 }}
                                </strong>

                            </td>


                            {{-- STUDENT --}}

                            <td>

                                <div class="d-flex
                                            align-items-center">

                                    <span class="student-avatar">

                                        {{ strtoupper(
                                            substr(
                                                $attempt->student_name ?? 'N',
                                                0,
                                                1
                                            )
                                        ) }}

                                    </span>


                                    <strong>

                                        {{ $attempt->student_name ?? 'N/A' }}

                                    </strong>

                                </div>

                            </td>


                            {{-- SUBJECT --}}

                            <td>

                                <span class="fw-semibold">

                                    {{ $attempt->subject_name ?? 'N/A' }}

                                </span>

                            </td>


                            {{-- QUESTIONS --}}

                            <td>

                                {{ $attempt->total_questions ?? 0 }}

                            </td>


                            {{-- SCORE --}}

                            <td>

                                <strong>

                                    {{ $attempt->score ?? '0/0' }}

                                </strong>

                            </td>


                            {{-- PERCENTAGE --}}

                            <td>

                                @php

                                    $percentage =
                                        $attempt->percentage ?? 0;

                                @endphp


                                @if($percentage >= 70)

                                    <span
                                        class="score-badge score-good">

                                        {{ number_format(
                                            $percentage,
                                            2
                                        ) }}%

                                    </span>

                                @elseif($percentage >= 40)

                                    <span
                                        class="score-badge score-average">

                                        {{ number_format(
                                            $percentage,
                                            2
                                        ) }}%

                                    </span>

                                @else

                                    <span
                                        class="score-badge score-low">

                                        {{ number_format(
                                            $percentage,
                                            2
                                        ) }}%

                                    </span>

                                @endif

                            </td>


                            {{-- DATE --}}

                            <td>

                                @if($attempt->created_at)

                                    {{ \Carbon\Carbon::parse(
                                        $attempt->created_at
                                    )->format('d-m-Y') }}

                                @else

                                    N/A

                                @endif

                            </td>


                            {{-- ACTION --}}

                            <td>

                                <a
                                    href="{{ route(
                                        'admin.reports.attempt',
                                        $attempt->result_id
                                    ) }}"
                                    class="btn btn-primary
                                           view-btn">

                                    👁 View Details

                                </a>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="8">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        📊
                                    </div>

                                    <h5>

                                        No Viva Attempts Found

                                    </h5>

                                    <p class="mb-0">

                                        Student viva results
                                        will appear here.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>



    <!-- =====================================================
         STUDENT PERFORMANCE
    ====================================================== -->

    <div class="card section-card mb-4">


        <div class="section-header">

            <h4 class="section-title mb-1">

                👨‍🎓 Student Performance

            </h4>

            <small class="text-muted">

                Overall performance of students based
                on completed viva attempts

            </small>

        </div>



        <div class="table-responsive">

            <table class="table report-table">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Student</th>

                        <th>Total Attempts</th>

                        <th>Average Score</th>

                        <th>Highest Score</th>

                        <th>Performance</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($studentReports ?? [] as $index => $student)

                        <tr>


                            <td>

                                {{ $index + 1 }}

                            </td>


                            <td>

                                <div class="d-flex
                                            align-items-center">

                                    <span class="student-avatar">

                                        {{ strtoupper(
                                            substr(
                                                $student->name ?? 'N',
                                                0,
                                                1
                                            )
                                        ) }}

                                    </span>


                                    <strong>

                                        {{ $student->name ?? 'N/A' }}

                                    </strong>

                                </div>

                            </td>


                            <td>

                                <strong>

                                    {{ $student->total_attempts ?? 0 }}

                                </strong>

                            </td>


                            <td>

                                <strong>

                                    {{ number_format(
                                        $student->average_score ?? 0,
                                        2
                                    ) }}%

                                </strong>

                            </td>


                            <td>

                                {{ number_format(
                                    $student->highest_score ?? 0,
                                    2
                                ) }}%

                            </td>


                            <td>

                                @php

                                    $studentScore =
                                        $student->average_score ?? 0;

                                @endphp


                                @if($studentScore >= 70)

                                    <span
                                        class="score-badge score-good">

                                        Excellent

                                    </span>

                                @elseif($studentScore >= 40)

                                    <span
                                        class="score-badge score-average">

                                        Average

                                    </span>

                                @elseif(($student->total_attempts ?? 0) == 0)

                                    <span
                                        class="score-badge score-low">

                                        No Attempt

                                    </span>

                                @else

                                    <span
                                        class="score-badge score-low">

                                        Needs Improvement

                                    </span>

                                @endif

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="6">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        👨‍🎓
                                    </div>

                                    <h5>

                                        No Student Reports

                                    </h5>

                                    <p class="mb-0">

                                        Student performance data
                                        will appear here.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>



    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <div class="text-center text-muted py-3">

        <small>

            AI Viva Teacher • Admin Reporting System

        </small>

    </div>

</div>

@endsection