@extends('layouts.app')

@section('title', 'Manage Students')

@section('content')

<style>

/* =========================================
   PAGE BACKGROUND
========================================= */

.student-page {
    background: #f4f8fc;
    min-height: 90vh;
}


/* =========================================
   MAIN CARD
========================================= */

.student-card {
    border: none;
    border-radius: 24px;
    overflow: hidden;

    box-shadow:
        0 15px 40px rgba(30, 64, 175, 0.10);
}


/* =========================================
   HEADER
========================================= */

.student-header {

    background: linear-gradient(
        135deg,
        #0f172a,
        #1d4ed8,
        #3b82f6
    );

    color: white;

    padding: 22px 28px;
}


.student-header h4 {

    font-weight: 700;

    letter-spacing: .3px;
}


/* =========================================
   TABLE
========================================= */

.student-table {

    margin-bottom: 0;
}


.student-table thead th {

    background: #1e3a8a;

    color: white;

    border: none;

    padding: 15px 18px;

    font-size: 14px;
}


.student-table tbody td {

    padding: 16px 18px;

    border-color: #e5edf7;
}


.student-table tbody tr {

    transition: .25s ease;
}


.student-table tbody tr:hover {

    background: #f5f9ff;
}


/* =========================================
   STUDENT NUMBER
========================================= */

.student-number {

    width: 35px;
    height: 35px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #dbeafe;

    color: #1d4ed8;

    font-weight: 700;
}


/* =========================================
   STUDENT NAME
========================================= */

.student-name {

    font-weight: 700;

    color: #1e3a8a;
}


/* =========================================
   EMAIL
========================================= */

.student-email {

    color: #64748b;
}


/* =========================================
   STATUS
========================================= */

.status-active {

    background: #dcfce7;

    color: #15803d;

    padding: 7px 14px;

    border-radius: 50px;

    font-weight: 600;

    font-size: 12px;
}


.status-inactive {

    background: #fee2e2;

    color: #dc2626;

    padding: 7px 14px;

    border-radius: 50px;

    font-weight: 600;

    font-size: 12px;
}


.status-deleted {

    background: #e5e7eb;

    color: #4b5563;

    padding: 7px 14px;

    border-radius: 50px;

    font-weight: 600;

    font-size: 12px;
}


/* =========================================
   DELETE BUTTON
========================================= */

.delete-btn {

    background: #fee2e2;

    color: #dc2626;

    border: none;

    padding: 8px 18px;

    border-radius: 50px;

    font-weight: 600;

    transition: .25s;

    cursor: pointer;
}


.delete-btn:hover {

    background: #dc2626;

    color: white;

    transform: translateY(-2px);
}


/* =========================================
   RESTORE BUTTON
========================================= */

.restore-btn {

    background: #dcfce7;

    color: #15803d;

    border: none;

    padding: 8px 18px;

    border-radius: 50px;

    font-weight: 600;

    transition: .25s;

    cursor: pointer;
}


.restore-btn:hover {

    background: #15803d;

    color: white;

    transform: translateY(-2px);
}


/* =========================================
   ALERT
========================================= */

.alert {

    border: none;

    border-radius: 14px;
}


/* =========================================
   EMPTY STATE
========================================= */

.empty-state {

    padding: 45px;

    color: #94a3b8;
}


.empty-icon {

    font-size: 45px;

    margin-bottom: 10px;
}


/* =========================================
   RESPONSIVE
========================================= */

@media(max-width: 768px) {

    .student-header {

        padding: 20px;
    }


    .student-table thead th,
    .student-table tbody td {

        padding: 12px;
    }

}

</style>


