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
            <span id="setMsg"></span>
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Create Purchase Form</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                     <div class="form-row">
                         <div class="form-group col-md-4">
                             <label for="supplier_id">Supplier Name</label>
                             <select class="form-control select2" name="supplier_id" id="supplier_id" style="width: 100%;">
                                 <option value="">Select Suppiler Name</option>
                                 @foreach($products as $supplier)
                                     <option value="{{ $supplier->supplier->id }}">{{ $supplier->supplier->name }}</option>
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
                                 <option value="0">Select Sub Category Name</option>
{{--                              @foreach($sub_categories as $sub_category)--}}
{{--                                  <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>--}}
{{--                              @endforeach--}}
                                 @error('sub_category_id')
                                 <span class="text-danger fade show">{{ $message }}</span>
                                 @enderror
                             </select>
                         </div>

                         <div class="form-group col-md-4">
                             <label for="unit_id">Unit Name</label>
                             <select class="form-control select2" name="unit_id" id="unit_id" style="width: 100%;">
                                 <option value="">Select Unit Name</option>
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
 {{--                      <div class="form-group col-md-4">--}}
 {{--                          <label for="Quantity">Product Quantity</label>--}}
 {{--                          <input type="number" name="qty" class="form-control" id="Quantity" placeholder="Enter Product Quantity"  value="{{ old('qty') }}">--}}
 {{--                          @error('qty')--}}
 {{--                          <p class="text-danger fade show">{{ $message }}</p>--}}
 {{--                          @enderror--}}
 {{--                      </div>--}}
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
                                 <input class="form-control datetimepicker" id="purchase_date" name="purchase_date" placeholder="YYYY-MM-DD HH:MM" width="550">
                             </div>
                         </div>

                         <div class="form-group col-md-4" style="padding: 32px;">
                             <button type="submit" class="btn btn-info addPurchaseData" id="">Add Purchase</button>
                         </div>

                     </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- form start -->
            <form class="form-horizontal" id="purchaseCreateForm" action="{{ route('purchase.store') }}" method="POST">
                @csrf
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Purchase List Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Cat. Name</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Unit Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="showPurchaseRowData" class="showPurchaseRowData">

                            </tbody>
                            <tr>
                                <td colspan="7" class="text-right">Grand Total : </td>
                                <td>
{{--                                Sub Total: <span class="sub-total" style="display: inline-block; width: 60%;"><input type="text" name="sub_total" class="form-control form-control-sm text-right sub_total" id="sub_total" value="0" placeholder="00.00" readonly style="background-color: rgba(19, 132, 150, 0.5); color: #fff;"></span> <br>--}}
{{--                                Vat/Tax <span class="vat-tax" style="display: inline-block; width: 66%;"><input type="text" name="vat_tax" class="form-control form-control-sm text-right vat_tax" id="vat_tax" value="" placeholder="00.00" style="background-color: rgba(19, 132, 150, 0.5); color: #fff;"></span> <br>--}}
                                    <input type="text" name="total_price" class="form-control form-control-sm text-right total_price" id="total_price" value="" placeholder="00.00" readonly style="background-color: rgba(19, 132, 150, 0.3); color: #fff;">
                                </td>
                                <td></td>
                            </tr>
                            <tfoot>
                            <tr>
                                <th>Sl No.</th>
                                <th>Cat. Name</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Unit Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                        <br>
                        <button type="submit" class="btn btn-info" id="createPurchase">Create Purchase</button>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->

@endsection


@push('js')

<script type="text/javascript">
    $(document).ready(function() {

      $(document).on('click', '.addPurchaseData', function() {
        var supplier_id = $('#supplier_id').val();
        var category_id = $('#category_id').val();
        var category_name = $('#category_id').find('option:selected').text();
        var sub_category_id = $('#sub_category_id').val();
        var sub_category_name = $('#sub_category_id').find('option:selected').text();
        var unit_id = $('#unit_id').val();
        var unit_name = $('#unit_id').find('option:selected').text();
        var product_id = $('#product_id').val();
        var product_name = $('#product_id').find('option:selected').text();
        var purchase_no = $('#purchase_no').val();
        var purchase_date = $('#purchase_date').val();

        if(supplier_id === '') {
            $.notify("Please Choose Suppiler Name!", {
                globalPosition: 'top center',
                className: 'error',
            });
            return false;
        }
        if(category_id === '') {
            $.notify("Please Choose Category Name!", {
                globalPosition: 'top center',
                className: 'error',
            });
            return false;
        }
        if(sub_category_id === '') {
            $.notify("Please Choose Sub Category Name!", {
                globalPosition: 'top center',
                className: 'error',
            });
            return false;
        }
        if(unit_id === '') {
            $.notify("Please Choose Unit Name!", {
                globalPosition: 'top center',
                className: 'error',
            });
            return false;
        }
        if(product_id === '') {
            $.notify("Please Choose Product Name!", {
                globalPosition: 'top center',
                className: 'error',
            });
            return false;
        }
        if(purchase_no === '') {
            $.notify("Please Enter Purchase Number!", {
                globalPosition: 'top center',
                className: 'error',
            });
            return false;
        }
        if(purchase_date === '') {
            $.notify("Please Enter Purchase Date!", {
                globalPosition: 'top center',
                className: 'error',
            });
            return false;
        }

        // $.ajax({
        //     url: '/home/purchases/check-product-stock/' + product_id,
        //     type: 'GET',
        //     success: function(response) {
        //         let pro_stock_qty = parseInt(response.qty);
        //         if(pro_stock_qty > 0) {
        //             $.notify("Success, Product has been stocked!", {
        //                 globalPosition: 'top center',
        //                 className: 'success',
        //             });
        //             return false;

        let loadRowData = $('#loadAddPurchaseDataTemplate').html();
        let loadTemplate = Handlebars.compile(loadRowData);
        var sl_no = '##';
        let data = {
            sl_no: sl_no,
            supplier_id: supplier_id,
            category_id: category_id,
            category_name: category_name,
            sub_category_id: sub_category_id != 0 ? sub_category_id : '',
            sub_category_name: sub_category_name,
            unit_id: unit_id,
            unit_name: unit_name,
            product_id: product_id,
            product_name: product_name,
            purchase_no: purchase_no,
            purchase_date: purchase_date,
        };

        let loadHtml = loadTemplate(data);
        $('#showPurchaseRowData').append(loadHtml);


        //         } else {
        //             $.notify("Failed, This product is out of stocked!", {
        //                 globalPosition: 'top center',
        //                 className: 'error',
        //             });
        //             return false;
        //         }
        //     },
        //     error: function() {
        //         alert("Something went wrong!");
        //     }
        // });



      });

      $(document).on('click', '.removePurchaseDataRow', function(event) {
         $(this).closest('.singlePurchaseDataRow').remove();
          subTotalPrice();
      });

        // $(document).on('keyup click', '.buying_qty', function() {
        //     var quantity = $(this).val();
        //     var csrf_token = $("meta[name='csrf-token']").attr('content');
        //     var product_id = $(this).closest('tr').find('input.product_id').val();
        //
        //         $.ajax({
        //             url: '/home/purchases/check-product-stock',
        //             type: 'POST',
        //             data: {
        //                 quantity: quantity, product_id: product_id, _token: csrf_token,
        //             },
        //             success: function (response) {
        //                 let pro_stock = parseInt(response);
        //                 if(pro_stock >= quantity) {
        //                     // alert("True");
        //                     $('#createPurchase').slideDown();

        $(document).on('keyup click', '.buying_qty, .unit_price, .vat_tax', function() {
            var buy_qty = $(this).closest('tr').find('input.buying_qty').val();
            var unit_price = $(this).closest('tr').find('input.unit_price').val();
            // var vat_tax = $(this).closest('tr').find('input.vat_tax').val();

            var sub_total = (buy_qty * unit_price);
            // let cal_vat = (sub_total * 3) / 100;
            // var cal_vat_tax = (sub_total * vat) / 100;
            var total = sub_total;

            $(this).closest('tr').find('input.buying_price').val(sub_total);
            // $(this).closest('tr').find('input.vat').val(cal_vat);
            $(this).closest('tr').find('input.total_price').val(total);
            subTotalPrice();

        });

      //                   }
      //                   else {
      //                       // alert("False");
      //                       $('#createPurchase').slideUp();
      //                       $.notify("Failed, Product is out of stocked!", {
      //                           globalPosition: 'top center',
      //                           className: 'error',
      //                       });
      //                       return false;
      //                   }
      //
      //               },
      //               error: function () {
      //                   alert("Something went wrong!");
      //               }
      //   });
      //
      //
      //
      // });

      function subTotalPrice() {
        var sum = 0;
        $('.buying_price').each(function() {
            var price = $(this).val();
            if(!isNaN(price) && price.length !== 0) {
                sum += parseFloat(price);
            }
        });
        // $('#sub_total').val(sum);
        $('#total_price').val(sum);
      }

      // $(document).on('keyup', '#vat_tax', function() {
      //     let total_price;
      //     var sub_total = $('#sub_total').val();
      //     var vat_tax = $(this).val();
      //     // total_price = parseFloat(sub_total) + parseFloat(sub_total * vat_tax);
      //     total_price = parseFloat(sub_total) + parseFloat(vat_tax);
      //     $('#total_price').val(total_price);
      //
      // });

    });
</script>

<script type="text/x-handlebars-template" id="loadAddPurchaseDataTemplate">

    <tr id="singlePurchaseDataRow" class="singlePurchaseDataRow">
        <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">
        <input type="hidden" name="sub_category_id[]" value="@{{ sub_category_id }}">
        <input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">
        <input type="hidden" name="purchase_date[]" value="@{{ purchase_date }}">
        <td>
            @{{ sl_no }}
        </td>
        <td>
            <input type="hidden" name="category_id[]" value="@{{ category_id }}">
            @{{ category_name }}
        </td>
        <td>
            <input type="hidden" name="product_id[]" class="product_id" value="@{{ product_id }}">
            @{{ product_name }}
        </td>
        <td>
            <textarea class="form-control form-control-sm" name="desc[]" id="desc" cols="25" rows="2"></textarea>
        </td>
        <td>
            <input type="hidden" name="unit_id[]" value="@{{ unit_id }}">
            @{{ unit_name }}
        </td>
        <td>
            <input type="number" min="1" class="form-control form-control-sm text-right buying_qty" name="buying_qty[]" id="buying_qty" value="1">
        </td>
        <td>
            <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]" id="unit_price" value="" placeholder="00.00">
        </td>
{{--        <td>--}}
{{--            <input type="text" name="vat" class="form-control form-control-sm text-right vat" id="vat" value="" placeholder="00.00" readonly>--}}
{{--        </td>--}}
        <td>
            <input type="text" class="form-control form-control-sm text-right buying_price" id="buying_price" name="buying_price[]" value="" placeholder="00.00" readonly>
        </td>
        <td>
            <i class="btn btn-danger btn-sm fa fa-window-close removePurchaseDataRow"></i>
        </td>
    </tr>

</script>

@endpush
