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
<span>Invoice's </span>
@endsection

@section('content')
<div class="container">
    <hr>
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Customer Name</th>
                <th class="text-center">Customer Mobile</th>
                <th class="text-center">Date</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($bill as $row)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $row->customer_name }}</td>
                <td>{{ $row->customer_phone }}</td>
                <td>{{ $row->created_at }}</td>
                <td>₹ {{ $row->amount }}</td>
                <td class="text-center">
                    <a href="{{ url('staff/invoice/'.$row->id.'/detail') }}" class="btn btn-dark btn-sm"><i class="bi bi-eye"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection