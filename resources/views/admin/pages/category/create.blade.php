@extends('layouts.admin.app')

@section('title', 'Category Create || ')

@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/categories/create') ? 'active' : '' }}"><a href="{{ route('category.create') }}">Create Category</a></li>
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
                    <h3 class="card-title">Create Category Form</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
              <form class="form-horizontal" id="categoryCreateForm" action="{{ route('category.store') }}" method="POST">
                @csrf

                <div class="card-body">

                  <div class="form-row">  
                    <div class="form-group col-md-6">
                        <label for="name">Category Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Category Name" value="{{ old('name') }}">
                        @error('name')
                        <p class="text-danger fade show">{{ $message }}</p>
                        @enderror
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Create Category</button>
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
