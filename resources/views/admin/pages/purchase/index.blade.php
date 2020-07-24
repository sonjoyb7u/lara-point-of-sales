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
                        <th>Supp. Name</th>
                        <th>Cat. Name</th>
                        <th>Sub Cat. Name</th>
                        <th>Pur. No</th>
                        <th>Pur. Date</th>
                        <th>Product Name</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Buy. qty</th>
                        <th>Buy. Price</th>
                        <th>Total Price</th>
                        <th>Created By</th>
                        <th>Updated By</th>                     
                        <th>Pur. Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchases as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->supplier->name }}</td>
                        <td>{{ $data->category->name }}</td>
                        <td>{{ $data->sub_category ? $data->sub_category->name : 'Not Found' }}</td>
                        <td>{{ $data->purchase_no }}</td>
                        <td>{{ date('Y-m-d(F)', strtotime($data->purchase_date)) }}</td>
                        <td>{{ $data->product->name }}</td>
                        <td>{{ $data->unit->name }}</td>
                        <td>{{ $data->product->qty }}</td>
                        <td>{{ $data->unit_price }}</td>
                        <td>{{ $data->buying_qty }}</td>
                        <td>{{ $data->buying_price }}</td>
                        <td>{{ $data->buying_qty * $data->buying_price }}</td>
                        <td>{{ $data->created_by }}</td>
                        <td>{{ $data->updated_by }}</td>
                        <td>
                            <span class="badge badge-pill {{ randomStatusColor($data->status) }}">{{ $data->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('purchase.show', base64_encode($data->id)) }}" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('purchase.edit', base64_encode($data->id)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('purchase.delete', base64_encode($data->id)) }}" id="deleteData" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Sl No.</th>
                        <th>Supp. Name</th>
                        <th>Cat. Name</th>
                        <th>Sub Cat. Name</th>
                        <th>Pur. No</th>
                        <th>Pur. Date</th>
                        <th>Product Name</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Buy. qty</th>
                        <th>Buy. Price</th>
                        <th>Total Price</th>
                        <th>Created By</th>
                        <th>Updated By</th>
                        <th>Pur. Status</th>
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
