@extends('layouts.admin.app')

@section('title', 'Product\'s Manage || ')

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
            <h1 class="m-0 text-dark">Manage Product's</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/products') ? 'active' : '' }}"><a href="{{ route('product.index') }}">Manage Product's</a></li>
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
                    <h3 class="card-title">Product's List of Datatable</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                    <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Supp Name</th>
                        <th>Cat Name</th>
                        <th>Sub Cat Name</th>
                        <th>Product Name</th>
                        <th>Product Slug</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Created By</th>   
                        <th>Updated By</th>                     
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->supplier->name }}</td>
                        <td>{{ $data->category->name }}</td>
                        <td>{{ $data->sub_category ? $data->sub_category->name : 'Not Found' }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->slug }}</td>
                        <td>{{ $data->unit->name }}</td>
                        <td>{{ $data->qty }}</td>
                        <td>{{ $data->created_by }}</td>
                        <td>{{ $data->updated_by }}</td>
                        <td>
                        <input type="checkbox" id="productStatusToggle" data-id="{{ $data->id }}" {{ $data->status == 'active' ? 'checked' : '' }}  data-toggle="toggle" data-size="xs" data-on="Active" data-off="InActive" data-onstyle="success" data-offstyle="danger" >
                        </td>
                        <td>
                            <a href="{{ route('product.show', base64_encode($data->id)) }}" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('product.edit', base64_encode($data->id)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                            @php
                                $count_product_id = App\Models\Purchase::with('product')->where('product_id', $data->id)->select('product_id')->count();
                            @endphp
                            @if($count_product_id < 1)
                            <a href="{{ route('product.delete', base64_encode($data->id)) }}" id="deleteData" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a>
                            @endif
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
                        <th>Product Name</th>
                        <th>Product Slug</th>
                        <th>Unit</th>
                        <th>Quantity</th>
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
