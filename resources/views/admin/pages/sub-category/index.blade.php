@extends('layouts.admin.app')

@section('title', 'Sub Categories Manage || ')

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
            <h1 class="m-0 text-dark">Manage Sub Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/sub-categories') ? 'active' : '' }}"><a href="{{ route('sub-category.index') }}">Manage Sub Category</a></li>
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
                    <h3 class="card-title">Sub Categories List of Datatable</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Sub Category Slug</th>
                        <th>Created By</th>
                        <th>Updated By</th>                     
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sub_categories as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->category->name }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->slug }}</td>
                        <td>{{ $data->created_by }}({{ \Auth::user()->user_type == 'super_admin' ? 'Super Admin' : 'Admin' }})</td>
                        <td>{{ $data->updated_by }}({{ \Auth::user()->user_type == 'super_admin' ? 'Super Admin' : 'Admin' }})</td>
                        <td>
                        <input type="checkbox" id="subCategoryStatusToggle" data-id="{{ $data->id }}" {{ $data->status == 'active' ? 'checked' : '' }}  data-toggle="toggle" data-size="xs" data-on="Active" data-off="InActive" data-onstyle="success" data-offstyle="danger" >
                        </td>
                        <td>
                            <a href="{{ route('sub-category.show', base64_encode($data->id)) }}" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('sub-category.edit', base64_encode($data->id)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                            @php
                                $count_subcat_id = App\Models\Product::with('sub_category')->where('sub_category_id', $data->id)->select('sub_category_id')->count();
                            @endphp
                            @if($count_subcat_id < 1)
                            <a href="{{ route('sub-category.delete', base64_encode($data->id)) }}" id="deleteData" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Sl No.</th>
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Sub Category Slug</th>
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

            $('body').on('change', '#subCategoryStatusToggle', function () {
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
                    url: "/home/sub-categories/status",
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
