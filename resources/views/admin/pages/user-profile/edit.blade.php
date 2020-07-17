@extends('layouts.admin.app')

@section('title', 'User Profile Edit || ')

@push('css')
    <style>
        img.user_photo {
            width: 110px;
            height: 100px;
            border: 1px solid #000;

        }
        .user_image {
            display: none;
        }
        .click_custom_btn {
            margin-bottom: 5px;
        }
    </style>
@endpush

@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit User Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/user/profile/edit') ? 'active' : '' }}"><a href="{{ route('user.profile.edit') }}">User Profile Edit</a></li>
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
                    <h3 class="card-title">Edit User Profile</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
              <form class="form-horizontal" id="inputForm" action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">

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
                    <div class="form-group col-md-6">
                        <label for="phone">Mobile No.</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Mobile No." value="{{ $user->phone }}">
                        @error('phone')
                        <p class="text-danger fade show">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address">Address</label>
                        <textarea class="form-control" name="address" id="" cols="30" rows="1" placeholder="Enter Address">{{ $user->address }}</textarea> 
                        @error('address')
                        <p class="text-danger fade show">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="image">Change Profile Photo</label><br>
                        <input type="file" name="image" class="form-control user_image" id="user_image">
                        <button type="button" id="user_image" class="btn btn-info btn-sm click_custom_btn">Browse</button><br>
                        @error('image')
                        <p class="text-danger fade show">{{ $message }}</p>
                        @enderror
                        <img id="previewImage" class="user_photo" src="{{ !empty($user->image) ? asset('uploads/users/profile/' . $user->image) : asset('uploads/users/default_no Image.png') }}" alt="User Photo">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="gender">Gender</label>
                        <select class="form-control select2" name="gender" id="gender" style="width: 100%;">
                            <option value="">Choose Gender</option>
                            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $user->user_type == 'other' ? 'selected' : '' }}>Other</option>
                            @error('gender')
                            <span class="text-danger fade show">{{ $message }}</span>
                            @enderror
                        </select>
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

    $(document).ready(function (){

        $('body').on('click', '.click_custom_btn', function() {
            var id = $(this).attr('id');
            $('#' + id).click();
        });

        $('body').on('change', '#user_image', function(e) {
            e.preventDefault();
            var reader = new FileReader();
            $('#previewImage').slideUp();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
                $('#previewImage').slideDown();
            }
            reader.readAsDataURL(e.target.files['0']);
        });

    });
</script>

@endpush