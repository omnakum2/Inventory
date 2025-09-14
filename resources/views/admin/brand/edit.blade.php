@extends('layouts.adminLayout')

@section('page-title')
<span>Edit Brand <a href="{{ url('admin/brand') }}" class="btn btn-dark btn-color float-end">Back</a></span>
@endsection

@section('content')
<div class="container">
    <hr>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/brand/'.$brand->id.'/update') }}" method="post">
                @csrf
                <div class="row-md-6 mt-3">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$brand->brand_name) }}" placeholder="Enter Brand Name">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="row-md-6 mt-3">
                    <input type="submit" value="Save" class="btn btn-dark btn-color form-control">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection