@extends('layouts.admin.app')

@section('title', 'User Profile Manage || ')

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
            <h1 class="m-0 text-dark">Manage User Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/user/profile') ? 'active' : '' }}"><a href="{{ route('user.profile.index') }}">Manage User Profile</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-4 offset-md-4">

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
            
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ !empty($user->image) ? asset('uploads/users/profile/' . $user->image) : asset('uploads/users/default_no_image.png') }}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ ucfirst($user->name) }}</h3>

                <p class="text-muted text-center">{{ $user->address }}</p>

                <table class="table table-bordered table-striped table-hover mb-3" width="100%">
                    <tbody>
                        <tr>
                            <td>Email Address </td>
                            <td>{{  $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Mobile No. </td>
                            <td>{{  $user->phone }}</td>
                        </tr>
                        <tr>
                            <td>Gender </td>
                            <td>{{  $user->gender }}</td>
                        </tr>
                    </tbody>
                </table>

                <a href="{{ route('user.profile.edit') }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
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