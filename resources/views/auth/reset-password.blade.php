@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center align-items-center" style="min-height:80vh;">

        <div class="col-lg-5 col-md-7">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-5">

                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">
                            Reset Password
                        </h2>

                        <p class="text-muted">
                            Create a new password for your account.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ request()->route('token') }}">

                        <div class="mb-3">
                            <label class="form-label">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', request()->email) }}"
                                readonly>

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                New Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter new password"
                                required>

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Confirm Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Confirm password"
                                required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            🔒 Reset Password
                        </button>

                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            ← Back to Login
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection