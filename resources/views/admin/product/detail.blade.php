@extends('layouts.adminLayout')

@section('page-title')
<span>Product Description<a href="{{ url('admin/product') }}" class="btn btn-dark btn-color float-end">Back</a></span>
@endsection

@section('content')
<div class="container">
  <hr>
  <div class="card mt-5">
    <div class="card-header text-center bg-dark">
        <h3><span class="text-light">{{ $product->name }}</span></h3>
    </div>
    <div class="card-body mt-2">
      <p class="card-text fw-bold">Code: <span>{{ $product->code }}</span></p>
      <p class="card-text fw-bold">Description: <span>{{ $product->description }}</span></p>
      <p class="card-text fw-bold">Category: <span>{{ $product->category->category_name }}</span></p>
      <p class="card-text fw-bold">Brand: <span>{{ $product->brand->brand_name }}</span></p>
      <p class="card-text fw-bold">Price: ₹<span>{{ $product->price }}</span></p>
    </div>
  </div>
</div>
@endsection