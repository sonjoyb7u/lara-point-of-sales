@extends('layouts.admin.app')

@section('title', 'Purchase Manage || ')

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
            <h1 class="m-0 text-dark">Manage Purchase</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/purchases') ? 'active' : '' }}"><a href="{{ route('purchase.index') }}">Manage Purchase</a></li>
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
                    <h3 class="card-title">Purchase List of Datatable</h3>
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
                        <td width="10%">
                            @if($data->purchase_status === 'pending')
                            <span class="badge badge-pill {{ randomStatusColor($data->purchase_status) }} text-green">{{ ucwords($data->purchase_status) }}</span>
                            <a href="{{ route('purchase.approved-status', base64_encode($data->id)) }}" class="btn btn-success btn-sm" id="approvedStatus" title="Approved Status"><i class="far fa-check-square"></i></a>
                            <a href="{{ route('purchase.return-status', base64_encode($data->id)) }}" class="btn btn-danger btn-sm" id="returnStatus" title="Return Status"><i class="fas fa-undo-alt"></i></a>
                            @elseif($data->purchase_status === 'approved')
                            <span class="badge badge-pill {{ randomStatusColor($data->purchase_status) }} text-yellow">{{ ucwords($data->purchase_status) }}</span>
                            <a href="{{ route('purchase.pending-status', base64_encode($data->id)) }}" class="btn btn-warning btn-sm" id="pendingStatus" title="Pending Status"><i class="far fa-pause-circle"></i></a>
                            <a href="{{ route('purchase.return-status', base64_encode($data->id)) }}" class="btn btn-danger btn-sm" id="returnStatus" title="Return Status"><i class="fas fa-undo-alt"></i></a>
                            @else
                            <span class="badge badge-pill {{ randomStatusColor($data->purchase_status) }} text-light">{{ ucwords($data->purchase_status) }}</span>
                            <a href="{{ route('purchase.pending-status', base64_encode($data->id)) }}" class="btn btn-warning btn-sm" id="pendingStatus" title="Pending Status"><i class="far fa-pause-circle"></i></a>
                            <a href="{{ route('purchase.approved-status', base64_encode($data->id)) }}" class="btn btn-success btn-sm" id="approvedStatus" title="Approved Status"><i class="far fa-check-square"></i></a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('purchase.show', base64_encode($data->id)) }}" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
{{--                            <a href="{{ route('purchase.edit', base64_encode($data->id)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>--}}
                            @if($data->purchase_status === 'pending')
                            <a href="{{ route('purchase.delete', base64_encode($data->id)) }}" id="deleteData" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a>
                            @elseif($data->purchase_status === 'return')
                            <a href="{{ route('purchase.delete', base64_encode($data->id)) }}" id="deleteData" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a>
                            @endif
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
        $(function () {

            $('body').on('change', '#productStatusToggle', function () {
                var token = $("meta[name='csrf-token']").attr('content');
                var id = $(this).attr('data-id');
                // console.log(id);

                if(this.checked) {
                    var status = 'active';
                } else {
                    var status = 'inactive';
                }
                // alert(status);

                $('.loader-overlay').show();
                $.ajax({
                    data: {id: id , status: status , _token: token},
                    url: "/home/products/status",
                    method: "POST",
                    success:function (response) {
                        // alert(response);
                    $('.loader-overlay').hide();

                    },
                    error:function () {
                        alert("Error!");
                    }
                });

            });

        });
    </script>

@endpush
