<div class="card-body">
    <h4>Customer Information :</h4>
    <table id="example1" class="table table-striped table-responsive">
        <thead>
        </thead>
        <tbody>
        <tr>
            <td width="16%"><strong>Customer Name : </strong><p>{{ $invoice->payment->customer->name }}</p></td>
            <td width="17%"><strong>Customer Mobile : </strong><p>{{ $invoice->payment->customer->phone }}</p></td>
            <td><strong>Customer Address : </strong><p>{{ $invoice->payment->customer->address }}</p></td>
            <td><strong>Product Details : </strong><p>{{ $invoice->desc }}</p></td>
        </tr>
        </tbody>
    </table>
    <br><br>
    <h4>Invoice Details :</h4>
    <form action="{{ route('invoice.invoice-approve-create', base64_encode($invoice->id)) }}" method="post">
        @csrf
        <table id="example1" class="table table-bordered table-striped" width="100%">
            <thead>
            <tr>
                <th>Sl No.</th>
                <th>Category Name</th>
                <th>Sub Category Name</th>
                <th>Product Name</th>
                <th class="text-center bg-gradient-gray text-light">Current Stock</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
            </thead>
            <tbody>
            @php($sub_total = 0)
            @foreach($invoice->invoice_details as $invoice_detail)
                <tr>
                    <input type="hidden" name="invoice_detail_id[]" value="{{ $invoice_detail->id }}">
                    <input type="hidden" name="category_id[]" value="{{ $invoice_detail->category->id }}">
                    <input type="hidden" name="product_id[]" value="{{ $invoice_detail->product->id }}">
                    <input type="hidden" name="selling_qty[]" value="{{ $invoice_detail->selling_qty }}">

                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $invoice_detail->category->name }}</td>

                    <td>
                        @foreach($invoice_detail->category->sub_categories as $key => $sub_category)
                            {{ $key + 1 }} ) {{ $sub_category->name }}
                            <br>
                        @endforeach
                    </td>

                    <td>{{ $invoice_detail->product->name }}</td>
                    <td class="text-center bg-gradient-gray text-light">{{ $invoice_detail->product->qty }} {{ $invoice_detail->product->unit->name }}</td>
                    <td class="text-right">{{ $invoice_detail->selling_qty }}</td>
                    <td class="text-right">{{ $invoice_detail->unit_price }}&#2547;</td>
                    <td class="text-right">{{ $invoice_detail->selling_price }}&#2547;</td>
                </tr>
                @php($sub_total += $invoice_detail->selling_price)
            @endforeach
            <tr>
                <td class="text-right font-weight-bold" colspan="7">Sub Total :</td>
                <td class="text-right font-weight-bold">{{ $sub_total }}&#2547;</td>
            </tr>
            <tr>
                <td class="text-right font-weight-bold" colspan="7">Discount :</td>
                <td class="text-right font-weight-bold">( - ) {{ $invoice->payment->discount_amount }}&#2547;</td>
            </tr>
            <tr>
                <td class="text-right font-weight-bold" colspan="7">Grand Total :</td>
                <td class="text-right font-weight-bold">{{ $invoice->payment->total_amount }}&#2547;</td>
            </tr>
            <tr>
                <td class="text-right font-weight-bold" colspan="7">Paid Amount :</td>
                <td class="text-right font-weight-bold">{{ $invoice->payment->paid_amount }}&#2547;</td>
            </tr>
            <tr>
                <td class="text-right font-weight-bold" colspan="7">Due Amount :</td>
                <td class="text-right font-weight-bold">{{ $invoice->payment->due_amount }}&#2547;</td>
            </tr>
            </tbody>
            <tfooter>
                <tr>
                    <th>Sl No.</th>
                    <th>Category Name</th>
                    <th>Sub Category Name</th>
                    <th>Product Name</th>
                    <th class="text-center bg-gradient-gray text-light">Current Stock</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </tfooter>
        </table>
        <button type="submit" class="btn btn-primary float-right">Invoice Approved</button>
    </form>

</div>
<!-- /.card-body -->

@push('js')
    <script>

    </script>
@endpush
