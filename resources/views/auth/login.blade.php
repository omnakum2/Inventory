@extends('layouts.app')
@section('authContent')
@if (session('success'))
<div class="alert alert-danger">
    <strong>{{ session('success') }}</strong>
</div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <!-- Email Address -->
    <div>
        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus autocomplete="username" placeholder="Enter Email" />
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <!-- Password -->
    <div class="mt-3">
        <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" autocomplete="current-password" placeholder="Enter password" />
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <button class="btn btn-primary form-control mt-3">
        {{ __('Log in') }}
    </button>


    <div class="row mt-3">
        <div class="col">
            @if (Route::has('password.request'))
            <a class="text-decoration-none" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
        </div>
        <!-- <div class="col text-end">
            <a class="text-decoration-none" href="{{ route('auth.register') }}">
                <span class="text-muted">New User</span> {{ __('Register') }}
            </a>
        </div> -->
    </div>
</form>

@endsection