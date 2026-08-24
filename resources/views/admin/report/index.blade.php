@extends('layouts.adminLayout')

@section('page-title')

<div class="row">
    <div class="col-md-4 d-flex">
        <span>Report's</span>
        <select name="report" id="myreport" class="form-select m-2">
            <option value="0">Monthly</option>
            <option value="1">Yearly</option>
        </select>
    </div>
    <div class="col text-end">
        <button class="btn btn-sm btn-dark m-2" id="printPdf"><i class="bi bi-download"></i> Download PDF</button>
        <button class="btn btn-sm btn-success m-2" onclick="exportExcel()"><i class="bi bi-file-earmark-excel"></i> Export Excel</button>
    </div>
</div>

@endsection

@section('content')
<div class="container">
    <hr>
    <div id="report">
        <p class="text-center fw-bold h5 m-3">Report</p>
        <table id="reportTable" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Month / Year</th>
                    <th class="text-center">Total Sales (₹)</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($monthlyData as $row)
                <tr>
                    <td>{{ $row->month_name }}</td>
                    <td>₹ {{ $row->total_amount }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('customScript')
<script>
    $(document).ready(function() {

        $('#myreport').change(function() {
            var selectedOption = $(this).val();

            $.ajax({
                url: '/admin/report/' + selectedOption,
                type: 'GET',
                success: function(response) {
                    //alert(response);
                    $('#reportTable tbody').empty();

                    $.each(response.data, function(index, item) {
                        $('#reportTable tbody').append('<tr><td>' + item.value + '</td><td>₹ ' + item.total_amount + '</td></tr>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('#printPdf').click(function() {
            //alert('aaaaaa')
            var billContents = document.getElementById("report").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = billContents;

            window.print();

            document.body.innerHTML = originalContents;
        });

        window.onafterprint = function() {
            location.reload();
        };
    });

    function exportExcel() {
        /* generate workbook object from table */
        var wb = XLSX.utils.table_to_book(document.getElementById('reportTable'));

        /* generate XLSX file and force a download */
        XLSX.writeFile(wb, 'report.xlsx');
    }
</script>
@endpush
@endsection