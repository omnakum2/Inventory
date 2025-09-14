@extends('layouts.staffLayout')
@section('content')
<div class="invoice" id="bill">
    <div class="invoice-header">
        <h2>Invoice</h2>
    </div>
    <div class="customer-details">
        <div class="row">
            <div class="col">
                @foreach ($billdata as $row)@endforeach
                <p><strong>Customer Name:</strong> {{ $row->customer_name }} </p>
                <p><strong>Mobile:</strong> {{ $row->customer_phone }} </p>
            </div>
            <div class="col">
                <p class="text-end"><strong>Date:</strong> {{ $row->created_at }} </p>
            </div>
        </div>
    </div>
    <table class="invoice-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($billdata as $row)
            <tr>
                <td>{{ $row->product_code }}</td>
                <td>₹ {{ $row->product_price }}</td>
                <td>{{ $row->product_quantity }}</td>
                <td>{{ $row->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="invoice-total">
        <p><strong>Grand Total:</strong>{{ $row->amount }} </p>
    </div>
    <div class="invoice-footer">
        <p>Terms and Conditions Apply @IMS</p>
    </div>
</div>
<div class="text-center">
    <button class="btn btn-sm btn-dark m-2" onclick="billprint()">Print</button>
</div>
</body>
@push('customScript')
<script>
    function billprint() {
        var billContents = document.getElementById("bill").innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = billContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
@endpush
@endsection