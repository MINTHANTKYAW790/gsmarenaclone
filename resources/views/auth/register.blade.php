@extends('layouts.application')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f8fafc 0%, #f26522 100%);
        min-height: 100vh;
    }
    .register-card {
        border: none;
        border-radius: 1.2rem;
        box-shadow: 0 6px 24px 0 rgba(31, 38, 135, 0.13);
        background: #fff;
        padding: 1.5rem 1.2rem;
        max-width: 380px;
        margin: 1rem auto;
        transition: box-shadow 0.3s;
    }
    .register-card:hover {
        box-shadow: 0 10px 32px 0 rgba(31, 38, 135, 0.16);
    }
    .register-header {
        font-size: 1.5rem;
        font-weight: 700;
        color: #f26522;
        text-align: center;
        margin-bottom: 1rem;
        letter-spacing: 1px;
    }
    .form-label {
        font-weight: 500;
        color: #333;
        font-size: 0.98rem;
        margin-bottom: 0.2rem;
    }
    .form-control {
        border-radius: 0.5rem;
        border: 1px solid #e0e0e0;
        padding: 0.5rem 0.8rem;
        font-size: 0.98rem;
        background: #f9f9f9;
        transition: border-color 0.2s;
    }
    .form-control:focus {
        border-color: #f26522;
        box-shadow: 0 0 0 0.08rem rgba(242, 101, 34, 0.13);
        background: #fff;
    }
    .btn-register {
        background: linear-gradient(90deg, #f26522 60%, #ff8c42 100%);
        color: #fff;
        border: none;
        border-radius: 0.5rem;
        padding: 0.6rem 1.2rem;
        font-size: 1rem;
        font-weight: 600;
        transition: background 0.2s;
        box-shadow: 0 2px 8px rgba(242, 101, 34, 0.08);
    }
    .btn-register:hover {
        background: linear-gradient(90deg, #ff8c42 60%, #f26522 100%);
        color: #fff;
    }
    .login-link {
        color: #f26522;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s;
        font-size: 0.97rem;
    }
    .login-link:hover {
        color: #ff8c42;
        text-decoration: underline;
    }
    .invalid-feedback {
        font-size: 0.92rem;
    }
    .role-group {
        display: flex;
        gap: 1.2rem;
        align-items: center;
        margin-bottom: 1rem;
    }
    .mb-2, .mb-4 {
        margin-bottom: 0.8rem !important;
    }
    .d-grid {
        margin-top: 0.5rem;
    }
</style>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 70vh;">
    <div class="register-card">
        <div class="register-header">{{ __('Register') }}</div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-2">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-2">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-2">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-2">
                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="role-group mb-2">
                <label class="form-label mb-0">{{ __('Role') }}:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="role_customer" value="customer" {{ old('role', 'customer') == 'customer' ? 'checked' : '' }}>
                    <label class="form-check-label" for="role_customer">
                        {{ __('Customer') }}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="role_admin" value="admin" {{ old('role') == 'admin' ? 'checked' : '' }}>
                    <label class="form-check-label" for="role_admin">
                        {{ __('Admin') }}
                    </label>
                </div>
            </div>

            <div class="mb-2 text-end">
                <span style="font-size:0.97rem;">Already have an account?
                    <a href="{{ route('login') }}" class="login-link">Login</a>
                </span>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-register">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection