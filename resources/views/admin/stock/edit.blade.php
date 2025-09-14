@extends('layouts.adminLayout')

@section('page-title')
<span>Edit Stock <a href="{{ url('admin/stock') }}" class="btn btn-dark btn-color float-end">Back</a></span>
@endsection

@section('content')
<div class="container">
    <hr>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/stock/'.$stock->id.'/update') }}" method="post">
                @csrf
                <div class="row-md-6 mt-3">
                    <label for="" class="form-label">Enter Stock</label>
                    <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity',$stock->quantity) }}" placeholder="Enter Stock">
                    @if ($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                    @endif
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="" class="form-label">Select Product</label>
                        <select name="product_code" id="" class="form-select @error('product_code') is-invalid @enderror">
                            @forelse ($product as $row)
                            @if ($row->status == '1')
                            <option value="{{ $row->code }}" {{ $row->code == $stock->product_code ? 'selected':'' }} >{{ $row->name }}</option>
                            @endif
                            @empty
                            <option value="">NA</option>
                            @endforelse
                        </select>
                        @if ($errors->has('product_code'))
                        <span class="text-danger">{{ $errors->first('product_code') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Select Wharehouse</label>
                        <select name="wharehouse" id="" class="form-select @error('wharehouse') is-invalid @enderror">
                            @forelse ($wharehouse as $row)
                            @if ($row->status == '1')
                            <option value="{{ $row->id }}" {{ $row->id == $stock->wharehouse_id ? 'selected':'' }} >{{ $row->name }}</option>
                            @endif
                            @empty
                            <option value="">NA</option>
                            @endforelse
                        </select>
                        @if ($errors->has('wharehouse'))
                        <span class="text-danger">{{ $errors->first('wharehouse') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row-md-6 mt-3">
                    <input type="submit" value="Save" class="btn btn-dark btn-color form-control">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection