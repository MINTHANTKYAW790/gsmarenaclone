<!-- resources/views/auth/login.blade.php -->

@extends('layouts.application')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f8fafc 0%, #f26522 100%);
        min-height: 100vh;
    }
    .login-card {
        border: none;
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        background: #fff;
        padding: 2.5rem 2rem;
        max-width: 400px;
        margin: 3rem auto;
        transition: box-shadow 0.3s;
    }
    .login-card:hover {
        box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.18);
    }
    .login-header {
        font-size: 2rem;
        font-weight: 700;
        color: #f26522;
        text-align: center;
        margin-bottom: 1.5rem;
        letter-spacing: 1px;
    }
    .form-label {
        font-weight: 500;
        color: #333;
    }
    .form-control {
        border-radius: 0.75rem;
        border: 1px solid #e0e0e0;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        background: #f9f9f9;
        transition: border-color 0.2s;
    }
    .form-control:focus {
        border-color: #f26522;
        box-shadow: 0 0 0 0.1rem rgba(242, 101, 34, 0.15);
        background: #fff;
    }
    .btn-login {
        background: linear-gradient(90deg, #f26522 60%, #ff8c42 100%);
        color: #fff;
        border: none;
        border-radius: 0.75rem;
        padding: 0.75rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        transition: background 0.2s;
        box-shadow: 0 2px 8px rgba(242, 101, 34, 0.08);
    }
    .btn-login:hover {
        background: linear-gradient(90deg, #ff8c42 60%, #f26522 100%);
        color: #fff;
    }
    .register-link {
        color: #f26522;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s;
    }
    .register-link:hover {
        color: #ff8c42;
        text-decoration: underline;
    }
    .invalid-feedback {
        font-size: 0.95rem;
    }
</style>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 90vh;">
    <div class="login-card">
        <div class="login-header">{{ __('Login') }}</div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3 text-end">
                <span>Don't have an account?
                    <a href="{{ route('register') }}" class="register-link">Register</a>
                </span>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-login">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection