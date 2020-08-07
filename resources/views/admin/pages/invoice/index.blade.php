@extends('layouts.admin.app')

@section('title', 'Invoice Manage || ')

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
            <h1 class="m-0 text-dark">Manage Invoices</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/invoices') ? 'active' : '' }}"><a href="{{ route('invoice.index') }}">Manage Invoices</a></li>
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
                    <h3 class="card-title">Invoice List of Datatable</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                    <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Customer Info</th>
                        <th>Invoice No.</th>
                        <th>Invoice Date</th>
                        <th>Total Amount</th>
                        <th>Desc.</th>
                        <th>Created By</th>
                        <th>Updated By</th>
                        <th>Status</th>
                        <th width="10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->payment->customer->name }} ({{ $data->payment->customer->phone }})</td>
                        <td>##00{{ $data->invoice_no }}</td>
                        <td>{{ date('(D)-d-m-Y H:m a', strtotime($data->date)) }}</td>
                        <td>{{ $data->payment->total_amount + $data->payment->discount_amount }}</td>
                        <td>{{ $data->desc }}</td>
                        <td>{{ $data->created_by }}</td>
                        <td>{{ $data->updated_by }}</td>
                        <td width="10%">
                            @if($data->status === 'pending')
                                <span class="badge badge-pill {{ randomStatusColor($data->status) }} text-muted">{{ ucwords($data->status) }}</span>
                                <a href="{{route('invoice.invoice-approve', base64_encode($data->id)) }}" class="btn btn-success btn-sm" title="Approved Status"><i class="far fa-check-square"></i></a>
                            @else
                                <span class="badge badge-pill {{ randomStatusColor($data->status) }} text-light">{{ ucwords($data->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('invoice.show', base64_encode($data->id)) }}" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
                            @if($data->status === 'pending')
                            <a href="{{ route('invoice.delete', base64_encode($data->id)) }}" id="deleteData" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a>
                            @endif
                            @if($data->status === 'approved')
                                <button type="submit" id="invoiceDataPrint" data-id="{{ $data->id }}" class="btn btn-info btn-sm" title="Invoice Print" style="display: inline-block;"><i class="fas fa-print"></i></button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Sl No.</th>
                        <th>Customer Info</th>
                        <th>Invoice No.</th>
                        <th>Invoice Date</th>
                        <th>Total Amount</th>
                        <th>Desc.</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Updated By</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</section>
<!-- /.content -->

@endsection


@push('js')

    <script>
        $(function() {
            $(document).on('click', '#invoiceDataPrint', function() {
                // let csrf_token = $("meta[name='csrf-token']").attr('content');
                let invoice_id = $(this).data('id');
                $.ajax({
                    url: '/home/invoices/invoice-print/' + invoice_id,
                    type: 'GET',

                    success: function(data) {

                    },
                });
            });
        });
    </script>

@endpush
