@extends('layouts.admin.app')

@section('title', 'Change Status || ')

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
            <h1 class="m-0 text-dark">Manage Status</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/purchases/manage-status') ? 'active' : '' }}"><a href="{{ route('purchase.manage-status') }}">Manage Status</a></li>
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
                    <h3 class="card-title">Change Status List of Datatable</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                    <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Cat. Name</th>
                        <th>Sub Cat. Name</th>
                        <th>Pur. No</th>
                        <th>Pur. Date</th>
                        <th>Pro. Name</th>
                        <th>Desc</th>
                        <th>Pro. Stock</th>
                        <th>Unit Price</th>
                        <th>Buy. qty</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchases as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->category->name }}</td>
                        <td>{{ $data->sub_category ? $data->sub_category->name : 'Not Found' }}</td>
                        <td>{{ $data->purchase_no }}</td>
                        <td>{{ date('(D)-d-m-Y H:m a', strtotime($data->purchase_date)) }}</td>
                        <td>{{ $data->product->name }}</td>
                        <td>{{ $data->desc }}</td>
                        <td>{{ $data->product->qty }} {{ $data->unit->name }}</td>
                        <td>{{ $data->unit_price }}</td>
                        <td>{{ $data->buying_qty }} {{ $data->unit->name }}</td>
                        <td>{{ $data->buying_price }}</td>
                        <td>
                            @if($data->purchase_status === 'pending')
                            <span class="badge badge-pill {{ randomStatusColor($data->purchase_status) }} text-green">{{ ucwords($data->purchase_status) }}</span>
                            @else
                            <span class="badge badge-pill {{ randomStatusColor($data->purchase_status) }} text-light">{{ ucwords($data->purchase_status) }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('purchase.approved-status', base64_encode($data->id)) }}" class="btn btn-success btn-sm" id="approvedStatus" title="Approved Status"><i class="far fa-check-square"></i></a>
                            <a href="{{ route('purchase.return-status', base64_encode($data->id)) }}" class="btn btn-danger btn-sm" id="returnStatus" title="Return Status"><i class="fas fa-undo-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Sl No.</th>
                        <th>Cat. Name</th>
                        <th>Sub Cat. Name</th>
                        <th>Purch. No</th>
                        <th>Purch. Date</th>
                        <th>Pro. Name</th>
                        <th>Desc</th>
                        <th>Pro. Stock</th>
                        <th>Unit Price</th>
                        <th>Buy. qty</th>
                        <th>Total Price</th>
                        <th>Status</th>
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

</script>
@endpush
