@extends('layouts.admin.app')

@section('title', 'Customer\'s Manage || ')

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
            <h1 class="m-0 text-dark">Manage Customer's</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/customer') ? 'active' : '' }}"><a href="{{ route('customer.index') }}">Manage Customer's</a></li>
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
                    <h3 class="card-title">Customer's List of Datatable</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Address</th>
                        <th>Created By</th>   
                        <th>Updated By</th>                     
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>{{ $data->address }}</td>
                        <td>{{ $data->created_by }}</td>
                        <td>{{ $data->updated_by }}</td>
                        <td>
                        <input type="checkbox" id="customerStatusToggle" data-id="{{ $data->id }}" {{ $data->status == 'active' ? 'checked' : '' }}  data-toggle="toggle" data-size="xs" data-on="Active" data-off="InActive" data-onstyle="success" data-offstyle="danger" >
                        </td>
                        <td>
                            <a href="{{ route('customer.show', base64_encode($data->id)) }}" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('customer.edit', base64_encode($data->id)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('customer.delete', base64_encode($data->id)) }}" id="deleteData" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Sl No.</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Address</th>
                        <th>Created By</th>   
                        <th>Updated By</th>                     
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

            $('body').on('change', '#customerStatusToggle', function () {
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
                    url: "/home/customers/status",
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
