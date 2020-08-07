@extends('layouts.admin.app')

@section('title', 'Invoice Create || ')

@section('main-content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item {{ request()->is('home/invoices/create') ? 'active' : '' }}"><a href="{{ route('invoice.create') }}">Create Invoice</a></li>
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
                    <h3 class="card-title">Create Invoice Form</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                     <div class="form-row">
                         <div class="form-group col-md-2 offset-md-5">
                               <label for="invoice_no">Invoice No.</label>
                               <input type="text" name="invoice_no" class="form-control" id="invoice_no" value="{{ $new_invoice_no }}" readonly style="background-color: rgba(19, 132, 150, 0.3); color: #fff;">
                         </div>
                     </div>
                    <div class="form-row">
                         <div class="form-group col-md-4">
                             <label for="date">Invoice Date</label>
                             <div class="input-group">
                                 <input class="form-control datetimepicker" id="date" name="date" value="" placeholder="YYYY-MM-DD HH:MM" width="550">
                             </div>
                         </div>
                         <div class="form-group col-md-4">
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
                        <div class="form-group col-md-2">
                            <label for="invoice_no">Product Stock</label>
                            <input type="text" name="qty" class="form-control" id="qty" value="" readonly style="background-color: rgba(19, 132, 150, 0.3); color: #fff;">
                        </div>

                         <div class="form-group col-md-4">
                             <button type="submit" class="btn btn-info addInvoiceData" id="">Add Invoice</button>
                         </div>

                     </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- form start -->
            <form class="form-horizontal" id="invoiceCreateForm" action="{{ route('invoice.store') }}" method="POST">
                @csrf
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Inovice List Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Cat. Name</th>
                                <th>Product Name</th>
                                <th>Unit Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Vat(3%)</th>
                                <th>Sub Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="showInvoiceRowData" class="showInvoiceRowData">

                            </tbody>
                            <tr>
                                <td colspan="7" class="text-right">Discount : </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm text-right discount_amount" name="discount_amount" id="discount_amount" placeholder="Enter discount amount..." >
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-right">Total : </td>
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
                                <th>Unit Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Vat(3%)</th>
                                <th>Sub Total</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="paid_status">Description</label>
                                <textarea class="form-control desc" name="desc" id="desc" placeholder="Write something here..."></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="paid_status">Paid Status</label>
                                <select name="paid_status" id="paid_status" class="form-control form-control-sm select2 paid_status">
                                    <option value="">Select Status</option>
                                    <option value="paid">Full Paid</option>
                                    <option value="due">Full Due</option>
                                    <option value="partial">Partial Paid</option>
                                </select>
                                <div class="form-row paid_amount mt-3" style="display: none;">
                                    <div class="form-group col-md-12">
                                        <label for="name">Partial Paid</label>
                                        <input type="text" class="form-control form-control-sm" name="paid_amount" placeholder="Enter Partial amount">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="">Customer Info</label>
                                <select name="customer_id" id="customer_id" class="form-control form-control-sm select2 customer_id">
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }} - ( {{ $customer->phone }} - {{ $customer->address }} )</option>
                                    @endforeach
                                    <option value="0" name="customer_">New Customer</option>
                                </select>

                                <div class="form-row customer_info mt-3" style="display: none;">
                                    <div class="form-group col-md-4">
                                        <label for="name">Customer Name</label>
                                        <input type="text" name="name" id="name" class="form-control form-control-sm name" placeholder="Enter New Customer Name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="email">Customer Email</label>
                                        <input type="text" name="email" id="email" class="form-control form-control-sm email" placeholder="Enter New Customer Email">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="phone">Customer Mobile</label>
                                        <input type="text" name="phone" id="phone" class="form-control form-control-sm phone" placeholder="Enter New Customer Mobile">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="address">Customer Address</label>
                                        <textarea class="form-control form-control-sm address" name="address" id="address" placeholder="Enter New Customer Address"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info" id="createInvoice">Create Invoice</button>
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

      $(document).on('click', '.addInvoiceData', function() {
        var invoice_no = $('#invoice_no').val();
        var category_id = $('#category_id').val();
        var category_name = $('#category_id').find('option:selected').text();
        var sub_category_id = $('#sub_category_id').val();
        var sub_category_name = $('#sub_category_id').find('option:selected').text();
        var unit_id = $('#unit_id').val();
        var unit_name = $('#unit_id').find('option:selected').text();
        var product_id = $('#product_id').val();
        var product_name = $('#product_id').find('option:selected').text();
        var date = $('#date').val();

        if(date === '') {
              $.notify("Please Enter Invoice Date!", {
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

        let loadRowData = $('#loadAddInvoiceDataTemplate').html();
        let loadTemplate = Handlebars.compile(loadRowData);
        var sl_no = '##';
        let data = {
            sl_no: sl_no,
            invoice_no: invoice_no,
            date: date,
            category_id: category_id,
            category_name: category_name,
            sub_category_id: sub_category_id != 0 ? sub_category_id : '',
            sub_category_name: sub_category_name,
            unit_id: unit_id,
            unit_name: unit_name,
            product_id: product_id,
            product_name: product_name,
        };

        let loadHtml = loadTemplate(data);
        $('#showInvoiceRowData').append(loadHtml);

      });

      $(document).on('click', '.removeInvoiceDataRow', function(event) {
         $(this).closest('.singleInvoiceDataRow').remove();
          subTotalPrice();
      });

      $(document).on('keyup click', '.selling_qty, .unit_price, .vat_tax', function() {
        var sell_qty = $(this).closest('tr').find('input.selling_qty').val();
        var unit_price = $(this).closest('tr').find('input.unit_price').val();
        var vat_tax = $(this).closest('tr').find('input.vat_tax').val();

        var sub_total = (sell_qty * unit_price);
        let cal_vat = (sub_total * 3) / 100;
        // var cal_vat_tax = (sub_total * vat) / 100;
        var total = sub_total + cal_vat;

        $(this).closest('tr').find('input.selling_price').val(total);
        $(this).closest('tr').find('input.vat').val(cal_vat);
        // $(this).closest('tr').find('input.total_price').val(total);
        $('#discount_amount').trigger('keyup');

      });

      $(document).on('keyup', '#discount_amount', function() {
          subTotalPrice();
      });

      function subTotalPrice() {
        var sum = 0;
        $('.selling_price').each(function() {
            var price = $(this).val();
            if(!isNaN(price) && price.length !== 0) {
                sum += parseFloat(price);
            }
        });
        var discount_amount = parseFloat($('#discount_amount').val());
        if(!isNaN(discount_amount) && discount_amount.length !== 0) {
              sum -= parseFloat(discount_amount);
        }
        // $('#sub_total').val(sum);
        $('#total_price').val(sum);
      }

    });

    $(document).ready(function () {
        // Show paid amount form js...
        $(document).on('change', '#paid_status', function () {
            var paid_status = $(this).val();
            if(paid_status === 'partial') {
                $('.paid_amount').slideDown();
            } else {
                $('.paid_amount').slideUp();
            }
        });
        // Show New customer form js...
        $(document).on('change', '#customer_id', function () {
            var new_customer = $(this).val();
            if(new_customer === '0') {
                $('.customer_info').slideDown();
            } else {
                $('.customer_info').slideUp();
            }
        });


    });


</script>

<script type="text/x-handlebars-template" id="loadAddInvoiceDataTemplate">

    <tr id="singleInvoiceDataRow" class="singleInvoiceDataRow">
        <input type="hidden" name="sub_category_id[]" value="@{{ sub_category_id }}">
        <input type="hidden" name="invoice_no" value="@{{ invoice_no }}">
        <input type="hidden" name="date" value="@{{ date }}">
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
            <input type="hidden" name="unit_id[]" value="@{{ unit_id }}">
            @{{ unit_name }}
        </td>
        <td>
            <input type="number" min="1" class="form-control form-control-sm text-right selling_qty" name="selling_qty[]" id="selling_qty" value="1">
        </td>
        <td>
            <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]" id="unit_price" value="" placeholder="00.00">
        </td>
        <td width="7%">
            <input type="text" name="vat" class="form-control form-control-sm text-right vat" id="vat" value="" placeholder="00.00" readonly>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm text-right selling_price" id="selling_price" name="selling_price[]" value="" placeholder="00.00" readonly>
        </td>
        <td>
            <i class="btn btn-danger btn-sm fa fa-window-close removeInvoiceDataRow"></i>
        </td>
    </tr>

</script>

@endpush
