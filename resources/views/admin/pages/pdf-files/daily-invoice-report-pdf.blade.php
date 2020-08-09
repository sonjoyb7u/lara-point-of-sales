<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Invoice Report - PDF</title>
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
                            <hr>
                                <div style="width: 650px; margin: 0 auto; padding: 10px;"><strong>Date Range : </strong>{{ date('d(D)-m-Y', strtotime($start_date)) }} To {{ date('d(D)-m-Y', strtotime($end_date)) }}</div>
                        </header>
                        <main>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Customer Info</th>
                                    <th>Invoice No.</th>
                                    <th>Invoice Date</th>
                                    <th>Product Name</th>
                                    <th class="text-left">Description</th>
                                    <th>Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($grand_total = 0)
                                @php($discount = 0)
                                @foreach($invoices as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->payment->customer->name }} ({{ $data->payment->customer->phone }})</td>
                                        <td>##00{{ $data->invoice_no }}</td>
                                        <td>{{ date('(D)-d-m-Y H:m a', strtotime($data->date)) }}</td>
                                        <td>
                                            @foreach($data->invoice_details as $invoice_detail)
                                            {{ $invoice_detail->product->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $data->desc }}</td>
                                        <td>{{ $data->payment->total_amount + $data->payment->discount_amount }}</td>
                                    </tr>
                                    @php($grand_total += $data->payment->total_amount)
                                    @php($discount += $data->payment->discount_amount)
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>DISCOUNT</td>
                                    <td>( - ) &#2547;{{ $discount }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>GRAND TOTAL</td>
                                    <td>&#2547;{{ $grand_total }}</td>
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

