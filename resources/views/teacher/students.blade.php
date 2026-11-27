@extends('layouts.app')

@section('title', 'Manage Students')

@section('content')

<div class="container py-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                👨‍🎓 Manage Students
            </h2>

            <p class="text-muted mb-0">
                View all registered students.
            </p>

        </div>

        <a href="{{ route('teacher.dashboard') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>
            Back to Dashboard

        </a>

    </div>


    <!-- Students Card -->

    <div class="card shadow border-0 rounded-4 overflow-hidden">

        <div class="card-header bg-primary text-white py-3">

            <h5 class="mb-0">

                <i class="bi bi-people-fill"></i>

                Students

                <span class="badge bg-light text-primary ms-2">

                    {{ $students->count() }}

                </span>

            </h5>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="px-4">
                                #
                            </th>

                            <th>
                                Student Name
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Registered
                            </th>

                            <th>
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($students as $student)

                            <tr>

                                <td class="px-4">

                                    {{ $loop->iteration }}

                                </td>


                                <td>

                                    <div class="d-flex align-items-center">

                                        <div class="bg-primary text-white rounded-circle
                                                    d-flex align-items-center justify-content-center me-2"
                                             style="width:40px;height:40px;">

                                            {{ strtoupper(substr($student->name, 0, 1)) }}

                                        </div>

                                        <strong>

                                            {{ $student->name }}

                                        </strong>

                                    </div>

                                </td>


                                <td>

                                    {{ $student->email }}

                                </td>


                                <td>

                                    {{ $student->created_at->format('d M Y') }}

                                </td>


                                <td>

                                    @if($student->deleted_at)

                                        <span class="badge bg-danger">

                                            Deactive

                                        </span>

                                    @else

                                        <span class="badge bg-success">

                                            Active

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center py-5 text-muted">

                                    <i class="bi bi-people fs-1 d-block mb-3"></i>

                                    No students found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection