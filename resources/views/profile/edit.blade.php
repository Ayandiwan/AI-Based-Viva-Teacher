@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-header bg-primary text-white py-3">
                    <h3 class="mb-0">👤 My Profile</h3>
                </div>

                <div class="card-body p-4">

                    @if(session('status') == 'profile-updated')
                        <div class="alert alert-success">
                            Profile updated successfully.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">

                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Full Name</label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', auth()->user()->name) }}"
                            >

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address</label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', auth()->user()->email) }}"
                            >

                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                💾 Update Profile
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection