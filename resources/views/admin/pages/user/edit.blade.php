@extends('layouts.admin.app')

@section('title', 'User Edit || ')

@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit User's</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/user/edit') ? 'active' : '' }}"><a href="{{ route('user.edit', $id) }}">Edit User</a></li>
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
                    <h3 class="card-title">Create User Form</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
              <form class="form-horizontal" id="inputForm" action="{{ route('user.update', base64_encode($user->id)) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                  <div class="form-row">  
                    <div class="form-group col-md-4 offset-4">
                        <label for="user_type">User Type</label>
                        <select class="form-control select2" name="user_type" id="user_type" style="width: 100%;">
                            <option value="">Choose User Type</option>
                            <option value="super_admin" {{ $user->user_type == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="customer" {{ $user->user_type == 'customer' ? 'selected' : '' }}>Customer</option>
                            @error('user_type')
                            <span class="text-danger fade show">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>
                  </div>

                  <div class="form-row">  
                    <div class="form-group col-md-6">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Full Name" value="{{ $user->name }}">
                        @error('name')
                        <p class="text-danger fade show">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email Address" value="{{ $user->email }}">
                        @error('email')
                        <p class="text-danger fade show">{{ $message }}</p>
                        @enderror
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Update User</button>
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