@extends('layouts.admin.app')

@section('title', 'User Password Edit || ')

@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit User Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/user/profile/password/edit') ? 'active' : '' }}"><a href="{{ route('user.profile.password.edit') }}">Edit User Password</a></li>
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
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Edit User Password</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
              <form class="form-horizontal" id="passwordForm" action="{{ route('user.profile.password.update') }}" method="POST">
                @csrf

                <div class="card-body">

                  <div class="form-row">  
                    <div class="form-group col-md-6 offset-md-3">
                        <label for="old_password">Old Password</label>
                        <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Enter Old Password">
                        @error('password')
                        <p class="text-danger fade show">{{ $message }}</p>
                        @enderror
                    </div>
                  </div>

                  <div class="form-row">  
                    <div class="form-group col-md-6">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Enter New Password">
                        @error('password')
                        <p class="text-danger fade show">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="again_new_password">Retype New Password</label>
                        <input type="password" name="again_new_password" id="again_new_password" class="form-control" placeholder="Enter New password again">
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Update User Paasoword</button>
                </div>
                <!-- /.card-footer -->
              </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</section>
<!-- /.content -->

@endsection


@push('js')

<script type="text/javascript">
  
</script>

@endpush