<div class="student-page py-5">

    <div class="container">


        <!-- =====================================
             MAIN CARD
        ====================================== -->

        <div class="card student-card">


            <!-- =====================================
                 HEADER
            ====================================== -->

            <div class="student-header">

                <h4 class="mb-1">

                    👨‍🎓 Manage Students

                </h4>

                <small class="opacity-75">

                    Manage registered student accounts

                </small>

            </div>



            <!-- =====================================
                 BODY
            ====================================== -->

            <div class="card-body p-4">


                <!-- =====================================
                     SUCCESS MESSAGE
                ====================================== -->

                @if(session('success'))

                    <div class="alert alert-success
                                alert-dismissible fade show">

                        <i class="bi bi-check-circle me-2"></i>

                        {{ session('success') }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>

                    </div>

                @endif



                <!-- =====================================
                     ERROR MESSAGE
                ====================================== -->

                @if(session('error'))

                    <div class="alert alert-danger
                                alert-dismissible fade show">

                        <i class="bi bi-exclamation-triangle me-2"></i>

                        {{ session('error') }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>

                    </div>

                @endif



                <!-- =====================================
                     STUDENTS TABLE
                ====================================== -->

                <div class="table-responsive">

                    <table class="table student-table align-middle">


                        <!-- =====================================
                             TABLE HEADER
                        ====================================== -->

                        <thead>

                            <tr>

                                <th>
                                    #
                                </th>

                                <th>
                                    Name
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>



                        <!-- =====================================
                             TABLE BODY
                        ====================================== -->

                        <tbody>

                            @forelse($students as $student)

                                <tr>


                                    <!-- =====================================
                                         NUMBER
                                    ====================================== -->

                                    <td>

                                        <div class="student-number">

                                            {{ $loop->iteration }}

                                        </div>

                                    </td>



                                    <!-- =====================================
                                         NAME
                                    ====================================== -->

                                    <td>

                                        <div class="student-name">

                                            {{ $student->name }}

                                        </div>

                                    </td>



                                    <!-- =====================================
                                         EMAIL
                                    ====================================== -->

                                    <td>

                                        <div class="student-email">

                                            {{ $student->email }}

                                        </div>

                                    </td>



                                    <!-- =====================================
                                         STATUS
                                    ====================================== -->

                                    <td>

                                        @if($student->trashed())

                                            <span class="status-deleted">

                                                <i class="bi bi-trash me-1"></i>

                                                Deleted

                                            </span>

                                        @elseif($student->status)

                                            <span class="status-active">

                                                <i class="bi bi-check-circle me-1"></i>

                                                Active

                                            </span>

                                        @else

                                            <span class="status-inactive">

                                                <i class="bi bi-x-circle me-1"></i>

                                                Inactive

                                            </span>

                                        @endif

                                    </td>



                                    <!-- =====================================
                                         ACTION
                                    ====================================== -->

                                    <td>

                                        @if($student->trashed())


                                            <!-- =====================================
                                                 RESTORE STUDENT
                                            ====================================== -->

                                            <form
                                                action="{{ route(
                                                    'teacher.students.delete',
                                                    $student->id
                                                ) }}"
                                                method="POST"
                                                class="d-inline"
                                            >

                                                @csrf

                                                @method('DELETE')


                                                <button
                                                    type="submit"
                                                    class="restore-btn"
                                                    onclick="return confirm(
                                                        'Restore this student?'
                                                    )"
                                                >

                                                    <i class="bi bi-arrow-counterclockwise"></i>

                                                    Restore

                                                </button>

                                            </form>


                                        @else


                                            <!-- =====================================
                                                 DELETE STUDENT
                                            ====================================== -->

                                            <form
                                                action="{{ route(
                                                    'teacher.students.delete',
                                                    $student->id
                                                ) }}"
                                                method="POST"
                                                class="d-inline"
                                            >

                                                @csrf

                                                @method('DELETE')


                                                <button
                                                    type="submit"
                                                    class="delete-btn"
                                                    onclick="return confirm(
                                                        'Delete this student?'
                                                    )"
                                                >

                                                    <i class="bi bi-trash"></i>

                                                    Delete

                                                </button>

                                            </form>


                                        @endif

                                    </td>


                                </tr>

                            @empty


                                <!-- =====================================
                                     NO STUDENTS
                                ====================================== -->

                                <tr>

                                    <td colspan="5">

                                        <div class="empty-state text-center">

                                            <div class="empty-icon">

                                                👨‍🎓

                                            </div>

                                            <h5>

                                                No Students Found

                                            </h5>

                                            <p class="mb-0">

                                                There are currently no student accounts.

                                            </p>

                                        </div>

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