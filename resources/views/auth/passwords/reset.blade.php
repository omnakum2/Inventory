@extends('layouts.app')

@section('authContent')
<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <!-- Email Address -->
    <div class="mt-3">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

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

    <div class="mt-3">
        <button type="submit" class="form-control btn btn-primary">
            {{ __('Reset Password') }}
        </button>
    </div>
</form>
@endsection