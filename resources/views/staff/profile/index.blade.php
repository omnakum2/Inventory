@extends('layouts.staffLayout')

@if ($message = Session::get('msg'))
<div class="toast-container position-absolute top-5 end-0">
    <div class="toast align-items-center bg-success text-light show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <strong>{{ $message }}</strong>
            </div>
            <button type="button" class="btn btn-lg text-light me-2 m-auto" data-bs-dismiss="toast"><i class="bi bi-x"></i></button>
        </div>
    </div>
</div>
@endif

@section('page-title')
<span>Edit Profile <a href="{{ url('staff/dashboard') }}" class="btn btn-dark btn-color float-end">Back</a></span>
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
            <form method="POST" action="{{ url('staff/profile/'.$user->id.'/update') }}">
                @csrf

                <!-- Name -->
                <div>
                    <input id="name" class="mt-3 form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name',$user->name) }}" autofocus autocomplete="name" placeholder="Enter Name" />
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mt-3">
                    <input id="email" class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email',$user->email) }}" autocomplete="username" placeholder="Enter Email" />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="flex items-center justify-end mt-3">
                    <button class="btn btn-dark form-control">
                        {{ __('Save Profile') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection