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
<span>Staff <a href="{{ url('admin/staff/add') }}" class="btn btn-dark btn-color float-end">Add</a></span>
@endsection

@section('content')
<div class="container">
    <hr>
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($user as $row)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>
                    <a href="{{ url('admin/staff/'.$row->id.'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-fill"></i></a>
                    <a href="{{ url('admin/staff/'.$row->id.'/delete') }}" class="btn btn-danger btn-sm" onclick="return remove();"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection