@extends('layouts.admin.app')

@section('title', 'Search Invoice || ')

@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Search Date Wise Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item {{ request()->is('home/invoices/invoice-report-daily') ? 'active' : '' }}"><a href="{{ route('invoice.invoice-report-daily') }}">Search Invoice</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <span id="errMsg"></span>
            <div class="col-md-6 offset-3" id="searchInputDate">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Search Invoice</h3>
                    </div>
                    <div class="card-body">
{{--                        <form action="" method="post">--}}
{{--                            <p  style="color: brown;"></p>--}}
                            <div class="form-row" id="dateWiseInvoice">
                                <div class="form-group col-md-6">
                                    <label for="start_date">Start Invoice Date</label>
                                    <div class="input-group">
                                        <input class="form-control datetimepicker1" id="start_date" name="start_date" value="" placeholder="YYYY-MM-DD" width="550">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="end_date">End Invoice Date</label>
                                    <div class="input-group">
                                        <input class="form-control datetimepicker2" id="end_date" name="end_date" value="" placeholder="YYYY-MM-DD" width="550">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 offset-5">
                                    <button type="submit" class="btn btn-info searchDateWiseInvoice" id="">Search</button>
                                </div>
                            </div>
{{--                        </form>--}}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-12" id="searchDailyInvoiceReport"></div>

        </div>
    </section>
    <!-- /.content -->

@endsection


@push('js')
    <script type="text/javascript">
        // Date validation...
        // function dateFormValidate() {
        //     var val1, val2, inputDate;
        //     // Get the value of the input field with id="start_date"
        //     val1 = document.getElementById("start_date").value;
        //     val2 = document.getElementById("end_date").value;
        //
        //     // If x is Not a Number or less than one or greater than 10
        //     if (val1 == '' || val2 == '') {
        //         inputDate = "Please select a date!";
        //     }
        //     document.getElementById("errMsg").innerHTML = inputDate;
        // }

        $(document).ready(function() {
            // Check Date wise invoice using ajax call...
            $(document).on('click', '.searchDateWiseInvoice', function() {
                var start_date, end_date, inputDate, dateWiseMsg, csrf_token;
                csrf_token = $("meta[name='csrf-token']").attr('content');
                start_date = $('#start_date').val();
                end_date = $('#end_date').val();

                if (start_date == '' || end_date == '') {
                    inputDate = '<div class="alert alert-danger">' +
                                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                        '<strong>Error, Please Select a Start and End Date!</strong>' + '</div>';
                }
                $('#errMsg').html(inputDate);
                $('.loader-overlay').show();
                $.ajax({
                    url: '/home/invoices/invoice-report-daily-pdf',
                    data: { _token: csrf_token, start_date: start_date, end_date: end_date },
                    type: 'POST',
                    success: function(response) {
                        // $('#searchInputDate').hide();
                        $('#searchDailyInvoiceReport').html(response);
                        dateWiseMsg = '<div class="alert alert-danger">' +
                                        '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                        '<strong>' + response + '</strong>' + '</div>';
                        $('#errMsg').html(dateWiseMsg);
                        $('.loader-overlay').hide();

                    },
                    error: function() {
                        alert("Error, Something went wrong!");
                    },
                });

            });

        });
    </script>
@endpush
