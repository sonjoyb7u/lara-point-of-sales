@extends('layouts.admin.app')

@section('title', 'Product Edit || ')

@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/product/edit') ? 'active' : '' }}"><a href="{{ route('product.edit', base64_encode($product->id)) }}">Edit Product</a></li>
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
                    <h3 class="card-title">Edit Product Form</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
              <form class="form-horizontal" id="productCreateForm" action="{{ route('product.update', base64_encode($product->id)) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="supplier_id">Supplier Name</label>
                            <select class="form-control select2" name="supplier_id" id="supplier_id" style="width: 100%;">
                                <option value="">Select Suppiler Name</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ $supplier->id == $product->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                @endforeach
                                @error('supplier_id')
                                <span class="text-danger fade show">{{ $message }}</span>
                                @enderror
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category_id">Category Name</label>
                            <select class="form-control select2" name="category_id" id="category_id" style="width: 100%;">
                                <option value="">Select Category Name</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                                @error('category_id')
                                <span class="text-danger fade show">{{ $message }}</span>
                                @enderror
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="sub_category_id">Sub Category Name</label>
                            <select class="form-control select2" name="sub_category_id" id="sub_category_id" style="width: 100%;">
                                <option value="">Choose Sub Category Name</option>
                                @foreach($sub_categories as $sub_category)
                                    @if(empty($sub_category))
                                    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                    @else
                                    <option value="{{ $sub_category->id }}" {{ $sub_category->id == $product->sub_category_id ? 'selected' : '' }}>{{ $sub_category->name }}</option>
                                    @endif
                                @endforeach
                                @error('sub_category_id')
                                <span class="text-danger fade show">{{ $message }}</span>
                                @enderror
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="unit_id">Unit Name</label>
                            <select class="form-control select2" name="unit_id" id="unit_id" style="width: 100%;">
                                <option value="">Select Unit Name</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}" {{ $unit->id == $product->unit_id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                @endforeach
                                @error('unit_id')
                                <span class="text-danger fade show">{{ $message }}</span>
                                @enderror
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Product Name"  value="{{ $product->name }}">
                            @error('name')
                            <p class="text-danger fade show">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Quantity">Quantity</label>
                            <input type="number" name="qty" class="form-control" id="Quantity" placeholder="Enter Product Quantity"  value="{{ $product->qty }}">
                            @error('qty')
                            <p class="text-danger fade show">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Update Customer</button>
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
