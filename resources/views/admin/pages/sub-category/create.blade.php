@extends('layouts.admin.app')

@section('title', 'Sub Category Create || ')

@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Sub Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/sub-categories/create') ? 'active' : '' }}"><a href="{{ route('sub-category.create') }}">Create Sub Category</a></li>
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
                    <h3 class="card-title">Create Sub Category Form</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
              <form class="form-horizontal" id="subCategoryCreateForm" action="{{ route('sub-category.store') }}" method="POST">
                @csrf

                <div class="card-body">

                  <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="category_id">Category Name</label>
                      <select class="form-control select2" name="category_id" id="category_id" style="width: 100%;">
                          <option value="">Select Category Name</option>
                          @foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                          @error('category_id')
                          <span class="text-danger fade show">{{ $message }}</span>
                          @enderror
                      </select>
                  </div>
                    <div class="form-group col-md-6">
                        <label for="name">Sub Category Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Sub Category Name" value="{{ old('name') }}">
                        @error('name')
                        <p class="text-danger fade show">{{ $message }}</p>
                        @enderror
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Create Sub Category</button>
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
