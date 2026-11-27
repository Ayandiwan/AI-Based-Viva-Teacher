@extends('layouts.app')

@section('content')

<div class="container py-5" style="margin-top:20px;">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">📚 Subject List</h2>

        <a href="{{ route('subjects.create') }}" class="btn btn-primary">
            + Add Subject
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-primary">

                    <tr>

                        <th width="80">
                            No
                        </th>

                        <th>
                            Subject Code
                        </th>

                        <th>
                            Subject Name
                        </th>

                        <th>
                            Description
                        </th>

                        <th width="300">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($subjects as $subject)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        {{-- Subject Code --}}
                        <td>
                            {{ $subject->subject_code }}
                        </td>

                        <td>
                            {{ $subject->subject_name }}
                        </td>

                        <td>
                            {{ $subject->description }}
                        </td>

                        <td>

                            <a href="{{ route('subjects.edit',$subject->id) }}"
                               class="btn btn-success btn-sm">
                                Edit
                            </a>


                            <form action="{{ route('subjects.destroy',$subject->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this subject?')">

                                    Delete

                                </button>

                            </form>


                            <a href="{{ route('questions.create',$subject->id) }}"
                               class="btn btn-primary btn-sm">

                                ➕ Add Viva Question

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="text-center text-muted">

                            No Subjects Found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection