@extends('layouts.admin.app')

@section('title', 'Purchase Create || ')

@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Purchase</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/purchases/create') ? 'active' : '' }}"><a href="{{ route('purchase.create') }}">Create Purchase</a></li>
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
                    <h3 class="card-title">Create Purchase Form</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
              <form class="form-horizontal" id="purchaseCreateForm addPurchaseData" action="{{ route('purchase.store') }}" method="POST">
                @csrf

                <div class="card-body">

                  <div class="form-row">
                      <div class="form-group col-md-4">
                          <label for="supplier_id">Supplier Name</label>
                          <select class="form-control select2" name="supplier_id" id="supplier_id" style="width: 100%;">
                              <option value="">Select Suppiler Name</option>
                              @foreach($suppliers as $supplier)
                              <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                              @endforeach
                              @error('supplier_id')
                              <span class="text-danger fade show">{{ $message }}</span>
                              @enderror
                          </select>
                      </div>
                      <div class="form-group col-md-4">
                          <label for="category_id">Category Name</label>
                          <select class="form-control select2" name="category_id" id="category_id" style="width: 100%;">
                              <option value="">Select Category Name</option>
{{--                              @foreach($categories as $category)--}}
{{--                                  <option value="{{ $category->id }}">{{ $category->name }}</option>--}}
{{--                              @endforeach--}}
                              @error('category_id')
                              <span class="text-danger fade show">{{ $message }}</span>
                              @enderror
                          </select>
                      </div>
                      <div class="form-group col-md-4">
                          <label for="sub_category_id">Sub Category Name</label>
                          <select class="form-control select2" name="sub_category_id" id="sub_category_id" style="width: 100%;">
                              <option value="">Choose Sub Category Name</option>
{{--                              @foreach($sub_categories as $sub_category)--}}
{{--                                  <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>--}}
{{--                              @endforeach--}}
                              @error('sub_category_id')
                              <span class="text-danger fade show">{{ $message }}</span>
                              @enderror
                          </select>
                      </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-4">
                          <label for="unit_id">Unit Name</label>
                          <select class="form-control select2" name="unit_id" id="unit_id" style="width: 100%;">
                              <option value="">Choose Unit Name</option>
{{--                              @foreach($units as $unit)--}}
{{--                                  <option value="{{ $unit->id }}">{{ $unit->name }}</option>--}}
{{--                              @endforeach--}}
                              @error('unit_id')
                              <span class="text-danger fade show">{{ $message }}</span>
                              @enderror
                          </select>
                      </div>
                      <div class="form-group col-md-4">
                          <label for="product_id">Product Name</label>
                          <select class="form-control select2" name="product_id" id="product_id" style="width: 100%;">
                              <option value="">Select Product Name</option>
{{--                              @foreach($products as $product)--}}
{{--                                  <option value="{{ $product->id }}">{{ $product->name }}</option>--}}
{{--                              @endforeach--}}
                              @error('product_id')
                              <span class="text-danger fade show">{{ $message }}</span>
                              @enderror
                          </select>
                      </div>
                      <div class="form-group col-md-4">
                          <label for="Quantity">Product Quantity</label>
                          <input type="number" name="qty" class="form-control" id="Quantity" placeholder="Enter Product Quantity"  value="{{ old('qty') }}">
                          @error('qty')
                          <p class="text-danger fade show">{{ $message }}</p>
                          @enderror
                      </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-4">
                          <label for="purchase_no">Purchase Number</label>
                          <input type="text" name="purchase_no" class="form-control" id="purchase_no" placeholder="Enter Purchase Number"  value="{{ old('purchase_no') }}">
                          @error('qty')
                          <p class="text-danger fade show">{{ $message }}</p>
                          @enderror
                      </div>
                      <div class="form-group col-md-4">
                          <label for="purchase_date">Purchase Date</label>
                          <div class="input-group">
                              <input class="form-control datetimepicker" id="datetime" placeholder="YYYY-MM-DD HH:MM AM" width="550">
                          </div>
                      </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" id="addPurchase">Add Purchase</button>
                </div>
                <!-- /.card-footer -->

                  <div class="card-body">
                      <table class="table table-bordered table-striped">
                          <thead>
                          <tr>
                              <th>Sl No.</th>
                              <th>Cat. Name</th>
                              <th>Product Name</th>
                              <th>Description</th>
                              <th>Unit</th>
                              <th>Buy. qty</th>
                              <th>Unit Price</th>
                              <th>Total Price</th>
                              <th>Action</th>
                          </tr>
                          </thead>
                          <tbody id="addPurchaseRowData" class="addPurchaseRowData">
                              
                          </tbody>
                          <tbody>
                          <tr>
                              <td colspan="7"></td>
                              <td>
                                  Total :
                                  <input type="text" name="total_price" class="form-control form-control-sm text-right total_price" id="totsl_price" value="00.00" readonly>
                              </td>
                              <td></td>
                          </tr>
                          </tbody>
                          <tfoot>
                          <tr>
                              <th>Sl No.</th>
                              <th>Cat. Name</th>
                              <th>Product Name</th>
                              <th>Description</th>
                              <th>Unit</th>
                              <th>Buy. qty</th>
                              <th>Unit Price</th>
                              <th>Total Price</th>
                              <th>Action</th>
                          </tr>
                          </tfoot>
                      </table>
                      <br>
                      <div class="form-group">
                          <button type="submit" class="btn btn-info" id="purchaseStore">Purchase Store</button>
                      </div>
                  </div>
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
    $(function() {
        // Supplier wise Category return Data ajax call using jquery...
        $(document).on('change', '#supplier_id', function() {
            var csrf_token = $("meta[name='csrf-token']").attr('content');
            var supplier_id = $(this).val();
            $.ajax({
                url: '/home/purchases/supp-wise-cat',
                type: 'POST',
                data: {
                    supplier_id: supplier_id, _token: csrf_token,
                },
                success: function(data) {
                    var html = '<option value="">Select Category Name</option>';
                    $.each(data, function(key, val) {
                        html += '<option value="' + val.category_id + '">' + val.category.name + '</option>';
                    });
                    $('#category_id').html(html);
                },
                error: function() {
                    alert('Error!');
                },
            });
        });

        // Category wise Sub category Data return ajax call using jquery...
        $(document).on('change', '#category_id', function() {
            var csrf_token = $("meta[name='csrf-token']").attr('content');
            var category_id = $(this).val();
            $.ajax({
                url: '/home/purchases/cat-wise-subcat',
                type: 'POST',
                data: {
                    category_id: category_id, _token: csrf_token,
                },
                success: function(data) {
                    var html = '<option value="">Choose Sub Category Name</option>';
                    $.each(data, function(key, val) {
                        html += '<option value="' + val.sub_category_id + '">' + val.sub_category.name  + '</option>'
                    });
                    $('#sub_category_id').html(html);
                },
                error: function() {
                    alert('Error!');
                },
            });

        });

        // Category wise Unit Data return ajax call using jquery...
        $(document).on('change', '#category_id', function() {
            var csrf_token = $("meta[name='csrf-token']").attr('content');
            var category_id = $(this).val();
            $.ajax({
                url: '/home/purchases/cat-wise-unit',
                type: 'POST',
                data: {
                    category_id: category_id, _token: csrf_token,
                },
                success: function(data) {
                    var html = '<option value="">Choose Unit Name</option>';
                    $.each(data, function(key, val) {
                        html += '<option value="' + val.unit_id + '">' + val.unit.name  + '</option>';
                    });
                    $('#unit_id').html(html);
                },
                error: function() {
                    alert('Error!');
                },
            });

        });

        // Category wise Product Data return ajax call using jquery...
        $(document).on('change', '#category_id', function() {
            var csrf_token = $("meta[name='csrf-token']").attr('content');
            var category_id = $(this).val();
            $.ajax({
                url: '/home/purchases/cat-wise-product',
                type: 'POST',
                data: {
                    category_id: category_id, _token: csrf_token,
                },
                success: function(data) {
                    var html = '<option value="">Choose Product Name</option>';
                    $.each(data, function(key, val) {
                        html += '<option value="' + val.id + '">' + val.name  + '</option>';
                    });
                    $('#product_id').html(html);
                },
                error: function() {
                    alert('Error!');
                },
            });

        });

    });
