@extends('layouts.staffLayout')

@section('page-title')
<span>New Invoice</span>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="h6 fw-bold mt-3">Bill No. #<span name="bill_no">{{ $bno = 'I1'}}</span></label>
                        <label class="h6 fw-bold mt-3 float-end">Date : <span name="bill_date"></span>{{ $date = date('d-m-Y') }}</label>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="" class="form-label">Enter Customer Name</label>
                        <input type="text" name="cname" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Enter Customer Mob no.</label>
                        <input type="text" name="cmob" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row justify-content-center">
                    <div id="show_items">
                        <div class="row">
                            <div class="col-md-3  mb-3">
                                <select name="products" id="products" class="form-select">
                                    <option>-Products-</option>
                                    @foreach ($product as $row)
                                    @if ($row->status == '1')
                                    <option value="{{ $row->code }}">{{ $row->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3  mb-3">
                                <input name="price" class="form-control" id="price" placeholder="00.00" readonly />
                            </div>
                            <div class="col-md-2  mb-3">
                                <input name="stock" class="form-control" id="stock" placeholder="stock" readonly />
                            </div>
                            <div class="col-md-3  mb-3">
                                <input type="text" name="quantity" class="form-control" placeholder="Enter Quantity">
                            </div>
                            <div class="col d-grid  mb-3">
                                <button type="button" class="btn btn-success addBtn"><i class="bi bi-plus-lg"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="scrollbox p-2">
                    <table id="billTable" class="table table-bordered" style="width:100%">
                        <thead class="text-center">
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    <p class="h4 fw-bold text-end">Grand Total : <span id="gt">0</span></p>
                    <div class="col-md-6 float-center">
                        <button type="submit" class="btn btn-dark form-control" id="saveBill">Generate</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('customScript')
<script>
    $(document).ready(function() {
        var billItems = [];

        $(".addBtn").click(function(e) {
            e.preventDefault();
            var productName = $('#products').val();
            var stock = parseInt($('input[id="stock"]').val());
            var quantity = parseInt($('input[name="quantity"]').val());
            var price = parseFloat($('input[name="price"]').val());

            if (isNaN(quantity) || quantity <= 0) {
                alert("Please enter quantity.");
                return;
            }

            if (isNaN(stock) || quantity >= stock) {
                alert("you cant enter quantity more than stock");
                return;
            }

            var item = {
                productName: productName,
                quantity: quantity,
                price: price
            };

            billItems.push(item);
            updateBillTable();
            clearForm();
        });

        function updateBillTable() {
            var tbody = $('#billTable tbody');
            var gt = $('#gt');
            tbody.empty();

            var gtotal = 0;
            billItems.forEach(function(item, index) {
                var row = '<tr>';
                row += '<td>' + item.productName + '</td>';
                row += '<td>' + item.price + '</td>';
                row += '<td>' + item.quantity + '</td>';
                row += '<td>' + item.quantity * item.price + '</td>';
                row += '<td> <button type="button" class="btn btn-danger btn-sm removeBtn"><i class="bi bi-x-lg"></i></button> </td>';
                row += '</tr>';
                gtotal += item.quantity * item.price;

                gt.html(gtotal);
                tbody.append(row);
            });
        }

        function clearForm() {
            $('input[name="products"]').val('');
            $('input[name="quantity"]').val('');
            $('input[name="price"]').val('');
            $('input[name="stock"]').val('');
        }

        function clearTable() {
            var tbody = $('#billTable tbody');
            tbody.empty();
        }

        function removeItem(index) {
            billItems.splice(index, 1);
            updateBillTable();
        }

        $(document).on('click', '.removeBtn', function() {
            var index = $(this).data('index');
            removeItem(index);
        });

        $("#saveBill").click(function(e) {
            e.preventDefault();
            var c_name = $('input[name="cname"]').val();
            var c_mob = $('input[name="cmob"]').val();

            // Prepare data for AJAX request
            var formData = {
                billItems: billItems,
                user: '{{ Auth::user()->id }}',
                gtotal: $('#gt').text(),
                cname: c_name,
                cmob: c_mob,
                _token: '{{csrf_token()}}'
            };

            //alert(JSON.stringify(formData));

            // Send AJAX request
            $.ajax({
                type: "POST",
                url: "/getdata",
                data: JSON.stringify(formData),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(response) {
                    alert(response.message);
                    // Optionally, you can clear the billItems array and update the bill table here
                    clearTable();
                    billItems = [];
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("An error occurred while saving the bill.");
                }
            });
        });

        $(document).ready(function() {
            $('#products').change(function() {
                var code = $(this).val();
                $.ajax({
                    url: '/getfill',
                    type: 'post',
                    data: 'id=' + code + '&_token={{csrf_token()}}',
                    success: function(res) {
                        $('#price').val(res.price),
                            $('#stock').val(res.quantity)
                    },
                    error: function() {
                        alert('erorr...')
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection