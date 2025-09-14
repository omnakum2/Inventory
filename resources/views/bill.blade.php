@extends('layouts.adminLayout')

@section('page-title')
<span>New Invoice</span>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row justify-content-center">
            <form action="">
                <div id="show_items">
                    <div class="row mt-3">
                        <div class="col-5  mb-3">
                            <select name="products[]" id="products" class="form-select">
                                <option>-Products-</option>
                                <option value="aaa">aaa</option>
                                <option value="bbb">bbb</option>
                                <option value="ccc">ccc</option>
                                <option value="ddd">ddd</option>
                            </select>
                        </div>
                        <div class="col-3  mb-3">
                            <input type="text" name="price[]" class="form-control" placeholder="Enter Price">
                        </div>
                        <div class="col-3  mb-3">
                            <input type="text" name="qty[]" class="form-control" placeholder="Enter Quantity">
                        </div>
                        <div class="col d-grid  mb-3">
                            <button type="button" class="btn btn-success addBtn"><i class="bi bi-plus-lg"></i></button>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <button type="submit" class="btn btn-dark form-control" id="addSubmit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('customScript')
<script>
    $(document).ready(function() {
        $(".addBtn").click(function(e) {
            e.preventDefault();
            $("#show_items").prepend(`
                <div class="row mt-3">
                    <div class="col-5 mb-3">
                        <select name="products[]" id="products" class="form-select">
                            <option>-Products-</option>
                            <option value="aaa">aaa</option>
                            <option value="bbb">bbb</option>
                            <option value="ccc">ccc</option>
                            <option value="ddd">ddd</option>
                        </select>
                    </div>
                    <div class="col-3 mb-3">
                        <input type="text" name="price[]" class="form-control" placeholder="Enter Price">
                    </div>
                    <div class="col-3 mb-3">
                        <input type="text" name="qty[]" class="form-control" placeholder="Enter Quantity">
                    </div>
                    <div class="col d-grid mb-3">
                        <button type="button" class="btn btn-danger removeBtn"><i class="bi bi-x-lg"></i></button>
                    </div>
                </div>`);
        });

        $(document).on('click', '.removeBtn', function(e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        })
    });
</script>
@endpush
@endsection