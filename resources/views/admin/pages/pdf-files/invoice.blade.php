<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice - PDF</title>
    <link rel="stylesheet" href="{{ asset('assets/admin/custom/plugins/pdf-table/css/pdf-table.css') }}">
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="invoice">
                <div class="invoice">
                    <div style="">
                        <header>
                            <div class="row">
                                <div class="col" style="float: left;">
                                    <a target="_blank" href="" class="invoice-logo">
                                        <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" data-holder-rendered="true" />
                                    </a>
                                    <span class="logo-head"><h2>Product Sales </h2></span>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        <a target="_blank" href="#">
                                            Laravel Product Sales
                                        </a>
                                    </h2>
                                    <div>799/A, Chawttashari Road, Dhumpara, Wasa</div>
                                    <div>(+8801) 915-456-789</div>
                                    <div>product.sales@gmail.com</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 class="to">{{ $invoice->payment->customer->name }}</h2>
                                    <div class="address">{{ $invoice->payment->customer->address }}</div>
                                    <div class="email"><a href="#">{{ $invoice->payment->customer->email ? $invoice->payment->customer->email : 'NA' }}</a></div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">INVOICE #00{{ $invoice->invoice_no }}</h1>
                                    <div class="date">Date of Invoice: {{ date('(D)d/m/Y', strtotime($invoice->date)) }}</div>
                                    <div class="date">Due Date: NA</div>
                                </div>
                            </div>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th class="text-left">Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($sub_total = 0)
                                @foreach($invoice->invoice_details as $invoice_detail)
                                <tr>
                                    <td class="no">{{ $loop->iteration }}</td>
                                    <td>{{ $invoice_detail->category->name }}</td>
                                    <td class="text-left">{{ $invoice_detail->product->name }}</td>
                                    <td>{{ $invoice->desc }}</td>
                                    <td class="qty">{{ $invoice_detail->selling_qty }}</td>
                                    <td class="unit">&#2547;{{ $invoice_detail->unit_price }}</td>
                                    <td class="total">&#2547;{{ $invoice_detail->selling_price }}</td>
                                </tr>
                                @php($sub_total += $invoice_detail->selling_price)
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>SUBTOTAL</td>
                                    <td>&#2547;{{ $sub_total }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>DISCOUNT</td>
                                    <td>( - ) &#2547;{{ $invoice->payment->discount_amount }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>GRAND TOTAL</td>
                                    <td>&#2547;{{ $invoice->payment->total_amount }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>PAID AMOUNT</td>
                                    <td>&#2547;{{ $invoice->payment->paid_amount }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>DUE AMOUNT</td>
                                    <td>&#2547;{{ $invoice->payment->due_amount }}</td>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="thanks">
                                Thank you!
                                @php($date = new DateTime('now', new DateTimeZone('Asia/Dhaka')))
                                <p style="font-size: 10px;"><i>Print - Date/Time : {{ $date->format('F j, Y, g:i a') }}</i></p>
                            </div>
                            <div class="notices">
                                <div>NOTICE:</div>
                                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                            </div>
                        </main>
                        <footer>
                            Invoice was created on a computer and is valid without the signature and seal.
                        </footer>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