</script>

<script type="text/x-handlebars-template" id="loadRowDataTemplate">
    <tr id="addMoreData" class="addMoreData">
        <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">
        <input type="hidden" name="sub_category_id[]" value="@{{ sub_category_id }}">
        <input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">
        <input type="hidden" name="purchase_date[]" value="@{{ purchase_date }}">
        <td>
            Sl. No.
        </td>
        <td>
            <input type="hidden" name="category_id[]" value="@{{ category_id }}">
            @{{ category_name }}
        </td>
        <td>
            <input type="hidden" name="product_id[]" value="@{{ product_id }}">
            @{{ product_name }}
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="desc[]" value="@{{ desc }}">
            @{{ Desc }}
        </td>
        <td>
            <input type="hidden" name="unit_id[]" value="@{{ unit_id }}">
            @{{ unit_name }}
        </td>
        <td>
            <input type="number" min="1" class="form-control form-control-sm text-right buying_qty" name="buying_qty[]" value="1">
        </td>
        <td>
            <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="00.00">
        </td>
        <td>
            <input type="hidden" class="form-control form-control-sm text-right buying_price" name="buying_price[]" value="00.00" readonly>
        </td>
        <td>
            <span class="btn btn-danger btn-sm removeMoreData"><i class="fas fa-window-close"></i></span>
        </td>
    </tr>
</script>

@endpush
