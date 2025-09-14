@extends('layouts.adminLayout')

@section('page-title')
<span>Add Staff <a href="{{ url('admin/staff') }}" class="btn btn-dark btn-color float-end">Back</a></span>
@endsection

@section('content')
<div class="container">
    <hr>
    <div class="card">
        @if (session()->has('success'))
        <div class="alert alert-success">
            <strong>{{ session()->get('success') }}</strong>
        </div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ url('admin/staff/store') }}">
                @csrf

                <!-- Name -->
                <div>
                    <input id="name" class="mt-3 form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" autofocus autocomplete="name" placeholder="Enter Name" />
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
                    <button class="btn btn-dark form-control">
                        {{ __('Add') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection