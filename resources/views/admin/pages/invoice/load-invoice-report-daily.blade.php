<div class="card">
    <div class="card-header">
        <h3 class="card-title">Search Daily Invoice Report List of Datatable</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th>Sl No.</th>
                <th>Customer Info</th>
                <th>Invoice No.</th>
                <th>Invoice Date</th>
                <th>Description</th>
                <th>Discount</th>
                <th>Sub Total</th>
                <th>Status</th>
                <th width="10%">Action</th>
            </tr>
            </thead>
            <tbody>
            @php($sub_total = 0)
            @php($discount = 0)
            @foreach($invoices as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->payment->customer->name }} ({{ $data->payment->customer->phone }})</td>
                    <td>##00{{ $data->invoice_no }}</td>
                    <td>{{ date('(D)-d-m-Y H:m a', strtotime($data->date)) }}</td>
                    <td>{{ $data->desc }}</td>
                    <td>{{ $data->payment->discount_amount }}</td>
                    <td>
                        {{ $data->payment->total_amount + $data->payment->discount_amount }}
                    </td>
                    <td width="10%">
                        @if($data->status === 'approved')
                            <span class="badge badge-pill {{ randomStatusColor($data->status) }} text-light">{{ ucwords($data->status) }}</span>
                        @else
                            <span class="badge badge-pill {{ randomStatusColor($data->status) }} text-muted">{{ ucwords($data->status) }}</span>
                        @endif
                    </td>
                    <td>
                        @if($data->status === 'approved')
                            <form action="{{ route('invoice.invoice-daily-report-pdf-print') }}" method="post">
                                @csrf
                                <input type="hidden" name="start_date" value="{{ $start_date }}">
                                <input type="hidden" name="end_date" value="{{ $end_date }}">
                                <input type="hidden" name="invoice_id" value="{{ base64_encode($data->id) }}">
                                <button type="submit" id="invoiceDailyReportPrint" data-id="{{ $data->id }}" class="btn btn-info btn-sm" title="Daily Invoice Report Print" style="display: inline-block;"><i class="fas fa-print"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
                @php($sub_total += $data->payment->total_amount + $data->payment->discount_amount)
                @php($discount += $data->payment->discount_amount)
            @endforeach
            <tr>
                <td class="text-right font-weight-bold" colspan="6">Discount :</td>
                <td class="text-right font-weight-bold">( - ) &#2547;{{ $discount }}</td>
            </tr>
            <tr>
                <td class="text-right font-weight-bold" colspan="6">Grand Total :</td>
                <td class="text-right font-weight-bold">&#2547;{{ $sub_total - $discount }}</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <th>Sl No.</th>
                <th>Customer Info</th>
                <th>Invoice No.</th>
                <th>Invoice Date</th>
                <th>Description</th>
                <th>Discount</th>
                <th>Sub Total</th>
                <th>Status</th>
                <th width="10%">Action</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@push('js')
    <script>
        $(document).on('click', '#', function() {
            var invoice_id = $(this).data('id');
            alert(invoice_id);
            $.ajax({
                url: '/home/invoices/invoice-daily-report-pdf-print/' + invoice_id,
                type: 'GET',
                success: function(data) {

                },
            });
        });
    </script>
@endpush
