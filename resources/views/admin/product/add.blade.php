@extends('layouts.adminLayout')

@section('page-title')
<span>Add Product<a href="{{ url('admin/product') }}" class="btn btn-dark btn-color float-end">Back</a></span>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/product/store') }}" method="post">
                @csrf
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="" class="form-label">Enter Product Code</label>
                        <input type="text" name="code" value="{{ old('code') }}" class="form-control @error('code') is-invalid @enderror" placeholder="Enter Code">
                        @if ($errors->has('price'))
                        <span class="text-danger">{{ $errors->first('code') }}</span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Enter Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter Name">
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Enter Price</label>
                        <input type="text" name="price" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror" placeholder="Enter Price">
                        @if ($errors->has('price'))
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="" class="form-label">Select Category</label>
                        <select name="category" id="" class="form-select @error('category') is-invalid @enderror">
                            @forelse ($categories as $row)
                                @if ($row->status == '1')
                                <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                                @endif
                            @empty
                            <option value="">NA</option>
                            @endforelse
                        </select>
                        @if ($errors->has('category'))
                        <span class="text-danger">{{ $errors->first('category') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Select Brand's</label>
                        <select name="brand" id="" class="form-select @error('brand') is-invalid @enderror">
                            @forelse ($brands as $row)
                            @if ($row->status == '1')
                            <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                            @endif
                            @empty
                            <option value="">NA</option>
                            @endforelse
                        </select>
                        @if ($errors->has('brand'))
                        <span class="text-danger">{{ $errors->first('brand') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="" class="form-label">Enter Description</label>
                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" placeholder="Enter Description">
                        @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <input type="submit" value="Add" class="btn btn-dark form-control">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection