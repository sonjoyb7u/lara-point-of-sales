@extends('layouts.admin.app')

@section('title', 'User\'s Manage || ')

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
            <h1 class="m-0 text-dark">Manage User's</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/user') ? 'active' : '' }}"><a href="{{ route('user.index') }}">Manage User's</a></li>
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
            {{-- @includeIf('alert-message.notify-message') --}}
            {{-- Notify js... --}}
            @if (session()->has('success'))
                <script type="text/javascript">
                    $(function () {
                        $.notify("{{ session()->get('success') }}", { globalPosition: 'top right', className: 'success'});
                    });
                </script>
            @elseif(session()->has('error'))
                <script type="text/javascript">
                    $(function () {
                        $.notify("{{ session()->get('error') }}", { globalPosition: 'top right', className: 'error'});
                    });
                </script>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User's List of Datatable</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Image</th>
                        <th>Address</th>
                        <th>User Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_user_data as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>
                            <img width="80" height="60" src="{{ !empty($data->image) ? asset('uploads/users/profile/'.$data->image) : asset('uploads/users/default_no_image.png') }}" alt="{{ $data->image }}">
                        </td>
                        <td>{{ $data->address }}</td>
                        <td>
                            @if($data->user_type === 'super_admin')
                                Super Admin
                            @elseif($data->user_type === 'admin')
                                Admin
                            @else
                                Customer
                            @endif
                        </td>
                        <td>

                        <input type="checkbox" id="userStatusToggle" data-id="{{ $data->id }}" {{ $data->status == 'active' ? 'checked' : '' }}  data-toggle="toggle" data-size="xs" data-on="Active" data-off="InActive" data-onstyle="success" data-offstyle="danger" >

                            {{-- @if($data->status == 'active') --}}
                                {{-- <input type="hidden" name="inactive" value="inactive">
                                <button type="submit" id="userInActive" data-id="{{ $data->id }}" class="btn btn-success btn-sm"><i class="far fa-arrow-alt-circle-up"></i></button>
                                <span id="inActiveBtnLoad"></span> --}}
                            {{-- @else
                                <input type="hidden" name="active" value="active">
                                <button type="submit" id="userActive" data-id="{{ $data->id }}" class="btn btn-warning btn-sm"><i class="far fa-arrow-alt-circle-down"></i></button>
                                <span id="activeBtnLoad"></span>
                            @endif --}}

                        </td>
                        <td>
                            <a href="{{ route('user.show', base64_encode($data->id)) }}" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('user.edit', base64_encode($data->id)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('user.delete', base64_encode($data->id)) }}" id="deleteData" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Sl No.</th>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Mobile No.</th>
                        <th>Image</th>
                        <th>Address</th>
                        <th>User Type</th>
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

    $('body').on('change', '#userStatusToggle', function () {
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
            url: "/home/user/status",
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