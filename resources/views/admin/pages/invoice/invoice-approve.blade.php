
@extends('layouts.admin.app')

@section('title', 'Approved Detail || ')

@push('css')
    <style>
        /* .notifyjs-corner {
            z-index: 10000 !important;
        } */
    </style>
@endpush

@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Approve Detail</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item {{ request()->is('/home/invoices/invoice-approve/', base64_encode($invoice->id)) ? 'active' : '' }}"><a href="{{ route('invoice.invoice-approve', base64_encode($invoice->id)) }}">Approve Detail</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                @includeIf('alert-message.message')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Approve Detail List of Datatable</h3>
                        <span class="float-right"><strong>Invoice No : </strong>#00{{$invoice->invoice_no}}, <strong>Date : </strong>{{date('d(D)-m(F)-Y', strtotime($invoice->date))}}</span>
                    </div>
                    <!-- /.card-header -->

                    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                    <div id="invoiceApproveDetails"></div>

                </div>
                <!-- /.card -->

            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection


@push('js')
    <script>
        function loadInvoiceApproveDetails() {
            var token = $("meta[name='csrf-token']").attr('content');
            var invoice_id = $("input[name='invoice_id']").val();
            $('.loader-overlay').show();
            $.ajax({
                data: {invoice_id: invoice_id, _token: token},
                url: '/home/invoices/load-invoice-approve-detail',
                method: 'POST',
                // beforeSend: function (request) {
                //     return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                // },
                success:function (reponse) {
                    // console.log(results);
                    $('#invoiceApproveDetails').append(reponse);
                    $('.loader-overlay').hide();

                }

            });
        }
        loadInvoiceApproveDetails();
    </script>
@endpush




