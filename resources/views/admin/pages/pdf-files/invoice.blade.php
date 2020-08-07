<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice - PDF</title>
    {{--    <link rel="stylesheet" href="{{ asset('assets/admin/custom/plugins/bootstrap/css/bootstrap.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('assets/admin/custom/plugins/pdf-table/css/pdf-table.css') }}">
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="invoice">
                <div class="invoice overflow-auto">
                    <div style="">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a target="_blank" href="">
                                        <img style="display: inline-block;" src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" data-holder-rendered="true" />
                                        <span><h2> Laravel Product Sales : </h2></span>
                                    </a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        <a target="_blank" href="https://lobianijs.com">
                                            Arboshiki
                                        </a>
                                    </h2>
                                    <div>455 Foggy Heights, AZ 85004, US</div>
                                    <div>(123) 456-789</div>
                                    <div>company@example.com</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 class="to">John Doe</h2>
                                    <div class="address">796 Silver Harbour, TX 79273, US</div>
                                    <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">INVOICE 3-2-1</h1>
                                    <div class="date">Date of Invoice: 01/10/2018</div>
                                    <div class="date">Due Date: 30/10/2018</div>
                                </div>
                            </div>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-left">DESCRIPTION</th>
                                    <th class="text-right">HOUR PRICE</th>
                                    <th class="text-right">HOURS</th>
                                    <th class="text-right">TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="no">04</td>
                                    <td class="text-left"><h3>
                                            <a target="_blank" href="https://www.youtube.com/channel/UC_UMEcP_kF0z4E6KbxCpV1w">
                                                Youtube channel
                                            </a>
                                        </h3>
                                        <a target="_blank" href="https://www.youtube.com/channel/UC_UMEcP_kF0z4E6KbxCpV1w">
                                            Useful videos
                                        </a>
                                        to improve your Javascript skills. Subscribe and stay tuned :)
                                    </td>
                                    <td class="unit">$0.00</td>
                                    <td class="qty">100</td>
                                    <td class="total">$0.00</td>
                                </tr>
                                <tr>
                                    <td class="no">01</td>
                                    <td class="text-left"><h3>Website Design</h3>Creating a recognizable design solution based on the company's existing visual identity</td>
                                    <td class="unit">$40.00</td>
                                    <td class="qty">30</td>
                                    <td class="total">$1,200.00</td>
                                </tr>
                                <tr>
                                    <td class="no">02</td>
                                    <td class="text-left"><h3>Website Development</h3>Developing a Content Management System-based Website</td>
                                    <td class="unit">$40.00</td>
                                    <td class="qty">80</td>
                                    <td class="total">$3,200.00</td>
                                </tr>
                                <tr>
                                    <td class="no">03</td>
                                    <td class="text-left"><h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)</td>
                                    <td class="unit">$40.00</td>
                                    <td class="qty">20</td>
                                    <td class="total">$800.00</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">SUBTOTAL</td>
                                    <td>$5,200.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">TAX 25%</td>
                                    <td>$1,300.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">GRAND TOTAL</td>
                                    <td>$6,500.00</td>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="thanks">Thank you!</div>
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


{{--<script src="{{ asset('assets/admin/custom/plugins/bootstrap/js/jquery.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/admin/custom/plugins/bootstrap/js/bootstrap.min.js') }}"></script>--}}
{{--<script>--}}
{{--    $('#printInvoice').click(function(){--}}
{{--        Popup($('.invoice')[0].outerHTML);--}}
{{--        function Popup(data)--}}
{{--        {--}}
{{--            window.print();--}}
{{--            return true;--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}
</body>
</html>
