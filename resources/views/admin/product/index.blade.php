@extends('layouts.adminLayout')

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
<span>Product's</span>
@endsection

@section('content')
<div class="container">
    <hr>
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Code</th>
                <th class="text-center">Name</th>
                <th class="text-center">Price</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($product as $row)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $row->code }}</td>
                <td>{{ $row->name }}</td>
                <td>₹ {{ $row->price }}</td>
                <td>
                    @if ($row->status == '1')
                    <a href="{{ url('admin/product/'.$row->id.'/toggle') }}" class="btn btn-success btn-sm">Active</a>
                    @else
                    <a href="{{ url('admin/product/'.$row->id.'/toggle') }}" class="btn btn-warning btn-sm">Deactive</a>
                    @endif
                </td>
                <td>
                    <a href="{{ url('admin/product/'.$row->id.'/detail') }}" class="btn btn-dark btn-sm"><i class="bi bi-eye"></i></a>
                    <a href="{{ url('admin/product/'.$row->id.'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-fill"></i></a>
                    <a href="{{ url('admin/product/'.$row->id.'/delete') }}" class="btn btn-danger btn-sm" onclick="return remove();"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection