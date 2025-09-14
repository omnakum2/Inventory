@extends('layouts.app')
@section('authContent')
@if (session()->has('success'))
<div class="alert alert-success">
    <strong>{{ session()->get('success') }}</strong>
</div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div>
        <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" autofocus autocomplete="name" placeholder="Enter Name" />
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <!-- Email Address -->
    <div class="mt-3">
        <input id="email" class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email') }}" autocomplete="username" placeholder="Enter Email" />
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <!-- Password -->
    <div class="mt-3">
        <input id="password" class="form-control @error('password') is-invalid @enderror" type="text" name="password" autocomplete="new-password" placeholder="Enter Password" />
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mt-3">
        <input id="password_confirmation" class="form-control" type="text" name="password_confirmation" autocomplete="new-password" placeholder="Enter Confirm Password" />
    </div>

    <div class="flex items-center justify-end mt-3">
        <button class="btn btn-primary form-control">
            {{ __('Register') }}
        </button>
    </div>
    <p class="text-center mt-2">
        <a class="text-primary text-decoration-none" href="{{ route('login') }}">
            <span class="text-muted">Already User</span> {{ __('login') }}
        </a>
    </p>
</form>
@endsection