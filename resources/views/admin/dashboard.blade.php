@extends('layouts.app')

@section('content')

<style>

body{
    background:#eef3f8;
}


/* =========================
   Hero
========================= */

.hero-card{
    border:none;
    border-radius:28px;
    overflow:hidden;

    background:
    linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);

    color:#fff;

    box-shadow:0 25px 60px rgba(0,0,0,.18);
}


.hero-card h2{
    font-weight:700;
}


.hero-card p{
    color:rgba(255,255,255,.85);
}


/* =========================
   AI Hologram
========================= */

.ai-container{

    position:relative;

    height:250px;

    display:flex;

    justify-content:center;

    align-items:center;

}


.ai-circle{

    width:160px;
    height:160px;

    border-radius:50%;

    background:
    linear-gradient(135deg,#60a5fa,#2563eb);

    box-shadow:

    0 0 45px rgba(96,165,250,.9),

    inset 0 0 35px rgba(255,255,255,.5);

    display:flex;

    justify-content:center;

    align-items:center;

    animation:floatAI 3s infinite ease-in-out;

}


.ai-face{

    width:95px;
    height:70px;

    background:white;

    border-radius:30px;

    display:flex;

    justify-content:center;

    align-items:center;

    gap:25px;

}


.ai-face span{

    width:15px;
    height:15px;

    background:#2563eb;

    border-radius:50%;

    animation:blink 2s infinite;

}


.ai-ring{

    position:absolute;

    border-radius:50%;

    border:2px solid rgba(255,255,255,.5);

}


.ring1{

    width:210px;
    height:210px;

    animation:rotate 8s linear infinite;

}


.ring2{

    width:260px;
    height:260px;

    border-style:dashed;

    animation:rotate 12s linear infinite reverse;

}


@keyframes floatAI{

    0%,100%{
        transform:translateY(0);
    }

    50%{
        transform:translateY(-18px);
    }

}


@keyframes rotate{

    from{
        transform:rotate(0deg);
    }

    to{
        transform:rotate(360deg);
    }

}


@keyframes blink{

    50%{
        opacity:.3;
    }

}


/* =========================
   Statistics
========================= */

.stat-card{

    border:none;

    border-radius:22px;

    background:white;

    transition:.35s;

    box-shadow:0 12px 30px rgba(0,0,0,.08);

}


.stat-card:hover{

    transform:translateY(-10px);

    box-shadow:0 25px 50px rgba(37,99,235,.20);

}


.stat-icon{

    width:70px;
    height:70px;

    border-radius:18px;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:30px;

    color:white;

}


.bg1{

    background:
    linear-gradient(135deg,#2563eb,#60a5fa);

}


.bg2{

    background:
    linear-gradient(135deg,#16a34a,#4ade80);

}


.bg3{

    background:
    linear-gradient(135deg,#f59e0b,#facc15);

}


/* =========================
   Action Cards
========================= */

.action-card{

    border:none;

    border-radius:24px;

    background:white;

    transition:.35s;

    overflow:hidden;

    box-shadow:0 15px 35px rgba(0,0,0,.08);

}


.action-card:hover{

    transform:translateY(-12px);

    box-shadow:0 30px 60px rgba(0,0,0,.15);

}


.action-header{

    height:8px;

}


.blue{

    background:#2563eb;

}


.green{

    background:#16a34a;

}


.orange{

    background:#f59e0b;

}


.gray{

    background:#334155;

}


.big-icon{

    font-size:55px;

}


.btn-custom{

    border-radius:50px;

    padding:10px 30px;

    font-weight:600;

}

</style>


<div class="container-fluid py-4">


    <!-- =========================
         Hero
    ========================== -->

    <div class="card hero-card mb-5">

        <div class="card-body p-5">

            <div class="row align-items-center">


                <div class="col-lg-8">

                    <h2 class="display-6 mb-3">

                        👋 Welcome, Administrator

                    </h2>


                    <p class="lead mb-4">

                        Manage your complete
                        <strong>AI Based Viva Teacher</strong>
                        platform from one powerful dashboard.

                    </p>


                    <a href="{{ route('admin.dashboard') }}"
                       class="btn btn-light btn-lg rounded-pill px-4">

                        Open Dashboard

                    </a>

                </div>


                <div class="col-lg-4 text-center">

                    <div class="ai-container">

                        <div class="ai-ring ring1"></div>

                        <div class="ai-ring ring2"></div>


                        <div class="ai-circle">

                            <div class="ai-face">

                                <span></span>

                                <span></span>

                            </div>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </div>



    <!-- =========================
         Statistics
    ========================== -->

    <div class="row g-4 mb-5">


        <!-- Teachers -->

        <div class="col-lg-4 col-md-6">

            <div class="card stat-card">

                <div class="card-body d-flex align-items-center">

                    <div class="stat-icon bg1">

                        👨‍🏫

                    </div>


                    <div class="ms-3">

                        <h3 class="fw-bold mb-0">

                            {{ $teacherCount }}

                        </h3>


                        <small class="text-muted">

                            Teachers

                        </small>

                    </div>

                </div>

            </div>

        </div>



        <!-- Students -->

        <div class="col-lg-4 col-md-6">

            <div class="card stat-card">

                <div class="card-body d-flex align-items-center">

                    <div class="stat-icon bg2">

                        👨‍🎓

                    </div>


                    <div class="ms-3">

                        <h3 class="fw-bold mb-0">

                            {{ $studentCount }}

                        </h3>


                        <small class="text-muted">

                            Students

                        </small>

                    </div>

                </div>

            </div>

        </div>



        <!-- Subjects -->

        <div class="col-lg-4 col-md-6">

            <div class="card stat-card">

                <div class="card-body d-flex align-items-center">

                    <div class="stat-icon bg3">

                        📚

                    </div>


                    <div class="ms-3">

                        <h3 class="fw-bold mb-0">

                            {{ $subjectCount }}

                        </h3>


                        <small class="text-muted">

                            Subjects

                        </small>

                    </div>

                </div>

            </div>

        </div>


    </div>



    <!-- =========================
         Action Cards
    ========================== -->

    <div class="row g-4">


        <!-- =========================
             Manage Teachers
        ========================== -->

        <div class="col-lg-3 col-md-6">

            <div class="card action-card">

                <div class="action-header blue"></div>


                <div class="card-body text-center p-4">

                    <div class="big-icon">

                        👨‍🏫

                    </div>


                    <h4 class="fw-bold mt-3">

                        Manage Teachers

                    </h4>


                    <p class="text-muted">

                        Add, edit and monitor teacher accounts.

                    </p>


                    <a href="{{ route('admin.teachers') }}"
                       class="btn btn-primary btn-custom">

                        Manage

                    </a>

                </div>

            </div>

        </div>



        <!-- =========================
             Manage Students
        ========================== -->

        <div class="col-lg-3 col-md-6">

            <div class="card action-card">

                <div class="action-header green"></div>


                <div class="card-body text-center p-4">

                    <div class="big-icon">

                        👨‍🎓

                    </div>


                    <h4 class="fw-bold mt-3">

                        Manage Students

                    </h4>


                    <p class="text-muted">

                        Student records and registrations.

                    </p>


                    <a href="{{ route('admin.students') }}"
                       class="btn btn-success btn-custom">

                        Manage

                    </a>

                </div>

            </div>

        </div>


<!-- =========================
     Reports
========================== -->

<div class="col-lg-3 col-md-6">

    <div class="card action-card">

        <div class="action-header orange"></div>

        <div class="card-body text-center p-4">

            <div class="big-icon">
                📊
            </div>

            <h4 class="fw-bold mt-3">
                Reports
            </h4>

            <p class="text-muted">
                View AI performance and analytics.
            </p>

            <a href="{{ route('admin.reports') }}"
               class="btn btn-warning btn-custom">
                View Reports
            </a>

        </div>

    </div>

</div>




        <!-- =========================
             Settings
        ========================== -->

        <div class="col-lg-3 col-md-6">

            <div class="card action-card">

                <div class="action-header gray"></div>


                <div class="card-body text-center p-4">

                    <div class="big-icon">

                        ⚙️

                    </div>


                    <h4 class="fw-bold mt-3">

                        Settings

                    </h4>


                    <p class="text-muted">

                        Configure your application.

                    </p>


                    <button class="btn btn-dark btn-custom">

                        Open

                    </button>

                </div>

            </div>

        </div>


    </div>

</div>

@endsection